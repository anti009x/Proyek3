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
        'Generate_Resi',
        'Berat_Barang',
        'Alamat_Tujuan',
        'status_pembayaran',
        'Nama_Kurir',
        'nama',
        'pilihanpakets_id',
        'kurirs_id',
        'nama'

        
    ];


    public function User()
    {
        return $this->hasMany(User::class, 'nama', 'nama');
    }

    // public function User()
    // {
    //     return $this->belongsTo(User::class, 'nama');
    // }

    // public function Pesanan(){
    //     return $this->hasMany(PilihanPaket::class,'Nama_Paket');
    //     return $this->hasMany(PilihanPaket::class,'Harga_Paket');

    // }

    

    // public function kurir()
    // {
    //     return $this->belongsTo(Kurir::class, 'Nama_Kurir');
    // }

}
