@extends('layouts.navbar_admin')

@section('title', 'Data Karyawan - MyYOGYA Admin')

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
.new-karyawan {
    background: #f8fafc !important;
    min-height: 100vh !important;
    padding: 0 !important;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
    overflow-x: hidden !important;
    width: 100% !important;
    margin: 0 !important;
}

body.dark-mode .new-karyawan {
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
    transition: all 0.2s ease !important;
}

#realTimeClock:hover {
    background: rgba(255, 255, 255, 0.25) !important;
    transform: translateY(-1px) !important;
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

/* Table Styling */
.table-responsive {
    border-radius: 8px !important;
    background: white !important;
}

body.dark-mode .table-responsive {
    background: #2a2d3f !important;
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

/* Buttons */
.btn-primary {
    background: linear-gradient(135deg, #f26b37, #e55827) !important;
    border: none !important;
    color: white !important;
    font-weight: 500 !important;
    padding: 8px 16px !important;
    border-radius: 8px !important;
    transition: all 0.3s ease !important;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #e55827, #d44a1a) !important;
    transform: translateY(-1px) !important;
}

.btn-outline-primary {
    border: 2px solid #f26b37 !important;
    color: #f26b37 !important;
    background: transparent !important;
    font-weight: 500 !important;
    padding: 6px 14px !important;
    border-radius: 8px !important;
    transition: all 0.3s ease !important;
}

.btn-outline-primary:hover {
    background: #f26b37 !important;
    color: white !important;
    transform: translateY(-1px) !important;
}

/* Action Buttons */
.btn-action {
    padding: 4px 8px !important;
    font-size: 0.75rem !important;
    border-radius: 6px !important;
    margin: 0 2px !important;
    transition: all 0.2s ease !important;
}

.btn-edit {
    background: #3b82f6 !important;
    color: white !important;
    border: none !important;
}

.btn-edit:hover {
    background: #2563eb !important;
    transform: translateY(-1px) !important;
}

.btn-delete {
    background: #ef4444 !important;
    color: white !important;
    border: none !important;
}

.btn-delete:hover {
    background: #dc2626 !important;
    transform: translateY(-1px) !important;
}

/* Badge Styles */
.badge-active {
    background: #dcfce7 !important;
    color: #15803d !important;
    font-weight: 500 !important;
    padding: 6px 12px !important;
    border-radius: 20px !important;
    font-size: 0.75rem !important;
}

.badge-inactive {
    background: #fee2e2 !important;
    color: #dc2626 !important;
    font-weight: 500 !important;
    padding: 6px 12px !important;
    border-radius: 20px !important;
    font-size: 0.75rem !important;
}

.badge-department {
    background: #dbeafe !important;
    color: #1d4ed8 !important;
    font-weight: 500 !important;
    padding: 4px 10px !important;
    border-radius: 15px !important;
    font-size: 0.7rem !important;
}

/* Grid Layout for responsive */
.row.g-4 {
    margin-bottom: 30px !important;
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
    border: 2px solid #e2e8f0 !important;
    border-radius: 8px !important;
    padding: 8px 12px !important;
    font-size: 0.9rem !important;
    transition: all 0.2s ease !important;
}

.form-control:hover {
    border-color: #cbd5e1 !important;
    transform: none !important;
}

.form-control:focus {
    border-color: #f26b37 !important;
    box-shadow: 0 0 0 0.2rem rgba(242, 107, 55, 0.25) !important;
    transform: none !important;
}

body.dark-mode .form-control {
    background: #374151 !important;
    border-color: #4b5563 !important;
    color: #e2e8f0 !important;
}

body.dark-mode .form-control:hover {
    border-color: #6b7280 !important;
    transform: none !important;
}

body.dark-mode .form-control:focus {
    background: #374151 !important;
    border-color: #f26b37 !important;
    transform: none !important;
}

body.dark-mode .form-control::placeholder {
    color: #9ca3af !important;
}

body.dark-mode .form-select {
    background: #374151 !important;
    border-color: #4b5563 !important;
    color: #e2e8f0 !important;
}

body.dark-mode .form-select option {
    background: #374151 !important;
    color: #e2e8f0 !important;
}

/* Ensure no transform interference on search area */
.search-filter-section * {
    transform: none !important;
}

.search-filter-section .form-control:hover {
    border-color: #cbd5e1 !important;
    transform: none !important;
}

body.dark-mode .search-filter-section .form-control:hover {
    border-color: #6b7280 !important;
    transform: none !important;
}

/* Dropdown Action Button */
.action-dropdown {
    position: relative;
    display: inline-block;
}

.action-dropdown-btn {
    background: #f8fafc !important;
    border: 1px solid #e2e8f0 !important;
    border-radius: 6px !important;
    padding: 6px 8px !important;
    color: #64748b !important;
    font-size: 14px !important;
    cursor: pointer !important;
    transition: all 0.2s ease !important;
    position: relative !important;
    z-index: 10 !important;
}

.action-dropdown-btn:hover {
    background: #f1f5f9 !important;
    border-color: #cbd5e1 !important;
    color: #475569 !important;
}

.action-dropdown-btn:focus {
    outline: none !important;
    box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5) !important;
}

body.dark-mode .action-dropdown-btn {
    background: #374151 !important;
    border-color: #4b5563 !important;
    color: #9ca3af !important;
}

body.dark-mode .action-dropdown-btn:hover {
    background: #4b5563 !important;
    border-color: #6b7280 !important;
    color: #d1d5db !important;
}

.action-dropdown-menu {
    position: absolute;
    top: 100%;
    right: 0;
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    min-width: 120px;
    z-index: 9999 !important;
    display: none;
}

body.dark-mode .action-dropdown-menu {
    background: #374151;
    border-color: #4b5563;
}

.action-dropdown-item {
    display: block;
    padding: 8px 12px;
    color: #374151;
    text-decoration: none;
    font-size: 0.875rem;
    transition: background-color 0.2s ease;
    border: none;
    background: none;
    width: 100%;
    text-align: left;
    cursor: pointer;
}

.action-dropdown-item:hover {
    background: #f8fafc;
    color: #1e293b;
}

body.dark-mode .action-dropdown-item {
    color: #d1d5db;
}

body.dark-mode .action-dropdown-item:hover {
    background: #4b5563;
    color: #f3f4f6;
}

.action-dropdown-item.edit-item {
    color: #2563eb;
}

.action-dropdown-item.delete-item {
    color: #dc2626;
}

.action-dropdown-item.view-item {
    color: #059669;
}

/* Pagination Styles */
.pagination-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;
    padding: 15px 0;
}

.pagination-info {
    font-size: 0.875rem;
    color: #64748b;
}

body.dark-mode .pagination-info {
    color: #9ca3af;
}

.pagination {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
    gap: 4px;
}

.pagination .page-item {
    margin: 0;
}

.pagination .page-link {
    padding: 8px 12px;
    border: 1px solid #e2e8f0;
    background: white;
    color: #64748b;
    text-decoration: none;
    border-radius: 6px;
    font-size: 0.875rem;
    transition: all 0.2s ease;
}

.pagination .page-link:hover {
    background: #f8fafc;
    border-color: #cbd5e1;
    color: #1e293b;
}

.pagination .page-item.active .page-link {
    background: #f26b37;
    border-color: #f26b37;
    color: white;
}

body.dark-mode .pagination .page-link {
    background: #374151;
    border-color: #4b5563;
    color: #9ca3af;
}

body.dark-mode .pagination .page-link:hover {
    background: #4b5563;
    border-color: #6b7280;
    color: #d1d5db;
}

/* Equal height for bottom tables */
.equal-height-cards {
    display: flex;
    align-items: stretch;
}

.equal-height-cards .new-card {
    display: flex;
    flex-direction: column;
    height: 100%;
}

.equal-height-cards .new-card-body {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.equal-height-cards .table-responsive {
    flex: 1;
}

@media (max-width: 1200px) {
    .main-content {
        margin-left: 0 !important;
        width: 100% !important;
        padding: 20px 15px !important;
    }
    
    .col-lg-6 {
        margin-bottom: 20px !important;
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
    
    .header-icon {
        margin: 0 auto 15px auto !important;
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
</style>

<div class="new-karyawan">
    <!-- Header Section -->
    <div class="new-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h1><i class="fas fa-users me-3"></i>Data Karyawan</h1>
                <p>Kelola informasi karyawan MyYOGYA dengan mudah</p>
            </div>
            <div style="text-align: right;">
                <div id="realTimeClock" style="font-weight: 600; color: white; font-size: 1rem; margin-bottom: 5px;"></div>
                <small style="opacity: 0.8;" id="current-day">{{ date('l, d F Y') }}</small>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-5">
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="new-stat-number">33</div>
                <div class="new-stat-label">Total Karyawan</div>
                <div class="new-stat-change change-positive">
                    <i class="fas fa-arrow-up"></i> Aktif
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="new-stat-number">30</div>
                <div class="new-stat-label">Karyawan Aktif</div>
                <div class="new-stat-change change-positive">
                    <i class="fas fa-check"></i> Online
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-building"></i>
                </div>
                <div class="new-stat-number">5</div>
                <div class="new-stat-label">Departemen</div>
                <div class="new-stat-change change-neutral">
                    <i class="fas fa-layer-group"></i> Unit
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="new-stat-number">28</div>
                <div class="new-stat-label">Hadir Hari Ini</div>
                <div class="new-stat-change change-positive">
                    <i class="fas fa-clock"></i> {{ date('H:i') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter Bar -->
    <div class="search-filter-bar">
        <div class="row g-3 align-items-center">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" class="form-control" placeholder="Cari karyawan..." id="searchKaryawan">
                </div>
            </div>
            <div class="col-md-3">
                <select class="form-control" id="filterDepartment">
                    <option value="">Semua Departemen</option>
                    <option value="Kasir">Kasir</option>
                    <option value="Gudang">Gudang</option>
                    <option value="Security">Security</option>
                    <option value="Cleaning Service">Cleaning Service</option>
                    <option value="Manager">Manager</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-control" id="filterStatus">
                    <option value="">Semua Status</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Non-Aktif">Non-Aktif</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary w-100">
                    <i class="fas fa-plus me-2"></i>Tambah
                </button>
            </div>
        </div>
    </div>

    <!-- Karyawan Table -->
    <div class="row">
        <div class="col-12">
            <div class="new-card">
                <div class="new-card-header">
                    <div class="new-card-title">
                        <i class="fas fa-table"></i>
                        Daftar Karyawan
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-download me-1"></i>Export
                        </button>
                        <button class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-filter me-1"></i>Filter
                        </button>
                    </div>
                </div>
                <div class="new-card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead style="background: white;">
                                <tr>
                                    <th style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none;">#</th>
                                    <th style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none;">Foto</th>
                                    <th style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none;">Nama Karyawan</th>
                                    <th style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none;">Jabatan</th>
                                    <th style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none;">Departemen</th>
                                    <th style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none;">Status</th>
                                    <th style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none;">Bergabung</th>
                                    <th style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none; text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Sample Data -->
                                <tr>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0;">1</td>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                                        <img src="/image/default-avatar.png" alt="Foto" style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover;">
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                                        <div>
                                            <strong style="color: #1e293b;">Budi Santoso</strong>
                                            <br>
                                            <small style="color: #64748b;">budi.santoso@yogya.com</small>
                                        </div>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                                        <strong style="color: #1e293b;">Kasir Senior</strong>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                                        <span class="badge-department">Kasir</span>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                                        <span class="badge-active">Aktif</span>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                                        <small style="color: #64748b;">15 Jan 2024</small>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0; text-align: center;">
                                        <div class="action-dropdown">
                                            <button class="action-dropdown-btn" data-employee-id="1">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="action-dropdown-menu">
                                                <button class="action-dropdown-item view-item" onclick="viewEmployee(1)">
                                                    <i class="fas fa-eye me-2"></i>Detail
                                                </button>
                                                <button class="action-dropdown-item edit-item" onclick="editEmployee(1)">
                                                    <i class="fas fa-edit me-2"></i>Edit
                                                </button>
                                                <button class="action-dropdown-item delete-item" onclick="deleteEmployee(1)">
                                                    <i class="fas fa-trash me-2"></i>Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0;">2</td>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                                        <img src="/image/default-avatar.png" alt="Foto" style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover;">
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                                        <div>
                                            <strong style="color: #1e293b;">Sari Wulandari</strong>
                                            <br>
                                            <small style="color: #64748b;">sari.wulan@yogya.com</small>
                                        </div>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                                        <strong style="color: #1e293b;">Staff Gudang</strong>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                                        <span class="badge-department">Gudang</span>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                                        <span class="badge-active">Aktif</span>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                                        <small style="color: #64748b;">22 Feb 2024</small>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0; text-align: center;">
                                        <div class="action-dropdown">
                                            <button class="action-dropdown-btn" data-employee-id="2">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="action-dropdown-menu">
                                                <button class="action-dropdown-item view-item" onclick="viewEmployee(2)">
                                                    <i class="fas fa-eye me-2"></i>Detail
                                                </button>
                                                <button class="action-dropdown-item edit-item" onclick="editEmployee(2)">
                                                    <i class="fas fa-edit me-2"></i>Edit
                                                </button>
                                                <button class="action-dropdown-item delete-item" onclick="deleteEmployee(2)">
                                                    <i class="fas fa-trash me-2"></i>Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0;">3</td>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                                        <img src="/image/default-avatar.png" alt="Foto" style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover;">
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                                        <div>
                                            <strong style="color: #1e293b;">Ahmad Rifki</strong>
                                            <br>
                                            <small style="color: #64748b;">ahmad.rifki@yogya.com</small>
                                        </div>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                                        <strong style="color: #1e293b;">Security</strong>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                                        <span class="badge-department">Security</span>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                                        <span class="badge-inactive">Non-Aktif</span>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                                        <small style="color: #64748b;">05 Mar 2024</small>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0; text-align: center;">
                                        <div class="action-dropdown">
                                            <button class="action-dropdown-btn" data-employee-id="3">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="action-dropdown-menu">
                                                <button class="action-dropdown-item view-item" onclick="viewEmployee(3)">
                                                    <i class="fas fa-eye me-2"></i>Detail
                                                </button>
                                                <button class="action-dropdown-item edit-item" onclick="editEmployee(3)">
                                                    <i class="fas fa-edit me-2"></i>Edit
                                                </button>
                                                <button class="action-dropdown-item delete-item" onclick="deleteEmployee(3)">
                                                    <i class="fas fa-trash me-2"></i>Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0;">4</td>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                                        <img src="/image/default-avatar.png" alt="Foto" style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover;">
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                                        <div>
                                            <strong style="color: #1e293b;">Dewi Sartika</strong>
                                            <br>
                                            <small style="color: #64748b;">dewi.sartika@yogya.com</small>
                                        </div>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                                        <strong style="color: #1e293b;">Cleaning Service</strong>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                                        <span class="badge-department">Cleaning Service</span>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                                        <span class="badge-active">Aktif</span>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                                        <small style="color: #64748b;">18 Apr 2024</small>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0; text-align: center;">
                                        <div class="action-dropdown">
                                            <button class="action-dropdown-btn" data-employee-id="4">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="action-dropdown-menu">
                                                <button class="action-dropdown-item view-item" onclick="viewEmployee(4)">
                                                    <i class="fas fa-eye me-2"></i>Detail
                                                </button>
                                                <button class="action-dropdown-item edit-item" onclick="editEmployee(4)">
                                                    <i class="fas fa-edit me-2"></i>Edit
                                                </button>
                                                <button class="action-dropdown-item delete-item" onclick="deleteEmployee(4)">
                                                    <i class="fas fa-trash me-2"></i>Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0;">5</td>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                                        <img src="/image/default-avatar.png" alt="Foto" style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover;">
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                                        <div>
                                            <strong style="color: #1e293b;">Rian Pratama</strong>
                                            <br>
                                            <small style="color: #64748b;">rian.pratama@yogya.com</small>
                                        </div>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                                        <strong style="color: #1e293b;">Manager</strong>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                                        <span class="badge-department">Manager</span>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                                        <span class="badge-active">Aktif</span>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                                        <small style="color: #64748b;">10 May 2024</small>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 12px 0; text-align: center;">
                                        <div class="action-dropdown">
                                            <button class="action-dropdown-btn" data-employee-id="5">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="action-dropdown-menu">
                                                <button class="action-dropdown-item view-item" onclick="viewEmployee(5)">
                                                    <i class="fas fa-eye me-2"></i>Detail
                                                </button>
                                                <button class="action-dropdown-item edit-item" onclick="editEmployee(5)">
                                                    <i class="fas fa-edit me-2"></i>Edit
                                                </button>
                                                <button class="action-dropdown-item delete-item" onclick="deleteEmployee(5)">
                                                    <i class="fas fa-trash me-2"></i>Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div class="pagination-container">
                            <div class="pagination-info">
                                Menampilkan 1-5 dari 33 karyawan
                            </div>
                            <nav>
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <i class="fas fa-chevron-left"></i>
                                        </a>
                                    </li>
                                    <li class="page-item active">
                                        <a class="page-link" href="#">1</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">2</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">3</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">...</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">7</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Department Overview Cards -->
    <div class="row g-4 mt-4 equal-height-cards">
        <div class="col-lg-6">
            <div class="new-card">
                <div class="new-card-header">
                    <div class="new-card-title">
                        <i class="fas fa-chart-pie"></i>
                        Distribusi Departemen
                    </div>
                </div>
                <div class="new-card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead style="background: white;">
                                <tr>
                                    <th style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none;">Departemen</th>
                                    <th style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none; text-align: right;">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="font-size: 0.85rem; border: none; padding: 8px 0;">
                                        <span class="badge-department">Kasir</span>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 8px 0; text-align: right;">
                                        <strong style="color: #1e293b;">12 orang</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size: 0.85rem; border: none; padding: 8px 0;">
                                        <span class="badge-department">Gudang</span>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 8px 0; text-align: right;">
                                        <strong style="color: #1e293b;">8 orang</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size: 0.85rem; border: none; padding: 8px 0;">
                                        <span class="badge-department">Security</span>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 8px 0; text-align: right;">
                                        <strong style="color: #1e293b;">4 orang</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size: 0.85rem; border: none; padding: 8px 0;">
                                        <span class="badge-department">Cleaning Service</span>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 8px 0; text-align: right;">
                                        <strong style="color: #1e293b;">6 orang</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size: 0.85rem; border: none; padding: 8px 0;">
                                        <span class="badge-department">Manager</span>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 8px 0; text-align: right;">
                                        <strong style="color: #1e293b;">3 orang</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Pagination for Distribusi Departemen -->
                        <div class="pagination-container">
                            <div class="pagination-info">
                                Menampilkan semua 5 departemen
                            </div>
                            <nav>
                                <ul class="pagination">
                                    <li class="page-item active">
                                        <a class="page-link" href="#">1</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="new-card">
                <div class="new-card-header">
                    <div class="new-card-title">
                        <i class="fas fa-clock"></i>
                        Kehadiran Hari Ini
                    </div>
                </div>
                <div class="new-card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead style="background: white;">
                                <tr>
                                    <th style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none;">Nama</th>
                                    <th style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none;">Waktu Masuk</th>
                                    <th style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none; text-align: center;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="font-size: 0.85rem; border: none; padding: 8px 0;">
                                        <strong style="color: #1e293b;">Budi Santoso</strong>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 8px 0;">
                                        <small style="color: #64748b;">08:00</small>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 8px 0; text-align: center;">
                                        <span class="badge-active">Hadir</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size: 0.85rem; border: none; padding: 8px 0;">
                                        <strong style="color: #1e293b;">Sari Wulandari</strong>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 8px 0;">
                                        <small style="color: #64748b;">08:15</small>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 8px 0; text-align: center;">
                                        <span class="badge-active">Hadir</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size: 0.85rem; border: none; padding: 8px 0;">
                                        <strong style="color: #1e293b;">Ahmad Rifki</strong>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 8px 0;">
                                        <small style="color: #64748b;">-</small>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 8px 0; text-align: center;">
                                        <span class="badge-inactive">Tidak Hadir</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size: 0.85rem; border: none; padding: 8px 0;">
                                        <strong style="color: #1e293b;">Dewi Sartika</strong>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 8px 0;">
                                        <small style="color: #64748b;">08:05</small>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 8px 0; text-align: center;">
                                        <span class="badge-active">Hadir</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size: 0.85rem; border: none; padding: 8px 0;">
                                        <strong style="color: #1e293b;">Rian Pratama</strong>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 8px 0;">
                                        <small style="color: #64748b;">08:20</small>
                                    </td>
                                    <td style="font-size: 0.85rem; border: none; padding: 8px 0; text-align: center;">
                                        <span class="badge-active">Hadir</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Pagination for Kehadiran -->
                        <div class="pagination-container">
                            <div class="pagination-info">
                                Menampilkan 1-5 dari 28 karyawan hadir
                            </div>
                            <nav>
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <i class="fas fa-chevron-left"></i>
                                        </a>
                                    </li>
                                    <li class="page-item active">
                                        <a class="page-link" href="#">1</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">2</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">3</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">...</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">6</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Update current time
function updateDateTime() {
    const now = new Date();
    const options = {
        timeZone: 'Asia/Jakarta',
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    };
    const dateString = now.toLocaleDateString('id-ID', options);
    
    const dateElement = document.getElementById('current-date');
    if (dateElement) {
        dateElement.textContent = dateString;
    }
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    updateDateTime();
    setInterval(updateDateTime, 60000); // Update every minute
});

// Search functionality
document.getElementById('searchKaryawan').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const tableRows = document.querySelectorAll('tbody tr');
    
    tableRows.forEach(row => {
        const text = row.textContent.toLowerCase();
        if (text.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Real-time clock update
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
    const realTimeClockElement = document.getElementById('realTimeClock');
    if (realTimeClockElement) {
        realTimeClockElement.textContent = timeString + ' WIB';
    }
}

// Update real-time clock
updateRealTimeClock();
setInterval(updateRealTimeClock, 1000);

// Update current day
function updateDateTime() {
    const now = new Date();
    const dayElement = document.getElementById('current-day');
    
    if (dayElement) {
        const dayOptions = {
            weekday: 'long',
            day: 'numeric',
            month: 'long',
            year: 'numeric',
            timeZone: 'Asia/Jakarta'
        };
        
        const dayFormatter = new Intl.DateTimeFormat('id-ID', dayOptions);
        dayElement.textContent = dayFormatter.format(now);
    }
}

// Update day immediately and then every minute
updateDateTime();
setInterval(updateDateTime, 60000);

// Filter functionality
document.getElementById('filterDepartment').addEventListener('change', function(e) {
    const filterValue = e.target.value.toLowerCase();
    const tableRows = document.querySelectorAll('tbody tr');
    
    tableRows.forEach(row => {
        if (filterValue === '') {
            row.style.display = '';
        } else {
            const departmentCell = row.cells[4]; // Assuming department is 5th column
            if (departmentCell && departmentCell.textContent.toLowerCase().includes(filterValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    });
});

document.getElementById('filterStatus').addEventListener('change', function(e) {
    const filterValue = e.target.value.toLowerCase();
    const tableRows = document.querySelectorAll('tbody tr');
    
    tableRows.forEach(row => {
        if (filterValue === '') {
            row.style.display = '';
        } else {
            const statusCell = row.cells[5]; // Assuming status is 6th column
            if (statusCell && statusCell.textContent.toLowerCase().includes(filterValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    });
});

// Dropdown functionality with proper event handling
document.addEventListener('DOMContentLoaded', function() {
    // Add event listeners to all dropdown buttons
    document.querySelectorAll('.action-dropdown-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const dropdown = this.nextElementSibling;
            const allDropdowns = document.querySelectorAll('.action-dropdown-menu');
            
            // Close all other dropdowns
            allDropdowns.forEach(d => {
                if (d !== dropdown) {
                    d.style.display = 'none';
                }
            });
            
            // Toggle current dropdown
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        });
    });
});

// Remove the old function
function toggleDropdown(button) {
    // This function is no longer used
}

// Close dropdown when clicking outside
document.addEventListener('click', function(e) {
    if (!e.target.closest('.action-dropdown')) {
        document.querySelectorAll('.action-dropdown-menu').forEach(dropdown => {
            dropdown.style.display = 'none';
        });
    }
});

// Employee action functions
function viewEmployee(id) {
    alert('View employee with ID: ' + id);
    // Close dropdown
    document.querySelectorAll('.action-dropdown-menu').forEach(dropdown => {
        dropdown.style.display = 'none';
    });
}

function editEmployee(id) {
    alert('Edit employee with ID: ' + id);
    // Close dropdown
    document.querySelectorAll('.action-dropdown-menu').forEach(dropdown => {
        dropdown.style.display = 'none';
    });
}

function deleteEmployee(id) {
    if (confirm('Apakah Anda yakin ingin menghapus karyawan ini?')) {
        alert('Delete employee with ID: ' + id);
    }
    // Close dropdown
    document.querySelectorAll('.action-dropdown-menu').forEach(dropdown => {
        dropdown.style.display = 'none';
    });
}
</script>
@endsection
