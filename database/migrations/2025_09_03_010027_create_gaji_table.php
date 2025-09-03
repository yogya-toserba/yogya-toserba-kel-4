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
            $table->id();
            $table->foreignId('karyawan_id')->constrained('karyawan')->onDelete('cascade');
            $table->string('periode'); // Format: YYYY-MM (contoh: 2025-09)
            $table->integer('hari_kerja_normal'); // Hari kerja normal dalam bulan
            $table->integer('hari_hadir'); // Hari kehadiran aktual
            $table->integer('jam_lembur')->default(0); // Jam lembur
            $table->decimal('gaji_pokok', 12, 2); // Gaji pokok berdasarkan jabatan
            $table->decimal('tunjangan', 12, 2)->default(0); // Tunjangan tambahan
            $table->decimal('bonus_kehadiran', 12, 2)->default(0); // Bonus kehadiran penuh
            $table->decimal('upah_lembur', 12, 2)->default(0); // Upah lembur
            $table->decimal('potongan_absen', 12, 2)->default(0); // Potongan karena absen
            $table->decimal('potongan_lain', 12, 2)->default(0); // Potongan lain-lain
            $table->decimal('total_gaji', 12, 2); // Total gaji bersih
            $table->enum('status', ['draft', 'approved', 'paid'])->default('draft');
            $table->date('tanggal_pembayaran')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            // Index untuk optimasi query
            $table->index(['karyawan_id', 'periode']);
            $table->unique(['karyawan_id', 'periode']); // Tidak boleh duplikat gaji per periode
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
