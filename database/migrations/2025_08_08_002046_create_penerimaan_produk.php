<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('penerimaan_produk', function (Blueprint $table) {
            $table->id('id_penerimaan');
            $table->foreignId('id_pengiriman')->constrained('pengiriman_produk')->onDelete('cascade');
            $table->foreignId('id_produk')->constrained('stok_produk')->onDelete('cascade');
            $table->foreignId('id_cabang')->constrained('cabang')->onDelete('cascade');
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
