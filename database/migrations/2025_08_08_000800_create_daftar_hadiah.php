<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('daftar_hadiah', function (Blueprint $table) {
            $table->id('id_hadiah');
            $table->string('nama_hadiah');
            $table->integer('poin_yang_dibutuhkan');
            $table->integer('stok');
            $table->string('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daftar_hadiah');
    }
};
