<?php

use App\Models\Kurir;
use App\Models\PilihanPaket;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInputpesananTable extends Migration
{
    public function up()
    {
        Schema::create('inputpesanan', function (Blueprint $table) {
            $table->id();
            $table->string('Nama_Barang');
            $table->string('Generate_Resi');
            $table->string('Berat_Barang');
            $table->string('Alamat_Tujuan');
            $table->string('status_pembayaran');
            $table->string('Harga_Paket')->default(30000);
            // $table->foreignIdFor(PilihanPaket::class,'Nama_Paket');
            // $table->foreignIdFor(User::class,'nama');
            // $table->foreignIdFor(Kurir::class,'Nama_Kurir');
            //Komentar Data Ini Jika Sudah Running Di Program
            $table->string('Nama_Paket')->default('Paket Cepat');
            // $table->string('nama');
            // $table->string('Nama_Kurir');

            // $table->foreign('Nama_Kurir')->references('id')->on('kurir');
            // $table->foreign('kurir_id')->references('id')->on('kurir'); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inputpesanan');
    }
}
