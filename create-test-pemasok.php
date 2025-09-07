<?php

require_once 'vendor/autoload.php';

use App\Models\Pemasok;
use App\Models\PemasokUser;
use Illuminate\Support\Facades\Hash;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Buat pemasok test
$pemasok = Pemasok::create([
  'nama_perusahaan' => 'PT Test Supplier Indonesia',
  'kontak_person' => 'Budi Santoso',
  'jabatan' => 'Manager Penjualan',
  'telepon' => '081234567890',
  'email' => 'budi@testsupplier.com',
  'alamat' => 'Jl. Industri No. 123, Jakarta Timur',
  'kota' => 'Jakarta',
  'kategori_produk' => 'Makanan & Minuman',
  'tanggal_kerjasama' => '2024-01-15',
  'status' => 'aktif',
  'catatan' => 'Supplier utama untuk kategori makanan ringan',
  'rating' => 4.5
]);

echo "Pemasok created with ID: " . $pemasok->id_pemasok . "\n";

// Buat user untuk pemasok
$plainPassword = 'supplier123';
$user = PemasokUser::create([
  'pemasok_id' => $pemasok->id_pemasok,
  'username' => 'testsupplier',
  'email' => 'login@testsupplier.com',
  'password' => Hash::make($plainPassword),
  'plain_password' => $plainPassword,
  'nama_lengkap' => 'Budi Santoso',
  'telepon' => '081234567890',
  'status' => 'aktif'
]);

echo "PemasokUser created with username: " . $user->username . "\n";
echo "Plain password: " . $plainPassword . "\n";

// Buat pemasok kedua
$pemasok2 = Pemasok::create([
  'nama_perusahaan' => 'CV Sumber Rejeki',
  'kontak_person' => 'Siti Rahayu',
  'jabatan' => 'Owner',
  'telepon' => '081987654321',
  'email' => 'siti@sumberrejeki.com',
  'alamat' => 'Jl. Raya Bogor No. 456, Depok',
  'kota' => 'Depok',
  'kategori_produk' => 'Peralatan Rumah Tangga',
  'tanggal_kerjasama' => '2024-02-20',
  'status' => 'aktif',
  'catatan' => 'Supplier untuk peralatan dapur dan rumah tangga',
  'rating' => 4.8
]);

echo "Pemasok 2 created with ID: " . $pemasok2->id_pemasok . "\n";

// Buat user untuk pemasok kedua
$plainPassword2 = 'rejeki2024';
$user2 = PemasokUser::create([
  'pemasok_id' => $pemasok2->id_pemasok,
  'username' => 'sumberrejeki',
  'email' => 'login@sumberrejeki.com',
  'password' => Hash::make($plainPassword2),
  'plain_password' => $plainPassword2,
  'nama_lengkap' => 'Siti Rahayu',
  'telepon' => '081987654321',
  'status' => 'aktif'
]);

echo "PemasokUser 2 created with username: " . $user2->username . "\n";
echo "Plain password 2: " . $plainPassword2 . "\n";

echo "Test data created successfully!\n";
