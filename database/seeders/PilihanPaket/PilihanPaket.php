<?php

namespace Database\Seeders\PilihanPaket;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PilihanPaket extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pilihanpakets')->insert([
            'Nama_Paket' => 'Paket Cepat',
            'Harga_Paket' => 30000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('pilihanpakets')->insert([
            'Nama_Paket' => 'Paket Reguler',
            'Harga_Paket' => 25000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('pilihanpakets')->insert([
            'Nama_Paket' => 'Paket Standar',
            'Harga_Paket' => 20000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('pilihanpakets')->insert([
            'Nama_Paket' => 'Paket Ekonomis',
            'Harga_Paket' => 15000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
