<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kurir extends Model
{
    use HasFactory;

    protected $table = 'kurirs';
    protected $fillable = [
        'role_id',
        'gaji',
        'nama',
        'nohp',
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'nama', 'nama');
    }

    public function inputPesanan()
    {
        return $this->hasMany(InputPesanan::class, 'Nama_Kurir', 'nama');
    }


}
