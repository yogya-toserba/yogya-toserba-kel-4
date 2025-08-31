<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pemasok;
use Carbon\Carbon;

class PemasokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama
        Pemasok::truncate();
        
        $pemasoks = [
            [
                'nama_perusahaan' => 'PT Sumber Rezeki',
                'kontak_person' => 'Ahmad Wijaya',
                'telepon' => '021-5551234',
                'email' => 'ahmad@sumberrezeki.com',
                'alamat' => 'Jl. Gatot Subroto No. 45, Jakarta Selatan',
                'kota' => 'Jakarta',
                'kategori_produk' => 'Makanan & Minuman',
                'tanggal_kerjasama' => Carbon::parse('2020-01-15'),
                'status' => 'aktif',
                'catatan' => 'Supplier utama untuk produk makanan dan minuman',
                'rating' => 4.8
            ],
            [
                'nama_perusahaan' => 'CV Berkah Jaya',
                'kontak_person' => 'Siti Nurhaliza',
                'telepon' => '021-7778899',
                'email' => 'siti@berkahjaya.com',
                'alamat' => 'Jl. Sudirman No. 123, Jakarta Pusat',
                'kota' => 'Jakarta',
                'kategori_produk' => 'Elektronik',
                'tanggal_kerjasama' => Carbon::parse('2021-03-20'),
                'status' => 'aktif',
                'catatan' => 'Supplier elektronik dengan kualitas terbaik',
                'rating' => 4.5
            ],
            [
                'nama_perusahaan' => 'PT Cahaya Mandiri',
                'kontak_person' => 'Budi Santoso',
                'telepon' => '031-4445566',
                'email' => 'budi@cahayamandiri.com',
                'alamat' => 'Jl. Tunjungan No. 88, Surabaya',
                'kota' => 'Surabaya',
                'kategori_produk' => 'Fashion & Pakaian',
                'tanggal_kerjasama' => Carbon::parse('2019-08-10'),
                'status' => 'aktif',
                'catatan' => 'Supplier fashion terpercaya dari Surabaya',
                'rating' => 4.7
            ],
            [
                'nama_perusahaan' => 'UD Maju Bersama',
                'kontak_person' => 'Rina Sari',
                'telepon' => '022-9998877',
                'email' => 'rina@majubersama.com',
                'alamat' => 'Jl. Dago No. 234, Bandung',
                'kota' => 'Bandung',
                'kategori_produk' => 'Peralatan Rumah Tangga',
                'tanggal_kerjasama' => Carbon::parse('2022-01-05'),
                'status' => 'aktif',
                'catatan' => 'Supplier peralatan rumah tangga berkualitas',
                'rating' => 4.3
            ],
            [
                'nama_perusahaan' => 'CV Harapan Sejahtera',
                'kontak_person' => 'Dedi Kurniawan',
                'telepon' => '0274-123456',
                'email' => 'dedi@harapansejahtera.com',
                'alamat' => 'Jl. Malioboro No. 67, Yogyakarta',
                'kota' => 'Yogyakarta',
                'kategori_produk' => 'Kerajinan & Souvenir',
                'tanggal_kerjasama' => Carbon::parse('2021-09-12'),
                'status' => 'aktif',
                'catatan' => 'Supplier kerajinan lokal Yogyakarta',
                'rating' => 4.6
            ],
            [
                'nama_perusahaan' => 'PT Sejahtera Abadi',
                'kontak_person' => 'Linda Permata',
                'telepon' => '024-5556677',
                'email' => 'linda@sejahteraabadi.com',
                'alamat' => 'Jl. Pandanaran No. 156, Semarang',
                'kota' => 'Semarang',
                'kategori_produk' => 'Kosmetik & Kecantikan',
                'tanggal_kerjasama' => Carbon::parse('2020-11-30'),
                'status' => 'aktif',
                'catatan' => 'Distributor kosmetik dan produk kecantikan',
                'rating' => 4.4
            ],
            [
                'nama_perusahaan' => 'UD Karya Utama',
                'kontak_person' => 'Hendra Gunawan',
                'telepon' => '061-3334455',
                'email' => 'hendra@karyautama.com',
                'alamat' => 'Jl. Sisingamangaraja No. 99, Medan',
                'kota' => 'Medan',
                'kategori_produk' => 'Otomotif',
                'tanggal_kerjasama' => Carbon::parse('2021-06-18'),
                'status' => 'aktif',
                'catatan' => 'Supplier spare part dan aksesoris otomotif',
                'rating' => 4.2
            ],
            [
                'nama_perusahaan' => 'CV Teknologi Masa Depan',
                'kontak_person' => 'Maya Indrasari',
                'telepon' => '021-8887766',
                'email' => 'maya@tekmasadepan.com',
                'alamat' => 'Jl. Kemang Raya No. 77, Jakarta Selatan',
                'kota' => 'Jakarta',
                'kategori_produk' => 'Komputer & IT',
                'tanggal_kerjasama' => Carbon::parse('2022-02-14'),
                'status' => 'non-aktif',
                'catatan' => 'Kontrak sedang dalam review',
                'rating' => 3.8
            ]
        ];
        
        foreach ($pemasoks as $pemasok) {
            Pemasok::create($pemasok);
        }
        
        echo "✅ Berhasil membuat " . count($pemasoks) . " data pemasok!\n";
    }
}
