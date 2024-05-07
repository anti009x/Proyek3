<?php

namespace Database\Seeders\Kurir;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Kurir extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kurirs')->insert([
            'role_id' => 3 , 
            'gaji' => 40000,
            'nama' => 'Joko',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('kurirs')->insert([
            'role_id' => 3 , 
            'gaji' => 40000,
            'nama' => 'Soko',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        
    }
    
}
