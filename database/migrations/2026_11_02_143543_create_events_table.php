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
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            // Judul acara
            $table->string('title');

            // Deskripsi acara
            $table->text('description')->nullable();

            // Lokasi acara
            $table->string('location')->nullable();

            // Tanggal dan waktu acara
            $table->dateTime('event_date');

            // Status publikasi acara
            $table->enum('status', ['draft', 'published'])
                ->default('draft');

            // Waktu pembuatan dan perubahan data
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
