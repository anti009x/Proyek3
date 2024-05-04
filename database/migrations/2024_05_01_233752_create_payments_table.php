<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userss_id')->constrained('userss');
            $table->string('nama');
            $table->string('transaction_id');
            $table->string('order_id');
            $table->string('merchant_id');
            $table->integer('gross_amount');
            $table->string('payment_type');
            $table->string('status_message');
            $table->string('transaction_status');
            $table->string('bank');
            $table->string('va_number');
            $table->timestamp('transaction_time')->useCurrent();
            $table->timestamp('expiry_time')->useCurrent();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
