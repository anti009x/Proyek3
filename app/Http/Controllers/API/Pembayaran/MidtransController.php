<?php

namespace App\Http\Controllers\API\Pembayaran;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
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
        $serverKey = env('MIDTRANS_SERVER_KEY'); // Use server key instead of client key for authorization
        $midtrans_auth = $serverKey . ':'; // Corrected to use server key
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
            'bank_transfer' => $bank_transfer
        ];
        $response = Http::withHeaders($header)
            ->post('https://api.sandbox.midtrans.com/v2/charge', $transaction_data);
        $data = json_decode($response->getBody(), true);
        $this->model->insert_payment($data);
        return response()->json([
            'message' => true,
            'data' => $data,
        ]);
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
