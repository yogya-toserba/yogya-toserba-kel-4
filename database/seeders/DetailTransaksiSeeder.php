<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DetailTransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo "🔄 Memulai seeding detail transaksi tambahan...\n";
        
        $faker = Faker::create('id_ID');
        
        // Ambil transaksi yang belum memiliki detail (jika ada)
        $transaksiTanpaDetail = DB::table('transaksi')
            ->leftJoin('detail_transaksi', 'transaksi.id_transaksi', '=', 'detail_transaksi.id_transaksi')
            ->whereNull('detail_transaksi.id_transaksi')
            ->select('transaksi.*')
            ->get();
            
        if ($transaksiTanpaDetail->isEmpty()) {
            echo "✅ Semua transaksi sudah memiliki detail transaksi!\n";
            return;
        }
        
        $produkData = DB::table('stok_produk')
            ->join('kategori', 'stok_produk.id_kategori', '=', 'kategori.id_kategori')
            ->select('stok_produk.*', 'kategori.nama_kategori')
            ->get()
            ->toArray();
        
        if (empty($produkData)) {
            echo "❌ Tidak ada data produk. Jalankan StokProdukSeeder terlebih dahulu.\n";
            return;
        }
        
        $detailData = [];
        
        foreach ($transaksiTanpaDetail as $transaksi) {
            // Generate 1-5 item per transaksi
            $jumlahItem = $faker->numberBetween(1, 5);
            $totalBelanja = 0;
            
            for ($i = 0; $i < $jumlahItem; $i++) {
                $produk = $faker->randomElement($produkData);
                $jumlahBarang = $faker->numberBetween(1, 3);
                $hargaSatuan = $this->generateHargaProduk($produk->nama_barang, $produk->nama_kategori);
                $totalHargaItem = $hargaSatuan * $jumlahBarang;
                $totalBelanja += $totalHargaItem;
                
                $detailData[] = [
                    'id_transaksi' => $transaksi->id_transaksi,
                    'id_produk' => $produk->id_produk,
                    'nama_barang' => $produk->nama_barang,
                    'jumlah_barang' => $jumlahBarang,
                    'total_harga' => $totalHargaItem,
                    'created_at' => $transaksi->created_at,
                    'updated_at' => $transaksi->updated_at,
                ];
                
                // Insert dalam batch 100 data untuk performa
                if (count($detailData) >= 100) {
                    DB::table('detail_transaksi')->insert($detailData);
                    $detailData = [];
                }
            }
            
            // Update total belanja transaksi jika diperlukan
            if ($totalBelanja != $transaksi->total_belanja) {
                DB::table('transaksi')
                    ->where('id_transaksi', $transaksi->id_transaksi)
                    ->update([
                        'total_belanja' => $totalBelanja,
                        'poin_yang_didapatkan' => floor($totalBelanja / 10000)
                    ]);
            }
        }
        
        // Insert sisa data jika ada
        if (!empty($detailData)) {
            DB::table('detail_transaksi')->insert($detailData);
        }
        
        echo "✅ Berhasil menambahkan detail untuk " . count($transaksiTanpaDetail) . " transaksi!\n";
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
