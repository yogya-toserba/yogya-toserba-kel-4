<?php

// Setup database sederhana tanpa Laravel
try {
  echo "Creating SQLite database...\n";

  // Buat file database jika belum ada
  $dbPath = __DIR__ . '/database/database.sqlite';
  if (!file_exists($dbPath)) {
    touch($dbPath);
    echo "Database file created at: $dbPath\n";
  }

  // Coba koneksi menggunakan SQLite
  $pdo = new PDO('sqlite:' . $dbPath);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  echo "Connected to SQLite database successfully!\n";

  // Buat tabel sederhana untuk test
  $pdo->exec("CREATE TABLE IF NOT EXISTS test_table (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

  echo "Test table created successfully!\n";

  // Insert test data
  $stmt = $pdo->prepare("INSERT INTO test_table (name) VALUES (?)");
  $stmt->execute(['Test Record']);

  echo "Test data inserted successfully!\n";

  // Cek data
  $stmt = $pdo->query("SELECT * FROM test_table");
  $results = $stmt->fetchAll();
  echo "Data in test_table: " . count($results) . " records\n";

  foreach ($results as $row) {
    echo "- ID: {$row['id']}, Name: {$row['name']}, Created: {$row['created_at']}\n";
  }
} catch (PDOException $e) {
  echo "Database Error: " . $e->getMessage() . "\n";
} catch (Exception $e) {
  echo "Error: " . $e->getMessage() . "\n";
}
