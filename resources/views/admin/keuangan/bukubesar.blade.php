@extends('layouts.navbar_admin')

@section('title', 'Buku Besar - MyYOGYA')

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

/* STATS CARDS - EXACT MATCH WITH DATA PENGAWAI GUDANG */
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

/* SEARCH FILTER BAR - EXACT MATCH WITH DATA PENGAWAI GUDANG */
.search-filter-bar {
    background: white !important;
    padding: 25px !important;
    border-radius: 15px !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
    border: 1px solid #e2e8f0 !important;
    margin-bottom: 25px !important;
}

body.dark-mode .search-filter-bar {
    background: #2a2d3f !important;
    border-color: #374151 !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3) !important;
}

.search-filter-bar .form-label {
    font-weight: 600 !important;
    color: #374151 !important;
    margin-bottom: 6px !important;
    font-size: 0.9rem !important;
    text-shadow: none !important;
}

body.dark-mode .search-filter-bar .form-label {
    color: #f9fafb !important;
    text-shadow: none !important;
}

.search-filter-bar .form-control, 
.search-filter-bar .form-select {
    border: 2px solid #d1d5db !important;
    border-radius: 8px !important;
    padding: 8px 12px !important;
    background: white !important;
    transition: all 0.3s ease !important;
    font-size: 0.9rem !important;
    color: #374151 !important;
    min-height: 38px !important;
    height: 38px !important;
}

.search-filter-bar .form-control:focus, 
.search-filter-bar .form-select:focus {
    border-color: #f26b37 !important;
    box-shadow: 0 0 0 3px rgba(242, 107, 55, 0.1) !important;
    outline: none !important;
    background: white !important;
}

.search-filter-bar .form-control::placeholder {
    color: #9ca3af !important;
    opacity: 1 !important;
}

body.dark-mode .search-filter-bar .form-control, 
body.dark-mode .search-filter-bar .form-select {
    background: #374151 !important;
    border-color: #4b5563 !important;
    color: #f9fafb !important;
}

body.dark-mode .search-filter-bar .form-control:focus, 
body.dark-mode .search-filter-bar .form-select:focus {
    background: #4b5563 !important;
    border-color: #f26b37 !important;
    color: #f9fafb !important;
}

body.dark-mode .search-filter-bar .form-control::placeholder {
    color: #9ca3af !important;
}

.search-btn {
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%) !important;
    border: none !important;
    color: white !important;
    padding: 8px 16px !important;
    border-radius: 8px !important;
    font-weight: 600 !important;
    transition: all 0.2s ease !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 8px !important;
    width: 100% !important;
    min-height: 38px !important;
    height: 38px !important;
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

/* Dropdown Menu Styling */
.dropdown-menu {
    border: none !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
    border-radius: 8px !important;
    min-width: 160px !important;
}

body.dark-mode .dropdown-menu {
    background: #374151 !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3) !important;
}

.dropdown-item {
    padding: 8px 16px !important;
    transition: all 0.3s ease !important;
    color: #374151 !important;
    font-size: 0.9rem !important;
}

.dropdown-item:hover {
    background: #f8fafc !important;
    color: #f26b37 !important;
}

.dropdown-item.text-danger {
    color: #dc2626 !important;
}

.dropdown-item.text-danger:hover {
    background: #fee2e2 !important;
    color: #dc2626 !important;
}

body.dark-mode .dropdown-item {
    color: #f9fafb !important;
}

body.dark-mode .dropdown-item:hover {
    background: #4b5563 !important;
    color: #f26b37 !important;
}

body.dark-mode .dropdown-item.text-danger {
    color: #f87171 !important;
}

body.dark-mode .dropdown-item.text-danger:hover {
    background: #7f1d1d !important;
    color: #f87171 !important;
}

.dropdown-divider {
    margin: 4px 0 !important;
    border-top: 1px solid #e5e7eb !important;
}

body.dark-mode .dropdown-divider {
    border-top-color: #4b5563 !important;
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
        padding: 15px 8px !important;
        font-size: 0.8rem !important;
    }
}
</style>

<div class="new-pengguna">
    <!-- Header Section -->
    <div class="new-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h1><i class="fas fa-book me-3"></i>Buku Besar</h1>
                <p>Manajemen dan Monitoring Transaksi Keuangan Perusahaan</p>
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
                    <i class="fas fa-arrow-up"></i>
                </div>
                <div class="new-stat-number">Rp 100M</div>
                <div class="new-stat-label">Total Debit</div>
                <div class="new-stat-change change-positive">+12% dari bulan lalu</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-arrow-down"></i>
                </div>
                <div class="new-stat-number">Rp 10M</div>
                <div class="new-stat-label">Total Kredit</div>
                <div class="new-stat-change change-warning">+5% dari bulan lalu</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="new-stat-number">Rp 0</div>
                <div class="new-stat-label">Saldo Awal</div>
                <div class="new-stat-change change-neutral">Tetap stabil</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-coins"></i>
                </div>
                <div class="new-stat-number">Rp 90M</div>
                <div class="new-stat-label">Saldo Akhir</div>
                <div class="new-stat-change change-positive">+18% dari bulan lalu</div>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="search-filter-bar">
        <form method="GET" action="">
            <div class="row g-2 align-items-end">
                <div class="col-md-4">
                    <label for="search" class="form-label">Cari Transaksi</label>
                    <input type="text" class="form-control" id="search" name="search" 
                           placeholder="No transaksi, tanggal, atau keterangan..." value="">
                </div>
                <div class="col-md-2">
                    <label for="periode" class="form-label">Periode</label>
                    <select class="form-select" id="periode" name="periode">
                        <option value="">Semua Periode</option>
                        <option value="harian">Harian</option>
                        <option value="mingguan">Mingguan</option>
                        <option value="bulanan">Bulanan</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="jenis" class="form-label">Jenis</label>
                    <select class="form-select" id="jenis" name="jenis">
                        <option value="">Semua Jenis</option>
                        <option value="debit">Debit</option>
                        <option value="kredit">Kredit</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="metode" class="form-label">Metode</label>
                    <select class="form-select" id="metode" name="metode">
                        <option value="">Semua Metode</option>
                        <option value="tunai">Tunai</option>
                        <option value="transfer">Transfer</option>
                        <option value="kartu">Kartu</option>
                        <option value="ewallet">E-Wallet</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <div class="d-flex gap-2">
                        <button type="submit" class="search-btn">
                            <i class="fas fa-search"></i> Cari
                        </button>
                        <button type="button" class="btn-outline-secondary" onclick="resetForm()">
                            <i class="fas fa-undo"></i> Reset
                        </button>
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
                        Manajemen Buku Besar Keuangan
                    </div>
                </div>
                <div class="new-card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>TRANSAKSI</th>
                                    <th>NO TRANSAKSI</th>
                                    <th>JENIS</th>
                                    <th>TANGGAL</th>
                                    <th>METODE</th>
                                    <th>NOMINAL</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-fallback me-3">--</div>
                                            <div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <strong>Penjualan Produk</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>TRX001/2025</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>Debit</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>03 Sep 2025</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #dcfce7; color: #15803d; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">Tunai</span>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>Rp 2.500.000</strong>
                                            <small class="text-success">Debit (+)</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn-menu" type="button" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#" onclick="lihatDetail('TRX001/2025')"><i class="fas fa-eye me-2"></i>Lihat Detail</a></li>
                                                <li><a class="dropdown-item" href="#" onclick="cetakJurnal('TRX001/2025')"><i class="fas fa-print me-2"></i>Cetak Jurnal</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item" href="#" onclick="editTransaksi('TRX001/2025')"><i class="fas fa-edit me-2"></i>Edit</a></li>
                                                <li><a class="dropdown-item text-danger" href="#" onclick="hapusTransaksi('TRX001/2025')"><i class="fas fa-trash me-2"></i>Hapus</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-fallback me-3">--</div>
                                            <div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <strong>Pembelian Stok</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>TRX002/2025</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>Kredit</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>03 Sep 2025</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #e0f2fe; color: #0277bd; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">Transfer</span>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>Rp 1.800.000</strong>
                                            <small class="text-danger">Kredit (-)</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn-menu" type="button" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#" onclick="lihatDetail('TRX002/2025')"><i class="fas fa-eye me-2"></i>Lihat Detail</a></li>
                                                <li><a class="dropdown-item" href="#" onclick="cetakJurnal('TRX002/2025')"><i class="fas fa-print me-2"></i>Cetak Jurnal</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item" href="#" onclick="editTransaksi('TRX002/2025')"><i class="fas fa-edit me-2"></i>Edit</a></li>
                                                <li><a class="dropdown-item text-danger" href="#" onclick="hapusTransaksi('TRX002/2025')"><i class="fas fa-trash me-2"></i>Hapus</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-fallback me-3">--</div>
                                            <div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <strong>Bayar Listrik</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>TRX003/2025</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>Kredit</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>02 Sep 2025</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #fef3c7; color: #d97706; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">E-Wallet</span>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>Rp 750.000</strong>
                                            <small class="text-danger">Kredit (-)</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn-menu" type="button" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#" onclick="lihatDetail('TRX003/2025')"><i class="fas fa-eye me-2"></i>Lihat Detail</a></li>
                                                <li><a class="dropdown-item" href="#" onclick="cetakJurnal('TRX003/2025')"><i class="fas fa-print me-2"></i>Cetak Jurnal</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item" href="#" onclick="editTransaksi('TRX003/2025')"><i class="fas fa-edit me-2"></i>Edit</a></li>
                                                <li><a class="dropdown-item text-danger" href="#" onclick="hapusTransaksi('TRX003/2025')"><i class="fas fa-trash me-2"></i>Hapus</a></li>
                                            </ul>
                                        </div>
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-fallback me-3">--</div>
                                            <div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <strong>Penjualan Online</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>TRX004/2025</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>Debit</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>02 Sep 2025</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #e0f2fe; color: #0277bd; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">Transfer</span>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>Rp 3.200.000</strong>
                                            <small class="text-success">Debit (+)</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn-menu" type="button" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#" onclick="lihatDetail('TRX004/2025')"><i class="fas fa-eye me-2"></i>Lihat Detail</a></li>
                                                <li><a class="dropdown-item" href="#" onclick="cetakJurnal('TRX004/2025')"><i class="fas fa-print me-2"></i>Cetak Jurnal</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item" href="#" onclick="editTransaksi('TRX004/2025')"><i class="fas fa-edit me-2"></i>Edit</a></li>
                                                <li><a class="dropdown-item text-danger" href="#" onclick="hapusTransaksi('TRX004/2025')"><i class="fas fa-trash me-2"></i>Hapus</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-fallback me-3">--</div>
                                            <div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <strong>Gaji Karyawan</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>TRX005/2025</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>Kredit</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>01 Sep 2025</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #e0f2fe; color: #0277bd; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">Transfer</span>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>Rp 15.000.000</strong>
                                            <small class="text-danger">Kredit (-)</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn-menu" type="button" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#" onclick="lihatDetail('TRX005/2025')"><i class="fas fa-eye me-2"></i>Lihat Detail</a></li>
                                                <li><a class="dropdown-item" href="#" onclick="cetakJurnal('TRX005/2025')"><i class="fas fa-print me-2"></i>Cetak Jurnal</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item" href="#" onclick="editTransaksi('TRX005/2025')"><i class="fas fa-edit me-2"></i>Edit</a></li>
                                                <li><a class="dropdown-item text-danger" href="#" onclick="hapusTransaksi('TRX005/2025')"><i class="fas fa-trash me-2"></i>Hapus</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-fallback me-3">--</div>
                                            <div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <strong>Service & Maintenance</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>TRX006/2025</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>Kredit</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>01 Sep 2025</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #dcfce7; color: #15803d; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">Tunai</span>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>Rp 1.500.000</strong>
                                            <small class="text-danger">Kredit (-)</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn-menu" type="button" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#" onclick="lihatDetail('TRX006/2025')"><i class="fas fa-eye me-2"></i>Lihat Detail</a></li>
                                                <li><a class="dropdown-item" href="#" onclick="cetakJurnal('TRX006/2025')"><i class="fas fa-print me-2"></i>Cetak Jurnal</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item" href="#" onclick="editTransaksi('TRX006/2025')"><i class="fas fa-edit me-2"></i>Edit</a></li>
                                                <li><a class="dropdown-item text-danger" href="#" onclick="hapusTransaksi('TRX006/2025')"><i class="fas fa-trash me-2"></i>Hapus</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-fallback me-3">--</div>
                                            <div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <strong>Bonus Penjualan</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>TRX007/2025</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>Debit</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>31 Aug 2025</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #dcfce7; color: #15803d; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">Tunai</span>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>Rp 5.000.000</strong>
                                            <small class="text-success">Debit (+)</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn-menu" type="button" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#" onclick="lihatDetail('TRX007/2025')"><i class="fas fa-eye me-2"></i>Lihat Detail</a></li>
                                                <li><a class="dropdown-item" href="#" onclick="cetakJurnal('TRX007/2025')"><i class="fas fa-print me-2"></i>Cetak Jurnal</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item" href="#" onclick="editTransaksi('TRX007/2025')"><i class="fas fa-edit me-2"></i>Edit</a></li>
                                                <li><a class="dropdown-item text-danger" href="#" onclick="hapusTransaksi('TRX007/2025')"><i class="fas fa-trash me-2"></i>Hapus</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-fallback me-3">--</div>
                                            <div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <strong>Return Produk</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>TRX008/2025</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>Kredit</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>30 Aug 2025</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #fef3c7; color: #d97706; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">E-Wallet</span>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>Rp 450.000</strong>
                                            <small class="text-danger">Kredit (-)</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn-menu" type="button" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#" onclick="lihatDetail('TRX008/2025')"><i class="fas fa-eye me-2"></i>Lihat Detail</a></li>
                                                <li><a class="dropdown-item" href="#" onclick="cetakJurnal('TRX008/2025')"><i class="fas fa-print me-2"></i>Cetak Jurnal</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item" href="#" onclick="editTransaksi('TRX008/2025')"><i class="fas fa-edit me-2"></i>Edit</a></li>
                                                <li><a class="dropdown-item text-danger" href="#" onclick="hapusTransaksi('TRX008/2025')"><i class="fas fa-trash me-2"></i>Hapus</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Real-time clock functionality - EXACT MATCH WITH LAPORAN
function updateClock() {
    const now = new Date();
    const clock = document.getElementById('realTimeClock');
    const dateElement = document.getElementById('currentDate');
    
    if (clock) {
        const timeString = now.toLocaleTimeString('id-ID', {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });
        clock.textContent = timeString;
    }
    
    if (dateElement) {
        const dateString = now.toLocaleDateString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
        dateElement.textContent = dateString;
    }
}

// Update clock immediately and then every second
updateClock();
setInterval(updateClock, 1000);

// Reset form function
function resetForm() {
    document.getElementById('search').value = '';
    document.getElementById('periode').selectedIndex = 0;
    document.getElementById('jenis').selectedIndex = 0;
    document.getElementById('metode').selectedIndex = 0;
}

// Function to generate initials from transaction name
function generateInitials(transactionName) {
    return transactionName
        .split(' ')
        .map(word => word.charAt(0).toUpperCase())
        .join('');
}

// Function to update all avatars automatically
function updateAvatarsAutomatically() {
    // Get all transaction names and their corresponding avatars
    const transactionRows = document.querySelectorAll('tbody tr');
    
    transactionRows.forEach(row => {
        const transactionNameElement = row.querySelector('strong');
        const avatarElement = row.querySelector('.avatar-fallback');
        
        if (transactionNameElement && avatarElement) {
            const transactionName = transactionNameElement.textContent.trim();
            const initials = generateInitials(transactionName);
            avatarElement.textContent = initials;
        }
    });
}

// Call the function when page loads
document.addEventListener('DOMContentLoaded', function() {
    updateAvatarsAutomatically();
});

// Dropdown Action Functions
function lihatDetail(noTransaksi) {
    // Show loading toast
    showToast('Loading...', 'info');
    
    // Simulate detail view action
    setTimeout(() => {
        showToast(`Menampilkan detail transaksi ${noTransaksi}`, 'success');
        
        // Here you would typically open a modal or redirect to detail page
        console.log('Lihat Detail:', noTransaksi);
    }, 500);
}

function cetakJurnal(noTransaksi) {
    showToast('Memproses cetak jurnal...', 'info');
    
    // Simulate print action
    setTimeout(() => {
        showToast(`Jurnal transaksi ${noTransaksi} berhasil dicetak`, 'success');
        
        // Here you would typically open print dialog or generate PDF
        console.log('Cetak Jurnal:', noTransaksi);
    }, 1000);
}

function editTransaksi(noTransaksi) {
    showToast('Membuka form edit...', 'info');
    
    // Simulate edit action
    setTimeout(() => {
        showToast(`Mengedit transaksi ${noTransaksi}`, 'success');
        
        // Here you would typically redirect to edit form or open modal
        console.log('Edit Transaksi:', noTransaksi);
    }, 500);
}

function hapusTransaksi(noTransaksi) {
    // Show confirmation dialog
    if (confirm(`Apakah Anda yakin ingin menghapus transaksi ${noTransaksi}?\n\nTindakan ini tidak dapat dibatalkan.`)) {
        showToast('Menghapus transaksi...', 'info');
        
        // Simulate delete action
        setTimeout(() => {
            showToast(`Transaksi ${noTransaksi} berhasil dihapus`, 'success');
            
            // Here you would typically send delete request to server
            console.log('Hapus Transaksi:', noTransaksi);
        }, 1000);
    }
}

// Toast notification function
function showToast(message, type = 'success') {
    // Remove existing toasts
    const existingToasts = document.querySelectorAll('.toast-notification');
    existingToasts.forEach(toast => toast.remove());
    
    // Create toast element
    const toast = document.createElement('div');
    toast.className = `toast-notification toast-${type}`;
    
    const icon = type === 'success' ? 'fa-check-circle' : 
                 type === 'error' ? 'fa-exclamation-circle' : 
                 type === 'info' ? 'fa-info-circle' : 'fa-check-circle';
    
    toast.innerHTML = `
        <i class="fas ${icon}"></i>
        <span>${message}</span>
    `;
    
    // Add CSS styles
    toast.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : '#3b82f6'};
        color: white;
        padding: 12px 16px;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        z-index: 9999;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        font-weight: 500;
        animation: slideIn 0.3s ease;
    `;
    
    // Add animation styles to head if not exists
    if (!document.querySelector('#toast-styles')) {
        const style = document.createElement('style');
        style.id = 'toast-styles';
        style.textContent = `
            @keyframes slideIn {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            @keyframes slideOut {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(100%);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    }
    
    // Add to document
    document.body.appendChild(toast);
    
    // Auto remove after 3 seconds
    setTimeout(() => {
        toast.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}
</script>

@endsection
