@extends('layouts.navbar_admin')

@section('title', 'Riwayat Transaksi - MyYOGYA')

@section('content')
<style>
/* GLOBAL OVERRIDE - FORCE EXACT DASHBOARD LAYOUT */
* {
    box-sizing: border-box !important;
}

/* RESET ALL MAIN CONTENT CONFLICTS */
.main-content {
    margin-left: 250px !important;
    padding: 0 !important;
    background: transparent !important;
    min-height: 100vh !important;
    width: calc(100% - 250px) !important;
    box-sizing: border-box !important;
    position: relative !important;
    overflow-x: hidden !important;
}

/* Ensure no parent container interferes */
@media (min-width: 769px) {
    .main-content {
        margin-left: 250px !important;
        width: calc(100% - 250px) !important;
    }
}

/* Remove any extra padding or margin that might conflict */
.main-content > * {
    max-width: 100% !important;
}

/* Dark Mode Support */
body.dark-mode .main-content {
    background: transparent !important;
}

/* FORCE NEW DASHBOARD STYLES - EXACT MATCH WITH DATA PENGAWAI GUDANG */
.new-pengguna {
    background: #f8fafc !important;
    min-height: 100vh !important;
    padding: 25px 35px !important;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
    overflow-x: hidden !important;
    width: 100% !important;
}

body.dark-mode .new-pengguna {
    background: #1a1d29 !important;
}

/* NEW HEADER STYLING */
.new-header {
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%) !important;
    color: white !important;
    padding: 35px 40px !important;
    border-radius: 15px !important;
    margin-bottom: 15px !important;
    box-shadow: 0 4px 15px rgba(242, 107, 55, 0.3) !important;
    position: relative !important;
}

.new-header h1 {
    font-size: 2.5rem !important;
    font-weight: bold !important;
    margin: 0 !important;
    color: white !important;
    display: flex;
    align-items: center;
    gap: 12px;
}

.new-header p {
    font-size: 1.1rem !important;
    opacity: 0.9 !important;
    margin: 10px 0 0 0 !important;
    color: white !important;
}

.new-header .date-time {
    text-align: right;
    font-size: 0.9rem;
    opacity: 0.95;
}

/* Header Right Side Layout - EXACT MATCH WITH DAFTAR PENGGUNA */
.new-header div[style*="text-align: right"] {
    display: flex !important;
    flex-direction: column !important;
    align-items: flex-end !important;
    gap: 0 !important;
}

/* Real Time Clock Styling - EXACT SAME AS DAFTAR PENGGUNA */
#realTimeClock {
    background: rgba(255, 255, 255, 0.2) !important;
    padding: 8px 16px !important;
    border-radius: 20px !important;
    font-size: 1rem !important;
    font-weight: 600 !important;
    color: white !important;
    border: 1px solid rgba(255, 255, 255, 0.3) !important;
    backdrop-filter: blur(10px) !important;
    transition: all 0.2s ease !important;
    display: inline-block !important;
    font-family: 'Courier New', monospace !important;
    letter-spacing: 1px !important;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1) !important;
    margin-bottom: 5px !important;
    text-align: center !important;
}

#realTimeClock:hover {
    background: rgba(255, 255, 255, 0.25) !important;
    transform: translateY(-1px) !important;
}

/* STATS CARDS - EXACT MATCH WITH DAFTAR PENGGUNA */
.new-stat-card {
        background: white !important;
    padding: 25px !important;
    border-radius: 15px !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
    border: 1px solid #e2e8f0 !important;
    transition: all 0.3s ease !important;
    position: relative !important;
    overflow: hidden !important;
    text-align: center !important;
}

.new-stat-card:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

body.dark-mode .new-stat-card {
    background: #2a2d3f !important;
    color: #e2e8f0 !important;
    border-color: #374151 !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3) !important;
}

body.dark-mode .new-stat-card:hover {
    box-shadow: 0 8px 25px rgba(0,0,0,0.4) !important;
}

.new-stat-icon {
    width: 60px !important;
    height: 60px !important;
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%) !important;
    border-radius: 15px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 20px !important;
    margin: 0 auto 15px auto !important;
    box-shadow: 0 4px 12px rgba(242, 107, 55, 0.3) !important;
    color: white !important;
}

.new-stat-number {
    font-size: 2.2rem !important;
    font-weight: bold !important;
    margin-bottom: 8px !important;
    color: #1e293b !important;
    line-height: 1 !important;
    text-align: center !important;
}

body.dark-mode .new-stat-number {
    color: white !important;
}

.new-stat-label {
    font-size: 1rem !important;
    font-weight: 500 !important;
    color: #64748b !important;
    margin-bottom: 10px !important;
    text-align: center !important;
    line-height: 1.3 !important;
}

body.dark-mode .new-stat-label {
    color: #94a3b8 !important;
}

.new-stat-change {
    font-size: 0.75rem !important;
    font-weight: 600 !important;
    margin-top: 8px !important;
    padding: 4px 8px !important;
    border-radius: 12px !important;
    display: inline-block !important;
    text-align: center !important;
}

.change-positive {
    background: #dcfce7 !important;
    color: #15803d !important;
}

.change-negative {
    background: #fee2e2 !important;
    color: #dc2626 !important;
}

.change-neutral {
    background: #e0f2fe !important;
    color: #0277bd !important;
}

.change-warning {
    background: #fef3c7 !important;
    color: #d97706 !important;
}

body.dark-mode .change-positive {
    background: #052e16 !important;
    color: #4ade80 !important;
}

body.dark-mode .change-negative {
    background: #450a0a !important;
    color: #f87171 !important;
}

/* SEARCH FILTER BAR - EXACT MATCH WITH LAPORAN */
.search-filter-bar {
    background: white !important;
    padding: 25px 30px !important;
    border-radius: 15px !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
    border: 1px solid #e2e8f0 !important;
    margin-bottom: 20px !important;
}

/* Force override for change classes */
.new-stat-change.change-warning {
    background: #fef3c7 !important;
    color: #d97706 !important;
}

.new-stat-change.change-positive {
    background: #dcfce7 !important;
    color: #15803d !important;
}

.new-stat-change.change-negative {
    background: #fee2e2 !important;
    color: #dc2626 !important;
}

.new-stat-change.change-neutral {
    background: #e0f2fe !important;
    color: #0277bd !important;
}

body.dark-mode .search-filter-bar {
    background: #2a2d3f !important;
    border-color: #374151 !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3) !important;
}

.form-label {
    font-weight: 600 !important;
    color: #374151 !important;
    margin-bottom: 8px !important;
    font-size: 0.875rem !important;
}

body.dark-mode .form-label {
    color: #f9fafb !important;
}

.form-control, .form-select {
    border: 2px solid #e2e8f0 !important;
    border-radius: 8px !important;
    padding: 10px 12px !important;
    font-size: 0.9rem !important;
    transition: all 0.2s ease !important;
    background: white !important;
    color: #374151 !important;
}

.form-control:focus, .form-select:focus {
    border-color: #f26b37 !important;
    box-shadow: 0 0 0 0.2rem rgba(242, 107, 55, 0.25) !important;
    outline: none !important;
}

body.dark-mode .form-control,
body.dark-mode .form-select {
    background: #374151 !important;
    border-color: #4b5563 !important;
    color: #f9fafb !important;
}

body.dark-mode .form-control:focus,
body.dark-mode .form-select:focus {
    border-color: #f26b37 !important;
    background: #4b5563 !important;
}

.search-btn {
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%) !important;
    border: none !important;
    color: white !important;
    padding: 10px 20px !important;
    border-radius: 8px !important;
    font-weight: 600 !important;
    transition: all 0.2s ease !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 8px !important;
    width: 100% !important;
}

.search-btn:hover {
    transform: translateY(-1px) !important;
    box-shadow: 0 6px 20px rgba(242, 107, 55, 0.4) !important;
}

/* NEW CARD STYLING - EXACT MATCH */
.new-card {
    background: white !important;
    border-radius: 15px !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
    border: 1px solid #e2e8f0 !important;
    overflow: hidden !important;
}

body.dark-mode .new-card {
    background: #2a2d3f !important;
    border-color: #374151 !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3) !important;
}

.new-card-header {
    background: #f8fafc !important;
    padding: 20px 25px !important;
    border-bottom: 1px solid #e2e8f0 !important;
}

body.dark-mode .new-card-header {
    background: #374151 !important;
    border-bottom-color: #4b5563 !important;
}

.new-card-title {
    font-size: 1.25rem !important;
    font-weight: 700 !important;
    color: #1e293b !important;
    margin: 0 !important;
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
}

body.dark-mode .new-card-title {
    color: #f9fafb !important;
}

.new-card-body {
    padding: 0 !important;
}

/* TABLE STYLES */
.table {
    margin-bottom: 0 !important;
    border-collapse: separate !important;
    border-spacing: 0 !important;
    background: transparent !important;
}

.table th {
    background: #f8fafc !important;
    color: #374151 !important;
    font-weight: 600 !important;
    text-transform: uppercase !important;
    font-size: 0.75rem !important;
    letter-spacing: 0.5px !important;
    padding: 15px 20px !important;
    border: none !important;
    vertical-align: middle !important;
}

.table th:last-child {
    width: 60px !important;
    text-align: center !important;
    padding: 15px 12px !important;
}

body.dark-mode .table th {
    background: #374151 !important;
    color: #f9fafb !important;
}

.table td {
    padding: 15px 20px !important;
    border-top: 1px solid #e2e8f0 !important;
    border-bottom: none !important;
    vertical-align: middle !important;
    color: #374151 !important;
    background: white !important;
}

.table td:last-child {
    width: 60px !important;
    text-align: center !important;
    padding: 15px 12px !important;
}

body.dark-mode .table td {
    border-top-color: #4b5563 !important;
    color: #f9fafb !important;
    background: #2a2d3f !important;
}

.table tbody tr:hover {
    background: #f8fafc !important;
}

.table tbody tr:hover td {
    background: #f8fafc !important;
}

body.dark-mode .table tbody tr:hover {
    background: #374151 !important;
}

body.dark-mode .table tbody tr:hover td {
    background: #374151 !important;
}

/* Badge styling - consistent with other pages */
.table .badge {
    padding: 4px 8px !important;
    border-radius: 12px !important;
    font-size: 0.75rem !important;
    font-weight: 500 !important;
}

/* Ellipsis menu button */
.btn-menu {
    background: none !important;
    border: none !important;
    color: #9ca3af !important;
    padding: 0 !important;
    margin: 0 !important;
    font-size: 16px !important;
    line-height: 1 !important;
    cursor: pointer !important;
    transition: color 0.2s ease !important;
}

.btn-menu:hover {
    background: none !important;
    border: none !important;
    color: #6b7280 !important;
}

.btn-menu:focus,
.btn-menu:active {
    background: none !important;
    border: none !important;
    outline: none !important;
    box-shadow: none !important;
}

body.dark-mode .btn-menu {
    color: #9ca3af !important;
}

body.dark-mode .btn-menu:hover {
    background: none !important;
    border: none !important;
    color: #d1d5db !important;
}

/* PAGINATION - SAME AS DATA PENGAWAI GUDANG */
.pagination-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 0;
    padding: 20px 25px;
    flex-wrap: wrap;
    background: white !important;
}

body.dark-mode .pagination-container {
    background: #2a2d3f !important;
}

.pagination-info {
    color: #64748b;
    font-size: 0.9rem;
}

body.dark-mode .pagination-info {
    color: #94a3b8;
}

.pagination-wrapper {
    display: flex;
    align-items: center;
}

.pagination {
    margin: 0;
}

.page-link {
    color: #374151;
    background: white;
    border: 1px solid #d1d5db;
    padding: 8px 12px;
    margin: 0 2px;
    border-radius: 6px;
    font-size: 0.875rem;
    transition: all 0.2s ease;
}

.page-link:hover {
    background: #f8fafc;
    border-color: #f26b37;
    color: #f26b37;
}

.page-item.active .page-link {
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
    border-color: #f26b37;
    color: white;
}

.page-item.disabled .page-link {
    color: #9ca3af;
    background: #f9fafb;
    border-color: #e5e7eb;
    cursor: not-allowed;
}

body.dark-mode .page-link {
    background: #374151;
    border-color: #4b5563;
    color: #f9fafb;
}

body.dark-mode .page-link:hover {
    background: #4b5563;
    border-color: #f26b37;
    color: #f26b37;
}

body.dark-mode .page-item.disabled .page-link {
    color: #6b7280;
    background: #2a2d3f;
    border-color: #374151;
}

/* Avatar fallback styling */
.avatar-fallback {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 0.9rem;
    flex-shrink: 0;
}

/* Button styling - exact match */
.btn-outline-secondary {
    border: 2px solid #6c757d !important;
    background: transparent !important;
    color: #6c757d !important;
    padding: 6px 12px !important;
    border-radius: 6px !important;
    font-size: 0.875rem !important;
    font-weight: 600 !important;
    transition: all 0.2s ease !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 6px !important;
}

.btn-outline-secondary:hover {
    background: #6c757d !important;
    color: white !important;
    transform: translateY(-1px) !important;
}

/* Responsive design */
@media (max-width: 768px) {
    .pagination-container {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
    
    .table tbody td {
        font-size: 0.8rem;
    }
    
    .new-pengguna {
        padding: 15px 20px !important;
    }
    
    .new-header {
        padding: 25px 20px !important;
    }
    
    .new-header h1 {
        font-size: 2rem !important;
    }
    
    .search-filter-bar {
        padding: 20px 15px !important;
    }
    
    .table-responsive {
        font-size: 0.85rem;
    }
}

@media (max-width: 576px) {
    .new-pengguna {
        padding: 10px 15px !important;
    }
    
    .new-header {
        padding: 20px 15px !important;
        text-align: center;
    }
    
    .new-header h1 {
        font-size: 1.5rem !important;
        justify-content: center;
    }
    
    .search-filter-bar .row > div {
        margin-bottom: 15px;
    }
    
    .table th,
    .table td {
        padding: 8px 12px !important;
        font-size: 0.75rem !important;
    }
}

/* ADDITIONAL IMPROVEMENTS */
.change-info {
    color: #3b82f6 !important;
}

.change-negative {
    color: #dc2626 !important;
}

.dropdown-menu {
    border: none !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
    border-radius: 8px !important;
}

body.dark-mode .dropdown-menu {
    background: #374151 !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3) !important;
}

.dropdown-item {
    padding: 8px 16px !important;
    transition: all 0.3s ease !important;
}

.dropdown-item:hover {
    background: #f8fafc !important;
    color: #1f2937 !important;
}

body.dark-mode .dropdown-item {
    color: #e5e7eb !important;
}

body.dark-mode .dropdown-item:hover {
    background: #4b5563 !important;
    color: #f9fafb !important;
}

.avatar-fallback {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #f26b37, #e55827);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 14px;
}
</style>

<div class="new-pengguna">
    <!-- Header with Time and Date -->
    <div class="new-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h1><i class="fas fa-history me-3"></i>Riwayat Transaksi</h1>
                <p>Kelola dan analisis semua riwayat transaksi perusahaan</p>
            </div>
            <div style="text-align: right;">
                <div id="realTimeClock"></div>
                <small id="currentDate" style="opacity: 0.8;"></small>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4" style="margin-top: 30px; margin-bottom: 30px;">
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="new-stat-number">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                <div class="new-stat-label">Total Pendapatan</div>
                <div class="new-stat-change {{ $pertumbuhanPendapatan >= 0 ? 'change-positive' : 'change-negative' }}">
                    {{ $pertumbuhanPendapatan >= 0 ? '+' : '' }}{{ number_format($pertumbuhanPendapatan, 1) }}% dari bulan lalu
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-credit-card"></i>
                </div>
                <div class="new-stat-number">Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</div>
                <div class="new-stat-label">Pendapatan Bulan Ini</div>
                <div class="new-stat-change change-info">{{ \Carbon\Carbon::now()->format('F Y') }}</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <div class="new-stat-number">Rp {{ number_format($pendapatanBulanIni > 0 ? $pendapatanBulanIni / $totalTransaksi : 0, 0, ',', '.') }}</div>
                <div class="new-stat-label">Rata-rata per Transaksi</div>
                <div class="new-stat-change change-info">Berdasarkan data bulan ini</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <div class="new-stat-number">{{ number_format($totalTransaksi) }}</div>
                <div class="new-stat-label">Total Transaksi</div>
                <div class="new-stat-change change-positive">Semua periode</div>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="search-filter-bar">
        <form method="GET" action="{{ route('admin.keuangan.riwayat') }}">
            <div class="row g-2 align-items-end">
                <div class="col-md-4">
                    <label for="search" class="form-label">Cari Transaksi</label>
                    <input type="text" class="form-control" id="search" name="search" 
                           placeholder="ID transaksi, nama pelanggan, atau metode..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <label for="periode" class="form-label">Periode</label>
                    <select class="form-select" id="periode" name="periode">
                        <option value="">Semua Periode</option>
                        <option value="harian" {{ request('periode') == 'harian' ? 'selected' : '' }}>Harian</option>
                        <option value="mingguan" {{ request('periode') == 'mingguan' ? 'selected' : '' }}>Mingguan</option>
                        <option value="bulanan" {{ request('periode') == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="">Semua Status</option>
                        <option value="berhasil" {{ request('status') == 'berhasil' ? 'selected' : '' }}>Berhasil</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="gagal" {{ request('status') == 'gagal' ? 'selected' : '' }}>Gagal</option>
                        <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="metode" class="form-label">Metode</label>
                    <select class="form-select" id="metode" name="metode">
                        <option value="">Semua Metode</option>
                        <option value="tunai" {{ request('metode') == 'tunai' ? 'selected' : '' }}>Tunai</option>
                        <option value="kartu" {{ request('metode') == 'kartu' ? 'selected' : '' }}>Kartu</option>
                        <option value="transfer" {{ request('metode') == 'transfer' ? 'selected' : '' }}>Transfer</option>
                        <option value="ewallet" {{ request('metode') == 'ewallet' ? 'selected' : '' }}>E-Wallet</option>
                        <option value="qris" {{ request('metode') == 'qris' ? 'selected' : '' }}>QRIS</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <div class="d-flex gap-2">
                        <button type="submit" class="search-btn">
                            <i class="fas fa-search"></i> Cari
                        </button>
                        <a href="{{ route('admin.keuangan.riwayat') }}" class="btn-outline-secondary">
                            <i class="fas fa-undo"></i> Reset
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Main Data Table -->
    <div class="row" style="margin-top: 30px; clear: both;">
        <div class="col-12">
            <div class="new-card">
                <div class="new-card-header">
                    <div class="new-card-title">
                        <i class="fas fa-table"></i>
                        Manajemen Riwayat Transaksi
                    </div>
                </div>
                <div class="new-card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>TRANSAKSI</th>
                                    <th>ID TRANSAKSI</th>
                                    <th>METODE</th>
                                    <th>TANGGAL</th>
                                    <th>STATUS</th>
                                    <th>TOTAL</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                    <tbody>
                        @forelse($transaksi as $index => $t)
                        <tr>
                            <td>{{ $transaksi->firstItem() + $index }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-fallback me-3">{{ strtoupper(substr($t->nama_pelanggan, 0, 2)) }}</div>
                                    <div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>{{ $t->nama_pelanggan }}</strong>
                                            <small class="text-muted">{{ $t->nama_cabang }}</small>
                                        </div>
                                    </div>
                                </div>
                            </td>
                                                        <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <strong>#{{ $t->id_transaksi }}</strong>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <strong>{{ ucfirst($t->metode_pembayaran ?? 'Tunai') }}</strong>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <strong>{{ \Carbon\Carbon::parse($t->tanggal_transaksi)->format('d M Y') }}</strong>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($t->tanggal_transaksi)->format('H:i') }}</small>
                                </div>
                            </td>
                            <td>
                                @php
                                    $status = $t->status_transaksi ?? 'berhasil';
                                    $statusConfig = [
                                        'berhasil' => ['bg' => '#dcfce7', 'color' => '#15803d', 'text' => 'Berhasil'],
                                        'pending' => ['bg' => '#fef3c7', 'color' => '#d97706', 'text' => 'Pending'],
                                        'gagal' => ['bg' => '#fee2e2', 'color' => '#dc2626', 'text' => 'Gagal'],
                                        'dibatalkan' => ['bg' => '#f3f4f6', 'color' => '#6b7280', 'text' => 'Dibatalkan']
                                    ];
                                    $config = $statusConfig[$status] ?? $statusConfig['berhasil'];
                                @endphp
                                <span class="badge" style="background: {{ $config['bg'] }}; color: {{ $config['color'] }}; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">
                                    {{ $config['text'] }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <strong>Rp {{ number_format($t->total_belanja, 0, ',', '.') }}</strong>
                                </div>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn-menu" type="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i>Lihat Detail</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-print me-2"></i>Cetak Struk</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-2"></i>Hapus</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fas fa-search text-muted mb-2" style="font-size: 2rem;"></i>
                                    <p class="text-muted mb-0">Tidak ada data transaksi ditemukan</p>
                                    @if(request()->hasAny(['search', 'periode', 'status', 'metode']))
                                        <small class="text-muted">Coba ubah kriteria pencarian Anda</small>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                            </tbody>
                        </table>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-fallback me-3">BP</div>
                                    <div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>Budi Pratama</strong>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <strong>TRX003</strong>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <strong>Transfer</strong>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <strong>01 Sep 2025</strong>
                                </div>
                            </td>
                            <td>
                                <span class="badge" style="background: #fef3c7; color: #d97706; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">Pending</span>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <strong>Rp 520.000</strong>
                                </div>
                            </td>
                            <td>
                                <button class="btn-menu">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-fallback me-3">DF</div>
                                    <div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>Dewi Fortuna</strong>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <strong>TRX004</strong>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <strong>E-Wallet</strong>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <strong>01 Sep 2025</strong>
                                </div>
                            </td>
                            <td>
                                <span class="badge" style="background: #dcfce7; color: #15803d; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">Berhasil</span>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <strong>Rp 89.900</strong>
                                </div>
                            </td>
                            <td>
                                <button class="btn-menu">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-fallback me-3">RH</div>
                                    <div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>Rizky Hamdani</strong>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <strong>TRX005</strong>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <strong>Kartu</strong>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <strong>31 Agu 2025</strong>
                                </div>
                            </td>
                            <td>
                                <span class="badge" style="background: #fee2e2; color: #dc2626; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">Gagal</span>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <strong>Rp 750.000</strong>
                                </div>
                            </td>
                            <td>
                                <button class="btn-menu">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-container">
                        <div class="pagination-info">
                            @if($transaksi->total() > 0)
                                Menampilkan {{ $transaksi->firstItem() }} - {{ $transaksi->lastItem() }} dari {{ number_format($transaksi->total()) }} riwayat transaksi
                                @if(request()->hasAny(['search', 'periode', 'status', 'metode']))
                                    <span class="text-muted"> (hasil pencarian/filter)</span>
                                @endif
                            @else
                                Tidak ada riwayat transaksi yang ditemukan
                            @endif
                        </div>
                        @if($transaksi->hasPages())
                            <div class="pagination-wrapper">
                                {{ $transaksi->appends(request()->query())->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Real Time Clock and Date - HEADER ONLY
function updateDateTime() {
    const now = new Date();
    
    // Update clock
    const clockElement = document.getElementById('realTimeClock');
    if (clockElement) {
        const timeString = now.toLocaleTimeString('id-ID', {
            hour12: false,
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            timeZone: 'Asia/Jakarta'
        });
        clockElement.textContent = timeString + ' WIB';
    }
    
    // Update date
    const dateElement = document.getElementById('currentDate');
    if (dateElement) {
        const options = { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric',
            timeZone: 'Asia/Jakarta'
        };
        const dateString = now.toLocaleDateString('id-ID', options);
        dateElement.textContent = dateString;
    }
}

// Initialize and update every second
updateDateTime();
setInterval(updateDateTime, 1000);

// Reset form function
function resetForm() {
    document.getElementById('search').value = '';
    document.getElementById('periode').value = '';
    document.getElementById('status').value = '';
    document.getElementById('metode').value = '';
}
</script>
@endsection
