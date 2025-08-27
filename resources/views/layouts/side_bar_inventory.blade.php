<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Inventory Dashboard</title>
    <link href="{{ asset('css/gudang/inventory.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex">
        {{-- Sidebar --}}
        <div class="sidebar">
            <div class="sidebar-header">
                <h4>My<span class="fw-bold">YOGYA</span></h4>
            </div>
            <div class="sidebar-menu">
                <a href="#" class="{{ request()->routeIs('gudang.inventori.index') ? 'active' : '' }}">
                    <i class="fas fa-box me-2"></i> Inventori
                </a>
                <a href="#" class="{{ request()->routeIs('gudang.inventori.create') ? 'active' : '' }}">
                    <i class="fas fa-plus me-2"></i> Tambah Produk
                </a>
                <a href="#"><i class="fas fa-chart-line me-2"></i> Laporan</a>
                <a href="#"><i class="fas fa-cog me-2"></i> Pengaturan</a>
            </div>
        </div>

        {{-- Content --}}
        <div class="content">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>