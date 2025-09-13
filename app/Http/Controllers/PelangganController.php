<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use App\Models\Pelanggan;
use App\Models\Product;
use App\Models\StokProduk;
use App\Models\Cart;

class PelangganController extends Controller
{
  public function showLogin()
  {
    return view('pelanggan.login');
  }

  public function showRegister()
  {
    return view('pelanggan.register');
  }

  public function login(Request $request)
  {
    $request->validate([
      'email' => 'required|email',
      'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');

    // Try to authenticate using pelanggan guard
    if (Auth::guard('pelanggan')->attempt($credentials)) {
      $request->session()->regenerate();

      // Redirect langsung ke dashboard dengan pesan sukses
      return redirect()->intended(route('pelanggan.dashboard'))->with('success', 'Login berhasil! Selamat datang ' . Auth::guard('pelanggan')->user()->nama_pelanggan);
    }

    // Jika login gagal, kembali ke form login dengan error
    return back()->withErrors([
      'email' => 'Email atau password salah!'
    ])->onlyInput('email');
  }

  public function register(Request $request)
  {
    $request->validate([
      'nama_pelanggan' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:pelanggan',
      'password' => 'required|string|min:8|confirmed',
      'tanggal_lahir' => 'required|date',
      'jenis_kelamin' => 'required|in:L,P',
      'nomer_telepon' => 'required|string|max:20',
      'alamat' => 'required|string',
    ]);

    $pelanggan = Pelanggan::create([
      'nama_pelanggan' => $request->nama_pelanggan,
      'email' => $request->email,
      'password' => Hash::make($request->password),
      'tanggal_lahir' => $request->tanggal_lahir,
      'jenis_kelamin' => $request->jenis_kelamin,
      'nomer_telepon' => $request->nomer_telepon,
      'alamat' => $request->alamat,
      'level_membership' => 'Bronze', // default membership
    ]);

    Auth::guard('pelanggan')->login($pelanggan);

    // Redirect langsung ke dashboard dengan pesan sukses setelah registrasi
    return redirect()->route('pelanggan.dashboard')->with('success', 'Registrasi berhasil! Selamat datang ' . $pelanggan->nama_pelanggan);
  }

  public function logout(Request $request)
  {
    Auth::guard('pelanggan')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/')->with('success', 'Anda telah berhasil logout!');
  }

  // Search function for pelanggan
  public function search(Request $request)
  {
    $query = $request->input('q');
    if (!$query) {
      return view('pelanggan.search-results', ['results' => [], 'query' => '']);
    }

    // Search products from stok_produk with kategori join
    $results = \DB::table('stok_produk')
      ->leftJoin('kategori', 'stok_produk.id_kategori', '=', 'kategori.id_kategori')
      ->select(
        'stok_produk.id_produk', 
        'stok_produk.nama_barang', 
        'stok_produk.harga_jual as harga', 
        'stok_produk.stok', 
        'stok_produk.foto',
        'kategori.nama_kategori as kategori',
        'stok_produk.jumlah_barang'
      )
      ->where(function($q) use ($query) {
          $q->where('stok_produk.nama_barang', 'like', "%{$query}%")
            ->orWhere('kategori.nama_kategori', 'like', "%{$query}%");
      })
      ->where('stok_produk.stok', '>', 0) // Only show products with stock
      ->orderBy('stok_produk.nama_barang')
      ->limit(20)
      ->get();

    // If no results from stok_produk, also search from produks table
    if ($results->isEmpty()) {
      $additionalResults = \DB::table('produks')
        ->select(
          'id as id_produk',
          'nama as nama_barang',
          'harga_jual as harga',
          'unit as stok',
          'gambar as foto',
          \DB::raw("'Produk' as kategori"),
          'deskripsi'
        )
        ->where(function($q) use ($query) {
            $q->where('nama', 'like', "%{$query}%")
              ->orWhere('deskripsi', 'like', "%{$query}%");
        })
        ->where('status', 'aktif')
        ->orderBy('nama')
        ->limit(20)
        ->get();

      $results = $additionalResults;
    }

    return view('pelanggan.search-results', [
      'results' => $results,
      'query' => $query
    ]);
  }

  public function dashboard()
  {
    // Data for customer dashboard
    $promoSlides = [
        [
            'title' => 'Flash Sale Spektakuler!',
            'subtitle' => 'Diskon hingga 70% untuk produk pilihan',
            'button_text' => 'Belanja Sekarang'
        ],
        [
            'title' => 'Gratis Ongkir Se-Indonesia',
            'subtitle' => 'Minimum pembelian Rp 100.000',
            'button_text' => 'Mulai Belanja'
        ],
        [
            'title' => 'Member Baru? Dapat Voucher!',
            'subtitle' => 'Dapatkan voucher 50% untuk pembelian pertama',
            'button_text' => 'Daftar Sekarang'
        ]
    ];

    $categories = [
        ['name' => 'Elektronik', 'icon' => 'fas fa-laptop', 'color' => '#3498db', 'url' => '#'],
        ['name' => 'Fashion', 'icon' => 'fas fa-tshirt', 'color' => '#e74c3c', 'url' => '#'],
        ['name' => 'Rumah Tangga', 'icon' => 'fas fa-home', 'color' => '#2ecc71', 'url' => '#'],
        ['name' => 'Olahraga', 'icon' => 'fas fa-dumbbell', 'color' => '#f39c12', 'url' => '#'],
        ['name' => 'Kecantikan', 'icon' => 'fas fa-heart', 'color' => '#e91e63', 'url' => '#'],
        ['name' => 'Makanan', 'icon' => 'fas fa-utensils', 'color' => '#ff9800', 'url' => '#'],
        ['name' => 'Buku', 'icon' => 'fas fa-book', 'color' => '#9c27b0', 'url' => '#'],
        ['name' => 'Perawatan', 'icon' => 'fas fa-spa', 'color' => '#607d8b', 'url' => '#']
    ];

    $popularProducts = [
        [
            'id' => 1,
            'name' => 'Smartphone Flagship Terbaru',
            'price' => 8999000,
            'original_price' => 12999000,
            'rating' => 4.8,
            'sold' => 2350
        ],
        [
            'id' => 2,
            'name' => 'Laptop Gaming Pro',
            'price' => 15999000,
            'original_price' => 21999000,
            'rating' => 4.9,
            'sold' => 1150
        ],
        [
            'id' => 3,
            'name' => 'Wireless Earbuds Premium',
            'price' => 899000,
            'original_price' => 1299000,
            'rating' => 4.7,
            'sold' => 5420
        ],
        [
            'id' => 4,
            'name' => 'Smart Watch Series X',
            'price' => 2499000,
            'original_price' => 3499000,
            'rating' => 4.6,
            'sold' => 3200
        ]
    ];

    return view('dashboard.index', compact('promoSlides', 'categories', 'popularProducts'));
  }

  public function profile()
  {
    $pelanggan = Auth::guard('pelanggan')->user();
    return view('pelanggan.profile', compact('pelanggan'));
  }

  public function updateProfile(Request $request)
  {
    $pelanggan = Auth::guard('pelanggan')->user();
    
    $request->validate([
      'nama_pelanggan' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:pelanggan,email,' . $pelanggan->id_pelanggan . ',id_pelanggan',
      'nomer_telepon' => 'required|string|max:20',
      'alamat' => 'required|string',
      'tanggal_lahir' => 'required|date',
      'jenis_kelamin' => 'required|in:L,P',
    ]);

    $pelanggan->update([
      'nama_pelanggan' => $request->nama_pelanggan,
      'email' => $request->email,
      'nomer_telepon' => $request->nomer_telepon,
      'alamat' => $request->alamat,
      'tanggal_lahir' => $request->tanggal_lahir,
      'jenis_kelamin' => $request->jenis_kelamin,
    ]);

    return redirect()->route('pelanggan.profile')->with('success', 'Profile berhasil diperbarui!');
  }

  public function updatePassword(Request $request)
  {
    $request->validate([
      'current_password' => 'required',
      'password' => 'required|string|min:8|confirmed',
    ]);

    $pelanggan = Auth::guard('pelanggan')->user();

    if (!Hash::check($request->current_password, $pelanggan->password)) {
      return back()->withErrors(['current_password' => 'Password saat ini tidak benar']);
    }

    $pelanggan->update([
      'password' => Hash::make($request->password),
    ]);

    return redirect()->route('pelanggan.profile')->with('success', 'Password berhasil diperbarui!');
  }

  // Method untuk kategori produk
    public function fashion()
    {
        try {
            // Ambil produk fashion dari tabel stok_produk
            $products = StokProduk::fashionProducts()
                                ->active()
                                ->with(['kategori', 'cabang'])
                                ->paginate(12);
                            
            return view('dashboard.kategori.fashion', compact('products'));
        } catch (\Exception $e) {
            // Jika ada error, tampilkan dengan data kosong
            $products = new \Illuminate\Pagination\LengthAwarePaginator(
                collect([]),
                0,
                12,
                1,
                ['path' => request()->url()]
            );
            return view('dashboard.kategori.fashion', compact('products'))
                ->with('error', 'Terjadi kesalahan saat memuat produk: ' . $e->getMessage());
        }
    }

  public function elektronik()
  {
      $products = Product::byCategory('elektronik')
                        ->active()
                        ->inStock()
                        ->paginate(12);
                        
      return view('dashboard.kategori.elektronik', compact('products'));
  }

  public function makanan()
  {
      $products = Product::byCategory('makanan')
                        ->active()
                        ->inStock()
                        ->paginate(12);
                        
      return view('dashboard.kategori.makanan', compact('products'));
  }

  public function rumahTangga()
  {
      $products = Product::byCategory('rumah-tangga')
                        ->active()
                        ->inStock()
                        ->paginate(12);
                        
      return view('dashboard.kategori.rumah-tangga', compact('products'));
  }

  public function olahraga()
  {
      $products = Product::byCategory('olahraga')
                        ->active()
                        ->inStock()
                        ->paginate(12);
                        
      return view('dashboard.kategori.olahraga', compact('products'));
  }

  public function otomotif()
  {
      $products = Product::byCategory('otomotif')
                        ->active()
                        ->inStock()
                        ->paginate(12);
                        
      return view('dashboard.kategori.otomotif', compact('products'));
  }

  public function perawatan()
  {
      $products = Product::byCategory('perawatan')
                        ->active()
                        ->inStock()
                        ->paginate(12);
                        
      return view('dashboard.kategori.perawatan', compact('products'));
  }

  public function buku()
  {
      $products = Product::byCategory('buku')
                        ->active()
                        ->inStock()
                        ->paginate(12);
                        
      return view('dashboard.kategori.buku', compact('products'));
  }

  // API untuk mendapatkan detail produk
  public function getProductDetail($id)
  {
      $product = StokProduk::with(['kategori', 'cabang'])->findOrFail($id);
      
      return response()->json([
          'id' => $product->id_produk,
          'name' => $product->name,
          'description' => $product->description,
          'price' => $product->formatted_price,
          'image' => $product->image,
          'gallery' => $product->gallery,
          'category' => $product->category,
          'subcategory' => $product->subcategory,
          'rating' => $product->rating,
          'reviews_count' => $product->reviews_count,
          'stock' => $product->stock,
          'features' => $product->features
      ]);
  }

  // API untuk menambahkan produk ke keranjang
  public function addToCart(Request $request)
  {
      try {
          $request->validate([
              'id_produk' => 'required|exists:stok_produk,id_produk',
              'quantity' => 'required|integer|min:1'
          ]);

          $product = StokProduk::findOrFail($request->id_produk);
          
          // Check stock availability
          if ($product->stok < $request->quantity) {
              return response()->json([
                  'success' => false,
                  'message' => 'Stok tidak mencukupi. Stok tersedia: ' . $product->stok
              ], 400);
          }

          $userId = Auth::guard('pelanggan')->id();
          $sessionId = $request->session()->getId();
          
          // Check if item already exists in cart
          $existingCartItem = Cart::where('id_produk', $request->id_produk)
                                  ->where(function($query) use ($userId, $sessionId) {
                                      if ($userId) {
                                          $query->where('id_pelanggan', $userId);
                                      } else {
                                          $query->where('session_id', $sessionId)
                                                ->whereNull('id_pelanggan');
                                      }
                                  })
                                  ->first();

          if ($existingCartItem) {
              // Update quantity if item exists
              $newQuantity = $existingCartItem->quantity + $request->quantity;
              
              if ($product->stok < $newQuantity) {
                  return response()->json([
                      'success' => false,
                      'message' => 'Total quantity melebihi stok tersedia. Stok tersedia: ' . $product->stok
                  ], 400);
              }

              $existingCartItem->update(['quantity' => $newQuantity]);
              $cartItem = $existingCartItem;
          } else {
              // Create new cart item
              $cartItem = Cart::create([
                  'id_pelanggan' => $userId,
                  'session_id' => $userId ? null : $sessionId,
                  'id_produk' => $request->id_produk,
                  'quantity' => $request->quantity,
                  'price' => $product->harga_jual,
                  'product_options' => null
              ]);
          }

          // Get updated cart count
          $cartCount = Cart::getCountForUserOrSession($userId, $sessionId);

          return response()->json([
              'success' => true,
              'message' => 'Produk berhasil ditambahkan ke keranjang',
              'cart_count' => $cartCount,
              'cart_item' => [
                  'id' => $cartItem->id,
                  'product_name' => $product->name,
                  'quantity' => $cartItem->quantity,
                  'subtotal' => $cartItem->formatted_subtotal
              ]
          ]);

      } catch (\Exception $e) {
          return response()->json([
              'success' => false,
              'message' => 'Terjadi kesalahan saat menambahkan ke keranjang: ' . $e->getMessage()
          ], 500);
      }
  }

  // API untuk mendapatkan jumlah item di keranjang
  public function getCartCount(Request $request)
  {
      $userId = Auth::guard('pelanggan')->id();
      $sessionId = $request->session()->getId();
      
      $cartCount = Cart::getCountForUserOrSession($userId, $sessionId);
      
      return response()->json([
          'cart_count' => $cartCount
      ]);
  }

  // API untuk mendapatkan isi keranjang
  public function getCartItems(Request $request)
  {
      $userId = Auth::guard('pelanggan')->id();
      $sessionId = $request->session()->getId();
      
      $cartItems = Cart::forUserOrSession($userId, $sessionId)
                      ->with('product')
                      ->get();
      
      $total = $cartItems->sum('subtotal');
      
      return response()->json([
          'success' => true,
          'items' => $cartItems->map(function($item) {
              return [
                  'id' => $item->id,
                  'product' => [
                      'id' => $item->product->id_produk,
                      'name' => $item->product->name,
                      'image' => $item->product->image,
                  ],
                  'quantity' => $item->quantity,
                  'price' => $item->formatted_price,
                  'subtotal' => $item->formatted_subtotal,
                  'options' => $item->product_options
              ];
          }),
          'total' => 'Rp ' . number_format($total, 0, ',', '.'),
          'count' => $cartItems->sum('quantity')
      ]);
  }
}
