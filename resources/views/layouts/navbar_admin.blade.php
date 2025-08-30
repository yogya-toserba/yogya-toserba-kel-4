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
            --admin-bg: #0f172a;
            /* slate-900 */
            --admin-bg-soft: #111827;
            /* gray-900 */
            --admin-surface: #111827;
            /* gray-900 */
            --admin-surface-2: #1f2937;
            /* gray-800 */
            --admin-text: #e5e7eb;
            /* gray-200 */
            --admin-text-dim: #9ca3af;
            /* gray-400 */
            --admin-primary: #22c55e;
            /* emerald-500 */
            --admin-primary-600: #16a34a;
            /* emerald-600 */
            --admin-hover: #374151;
            /* gray-700 */
        }

        #sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            transition: all 0.3s;
            background: linear-gradient(180deg, var(--admin-bg) 0%, var(--admin-surface) 100%);
            color: var(--admin-text);
            z-index: 1000;
            overflow-y: auto;
        }

        .content {
            margin-left: 250px;
            width: calc(100% - 250px);
            min-height: 100vh;
            background: #f8fafc;
            /* slate-50 */
        }

        .sidebar-link {
            color: var(--admin-text);
            text-decoration: none;
            padding: 12px 16px;
            display: block;
            border-radius: 10px;
            margin: 4px 8px;
            position: relative;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-left: 3px solid transparent;
        }

        .sidebar-link:hover {
            background: var(--admin-hover);
            color: var(--admin-text);
            transform: translateX(3px);
            border-left-color: rgba(255, 107, 53, 0.5);
        }

        .sidebar-link.active {
            background: linear-gradient(135deg, #ff6b35, #f7931e);
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
            transform: translateX(5px);
            border-left: 4px solid #ff6b35;
            position: relative;
            overflow: hidden;
            animation: activeMenuPulse 3s infinite;
        }

        @keyframes activeMenuPulse {
            0%, 100% {
                box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
            }
            50% {
                box-shadow: 0 4px 20px rgba(255, 107, 53, 0.5);
            }
        }

        .sidebar-link.active::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.2), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar-link.active:hover::before {
            opacity: 1;
        }

        .sidebar-link.active:hover {
            background: linear-gradient(135deg, #f7931e, #ff6b35);
            color: #ffffff;
            box-shadow: 0 6px 20px rgba(255, 107, 53, 0.4);
            animation: none;
        }

        .sidebar-link i {
            transition: all 0.3s ease;
            width: 20px;
            text-align: center;
        }

        .sidebar-link.active i {
            transform: scale(1.1);
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
        }

        .sidebar-link:hover i {
            transform: scale(1.05);
            color: #ff6b35;
        }

        .dropdown-toggle::after {
            display: none;
        }

        .sidebar-link .fa-chevron-down {
            position: absolute;
            top: 18px;
            right: 17px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 0.8rem;
            color: #9ca3af;
        }

        .sidebar-link .keuangan-arrow {
            position: absolute;
            top: 18px;
            right: 17px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 0.8rem;
            color: #9ca3af;
        }

        .sidebar-link[aria-expanded="true"] .fa-chevron-down,
        .sidebar-link[aria-expanded="true"] .keuangan-arrow {
            transform: rotate(180deg);
            color: #ff6b35;
        }

        .sidebar-link.active .fa-chevron-down,
        .sidebar-link.active .keuangan-arrow {
            color: #ffffff;
        }

        /* Fix dropdown toggle */
        .dropdown-toggle::after {
            display: none !important;
        }

        #keuanganSubmenu .sidebar-link {
            padding: 10px 18px;
            font-size: 0.9rem;
            margin: 2px 0;
            transition: all 0.3s ease;
        }

        #keuanganSubmenu .sidebar-link:hover {
            background: rgba(255, 107, 53, 0.15);
            padding-left: 24px;
            transition: all 0.3s ease;
            border-radius: 8px;
        }

        #keuanganSubmenu .sidebar-link.active {
            background: linear-gradient(135deg, #ff6b35, #f7931e);
            color: #ffffff;
            box-shadow: 0 2px 8px rgba(255, 107, 53, 0.3);
            border-radius: 8px;
        }

        #keuanganSubmenu .sidebar-link.active i {
            color: #ffffff;
            text-shadow: 0 0 8px rgba(255, 255, 255, 0.3);
        }

        .collapse {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        #keuanganSubmenu {
            background: rgba(15, 23, 42, 0.5);
            border-radius: 8px;
            margin: 8px 16px;
            padding: 8px 0;
            border: 1px solid rgba(255, 107, 53, 0.1);
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
                transition: margin-left 0.3s ease;
            }

            #sidebar.active {
                margin-left: 0;
                box-shadow: 5px 0 15px rgba(0, 0, 0, 0.3);
            }

            .content {
                margin-left: 0;
                width: 100%;
                transition: margin-left 0.3s ease;
            }

            .content.sidebar-open {
                margin-left: 250px;
            }

            /* Overlay for mobile */
            #sidebar.active::after {
                content: '';
                position: fixed;
                top: 0;
                left: 250px;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: -1;
            }
        }

        /* Smooth scrollbar for sidebar */
        #sidebar::-webkit-scrollbar {
            width: 6px;
        }

        #sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
        }

        #sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 107, 53, 0.5);
            border-radius: 3px;
        }

        #sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 107, 53, 0.7);
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="p-4">
                <h4 class="text-white mb-3" style="background: linear-gradient(135deg, #ffffff, #ff6b35); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; font-weight: bold; text-shadow: 0 0 20px rgba(255, 107, 53, 0.3);">
                    <i class="fas fa-store me-2" style="color: #ff6b35;"></i>Yogya Admin
                </h4>
                <hr style="background: linear-gradient(90deg, #ff6b35, transparent); height: 2px; border: none; border-radius: 2px;">
                <ul class="list-unstyled">
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                            class="sidebar-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                            <i class="fas fa-home me-2"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.data-karyawan') }}"
                            class="sidebar-link {{ Request::is('admin/data-karyawan*') ? 'active' : '' }}">
                            <i class="fas fa-users me-2"></i> Data Karyawan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.penggajian') }}"
                            class="sidebar-link {{ Request::is('admin/penggajian*') ? 'active' : '' }}">
                            <i class="fas fa-money-check-alt me-2"></i> Penggajian
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.absensi') }}"
                            class="sidebar-link {{ Request::is('admin/absensi*') ? 'active' : '' }}">
                            <i class="fas fa-user-check me-2"></i> Absensi
                        </a>
                    </li>
                    
                    <!-- Keuangan Dropdown -->
                    <li class="nav-item dropdown">
                        <a href="#" class="sidebar-link dropdown-toggle {{ Request::is('admin/laporan*') || Request::is('admin/keuangan*') ? 'active' : '' }}" 
                           id="keuanganDropdown" role="button" data-bs-toggle="collapse" data-bs-target="#keuanganSubmenu" 
                           aria-expanded="{{ Request::is('admin/laporan*') || Request::is('admin/keuangan*') ? 'true' : 'false' }}">
                            <i class="fas fa-chart-pie me-2"></i> Keuangan
                            <i class="fas fa-chevron-down keuangan-arrow"></i>
                        </a>
                        <div class="collapse {{ Request::is('admin/laporan*') || Request::is('admin/keuangan*') ? 'show' : '' }}" id="keuanganSubmenu">
                            <ul class="list-unstyled ps-4">
                                <li>
                                    <a href="{{ route('admin.laporan') }}"
                                        class="sidebar-link {{ Request::is('admin/laporan') ? 'active' : '' }}">
                                        <i class="fas fa-file-alt me-2"></i> Laporan
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.keuangan.riwayat') }}"
                                        class="sidebar-link {{ Request::is('admin/keuangan/riwayat*') ? 'active' : '' }}">
                                        <i class="fas fa-history me-2"></i> Riwayat Transaksi
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.keuangan.bukubesar') }}"
                                        class="sidebar-link {{ Request::is('admin/keuangan/buku-besar*') ? 'active' : '' }}">
                                        <i class="fas fa-book me-2"></i> Buku Besar
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <li>
                        <a href="{{ route('admin.pengaturan') }}"
                            class="sidebar-link {{ Request::is('admin/pengaturan*') ? 'active' : '' }}">
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
                    <button class="btn btn-link" id="sidebarCollapse">
                        <i class="fas fa-bars"></i>
                    </button>

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
        document.getElementById('sidebarCollapse').addEventListener('click', function () {
            const sidebar = document.getElementById('sidebar');
            const content = document.querySelector('.content');
            
            sidebar.classList.toggle('active');
            
            // Add smooth transition for mobile
            if (window.innerWidth <= 768) {
                content.classList.toggle('sidebar-open');
            }
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const sidebarCollapse = document.getElementById('sidebarCollapse');
            
            if (window.innerWidth <= 768 && 
                sidebar.classList.contains('active') && 
                !sidebar.contains(event.target) && 
                !sidebarCollapse.contains(event.target)) {
                sidebar.classList.remove('active');
                document.querySelector('.content').classList.remove('sidebar-open');
            }
        });

        // Add ripple effect to sidebar links
        document.querySelectorAll('.sidebar-link').forEach(link => {
            link.addEventListener('click', function(e) {
                if (!this.classList.contains('dropdown-toggle')) {
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.cssText = `
                        width: ${size}px;
                        height: ${size}px;
                        left: ${x}px;
                        top: ${y}px;
                        position: absolute;
                        border-radius: 50%;
                        background: rgba(255, 255, 255, 0.3);
                        transform: scale(0);
                        animation: ripple-animation 0.6s linear;
                        pointer-events: none;
                    `;
                    
                    this.style.position = 'relative';
                    this.style.overflow = 'hidden';
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                }
            });
        });

        // Add CSS for ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple-animation {
                0% {
                    transform: scale(0);
                    opacity: 1;
                }
                100% {
                    transform: scale(2);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
    @stack('scripts')
</body>

</html>