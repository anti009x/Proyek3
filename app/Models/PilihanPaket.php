<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Input\Input;

class PilihanPaket extends Model
{
    use HasFactory;

    protected $table = 'pilihanpakets';
    protected $fillable = [
        'Nama_Paket',
        'Harga_Paket',
        // 'Nama Kurir',
    ];

    public function InputPesanan()
    {
        return $this->belongsTo(InputPesanan::class, 'Nama_Paket', 'Nama_Paket');
    }

    public function pilihanPaketByHarga()
    {
        return $this->belongsTo(PilihanPaket::class, 'Harga_Paket', 'Harga_Paket');
    }


}
