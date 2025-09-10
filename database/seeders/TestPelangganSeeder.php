<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Hash;

class TestPelangganSeeder extends Seeder
{
    public function run()
    {
        // Create 25 test customers for pagination testing
        $customers = [
            ['nama' => 'Ahmad Dani', 'email' => 'ahmad.dani@gmail.com', 'level' => 'Gold', 'jk' => 'L'],
            ['nama' => 'Sari Wulandari', 'email' => 'sari.wulandari@gmail.com', 'level' => 'Silver', 'jk' => 'P'],
            ['nama' => 'Budi Hartanto', 'email' => 'budi.hartanto@gmail.com', 'level' => 'Regular', 'jk' => 'L'],
            ['nama' => 'Maya Fitri', 'email' => 'maya.fitri@gmail.com', 'level' => 'Gold', 'jk' => 'P'],
            ['nama' => 'Rian Pratama', 'email' => 'rian.pratama@gmail.com', 'level' => 'Silver', 'jk' => 'L'],
            ['nama' => 'Putri Nurjanah', 'email' => 'putri.nurjanah@gmail.com', 'level' => 'Gold', 'jk' => 'P'],
            ['nama' => 'Andi Kurniawan', 'email' => 'andi.kurniawan@gmail.com', 'level' => 'Regular', 'jk' => 'L'],
            ['nama' => 'Dewi Sartika', 'email' => 'dewi.sartika@gmail.com', 'level' => 'Silver', 'jk' => 'P'],
            ['nama' => 'Joko Santoso', 'email' => 'joko.santoso@gmail.com', 'level' => 'Regular', 'jk' => 'L'],
            ['nama' => 'Lisa Amelia', 'email' => 'lisa.amelia@gmail.com', 'level' => 'Gold', 'jk' => 'P'],
            ['nama' => 'Bambang Susilo', 'email' => 'bambang.susilo@gmail.com', 'level' => 'Silver', 'jk' => 'L'],
            ['nama' => 'Ratna Sari', 'email' => 'ratna.sari@gmail.com', 'level' => 'Regular', 'jk' => 'P'],
            ['nama' => 'Dimas Prasetyo', 'email' => 'dimas.prasetyo@gmail.com', 'level' => 'Gold', 'jk' => 'L'],
            ['nama' => 'Indira Kusuma', 'email' => 'indira.kusuma@gmail.com', 'level' => 'Silver', 'jk' => 'P'],
            ['nama' => 'Wahyu Nugroho', 'email' => 'wahyu.nugroho@gmail.com', 'level' => 'Regular', 'jk' => 'L'],
            ['nama' => 'Sinta Maharani', 'email' => 'sinta.maharani@gmail.com', 'level' => 'Gold', 'jk' => 'P'],
            ['nama' => 'Agus Setiyawan', 'email' => 'agus.setiyawan@gmail.com', 'level' => 'Silver', 'jk' => 'L'],
            ['nama' => 'Kartika Dewi', 'email' => 'kartika.dewi@gmail.com', 'level' => 'Regular', 'jk' => 'P'],
            ['nama' => 'Fajar Ramadhan', 'email' => 'fajar.ramadhan@gmail.com', 'level' => 'Gold', 'jk' => 'L'],
            ['nama' => 'Anisa Putri', 'email' => 'anisa.putri@gmail.com', 'level' => 'Silver', 'jk' => 'P'],
            ['nama' => 'Rahman Hakim', 'email' => 'rahman.hakim@gmail.com', 'level' => 'Regular', 'jk' => 'L'],
            ['nama' => 'Dina Amalia', 'email' => 'dina.amalia@gmail.com', 'level' => 'Gold', 'jk' => 'P'],
            ['nama' => 'Yudi Setiawan', 'email' => 'yudi.setiawan@gmail.com', 'level' => 'Silver', 'jk' => 'L'],
            ['nama' => 'Eka Pratiwi', 'email' => 'eka.pratiwi@gmail.com', 'level' => 'Regular', 'jk' => 'P'],
            ['nama' => 'Hendra Wijaya', 'email' => 'hendra.wijaya@gmail.com', 'level' => 'Gold', 'jk' => 'L']
        ];

        foreach ($customers as $customer) {
            Pelanggan::create([
                'nama_pelanggan' => $customer['nama'],
                'email' => $customer['email'],
                'nomer_telepon' => '08' . rand(1000000000, 9999999999),
                'password' => Hash::make('password123'),
                'tanggal_lahir' => now()->subYears(rand(20, 60))->subDays(rand(1, 365)),
                'jenis_kelamin' => $customer['jk'],
                'alamat' => 'Jl. Test No. ' . rand(1, 100) . ', Yogyakarta',
                'level_membership' => $customer['level'],
                'created_at' => now()->subDays(rand(1, 365)),
                'updated_at' => now()->subDays(rand(1, 30)),
            ]);
        }
    }
}
