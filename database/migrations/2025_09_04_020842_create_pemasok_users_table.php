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
        Schema::create('pemasok_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemasok_id');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('nama_lengkap');
            $table->string('telepon')->nullable();
            $table->enum('status', ['aktif', 'non-aktif'])->default('aktif');
            $table->timestamp('last_login')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('pemasok_id')->references('id_pemasok')->on('pemasok')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemasok_users');
    }
};
