<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $table = 'ratings';

    protected $fillable = [
        'rating',
        'saran',
        'nama'
    ];
    public function User(){

        return $this->hasMany(User::class , 'nama','nama');

    }


}
