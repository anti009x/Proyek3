<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table='userss';

    protected $fillable = [
        'id',
        'nama',
        'email',
        'nohp',
        'password',
        'Nama_Kurir',
        'kurirs_id', // Rubah Nama_Kurir -<Valid coy
        'role_id',
        'alamat',
        'gaji',
        // 'kurirs_id'
    ];



    public function InputPesanan()
    {
        return $this->belongsTo(InputPesanan::class, 'nama', 'nama');
    }

    
    public function isActive()
    {
        return $this->active; 
    }
    
    public function Kurir()
    {
        return $this->belongsTo(Kurir::class, 'nama', 'nama');
    }

    public function Pesan()
    {
        return $this->belongsTo(Pesan::class, 'nama', 'nama');
    }

    public function Rating(){
        return $this->belongsTo(Rating::class,'nama','nama');
    }

    public function Pengumuman(){
        return $this->belongsTo(Pengumuman::class,'nama','nama');
    }
    public function Payment(){
        return $this->belongsTo(Payment::class,'nama','nama');
    }
    


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // public function kurir()
    // {
    //     return $this->belongsTo(Kurir::class, 'Nama_Kurir');
    // }
}
