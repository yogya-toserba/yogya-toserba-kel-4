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
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->decimal('original_price', 10, 2)->nullable();
            $table->integer('discount_percentage')->nullable();
            $table->string('image');
            $table->json('gallery')->nullable(); // Array of image URLs
            $table->string('category');
            $table->string('subcategory')->nullable();
            $table->decimal('rating', 2, 1)->default(4.5);
            $table->integer('reviews_count')->default(0);
            $table->integer('stock')->default(0);
            $table->json('sizes')->nullable(); // Array of available sizes
            $table->json('colors')->nullable(); // Array of available colors
            $table->json('features')->nullable(); // Array of product features
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};