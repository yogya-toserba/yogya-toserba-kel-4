<?php
// Simple test to access gudang dashboard
require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Auth;

try {
  echo "Testing Route Resolution...\n\n";

  // Test if all gudang routes are properly defined
  $routes = [
    'gudang.login' => 'Login route',
    'gudang.dashboard' => 'Dashboard route',
    'gudang.logout' => 'Logout route',
    'gudang.permintaan' => 'Permintaan route',
    'gudang.stok' => 'Stok route'
  ];

  foreach ($routes as $routeName => $description) {
    try {
      $url = route($routeName);
      echo "✓ $description: $url\n";
    } catch (Exception $e) {
      echo "✗ $description: ERROR - " . $e->getMessage() . "\n";
    }
  }

  echo "\n=== Route test completed ===\n";

  // Test authentication flow
  echo "\nTesting Authentication Flow...\n";

  // Simulate login
  $credentials = [
    'id_gudang' => 'GD006',
    'password' => 'gudang123'
  ];

  if (Auth::guard('gudang')->attempt($credentials)) {
    echo "✓ Authentication successful\n";

    $user = Auth::guard('gudang')->user();
    echo "  - Logged in as: {$user->nama_gudang}\n";
    echo "  - Guard: gudang\n";
    echo "  - User ID: {$user->id}\n";
    echo "  - Gudang ID: {$user->id_gudang}\n";

    // Test if user is authenticated
    if (Auth::guard('gudang')->check()) {
      echo "✓ User is authenticated\n";
    } else {
      echo "✗ User authentication check failed\n";
    }

    Auth::guard('gudang')->logout();
    echo "✓ Logged out successfully\n";
  } else {
    echo "✗ Authentication failed\n";
  }

  echo "\n=== Authentication test completed ===\n";
} catch (Exception $e) {
  echo "Error: " . $e->getMessage() . "\n";
}
