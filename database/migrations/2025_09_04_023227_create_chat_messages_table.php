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
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chat_room_id');
            $table->string('sender_type'); // 'pemasok', 'admin', 'gudang'
            $table->unsignedBigInteger('sender_id');
            $table->text('message');
            $table->enum('message_type', ['text', 'image', 'file', 'product_request'])->default('text');
            $table->json('attachments')->nullable(); // untuk file/gambar
            $table->json('product_data')->nullable(); // untuk request produk
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->foreign('chat_room_id')->references('id')->on('chat_rooms')->onDelete('cascade');
            $table->index(['chat_room_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_messages');
    }
};
