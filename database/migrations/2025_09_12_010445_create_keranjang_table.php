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
        Schema::create('keranjang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pelanggan');
            $table->unsignedBigInteger('id_produk');
            $table->string('nama_produk');
            $table->integer('harga');
            $table->integer('jumlah');
            $table->integer('subtotal');
            $table->string('gambar')->nullable();
            $table->string('kategori')->nullable();
            $table->timestamps();
            
            // Foreign key constraints - menggunakan id_pelanggan sebagai referensi
            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan')->onDelete('cascade');
            
            // Index untuk optimasi query
            $table->index(['id_pelanggan', 'id_produk']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjang');
    }
};
