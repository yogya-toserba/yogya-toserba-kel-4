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
            // Add periode_gaji column if it doesn't exist
            if (!Schema::hasColumn('gaji', 'periode_gaji')) {
                $table->string('periode_gaji', 7)->nullable()->after('id_karyawan'); // Format: Y-m (2024-01)
            }

            // Add other missing columns if they don't exist
            if (!Schema::hasColumn('gaji', 'gaji_pokok')) {
                $table->decimal('gaji_pokok', 12, 2)->default(0)->after('periode_gaji');
            }

            if (!Schema::hasColumn('gaji', 'tunjangan')) {
                $table->decimal('tunjangan', 12, 2)->default(0)->after('gaji_pokok');
            }

            if (!Schema::hasColumn('gaji', 'bonus')) {
                $table->decimal('bonus', 12, 2)->default(0)->after('tunjangan');
            }

            if (!Schema::hasColumn('gaji', 'potongan')) {
                $table->decimal('potongan', 12, 2)->default(0)->after('bonus');
            }

            if (!Schema::hasColumn('gaji', 'status_pembayaran')) {
                $table->enum('status_pembayaran', ['pending', 'paid', 'cancelled'])->default('pending')->after('jumlah_gaji');
            }

            if (!Schema::hasColumn('gaji', 'keterangan')) {
                $table->text('keterangan')->nullable()->after('status_pembayaran');
            }

            if (!Schema::hasColumn('gaji', 'is_auto_generated')) {
                $table->boolean('is_auto_generated')->default(false)->after('keterangan');
            }
        });

        // Add indexes after columns are created
        Schema::table('gaji', function (Blueprint $table) {
            // Check if index doesn't exist before creating
            try {
                $table->index(['periode_gaji', 'id_karyawan'], 'gaji_periode_karyawan_index');
            } catch (Exception $e) {
                // Index might already exist, ignore
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gaji', function (Blueprint $table) {
            // Drop indexes first
            try {
                $table->dropIndex('gaji_periode_karyawan_index');
            } catch (Exception $e) {
                // Index might not exist, ignore
            }

            // Drop columns if they exist
            if (Schema::hasColumn('gaji', 'is_auto_generated')) {
                $table->dropColumn('is_auto_generated');
            }

            if (Schema::hasColumn('gaji', 'keterangan')) {
                $table->dropColumn('keterangan');
            }

            if (Schema::hasColumn('gaji', 'status_pembayaran')) {
                $table->dropColumn('status_pembayaran');
            }

            if (Schema::hasColumn('gaji', 'potongan')) {
                $table->dropColumn('potongan');
            }

            if (Schema::hasColumn('gaji', 'bonus')) {
                $table->dropColumn('bonus');
            }

            if (Schema::hasColumn('gaji', 'tunjangan')) {
                $table->dropColumn('tunjangan');
            }

            if (Schema::hasColumn('gaji', 'gaji_pokok')) {
                $table->dropColumn('gaji_pokok');
            }

            if (Schema::hasColumn('gaji', 'periode_gaji')) {
                $table->dropColumn('periode_gaji');
            }
        });
    }
};
