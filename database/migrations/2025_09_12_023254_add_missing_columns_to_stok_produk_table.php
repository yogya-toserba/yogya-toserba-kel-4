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
        Schema::table('stok_produk', function (Blueprint $table) {
            $table->string('sku')->unique()->after('nama_barang');
            $table->decimal('harga_beli', 15, 2)->after('jumlah_barang');
            $table->text('deskripsi')->nullable()->after('stok');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stok_produk', function (Blueprint $table) {
            $table->dropColumn(['sku', 'harga_beli', 'deskripsi']);
        });
    }
};
