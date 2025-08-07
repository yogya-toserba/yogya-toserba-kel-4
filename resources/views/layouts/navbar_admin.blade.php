
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
        #sidebar {
            min-height: 100vh;
            width: 250px;
            transition: all 0.3s;
            background: #343a40;
            color: #fff;
        }
        .content {
            width: calc(100% - 250px);
            min-height: 100vh;
        }
        .sidebar-link {
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
        }
        .sidebar-link:hover {
            background: #495057;
            color: #fff;
        }
        .sidebar-link.active {
            background: #0d6efd;
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
            <nav class="navbar navbar-expand-lg  shadow-sm" style="background-color: #ffffffff;">
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
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Settings</a></li>
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