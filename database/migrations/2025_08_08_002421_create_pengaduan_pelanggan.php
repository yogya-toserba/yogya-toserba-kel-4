<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pengaduan_pelanggan', function (Blueprint $table) {
            $table->id('id_pengaduan');

            $table->unsignedBigInteger('id_pelanggan');
            $table->foreign('id_pelanggan')
                  ->references('id_pelanggan')
                  ->on('pelanggan')
                  ->onDelete('cascade');

            $table->string('kategori');
            $table->text('deskripsi');
            $table->string('status')->nullable();
            $table->string('lampiran')->nullable();
            $table->date('tanggal_pengaduan');
            $table->text('tanggapan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaduan_pelanggan');
    }
};
