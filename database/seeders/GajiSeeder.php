<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gaji;
use App\Models\Karyawan;

class GajiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all karyawan
        $karyawanList = Karyawan::all();

        if ($karyawanList->count() == 0) {
            $this->command->info('No karyawan found. Please seed karyawan first.');
            return;
        }

        $gajiData = [
            'Manager' => 8500000,
            'Supervisor' => 6500000,
            'Admin' => 4500000,
            'Kasir' => 3200000,
            'Security' => 3800000,
            'Cleaning Service' => 3000000,
            'Sales' => 3500000,
        ];

        foreach ($karyawanList as $karyawan) {
            // Check if gaji already exists
            $existingGaji = Gaji::where('id_karyawan', $karyawan->id_karyawan)->first();

            if (!$existingGaji) {
                $baseGaji = $gajiData[$karyawan->divisi] ?? 3000000;
                $adjustment = rand(-500000, 1000000); // Random adjustment

                Gaji::create([
                    'id_karyawan' => $karyawan->id_karyawan,
                    'id_absensi' => null, // Set to null since no absensi data yet
                    'jumlah_gaji' => $baseGaji + $adjustment,
                ]);
            }
        }

        $this->command->info('Gaji data seeded successfully!');
    }
}
