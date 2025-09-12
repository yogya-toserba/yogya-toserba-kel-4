<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Gaji;
use Illuminate\Support\Facades\Session;

class KaryawanGajiController extends Controller
{
    public function index(Request $request)
    {
        // Check if karyawan is logged in via session
        $karyawanId = Session::get('karyawan_id');

        if (!$karyawanId) {
            return redirect()->route('karyawan.login')->with('error', 'Silakan login terlebih dahulu');
        }

        $karyawan = Karyawan::with('jabatan', 'cabang')->findOrFail($karyawanId);

        // Get pagination parameters
        $perPage = $request->get('per_page', 10);
        $search = $request->get('search');

        // Build query for gaji
        $gajiQuery = Gaji::where('id_karyawan', $karyawanId)
            ->with('karyawan.jabatan')
            ->orderBy('periode_gaji', 'desc');

        // Apply search filter if provided
        if ($search) {
            $gajiQuery->where(function ($query) use ($search) {
                $query->where('periode_gaji', 'like', "%{$search}%")
                    ->orWhere('status_pembayaran', 'like', "%{$search}%")
                    ->orWhere('keterangan', 'like', "%{$search}%");
            });
        }

        $gajiData = $gajiQuery->paginate($perPage);

        // Calculate statistics
        $totalGaji = Gaji::where('id_karyawan', $karyawanId)->sum('jumlah_gaji');
        $totalPaid = Gaji::where('id_karyawan', $karyawanId)
            ->where('status_pembayaran', 'paid')
            ->sum('jumlah_gaji');
        $totalPending = Gaji::where('id_karyawan', $karyawanId)
            ->where('status_pembayaran', 'pending')
            ->sum('jumlah_gaji');
        $totalGajiThisYear = Gaji::where('id_karyawan', $karyawanId)
            ->whereYear('created_at', date('Y'))
            ->sum('jumlah_gaji');

        return view('karyawan.gaji.index', compact(
            'karyawan',
            'gajiData',
            'totalGaji',
            'totalPaid',
            'totalPending',
            'totalGajiThisYear',
            'search',
            'perPage'
        ));
    }

    public function detail($id)
    {
        // Check if karyawan is logged in via session
        $karyawanId = Session::get('karyawan_id');

        if (!$karyawanId) {
            return redirect()->route('karyawan.login')->with('error', 'Silakan login terlebih dahulu');
        }

        // Find gaji record and ensure it belongs to the logged in karyawan
        $gaji = Gaji::where('id_gaji', $id)
            ->where('id_karyawan', $karyawanId)
            ->with('karyawan.jabatan', 'karyawan.cabang')
            ->firstOrFail();

        return view('karyawan.gaji.detail', compact('gaji'));
    }

    public function downloadSlip($id)
    {
        // Check if karyawan is logged in via session
        $karyawanId = Session::get('karyawan_id');

        if (!$karyawanId) {
            return redirect()->route('karyawan.login')->with('error', 'Silakan login terlebih dahulu');
        }

        // Find gaji record and ensure it belongs to the logged in karyawan
        $gaji = Gaji::where('id_gaji', $id)
            ->where('id_karyawan', $karyawanId)
            ->where('status_pembayaran', 'paid') // Only allow download for paid salary
            ->with('karyawan.jabatan', 'karyawan.cabang')
            ->firstOrFail();

        // Generate PDF slip gaji (you can implement PDF generation here)
        return view('karyawan.gaji.slip', compact('gaji'));
    }

    public function login()
    {
        return view('karyawan.auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'nama' => 'required|string'
        ]);

        // Simple authentication using email and name
        $karyawan = Karyawan::where('email', $request->email)
            ->where('nama', $request->nama)
            ->where('status', 'aktif')
            ->first();

        if ($karyawan) {
            Session::put('karyawan_id', $karyawan->id_karyawan);
            Session::put('karyawan_nama', $karyawan->nama);
            Session::put('karyawan_email', $karyawan->email);

            return redirect()->route('karyawan.gaji.index')->with('success', 'Login berhasil!');
        }

        return back()->with('error', 'Email atau nama tidak valid atau akun tidak aktif');
    }

    public function logout()
    {
        Session::forget(['karyawan_id', 'karyawan_nama', 'karyawan_email']);
        return redirect()->route('karyawan.login')->with('success', 'Logout berhasil');
    }

    public function dashboard()
    {
        // Check if karyawan is logged in via session
        $karyawanId = Session::get('karyawan_id');

        if (!$karyawanId) {
            return redirect()->route('karyawan.login')->with('error', 'Silakan login terlebih dahulu');
        }

        $karyawan = Karyawan::with('jabatan', 'cabang')->findOrFail($karyawanId);

        // Get recent gaji data
        $recentGaji = Gaji::where('id_karyawan', $karyawanId)
            ->orderBy('periode_gaji', 'desc')
            ->limit(5)
            ->get();

        // Calculate statistics
        $totalGaji = Gaji::where('id_karyawan', $karyawanId)->sum('jumlah_gaji');
        $totalPaid = Gaji::where('id_karyawan', $karyawanId)
            ->where('status_pembayaran', 'paid')
            ->count();
        $totalPending = Gaji::where('id_karyawan', $karyawanId)
            ->where('status_pembayaran', 'pending')
            ->count();
        $thisMonthGaji = Gaji::where('id_karyawan', $karyawanId)
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->sum('jumlah_gaji');

        return view('karyawan.dashboard', compact(
            'karyawan',
            'recentGaji',
            'totalGaji',
            'totalPaid',
            'totalPending',
            'thisMonthGaji'
        ));
    }
}
