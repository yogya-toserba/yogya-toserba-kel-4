<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;
use App\Models\Gaji;
use App\Models\Karyawan;
use Carbon\Carbon;

echo "=== Debug Generate Gaji Otomatis ===\n";

// Check table structure
echo "\n=== Struktur Table Gaji ===\n";
$columns = DB::select('DESCRIBE gaji');
foreach ($columns as $col) {
    echo $col->Field . ' - ' . $col->Type . ' - ' . ($col->Null == 'YES' ? 'NULL' : 'NOT NULL') . "\n";
}

// Check karyawan data
echo "\n=== Data Karyawan ===\n";
$karyawan = Karyawan::with(['jabatan', 'shift'])->where('status', true)->get();
echo "Total karyawan aktif: " . $karyawan->count() . "\n";

foreach ($karyawan as $kar) {
    echo "- ID: {$kar->id_karyawan}, Nama: {$kar->nama}, Jabatan: " . ($kar->jabatan->nama_jabatan ?? 'NULL') . "\n";
}

// Test create gaji
echo "\n=== Test Create Gaji ===\n";
if ($karyawan->count() > 0) {
    $testKar = $karyawan->first();
    $periode = Carbon::create(2025, 9, 1);
    
    try {
        // Check existing
        $existing = Gaji::where('id_karyawan', $testKar->id_karyawan)
            ->where('periode_gaji', $periode->format('Y-m'))
            ->first();
            
        if ($existing) {
            echo "Gaji sudah ada untuk {$testKar->nama} periode {$periode->format('Y-m')}\n";
        } else {
            echo "Mencoba create gaji untuk {$testKar->nama}...\n";
            
            $gajiPokok = $testKar->jabatan->gaji_pokok ?? 3000000;
            $tunjangan = 350000;
            $bonus = 0;
            $potongan = $gajiPokok * 0.09;
            $jumlahGaji = $gajiPokok + $tunjangan + $bonus - $potongan;
            
            $newGaji = Gaji::create([
                'id_karyawan' => $testKar->id_karyawan,
                'periode_gaji' => $periode->format('Y-m'),
                'gaji_pokok' => $gajiPokok,
                'tunjangan' => $tunjangan,
                'bonus' => $bonus,
                'potongan' => $potongan,
                'jumlah_gaji' => $jumlahGaji,
                'status_pembayaran' => 'pending',
                'is_auto_generated' => true
            ]);
            
            echo "✅ Berhasil create gaji ID: {$newGaji->id_gaji}\n";
        }
    } catch (\Exception $e) {
        echo "❌ Error: " . $e->getMessage() . "\n";
        echo "File: " . $e->getFile() . " Line: " . $e->getLine() . "\n";
    }
}
