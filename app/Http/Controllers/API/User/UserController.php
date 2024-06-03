<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Mail\OTPEmail;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Mail;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

use function Laravel\Prompts\password;

class UserController extends Controller
{   
    use HasApiTokens;
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama' => 'required',
            'nohp' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role_id' => 'required',
            'alamat',
            'gaji',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Data yang Anda masukkan salah!',
                'data' => $validator->errors()
            ]);
        }

        $phone_number = preg_replace('/[^0-9]/', '', $request->nohp);
        if (substr($phone_number, 0, 2) === '08') {
            $phone_number = '628' . substr($phone_number, 2);
        }

        $verification = VerificationCode::where('email_or_phone', $phone_number)
            ->where('verification_type', 'whatsapp')
            ->where('expire_date', '>', now())
            ->latest()
            ->first();

        if (!$verification || !$request->has('code') || $request->code != $verification->code) {
            return response()->json([
                'success' => false,
                'message' => 'Kode verifikasi tidak valid atau belum dimasukkan.'
            ]);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $tokenResult = $user->createToken('auth_token');
        $success['token'] = $tokenResult->plainTextToken;
        $success['nama'] = $user->nama;

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diinput',
            'data' => $success
        ]);
    }

    public function send(Request $request) {
        $phone_number = $request->input('nohp'); 
        $phone_number = preg_replace('/[^0-9]/', '', $phone_number);

        $user = User::where('nohp', $phone_number)->first();
        if ($user) {
            return response()->json([
                "success" => false,
                "message" => "Nomor hp telah digunakan."
            ]);
        }

        if (substr($phone_number, 0, 2) === '08') {
            $phone_number = '628' . substr($phone_number, 2);
        }

        $countExistingVerif = VerificationCode::where('email_or_phone', $phone_number)
            ->whereDate('created_at', now()->toDateString())
            ->count();
        if ($countExistingVerif >= 15) {
            return response()->json([
                "success" => false,
                "message" => "Nomor ini telah mencapai batas pengiriman harian. Silakan coba lagi besok"
            ]);
        }

        $code = $this->generateCode();

        $url = 'https://wa-gateway-production-36b2.up.railway.app/send-message';
        $postData = [
            "session" => "mysession",
            "to" => $phone_number,
            "text" => "{$code} adalah kode verifikasi anda. Selamat menggunakan AntarIn",
        ];

        $response = $this->curl($url, $postData);

        $responseMessage = "";
        $isSuccess = $response['httpCode'] == 200;
        if ($isSuccess) {
            try {
                VerificationCode::create([
                    'code' => $code,
                    'email_or_phone' => $phone_number,
                    'verification_type' => 'whatsapp',
                    'expire_date' => now()->addHours(24),
                ]);

                $responseMessage = "Kode verifikasi berhasil dikirim ke WhatsApp Anda";
            } catch (\Exception $e) {
                $responseMessage = "Kode verifikasi gagal dikirim ke WhatsApp Anda (Internal DB Error)";
            }
        } else {
            $responseMessage = "Kode verifikasi gagal dikirim ke WhatsApp Anda (Internal Error)";

            if ($response['response']) {
                $respWaGateway = json_decode($response['response'])->message;
                if (preg_match("/is not registered on Whatsapp/i", $respWaGateway)) {
                    $responseMessage = "Nomor tidak terdaftar di WhatsApp";
                }
            }
        }

        return response()->json([
            'success' => $isSuccess,
            'message' => $responseMessage,
        ]);
    }

    private function generateCode() {
        return random_int(100000, 999999);
    }

    private function curl($remoteUrl, $postData) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $remoteUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        return [
            'httpCode' => $httpCode,
            'response' => $response,
            'error' => ($httpCode != 200) ?
                "Failed. HTTP Code: " . $httpCode : null,
        ];
    }
    public function login(Request $request)
    {
      
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $auth = Auth::user();
            
            // abaikan error ini guys
            $tokenResult = $auth->createToken('auth_token');
            $success['token'] = $tokenResult->plainTextToken; 
            $success['nama'] = $auth->nama;
            $success['role_id'] = $auth->role_id;

            return response()->json([
                'success' => true,
                'message' => 'Login Berhasil',
                'data' => $success
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Kesalahan Data !',
            ], 401);
        }

        //Logout
    }
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        $auth = Auth::user();
        $success['nama'] = $auth->nama;

        return response()->json([
            'message' => 'Berhasil Logout',
            'Akun Yang Logout Adalah' => $success,
        ], 200);
    }


    public function index(Request $request){
        $user = $request->user();
        if ($user){
            return response()->json([
                'message' => true,
                'data' => $user
            ],200);
        }else{
            return response()->json([
                'message' => false,
                'data' => 'Data User Tidak Ditemukan',
            ],404);
        }
    }

    public function datasemuauser(){
        $user = User::all();
        if ($user){
            return response()->json([
                'message' => true,
                'data' => $user
            ],200);
        }else{
            return response()->json([
                'message' => false,
                'data' => 'Data User Tidak Ditemukan',
            ],404);
        }
    }

    public function updatenohp(Request $request){
        $user = $request->user();

        $request->validate([
            'nohp' => 'required',
        ]);

        if (!$user){
            return response()->json([
                'message' => 'Data User Tidak Ditemukan',
                'data' => 'Data User Tidak Ditemukan',
            ],404);
        }

        $user->update($request->only(['nohp']));

        return response()->json([
            'message' => 'Data Berhasil Diupdate',
            'data' => $user,
            'succes'=>true
        ], 200);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'alamat' => 'required',
        ]);

        if (!$user) {
            return response()->json([
                'message' => 'Data User Tidak / Ada Bermasalah',
                 'succes'=>false
            ], 404);
        }
        $user->update($request->only(['alamat']));
        return response()->json([
            'message' => 'Data Berhasil Iinput',
            'data' => $user,
            'succes'=>true
        ], 200);
    }

    public function updategajikurir(Request $request, $nama_kurir){
  
        $user = User::where('nama', $nama_kurir)->first();
    
        if (!$user) {
            return response()->json([
                'message' => 'Kurir tidak ditemukan',
                'success' => false
            ], 404);
        }
    
        $request->validate([
            'gaji' => 'required|numeric', 
        ]);
    
        $gaji_sekarang = $user->gaji;
        $gaji_baru = $gaji_sekarang + $request->gaji;
        $user->update(['gaji' => $gaji_baru]);
    
        return response()->json([
            'message' => 'Data Gaji Kurir Berhasil Ditambahkan',
            'data' => $user,
            'success' => true
        ], 200);
    }

    public function delete($id){
        $user = User::find($id);
        if (!$user){
            return response()->json([
                'message' => 'Delete Error: User Not Found',
            ],404);
        }
        $user->delete();
        $success['nama'] = $user->nama;
        return response()->json([
            'message' => 'Delete Success',
            'data' => $success
        ],200);          
    }

    public function getdatakurir(){
        $kurir = User::where('role_id', 3)->get();
        return response()->json([
            'message' => true,
            'data' => $kurir
        ],200);
    }


 
    public function sendemail(Request $request) {
        $email = $request->input('email'); 
        
        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json([
                "success" => false,
                "message" => "Format email tidak valid."
            ], 400);
        }

        // $user = User::where('email', $email)->first();
        // if ($user) {
        //     return response()->json([
        //         "success" => false,
        //         "message" => "Email telah digunakan."
        //     ], 409);
        // }

        $countExistingVerif = VerificationCode::where('email_or_phone', $email)
            ->whereDate('created_at', now()->toDateString())
            ->count();
        if ($countExistingVerif >= 15) {
            return response()->json([
                "success" => false,
                "message" => "Email ini telah mencapai batas pengiriman harian. Silakan coba lagi besok"
            ], 429); 
        }

        $code = $this->generateCode();

        $details = [
            'subject' => "{$code} adalah kode verifikasi Anda Untuk Reset Password",
            'verif_code' => $code,
            'email' => $email 
        ];

        Mail::to($email)->send(new OTPEmail($details));

        VerificationCode::create([
            'code' => $code,
            'email_or_phone' => $email,
            'verification_type' => 'email',
            'expire_date' => now()->addHours(24),
        ]);

        return response()->json([
            'success' => true,
            'message' => "Kode verifikasi berhasil dikirim ke Email Anda",
        ], 200);
    }
    public function changepassword(Request $request, $email){
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json([
                'message' => 'Format email tidak valid',
            ], 400);
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Email Tidak Ditemukan',
            ], 404);
        }

        $verification = VerificationCode::where('email_or_phone', $email)
            ->where('verification_type', 'email')
            ->where('expire_date', '>', now())
            ->latest()
            ->first();

        if (!$verification || !$request->has('code') || $request->code != $verification->code) {
            return response()->json([
                'success' => false,
                'message' => 'Kode verifikasi tidak valid atau belum dimasukkan.'
            ], 400); 
        }

        $password = $request->password;
        $confirmasipassword = $request->confirmasipassword;

        if ($password != $confirmasipassword ){
            return response()->json([
                'message' => 'Password Tidak Sama',
            ], 400);
        }

        $request->validate([
            'password' => 'required',
            'confirmasipassword' => 'required|same:password',
        ]);

        $user->update(['password' => bcrypt($request->password)]);
        return response()->json([
            'message' => 'Password Berhasil Diubah',
            'data' => $user,
            'success' => true
        ], 200);
    }

    
    public function checkavaiblemail(Request $request, $email) {
        
        $user = User::where('email', $email)->first();
        if ($user){
            return response ()->json([
            'message' => 'Email Ditemukan'
            ],200);
            
        }

        if (!$user){
            return response ()->json([
                'message' => 'Email Tidak Ditemukan'
                ],200);
        }
    }

}