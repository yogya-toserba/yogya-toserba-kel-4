<?php
// Debug script to check database connectivity and create tables if needed

// Database configuration from .env
$host = '127.0.0.1';
$database = 'db_yogya';
$username = 'root';
$password = '';

// Set content type to HTML for browser display
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Database Debug</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .success { color: green; }
        .error { color: red; }
        .info { color: blue; }
        pre { background: #f5f5f5; padding: 10px; border-radius: 5px; }
    </style>
</head>
<body>
    <h1>Database Debug Script</h1>
    <pre>
<?php

echo "=== Database Debug Script ===\n";

try {
    // Create database connection
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<span class='success'>✓ Connected to MySQL server</span>\n";
    
    // Check if database exists
    $stmt = $pdo->query("SHOW DATABASES LIKE '$database'");
    if ($stmt->rowCount() > 0) {
        echo "<span class='success'>✓ Database '$database' exists</span>\n";
    } else {
        echo "<span class='error'>✗ Database '$database' does NOT exist</span>\n";
        echo "<span class='info'>Creating database...</span>\n";
        $pdo->exec("CREATE DATABASE `$database`");
        echo "<span class='success'>✓ Database '$database' created</span>\n";
    }
    
    // Connect to the specific database
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if shift table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'shift'");
    if ($stmt->rowCount() > 0) {
        echo "<span class='success'>✓ Table 'shift' exists</span>\n";
    } else {
        echo "<span class='error'>✗ Table 'shift' does NOT exist</span>\n";
        echo "<span class='info'>Creating shift table...</span>\n";
        $pdo->exec("
            CREATE TABLE `shift` (
                `id_shift` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                `nama_shift` varchar(255) NOT NULL,
                `jam_mulai` time NOT NULL,
                `jam_selesai` time NOT NULL,
                `created_at` timestamp NULL DEFAULT NULL,
                `updated_at` timestamp NULL DEFAULT NULL,
                PRIMARY KEY (`id_shift`)
            )
        ");
        
        // Insert sample shift data
        $pdo->exec("
            INSERT INTO `shift` (`nama_shift`, `jam_mulai`, `jam_selesai`) VALUES
            ('Pagi', '08:00:00', '16:00:00'),
            ('Siang', '12:00:00', '20:00:00'),
            ('Malam', '20:00:00', '04:00:00')
        ");
        
        echo "<span class='success'>✓ Table 'shift' created with sample data</span>\n";
    }
    
    // Check if karyawan table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'karyawan'");
    if ($stmt->rowCount() > 0) {
        echo "<span class='success'>✓ Table 'karyawan' exists</span>\n";
    } else {
        echo "<span class='error'>✗ Table 'karyawan' does NOT exist</span>\n";
        echo "<span class='info'>Creating karyawan table...</span>\n";
        $pdo->exec("
            CREATE TABLE `karyawan` (
                `id_karyawan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                `nama` varchar(255) NOT NULL,
                `divisi` varchar(255) NOT NULL,
                `alamat` varchar(500) NOT NULL,
                `email` varchar(255) NOT NULL,
                `tanggal_lahir` date NOT NULL,
                `nomer_telepon` varchar(20) NOT NULL,
                `id_shift` bigint(20) UNSIGNED NOT NULL,
                `created_at` timestamp NULL DEFAULT NULL,
                `updated_at` timestamp NULL DEFAULT NULL,
                PRIMARY KEY (`id_karyawan`),
                UNIQUE KEY `karyawan_email_unique` (`email`),
                KEY `karyawan_id_shift_foreign` (`id_shift`),
                CONSTRAINT `karyawan_id_shift_foreign` FOREIGN KEY (`id_shift`) REFERENCES `shift` (`id_shift`) ON DELETE CASCADE
            )
        ");
        echo "<span class='success'>✓ Table 'karyawan' created</span>\n";
    }
    
    // Test insert into karyawan table
    echo "\n=== Testing Data Insertion ===\n";
    $testData = [
        'nama' => 'Test Employee',
        'divisi' => 'IT',
        'alamat' => 'Test Address',
        'email' => 'test@example.com',
        'tanggal_lahir' => '1990-01-01',
        'nomer_telepon' => '08123456789',
        'id_shift' => 1
    ];
    
    // First, delete any existing test data
    $pdo->exec("DELETE FROM karyawan WHERE email = 'test@example.com'");
    
    $stmt = $pdo->prepare("
        INSERT INTO karyawan (nama, divisi, alamat, email, tanggal_lahir, nomer_telepon, id_shift, created_at, updated_at) 
        VALUES (:nama, :divisi, :alamat, :email, :tanggal_lahir, :nomer_telepon, :id_shift, NOW(), NOW())
    ");
    
    $result = $stmt->execute($testData);
    
    if ($result) {
        $lastId = $pdo->lastInsertId();
        echo "<span class='success'>✓ Test insertion successful! New ID: $lastId</span>\n";
        
        // Verify the data was inserted
        $stmt = $pdo->prepare("SELECT * FROM karyawan WHERE id_karyawan = ?");
        $stmt->execute([$lastId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            echo "<span class='success'>✓ Data verification successful:</span>\n";
            echo "  - Name: {$row['nama']}\n";
            echo "  - Division: {$row['divisi']}\n";
            echo "  - Email: {$row['email']}\n";
        }
        
        // Clean up test data
        $pdo->exec("DELETE FROM karyawan WHERE id_karyawan = $lastId");
        echo "<span class='success'>✓ Test data cleaned up</span>\n";
    } else {
        echo "<span class='error'>✗ Test insertion failed</span>\n";
    }
    
    echo "\n=== Database Check Complete ===\n";
    
} catch (PDOException $e) {
    echo "<span class='error'>✗ Database error: " . htmlspecialchars($e->getMessage()) . "</span>\n";
    echo "<span class='error'>Error Code: " . $e->getCode() . "</span>\n";
} catch (Exception $e) {
    echo "<span class='error'>✗ General error: " . htmlspecialchars($e->getMessage()) . "</span>\n";
}
?>
    </pre>
</body>
</html>
