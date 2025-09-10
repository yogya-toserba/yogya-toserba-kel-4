@extends('layouts.navbar_admin')

@section('title', 'Laporan Gaji - MyYOGYA Admin')

@section('content')
<style>
/* GLOBAL OVERRIDE - FORCE EXACT DASHBOARD LAYOUT */
* {
    box-sizing: border-box !important;
}

/* RESET ALL CONFLICTS - EXACT MATCH WITH DASHBOARD */
.main-content {
    margin-left: 250px !important;
    padding: 25px 35px !important;
    background: #f8fafc !important;
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

/* DISABLE ALL BOOTSTRAP INTERFERENCE */
.container,
.container-fluid,
.container-sm,
.container-md,
.container-lg,
.container-xl,
.container-xxl {
    padding: 0 !important;
    margin: 0 !important;
    max-width: 100% !important;
    width: 100% !important;
}

/* RESET BOOTSTRAP GRID SYSTEM */
.row {
    margin-left: 0 !important;
    margin-right: 0 !important;
}

.row > * {
    padding-left: 12px !important;
    padding-right: 12px !important;
}

/* Dark Mode Support */
body.dark-mode .main-content {
    background: #1a1d29 !important;
}

/* FORCE NEW DASHBOARD STYLES - EXACT COPY */
.new-laporan-gaji {
    background: #f8fafc !important;
    min-height: 100vh !important;
    padding: 0 !important;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
    overflow-x: hidden !important;
    width: 100% !important;
    margin: 0 !important;
}

body.dark-mode .new-laporan-gaji {
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

/* Real-time clock styling (same as dashboard) */
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

/* Stats Cards */
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
    transform: translateY(-2px) !important;
    box-shadow: 0 8px 25px rgba(242, 107, 55, 0.15) !important;
}

.new-stat-icon {
    background: linear-gradient(135deg, #f26b37, #e55827) !important;
    color: white !important;
    border-radius: 15px !important;
    width: 55px !important;
    height: 55px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 20px !important;
    margin-bottom: 15px !important;
    box-shadow: 0 4px 12px rgba(242, 107, 55, 0.3) !important;
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

.new-stat-change {
    font-size: 0.75rem !important;
    font-weight: 600 !important;
    margin-top: 8px !important;
    padding: 4px 8px !important;
    border-radius: 12px !important;
}

.change-positive {
    background: #dcfce7 !important;
    color: #15803d !important;
}

.change-neutral {
    background: #e0f2fe !important;
    color: #0277bd !important;
}

.change-warning {
    background: #fef3c7 !important;
    color: #d97706 !important;
}

/* Cards */
.new-card {
    background: white !important;
    border-radius: 15px !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
    border: 1px solid #e2e8f0 !important;
    overflow: hidden !important;
    transition: all 0.3s ease !important;
}

body.dark-mode .new-card {
    background: #2a2d3f !important;
    border-color: #3a3d4a !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3) !important;
}

.new-card:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
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
    background: linear-gradient(135deg, #374151 0%, #4b5563 100%) !important;
    border-bottom-color: #3a3d4a !important;
}

.new-card-title {
    font-size: 1.1rem !important;
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

.new-card-body {
    padding: 25px !important;
}

/* Search and Filter */
.search-filter-bar {
    background: white !important;
    padding: 20px !important;
    border-radius: 15px !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
    border: 1px solid #e2e8f0 !important;
    margin-bottom: 25px !important;
}

body.dark-mode .search-filter-bar {
    background: #2a2d3f !important;
    border-color: #3a3d4a !important;
}

/* Form Controls */
.form-control {
    border: 1px solid #e2e8f0 !important;
    border-radius: 10px !important;
    padding: 8px 12px !important;
    background: white !important;
    color: #1e293b !important;
    font-size: 0.9rem !important;
    transition: all 0.3s ease !important;
}

.form-control:focus {
    border-color: #f26b37 !important;
    box-shadow: 0 0 0 3px rgba(242, 107, 55, 0.1) !important;
    background: white !important;
}

body.dark-mode .form-control {
    background: #374151 !important;
    border-color: #4b5563 !important;
    color: #e2e8f0 !important;
}

body.dark-mode .form-control:focus {
    background: #374151 !important;
    border-color: #f26b37 !important;
    color: #e2e8f0 !important;
    box-shadow: 0 0 0 3px rgba(242, 107, 55, 0.2) !important;
}

.form-select {
    border: 1px solid #e2e8f0 !important;
    border-radius: 10px !important;
    padding: 8px 12px !important;
    background: white !important;
    color: #1e293b !important;
    font-size: 0.9rem !important;
}

body.dark-mode .form-select {
    background: #374151 !important;
    border-color: #4b5563 !important;
    color: #e2e8f0 !important;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e") !important;
}

body.dark-mode .form-select option {
    background: #374151 !important;
    color: #e2e8f0 !important;
}

/* Buttons */
.btn-primary {
    background: linear-gradient(135deg, #f26b37, #e55827) !important;
    border: none !important;
    color: white !important;
    font-weight: 500 !important;
    padding: 8px 16px !important;
    border-radius: 10px !important;
    transition: all 0.3s ease !important;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #e55827, #d44a1a) !important;
    transform: translateY(-1px) !important;
}

.btn-success {
    background: linear-gradient(135deg, #10b981, #059669) !important;
    border: none !important;
    color: white !important;
    font-weight: 500 !important;
    padding: 8px 16px !important;
    border-radius: 10px !important;
    transition: all 0.3s ease !important;
}

.btn-success:hover {
    background: linear-gradient(135deg, #059669, #047857) !important;
    transform: translateY(-1px) !important;
}

/* Table Styling */
.table-responsive {
    border-radius: 8px !important;
    background: white !important;
    overflow-x: auto !important;
    max-width: 100% !important;
    width: 100% !important;
}

.table-responsive .table {
    table-layout: auto !important;
    width: 100% !important;
    margin-bottom: 0 !important;
}

.table-responsive .table td,
.table-responsive .table th {
    word-wrap: break-word !important;
    padding: 12px 8px !important;
    vertical-align: middle !important;
    font-size: 0.85rem !important;
}

/* Better table borders */
.table-responsive .table tbody tr {
    border-bottom: 1px solid #f1f5f9 !important;
}

.table-responsive .table tbody tr:hover {
    background-color: #f8fafc !important;
}

.table th {
    border-bottom: 2px solid #e2e8f0 !important;
    font-weight: 600 !important;
    font-size: 0.8rem !important;
    color: #64748b !important;
}

.table td {
    border-bottom: 1px solid #e2e8f0 !important;
    vertical-align: middle !important;
}

body.dark-mode .table-responsive {
    background: #2a2d3f !important;
}

body.dark-mode .table {
    background: #2a2d3f !important;
    color: #e2e8f0 !important;
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

body.dark-mode .table tbody tr:hover {
    background: #3a3d4a !important;
}

/* Chart Container */
.chart-container {
    position: relative;
    height: 400px;
    width: 100%;
}

/* Responsive adjustments */
@media (max-width: 1200px) {
    .main-content {
        margin-left: 0 !important;
        width: 100% !important;
        padding: 20px 15px !important;
    }
}

@media (max-width: 768px) {
    .main-content {
        padding: 15px 10px !important;
    }
    
    .new-header {
        padding: 25px 20px !important;
        text-align: center !important;
    }
    
    .new-stat-card {
        margin-bottom: 20px !important;
    }
    
    .new-card-header {
        padding: 15px 20px !important;
    }
    
    .new-card-body {
        padding: 20px !important;
    }
}

/* Badge styles for currency */
.currency-badge {
    background: #dbeafe !important;
    color: #1d4ed8 !important;
    font-weight: 600 !important;
    padding: 4px 8px !important;
    border-radius: 12px !important;
    font-size: 0.75rem !important;
    display: inline-block !important;
}

.currency-large {
    font-size: 0.85rem !important;
    padding: 6px 10px !important;
}

body.dark-mode .currency-badge {
    background: #1e3a8a !important;
    color: #bfdbfe !important;
}
</style>

<div class="new-laporan-gaji">
    <!-- Header Section -->
    <div class="new-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h1><i class="fas fa-chart-line me-3"></i>Laporan Gaji</h1>
                <p>Analisis lengkap dan detail penggajian karyawan MyYOGYA</p>
            </div>
            <div style="text-align: right;">
                <div id="realTimeClock" style="font-weight: 600; color: white; font-size: 1rem; margin-bottom: 5px;"></div>
                <small id="currentDate" style="opacity: 0.8;"></small>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="search-filter-bar">
        <form method="GET" action="{{ route('admin.laporan.gaji') }}">
            <div class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label">Bulan</label>
                    <select name="bulan" class="form-select">
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tahun</label>
                    <select name="tahun" class="form-select">
                        @for ($i = date('Y') - 2; $i <= date('Y') + 1; $i++)
                            <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Jabatan</label>
                    <select name="jabatan_id" class="form-select">
                        <option value="">Semua Jabatan</option>
                        @foreach ($jabatanList as $jabatan)
                            <option value="{{ $jabatan->id }}" {{ $jabatan_id == $jabatan->id ? 'selected' : '' }}>
                                {{ $jabatan->nama_jabatan }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-filter me-2"></i>Filter
                    </button>
                </div>
                <div class="col-md-1">
                    <a href="{{ route('admin.laporan.export', ['type' => 'gaji', 'bulan' => $bulan, 'tahun' => $tahun]) }}" 
                       class="btn btn-success w-100" title="Export CSV">
                        <i class="fas fa-download"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-5">
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="new-stat-number">{{ $stats['total_karyawan'] }}</div>
                <div class="new-stat-label">Total Karyawan</div>
                <div class="new-stat-change change-positive">
                    <i class="fas fa-user-check"></i> Aktif
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="new-stat-card">
                <div class="new-stat-icon" style="background: linear-gradient(135deg, #10b981, #059669) !important;">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="new-stat-number" style="font-size: 1.8rem;">{{ number_format($stats['total_gaji'], 0, ',', '.') }}</div>
                <div class="new-stat-label">Total Gaji (Rp)</div>
                <div class="new-stat-change change-positive">
                    <i class="fas fa-arrow-up"></i> Periode Ini
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="new-stat-card">
                <div class="new-stat-icon" style="background: linear-gradient(135deg, #f59e0b, #d97706) !important;">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <div class="new-stat-number" style="font-size: 1.5rem;">{{ number_format($stats['rata_rata'], 0, ',', '.') }}</div>
                <div class="new-stat-label">Rata-rata (Rp)</div>
                <div class="new-stat-change change-neutral">
                    <i class="fas fa-equals"></i> Normal
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed) !important;">
                    <i class="fas fa-arrow-up"></i>
                </div>
                <div class="new-stat-number" style="font-size: 1.4rem;">{{ number_format($stats['tertinggi'], 0, ',', '.') }}</div>
                <div class="new-stat-label">Tertinggi (Rp)</div>
                <div class="new-stat-change change-positive">
                    <i class="fas fa-crown"></i> Max
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon" style="background: linear-gradient(135deg, #ef4444, #dc2626) !important;">
                    <i class="fas fa-arrow-down"></i>
                </div>
                <div class="new-stat-number" style="font-size: 1.4rem;">{{ number_format($stats['terendah'], 0, ',', '.') }}</div>
                <div class="new-stat-label">Terendah (Rp)</div>
                <div class="new-stat-change change-warning">
                    <i class="fas fa-exclamation-triangle"></i> Min
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="new-card mb-4">
        <div class="new-card-header">
            <div class="new-card-title">
                <i class="fas fa-chart-pie"></i>
                Distribusi Gaji per Jabatan
            </div>
        </div>
        <div class="new-card-body">
            <div class="chart-container">
                <canvas id="gajiChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Tables Section -->
    <div class="row g-4">
        <!-- Detail Gaji Table -->
        <div class="col-12">
            <div class="new-card">
                <div class="new-card-header">
                    <div class="new-card-title">
                        <i class="fas fa-table"></i>
                        Detail Gaji Karyawan
                    </div>
                </div>
                <div class="new-card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead style="background: white;">
                                <tr>
                                    <th style="width: 20%;">Nama Karyawan</th>
                                    <th style="width: 15%;">Jabatan</th>
                                    <th style="width: 10%;">Periode</th>
                                    <th style="width: 13%;">Gaji Pokok</th>
                                    <th style="width: 12%;">Tunjangan</th>
                                    <th style="width: 10%;">Bonus</th>
                                    <th style="width: 10%;">Potongan</th>
                                    <th style="width: 15%;">Total Gaji</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($gajiList as $gaji)
                                <tr>
                                    <td>
                                        <strong style="color: #1e293b;">{{ $gaji->karyawan->nama ?? 'N/A' }}</strong>
                                    </td>
                                    <td>
                                        <span class="currency-badge">{{ $gaji->karyawan->jabatan->nama_jabatan ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <small style="color: #64748b;">{{ $gaji->periode_gaji }}</small>
                                    </td>
                                    <td>
                                        <strong style="color: #059669;">Rp {{ number_format($gaji->gaji_pokok, 0, ',', '.') }}</strong>
                                    </td>
                                    <td>
                                        <strong style="color: #2563eb;">Rp {{ number_format($gaji->tunjangan, 0, ',', '.') }}</strong>
                                    </td>
                                    <td>
                                        <strong style="color: #d97706;">Rp {{ number_format($gaji->bonus, 0, ',', '.') }}</strong>
                                    </td>
                                    <td>
                                        <strong style="color: #dc2626;">Rp {{ number_format($gaji->potongan, 0, ',', '.') }}</strong>
                                    </td>
                                    <td>
                                        <span class="currency-badge currency-large">Rp {{ number_format($gaji->jumlah_gaji, 0, ',', '.') }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" style="text-align: center; padding: 40px; color: #64748b;">
                                        <i class="fas fa-chart-line fa-2x mb-3" style="opacity: 0.3;"></i>
                                        <br>
                                        Tidak ada data gaji untuk periode ini
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ringkasan per Jabatan Table -->
        <div class="col-12">
            <div class="new-card">
                <div class="new-card-header">
                    <div class="new-card-title">
                        <i class="fas fa-users-cog"></i>
                        Ringkasan Gaji per Jabatan
                    </div>
                </div>
                <div class="new-card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead style="background: white;">
                                <tr>
                                    <th style="width: 30%;">Jabatan</th>
                                    <th style="width: 20%;">Jumlah Karyawan</th>
                                    <th style="width: 25%;">Total Gaji</th>
                                    <th style="width: 25%;">Rata-rata</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($laporanJabatan as $laporan)
                                <tr>
                                    <td>
                                        <strong style="color: #1e293b;">{{ $laporan['jabatan'] }}</strong>
                                    </td>
                                    <td>
                                        <span class="currency-badge">{{ $laporan['jumlah_karyawan'] }} orang</span>
                                    </td>
                                    <td>
                                        <strong style="color: #059669;">Rp {{ number_format($laporan['total_gaji'], 0, ',', '.') }}</strong>
                                    </td>
                                    <td>
                                        <strong style="color: #2563eb;">Rp {{ number_format($laporan['rata_rata'], 0, ',', '.') }}</strong>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" style="text-align: center; padding: 40px; color: #64748b;">
                                        <i class="fas fa-briefcase fa-2x mb-3" style="opacity: 0.3;"></i>
                                        <br>
                                        Tidak ada data jabatan
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
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Real-time clock function (same as dashboard)
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
    
    // Update clock
    const clockElement = document.getElementById('realTimeClock');
    if (clockElement) {
        clockElement.textContent = timeString + ' WIB';
    }
    
    // Update date
    const dateElement = document.getElementById('currentDate');
    if (dateElement) {
        const dateOptions = { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric',
            timeZone: 'Asia/Jakarta'
        };
        const dateString = now.toLocaleDateString('id-ID', dateOptions);
        dateElement.textContent = dateString;
    }
}

// Initialize clock
document.addEventListener('DOMContentLoaded', function() {
    // Update clock immediately and then every second
    updateRealTimeClock();
    setInterval(updateRealTimeClock, 1000);
    
    // Initialize chart
    initializeChart();
});

// Chart Gaji per Jabatan
function initializeChart() {
    const ctx = document.getElementById('gajiChart');
    if (!ctx) return;
    
    const gajiChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [
                @foreach ($laporanJabatan as $laporan)
                    '{{ $laporan['jabatan'] }}',
                @endforeach
            ],
            datasets: [{
                data: [
                    @foreach ($laporanJabatan as $laporan)
                        {{ $laporan['total_gaji'] }},
                    @endforeach
                ],
                backgroundColor: [
                    'rgba(242, 107, 55, 0.8)',
                    'rgba(16, 185, 129, 0.8)',
                    'rgba(245, 158, 11, 0.8)',
                    'rgba(139, 92, 246, 0.8)',
                    'rgba(239, 68, 68, 0.8)',
                    'rgba(59, 130, 246, 0.8)',
                    'rgba(168, 85, 247, 0.8)',
                    'rgba(34, 197, 94, 0.8)'
                ],
                borderColor: [
                    'rgba(242, 107, 55, 1)',
                    'rgba(16, 185, 129, 1)',
                    'rgba(245, 158, 11, 1)',
                    'rgba(139, 92, 246, 1)',
                    'rgba(239, 68, 68, 1)',
                    'rgba(59, 130, 246, 1)',
                    'rgba(168, 85, 247, 1)',
                    'rgba(34, 197, 94, 1)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                        font: {
                            size: 12
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const value = context.parsed;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((value / total) * 100).toFixed(1);
                            return context.label + ': Rp ' + value.toLocaleString('id-ID') + ' (' + percentage + '%)';
                        }
                    },
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: 'white',
                    bodyColor: 'white',
                    borderColor: '#f26b37',
                    borderWidth: 1
                }
            },
            animation: {
                animateRotate: true,
                duration: 1000
            }
        }
    });
}
</script>
@endsection
