<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MyYOGYA - Belanja Online Terpercaya')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    @stack('styles')
    
    <style>
        /* Category Header Styles */
        .category-header {
            background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
            color: white;
            padding: 80px 0 50px;
            margin-bottom: 40px;
        }
        
        .breadcrumb-custom {
            margin-bottom: 20px;
        }
        
        .breadcrumb-custom a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
        }
        
        .breadcrumb-custom a:hover {
            color: white;
        }
        
        .breadcrumb-custom span {
            color: rgba(255, 255, 255, 0.6);
        }

        /* Filter Section */
        .filter-section {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }

        /* Product Grid */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 50px;
            grid-auto-rows: 1fr; /* Makes all grid items same height */
        }

        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            position: relative;
            display: flex;
            flex-direction: column;
            height: 100%; /* Ensures full height usage */
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            position: relative;
            overflow: hidden;
            height: 220px; /* Fixed height for consistency */
            flex-shrink: 0; /* Prevents image from shrinking */
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-image img {
            transform: scale(1.05);
        }

        .discount-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: #e74c3c;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .wishlist-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            color: #666;
            transition: all 0.3s ease;
        }

        .wishlist-btn:hover {
            background: #e74c3c;
            color: white;
            transform: scale(1.1);
        }

        .product-info {
            padding: 20px;
            display: flex;
            flex-direction: column;
            flex-grow: 1; /* Takes remaining space */
            justify-content: space-between;
        }

        .product-title {
            font-weight: 600;
            margin-bottom: 10px;
            color: #2c3e50;
            min-height: 48px; /* Fixed minimum height for 2 lines */
            max-height: 48px; /* Maximum height for 2 lines */
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            line-height: 1.2; /* Consistent line height */
        }

        .product-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .product-meta {
            margin-top: auto; /* Pushes to bottom */
        }

        .product-rating {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
        }

        .stars {
            color: #f39c12;
            margin-right: 8px;
        }

        .review-count {
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        .product-price {
            margin-bottom: 15px;
        }

        .current-price {
            font-size: 1.3rem;
            font-weight: 700;
            color: #e74c3c;
        }

        .original-price {
            color: #95a5a6;
            text-decoration: line-through;
            margin-left: 10px;
            font-size: 1rem;
        }

        .add-to-cart-btn {
            width: 100%;
            background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-top: auto; /* Ensures button stays at bottom */
        }

        .add-to-cart-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(242, 107, 55, 0.3);
        }

        /* Pagination - Modern Design */
        .pagination-custom {
            margin-top: 50px;
            margin-bottom: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .pagination-custom .pagination {
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin: 0;
        }

        .pagination-custom .page-item {
            margin: 0;
        }

        .pagination-custom .page-link {
            color: #6c757d;
            background: white;
            border: 2px solid #e9ecef;
            margin: 0;
            padding: 12px 16px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            min-width: 48px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .pagination-custom .page-link:hover {
            background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
            color: white;
            border-color: #f26b37;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(242, 107, 55, 0.3);
        }

        .pagination-custom .page-item.active .page-link {
            background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
            border-color: #f26b37;
            color: white;
            box-shadow: 0 4px 15px rgba(242, 107, 55, 0.4);
        }

        .pagination-custom .page-item.disabled .page-link {
            color: #adb5bd;
            background: #f8f9fa;
            border-color: #e9ecef;
            cursor: not-allowed;
        }

        .pagination-custom .page-item.disabled .page-link:hover {
            background: #f8f9fa;
            color: #adb5bd;
            border-color: #e9ecef;
            transform: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        /* Previous/Next buttons with icons */
        .pagination-custom .page-item:first-child .page-link,
        .pagination-custom .page-item:last-child .page-link {
            padding: 12px 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .pagination-custom .page-item:first-child .page-link::before {
            content: "←";
            font-weight: bold;
        }

        .pagination-custom .page-item:last-child .page-link::after {
            content: "→";
            font-weight: bold;
        }

        /* Ellipsis styling */
        .pagination-custom .page-item .page-link.text-muted {
            background: transparent;
            border: none;
            color: #adb5bd;
            cursor: default;
            box-shadow: none;
            font-weight: bold;
        }

        .pagination-custom .page-item .page-link.text-muted:hover {
            background: transparent;
            color: #adb5bd;
            transform: none;
            box-shadow: none;
        }

        /* Loading state for pagination */
        .pagination-custom.loading .page-link {
            pointer-events: none;
            opacity: 0.6;
        }

        /* Pagination animations */
        .pagination-custom .page-item {
            opacity: 0;
            animation: fadeInUp 0.3s ease forwards;
        }

        .pagination-custom .page-item:nth-child(1) { animation-delay: 0.1s; }
        .pagination-custom .page-item:nth-child(2) { animation-delay: 0.15s; }
        .pagination-custom .page-item:nth-child(3) { animation-delay: 0.2s; }
        .pagination-custom .page-item:nth-child(4) { animation-delay: 0.25s; }
        .pagination-custom .page-item:nth-child(5) { animation-delay: 0.3s; }
        .pagination-custom .page-item:nth-child(6) { animation-delay: 0.35s; }
        .pagination-custom .page-item:nth-child(7) { animation-delay: 0.4s; }
        .pagination-custom .page-item:nth-child(8) { animation-delay: 0.45s; }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Active page pulse effect */
        .pagination-custom .page-item.active .page-link {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 4px 15px rgba(242, 107, 55, 0.4);
            }
            50% {
                box-shadow: 0 6px 20px rgba(242, 107, 55, 0.6);
            }
            100% {
                box-shadow: 0 4px 15px rgba(242, 107, 55, 0.4);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .category-header {
                padding: 60px 0 40px;
                text-align: center;
            }
            
            .product-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 15px;
            }
            
            .filter-section .row > div {
                margin-bottom: 10px;
            }

            .product-title {
                min-height: 40px; /* Slightly smaller on mobile */
                max-height: 40px;
                font-size: 0.95rem;
            }

            .product-image {
                height: 200px; /* Slightly smaller image on mobile */
            }

            /* Pagination responsive */
            .pagination-custom .page-link {
                padding: 10px 12px;
                font-size: 0.9rem;
                min-width: 40px;
            }

            .pagination-custom .page-item:first-child .page-link,
            .pagination-custom .page-item:last-child .page-link {
                padding: 10px 16px;
            }

            .pagination-custom .pagination {
                gap: 6px;
            }
        }

        @media (max-width: 480px) {
            .product-grid {
                grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
                gap: 12px;
            }

            .product-info {
                padding: 15px;
            }

            .current-price {
                font-size: 1.1rem;
            }

            /* Pagination mobile */
            .pagination-custom .page-link {
                padding: 8px 10px;
                font-size: 0.85rem;
                min-width: 36px;
            }

            .pagination-custom .page-item:first-child .page-link,
            .pagination-custom .page-item:last-child .page-link {
                padding: 8px 12px;
            }

            .pagination-custom .pagination {
                gap: 4px;
            }
        }

        /* Category Navigation Dropdown Styles */
        .dropdown-menu-wide {
            min-width: 280px;
            border-radius: 12px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            padding: 15px 0;
            opacity: 0;
            transition: opacity 0.3s ease;
            visibility: hidden;
        }

        .dropdown-menu-wide.show {
            opacity: 1;
            visibility: visible;
        }

        .dropdown-menu-wide .dropdown-item {
            padding: 12px 20px;
            font-weight: 500;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 0;
            opacity: 0;
            animation: fadeInItem 0.3s ease forwards;
        }

        .dropdown-menu-wide .dropdown-item:nth-child(1) { animation-delay: 0.05s; }
        .dropdown-menu-wide .dropdown-item:nth-child(2) { animation-delay: 0.1s; }
        .dropdown-menu-wide .dropdown-item:nth-child(3) { animation-delay: 0.15s; }
        .dropdown-menu-wide .dropdown-item:nth-child(4) { animation-delay: 0.2s; }
        .dropdown-menu-wide .dropdown-item:nth-child(5) { animation-delay: 0.25s; }
        .dropdown-menu-wide .dropdown-item:nth-child(6) { animation-delay: 0.3s; }
        .dropdown-menu-wide .dropdown-item:nth-child(7) { animation-delay: 0.35s; }
        .dropdown-menu-wide .dropdown-item:nth-child(8) { animation-delay: 0.4s; }
        .dropdown-menu-wide .dropdown-item:nth-child(9) { animation-delay: 0.45s; }

        @keyframes fadeInItem {
            to {
                opacity: 1;
            }
        }

        .dropdown-menu-wide .dropdown-item:hover {
            background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(242, 107, 55, 0.3);
        }

        .dropdown-menu-wide .dropdown-item i {
            width: 20px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .dropdown-menu-wide .dropdown-item:hover i {
            color: white !important;
        }

        #categoryDropdown {
            border: 2px solid #dee2e6 !important;
            border-radius: 25px !important;
            padding: 8px 16px !important;
            font-weight: 500 !important;
            transition: all 0.3s ease !important;
            background: white !important;
            color: #495057 !important;
            position: relative;
            z-index: 1;
        }

        #categoryDropdown * {
            position: relative;
            z-index: 2;
        }

        #categoryDropdown:hover {
            border-color: #f26b37 !important;
            background: linear-gradient(135deg, #f26b37 0%, #e55827 100%) !important;
            color: white !important;
            box-shadow: 0 4px 15px rgba(242, 107, 55, 0.3) !important;
        }

        #categoryDropdown:hover,
        #categoryDropdown:hover span,
        #categoryDropdown:hover i {
            color: white !important;
        }

        /* Ensure Bootstrap doesn't override */
        button#categoryDropdown:hover {
            color: white !important;
        }

        button#categoryDropdown.btn:hover {
            color: white !important;
        }

        /* Mobile responsive for category nav */
        @media (max-width: 992px) {
            .category-nav .d-flex {
                flex-direction: column;
                align-items: flex-start !important;
            }
            
            .category-nav .dropdown {
                margin-top: 10px;
            }
        }

        /* Disable Bootstrap dropdown default animations */
        .dropdown-menu {
            animation: none !important;
        }

        /* Better dropdown positioning */
        .dropdown-menu-wide {
            margin-top: 8px !important;
        }

        /* Prevent dropdown flicker */
        .dropdown-menu.show {
            animation: none !important;
        }

        /* Force text visibility on dropdown buttons */
        .dropdown-toggle:hover {
            color: white !important;
        }

        .btn.dropdown-toggle:hover {
            color: white !important;
        }

        .btn-outline-secondary:hover {
            color: white !important;
            background-color: transparent !important;
        }

        /* Override Bootstrap button hover specifically for our dropdown */
        #categoryDropdown.btn-outline-secondary:hover {
            color: white !important;
            background: linear-gradient(135deg, #f26b37 0%, #e55827 100%) !important;
            border-color: #f26b37 !important;
        }
    </style>
</head>
<body>
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
            </div>

            <!-- Navbar Actions -->
            <div class="navbar-actions">
                <!-- Wishlist -->
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <div class="nav-icon-wrapper">
                            <i class="far fa-heart"></i>
                            <span class="notification-badge">3</span>
                        </div>
                    </a>
                </div>

                <!-- Cart -->
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <div class="nav-icon-wrapper">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="cart-badge">5</span>
                        </div>
                    </a>
                </div>

                <!-- Profile -->
                <div class="nav-item">
                    @guest
                        <a href="{{ route('pelanggan.login') }}" class="btn btn-nav-outline me-2">
                            <i class="fas fa-sign-in-alt me-2"></i>Masuk
                        </a>
                        <a href="{{ route('pelanggan.register') }}" class="btn btn-nav-primary">
                            <i class="fas fa-user-plus me-2"></i>Daftar
                        </a>
                    @else
                        <div class="profile-info">
                            <div class="avatar">
                                {{ strtoupper(substr(Auth::user()->nama ?? 'U', 0, 1)) }}
                            </div>
                            <div class="user-details">
                                <div class="user-name">{{ Auth::user()->nama ?? 'User' }}</div>
                                <div class="user-status">Member</div>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Category Navigation -->
    <div class="category-nav" style="background: var(--light-bg); padding: 12px 0; border-bottom: 1px solid var(--border-color);">
        <div class="container">
            <div class="d-flex align-items-center">
                <div class="d-flex align-items-center">
                    <a href="{{ route('dashboard') }}" class="me-4 text-decoration-none" style="color: var(--text-dark);">
                        <i class="fas fa-home"></i> Beranda
                    </a>
                    
                    <!-- Category Dropdown -->
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center" type="button" id="categoryDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-th-large me-2"></i>
                            Semua Kategori
                        </button>
                        <ul class="dropdown-menu dropdown-menu-wide" aria-labelledby="categoryDropdown">
                            <li><a class="dropdown-item" href="{{ route('kategori.elektronik') }}">
                                <i class="fas fa-laptop me-2 text-primary"></i>Elektronik
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('kategori.fashion') }}">
                                <i class="fas fa-tshirt me-2 text-danger"></i>Fashion
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('kategori.makanan') }}">
                                <i class="fas fa-hamburger me-2 text-warning"></i>Makanan & Minuman
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('kategori.perawatan') }}">
                                <i class="fas fa-spa me-2 text-info"></i>Perawatan & Kecantikan
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('kategori.rumah-tangga') }}">
                                <i class="fas fa-home me-2 text-success"></i>Rumah Tangga
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('kategori.olahraga') }}">
                                <i class="fas fa-dumbbell me-2 text-dark"></i>Olahraga
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('kategori.otomotif') }}">
                                <i class="fas fa-car me-2 text-secondary"></i>Otomotif
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('kategori.buku') }}">
                                <i class="fas fa-book me-2 text-muted"></i>Buku & Alat Tulis
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('kategori.kesehatan-kecantikan') }}">
                                <i class="fas fa-heart me-2 text-danger"></i>Kesehatan & Kecantikan
                            </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="footer-brand">
                        <h5 class="mb-2">MyYOGYA</h5>
                        <p class="mb-3">Platform belanja online terpercaya #1 di Indonesia dengan berbagai produk berkualitas dan harga terjangkau.</p>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="footer-title">Tentang MyYOGYA</h6>
                    <ul class="footer-links list-unstyled">
                        <li><a href="{{ route('tentang') }}">Tentang Kami</a></li>
                        <li><a href="{{ route('karir') }}">Karir</a></li>
                        <li><a href="{{ route('investor-relations') }}">Investor Relations</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="footer-title">Layanan & Bantuan</h6>
                    <ul class="footer-links list-unstyled">
                        <li><a href="{{ route('layanan') }}">Pusat Bantuan</a></li>
                        <li><a href="{{ route('cara-belanja') }}">Cara Belanja</a></li>
                        <li><a href="{{ route('pengiriman') }}">Pengiriman</a></li>
                        <li><a href="{{ route('metode-pembayaran') }}">Metode Pembayaran</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="footer-title">Kebijakan</h6>
                    <ul class="footer-links list-unstyled">
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
                        <a href="https://www.google.com/maps?q=Jl.%20Perintis%20Kemerdekaan%20No.57%2C%20Ciamis%2C%20Kec.%20Ciamis%2C%20Kabupaten%20Ciamis%2C%20Jawa%20Barat%2046211%2C%20Indonesia" target="_blank" rel="noopener" title="Lihat lokasi di Google Maps" aria-label="Lokasi">
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
    
    <script>
        // Auto close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const navbarToggler = document.querySelector('.navbar-toggler');
            const navbarCollapse = document.querySelector('.navbar-collapse');
            
            if (navbarToggler && navbarCollapse && !navbarToggler.contains(event.target) && !navbarCollapse.contains(event.target)) {
                const isExpanded = navbarToggler.getAttribute('aria-expanded') === 'true';
                if (isExpanded) {
                    navbarToggler.click();
                }
            }
        });

        // Enhanced smooth category dropdown animations
        document.addEventListener('DOMContentLoaded', function() {
            const dropdown = document.getElementById('categoryDropdown');
            const dropdownMenu = dropdown ? dropdown.nextElementSibling : null;
            
            if (dropdown && dropdownMenu) {
                // Simple fade animation only
                dropdown.addEventListener('show.bs.dropdown', function() {
                    dropdownMenu.style.display = 'block';
                    dropdownMenu.style.opacity = '0';
                    
                    // Force reflow
                    dropdownMenu.offsetHeight;
                    
                    // Fade in
                    dropdownMenu.style.transition = 'opacity 0.3s ease';
                    dropdownMenu.style.opacity = '1';
                });
                
                // Fade out
                dropdown.addEventListener('hide.bs.dropdown', function(e) {
                    e.preventDefault();
                    
                    dropdownMenu.style.transition = 'opacity 0.2s ease';
                    dropdownMenu.style.opacity = '0';
                    
                    setTimeout(() => {
                        dropdownMenu.classList.remove('show');
                        dropdown.setAttribute('aria-expanded', 'false');
                        dropdownMenu.style.display = 'none';
                    }, 200);
                });
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>
