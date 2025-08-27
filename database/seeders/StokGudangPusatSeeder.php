<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StokGudangPusat;
use Carbon\Carbon;

class StokGudangPusatSeeder extends Seeder
{
    public function run(): void
    {
        StokGudangPusat::create([
            'tanggal' => '2025-08-25',
            'nama_produk' => 'Beras Premium 5kg',
            'kategori' => 'Sembako',
            'deskripsi' => 'Beras berkualitas premium untuk kebutuhan sehari-hari',
            'satuan' => 'Karung',
            'jumlah' => 150,
            'harga_beli' => 65000,
            'harga_jual' => 75000,
            'foto' => 'beras.jpg',
            'status' => 'Tersedia',
            'expired' => Carbon::now()->addMonths(6),
        ]);

        StokGudangPusat::create([
            'tanggal' => '2025-08-25',
            'nama_produk' => 'Minyak Goreng 1L',
            'kategori' => 'Sembako',
            'deskripsi' => 'Minyak goreng kemasan 1 liter untuk memasak',
            'satuan' => 'Botol',
            'jumlah' => 75,
            'harga_beli' => 15000,
            'harga_jual' => 18000,
            'foto' => 'minyak.jpg',
            'status' => 'Tersedia',
            'expired' => Carbon::now()->addMonths(12),
        ]);

        StokGudangPusat::create([
            'tanggal' => '2025-08-25',
            'nama_produk' => 'Gula Pasir 1kg',
            'kategori' => 'Sembako',
            'deskripsi' => 'Gula pasir putih berkualitas baik',
            'satuan' => 'Bungkus',
            'jumlah' => 200,
            'harga_beli' => 12000,
            'harga_jual' => 14000,
            'foto' => 'gula.jpg',
            'status' => 'Tersedia',
            'expired' => null,
        ]);

        StokGudangPusat::create([
            'tanggal' => '2025-08-25',
            'nama_produk' => 'Sabun Mandi 85gr',
            'kategori' => 'Perawatan',
            'deskripsi' => 'Sabun mandi dengan aroma segar',
            'satuan' => 'Batang',
            'jumlah' => 8,
            'harga_beli' => 2500,
            'harga_jual' => 3500,
            'foto' => 'sabun.jpg',
            'status' => 'Stok Rendah',
            'expired' => Carbon::now()->addYears(2),
        ]);

        StokGudangPusat::create([
            'tanggal' => '2025-08-25',
            'nama_produk' => 'Shampo Sachet 12ml',
            'kategori' => 'Perawatan',
            'deskripsi' => 'Shampo kemasan sachet praktis',
            'satuan' => 'Sachet',
            'jumlah' => 0,
            'harga_beli' => 1000,
            'harga_jual' => 1500,
            'foto' => 'shampo.jpg',
            'status' => 'Habis',
            'expired' => Carbon::now()->addMonths(18),
        ]);

        StokGudangPusat::create([
            'tanggal' => '2025-08-25',
            'nama_produk' => 'Susu UHT 250ml',
            'kategori' => 'Minuman',
            'deskripsi' => 'Susu UHT rasa original kemasan kotak',
            'satuan' => 'Kotak',
            'jumlah' => 45,
            'harga_beli' => 4000,
            'harga_jual' => 5000,
            'foto' => 'susu.jpg',
            'status' => 'Tersedia',
            'expired' => Carbon::now()->addDays(15),
        ]);

        StokGudangPusat::create([
            'tanggal' => '2025-08-25',
            'nama_produk' => 'Roti Tawar 400gr',
            'kategori' => 'Makanan',
            'deskripsi' => 'Roti tawar segar untuk sarapan',
            'satuan' => 'Bungkus',
            'jumlah' => 25,
            'harga_beli' => 8000,
            'harga_jual' => 10000,
            'foto' => 'roti.jpg',
            'status' => 'Tersedia',
            'expired' => Carbon::now()->addDays(3),
        ]);

        StokGudangPusat::create([
            'tanggal' => '2025-08-25',
            'nama_produk' => 'Deterjen Bubuk 800gr',
            'kategori' => 'Perawatan',
            'deskripsi' => 'Deterjen bubuk untuk mencuci baju',
            'satuan' => 'Kotak',
            'jumlah' => 90,
            'harga_beli' => 12000,
            'harga_jual' => 15000,
            'foto' => 'deterjen.jpg',
            'status' => 'Tersedia',
            'expired' => null,
        ]);

        StokGudangPusat::create([
            'tanggal' => '2025-08-25',
            'nama_produk' => 'Pasta Gigi 150gr',
            'kategori' => 'Perawatan',
            'deskripsi' => 'Pasta gigi untuk kesehatan mulut',
            'satuan' => 'Tube',
            'jumlah' => 65,
            'harga_beli' => 8000,
            'harga_jual' => 10000,
            'foto' => 'pasta_gigi.jpg',
            'status' => 'Tersedia',
            'expired' => Carbon::now()->addYears(3),
        ]);

        StokGudangPusat::create([
            'tanggal' => '2025-08-25',
            'nama_produk' => 'Kecap Manis 600ml',
            'kategori' => 'Sembako',
            'deskripsi' => 'Kecap manis kemasan botol untuk masakan',
            'satuan' => 'Botol',
            'jumlah' => 120,
            'harga_beli' => 8000,
            'harga_jual' => 10000,
            'foto' => 'kecap.jpg',
            'status' => 'Tersedia',
            'expired' => Carbon::now()->addMonths(8),
        ]);
    }
}
