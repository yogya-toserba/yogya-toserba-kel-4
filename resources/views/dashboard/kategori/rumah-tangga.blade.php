@extends('layouts.app')

@section('title', 'Rumah Tangga - MyYOGYA')

@section('content')
<!-- Category Header -->
<div class="category-header">
    <div class="container">
        <nav class="breadcrumb-custom">
            <a href="{{ route('dashboard') }}">Beranda</a>
            <span class="mx-2">/</span>
            <span>Rumah Tangga</span>
        </nav>
        
        <h1 class="display-5 fw-bold mb-3">🏠 Rumah Tangga</h1>
        <p class="lead mb-0">Perlengkapan rumah tangga untuk kenyamanan keluarga Anda</p>
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
                            <option>Elektronik Rumah</option>
                            <option>Peralatan Dapur</option>
                            <option>Peralatan Mandi</option>
                            <option>Furnitur</option>
                            <option>Dekorasi</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select">
                            <option>Rentang Harga</option>
                            <option>< Rp 100.000</option>
                            <option>Rp 100.000-500.000</option>
                            <option>Rp 500.000-1.000.000</option>
                            <option>> Rp 1.000.000</option>
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
                <small class="text-muted">Menampilkan 1-12 dari 134 produk</small>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="product-grid">
        @foreach([
            [
                'name' => 'Rice Cooker Cosmos CRJ-6601 1.8L',
                'price' => 'Rp 299.000',
                'original_price' => 'Rp 350.000',
                'discount' => '15%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Rice+Cooker',
                'rating' => 4.6,
                'reviews' => 378
            ],
            [
                'name' => 'Blender Miyako BL-152 PF 1.5L',
                'price' => 'Rp 189.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Blender+Miyako',
                'rating' => 4.4,
                'reviews' => 534
            ],
            [
                'name' => 'Setrika Uap Philips GC1430 1400W',
                'price' => 'Rp 245.000',
                'original_price' => 'Rp 285.000',
                'discount' => '14%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Setrika+Philips',
                'rating' => 4.5,
                'reviews' => 245
            ],
            [
                'name' => 'Kipas Angin Maspion EX-455 16 inch',
                'price' => 'Rp 125.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Kipas+Maspion',
                'rating' => 4.3,
                'reviews' => 698
            ],
            [
                'name' => 'Dispenser Sanken HWD-Z87 Hot & Cool',
                'price' => 'Rp 485.000',
                'original_price' => 'Rp 550.000',
                'discount' => '12%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Dispenser+Sanken',
                'rating' => 4.6,
                'reviews' => 189
            ],
            [
                'name' => 'Set Panci Teflon Anti Lengket 7 Pcs',
                'price' => 'Rp 185.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Set+Panci+Teflon',
                'rating' => 4.7,
                'reviews' => 423
            ],
            [
                'name' => 'Vacuum Cleaner Electrolux Z1230',
                'price' => 'Rp 625.000',
                'original_price' => 'Rp 750.000',
                'discount' => '17%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Vacuum+Electrolux',
                'rating' => 4.5,
                'reviews' => 156
            ],
            [
                'name' => 'Kursi Plastik Napolly Olymplast',
                'price' => 'Rp 45.000',
                'original_price' => 'Rp 55.000',
                'discount' => '18%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Kursi+Napolly',
                'rating' => 4.2,
                'reviews' => 789
            ],
            [
                'name' => 'Lemari Pakaian 3 Pintu Kayu Jati',
                'price' => 'Rp 1.250.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Lemari+3+Pintu',
                'rating' => 4.8,
                'reviews' => 67
            ],
            [
                'name' => 'Kompor Gas Rinnai RI-522E 2 Tungku',
                'price' => 'Rp 385.000',
                'original_price' => 'Rp 450.000',
                'discount' => '14%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Kompor+Rinnai',
                'rating' => 4.6,
                'reviews' => 298
            ],
            [
                'name' => 'Gorden Minimalis Anti UV 150x200cm',
                'price' => 'Rp 85.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Gorden+Minimalis',
                'rating' => 4.4,
                'reviews' => 234
            ],
            [
                'name' => 'Tempat Sampah Otomatis Sensor 12L',
                'price' => 'Rp 125.000',
                'original_price' => 'Rp 155.000',
                'discount' => '19%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Tempat+Sampah',
                'rating' => 4.5,
                'reviews' => 345
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