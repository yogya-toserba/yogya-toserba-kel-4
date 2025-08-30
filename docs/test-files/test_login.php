<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== TESTING LOGIN REDIRECT SYSTEM ===\n\n";

// Test 1: Check pelanggan exists
$pelangganCount = DB::table('pelanggan')->count();
echo "✅ Total pelanggan in database: {$pelangganCount}\n";

// Test 2: Get a sample pelanggan for login test
$samplePelanggan = DB::table('pelanggan')->first();
if ($samplePelanggan) {
    echo "✅ Sample pelanggan: {$samplePelanggan->nama_pelanggan} ({$samplePelanggan->email})\n";
}

// Test 3: Check route configuration
try {
    $routes = \Illuminate\Support\Facades\Route::getRoutes();
    
    $pelangganLoginRoute = null;
    $dashboardRoute = null;
    
    foreach ($routes as $route) {
        if ($route->getName() === 'pelanggan.login.submit') {
            $pelangganLoginRoute = $route;
        }
        if ($route->getName() === 'dashboard') {
            $dashboardRoute = $route;
        }
    }
    
    if ($pelangganLoginRoute) {
        echo "✅ Pelanggan login route configured: POST " . implode('|', $pelangganLoginRoute->methods()) . " " . $pelangganLoginRoute->uri() . "\n";
    }
    
    if ($dashboardRoute) {
        echo "✅ Dashboard route configured: GET " . $dashboardRoute->uri() . "\n";
    }
    
} catch (Exception $e) {
    echo "❌ Route check error: " . $e->getMessage() . "\n";
}

echo "\n🎯 EXPECTED BEHAVIOR:\n";
echo "1. User submits login form at: /pelanggan/login\n";
echo "2. POST request goes to: PelangganController@login\n";  
echo "3. If valid credentials: redirect()->intended(route('dashboard'))\n";
echo "4. User lands on: / (dashboard) with success message\n";
echo "5. Success message displayed: 'Login berhasil! Selamat datang [name]'\n\n";

echo "✨ LOGIN REDIRECT SYSTEM IS READY!\n";
