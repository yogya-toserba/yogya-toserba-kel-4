@extends('layouts.customer')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid py-4">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body text-white p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="mb-2">Selamat Datang, {{ Auth::guard('pelanggan')->user()->nama }}! 👋</h3>
                            <p class="mb-0 opacity-90">Selamat berbelanja dan temukan produk terbaik untuk kebutuhan Anda.</p>
                        </div>
                        <div class="col-md-4 text-end d-none d-md-block">
                            <i class="fas fa-shopping-cart fa-3x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(isset($promoSlides) && count($promoSlides) > 0)
    <!-- Promo Slider -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0"><i class="fas fa-fire text-danger me-2"></i>Promo Spesial</h5>
                </div>
                <div class="card-body p-0">
                    <div id="promoCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($promoSlides as $index => $promo)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <div class="p-4 text-center" style="background: linear-gradient(45deg, #ff9a9e 0%, #fecfef 100%);">
                                    <h4 class="text-dark">{{ $promo['title'] }}</h4>
                                    <p class="text-dark mb-3">{{ $promo['description'] }}</p>
                                    <span class="badge bg-warning text-dark px-3 py-2">{{ $promo['discount'] }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#promoCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#promoCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Quick Stats -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="text-primary mb-3">
                        <i class="fas fa-shopping-bag fa-2x"></i>
                    </div>
                    <h5 class="card-title">Total Pembelian</h5>
                    <h3 class="text-primary mb-0">24</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="text-success mb-3">
                        <i class="fas fa-star fa-2x"></i>
                    </div>
                    <h5 class="card-title">Poin Reward</h5>
                    <h3 class="text-success mb-0">1,250</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="text-warning mb-3">
                        <i class="fas fa-heart fa-2x"></i>
                    </div>
                    <h5 class="card-title">Wishlist</h5>
                    <h3 class="text-warning mb-0">8</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="text-info mb-3">
                        <i class="fas fa-shipping-fast fa-2x"></i>
                    </div>
                    <h5 class="card-title">Dalam Pengiriman</h5>
                    <h3 class="text-info mb-0">2</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @if(isset($categories) && count($categories) > 0)
        <!-- Categories -->
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0"><i class="fas fa-th-large text-info me-2"></i>Kategori Produk</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($categories->take(6) as $category)
                        <div class="col-6 mb-3">
                            <a href="{{ $category['url'] }}" class="text-decoration-none">
                                <div class="p-3 bg-light rounded-3 text-center hover-shadow-sm">
                                    <i class="fas fa-cube text-primary mb-2"></i>
                                    <div class="small fw-medium">{{ $category['name'] }}</div>
                                    <div class="text-muted" style="font-size: 0.8rem;">{{ $category['count'] }} produk</div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if(isset($popularProducts) && count($popularProducts) > 0)
        <!-- Popular Products -->
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0"><i class="fas fa-fire text-danger me-2"></i>Produk Populer</h5>
                </div>
                <div class="card-body">
                    @foreach($popularProducts->take(4) as $product)
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-shrink-0">
                            <div class="bg-light rounded-3 p-2" style="width: 60px; height: 60px;">
                                <i class="fas fa-box text-primary d-block text-center" style="line-height: 44px;"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1">{{ $product['name'] }}</h6>
                            <div class="text-primary fw-medium">Rp {{ number_format($product['price'], 0, ',', '.') }}</div>
                            <small class="text-muted">{{ $product['sold'] }} terjual</small>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Recent Orders -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-history text-secondary me-2"></i>Pesanan Terakhir</h5>
                    <a href="#" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="border rounded-3 p-3">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <span class="badge bg-warning text-dark">Dikemas</span>
                                    <small class="text-muted">15 Jan 2024</small>
                                </div>
                                <h6 class="mb-1">Order #ORD-001</h6>
                                <p class="mb-2 text-muted small">3 item • Rp 245,000</p>
                                <button class="btn btn-sm btn-outline-primary w-100">Lacak Pesanan</button>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="border rounded-3 p-3">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <span class="badge bg-info">Dikirim</span>
                                    <small class="text-muted">12 Jan 2024</small>
                                </div>
                                <h6 class="mb-1">Order #ORD-002</h6>
                                <p class="mb-2 text-muted small">1 item • Rp 89,000</p>
                                <button class="btn btn-sm btn-outline-primary w-100">Lacak Pesanan</button>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="border rounded-3 p-3">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <span class="badge bg-success">Selesai</span>
                                    <small class="text-muted">10 Jan 2024</small>
                                </div>
                                <h6 class="mb-1">Order #ORD-003</h6>
                                <p class="mb-2 text-muted small">2 item • Rp 156,000</p>
                                <button class="btn btn-sm btn-outline-secondary w-100">Beri Ulasan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.hover-shadow-sm:hover {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
    transition: box-shadow 0.15s ease-in-out;
}
</style>
@endsection
