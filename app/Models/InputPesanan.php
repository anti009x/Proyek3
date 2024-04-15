<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputPesanan extends Model
{
    use HasFactory;

    protected $table = 'inputpesananss';

    protected $fillable = [
        'Nama_Barang',
        'nama',
        'Alamat_Tujuan',
        'Nama_Paket',
        'Harga_Paket',
        'Nama_Kurir',
        'status'
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'nama', 'nama');
    }

    public function pilihanPaketByNama()
    {
        return $this->hasMany(PilihanPaket::class, 'Nama_Paket', 'Nama_Paket');
    }

    public function pilihanPaketByHarga()
    {
        return $this->hasMany(PilihanPaket::class, 'Harga_Paket', 'Harga_Paket');
    }

    
    public function kurir()
    {
        return $this->belongsTo(Kurir::class, 'Nama_Kurir', 'nama');
    }

}
