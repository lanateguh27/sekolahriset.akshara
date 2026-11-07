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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();

            // Data identitas peserta
            $table->string('name');
            $table->string('institution');
            $table->string('city');
            $table->string('phone', 20);
            $table->string('email')->unique();

            // Bukti pembayaran disimpan sebagai path file
            $table->string('payment_proof');

            // Sumber informasi pendaftaran
            $table->string('information_source');

            // Status verifikasi oleh admin
            $table->string('status')->default('pending');

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
