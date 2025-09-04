<?php

// Test registrasi pelanggan
require_once 'vendor/autoload.php';

use Illuminate\Support\Facades\DB;
use App\Models\Pelanggan;

// Simulasi data yang akan dikirim form
$testData = [
    'nama_pelanggan' => 'Test User',
    'email' => 'test@example.com',
    'password' => 'password123',
    'tanggal_lahir' => '1990-01-01',
    'jenis_kelamin' => 'L',
    'nomer_telepon' => '081234567890',
    'alamat' => 'Jalan Test No. 123',
];

echo "=== TEST REGISTRASI PELANGGAN ===\n\n";

// Test koneksi database
try {
    $count = DB::table('pelanggan')->count();
    echo "✅ Database terhubung. Total pelanggan: $count\n";
} catch (Exception $e) {
    echo "❌ Koneksi database gagal: " . $e->getMessage() . "\n";
    exit;
}

// Test validasi email unique
$existing = DB::table('pelanggan')->where('email', $testData['email'])->first();
if ($existing) {
    echo "⚠️  Email test sudah ada, akan dihapus untuk testing\n";
    DB::table('pelanggan')->where('email', $testData['email'])->delete();
}

// Test pembuatan pelanggan baru
try {
    $pelanggan = Pelanggan::create([
        'nama_pelanggan' => $testData['nama_pelanggan'],
        'email' => $testData['email'],
        'password' => bcrypt($testData['password']),
        'tanggal_lahir' => $testData['tanggal_lahir'],
        'jenis_kelamin' => $testData['jenis_kelamin'],
        'nomer_telepon' => $testData['nomer_telepon'],
        'alamat' => $testData['alamat'],
        'level_membership' => 'Bronze',
    ]);
    
    echo "✅ Pelanggan berhasil dibuat dengan ID: " . $pelanggan->id_pelanggan . "\n";
    echo "✅ Nama: " . $pelanggan->nama_pelanggan . "\n";
    echo "✅ Email: " . $pelanggan->email . "\n";
    
    // Hapus data test
    $pelanggan->delete();
    echo "✅ Data test berhasil dihapus\n\n";
    
    echo "=== KESIMPULAN ===\n";
    echo "✅ Model Pelanggan berfungsi dengan baik\n";
    echo "✅ Semua field dapat diisi\n";
    echo "✅ Registrasi seharusnya berhasil\n";
    
} catch (Exception $e) {
    echo "❌ Gagal membuat pelanggan: " . $e->getMessage() . "\n";
}
