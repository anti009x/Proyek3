<?php

use App\Models\InputPesanan;
use App\Models\User;
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
            $table->id();
            $table->string('Nama_Kurir');
            $table->string('Nomor_Telepon')->nullable(true);
            $table->string('Alamat')->nullable(true);
            $table->integer('Gaji')->nullable(true);
            // $table->foreignId(InputPesanan::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kurir');
    }
};
