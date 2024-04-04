<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PilihanPaket extends Model
{
    use HasFactory;

    protected $table = 'pilihan_paket';
    protected $fillable = [
        'Nama_Paket',
        'nama',
        'Harga_Paket'
    ];
}
