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

        // Generate 300 data karyawan menggunakan factory
        Karyawan::factory()->count(300)->create();
        
        $this->command->info('✅ 300 data karyawan berhasil di-seed ke database');
    }
}
