<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokProdukSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil cabang pertama & kategori pertama
        $cabang = DB::table('cabang')->first();
        $kategori = DB::table('kategori')->first();

        if (!$cabang || !$kategori) {
            echo "⚠️ Seeder gagal: pastikan tabel cabang & kategori sudah ada datanya!\n";
            return;
        }

        DB::table('stok_produk')->insert([
            [
                'id_cabang'      => $cabang->id_cabang,
                'id_kategori'    => $kategori->id_kategori,
                'foto'           => '/storage/produk/beras-premium-5kg.jpg',
                'nama_barang'    => 'Beras Premium 5Kg',
                'jumlah_barang'  => 50,
                'harga_jual'     => 75000.00,
                'stok'           => 50,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'id_cabang'      => $cabang->id_cabang,
                'id_kategori'    => $kategori->id_kategori,
                'foto'           => '/storage/produk/minyak-goreng-1l.jpg',
                'nama_barang'    => 'Minyak Goreng 1L',
                'jumlah_barang'  => 100,
                'harga_jual'     => 18000.00,
                'stok'           => 100,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ]);
    }
}
