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
            'rating'=>'Lumayan',
            'saran'=>'Saya sangat suka',
            'nama'=>'Sule',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
