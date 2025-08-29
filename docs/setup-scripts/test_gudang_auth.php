<?php
require 'vendor/autoload.php';

// Create Laravel app instance
$app = require_once 'bootstrap/app.php';

// Boot the application
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

try {
  echo "Testing Gudang Authentication...\n\n";

  // Test 1: Check if model can be loaded
  echo "1. Testing model loading...\n";
  $gudang = App\Models\Gudang::first();
  if ($gudang) {
    echo "✓ Model loaded successfully\n";
    echo "  - Found gudang: {$gudang->nama_gudang} (ID: {$gudang->id_gudang})\n";
  } else {
    echo "✗ No gudang records found\n";
  }

  // Test 2: Test authentication attempt
  echo "\n2. Testing authentication...\n";

  $credentials = [
    'id_gudang' => 'GD006',
    'password' => 'gudang123'
  ];

  if (Auth::guard('gudang')->attempt($credentials)) {
    echo "✓ Authentication successful!\n";
    $authenticatedGudang = Auth::guard('gudang')->user();
    echo "  - Logged in as: {$authenticatedGudang->nama_gudang}\n";
    echo "  - Location: {$authenticatedGudang->lokasi}\n";

    // Logout
    Auth::guard('gudang')->logout();
    echo "  - Logged out successfully\n";
  } else {
    echo "✗ Authentication failed\n";
    echo "  - Credentials: " . json_encode($credentials) . "\n";

    // Debug: Check if user exists
    $user = App\Models\Gudang::where('id_gudang', 'GD006')->first();
    if ($user) {
      echo "  - User exists in database\n";
      echo "  - Stored password hash: " . substr($user->password, 0, 10) . "...\n";

      // Test password verification
      if (Hash::check('gudang123', $user->password)) {
        echo "  - Password verification: ✓ PASS\n";
      } else {
        echo "  - Password verification: ✗ FAIL\n";
      }
    } else {
      echo "  - User NOT found in database\n";
    }
  }

  // Test 3: Check routes
  echo "\n3. Testing routes...\n";
  try {
    $loginRoute = route('gudang.login');
    echo "✓ Login route exists: $loginRoute\n";

    $dashboardRoute = route('gudang.dashboard');
    echo "✓ Dashboard route exists: $dashboardRoute\n";

    $logoutRoute = route('gudang.logout');
    echo "✓ Logout route exists: $logoutRoute\n";
  } catch (Exception $e) {
    echo "✗ Route error: " . $e->getMessage() . "\n";
  }

  echo "\n=== Test completed ===\n";
} catch (Exception $e) {
  echo "Error: " . $e->getMessage() . "\n";
  echo "Stack trace: " . $e->getTraceAsString() . "\n";
}
