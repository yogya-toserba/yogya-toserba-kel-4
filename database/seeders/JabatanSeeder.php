<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jabatan;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jabatan = [
            [
                'nama_jabatan' => 'Manager',
                'gaji_pokok' => 8000000,
                'tunjangan_jabatan' => 2000000,
                'upah_lembur_per_jam' => 50000,
                'bonus_kehadiran_penuh' => 500000,
                'target_hari_kerja' => 22,
                'deskripsi' => 'Manager bertanggung jawab atas operasional cabang',
                'is_active' => true
            ],
            [
                'nama_jabatan' => 'Supervisor',
                'gaji_pokok' => 5000000,
                'tunjangan_jabatan' => 1000000,
                'upah_lembur_per_jam' => 40000,
                'bonus_kehadiran_penuh' => 300000,
                'target_hari_kerja' => 22,
                'deskripsi' => 'Supervisor mengawasi kinerja karyawan',
                'is_active' => true
            ],
            [
                'nama_jabatan' => 'Kasir',
                'gaji_pokok' => 3500000,
                'tunjangan_jabatan' => 500000,
                'upah_lembur_per_jam' => 30000,
                'bonus_kehadiran_penuh' => 200000,
                'target_hari_kerja' => 22,
                'deskripsi' => 'Kasir melayani transaksi pelanggan',
                'is_active' => true
            ],
            [
                'nama_jabatan' => 'Staff Gudang',
                'gaji_pokok' => 3000000,
                'tunjangan_jabatan' => 300000,
                'upah_lembur_per_jam' => 25000,
                'bonus_kehadiran_penuh' => 150000,
                'target_hari_kerja' => 22,
                'deskripsi' => 'Staff gudang mengelola stok barang',
                'is_active' => true
            ],
            [
                'nama_jabatan' => 'Security',
                'gaji_pokok' => 2800000,
                'tunjangan_jabatan' => 200000,
                'upah_lembur_per_jam' => 20000,
                'bonus_kehadiran_penuh' => 100000,
                'target_hari_kerja' => 22,
                'deskripsi' => 'Security menjaga keamanan toko',
                'is_active' => true
            ],
            [
                'nama_jabatan' => 'Cleaning Service',
                'gaji_pokok' => 2500000,
                'tunjangan_jabatan' => 150000,
                'upah_lembur_per_jam' => 15000,
                'bonus_kehadiran_penuh' => 75000,
                'target_hari_kerja' => 22,
                'deskripsi' => 'Cleaning service menjaga kebersihan toko',
                'is_active' => true
            ]
        ];

        foreach ($jabatan as $data) {
            Jabatan::create($data);
        }
    }
}
