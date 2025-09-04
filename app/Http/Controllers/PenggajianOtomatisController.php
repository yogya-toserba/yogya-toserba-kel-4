<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gaji;
use App\Models\Karyawan;
use App\Models\Jabatan;
use Carbon\Carbon;

class PenggajianOtomatisController extends Controller
{
    public function index(Request $request)
    {
        $periode = $request->get('periode', now()->format('Y-m'));
        $status = $request->get('status', 'all');

        $query = Gaji::with(['karyawan.jabatan'])
            ->whereYear('periode_gaji', substr($periode, 0, 4))
            ->whereMonth('periode_gaji', substr($periode, 5, 2));

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $gajiList = $query->orderBy('created_at', 'desc')->paginate(15);

        // Statistics
        $stats = [
            'total_karyawan' => Karyawan::whereNotNull('jabatan_id')->count(),
            'total_gaji_pending' => Gaji::byStatus('pending')->whereYear('periode_gaji', substr($periode, 0, 4))->whereMonth('periode_gaji', substr($periode, 5, 2))->count(),
            'total_gaji_approved' => Gaji::byStatus('approved')->whereYear('periode_gaji', substr($periode, 0, 4))->whereMonth('periode_gaji', substr($periode, 5, 2))->count(),
            'total_gaji_paid' => Gaji::byStatus('paid')->whereYear('periode_gaji', substr($periode, 0, 4))->whereMonth('periode_gaji', substr($periode, 5, 2))->count(),
            'total_nominal' => Gaji::whereYear('periode_gaji', substr($periode, 0, 4))->whereMonth('periode_gaji', substr($periode, 5, 2))->sum('total_gaji')
        ];

        return view('admin.penggajian-otomatis', compact('gajiList', 'stats', 'periode', 'status'));
    }

    public function generateGaji(Request $request)
    {
        $periode = $request->get('periode', now()->format('Y-m-01'));

        try {
            $gajiGenerated = Gaji::generateGajiOtomatisSemua($periode);

            return response()->json([
                'success' => true,
                'message' => 'Berhasil generate ' . count($gajiGenerated) . ' gaji karyawan',
                'data' => $gajiGenerated
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function approveGaji($id)
    {
        try {
            $gaji = Gaji::findOrFail($id);
            $gaji->approve();

            return response()->json([
                'success' => true,
                'message' => 'Gaji berhasil di-approve'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function markAsPaid($id)
    {
        try {
            $gaji = Gaji::findOrFail($id);
            $gaji->markAsPaid();

            return response()->json([
                'success' => true,
                'message' => 'Gaji berhasil ditandai sebagai dibayar'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bulkApprove(Request $request)
    {
        $ids = $request->get('ids', []);

        try {
            Gaji::whereIn('id_gaji', $ids)->update(['status' => 'approved']);

            return response()->json([
                'success' => true,
                'message' => 'Berhasil approve ' . count($ids) . ' gaji'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function detail($id)
    {
        $gaji = Gaji::with(['karyawan.jabatan'])->findOrFail($id);

        return view('admin.penggajian-detail', compact('gaji'));
    }

    public function jabatan()
    {
        $jabatanList = Jabatan::active()->orderBy('nama_jabatan')->get();

        return view('admin.jabatan-gaji', compact('jabatanList'));
    }

    public function storeJabatan(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:255',
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan_jabatan' => 'required|numeric|min:0',
            'bonus_kehadiran_per_hari' => 'required|numeric|min:0',
            'minimal_hari_kerja' => 'required|integer|min:1|max:31'
        ]);

        try {
            Jabatan::create($request->all());

            return redirect()->back()->with('success', 'Jabatan berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function updateJabatan(Request $request, $id)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:255',
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan_jabatan' => 'required|numeric|min:0',
            'bonus_kehadiran_per_hari' => 'required|numeric|min:0',
            'minimal_hari_kerja' => 'required|integer|min:1|max:31'
        ]);

        try {
            $jabatan = Jabatan::findOrFail($id);
            $jabatan->update($request->all());

            return redirect()->back()->with('success', 'Jabatan berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function deleteJabatan($id)
    {
        try {
            $jabatan = Jabatan::findOrFail($id);

            // Check if any karyawan is using this jabatan
            if ($jabatan->karyawans()->count() > 0) {
                return redirect()->back()->with('error', 'Tidak dapat menghapus jabatan karena masih ada karyawan yang menggunakan jabatan ini');
            }

            $jabatan->delete();

            return redirect()->back()->with('success', 'Jabatan berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
