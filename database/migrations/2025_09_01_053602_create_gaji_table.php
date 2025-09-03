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
        Schema::create('gaji', function (Blueprint $table) {
            $table->id('id_gaji');
            $table->unsignedBigInteger('id_karyawan');
            $table->year('periode_tahun');
            $table->tinyInteger('periode_bulan');
            $table->decimal('gaji_pokok', 15, 2)->default(0);
            $table->decimal('tunjangan', 15, 2)->default(0);
            $table->decimal('lembur_jam', 8, 2)->default(0);
            $table->decimal('lembur_tarif', 15, 2)->default(0);
            $table->decimal('total_lembur', 15, 2)->default(0);
            $table->decimal('bonus', 15, 2)->default(0);
            $table->decimal('potongan_absen', 15, 2)->default(0);
            $table->decimal('potongan_bpjs', 15, 2)->default(0);
            $table->decimal('potongan_pajak', 15, 2)->default(0);
            $table->decimal('potongan_lain', 15, 2)->default(0);
            $table->decimal('total_potongan', 15, 2)->default(0);
            $table->decimal('total_gaji', 15, 2)->default(0);
            $table->date('tanggal_gajian')->nullable();
            $table->enum('status_pembayaran', ['pending', 'approved', 'dibayar', 'cancelled'])->default('pending');
            $table->enum('metode_pembayaran', ['cash', 'transfer', 'check'])->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_karyawan')->references('id_karyawan')->on('karyawan')->onDelete('cascade');

            // Unique constraint for periode per karyawan
            $table->unique(['id_karyawan', 'periode_tahun', 'periode_bulan'], 'unique_karyawan_periode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gaji');
    }
};
