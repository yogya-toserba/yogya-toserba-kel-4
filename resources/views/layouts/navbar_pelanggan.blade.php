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
                    <a class="nav-link notification-link" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="nav-icon-wrapper">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge pulse">3</span>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end notification-dropdown">
                        <li><h6 class="dropdown-header">
                            <i class="fas fa-bell me-2"></i>Notifikasi Terbaru
                        </h6></li>
                        <li><a class="dropdown-item" href="#">
                            <div class="notification-item">
                                <i class="fas fa-shipping-fast text-success me-2"></i>
                                <span>Pesanan Anda sedang dikirim</span>
                            </div>
                        </a></li>
                        <li><a class="dropdown-item" href="#">
                            <div class="notification-item">
                                <i class="fas fa-bolt text-warning me-2"></i>
                                <span>Flash Sale dimulai dalam 1 jam</span>
                            </div>
                        </a></li>
                        <li><a class="dropdown-item" href="#">
                            <div class="notification-item">
                                <i class="fas fa-gift text-primary me-2"></i>
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
                    <a class="nav-link profile-link" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="profile-info">
                            <div class="avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="user-details">
                                <span class="user-name">{{ auth('pelanggan')->user()->nama }}</span>
                                <span class="user-status">Premium Member</span>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end profile-dropdown">
                        <li class="dropdown-header">
                            <div class="profile-header-dropdown">
                                <div class="avatar-large">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="user-info">
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
                            <form action="{{ route('pelanggan.logout') }}" method="POST" class="d-inline w-100">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger w-100 text-start border-0 bg-transparent"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
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

<!-- Search Styles & Functionality -->
<style>
    /* Remove all orange hover effects from navbar */
    .navbar-actions .nav-link,
    .notification-link,
    .cart-link,
    .profile-link {
        transition: all 0.3s ease !important;
        border: none !important;
        outline: none !important;
    }
    
    .navbar-actions .nav-link:hover,
    .navbar-actions .nav-link:focus,
    .notification-link:hover,
    .cart-link:hover,
    .profile-link:hover {
        background: rgba(0, 0, 0, 0.05) !important;
        color: #2c3e50 !important;
        transform: translateY(-1px);
        border: none !important;
        outline: none !important;
    }
    
    /* Remove icon color changes on hover */
    .navbar-actions .fas,
    .navbar-actions i {
        color: #2c3e50 !important;
        transition: none !important;
    }
    
    .navbar-actions .nav-link:hover .fas,
    .navbar-actions .nav-link:hover i {
        color: #2c3e50 !important;
        transform: none !important;
    }

    /* Hide Bootstrap dropdown arrows */
    .dropdown-toggle::after {
        display: none !important;
    }
    
    .dropdown-toggle::before {
        display: none !important;
    }
    
    /* Remove any borders or boxes from navbar elements */
    .navbar-actions .dropdown,
    .navbar-actions .nav-item,
    .navbar-actions .nav-link {
        border: none !important;
        box-shadow: none !important;
        outline: none !important;
    }
    
    /* Profile info styling without borders */
    .profile-info {
        border: none !important;
        background: transparent !important;
        box-shadow: none !important;
    }

    /* Enhanced Dropdown Styles */
    .dropdown-menu {
        border: none !important;
        border-radius: 12px !important;
        box-shadow: 0 10px 40px rgba(0,0,0,0.15) !important;
        padding: 8px 0 !important;
        margin-top: 8px !important;
        min-width: 250px !important;
        max-width: 320px !important;
    }
    
    .dropdown-menu.dropdown-menu-end {
        right: 0 !important;
        left: auto !important;
    }
    
    .dropdown-item {
        padding: 12px 20px !important;
        font-size: 0.9rem !important;
        transition: all 0.2s ease !important;
        border-radius: 8px !important;
        margin: 2px 8px !important;
        border: none !important;
        background: transparent !important;
        display: flex !important;
        align-items: center !important;
        white-space: nowrap !important;
    }

    .dropdown-item:hover,
    .dropdown-item:focus {
        background: rgba(0, 0, 0, 0.05) !important;
        color: #2c3e50 !important;
        transform: translateX(5px) !important;
    }
    
    .dropdown-item i {
        color: #6c757d !important;
        width: 16px !important;
        text-align: center !important;
    }
    
    .dropdown-header {
        padding: 15px 20px 10px !important;
        margin-bottom: 0 !important;
        font-size: 0.9rem !important;
        font-weight: 600 !important;
        color: #2c3e50 !important;
        border-bottom: 1px solid #e9ecef !important;
    }
    
    .dropdown-divider {
        margin: 8px 12px !important;
        border-color: #e9ecef !important;
    }

    /* Profile Dropdown Specific Styles */
    .profile-dropdown {
        min-width: 280px !important;
    }
    
    .profile-header-dropdown {
        display: flex !important;
        align-items: center !important;
        gap: 12px !important;
        padding: 5px 0 !important;
    }
    
    .avatar-large {
        background: linear-gradient(135deg, var(--yogya-orange) 0%, var(--yogya-yellow) 100%) !important;
        width: 45px !important;
        height: 45px !important;
        border-radius: 50% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        color: white !important;
        font-size: 1.1rem !important;
        flex-shrink: 0 !important;
    }
    
    .user-info h6 {
        font-size: 0.9rem !important;
        font-weight: 600 !important;
        color: #2c3e50 !important;
        margin: 0 !important;
    }
    
    .user-info small {
        color: #6c757d !important;
        font-size: 0.75rem !important;
    }

    /* Notification Dropdown Specific Styles */
    .notification-dropdown {
        min-width: 300px !important;
        max-width: 350px !important;
    }
    
    .notification-item {
        display: flex !important;
        align-items: center !important;
        gap: 8px !important;
        width: 100% !important;
    }
    
    .notification-item i {
        font-size: 0.9rem !important;
        flex-shrink: 0 !important;
    }
    
    .notification-item span {
        font-size: 0.85rem !important;
        line-height: 1.3 !important;
        flex-grow: 1 !important;
    }

    /* Responsive dropdown fixes */
    @media (max-width: 768px) {
        .dropdown-menu {
            position: static !important;
            float: none !important;
            width: 100% !important;
            margin-top: 10px !important;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1) !important;
        }
        
        .dropdown-menu.dropdown-menu-end {
            right: auto !important;
            left: 0 !important;
        }
        
        .profile-dropdown,
        .notification-dropdown {
            min-width: 100% !important;
            max-width: 100% !important;
        }
    }

    /* Search suggestions styling */
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
        background: rgba(0, 0, 0, 0.05);
        color: #2c3e50;
    }
    
    .search-suggestion-item:last-child {
        border-bottom: none;
        border-radius: 0 0 15px 15px;
    }
    
    .search-suggestion-item:first-child {
        border-radius: 15px 15px 0 0;
    }
    
    .suggestion-icon {
        color: #6c757d;
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
    
    .suggestion-tag {
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .suggestion-tag:hover {
        background: #6c757d;
        color: white;
        transform: translateY(-2px);
    }
    
    .search-box {
        position: relative;
        width: 100%;
    }
</style>

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
});
</script>
