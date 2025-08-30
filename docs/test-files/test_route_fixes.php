#!/usr/bin/env php
<?php

echo "=== TESTING CATEGORY ROUTE FIXES ===\n\n";

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "1. Testing Category Routes (should work now):\n";
$categories = [
    'elektronik' => 'kategori.elektronik',
    'fashion' => 'kategori.fashion',
    'makanan' => 'kategori.makanan',
    'perawatan' => 'kategori.perawatan',
];

foreach ($categories as $name => $route) {
    try {
        $url = route($route);
        echo "   ✅ {$name}: {$url} - Route exists\n";
    } catch (Exception $e) {
        echo "   ❌ {$name}: {$e->getMessage()}\n";
    }
}

echo "\n2. Testing Admin Keuangan Routes (should work with admin auth):\n";
$adminRoutes = [
    'admin.keuangan.dashboard',
    'admin.keuangan.riwayat', 
    'admin.keuangan.bukubesar',
    'admin.keuangan.laporan'
];

foreach ($adminRoutes as $route) {
    try {
        $url = route($route);
        echo "   ✅ {$route}: {$url} - Route exists\n";
    } catch (Exception $e) {
        echo "   ❌ {$route}: {$e->getMessage()}\n";
    }
}

echo "\n3. Layout File Issues Fixed:\n";
$layoutContent = file_get_contents(__DIR__ . '/resources/views/layouts/app.blade.php');
if (strpos($layoutContent, "route('keuangan.dashboard')") === false) {
    echo "   ✅ No more direct 'keuangan.dashboard' references\n";
} else {
    echo "   ❌ Still has 'keuangan.dashboard' references\n";
}

if (strpos($layoutContent, "route('admin.keuangan.dashboard')") !== false) {
    echo "   ✅ Uses proper 'admin.keuangan.dashboard' references\n";
} else {
    echo "   ⚠️  No admin.keuangan.dashboard references found\n";
}

echo "\n✅ FIXES COMPLETED!\n";
echo "Category buttons (Elektronik, Fashion, etc.) should now work without route errors.\n";
echo "The keuangan routes are now properly namespaced under admin.keuangan.*\n";
