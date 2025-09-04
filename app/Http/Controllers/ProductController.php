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
            'jumlah_barang' => 'required|integer',
            'stok' => 'required|integer',
            'harga_jual' => 'required|numeric',
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

        // Pastikan ada kategori default
        $kategoriDefault = DB::table('kategori')->first();
        if (!$kategoriDefault) {
            // Buat kategori default jika belum ada
            $kategoriId = DB::table('kategori')->insertGetId([
                'nama_kategori' => 'Umum',
                'sub_kategori' => 'Produk Umum',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        } else {
            $kategoriId = $kategoriDefault->id_kategori;
        }

        // Set ID cabang otomatis ke Cikoneng
        $validated['id_cabang'] = $cabangCikoneng->id_cabang;
        $validated['id_kategori'] = $kategoriId;

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('produk', 'public');
        }

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
}
