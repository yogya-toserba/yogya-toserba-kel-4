<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('permintaan', function (Blueprint $table) {
            $table->id('id_permintaan');

            $table->unsignedBigInteger('id_cabang');
            $table->foreign('id_cabang')
                  ->references('id_cabang')
                  ->on('cabang')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('id_produk');
            $table->foreign('id_produk')
                  ->references('id_produk')
                  ->on('stok_produk')
                  ->onDelete('cascade');

            $table->date('tanggal_permintaan');
            $table->string('status');
            $table->string('prioritas')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permintaan');
    }
};
