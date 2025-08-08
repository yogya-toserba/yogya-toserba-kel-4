<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('gaji', function (Blueprint $table) {
            $table->id('id_gaji');
            $table->foreignId('id_karyawan')->constrained('karyawan')->onDelete('cascade');
            $table->foreignId('id_absensi')->nullable()->constrained('absensi')->onDelete('set null');
            $table->decimal('jumlah_gaji', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gaji');
    }
};
