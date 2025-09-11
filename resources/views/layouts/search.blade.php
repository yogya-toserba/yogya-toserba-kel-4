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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root {
            --yogya-orange: #f26b37;
            --yogya-orange-light: #ff8c66;
            --yogya-orange-dark: #e55827;
            --yogya-yellow: #ffd23f;
            --yogya-green: #4caf50;
            --yogya-blue: #2196f3;
            --yogya-red: #f44336;
            --yogya-gray: #6c757d;
            --yogya-dark: #2c3e50;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
            padding-top: 100px; /* Space for fixed navbar */
        }

        /* Navbar Styles */
        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            border-bottom: 1px solid rgba(0,0,0,0.1);
        }

        .navbar-brand .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .navbar-brand .brand-info {
            display: flex;
            flex-direction: column;
            line-height: 1;
        }

        .navbar-brand .brand-text {
            font-weight: 700;
            font-size: 1.25rem;
            background: linear-gradient(135deg, var(--yogya-orange) 0%, var(--yogya-yellow) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .navbar-brand .brand-tagline {
            font-size: 0.75rem;
            color: var(--yogya-gray);
            font-weight: 500;
        }

        /* Search Container */
        .search-container {
            max-width: 500px;
            position: relative;
        }

        .search-box {
            position: relative;
        }

        .search-input {
            padding: 12px 50px 12px 45px;
            border-radius: 25px;
            border: 2px solid #e9ecef;
            font-size: 0.95rem;
            background: white;
            width: 100%;
        }

        .search-input:focus {
            border-color: var(--yogya-blue);
            box-shadow: 0 0 0 0.2rem rgba(33, 150, 243, 0.25);
            outline: none;
        }

        .search-icon-left {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            z-index: 10;
        }

        .search-suggestions {
            display: flex;
            gap: 8px;
            margin-top: 8px;
            flex-wrap: wrap;
        }

        .suggestion-tag {
            background: rgba(242, 107, 55, 0.1);
            color: var(--yogya-orange);
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.2s ease;
        }

        .suggestion-tag:hover {
            background: var(--yogya-orange);
            color: white;
            transform: translateY(-1px);
        }

        /* Navbar Actions */
        .navbar-actions .nav-link {
            color: var(--yogya-dark) !important;
            font-weight: 500;
            padding: 8px 12px;
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-icon-wrapper {
            position: relative;
            display: inline-block;
        }

        .notification-badge, .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--yogya-red);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid white;
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        .bounce {
            animation: bounce 1s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-3px); }
            60% { transform: translateY(-2px); }
        }

        /* Profile Section */
        .profile-link .profile-info {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .profile-link .avatar {
            background: linear-gradient(135deg, var(--yogya-orange) 0%, var(--yogya-yellow) 100%);
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.9rem;
        }

        .profile-link .user-details {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .profile-link .user-name {
            font-weight: 600;
            font-size: 0.9rem;
        }

        .profile-link .user-status {
            font-size: 0.75rem;
            color: var(--yogya-gray);
        }

        /* Buttons */
        .btn-nav-outline {
            border: 2px solid var(--yogya-orange);
            color: var(--yogya-orange);
            background: transparent;
            border-radius: 25px;
            padding: 8px 16px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-nav-outline:hover {
            background: var(--yogya-orange);
            color: white;
            transform: translateY(-1px);
        }

        .btn-nav-primary {
            background: var(--yogya-orange);
            color: white;
            border: 2px solid var(--yogya-orange);
            border-radius: 25px;
            padding: 8px 16px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-nav-primary:hover {
            background: var(--yogya-orange-dark);
            border-color: var(--yogya-orange-dark);
            color: white;
            transform: translateY(-1px);
        }

        /* Dropdown Menus */
        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            border-radius: 12px;
            padding: 8px 0;
            margin-top: 8px;
        }

        .dropdown-item {
            padding: 12px 20px;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background: rgba(242, 107, 55, 0.1);
            color: var(--yogya-orange);
        }

        /* Search Suggestions Dropdown */
        .search-suggestions-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            z-index: 1000;
            max-height: 400px;
            overflow-y: auto;
            margin-top: 5px;
        }
        
        .search-suggestion-item {
            padding: 12px 20px;
            border-bottom: 1px solid #f1f3f4;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
        }
        
        .search-suggestion-item:hover,
        .search-suggestion-item.active {
            background: rgba(242, 107, 55, 0.1);
            color: var(--yogya-orange, #f26b37);
        }
        
        .search-suggestion-item:last-child {
            border-bottom: none;
            border-radius: 0 0 15px 15px;
        }
        
        .search-suggestion-item:first-child {
            border-radius: 15px 15px 0 0;
        }
        
        .suggestion-icon {
            color: var(--yogya-orange, #f26b37);
            margin-right: 10px;
            width: 20px;
        }
        
        .suggestion-text {
            flex-grow: 1;
        }
        
        .suggestion-category {
            font-size: 0.8rem;
            color: #6c757d;
            margin-left: auto;
        }

        .search-box {
            position: relative;
        }

        .search-input {
            padding-left: 45px;
            padding-right: 45px;
            border-radius: 25px;
            border: 2px solid #e9ecef;
            font-size: 0.95rem;
        }

        .search-input:focus {
            border-color: var(--yogya-blue);
            box-shadow: 0 0 0 0.2rem rgba(33, 150, 243, 0.25);
        }

        .search-icon-left {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            z-index: 10;
        }

        .search-btn {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            background: var(--yogya-blue);
            border: none;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .search-btn:hover {
            background: var(--yogya-orange);
            transform: translateY(-50%) scale(1.1);
        }

        /* Product Card Styles */
        .product-card {
            transition: all 0.3s ease;
            border: none;
            overflow: hidden;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Navigation -->
    <!-- Navbar Pelanggan -->
    <nav class="navbar navbar-expand-lg fixed-top">
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
                <form action="{{ route('pelanggan.search') }}" method="GET" class="search-box">
                    <div class="search-icon-left">
                        <i class="fas fa-search"></i>
                    </div>
                    <input type="text" class="form-control search-input" name="q" 
                           placeholder="Cari produk, kategori, atau brand favorit Anda..." 
                           value="{{ request('q') }}" autocomplete="off" id="searchInput">
                    <button type="submit" class="search-btn">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                    <!-- Live Search Suggestions -->
                    <div class="search-suggestions-dropdown" id="searchSuggestions" style="display: none;">
                        <!-- Suggestions will be populated here via AJAX -->
                    </div>
                </form>
                <div class="search-suggestions">
                    <span class="suggestion-tag" onclick="searchTag('Elektronik')">Elektronik</span>
                    <span class="suggestion-tag" onclick="searchTag('Fashion')">Fashion</span>
                    <span class="suggestion-tag" onclick="searchTag('Makanan')">Makanan</span>
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
                        <a class="nav-link cart-link" href="{{ route('keranjang.index') }}">
                            <div class="nav-icon-wrapper">
                                <i class="fas fa-shopping-cart"></i>
                                <span class="cart-badge bounce">0</span>
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

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-light py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <p class="mb-0">&copy; 2024 MyYOGYA. Semua hak dilindungi.</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <div class="social-icons">
                        <a href="#" class="text-light me-3"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-light"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Navbar Search Functionality -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const searchSuggestions = document.getElementById('searchSuggestions');
        let searchTimeout;
        
        if (searchInput && searchSuggestions) {
            // Live search suggestions
            searchInput.addEventListener('input', function() {
                const query = this.value.trim();
                
                clearTimeout(searchTimeout);
                
                if (query.length < 2) {
                    hideSuggestions();
                    return;
                }
                
                searchTimeout = setTimeout(() => {
                    fetchSuggestions(query);
                }, 300);
            });
            
            searchInput.addEventListener('focus', function() {
                const query = this.value.trim();
                if (query.length >= 2) {
                    fetchSuggestions(query);
                }
            });
            
            searchInput.addEventListener('blur', function() {
                setTimeout(() => {
                    hideSuggestions();
                }, 200);
            });
            
            function fetchSuggestions(query) {
                fetch(`/pelanggan/search/suggestions?q=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        displaySuggestions(data);
                    })
                    .catch(error => {
                        console.error('Error fetching suggestions:', error);
                        hideSuggestions();
                    });
            }
            
            function displaySuggestions(suggestions) {
                if (suggestions.length === 0) {
                    hideSuggestions();
                    return;
                }
                
                let html = '';
                suggestions.forEach(item => {
                    html += `
                        <div class="search-suggestion-item" onclick="selectSuggestion('${item.text.replace(/'/g, "\\'")}')">
                            <i class="${item.icon} suggestion-icon"></i>
                            <span class="suggestion-text">${item.text}</span>
                            <span class="suggestion-category">${item.category}</span>
                        </div>
                    `;
                });
                
                searchSuggestions.innerHTML = html;
                showSuggestions();
            }
            
            function showSuggestions() {
                searchSuggestions.style.display = 'block';
            }
            
            function hideSuggestions() {
                searchSuggestions.style.display = 'none';
            }
            
            // Handle keyboard navigation
            searchInput.addEventListener('keydown', function(e) {
                const suggestions = searchSuggestions.querySelectorAll('.search-suggestion-item');
                const activeItem = searchSuggestions.querySelector('.search-suggestion-item.active');
                
                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    let next = activeItem ? activeItem.nextElementSibling : suggestions[0];
                    if (next) {
                        if (activeItem) activeItem.classList.remove('active');
                        next.classList.add('active');
                    }
                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    let prev = activeItem ? activeItem.previousElementSibling : suggestions[suggestions.length - 1];
                    if (prev) {
                        if (activeItem) activeItem.classList.remove('active');
                        prev.classList.add('active');
                    }
                } else if (e.key === 'Enter') {
                    if (activeItem) {
                        e.preventDefault();
                        activeItem.click();
                    }
                } else if (e.key === 'Escape') {
                    hideSuggestions();
                    searchInput.blur();
                }
            });
            
            // Hide suggestions when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.search-container')) {
                    hideSuggestions();
                }
            });
        }
        
        // Global functions
        window.selectSuggestion = function(text) {
            searchInput.value = text;
            hideSuggestions();
            // Submit the form
            searchInput.closest('form').submit();
        };
        
        window.searchTag = function(tag) {
            searchInput.value = tag;
            searchInput.closest('form').submit();
        };

        // Global cart functions
        window.updateCartBadge = function() {
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const cartBadge = document.querySelector('.cart-badge');
            if (cartBadge) {
                const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
                cartBadge.textContent = totalItems;
                cartBadge.style.display = totalItems > 0 ? 'inline' : 'none';
            }
        };

        // Initialize cart badge on page load
        window.updateCartBadge();
        
        // Update cart badge when storage changes (from other tabs)
        window.addEventListener('storage', function(e) {
            if (e.key === 'cart') {
                window.updateCartBadge();
            }
        });
    });
    </script>
    
    @stack('scripts')
</body>
</html>
