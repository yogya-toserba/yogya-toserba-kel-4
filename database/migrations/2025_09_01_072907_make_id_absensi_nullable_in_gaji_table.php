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
            // Drop foreign key constraint first
            $table->dropForeign(['id_absensi']);

            // Modify column to be nullable
            $table->unsignedBigInteger('id_absensi')->nullable()->change();

            // Re-add foreign key constraint with nullable option
            $table->foreign('id_absensi')->references('id_absensi')->on('absensi')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gaji', function (Blueprint $table) {
            // Drop foreign key constraint
            $table->dropForeign(['id_absensi']);

            // Modify column back to not nullable
            $table->unsignedBigInteger('id_absensi')->nullable(false)->change();

            // Re-add original foreign key constraint
            $table->foreign('id_absensi')->references('id_absensi')->on('absensi')->onDelete('cascade');
        });
    }
};
