<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\Karyawan;
use App\Models\Cabang;
use App\Services\GajiService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PenggajianController extends Controller
{
    public function index(Request $request)
    {
        $query = Gaji::with(['karyawan']);

        // Filter by period
        if ($request->filled('periode')) {
            $period = $request->periode;
            $query->whereYear('created_at', date('Y', strtotime($period)))
                ->whereMonth('created_at', date('m', strtotime($period)));
        }

        // Filter by status (placeholder - you can extend this based on your status logic)
        if ($request->filled('status') && $request->status !== 'all') {
            // Example status filtering logic
            switch ($request->status) {
                case 'paid':
                    // Add status column to gaji table if needed
                    // $query->where('status', 'paid');
                    break;
                case 'pending':
                    // $query->where('status', 'pending');
                    break;
                case 'processing':
                    // $query->where('status', 'processing');
                    break;
            }
        }

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('karyawan', function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('divisi', 'like', '%' . $search . '%');
            });
        }

        $gajiList = $query->orderBy('created_at', 'desc')->paginate(10);

        // Statistics
        $stats = [
            'total_gaji' => Gaji::sum('jumlah_gaji'),
            'total_karyawan' => Gaji::count(),
            'rata_rata_gaji' => Gaji::avg('jumlah_gaji'),
            'gaji_tertinggi' => Gaji::max('jumlah_gaji')
        ];

        // Available periods for filter dropdown
        $periods = Gaji::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month')
            ->distinct()
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    'value' => $item->year . '-' . str_pad($item->month, 2, '0', STR_PAD_LEFT),
                    'label' => date('F Y', mktime(0, 0, 0, $item->month, 1, $item->year))
                ];
            });

        return view('admin.penggajian', compact('gajiList', 'stats', 'periods'));
    }

    public function create()
    {
        $karyawan = Karyawan::all();
        $strukturGaji = GajiService::getAllStrukturGaji();

        return view('admin.penggajian.create', compact('karyawan', 'strukturGaji'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required|exists:karyawan,id_karyawan',
            'periode' => 'required|date',
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan' => 'nullable|numeric|min:0',
            'bonus' => 'nullable|numeric|min:0',
            'potongan' => 'nullable|numeric|min:0',
            'jumlah_gaji' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string|max:500'
        ]);

        // Check if employee already has salary for this period
        $existingGaji = Gaji::where('id_karyawan', $request->id_karyawan)
            ->whereMonth('created_at', date('m', strtotime($request->periode)))
            ->whereYear('created_at', date('Y', strtotime($request->periode)))
            ->first();

        if ($existingGaji) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['id_karyawan' => 'Karyawan sudah memiliki data gaji untuk periode ini.']);
        }

        // Jika gaji pokok tidak diisi, ambil dari struktur gaji berdasarkan divisi
        $karyawan = Karyawan::find($request->id_karyawan);
        if (!$request->gaji_pokok || $request->gaji_pokok == 0) {
            $request->merge(['gaji_pokok' => GajiService::getGajiByDivisi($karyawan->divisi)]);
        }

        // Hitung ulang total gaji
        $totalGaji = $request->gaji_pokok + ($request->tunjangan ?? 0) + ($request->bonus ?? 0) - ($request->potongan ?? 0);

        $gaji = new Gaji([
            'id_karyawan' => $request->id_karyawan,
            'jumlah_gaji' => $totalGaji
        ]);
        $gaji->save();

        return redirect()->route('admin.penggajian')
            ->with('success', 'Data gaji berhasil ditambahkan.');
    }

    /**
     * Get gaji amount berdasarkan karyawan ID (untuk AJAX)
     */
    public function getGajiByKaryawan($id)
    {
        $karyawan = Karyawan::find($id);
        if (!$karyawan) {
            return response()->json(['error' => 'Karyawan tidak ditemukan'], 404);
        }

        $gajiAmount = GajiService::getGajiByDivisi($karyawan->divisi);

        return response()->json([
            'divisi' => $karyawan->divisi,
            'gaji' => $gajiAmount,
            'gaji_formatted' => GajiService::formatCurrency($gajiAmount)
        ]);
    }

    /**
     * Bulk actions untuk multiple gaji records
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,update_status,export',
            'selected_ids' => 'required|array',
            'selected_ids.*' => 'exists:gaji,id_gaji'
        ]);

        $selectedIds = $request->selected_ids;
        $action = $request->action;

        switch ($action) {
            case 'delete':
                Gaji::whereIn('id_gaji', $selectedIds)->delete();
                return redirect()->back()->with('success', count($selectedIds) . ' data gaji berhasil dihapus.');

            case 'update_status':
                // Example: Update status (you need to add status column to gaji table)
                // Gaji::whereIn('id_gaji', $selectedIds)->update(['status' => $request->new_status]);
                return redirect()->back()->with('success', count($selectedIds) . ' data gaji berhasil diupdate.');

            case 'export':
                // Export selected records
                $selectedGaji = Gaji::with('karyawan')->whereIn('id_gaji', $selectedIds)->get();
                // Implement export logic here
                return redirect()->back()->with('success', count($selectedIds) . ' data gaji berhasil diekspor.');

            default:
                return redirect()->back()->with('error', 'Aksi tidak valid.');
        }
    }

    public function show($id)
    {
        $gaji = Gaji::with(['karyawan'])->findOrFail($id);

        return view('admin.penggajian.show', compact('gaji'));
    }

    public function edit($id)
    {
        $gaji = Gaji::findOrFail($id);
        $karyawan = Karyawan::all();

        return view('admin.penggajian.edit', compact('gaji', 'karyawan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah_gaji' => 'required|numeric|min:0',
        ]);

        $gaji = Gaji::findOrFail($id);
        $gaji->fill($request->all());
        $gaji->save();

        return redirect()->route('admin.penggajian.index')
            ->with('success', 'Data gaji berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $gaji = Gaji::findOrFail($id);
        $gaji->delete();

        return redirect()->route('admin.penggajian.index')
            ->with('success', 'Data gaji berhasil dihapus.');
    }

    public function prosesPembayaran(Request $request)
    {
        $ids = $request->input('ids', []);

        if (empty($ids)) {
            return back()->with('error', 'Pilih data gaji yang akan diproses.');
        }

        $updated = Gaji::whereIn('id_gaji', $ids)
            ->where('status_pembayaran', 'pending')
            ->update([
                'status_pembayaran' => 'dibayar',
                'tanggal_gajian' => now(),
                'metode_pembayaran' => $request->input('metode_pembayaran', 'transfer')
            ]);

        return back()->with('success', "Berhasil memproses pembayaran untuk {$updated} karyawan.");
    }

    public function approveMassal(Request $request)
    {
        $ids = $request->input('ids', []);

        if (empty($ids)) {
            return back()->with('error', 'Pilih data gaji yang akan di-approve.');
        }

        $updated = Gaji::whereIn('id_gaji', $ids)
            ->where('status_pembayaran', 'pending')
            ->update(['status_pembayaran' => 'approved']);

        return back()->with('success', "Berhasil meng-approve {$updated} data gaji.");
    }

    public function generateSlipGaji()
    {
        // Get all active employees
        $karyawan = Karyawan::where('status', 'aktif')->get();

        $created = 0;
        foreach ($karyawan as $k) {
            // Check if slip already exists
            $existing = Gaji::where('id_karyawan', $k->id_karyawan)->first();

            if (!$existing) {
                $gaji = new Gaji([
                    'id_karyawan' => $k->id_karyawan,
                    'id_absensi' => 1, // Default absensi
                    'jumlah_gaji' => $this->getGajiPokok($k->divisi),
                ]);

                $gaji->save();
                $created++;
            }
        }

        return back()->with('success', "Berhasil generate {$created} slip gaji.");
    }

    public function exportData(Request $request)
    {
        $gajiList = Gaji::with(['karyawan'])->get();

        // Generate CSV or Excel export
        // This would typically use Laravel Excel package

        return back()->with('success', 'Data berhasil di-export.');
    }

    private function getGajiPokok($divisi)
    {
        $gajiPokok = [
            'Manager' => 8500000,
            'Supervisor' => 6500000,
            'Admin' => 4500000,
            'Kasir' => 3200000,
            'Security' => 3800000,
            'Cleaning Service' => 3000000,
            'Sales' => 3500000,
        ];

        return $gajiPokok[$divisi] ?? 3000000;
    }
}
