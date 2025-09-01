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
        Schema::create('simple_pengiriman_produk', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->string('tujuan');
            $table->integer('jumlah');
            $table->date('tanggal_kirim');
            $table->enum('status', ['pending', 'dikirim', 'selesai'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simple_pengiriman_produk');
    }
};