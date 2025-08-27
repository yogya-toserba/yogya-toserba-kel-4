<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('stok_gudang_pusat', function (Blueprint $table) {
            $table->integer('harga_beli')->nullable();
            $table->integer('harga_jual')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stok_gudang_pusat', function (Blueprint $table) {
            $table->dropColumn(['harga_beli', 'harga_jual']);
        });
    }
};
