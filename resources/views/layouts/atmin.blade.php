<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Keuangan - MyYOGYA')</title>
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
            --text-dark: #2c3e50;
            --text-light: #6c757d;
            --light-bg: #f8f9fa;
            --border-color: #e9ecef;
            --white: #ffffff;
            --sidebar-width: 260px;
            --navbar-height: 70px;
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

        /* Sidebar Styles */
        .sidebar {
            background: linear-gradient(180deg, var(--secondary-color), var(--primary-color));
            height: 100vh;
            color: white;
            padding: 0;
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 4px 0 15px rgba(0,0,0,0.1);
        }

        .sidebar-header {
            padding: 20px;
            background: rgba(0,0,0,0.1);
            border-bottom: 1px solid rgba(255,255,255,0.1);
            text-align: center;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            text-decoration: none;
            color: white;
        }

        .sidebar-logo:hover {
            color: white;
            text-decoration: none;
        }

        .sidebar-logo img {
            height: 40px;
            width: auto;
        }

        .sidebar-brand {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .sidebar-brand h4 {
            font-weight: 700;
            margin: 0;
            font-size: 1.4rem;
        }

        .sidebar-brand small {
            font-size: 0.8rem;
            opacity: 0.8;
            font-weight: 500;
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .sidebar-menu-item {
            margin: 0 15px 8px;
        }

        .sidebar-menu-link {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            color: rgba(255,255,255,0.9);
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.3s ease;
            font-weight: 500;
            position: relative;
            overflow: hidden;
        }

        .sidebar-menu-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            transition: left 0.5s ease;
        }

        .sidebar-menu-link:hover::before {
            left: 100%;
        }

        .sidebar-menu-link:hover {
            background: rgba(255,255,255,0.15);
            color: white;
            transform: translateX(5px);
            text-decoration: none;
        }

        .sidebar-menu-link.active {
            background: rgba(255,255,255,0.2);
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .sidebar-menu-link.active::after {
            content: '';
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: white;
            border-radius: 2px 0 0 2px;
        }

        .sidebar-menu-link i {
            width: 20px;
            margin-right: 12px;
            font-size: 1.1rem;
        }

        .sidebar-user {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 20px;
            background: rgba(0,0,0,0.1);
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-user-avatar {
            width: 45px;
            height: 45px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
        }

        .sidebar-user-details h6 {
            margin: 0;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .sidebar-user-details small {
            opacity: 0.8;
            font-size: 0.75rem;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Top Navbar */
        .top-navbar {
            background: white;
            height: var(--navbar-height);
            box-shadow: 0 2px 15px rgba(0,0,0,0.08);
            display: flex;
            align-items: center;
            padding: 0 30px;
            position: sticky;
            top: 0;
            z-index: 999;
            border-bottom: 1px solid var(--border-color);
        }

        .navbar-breadcrumb {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text-light);
            font-weight: 500;
        }

        .navbar-breadcrumb i {
            color: var(--primary-color);
        }

        .navbar-actions {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .navbar-time {
            color: var(--text-dark);
            font-weight: 600;
            font-size: 0.9rem;
        }

        .navbar-user {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 15px;
            background: rgba(242, 107, 55, 0.1);
            border-radius: 25px;
            border: 1px solid rgba(242, 107, 55, 0.2);
        }

        .navbar-user-avatar {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.9rem;
        }

        .navbar-user-info h6 {
            margin: 0;
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--text-dark);
        }

        .navbar-user-info small {
            color: var(--primary-color);
            font-weight: 500;
        }

        /* Page Content */
        .page-content {
            flex: 1;
            padding: 30px;
        }

        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 40px 30px;
            margin: -30px -30px 30px -30px;
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
        }

        .page-header-content {
            position: relative;
            z-index: 1;
        }

        .page-header h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 8px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .page-header .lead {
            font-size: 1rem;
            opacity: 0.9;
            margin: 0;
        }

        /* Cards */
        .card-custom {
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            border: 1px solid rgba(242, 107, 55, 0.1);
            margin-bottom: 25px;
            overflow: hidden;
        }

        .card-custom .card-header {
            background: linear-gradient(135deg, rgba(242, 107, 55, 0.1), rgba(215, 38, 61, 0.1));
            border-bottom: 1px solid rgba(242, 107, 55, 0.1);
            padding: 20px;
            font-weight: 600;
        }

        .card-custom .card-body {
            padding: 25px;
        }

        /* KPI Cards */
        .kpi-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            border: 1px solid rgba(242, 107, 55, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .kpi-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        }

        .kpi-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0,0,0,0.15);
        }

        .kpi-card h5 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--text-dark);
        }

        .kpi-card p {
            font-weight: 600;
            margin-bottom: 5px;
            color: var(--text-dark);
        }

        .kpi-card small {
            color: var(--text-light);
            font-weight: 500;
        }

        .kpi-green h5 { color: #28a745; }
        .kpi-blue h5 { color: #007bff; }
        .kpi-yellow h5 { color: #ffc107; }
        .kpi-red h5 { color: #dc3545; }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .page-content {
                padding: 20px;
            }

            .top-navbar {
                padding: 0 20px;
            }
        }

        /* Scrollbar */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.1);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255,255,255,0.5);
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('keuangan.dashboard') }}" class="sidebar-logo">
                <img src="{{ asset('image/logo_yogya.png') }}" alt="MyYOGYA">
                <div class="sidebar-brand">
                    <h4>MyYOGYA</h4>
                    <small>Admin Keuangan</small>
                </div>
            </a>
        </div>

        <div class="sidebar-menu">
            <div class="sidebar-menu-item">
                <a href="{{ route('keuangan.dashboard') }}" class="sidebar-menu-link {{ request()->routeIs('keuangan.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i>
                    Dashboard
                </a>
            </div>
            <div class="sidebar-menu-item">
                <a href="{{ route('keuangan.riwayat') }}" class="sidebar-menu-link {{ request()->routeIs('keuangan.riwayat') ? 'active' : '' }}">
                    <i class="fas fa-history"></i>
                    Riwayat Transaksi
                </a>
            </div>
            <div class="sidebar-menu-item">
                <a href="{{ route('keuangan.bukubesar') }}" class="sidebar-menu-link {{ request()->routeIs('keuangan.bukubesar') ? 'active' : '' }}">
                    <i class="fas fa-book"></i>
                    Buku Besar
                </a>
            </div>
            <div class="sidebar-menu-item">
                <a href="{{ route('keuangan.laporan') }}" class="sidebar-menu-link {{ request()->routeIs('keuangan.laporan') ? 'active' : '' }}">
                    <i class="fas fa-chart-line"></i>
                    Laporan Keuangan
                </a>
            </div>
            
            <!-- Divider -->
            <hr style="border-color: rgba(255,255,255,0.2); margin: 20px 15px;">
            
            <div class="sidebar-menu-item">
                <a href="{{ route('dashboard') }}" class="sidebar-menu-link">
                    <i class="fas fa-home"></i>
                    Kembali ke Toko
                </a>
            </div>
        </div>

        <div class="sidebar-user">
            <div class="sidebar-user-info">
                <div class="sidebar-user-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div class="sidebar-user-details">
                    <h6>{{ auth()->user()->name ?? 'Admin Keuangan' }}</h6>
                    <small>Administrator</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navbar -->
        <div class="top-navbar">
            <div class="navbar-breadcrumb">
                <i class="fas fa-chart-line"></i>
                <span>Sistem Keuangan</span>
                <i class="fas fa-chevron-right"></i>
                <span>@yield('page_title', 'Dashboard')</span>
            </div>

            <div class="navbar-actions">
                <div class="navbar-time">
                    <i class="fas fa-clock me-2"></i>
                    <span id="current-time"></span>
                </div>
                
                <div class="navbar-user">
                    <div class="navbar-user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="navbar-user-info">
                        <h6>{{ auth()->user()->name ?? 'Admin' }}</h6>
                        <small>Online</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div class="page-content">
            @hasSection('page_header')
                <div class="page-header">
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
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            
            document.getElementById('current-time').textContent = `${timeString} - ${dateString}`;
        }
        
        // Update time every second
        setInterval(updateTime, 1000);
        updateTime();

        // Mobile sidebar toggle
        const sidebar = document.querySelector('.sidebar');
        const toggleBtn = document.createElement('button');
        toggleBtn.classList.add('btn', 'btn-primary', 'd-md-none', 'position-fixed');
        toggleBtn.style.cssText = 'top: 15px; left: 15px; z-index: 1001;';
        toggleBtn.innerHTML = '<i class="fas fa-bars"></i>';
        
        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('show');
        });
        
        if (window.innerWidth <= 768) {
            document.body.appendChild(toggleBtn);
        }
    </script>
    
    @stack('scripts')
</body>
</html>