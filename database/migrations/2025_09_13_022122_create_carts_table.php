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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pelanggan')->nullable(); // Allow guest carts
            $table->string('session_id')->nullable(); // For guest users
            $table->unsignedBigInteger('id_produk');
            $table->integer('quantity')->default(1);
            $table->decimal('price', 15, 2); // Store price at time of adding to cart
            $table->json('product_options')->nullable(); // Store color, size etc
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan')->onDelete('cascade');
            $table->foreign('id_produk')->references('id_produk')->on('stok_produk')->onDelete('cascade');
            
            // Index for performance
            $table->index(['id_pelanggan', 'session_id']);
            $table->index('id_produk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
