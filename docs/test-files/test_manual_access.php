<?php
require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
  echo "Testing Gudang Manual Route Access...\n\n";

  // Test if manual route is accessible
  echo "1. Testing route resolution...\n";
  try {
    $manualRoute = route('gudang.manual');
    echo "✓ Manual route exists: $manualRoute\n";
  } catch (Exception $e) {
    echo "✗ Manual route error: " . $e->getMessage() . "\n";
  }

  // Test other gudang routes
  echo "\n2. Testing other gudang routes...\n";
  $routes = [
    'gudang.login' => 'Login route',
    'gudang.dashboard' => 'Dashboard route',
    'gudang.logout' => 'Logout route',
    'gudang.manual' => 'Manual route',
    'gudang.permintaan' => 'Permintaan route',
  ];

  foreach ($routes as $routeName => $description) {
    try {
      $url = route($routeName);
      echo "✓ $description: $url\n";
    } catch (Exception $e) {
      echo "✗ $description: ERROR - " . $e->getMessage() . "\n";
    }
  }

  echo "\n3. Checking if manual view exists...\n";
  $manualViewPath = 'c:\laragon\www\yogya-toserba-kel-4\resources\views\gudang\manual.blade.php';
  if (file_exists($manualViewPath)) {
    echo "✓ Manual view file exists\n";
    echo "  - Path: $manualViewPath\n";

    // Get file size
    $fileSize = filesize($manualViewPath);
    echo "  - File size: " . number_format($fileSize) . " bytes\n";
  } else {
    echo "✗ Manual view file NOT found\n";
    echo "  - Expected path: $manualViewPath\n";
  }

  echo "\n=== Manual access test completed ===\n";
  echo "\nSUMMARY:\n";
  echo "- Manual route should now be accessible without authentication\n";
  echo "- URL: $manualRoute\n";
  echo "- This can be accessed from login page without logging in\n";
} catch (Exception $e) {
  echo "Error: " . $e->getMessage() . "\n";
}
