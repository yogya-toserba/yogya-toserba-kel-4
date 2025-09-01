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
            font-size: 13px;
            padding: 8px 15px;
            color: var(--light-text-secondary);
        }

        body.dark-mode .submenu .nav-link {
            color: var(--dark-text-secondary);
        }

        .submenu .nav-link:hover {
            background: var(--light-nav-hover);
            padding-left: 20px;
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
            
            .nav-text, .brand-text, .admin-info {
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
                <a href="{{ route('admin.analisis') }}" class="nav-link {{ Request::is('admin/analisis*') ? 'active' : '' }}">
                    <div class="nav-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <span class="nav-text">Analisis</span>
                    @if(Request::is('admin/analisis*'))
                        <div class="nav-indicator"></div>
                    @endif
                </a>

                <a href="{{ route('admin.data-karyawan') }}" class="nav-link {{ Request::is('admin/data-karyawan*') ? 'active' : '' }}">
                    <div class="nav-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <span class="nav-text">Data Karyawan</span>
                    @if(Request::is('admin/data-karyawan*'))
                        <div class="nav-indicator"></div>
                    @endif
                </a>

                <a href="{{ route('admin.penggajian') }}" class="nav-link {{ Request::is('admin/penggajian*') ? 'active' : '' }}">
                    <div class="nav-icon">
                        <i class="fas fa-money-check-alt"></i>
                    </div>
                    <span class="nav-text">Penggajian</span>
                    @if(Request::is('admin/penggajian*'))
                        <div class="nav-indicator"></div>
                    @endif
                </a>

                <a href="{{ route('admin.absensi') }}" class="nav-link {{ Request::is('admin/absensi*') ? 'active' : '' }}">
                    <div class="nav-icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <span class="nav-text">Absensi</span>
                    @if(Request::is('admin/absensi*'))
                        <div class="nav-indicator"></div>
                    @endif
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
                    <div class="nav-icon">
                        <i class="fas fa-cog"></i>
                    </div>
                    <span class="nav-text">Pengaturan</span>
                    @if(Request::is('admin/pengaturan*'))
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
                            <button class="mode-toggle-btn" onclick="toggleDarkMode(event)" id="mode-toggle" title="Toggle Dark Mode">
                                <i class="fas fa-moon" id="mode-icon"></i>
                            </button>
                            <div class="dropdown-arrow-footer">
                                <i class="fas fa-chevron-down" id="dropdown-icon"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Dropdown Menu -->
                    <div class="dropdown-menu" id="admin-dropdown">
                        <div class="dropdown-item" onclick="window.location.href='{{ route('admin.profile') ?? '#' }}'">
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
                        v2.1.3
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
    </script>
    @stack('scripts')
</body>
</html>
