<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CabangSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cabang')->insert([
            [
                'id_cabang'   => 101,
                'nama_cabang' => 'Cabang Bandung',
                'kategori'    => 'Supermarket',
                'alamat'      => 'Jl. Asia Afrika No. 10, Bandung',
                'wilayah'     => 'Bandung',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'id_cabang'   => 102,
                'nama_cabang' => 'Cabang Jakarta Selatan',
                'kategori'    => 'Hypermarket',
                'alamat'      => 'Jl. Sudirman No. 25, Jakarta Selatan',
                'wilayah'     => 'Jakarta',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'id_cabang'   => 103,
                'nama_cabang' => 'Cabang Yogyakarta',
                'kategori'    => 'Mini Market',
                'alamat'      => 'Jl. Malioboro No. 88, Yogyakarta',
                'wilayah'     => 'Yogyakarta',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
