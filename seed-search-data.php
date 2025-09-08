<?php

// Test Data Seeder for Search Functionality
require_once 'vendor/autoload.php';

// Setup Laravel app
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== Seeding Test Data for Search ===\n\n";

try {
    // Insert categories first
    echo "1. Creating categories...\n";
    
    $categories = [
        ['nama_kategori' => 'Elektronik', 'sub_kategori' => 'Smartphone'],
        ['nama_kategori' => 'Elektronik', 'sub_kategori' => 'Laptop'],
        ['nama_kategori' => 'Elektronik', 'sub_kategori' => 'Audio'],
        ['nama_kategori' => 'Fashion', 'sub_kategori' => 'Pakaian Pria'],
        ['nama_kategori' => 'Fashion', 'sub_kategori' => 'Pakaian Wanita'],
        ['nama_kategori' => 'Rumah Tangga', 'sub_kategori' => 'Peralatan Dapur'],
        ['nama_kategori' => 'Olahraga', 'sub_kategori' => 'Fitness'],
        ['nama_kategori' => 'Kecantikan', 'sub_kategori' => 'Skincare'],
    ];
    
    foreach ($categories as $category) {
        DB::table('kategori')->insert($category);
    }
    
    echo "Created " . count($categories) . " categories\n";
    
    // Get a test cabang ID (create one if doesn't exist)
    echo "2. Checking cabang...\n";
    $cabang = DB::table('cabang')->first();
    if (!$cabang) {
        echo "Creating test cabang...\n";
        DB::table('cabang')->insert([
            'nama_cabang' => 'YOGYA Malioboro',
            'kategori' => 'Pusat',
            'alamat' => 'Jl. Malioboro No. 1',
            'wilayah' => 'Yogyakarta',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $cabang = DB::table('cabang')->first();
    }
    
    echo "Using cabang: {$cabang->nama_cabang}\n";
    
    // Insert sample products
    echo "3. Creating products...\n";
    
    $products = [
        // Elektronik - Smartphone
        [
            'id_cabang' => $cabang->id_cabang,
            'id_kategori' => 1,
            'foto' => 'smartphone1.jpg',
            'nama_barang' => 'iPhone 15 Pro Max',
            'jumlah_barang' => 50,
            'harga_jual' => 15999000,
            'stok' => 25,
        ],
        [
            'id_cabang' => $cabang->id_cabang,
            'id_kategori' => 1,
            'foto' => 'smartphone2.jpg',
            'nama_barang' => 'Samsung Galaxy S24 Ultra',
            'jumlah_barang' => 40,
            'harga_jual' => 13999000,
            'stok' => 30,
        ],
        [
            'id_cabang' => $cabang->id_cabang,
            'id_kategori' => 1,
            'foto' => 'smartphone3.jpg',
            'nama_barang' => 'Xiaomi 14 Pro',
            'jumlah_barang' => 60,
            'harga_jual' => 8999000,
            'stok' => 45,
        ],
        // Elektronik - Laptop
        [
            'id_cabang' => $cabang->id_cabang,
            'id_kategori' => 2,
            'foto' => 'laptop1.jpg',
            'nama_barang' => 'MacBook Pro 16 inch M3',
            'jumlah_barang' => 20,
            'harga_jual' => 35999000,
            'stok' => 15,
        ],
        [
            'id_cabang' => $cabang->id_cabang,
            'id_kategori' => 2,
            'foto' => 'laptop2.jpg',
            'nama_barang' => 'ASUS ROG Strix Gaming Laptop',
            'jumlah_barang' => 25,
            'harga_jual' => 18999000,
            'stok' => 20,
        ],
        [
            'id_cabang' => $cabang->id_cabang,
            'id_kategori' => 2,
            'foto' => 'laptop3.jpg',
            'nama_barang' => 'Lenovo ThinkPad X1 Carbon',
            'jumlah_barang' => 30,
            'harga_jual' => 22999000,
            'stok' => 12,
        ],
        // Elektronik - Audio
        [
            'id_cabang' => $cabang->id_cabang,
            'id_kategori' => 3,
            'foto' => 'headphone1.jpg',
            'nama_barang' => 'Sony WH-1000XM5 Wireless Headphones',
            'jumlah_barang' => 100,
            'harga_jual' => 4999000,
            'stok' => 80,
        ],
        [
            'id_cabang' => $cabang->id_cabang,
            'id_kategori' => 3,
            'foto' => 'speaker1.jpg',
            'nama_barang' => 'JBL Charge 5 Bluetooth Speaker',
            'jumlah_barang' => 75,
            'harga_jual' => 2499000,
            'stok' => 60,
        ],
        // Fashion - Pakaian Pria
        [
            'id_cabang' => $cabang->id_cabang,
            'id_kategori' => 4,
            'foto' => 'shirt1.jpg',
            'nama_barang' => 'Kemeja Formal Pria Premium',
            'jumlah_barang' => 200,
            'harga_jual' => 299000,
            'stok' => 150,
        ],
        [
            'id_cabang' => $cabang->id_cabang,
            'id_kategori' => 4,
            'foto' => 'jeans1.jpg',
            'nama_barang' => 'Celana Jeans Pria Slim Fit',
            'jumlah_barang' => 180,
            'harga_jual' => 399000,
            'stok' => 120,
        ],
        // Rumah Tangga
        [
            'id_cabang' => $cabang->id_cabang,
            'id_kategori' => 6,
            'foto' => 'blender1.jpg',
            'nama_barang' => 'Blender Philips HR3556',
            'jumlah_barang' => 50,
            'harga_jual' => 899000,
            'stok' => 35,
        ],
        [
            'id_cabang' => $cabang->id_cabang,
            'id_kategori' => 6,
            'foto' => 'ricecooker1.jpg',
            'nama_barang' => 'Rice Cooker Cosmos Digital',
            'jumlah_barang' => 40,
            'harga_jual' => 699000,
            'stok' => 28,
        ],
    ];
    
    foreach ($products as $product) {
        $product['created_at'] = now();
        $product['updated_at'] = now();
        DB::table('stok_produk')->insert($product);
    }
    
    echo "Created " . count($products) . " products\n";
    
    echo "\n=== Test Data Seeding Complete ===\n";
    echo "Categories: " . DB::table('kategori')->count() . "\n";
    echo "Products: " . DB::table('stok_produk')->count() . "\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Make sure the database is properly configured and tables exist.\n";
}
