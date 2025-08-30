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
            --sidebar-width: 260px;
            --navbar-height: 70px;
        }

        #sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            transition: all 0.3s;
            background: linear-gradient(180deg, var(--secondary-color), var(--primary-color));
            color: white;
            z-index: 1000;
            overflow-y: auto;
            box-shadow: 4px 0 15px rgba(0,0,0,0.1);
        }

        .content {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            min-height: 100vh;
            background: #f8fafc;
        }

        .sidebar-link {
            color: rgba(255,255,255,0.9) !important;
            text-decoration: none !important;
            padding: 15px 20px;
            display: block;
            border-radius: 12px;
            margin: 0 15px 8px;
            position: relative;
            font-weight: 500;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .sidebar-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            transition: left 0.5s ease;
        }

        .sidebar-link:hover::before {
            left: 100%;
        }

        .sidebar-link:hover {
            background: rgba(255,255,255,0.15) !important;
            color: white !important;
            text-decoration: none !important;
            transform: translateX(5px);
        }

        .sidebar-link.active {
            background: rgba(255,255,255,0.2) !important;
            color: white !important;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .sidebar-link.active::after {
            content: '';
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: white;
            border-radius: 2px 0 0 2px;
        }

        .dropdown-toggle::after {
            display: none;
        }

        .sidebar-link .fa-chevron-down {
            position: absolute;
            top: 18px;
            right: 17px;
            transition: transform 0.3s ease;
            font-size: 0.8rem;
        }

        .sidebar-link .keuangan-arrow {
            position: absolute;
            top: 18px;
            right: 17px;
            transition: transform 0.3s ease;
            font-size: 0.8rem;
        }

        .sidebar-link[aria-expanded="true"] .fa-chevron-down,
        .sidebar-link[aria-expanded="true"] .keuangan-arrow {
            transform: rotate(180deg);
        }

        /* Fix dropdown toggle */
        .dropdown-toggle::after {
            display: none !important;
        }

        #keuanganSubmenu .sidebar-link {
            padding: 12px 20px;
            font-size: 0.9rem;
            margin: 2px 15px;
            color: rgba(255, 255, 255, 0.8) !important;
            text-decoration: none !important;
            border-radius: 8px;
        }

        #keuanganSubmenu .sidebar-link:hover {
            background: rgba(255, 255, 255, 0.1);
            padding-left: 25px;
            transition: all 0.3s ease;
            color: white !important;
        }

        #keuanganSubmenu .sidebar-link.active {
            background: rgba(255, 255, 255, 0.2);
            color: white !important;
            font-weight: 600;
        }

        /* Sidebar Header */
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

        .sidebar-brand h4 {
            font-weight: 700;
            margin: 0;
            font-size: 1.4rem;
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .sidebar-menu-item {
            margin-bottom: 8px;
        }

        .sidebar-link i {
            width: 20px;
            margin-right: 12px;
            font-size: 1.1rem;
        }
        }

        .collapse {
            transition: all 0.3s ease-in-out;
        }

        .navbar {
            background: #ffffff !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .card {
            border-radius: 12px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
        }

        .avatar-sm {
            width: 40px;
            height: 40px;
        }

        .list-group-item {
            border: none !important;
            padding: 0.75rem 0;
        }

        .table th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            color: #6c757d;
        }

        main.p-4 {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            min-height: calc(100vh - 70px);
        }

        @media (max-width: 768px) {
            #sidebar {
                margin-left: -250px;
            }

            #sidebar.active {
                margin-left: 0;
            }

            .content {
                margin-left: 0;
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-logo">
                    <div class="sidebar-brand">
                        <h4>Yogya Admin</h4>
                    </div>
                </a>
            </div>

            <div class="sidebar-menu">
                <ul class="list-unstyled">
                    <li class="sidebar-menu-item">
                        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                            <i class="fas fa-home me-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="{{ route('admin.data-karyawan') }}" class="sidebar-link {{ Request::is('admin/data-karyawan*') ? 'active' : '' }}">
                            <i class="fas fa-users me-2"></i> Data Karyawan
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="{{ route('admin.penggajian') }}" class="sidebar-link {{ Request::is('admin/penggajian*') ? 'active' : '' }}">
                            <i class="fas fa-money-check-alt me-2"></i> Penggajian
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="{{ route('admin.absensi') }}" class="sidebar-link {{ Request::is('admin/absensi*') ? 'active' : '' }}">
                            <i class="fas fa-user-check me-2"></i> Absensi
                        </a>
                    </li>
                    
                    <!-- Keuangan Dropdown -->
                    <li class="sidebar-menu-item nav-item dropdown">
                        <a href="#" class="sidebar-link dropdown-toggle {{ Request::is('admin/laporan*') || Request::is('admin/keuangan*') ? 'active' : '' }}" 
                           id="keuanganDropdown" role="button" data-bs-toggle="collapse" data-bs-target="#keuanganSubmenu" 
                           aria-expanded="{{ Request::is('admin/laporan*') || Request::is('admin/keuangan*') ? 'true' : 'false' }}">
                            <i class="fas fa-chart-pie me-2"></i> Keuangan
                            <i class="fas fa-chevron-down keuangan-arrow"></i>
                        </a>
                        <div class="collapse {{ Request::is('admin/laporan*') || Request::is('admin/keuangan*') ? 'show' : '' }}" id="keuanganSubmenu">
                            <ul class="list-unstyled">
                                <li>
                                    <a href="{{ route('admin.laporan') }}" class="sidebar-link {{ Request::is('admin/laporan') ? 'active' : '' }}">
                                        <i class="fas fa-file-alt me-2"></i> Laporan
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.keuangan.riwayat') }}" class="sidebar-link {{ Request::is('admin/keuangan/riwayat*') ? 'active' : '' }}">
                                        <i class="fas fa-history me-2"></i> Riwayat Transaksi
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.keuangan.bukubesar') }}" class="sidebar-link {{ Request::is('admin/keuangan/buku-besar*') ? 'active' : '' }}">
                                        <i class="fas fa-book me-2"></i> Buku Besar
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <li class="sidebar-menu-item">
                        <a href="{{ route('admin.pengaturan') }}" class="sidebar-link {{ Request::is('admin/pengaturan*') ? 'active' : '' }}">
                            <i class="fas fa-cog me-2"></i> Pengaturan
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="content">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg shadow-sm">
                <div class="container-fluid">
                    <div class="ms-auto">
                        <div class="dropdown">
                            <button class="btn btn-link dropdown-toggle text-dark text-decoration-none" type="button"
                                id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle me-1"></i> Admin
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="{{ route('admin.profile') }}">Profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.pengaturan') }}">Settings</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="{{ route('admin.logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main class="p-4">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Simple dropdown functionality only
        document.addEventListener('DOMContentLoaded', function() {
            // No minimized functionality
        });
    </script>
    @stack('scripts')
</body>

</html>