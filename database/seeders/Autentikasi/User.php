<?php

namespace Database\Seeders\Autentikasi;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class User extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            DB::table('userss')->insert([
                'nama'=>'sule',
                'nohp'=>'081234567890',
                'email'=>'ganteng123ke1@gmail.com',
                'password'=>bcrypt(12345),
                'role_id'=>2,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('userss')->insert([
                'nama'=>'Soko',
                'nohp'=>'081234567890',
                'email'=>'ganteng123ke2@gmail.com',
                'password'=>bcrypt(12345),
                'role_id'=>3,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('userss')->insert([
                'nama'=>'Joko',
                'nohp'=>'081234567890',
                'email'=>'ganteng123ke3@gmail.com',
                'password'=>bcrypt(12345),
                'role_id'=>3,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
