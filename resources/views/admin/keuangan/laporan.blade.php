@extends('layouts.navbar_admin')

@section('title', 'Laporan Keuangan - MyYOGYA')

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
    transition: all 0.3s ease !important;
    box-shadow: 0 4px 15px rgba(242, 107, 55, 0.3) !important;
    height: 38px !important;
    min-width: 80px !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 6px !important;
    font-size: 0.9rem !important;
}

.search-btn:hover {
    transform: translateY(-1px) !important;
    box-shadow: 0 6px 20px rgba(242, 107, 55, 0.4) !important;
    color: white !important;
}

/* Reset button styling to match search button */
.btn-outline-secondary {
    border: 2px solid #6c757d !important;
    background: transparent !important;
    color: #6c757d !important;
    padding: 8px 16px !important;
    border-radius: 8px !important;
    font-weight: 600 !important;
    transition: all 0.3s ease !important;
    height: 38px !important;
    min-width: 80px !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 6px !important;
    font-size: 0.9rem !important;
}

.btn-outline-secondary:hover {
    background: #6c757d !important;
    color: white !important;
    transform: translateY(-1px) !important;
}

/* TABLE STYLING - EXACT MATCH WITH DATA PENGAWAI GUDANG */
.new-card {
    background: white !important;
    border-radius: 15px !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
    border: 1px solid #e2e8f0 !important;
    margin-bottom: 25px !important;
    overflow: hidden !important;
}

body.dark-mode .new-card {
    background: #2a2d3f !important;
    color: #e2e8f0 !important;
    border-color: #374151 !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3) !important;
}

.new-card-header {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%) !important;
    padding: 20px 25px !important;
    border-bottom: 1px solid #e2e8f0 !important;
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
}

body.dark-mode .new-card-header {
    background: linear-gradient(135deg, #1f2937 0%, #374151 100%) !important;
    border-bottom-color: #4b5563 !important;
}

.new-card-title {
    font-size: 1.25rem !important;
    font-weight: 600 !important;
    color: #1e293b !important;
    margin: 0 !important;
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
}

body.dark-mode .new-card-title {
    color: #e2e8f0 !important;
}

.new-card-title i {
    color: #f26b37 !important;
}

.new-card-body {
    padding: 0 !important;
    background: white !important;
}

body.dark-mode .new-card-body {
    background: #2a2d3f !important;
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
                <h1><i class="fas fa-chart-line me-3"></i>Laporan Keuangan</h1>
                <p>Generator dan Analisis Laporan Keuangan Perusahaan</p>
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
                <div class="new-stat-number">Rp 2.5M</div>
                <div class="new-stat-label">Total Pendapatan</div>
                <div class="new-stat-change change-positive">+12% dari bulan lalu</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-credit-card"></i>
                </div>
                <div class="new-stat-number">Rp 1.8M</div>
                <div class="new-stat-label">Total Pengeluaran</div>
                <div class="new-stat-change change-warning">+5% dari bulan lalu</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <div class="new-stat-number">Rp 700K</div>
                <div class="new-stat-label">Laba Bersih</div>
                <div class="new-stat-change change-positive">+28% dari bulan lalu</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <div class="new-stat-number">248</div>
                <div class="new-stat-label">Total Transaksi</div>
                <div class="new-stat-change change-positive">+18% dari bulan lalu</div>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="search-filter-bar">
        <form method="GET" action="{{ route('admin.keuangan.laporan') }}" id="filterForm">
            <div class="row g-2 align-items-end">
                <div class="col-md-4">
                    <label for="search" class="form-label">Cari Laporan</label>
                    <input type="text" class="form-control" id="search" name="search" 
                           placeholder="Nama transaksi, ID laporan, atau kategori..." 
                           value="{{ $search ?? '' }}">
                </div>
                <div class="col-md-2">
                    <label for="periode" class="form-label">Periode</label>
                    <select class="form-select" id="periode" name="periode">
                        <option value="semua" {{ ($periode ?? '') == 'semua' ? 'selected' : '' }}>Semua Periode</option>
                        @foreach($periodeList as $key => $value)
                            <option value="{{ $key }}" {{ ($periode ?? '') == $key ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="semua" {{ ($status ?? '') == 'semua' ? 'selected' : '' }}>Semua Status</option>
                        @foreach($statusList as $key => $value)
                            <option value="{{ $key }}" {{ ($status ?? '') == $key ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select class="form-select" id="kategori" name="kategori">
                        <option value="semua" {{ ($kategori ?? '') == 'semua' ? 'selected' : '' }}>Semua Kategori</option>
                        @foreach($kategoriList as $cat)
                            <option value="{{ $cat }}" {{ ($kategori ?? '') == $cat ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <div class="d-flex gap-2">
                        <button type="submit" class="search-btn">
                            <i class="fas fa-search"></i> Cari
                        </button>
                        <button type="button" class="btn-outline-secondary" onclick="resetFilters()">
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
                        Generator Laporan Keuangan
                    </div>
                </div>
                <div class="new-card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>LAPORAN</th>
                                    <th>ID TRANSAKSI</th>
                                    <th>KATEGORI</th>
                                    <th>PERIODE</th>
                                    <th>STATUS</th>
                                    <th>NILAI</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($laporan as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-fallback me-3">{{ $item['avatar'] }}</div>
                                                <div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <strong>{{ $item['nama_laporan'] }}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center">
                                                <strong>{{ $item['id'] }}</strong>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center">
                                                <strong>{{ $item['kategori'] }}</strong>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center">
                                                <strong>{{ $item['periode'] }}</strong>
                                            </div>
                                        </td>
                                        <td>
                                            @php
                                                $statusColors = [
                                                    'selesai' => 'background: #dcfce7; color: #15803d;',
                                                    'pending' => 'background: #fee2e2; color: #dc2626;',
                                                    'review' => 'background: #fef3c7; color: #d97706;'
                                                ];
                                                $statusText = [
                                                    'selesai' => 'Selesai',
                                                    'pending' => 'Pending',
                                                    'review' => 'Review'
                                                ];
                                            @endphp
                                            <span class="badge" style="{{ $statusColors[$item['status']] ?? 'background: #e5e7eb; color: #374151;' }} padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">
                                                {{ $statusText[$item['status']] ?? ucfirst($item['status']) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center">
                                                <strong>Rp {{ number_format($item['nilai'], 0, ',', '.') }}</strong>
                                                <small class="
                                                    @if($item['status'] == 'selesai') text-success
                                                    @elseif($item['status'] == 'pending') text-danger
                                                    @elseif($item['status'] == 'review') text-warning
                                                    @else text-info
                                                    @endif
                                                ">{{ $item['deskripsi'] }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn-menu">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-search mb-2" style="font-size: 2rem; opacity: 0.3;"></i>
                                                <p>Tidak ada data laporan yang ditemukan</p>
                                                <small>Coba ubah filter pencarian Anda</small>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-container">
                        <div class="pagination-info">
                            Menampilkan {{ $laporan->count() }} dari {{ $laporan->total() }} laporan keuangan
                            @if(request('search') || request('periode') || request('status') || request('kategori'))
                                dari hasil pencarian/filter
                            @endif
                        </div>
                        <div class="pagination-wrapper">
                            {{ $laporan->appends(request()->query())->links() }}
                        </div>
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
function resetFilters() {
    document.getElementById('search').value = '';
    document.getElementById('periode').value = 'semua';
    document.getElementById('status').value = 'semua';
    document.getElementById('kategori').value = 'semua';
    
    // Submit the form to refresh the page with empty filters
    document.getElementById('filterForm').submit();
}

// Auto-submit form when dropdowns change (for better UX)
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('filterForm');
    const selects = form.querySelectorAll('select');
    
    selects.forEach(function(select) {
        select.addEventListener('change', function() {
            form.submit();
        });
    });
    
    // Submit form on Enter key press in search input
    const searchInput = document.getElementById('search');
    if (searchInput) {
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                form.submit();
            }
        });
    }
});
</script>
@endsection
