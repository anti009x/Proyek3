<?php

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
        Schema::create('pilihanpaket', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('Nama_Paket');
            $table->string('Harga_Paket');
            $table->foreignId('nama_kurir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pilihanpaket');
    }
};
