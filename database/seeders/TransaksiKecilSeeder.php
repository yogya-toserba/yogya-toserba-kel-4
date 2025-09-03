<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class TransaksiKecilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo "🔄 Memulai seeding transaksi dengan nominal kecil...\n";
        
        // Hapus data lama
        DB::table('detail_transaksi')->delete();
        DB::table('transaksi')->delete();
        
        $faker = Faker::create('id_ID');
        
        // Ambil ID dari tabel yang diperlukan
        $pelangganIds = DB::table('pelanggan')->pluck('id_pelanggan')->toArray();
        $cabangIds = DB::table('cabang')->pluck('id_cabang')->toArray();
        $kasIds = DB::table('kas')->pluck('id_kas')->toArray();
        
        // Ambil data produk dengan kategori
        $produkData = DB::table('stok_produk')
            ->join('kategori', 'stok_produk.id_kategori', '=', 'kategori.id_kategori')
            ->select('stok_produk.*', 'kategori.nama_kategori')
            ->get()
            ->toArray();
        
        // Validasi data yang diperlukan
        if (empty($pelangganIds)) {
            echo "❌ Tidak ada data pelanggan. Jalankan PelangganSeeder terlebih dahulu.\n";
            return;
        }
        
        if (empty($produkData)) {
            echo "❌ Tidak ada data produk. Jalankan StokProdukSeeder terlebih dahulu.\n";
            return;
        }
        
        // Buat data cabang default jika tidak ada
        if (empty($cabangIds)) {
            DB::table('cabang')->insert([
                'nama_cabang' => 'Cabang Pusat',
                'kategori' => 'Supermarket',
                'alamat' => 'Jl. Sudirman No. 1',
                'wilayah' => 'Jakarta',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $cabangIds = DB::table('cabang')->pluck('id_cabang')->toArray();
        }
        
        // Buat data kas default jika tidak ada
        if (empty($kasIds)) {
            DB::table('kas')->insert([
                'id_cabang' => $cabangIds[0],
                'referensi' => 'KAS001',
                'jenis_transaksi' => 'SALDO_AWAL',
                'jumlah' => 5000000,
                'keterangan' => 'Saldo awal kas',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $kasIds = DB::table('kas')->pluck('id_kas')->toArray();
        }
        
        $totalTransaksi = 0;
        $totalDetailTransaksi = 0;
        $detailTransaksiData = [];
        
        // Generate transaksi untuk 14 hari terakhir (lebih sedikit dari sebelumnya)
        for ($day = 13; $day >= 0; $day--) {
            $date = Carbon::now()->subDays($day);
            
            // Random jumlah transaksi per hari yang lebih sedikit (3-15 transaksi)
            $transaksisPerDay = $faker->numberBetween(3, 15);
            
            for ($i = 0; $i < $transaksisPerDay; $i++) {
                $idPelanggan = $faker->randomElement($pelangganIds);
                $idCabang = $faker->randomElement($cabangIds);
                $idKas = $faker->randomElement($kasIds);
                
                // Generate 1-4 item per transaksi (lebih sedikit)
                $jumlahItem = $faker->numberBetween(1, 4);
                $totalBelanja = 0;
                $tempDetailTransaksi = [];
                
                // Generate detail transaksi dulu untuk menghitung total
                for ($j = 0; $j < $jumlahItem; $j++) {
                    $produk = $faker->randomElement($produkData);
                    $jumlahBarang = $faker->numberBetween(1, 3); // Lebih sedikit quantity
                    $hargaSatuan = $this->generateHargaProdukKecil($produk->nama_barang, $produk->nama_kategori);
                    $totalHargaItem = $hargaSatuan * $jumlahBarang;
                    $totalBelanja += $totalHargaItem;
                    
                    $tempDetailTransaksi[] = [
                        'id_produk' => $produk->id_produk,
                        'nama_barang' => $produk->nama_barang,
                        'jumlah_barang' => $jumlahBarang,
                        'total_harga' => $totalHargaItem,
                        'created_at' => $date,
                        'updated_at' => $date,
                    ];
                }
                
                // Hitung poin (lebih sedikit karena nominal kecil)
                $poinDidapat = floor($totalBelanja / 25000); // 1 poin per 25k (lebih susah dapat poin)
                $poinDigunakan = $faker->optional(0.2)->numberBetween(0, min(10, $poinDidapat)); // 20% chance menggunakan poin
                
                // Adjust total belanja jika menggunakan poin
                if ($poinDigunakan) {
                    $totalBelanja -= ($poinDigunakan * 1000);
                }
                
                // Insert transaksi dan dapatkan ID
                $idTransaksi = DB::table('transaksi')->insertGetId([
                    'id_pelanggan' => $idPelanggan,
                    'tanggal_transaksi' => $date->format('Y-m-d'),
                    'total_belanja' => $totalBelanja,
                    'id_cabang' => $idCabang,
                    'poin_yang_didapatkan' => $poinDidapat,
                    'poin_yang_digunakan' => $poinDigunakan,
                    'id_kas' => $idKas,
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
                
                // Insert detail transaksi dengan id_transaksi yang benar
                foreach ($tempDetailTransaksi as $detail) {
                    $detail['id_transaksi'] = $idTransaksi;
                    $detailTransaksiData[] = $detail;
                }
                
                $totalTransaksi++;
                $totalDetailTransaksi += count($tempDetailTransaksi);
                
                // Insert detail dalam batch 50 untuk performa
                if (count($detailTransaksiData) >= 50) {
                    DB::table('detail_transaksi')->insert($detailTransaksiData);
                    $detailTransaksiData = [];
                }
            }
        }
        
        // Insert sisa data jika ada
        if (!empty($detailTransaksiData)) {
            DB::table('detail_transaksi')->insert($detailTransaksiData);
        }
        
        // Tampilkan statistik
        $avgTransaksi = DB::table('transaksi')->avg('total_belanja');
        $minTransaksi = DB::table('transaksi')->min('total_belanja');
        $maxTransaksi = DB::table('transaksi')->max('total_belanja');
        
        echo "✅ Berhasil membuat {$totalTransaksi} transaksi dengan {$totalDetailTransaksi} detail transaksi!\n";
        echo "📊 Data tersebar dalam 14 hari terakhir\n";
        echo "💰 Rata-rata transaksi: Rp " . number_format($avgTransaksi) . "\n";
        echo "📉 Transaksi terkecil: Rp " . number_format($minTransaksi) . "\n";
        echo "📈 Transaksi terbesar: Rp " . number_format($maxTransaksi) . "\n";
    }
    
    /**
     * Generate harga produk dengan nominal yang lebih kecil
     */
    private function generateHargaProdukKecil($namaProduk, $kategori)
    {
        $faker = \Faker\Factory::create('id_ID');
        
        // Harga berdasarkan kategori dengan nominal yang diperkecil
        switch ($kategori) {
            case 'Buku':
                if (strpos($namaProduk, 'Novel') !== false || strpos($namaProduk, 'Buku') !== false) {
                    return $faker->numberBetween(15000, 45000); // Dikurangi dari 25k-85k
                }
                // Alat tulis
                return $faker->numberBetween(2000, 15000); // Dikurangi dari 3k-25k
                
            case 'Elektronik':
                if (strpos($namaProduk, 'Smartphone') !== false || strpos($namaProduk, 'Laptop') !== false) {
                    return $faker->numberBetween(800000, 3500000); // Dikurangi drastis dari 2jt-15jt
                }
                if (strpos($namaProduk, 'Speaker') !== false || strpos($namaProduk, 'Headphone') !== false) {
                    return $faker->numberBetween(75000, 500000); // Dikurangi dari 150k-2jt
                }
                return $faker->numberBetween(25000, 300000); // Dikurangi dari 50k-1.5jt
                
            case 'Fashion':
                if (strpos($namaProduk, 'Sepatu') !== false || strpos($namaProduk, 'Boots') !== false) {
                    return $faker->numberBetween(100000, 400000); // Dikurangi dari 200k-1.5jt
                }
                if (strpos($namaProduk, 'Tas') !== false || strpos($namaProduk, 'Dompet') !== false) {
                    return $faker->numberBetween(75000, 250000); // Dikurangi dari 150k-800k
                }
                return $faker->numberBetween(25000, 150000); // Dikurangi dari 50k-500k
                
            case 'Kesehatan':
            case 'Perawatan':
                if (strpos($namaProduk, 'Vitamin') !== false || strpos($namaProduk, 'Suplemen') !== false) {
                    return $faker->numberBetween(25000, 85000); // Dikurangi dari 50k-250k
                }
                return $faker->numberBetween(8000, 45000); // Dikurangi dari 15k-150k
                
            case 'Makanan':
                if (strpos($namaProduk, 'Susu') !== false || strpos($namaProduk, 'Keju') !== false) {
                    return $faker->numberBetween(12000, 35000); // Dikurangi dari 25k-75k
                }
                if (strpos($namaProduk, 'Snack') !== false || strpos($namaProduk, 'Biskuit') !== false) {
                    return $faker->numberBetween(3000, 18000); // Dikurangi dari 8k-35k
                }
                return $faker->numberBetween(2500, 25000); // Dikurangi dari 5k-50k
                
            case 'Olahraga':
                if (strpos($namaProduk, 'Sepeda') !== false) {
                    return $faker->numberBetween(500000, 1500000); // Dikurangi dari 1.5jt-5jt
                }
                if (strpos($namaProduk, 'Matras') !== false || strpos($namaProduk, 'Dumbbell') !== false) {
                    return $faker->numberBetween(45000, 180000); // Dikurangi dari 100k-500k
                }
                return $faker->numberBetween(12000, 120000); // Dikurangi dari 25k-300k
                
            case 'Otomotif':
                if (strpos($namaProduk, 'Ban') !== false || strpos($namaProduk, 'Velg') !== false) {
                    return $faker->numberBetween(200000, 800000); // Dikurangi dari 500k-2jt
                }
                if (strpos($namaProduk, 'Oli') !== false) {
                    return $faker->numberBetween(25000, 85000); // Dikurangi dari 50k-200k
                }
                return $faker->numberBetween(12000, 250000); // Dikurangi dari 25k-800k
                
            case 'Rumah Tangga':
                if (strpos($namaProduk, 'Kulkas') !== false || strpos($namaProduk, 'Mesin Cuci') !== false) {
                    return $faker->numberBetween(800000, 2500000); // Dikurangi dari 2jt-8jt
                }
                if (strpos($namaProduk, 'Panci') !== false || strpos($namaProduk, 'Wajan') !== false) {
                    return $faker->numberBetween(35000, 120000); // Dikurangi dari 75k-300k
                }
                return $faker->numberBetween(8000, 180000); // Dikurangi dari 15k-500k
                
            default:
                return $faker->numberBetween(5000, 45000); // Dikurangi dari 10k-100k
        }
    }
}
