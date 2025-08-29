<?php
$pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=db_yogya', 'root', '');

// Add missing migration records
$migrations = [
  '2025_08_08_001913_create_transaksi',
  '2025_08_08_001946_create_detail_transaksi'
];

$stmt = $pdo->prepare('INSERT IGNORE INTO migrations (migration, batch) VALUES (?, 1)');
foreach ($migrations as $migration) {
  $stmt->execute([$migration]);
}

echo 'Migration records updated successfully!';
