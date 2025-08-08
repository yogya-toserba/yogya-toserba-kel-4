<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('permintaan', function (Blueprint $table) {
            $table->id('id_permintaan');
            $table->foreignId('id_cabang')->constrained('cabang')->onDelete('cascade');
            $table->foreignId('id_produk')->constrained('stok_produk')->onDelete('cascade');
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
