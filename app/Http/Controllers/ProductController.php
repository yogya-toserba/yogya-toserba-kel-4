<?php

// app/Http/Controllers/ProductController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('gudang.inventory', compact('products'));
    }

    public function create()
    {
        return view('gudang.create');
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

    return redirect()->route('gudang.inventory.index')->with('success', 'Produk berhasil ditambahkan');
}

}
