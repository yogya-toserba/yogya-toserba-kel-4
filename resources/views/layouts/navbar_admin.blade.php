<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Analisis Admin')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --light-bg: #ffffff;
            --light-sidebar-bg: #f8f9fc;
            --light-border: #e3e6f0;
            --light-text: #2c3e50;
            --light-text-secondary: #6c757d;
            --light-nav-hover: #f1f3f9;
            --light-card-bg: #ffffff;
            --light-shadow: rgba(0, 0, 0, 0.08);
            --dark-bg: #1a1d29;
            --dark-sidebar-bg: #252837;
            --dark-border: #3a3d4a;
            --dark-text: #e2e8f0;
            --dark-text-secondary: #94a3b8;
            --dark-nav-hover: #2d3142;
            --dark-card-bg: #2a2d3f;
            --dark-shadow: rgba(0, 0, 0, 0.3);
            --yogya-orange: #f26b37;
            --yogya-orange-dark: #e55827;
            --yogya-gradient: linear-gradient(135deg, var(--yogya-orange) 0%, var(--yogya-orange-dark) 100%);
            --sidebar-width: 260px;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8fafc;
            margin: 0;
            padding: 0;
        }

        body.dark-mode {
            background-color: var(--dark-bg) !important;
            color: var(--dark-text) !important;
        }

        body.dark-mode .main-content {
            background-color: var(--dark-bg) !important;
        }

        body.dark-mode .card {
            background: var(--dark-card-bg) !important;
            border-color: var(--dark-border) !important;
            color: var(--dark-text) !important;
        }

        /* SIDEBAR STYLES */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: var(--light-sidebar-bg);
            border-right: 2px solid var(--light-border);
            z-index: 1000;
            overflow-y: auto;
            transition: all 0.3s ease;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        body.dark-mode .sidebar {
            background: var(--dark-sidebar-bg);
            border-right-color: var(--dark-border);
            box-shadow: 2px 0 12px var(--dark-shadow);
        }

        /* MAIN CONTENT */
        .main-content {
            margin-left: calc(var(--sidebar-width) + 20px);
            min-height: 100vh;
            background: #f8fafc;
            padding: 30px 40px;
            width: calc(100% - var(--sidebar-width) - 20px);
            box-sizing: border-box;
        }

        /* SIDEBAR BRAND */
        .sidebar-brand {
            padding: 20px 18px;
            text-align: center;
            border-bottom: 2px solid var(--light-border);
            background: var(--light-card-bg);
        }

        body.dark-mode .sidebar-brand {
            border-bottom-color: var(--dark-border);
            background: var(--dark-card-bg);
        }

        .brand-logo {
            margin-bottom: 10px;
        }

        .yogya-logo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--yogya-orange);
            padding: 2px;
            background: white;
            box-shadow: 0 3px 8px rgba(242, 107, 55, 0.3);
        }

        .sidebar-brand h4 {
            font-size: 20px;
            font-weight: 700;
            margin: 0;
            color: var(--light-text);
            font-family: 'Inter', sans-serif;
        }

        body.dark-mode .sidebar-brand h4 {
            color: var(--dark-text);
        }

        .brand-highlight {
            color: var(--yogya-orange);
        }

        .brand-subtitle {
            font-size: 12px;
            color: var(--light-text-secondary);
            margin: 3px 0 0 0;
            font-weight: 500;
        }

        body.dark-mode .brand-subtitle {
            color: var(--dark-text-secondary);
        }

        /* ADMIN INFO */
        .admin-section {
            padding: 18px;
            border-bottom: 2px solid var(--light-border);
            background: var(--light-card-bg);
        }

        body.dark-mode .admin-section {
            border-bottom-color: var(--dark-border);
            background: var(--dark-card-bg);
        }

        .admin-profile {
            display: flex;
            align-items: center;
            padding: 12px;
            background: var(--light-bg);
            border-radius: 8px;
            border: 2px solid var(--light-border);
            cursor: pointer;
            transition: all 0.3s ease;
            gap: 10px;
        }

        body.dark-mode .admin-profile {
            background: var(--dark-bg);
            border-color: var(--dark-border);
        }

        .admin-profile:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 6px var(--light-shadow);
        }

        body.dark-mode .admin-profile:hover {
            box-shadow: 0 2px 6px var(--dark-shadow);
        }

        .admin-avatar {
            position: relative;
        }

        .avatar-circle {
            width: 38px;
            height: 38px;
            background: var(--yogya-gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 15px;
            box-shadow: 0 2px 6px rgba(242, 107, 55, 0.3);
        }

        .user-status {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 10px;
            height: 10px;
            background: #22c55e;
            border-radius: 50%;
            border: 2px solid white;
        }

        .admin-info h6 {
            font-size: 14px;
            font-weight: 700;
            margin: 0;
            color: var(--light-text);
            line-height: 1.2;
        }

        body.dark-mode .admin-info h6 {
            color: var(--dark-text);
        }

        .admin-info small {
            font-size: 12px;
            font-weight: 400;
            color: var(--light-text-secondary);
            margin: 2px 0 0 0;
            line-height: 1.2;
        }

        body.dark-mode .admin-info small {
            color: var(--dark-text-secondary);
        }

        /* NAVIGATION MENU */
        .sidebar-nav {
            flex: 1;
            padding: 18px 12px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: var(--light-text);
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 6px;
            transition: all 0.3s ease;
            position: relative;
            font-weight: 500;
            gap: 12px;
            font-size: 14px;
        }

        body.dark-mode .nav-link {
            color: var(--dark-text);
        }

        .nav-link:hover {
            background: var(--light-nav-hover);
            transform: translateX(2px);
            box-shadow: 0 1px 4px var(--light-shadow);
            color: var(--light-text);
            text-decoration: none;
        }

        body.dark-mode .nav-link:hover {
            background: var(--dark-nav-hover);
            box-shadow: 0 1px 4px var(--dark-shadow);
            color: var(--dark-text);
        }

        .nav-link.active {
            background: var(--yogya-gradient);
            color: white;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(242, 107, 55, 0.4);
        }

        .nav-link.active:hover {
            transform: translateX(0);
            color: white;
        }

        .nav-link i {
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
        }

        .nav-indicator {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 20px;
            background: white;
            border-radius: 2px;
        }

        /* DROPDOWN STYLES */
        .dropdown-nav {
            margin-bottom: 6px;
        }

        .dropdown-toggle-nav {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: var(--light-text);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 14px;
            cursor: pointer;
            justify-content: space-between;
            gap: 12px;
            font-weight: 500;
        }

        body.dark-mode .dropdown-toggle-nav {
            color: var(--dark-text);
        }

        .dropdown-toggle-nav:hover {
            background: var(--light-nav-hover);
            color: var(--light-text);
            text-decoration: none;
            transform: translateX(2px);
            box-shadow: 0 1px 4px var(--light-shadow);
        }

        body.dark-mode .dropdown-toggle-nav:hover {
            background: var(--dark-nav-hover);
            color: var(--dark-text);
            box-shadow: 0 1px 4px var(--dark-shadow);
        }

        .dropdown-toggle-nav.active {
            background: var(--yogya-gradient);
            color: white;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(242, 107, 55, 0.4);
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
            font-size: 11px;
            padding: 6px 12px;
            color: var(--light-text-secondary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        body.dark-mode .submenu .nav-link {
            color: var(--dark-text-secondary);
        }

        .submenu .nav-link:hover {
            background: var(--light-nav-hover);
            padding-left: 16px;
            color: var(--light-text);
        }

        body.dark-mode .submenu .nav-link:hover {
            background: var(--dark-nav-hover);
            color: var(--dark-text);
        }

        /* SIDEBAR FOOTER */
        .sidebar-footer {
            padding: 18px;
            border-top: 2px solid var(--light-border);
            background: var(--light-card-bg);
        }

        body.dark-mode .sidebar-footer {
            border-top-color: var(--dark-border);
            background: var(--dark-card-bg);
        }

        .admin-dropdown {
            position: relative;
        }

        .admin-actions {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .mode-toggle-btn {
            width: 28px;
            height: 28px;
            background: var(--yogya-gradient);
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            transition: all 0.3s ease;
            box-shadow: 0 1px 4px rgba(242, 107, 55, 0.3);
        }

        .mode-toggle-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 2px 6px rgba(242, 107, 55, 0.4);
        }

        .dropdown-arrow-footer {
            transition: transform 0.3s ease;
        }

        .dropdown-arrow-footer.rotated {
            transform: rotate(180deg);
        }

        .dropdown-menu {
            position: absolute;
            bottom: 100%;
            left: 0;
            right: 0;
            background: var(--light-card-bg);
            border: 2px solid var(--light-border);
            border-radius: 8px;
            box-shadow: 0 4px 12px var(--light-shadow);
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s ease;
            z-index: 1001;
            margin-bottom: 5px;
        }

        body.dark-mode .dropdown-menu {
            background: var(--dark-card-bg);
            border-color: var(--dark-border);
            box-shadow: 0 4px 12px var(--dark-shadow);
        }

        .dropdown-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            gap: 12px;
            min-height: 44px;
            box-sizing: border-box;
        }

        .dropdown-item:hover {
            background: var(--light-nav-hover);
        }

        body.dark-mode .dropdown-item:hover {
            background: var(--dark-nav-hover);
        }

        .dropdown-item i {
            width: 18px;
            font-size: 14px;
            color: var(--light-text-secondary);
            text-align: center;
            flex-shrink: 0;
        }

        body.dark-mode .dropdown-item i {
            color: var(--dark-text-secondary);
        }

        .dropdown-item span {
            flex: 1;
            font-size: 14px;
            font-weight: 500;
            color: var(--light-text);
            line-height: 1.4;
        }

        body.dark-mode .dropdown-item span {
            color: var(--dark-text);
        }

        .dropdown-item small {
            font-size: 12px;
            color: var(--light-text-secondary);
            line-height: 1.3;
            flex-shrink: 0;
        }

        body.dark-mode .dropdown-item small {
            color: var(--dark-text-secondary);
        }

        .dropdown-divider {
            height: 1px;
            background: var(--light-border);
            margin: 8px 0;
        }

        body.dark-mode .dropdown-divider {
            background: var(--dark-border);
        }

        .logout-item:hover {
            background: #fef2f2 !important;
        }

        body.dark-mode .logout-item:hover {
            background: #1a0f0f !important;
        }

        .sidebar-info {
            text-align: center;
            padding-top: 8px;
            border-top: 1px solid var(--light-border);
            margin-top: 10px;
        }

        body.dark-mode .sidebar-info {
            border-top-color: var(--dark-border);
        }

        .sidebar-info p {
            font-size: 10px;
            color: var(--light-text-secondary);
            margin: 2px 0;
        }

        body.dark-mode .sidebar-info p {
            color: var(--dark-text-secondary);
        }

        /* TOP HEADER */
        .top-header {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            height: 70px;
            background: var(--light-card-bg);
            border-bottom: 1px solid var(--light-border);
            z-index: 1000;
            display: flex;
            align-items: center;
            box-shadow: 0 2px 10px var(--light-shadow);
        }

        body.dark-mode .top-header {
            background: var(--dark-card-bg);
            border-bottom-color: var(--dark-border);
            box-shadow: 0 2px 10px var(--dark-shadow);
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            padding: 0 25px;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
            flex: 1;
        }

        .sidebar-toggle {
            background: none;
            border: none;
            color: var(--light-text);
            font-size: 18px;
            cursor: pointer;
            padding: 8px;
            border-radius: 6px;
            transition: background 0.3s ease;
        }

        .sidebar-toggle:hover {
            background: var(--light-nav-hover);
        }

        body.dark-mode .sidebar-toggle {
            color: var(--dark-text);
        }

        body.dark-mode .sidebar-toggle:hover {
            background: var(--dark-nav-hover);
        }

        .page-title h5 {
            color: var(--light-text);
            font-weight: 600;
            margin: 0;
        }

        body.dark-mode .page-title h5 {
            color: var(--dark-text);
        }

        .header-center {
            flex: 2;
            display: flex;
            justify-content: center;
        }

        .search-container {
            position: relative;
            width: 100%;
            max-width: 500px;
        }

        .search-input-group {
            position: relative;
            display: flex;
            align-items: center;
        }

        .search-input {
            width: 100%;
            padding: 12px 45px 12px 15px;
            border: 2px solid var(--light-border);
            border-radius: 25px;
            background: var(--light-bg);
            color: var(--light-text);
            font-size: 14px;
            transition: all 0.3s ease;
            outline: none;
        }

        .search-input:focus {
            border-color: var(--yogya-orange);
            box-shadow: 0 0 0 3px rgba(242, 107, 55, 0.1);
        }

        body.dark-mode .search-input {
            background: var(--dark-card-bg);
            border-color: var(--dark-border);
            color: var(--dark-text);
        }

        body.dark-mode .search-input:focus {
            border-color: var(--yogya-orange);
            box-shadow: 0 0 0 3px rgba(242, 107, 55, 0.2);
        }

        .search-btn {
            position: absolute;
            right: 5px;
            background: var(--yogya-gradient);
            border: none;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .search-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(242, 107, 55, 0.4);
        }

        .search-results {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: var(--light-card-bg);
            border: 1px solid var(--light-border);
            border-radius: 12px;
            max-height: 400px;
            overflow-y: auto;
            z-index: 1001;
            display: none;
            box-shadow: 0 8px 25px var(--light-shadow);
            margin-top: 5px;
        }

        body.dark-mode .search-results {
            background: var(--dark-card-bg);
            border-color: var(--dark-border);
            box-shadow: 0 8px 25px var(--dark-shadow);
        }

        .search-result-item {
            padding: 12px 15px;
            border-bottom: 1px solid var(--light-border);
            cursor: pointer;
            transition: background 0.3s ease;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .search-result-item:hover {
            background: var(--light-nav-hover);
        }

        .search-result-item:last-child {
            border-bottom: none;
        }

        body.dark-mode .search-result-item {
            border-bottom-color: var(--dark-border);
        }

        body.dark-mode .search-result-item:hover {
            background: var(--dark-nav-hover);
        }

        .search-result-icon {
            width: 30px;
            height: 30px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: white;
        }

        .search-result-content {
            flex: 1;
        }

        .search-result-title {
            font-weight: 600;
            color: var(--light-text);
            font-size: 13px;
            margin: 0;
        }

        .search-result-subtitle {
            color: var(--light-text-secondary);
            font-size: 11px;
            margin: 2px 0 0 0;
        }

        body.dark-mode .search-result-title {
            color: var(--dark-text);
        }

        body.dark-mode .search-result-subtitle {
            color: var(--dark-text-secondary);
        }

        .header-right {
            flex: 1;
            display: flex;
            justify-content: flex-end;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .action-btn {
            position: relative;
            background: none;
            border: none;
            color: var(--light-text);
            font-size: 16px;
            cursor: pointer;
            padding: 10px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .action-btn:hover {
            background: var(--light-nav-hover);
            color: var(--yogya-orange);
        }

        body.dark-mode .action-btn {
            color: var(--dark-text);
        }

        body.dark-mode .action-btn:hover {
            background: var(--dark-nav-hover);
        }

        .notification-badge {
            position: absolute;
            top: 5px;
            right: 5px;
            background: #e74c3c;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            border-radius: 25px;
            background: var(--light-nav-hover);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .admin-profile:hover {
            background: var(--yogya-orange);
            color: white;
        }

        body.dark-mode .admin-profile {
            background: var(--dark-nav-hover);
        }

        body.dark-mode .admin-profile:hover {
            background: var(--yogya-orange);
        }

        .admin-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--yogya-orange);
        }

        .admin-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--light-text);
        }

        body.dark-mode .admin-name {
            color: var(--dark-text);
        }

        .main-content {
            margin-top: 70px; /* Account for fixed header */
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .top-header {
                left: 0;
            }
            
            .header-center {
                flex: 1;
                margin: 0 15px;
            }
            
            .search-container {
                max-width: none;
            }
            
            .admin-name {
                display: none;
            }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .sidebar {
                width: 80px;
                margin-left: -280px;
                transition: margin-left 0.3s ease;
            }

            .sidebar.active {
                margin-left: 0;
            }

            .main-content {
                margin-left: 0;
            }

            .nav-text,
            .brand-text,
            .admin-info {
                display: none;
            }

            .nav-link {
                justify-content: center;
                padding: 12px 10px;
            }
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="sidebar" id="sidebar">
            <!-- Brand -->
            <div class="sidebar-brand">
                <div class="brand-logo">
                    <img src="{{ asset('image/logo_yogya.png') }}" alt="YOGYA Logo" class="yogya-logo">
                </div>
                <div class="brand-text">
                    <h4>My<span class="brand-highlight">YOGYA</span></h4>
                    <div class="brand-subtitle">Admin Panel</div>
                </div>
            </div>

            <!-- Navigation -->
            <div class="sidebar-nav">
                <a href="{{ route('admin.analisis') }}"
                    class="nav-link {{ Request::is('admin/analisis*') ? 'active' : '' }}">
                    <div class="nav-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <span class="nav-text">Analisis</span>
                    @if (Request::is('admin/analisis*'))
                        <div class="nav-indicator"></div>
                    @endif
                </a>

                <!-- Manajemen Karyawan Dropdown -->
                <div
                    class="dropdown-nav {{ Request::is('admin/data-karyawan*') || Request::is('admin/penggajian*') || Request::is('admin/absensi*') ? 'show' : '' }}">
                    <div class="dropdown-toggle-nav {{ Request::is('admin/data-karyawan*') || Request::is('admin/penggajian*') || Request::is('admin/absensi*') ? 'active' : '' }}"
                        onclick="toggleKaryawanDropdown()">
                        <span><i class="fas fa-users"></i> Manajemen Karyawan</span>
                        <i class="fas fa-chevron-down dropdown-arrow"></i>
                    </div>
                    <div
                        class="submenu {{ Request::is('admin/data-karyawan*') || Request::is('admin/penggajian*') || Request::is('admin/absensi*') ? 'show' : '' }}">
                        <a href="{{ route('admin.data-karyawan') }}"
                            class="nav-link {{ Request::is('admin/data-karyawan*') ? 'active' : '' }}">
                            <i class="fas fa-users"></i> Data Karyawan
                        </a>
                        <a href="{{ route('admin.penggajian') }}"
                            class="nav-link {{ Request::is('admin/penggajian') && !Request::is('admin/penggajian-otomatis*') ? 'active' : '' }}">
                            <i class="fas fa-money-check-alt"></i> Penggajian
                        </a>
                        <!-- <a href="{{ route('admin.penggajian-otomatis') }}"
                            class="nav-link {{ Request::is('admin/penggajian-otomatis*') ? 'active' : '' }}">
                            <i class="fas fa-robot"></i> Penggajian Otomatis
                        </a> -->
                        <a href="{{ route('admin.absensi') }}"
                            class="nav-link {{ Request::is('admin/absensi*') ? 'active' : '' }}">
                            <i class="fas fa-user-check"></i> Absensi
                        </a>
                    </div>
                </div>

                <!-- Keuangan Dropdown -->
                <div
                    class="dropdown-nav {{ Request::is('admin/laporan*') || Request::is('admin/keuangan*') ? 'show' : '' }}">
                    <div class="dropdown-toggle-nav {{ Request::is('admin/laporan*') || Request::is('admin/keuangan*') ? 'active' : '' }}"
                        onclick="toggleDropdown()">
                        <span><i class="fas fa-chart-pie"></i> Keuangan</span>
                        <i class="fas fa-chevron-down dropdown-arrow"></i>
                    </div>
                    <div
                        class="submenu {{ Request::is('admin/laporan*') || Request::is('admin/keuangan*') ? 'show' : '' }}">
                        <a href="{{ route('admin.laporan') }}"
                            class="nav-link {{ Request::is('admin/laporan') ? 'active' : '' }}">
                            <i class="fas fa-file-alt"></i> Laporan
                        </a>
                        <a href="{{ route('admin.keuangan.riwayat') }}"
                            class="nav-link {{ Request::is('admin/keuangan/riwayat*') ? 'active' : '' }}">
                            <i class="fas fa-history"></i> Riwayat Transaksi
                        </a>
                        <a href="{{ route('admin.keuangan.bukubesar') }}"
                            class="nav-link {{ Request::is('admin/keuangan/buku-besar*') ? 'active' : '' }}">
                            <i class="fas fa-book"></i> Buku Besar
                        </a>
                    </div>
                </div>

                <!-- Manajemen Pengguna Dropdown -->
                <div
                    class="dropdown-nav {{ Request::is('admin/daftar-pengguna*') || Request::is('admin/membership*') || Request::is('admin/log-aktivitas*') ? 'show' : '' }}">
                    <div class="dropdown-toggle-nav {{ Request::is('admin/daftar-pengguna*') || Request::is('admin/membership*') || Request::is('admin/log-aktivitas*') ? 'active' : '' }}"
                        onclick="togglePenggunaDropdown()">
                        <span><i class="fas fa-users-cog"></i> Manajemen Pengguna</span>
                        <i class="fas fa-chevron-down dropdown-arrow"></i>
                    </div>
                    <div
                        class="submenu {{ Request::is('admin/daftar-pengguna*') || Request::is('admin/membership*') || Request::is('admin/log-aktivitas*') ? 'show' : '' }}">
                        <a href="{{ url('/admin/daftar-pengguna') }}"
                            class="nav-link {{ Request::is('admin/daftar-pengguna*') ? 'active' : '' }}">
                            <i class="fas fa-users"></i> Daftar Pengguna
                        </a>
                        <a href="{{ url('/admin/membership') }}"
                            class="nav-link {{ Request::is('admin/membership*') ? 'active' : '' }}">
                            <i class="fas fa-id-card"></i> Membership
                        </a>
                        <a href="{{ url('/admin/log-aktivitas') }}"
                            class="nav-link {{ Request::is('admin/log-aktivitas*') ? 'active' : '' }}">
                            <i class="fas fa-chart-line"></i> Log Aktivitas
                        </a>
                    </div>
                </div>

                <!-- Manajemen Gudang Dropdown -->
                <div class="dropdown-nav {{ Request::is('admin/data-pengawai-gudang*') || Request::is('admin/lokasi-gudang*') || Request::is('admin/data-barang*') ? 'show' : '' }}">
                    <div class="dropdown-toggle-nav {{ Request::is('admin/data-pengawai-gudang*') || Request::is('admin/lokasi-gudang*') || Request::is('admin/data-barang*') ? 'active' : '' }}" onclick="toggleGudangDropdown()">
                        <span><i class="fas fa-warehouse"></i> Manajemen Gudang</span>
                        <i class="fas fa-chevron-down dropdown-arrow"></i>
                    </div>
                    <div
                        class="submenu {{ Request::is('admin/data-pengawai-gudang*') || Request::is('admin/lokasi-gudang*') || Request::is('admin/data-barang*') ? 'show' : '' }}">
                        <a href="{{ route('admin.data-pengawai-gudang') }}"
                            class="nav-link {{ Request::is('admin/data-pengawai-gudang*') ? 'active' : '' }}">
                            <i class="fas fa-users-cog"></i> Data Pengawai Gudang
                        </a>
                        <a href="{{ route('admin.lokasi-gudang') }}"
                            class="nav-link {{ Request::is('admin/lokasi-gudang*') ? 'active' : '' }}">
                            <i class="fas fa-map-marker-alt"></i> Lokasi Gudang
                        </a>
                        <a href="{{ route('admin.data-barang') }}"
                            class="nav-link {{ Request::is('admin/data-barang*') ? 'active' : '' }}">
                            <i class="fas fa-boxes"></i> Data Barang
                        </a>
                    </div>
                </div>

                <a href="{{ route('admin.pengaturan') }}"
                    class="nav-link {{ Request::is('admin/pengaturan*') ? 'active' : '' }}">
                    <div class="nav-icon">
                        <i class="fas fa-cog"></i>
                    </div>
                    <span class="nav-text">Pengaturan</span>
                    @if (Request::is('admin/pengaturan*'))
                        <div class="nav-indicator"></div>
                    @endif
                </a>
            </div>

            <!-- Footer -->
            <div class="sidebar-footer">
                <div class="admin-dropdown">
                    <div class="admin-profile" onclick="toggleAdminDropdown()">
                        <div class="admin-avatar">
                            <div class="avatar-circle">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="user-status online"></div>
                        </div>
                        <div class="admin-info">
                            <h6 class="admin-name">Admin</h6>
                            <small class="admin-role">Administrator</small>
                        </div>
                        <div class="admin-actions">
                            <!-- Mode Toggle Button -->
                            <button class="mode-toggle-btn" onclick="toggleDarkMode(event)" id="mode-toggle"
                                title="Toggle Dark Mode">
                                <i class="fas fa-moon" id="mode-icon"></i>
                            </button>
                            <div class="dropdown-arrow-footer">
                                <i class="fas fa-chevron-down" id="dropdown-icon"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Dropdown Menu -->
                    <div class="dropdown-menu" id="admin-dropdown">
                        <div class="dropdown-item"
                            onclick="window.location.href='{{ route('admin.profile') ?? '#' }}'">
                            <i class="fas fa-user-edit"></i>
                            <span>Edit Profile</span>
                            <small>Ubah profil</small>
                        </div>
                        <div class="dropdown-item" onclick="window.location.href='{{ route('admin.pengaturan') }}'">
                            <i class="fas fa-cog"></i>
                            <span>Pengaturan</span>
                            <small>Setting akun</small>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="dropdown-item logout-item" onclick="handleLogout()">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                            <small>Keluar sistem</small>
                        </div>
                    </div>
                </div>

                <!-- Footer Info -->
                <div class="sidebar-info">
                    <p class="app-version">
                        <i class="fas fa-code-branch"></i>
                        v1.0.0
                    </p>
                    <p class="device-info">
                        <i class="fas fa-desktop"></i>
                        <span id="device-info">Loading...</span>
                    </p>
                    <p class="login-time">
                        <i class="fas fa-clock"></i>
                        <span id="current-datetime">{{ date('d/m/Y H:i:s') }}</span>
                    </p>
                </div>
            </div>
        </nav>

        <!-- Top Header with Search -->
        <div class="top-header">
            <div class="header-content">
                <div class="header-left">
                    <button class="sidebar-toggle d-lg-none" onclick="toggleSidebar()">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="page-title">
                        <h5 class="mb-0">@yield('page-title', 'Dashboard')</h5>
                        <small class="text-muted">@yield('page-subtitle', 'Selamat datang di panel admin')</small>
                    </div>
                </div>
                
                <div class="header-center">
                    <div class="search-container">
                        <form class="search-form" id="globalSearchForm">
                            <div class="search-input-group">
                                <input type="text" 
                                       class="search-input" 
                                       id="globalSearch" 
                                       placeholder="Cari produk, pelanggan, transaksi..."
                                       autocomplete="off">
                                <button type="submit" class="search-btn">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <div class="search-results" id="searchResults"></div>
                        </form>
                    </div>
                </div>
                
                <div class="header-right">
                    <div class="header-actions">
                        <button class="action-btn notification-btn" title="Notifikasi">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge">3</span>
                        </button>
                        <button class="action-btn theme-toggle" onclick="toggleTheme()" title="Toggle Dark Mode">
                            <i class="fas fa-moon" id="theme-icon"></i>
                        </button>
                        <div class="admin-profile">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::guard('admin')->user()->username ?? 'Admin') }}&background=f26b37&color=fff&size=30" alt="Admin" class="admin-avatar">
                            <span class="admin-name">{{ Auth::guard('admin')->user()->username ?? 'Admin' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function closeAllDropdowns() {
            const allDropdowns = document.querySelectorAll('.dropdown-nav');
            allDropdowns.forEach(dropdown => {
                const submenu = dropdown.querySelector('.submenu');
                const arrow = dropdown.querySelector('.dropdown-arrow');

                dropdown.classList.remove('show');
                submenu.classList.remove('show');
                arrow.style.transform = 'rotate(0deg)';
            });
        }

        function toggleDropdown() {
            // Close all dropdowns first
            const allDropdowns = document.querySelectorAll('.dropdown-nav');
            const keuanganDropdown = allDropdowns[1]; // Second dropdown (Keuangan)
            const isCurrentlyOpen = keuanganDropdown.classList.contains('show');

            closeAllDropdowns();

            // If it wasn't open, open the Keuangan dropdown
            if (!isCurrentlyOpen) {
                const submenu = keuanganDropdown.querySelector('.submenu');
                const arrow = keuanganDropdown.querySelector('.dropdown-arrow');

                keuanganDropdown.classList.add('show');
                submenu.classList.add('show');
                arrow.style.transform = 'rotate(180deg)';
            }
        }

        function toggleKaryawanDropdown() {
            // Close all dropdowns first
            const allDropdowns = document.querySelectorAll('.dropdown-nav');
            const karyawanDropdown = allDropdowns[0]; // First dropdown (Manajemen Karyawan)
            const isCurrentlyOpen = karyawanDropdown.classList.contains('show');

            closeAllDropdowns();

            // If it wasn't open, open the Karyawan dropdown
            if (!isCurrentlyOpen) {
                const submenu = karyawanDropdown.querySelector('.submenu');
                const arrow = karyawanDropdown.querySelector('.dropdown-arrow');

                karyawanDropdown.classList.add('show');
                submenu.classList.add('show');
                arrow.style.transform = 'rotate(180deg)';
            }
        }

        function togglePenggunaDropdown() {
            // Close all dropdowns first
            const allDropdowns = document.querySelectorAll('.dropdown-nav');
            const penggunaDropdown = allDropdowns[2]; // Third dropdown (Manajemen Pengguna)
            const isCurrentlyOpen = penggunaDropdown.classList.contains('show');

            closeAllDropdowns();

            // If it wasn't open, open the Pengguna dropdown
            if (!isCurrentlyOpen) {
                const submenu = penggunaDropdown.querySelector('.submenu');
                const arrow = penggunaDropdown.querySelector('.dropdown-arrow');

                penggunaDropdown.classList.add('show');
                submenu.classList.add('show');
                arrow.style.transform = 'rotate(180deg)';
            }
        }

        function toggleGudangDropdown() {
            // Close all dropdowns first
            const allDropdowns = document.querySelectorAll('.dropdown-nav');
            const gudangDropdown = allDropdowns[3]; // Fourth dropdown (Manajemen Gudang)
            const isCurrentlyOpen = gudangDropdown.classList.contains('show');

            closeAllDropdowns();

            // If it wasn't open, open the Gudang dropdown
            if (!isCurrentlyOpen) {
                const submenu = gudangDropdown.querySelector('.submenu');
                const arrow = gudangDropdown.querySelector('.dropdown-arrow');

                gudangDropdown.classList.add('show');
                submenu.classList.add('show');
                arrow.style.transform = 'rotate(180deg)';
            }
        }

        function toggleDarkMode(event) {
            if (event) {
                event.stopPropagation();
            }

            const body = document.body;
            const modeIcon = document.getElementById('mode-icon');

            body.classList.toggle('dark-mode');

            if (body.classList.contains('dark-mode')) {
                modeIcon.className = 'fas fa-sun';
                localStorage.setItem('theme', 'dark');
            } else {
                modeIcon.className = 'fas fa-moon';
                localStorage.setItem('theme', 'light');
            }
        }

        function toggleAdminDropdown() {
            const dropdown = document.getElementById('admin-dropdown');
            const arrow = document.getElementById('dropdown-icon');

            dropdown.classList.toggle('show');
            arrow.parentElement.classList.toggle('rotated');
        }

        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('admin-dropdown');
            const adminProfile = document.querySelector('.admin-profile');

            if (dropdown && adminProfile && !adminProfile.contains(event.target)) {
                dropdown.classList.remove('show');
                document.getElementById('dropdown-icon').parentElement.classList.remove('rotated');
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = localStorage.getItem('theme');
            const body = document.body;
            const modeIcon = document.getElementById('mode-icon');

            if (savedTheme === 'dark') {
                body.classList.add('dark-mode');
                modeIcon.className = 'fas fa-sun';
            }

            updateTime();
            setInterval(updateTime, 1000);
        });

        function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            });

            const timeElement = document.getElementById('current-time');
            if (timeElement) {
                timeElement.textContent = timeString;
            }
        }

        // Update real-time data
        function updateRealTimeData() {
            // Update current date and time
            const now = new Date();
            const options = {
                timeZone: 'Asia/Jakarta',
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            };
            const timeString = now.toLocaleDateString('id-ID', options).replace(/\//g, '/') + ' WIB';

            const dateTimeElement = document.getElementById('current-datetime');
            if (dateTimeElement) {
                dateTimeElement.textContent = timeString;
            }
        }

        // Get device information
        function getDeviceInfo() {
            const deviceInfo = document.getElementById('device-info');
            if (deviceInfo) {
                const userAgent = navigator.userAgent;
                let deviceType = 'Desktop';
                let browser = 'Unknown';

                // Detect device type
                if (/Mobile|Android|iPhone|iPad/.test(userAgent)) {
                    deviceType = 'Mobile';
                } else if (/Tablet|iPad/.test(userAgent)) {
                    deviceType = 'Tablet';
                }

                // Detect browser
                if (userAgent.includes('Chrome')) {
                    browser = 'Chrome';
                } else if (userAgent.includes('Firefox')) {
                    browser = 'Firefox';
                } else if (userAgent.includes('Safari')) {
                    browser = 'Safari';
                } else if (userAgent.includes('Edge')) {
                    browser = 'Edge';
                }

                deviceInfo.textContent = `${deviceType} - ${browser}`;
            }
        }

        // Initialize real-time updates
        document.addEventListener('DOMContentLoaded', function() {
            getDeviceInfo();
            updateRealTimeData();

            // Update time every second
            setInterval(updateRealTimeData, 1000);
        });

        function handleLogout() {
            const dropdown = document.getElementById('admin-dropdown');
            dropdown.classList.remove('show');
            document.getElementById('dropdown-icon').parentElement.classList.remove('rotated');

            if (confirm('Apakah Anda yakin ingin logout dari sistem?')) {
                window.location.href = '/logout';
            }
        }

        // Search Functionality
        class GlobalSearch {
            constructor() {
                this.searchInput = document.getElementById('globalSearch');
                this.searchResults = document.getElementById('searchResults');
                this.searchForm = document.getElementById('globalSearchForm');
                this.debounceTimer = null;
                this.init();
            }

            init() {
                if (!this.searchInput) return;

                this.searchInput.addEventListener('input', (e) => {
                    this.debounceSearch(e.target.value);
                });

                this.searchInput.addEventListener('focus', () => {
                    if (this.searchInput.value.trim()) {
                        this.showResults();
                    }
                });

                // Close results when clicking outside
                document.addEventListener('click', (e) => {
                    if (!e.target.closest('.search-container')) {
                        this.hideResults();
                    }
                });

                // Handle form submission
                this.searchForm.addEventListener('submit', (e) => {
                    e.preventDefault();
                    this.performDetailedSearch(this.searchInput.value);
                });
            }

            debounceSearch(query) {
                clearTimeout(this.debounceTimer);
                this.debounceTimer = setTimeout(() => {
                    this.performSearch(query);
                }, 300);
            }

            async performSearch(query) {
                if (!query.trim()) {
                    this.hideResults();
                    return;
                }

                try {
                    // Show loading state
                    this.showLoading();

                    const response = await fetch('/admin/search', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ query: query })
                    });

                    const data = await response.json();
                    this.displayResults(data);
                } catch (error) {
                    console.error('Search error:', error);
                    this.showError();
                }
            }

            showLoading() {
                this.searchResults.innerHTML = `
                    <div class="search-result-item">
                        <div class="search-result-icon" style="background: #6c757d;">
                            <i class="fas fa-spinner fa-spin"></i>
                        </div>
                        <div class="search-result-content">
                            <div class="search-result-title">Mencari...</div>
                            <div class="search-result-subtitle">Sedang mencari data yang sesuai</div>
                        </div>
                    </div>
                `;
                this.showResults();
            }

            showError() {
                this.searchResults.innerHTML = `
                    <div class="search-result-item">
                        <div class="search-result-icon" style="background: #e74c3c;">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="search-result-content">
                            <div class="search-result-title">Error pencarian</div>
                            <div class="search-result-subtitle">Terjadi kesalahan saat mencari data</div>
                        </div>
                    </div>
                `;
                this.showResults();
            }

            displayResults(data) {
                if (!data.results || data.results.length === 0) {
                    this.searchResults.innerHTML = `
                        <div class="search-result-item">
                            <div class="search-result-icon" style="background: #6c757d;">
                                <i class="fas fa-search"></i>
                            </div>
                            <div class="search-result-content">
                                <div class="search-result-title">Tidak ada hasil</div>
                                <div class="search-result-subtitle">Coba gunakan kata kunci yang berbeda</div>
                            </div>
                        </div>
                    `;
                } else {
                    let html = '';
                    data.results.forEach(item => {
                        html += this.createResultItem(item);
                    });
                    
                    if (data.hasMore) {
                        html += `
                            <div class="search-result-item" onclick="globalSearch.performDetailedSearch('${this.searchInput.value}')">
                                <div class="search-result-icon" style="background: var(--yogya-orange);">
                                    <i class="fas fa-ellipsis-h"></i>
                                </div>
                                <div class="search-result-content">
                                    <div class="search-result-title">Lihat semua hasil</div>
                                    <div class="search-result-subtitle">Klik untuk melihat hasil pencarian lengkap</div>
                                </div>
                            </div>
                        `;
                    }
                    
                    this.searchResults.innerHTML = html;
                }
                this.showResults();
            }

            createResultItem(item) {
                const iconColor = this.getIconColor(item.type);
                const icon = this.getIcon(item.type);
                
                return `
                    <div class="search-result-item" onclick="globalSearch.navigateToResult('${item.url}')">
                        <div class="search-result-icon" style="background: ${iconColor};">
                            <i class="fas fa-${icon}"></i>
                        </div>
                        <div class="search-result-content">
                            <div class="search-result-title">${item.title}</div>
                            <div class="search-result-subtitle">${item.subtitle}</div>
                        </div>
                    </div>
                `;
            }

            getIconColor(type) {
                const colors = {
                    'produk': '#28a745',
                    'pelanggan': '#007bff',
                    'transaksi': '#ffc107',
                    'karyawan': '#17a2b8',
                    'kategori': '#6f42c1'
                };
                return colors[type] || '#6c757d';
            }

            getIcon(type) {
                const icons = {
                    'produk': 'box',
                    'pelanggan': 'user',
                    'transaksi': 'receipt',
                    'karyawan': 'user-tie',
                    'kategori': 'tags'
                };
                return icons[type] || 'search';
            }

            navigateToResult(url) {
                window.location.href = url;
            }

            performDetailedSearch(query) {
                // Navigate to a dedicated search results page
                window.location.href = `/admin/search-results?q=${encodeURIComponent(query)}`;
            }

            showResults() {
                this.searchResults.style.display = 'block';
            }

            hideResults() {
                this.searchResults.style.display = 'none';
            }
        }

        // Theme toggle functionality
        function toggleTheme() {
            const body = document.body;
            const themeIcon = document.getElementById('theme-icon');
            
            body.classList.toggle('dark-mode');
            
            if (body.classList.contains('dark-mode')) {
                themeIcon.className = 'fas fa-sun';
                localStorage.setItem('theme', 'dark');
            } else {
                themeIcon.className = 'fas fa-moon';
                localStorage.setItem('theme', 'light');
            }
        }

        // Initialize theme from localStorage
        function initTheme() {
            const savedTheme = localStorage.getItem('theme');
            const themeIcon = document.getElementById('theme-icon');
            
            if (savedTheme === 'dark') {
                document.body.classList.add('dark-mode');
                if (themeIcon) themeIcon.className = 'fas fa-sun';
            }
        }

        // Sidebar toggle for mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }

        // Initialize everything when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize existing functionality
            getDeviceInfo();
            updateRealTimeData();
            initTheme();
            
            // Initialize search
            window.globalSearch = new GlobalSearch();
            
            // Update time every second
            setInterval(updateRealTimeData, 1000);
        });
    </script>
    @stack('scripts')
</body>

</html>
