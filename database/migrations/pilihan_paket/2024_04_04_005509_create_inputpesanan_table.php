<?php

use App\Models\Kurir;
use App\Models\PilihanPaket;
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
        Schema::create('inputpesanan', function (Blueprint $table) {
            $table->id();
            $table->string('Nama_Barang');
            $table->string('Generate_Resi');
            $table->integer('Berat_Barang');
            $table->string('Alamat_Tujuan'); 
            $table->string('status_pembayaran');
     
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inputpaket');
    }
};
