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
    <!-- Custom CSS -->
    <link href="{{ asset('css/dashboard_backup.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Enhanced Promo Notification Modal -->
    <div class="modal fade" id="promoModal" tabindex="-1" aria-labelledby="promoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content promo-modal">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <!-- Welcome Icon -->
                    <div class="promo-icon">
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
                @auth
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
                                    <span class="user-name">{{ $user->name }}</span>
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
                                        <h6 class="mb-0">{{ $user->name }}</h6>
                                        <small class="text-muted">Premium Member</small>
                                    </div>
                                </div>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile Saya</a></li>
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
                                                <a href="{{ $slide['button_link'] }}" class="btn btn-hero-primary">
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
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="fas fa-bolt text-warning me-2"></i>Flash Sale
                    <span class="countdown" id="countdown">Berakhir dalam: <span id="timer">12:34:56</span></span>
                </h2>
            </div>
            
            <div class="row">
                @foreach($flashSaleVouchers as $voucher)
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="voucher-card">
                            <div class="voucher-discount">{{ $voucher['discount'] }}</div>
                            <div class="voucher-details">
                                <p class="voucher-min">{{ $voucher['min_purchase'] }}</p>
                                <div class="voucher-code">
                                    <span>Kode: {{ $voucher['code'] }}</span>
                                    <button class="btn btn-sm btn-outline-primary copy-code" data-code="{{ $voucher['code'] }}">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="voucher-claim">
                                <button class="btn btn-warning btn-sm">Claim Voucher</button>
                            </div>
                        </div>
                    </div>
                @endforeach
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
    <section class="popular-products">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Produk Terlaris</h2>
                <p class="section-subtitle">Produk pilihan yang paling banyak dibeli</p>
            </div>
            
            <div class="row">
                @foreach($popularProducts as $product)
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="product-card">
                            <div class="product-image">
                                <img src="{{ asset('image/illustration.png') }}" alt="{{ $product['name'] }}" class="img-fluid">
                                <div class="product-badge">
                                    <span class="discount-badge">
                                        {{ round((($product['original_price'] - $product['price']) / $product['original_price']) * 100) }}%
                                    </span>
                                </div>
                                <div class="product-actions">
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </button>
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
                                <button class="btn btn-primary btn-add-cart" data-product-id="{{ $product['id'] }}">
                                    <i class="fas fa-shopping-cart me-2"></i>Tambah ke Keranjang
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
                        <img src="{{ asset('image/logo_yogya.png') }}" alt="MyYOGYA" height="40" class="mb-3">
                        <h5>MyYOGYA</h5>
                        <p>Platform belanja online terpercaya dengan ribuan produk berkualitas dan pelayanan terbaik untuk kepuasan Anda.</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="footer-title">Tentang Kami</h6>
                    <ul class="footer-links">
                        <li><a href="#">Tentang MyYOGYA</a></li>
                        <li><a href="#">Karir</a></li>
                        <li><a href="#">Press Release</a></li>
                        <li><a href="#">Investor Relations</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="footer-title">Layanan</h6>
                    <ul class="footer-links">
                        <li><a href="#">Bantuan</a></li>
                        <li><a href="#">Cara Belanja</a></li>
                        <li><a href="#">Pengiriman</a></li>
                        <li><a href="#">Metode Pembayaran</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="footer-title">Kebijakan</h6>
                    <ul class="footer-links">
                        <li><a href="#">Syarat & Ketentuan</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                        <li><a href="#">Kebijakan Return</a></li>
                        <li><a href="#">Hak Kekayaan Intelektual</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="footer-title">Ikuti Kami</h6>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <hr class="footer-divider">
            <div class="row">
                <div class="col-md-6">
                    <p class="footer-text">&copy; 2025 MyYOGYA. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="footer-text">Made with <i class="fas fa-heart text-danger"></i> in Indonesia</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>
