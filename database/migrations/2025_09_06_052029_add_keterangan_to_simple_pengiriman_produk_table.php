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
        Schema::table('simple_pengiriman_produk', function (Blueprint $table) {
            $table->text('keterangan')->nullable()->after('status');
            $table->timestamp('tanggal_diterima')->nullable()->after('keterangan');
            $table->timestamp('tanggal_ditolak')->nullable()->after('tanggal_diterima');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('simple_pengiriman_produk', function (Blueprint $table) {
            $table->dropColumn(['keterangan', 'tanggal_diterima', 'tanggal_ditolak']);
        });
    }
};
