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
        'nama',
        'transaction_id',
        'order_id',
        'merchant_id',
        'gross_amount',
        'payment_type',
        // 'transaction_message',
        'transaction_status',
        'bank',
        'va_number',
        'status_message',
        'userss_id',
        'transaction_time',
        'expiry_time',
    ];

    public function User(){

        return $this->hasMany(User::class , 'nama','nama');

    }


    

    public function insert_payment($data){
        self::create([
            'transaction_id' => $data['transaction_id'],
            'nama'=> $data['nama'],
            'userss_id'=>$data['userss_id'],
            'order_id' => $data['order_id'],
            'merchant_id' => $data['merchant_id'],
            'gross_amount' => $data['gross_amount'],
            'payment_type' => $data['payment_type'],
            'transaction_status' => $data ['transaction_status'],
            'status_message' => $data['status_message'], 
            'bank' => $data['va_numbers'][0]['bank'], 
            'va_number' => $data['va_numbers'][0]['va_number'], 
            'transaction_time'=>$data['transaction_time'],
            'expiry_time'=>$data['expiry_time'],

        ]);
    }

    public function update_payment($data){
        $status = $data['transaction_status'] === 'settlement' || $data['transaction_status'] === 'capture' ? 'Sukses' : $data['transaction_status'];
        self::where('order_id', $data['order_id'])->update([
            'transaction_status' => $status
        ]);
    }



}
