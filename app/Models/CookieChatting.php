<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CookieChatting extends Model
{
    use HasFactory;
    protected $table= 'cookie_chatting';
    protected $fillable=[
        'id',
        'channel',
        'nama',
        'user_id'
    ];
}
