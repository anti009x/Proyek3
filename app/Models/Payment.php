<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';
    protected $fillable = [
        'transaction_id',
        'order_id',
        'merchant_id',
        'gross_amount',
        'payment_type',
        // 'transaction_message',
        'transaction_status',
        'bank',
        'va_number',
        'status_message'
    ];

    public function insert_payment($data){
        self::create([
            'transaction_id' => $data['transaction_id'],
            'order_id' => $data['order_id'],
            'merchant_id' => $data['merchant_id'],
            'gross_amount' => $data['gross_amount'],
            'payment_type' => $data['payment_type'],
            'transaction_status' => $data ['transaction_status'],
            'status_message' => $data['status_message'], // Assuming you want to store the status message here
            'bank' => $data['va_numbers'][0]['bank'], // Accessing the first element of the va_numbers array
            'va_number' => $data['va_numbers'][0]['va_number'], // Accessing the first element of the va_numbers array
        ]);
    }

    public function update_payment($data){
        $status = "";
        if ($data['transaction_status'] == 'settlement' || $data['transaction_status'] == 'capture') {
            $status = 'Sukses';
        } else {
            $status = $data['transaction_status'];
        }
        self::where('order_id', $data['order_id'])->update([
            'transaction_status' => $status
        ]);
    }



}
