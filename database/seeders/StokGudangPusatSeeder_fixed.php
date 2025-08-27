<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StokGudangPusat;
use Carbon\Carbon;

class StokGudangPusatSeeder extends Seeder
{
    public function run(): void
    {
        // Truncate tabel agar data lama terhapus
        StokGudangPusat::truncate();
        
        StokGudangPusat::create([
            'nama_produk' => 'Beras Premium 5kg',
            'satuan' => 'Karung',
            'jumlah' => 150,
            'foto' => 'beras.jpg',
            'expired' => Carbon::now()->addMonths(6),
        ]);

        StokGudangPusat::create([
            'nama_produk' => 'Minyak Goreng 1L',
            'satuan' => 'Botol',
            'jumlah' => 75,
            'foto' => 'minyak.jpg',
            'expired' => Carbon::now()->addMonths(12),
        ]);

        StokGudangPusat::create([
            'nama_produk' => 'Gula Pasir 1kg',
            'satuan' => 'Bungkus',
            'jumlah' => 200,
            'foto' => 'gula.jpg',
            'expired' => Carbon::now()->addMonths(18),
        ]);

        StokGudangPusat::create([
            'nama_produk' => 'Tepung Terigu 1kg',
            'satuan' => 'Bungkus',
            'jumlah' => 100,
            'foto' => 'tepung.jpg',
            'expired' => Carbon::now()->addMonths(8),
        ]);

        StokGudangPusat::create([
            'nama_produk' => 'Garam Dapur 250g',
            'satuan' => 'Bungkus',
            'jumlah' => 300,
            'foto' => 'garam.jpg',
            'expired' => Carbon::now()->addYears(2),
        ]);

        StokGudangPusat::create([
            'nama_produk' => 'Kopi Bubuk 200g',
            'satuan' => 'Bungkus',
            'jumlah' => 80,
            'foto' => 'kopi.jpg',
            'expired' => Carbon::now()->addMonths(10),
        ]);

        StokGudangPusat::create([
            'nama_produk' => 'Teh Celup isi 25',
            'satuan' => 'Kotak',
            'jumlah' => 120,
            'foto' => 'teh.jpg',
            'expired' => Carbon::now()->addMonths(15),
        ]);

        StokGudangPusat::create([
            'nama_produk' => 'Susu UHT 1L',
            'satuan' => 'Kotak',
            'jumlah' => 60,
            'foto' => 'susu.jpg',
            'expired' => Carbon::now()->addMonths(6),
        ]);

        StokGudangPusat::create([
            'nama_produk' => 'Mie Instan Goreng',
            'satuan' => 'Bungkus',
            'jumlah' => 400,
            'foto' => 'mie.jpg',
            'expired' => Carbon::now()->addMonths(12),
        ]);

        StokGudangPusat::create([
            'nama_produk' => 'Sabun Cuci Piring 800ml',
            'satuan' => 'Botol',
            'jumlah' => 50,
            'foto' => 'sabun.jpg',
            'expired' => Carbon::now()->addMonths(24),
        ]);

        StokGudangPusat::create([
            'nama_produk' => 'Deterjen Bubuk 1kg',
            'satuan' => 'Kotak',
            'jumlah' => 70,
            'foto' => 'deterjen.jpg',
            'expired' => Carbon::now()->addMonths(18),
        ]);

        StokGudangPusat::create([
            'nama_produk' => 'Shampo 200ml',
            'satuan' => 'Botol',
            'jumlah' => 90,
            'foto' => 'shampo.jpg',
            'expired' => Carbon::now()->addMonths(30),
        ]);

        StokGudangPusat::create([
            'nama_produk' => 'Pasta Gigi 150g',
            'satuan' => 'Tube',
            'jumlah' => 110,
            'foto' => 'pasta_gigi.jpg',
            'expired' => Carbon::now()->addMonths(24),
        ]);

        StokGudangPusat::create([
            'nama_produk' => 'Tissue Gulung',
            'satuan' => 'Roll',
            'jumlah' => 200,
            'foto' => 'tissue.jpg',
            'expired' => null,
        ]);

        StokGudangPusat::create([
            'nama_produk' => 'Biskuit Kaleng',
            'satuan' => 'Kaleng',
            'jumlah' => 40,
            'foto' => 'biskuit.jpg',
            'expired' => Carbon::now()->addMonths(8),
        ]);
    }
}
