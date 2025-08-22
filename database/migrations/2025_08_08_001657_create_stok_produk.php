<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stok_produk', function (Blueprint $table) {
            $table->id('id_produk');
            $table->unsignedBigInteger('id_cabang');
            $table->foreign('id_cabang')
                ->references('id_cabang')
                ->on('cabang')
                ->onDelete('cascade');

            $table->unsignedBigInteger('id_kategori');
            $table->foreign('id_kategori')
                ->references('id_kategori')
                ->on('kategori')
                ->onDelete('cascade');
            $table->string('foto');
            $table->string('nama_barang');
            $table->integer('jumlah_barang');
            $table->decimal('harga_jual', 15, 2);
            $table->integer('stok');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stok_produk');
    }
};
