<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #f26b37;
            --secondary-color: #d7263d;
            --text-dark: #2c3e50;
            --text-light: #6c757d;
            --light-bg: #f8f9fa;
            --border-color: #e9ecef;
            --white: #ffffff;
            --sidebar-width: 250px;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8fafc;
            margin: 0;
            padding: 0;
        }

        /* SIDEBAR STYLES */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--secondary-color), var(--primary-color));
            color: white;
            z-index: 1000;
            overflow-y: auto;
            box-shadow: 4px 0 15px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
        }

        /* MAIN CONTENT */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            background: #f8fafc;
            padding: 0;
        }

        /* SIDEBAR BRAND */
        .sidebar-brand {
            padding: 20px;
            background: rgba(0,0,0,0.1);
            border-bottom: 1px solid rgba(255,255,255,0.1);
            text-align: center;
        }

        .sidebar-brand h4 {
            margin: 0;
            font-weight: 700;
            font-size: 1.3rem;
            color: white;
        }

        .brand-subtitle {
            font-size: 0.8rem;
            opacity: 0.8;
            margin-top: 5px;
        }

        /* ADMIN INFO */
        .admin-section {
            padding: 15px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 15px;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .admin-avatar {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
        }

        .admin-info h6 {
            margin: 0;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .admin-info small {
            opacity: 0.8;
            font-size: 0.75rem;
        }

        /* NAVIGATION MENU */
        .sidebar-nav {
            flex: 1;
            padding: 0 15px;
        }

        .nav-link {
            color: rgba(255,255,255,0.9);
            text-decoration: none;
            padding: 12px 15px;
            display: block;
            border-radius: 8px;
            margin-bottom: 5px;
            position: relative;
            font-weight: 500;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .nav-link:hover {
            background: rgba(255,255,255,0.15);
            color: white;
            text-decoration: none;
            transform: translateX(3px);
        }

        .nav-link.active {
            background: rgba(255,255,255,0.2);
            color: white;
            font-weight: 600;
        }

        .nav-link i {
            width: 18px;
            margin-right: 10px;
            font-size: 0.9rem;
        }

        /* DROPDOWN STYLES */
        .dropdown-nav {
            margin-bottom: 5px;
        }

        .dropdown-toggle-nav {
            color: rgba(255,255,255,0.9);
            text-decoration: none;
            padding: 12px 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            cursor: pointer;
        }

        .dropdown-toggle-nav:hover {
            background: rgba(255,255,255,0.15);
            color: white;
            text-decoration: none;
        }

        .dropdown-toggle-nav.active {
            background: rgba(255,255,255,0.2);
            color: white;
        }

        .dropdown-arrow {
            transition: transform 0.3s ease;
            font-size: 0.7rem;
        }

        .dropdown-nav.show .dropdown-arrow {
            transform: rotate(180deg);
        }

        .submenu {
            display: none;
            padding-left: 25px;
            margin-top: 5px;
        }

        .submenu.show {
            display: block;
        }

        .submenu .nav-link {
            font-size: 0.85rem;
            padding: 8px 15px;
            color: rgba(255,255,255,0.8);
        }

        .submenu .nav-link:hover {
            background: rgba(255,255,255,0.1);
            padding-left: 20px;
        }

        /* SIDEBAR FOOTER */
        .sidebar-footer {
            padding: 15px 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
            font-size: 0.75rem;
            opacity: 0.8;
        }

        .sidebar-footer p {
            margin: 5px 0;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .sidebar {
                margin-left: -250px;
                transition: margin-left 0.3s ease;
            }

            .sidebar.active {
                margin-left: 0;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="sidebar">
            <!-- Brand -->
            <div class="sidebar-brand">
                <h4>MyYOGYA</h4>
                <div class="brand-subtitle">Admin Panel</div>
            </div>

            <!-- Admin Info -->
            <div class="admin-section">
                <div class="admin-profile">
                    <div class="admin-avatar">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div class="admin-info">
                        <h6>Admin</h6>
                        <small>Administrator</small>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <div class="sidebar-nav">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>

                <a href="{{ route('admin.data-karyawan') }}" class="nav-link {{ Request::is('admin/data-karyawan*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> Data Karyawan
                </a>

                <a href="{{ route('admin.penggajian') }}" class="nav-link {{ Request::is('admin/penggajian*') ? 'active' : '' }}">
                    <i class="fas fa-money-check-alt"></i> Penggajian
                </a>

                <a href="{{ route('admin.absensi') }}" class="nav-link {{ Request::is('admin/absensi*') ? 'active' : '' }}">
                    <i class="fas fa-user-check"></i> Absensi
                </a>

                <!-- Keuangan Dropdown -->
                <div class="dropdown-nav {{ Request::is('admin/laporan*') || Request::is('admin/keuangan*') ? 'show' : '' }}">
                    <div class="dropdown-toggle-nav {{ Request::is('admin/laporan*') || Request::is('admin/keuangan*') ? 'active' : '' }}" onclick="toggleDropdown()">
                        <span><i class="fas fa-chart-pie"></i> Keuangan</span>
                        <i class="fas fa-chevron-down dropdown-arrow"></i>
                    </div>
                    <div class="submenu {{ Request::is('admin/laporan*') || Request::is('admin/keuangan*') ? 'show' : '' }}">
                        <a href="{{ route('admin.laporan') }}" class="nav-link {{ Request::is('admin/laporan') ? 'active' : '' }}">
                            <i class="fas fa-file-alt"></i> Laporan
                        </a>
                        <a href="{{ route('admin.keuangan.riwayat') }}" class="nav-link {{ Request::is('admin/keuangan/riwayat*') ? 'active' : '' }}">
                            <i class="fas fa-history"></i> Riwayat Transaksi
                        </a>
                        <a href="{{ route('admin.keuangan.bukubesar') }}" class="nav-link {{ Request::is('admin/keuangan/buku-besar*') ? 'active' : '' }}">
                            <i class="fas fa-book"></i> Buku Besar
                        </a>
                    </div>
                </div>

                <a href="{{ route('admin.pengaturan') }}" class="nav-link {{ Request::is('admin/pengaturan*') ? 'active' : '' }}">
                    <i class="fas fa-cog"></i> Pengaturan
                </a>
            </div>

            <!-- Footer -->
            <div class="sidebar-footer">
                <p><i class="fas fa-code-branch"></i> v2.1.3</p>
                <p><i class="fas fa-clock"></i> Login: {{ date('d/m/Y H:i') }}</p>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleDropdown() {
            const dropdown = document.querySelector('.dropdown-nav');
            const submenu = dropdown.querySelector('.submenu');
            const arrow = dropdown.querySelector('.dropdown-arrow');
            
            dropdown.classList.toggle('show');
            submenu.classList.toggle('show');
            
            if (dropdown.classList.contains('show')) {
                arrow.style.transform = 'rotate(180deg)';
            } else {
                arrow.style.transform = 'rotate(0deg)';
            }
        }
    </script>
    @stack('scripts')
</body>
</html>
