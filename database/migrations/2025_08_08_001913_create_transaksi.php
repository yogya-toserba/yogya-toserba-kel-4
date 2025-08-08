<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->foreignId('id_pelanggan')->constrained('pelanggan')->onDelete('cascade');
            $table->date('tanggal_transaksi');
            $table->decimal('total_belanja', 15, 2);
            $table->foreignId('id_cabang')->constrained('cabang')->onDelete('cascade');
            $table->integer('poin_yang_didapatkan')->nullable();
            $table->integer('poin_yang_digunakan')->nullable();
            $table->foreignId('id_kas')->constrained('kas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
