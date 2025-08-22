@extends('layouts.app')

@section('title', 'Makanan & Minuman - MyYOGYA')

@section('content')
<!-- Category Header -->
<div class="category-header">
    <div class="container">
        <nav class="breadcrumb-custom">
            <a href="{{ route('dashboard') }}">Beranda</a>
            <span class="mx-2">/</span>
            <span>Makanan & Minuman</span>
        </nav>
        
        <h1 class="display-5 fw-bold mb-3">🍕 Makanan & Minuman</h1>
        <p class="lead mb-0">Nikmati berbagai pilihan makanan dan minuman segar berkualitas</p>
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
                            <option>Makanan Instan</option>
                            <option>Minuman</option>
                            <option>Snack & Cemilan</option>
                            <option>Roti & Kue</option>
                            <option>Bumbu & Masakan</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select">
                            <option>Merek</option>
                            <option>Indomie</option>
                            <option>Coca-Cola</option>
                            <option>Chitato</option>
                            <option>Pepsi</option>
                            <option>Teh Botol</option>
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
                <small class="text-muted">Menampilkan 1-12 dari 467 produk</small>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="product-grid">
        @foreach([
            [
                'name' => 'Indomie Goreng Rendang 5 Pcs',
                'price' => 'Rp 12.500',
                'original_price' => 'Rp 15.000',
                'discount' => '17%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Indomie+Rendang',
                'rating' => 4.8,
                'reviews' => 1254
            ],
            [
                'name' => 'Coca-Cola Original 330ml x 6',
                'price' => 'Rp 18.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Coca+Cola',
                'rating' => 4.6,
                'reviews' => 789
            ],
            [
                'name' => 'Chitato Rasa BBQ 68g x 3',
                'price' => 'Rp 22.500',
                'original_price' => 'Rp 27.000',
                'discount' => '17%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Chitato+BBQ',
                'rating' => 4.7,
                'reviews' => 456
            ],
            [
                'name' => 'Oreo Original Biskuit 137g',
                'price' => 'Rp 8.900',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Oreo+Original',
                'rating' => 4.9,
                'reviews' => 623
            ],
            [
                'name' => 'Teh Botol Sosro 450ml x 12',
                'price' => 'Rp 36.000',
                'original_price' => 'Rp 42.000',
                'discount' => '14%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Teh+Botol',
                'rating' => 4.5,
                'reviews' => 234
            ],
            [
                'name' => 'Kopi Kapal Api Special Mix 25 Sachet',
                'price' => 'Rp 24.900',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Kopi+Kapal+Api',
                'rating' => 4.6,
                'reviews' => 345
            ],
            [
                'name' => 'Beng-beng Wafer Coklat 20 Pcs',
                'price' => 'Rp 31.000',
                'original_price' => 'Rp 36.000',
                'discount' => '14%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Beng+Beng',
                'rating' => 4.7,
                'reviews' => 189
            ],
            [
                'name' => 'Aqua Botol 600ml x 12',
                'price' => 'Rp 18.500',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Aqua+600ml',
                'rating' => 4.4,
                'reviews' => 567
            ],
            [
                'name' => 'Richeese Nabati Ahh Keju 50g',
                'price' => 'Rp 6.500',
                'original_price' => 'Rp 7.500',
                'discount' => '13%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Richeese+Keju',
                'rating' => 4.8,
                'reviews' => 432
            ],
            [
                'name' => 'Nescafe 3in1 Original 20 Sachet',
                'price' => 'Rp 28.900',
                'original_price' => 'Rp 32.000',
                'discount' => '10%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Nescafe+3in1',
                'rating' => 4.5,
                'reviews' => 298
            ],
            [
                'name' => 'Lay\'s Potato Chips Rumput Laut 68g',
                'price' => 'Rp 9.900',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Lays+Rumput+Laut',
                'rating' => 4.6,
                'reviews' => 156
            ],
            [
                'name' => 'Ultra Milk Coklat 250ml x 6',
                'price' => 'Rp 21.000',
                'original_price' => 'Rp 24.000',
                'discount' => '13%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Ultra+Milk',
                'rating' => 4.7,
                'reviews' => 312
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
