<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pilihanpakets', function (Blueprint $table) {
            $table->id();
            $table->string('Nama_Paket');
            $table->integer('Harga_Paket');
            $table->timestamps();
        });

        DB::table('pilihanpakets')->insert([
            [
                'Nama_Paket' => 'Paket Cepat',
                'Harga_Paket' => 30000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Nama_Paket' => 'Paket Reguler',
                'Harga_Paket' => 25000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Nama_Paket' => 'Paket Standar',
                'Harga_Paket' => 20000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pilihanpakets');
    }
};
