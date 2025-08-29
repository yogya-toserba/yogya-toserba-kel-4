<?php

// Create admin table and seed admin users
echo "=== CREATING ADMIN TABLE AND SEEDING DATA ===\n";
echo "Adding admin table to database...\n\n";

$host = '127.0.0.1';
$port = '3306';
$database = 'db_yogya';
$username = 'root';
$password = '';

try {
  $pdo = new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  echo "Connected to database successfully!\n\n";

  // Create admin table
  echo "Creating admin table...\n";
  $sql = "
    CREATE TABLE IF NOT EXISTS admin (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        remember_token VARCHAR(100) NULL,
        created_at TIMESTAMP NULL,
        updated_at TIMESTAMP NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ";
  $pdo->exec($sql);
  echo "Admin table created successfully!\n";

  // Clear existing admin data
  echo "Clearing existing admin data...\n";
  $pdo->exec("DELETE FROM admin");

  // Seed admin users
  echo "Seeding admin users...\n";
  $adminData = [
    ['Super Admin', 'admin@admin.com', password_hash('admin123', PASSWORD_BCRYPT)],
    ['Admin Sistem', 'admin@yogyatoserba.com', password_hash('admin123', PASSWORD_BCRYPT)],
    ['Manager IT', 'manager@yogyatoserba.com', password_hash('manager123', PASSWORD_BCRYPT)],
    ['Administrator', 'administrator@yogyatoserba.com', password_hash('password123', PASSWORD_BCRYPT)]
  ];

  $stmt = $pdo->prepare("INSERT INTO admin (name, email, password, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())");
  foreach ($adminData as $data) {
    $stmt->execute($data);
  }
  echo "Admin users seeded successfully! (" . count($adminData) . " records)\n";

  // Verify data
  echo "\n=== VERIFICATION ===\n";
  $stmt = $pdo->query("SELECT id, name, email FROM admin ORDER BY id");
  $admins = $stmt->fetchAll();

  echo "Admin users in database:\n";
  foreach ($admins as $admin) {
    echo "- ID: {$admin['id']}, Name: {$admin['name']}, Email: {$admin['email']}\n";
  }

  // Test the specific query that was failing
  echo "\n=== TESTING FAILING QUERY ===\n";
  $stmt = $pdo->prepare("SELECT * FROM admin WHERE email = ? LIMIT 1");
  $stmt->execute(['admin@admin.com']);
  $result = $stmt->fetch();

  if ($result) {
    echo "✅ SUCCESS: Found admin with email 'admin@admin.com'\n";
    echo "   Name: {$result['name']}\n";
    echo "   ID: {$result['id']}\n";
  } else {
    echo "❌ ERROR: Could not find admin with email 'admin@admin.com'\n";
  }

  echo "\n=== ADMIN TABLE SETUP COMPLETED SUCCESSFULLY! ===\n";
  echo "Admin login should now work properly.\n";
  echo "\nAdmin Login Credentials:\n";
  echo "- Email: admin@admin.com\n";
  echo "- Password: admin123\n";
  echo "\nOther admin accounts:\n";
  echo "- admin@yogyatoserba.com / admin123\n";
  echo "- manager@yogyatoserba.com / manager123\n";
  echo "- administrator@yogyatoserba.com / password123\n";
} catch (PDOException $e) {
  echo "Database Error: " . $e->getMessage() . "\n";
} catch (Exception $e) {
  echo "Error: " . $e->getMessage() . "\n";
}
