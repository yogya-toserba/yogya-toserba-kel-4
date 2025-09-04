<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('simple_pengiriman_produk', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk')->nullable();
            $table->string('tujuan')->nullable();
            $table->integer('jumlah')->default(0);
            $table->date('tanggal_kirim')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('simple_pengiriman_produk');
    }
};
