<?php
// Script untuk membuat data shift yang diperlukan

// Database configuration
$host = '127.0.0.1';
$database = 'db_yogya';
$username = 'root';
$password = '';

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Fix Shift Data</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .success { color: green; }
        .error { color: red; }
        .info { color: blue; }
        pre { background: #f5f5f5; padding: 10px; border-radius: 5px; }
    </style>
</head>
<body>
    <h1>Fix Shift Data untuk Karyawan</h1>
    <pre>
<?php

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<span class='info'>Connected to database successfully</span>\n\n";
    
    // Check current shift data
    echo "=== Checking Current Shift Data ===\n";
    $stmt = $pdo->query("SELECT * FROM shift ORDER BY id_shift");
    $shifts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if ($shifts) {
        echo "<span class='success'>Found " . count($shifts) . " shift records:</span>\n";
        foreach ($shifts as $shift) {
            echo "  ID: {$shift['id_shift']} - {$shift['nama_shift']} ({$shift['jam_mulai']} - {$shift['jam_selesai']})\n";
        }
    } else {
        echo "<span class='error'>No shift data found!</span>\n";
        echo "<span class='info'>Creating default shift data...</span>\n";
        
        // Insert default shift data
        $pdo->exec("
            INSERT INTO shift (nama_shift, jam_mulai, jam_selesai, created_at, updated_at) VALUES
            ('Pagi', '08:00:00', '16:00:00', NOW(), NOW()),
            ('Siang', '12:00:00', '20:00:00', NOW(), NOW()),
            ('Malam', '20:00:00', '04:00:00', NOW(), NOW())
        ");
        
        echo "<span class='success'>✓ Default shift data created</span>\n";
        
        // Show the new data
        $stmt = $pdo->query("SELECT * FROM shift ORDER BY id_shift");
        $shifts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "\n<span class='success'>New shift data:</span>\n";
        foreach ($shifts as $shift) {
            echo "  ID: {$shift['id_shift']} - {$shift['nama_shift']} ({$shift['jam_mulai']} - {$shift['jam_selesai']})\n";
        }
    }
    
    echo "\n=== Testing Karyawan Insertion ===\n";
    
    // Test data
    $testData = [
        'nama' => 'Test Employee - ' . date('H:i:s'),
        'divisi' => 'IT',
        'alamat' => 'Test Address',
        'email' => 'test' . time() . '@example.com',
        'tanggal_lahir' => '1990-01-01',
        'nomer_telepon' => '08123456789',
        'id_shift' => 1
    ];
    
    // Insert test karyawan
    $stmt = $pdo->prepare("
        INSERT INTO karyawan (nama, divisi, alamat, email, tanggal_lahir, nomer_telepon, id_shift, created_at, updated_at) 
        VALUES (:nama, :divisi, :alamat, :email, :tanggal_lahir, :nomer_telepon, :id_shift, NOW(), NOW())
    ");
    
    $result = $stmt->execute($testData);
    
    if ($result) {
        $lastId = $pdo->lastInsertId();
        echo "<span class='success'>✓ Test karyawan insertion successful! New ID: $lastId</span>\n";
        
        // Clean up test data
        $pdo->exec("DELETE FROM karyawan WHERE id_karyawan = $lastId");
        echo "<span class='success'>✓ Test data cleaned up</span>\n";
    } else {
        echo "<span class='error'>✗ Test insertion failed</span>\n";
    }
    
    echo "\n=== Current Karyawan Data ===\n";
    $stmt = $pdo->query("SELECT k.*, s.nama_shift FROM karyawan k LEFT JOIN shift s ON k.id_shift = s.id_shift ORDER BY k.id_karyawan DESC LIMIT 5");
    $karyawans = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if ($karyawans) {
        echo "<span class='success'>Found " . count($karyawans) . " karyawan records:</span>\n";
        foreach ($karyawans as $k) {
            echo "  {$k['nama']} - {$k['divisi']} - Shift: {$k['nama_shift']}\n";
        }
    } else {
        echo "<span class='info'>No karyawan data found</span>\n";
    }
    
    echo "\n<span class='success'>=== Database is now ready for karyawan insertion! ===</span>\n";
    
} catch (PDOException $e) {
    echo "<span class='error'>Database error: " . htmlspecialchars($e->getMessage()) . "</span>\n";
} catch (Exception $e) {
    echo "<span class='error'>General error: " . htmlspecialchars($e->getMessage()) . "</span>\n";
}
?>
    </pre>
    
    <h2>Next Steps</h2>
    <p>Sekarang coba kembali ke form tambah karyawan dan input data lagi. Data shift sudah tersedia!</p>
    <a href="/yogya-toserba-kel-4/admin/tambah-karyawan" style="background: #f27061; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
        Kembali ke Form Tambah Karyawan
    </a>
</body>
</html>
