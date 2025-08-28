<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo "🔄 Memulai seeding transaksi dan detail transaksi...\n";
        
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
                'jumlah' => 10000000,
                'keterangan' => 'Saldo awal kas',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $kasIds = DB::table('kas')->pluck('id_kas')->toArray();
        }
        
        $totalTransaksi = 0;
        $totalDetailTransaksi = 0;
        $detailTransaksiData = [];
        
        // Generate transaksi untuk 30 hari terakhir
        for ($day = 29; $day >= 0; $day--) {
            $date = Carbon::now()->subDays($day);
            
            // Random jumlah transaksi per hari (10-50 transaksi)
            $transaksisPerDay = $faker->numberBetween(10, 50);
            
            for ($i = 0; $i < $transaksisPerDay; $i++) {
                $idPelanggan = $faker->randomElement($pelangganIds);
                $idCabang = $faker->randomElement($cabangIds);
                $idKas = $faker->randomElement($kasIds);
                
                // Generate 1-8 item per transaksi
                $jumlahItem = $faker->numberBetween(1, 8);
                $totalBelanja = 0;
                $tempDetailTransaksi = [];
                
                // Generate detail transaksi dulu untuk menghitung total
                for ($j = 0; $j < $jumlahItem; $j++) {
                    $produk = $faker->randomElement($produkData);
                    $jumlahBarang = $faker->numberBetween(1, 5);
                    $hargaSatuan = $this->generateHargaProduk($produk->nama_barang, $produk->nama_kategori);
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
                
                // Hitung poin
                $poinDidapat = floor($totalBelanja / 10000); // 1 poin per 10k
                $poinDigunakan = $faker->optional(0.3)->numberBetween(0, min(100, $poinDidapat)); // 30% chance menggunakan poin
                
                // Adjust total belanja jika menggunakan poin (1 poin = Rp 1000)
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
                
                // Insert detail dalam batch 100 untuk performa
                if (count($detailTransaksiData) >= 100) {
                    DB::table('detail_transaksi')->insert($detailTransaksiData);
                    $detailTransaksiData = [];
                }
            }
        }
        
        // Insert sisa data jika ada
        if (!empty($detailTransaksiData)) {
            DB::table('detail_transaksi')->insert($detailTransaksiData);
        }
        
        echo "✅ Berhasil membuat {$totalTransaksi} transaksi dengan {$totalDetailTransaksi} detail transaksi!\n";
        echo "📊 Data tersebar dalam 30 hari terakhir untuk analisis yang realistis\n";
    }
    
    /**
     * Generate harga produk berdasarkan nama dan kategori
     */
    private function generateHargaProduk($namaProduk, $kategori)
    {
        $faker = \Faker\Factory::create('id_ID');
        
        // Harga berdasarkan kategori
        switch ($kategori) {
            case 'Buku':
                if (strpos($namaProduk, 'Novel') !== false || strpos($namaProduk, 'Buku') !== false) {
                    return $faker->numberBetween(25000, 85000);
                }
                // Alat tulis
                return $faker->numberBetween(3000, 25000);
                
            case 'Elektronik':
                if (strpos($namaProduk, 'Smartphone') !== false || strpos($namaProduk, 'Laptop') !== false) {
                    return $faker->numberBetween(2000000, 15000000);
                }
                if (strpos($namaProduk, 'Speaker') !== false || strpos($namaProduk, 'Headphone') !== false) {
                    return $faker->numberBetween(150000, 2000000);
                }
                return $faker->numberBetween(50000, 1500000);
                
            case 'Fashion':
                if (strpos($namaProduk, 'Sepatu') !== false || strpos($namaProduk, 'Boots') !== false) {
                    return $faker->numberBetween(200000, 1500000);
                }
                if (strpos($namaProduk, 'Tas') !== false || strpos($namaProduk, 'Dompet') !== false) {
                    return $faker->numberBetween(150000, 800000);
                }
                return $faker->numberBetween(50000, 500000);
                
            case 'Kesehatan':
            case 'Perawatan':
                if (strpos($namaProduk, 'Vitamin') !== false || strpos($namaProduk, 'Suplemen') !== false) {
                    return $faker->numberBetween(50000, 250000);
                }
                return $faker->numberBetween(15000, 150000);
                
            case 'Makanan':
                if (strpos($namaProduk, 'Susu') !== false || strpos($namaProduk, 'Keju') !== false) {
                    return $faker->numberBetween(25000, 75000);
                }
                if (strpos($namaProduk, 'Snack') !== false || strpos($namaProduk, 'Biskuit') !== false) {
                    return $faker->numberBetween(8000, 35000);
                }
                return $faker->numberBetween(5000, 50000);
                
            case 'Olahraga':
                if (strpos($namaProduk, 'Sepeda') !== false) {
                    return $faker->numberBetween(1500000, 5000000);
                }
                if (strpos($namaProduk, 'Matras') !== false || strpos($namaProduk, 'Dumbbell') !== false) {
                    return $faker->numberBetween(100000, 500000);
                }
                return $faker->numberBetween(25000, 300000);
                
            case 'Otomotif':
                if (strpos($namaProduk, 'Ban') !== false || strpos($namaProduk, 'Velg') !== false) {
                    return $faker->numberBetween(500000, 2000000);
                }
                if (strpos($namaProduk, 'Oli') !== false) {
                    return $faker->numberBetween(50000, 200000);
                }
                return $faker->numberBetween(25000, 800000);
                
            case 'Rumah Tangga':
                if (strpos($namaProduk, 'Kulkas') !== false || strpos($namaProduk, 'Mesin Cuci') !== false) {
                    return $faker->numberBetween(2000000, 8000000);
                }
                if (strpos($namaProduk, 'Panci') !== false || strpos($namaProduk, 'Wajan') !== false) {
                    return $faker->numberBetween(75000, 300000);
                }
                return $faker->numberBetween(15000, 500000);
                
            default:
                return $faker->numberBetween(10000, 100000);
        }
    }
}
