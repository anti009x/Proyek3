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
        'Nama_Barang'

    ];

    public function InputPesanan()
    {
        return $this->belongsTo(InputPesanan::class, 'Nama_Barang');
    }

}
