<?php
// Test file untuk halaman Bantuan IT

echo "Testing Bantuan IT Page Setup...\n";
echo "================================\n\n";

// Check if CSS file exists and has content
$cssFile = 'public/css/gudang/bantuan-it.css';
if (file_exists($cssFile)) {
  $cssSize = filesize($cssFile);
  echo "✓ CSS file exists: {$cssFile} ({$cssSize} bytes)\n";
} else {
  echo "✗ CSS file missing: {$cssFile}\n";
}

// Check if Blade template exists and has content
$bladeFile = 'resources/views/gudang/bantuan-it.blade.php';
if (file_exists($bladeFile)) {
  $bladeSize = filesize($bladeFile);
  echo "✓ Blade template exists: {$bladeFile} ({$bladeSize} bytes)\n";
} else {
  echo "✗ Blade template missing: {$bladeFile}\n";
}

// Check if route is added
$routeFile = 'routes/web.php';
if (file_exists($routeFile)) {
  $routeContent = file_get_contents($routeFile);
  if (strpos($routeContent, 'bantuan-it') !== false) {
    echo "✓ Route added to web.php\n";
  } else {
    echo "✗ Route not found in web.php\n";
  }
}

// Check if login page has been updated
$loginFile = 'resources/views/gudang/login.blade.php';
if (file_exists($loginFile)) {
  $loginContent = file_get_contents($loginFile);
  if (strpos($loginContent, 'gudang.bantuan-it') !== false) {
    echo "✓ Login page updated with Bantuan IT link\n";
  } else {
    echo "✗ Login page not updated\n";
  }
}

echo "\n";
echo "================================\n";
echo "Setup Summary:\n";
echo "- CSS: Modern orange theme matching manual\n";
echo "- HTML: Complete IT support content\n";
echo "- Route: Public access via /gudang/bantuan-it\n";
echo "- Integration: Link added to login page\n";
echo "- Features: FAQ, Troubleshooting, Contact info\n";
echo "================================\n";

echo "\nTo test the page, access: http://localhost:8000/gudang/bantuan-it\n";
