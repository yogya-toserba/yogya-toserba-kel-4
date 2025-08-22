<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pengiriman_produk', function (Blueprint $table) {
            $table->id('id_pengiriman');

            $table->unsignedBigInteger('id_produk');
            $table->foreign('id_produk')
                  ->references('id_produk')
                  ->on('stok_produk')
                  ->onDelete('cascade');

            $table->integer('jumlah');
            $table->date('tanggal_dikirim');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengiriman_produk');
    }
};
