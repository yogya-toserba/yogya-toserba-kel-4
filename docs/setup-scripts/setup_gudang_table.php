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

  // Check if gudang table exists
  $stmt = $pdo->query("SHOW TABLES LIKE 'gudang'");
  $tableExists = $stmt->rowCount() > 0;

  if (!$tableExists) {
    echo "Creating gudang table...\n";

    $createTable = "CREATE TABLE gudang (
            id_gudang VARCHAR(8) PRIMARY KEY,
            nama_gudang VARCHAR(100) NOT NULL,
            password VARCHAR(255) NOT NULL,
            lokasi VARCHAR(255) NOT NULL,
            status BOOLEAN DEFAULT 1,
            remember_token VARCHAR(100) NULL,
            created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";

    $pdo->exec($createTable);
    echo "Table gudang created successfully!\n";

    // Insert sample data
    echo "Inserting sample gudang data...\n";

    $insertData = "INSERT INTO gudang (id_gudang, nama_gudang, password, lokasi, status) VALUES
            ('GD001', 'Gudang Pusat Jakarta', ?, 'Jakarta Selatan', 1),
            ('GD002', 'Gudang Bandung', ?, 'Bandung', 1),
            ('GD003', 'Gudang Yogyakarta', ?, 'Yogyakarta', 1)";

    $stmt = $pdo->prepare($insertData);
    $hashedPassword = password_hash('gudang123', PASSWORD_DEFAULT);
    $stmt->execute([$hashedPassword, $hashedPassword, $hashedPassword]);

    echo "Sample gudang data inserted successfully!\n";
  } else {
    echo "Table gudang already exists.\n";
  }

  // Show table structure
  echo "\nTable structure:\n";
  $stmt = $pdo->query("DESCRIBE gudang");
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "  - {$row['Field']} ({$row['Type']})\n";
  }

  // Show records
  echo "\nRecords in gudang table:\n";
  $stmt = $pdo->query("SELECT * FROM gudang");
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "  - ID: {$row['id_gudang']}, Nama: {$row['nama_gudang']}, Lokasi: {$row['lokasi']}, Status: " . ($row['status'] ? 'Active' : 'Inactive') . "\n";
  }

  echo "\nGudang table setup completed!\n";
  echo "\nCredentials for testing:\n";
  echo "ID Gudang: GD001, GD002, or GD003\n";
  echo "Password: gudang123\n";
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage() . "\n";
}
