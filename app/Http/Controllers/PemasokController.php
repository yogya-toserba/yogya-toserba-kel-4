<?php

namespace App\Http\Controllers;

use App\Models\Pemasok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemasokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $gudang = Auth::guard('gudang')->user();
        
        $query = Pemasok::query();
        
        // Filter berdasarkan pencarian
        if ($request->filled('search')) {
            $query->search($request->search);
        }
        
        // Filter berdasarkan status
        if ($request->filled('status')) {
            if ($request->status === 'aktif') {
                $query->aktif();
            } elseif ($request->status === 'non-aktif') {
                $query->nonAktif();
            }
        }
        
        // Filter berdasarkan kategori
        if ($request->filled('kategori')) {
            $query->kategori($request->kategori);
        }
        
        // Filter berdasarkan kota
        if ($request->filled('kota')) {
            $query->where('kota', 'like', '%' . $request->kota . '%');
        }
        
        // Sorting
        $sortBy = $request->get('sort', 'nama_perusahaan');
        $sortOrder = $request->get('order', 'asc');
        $query->orderBy($sortBy, $sortOrder);
        
        $pemasoks = $query->paginate(10);
        
        // Data untuk statistics
        $totalPemasok = Pemasok::count();
        $pemasokAktif = Pemasok::aktif()->count();
        $pemasokNonAktif = Pemasok::nonAktif()->count();
        $totalKategori = Pemasok::distinct('kategori_produk')->count();
        
        // Kategori produk untuk dropdown filter
        $kategoriProduk = Pemasok::distinct()
            ->pluck('kategori_produk')
            ->filter()
            ->sort()
            ->values();
        
        // Kota untuk dropdown filter  
        $kotaList = Pemasok::distinct()
            ->pluck('kota')
            ->filter()
            ->sort()
            ->values();
        
        return view('gudang.pemasok', compact(
            'gudang',
            'pemasoks', 
            'totalPemasok',
            'pemasokAktif',
            'pemasokNonAktif',
            'totalKategori',
            'kategoriProduk',
            'kotaList'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gudang = Auth::guard('gudang')->user();
        return view('gudang.pemasok-create', compact('gudang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'kontak_person' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'email' => 'required|email|unique:pemasok,email',
            'alamat' => 'required|string',
            'kota' => 'required|string|max:100',
            'kategori_produk' => 'required|string|max:255',
            'tanggal_kerjasama' => 'nullable|date',
            'status' => 'required|in:aktif,non-aktif',
            'catatan' => 'nullable|string',
            'rating' => 'nullable|numeric|between:1,5'
        ]);
        
        // Set default rating jika tidak diisi
        if (!isset($validated['rating'])) {
            $validated['rating'] = 5.0;
        }
        
        Pemasok::create($validated);
        
        return redirect()->route('gudang.pemasok.index')
            ->with('success', 'Pemasok berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pemasok = Pemasok::findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $pemasok
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pemasok = Pemasok::findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $pemasok
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pemasok = Pemasok::findOrFail($id);
        
        $validated = $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'kontak_person' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'email' => 'required|email|unique:pemasok,email,' . $pemasok->id_pemasok . ',id_pemasok',
            'alamat' => 'required|string',
            'kota' => 'required|string|max:100',
            'kategori_produk' => 'required|string|max:255',
            'tanggal_kerjasama' => 'nullable|date',
            'status' => 'required|in:aktif,non-aktif',
            'catatan' => 'nullable|string',
            'rating' => 'nullable|numeric|between:1,5'
        ]);
        
        $pemasok->update($validated);
        
        return redirect()->route('gudang.pemasok.index')
            ->with('success', 'Pemasok berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $pemasok = Pemasok::findOrFail($id);
            $pemasok->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Pemasok berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus pemasok: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Get pemasok data for AJAX
     */
    public function getData(Request $request)
    {
        $query = Pemasok::query();
        
        // Apply filters
        if ($request->filled('search')) {
            $query->search($request->search);
        }
        
        if ($request->filled('status')) {
            if ($request->status === 'aktif') {
                $query->aktif();
            } elseif ($request->status === 'non-aktif') {
                $query->nonAktif();
            }
        }
        
        if ($request->filled('kategori')) {
            $query->kategori($request->kategori);
        }
        
        if ($request->filled('kota')) {
            $query->where('kota', 'like', '%' . $request->kota . '%');
        }
        
        $pemasoks = $query->get();
        
        return response()->json([
            'success' => true,
            'data' => $pemasoks
        ]);
    }
}
