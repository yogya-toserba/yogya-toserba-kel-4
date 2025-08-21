<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->id('id_detail_penjualan');

            $table->unsignedBigInteger('id_transaksi');
            $table->foreign('id_transaksi')
                  ->references('id_transaksi')
                  ->on('transaksi')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('id_produk');
            $table->foreign('id_produk')
                  ->references('id_produk')
                  ->on('stok_produk')
                  ->onDelete('cascade');

            $table->string('nama_barang');
            $table->integer('jumlah_barang');
            $table->decimal('total_harga', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_transaksi');
    }
};
