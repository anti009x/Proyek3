<?php

namespace App\Http\Controllers\API\OTP;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Http\Request;

class OTPController extends Controller
{
    
    public function send(Request $request) {
        // $user_id = $request->input('user_id');
        // $user = User::find($user_id);

        // if (!$user) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => "User not found",
        //     ], 400);
        // }

        /**
         *TODO: FILTER no hp
        *format: 628xxx
       * ignore: '+' as in +628xxx, '-' as in 628x-xxx-xxx
        *min: 7 digit
        *max: 13 digit
         */
        $phone_number = $request->input('to');
        // Menghapus semua karakter yang bukan angka
        $phone_number = preg_replace('/[^0-9]/', '', $phone_number);


        /*
        tambahan: satu no. hp cuma bisa dipake satu user
        06/11/23
         */
        $user = User::where('nohp', $phone_number)->first();
        if ($user) {
            return response()->json([
                "success" => false,
                "message" => "Nomor hp telah digunakan."
            ]);
        }

         // rentang 7 hingga 13 digit
        // if (strlen($phone_number) < 7 || strlen($phone_number) > 13) {
        //     return response()->json(['error' => 'Phone number must be 7 characters, and max 13.'], 400);
        // }


        // menghapus awalan "08" klo ada
        if (substr($phone_number, 0, 2) === '08') {
            $phone_number = '628' . substr($phone_number, 2);
        }

        /**
         * tambahan: satu no. hp cuma bisa dikirimin kode 15x dalam 24jam
         * 06/11/23
         */
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


        $url = 'http://127.0.0.1:5001/send-message';
        $postData = [
            "session" => "mysession",
            "to" => $phone_number, # kudu divalidasi dulu nomernya
            "text" => "{$code} adalah kode verifikasi anda. Selamat menggunakan SmartHealth",
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
            //pass
            $responseMessage = "Kode verifikasi gagal dikirim ke WhatsApp Anda (Internal Error)";

            if ($response['response']) {
                $respWaGateway = json_decode($response['response'])->message;
                // $responseMessage = $respWaGateway;
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
}
