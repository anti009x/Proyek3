<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PilihanBerat extends Model
{
    use HasFactory;
    protected $table = 'pilihan_berats';

    protected $fillable = [

        'Berat_kg',
    ];
}
