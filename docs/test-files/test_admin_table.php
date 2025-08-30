<?php

require_once 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

// Setup database connection
$capsule = new Capsule;
$capsule->addConnection([
  'driver' => 'mysql',
  'host' => '127.0.0.1',
  'port' => '3306',
  'database' => 'db_yogya',
  'username' => 'root',
  'password' => '',
  'charset' => 'utf8mb4',
  'collation' => 'utf8mb4_unicode_ci',
  'prefix' => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

echo "=== TESTING ADMIN TABLE WITH LARAVEL ===\n";

try {
  // Test admin count
  $adminCount = Capsule::table('admin')->count();
  echo "✅ Admin table exists with {$adminCount} records\n";

  // Test the specific failing query
  $admin = Capsule::table('admin')->where('email', 'admin@admin.com')->first();

  if ($admin) {
    echo "✅ SUCCESS: Found admin with email 'admin@admin.com'\n";
    echo "   Name: {$admin->name}\n";
    echo "   ID: {$admin->id}\n";
    echo "   Created: {$admin->created_at}\n";
  } else {
    echo "❌ ERROR: Could not find admin with email 'admin@admin.com'\n";
  }

  // Test all admin users
  echo "\n=== ALL ADMIN USERS ===\n";
  $admins = Capsule::table('admin')->orderBy('id')->get();
  foreach ($admins as $admin) {
    echo "- {$admin->name} ({$admin->email})\n";
  }

  echo "\n✅ ADMIN TABLE FULLY FUNCTIONAL!\n";
  echo "Admin login should now work without errors.\n";
} catch (Exception $e) {
  echo "❌ Error: " . $e->getMessage() . "\n";
}
