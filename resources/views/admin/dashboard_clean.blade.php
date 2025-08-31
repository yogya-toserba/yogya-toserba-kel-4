@extends('layouts.navbar_admin')

@section('title', 'Dashboard Admin - MyYOGYA')

@section('content')
<style>
/* RESET ALL CONFLICTS */
.main-content {
    margin-left: 280px !important;
    padding: 20px 25px !important;
    background: #f8fafc !important;
}

/* Dark Mode Support */
body.dark-mode .main-content {
    background: #1a1d29 !important;
}

/* FORCE NEW DASHBOARD STYLES */
.new-dashboard {
    background: #f8fafc !important;
    min-height: 100vh !important;
    padding: 20px !important;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
}

body.dark-mode .new-dashboard {
    background: #1a1d29 !important;
}

.new-header {
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%) !important;
    color: white !important;
    padding: 30px !important;
    border-radius: 15px !important;
    margin-bottom: 30px !important;
    box-shadow: 0 4px 15px rgba(242, 107, 55, 0.3) !important;
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

.new-stats {
    display: grid !important;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)) !important;
    gap: 20px !important;
    margin-bottom: 30px !important;
}

.new-stat-card {
    background: white !important;
    padding: 25px !important;
    border-radius: 15px !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
    border: 1px solid #e2e8f0 !important;
    position: relative !important;
    transition: transform 0.3s ease !important;
}

body.dark-mode .new-stat-card {
    background: #2a2d3f !important;
    border-color: #3a3d4a !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3) !important;
}

.new-stat-card:hover {
    transform: translateY(-5px) !important;
}

.new-stat-card::before {
    content: '' !important;
    position: absolute !important;
    top: 0 !important;
    left: 0 !important;
    right: 0 !important;
    height: 4px !important;
    background: linear-gradient(90deg, #f26b37, #e55827) !important;
    border-radius: 15px 15px 0 0 !important;
}

.new-stat-number {
    font-size: 2.5rem !important;
    font-weight: bold !important;
    color: #1e293b !important;
    margin: 15px 0 5px 0 !important;
}

body.dark-mode .new-stat-number {
    color: #e2e8f0 !important;
}

.new-stat-label {
    color: #64748b !important;
    font-weight: 500 !important;
    font-size: 1rem !important;
}

body.dark-mode .new-stat-label {
    color: #94a3b8 !important;
}

.new-stat-icon {
    width: 50px !important;
    height: 50px !important;
    background: linear-gradient(135deg, #f26b37, #e55827) !important;
    border-radius: 12px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    color: white !important;
    font-size: 1.3rem !important;
    float: right !important;
}

.new-charts {
    display: grid !important;
    grid-template-columns: 2fr 1fr !important;
    gap: 30px !important;
}

.new-card {
    background: white !important;
    border-radius: 15px !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
    border: 1px solid #e2e8f0 !important;
    overflow: hidden !important;
}

body.dark-mode .new-card {
    background: #2a2d3f !important;
    border-color: #3a3d4a !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3) !important;
}

.new-card-header {
    padding: 20px 25px !important;
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
    padding: 25px !important;
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
    max-height: 400px !important;
    overflow-y: auto !important;
}

.activity-item {
    padding: 15px 0 !important;
    border-bottom: 1px solid #e2e8f0 !important;
    display: flex !important;
    align-items: center !important;
    gap: 15px !important;
}

body.dark-mode .activity-item {
    border-bottom-color: #3a3d4a !important;
}

.activity-icon {
    width: 40px !important;
    height: 40px !important;
    border-radius: 10px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 1rem !important;
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
    margin: 0 0 5px 0 !important;
    font-size: 0.9rem !important;
    font-weight: 600 !important;
    color: #1e293b !important;
}

body.dark-mode .activity-content h6 {
    color: #e2e8f0 !important;
}

.activity-content small {
    color: #64748b !important;
    font-size: 0.8rem !important;
}

body.dark-mode .activity-content small {
    color: #94a3b8 !important;
}

@media (max-width: 1200px) {
    .main-content {
        margin-left: 0 !important;
    }
    
    .new-charts {
        grid-template-columns: 1fr !important;
    }
    
    .new-stats {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)) !important;
    }
}
</style>

<div class="new-dashboard">
    <!-- Header -->
    <div class="new-header">
        <h1>Dashboard Admin</h1>
        <p>Selamat datang di panel administrasi MyYOGYA</p>
        <div style="float: right; margin-top: -60px;">
            <small style="opacity: 0.8;">{{ date('l, d F Y') }}</small>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="new-stats">
        <div class="new-stat-card">
            <div class="new-stat-icon">
                <i class="fas fa-box"></i>
            </div>
            <div class="new-stat-label">Total Produk</div>
            <div class="new-stat-number">{{ number_format($totalProduk) }}</div>
            <small style="color: #10b981;">
                <i class="fas fa-box-open"></i> {{ number_format($totalStok) }} Total Stok
            </small>
        </div>

        <div class="new-stat-card">
            <div class="new-stat-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="new-stat-label">Transaksi Hari Ini</div>
            <div class="new-stat-number">{{ number_format($transaksiHariIni) }}</div>
            <small style="color: #3b82f6;">
                <i class="fas fa-calendar-day"></i> {{ date('d F Y') }}
            </small>
        </div>

        <div class="new-stat-card">
            <div class="new-stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="new-stat-label">Total Pelanggan</div>
            <div class="new-stat-number">{{ number_format($totalPengguna) }}</div>
            <small style="color: #f59e0b;">
                <i class="fas fa-user-check"></i> Registered customers
            </small>
        </div>

        <div class="new-stat-card">
            <div class="new-stat-icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="new-stat-label">Pendapatan Hari Ini</div>
            <div class="new-stat-number">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</div>
            <small style="color: #10b981;">
                <i class="fas fa-money-bill-wave"></i> Dari {{ $transaksiHariIni }} transaksi
            </small>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="new-charts">
        <!-- Revenue Chart -->
        <div class="new-card">
            <div class="new-card-header">
                <h5 class="new-card-title">Grafik Pendapatan Bulanan</h5>
            </div>
            <div class="new-card-body">
                <div class="chart-placeholder">
                    <div class="text-center">
                        <i class="fas fa-chart-area fa-3x mb-3" style="color: #f26b37;"></i>
                        <div>Chart akan ditampilkan di sini</div>
                        <small>Data pendapatan per bulan</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="new-card">
            <div class="new-card-header">
                <h5 class="new-card-title">Aktivitas Terbaru</h5>
            </div>
            <div class="new-card-body">
                <div class="recent-activity">
                    <div class="activity-item">
                        <div class="activity-icon success">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="activity-content">
                            <h6>Transaksi Baru</h6>
                            <small>Transaksi #TRX001 berhasil diproses - Rp 125.000</small>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon info">
                            <i class="fas fa-box"></i>
                        </div>
                        <div class="activity-content">
                            <h6>Produk Ditambahkan</h6>
                            <small>5 produk baru ditambahkan ke kategori Fashion</small>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon warning">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="activity-content">
                            <h6>Stok Menipis</h6>
                            <small>3 produk memiliki stok di bawah 10 unit</small>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon success">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="activity-content">
                            <h6>Pelanggan Baru</h6>
                            <small>2 pelanggan baru mendaftar hari ini</small>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon info">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="activity-content">
                            <h6>Laporan Keuangan</h6>
                            <small>Laporan bulanan telah diperbarui</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Info Cards -->
    <div class="row g-4 mt-2">
        <div class="col-md-6">
            <div class="new-card">
                <div class="new-card-header">
                    <h5 class="new-card-title">Top Produk Terlaris</h5>
                </div>
                <div class="new-card-body">
                    <div class="chart-placeholder" style="height: 200px;">
                        <div class="text-center">
                            <i class="fas fa-crown fa-2x mb-2" style="color: #f26b37;"></i>
                            <div>Data produk terlaris</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="new-card">
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
    </div>
</div>
@endsection
