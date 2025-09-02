<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokGudangPusat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller as BaseController;

class StokGudangPusatController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:gudang');
    }

    /**
     * Display a listing of the stock.
     */
    public function index(Request $request)
    {
        $gudang = auth()->guard('gudang')->user();
        
        $query = StokGudangPusat::query();
        
        // Search functionality
        if ($request->filled('search')) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%');
        }
        
        // Category filter
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }
        
        // Filter functionality
        if ($request->filled('stock_filter')) {
            switch ($request->stock_filter) {
                case 'low':
                    $query->where('jumlah', '<=', 10)->where('jumlah', '>', 0);
                    break;
                case 'empty':
                    $query->where('jumlah', '<=', 0);
                    break;
                case 'normal':
                    $query->where('jumlah', '>', 10);
                    break;
                case 'expiring':
                    $query->whereNotNull('expired')
                          ->where('expired', '<=', now()->addDays(30));
                    break;
            }
        }
        
        $stoks = $query->paginate(10);
        
        // Calculate statistics
        $stats = [
            'total_produk' => StokGudangPusat::count(),
            'stok_menipis' => StokGudangPusat::where('jumlah', '<=', 10)->where('jumlah', '>', 0)->count(),
            'stok_habis' => StokGudangPusat::where('jumlah', '<=', 0)->count(),
            'total_nilai' => StokGudangPusat::whereNotNull('harga_jual')->sum('harga_jual') ?? 0
        ];
        
        return view('gudang.stok', compact('stoks', 'gudang', 'stats'));
    }

    /**
     * Show the form for creating a new stock item.
     */
    public function create()
    {
        $gudang = Auth::guard('gudang')->user();
        return view('gudang.stok.create', compact('gudang'));
    }

    /**
     * Store a newly created stock item in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255|unique:stok_gudang_pusat,nama_produk',
            'kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:1000',
            'satuan' => 'required|string|max:50',
            'jumlah' => 'required|integer|min:0',
            'harga_beli' => 'nullable|numeric|min:0',
            'harga_jual' => 'nullable|numeric|min:0',
            'expired' => 'nullable|date|after:today',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'nama_produk.unique' => 'Nama produk sudah ada dalam database.',
            'expired.after' => 'Tanggal kedaluwarsa harus lebih dari hari ini.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.max' => 'Ukuran gambar maksimal 2MB.',
        ]);
        
        $data = $request->all();
        $data['tanggal'] = now()->format('Y-m-d');
        
        // Determine status based on jumlah
        if ($data['jumlah'] <= 0) {
            $data['status'] = 'Habis';
        } elseif ($data['jumlah'] <= 10) {
            $data['status'] = 'Stok Rendah';
        } else {
            $data['status'] = 'Tersedia';
        }
        
        // Handle file upload
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . uniqid() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
            
            // Move file to public/images/produk directory
            $destinationPath = public_path('images/produk');
            $file->move($destinationPath, $filename);
            
            // Store the URL path in database
            $data['foto'] = 'images/produk/' . $filename;
        } else {
            $data['foto'] = 'images/produk/default-product.svg';
        }
        
        try {
            StokGudangPusat::create($data);
            
            return redirect()->route('gudang.stok.index')
                            ->with('success', 'Produk "' . $data['nama_produk'] . '" berhasil ditambahkan ke stok gudang.');
        } catch (\Exception $e) {
            return redirect()->back()
                            ->withInput()
                            ->with('error', 'Gagal menambahkan produk. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified stock item.
     */
    public function show(StokGudangPusat $stok)
    {
        $gudang = Auth::guard('gudang')->user();
        return view('gudang.stok-show', compact('stok', 'gudang'));
    }

    /**
     * Show the form for editing the specified stock item.
     */
    public function edit(StokGudangPusat $stok)
    {
        $gudang = Auth::guard('gudang')->user();
        return view('gudang.stok-edit', compact('stok', 'gudang'));
    }

    /**
     * Update the specified stock item in storage.
     */
    public function update(Request $request, StokGudangPusat $stok)
    {
        // Validation untuk field yang essential saja
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:0',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'status' => 'required|in:aktif,non-aktif',
            'expired' => 'nullable|date',
        ]);

        // Update data stok
        $stok->update($validated);

        // Handle AJAX requests
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Data stok berhasil diperbarui',
                'data' => $stok->fresh()
            ]);
        }

        return redirect()->route('gudang.stok.index')
                        ->with('success', 'Data produk berhasil diperbarui.');
    }

    /**
     * Remove the specified stock item from storage.
     */
    public function destroy(StokGudangPusat $stok)
    {
        // Delete photo if exists
        if ($stok->foto) {
            Storage::disk('public')->delete($stok->foto);
        }

        $stok->delete();

        return redirect()->route('gudang.stok.index')
                        ->with('success', 'Produk berhasil dihapus dari stok gudang.');
    }

    /**
     * Show form to add stock for existing product.
     */
    public function showAddStock(StokGudangPusat $stok)
    {
        $gudang = Auth::guard('gudang')->user();
        return view('gudang.stok.add-stock', compact('stok', 'gudang'));
    }

    /**
     * Add stock to existing product.
     */
    public function addStock(Request $request, StokGudangPusat $stok)
    {
        $request->validate([
            'jumlah_tambah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string|max:500',
            'harga_beli' => 'nullable|numeric|min:0',
            'expired' => 'nullable|date|after:today',
        ], [
            'jumlah_tambah.required' => 'Jumlah stok yang ditambahkan wajib diisi.',
            'jumlah_tambah.min' => 'Minimal tambah 1 unit stok.',
            'expired.after' => 'Tanggal kedaluwarsa harus lebih dari hari ini.',
        ]);

        try {
            // Calculate new stock quantity
            $newQuantity = $stok->jumlah + $request->jumlah_tambah;
            
            // Update stock data
            $updateData = [
                'jumlah' => $newQuantity,
                'tanggal' => now()->format('Y-m-d'),
            ];
            
            // Update price if provided
            if ($request->filled('harga_beli')) {
                $updateData['harga_beli'] = $request->harga_beli;
            }
            
            // Update expiry date if provided
            if ($request->filled('expired')) {
                $updateData['expired'] = $request->expired;
            }
            
            // Update status based on new quantity
            if ($newQuantity <= 0) {
                $updateData['status'] = 'Habis';
            } elseif ($newQuantity <= 10) {
                $updateData['status'] = 'Stok Rendah';
            } else {
                $updateData['status'] = 'Tersedia';
            }
            
            $stok->update($updateData);
            
            return redirect()->route('gudang.stok.index')
                            ->with('success', 'Berhasil menambahkan ' . $request->jumlah_tambah . ' unit stok untuk produk "' . $stok->nama_produk . '". Stok sekarang: ' . $newQuantity . ' unit.');
        
        } catch (\Exception $e) {
            return redirect()->back()
                            ->withInput()
                            ->with('error', 'Gagal menambahkan stok. Silakan coba lagi.');
        }
    }

    /**
     * Get stock data for dashboard
     */
    public function getDashboardData()
    {
        $totalStok = StokGudangPusat::sum('jumlah');
        $totalProduk = StokGudangPusat::count();
        $stokRendah = StokGudangPusat::lowStock()->count();
        $akanExpired = StokGudangPusat::expiringSoon()->count();

        return response()->json([
            'total_stok' => $totalStok,
            'total_produk' => $totalProduk,
            'stok_rendah' => $stokRendah,
            'akan_expired' => $akanExpired
        ]);
    }

    /**
     * Update stock quantity (for stock in/out operations)
     */
    public function updateStock(Request $request, StokGudangPusat $stok)
    {
        $validated = $request->validate([
            'operation' => 'required|in:add,subtract',
            'quantity' => 'required|integer|min:1',
            'note' => 'nullable|string|max:255'
        ]);

        $oldQuantity = $stok->jumlah;
        
        if ($validated['operation'] === 'add') {
            $stok->jumlah += $validated['quantity'];
        } else {
            $stok->jumlah = max(0, $stok->jumlah - $validated['quantity']);
        }

        $stok->save();

        $operation = $validated['operation'] === 'add' ? 'ditambah' : 'dikurangi';
        $message = "Stok {$stok->nama_produk} berhasil {$operation}. Dari {$oldQuantity} menjadi {$stok->jumlah}";

        return response()->json([
            'success' => true,
            'message' => $message,
            'new_quantity' => $stok->jumlah
        ]);
    }

    /**
     * Export stok data to CSV or Excel
     */
    public function export(Request $request)
    {
        $format = $request->get('format', 'csv');
        
        $query = StokGudangPusat::query();
        
        // Apply same filters as index
        if ($request->filled('search')) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%');
        }
        
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }
        
        if ($request->filled('stock_filter')) {
            switch ($request->stock_filter) {
                case 'low':
                    $query->where('jumlah', '<=', 10)->where('jumlah', '>', 0);
                    break;
                case 'empty':
                    $query->where('jumlah', '<=', 0);
                    break;
                case 'normal':
                    $query->where('jumlah', '>', 10);
                    break;
                case 'expiring':
                    $query->whereNotNull('expired')
                          ->whereDate('expired', '<=', now()->addDays(30));
                    break;
            }
        }
        
        $stokData = $query->orderBy('nama_produk')->get();
        
        if ($format === 'excel') {
            return $this->exportToExcel($stokData);
        } else {
            return $this->exportToCsv($stokData);
        }
    }

    /**
     * Export to CSV format
     */
    private function exportToCsv($stokData)
    {
        $filename = 'stok_gudang_pusat_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
            'Pragma' => 'public',
        ];

        $callback = function() use ($stokData) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Headers with semicolon delimiter for Excel compatibility
            fputcsv($file, [
                'ID Stok',
                'Nama Produk', 
                'Kategori',
                'Jumlah',
                'Satuan',
                'Harga Beli',
                'Harga Jual',
                'Tanggal Expired',
                'Supplier',
                'Lokasi Rak',
                'Barcode',
                'Status',
                'Tanggal Ditambahkan',
                'Terakhir Diperbarui'
            ], ';');
            
            // Data rows
            foreach ($stokData as $stok) {
                fputcsv($file, [
                    $stok->id_stok ?? '',
                    $stok->nama_produk ?? '',
                    $stok->kategori ?? '',
                    $stok->jumlah ?? 0,
                    $stok->satuan ?? '',
                    $stok->harga_beli ?? 0,
                    $stok->harga_jual ?? 0,
                    $stok->expired ? date('d/m/Y', strtotime($stok->expired)) : '',
                    $stok->supplier ?? '',
                    $stok->lokasi_rak ?? '',
                    $stok->barcode ?? '',
                    $stok->jumlah > 0 ? 'Tersedia' : 'Habis',
                    $stok->created_at ? date('d/m/Y H:i', strtotime($stok->created_at)) : '',
                    $stok->updated_at ? date('d/m/Y H:i', strtotime($stok->updated_at)) : ''
                ], ';');
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Export to Excel format (HTML table)
     */
    private function exportToExcel($stokData)
    {
        $filename = 'stok_gudang_pusat_' . date('Y-m-d_H-i-s') . '.xls';
        
        $headers = [
            'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
            'Pragma' => 'public',
        ];

        $html = '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        .number { text-align: right; }
        .center { text-align: center; }
    </style>
</head>
<body>
    <h2>Data Stok Gudang Pusat - ' . date('d/m/Y H:i') . '</h2>
    <table>
        <thead>
            <tr>
                <th>ID Stok</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Tanggal Expired</th>
                <th>Supplier</th>
                <th>Lokasi Rak</th>
                <th>Barcode</th>
                <th>Status</th>
                <th>Tanggal Ditambahkan</th>
                <th>Terakhir Diperbarui</th>
            </tr>
        </thead>
        <tbody>';

        foreach ($stokData as $stok) {
            $html .= '<tr>
                <td class="center">' . ($stok->id_stok ?? '') . '</td>
                <td>' . ($stok->nama_produk ?? '') . '</td>
                <td>' . ($stok->kategori ?? '') . '</td>
                <td class="number">' . ($stok->jumlah ?? 0) . '</td>
                <td>' . ($stok->satuan ?? '') . '</td>
                <td class="number">Rp ' . number_format($stok->harga_beli ?? 0, 0, ',', '.') . '</td>
                <td class="number">Rp ' . number_format($stok->harga_jual ?? 0, 0, ',', '.') . '</td>
                <td class="center">' . ($stok->expired ? date('d/m/Y', strtotime($stok->expired)) : '') . '</td>
                <td>' . ($stok->supplier ?? '') . '</td>
                <td>' . ($stok->lokasi_rak ?? '') . '</td>
                <td>' . ($stok->barcode ?? '') . '</td>
                <td class="center">' . ($stok->jumlah > 0 ? 'Tersedia' : 'Habis') . '</td>
                <td class="center">' . ($stok->created_at ? date('d/m/Y H:i', strtotime($stok->created_at)) : '') . '</td>
                <td class="center">' . ($stok->updated_at ? date('d/m/Y H:i', strtotime($stok->updated_at)) : '') . '</td>
            </tr>';
        }

        $html .= '</tbody>
    </table>
</body>
</html>';

        return response($html, 200, $headers);
    }

    /**
     * Get stok data for AJAX requests
     */
    public function getStokData(Request $request)
    {
        try {
            $id = $request->get('id');
            $stok = StokGudangPusat::where('id_produk', $id)->firstOrFail();
            
            return response()->json([
                'success' => true,
                'data' => $stok
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data stok tidak ditemukan'
            ], 404);
        }
    }
}
