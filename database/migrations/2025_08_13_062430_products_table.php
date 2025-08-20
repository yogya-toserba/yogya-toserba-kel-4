<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('image')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('sku')->unique();
            $table->integer('unit');
            $table->decimal('harga_beli', 10, 2);
            $table->decimal('harga_jual', 10, 2);
            $table->enum('status', ['aktif', 'expire']);
            $table->date('tanggal');
            $table->timestamps();
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
