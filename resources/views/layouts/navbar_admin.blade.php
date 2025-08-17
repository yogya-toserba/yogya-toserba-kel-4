
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
            --admin-bg: #0f172a; /* slate-900 */
            --admin-bg-soft: #111827; /* gray-900 */
            --admin-surface: #111827; /* gray-900 */
            --admin-surface-2: #1f2937; /* gray-800 */
            --admin-text: #e5e7eb; /* gray-200 */
            --admin-text-dim: #9ca3af; /* gray-400 */
            --admin-primary: #22c55e; /* emerald-500 */
            --admin-primary-600: #16a34a; /* emerald-600 */
            --admin-hover: #374151; /* gray-700 */
        }

        #sidebar {
            min-height: 100vh;
            width: 250px;
            transition: all 0.3s;
            background: linear-gradient(180deg, var(--admin-bg) 0%, var(--admin-surface) 100%);
            color: var(--admin-text);
        }
        .content {
            width: calc(100% - 250px);
            min-height: 100vh;
            background: #f8fafc; /* slate-50 */
        }
        .sidebar-link {
            color: var(--admin-text);
            text-decoration: none;
            padding: 10px 15px;
            display: block;
            border-radius: 8px;
            margin: 4px 8px;
        }
        .sidebar-link:hover {
            background: var(--admin-hover);
            color: var(--admin-text);
        }
        .sidebar-link.active {
            background: rgba(34, 197, 94, 0.2);
            color: var(--admin-primary);
        }
        .navbar {
            background: #ffffff !important;
        }
        @media (max-width: 768px) {
            #sidebar {
                margin-left: -250px;
            }
            #sidebar.active {
                margin-left: 0;
            }
            .content {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="p-4">
                <h4 class="text-white">Yogya Admin</h4>
                <hr class="bg-light">
                <ul class="list-unstyled">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                            <i class="fas fa-home me-2"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.penggajian') }}" class="sidebar-link {{ Request::is('admin/penggajian*') ? 'active' : '' }}">
                            <i class="fas fa-money-check-alt me-2"></i> Penggajian
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.absensi') }}" class="sidebar-link {{ Request::is('admin/absensi*') ? 'active' : '' }}">
                            <i class="fas fa-user-check me-2"></i> Absensi
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.laporan') }}" class="sidebar-link {{ Request::is('admin/laporan*') ? 'active' : '' }}">
                            <i class="fas fa-file-alt me-2"></i> Laporan
                        </a>
                    </li>
                    <li>
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
                    <button class="btn btn-link" id="sidebarCollapse">
                        <i class="fas fa-bars"></i>
                    </button>

                    <div class="ms-auto">
                        <div class="dropdown">
                            <button class="btn btn-link dropdown-toggle text-dark text-decoration-none" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle me-1"></i> Admin
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="{{ route('admin.profile') }}">Profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.pengaturan') }}">Settings</a></li>
                                <li><hr class="dropdown-divider"></li>
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
        document.getElementById('sidebarCollapse').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });
    </script>
    @stack('scripts')
</body>
</html>