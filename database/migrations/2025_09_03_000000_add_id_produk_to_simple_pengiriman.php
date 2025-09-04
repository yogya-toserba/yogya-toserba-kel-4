<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::table('simple_pengiriman_produk', function (Blueprint $table) {
      $table->unsignedBigInteger('id_produk')->nullable()->after('id');
    });
  }

  public function down(): void
  {
    Schema::table('simple_pengiriman_produk', function (Blueprint $table) {
      $table->dropColumn('id_produk');
    });
  }
};
