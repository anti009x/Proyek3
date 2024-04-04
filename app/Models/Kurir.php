<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kurir extends Model
{
    use HasFactory;

    protected $table = 'kurir';

    protected $fillable = [
        'Nama_Kurir',
        'Nomor_Telepon',
        'Alamat',
        'Gaji',
        'nama',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'nama');
    }
}
