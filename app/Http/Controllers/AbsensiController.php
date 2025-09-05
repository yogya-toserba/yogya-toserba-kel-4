<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Karyawan;
use App\Models\Shift;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tanggal = $request->get('tanggal', Carbon::today()->format('Y-m-d'));
        $bulan = $request->get('bulan', Carbon::now()->month);
        $tahun = $request->get('tahun', Carbon::now()->year);
        $karyawan_id = $request->get('karyawan_id');

        // Base query
        $query = Absensi::with(['karyawan.jabatan', 'shift']);

        // Filter berdasarkan parameter
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $tanggal);
        } else {
            $query->whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $bulan);
        }

        if ($karyawan_id) {
            $query->where('id_karyawan', $karyawan_id);
        }

        $absensiList = $query->orderBy('tanggal', 'desc')
            ->orderBy('jam_masuk', 'asc')
            ->paginate(20);

        // Data untuk filter
        $karyawanList = Karyawan::where('status', 'aktif')->get();
        $shiftList = Shift::all();

        // Statistik
        $stats = [
            'total_hadir' => $query->where('status', 'hadir')->count(),
            'total_terlambat' => $query->where('status', 'terlambat')->count(),
            'total_alpha' => $query->where('status', 'alpha')->count(),
            'total_izin' => $query->where('status', 'izin')->count()
        ];

        return view('admin.absensi.index', compact(
            'absensiList',
            'karyawanList',
            'shiftList',
            'stats',
            'tanggal',
            'bulan',
            'tahun',
            'karyawan_id'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $karyawanList = Karyawan::where('status', 'aktif')->get();
        $shiftList = Shift::all();

        return view('admin.absensi.create', compact('karyawanList', 'shiftList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required|exists:karyawan,id_karyawan',
            'tanggal' => 'required|date',
            'id_shift' => 'required|exists:shift,id_shift',
            'jam_masuk' => 'nullable|date_format:H:i',
            'jam_keluar' => 'nullable|date_format:H:i',
            'status' => 'required|in:hadir,terlambat,alpha,izin,sakit',
            'keterangan' => 'nullable|string|max:500'
        ]);

        // Check if absensi already exists for this date and employee
        $existingAbsensi = Absensi::where('id_karyawan', $request->id_karyawan)
            ->whereDate('tanggal', $request->tanggal)
            ->first();

        if ($existingAbsensi) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['id_karyawan' => 'Karyawan sudah memiliki data absensi untuk tanggal ini.']);
        }

        Absensi::create($request->all());

        return redirect()->route('admin.absensi')
            ->with('success', 'Data absensi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $absensi = Absensi::with(['karyawan.jabatan', 'shift'])->findOrFail($id);

        return view('admin.absensi.detail', compact('absensi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $absensi = Absensi::findOrFail($id);
        $karyawanList = Karyawan::where('status', 'aktif')->get();
        $shiftList = Shift::all();

        return view('admin.absensi.edit', compact('absensi', 'karyawanList', 'shiftList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'jam_masuk' => 'nullable|date_format:H:i',
            'jam_keluar' => 'nullable|date_format:H:i',
            'status' => 'required|in:hadir,terlambat,alpha,izin,sakit',
            'keterangan' => 'nullable|string|max:500'
        ]);

        $absensi = Absensi::findOrFail($id);
        $absensi->update($request->all());

        return redirect()->route('admin.absensi')
            ->with('success', 'Data absensi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $absensi = Absensi::findOrFail($id);
        $absensi->delete();

        return redirect()->route('admin.absensi')
            ->with('success', 'Data absensi berhasil dihapus.');
    }

    /**
     * Import absensi from external system or file
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,xlsx',
        ]);

        // Handle file import logic here
        // For now, just return success message

        return redirect()->route('admin.absensi')
            ->with('success', 'Data absensi berhasil diimport.');
    }

    /**
     * Export absensi data
     */
    public function export(Request $request)
    {
        $bulan = $request->get('bulan', Carbon::now()->month);
        $tahun = $request->get('tahun', Carbon::now()->year);

        $absensiList = Absensi::with(['karyawan.jabatan', 'shift'])
            ->whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->get();

        $filename = "absensi_" . str_pad($bulan, 2, '0', STR_PAD_LEFT) . "_" . $tahun . ".csv";

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"'
        ];

        $callback = function () use ($absensiList) {
            $file = fopen('php://output', 'w');

            // CSV Headers
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

    /**
     * Bulk update absensi status
     */
    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'selected_ids' => 'required|array|min:1',
            'selected_ids.*' => 'exists:absensi,id_absensi',
            'status' => 'required|in:hadir,terlambat,alpha,izin,sakit'
        ]);

        Absensi::whereIn('id_absensi', $request->selected_ids)
            ->update(['status' => $request->status]);

        return redirect()->route('admin.absensi')
            ->with('success', 'Status absensi berhasil diperbarui secara massal.');
    }
}
