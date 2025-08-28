<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class SimpleTransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo "🔄 Memulai simple seeding transaksi...\n";
        
        // Hapus data lama
        DB::table('detail_transaksi')->delete();
        DB::table('transaksi')->delete();
        
        $faker = Faker::create('id_ID');
        
        // Get required data
        $pelangganIds = DB::table('pelanggan')->pluck('id_pelanggan')->toArray();
        $cabangIds = DB::table('cabang')->pluck('id_cabang')->toArray();
        $produkData = DB::table('stok_produk')->get();
        
        if (empty($pelangganIds)) {
            echo "❌ Tidak ada data pelanggan\n";
            return;
        }
        
        if ($produkData->isEmpty()) {
            echo "❌ Tidak ada data produk\n";
            return;
        }
        
        // Create default cabang if none exist
        if (empty($cabangIds)) {
            $cabangId = DB::table('cabang')->insertGetId([
                'nama_cabang' => 'Cabang Pusat',
                'kategori' => 'Supermarket',
                'alamat' => 'Jl. Sudirman No. 1',
                'wilayah' => 'Jakarta',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $cabangIds = [$cabangId];
        }
        
        // Create default kas if none exist
        $kasIds = DB::table('kas')->pluck('id_kas')->toArray();
        if (empty($kasIds)) {
            $kasId = DB::table('kas')->insertGetId([
                'id_cabang' => $cabangIds[0], // Use first cabang
                'referensi' => 'KAS001',
                'jenis_transaksi' => 'SALDO_AWAL',
                'jumlah' => 10000000,
                'keterangan' => 'Saldo awal kas',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $kasIds = [$kasId];
        }
        
        $totalTransaksi = 0;
        
        // Create 50 simple transactions
        for ($i = 0; $i < 50; $i++) {
            // Insert single transaction
            $idTransaksi = DB::table('transaksi')->insertGetId([
                'id_pelanggan' => $faker->randomElement($pelangganIds),
                'tanggal_transaksi' => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d'),
                'total_belanja' => $faker->numberBetween(50000, 500000),
                'id_cabang' => $faker->randomElement($cabangIds),
                'poin_yang_didapatkan' => $faker->numberBetween(5, 50),
                'poin_yang_digunakan' => $faker->optional(0.3)->numberBetween(0, 20),
                'id_kas' => $faker->randomElement($kasIds),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            // Insert 1-3 detail transactions
            $jumlahDetail = $faker->numberBetween(1, 3);
            for ($j = 0; $j < $jumlahDetail; $j++) {
                $produk = $produkData->random();
                
                DB::table('detail_transaksi')->insert([
                    'id_transaksi' => $idTransaksi,
                    'id_produk' => $produk->id_produk,
                    'nama_barang' => $produk->nama_produk,
                    'jumlah_barang' => $faker->numberBetween(1, 3),
                    'total_harga' => $faker->numberBetween(20000, 200000),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            
            $totalTransaksi++;
        }
        
        echo "✅ Berhasil membuat {$totalTransaksi} transaksi sederhana!\n";
    }
}
