<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek apakah admin sudah ada
        if (Admin::count() == 0) {
            Admin::create([
                'name' => 'Super Admin',
                'username' => 'admin',
                'email' => 'admin@yogyatoserba.com',
                'phone' => '08123456789',
                'position' => 'Administrator',
                'bio' => 'Super Administrator Yogya Toserba',
                'password' => Hash::make('admin123'),
            ]);
        }
    }
}
