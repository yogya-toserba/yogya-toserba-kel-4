<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pemasok', function (Blueprint $table) {
            $table->id('id_pemasok');
            $table->string('nama_perusahaan');
            $table->string('kontak_person');
            $table->string('telepon', 20);
            $table->string('email');
            $table->text('alamat');
            $table->string('kota', 100);
            $table->string('kategori_produk');
            $table->date('tanggal_kerjasama')->nullable();
            $table->enum('status', ['aktif', 'non-aktif'])->default('aktif');
            $table->text('catatan')->nullable();
            $table->decimal('rating', 2, 1)->default(5.0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemasok');
    }
};
