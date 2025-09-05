<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Gaji;
use App\Models\Karyawan;
use App\Models\Absensi;
use App\Models\Jabatan;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.laporan.index');
    }

    /**
     * Laporan Keuangan
     */
    public function keuangan(Request $request)
    {
        $bulan = $request->get('bulan', Carbon::now()->month);
        $tahun = $request->get('tahun', Carbon::now()->year);

        // Data Transaksi
        $transaksi = Transaksi::whereYear('created_at', $tahun)
            ->whereMonth('created_at', $bulan)
            ->get();

        // Data Gaji
        $gaji = Gaji::where('periode_gaji', $tahun . '-' . str_pad($bulan, 2, '0', STR_PAD_LEFT))
            ->get();

        $pendapatan = $transaksi->sum('total_harga');
        $pengeluaran_gaji = $gaji->sum('jumlah_gaji');
        $laba_rugi = $pendapatan - $pengeluaran_gaji;

        // Chart data
        $chartData = [
            'pendapatan' => $pendapatan,
            'pengeluaran' => $pengeluaran_gaji,
            'laba_rugi' => $laba_rugi
        ];

        return view('admin.laporan.keuangan', compact(
            'transaksi',
            'gaji',
            'chartData',
            'bulan',
            'tahun',
            'pendapatan',
            'pengeluaran_gaji',
            'laba_rugi'
        ));
    }

    /**
     * Laporan Gaji
     */
    public function gaji(Request $request)
    {
        $bulan = $request->get('bulan', Carbon::now()->month);
        $tahun = $request->get('tahun', Carbon::now()->year);
        $jabatan_id = $request->get('jabatan_id');

        $query = Gaji::with(['karyawan.jabatan'])
            ->where('periode_gaji', $tahun . '-' . str_pad($bulan, 2, '0', STR_PAD_LEFT));

        if ($jabatan_id) {
            $query->whereHas('karyawan', function ($q) use ($jabatan_id) {
                $q->where('jabatan_id', $jabatan_id);
            });
        }

        $gajiList = $query->get();
        $jabatanList = Jabatan::where('is_active', true)->get();

        // Statistik
        $stats = [
            'total_gaji' => $gajiList->sum('jumlah_gaji'),
            'rata_rata' => $gajiList->avg('jumlah_gaji'),
            'tertinggi' => $gajiList->max('jumlah_gaji'),
            'terendah' => $gajiList->min('jumlah_gaji'),
            'total_karyawan' => $gajiList->count()
        ];

        // Laporan per jabatan
        $laporanJabatan = $gajiList->groupBy('karyawan.jabatan.nama_jabatan')
            ->map(function ($items, $jabatan) {
                return [
                    'jabatan' => $jabatan,
                    'jumlah_karyawan' => $items->count(),
                    'total_gaji' => $items->sum('jumlah_gaji'),
                    'rata_rata' => $items->avg('jumlah_gaji')
                ];
            });

        return view('admin.laporan.gaji', compact(
            'gajiList',
            'jabatanList',
            'stats',
            'laporanJabatan',
            'bulan',
            'tahun',
            'jabatan_id'
        ));
    }

    /**
     * Laporan Absensi
     */
    public function absensi(Request $request)
    {
        $bulan = $request->get('bulan', Carbon::now()->month);
        $tahun = $request->get('tahun', Carbon::now()->year);
        $karyawan_id = $request->get('karyawan_id');

        $query = Absensi::with(['karyawan.jabatan', 'shift'])
            ->whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan);

        if ($karyawan_id) {
            $query->where('id_karyawan', $karyawan_id);
        }

        $absensiList = $query->get();
        $karyawanList = Karyawan::where('status', 'aktif')->get();

        // Statistik
        $stats = [
            'total_hadir' => $absensiList->where('status', 'hadir')->count(),
            'total_terlambat' => $absensiList->where('status', 'terlambat')->count(),
            'total_alpha' => $absensiList->where('status', 'alpha')->count(),
            'total_izin' => $absensiList->where('status', 'izin')->count(),
            'total_sakit' => $absensiList->where('status', 'sakit')->count()
        ];

        // Laporan per karyawan
        $laporanKaryawan = $absensiList->groupBy('karyawan.nama')
            ->map(function ($items, $nama) {
                return [
                    'nama' => $nama,
                    'hadir' => $items->where('status', 'hadir')->count(),
                    'terlambat' => $items->where('status', 'terlambat')->count(),
                    'alpha' => $items->where('status', 'alpha')->count(),
                    'izin' => $items->where('status', 'izin')->count(),
                    'sakit' => $items->where('status', 'sakit')->count(),
                    'total' => $items->count()
                ];
            });

        return view('admin.laporan.absensi', compact(
            'absensiList',
            'karyawanList',
            'stats',
            'laporanKaryawan',
            'bulan',
            'tahun',
            'karyawan_id'
        ));
    }

    /**
     * Laporan Karyawan
     */
    public function karyawan(Request $request)
    {
        $status = $request->get('status', 'aktif');
        $jabatan_id = $request->get('jabatan_id');

        $query = Karyawan::with(['jabatan', 'cabang']);

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        if ($jabatan_id) {
            $query->where('jabatan_id', $jabatan_id);
        }

        $karyawanList = $query->get();
        $jabatanList = Jabatan::where('is_active', true)->get();

        // Statistik
        $stats = [
            'total_aktif' => Karyawan::where('status', 'aktif')->count(),
            'total_nonaktif' => Karyawan::where('status', 'nonaktif')->count(),
            'total_semua' => Karyawan::count()
        ];

        // Laporan per jabatan
        $laporanJabatan = $karyawanList->groupBy('jabatan.nama_jabatan')
            ->map(function ($items, $jabatan) {
                return [
                    'jabatan' => $jabatan ?: 'Belum ada jabatan',
                    'jumlah' => $items->count()
                ];
            });

        return view('admin.laporan.karyawan', compact(
            'karyawanList',
            'jabatanList',
            'stats',
            'laporanJabatan',
            'status',
            'jabatan_id'
        ));
    }

    /**
     * Export laporan ke Excel/CSV
     */
    public function export(Request $request)
    {
        $type = $request->get('type'); // gaji, absensi, karyawan, keuangan
        $format = $request->get('format', 'csv'); // csv, xlsx
        $bulan = $request->get('bulan', Carbon::now()->month);
        $tahun = $request->get('tahun', Carbon::now()->year);

        switch ($type) {
            case 'gaji':
                return $this->exportGaji($bulan, $tahun, $format);
            case 'absensi':
                return $this->exportAbsensi($bulan, $tahun, $format);
            case 'karyawan':
                return $this->exportKaryawan($format);
            case 'keuangan':
                return $this->exportKeuangan($bulan, $tahun, $format);
            default:
                return redirect()->back()->with('error', 'Tipe laporan tidak valid.');
        }
    }

    private function exportGaji($bulan, $tahun, $format)
    {
        $gajiList = Gaji::with(['karyawan.jabatan'])
            ->where('periode_gaji', $tahun . '-' . str_pad($bulan, 2, '0', STR_PAD_LEFT))
            ->get();

        $filename = "laporan_gaji_" . str_pad($bulan, 2, '0', STR_PAD_LEFT) . "_" . $tahun . ".csv";

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"'
        ];

        $callback = function () use ($gajiList) {
            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'Nama Karyawan',
                'Jabatan',
                'Periode',
                'Gaji Pokok',
                'Tunjangan',
                'Bonus',
                'Potongan',
                'Total Gaji'
            ]);

            foreach ($gajiList as $gaji) {
                fputcsv($file, [
                    $gaji->karyawan->nama ?? 'N/A',
                    $gaji->karyawan->jabatan->nama_jabatan ?? 'N/A',
                    $gaji->periode_gaji,
                    $gaji->gaji_pokok,
                    $gaji->tunjangan,
                    $gaji->bonus,
                    $gaji->potongan,
                    $gaji->jumlah_gaji
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function exportAbsensi($bulan, $tahun, $format)
    {
        $absensiList = Absensi::with(['karyawan.jabatan', 'shift'])
            ->whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->get();

        $filename = "laporan_absensi_" . str_pad($bulan, 2, '0', STR_PAD_LEFT) . "_" . $tahun . ".csv";

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"'
        ];

        $callback = function () use ($absensiList) {
            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'Tanggal',
                'Nama Karyawan',
                'Jabatan',
                'Shift',
                'Jam Masuk',
                'Jam Keluar',
                'Status',
                'Keterangan'
            ]);

            foreach ($absensiList as $absensi) {
                fputcsv($file, [
                    $absensi->tanggal,
                    $absensi->karyawan->nama ?? 'N/A',
                    $absensi->karyawan->jabatan->nama_jabatan ?? 'N/A',
                    $absensi->shift->nama_shift ?? 'N/A',
                    $absensi->jam_masuk,
                    $absensi->jam_keluar,
                    ucfirst($absensi->status),
                    $absensi->keterangan
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function exportKaryawan($format)
    {
        $karyawanList = Karyawan::with(['jabatan', 'cabang'])->get();

        $filename = "laporan_karyawan_" . date('Y_m_d') . ".csv";

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"'
        ];

        $callback = function () use ($karyawanList) {
            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'Nama',
                'Divisi',
                'Jabatan',
                'Cabang',
                'Email',
                'No. Telepon',
                'Alamat',
                'Tanggal Lahir',
                'Status'
            ]);

            foreach ($karyawanList as $karyawan) {
                fputcsv($file, [
                    $karyawan->nama,
                    $karyawan->divisi,
                    $karyawan->jabatan->nama_jabatan ?? 'N/A',
                    $karyawan->cabang->nama_cabang ?? 'Pusat',
                    $karyawan->email,
                    $karyawan->nomer_telepon,
                    $karyawan->alamat,
                    $karyawan->tanggal_lahir,
                    ucfirst($karyawan->status)
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function exportKeuangan($bulan, $tahun, $format)
    {
        $transaksi = Transaksi::whereYear('created_at', $tahun)
            ->whereMonth('created_at', $bulan)
            ->get();

        $gaji = Gaji::where('periode_gaji', $tahun . '-' . str_pad($bulan, 2, '0', STR_PAD_LEFT))
            ->get();

        $filename = "laporan_keuangan_" . str_pad($bulan, 2, '0', STR_PAD_LEFT) . "_" . $tahun . ".csv";

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"'
        ];

        $callback = function () use ($transaksi, $gaji) {
            $file = fopen('php://output', 'w');

            fputcsv($file, ['LAPORAN KEUANGAN']);
            fputcsv($file, ['Periode', date('F Y')]);
            fputcsv($file, []);

            fputcsv($file, ['PENDAPATAN']);
            fputcsv($file, ['Tanggal', 'Total Transaksi', 'Jumlah']);

            foreach ($transaksi as $t) {
                fputcsv($file, [
                    $t->created_at->format('Y-m-d'),
                    1,
                    $t->total_harga
                ]);
            }

            fputcsv($file, []);
            fputcsv($file, ['PENGELUARAN - GAJI']);
            fputcsv($file, ['Karyawan', 'Jabatan', 'Gaji']);

            foreach ($gaji as $g) {
                fputcsv($file, [
                    $g->karyawan->nama ?? 'N/A',
                    $g->karyawan->jabatan->nama_jabatan ?? 'N/A',
                    $g->jumlah_gaji
                ]);
            }

            fputcsv($file, []);
            fputcsv($file, ['RINGKASAN']);
            fputcsv($file, ['Total Pendapatan', $transaksi->sum('total_harga')]);
            fputcsv($file, ['Total Pengeluaran Gaji', $gaji->sum('jumlah_gaji')]);
            fputcsv($file, ['Laba/Rugi', $transaksi->sum('total_harga') - $gaji->sum('jumlah_gaji')]);

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
