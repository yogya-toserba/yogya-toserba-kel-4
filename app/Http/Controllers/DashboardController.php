<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
  public function index()
  {
    $user = Auth::guard('pelanggan')->user() ?: Auth::user();

    // Data untuk slider promo
    $promoSlides = [
      [
        'image' => 'promo1.jpg',
        'title' => 'Flash Sale 70% Off',
        'subtitle' => 'Belanja sekarang dan dapatkan diskon hingga 70%',
        'button_text' => 'Belanja Sekarang',
        'button_link' => '#flash-sale'
      ],
      [
        'image' => 'promo2.jpg',
        'title' => 'Gratis Ongkir',
        'subtitle' => 'Gratis ongkos kirim untuk pembelian minimal Rp 100.000',
        'button_text' => 'Claim Sekarang',
        'button_link' => '#voucher'
      ],
      [
        'image' => 'promo3.jpg',
        'title' => 'Member Baru Diskon 50%',
        'subtitle' => 'Daftar sekarang dan dapatkan voucher diskon 50%',
        'button_text' => 'Daftar Sekarang',
        'button_link' => route('pelanggan.register')
      ]
    ];

    // Data kategori
    $categories = [
        ['name' => 'Elektronik', 'icon' => 'fas fa-laptop', 'color' => '#3498db', 'url' => route('kategori.elektronik')],
        ['name' => 'Fashion', 'icon' => 'fas fa-tshirt', 'color' => '#e74c3c', 'url' => route('kategori.fashion')],
        ['name' => 'Makanan', 'icon' => 'fas fa-hamburger', 'color' => '#f39c12', 'url' => route('kategori.makanan')],
        ['name' => 'Perawatan', 'icon' => 'fas fa-spa', 'color' => '#9b59b6', 'url' => route('kategori.perawatan')],
        ['name' => 'Rumah Tangga', 'icon' => 'fas fa-home', 'color' => '#1abc9c', 'url' => route('kategori.rumah-tangga')],
        ['name' => 'Olahraga', 'icon' => 'fas fa-dumbbell', 'color' => '#34495e', 'url' => route('kategori.olahraga')],
        ['name' => 'Otomotif', 'icon' => 'fas fa-car', 'color' => '#e67e22', 'url' => route('kategori.otomotif')],
        ['name' => 'Buku', 'icon' => 'fas fa-book', 'color' => '#95a5a6', 'url' => route('kategori.buku')],
    ];


    // Data flash sale voucher
    $flashSaleVouchers = [
      ['discount' => '70%', 'min_purchase' => 'Min. Rp 200.000', 'code' => 'FLASH70'],
      ['discount' => '50%', 'min_purchase' => 'Min. Rp 150.000', 'code' => 'SAVE50'],
      ['discount' => '30%', 'min_purchase' => 'Min. Rp 100.000', 'code' => 'DISC30'],
      ['discount' => 'Gratis Ongkir', 'min_purchase' => 'Min. Rp 75.000', 'code' => 'FREESHIP']
    ];

    // Data produk populer berdasarkan transaksi terlaris
    $popularProducts = DB::table('detail_transaksi')
      ->join('stok_produk', 'detail_transaksi.id_produk', '=', 'stok_produk.id_produk')
      ->join('kategori', 'stok_produk.id_kategori', '=', 'kategori.id_kategori')
      ->select(
        'stok_produk.id_produk',
        'stok_produk.nama_barang as name',
        'stok_produk.harga_jual as price',
        'stok_produk.foto as image',
        'kategori.nama_kategori',
        DB::raw('SUM(detail_transaksi.jumlah_barang) as total_sold'),
        DB::raw('COUNT(detail_transaksi.id_transaksi) as transaction_count'),
        DB::raw('AVG(4.5 + (RAND() * 0.5)) as rating'), // Rating simulasi 4.5-5.0
        DB::raw('ROUND(stok_produk.harga_jual * 1.2) as original_price') // Harga asli simulasi 20% lebih tinggi
      )
      ->groupBy('stok_produk.id_produk', 'stok_produk.nama_barang', 'stok_produk.harga_jual', 'stok_produk.foto', 'kategori.nama_kategori')
      ->orderByDesc('total_sold')
      ->limit(8)
      ->get()
      ->map(function ($product) {
        return [
          'id' => $product->id_produk,
          'name' => $product->name,
          'price' => (int) $product->price,
          'original_price' => (int) $product->original_price,
          'image' => $product->image ?: 'default-product.jpg',
          'rating' => round($product->rating, 1),
          'sold' => (int) $product->total_sold,
          'category' => $product->nama_kategori
        ];
      })
      ->toArray();

    // Jika tidak ada data transaksi, gunakan produk dari stok_produk
    if (empty($popularProducts)) {
      $popularProducts = DB::table('stok_produk')
        ->join('kategori', 'stok_produk.id_kategori', '=', 'kategori.id_kategori')
        ->select(
          'stok_produk.id_produk as id',
          'stok_produk.nama_barang as name',
          'stok_produk.harga_jual as price',
          'stok_produk.foto as image',
          'kategori.nama_kategori as category',
          DB::raw('ROUND(stok_produk.harga_jual * 1.2) as original_price'),
          DB::raw('(4.0 + (RAND() * 1.0)) as rating'),
          DB::raw('FLOOR(10 + (RAND() * 500)) as sold')
        )
        ->where('stok_produk.stok', '>', 0) // Pastikan ada stok
        ->orderBy('stok_produk.stok', 'desc')
        ->limit(8)
        ->get()
        ->map(function ($product) {
          return [
            'id' => (int) $product->id,
            'name' => $product->name,
            'price' => (int) $product->price,
            'original_price' => (int) $product->original_price,
            'image' => $product->image ?: 'default-product.jpg',
            'rating' => round($product->rating, 1),
            'sold' => (int) $product->sold,
            'category' => $product->category
          ];
        })
        ->toArray();
    }

    // Fallback jika masih kosong
    if (empty($popularProducts)) {
      $popularProducts = [
        [
          'id' => 1,
          'name' => 'Produk Sample 1',
          'price' => 50000,
          'original_price' => 60000,
          'image' => 'default-product.jpg',
          'rating' => 4.5,
          'sold' => 100,
          'category' => 'Sample'
        ],
        [
          'id' => 2,
          'name' => 'Produk Sample 2',
          'price' => 75000,
          'original_price' => 90000,
          'image' => 'default-product.jpg',
          'rating' => 4.2,
          'sold' => 85,
          'category' => 'Sample'
        ]
      ];
    }

    return view('dashboard.index', compact('user', 'promoSlides', 'categories', 'flashSaleVouchers', 'popularProducts'));
  }

  public function addToCart(Request $request)
  {
    if (!Auth::guard('pelanggan')->check() && !Auth::check()) {
      return response()->json([
        'success' => false,
        'message' => 'Silakan login terlebih dahulu untuk menambahkan produk ke keranjang.',
        'redirect' => route('pelanggan.login')
      ]);
    }

    // Logic untuk menambah ke keranjang
    // Untuk sementara hanya return success
    return response()->json([
      'success' => true,
      'message' => 'Produk berhasil ditambahkan ke keranjang!'
    ]);
  }
}
