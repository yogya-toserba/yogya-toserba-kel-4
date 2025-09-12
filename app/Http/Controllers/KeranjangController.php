<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Keranjang;
use App\Models\Pelanggan;

class KeranjangController extends Controller
{
    /**
     * Display the shopping cart
     */
    public function index()
    {
        // Check if user is authenticated
        if (!Auth::guard('pelanggan')->check()) {
            return redirect()->route('pelanggan.login')->with('error', 'Silakan login terlebih dahulu untuk melihat keranjang.');
        }
        
        $pelanggan = Auth::guard('pelanggan')->user();
        $keranjangItems = Keranjang::forPelanggan($pelanggan->id_pelanggan)->get();
        
        return view('dashboard.keranjang', compact('keranjangItems'));
    }

    /**
     * Add item to cart - requires authentication
     */
    public function add(Request $request)
    {
        try {
            // Check if user is authenticated
            if (!Auth::guard('pelanggan')->check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Silakan login terlebih dahulu untuk menambahkan produk ke keranjang.',
                    'requireLogin' => true
                ], 401);
            }

            $request->validate([
                'id' => 'required|integer',
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'image' => 'nullable|string',
                'category' => 'nullable|string',
                'quantity' => 'nullable|integer|min:1'
            ]);

            $pelanggan = Auth::guard('pelanggan')->user();
            $quantity = $request->quantity ?? 1;
            
            // Check if item already exists in cart
            $existingItem = Keranjang::where('id_pelanggan', $pelanggan->id_pelanggan)
                                    ->where('id_produk', $request->id)
                                    ->first();
            
            if ($existingItem) {
                // Update quantity
                $existingItem->jumlah += $quantity;
                $existingItem->calculateSubtotal();
                $existingItem->save();
                
                $message = 'Jumlah produk di keranjang berhasil diperbarui';
            } else {
                // Create new cart item
                $keranjang = new Keranjang([
                    'id_pelanggan' => $pelanggan->id_pelanggan,
                    'id_produk' => $request->id,
                    'nama_produk' => $request->name,
                    'harga' => $request->price,
                    'jumlah' => $quantity,
                    'gambar' => $request->image,
                    'kategori' => $request->category
                ]);
                
                $keranjang->calculateSubtotal();
                $keranjang->save();
                
                $message = 'Produk berhasil ditambahkan ke keranjang';
            }
            
            // Get updated cart count
            $cartCount = Keranjang::forPelanggan($pelanggan->id_pelanggan)->sum('jumlah');
            
            return response()->json([
                'success' => true,
                'message' => $message,
                'cartCount' => $cartCount
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request)
    {
        // Check if user is authenticated
        if (!Auth::guard('pelanggan')->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan login terlebih dahulu.',
                'requireLogin' => true
            ], 401);
        }

        $request->validate([
            'id' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);

        $pelanggan = Auth::guard('pelanggan')->user();
        
        $keranjang = Keranjang::where('id_pelanggan', $pelanggan->id_pelanggan)
                            ->where('id', $request->id)
                            ->first();
        
        if (!$keranjang) {
            return response()->json([
                'success' => false,
                'message' => 'Item tidak ditemukan di keranjang.'
            ], 404);
        }
        
        $keranjang->jumlah = $request->quantity;
        $keranjang->calculateSubtotal();
        $keranjang->save();
        
        $cartCount = Keranjang::forPelanggan($pelanggan->id_pelanggan)->sum('jumlah');
        $cartTotal = Keranjang::forPelanggan($pelanggan->id_pelanggan)->sum('subtotal');
        
        return response()->json([
            'success' => true,
            'message' => 'Keranjang berhasil diupdate.',
            'cartCount' => $cartCount,
            'cartTotal' => $cartTotal,
            'itemSubtotal' => $keranjang->subtotal
        ]);
    }

    /**
     * Remove item from cart
     */
    public function remove(Request $request)
    {
        // Check if user is authenticated
        if (!Auth::guard('pelanggan')->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan login terlebih dahulu.',
                'requireLogin' => true
            ], 401);
        }

        $request->validate([
            'id' => 'required'
        ]);

        $pelanggan = Auth::guard('pelanggan')->user();
        
        $keranjang = Keranjang::where('id_pelanggan', $pelanggan->id_pelanggan)
                            ->where('id', $request->id)
                            ->first();
        
        if (!$keranjang) {
            return response()->json([
                'success' => false,
                'message' => 'Item tidak ditemukan di keranjang.'
            ], 404);
        }
        
        $keranjang->delete();
        
        $cartCount = Keranjang::forPelanggan($pelanggan->id_pelanggan)->sum('jumlah');
        $cartTotal = Keranjang::forPelanggan($pelanggan->id_pelanggan)->sum('subtotal');
        
        return response()->json([
            'success' => true,
            'message' => 'Item berhasil dihapus dari keranjang.',
            'cartCount' => $cartCount,
            'cartTotal' => $cartTotal
        ]);
    }

    /**
     * Clear entire cart
     */
    public function clear()
    {
        // Check if user is authenticated
        if (!Auth::guard('pelanggan')->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan login terlebih dahulu.',
                'requireLogin' => true
            ], 401);
        }

        $pelanggan = Auth::guard('pelanggan')->user();
        
        Keranjang::where('id_pelanggan', $pelanggan->id_pelanggan)->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Keranjang berhasil dikosongkan.',
            'cartCount' => 0,
            'cartTotal' => 0
        ]);
    }

    /**
     * Get cart data
     */
    public function getCart()
    {
        // Check if user is authenticated
        if (!Auth::guard('pelanggan')->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan login terlebih dahulu.',
                'requireLogin' => true,
                'cartItems' => [],
                'cartCount' => 0,
                'cartTotal' => 0
            ], 401);
        }

        $pelanggan = Auth::guard('pelanggan')->user();
        $keranjangItems = Keranjang::forPelanggan($pelanggan->id_pelanggan)->get();
        
        $cartCount = $keranjangItems->sum('jumlah');
        $cartTotal = $keranjangItems->sum('subtotal');
        
        return response()->json([
            'success' => true,
            'cartItems' => $keranjangItems,
            'cartCount' => $cartCount,
            'cartTotal' => $cartTotal
        ]);
    }

    /**
     * Sync cart from localStorage to session (deprecated - now using database)
     */
    public function syncCart(Request $request)
    {
        // This method is deprecated since we're now using database
        // But keeping for backward compatibility
        
        return response()->json([
            'success' => true,
            'message' => 'Cart sync tidak diperlukan, menggunakan database'
        ]);
    }
}
