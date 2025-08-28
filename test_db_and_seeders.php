<?php

echo "Testing database and seeders...\n";

// Test direct connection
try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=db_yogya', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✅ Database connection successful\n";
    
    // Check table counts
    $tables = ['pelanggan', 'cabang', 'stok_produk', 'transaksi', 'detail_transaksi', 'kas'];
    
    foreach ($tables as $table) {
        try {
            $stmt = $pdo->query("SELECT COUNT(*) FROM {$table}");
            $count = $stmt->fetchColumn();
            echo "{$table}: {$count} rows\n";
        } catch (Exception $e) {
            echo "{$table}: ERROR - {$e->getMessage()}\n";
        }
    }
    
    // If transaksi is empty, show some sample data to insert
    $stmt = $pdo->query("SELECT COUNT(*) FROM transaksi");
    $transaksiCount = $stmt->fetchColumn();
    
    if ($transaksiCount == 0) {
        echo "\n🔄 Transaksi table is empty. Will insert test data...\n";
        
        // Check if required data exists
        $stmt = $pdo->query("SELECT COUNT(*) FROM pelanggan");
        $pelangganCount = $stmt->fetchColumn();
        
        $stmt = $pdo->query("SELECT COUNT(*) FROM stok_produk");
        $produkCount = $stmt->fetchColumn();
        
        if ($pelangganCount > 0 && $produkCount > 0) {
            echo "Required data exists. Can proceed with transaction seeding.\n";
            
            // Insert a test transaction
            $stmt = $pdo->prepare("
                INSERT INTO transaksi (id_pelanggan, tanggal_transaksi, total_belanja, id_cabang, poin_yang_didapatkan, poin_yang_digunakan, id_kas, created_at, updated_at)
                VALUES (1, '2025-01-15', 150000, 1, 15, 0, 1, NOW(), NOW())
            ");
            
            if ($stmt->execute()) {
                $transaksiId = $pdo->lastInsertId();
                echo "✅ Test transaksi inserted with ID: {$transaksiId}\n";
                
                // Insert test detail
                $stmt = $pdo->prepare("
                    INSERT INTO detail_transaksi (id_transaksi, id_produk, nama_barang, jumlah_barang, total_harga, created_at, updated_at)
                    VALUES (?, 1, 'Test Product', 2, 150000, NOW(), NOW())
                ");
                
                if ($stmt->execute([$transaksiId])) {
                    echo "✅ Test detail transaksi inserted\n";
                } else {
                    echo "❌ Failed to insert detail transaksi\n";
                }
            } else {
                echo "❌ Failed to insert test transaksi\n";
            }
        } else {
            echo "❌ Missing required data: pelanggan={$pelangganCount}, produk={$produkCount}\n";
        }
    } else {
        echo "✅ Transaksi table already has {$transaksiCount} records\n";
    }
    
} catch (Exception $e) {
    echo "❌ Database error: " . $e->getMessage() . "\n";
}

echo "\nTest completed.\n";
