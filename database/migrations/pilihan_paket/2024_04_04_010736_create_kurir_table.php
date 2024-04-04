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
        Schema::create('kurir', function (Blueprint $table) {
            $table->increments('id');

            $table->string('Nama_Kurir');
            $table->string('Nomor_Telepon')->nullable();
            $table->string('Alamat')->nullable();
            $table->integer('Gaji')->nullable();
            $table->timestamps();
        });


        Schema::table('kurir', function (Blueprint $table) {
            $table->index('id');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('kurir');
    }
};
