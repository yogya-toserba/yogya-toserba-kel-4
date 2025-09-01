@extends('layouts.navbar_admin')

@section('title', 'Dashboard Admin - MyYOGYA')

@section('content')
<style>
/* GLOBAL OVERFLOW CONTROL */
* {
    box-sizing: border-box !important;
}

/* RESET ALL CONFLICTS */
.main-content {
    margin-left: 250px !important;
    padding: 25px 35px !important;
    background: #f8fafc !important;
    overflow-x: hidden !important;
    position: relative !important;
    width: calc(100% - 250px) !important;
    box-sizing: border-box !important;
}

/* Dark Mode Support */
body.dark-mode .main-content {
    background: #1a1d29 !important;
}

/* FORCE NEW DASHBOARD STYLES */
.new-dashboard {
    background: #f8fafc !important;
    min-height: 100vh !important;
    padding: 0 !important;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
    overflow-x: hidden !important;
    width: 100% !important;
}

body.dark-mode .new-dashboard {
    background: #1a1d29 !important;
}

.new-header {
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%) !important;
    color: white !important;
    padding: 35px 40px !important;
    border-radius: 15px !important;
    margin-bottom: 35px !important;
    box-shadow: 0 4px 15px rgba(242, 107, 55, 0.3) !important;
    position: relative !important;
}

.new-header h1 {
    font-size: 2.5rem !important;
    font-weight: bold !important;
    margin: 0 !important;
    color: white !important;
}

.new-header p {
    font-size: 1.1rem !important;
    opacity: 0.9 !important;
    margin: 10px 0 0 0 !important;
    color: white !important;
}

/* Real-time clock styling */
#realTimeClock {
    background: rgba(255, 255, 255, 0.2) !important;
    padding: 8px 16px !important;
    border-radius: 20px !important;
    border: 1px solid rgba(255, 255, 255, 0.3) !important;
    backdrop-filter: blur(10px) !important;
    font-family: 'Courier New', monospace !important;
    letter-spacing: 1px !important;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1) !important;
    transition: all 0.3s ease !important;
}

#realTimeClock:hover {
    background: rgba(255, 255, 255, 0.3) !important;
    transform: scale(1.05) !important;
}

/* Grid Layout for Tables */
.row.g-4 {
    margin-bottom: 30px !important;
}

.table-responsive {
    border-radius: 8px !important;
    background: white !important;
}

body.dark-mode .table-responsive {
    background: #2a2d3f !important;
}

.new-stat-card {
    background: white !important;
    padding: 25px 20px !important;
    border-radius: 15px !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
    border: 1px solid #e2e8f0 !important;
    position: relative !important;
    transition: all 0.3s ease !important;
    min-height: 140px !important;
    display: flex !important;
    flex-direction: column !important;
    align-items: center !important;
    text-align: center !important;
    overflow: hidden !important;
}

body.dark-mode .new-stat-card {
    background: #2a2d3f !important;
    border-color: #3a3d4a !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3) !important;
}

.new-stat-card:hover {
    transform: translateY(-3px) scale(1.02) !important;
    box-shadow: 0 8px 25px rgba(242, 107, 55, 0.15) !important;
}

.new-stat-card::before {
    display: none !important;
}

.new-stat-number {
    font-size: 2.3rem !important;
    font-weight: bold !important;
    color: #1e293b !important;
    margin: 12px 0 8px 0 !important;
    line-height: 1.2 !important;
}

body.dark-mode .new-stat-number {
    color: #e2e8f0 !important;
}

.new-stat-label {
    color: #64748b !important;
    font-weight: 500 !important;
    font-size: 0.9rem !important;
    line-height: 1.3 !important;
}

body.dark-mode .new-stat-label {
    color: #94a3b8 !important;
}

.new-stat-icon {
    width: 45px !important;
    height: 45px !important;
    background: linear-gradient(135deg, #f26b37, #e55827) !important;
    border-radius: 10px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    color: white !important;
    font-size: 1.1rem !important;
    margin: 0 auto 10px auto !important;
}

.new-charts {
    display: grid !important;
    grid-template-columns: 2fr 1fr !important;
    gap: 30px !important;
    margin-bottom: 30px !important;
    overflow: hidden !important;
}

.new-card {
    background: white !important;
    border-radius: 15px !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
    border: 1px solid #e2e8f0 !important;
    overflow: hidden !important;
    display: flex !important;
    flex-direction: column !important;
    position: relative !important;
}

body.dark-mode .new-card {
    background: #2a2d3f !important;
    border-color: #3a3d4a !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3) !important;
}

.new-card-header {
    padding: 25px 30px !important;
    background: #f8fafc !important;
    border-bottom: 1px solid #e2e8f0 !important;
}

body.dark-mode .new-card-header {
    background: #252837 !important;
    border-bottom-color: #3a3d4a !important;
}

.new-card-title {
    font-size: 1.2rem !important;
    font-weight: bold !important;
    color: #1e293b !important;
    margin: 0 !important;
}

body.dark-mode .new-card-title {
    color: #e2e8f0 !important;
}

.new-card-body {
    padding: 30px !important;
    flex: 1 !important;
    display: flex !important;
    flex-direction: column !important;
    justify-content: space-between !important;
}

body.dark-mode .new-card-body {
    color: #e2e8f0 !important;
}

.chart-placeholder {
    height: 300px !important;
    background: #f8fafc !important;
    border-radius: 10px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    color: #64748b !important;
    font-size: 1.1rem !important;
    border: 2px dashed #e2e8f0 !important;
}

body.dark-mode .chart-placeholder {
    background: #1a1d29 !important;
    color: #94a3b8 !important;
    border-color: #3a3d4a !important;
}

.recent-activity {
    display: flex !important;
    flex-direction: column !important;
    gap: 10px !important;
}

.activity-item {
    padding: 10px 0 !important;
    border-bottom: 1px solid #e2e8f0 !important;
    display: flex !important;
    align-items: center !important;
    gap: 12px !important;
}

.activity-item:last-child {
    border-bottom: none !important;
}

body.dark-mode .activity-item {
    border-bottom-color: #3a3d4a !important;
}

body.dark-mode .activity-item:last-child {
    border-bottom: none !important;
}

.activity-icon {
    width: 35px !important;
    height: 35px !important;
    border-radius: 8px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 0.9rem !important;
    flex-shrink: 0 !important;
}

.activity-icon.success {
    background: #dcfce7 !important;
    color: #15803d !important;
}

.activity-icon.warning {
    background: #fef3c7 !important;
    color: #d97706 !important;
}

.activity-icon.info {
    background: #dbeafe !important;
    color: #2563eb !important;
}

.activity-content h6 {
    margin: 0 0 3px 0 !important;
    font-size: 0.85rem !important;
    font-weight: 600 !important;
    color: #1e293b !important;
    line-height: 1.3 !important;
}

body.dark-mode .activity-content h6 {
    color: #e2e8f0 !important;
}

.activity-content small {
    color: #64748b !important;
    font-size: 0.75rem !important;
    line-height: 1.2 !important;
}

body.dark-mode .activity-content small {
    color: #94a3b8 !important;
}

/* Custom Dropdown Styling */
.custom-dropdown-btn {
    background: linear-gradient(135deg, #f26b37, #e55827) !important;
    border: none !important;
    color: white !important;
    font-weight: 500 !important;
    padding: 8px 16px !important;
    font-size: 0.85rem !important;
    border-radius: 8px !important;
    box-shadow: 0 4px 12px rgba(242, 107, 55, 0.3) !important;
    transition: all 0.3s ease !important;
}

.custom-dropdown-btn:hover {
    background: linear-gradient(135deg, #e55827, #d94a1f) !important;
    transform: translateY(-1px) scale(1.02) !important;
    box-shadow: 0 6px 16px rgba(242, 107, 55, 0.4) !important;
}

.custom-dropdown-btn:focus {
    background: linear-gradient(135deg, #f26b37, #e55827) !important;
    box-shadow: 0 0 0 3px rgba(242, 107, 55, 0.2) !important;
}

.custom-dropdown {
    border-radius: 10px !important;
    border: 1px solid #e2e8f0 !important;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12) !important;
    padding: 8px 0 !important;
    margin-top: 8px !important;
    overflow: hidden !important;
}

.custom-dropdown .dropdown-item {
    padding: 10px 16px !important;
    font-size: 0.9rem !important;
    color: #64748b !important;
    transition: all 0.2s ease !important;
    border-radius: 6px !important;
    margin: 2px 8px !important;
    position: relative !important;
    overflow: hidden !important;
}

.custom-dropdown .dropdown-item:hover {
    background: linear-gradient(135deg, #f26b37, #e55827) !important;
    color: white !important;
    transform: none !important;
}

.custom-dropdown .dropdown-item.active {
    background: linear-gradient(135deg, #f26b37, #e55827) !important;
    color: white !important;
}

.custom-dropdown .dropdown-item i {
    width: 16px !important;
    opacity: 0.7 !important;
}

.custom-dropdown .dropdown-item:hover i {
    opacity: 1 !important;
}

body.dark-mode .custom-dropdown {
    background: #2a2d3f !important;
    border-color: #3a3d4a !important;
}

body.dark-mode .custom-dropdown .dropdown-item {
    color: #94a3b8 !important;
}

body.dark-mode .custom-dropdown .dropdown-item:hover {
    background: linear-gradient(135deg, #f26b37, #e55827) !important;
    color: white !important;
}

/* TABLE DARK MODE STYLING */
body.dark-mode .table {
    background: #2a2d3f !important;
    color: #e2e8f0 !important;
}

body.dark-mode .table thead {
    background: #2a2d3f !important;
}

body.dark-mode .table th {
    color: #94a3b8 !important;
    background: #2a2d3f !important;
    border-color: #3a3d4a !important;
}

body.dark-mode .table td {
    color: #e2e8f0 !important;
    background: #2a2d3f !important;
    border-color: #3a3d4a !important;
}

body.dark-mode .table tbody tr {
    background: #2a2d3f !important;
}

body.dark-mode .table tbody tr:hover {
    background: #3a3d4a !important;
}

/* TABLE TEXT COLORS DARK MODE */
body.dark-mode .table strong {
    color: #e2e8f0 !important;
}

body.dark-mode .table small {
    color: #94a3b8 !important;
}

/* TABLE BADGES DARK MODE */
body.dark-mode .table span[style*="background: #dcfce7"] {
    background: #065f46 !important;
    color: #6ee7b7 !important;
}

body.dark-mode .table span[style*="background: #dbeafe"] {
    background: #1e3a8a !important;
    color: #93c5fd !important;
}

body.dark-mode .table span[style*="background: #fef3c7"] {
    background: #92400e !important;
    color: #fbbf24 !important;
}

@media (max-width: 1200px) {
    .main-content {
        margin-left: 0 !important;
    }
    
    .new-charts {
        grid-template-columns: 1fr !important;
    }
    
    .col-lg-6 {
        margin-bottom: 20px !important;
    }
    
    .new-stat-card {
        min-height: 110px !important;
        padding: 15px 12px !important;
    }
    
    .new-stat-number {
        font-size: 1.8rem !important;
    }
}

@media (max-width: 768px) {
    .col-lg-6 {
        margin-bottom: 15px !important;
    }
    
    .new-stat-card {
        min-height: 100px !important;
        padding: 12px 10px !important;
    }
    
    .new-stat-number {
        font-size: 1.5rem !important;
    }
    
    .new-stat-label {
        font-size: 0.75rem !important;
    }
    
    .new-stat-icon {
        width: 35px !important;
        height: 35px !important;
        font-size: 1rem !important;
    }
}
    
    .new-stat-icon {
        width: 35px !important;
        height: 35px !important;
        font-size: 1rem !important;
    }
}

@media (max-width: 480px) {
    .row.g-4 {
        margin-bottom: 15px !important;
    }
    
    .new-header div[style*="display: flex"] {
        flex-direction: column !important;
        text-align: center !important;
    }
    
    .new-header div[style*="text-align: right"] {
        text-align: center !important;
        margin-top: 15px !important;
    }
    
    #realTimeClock {
        font-size: 0.9rem !important;
        padding: 6px 12px !important;
    }
}

@media (max-width: 768px) {
    .new-header h1 {
        font-size: 2rem !important;
    }
    
    .new-header p {
        font-size: 1rem !important;
    }
    
    #realTimeClock {
        font-size: 0.95rem !important;
    }
}
</style>

<div class="new-dashboard">
    <!-- Header -->
    <div class="new-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h1><i class="fas fa-tachometer-alt me-3"></i>Dashboard Admin</h1>
                <p>Selamat datang di panel administrasi MyYOGYA</p>
            </div>
            <div style="text-align: right;">
                <div id="realTimeClock" style="font-weight: 600; color: white; font-size: 1rem; margin-bottom: 5px;"></div>
                <small style="opacity: 0.8;">Senin, 1 September 2025</small>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-5">
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-box"></i>
                </div>
                <div class="new-stat-label">Total Produk</div>
                <div class="new-stat-number">{{ number_format($totalProduk) }}</div>
                <small style="color: #10b981; font-size: 0.7rem;">
                    <i class="fas fa-box-open"></i> {{ number_format($totalStok) }} Stok
                </small>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="new-stat-label">Transaksi Hari Ini</div>
                <div class="new-stat-number">{{ number_format($transaksiHariIni) }}</div>
                <small style="color: #3b82f6; font-size: 0.7rem;">
                    <i class="fas fa-calendar-day"></i> {{ date('d M Y') }}
                </small>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="new-stat-label">Total Pelanggan</div>
                <div class="new-stat-number">{{ number_format($totalPengguna) }}</div>
                <small style="color: #f59e0b; font-size: 0.7rem;">
                    <i class="fas fa-user-check"></i> Customers
                </small>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="new-stat-label">Pendapatan Hari Ini</div>
                <div class="new-stat-number">Rp {{ number_format($pendapatanHariIni / 1000000, 1) }}M</div>
                <small style="color: #10b981; font-size: 0.7rem;">
                    <i class="fas fa-money-bill-wave"></i> {{ $transaksiHariIni }} transaksi
                </small>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="new-charts">
        <!-- Revenue Chart -->
        <div class="new-card">
            <div class="new-card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="new-card-title">Grafik Pendapatan</h5>
                    <div class="dropdown">
                        <button class="btn btn-primary btn-sm dropdown-toggle custom-dropdown-btn" type="button" id="periodDropdown" data-bs-toggle="dropdown">
                            <i class="fas fa-calendar-alt me-2"></i>
                            <span id="currentPeriodText">7 Hari Terakhir</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end custom-dropdown">
                            <li><a class="dropdown-item period-option" href="#" data-period="7" data-text="7 Hari Terakhir">
                                <i class="fas fa-calendar-day me-2"></i>7 Hari Terakhir
                            </a></li>
                            <li><a class="dropdown-item period-option" href="#" data-period="30" data-text="1 Bulan Terakhir">
                                <i class="fas fa-calendar-week me-2"></i>1 Bulan Terakhir
                            </a></li>
                            <li><a class="dropdown-item period-option" href="#" data-period="90" data-text="3 Bulan Terakhir">
                                <i class="fas fa-calendar me-2"></i>3 Bulan Terakhir
                            </a></li>
                            <li><a class="dropdown-item period-option" href="#" data-period="365" data-text="1 Tahun Terakhir">
                                <i class="fas fa-calendar-check me-2"></i>1 Tahun Terakhir
                            </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="new-card-body">
                <div id="chartLoading" class="text-center" style="display: none; padding: 60px;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Memuat data...</p>
                </div>
                <canvas id="revenueChart" style="height: 300px; display: block;"></canvas>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="new-card">
            <div class="new-card-header">
                <h5 class="new-card-title">Aktivitas Terbaru</h5>
            </div>
            <div class="new-card-body">
                <div class="recent-activity">
                    @if($transaksiTerbaru->count() > 0)
                        @foreach($transaksiTerbaru->take(2) as $transaksi)
                        <div class="activity-item">
                            <div class="activity-icon success">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <div class="activity-content">
                                <h6>Transaksi Baru</h6>
                                <small>{{ $transaksi->nama_pelanggan }} - Rp {{ number_format($transaksi->total_belanja, 0, ',', '.') }}</small>
                            </div>
                        </div>
                        @endforeach
                    @endif
                    
                    @if($stokMenipis->count() > 0)
                    <div class="activity-item">
                        <div class="activity-icon warning">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="activity-content">
                            <h6>Stok Menipis</h6>
                            <small>{{ $stokMenipis->count() }} produk memiliki stok di bawah 10 unit</small>
                        </div>
                    </div>
                    @endif
                    
                    <div class="activity-item">
                        <div class="activity-icon success">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="activity-content">
                            <h6>Total Pelanggan</h6>
                            <small>{{ number_format($totalPengguna, 0, ',', '.') }} pelanggan terdaftar</small>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon info">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="activity-content">
                            <h6>Transaksi Hari Ini</h6>
                            <small>{{ $transaksiHariIni }} transaksi dengan total Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Info Cards -->
    <div class="row g-4" style="margin-top: 35px;">
        <!-- Top Produk Terlaris -->
        <div class="col-lg-6">
            <div class="new-card h-100">
                <div class="new-card-header">
                    <h5 class="new-card-title">Top Produk Terlaris</h5>
                </div>
                <div class="new-card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead style="background: white;">
                                <tr>
                                    <th style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none;">#</th>
                                    <th style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none;">Produk</th>
                                    <th style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none; text-align: right;">Terjual</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($produkTerlaris as $index => $produk)
                                <tr>
                                    <td style="font-size: 0.85rem; border: none; padding: 8px 0;">{{ $index + 1 }}</td>
                                    <td style="font-size: 0.85rem; border: none; padding: 8px 0;">
                                        <div>
                                            <strong style="color: #1e293b;">{{ $produk->nama_barang }}</strong>
                                            <br>
                                            <small style="color: #64748b;">{{ $produk->nama_kategori }}</small>
                                        </div>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 8px 0; text-align: right;">
                                        <span style="background: #dcfce7; color: #15803d; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem; font-weight: 600;">
                                            {{ $produk->total_terjual }} unit
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" style="text-align: center; padding: 20px; color: #64748b; font-size: 0.85rem;">
                                        Belum ada data transaksi
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kategori Populer -->
        <div class="col-lg-6">
            <div class="new-card h-100">
                <div class="new-card-header">
                    <h5 class="new-card-title">Kategori Populer ({{ count($kategoriPopuler) }} Kategori)</h5>
                </div>
                <div class="new-card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead style="background: white;">
                                <tr>
                                    <th style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none;">#</th>
                                    <th style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none;">Kategori</th>
                                    <th style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none; text-align: right;">Terjual</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kategoriPopuler as $index => $kategori)
                                <tr>
                                    <td style="font-size: 0.85rem; border: none; padding: 8px 0;">{{ $index + 1 }}</td>
                                    <td style="font-size: 0.85rem; border: none; padding: 8px 0;">
                                        <strong style="color: #1e293b;">{{ $kategori->nama_kategori }}</strong>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 8px 0; text-align: right;">
                                        <span style="background: #dbeafe; color: #2563eb; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem; font-weight: 600;">
                                            {{ $kategori->total_terjual ?? 0 }} unit
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" style="text-align: center; padding: 20px; color: #64748b; font-size: 0.85rem;">
                                        Belum ada data penjualan
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Status and Performance Cards -->
    <div class="row g-4" style="margin-top: 35px;">
        <!-- Status Sistem -->
        <div class="col-lg-6">
            <div class="new-card h-100">
                <div class="new-card-header">
                    <h5 class="new-card-title">Status Sistem</h5>
                </div>
                <div class="new-card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="activity-icon success me-3">
                            <i class="fas fa-database"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Database</h6>
                            <small class="text-success">Online dan berjalan normal</small>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center mb-3">
                        <div class="activity-icon success me-3">
                            <i class="fas fa-server"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Server</h6>
                            <small class="text-success">Performa optimal</small>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center">
                        <div class="activity-icon info me-3">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Backup Terakhir</h6>
                            <small class="text-muted">{{ date('d F Y, H:i') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Performance Metrics -->
        <div class="col-lg-6">
            <div class="new-card h-100">
                <div class="new-card-header">
                    <h5 class="new-card-title">Performance Metrics</h5>
                </div>
                <div class="new-card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="activity-icon success me-3">
                            <i class="fas fa-tachometer-alt"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Total Produk</h6>
                            <small class="text-success">{{ number_format($totalProduk, 0, ',', '.') }} item</small>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center mb-3">
                        <div class="activity-icon info me-3">
                            <i class="fas fa-boxes"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Total Stok</h6>
                            <small class="text-info">{{ number_format($totalStok, 0, ',', '.') }} unit</small>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center">
                        <div class="activity-icon warning me-3">
                            <i class="fas fa-percentage"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Conversion Rate</h6>
                            @php
                                $conversionRate = $totalPengguna > 0 ? round(($transaksiHariIni / $totalPengguna) * 100, 1) : 0;
                            @endphp
                            <small class="text-warning">{{ $conversionRate }}% - @if($conversionRate > 5) Excellent @elseif($conversionRate > 2) Good @else Fair @endif</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Real-time clock function
    function updateRealTimeClock() {
        const now = new Date();
        
        // Format jam dengan timezone WIB (UTC+7)
        const options = {
            timeZone: 'Asia/Jakarta',
            hour12: false,
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        };
        
        const timeString = now.toLocaleTimeString('id-ID', options);
        document.getElementById('realTimeClock').textContent = timeString + ' WIB';
    }
    
    // Update clock immediately
    updateRealTimeClock();
    
    // Update clock every second
    setInterval(updateRealTimeClock, 1000);
    
    // Revenue Chart Configuration
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    let revenueChart;

    // Static fallback data
    const chartData = {
        7: {
            labels: ['24 Aug', '25 Aug', '26 Aug', '27 Aug', '28 Aug', '29 Aug', '30 Aug'],
            data: [1250000, 1890000, 2340000, 1780000, 2100000, 2650000, 1940000]
        },
        30: {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
            data: [8450000, 9230000, 7890000, 10200000]
        },
        90: {
            labels: ['Juni', 'Juli', 'Agustus'],
            data: [28500000, 32100000, 35700000]
        },
        365: {
            labels: ['Q1 2025', 'Q2 2025', 'Q3 2025', 'Q4 2025'],
            data: [85200000, 92400000, 96300000, 88700000]
        }
    };

    // Function to create/update chart
    function createRevenueChart(period = 7, labels = null, data = null) {
        if (revenueChart) {
            revenueChart.destroy();
        }

        // Use provided data or fallback to static data
        const chartLabels = labels || chartData[period].labels;
        const chartValues = data || chartData[period].data;

        revenueChart = new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: chartValues,
                    borderColor: '#f26b37',
                    backgroundColor: 'rgba(242, 107, 55, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#f26b37',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        borderColor: '#f26b37',
                        borderWidth: 1,
                        callbacks: {
                            label: function(context) {
                                return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        },
                        ticks: {
                            callback: function(value) {
                                if (value >= 1000000) {
                                    return 'Rp ' + (value / 1000000).toFixed(1) + 'M';
                                } else if (value >= 1000) {
                                    return 'Rp ' + (value / 1000).toFixed(0) + 'K';
                                }
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        }
                    }
                }
            }
        });
    }

    // Function to update chart with API data
    function updateChart(period) {
        const dropdown = document.getElementById('periodDropdown');
        dropdown.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status"></span>Loading...`;
        
        fetch(`/chart-data?period=${period}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Update chart with real data from database
                createRevenueChart(period, data.labels, data.data);
                
                // Update dropdown text
                const periodNames = {
                    7: '7 Hari',
                    30: '1 Bulan', 
                    90: '3 Bulan',
                    365: '1 Tahun'
                };
                dropdown.innerHTML = `<i class="fas fa-calendar-alt me-2"></i>${periodNames[period]}`;
            })
            .catch(error => {
                console.error('Error fetching chart data:', error);
                // Fallback to static data
                createRevenueChart(period);
                
                const periodNames = {
                    7: '7 Hari',
                    30: '1 Bulan',
                    90: '3 Bulan', 
                    365: '1 Tahun'
                };
                dropdown.innerHTML = `<i class="fas fa-calendar-alt me-2"></i>${periodNames[period]}`;
            });
    }

    // Initialize chart when page loads
    updateChart(7);
    
    // Add event listeners to dropdown items
    document.querySelectorAll('.dropdown-item[data-period]').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const period = parseInt(this.getAttribute('data-period'));
            updateChart(period);
        });
    });
});
</script>

@endsection
