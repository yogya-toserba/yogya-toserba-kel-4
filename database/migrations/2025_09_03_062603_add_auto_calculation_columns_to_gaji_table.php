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
            // Tambah kolom yang belum ada
            if (!Schema::hasColumn('gaji', 'total_hari_hadir')) {
                $table->integer('total_hari_hadir')->default(0)->after('id_karyawan');
            }
            if (!Schema::hasColumn('gaji', 'total_hari_kerja')) {
                $table->integer('total_hari_kerja')->default(22)->after('total_hari_hadir');
            }
            if (!Schema::hasColumn('gaji', 'periode_gaji')) {
                $table->date('periode_gaji')->nullable()->after('status');
            }
            if (!Schema::hasColumn('gaji', 'is_auto_generated')) {
                $table->boolean('is_auto_generated')->default(false)->after('periode_gaji');
            }
            if (!Schema::hasColumn('gaji', 'keterangan')) {
                $table->text('keterangan')->nullable()->after('is_auto_generated');
            }
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
                'periode_gaji',
                'is_auto_generated',
                'keterangan'
            ]);
        });
    }
};
