<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KaryawanSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan shift sudah ada
        if (DB::table('shift')->count() == 0) {
            $this->call(ShiftSeeder::class);
        }

        // Clear existing karyawan data
        DB::table('karyawan')->delete();

        // Data karyawan terbaru dengan divisi dan nama yang realistis
        $karyawanData = [
            // Management - September 2025
            ['nama' => 'Rizki Pratama', 'email' => 'rizki.pratama@myyogya.com', 'divisi' => 'General Manager', 'created_at' => '2025-09-11'],
            ['nama' => 'Sari Dewi Lestari', 'email' => 'sari.dewi@myyogya.com', 'divisi' => 'Store Manager', 'created_at' => '2025-09-10'],
            ['nama' => 'Ahmad Fauzi', 'email' => 'ahmad.fauzi@myyogya.com', 'divisi' => 'Assistant Manager', 'created_at' => '2025-09-09'],

            // Sales & Kasir - September 2025
            ['nama' => 'Maya Sari Putri', 'email' => 'maya.sari@myyogya.com', 'divisi' => 'Senior Kasir', 'created_at' => '2025-09-08'],
            ['nama' => 'Budi Santoso', 'email' => 'budi.santoso@myyogya.com', 'divisi' => 'Kasir', 'created_at' => '2025-09-07'],
            ['nama' => 'Indah Permata', 'email' => 'indah.permata@myyogya.com', 'divisi' => 'Sales Associate', 'created_at' => '2025-09-06'],
            ['nama' => 'Andi Wijaya', 'email' => 'andi.wijaya@myyogya.com', 'divisi' => 'Pramuniaga', 'created_at' => '2025-09-05'],

            // IT & Technology - September 2025
            ['nama' => 'Reza Firmansyah', 'email' => 'reza.firmansyah@myyogya.com', 'divisi' => 'IT Manager', 'created_at' => '2025-09-04'],
            ['nama' => 'Dina Marlina', 'email' => 'dina.marlina@myyogya.com', 'divisi' => 'Web Developer', 'created_at' => '2025-09-03'],
            ['nama' => 'Fajar Nugroho', 'email' => 'fajar.nugroho@myyogya.com', 'divisi' => 'IT Support', 'created_at' => '2025-09-02'],

            // Customer Service - September 2025
            ['nama' => 'Lestari Wulandari', 'email' => 'lestari.wulandari@myyogya.com', 'divisi' => 'Customer Service', 'created_at' => '2025-09-01'],
            ['nama' => 'Agung Prasetyo', 'email' => 'agung.prasetyo@myyogya.com', 'divisi' => 'Customer Care', 'created_at' => '2025-08-31'],

            // Security - Agustus 2025
            ['nama' => 'Teguh Supriyanto', 'email' => 'teguh.supriyanto@myyogya.com', 'divisi' => 'Security Supervisor', 'created_at' => '2025-08-30'],
            ['nama' => 'Hendra Kurniawan', 'email' => 'hendra.kurniawan@myyogya.com', 'divisi' => 'Security', 'created_at' => '2025-08-29'],

            // Warehouse & Logistics - Agustus 2025
            ['nama' => 'Wahyu Hidayat', 'email' => 'wahyu.hidayat@myyogya.com', 'divisi' => 'Warehouse Staff', 'created_at' => '2025-08-28'],
            ['nama' => 'Putri Rahayu', 'email' => 'putri.rahayu@myyogya.com', 'divisi' => 'Inventory Control', 'created_at' => '2025-08-27'],

            // Administration - Agustus 2025
            ['nama' => 'Dewi Sartika', 'email' => 'dewi.sartika@myyogya.com', 'divisi' => 'HRD', 'created_at' => '2025-08-26'],
            ['nama' => 'Bambang Setiawan', 'email' => 'bambang.setiawan@myyogya.com', 'divisi' => 'Finance', 'created_at' => '2025-08-25'],
            ['nama' => 'Eka Yunita', 'email' => 'eka.yunita@myyogya.com', 'divisi' => 'Accounting', 'created_at' => '2025-08-24'],

            // Marketing - Agustus 2025
            ['nama' => 'Joko Susilo', 'email' => 'joko.susilo@myyogya.com', 'divisi' => 'Marketing', 'created_at' => '2025-08-23'],
            ['nama' => 'Nina Puspita', 'email' => 'nina.puspita@myyogya.com', 'divisi' => 'Social Media Specialist', 'created_at' => '2025-08-22'],

            // Maintenance - Agustus 2025
            ['nama' => 'Sugeng Riyadi', 'email' => 'sugeng.riyadi@myyogya.com', 'divisi' => 'Maintenance', 'created_at' => '2025-08-21'],
            ['nama' => 'Tuti Handayani', 'email' => 'tuti.handayani@myyogya.com', 'divisi' => 'Cleaning Service', 'created_at' => '2025-08-20'],
        ];

        // Insert data dengan detail lengkap
        foreach ($karyawanData as $index => $data) {
            Karyawan::create([
                'nama' => $data['nama'],
                'email' => $data['email'],
                'divisi' => $data['divisi'],
                'alamat' => $this->generateAlamat(),
                'tanggal_lahir' => $this->generateTanggalLahir(),
                'nomer_telepon' => $this->generateNomorTelepon(),
                'id_shift' => rand(1, 10), // Random shift dari 1-10
                'status' => 'Aktif',
                'created_at' => $data['created_at'] . ' ' . rand(8, 17) . ':' . rand(10, 59) . ':00',
                'updated_at' => now(),
            ]);
        }

        $this->command->info('✅ Data karyawan terbaru berhasil di-seed ke database');
    }

    private function generateAlamat()
    {
        $jalan = ['Jl. Malioboro', 'Jl. Gejayan', 'Jl. Kaliurang', 'Jl. Solo', 'Jl. Parangtritis', 'Jl. Magelang'];
        $nomor = rand(10, 999);
        $kelurahan = ['Gondokusuman', 'Jetis', 'Tegalrejo', 'Mergangsan', 'Umbulharjo', 'Kotagede'];

        return $jalan[array_rand($jalan)] . ' No. ' . $nomor . ', ' . $kelurahan[array_rand($kelurahan)] . ', Yogyakarta';
    }

    private function generateTanggalLahir()
    {
        $year = rand(1985, 2005); // Umur 20-40 tahun
        $month = rand(1, 12);
        $day = rand(1, 28);

        return sprintf('%04d-%02d-%02d', $year, $month, $day);
    }

    private function generateNomorTelepon()
    {
        return '08' . rand(10000000, 99999999);
    }
}
