<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Models\InputPesanan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PembayaranController extends Controller
{
    protected $response = [];

    public function index() {
        // $InputPesanan = Pembayaran::findOrFail($id);
        // return view('pembayaran.pembayaran', ['books' => $books]);

        $InputPesanan = InputPesanan::all();

        return response()->json([
            'Message' => $InputPesanan
        ]);
        
    }

    public function __construct()
    {
        Config::$serverKey    = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized  = config('services.midtrans.isSanitized');
        Config::$is3ds        = config('services.midtrans.is3ds');
    }

    public function pay(Request $request)
    {
        DB::transaction(function () use ($request) {
            $user = Auth::user();

            $amount = $request->amount;
            $Nama_Barang = $request->Nama_Barang;
            $Alamat_Tujuan = $request->Alamat_Tujuan;
       
    
            
            $this->validate($request, [
                'judul' => 'required|string',

            ]);
    
            $Pembayaran = Pembayaran::create([

                'code'   => 'DONATION-' . mt_rand(100000, 999999),
                'nama'=>$user->name,
                'Alamat_Tujuan'=>$Alamat_Tujuan,
                'email'  => $user->email,
                'amount' => $amount,
                'Nama_Barang'=>$Nama_Barang,
                'note'   => $request->note,
            ]);
    
            $payload = [
                'transaction_details' => [
                    'order_id'     => $Pembayaran->code,
                    'gross_amount' => $Pembayaran->amount,
                ],
                'customer_details' => [
                    'first_name' => $Pembayaran->nama,
                    'email'      => $Pembayaran->email,
                ],
                'item_details' => [
                    [
                        'id'            => $Pembayaran->code,
                        'Nama_Barang'   => $Pembayaran->Nama_Barang,
                        'price'         => $Pembayaran->amount,
                        'Alamat_Tujuan' => $Pembayaran->Alamat_Tujuan,
                        'quantity'      => 1,
                        'nama'          => 'Pembayaran to ' . config('app.nama'),
                        'brand'         => 'Pembayaran',
                        'category'      => 'Pembayaran',
                        'merchant_name' => config('app.name'),
                    ],
                ],
            ];
    
            $snapToken = Snap::getSnapToken($payload);
            $Pembayaran->snap_token = $snapToken;
            $Pembayaran->save();
    
            $this->response['snap_token'] = $snapToken;
        });
    
        return response()->json([
            'status'     => 'success',
            'message'    => 'Payment successful',
            'snap_token' => $this->response['snap_token'],
          
        ]);


    
 
}

public function callback (Request $request){
                $serverKey = config('services.midtrans.serverKey');
                $hashed = hash("sha512", $request->order_id . $request->status . $request->gross_amount . $serverKey);

                if ($hashed($hashed==$request->signature_key)) {
                    if ($request->transaction_status == 'capture') {
                        $order = Pembayaran::find($request->status);
                        $order->update(['status' => 'Paid']);
                    }
                }
            }
}
