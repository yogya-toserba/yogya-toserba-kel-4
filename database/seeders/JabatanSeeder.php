<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
                'gaji_pokok' => 8500000,
                'tunjangan_jabatan' => 1500000,
                'bonus_kehadiran_per_hari' => 50000,
                'minimal_hari_kerja' => 22,
                'deskripsi' => 'Manager yang bertanggung jawab atas operasional',
                'status' => true
            ],
            [
                'nama_jabatan' => 'Supervisor',
                'gaji_pokok' => 6000000,
                'tunjangan_jabatan' => 800000,
                'bonus_kehadiran_per_hari' => 35000,
                'minimal_hari_kerja' => 22,
                'deskripsi' => 'Supervisor yang mengawasi tim',
                'status' => true
            ],
            [
                'nama_jabatan' => 'Admin',
                'gaji_pokok' => 4500000,
                'tunjangan_jabatan' => 500000,
                'bonus_kehadiran_per_hari' => 25000,
                'minimal_hari_kerja' => 22,
                'deskripsi' => 'Admin yang menangani administrasi',
                'status' => true
            ],
            [
                'nama_jabatan' => 'Kasir',
                'gaji_pokok' => 3500000,
                'tunjangan_jabatan' => 300000,
                'bonus_kehadiran_per_hari' => 20000,
                'minimal_hari_kerja' => 22,
                'deskripsi' => 'Kasir yang melayani transaksi',
                'status' => true
            ],
            [
                'nama_jabatan' => 'Security',
                'gaji_pokok' => 3200000,
                'tunjangan_jabatan' => 200000,
                'bonus_kehadiran_per_hari' => 15000,
                'minimal_hari_kerja' => 22,
                'deskripsi' => 'Security yang menjaga keamanan',
                'status' => true
            ],
            [
                'nama_jabatan' => 'Cleaning Service',
                'gaji_pokok' => 2800000,
                'tunjangan_jabatan' => 150000,
                'bonus_kehadiran_per_hari' => 10000,
                'minimal_hari_kerja' => 22,
                'deskripsi' => 'Cleaning service yang menjaga kebersihan',
                'status' => true
            ]
        ];

        foreach ($jabatan as $item) {
            \App\Models\Jabatan::create($item);
        }
    }
}
