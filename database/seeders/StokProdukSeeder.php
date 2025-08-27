<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class StokProdukSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama dengan delete (bukan truncate karena ada foreign key constraint)
        DB::table('stok_produk')->delete();
        
        $faker = Faker::create('id_ID');
        
        // Pastikan ada data cabang
        $cabangs = DB::table('cabang')->get();
        if ($cabangs->isEmpty()) {
            // Tambahkan cabang default jika belum ada
            DB::table('cabang')->insert([
                'nama_cabang' => 'Cabang Pusat',
                'kategori' => 'Supermarket',
                'alamat' => 'Jl. Sudirman No. 1',
                'wilayah' => 'Jakarta',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $cabangs = DB::table('cabang')->get();
        }

        // Pastikan ada data kategori dengan seeder KategoriSeeder
        $kategoris = DB::table('kategori')->get();
        if ($kategoris->isEmpty()) {
            // Jalankan KategoriSeeder jika belum ada data
            $this->call(KategoriSeeder::class);
            $kategoris = DB::table('kategori')->get();
        }

        // Data produk untuk setiap kategori
        $produkData = [
            'Buku' => [
                'Novel Petualangan', 'Buku Sejarah Indonesia', 'Komik Anak', 'Ensiklopedia', 'Kamus Bahasa Inggris',
                'Buku Resep Masakan', 'Atlas Dunia', 'Buku Motivasi', 'Dongeng Anak', 'Biografi Tokoh',
                'Buku Pelajaran SD', 'Novel Romantis', 'Buku Agama', 'Majalah Fashion', 'Buku Komputer',
                'Novel Misteri', 'Buku Kesehatan', 'Panduan Bisnis', 'Buku Seni', 'Manual Elektronik',
                'Pulpen Pilot', 'Pensil 2B Faber Castell', 'Spidol Snowman', 'Penggaris 30cm', 'Buku Tulis 58 Lembar',
                'Kertas HVS A4', 'Map Plastik', 'Stapler Kenko', 'Lem Stick UHU', 'Correction Pen Tip-Ex'
            ],
            'Elektronik' => [
                'Smartphone Samsung', 'iPhone 15', 'Laptop Asus', 'Power Bank Xiaomi', 'Earphone Sony',
                'Speaker Bluetooth JBL', 'Smartwatch Apple', 'Tablet iPad', 'Kamera Digital Canon', 'Drone DJI',
                'Smart TV LG 43"', 'Kulkas 2 Pintu', 'Mesin Cuci Polytron', 'AC Split Daikin', 'Rice Cooker Cosmos',
                'Blender Philips', 'Microwave Sharp', 'Dispenser Sanken', 'Kipas Angin Miyako', 'Setrika Philips',
                'Charger USB-C', 'Kabel HDMI', 'Memory Card 64GB', 'Hard Disk External', 'Mouse Wireless Logitech',
                'Keyboard Mechanical', 'Webcam HD', 'Printer Canon', 'Router WiFi TP-Link', 'UPS APC'
            ],
            'Fashion' => [
                'Kaos Polos Cotton', 'Kemeja Formal Pria', 'Blouse Wanita', 'Celana Jeans Levis', 'Rok Midi',
                'Dress Casual', 'Jaket Bomber', 'Sweater Rajut', 'Hoodie Unisex', 'Cardigan Wanita',
                'Sepatu Sneakers Adidas', 'Sandal Jepit Swallow', 'High Heels 7cm', 'Sepatu Formal Pantofel', 'Boot Ankle',
                'Tas Ransel Eiger', 'Handbag Kulit', 'Dompet Pria', 'Kacamata Hitam Rayban', 'Jam Tangan Casio',
                'Topi Baseball', 'Syal Wool', 'Sabuk Kulit', 'Kaos Kaki Pria', 'Celana Dalam Rider',
                'Bra Sport', 'Piyama Set', 'Kemeja Batik', 'Mukena Dewasa', 'Kerudung Segi Empat'
            ],
            'Kesehatan' => [
                'Vitamin C 1000mg', 'Madu Murni 500ml', 'Masker KF94', 'Hand Sanitizer 250ml', 'Termometer Digital',
                'Plester Luka Hansaplast', 'Betadine 15ml', 'Paracetamol Strip', 'OBH Combi Batuk', 'Minyak Kayu Putih',
                'Sunscreen SPF 50', 'Face Wash Neutrogena', 'Moisturizer Nivea', 'Serum Vitamin C', 'Lip Balm Vaseline',
                'Shampoo Head & Shoulders', 'Conditioner Pantene', 'Body Lotion Citra', 'Parfum Pria', 'Deodorant Rexona',
                'Pasta Gigi Sensodyne', 'Sikat Gigi Oral-B', 'Obat Kumur Listerine', 'Tisu Basah', 'Kapas Bulat',
                'Cotton Bud', 'Alkohol 70%', 'Perban Elastis', 'Koyo Salonpas', 'Minyak Telon Bayi'
            ],
            'Makanan' => [
                'Beras Premium 5Kg', 'Minyak Goreng Tropical 1L', 'Gula Pasir Gulaku 1Kg', 'Garam Dapur 250g', 'Tepung Terigu Segitiga',
                'Mie Instan Indomie', 'Sarden Kaleng ABC', 'Susu UHT Frisian Flag', 'Kopi Kapal Api', 'Teh Celup Sariwangi',
                'Biskuit Oreo', 'Cokelat Silverqueen', 'Permen Mentos', 'Chiki Balls', 'Keripik Kentang Chitato',
                'Saus Tomat ABC', 'Kecap Manis Bango', 'Sambal Oelek', 'Bumbu Nasi Goreng', 'Penyedap Rasa Royco',
                'Air Mineral Aqua 600ml', 'Teh Botol Sosro', 'Coca Cola 330ml', 'Sprite Kaleng', 'Jus Buavita',
                'Yogurt Cimory', 'Es Krim Walls', 'Keju Kraft Singles', 'Mentega Blueband', 'Selai Strawberry'
            ],
            'Olahraga' => [
                'Sepatu Lari Nike', 'Jersey Futsal Adidas', 'Celana Training', 'Kaos Olahraga Dri-Fit', 'Jaket Olahraga',
                'Bola Sepak Mikasa', 'Bola Basket Spalding', 'Raket Badminton Yonex', 'Shuttlecock Victor', 'Grip Raket',
                'Matras Yoga 6mm', 'Dumbbell 5kg', 'Resistance Band', 'Skipping Rope', 'Push Up Bar',
                'Botol Minum Olahraga', 'Handuk Olahraga', 'Tas Gym Adidas', 'Sarung Tangan Fitness', 'Sepeda Lipat',
                'Helm Sepeda', 'Kacamata Renang', 'Baju Renang Speedo', 'Pelampung Renang', 'Fin Renang',
                'Stopwatch Digital', 'Whistle Olahraga', 'Cone Training', 'Medicine Ball', 'Kettlebell 8kg'
            ],
            'Otomotif' => [
                'Oli Mesin Shell 1L', 'Ban Motor Corsa', 'Aki Motor GS Astra', 'Busi NGK', 'Filter Udara',
                'Kampas Rem Depan', 'Rantai Motor', 'Spion Motor', 'Lampu LED Motor', 'Klakson Denso',
                'Helm Full Face KYT', 'Jaket Motor Respiro', 'Sarung Tangan Motor', 'Masker Motor', 'Kacamata Riding',
                'Cover Motor', 'Kunci Kontak Motor', 'Speedometer', 'Handle Rem', 'Pedal Gas',
                'Air Radiator', 'Cairan Rem DOT 3', 'Gemuk Bearing', 'Pembersih Injector', 'Wax Mobil',
                'Sampo Mobil', 'Kanebo Lap', 'Sikat Velg', 'Pengharum Mobil', 'Dashboard Cleaner'
            ],
            'Perawatan' => [
                'Sabun Mandi Lifebuoy', 'Sabun Cuci Piring Sunlight', 'Detergen Surf', 'Pelembut Pakaian Molto', 'Pemutih Pakaian',
                'Shampo Bayi Johnson', 'Bedak Bayi', 'Minyak Telon', 'Popok Bayi Merries', 'Tisu Bayi',
                'Lotion Bayi', 'Sabun Bayi', 'Cotton Bud Bayi', 'Handuk Bayi', 'Baju Bayi 0-6 Bulan',
                'Sisir Rambut', 'Cermin Makeup', 'Lipstik Revlon', 'Bedak Tabur', 'Foundation Maybelline',
                'Nail Polish', 'Remover Kutek', 'Perawatan Kuku', 'Gunting Kuku', 'Kikir Kuku',
                'Body Scrub', 'Face Mask', 'Peeling Gel', 'Toner Wajah', 'Eye Cream'
            ],
            'Rumah Tangga' => [
                'Piring Melamin Set', 'Gelas Kaca 6pcs', 'Sendok Garpu Stainless', 'Mangkok Nasi', 'Mug Keramik',
                'Wajan Teflon 24cm', 'Panci Set Maxim', 'Spatula Kayu', 'Centong Nasi', 'Pisau Dapur Set',
                'Talenan Kayu', 'Saringan Minyak', 'Baskom Plastik', 'Ember 20 Liter', 'Gayung Plastik',
                'Sapu Ijuk', 'Pel Lantai', 'Sikat WC', 'Pembersih Lantai', 'Karbol Wangi',
                'Lampu LED 12 Watt', 'Stop Kontak', 'Kabel Roll', 'Tang Listrik', 'Obeng Set',
                'Gorden Jendela', 'Sprei Set Queen', 'Bantal Tidur', 'Selimut Tebal', 'Kasur Lipat'
            ]
        ];

        $stokProdukData = [];
        $counter = 0;
        
        // Generate 300 produk (sekitar 33-34 produk per kategori)
        foreach ($produkData as $kategoriName => $products) {
            $kategori = $kategoris->where('nama_kategori', $kategoriName)->first();
            
            if (!$kategori) continue;
            
            $productsPerCategory = ceil(300 / count($produkData)); // ~33 produk per kategori
            
            for ($i = 0; $i < min($productsPerCategory, count($products)) && $counter < 300; $i++) {
                $cabang = $cabangs->random();
                
                // Tentukan harga berdasarkan kategori
                $harga = match($kategoriName) {
                    'Elektronik' => $faker->numberBetween(500000, 15000000),
                    'Fashion' => $faker->numberBetween(50000, 800000),
                    'Otomotif' => $faker->numberBetween(25000, 2000000),
                    'Rumah Tangga' => $faker->numberBetween(15000, 500000),
                    'Buku' => $faker->numberBetween(10000, 150000),
                    'Kesehatan', 'Perawatan' => $faker->numberBetween(5000, 200000),
                    'Makanan' => $faker->numberBetween(3000, 100000),
                    'Olahraga' => $faker->numberBetween(30000, 1500000),
                    default => $faker->numberBetween(10000, 500000)
                };

                $stok = $faker->numberBetween(5, 200);
                
                $stokProdukData[] = [
                    'id_cabang' => $cabang->id_cabang,
                    'id_kategori' => $kategori->id_kategori,
                    'foto' => '/image/produk/' . strtolower(str_replace([' ', '&', '-'], ['_', 'dan', '_'], $products[$i])) . '.jpg',
                    'nama_barang' => $products[$i],
                    'jumlah_barang' => $stok,
                    'harga_jual' => $harga,
                    'stok' => $stok,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                
                $counter++;
            }
        }

        // Insert data dalam batch untuk performa yang lebih baik
        $chunks = array_chunk($stokProdukData, 50);
        foreach ($chunks as $chunk) {
            DB::table('stok_produk')->insert($chunk);
        }
    }
}
