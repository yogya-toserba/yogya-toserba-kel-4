<?php

require_once 'vendor/autoload.php';

// Load Laravel app
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    // Clear all karyawan data
    DB::table('karyawan')->delete();

    echo "✅ Semua data karyawan berhasil dihapus!\n";
    echo "Sekarang bisa input karyawan baru manual melalui form.\n";
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
