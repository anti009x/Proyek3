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
            $table->string('alamat');

            // $table->string('Alamat_Tujuan');
            $table->string('province');
            $table->string('city_name');
            $table->integer('postal_code');
            $table->string('Nama_Paket');
            $table->integer('Harga_Paket');
            $table->string('Nama_Kurir');
            $table->string('status')->default('Belum Dibayar');
            $table->string('paket')->default('NULL');
            $table->string( 'paket_sekarang')->default('NULL');
            $table->string('penerimaan_paket')->default('NULL');
            $table->string('Angkutan');
            $table->string('DetailAlamat');
            $table->integer('Lebar_cm');
            $table->integer('Tinggi_cm');

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
