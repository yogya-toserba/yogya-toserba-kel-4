<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyYOGYA - Sistem Keuangan & Akuntansi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }
        .sidebar {
            background: linear-gradient(180deg, #d7263d, #f46036);
            min-height: 100vh;
            color: white;
            padding-top: 1rem;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 0.8rem 1rem;
            border-radius: 8px;
            margin-bottom: 0.5rem;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: rgba(255,255,255,0.2);
        }
        .content {
            padding: 2rem;
        }
        .navbar {
            background-color: white;
            border-bottom: 1px solid #ddd;
        }
        .kpi-card {
            color: white;
            padding: 1rem;
            border-radius: 10px;
        }
        .kpi-green { background-color: #28a745; }
        .kpi-blue { background-color: #007bff; }
        .kpi-yellow { background-color: #ffc107; color: #333; }
        .kpi-red { background-color: #dc3545; }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        
        <!-- Sidebar -->
        <div class="col-md-2 sidebar">
            <h4 class="px-3 mb-4 fw-bold">MyYOGYA</h4>
            <a href="{{ route('dashboard') }}" class="{{ request()->is('/') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('keuangan.index') }}" class="{{ request()->is('keuangan*') ? 'active' : '' }}">Keuangan</a>
            <a href="{{ route('bukubesar.index') }}" class="{{ request()->is('buku-besar*') ? 'active' : '' }}">Buku Besar</a>
            <a href="{{ route('pajak.index') }}" class="{{ request()->is('pajak*') ? 'active' : '' }}">Pajak</a>
            <a href="{{ route('rekonsiliasi.index') }}" class="{{ request()->is('rekonsiliasi*') ? 'active' : '' }}">Rekonsiliasi Bank</a>
            <a href="{{ route('settings.index') }}" class="{{ request()->is('settings*') ? 'active' : '' }}">Pengaturan</a>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 p-0">
            <!-- Navbar -->
            <nav class="navbar px-4">
                <div class="d-flex align-items-center ms-auto">
                    <span class="me-3">Halo, {{ auth()->user()->name ?? 'User' }}</span>
                    <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" style="width:35px; height:35px;">
                        <i class="bi bi-person"></i>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
