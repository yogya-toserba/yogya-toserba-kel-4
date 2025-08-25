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

        $this->call(StokGudangPusatSeeder::class);
        $this->call([
            CabangSeeder::class,
        ]);
    }
}
