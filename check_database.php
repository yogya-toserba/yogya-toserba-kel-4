<?php

echo "🔄 Checking database status...\n";

try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=db_yogya', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if tables exist
    $stmt = $pdo->query("SELECT COUNT(*) FROM pelanggan");
    $pelangganCount = $stmt->fetchColumn();
    echo "Pelanggan: {$pelangganCount}\n";
    
    $stmt = $pdo->query("SELECT COUNT(*) FROM cabang");
    $cabangCount = $stmt->fetchColumn();
    echo "Cabang: {$cabangCount}\n";
    
    $stmt = $pdo->query("SELECT COUNT(*) FROM stok_produk");
    $produkCount = $stmt->fetchColumn();
    echo "Stok Produk: {$produkCount}\n";
    
    $stmt = $pdo->query("SELECT COUNT(*) FROM transaksi");
    $transaksiCount = $stmt->fetchColumn();
    echo "Transaksi: {$transaksiCount}\n";
    
    $stmt = $pdo->query("SELECT COUNT(*) FROM detail_transaksi");
    $detailCount = $stmt->fetchColumn();
    echo "Detail Transaksi: {$detailCount}\n";
    
    // Check kas table
    $stmt = $pdo->query("SELECT COUNT(*) FROM kas");
    $kasCount = $stmt->fetchColumn();
    echo "Kas: {$kasCount}\n";
    
    echo "✅ Database check completed!\n";
    
} catch (Exception $e) {
    echo "❌ Database Error: " . $e->getMessage() . "\n";
}
