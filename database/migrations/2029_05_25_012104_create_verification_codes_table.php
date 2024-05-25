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
        Schema::create('verification_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            // $table->foreignId('userss_id')->constrained('userss');
            $table->string('email_or_phone'); // atau nomor telepon
            $table->string('verification_type'); // misalnya "email" atau "whatsapp"
            $table->timestamp('expire_date');
            // $table->string('nama');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verification_codes');
    }
};
