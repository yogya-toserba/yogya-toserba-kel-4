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
        Schema::table('absensi', function (Blueprint $table) {
            $table->time('jam_masuk')->nullable()->after('tanggal');
            $table->time('jam_keluar')->nullable()->after('jam_masuk');
            $table->integer('terlambat_menit')->default(0)->after('jam_keluar');
            $table->integer('pulang_awal_menit')->default(0)->after('terlambat_menit');
            $table->decimal('durasi_kerja_jam', 5, 2)->default(0)->after('pulang_awal_menit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('absensi', function (Blueprint $table) {
            $table->dropColumn(['jam_masuk', 'jam_keluar', 'terlambat_menit', 'pulang_awal_menit', 'durasi_kerja_jam']);
        });
    }
};
