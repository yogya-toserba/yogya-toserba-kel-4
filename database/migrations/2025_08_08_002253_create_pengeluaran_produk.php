<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pengeluaran_produk', function (Blueprint $table) {
            $table->id('id_pengeluaran');
            $table->foreignId('id_produk')->constrained('stok_produk')->onDelete('cascade');
            $table->foreignId('id_cabang')->constrained('cabang')->onDelete('cascade');
            $table->date('tanggal_keluar');
            $table->string('alasan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengeluaran_produk');
    }
};
