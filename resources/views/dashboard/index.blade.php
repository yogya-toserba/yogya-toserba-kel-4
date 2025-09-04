<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyYOGYA - Belanja Online Terpercaya</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Custom CSS (consolidated) -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <!-- Google Fonts - Roboto Mono -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Ultra Elegant Login Required Modal -->
    <div class="modal login-required-modal" id="loginRequiredModal" tabindex="-1" aria-labelledby="loginRequiredModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="login-icon-container">
                        <div class="login-icon">
                            <i class="fas fa-user-shield"></i>
                        </div>
                    </div>
                    
                    <h2 class="modal-title" id="loginRequiredModalLabel">Akses Eksklusif</h2>
                    <p class="modal-text">
                        Bergabunglah dengan MyYOGYA untuk menikmati pengalaman berbelanja yang luar biasa dengan penawaran eksklusif, voucher spesial, dan layanan premium yang dirancang khusus untuk Anda.
                    </p>
                    
                    <div class="modal-buttons">
                        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">
                            <i class="fas fa-arrow-left me-2"></i>Nanti Saja
                        </button>
                        <a href="{{ route('pelanggan.login') }}" class="btn btn-login">
                            <i class="fas fa-sign-in-alt me-2"></i>Masuk Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Promo Notification Modal -->
    <div class="modal" id="promoModal" tabindex="-1" aria-labelledby="promoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content promo-modal">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <!-- Welcome Icon -->
                    <div class="promo-icon welcome-icon">
                        <i class="fas fa-gift fa-3x text-white"></i>
                    </div>
                    
                    <!-- Welcome Section -->
                    <div class="welcome-section">
                        <h3 class="welcome-title">Selamat Datang di</h3>
                        <h2 class="brand-title">MyYOGYA</h2>
                        <p class="platform-subtitle">Platform Belanja Online Terpercaya #1 di Indonesia</p>
                        
                        <div class="features-highlight">
                            <p class="features-text">
                                ✨ Ribuan Produk Berkualitas &nbsp;|&nbsp; 🚚 Gratis Ongkir &nbsp;|&nbsp; 💰 Harga Terjangkau ✨
                            </p>
                        </div>
                    </div>
                    
                    <!-- Voucher Section -->
                    <div class="voucher-section">
                        <h4 class="voucher-title">🎉 Dapatkan Voucher Spesial 🎉</h4>
                        <div class="voucher-code">
                            <span class="code">WELCOME70</span>
                        </div>
                        <p class="voucher-description">Diskon hingga 70% untuk pembelian pertama Anda!</p>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="modal-buttons">
                        <button type="button" class="btn btn-claim" data-bs-dismiss="modal">
                            <i class="fas fa-gift me-2"></i>Claim Voucher Sekarang
                        </button>
                        
                        @guest
                            <div class="auth-buttons">
                                <a href="{{ route('pelanggan.login') }}" class="btn btn-login">
                                    <i class="fas fa-sign-in-alt me-1"></i>Login
                                </a>
                                <a href="{{ route('pelanggan.register') }}" class="btn btn-register">
                                    <i class="fas fa-user-plus me-1"></i>Daftar
                                </a>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <div class="logo-container">
                    <img src="{{ asset('image/logo_yogya.png') }}" alt="MyYOGYA" height="45">
                    <div class="brand-info">
                        <span class="brand-text">MyYOGYA</span>
                        <span class="brand-tagline">Belanja Pintar</span>
                    </div>
                 </div>
            </a>

            <!-- Search Bar -->
            <div class="search-container mx-auto">
                <div class="search-box">
                    <div class="search-icon-left">
                        <i class="fas fa-search"></i>
                    </div>
                    <input type="text" class="form-control search-input" placeholder="Cari produk, kategori, atau brand favorit Anda...">
                    <button class="search-btn">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
                <div class="search-suggestions">
                    <span class="suggestion-tag">Elektronik</span>
                    <span class="suggestion-tag">Fashion</span>
                    <span class="suggestion-tag">Makanan</span>
                </div>
            </div>

            <!-- User Actions -->
            <div class="navbar-actions d-flex align-items-center">
                @auth('pelanggan')
                    <!-- Logged in user -->
                    <div class="nav-item dropdown me-3">
                        <a class="nav-link notification-link" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown">
                            <div class="nav-icon-wrapper">
                                <i class="fas fa-bell"></i>
                                <span class="notification-badge pulse">3</span>
                            </div>
                        </a>
                        <ul class="dropdown-menu notification-dropdown">
                            <li><h6 class="dropdown-header">
                                <i class="fas fa-bell me-2"></i>Notifikasi Terbaru
                            </h6></li>
                            <li><a class="dropdown-item" href="#">
                                <div class="notification-item">
                                    <i class="fas fa-shipping-fast text-success"></i>
                                    <span>Pesanan Anda sedang dikirim</span>
                                </div>
                            </a></li>
                            <li><a class="dropdown-item" href="#">
                                <div class="notification-item">
                                    <i class="fas fa-bolt text-warning"></i>
                                    <span>Flash Sale dimulai dalam 1 jam</span>
                                </div>
                            </a></li>
                            <li><a class="dropdown-item" href="#">
                                <div class="notification-item">
                                    <i class="fas fa-gift text-primary"></i>
                                    <span>Voucher baru tersedia</span>
                                </div>
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-center fw-bold" href="#">Lihat Semua Notifikasi</a></li>
                        </ul>
                    </div>

                    <div class="nav-item me-3">
                        <a class="nav-link cart-link" href="#">
                            <div class="nav-icon-wrapper">
                                <i class="fas fa-shopping-cart"></i>
                                <span class="cart-badge bounce">2</span>
                            </div>
                        </a>
                    </div>

                    <div class="nav-item dropdown">
                        <a class="nav-link profile-link" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown">
                            <div class="profile-info">
                                <div class="avatar">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="user-details">
                                    <span class="user-name">{{ auth('pelanggan')->user()->nama }}</span>
                                    <span class="user-status">Premium Member</span>
                                </div>
                                <i class="fas fa-chevron-down ms-2"></i>
                            </div>
                        </a>
                        <ul class="dropdown-menu profile-dropdown">
                            <li class="dropdown-header">
                                <div class="profile-header">
                                    <div class="avatar-large">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ auth('pelanggan')->user()->nama }}</h6>
                                        <small class="text-muted">Premium Member</small>
                                    </div>
                                </div>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('pelanggan.profile') }}"><i class="fas fa-user me-2"></i>Profile Saya</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-box me-2"></i>Pesanan Saya</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-heart me-2"></i>Wishlist</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-wallet me-2"></i>Dompet Digital</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Pengaturan</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('pelanggan.logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <!-- Guest user -->
                    <div class="nav-item me-2">
                        <a href="{{ route('pelanggan.login') }}" class="btn btn-nav-outline">
                            <i class="fas fa-sign-in-alt me-2"></i>Masuk
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="{{ route('pelanggan.register') }}" class="btn btn-nav-primary">
                            <i class="fas fa-user-plus me-2"></i>Daftar
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Success Message Alert -->
    @if(session('success'))
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <!-- Hero Slider -->
    <section class="hero-slider">
        <div id="promoCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-indicators">
                @foreach($promoSlides as $index => $slide)
                    <button type="button" data-bs-target="#promoCarousel" data-bs-slide-to="{{ $index }}" 
                            class="{{ $index === 0 ? 'active' : '' }}" aria-current="true" aria-label="Slide {{ $index + 1 }}"></button>
                @endforeach
            </div>
            
            <div class="carousel-inner">
                @foreach($promoSlides as $index => $slide)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="slide-content slide-{{ $index + 1 }}">
                            <div class="slide-overlay"></div>
                            <div class="slide-pattern"></div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-8 mx-auto text-center">
                                        <div class="slide-content-wrapper">
                                            <div class="slide-badge">
                                                @if($index === 0)
                                                    <i class="fas fa-bolt"></i> FLASH SALE
                                                @elseif($index === 1)
                                                    <i class="fas fa-shipping-fast"></i> FREE SHIPPING
                                                @else
                                                    <i class="fas fa-star"></i> NEW MEMBER
                                                @endif
                                            </div>
                                            <h1 class="slide-title">{{ $slide['title'] }}</h1>
                                            <p class="slide-subtitle">{{ $slide['subtitle'] }}</p>
                                            <div class="slide-features">
                                                @if($index === 0)
                                                    <span class="feature-item"><i class="fas fa-tag"></i> Diskon Hingga 70%</span>
                                                    <span class="feature-item"><i class="fas fa-clock"></i> Terbatas</span>
                                                    <span class="feature-item"><i class="fas fa-fire"></i> Best Deal</span>
                                                @elseif($index === 1)
                                                    <span class="feature-item"><i class="fas fa-truck"></i> Gratis Ongkir</span>
                                                    <span class="feature-item"><i class="fas fa-box"></i> Min. Rp 100K</span>
                                                    <span class="feature-item"><i class="fas fa-globe"></i> Seluruh Indonesia</span>
                                                @else
                                                    <span class="feature-item"><i class="fas fa-gift"></i> Voucher 50%</span>
                                                    <span class="feature-item"><i class="fas fa-users"></i> Member Baru</span>
                                                    <span class="feature-item"><i class="fas fa-crown"></i> Exclusive</span>
                                                @endif
                                            </div>
                                            <div class="slide-actions">
                                                <a href="#produk-terlaris" class="btn btn-hero-primary" onclick="scrollToSection('produk-terlaris')">
                                                    {{ $slide['button_text'] }}
                                                    <i class="fas fa-arrow-right ms-2"></i>
                                                </a>
                                                <a href="#flash-sale" class="btn btn-hero-secondary">
                                                    Lihat Produk
                                                    <i class="fas fa-eye ms-2"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="slide-decoration">
                                <div class="decoration-circle circle-1"></div>
                                <div class="decoration-circle circle-2"></div>
                                <div class="decoration-circle circle-3"></div>
                                <div class="decoration-triangle triangle-1"></div>
                                <div class="decoration-triangle triangle-2"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Flash Sale Section -->
    <section class="flash-sale" id="flash-sale">
        <div class="flash-sale-wrapper">
            <!-- Section Header -->
            <div class="flash-sale-header">
                <h2 class="section-title"><i class="fas fa-bolt"></i> Flash Sale</h2>
            </div>
            <div class="flash-sale-subheader">
                <div class="flash-sale-timer">
                    <span class="timer-text">Berakhir dalam:</span>
                    <span class="timer-value" id="timer">23:59:41</span>
                </div>
            </div>

            <!-- Voucher Grid -->
            <div class="flash-sale-grid">
                <!-- 70% Voucher -->
                <div class="voucher-item">
                    <div class="voucher-header">
                        <div class="discount-badge">70%</div>
                        <div class="min-purchase">MINIMAL PEMBELIAN Rp 200.000</div>
                    </div>
                    <div class="voucher-box">
                        <div class="code-info">
                            <span class="code">FLASH70</span>
                            <button class="copy-btn" data-code="FLASH70">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                    </div>
                    <button class="claim-btn available" aria-label="Klaim voucher FLASH70">KLAIM SEKARANG</button>
                </div>

                <!-- 50% Voucher -->
                <div class="voucher-item">
                    <div class="voucher-header">
                        <div class="discount-badge">50%</div>
                        <div class="min-purchase">MINIMAL PEMBELIAN Rp 150.000</div>
                    </div>
                    <div class="voucher-box">
                        <div class="code-info">
                            <span class="code">SAVE50</span>
                            <button class="copy-btn" data-code="SAVE50">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                    </div>
                    <button class="claim-btn available" aria-label="Klaim voucher SAVE50">KLAIM SEKARANG</button>
                </div>

                <!-- 30% Voucher -->
                <div class="voucher-item">
                    <div class="voucher-header">
                        <div class="discount-badge">30%</div>
                        <div class="min-purchase">MINIMAL PEMBELIAN Rp 100.000</div>
                    </div>
                    <div class="voucher-box">
                        <div class="code-info">
                            <span class="code">DISC30</span>
                            <button class="copy-btn" data-code="DISC30">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                    </div>
                    <button class="claim-btn available" aria-label="Klaim voucher DISC30">KLAIM SEKARANG</button>
                </div>

                <!-- Free Shipping Voucher -->
                <div class="voucher-item">
                    <div class="voucher-header">
                        <div class="discount-badge">GRATIS ONGKIR</div>
                        <div class="min-purchase">MINIMAL PEMBELIAN Rp 75.000</div>
                    </div>
                    <div class="voucher-box">
                        <div class="code-info">
                            <span class="code">FREESHIP</span>
                            <button class="copy-btn" data-code="FREESHIP">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                    </div>
                    <button class="claim-btn available" aria-label="Klaim voucher FREESHIP">KLAIM SEKARANG</button>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section -->
<section class="categories">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Kategori Populer</h2>
            <p class="section-subtitle">Temukan produk sesuai kebutuhan Anda</p>
        </div>
        
        <div class="row">
            @foreach($categories as $category)
                <div class="col-lg-3 col-md-4 col-6 mb-4">
                    <a href="{{ $category['url'] }}" class="text-decoration-none">
                        <div class="category-card" style="--category-color: {{ $category['color'] }}">
                            <div class="category-icon">
                                <i class="{{ $category['icon'] }}"></i>
                            </div>
                            <h5 class="category-name">{{ $category['name'] }}</h5>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>


    <!-- Popular Products Section -->
    <section class="popular-products" id="produk-terlaris">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Produk Terlaris</h2>
                <p class="section-subtitle">Produk pilihan yang paling banyak dibeli</p>
            </div>
            
            <div class="row">
                @foreach($popularProducts as $product)
                    <div class="col-lg-3 col-md-6 mb-4 d-flex">
                        <div class="product-card w-100">
                            <div class="product-image">
                                <img src="{{ asset('image/illustration.png') }}" alt="{{ $product['name'] }}" class="img-fluid">
                                <div class="product-badge">
                                    <span class="discount-badge">
                                        {{ round((($product['original_price'] - $product['price']) / $product['original_price']) * 100) }}%
                                    </span>
                                </div>
                            </div>
                            <div class="product-info">
                                <h6 class="product-name">{{ $product['name'] }}</h6>
                                <div class="product-rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= floor($product['rating']))
                                            <i class="fas fa-star text-warning"></i>
                                        @elseif($i <= $product['rating'])
                                            <i class="fas fa-star-half-alt text-warning"></i>
                                        @else
                                            <i class="far fa-star text-warning"></i>
                                        @endif
                                    @endfor
                                    <span class="rating-text">({{ $product['rating'] }}) | {{ $product['sold'] }} terjual</span>
                                </div>
                                <div class="product-price">
                                    <span class="current-price">Rp {{ number_format($product['price'], 0, ',', '.') }}</span>
                                    <span class="original-price">Rp {{ number_format($product['original_price'], 0, ',', '.') }}</span>
                                </div>
                                <button class="btn btn-primary btn-sm btn-add-cart" data-product-id="{{ $product['id'] }}">
                                    <i class="fas fa-shopping-cart me-1"></i>Keranjang
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter">
        <div class="container">
            <div class="newsletter-content">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h3 class="newsletter-title">Jangan Lewatkan Promo Terbaru!</h3>
                        <p class="newsletter-subtitle">Berlangganan newsletter kami untuk mendapatkan informasi promo eksklusif dan penawaran menarik lainnya.</p>
                    </div>
                    <div class="col-lg-6">
                        <form class="newsletter-form">
                            <div class="input-group">
                                <input type="email" class="form-control" placeholder="Masukkan email Anda...">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-paper-plane me-2"></i>Berlangganan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="footer-brand">
                        <h5 class="mb-2">MyYOGYA</h5>
                        <p>Platform belanja online terpercaya dengan ribuan produk berkualitas dan pelayanan terbaik untuk kepuasan Anda.</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="footer-title">Tentang Kami</h6>
                    <ul class="footer-links">
                        <li><a href="{{ route('tentang') }}">Tentang MyYOGYA</a></li>
                        <li><a href="{{ route('karir') }}">Karir</a></li>
                        <li><a href="{{ route('investor-relations') }}">Investor Relations</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="footer-title">Layanan</h6>
                    <ul class="footer-links">
                        <li><a href="{{ route('layanan') }}">Bantuan</a></li>
                        <li><a href="{{ route('cara-belanja') }}">Cara Belanja</a></li>
                        <li><a href="{{ route('pengiriman') }}">Pengiriman</a></li>
                        <li><a href="{{ route('metode-pembayaran') }}">Metode Pembayaran</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="footer-title">Kebijakan</h6>
                    <ul class="footer-links">
                        <li><a href="{{ route('syarat-ketentuan') }}">Syarat & Ketentuan</a></li>
                        <li><a href="{{ route('kebijakan-privasi') }}">Kebijakan Privasi</a></li>
                        <li><a href="{{ route('kebijakan-return') }}">Kebijakan Return</a></li>
                        <li><a href="{{ route('hak-kekayaan-intelektual') }}">Hak Kekayaan Intelektual</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="footer-title">Ikuti Kami</h6>
                    <div class="social-links">
                        <a href="https://www.facebook.com/toserbayogyaciamis57/" target="_blank" rel="noopener" title="Facebook Toserba YOGYA Ciamis" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.google.com/maps?q=Jl.%20Perintis%20Kemerdekaan%20No.57%2C%20Ciamis%2C%20Kec.%20Ciamis%2C%20Kabupaten%20Ciamis%2C%20Jawa%20Barat%2046211%2C%20Indonesia" target="_blank" rel="noopener" title="Lihat lokasi di Google Maps (Jl. Perintis Kemerdekaan No.57, Ciamis · +62 265 777779)" aria-label="Lokasi">
                            <i class="fas fa-map-marker-alt"></i>
                        </a>
                        <a href="https://www.instagram.com/yogya_ciamis/reels/" target="_blank" rel="noopener" title="Instagram YOGYA Ciamis" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://www.youtube.com/ToserbaYOGYA" target="_blank" rel="noopener" title="YouTube Toserba YOGYA" aria-label="YouTube">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
            <hr class="footer-divider">
            <div class="row">
                <div class="col-md-6">
                    <p class="footer-text">&copy; 2025 MyYOGYA. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="footer-text">Made from Selenium in Indonesia</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/dashboard.js') }}"></script>
    
    <script>
        // Enhanced navbar scroll effect
        document.addEventListener('DOMContentLoaded', function() {
            const navbar = document.querySelector('.navbar');
            let lastScrollTop = 0;
            
            function handleScroll() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                
                if (scrollTop > 100) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
                
                lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
            }
            
            window.addEventListener('scroll', handleScroll, { passive: true });
            
            // Enhanced modal functionality with smooth animations
            const promoModal = new bootstrap.Modal(document.getElementById('promoModal'));
            const loginRequiredModal = new bootstrap.Modal(document.getElementById('loginRequiredModal'));
            
            // Show modal on page load for guests only with delay for better UX
            @guest
                setTimeout(() => {
                    promoModal.show();
                    
                    // Add entrance sound effect (optional)
                    setTimeout(() => {
                        const modalBody = document.querySelector('#promoModal .modal-body');
                        modalBody.style.filter = 'drop-shadow(0 0 20px rgba(242, 107, 55, 0.3))';
                    }, 600);
                }, 800);
            @endguest
            
            // Login required functionality - trigger when user tries to access restricted features
            window.showLoginRequired = function() {
                loginRequiredModal.show();
            };
            
            // Add click handlers for restricted features
            document.querySelectorAll('.requires-login').forEach(function(element) {
                element.addEventListener('click', function(e) {
                    @guest
                        e.preventDefault();
                        showLoginRequired();
                    @endguest
                });
            });
            
            // Enhanced modal event handlers with animation controls
            function setupModalEvents(modalElement) {
                modalElement.addEventListener('show.bs.modal', function() {
                    document.body.style.overflow = 'hidden';
                    
                    // Add entrance animation class
                    setTimeout(() => {
                        modalElement.classList.add('modal-entering');
                    }, 100);
                });
                
                modalElement.addEventListener('shown.bs.modal', function() {
                    // Trigger sequential animations for modal content
                    const elements = modalElement.querySelectorAll('.welcome-title, .brand-title, .platform-subtitle, .features-highlight, .voucher-section, .modal-buttons');
                    
                    elements.forEach((element, index) => {
                        setTimeout(() => {
                            element.style.opacity = '1';
                            element.style.transform = 'translateY(0)';
                        }, index * 200);
                    });
                    
                    // Add interactive hover effects
                    const voucherCode = modalElement.querySelector('.voucher-code');
                    if (voucherCode) {
                        voucherCode.addEventListener('click', function() {
                            // Copy to clipboard effect
                            this.style.transform = 'scale(0.95)';
                            setTimeout(() => {
                                this.style.transform = 'scale(1)';
                            }, 150);
                        });
                    }
                });
                
                modalElement.addEventListener('hide.bs.modal', function() {
                    document.body.style.overflow = 'auto';
                    modalElement.classList.remove('modal-entering');
                    document.body.style.paddingRight = '0px';
                });
                
                modalElement.addEventListener('hidden.bs.modal', function() {
                    document.body.style.overflow = '';
                    document.body.style.paddingRight = '';
                    
                    // Force remove modal backdrop and body classes
                    document.body.classList.remove('modal-open');
                    const backdrop = document.querySelector('.modal-backdrop');
                    if (backdrop) {
                        backdrop.remove();
                    }
                    
                    // Reset body styles completely
                    document.body.removeAttribute('style');
                });
            }
            
            // Setup events for both modals
            setupModalEvents(document.getElementById('promoModal'));
            setupModalEvents(document.getElementById('loginRequiredModal'));
        });
        
        // Enhanced modal animations with orange theme
        document.addEventListener('DOMContentLoaded', function() {
            const modals = document.querySelectorAll('.modal');
            
            modals.forEach(function(modal) {
                modal.addEventListener('show.bs.modal', function() {
                    setTimeout(function() {
                        const backdrop = document.querySelector('.modal-backdrop');
                        if (backdrop) {
                            backdrop.style.opacity = '1';
                            backdrop.style.transition = 'opacity 0.3s ease';
                            backdrop.style.background = 'rgba(0, 0, 0, 0.7)';
                            backdrop.style.backdropFilter = 'blur(20px)';
                            backdrop.style.webkitBackdropFilter = 'blur(20px)';
                        }
                    }, 10);
                });
            });
            
            // Add elegant entrance animation to product cards
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, { threshold: 0.1 });
            
            document.querySelectorAll('.product-card').forEach(function(card, index) {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
                observer.observe(card);
            });
        });
                    }, 0);
                });
            }
        });
        
        // Smooth scroll function for navigation
        function scrollToSection(sectionId) {
            const element = document.getElementById(sectionId);
            if (element) {
                element.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }
    </script>
</body>
</html>
