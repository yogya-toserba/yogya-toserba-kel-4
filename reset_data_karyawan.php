<?php
require 'vendor/autoload.php';

$app = require 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Karyawan;
use App\Models\Jabatan;
use App\Models\Absensi;
use Illuminate\Support\Facades\DB;

echo "=== Clearing Existing Data ===\n";

// Clear existing absensi data
Absensi::truncate();
echo "Absensi table cleared.\n";

// Clear existing karyawan data safely (delete instead of truncate)
Karyawan::query()->delete();
echo "Karyawan table cleared.\n";

echo "\n=== Creating Sample Data ===\n";

// Check existing data
use App\Models\Cabang;
use App\Models\Shift;

$cabang = Cabang::first();
$shift = Shift::first();

echo "Using Cabang ID: " . ($cabang ? $cabang->id_cabang : 'none') . "\n";
echo "Using Shift: " . ($shift ? $shift->nama_shift : 'none') . "\n";

// Create sample jabatan if not exist
$jabatan1 = Jabatan::firstOrCreate(['nama_jabatan' => 'Staff'], [
    'gaji_pokok' => 3000000,
    'tunjangan' => 500000
]);

$jabatan2 = Jabatan::firstOrCreate(['nama_jabatan' => 'Supervisor'], [
    'gaji_pokok' => 5000000,
    'tunjangan' => 800000
]);

// Create sample karyawan
$samples = [
    ['K001', 'Ahmad Rizki', 'IT', $jabatan1->id_jabatan],
    ['K002', 'Siti Nurhaliza', 'HRD', $jabatan1->id_jabatan],
    ['K003', 'Budi Santoso', 'Finance', $jabatan2->id_jabatan],
    ['K004', 'Maya Sari', 'Marketing', $jabatan1->id_jabatan],
    ['K005', 'Dedi Kurniawan', 'Operations', $jabatan2->id_jabatan]
];

foreach ($samples as $sample) {
    $data = [
        'id_karyawan' => $sample[0],
        'nama' => $sample[1],
        'divisi' => $sample[2],
        'alamat' => 'Jl. Sample No. 123',
        'email' => strtolower(str_replace(' ', '.', $sample[1])) . '@yogyatoserba.com',
        'tanggal_lahir' => now()->subYears(rand(25, 45))->format('Y-m-d'),
        'nomer_telepon' => '081234567890',
        'jabatan_id' => $sample[3],
        'status' => 'Aktif'
    ];

    // Add cabang and shift if they exist
    if ($cabang) {
        $data['id_cabang'] = $cabang->id_cabang;
    }

    // Try to use any available shift or create default
    $shift_id = DB::table('shift')->value('id_shift');
    if ($shift_id) {
        $data['id_shift'] = $shift_id;
    } else {
        // Create a default shift
        $default_shift = DB::table('shift')->insertGetId([
            'nama_shift' => 'Default',
            'jam_mulai' => '08:00:00',
            'jam_selesai' => '17:00:00',
            'tunjangan_shift' => 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $data['id_shift'] = $default_shift;
    }

    Karyawan::create($data);
    echo "Created: {$sample[1]}\n";
}

echo "Sample karyawan created:\n";
$karyawan = Karyawan::with('jabatan')->get();
foreach ($karyawan as $k) {
    echo "- ID: {$k->id_karyawan}, Nama: {$k->nama}, Jabatan: " . ($k->jabatan ? $k->jabatan->nama_jabatan : 'N/A') . "\n";
}

echo "\n=== Checking Absensi Table ===\n";
echo "Total absensi records: " . Absensi::count() . "\n";

echo "\n=== Setup Complete ===\n";
echo "Data karyawan sudah di-reset dan siap untuk testing absensi.\n";
echo "Silakan test di: http://127.0.0.1:8000/karyawan\n";
echo "Cek hasil di admin: http://127.0.0.1:8000/admin/absensi\n";
