@extends('layouts.app')

@section('title', 'Fashion - MyYOGYA')

@section('content')
<!-- Category Header -->
<div class="category-header">
    <div class="container">
        <nav class="breadcrumb-custom">
            <a href="{{ route('dashboard') }}">Beranda</a>
            <span class="mx-2">/</span>
            <span>Fashion</span>
        </nav>
        
        <h1 class="display-5 fw-bold mb-3">👗 Fashion</h1>
        <p class="lead mb-0">Koleksi fashion terdepan untuk gaya hidup modern Anda</p>
    </div>
</div>

<div class="container">
    <!-- Filter Section -->
    <div class="filter-section">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="row g-3">
                    <div class="col-md-3">
                        <select class="form-select">
                            <option>Semua Kategori</option>
                            <option>Pakaian Pria</option>
                            <option>Pakaian Wanita</option>
                            <option>Sepatu</option>
                            <option>Tas & Dompet</option>
                            <option>Aksesoris</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select">
                            <option>Ukuran</option>
                            <option>XS</option>
                            <option>S</option>
                            <option>M</option>
                            <option>L</option>
                            <option>XL</option>
                            <option>XXL</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select">
                            <option>Urutkan</option>
                            <option>Harga Terendah</option>
                            <option>Harga Tertinggi</option>
                            <option>Terpopuler</option>
                            <option>Terbaru</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-end">
                <small class="text-muted">Menampilkan 1-12 dari 234 produk</small>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="product-grid">
        @foreach([
            [
                'name' => 'Kemeja Formal Pria Premium Cotton',
                'price' => 'Rp 299.000',
                'original_price' => 'Rp 399.000',
                'discount' => '25%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Kemeja+Formal',
                'rating' => 4.7,
                'reviews' => 156
            ],
            [
                'name' => 'Dress Wanita Elegant Korean Style',
                'price' => 'Rp 159.000',
                'original_price' => 'Rp 219.000',
                'discount' => '27%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Dress+Elegant',
                'rating' => 4.8,
                'reviews' => 243
            ],
            [
                'name' => 'Sepatu Sneakers Pria Casual Sport',
                'price' => 'Rp 449.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Sneakers+Sport',
                'rating' => 4.6,
                'reviews' => 189
            ],
            [
                'name' => 'Tas Handbag Wanita Kulit Premium',
                'price' => 'Rp 689.000',
                'original_price' => 'Rp 899.000',
                'discount' => '23%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Handbag+Premium',
                'rating' => 4.9,
                'reviews' => 98
            ],
            [
                'name' => 'Blouse Wanita Chiffon Modern',
                'price' => 'Rp 129.000',
                'original_price' => 'Rp 179.000',
                'discount' => '28%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Blouse+Chiffon',
                'rating' => 4.5,
                'reviews' => 167
            ],
            [
                'name' => 'Celana Jeans Pria Slim Fit',
                'price' => 'Rp 199.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Jeans+Slim+Fit',
                'rating' => 4.7,
                'reviews' => 134
            ],
            [
                'name' => 'High Heels Wanita Formal 7cm',
                'price' => 'Rp 349.000',
                'original_price' => 'Rp 449.000',
                'discount' => '22%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=High+Heels',
                'rating' => 4.4,
                'reviews' => 76
            ],
            [
                'name' => 'Jaket Bomber Pria Stylish',
                'price' => 'Rp 259.000',
                'original_price' => 'Rp 329.000',
                'discount' => '21%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Jaket+Bomber',
                'rating' => 4.6,
                'reviews' => 112
            ],
            [
                'name' => 'Rok Mini Wanita A-Line Casual',
                'price' => 'Rp 89.000',
                'original_price' => 'Rp 119.000',
                'discount' => '25%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Rok+Mini+A-Line',
                'rating' => 4.3,
                'reviews' => 89
            ],
            [
                'name' => 'Dompet Pria Kulit Asli Premium',
                'price' => 'Rp 179.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Dompet+Kulit',
                'rating' => 4.8,
                'reviews' => 203
            ],
            [
                'name' => 'Kaos Polo Pria Cotton Combed',
                'price' => 'Rp 149.000',
                'original_price' => 'Rp 199.000',
                'discount' => '25%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Kaos+Polo',
                'rating' => 4.5,
                'reviews' => 145
            ],
            [
                'name' => 'Sandal Wanita Casual Comfortable',
                'price' => 'Rp 99.000',
                'original_price' => 'Rp 139.000',
                'discount' => '29%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Sandal+Casual',
                'rating' => 4.4,
                'reviews' => 67
            ]
        ] as $product)
        <div class="product-card">
            <div class="product-image">
                <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}">
                @if($product['discount'])
                <span class="discount-badge">-{{ $product['discount'] }}</span>
                @endif
                <button class="wishlist-btn">
                    <i class="far fa-heart"></i>
                </button>
            </div>
            
            <div class="product-info">
                <h6 class="product-title">{{ $product['name'] }}</h6>
                
                <div class="product-rating">
                    <div class="stars">
                        @for($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star{{ $i <= floor($product['rating']) ? '' : ' text-muted' }}"></i>
                        @endfor
                    </div>
                    <span class="review-count">({{ $product['reviews'] }})</span>
                </div>
                
                <div class="product-price">
                    <span class="current-price">{{ $product['price'] }}</span>
                    @if($product['original_price'])
                    <span class="original-price">{{ $product['original_price'] }}</span>
                    @endif
                </div>
                
                <button class="add-to-cart-btn">
                    <i class="fas fa-shopping-cart me-2"></i>Tambah ke Keranjang
                </button>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <nav class="pagination-custom" aria-label="Product pagination">
        <ul class="pagination">
            <li class="page-item disabled">
                <span class="page-link">Previous</span>
            </li>
            <li class="page-item active">
                <span class="page-link">1</span>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">2</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">3</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">4</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>
</div>
@endsection
