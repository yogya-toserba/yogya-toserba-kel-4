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
        Schema::table('gaji', function (Blueprint $table) {
            // Kolom untuk perhitungan otomatis
            $table->integer('total_hari_hadir')->default(0)->after('id_karyawan');
            $table->integer('total_hari_kerja')->default(22)->after('total_hari_hadir');
            $table->decimal('gaji_pokok', 15, 2)->default(0)->after('total_hari_kerja');
            $table->decimal('tunjangan_jabatan', 15, 2)->default(0)->after('gaji_pokok');
            $table->decimal('bonus_kehadiran', 15, 2)->default(0)->after('tunjangan_jabatan');
            $table->decimal('potongan_absen', 15, 2)->default(0)->after('bonus_kehadiran');
            $table->decimal('lembur', 15, 2)->default(0)->after('potongan_absen');
            $table->decimal('total_gaji', 15, 2)->default(0)->after('lembur');
            $table->enum('status', ['pending', 'approved', 'paid'])->default('pending')->after('total_gaji');
            $table->date('periode_gaji')->after('status');
            $table->boolean('is_auto_generated')->default(true)->after('periode_gaji');
            $table->text('keterangan')->nullable()->after('is_auto_generated');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gaji', function (Blueprint $table) {
            $table->dropColumn([
                'total_hari_hadir',
                'total_hari_kerja',
                'gaji_pokok',
                'tunjangan_jabatan',
                'bonus_kehadiran',
                'potongan_absen',
                'lembur',
                'total_gaji',
                'status',
                'periode_gaji',
                'is_auto_generated',
                'keterangan'
            ]);
        });
    }
};
