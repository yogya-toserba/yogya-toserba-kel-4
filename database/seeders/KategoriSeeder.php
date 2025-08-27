<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama
        DB::table('kategori')->delete();
        
        $categories = [
            ['nama_kategori' => 'Buku', 'sub_kategori' => 'Alat Tulis'],
            ['nama_kategori' => 'Elektronik', 'sub_kategori' => 'Gadget'],
            ['nama_kategori' => 'Fashion', 'sub_kategori' => 'Pakaian'],
            ['nama_kategori' => 'Kesehatan', 'sub_kategori' => 'Kecantikan'],
            ['nama_kategori' => 'Makanan', 'sub_kategori' => 'Minuman'],
            ['nama_kategori' => 'Olahraga', 'sub_kategori' => 'Fitness'],
            ['nama_kategori' => 'Otomotif', 'sub_kategori' => 'Aksesoris'],
            ['nama_kategori' => 'Perawatan', 'sub_kategori' => 'Pribadi'],
            ['nama_kategori' => 'Rumah Tangga', 'sub_kategori' => 'Peralatan'],
        ];

        foreach ($categories as $category) {
            DB::table('kategori')->insert([
                'nama_kategori' => $category['nama_kategori'],
                'sub_kategori' => $category['sub_kategori'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
