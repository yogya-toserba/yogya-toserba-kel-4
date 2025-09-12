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
        
        /* Navbar Pelanggan Styles */
        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            border-bottom: 1px solid rgba(0,0,0,0.1);
            padding: 0.75rem 0;
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
            background: #1976d2;
            transform: translateY(-50%) scale(1.05);
        }

        /* Search Suggestions */
        .search-suggestions {
            display: flex;
            gap: 8px;
            margin-top: 8px;
            flex-wrap: wrap;
        }

        .suggestion-tag {
            background: rgba(108, 117, 125, 0.1);
            color: #6c757d;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.2s ease;
        }

        .suggestion-tag:hover {
            background: #6c757d;
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
            background: #6c757d;
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
            background: #5a6268;
            border-color: #5a6268;
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

        /* Responsive Design */
        @media (max-width: 768px) {
            .search-container {
                max-width: 100%;
                margin: 1rem 0;
            }
            
            .navbar-actions {
                margin-top: 1rem;
            }
            
            .profile-link .user-details {
                display: none;
            }
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
            color: #2c3e50 !important;
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
            background: rgba(0, 0, 0, 0.05);
            color: #2c3e50;
        }
        
        .dropdown-divider {
            margin: 10px 0;
        }
        
        .btn-outline-primary {
            border-color: var(--yogya-orange);
            color: var(--yogya-orange);
        }
        
        .btn-outline-primary:hover {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        
        .btn-primary {
            background-color: var(--yogya-orange);
            border-color: var(--yogya-orange);
        }
        
        .btn-primary:hover {
            background-color: #5a6268;
            border-color: #5a6268;
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
            box-shadow: 0 5px 15px rgba(33, 150, 243, 0.3);
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
            color: #2c3e50;
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
    @include('layouts.navbar_pelanggan')
    
    <!-- Main Content -->
    <main>
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
