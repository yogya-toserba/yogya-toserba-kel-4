<?php
// Database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'db_yogya';

try {
  $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8mb4", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  echo "Connected to database successfully!\n";

  // Check current table structure
  echo "Current gudang table structure:\n";
  $stmt = $pdo->query("DESCRIBE gudang");
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "  - {$row['Field']} ({$row['Type']})\n";
  }

  // Check if the table has the required columns for authentication
  $stmt = $pdo->query("SHOW COLUMNS FROM gudang LIKE 'id_gudang'");
  $hasIdGudang = $stmt->rowCount() > 0;

  $stmt = $pdo->query("SHOW COLUMNS FROM gudang LIKE 'password'");
  $hasPassword = $stmt->rowCount() > 0;

  if (!$hasIdGudang || !$hasPassword) {
    echo "\nTable structure needs to be updated for authentication!\n";
    echo "Updating gudang table structure...\n";

    // Add id_gudang column if not exists
    if (!$hasIdGudang) {
      $pdo->exec("ALTER TABLE gudang ADD COLUMN id_gudang VARCHAR(8) UNIQUE AFTER id");
      echo "Added id_gudang column\n";
    }

    // Add password column if not exists
    if (!$hasPassword) {
      $pdo->exec("ALTER TABLE gudang ADD COLUMN password VARCHAR(255) AFTER id_gudang");
      echo "Added password column\n";
    }

    // Add remember_token if not exists
    $stmt = $pdo->query("SHOW COLUMNS FROM gudang LIKE 'remember_token'");
    if ($stmt->rowCount() == 0) {
      $pdo->exec("ALTER TABLE gudang ADD COLUMN remember_token VARCHAR(100) NULL");
      echo "Added remember_token column\n";
    }

    // Update existing records with id_gudang and password
    echo "Updating existing records with authentication data...\n";

    $stmt = $pdo->query("SELECT id, nama_gudang FROM gudang WHERE id_gudang IS NULL");
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($records as $index => $record) {
      $gudangId = 'GD' . str_pad($record['id'], 3, '0', STR_PAD_LEFT);
      $hashedPassword = password_hash('gudang123', PASSWORD_DEFAULT);

      $updateStmt = $pdo->prepare("UPDATE gudang SET id_gudang = ?, password = ? WHERE id = ?");
      $updateStmt->execute([$gudangId, $hashedPassword, $record['id']]);

      echo "  - Updated {$record['nama_gudang']} with ID: $gudangId\n";
    }

    echo "Table structure updated successfully!\n";
  } else {
    echo "\nTable already has required columns for authentication.\n";
  }

  // Show final table structure
  echo "\nFinal table structure:\n";
  $stmt = $pdo->query("DESCRIBE gudang");
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "  - {$row['Field']} ({$row['Type']})\n";
  }

  // Show records with authentication data
  echo "\nRecords with authentication data:\n";
  $stmt = $pdo->query("SELECT id_gudang, nama_gudang, lokasi FROM gudang WHERE id_gudang IS NOT NULL");
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "  - ID: {$row['id_gudang']}, Nama: {$row['nama_gudang']}, Lokasi: {$row['lokasi']}\n";
  }

  echo "\nAuthentication setup completed!\n";
  echo "\nCredentials for testing:\n";
  echo "Use any ID from above (e.g., GD001, GD002, etc.)\n";
  echo "Password: gudang123\n";
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage() . "\n";
}
