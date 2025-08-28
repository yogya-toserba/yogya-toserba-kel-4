<?php

// app/Http/Controllers/ProductController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(5); // 5 per halaman
        return view('gudang.inventori.inventory', compact('products'));
    }

    public function create()
    {
        return view('gudang.inventori.create');
    }

   public function edit(Product $produk)
{
    return view('gudang.inventori.partials.edit-form', compact('produk'));
}

public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $validated = $request->validate([
        'nama_barang' => 'required|string|max:255',
        'sku' => 'required|string|max:100',
        'unit' => 'required|integer',
        'harga_beli' => 'required|numeric',
        'harga_jual' => 'required|numeric',
        'status' => 'required|in:aktif,nonaktif',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('produk', 'public');
    }

    $product->update($validated);

    return redirect()->route('gudang.produk.index')
    ->with('success', 'Produk berhasil diperbarui');

}

    public function store(Request $request)
{
    $validated = $request->validate([
        'nama_barang' => 'required|string',
        'sku' => 'required|string',
        'unit' => 'required|integer',
        'harga_beli' => 'required|numeric',
        'harga_jual' => 'required|numeric',
        'status' => 'required|string',
        'image' => 'nullable|image',
        'deskripsi' => 'nullable|string',
    ]);

    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('products', 'public');
    }

    $validated['tanggal'] = now(); // isi tanggal otomatis

    Product::create($validated);

    return redirect()->route('gudang.produk.index')
    ->with('success', 'Produk berhasil ditambahkan');
}

}
