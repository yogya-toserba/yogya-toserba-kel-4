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
        Schema::create('gaji_otomatis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id')->constrained('karyawan')->onDelete('cascade');
            $table->foreignId('jabatan_id')->constrained('jabatan')->onDelete('cascade');
            $table->year('tahun');
            $table->tinyInteger('bulan'); // 1-12
            $table->decimal('gaji_pokok', 15, 2);
            $table->decimal('tunjangan', 15, 2)->default(0);
            $table->integer('hari_kerja_wajib')->default(22);
            $table->integer('hari_hadir')->default(0);
            $table->integer('hari_alpha')->default(0);
            $table->integer('hari_sakit')->default(0);
            $table->integer('hari_izin')->default(0);
            $table->decimal('jam_lembur', 8, 2)->default(0);
            $table->decimal('tarif_lembur_per_jam', 15, 2)->default(0);
            $table->decimal('bonus_kehadiran', 15, 2)->default(0);
            $table->decimal('potongan_alpha', 15, 2)->default(0);
            $table->decimal('potongan_telat', 15, 2)->default(0);
            $table->decimal('potongan_lain', 15, 2)->default(0);
            $table->text('keterangan_potongan')->nullable();
            $table->decimal('total_pendapatan', 15, 2)->default(0);
            $table->decimal('total_potongan', 15, 2)->default(0);
            $table->decimal('gaji_bersih', 15, 2)->default(0);
            $table->enum('status', ['draft', 'approved', 'paid'])->default('draft');
            $table->timestamp('tanggal_approve')->nullable();
            $table->timestamp('tanggal_bayar')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();

            // Index untuk query cepat
            $table->index(['karyawan_id', 'tahun', 'bulan']);
            $table->index(['status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gaji_otomatis');
    }
};
