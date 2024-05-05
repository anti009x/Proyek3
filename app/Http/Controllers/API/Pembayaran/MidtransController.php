<?php

namespace App\Http\Controllers\API\Pembayaran;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class MidtransController extends Controller
{
    protected $model = null;
    public function __construct()
    {
        $this->model = new Payment();
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $midtrans_auth = $serverKey . ':'; 
        $kode = uniqid();
        $type = "";
        $bank = $request->bank;
        if ($bank == 'bca' || $bank == 'bni' || $bank == 'bri' || $bank == 'cimb') {
            $type = 'bank_transfer';
        }
        $header = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode($midtrans_auth)
        ];
        $transaction = [
            'order_id' => $kode,
            'gross_amount' => (int)$request->amount
        ];
        $payment_type = $type;
        $bank_transfer = [
            'bank' => $bank
        ];

        $transaction_data = [
            'payment_type' => $payment_type,
            'transaction_details' => $transaction,
            'bank_transfer' => $bank_transfer,
            'nama' => $user->nama, 
            'userss_id'=>$user->id,
        ];
        $response = Http::withHeaders($header)
            ->post('https://api.sandbox.midtrans.com/v2/charge', $transaction_data);
        $data = json_decode($response->getBody(), true);

        $data['nama'] = $user->nama;
        $data['userss_id']=$user->id;
        $this->model->insert_payment($data);
        return response()->json([
            'message' => true,
            'data' => $data,
        ]);
    }

    public function riwayatopup(){
        $user = Auth::user();
        if($user){
            $insert_payment = $this->model::where('userss_id', $user->id)->get();
            return response()->json([
                'message' => true,
                'data' => $insert_payment,
            ]);
        } else {
            return response()->json([
                'message' => false,
                'data' => 'tidak ada history transaksi',
            ]);
        }
    }

    public function riwayatopupbysaldo(){
        $user = Auth::user();
        if($user){
            $total_amount = $this->model::where('userss_id', $user->id)
                                        ->where('transaction_status', '!=', 'pending')
                                        ->sum('gross_amount');

            return response()->json([
                'message' => true,
                'data' => [
                    'gross_amount' => $total_amount,
                ],
            ]);
        } else {
            return response()->json([
                'message' => false,
                'data' => 'tidak ada history transaksi',
            ]);
        }
    }

    public function updatesaldo(Request $request){
        $user = Auth::user();
        if($user){
            $request->validate([
                'gross_amount' => 'required|numeric'
            ]);
    
            $transactions = $this->model::where('userss_id', $user->id)
                                        ->where('transaction_status', '!=', 'pending')
                                        ->get();
    
            $total_deducted = 0;
    
            foreach ($transactions as $transaction) {
                if ($request->gross_amount <= 0) break;
    
                $current_amount = $transaction->gross_amount;
                if ($current_amount >= $request->gross_amount) {
                    $transaction->update(['gross_amount' => $current_amount - $request->gross_amount]);
                    $total_deducted += $request->gross_amount;
                    $request->gross_amount = 0;
                } else {
                    $transaction->update(['gross_amount' => 0]);
                    $request->gross_amount -= $current_amount;
                    $total_deducted += $current_amount;
                }
            }
    
            if ($request->gross_amount > 0) {
                return response()->json([
                    'message' => 'Saldo tidak cukup',
                ], 400);
            }
    
            return response()->json([
                'message' => 'Saldo berhasil diperbarui',
                'data' => [
                    'gross_amount' => $user->saldo - $total_deducted,
                ],
            ]);
        } else {
            return response()->json([
                'message' => 'Tidak ada history transaksi',
            ], 404);
        }
    }

    public function riwayatopupbyid($id){
        $user = Auth::user();
        if($user){
            $insert_payment = $this->model::where('userss_id', $user->id)
                                            ->where('id', $id)
                                            ->get();
            return response()->json([
                'message' => true,
                'data' => $insert_payment,
            ]);
        } else {
            return response()->json([
                'message' => false,
                'data' => 'tidak ada history transaksi',
            ]);
        }
    }
    
    public function midtrans_hook(Request $request){
        $result = file_get_contents('php://input');
        $data = json_decode($result,true);
        $this->model->update_payment($data);
        return response()->json([
            'message' => true,
            'data'=>$data,
        ]);


    }

    // public function aftherpay(Request $request){
    //     $serverKey = config('midtrans.server_key');
    //     $hashed = hash ("")


    // }
}
