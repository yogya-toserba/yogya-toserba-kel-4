<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('detail_pembelian', function (Blueprint $table) {
            $table->id('id_detail_pembelian');

            $table->unsignedBigInteger('id_pembelian');
            $table->foreign('id_pembelian')
                  ->references('id_pembelian')
                  ->on('pembelian')
                  ->onDelete('cascade');

            $table->string('nama_produk');
            $table->integer('jumlah_produk');
            $table->decimal('total_harga', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_pembelian');
    }
};
