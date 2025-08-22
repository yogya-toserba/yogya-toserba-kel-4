<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kas', function (Blueprint $table) {
            $table->id('id_kas');
            $table->unsignedBigInteger('id_cabang');
            $table->foreign('id_cabang')
                ->references('id_cabang')
                ->on('cabang')
                ->onDelete('cascade');

            $table->string('referensi');
            $table->string('jenis_transaksi');
            $table->decimal('jumlah', 15, 2);
            $table->string('keterangan')->nullable();
              $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kas');
    }
};
