<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationCode extends Model
{
    use HasFactory;
    protected $table = 'verification_codes'; // Nama tabel yang sesuai

    protected $fillable = [
        'code',
        'email_or_phone',
        'verification_type',
        'expire_date',
    //    'userss_id'
    // 'nama'

    ];

    // public function User(){

    //     return $this->hasMany(User::class , 'nama','nama');

    // }

}
