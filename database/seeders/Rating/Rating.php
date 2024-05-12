<?php

namespace Database\Seeders\Rating;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Rating extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ratings')->insert([
            'rating'=>2,
            'komentar'=>'Kurang',
            'nama'=>'sulse',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('ratings')->insert([
            'rating'=>4,
            'komentar'=>'Bagus',
            'nama'=>'sule',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('ratings')->insert([
            'rating'=>5,
            'komentar'=>'Saya sangat suka',
            'nama'=>'sulse',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('ratings')->insert([
            'rating'=>1,
            'komentar'=>'Terlalu Kurang',
            'nama'=>'sule',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('ratings')->insert([
            'rating'=>3,
            'komentar'=>'Cukup',
            'nama'=>'sulse',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
    }
}
