<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gudang;
use Illuminate\Support\Facades\Hash;

class GudangSeeder extends Seeder
{
    public function run()
    {
        Gudang::create([
            'id_gudang' => '1001',
            'nama_gudang' => 'Gudang Pusat Jakarta',
            'password' => Hash::make('password123'),
            'lokasi' => 'Jakarta',
            'status' => true,
        ]);

        Gudang::create([
            'id_gudang' => '1002', 
            'nama_gudang' => 'Gudang Surabaya',
            'password' => Hash::make('password123'),
            'lokasi' => 'Surabaya',
            'status' => true,
        ]);

        Gudang::create([
            'id_gudang' => '1003',
            'nama_gudang' => 'Gudang Medan',
            'password' => Hash::make('password123'),
            'lokasi' => 'Medan',
            'status' => true,
        ]);
    }
}
