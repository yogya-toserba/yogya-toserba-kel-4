@extends('layouts.app')

@section('title', 'Kesehatan & Kecantikan - MyYOGYA')

@section('content')
<!-- Category Header -->
<div class="category-header">
    <div class="container">
        <nav class="breadcrumb-custom">
            <a href="{{ route('dashboard') }}">Beranda</a>
            <span class="mx-2">/</span>
            <span>Kesehatan & Kecantikan</span>
        </nav>
        
        <h1 class="display-5 fw-bold mb-3">💄 Kesehatan & Kecantikan</h1>
        <p class="lead mb-0">Produk perawatan kesehatan dan kecantikan untuk tampil percaya diri</p>
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
                            <option>Perawatan Wajah</option>
                            <option>Perawatan Tubuh</option>
                            <option>Makeup</option>
                            <option>Perawatan Rambut</option>
                            <option>Suplemen</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select">
                            <option>Merek</option>
                            <option>Wardah</option>
                            <option>Pigeon</option>
                            <option>Vaseline</option>
                            <option>L'Oreal</option>
                            <option>Garnier</option>
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
                <small class="text-muted">Menampilkan 1-12 dari 189 produk</small>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="product-grid">
        @foreach([
            [
                'name' => 'Wardah Lightening Face Wash 60ml',
                'price' => 'Rp 15.500',
                'original_price' => 'Rp 18.900',
                'discount' => '18%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Wardah+Face+Wash',
                'rating' => 4.7,
                'reviews' => 567
            ],
            [
                'name' => 'Pigeon Baby Lotion 200ml',
                'price' => 'Rp 24.900',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Pigeon+Lotion',
                'rating' => 4.8,
                'reviews' => 432
            ],
            [
                'name' => 'Vaseline Petroleum Jelly 100ml',
                'price' => 'Rp 12.000',
                'original_price' => 'Rp 15.000',
                'discount' => '20%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Vaseline+Jelly',
                'rating' => 4.6,
                'reviews' => 789
            ],
            [
                'name' => 'L\'Oreal Paris Revitalift Day Cream',
                'price' => 'Rp 89.000',
                'original_price' => 'Rp 109.000',
                'discount' => '18%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=LOreal+Cream',
                'rating' => 4.5,
                'reviews' => 234
            ],
            [
                'name' => 'Garnier Micellar Water 125ml',
                'price' => 'Rp 28.900',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Garnier+Micellar',
                'rating' => 4.7,
                'reviews' => 345
            ],
            [
                'name' => 'Wardah BB Cream Natural 15ml',
                'price' => 'Rp 19.500',
                'original_price' => 'Rp 24.000',
                'discount' => '19%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Wardah+BB+Cream',
                'rating' => 4.6,
                'reviews' => 298
            ],
            [
                'name' => 'TRESemmé Shampoo Keratin 170ml',
                'price' => 'Rp 16.900',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Tresemme+Shampoo',
                'rating' => 4.4,
                'reviews' => 156
            ],
            [
                'name' => 'Himalaya Face Wash Neem 150ml',
                'price' => 'Rp 22.500',
                'original_price' => 'Rp 27.000',
                'discount' => '17%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Himalaya+Neem',
                'rating' => 4.5,
                'reviews' => 189
            ],
            [
                'name' => 'Nivea Soft Moisturizing Cream 50ml',
                'price' => 'Rp 18.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Nivea+Soft',
                'rating' => 4.6,
                'reviews' => 267
            ],
            [
                'name' => 'Pantene Shampoo Total Damage Care',
                'price' => 'Rp 21.900',
                'original_price' => 'Rp 25.500',
                'discount' => '14%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Pantene+Shampoo',
                'rating' => 4.7,
                'reviews' => 398
            ],
            [
                'name' => 'Citra Hand & Body Lotion 230ml',
                'price' => 'Rp 14.500',
                'original_price' => 'Rp 17.900',
                'discount' => '19%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Citra+Lotion',
                'rating' => 4.5,
                'reviews' => 123
            ],
            [
                'name' => 'Rexona Deodorant Roll On 50ml',
                'price' => 'Rp 13.900',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Rexona+Deodorant',
                'rating' => 4.4,
                'reviews' => 201
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
