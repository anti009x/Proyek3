<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputPesanan extends Model
{
    use HasFactory;

    protected $table = 'inputpesanan';

    protected $fillable = [
        'Nama_Barang',
        'Generate_Resi',
        'Berat_Barang',
        'Alamat_Tujuan',
        'status_pembayaran',
        'nama',
        'Harga_Paket',
        'Nama_Kurir',
    ];

    public function Kurir()
    {
        return $this->belongsTo(Kurir::class, 'Nama_Kurir', 'Nama_Kurir');
    }

    public function PilihanPaket()
    {
        return $this->belongsTo(PilihanPaket::class, 'Harga_Paket', 'Harga_Paket');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'nama', 'nama');
    }
}
