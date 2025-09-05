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
        Schema::create('chat_rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemasok_id');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->string('gudang_id', 8)->nullable();
            $table->string('nama_room');
            $table->text('deskripsi')->nullable();
            $table->enum('status', ['aktif', 'non-aktif'])->default('aktif');
            $table->timestamp('last_message_at')->nullable();
            $table->timestamps();

            $table->foreign('pemasok_id')->references('id_pemasok')->on('pemasok')->onDelete('cascade');
            $table->foreign('admin_id')->references('id')->on('admin')->onDelete('set null');
            $table->foreign('gudang_id')->references('id_gudang')->on('gudang')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_rooms');
    }
};
