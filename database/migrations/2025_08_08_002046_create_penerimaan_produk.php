<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('penerimaan_produk', function (Blueprint $table) {
            $table->id('id_penerimaan');

            $table->unsignedBigInteger('id_pengiriman');
            $table->foreign('id_pengiriman')
                  ->references('id_pengiriman')
                  ->on('pengiriman_produk')
                  ->onDelete('cascade');

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

            $table->integer('jumlah');
            $table->date('tanggal_terima');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penerimaan_produk');
    }
};
