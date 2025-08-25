<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyYOGYA - Sistem Keuangan & Akuntansi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
        }

        /* Sidebar tetap */
        .sidebar {
            background: linear-gradient(180deg, #d7263d, #f46036);
            height: 100vh;
            color: white;
            padding-top: 1rem;
            position: fixed;
            top: 0;
            left: 0;
            width: 220px;
            overflow-y: auto;
        }

        .sidebar h4 {
            font-weight: bold;
            padding-left: 1rem;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 0.8rem 1rem;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .sidebar a:hover {
            background-color: rgba(255,255,255,0.15);
            transform: translateX(1px);
        }

        .sidebar a.active {
            background-color: rgba(255,255,255,0.3);
            font-weight: bold;
            transform: translateX(1px);
        }

        /* Navbar tetap */
        .navbar {
            background-color: white;
            border-bottom: 1px solid #ddd;
            position: fixed;
            top: 0;
            left: 220px; /* sesuai lebar sidebar */
            right: 0;
            height: 60px;
            z-index: 1000;
            display: flex;
            align-items: center;
        }

        /* Konten */
        .content {
            margin-left: 240px; /* sesuai lebar sidebar */
            margin-right: -240px;
            padding: 2rem;
            padding-top: 80px; /* supaya tidak ketutup navbar */
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.5s ease-out forwards;
        }

        /* Animasi fade in */
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* KPI Card */
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
            <h4 class="px-3 mb-4">MyYOGYA</h4>
            <a href="{{ route('keuangan.dashboard') }}" class="{{ request()->routeIs('keuangan.dashboard') ? 'active' : '' }}">
                Dashboard
            </a>
            <a href="{{ route('keuangan.riwayat') }}" class="{{ request()->routeIs('keuangan.riwayat') ? 'active' : '' }}">
                Riwayat Transaksi
            </a>
            <a href="{{ route('keuangan.bukubesar') }}" class="{{ request()->routeIs('keuangan.bukubesar') ? 'active' : '' }}">
                Buku Besar
            </a>
            <a href="{{ route('keuangan.laporan') }}" class="{{ request()->routeIs('keuangan.laporan') ? 'active' : '' }}">
                Laporan
            </a>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 p-0">
            <!-- Navbar -->
            <nav class="navbar px-4">
                <div class="d-flex align-items-center ms-auto">
                    <span class="me-3">Halo, {{ auth()->user()->name ?? 'Admin' }}</span>
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
