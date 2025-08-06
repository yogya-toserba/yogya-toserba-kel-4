<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
  public function index()
  {
    $user = Auth::user();

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
      ['name' => 'Elektronik', 'icon' => 'fas fa-laptop', 'color' => '#3498db'],
      ['name' => 'Fashion', 'icon' => 'fas fa-tshirt', 'color' => '#e74c3c'],
      ['name' => 'Makanan', 'icon' => 'fas fa-hamburger', 'color' => '#f39c12'],
      ['name' => 'Perawatan', 'icon' => 'fas fa-spa', 'color' => '#9b59b6'],
      ['name' => 'Rumah Tangga', 'icon' => 'fas fa-home', 'color' => '#1abc9c'],
      ['name' => 'Olahraga', 'icon' => 'fas fa-dumbbell', 'color' => '#34495e'],
      ['name' => 'Otomotif', 'icon' => 'fas fa-car', 'color' => '#e67e22'],
      ['name' => 'Buku', 'icon' => 'fas fa-book', 'color' => '#95a5a6']
    ];

    // Data flash sale voucher
    $flashSaleVouchers = [
      ['discount' => '70%', 'min_purchase' => 'Min. Rp 200.000', 'code' => 'FLASH70'],
      ['discount' => '50%', 'min_purchase' => 'Min. Rp 150.000', 'code' => 'SAVE50'],
      ['discount' => '30%', 'min_purchase' => 'Min. Rp 100.000', 'code' => 'DISC30'],
      ['discount' => 'Gratis Ongkir', 'min_purchase' => 'Min. Rp 75.000', 'code' => 'FREESHIP']
    ];

    // Data produk populer
    $popularProducts = [
      [
        'id' => 1,
        'name' => 'Smartphone Samsung Galaxy A54',
        'price' => 4999000,
        'original_price' => 5999000,
        'image' => 'product1.jpg',
        'rating' => 4.8,
        'sold' => 1250
      ],
      [
        'id' => 2,
        'name' => 'Laptop ASUS VivoBook',
        'price' => 7500000,
        'original_price' => 8999000,
        'image' => 'product2.jpg',
        'rating' => 4.7,
        'sold' => 890
      ],
      [
        'id' => 3,
        'name' => 'Headphone Sony WH-1000XM4',
        'price' => 3299000,
        'original_price' => 4199000,
        'image' => 'product3.jpg',
        'rating' => 4.9,
        'sold' => 2150
      ],
      [
        'id' => 4,
        'name' => 'Smart TV LG 43 Inch',
        'price' => 5999000,
        'original_price' => 7299000,
        'image' => 'product4.jpg',
        'rating' => 4.6,
        'sold' => 567
      ]
    ];

    return view('dashboard.index', compact('user', 'promoSlides', 'categories', 'flashSaleVouchers', 'popularProducts'));
  }

  public function addToCart(Request $request)
  {
    if (!Auth::check()) {
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
