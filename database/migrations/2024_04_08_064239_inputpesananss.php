<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inputpesananss', function (Blueprint $table) {
            $table->id();
            $table->string('Nama_Barang');
            $table->string('nama');
            $table->string('Generate_Resi');
            $table->string('Berat_Barang');
            $table->string('Alamat_Tujuan');
            $table->string('status_pembayaran');
            $table->foreignId('pilihanpakets_id')->constrained('pilihanpakets');
            $table->foreignId('kurirs_id')->constrained('kurirs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
