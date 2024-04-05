<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Input\Input;

class PilihanPaket extends Model
{
    use HasFactory;

    protected $table = 'pilihanpaket';
    protected $fillable = [
        'Nama_Paket',
        'Harga_Paket',
        // 'Nama Kurir',
    ];

    // public function Kurir(){
        
    //     return $this->hasMany(Kurir::class,'Nama_Kurir');
        
    // }

        public function InputPesanan(){
            return $this->belongsTo(InputPesanan::class,'id');
        }

}
