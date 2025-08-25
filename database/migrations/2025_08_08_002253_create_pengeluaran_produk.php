<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pengeluaran_produk', function (Blueprint $table) {
            $table->id('id_pengeluaran');

            $table->unsignedBigInteger('id_produk');
            $table->foreign('id_produk')
                  ->references('id_produk')
                  ->on('stok_produk')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('id_cabang');
            $table->foreign('id_cabang')
                  ->references('id_cabang')
                  ->on('cabang')
                  ->onDelete('cascade');

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
