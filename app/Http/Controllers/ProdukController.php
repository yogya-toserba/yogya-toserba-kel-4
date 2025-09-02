<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Product;

class ProdukController extends Controller
{
  /**
   * Display product detail page
   */
  public function detail(Request $request)
  {
    $productId = $request->get('id');

    if (!$productId) {
      return redirect()->back()->with('error', 'ID produk tidak ditemukan');
    }

    // Try to find product in both tables
    $produk = Produk::find($productId);
    if (!$produk) {
      $produk = Product::find($productId);
    }

    if (!$produk) {
      return redirect()->back()->with('error', 'Produk tidak ditemukan');
    }

    return view('produk.detail', compact('produk'));
  }

  /**
   * Get product reviews
   */
  public function getReviews($id)
  {
    try {
      // Try to find product in both tables
      $produk = Produk::find($id);
      if (!$produk) {
        $produk = Product::find($id);
      }

      if (!$produk) {
        return response()->json([
          'success' => false,
          'message' => 'Produk tidak ditemukan'
        ], 404);
      }

      // For now, return sample reviews since we don't have a reviews table
      $reviews = [
        [
          'id' => 1,
          'user' => 'John Doe',
          'rating' => 5,
          'comment' => 'Produk sangat bagus dan berkualitas!',
          'date' => '2025-09-01'
        ],
        [
          'id' => 2,
          'user' => 'Jane Smith',
          'rating' => 4,
          'comment' => 'Sesuai dengan deskripsi, pengiriman cepat.',
          'date' => '2025-09-02'
        ]
      ];

      return response()->json([
        'success' => true,
        'data' => $reviews
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => 'Terjadi kesalahan: ' . $e->getMessage()
      ], 500);
    }
  }

  /**
   * Add new product review
   */
  public function addReview(Request $request, $id)
  {
    try {
      // Validate request
      $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|string|max:1000',
        'user_name' => 'required|string|max:100'
      ]);

      // Try to find product in both tables
      $produk = Produk::find($id);
      if (!$produk) {
        $produk = Product::find($id);
      }

      if (!$produk) {
        return response()->json([
          'success' => false,
          'message' => 'Produk tidak ditemukan'
        ], 404);
      }

      // For now, just return success since we don't have a reviews table
      // In a real application, you would save to a reviews table here

      return response()->json([
        'success' => true,
        'message' => 'Review berhasil ditambahkan',
        'data' => [
          'id' => rand(1000, 9999),
          'user' => $request->user_name,
          'rating' => $request->rating,
          'comment' => $request->comment,
          'date' => date('Y-m-d')
        ]
      ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
      return response()->json([
        'success' => false,
        'message' => 'Data tidak valid',
        'errors' => $e->errors()
      ], 422);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => 'Terjadi kesalahan: ' . $e->getMessage()
      ], 500);
    }
  }

  /**
   * Display all products (index page)
   */
  public function index()
  {
    $produks = Produk::paginate(12);
    return view('produk.index', compact('produks'));
  }

  /**
   * Show product creation form
   */
  public function create()
  {
    return view('produk.create');
  }

  /**
   * Store new product
   */
  public function store(Request $request)
  {
    $request->validate([
      'nama' => 'required|string|max:255',
      'sku' => 'required|string|max:100|unique:produks',
      'unit' => 'required|string|max:50',
      'harga_beli' => 'required|numeric|min:0',
      'harga_jual' => 'required|numeric|min:0',
      'status' => 'required|in:active,inactive',
      'deskripsi' => 'nullable|string',
      'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $data = $request->all();

    // Handle image upload
    if ($request->hasFile('gambar')) {
      $image = $request->file('gambar');
      $imageName = time() . '.' . $image->getClientOriginalExtension();
      $image->move(public_path('images/produk'), $imageName);
      $data['gambar'] = 'images/produk/' . $imageName;
    }

    Produk::create($data);

    return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan');
  }

  /**
   * Show product edit form
   */
  public function edit($id)
  {
    $produk = Produk::findOrFail($id);
    return view('produk.edit', compact('produk'));
  }

  /**
   * Update product
   */
  public function update(Request $request, $id)
  {
    $produk = Produk::findOrFail($id);

    $request->validate([
      'nama' => 'required|string|max:255',
      'sku' => 'required|string|max:100|unique:produks,sku,' . $id,
      'unit' => 'required|string|max:50',
      'harga_beli' => 'required|numeric|min:0',
      'harga_jual' => 'required|numeric|min:0',
      'status' => 'required|in:active,inactive',
      'deskripsi' => 'nullable|string',
      'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $data = $request->all();

    // Handle image upload
    if ($request->hasFile('gambar')) {
      // Delete old image
      if ($produk->gambar && file_exists(public_path($produk->gambar))) {
        unlink(public_path($produk->gambar));
      }

      $image = $request->file('gambar');
      $imageName = time() . '.' . $image->getClientOriginalExtension();
      $image->move(public_path('images/produk'), $imageName);
      $data['gambar'] = 'images/produk/' . $imageName;
    }

    $produk->update($data);

    return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui');
  }

  /**
   * Delete product
   */
  public function destroy($id)
  {
    $produk = Produk::findOrFail($id);

    // Delete image if exists
    if ($produk->gambar && file_exists(public_path($produk->gambar))) {
      unlink(public_path($produk->gambar));
    }

    $produk->delete();

    return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus');
  }
}
