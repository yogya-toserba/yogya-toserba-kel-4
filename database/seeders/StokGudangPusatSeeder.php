<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokGudangPusatSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('stok_gudang_pusat')->insert([
            [
                'tanggal'     => now()->toDateString(),
                'nama_produk' => 'Beras Premium 5Kg',
                'kategori'    => 'Sembako',
                'satuan'      => 'Karung',
                'jumlah'      => 100,
                'foto'        => '/storage/produk/beras-premium-5kg.jpg', // URL lokal
                'harga_jual'  => 75000,
                'harga_beli'  => 65000,
                'deskripsi'   => 'Beras premium kualitas terbaik',
                'status'      => 'Tersedia',
                'expired'     => '2026-12-31',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'tanggal'     => now()->toDateString(),
                'nama_produk' => 'Minyak Goreng 1L',
                'kategori'    => 'Sembako',
                'satuan'      => 'Botol',
                'jumlah'      => 200,
                'foto'        => '/storage/produk/minyak-goreng-1l.jpg',
                'harga_jual'  => 18000,
                'harga_beli'  => 15000,
                'deskripsi'   => 'Minyak goreng sawit 1 liter',
                'status'      => 'Tersedia',
                'expired'     => '2026-05-01',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'tanggal'     => now()->toDateString(),
                'nama_produk' => 'Mie Instan Rasa Ayam',
                'kategori'    => 'Makanan Ringan',
                'satuan'      => 'Dus',
                'jumlah'      => 300,
                'foto'        => '/storage/produk/mie-instan-ayam.jpg',
                'harga_jual'  => 2500,
                'harga_beli'  => 2000,
                'deskripsi'   => 'Mie instan rasa ayam favorit keluarga',
                'status'      => 'Tersedia',
                'expired'     => '2027-01-15',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
