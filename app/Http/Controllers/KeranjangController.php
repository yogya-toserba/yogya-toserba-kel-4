<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KeranjangController extends Controller
{
    /**
     * Display the shopping cart
     */
    public function index()
    {
        return view('dashboard.keranjang');
    }

    /**
     * Add item to cart
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|string',
            'size' => 'required|string',
            'color' => 'required|string',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Session::get('cart', []);
        
        $itemKey = $request->product_id . '_' . $request->size . '_' . $request->color;
        
        if (isset($cart[$itemKey])) {
            $cart[$itemKey]['quantity'] += $request->quantity;
        } else {
            $cart[$itemKey] = [
                'id' => $request->product_id,
                'name' => $request->name,
                'price' => $request->price,
                'image' => $request->image,
                'size' => $request->size,
                'color' => $request->color,
                'quantity' => $request->quantity,
                'added_at' => now()
            ];
        }
        
        Session::put('cart', $cart);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Produk berhasil ditambahkan ke keranjang',
            'cart_count' => array_sum(array_column($cart, 'quantity'))
        ]);
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request)
    {
        $request->validate([
            'item_key' => 'required|string',
            'quantity' => 'required|integer|min:0'
        ]);

        $cart = Session::get('cart', []);
        
        if (isset($cart[$request->item_key])) {
            if ($request->quantity > 0) {
                $cart[$request->item_key]['quantity'] = $request->quantity;
            } else {
                unset($cart[$request->item_key]);
            }
            
            Session::put('cart', $cart);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Keranjang berhasil diupdate',
                'cart_count' => array_sum(array_column($cart, 'quantity'))
            ]);
        }
        
        return response()->json([
            'status' => 'error',
            'message' => 'Item tidak ditemukan'
        ], 404);
    }

    /**
     * Remove item from cart
     */
    public function remove(Request $request)
    {
        $request->validate([
            'item_key' => 'required|string'
        ]);

        $cart = Session::get('cart', []);
        
        if (isset($cart[$request->item_key])) {
            unset($cart[$request->item_key]);
            Session::put('cart', $cart);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Item berhasil dihapus dari keranjang',
                'cart_count' => array_sum(array_column($cart, 'quantity'))
            ]);
        }
        
        return response()->json([
            'status' => 'error',
            'message' => 'Item tidak ditemukan'
        ], 404);
    }

    /**
     * Clear entire cart
     */
    public function clear()
    {
        Session::forget('cart');
        
        return response()->json([
            'status' => 'success',
            'message' => 'Keranjang berhasil dikosongkan',
            'cart_count' => 0
        ]);
    }

    /**
     * Get cart data
     */
    public function getCart()
    {
        $cart = Session::get('cart', []);
        
        return response()->json([
            'status' => 'success',
            'cart' => array_values($cart),
            'cart_count' => array_sum(array_column($cart, 'quantity')),
            'subtotal' => array_sum(array_map(function($item) {
                return $item['price'] * $item['quantity'];
            }, $cart))
        ]);
    }

    /**
     * Sync cart from localStorage to session
     */
    public function syncCart(Request $request)
    {
        $cartData = $request->input('cart', []);
        
        // Convert to session format
        $sessionCart = [];
        
        foreach ($cartData as $item) {
            $itemKey = $item['id'] . '_' . ($item['size'] ?? 'default') . '_' . ($item['color'] ?? 'default');
            $sessionCart[$itemKey] = [
                'id' => $item['id'],
                'name' => $item['name'],
                'price' => $item['price'],
                'image' => $item['image'],
                'size' => $item['size'] ?? null,
                'color' => $item['color'] ?? null,
                'category' => $item['category'] ?? 'Produk',
                'stock' => $item['stock'] ?? 0,
                'quantity' => $item['quantity'],
                'added_at' => now()
            ];
        }
        
        Session::put('cart', $sessionCart);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Cart synced successfully',
            'cart_count' => array_sum(array_column($sessionCart, 'quantity'))
        ]);
    }
}
