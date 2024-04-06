<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'Pembayaran';
    protected  $fillable = [
        'id',
        'code',
        'nama',
        'Alamat_Tujuan',
        'email',
        'amount',
        'Nama_Barang',
        'note',
        'status',
        'snap_token',
    ];

    public function InputPesanan()
    {
        return $this->belongsTo(InputPesanan::class, 'amount', 'Harga_Paket');
    }

}
