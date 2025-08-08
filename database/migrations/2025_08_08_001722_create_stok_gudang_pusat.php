<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stok_gudang_pusat', function (Blueprint $table) {
            $table->id('id_produk');
            $table->string('nama_produk');
            $table->string('satuan');
            $table->integer('jumlah');
            $table->date('expired')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stok_gudang_pusat');
    }
};
