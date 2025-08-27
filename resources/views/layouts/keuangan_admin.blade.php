<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Keuangan - MyYOGYA')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    @stack('styles')
    
    <style>
        :root {
            --primary-color: #f26b37;
            --secondary-color: #d7263d;
            --admin-bg: #0f172a;
            --admin-bg-soft: #111827;
            --admin-surface: #111827;
            --admin-surface-2: #1f2937;
            --admin-text: #e5e7eb;
            --admin-text-dim: #9ca3af;
            --admin-primary: #22c55e;
            --admin-primary-600: #16a34a;
            --admin-hover: #374151;
            --text-dark: #2c3e50;
            --text-light: #6c757d;
            --light-bg: #f8f9fa;
            --border-color: #e9ecef;
            --white: #ffffff;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--light-bg);
            margin: 0;
            overflow-x: hidden;
        }

        /* Admin Sidebar Styles */
        #sidebar {
            min-height: 100vh;
            width: 250px;
            position: fixed;
            left: 0;
            top: 0;
            transition: all 0.3s;
            background: linear-gradient(180deg, var(--admin-bg) 0%, var(--admin-surface) 100%);
            color: var(--admin-text);
            z-index: 1000;
        }

        .sidebar-link {
            color: var(--admin-text);
            text-decoration: none;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            transition: all 0.2s ease;
            border-radius: 8px;
            margin: 2px 10px;
        }

        .sidebar-link:hover {
            background-color: var(--admin-hover);
            color: var(--admin-text);
            transform: translateX(5px);
        }

        .sidebar-link.active {
            background-color: var(--admin-primary);
            color: white;
        }

        .sidebar-link i {
            width: 20px;
            margin-right: 12px;
            text-align: center;
        }

        .sidebar-brand {
            padding: 20px;
            border-bottom: 1px solid var(--admin-surface-2);
            text-align: center;
        }

        .sidebar-brand img {
            width: 40px;
            height: auto;
            margin-bottom: 10px;
        }

        .sidebar-brand h4 {
            color: var(--admin-primary);
            font-size: 1.25rem;
            margin: 0;
        }

        .sidebar-brand small {
            color: var(--admin-text-dim);
            font-size: 0.75rem;
        }

        /* Financial Navbar */
        .financial-navbar {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: fixed;
            top: 0;
            left: 250px;
            right: 0;
            z-index: 999;
            height: 70px;
        }

        .financial-nav-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 100%;
            padding: 0 30px;
        }

        .financial-nav-left {
            display: flex;
            align-items: center;
        }

        .financial-nav-title {
            color: white;
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
        }

        .financial-nav-subtitle {
            color: rgba(255,255,255,0.8);
            font-size: 0.9rem;
            margin-left: 20px;
        }

        .financial-nav-menu {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .financial-nav-link {
            color: rgba(255,255,255,0.9);
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 20px;
            transition: all 0.3s ease;
            font-weight: 500;
            position: relative;
        }

        .financial-nav-link:hover {
            color: white;
            background: rgba(255,255,255,0.1);
            text-decoration: none;
        }

        .financial-nav-link.active {
            background: rgba(255,255,255,0.2);
            color: white;
        }

        .financial-nav-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .financial-nav-time {
            color: rgba(255,255,255,0.9);
            font-size: 0.9rem;
        }

        .financial-nav-user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .financial-nav-avatar {
            width: 35px;
            height: 35px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .financial-nav-user-info h6 {
            color: white;
            margin: 0;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .financial-nav-user-info small {
            color: rgba(255,255,255,0.7);
            font-size: 0.75rem;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            margin-top: 70px;
            min-height: calc(100vh - 70px);
            background: var(--light-bg);
        }

        .page-content {
            padding: 30px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            #sidebar {
                margin-left: -250px;
            }

            #sidebar.show {
                margin-left: 0;
            }

            .financial-navbar {
                left: 0;
            }

            .main-content {
                margin-left: 0;
            }
        }

        /* Custom Cards */
        .kpi-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            border: none;
            transition: all 0.3s ease;
            height: 100%;
        }

        .kpi-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .kpi-card h5 {
            color: var(--text-dark);
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
        }

        .kpi-card p {
            color: var(--text-light);
            font-weight: 500;
            margin: 8px 0 0;
            font-size: 1rem;
        }

        .kpi-card small {
            color: var(--text-light);
            font-size: 0.8rem;
        }

        .kpi-green {
            border-left: 5px solid #28a745;
        }

        .kpi-blue {
            border-left: 5px solid #007bff;
        }

        .kpi-yellow {
            border-left: 5px solid #ffc107;
        }

        .kpi-red {
            border-left: 5px solid #dc3545;
        }

        .card-custom {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            border: none;
            overflow: hidden;
        }

        .card-custom .card-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            padding: 20px 25px;
        }

        .card-custom .card-title {
            font-weight: 600;
            font-size: 1.1rem;
        }

        .card-custom .card-body {
            padding: 25px;
        }
    </style>
</head>
<body>
    <!-- Admin Sidebar -->
    <div id="sidebar">
        <div class="sidebar-brand">
            <img src="{{ asset('image/logo_yogya.png') }}" alt="MyYOGYA">
            <h4>MyYOGYA</h4>
            <small>Admin Panel</small>
        </div>

        <div class="mt-4">
            <!-- Admin Menu -->
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i>
                Dashboard
            </a>
            <a href="{{ route('admin.penggajian') }}" class="sidebar-link {{ request()->routeIs('admin.penggajian') ? 'active' : '' }}">
                <i class="fas fa-money-bill"></i>
                Penggajian
            </a>
            <a href="{{ route('admin.absensi') }}" class="sidebar-link {{ request()->routeIs('admin.absensi') ? 'active' : '' }}">
                <i class="fas fa-calendar-check"></i>
                Absensi
            </a>
            <a href="{{ route('admin.laporan') }}" class="sidebar-link {{ request()->routeIs('admin.laporan') ? 'active' : '' }}">
                <i class="fas fa-chart-bar"></i>
                Laporan
            </a>
            <a href="{{ route('admin.keuangan') }}" class="sidebar-link {{ request()->routeIs('admin.keuangan*') ? 'active' : '' }}">
                <i class="fas fa-coins"></i>
                Keuangan
            </a>
            <a href="{{ route('admin.pengaturan') }}" class="sidebar-link {{ request()->routeIs('admin.pengaturan') ? 'active' : '' }}">
                <i class="fas fa-cog"></i>
                Pengaturan
            </a>

            <!-- Divider -->
            <hr style="border-color: var(--admin-surface-2); margin: 20px 15px;">

            <!-- Back to Store -->
            <a href="{{ route('dashboard') }}" class="sidebar-link">
                <i class="fas fa-home"></i>
                Kembali ke Toko
            </a>

            <!-- Logout -->
            <form action="{{ route('admin.logout') }}" method="POST" style="margin: 10px;">
                @csrf
                <button type="submit" class="sidebar-link w-100 border-0 bg-transparent text-start">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Financial Navbar -->
    <nav class="financial-navbar">
        <div class="financial-nav-content">
            <div class="financial-nav-left">
                <h1 class="financial-nav-title">
                    <i class="fas fa-chart-line me-2"></i>
                    Sistem Keuangan
                </h1>
                <span class="financial-nav-subtitle">@yield('page_title', 'Dashboard Keuangan')</span>
            </div>

            <div class="financial-nav-menu">
                <a href="{{ route('admin.keuangan') }}" class="financial-nav-link {{ request()->routeIs('admin.keuangan') && !request()->routeIs('admin.keuangan.*') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt me-1"></i>
                    Dashboard
                </a>
                <a href="{{ route('admin.keuangan.riwayat') }}" class="financial-nav-link {{ request()->routeIs('admin.keuangan.riwayat') ? 'active' : '' }}">
                    <i class="fas fa-history me-1"></i>
                    Riwayat
                </a>
                <a href="{{ route('admin.keuangan.bukubesar') }}" class="financial-nav-link {{ request()->routeIs('admin.keuangan.bukubesar') ? 'active' : '' }}">
                    <i class="fas fa-book me-1"></i>
                    Buku Besar
                </a>
                <a href="{{ route('admin.keuangan.laporan') }}" class="financial-nav-link {{ request()->routeIs('admin.keuangan.laporan') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar me-1"></i>
                    Laporan
                </a>
            </div>

            <div class="financial-nav-right">
                <div class="financial-nav-time">
                    <i class="fas fa-clock me-1"></i>
                    <span id="current-time"></span>
                </div>
                
                <div class="financial-nav-user">
                    <div class="financial-nav-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="financial-nav-user-info">
                        <h6>{{ auth()->user()->name ?? 'Admin Keuangan' }}</h6>
                        <small>Online</small>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="page-content">
            @hasSection('page_header')
                <div class="page-header mb-4">
                    <div class="page-header-content">
                        @yield('page_header')
                    </div>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Update time
        function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            const dateString = now.toLocaleDateString('id-ID', {
                weekday: 'short',
                day: 'numeric',
                month: 'short'
            });
            
            document.getElementById('current-time').textContent = `${timeString} | ${dateString}`;
        }
        
        // Update time every second
        setInterval(updateTime, 1000);
        updateTime();

        // Mobile sidebar toggle
        const sidebar = document.querySelector('#sidebar');
        const toggleBtn = document.createElement('button');
        toggleBtn.classList.add('btn', 'btn-primary', 'd-md-none', 'position-fixed');
        toggleBtn.style.cssText = 'top: 15px; left: 15px; z-index: 1001; border-radius: 50%; width: 45px; height: 45px;';
        toggleBtn.innerHTML = '<i class="fas fa-bars"></i>';
        
        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('show');
        });
        
        if (window.innerWidth <= 768) {
            document.body.appendChild(toggleBtn);
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            if (window.innerWidth <= 768) {
                const sidebar = document.querySelector('#sidebar');
                const toggleBtn = document.querySelector('button');
                
                if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
                    sidebar.classList.remove('show');
                }
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>
