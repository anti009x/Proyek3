<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    use HasFactory;

    protected $table = 'pesans';

    protected $fillable = [
        'kirim_pesan',
        'nama_pengirim',
        'nama_penerima',
        'userss_id',

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'nama_pengirim', 'nama_penerima');
    }
}
