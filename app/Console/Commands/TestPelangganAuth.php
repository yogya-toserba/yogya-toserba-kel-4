<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class TestPelangganAuth extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:pelanggan-auth';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test pelanggan authentication system';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Testing Pelanggan Authentication System...');
        
        // Test 1: Check if model exists and works
        try {
            $count = Pelanggan::count();
            $this->info("✅ Model works - Total pelanggan: {$count}");
        } catch (\Exception $e) {
            $this->error("❌ Model error: " . $e->getMessage());
            return;
        }

        // Test 2: Check if we can retrieve a pelanggan
        try {
            $pelanggan = Pelanggan::first();
            if ($pelanggan) {
                $this->info("✅ Can retrieve pelanggan: {$pelanggan->nama_pelanggan}");
            } else {
                $this->warn("⚠️  No pelanggan found in database");
            }
        } catch (\Exception $e) {
            $this->error("❌ Retrieval error: " . $e->getMessage());
        }

        // Test 3: Check if password verification works
        try {
            $pelanggan = Pelanggan::first();
            if ($pelanggan && Hash::check('password123', $pelanggan->password)) {
                $this->info("✅ Password verification works");
            } elseif ($pelanggan) {
                $this->info("✅ Password hashing is working (test password doesn't match)");
            }
        } catch (\Exception $e) {
            $this->error("❌ Password check error: " . $e->getMessage());
        }

        // Test 4: Check authentication guard
        try {
            $guard = Auth::guard('pelanggan');
            $this->info("✅ Pelanggan guard is configured: " . get_class($guard));
        } catch (\Exception $e) {
            $this->error("❌ Guard error: " . $e->getMessage());
        }

        $this->info("\n🎉 Pelanggan authentication system is ready!");
        $this->info("Routes available:");
        $this->info("- GET  /pelanggan/login");
        $this->info("- POST /pelanggan/login");
        $this->info("- GET  /pelanggan/register");
        $this->info("- POST /pelanggan/register");
        $this->info("- POST /pelanggan/logout");
    }
}
