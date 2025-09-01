<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Hapus data lama
        User::truncate();
        Admin::truncate();

        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        Admin::create([
            'name' => 'Admin Yogya',
            'email' => 'admin@yogya.com',
            'password' => Hash::make('admin123'), // Password yang sudah di-hash
        ]);

        $this->call([
            ShiftSeeder::class,
            KaryawanSeeder::class,
            StokGudangPusatSeeder::class,
            CabangSeeder::class,
            KategoriSeeder::class,
            StokProdukSeeder::class,
            PelangganSeeder::class,
            TransaksiKecilSeeder::class,     // Transaksi dengan nominal kecil
        ]);
    }
}
