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
    <!-- Google Fonts - Roboto Mon        // Show toast notification functionref="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* Modal stability fixes */
        .modal {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            z-index: 1055 !important;
            width: 100% !important;
            height: 100% !important;
            overflow: hidden !important;
        }
        
        .modal-dialog {
            position: relative !important;
            width: auto !important;
            margin: 1.75rem auto !important;
            pointer-events: none !important;
            transform: none !important;
            transition: none !important;
        }
        
        .modal-content {
            position: relative !important;
            display: flex !important;
            flex-direction: column !important;
            width: 100% !important;
            pointer-events: auto !important;
            background-color: #fff !important;
            background-clip: padding-box !important;
            border: 1px solid rgba(0,0,0,.2) !important;
            border-radius: 0.5rem !important;
            outline: 0 !important;
            transform: none !important;
            transition: none !important;
        }
        
        .modal.show .modal-dialog {
            transform: none !important;
        }
        
        .modal-backdrop {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            z-index: 1050 !important;
            width: 100vw !important;
            height: 100vh !important;
            background-color: rgba(0, 0, 0, 0.5) !important;
        }
        
        body.modal-open {
            overflow: hidden !important;
            padding-right: 0 !important;
        }
        
        /* Ensure modal content is responsive and centered */
        .modal-content {
            position: relative !important;
            display: flex !important;
            flex-direction: column !important;
            width: 100% !important;
            pointer-events: auto !important;
            background-color: #fff !important;
            background-clip: padding-box !important;
            border: 1px solid rgba(0, 0, 0, 0.2) !important;
            border-radius: 0.3rem !important;
            outline: 0 !important;
        }
        
        /* Immediate backdrop and stable modal */
        .modal {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            width: 100vw !important;
            height: 100vh !important;
            z-index: 1055 !important;
            background-color: rgba(0, 0, 0, 0.5) !important;
            display: none !important;
            align-items: center !important;
            justify-content: center !important;
        }
        
        .modal.show {
            display: flex !important;
        }
        
        .modal-dialog {
            position: relative !important;
            margin: 0 !important;
            transform: none !important;
            animation: none !important;
            transition: none !important;
            max-width: 500px !important;
            width: 90% !important;
            z-index: 1056 !important;
        }
        
        .modal-dialog-centered {
            display: block !important;
            margin: 0 auto !important;
            position: relative !important;
            top: auto !important;
            left: auto !important;
            transform: none !important;
        }
        
        /* Override Bootstrap modal-dialog-centered */
        .modal .modal-dialog-centered {
            display: block !important;
            margin: 0 auto !important;
            min-height: auto !important;
            position: relative !important;
        }
        
        /* Keep internal content animations */
        .promo-icon, .welcome-icon, .voucher-section, .modal-buttons {
            animation: initial !important;
            transition: all 0.3s ease !important;
        }
        
        /* Guest restriction styles */
        .guest-restricted {
            opacity: 0.6 !important;
            cursor: not-allowed !important;
            pointer-events: auto !important;
        }
        
        .guest-restricted:hover {
            opacity: 0.8 !important;
        }
    </style>
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
    @include('layouts.navbar_pelanggan')

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
        // Enhanced navbar scroll effect (optimized for performance)
        document.addEventListener('DOMContentLoaded', function() {
            const navbar = document.querySelector('.navbar');
            let ticking = false;
            
            function handleScroll() {
                if (!ticking) {
                    requestAnimationFrame(function() {
                        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                        
                        if (scrollTop > 100) {
                            navbar.classList.add('scrolled');
                        } else {
                            navbar.classList.remove('scrolled');
                        }
                        
                        ticking = false;
                    });
                    ticking = true;
                }
            }
            
            window.addEventListener('scroll', handleScroll, { passive: true });
            
            // Simple and direct modal control
            const promoModalElement = document.getElementById('promoModal');
            const loginRequiredModalElement = document.getElementById('loginRequiredModal');
            
            // Custom modal show/hide functions
            function showModal(modalElement) {
                document.body.style.overflow = 'hidden';
                modalElement.classList.add('show');
                modalElement.style.display = 'flex';
                modalElement.setAttribute('aria-hidden', 'false');
            }
            
            function hideModal(modalElement) {
                document.body.style.overflow = '';
                modalElement.classList.remove('show');
                modalElement.style.display = 'none';
                modalElement.setAttribute('aria-hidden', 'true');
            }
            
            // Show modal for guests
            @guest
                if (document.readyState === 'complete') {
                    setTimeout(() => showModal(promoModalElement), 100);
                } else {
                    window.addEventListener('load', function() {
                        setTimeout(() => showModal(promoModalElement), 100);
                    });
                }
            @endguest
            
            // Close button functionality
            document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(button => {
                button.addEventListener('click', function() {
                    const modal = this.closest('.modal');
                    if (modal) {
                        hideModal(modal);
                    }
                });
            });
            
            // Close on backdrop click
            [promoModalElement, loginRequiredModalElement].forEach(modal => {
                if (modal) {
                    modal.addEventListener('click', function(e) {
                        if (e.target === this) {
                            hideModal(this);
                        }
                    });
                }
            });
            
            // Close on ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    const visibleModal = document.querySelector('.modal.show');
                    if (visibleModal) {
                        hideModal(visibleModal);
                    }
                }
            });
            
            // Login required functionality
            window.showLoginRequired = function() {
                showModal(loginRequiredModalElement);
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
        });
        
        // Stable modal setup without complex animations
        document.addEventListener('DOMContentLoaded', function() {
            const modals = document.querySelectorAll('.modal');
            
            modals.forEach(function(modal) {
                modal.addEventListener('show.bs.modal', function() {
                    // Simple backdrop setup
                    setTimeout(function() {
                        const backdrop = document.querySelector('.modal-backdrop');
                        if (backdrop) {
                            backdrop.style.opacity = '0.5';
                            backdrop.style.background = 'rgba(0, 0, 0, 0.5)';
                        }
                    }, 10);
                });
            });
        });
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

        });
        
        // Cart functionality
        let cart = JSON.parse(localStorage.getItem('cart') || '[]');

        // Update cart badge in navbar
        function updateCartBadge() {
            const cartBadge = document.querySelector('.cart-badge');
            if (cartBadge) {
                const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
                cartBadge.textContent = totalItems;
                cartBadge.style.display = totalItems > 0 ? 'inline' : 'none';
            }
        }

        // Block cart and notification access for non-authenticated users
        @guest
        document.addEventListener('DOMContentLoaded', function() {
            // Block cart access
            const cartLink = document.querySelector('.cart-link');
            if (cartLink) {
                cartLink.classList.add('guest-restricted');
                cartLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    showLoginRequired();
                });
            }

            // Block notification access
            const notificationDropdown = document.querySelector('[data-bs-toggle="dropdown"]');
            if (notificationDropdown && notificationDropdown.closest('.nav-item').querySelector('.notification-badge')) {
                notificationDropdown.classList.add('guest-restricted');
                notificationDropdown.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    showLoginRequired();
                });
            }

            // Alternative selector for notification icon
            const notificationIcon = document.querySelector('.fas.fa-bell');
            if (notificationIcon) {
                const notificationLink = notificationIcon.closest('a');
                if (notificationLink) {
                    notificationLink.classList.add('guest-restricted');
                    notificationLink.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        showLoginRequired();
                    });
                }
            }

            // Also hide badge counts for guests
            const cartBadge = document.querySelector('.cart-badge');
            if (cartBadge) {
                cartBadge.style.display = 'none';
            }

            const notificationBadge = document.querySelector('.notification-badge');
            if (notificationBadge) {
                notificationBadge.style.display = 'none';
            }
        });
        @endguest

        // Add to cart function
        // Enhanced cart functionality with authentication
        function addToCart(event, product) {
            console.log('addToCart called with product:', product);
            event.preventDefault();
            event.stopPropagation();
            
            // Get button element for visual feedback
            const button = event.target.matches('.btn-add-cart') ? event.target : event.target.closest('.btn-add-cart');
            const originalText = button.innerHTML;
            
            // Show loading state
            button.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Menambahkan...';
            button.disabled = true;
            
            // Check authentication status
            @auth('pelanggan')
                console.log('User is authenticated, proceeding with cart addition');
                
                // Prepare data for server
                const formData = {
                    id: product.id,
                    name: product.name,
                    price: product.price,
                    image: product.image || '{{ asset("image/illustration.png") }}',
                    category: product.category || 'Produk Populer',
                    quantity: 1
                };
                
                console.log('Sending data to server:', formData);
                
                // Send to server
                fetch('/keranjang/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => {
                    console.log('Server response status:', response.status);
                    return response.json();
                })
                .then(data => {
                    console.log('Server response data:', data);
                    if (data.success) {
                        // Update cart badge
                        updateCartBadgeFromServer(data.cartCount || 0);
                        
                        // Show success toast
                        showToast(data.message || 'Produk berhasil ditambahkan ke keranjang', 'success');
                        
                        // Change button text temporarily
                        button.innerHTML = '<i class="fas fa-check me-1"></i>Ditambahkan!';
                        button.classList.add('btn-success');
                        button.classList.remove('btn-primary');
                        
                        setTimeout(() => {
                            button.innerHTML = originalText;
                            button.classList.remove('btn-success');
                            button.classList.add('btn-primary');
                            button.disabled = false;
                        }, 2000);
                    } else {
                        showToast(data.message || 'Gagal menambahkan ke keranjang', 'danger');
                        button.innerHTML = originalText;
                        button.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Error adding to cart:', error);
                    showToast('Terjadi kesalahan saat menambahkan ke keranjang', 'danger');
                    button.innerHTML = originalText;
                    button.disabled = false;
                });
            @else
                console.log('User not authenticated, showing login dialog');
                // User not logged in, show login modal
                showLoginRequired();
                button.innerHTML = originalText;
                button.disabled = false;
            @endauth
        }

        // Show login required modal/message
        function showLoginRequired() {
            // Create modal or redirect to login
            if (confirm('Anda harus login terlebih dahulu untuk menambahkan produk ke keranjang. Login sekarang?')) {
                window.location.href = '{{ route("pelanggan.login") }}';
            }
        }

        // Update cart badge from server response
        function updateCartBadgeFromServer(count) {
            console.log('Updating cart badge with count:', count);
            const cartBadges = document.querySelectorAll('.cart-badge, .cart-count');
            cartBadges.forEach(badge => {
                badge.textContent = count || 0;
                badge.style.display = count > 0 ? 'inline' : 'none';
            });
        }

        // Update cart badge function
        function updateCartBadge() {
            @auth('pelanggan')
                // For authenticated users, get count from server
                fetch('/keranjang/data')
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            updateCartBadgeFromServer(data.cartCount || 0);
                        }
                    })
                    .catch(error => {
                        console.error('Error loading cart data:', error);
                    });
            @else
                // For guests, hide badge
                updateCartBadgeFromServer(0);
            @endauth
        }

        // Load cart count on page load for authenticated users
        @auth('pelanggan')
            document.addEventListener('DOMContentLoaded', function() {
                fetch('/keranjang/data')
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            updateCartBadgeFromServer(data.cartCount);
                        }
                    })
                    .catch(error => {
                        console.error('Error loading cart data:', error);
                    });
            });
        @endauth

        // Toast notification function
        function showToast(message, type = 'success') {
            // Create toast element
            const toastHtml = `
                <div class="toast align-items-center text-white bg-${type} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'danger' ? 'exclamation-triangle' : 'info-circle'} me-2"></i>${message}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            `;

            // Create toast container if it doesn't exist
            let toastContainer = document.getElementById('toast-container');
            if (!toastContainer) {
                toastContainer = document.createElement('div');
                toastContainer.id = 'toast-container';
                toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
                toastContainer.style.zIndex = '9999';
                document.body.appendChild(toastContainer);
            }

            // Add toast to container
            toastContainer.insertAdjacentHTML('beforeend', toastHtml);

            // Initialize and show toast
            const toastElement = toastContainer.lastElementChild;
            const toast = new bootstrap.Toast(toastElement, {
                autohide: true,
                delay: 3000
            });
            toast.show();

            // Remove toast element after it's hidden
            toastElement.addEventListener('hidden.bs.toast', function() {
                toastElement.remove();
            });
        }

        // Initialize cart badge and event listeners
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, initializing cart functionality');
            
            // Update cart badge on load
            updateCartBadge();
            
            // Debug: Check if products data exists
            const productData = @json($popularProducts);
            console.log('Product data loaded:', productData);
            console.log('Product count:', productData.length);
            
            // Use event delegation for better reliability
            document.addEventListener('click', function(e) {
                if (e.target.matches('.btn-add-cart') || e.target.closest('.btn-add-cart')) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const button = e.target.matches('.btn-add-cart') ? e.target : e.target.closest('.btn-add-cart');
                    const productId = parseInt(button.dataset.productId);
                    
                    console.log('Cart button clicked! Product ID:', productId);
                    console.log('Button element:', button);
                    
                    const product = productData.find(p => p.id === productId);
                    console.log('Found product:', product);
                    
                    if (product) {
                        const cartProduct = {
                            id: product.id,
                            name: product.name,
                            price: product.price,
                            image: product.image || '{{ asset("image/illustration.png") }}',
                            category: product.category || 'Produk Populer',
                            stock: 100 // Default stock
                        };
                        addToCart(e, cartProduct);
                    } else {
                        console.error('Product not found for ID:', productId);
                        showToast('Produk tidak ditemukan', 'danger');
                    }
                }
            });
            
            // Also keep the original method as fallback
            const cartButtons = document.querySelectorAll('.btn-add-cart');
            console.log('Found cart buttons:', cartButtons.length);
            
            cartButtons.forEach(function(button, index) {
                console.log('Setting up button', index, 'with product ID:', button.dataset.productId);
            });
        });

        // Update cart badge when storage changes (from other tabs)
        window.addEventListener('storage', function(e) {
            if (e.key === 'cart') {
                cart = JSON.parse(e.newValue || '[]');
                updateCartBadge();
            }
        });
    </script>
</body>
</html>
