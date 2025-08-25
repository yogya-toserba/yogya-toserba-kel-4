<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');

            $table->unsignedBigInteger('id_pelanggan');
            $table->foreign('id_pelanggan')
                  ->references('id_pelanggan')
                  ->on('pelanggan')
                  ->onDelete('cascade');

            $table->date('tanggal_transaksi');
            $table->decimal('total_belanja', 15, 2);

            $table->unsignedBigInteger('id_cabang');
            $table->foreign('id_cabang')
                  ->references('id_cabang')
                  ->on('cabang')
                  ->onDelete('cascade');

            $table->integer('poin_yang_didapatkan')->nullable();
            $table->integer('poin_yang_digunakan')->nullable();

            $table->unsignedBigInteger('id_kas');
            $table->foreign('id_kas')
                  ->references('id_kas')
                  ->on('kas')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
