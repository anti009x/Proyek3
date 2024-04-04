<?php

use App\Models\Kurir;
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
            $table->string('Nama_Kurir');
            $table->string('nama');
            

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
