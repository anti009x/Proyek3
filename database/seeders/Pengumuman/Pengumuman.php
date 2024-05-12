<?php

namespace Database\Seeders\Pengumuman;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Pengumuman extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pengumuman')->insert([
            'deskripsi'=>'Migrasi Server 1.1',
            'nama'=>'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('pengumuman')->insert([
            'deskripsi'=>'Maintance Mingguan Server 1.2',
            'nama'=>'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // DB::table('pengumuman')->insert([
        //     'deskripsi'=>'Bugs Fixed',
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        
    }
}
