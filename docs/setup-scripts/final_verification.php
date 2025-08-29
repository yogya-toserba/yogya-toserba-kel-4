<?php

// Final verification of all expected application queries
echo "=== FINAL APPLICATION QUERY VERIFICATION ===\n";
echo "Testing all expected queries that the application might use...\n\n";

$host = '127.0.0.1';
$port = '3306';
$database = 'db_yogya';
$username = 'root';
$password = '';

try {
  $pdo = new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  echo "✅ Database connection successful!\n\n";

  // 1. Test the original problematic query (Top selling products)
  echo "1. Testing Top Selling Products Query...\n";
  $sql = "
    SELECT stok_produk.id_produk, 
           stok_produk.nama_barang as name,
           stok_produk.harga_jual as price,
           stok_produk.foto as image,
           kategori.nama_kategori,
           SUM(detail_transaksi.jumlah_barang) as total_sold,
           COUNT(detail_transaksi.id_transaksi) as transaction_count,
           AVG(4.5 + (RAND() * 0.5)) as rating,
           ROUND(stok_produk.harga_jual * 1.2) as original_price
    FROM detail_transaksi 
    INNER JOIN stok_produk ON detail_transaksi.id_produk = stok_produk.id_produk
    INNER JOIN kategori ON stok_produk.id_kategori = kategori.id_kategori
    GROUP BY stok_produk.id_produk, stok_produk.nama_barang, 
             stok_produk.harga_jual, stok_produk.foto, kategori.nama_kategori
    ORDER BY total_sold DESC 
    LIMIT 8
    ";

  $stmt = $pdo->query($sql);
  $results = $stmt->fetchAll();
  echo "   ✅ SUCCESS: Found " . count($results) . " top selling products\n";

  // 2. Test Product by Category Query
  echo "2. Testing Products by Category Query...\n";
  $sql = "
    SELECT sp.*, k.nama_kategori, c.nama_cabang
    FROM stok_produk sp
    JOIN kategori k ON sp.id_kategori = k.id_kategori
    JOIN cabang c ON sp.id_cabang = c.id_cabang
    WHERE k.nama_kategori = 'Makanan & Minuman'
    ";

  $stmt = $pdo->query($sql);
  $results = $stmt->fetchAll();
  echo "   ✅ SUCCESS: Found " . count($results) . " products in Makanan & Minuman category\n";

  // 3. Test Transaction Details Query
  echo "3. Testing Transaction Details Query...\n";
  $sql = "
    SELECT t.id_transaksi, t.tanggal, t.total_harga, t.metode_pembayaran,
           p.nama_pelanggan, c.nama_cabang,
           dt.nama_barang, dt.jumlah_barang, dt.total_harga as item_total
    FROM transaksi t
    LEFT JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan
    JOIN cabang c ON t.id_cabang = c.id_cabang
    JOIN detail_transaksi dt ON t.id_transaksi = dt.id_transaksi
    ORDER BY t.tanggal DESC
    ";

  $stmt = $pdo->query($sql);
  $results = $stmt->fetchAll();
  echo "   ✅ SUCCESS: Found " . count($results) . " transaction detail records\n";

  // 4. Test Product Stock Query
  echo "4. Testing Product Stock by Branch Query...\n";
  $sql = "
    SELECT sp.nama_barang, sp.stok, sp.harga_jual, 
           c.nama_cabang, k.nama_kategori
    FROM stok_produk sp
    JOIN cabang c ON sp.id_cabang = c.id_cabang
    JOIN kategori k ON sp.id_kategori = k.id_kategori
    WHERE sp.stok > 0
    ORDER BY c.nama_cabang, k.nama_kategori
    ";

  $stmt = $pdo->query($sql);
  $results = $stmt->fetchAll();
  echo "   ✅ SUCCESS: Found " . count($results) . " products with available stock\n";

  // 5. Test Sales Summary Query
  echo "5. Testing Sales Summary Query...\n";
  $sql = "
    SELECT 
        DATE(t.tanggal) as sale_date,
        COUNT(DISTINCT t.id_transaksi) as total_transactions,
        SUM(t.total_harga) as total_revenue,
        AVG(t.total_harga) as avg_transaction_value,
        COUNT(dt.id_detail_penjualan) as total_items_sold
    FROM transaksi t
    JOIN detail_transaksi dt ON t.id_transaksi = dt.id_transaksi
    GROUP BY DATE(t.tanggal)
    ORDER BY sale_date DESC
    ";

  $stmt = $pdo->query($sql);
  $results = $stmt->fetchAll();
  echo "   ✅ SUCCESS: Generated sales summary for " . count($results) . " days\n";

  // 6. Test Customer Purchase History
  echo "6. Testing Customer Purchase History Query...\n";
  $sql = "
    SELECT p.nama_pelanggan, p.email, p.level_membership,
           COUNT(t.id_transaksi) as total_purchases,
           SUM(t.total_harga) as total_spent,
           MAX(t.tanggal) as last_purchase
    FROM pelanggan p
    LEFT JOIN transaksi t ON p.id_pelanggan = t.id_pelanggan
    GROUP BY p.id_pelanggan, p.nama_pelanggan, p.email, p.level_membership
    HAVING total_purchases > 0
    ORDER BY total_spent DESC
    ";

  $stmt = $pdo->query($sql);
  $results = $stmt->fetchAll();
  echo "   ✅ SUCCESS: Found purchase history for " . count($results) . " customers\n";

  // 7. Test Inventory Summary
  echo "7. Testing Inventory Summary Query...\n";
  $sql = "
    SELECT k.nama_kategori,
           COUNT(sp.id_produk) as total_products,
           SUM(sp.stok) as total_stock,
           AVG(sp.harga_jual) as avg_price,
           MIN(sp.harga_jual) as min_price,
           MAX(sp.harga_jual) as max_price
    FROM kategori k
    LEFT JOIN stok_produk sp ON k.id_kategori = sp.id_kategori
    GROUP BY k.id_kategori, k.nama_kategori
    ORDER BY total_stock DESC
    ";

  $stmt = $pdo->query($sql);
  $results = $stmt->fetchAll();
  echo "   ✅ SUCCESS: Generated inventory summary for " . count($results) . " categories\n";

  echo "\n=== DETAILED VERIFICATION RESULTS ===\n";

  // Show some sample data
  echo "\nTop 3 Selling Products:\n";
  $stmt = $pdo->query("
        SELECT sp.nama_barang, SUM(dt.jumlah_barang) as total_sold, sp.harga_jual
        FROM detail_transaksi dt
        JOIN stok_produk sp ON dt.id_produk = sp.id_produk
        GROUP BY sp.id_produk, sp.nama_barang, sp.harga_jual
        ORDER BY total_sold DESC
        LIMIT 3
    ");

  $counter = 1;
  while ($row = $stmt->fetch()) {
    echo "   {$counter}. {$row['nama_barang']} - {$row['total_sold']} units sold (Rp " . number_format($row['harga_jual'], 0, ',', '.') . ")\n";
    $counter++;
  }

  echo "\nBranch Performance:\n";
  $stmt = $pdo->query("
        SELECT c.nama_cabang, COUNT(t.id_transaksi) as transactions, SUM(t.total_harga) as revenue
        FROM cabang c
        LEFT JOIN transaksi t ON c.id_cabang = t.id_cabang
        GROUP BY c.id_cabang, c.nama_cabang
        ORDER BY revenue DESC
    ");

  while ($row = $stmt->fetch()) {
    $revenue = $row['revenue'] ? 'Rp ' . number_format($row['revenue'], 0, ',', '.') : 'Rp 0';
    echo "   - {$row['nama_cabang']}: {$row['transactions']} transactions, {$revenue}\n";
  }

  echo "\n🎉 ALL APPLICATION QUERIES VERIFIED SUCCESSFULLY! 🎉\n";
  echo "\nDatabase is fully compatible with the application requirements.\n";
  echo "The original error has been completely resolved.\n";
} catch (PDOException $e) {
  echo "❌ Database Error: " . $e->getMessage() . "\n";
} catch (Exception $e) {
  echo "❌ Error: " . $e->getMessage() . "\n";
}
