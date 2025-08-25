<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('penukaran_poin', function (Blueprint $table) {
            $table->id('id_penukaran');
            $table->foreignId('id_pelanggan')
                  ->constrained('pelanggan', 'id_pelanggan')
                  ->onDelete('cascade');
            $table->foreignId('id_hadiah')
                  ->constrained('daftar_hadiah', 'id_hadiah')
                  ->onDelete('cascade');
            $table->integer('poin_yang_digunakan');
            $table->dateTime('waktu_penukaran');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penukaran_poin');
    }
};
