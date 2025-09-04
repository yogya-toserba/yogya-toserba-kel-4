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
        }
        
        .navbar {
            background: white !important;
            box-shadow: 0 2px 20px rgba(0,0,0,0.08);
            padding: 1rem 0;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            background: linear-gradient(135deg, var(--yogya-orange) 0%, var(--yogya-yellow) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .nav-link {
            color: var(--yogya-dark) !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            color: var(--yogya-orange) !important;
        }
        
        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            border-radius: 12px;
            padding: 10px;
        }
        
        .dropdown-item {
            border-radius: 8px;
            padding: 10px 15px;
            margin: 2px 0;
            transition: all 0.3s ease;
        }
        
        .dropdown-item:hover {
            background: rgba(242, 107, 55, 0.1);
            color: var(--yogya-orange);
        }
        
        .dropdown-divider {
            margin: 10px 0;
        }
        
        .btn-outline-primary {
            border-color: var(--yogya-orange);
            color: var(--yogya-orange);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--yogya-orange);
            border-color: var(--yogya-orange);
        }
        
        .btn-primary {
            background-color: var(--yogya-orange);
            border-color: var(--yogya-orange);
        }
        
        .btn-primary:hover {
            background-color: var(--yogya-orange-dark);
            border-color: var(--yogya-orange-dark);
        }
        
        .search-container {
            position: relative;
            flex-grow: 1;
            max-width: 600px;
            margin: 0 2rem;
        }
        
        .search-input {
            border-radius: 25px;
            border: 2px solid #e9ecef;
            padding: 12px 50px 12px 20px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }
        
        .search-input:focus {
            border-color: var(--yogya-orange);
            box-shadow: 0 0 0 0.2rem rgba(242, 107, 55, 0.25);
        }
        
        .search-btn {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            background: linear-gradient(135deg, var(--yogya-orange) 0%, var(--yogya-orange-dark) 100%);
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            color: white;
            transition: all 0.3s ease;
        }
        
        .search-btn:hover {
            transform: translateY(-50%) scale(1.05);
            box-shadow: 0 5px 15px rgba(242, 107, 55, 0.3);
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--yogya-orange) 0%, var(--yogya-yellow) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }
        
        .back-link {
            color: var(--yogya-orange);
            text-decoration: none;
            font-weight: 500;
            margin-bottom: 20px;
            display: inline-block;
            transition: all 0.3s ease;
        }
        
        .back-link:hover {
            color: var(--yogya-orange-dark);
            transform: translateX(-5px);
        }
        
        @media (max-width: 768px) {
            .search-container {
                margin: 1rem 0;
                max-width: 100%;
            }
            
            .navbar-nav {
                padding-top: 1rem;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('pelanggan.dashboard') }}">
                <i class="fas fa-store me-2"></i>MyYOGYA
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Search Bar -->
                <div class="search-container d-none d-lg-block">
                    <form action="{{ route('pelanggan.search') }}" method="GET" class="position-relative">
                        <input type="text" class="form-control search-input" name="q" 
                               placeholder="Cari produk, kategori, atau brand..." 
                               value="{{ request('q') }}">
                        <button type="submit" class="search-btn">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
                
                <!-- User Menu -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pelanggan.dashboard') }}">
                            <i class="fas fa-home me-1"></i>Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-shopping-cart me-1"></i>Keranjang
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" 
                           role="button" data-bs-toggle="dropdown">
                            <div class="user-avatar me-2">
                                {{ strtoupper(substr(auth('pelanggan')->user()->nama_pelanggan, 0, 1)) }}
                            </div>
                            <span class="d-none d-md-inline">{{ auth('pelanggan')->user()->nama_pelanggan }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <div class="dropdown-item-text">
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-3">
                                            {{ strtoupper(substr(auth('pelanggan')->user()->nama_pelanggan, 0, 1)) }}
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ auth('pelanggan')->user()->nama_pelanggan }}</h6>
                                            <small class="text-muted">{{ auth('pelanggan')->user()->level_membership ?? 'Basic' }} Member</small>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('pelanggan.profile') }}">
                                <i class="fas fa-user me-2"></i>Profile Saya</a></li>
                            <li><a class="dropdown-item" href="#">
                                <i class="fas fa-box me-2"></i>Pesanan Saya</a></li>
                            <li><a class="dropdown-item" href="#">
                                <i class="fas fa-heart me-2"></i>Wishlist</a></li>
                            <li><a class="dropdown-item" href="#">
                                <i class="fas fa-wallet me-2"></i>Dompet Digital</a></li>
                            <li><a class="dropdown-item" href="#">
                                <i class="fas fa-cog me-2"></i>Pengaturan</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('pelanggan.logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Mobile Search (visible on mobile) -->
    <div class="container d-lg-none my-3">
        <form action="{{ route('pelanggan.search') }}" method="GET" class="position-relative">
            <input type="text" class="form-control search-input" name="q" 
                   placeholder="Cari produk..." 
                   value="{{ request('q') }}">
            <button type="submit" class="search-btn">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
    
    <!-- Main Content -->
    <main class="py-4">
        @yield('content')
    </main>
    
    <!-- Footer -->
    <footer class="bg-white mt-5 py-4 border-top">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="fw-bold text-orange">MyYOGYA</h6>
                    <p class="text-muted mb-0">Platform belanja online terpercaya dengan produk berkualitas</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="text-muted mb-0">&copy; 2024 MyYOGYA. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html>
