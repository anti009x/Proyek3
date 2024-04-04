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
        'Nama_Kurir',
        'nama',
        
    ];

    public function User()
    {
        return $this->hasMany(User::class, 'nama');
    }

    public function kurir()
    {
        return $this->belongsTo(Kurir::class, 'Nama_Kurir');
    }

}
