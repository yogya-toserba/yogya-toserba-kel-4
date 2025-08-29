<?php

// Check current transaksi table structure
echo "=== CHECKING TRANSAKSI TABLE STRUCTURE ===\n";

$host = '127.0.0.1';
$port = '3306';
$database = 'db_yogya';
$username = 'root';
$password = '';

try {
  $pdo = new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  echo "Connected to database successfully!\n\n";

  // Show table structure
  echo "Current transaksi table structure:\n";
  $stmt = $pdo->query("DESCRIBE transaksi");
  $columns = $stmt->fetchAll();

  foreach ($columns as $column) {
    echo "- {$column['Field']} ({$column['Type']}) - {$column['Null']} - {$column['Key']}\n";
  }

  // Check if tanggal_transaksi column exists
  echo "\n=== CHECKING FOR SPECIFIC COLUMNS ===\n";
  $columnExists = false;
  foreach ($columns as $column) {
    if ($column['Field'] === 'tanggal_transaksi') {
      $columnExists = true;
      break;
    }
  }

  if ($columnExists) {
    echo "✅ Column 'tanggal_transaksi' EXISTS\n";
  } else {
    echo "❌ Column 'tanggal_transaksi' NOT FOUND\n";
    echo "Available date-related columns:\n";
    foreach ($columns as $column) {
      if (strpos($column['Field'], 'tanggal') !== false || strpos($column['Type'], 'date') !== false) {
        echo "- {$column['Field']} ({$column['Type']})\n";
      }
    }
  }

  // Show sample data
  echo "\n=== SAMPLE DATA ===\n";
  $stmt = $pdo->query("SELECT * FROM transaksi LIMIT 3");
  $data = $stmt->fetchAll();

  if ($data) {
    $firstRow = $data[0];
    echo "Sample record columns:\n";
    foreach ($firstRow as $key => $value) {
      if (!is_numeric($key)) {
        echo "- {$key}: {$value}\n";
      }
    }
  } else {
    echo "No data in transaksi table\n";
  }
} catch (PDOException $e) {
  echo "Database Error: " . $e->getMessage() . "\n";
} catch (Exception $e) {
  echo "Error: " . $e->getMessage() . "\n";
}
