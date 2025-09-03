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
        Schema::create('jabatan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jabatan');
            $table->decimal('gaji_pokok', 12, 2); // Gaji pokok per jabatan
            $table->decimal('tunjangan_jabatan', 12, 2)->default(0); // Tunjangan jabatan
            $table->decimal('upah_lembur_per_jam', 12, 2)->default(0); // Upah lembur per jam
            $table->decimal('bonus_kehadiran_penuh', 12, 2)->default(0); // Bonus jika hadir penuh
            $table->integer('target_hari_kerja')->default(22); // Target hari kerja per bulan
            $table->text('deskripsi')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jabatan');
    }
};
