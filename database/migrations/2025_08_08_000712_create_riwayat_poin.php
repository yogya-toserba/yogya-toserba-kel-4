<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('riwayat_poin', function (Blueprint $table) {
            $table->id('id_poin');
            $table->foreignId('id_pelanggan')
                  ->constrained('pelanggan', 'id_pelanggan')
                  ->onDelete('cascade')
                  ->onUpdate('cascade'); // tambah onUpdate untuk konsistensi data

            $table->integer('poin');
            $table->string('deskripsi', 255); // kasih batas panjang agar lebih optimal
            $table->date('tanggal_expired')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_poin');
    }
};
