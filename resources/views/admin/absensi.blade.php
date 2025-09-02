@extends('layouts.navbar_admin')

@section('title', 'Manajemen Absensi - MyYOGYA')

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

/* Dark Mode Support */
body.dark-mode .main-content {
    background: #1a1d29 !important;
}

/* FORCE NEW DASHBOARD STYLES */
.new-absensi {
    background: #f8fafc !important;
    min-height: 100vh !important;
    padding: 0 !important;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
    overflow-x: hidden !important;
    width: 100% !important;
}

body.dark-mode .new-absensi {
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

.new-stats {
    margin-bottom: 30px !important;
}

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

body.dark-mode .new-stat-card {
    background: #2a2d3f !important;
    border-color: #3a3d4a !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3) !important;
}

.new-stat-card:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
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
    margin-bottom: 15px !important;
    box-shadow: 0 4px 12px rgba(242, 107, 55, 0.3) !important;
    margin: 0 auto 15px auto !important;
    color: white !important;
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
    display: inline-block !important;
    text-align: center !important;
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

.change-danger {
    background: #fee2e2 !important;
    color: #dc2626 !important;
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
    padding: 25px !important;
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
    transition: all 0.2s ease !important;
}

#realTimeClock:hover {
    background: rgba(255, 255, 255, 0.25) !important;
    transform: translateY(-1px) !important;
}

/* Responsive styling for header */
@media (max-width: 992px) {
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

/* Search and Filter */
.search-filter-bar {
    background: white !important;
    padding: 25px !important;
    border-radius: 15px !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
    margin-bottom: 30px !important;
    border: 1px solid #e2e8f0 !important;
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
    box-shadow: 0 0 0 3px rgba(242, 107, 55, 0.2) !important;
}

.form-label {
    color: #374151 !important;
    font-weight: 500 !important;
    font-size: 0.85rem !important;
    margin-bottom: 5px !important;
}

body.dark-mode .form-label {
    color: #e2e8f0 !important;
}

/* Table Styles */
.table {
    border-collapse: separate !important;
    border-spacing: 0 !important;
    background: white !important;
    color: #1e293b !important;
    margin: 0 !important;
}

body.dark-mode .table {
    background: #2a2d3f !important;
    color: #e2e8f0 !important;
}

.table thead {
    background: #f8fafc !important;
    border-radius: 10px !important;
}

body.dark-mode .table thead {
    background: #1f2937 !important;
}

.table thead th {
    border: none !important;
    padding: 15px 12px !important;
    font-size: 0.8rem !important;
    font-weight: 600 !important;
    color: #64748b !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    background: #f8fafc !important;
}

body.dark-mode .table thead th {
    color: #94a3b8 !important;
    background: #1f2937 !important;
}

.table tbody tr {
    border: none !important;
    transition: all 0.2s ease !important;
    background: white !important;
}

body.dark-mode .table tbody tr {
    background: #2a2d3f !important;
}

.table tbody tr:hover {
    background: #f8fafc !important;
}

body.dark-mode .table tbody tr:hover {
    background: #374151 !important;
}

.table tbody td {
    border: none !important;
    padding: 15px 12px !important;
    font-size: 0.85rem !important;
    color: #1e293b !important;
    border-bottom: 1px solid #f1f5f9 !important;
    background: inherit !important;
}

body.dark-mode .table tbody td {
    color: #e2e8f0 !important;
    border-bottom-color: #374151 !important;
}

.table tbody td strong {
    color: #1e293b !important;
}

body.dark-mode .table tbody td strong {
    color: #e2e8f0 !important;
}

.table tbody td small {
    color: #64748b !important;
}

body.dark-mode .table tbody td small {
    color: #94a3b8 !important;
}

/* Force override any Bootstrap table styles */
.new-card-body .table-responsive {
    background: transparent !important;
}

.new-card-body .table-responsive .table {
    margin-bottom: 0 !important;
}

body.dark-mode .new-card-body .table-responsive .table {
    background: #2a2d3f !important;
}
</style>

<div class="new-absensi">
    <!-- Header Section -->
    <div class="new-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h1><i class="fas fa-clock me-3"></i>Manajemen Absensi</h1>
                <p>Kelola absensi karyawan MyYOGYA dengan mudah</p>
            </div>
            <div style="text-align: right;">
                <div id="realTimeClock" style="font-weight: 600; color: white; font-size: 1rem; margin-bottom: 5px;"></div>
                <small id="currentDate" style="opacity: 0.8;"></small>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-5">
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="new-stat-number">245</div>
                <div class="new-stat-label">Hadir</div>
                <div class="new-stat-change change-positive">
                    <i class="fas fa-check"></i> Hari Ini
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="new-stat-number">12</div>
                <div class="new-stat-label">Terlambat</div>
                <div class="new-stat-change change-warning">
                    <i class="fas fa-exclamation-triangle"></i> Peringatan
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-file-medical"></i>
                </div>
                <div class="new-stat-number">8</div>
                <div class="new-stat-label">Izin</div>
                <div class="new-stat-change change-neutral">
                    <i class="fas fa-info-circle"></i> Disetujui
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-user-times"></i>
                </div>
                <div class="new-stat-number">3</div>
                <div class="new-stat-label">Alpha</div>
                <div class="new-stat-change change-danger">
                    <i class="fas fa-times"></i> Tidak Hadir
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter Bar -->
    <div class="search-filter-bar">
        <div class="row g-3 align-items-center">
            <div class="col-md-3">
                <label class="form-label">Tanggal</label>
                <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Cabang</label>
                <select class="form-control">
                    <option>Semua Cabang</option>
                    <option>Yogyakarta Pusat</option>
                    <option>Solo</option>
                    <option>Semarang</option>
                    <option>Magelang</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Status</label>
                <select class="form-control">
                    <option>Semua Status</option>
                    <option>Hadir</option>
                    <option>Terlambat</option>
                    <option>Izin</option>
                    <option>Alpha</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">&nbsp;</label>
                <button class="btn btn-primary w-100" style="background: linear-gradient(135deg, #f26b37 0%, #e55827 100%); border: none; padding: 8px;">
                    <i class="fas fa-search me-2"></i>Filter
                </button>
            </div>
        </div>
    </div>

    <!-- Absensi Table -->
    <div class="new-card">
        <div class="new-card-header">
            <div class="new-card-title">
                <i class="fas fa-table"></i>
                Daftar Absensi Karyawan
            </div>
        </div>
        <div class="new-card-body">
            <div class="table-responsive">
                <table class="table table-sm table-fixed">
                    <thead>
                        <tr>
                            <th>Karyawan</th>
                            <th>Cabang</th>
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>
                            <th>Total Kerja</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div style="width: 35px; height: 35px; background: linear-gradient(135deg, #f26b37 0%, #e55827 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; margin-right: 10px;">AS</div>
                                    <div>
                                        <strong>Andi Setiawan</strong>
                                        <br><small>ID: EMP001</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <strong>Yogyakarta Pusat</strong>
                                <br><small>Kasir</small>
                            </td>
                            <td>
                                <span class="badge" style="background: #dcfce7; color: #15803d; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">08:00</span>
                            </td>
                            <td>
                                <span class="badge" style="background: #dcfce7; color: #15803d; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">17:00</span>
                            </td>
                            <td>
                                <strong style="color: #15803d;">9 jam</strong>
                            </td>
                            <td>
                                <span class="badge" style="background: #dcfce7; color: #15803d; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">Hadir</span>
                            </td>
                            <td>
                                <small>Tepat waktu</small>
                            </td>
                            <td style="text-align: center;">
                                <button class="btn btn-sm" style="background: none; border: none; color: #64748b; padding: 4px;">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div style="width: 35px; height: 35px; background: linear-gradient(135deg, #f26b37 0%, #e55827 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; margin-right: 10px;">SW</div>
                                    <div>
                                        <strong>Sari Wulandari</strong>
                                        <br><small>ID: EMP002</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <strong>Solo</strong>
                                <br><small>Admin</small>
                            </td>
                            <td>
                                <span class="badge" style="background: #fef3c7; color: #d97706; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">08:15</span>
                            </td>
                            <td>
                                <span class="badge" style="background: #dcfce7; color: #15803d; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">17:05</span>
                            </td>
                            <td>
                                <strong style="color: #15803d;">8.8 jam</strong>
                            </td>
                            <td>
                                <span class="badge" style="background: #fef3c7; color: #d97706; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">Terlambat</span>
                            </td>
                            <td>
                                <small>Terlambat 15 menit</small>
                            </td>
                            <td style="text-align: center;">
                                <button class="btn btn-sm" style="background: none; border: none; color: #64748b; padding: 4px;">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Additional Tables Row -->
    <div class="row g-4 mt-4">
        <!-- Rekap Absensi Bulanan -->
        <div class="col-lg-6">
            <div class="new-card">
                <div class="new-card-header">
                    <div class="new-card-title">
                        <i class="fas fa-chart-bar"></i>
                        Rekap Absensi Bulanan
                    </div>
                </div>
                <div class="new-card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-fixed">
                            <thead>
                                <tr>
                                    <th>Bulan</th>
                                    <th>Total Hadir</th>
                                    <th>Terlambat</th>
                                    <th>Alpha</th>
                                    <th>Persentase</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <strong id="currentMonthName">Loading...</strong>
                                        <br><small>Bulan Ini</small>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #dcfce7; color: #15803d; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">245</span>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #fef3c7; color: #d97706; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">12</span>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #fee2e2; color: #dc2626; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">3</span>
                                    </td>
                                    <td>
                                        <strong style="color: #15803d;">94.2%</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong id="previousMonthName">Loading...</strong>
                                        <br><small>Bulan Lalu</small>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #dcfce7; color: #15803d; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">720</span>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #fef3c7; color: #d97706; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">35</span>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #fee2e2; color: #dc2626; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">8</span>
                                    </td>
                                    <td>
                                        <strong style="color: #15803d;">94.4%</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong id="twoMonthsAgoName">Loading...</strong>
                                        <br><small>2 Bulan Lalu</small>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #dcfce7; color: #15803d; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">698</span>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #fef3c7; color: #d97706; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">42</span>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #fee2e2; color: #dc2626; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">15</span>
                                    </td>
                                    <td>
                                        <strong style="color: #d97706;">92.4%</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Karyawan Terlambat Hari Ini -->
        <div class="col-lg-6">
            <div class="new-card">
                <div class="new-card-header">
                    <div class="new-card-title">
                        <i class="fas fa-exclamation-triangle"></i>
                        Karyawan Terlambat Hari Ini
                    </div>
                </div>
                <div class="new-card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-fixed">
                            <thead>
                                <tr>
                                    <th>Karyawan</th>
                                    <th>Cabang</th>
                                    <th>Jam Masuk</th>
                                    <th>Terlambat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #f26b37 0%, #e55827 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; margin-right: 8px; font-size: 0.7rem;">SW</div>
                                            <div>
                                                <strong>Sari Wulandari</strong>
                                                <br><small>ID: EMP002</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <strong>Solo</strong>
                                        <br><small>Admin</small>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #fef3c7; color: #d97706; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">08:15</span>
                                    </td>
                                    <td>
                                        <strong style="color: #d97706;">15 menit</strong>
                                    </td>
                                    <td style="text-align: center;">
                                        <button class="btn btn-sm" style="background: none; border: none; color: #64748b; padding: 2px;">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #f26b37 0%, #e55827 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; margin-right: 8px; font-size: 0.7rem;">RP</div>
                                            <div>
                                                <strong>Rian Pratama</strong>
                                                <br><small>ID: EMP005</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <strong>Semarang</strong>
                                        <br><small>Security</small>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #fef3c7; color: #d97706; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">08:22</span>
                                    </td>
                                    <td>
                                        <strong style="color: #d97706;">22 menit</strong>
                                    </td>
                                    <td style="text-align: center;">
                                        <button class="btn btn-sm" style="background: none; border: none; color: #64748b; padding: 2px;">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #f26b37 0%, #e55827 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; margin-right: 8px; font-size: 0.7rem;">MF</div>
                                            <div>
                                                <strong>Maya Fitri</strong>
                                                <br><small>ID: EMP008</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <strong>Yogyakarta</strong>
                                        <br><small>Kasir</small>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #fef3c7; color: #d97706; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">08:10</span>
                                    </td>
                                    <td>
                                        <strong style="color: #d97706;">10 menit</strong>
                                    </td>
                                    <td style="text-align: center;">
                                        <button class="btn btn-sm" style="background: none; border: none; color: #64748b; padding: 2px;">
                                            <i class="fas fa-eye"></i>
                                        </button>
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
// Real time clock and date
function updateClock() {
    const now = new Date();
    
    // Update clock
    const timeString = now.toLocaleTimeString('id-ID', {
        hour12: false,
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        timeZone: 'Asia/Jakarta'
    });
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
    
    // Update current month name
    const currentMonthElement = document.getElementById('currentMonthName');
    if (currentMonthElement) {
        const monthOptions = { 
            month: 'long',
            year: 'numeric',
            timeZone: 'Asia/Jakarta'
        };
        const monthString = now.toLocaleDateString('id-ID', monthOptions);
        currentMonthElement.textContent = monthString;
    }
    
    // Update previous month name
    const previousMonthElement = document.getElementById('previousMonthName');
    if (previousMonthElement) {
        const prevMonth = new Date(now.getFullYear(), now.getMonth() - 1, 1);
        const prevMonthOptions = { 
            month: 'long',
            year: 'numeric',
            timeZone: 'Asia/Jakarta'
        };
        const prevMonthString = prevMonth.toLocaleDateString('id-ID', prevMonthOptions);
        previousMonthElement.textContent = prevMonthString;
    }
    
    // Update two months ago name
    const twoMonthsAgoElement = document.getElementById('twoMonthsAgoName');
    if (twoMonthsAgoElement) {
        const twoMonthsAgo = new Date(now.getFullYear(), now.getMonth() - 2, 1);
        const twoMonthsAgoOptions = { 
            month: 'long',
            year: 'numeric',
            timeZone: 'Asia/Jakarta'
        };
        const twoMonthsAgoString = twoMonthsAgo.toLocaleDateString('id-ID', twoMonthsAgoOptions);
        twoMonthsAgoElement.textContent = twoMonthsAgoString;
    }
}

// Update clock every second
setInterval(updateClock, 1000);
updateClock(); // Initial call
</script>

@endsection
