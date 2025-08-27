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
        // Hapus data lama
        DB::table('transaksi')->delete();
        
        $faker = Faker::create('id_ID');
        
        // Ambil ID dari tabel yang diperlukan
        $pelangganIds = DB::table('pelanggan')->pluck('id_pelanggan')->toArray();
        $cabangIds = DB::table('cabang')->pluck('id_cabang')->toArray();
        $kasIds = DB::table('kas')->pluck('id_kas')->toArray();
        
        // Jika tidak ada data di tabel terkait, buat data default
        if (empty($pelangganIds)) {
            echo "❌ Tidak ada data pelanggan. Jalankan PelangganSeeder terlebih dahulu.\n";
            return;
        }
        
        if (empty($cabangIds)) {
            DB::table('cabang')->insert([
                'nama_cabang' => 'Cabang Pusat',
                'alamat' => 'Jl. Sudirman No. 1',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $cabangIds = DB::table('cabang')->pluck('id_cabang')->toArray();
        }
        
        if (empty($kasIds)) {
            DB::table('kas')->insert([
                'id_cabang' => $cabangIds[0] ?? 1,
                'referensi' => 'KAS001',
                'jenis_transaksi' => 'SALDO AWAL',
                'jumlah' => 10000000,
                'keterangan' => 'Saldo awal kas',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $kasIds = DB::table('kas')->pluck('id_kas')->toArray();
        }
        
        $transaksiData = [];
        
        // Generate transaksi untuk 7 hari terakhir
        for ($day = 6; $day >= 0; $day--) {
            $date = Carbon::now()->subDays($day);
            
            // Random jumlah transaksi per hari (5-25 transaksi)
            $transaksisPerDay = $faker->numberBetween(5, 25);
            
            for ($i = 0; $i < $transaksisPerDay; $i++) {
                $totalBelanja = $faker->numberBetween(25000, 500000);
                $poinDidapat = floor($totalBelanja / 10000); // 1 poin per 10k
                
                $transaksiData[] = [
                    'id_pelanggan' => $faker->randomElement($pelangganIds),
                    'tanggal_transaksi' => $date->format('Y-m-d'),
                    'total_belanja' => $totalBelanja,
                    'id_cabang' => $faker->randomElement($cabangIds),
                    'poin_yang_didapatkan' => $poinDidapat,
                    'poin_yang_digunakan' => $faker->optional(0.3)->numberBetween(0, min(100, $poinDidapat)), // 30% chance menggunakan poin
                    'id_kas' => $faker->randomElement($kasIds),
                    'created_at' => $date,
                    'updated_at' => $date,
                ];
                
                // Insert dalam batch 50 data untuk performa
                if (count($transaksiData) === 50) {
                    DB::table('transaksi')->insert($transaksiData);
                    $transaksiData = [];
                }
            }
        }
        
        // Insert sisa data jika ada
        if (!empty($transaksiData)) {
            DB::table('transaksi')->insert($transaksiData);
        }
        
        echo "✅ Berhasil membuat data transaksi untuk grafik penjualan!\n";
    }
}
