<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Show product detail page
     */
    public function detail(Request $request)
    {
        // Get product data from request parameters or use defaults
        $product = [
            'id' => $request->get('id', '1'),
            'name' => $request->get('name', 'Kemeja Formal Pria Premium Cotton'),
            'price' => $request->get('price', 'Rp 299.000'),
            'original_price' => $request->get('originalPrice', 'Rp 399.000'),
            'image' => $request->get('image', '/image/kategori/fashion/kemeja_formal.png'),
            'rating' => floatval($request->get('rating', 4.7)),
            'reviews' => intval($request->get('reviews', 156)),
            'sold' => $request->get('sold', '2.3k'),
            'stock' => intval($request->get('stock', 20)),
            'sku' => $request->get('sku', 'FASH-001'),
            'category' => $request->get('category', 'Fashion Pria'),
            'brand' => $request->get('brand', 'MyYOGYA Premium'),
            'material' => $request->get('material', '100% Cotton Premium'),
            'weight' => $request->get('weight', '200 gram'),
            'description' => $request->get('description', 'Kemeja formal premium dengan bahan cotton berkualitas tinggi. Cocok untuk acara formal maupun kasual. Tersedia dalam berbagai ukuran dan warna. Nyaman dipakai seharian dan mudah perawatannya.')
        ];
        
        // Calculate discount percentage
        if ($product['original_price'] && $product['original_price'] !== '') {
            $originalPrice = floatval(preg_replace('/[^\d]/', '', $product['original_price']));
            $currentPrice = floatval(preg_replace('/[^\d]/', '', $product['price']));
            
            if ($originalPrice > 0) {
                $product['discount_percentage'] = round((($originalPrice - $currentPrice) / $originalPrice) * 100);
                $product['savings'] = $originalPrice - $currentPrice;
            }
        }
        
        // Related products (sample data)
        $relatedProducts = [
            [
                'id' => '2',
                'name' => 'Kemeja Kasual Lengan Panjang',
                'price' => 'Rp 189.000',
                'original_price' => 'Rp 259.000',
                'image' => '/image/kategori/fashion/kemeja_kasual.png',
                'rating' => 4.5,
                'discount' => '27%'
            ],
            [
                'id' => '3',
                'name' => 'Kemeja Batik Modern',
                'price' => 'Rp 349.000',
                'original_price' => '',
                'image' => '/image/kategori/fashion/kemeja_batik.png',
                'rating' => 4.8,
                'discount' => ''
            ],
            [
                'id' => '4',
                'name' => 'Kemeja Oxford Premium',
                'price' => 'Rp 419.000',
                'original_price' => 'Rp 599.000',
                'image' => '/image/kategori/fashion/kemeja_oxford.png',
                'rating' => 4.6,
                'discount' => '30%'
            ],
            [
                'id' => '5',
                'name' => 'Kemeja Flanel Casual',
                'price' => 'Rp 229.000',
                'original_price' => 'Rp 319.000',
                'image' => '/image/kategori/fashion/kemeja_flanel.png',
                'rating' => 4.4,
                'discount' => '28%'
            ]
        ];
        
        return view('produk.detail', compact('product', 'relatedProducts'));
    }
    
    /**
     * Get product reviews
     */
    public function getReviews(Request $request)
    {
        $productId = $request->get('product_id');
        
        // Sample reviews data
        $reviews = [
            [
                'id' => 1,
                'customer_name' => 'Ahmad Rizki',
                'avatar' => 'A',
                'rating' => 5,
                'date' => '2 hari yang lalu',
                'comment' => 'Kualitas sangat bagus, bahan adem dan nyaman dipakai. Ukuran sesuai dengan size chart. Pengiriman cepat dan packaging rapi. Recommended!',
                'images' => ['/image/review1.jpg', '/image/review2.jpg'],
                'verified_purchase' => true
            ],
            [
                'id' => 2,
                'customer_name' => 'Sari Dewi',
                'avatar' => 'S',
                'rating' => 5,
                'date' => '1 minggu yang lalu',
                'comment' => 'Kemejanya bagus banget, warnanya sesuai dengan gambar. Bahan nya juga adem dan tidak mudah kusut. Terima kasih MyYOGYA!',
                'images' => [],
                'verified_purchase' => true
            ],
            [
                'id' => 3,
                'customer_name' => 'Budi Santoso',
                'avatar' => 'B',
                'rating' => 4,
                'date' => '2 minggu yang lalu',
                'comment' => 'Overall bagus, tapi agak tipis materialnya. Untuk harga segini sih masih worth it.',
                'images' => ['/image/review3.jpg'],
                'verified_purchase' => true
            ]
        ];
        
        return response()->json([
            'status' => 'success',
            'reviews' => $reviews,
            'total_reviews' => count($reviews)
        ]);
    }
    
    /**
     * Add product review
     */
    public function addReview(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
            'images.*' => 'nullable|image|max:2048'
        ]);
        
        // Here you would typically save to database
        // For now, we'll just return success response
        
        return response()->json([
            'status' => 'success',
            'message' => 'Review berhasil ditambahkan. Terima kasih atas feedback Anda!'
        ]);
    }
}
