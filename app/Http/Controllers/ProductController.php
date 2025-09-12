<?php

// app/Http/Controllers/ProductController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokProduk;
use App\Models\Cabang;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = StokProduk::paginate(10); // 10 per halaman
        return view('gudang.inventori.inventory', compact('products'));
    }

    public function create()
    {
        return view('gudang.inventori.create');
    }

    public function edit($id)
    {
        $produk = StokProduk::findOrFail($id);
        return view('gudang.inventori.partials.edit-form', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $product = StokProduk::findOrFail($id);

        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jumlah_barang' => 'required|integer',
            'stok' => 'required|integer', 
            'harga_jual' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Pastikan tetap menggunakan cabang Cikoneng
        $cabangCikoneng = Cabang::where('nama_cabang', 'like', '%Cikoneng%')
                                ->orWhere('nama_cabang', 'like', '%cikoneng%')
                                ->first();
        
        if ($cabangCikoneng) {
            $validated['id_cabang'] = $cabangCikoneng->id_cabang;
        }
        
        // Pastikan ada kategori default
        $kategoriDefault = DB::table('kategori')->first();
        if ($kategoriDefault) {
            $validated['id_kategori'] = $kategoriDefault->id_kategori;
        }

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('produk', 'public');
        }

        $product->update($validated);

        return redirect()->route('gudang.inventori.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    public function store(Request $request)
    {
        // Debug: Log request data
        \Log::info('Store request data: ', $request->all());
        
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'sku' => 'required|string|max:50|unique:stok_produk,sku',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string|max:1000',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Debug: Log validated data
        \Log::info('Validated data: ', $validated);

        // Cari atau buat cabang Cikoneng
        $cabangCikoneng = Cabang::where('nama_cabang', 'like', '%Cikoneng%')
                                ->orWhere('nama_cabang', 'like', '%cikoneng%')
                                ->first();
        
        if (!$cabangCikoneng) {
            // Buat cabang Cikoneng jika belum ada
            $cabangCikoneng = Cabang::create([
                'nama_cabang' => 'Cikoneng',
                'kategori' => 'Pusat',
                'alamat' => 'Cikoneng, Ciamis',
                'wilayah' => 'Jawa Barat'
            ]);
        }

        // Cari atau buat kategori berdasarkan string kategori
        $kategoriData = DB::table('kategori')
            ->where('nama_kategori', 'like', '%' . $validated['kategori'] . '%')
            ->first();
            
        if (!$kategoriData) {
            // Buat kategori baru jika belum ada
            $kategoriId = DB::table('kategori')->insertGetId([
                'nama_kategori' => ucfirst($validated['kategori']),
                'sub_kategori' => 'Kategori ' . ucfirst($validated['kategori']),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        } else {
            $kategoriId = $kategoriData->id_kategori;
        }

        // Set ID cabang dan kategori
        $validated['id_cabang'] = $cabangCikoneng->id_cabang;
        $validated['id_kategori'] = $kategoriId;
        
        // Set jumlah_barang sama dengan stok untuk produk baru
        $validated['jumlah_barang'] = $validated['stok'];

        // Handle upload foto
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('produk', 'public');
        }

        // Remove kategori string dari data yang akan disimpan
        unset($validated['kategori']);

        // Debug: Log final data before insert
        \Log::info('Final data before insert: ', $validated);

        try {
            $product = StokProduk::create($validated);
            \Log::info('Product created successfully with ID: ' . $product->id_produk);
        } catch (\Exception $e) {
            \Log::error('Error creating product: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }

        return redirect()->route('gudang.inventori.index')
            ->with('success', 'Produk berhasil ditambahkan ke cabang ' . $cabangCikoneng->nama_cabang);
    }

    public function destroy($id)
    {
        $product = StokProduk::findOrFail($id);
        
        // Hapus file gambar jika ada
        if ($product->foto) {
            \Storage::disk('public')->delete($product->foto);
        }
        
        $product->delete();

        return redirect()->route('gudang.inventori.index')
            ->with('success', 'Produk berhasil dihapus');
    }
    
    /**
     * Get next product ID for SKU generation
     */
    public function getNextId()
    {
        // Hitung total produk yang ada + 1
        $nextId = StokProduk::count() + 1;
        
        return response()->json(['next_id' => $nextId]);
    }
}
