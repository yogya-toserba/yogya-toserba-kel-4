<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama
        DB::table('pelanggan')->delete();
        
        $faker = Faker::create('id_ID'); // Indonesian locale
        $pelangganData = [];
        
        for ($i = 0; $i < 1000; $i++) {
            $gender = $faker->randomElement(['L', 'P']);
            $firstName = $gender === 'L' ? $faker->firstNameMale : $faker->firstNameFemale;
            $fullName = $firstName . ' ' . $faker->lastName;
            
            $pelangganData[] = [
                'nama_pelanggan' => $fullName,
                'nomer_telepon' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'alamat' => $faker->address,
                'tanggal_lahir' => $faker->dateTimeBetween('-60 years', '-18 years')->format('Y-m-d'),
                'jenis_kelamin' => $gender,
                'password' => bcrypt('password123'), // password default
                'level_membership' => $faker->randomElement(['Bronze', 'Silver', 'Gold', 'Platinum']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            
            // Insert dalam batch 100 data untuk performa
            if (count($pelangganData) === 100) {
                DB::table('pelanggan')->insert($pelangganData);
                $pelangganData = [];
            }
        }
        
        // Insert sisa data jika ada
        if (!empty($pelangganData)) {
            DB::table('pelanggan')->insert($pelangganData);
        }
        
        echo "✅ Berhasil membuat 1000 data pelanggan!\n";
    }
}
