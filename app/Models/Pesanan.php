<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';

    protected $fillable = [
        'Nama_Paket',
        'nama',
        'Generate_Resi',
        'Berat_Barang',
        'Alamat_Tujuan',
        'status_pembayaran',
    ];

    public function InputPesanan()
    {
        return $this->belongsTo(InputPesanan::class, 'Nama_Paket', 'Nama_Paket');
    }
}
