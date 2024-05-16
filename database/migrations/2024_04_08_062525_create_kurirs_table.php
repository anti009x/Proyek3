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
        Schema::create('kurirs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained('roles')->where('id', 3);
            $table->integer('gaji')->default(0);
            $table->string('nama');
            $table->string('nohp')->default('62895806770203');
            $table->timestamps();
        });
        // DB::table('kurirs')->insert([
        //     ['role_id' => 3 , 
        //     'gaji' => 40000,
        //     'nama' => 'Joko',
        //     'created_at' => now(),
        //     'updated_at' => now(),],
        // ]);
        // DB::table('kurirs')->insert([
        //     ['role_id' => 3 , 
        //     'gaji' => 50000,
        //     'nama' => 'Soko',
        //     'created_at' => now(),
        //     'updated_at' => now(),],
        // ]);
    }
    


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kurirs');
    }
};
