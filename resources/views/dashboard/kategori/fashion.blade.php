@extends('layouts.app')

@section('title', 'Fashion - Yogya Toserba')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header Kategori -->
    <div class="mb-8">
        <nav class="text-sm breadcrumbs mb-4">
            <ul class="flex space-x-2 text-gray-600">
                <li><a href="{{ route('dashboard') }}" class="hover:text-blue-600">Home</a></li>
                <li class="before:content-['/'] before:mx-2">Fashion</li>
            </ul>
        </nav>
        
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Fashion</h1>
        <p class="text-gray-600">Koleksi fashion terdepan untuk gaya hidup modern Anda</p>
    </div>

    <!-- Filter & Sort -->
    <div class="bg-white rounded-lg shadow-sm border p-4 mb-6">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div class="flex flex-wrap items-center gap-4">
                <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <option>Semua Kategori</option>
                    <option>Pakaian Pria</option>
                    <option>Pakaian Wanita</option>
                    <option>Sepatu</option>
                    <option>Tas & Dompet</option>
                    <option>Aksesoris</option>
                </select>
                
                <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <option>Ukuran</option>
                    <option>XS</option>
                    <option>S</option>
                    <option>M</option>
                    <option>L</option>
                    <option>XL</option>
                    <option>XXL</option>
                </select>
                
                <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <option>Urutkan</option>
                    <option>Harga Terendah</option>
                    <option>Harga Tertinggi</option>
                    <option>Terpopuler</option>
                    <option>Terbaru</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <!-- Sample Products -->
        @foreach([
            [
                'name' => 'Kemeja Kasual Premium Pria',
                'price' => 'Rp 159.000',
                'original_price' => 'Rp 199.000',
                'discount' => '20%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Kemeja+Pria',
                'rating' => 4.6,
                'reviews' => 156,
                'colors' => ['#2563eb', '#dc2626', '#000000']
            ],
            [
                'name' => 'Dress Elegant Wanita',
                'price' => 'Rp 249.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Dress+Wanita',
                'rating' => 4.8,
                'reviews' => 203,
                'colors' => ['#dc2626', '#000000', '#7c3aed']
            ],
            [
                'name' => 'Sepatu Sneakers Casual',
                'price' => 'Rp 299.000',
                'original_price' => 'Rp 399.000',
                'discount' => '25%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Sneakers',
                'rating' => 4.7,
                'reviews' => 89,
                'colors' => ['#ffffff', '#000000', '#dc2626']
            ],
            [
                'name' => 'Tas Tangan Kulit Premium',
                'price' => 'Rp 459.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Tas+Kulit',
                'rating' => 4.9,
                'reviews' => 67,
                'colors' => ['#7f5539', '#000000', '#dc2626']
            ],
            [
                'name' => 'Jaket Denim Vintage',
                'price' => 'Rp 189.000',
                'original_price' => 'Rp 249.000',
                'discount' => '24%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Jaket+Denim',
                'rating' => 4.5,
                'reviews' => 134,
                'colors' => ['#1e40af', '#000000']
            ],
            [
                'name' => 'Celana Jeans Slim Fit',
                'price' => 'Rp 179.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Celana+Jeans',
                'rating' => 4.6,
                'reviews' => 198,
                'colors' => ['#1e40af', '#000000', '#374151']
            ]
        ] as $product)
        <div class="bg-white rounded-lg shadow-sm border overflow-hidden group hover:shadow-lg transition-all duration-300">
            <div class="relative">
                <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-full h-48 object-cover">
                @if($product['discount'])
                <span class="absolute top-2 left-2 bg-red-500 text-white text-xs px-2 py-1 rounded">-{{ $product['discount'] }}</span>
                @endif
                <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                    <button class="bg-white p-2 rounded-full shadow-md hover:bg-gray-50">
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </button>
                </div>
            </div>
            
            <div class="p-4">
                <h3 class="font-semibold text-gray-800 mb-2 line-clamp-2">{{ $product['name'] }}</h3>
                
                <!-- Color Options -->
                <div class="flex items-center gap-1 mb-2">
                    @foreach($product['colors'] as $color)
                    <div class="w-4 h-4 rounded-full border border-gray-300" style="background-color: {{ $color }}"></div>
                    @endforeach
                </div>
                
                <div class="flex items-center mb-2">
                    <div class="flex items-center">
                        @for($i = 1; $i <= 5; $i++)
                        <svg class="w-4 h-4 {{ $i <= floor($product['rating']) ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        @endfor
                    </div>
                    <span class="text-sm text-gray-600 ml-2">({{ $product['reviews'] }})</span>
                </div>
                
                <div class="mb-3">
                    <span class="text-lg font-bold text-blue-600">{{ $product['price'] }}</span>
                    @if($product['original_price'])
                    <span class="text-sm text-gray-500 line-through ml-2">{{ $product['original_price'] }}</span>
                    @endif
                </div>
                
                <button class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors">
                    Tambah ke Keranjang
                </button>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8 flex justify-center">
        <nav class="flex space-x-2">
            <button class="px-3 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50">Previous</button>
            <button class="px-3 py-2 bg-blue-600 text-white rounded-lg">1</button>
            <button class="px-3 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50">2</button>
            <button class="px-3 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50">3</button>
            <button class="px-3 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50">Next</button>
        </nav>
    </div>
</div>
@endsection
<title>Pilihan Produk Elektronik - Shopee Style</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f5f5f5;
        margin: 0;
        padding: 0;
    }

    .navbar {
        position: fixed;
        top: 0;
        width: 100%;
        background: white;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 10px; /* padding dikurangi supaya muat */
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        z-index: 1000;
        flex-wrap: wrap; /* biar bisa turun kalau layar sempit */
        box-sizing: border-box; /* supaya padding gak bikin overflow */
    }

    .nav-buttons {
        display: flex;
        gap: 8px;
        flex-shrink: 0; /* tombol gak mengecil */
    }

    .navbar .logo {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .navbar .logo img {
        height: 40px;
    }

    .navbar .logo-text {
        font-size: 20px;
        font-weight: bold;
        color: #f15a24;
    }

    .search-bar {
        flex: 1;
        margin: 0 20px;
        display: flex;
        align-items: center;
        background: white;
        border-radius: 30px;
        border: 2px solid #f15a24;
        overflow: hidden;
    }

    .search-bar input {
        flex: 1;
        border: none;
        padding: 10px 15px;
        font-size: 14px;
        outline: none;
    }

    .search-bar button {
        background: #f15a24;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 16px;
    }

    .btn-outline {
        border: 2px solid #f15a24;
        color: #f15a24;
        background: white;
        padding: 8px 15px;
        border-radius: 20px;
        font-weight: bold;
        text-decoration: none;
        transition: 0.3s;
    }

    .btn-outline:hover {
        background: #f15a24;
        color: white;
    }

    .btn-fill {
        background: #f15a24;
        color: white;
        padding: 8px 15px;
        border-radius: 20px;
        font-weight: bold;
        text-decoration: none;
        transition: 0.3s;
    }

    .btn-fill:hover {
        background: #d94a1d;
    }

    /* Konten */
    .content {
        margin-top: 90px; /* kasih jarak dari navbar */
        padding: 20px;
    }

    .product-container {
    display: grid;
    grid-template-columns: repeat(6, 1fr); /* 6 kolom */
    gap: 16px;
    }

    .product-card {
        background: #fff;
        border-radius: 8px;
        position: relative;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        overflow: hidden;
        transition: transform 0.2s;
    }

    .product-card:hover {
        transform: translateY(-5px);
    }

    .product-card img {
        width: 100%;
        height: 200px; /* gambar lebih tinggi */
        object-fit: cover;
    }

    .product-info {
        padding: 10px;
    }

    .product-title {
        font-size: 14px;
        height: 40px;
        overflow: hidden;
    }

    .price-section {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .price-original {
        font-size: 12px;
        text-decoration: line-through;
        color: #888;
    }

    .price-discount {
        color: #e91e63;
        font-weight: bold;
        font-size: 15px;
    }

    .sold-count {
        font-size: 12px;
        color: #666;
    }

    .discount-label {
    position: absolute;
    top: 8px;
    right: 8px;
    background: #e91e63;
    color: white;
    font-size: 13px;
    font-weight: bold;
    padding: 4px 8px;
    border-radius: 4px;
    }

</style>

<body>
    <!-- Navbar -->


    <div class="navbar">
        <div class="logo">
            <img src="{{ asset('image/logo_yogya.png') }}" alt="Lampu LED">
            <span class="logo-text">MyYOGYA</span>
        </div>

        <form class="search-bar">
            <input type="text" placeholder="Cari produk, kategori, atau brand favorit Anda...">
            <button type="submit">&#10140;</button>
        </form>

        <div class="nav-buttons">
            <a href="#" class="btn-outline">Masuk</a>
            <a href="#" class="btn-fill">Daftar</a>
        </div>
    </div>

    <!-- Produk -->
    <div class="content">
        <div class="product-container">
            <div class="product-card">
                <img src="{{ asset('image/illustration.png') }}" alt="Lampu LED">
                <span class="discount-label">-38%</span>
                <div class="product-info">
                    <div class="product-title">Fitting Saklar E27 LED Lamp Holder</div>
                    <span class="price-original">Rp 50.000</span>
                    <div class="price-section">
                        <span class="price-discount">Rp 31.000</span>
                        <span class="sold-count">Terjual 500</span>
                    </div>
                </div>
            </div>
            
            <div class="product-card">
                <img src="{{ asset('image/illustration.png') }}" alt="Lampu LED">
                <span class="discount-label">-38%</span>
                <div class="product-info">
                    <div class="product-title">Fitting Saklar E27 LED Lamp Holder</div>
                    <span class="price-original">Rp 50.000</span>
                    <div class="price-section">
                        <span class="price-discount">Rp 31.000</span>
                        <span class="sold-count">Terjual 500</span>
                    </div>
                </div>
            </div>

            <div class="product-card">
                <img src="{{ asset('image/illustration.png') }}" alt="Lampu LED">
                <span class="discount-label">-38%</span>
                <div class="product-info">
                    <div class="product-title">Fitting Saklar E27 LED Lamp Holder</div>
                    <span class="price-original">Rp 50.000</span>
                    <div class="price-section">
                        <span class="price-discount">Rp 31.000</span>
                        <span class="sold-count">Terjual 500</span>
                    </div>
                </div>
            </div>

            <div class="product-card">
                <img src="{{ asset('image/illustration.png') }}" alt="Lampu LED">
                <span class="discount-label">-38%</span>
                <div class="product-info">
                    <div class="product-title">Fitting Saklar E27 LED Lamp Holder</div>
                    <span class="price-original">Rp 50.000</span>
                    <div class="price-section">
                        <span class="price-discount">Rp 31.000</span>
                        <span class="sold-count">Terjual 500</span>
                    </div>
                </div>
            </div>

            <div class="product-card">
                <img src="{{ asset('image/illustration.png') }}" alt="Lampu LED">
                <span class="discount-label">-38%</span>
                <div class="product-info">
                    <div class="product-title">Fitting Saklar E27 LED Lamp Holder</div>
                    <span class="price-original">Rp 50.000</span>
                    <div class="price-section">
                        <span class="price-discount">Rp 31.000</span>
                        <span class="sold-count">Terjual 500</span>
                    </div>
                </div>
            </div>

            <div class="product-card">
                <img src="{{ asset('image/illustration.png') }}" alt="Lampu LED">
                <span class="discount-label">-38%</span>
                <div class="product-info">
                    <div class="product-title">Fitting Saklar E27 LED Lamp Holder</div>
                    <span class="price-original">Rp 50.000</span>
                    <div class="price-section">
                        <span class="price-discount">Rp 31.000</span>
                        <span class="sold-count">Terjual 500</span>
                    </div>
                </div>
            </div>

            <div class="product-card">
                <img src="{{ asset('image/illustration.png') }}" alt="Lampu LED">
                <span class="discount-label">-38%</span>
                <div class="product-info">
                    <div class="product-title">Fitting Saklar E27 LED Lamp Holder</div>
                    <span class="price-original">Rp 50.000</span>
                    <div class="price-section">
                        <span class="price-discount">Rp 31.000</span>
                        <span class="sold-count">Terjual 500</span>
                    </div>
                </div>
            </div>

            <div class="product-card">
                <img src="{{ asset('image/illustration.png') }}" alt="Lampu LED">
                <span class="discount-label">-38%</span>
                <div class="product-info">
                    <div class="product-title">Fitting Saklar E27 LED Lamp Holder</div>
                    <span class="price-original">Rp 50.000</span>
                    <div class="price-section">
                        <span class="price-discount">Rp 31.000</span>
                        <span class="sold-count">Terjual 500</span>
                    </div>
                </div>
            </div>

            <div class="product-card">
                <img src="{{ asset('image/illustration.png') }}" alt="Lampu LED">
                <span class="discount-label">-38%</span>
                <div class="product-info">
                    <div class="product-title">Fitting Saklar E27 LED Lamp Holder</div>
                    <span class="price-original">Rp 50.000</span>
                    <div class="price-section">
                        <span class="price-discount">Rp 31.000</span>
                        <span class="sold-count">Terjual 500</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
