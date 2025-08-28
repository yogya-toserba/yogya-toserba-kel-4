<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // kalau pakai MySQL enum, bisa pakai raw query
        DB::statement("ALTER TABLE products MODIFY status ENUM('aktif', 'nonaktif', 'expire') NOT NULL DEFAULT 'aktif'");
    }

    public function down(): void
    {
        // kembalikan seperti semula (misalnya hanya aktif & expire)
        DB::statement("ALTER TABLE products MODIFY status ENUM('aktif', 'expire') NOT NULL DEFAULT 'aktif'");
    }
};
