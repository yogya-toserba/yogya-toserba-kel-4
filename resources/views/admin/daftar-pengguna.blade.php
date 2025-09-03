@extends('layouts.navbar_admin')

@section('title', 'Data Pembeli - MyYOGYA')

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
    overflow-x: hidden    <!-- Statistics Cards -->
    <div class="row     </div>

    <!-- Search and Filter with proper spacing -->
    <div class="search-filter-bar" style="margin-top: 40px; clear: both;")mb-5 clearfix new-stats")important;
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

/* FORCE NEW DASHBOARD STYLES - EXACT MATCH WITH ABSENSI */
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

/* Header Right Side Layout - EXACT MATCH WITH ABSENSI */
.new-header div[style*="text-align: right"] {
    display: flex !important;
    flex-direction: column !important;
    align-items: flex-end !important;
    gap: 0 !important;
}

/* Real Time Clock Styling - EXACT SAME AS ABSENSI */
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

/* CLEARFIX AND SPACING UTILITIES */
.clearfix::after {
    content: "" !important;
    display: table !important;
    clear: both !important;
}

/* Ensure proper spacing between sections */
.row + .search-filter-bar {
    margin-top: 30px !important;
}

.search-filter-bar + .new-card {
    margin-top: 20px !important;
}

/* RESPONSIVE SPACING FIXES */
@media (max-width: 768px) {
    .row.g-4 {
        margin-bottom: 30px !important;
    }
    
    .search-filter-bar {
        margin-top: 15px !important;
        padding: 20px !important;
    }
    
    .new-stat-card {
        margin-bottom: 20px !important;
    }
}

.new-stats {
    margin-bottom: 50px !important;
    position: relative !important;
    z-index: 1 !important;
}

/* ROW AND COLUMN LAYOUT - EXACT MATCH WITH ABSENSI */
.row.g-4 {
    margin: 0 -15px !important;
    margin-bottom: 10px !important;
}

.row.g-4 > .col-lg-3 {
    padding: 0 15px !important;
    margin-bottom: 0px !important;
}

/* STATS CARDS - EXACT MATCH WITH ABSENSI */
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
    background: #fecaca !important;
    color: #dc2626 !important;
}

body.dark-mode .new-stat-card p {
    color: #94a3b8;
}

/* SEARCH FILTER BAR - COMPACT VERSION LIKE ABSENSI */
.search-filter-bar {
    background: white !important;
    border-radius: 12px !important;
    padding: 20px !important;
    margin-bottom: 25px !important;
    margin-top: -5px !important;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08) !important;
    border: none !important;
    clear: both !important;
}

body.dark-mode .search-filter-bar {
    background: #2a2d3f !important;
    color: #e2e8f0 !important;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3) !important;
}

.search-filter-bar .form-label {
    font-weight: 600 !important;
    color: #1f2937 !important;
    margin-bottom: 6px !important;
    font-size: 0.9rem !important;
    display: block !important;
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

/* Ensure form elements have consistent heights */
.search-filter-bar .form-control,
.search-filter-bar .form-select {
    min-height: 38px !important;
}

/* Better spacing for mobile responsiveness */
@media (max-width: 768px) {
    .search-filter-bar .row {
        flex-direction: column !important;
        gap: 15px !important;
    }
    
    .search-filter-bar .row .col-md-2:last-child .d-flex {
        justify-content: center !important;
        margin-top: 15px !important;
    }
}

/* Reset button (icon only) styling */
.reset-btn {
    min-width: 38px !important;
    width: 38px !important;
    padding: 8px !important;
    gap: 0 !important;
}

.btn-outline-secondary:hover {
    background: #6c757d !important;
    color: white !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3) !important;
}

body.dark-mode .btn-outline-secondary {
    border-color: #9ca3af !important;
    color: #9ca3af !important;
}

body.dark-mode .btn-outline-secondary:hover {
    background: #9ca3af !important;
    color: #1f2937 !important;
}

/* Button container styling for perfect alignment */
.search-filter-bar .d-flex {
    margin-top: 8px !important;
}

.search-filter-bar .gap-2 {
    gap: 12px !important;
}

/* Ensure consistent heights and alignment */
.search-filter-bar .row.g-3 {
    align-items: end !important;
}

.search-filter-bar .col-md-3:last-child {
    display: flex !important;
    align-items: end !important;
}

/* NEW CARD STYLING - EXACT MATCH ABSENSI */
.new-card {
    background: white !important;
    border-radius: 16px !important;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08) !important;
    border: none !important;
    overflow: hidden !important;
    transition: all 0.3s ease !important;
    margin-bottom: 30px !important;
}

.new-card:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15) !important;
}

body.dark-mode .new-card {
    background: #2a2d3f !important;
    color: #e2e8f0 !important;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3) !important;
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
    background: white !important;
}

body.dark-mode .new-card-body {
    background: #2a2d3f !important;
}

/* TABLE STYLING - EXACT MATCH ABSENSI */
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

/* BADGE STYLING */
.badge {
    font-size: 0.75rem !important;
    padding: 4px 8px !important;
    font-weight: 500 !important;
    border-radius: 6px !important;
}

/* ACTION BUTTONS */
.btn-sm {
    padding: 4px 8px !important;
    font-size: 0.75rem !important;
    border-radius: 6px !important;
}

/* TABLE UTILITIES - REMOVED OLD TABLE-FIXED STYLES */

/* HOVER EFFECTS */
.table tbody tr:hover {
    background: #f8fafc !important;
}

body.dark-mode .table tbody tr:hover {
    background: #374151 !important;
}

/* PAGINATION - SAME AS PENGGAJIAN */
.pagination-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;
    padding: 15px 0;
    flex-wrap: wrap;
    gap: 10px;
}

.pagination-info {
    font-size: 0.875rem;
    color: #64748b;
    margin: 0;
}

body.dark-mode .pagination-info {
    color: #9ca3af;
}

/* Laravel Pagination Styles */
.pagination {
    display: flex !important;
    justify-content: center !important;
    list-style: none !important;
    margin: 0 !important;
    padding: 0 !important;
    gap: 2px !important;
    align-items: center !important;
}

.pagination .page-item {
    margin: 0 !important;
    display: inline-block !important;
}

.pagination .page-link {
    display: inline-block !important;
    padding: 8px 12px !important;
    margin: 0 1px !important;
    border: 1px solid #e2e8f0 !important;
    background: white !important;
    color: #64748b !important;
    text-decoration: none !important;
    border-radius: 6px !important;
    font-size: 0.875rem !important;
    transition: all 0.2s ease !important;
    line-height: 1.4 !important;
    min-width: 36px !important;
    text-align: center !important;
}

.pagination .page-link:hover {
    background: #f8fafc !important;
    border-color: #cbd5e1 !important;
    color: #1e293b !important;
    text-decoration: none !important;
    transform: none !important;
}

.pagination .page-link:focus {
    box-shadow: 0 0 0 0.2rem rgba(242, 107, 55, 0.25) !important;
    border-color: #f26b37 !important;
    outline: none !important;
}

.pagination .page-item.active .page-link {
    background: #f26b37 !important;
    border-color: #f26b37 !important;
    color: white !important;
    z-index: 3 !important;
}

.pagination .page-item.disabled .page-link {
    color: #6c757d !important;
    pointer-events: none !important;
    background-color: #fff !important;
    border-color: #dee2e6 !important;
    opacity: 0.5 !important;
}

/* Dark mode pagination */
body.dark-mode .pagination .page-link {
    background: #374151 !important;
    border-color: #4b5563 !important;
    color: #9ca3af !important;
}

body.dark-mode .pagination .page-link:hover {
    background: #4b5563 !important;
    border-color: #6b7280 !important;
    color: #d1d5db !important;
}

body.dark-mode .pagination .page-item.active .page-link {
    background: #f26b37 !important;
    border-color: #f26b37 !important;
    color: white !important;
}

body.dark-mode .pagination .page-item.disabled .page-link {
    background: #374151 !important;
    border-color: #4b5563 !important;
    color: #6b7280 !important;
}

/* Responsive pagination */
@media (max-width: 576px) {
    .pagination-container {
        flex-direction: column;
        text-align: center;
        gap: 15px;
    }
    
    .pagination .page-link {
        padding: 6px 10px !important;
        font-size: 0.8rem !important;
        min-width: 32px !important;
    }
}

/* Pagination wrapper */
.pagination-wrapper {
    display: flex;
    justify-content: center;
}

/* RESPONSIVE STYLING - SAME AS ABSENSI */
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
    
    .search-filter-bar .row > div {
        margin-bottom: 15px;
    }
    
    .table-responsive {
        border-radius: 12px;
    }
}
</style>

<div class="new-pengguna">
    <!-- Header Section -->
    <div class="new-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h1><i class="fas fa-users me-3"></i>Data Pembeli</h1>
                <p>Manajemen Data Pembeli dan Customer MyYOGYA</p>
            </div>
            <div style="text-align: right;">
                <div id="realTimeClock"></div>
                <small id="currentDate" style="opacity: 0.8;"></small>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4">
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="new-stat-number">248</div>
                <div class="new-stat-label">Total Pembeli</div>
                <div class="new-stat-change change-positive">
                    <i class="fas fa-user-check"></i> Terdaftar
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="new-stat-number">231</div>
                <div class="new-stat-label">Pembeli Aktif</div>
                <div class="new-stat-change change-positive">
                    <i class="fas fa-check-circle"></i> Berbelanja
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-user-clock"></i>
                </div>
                <div class="new-stat-number">17</div>
                <div class="new-stat-label">Pembeli Idle</div>
                <div class="new-stat-change change-neutral">
                    <i class="fas fa-pause-circle"></i> Tidak Aktif
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <div class="new-stat-number">12</div>
                <div class="new-stat-label">Pembeli Baru</div>
                <div class="new-stat-change change-warning">
                    <i class="fas fa-calendar-plus"></i> Bulan Ini
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="search-filter-bar">
        <form method="GET" action="">
            <div class="row g-2 align-items-end">
                <div class="col-md-4">
                    <label for="search" class="form-label">Cari Pembeli</label>
                    <input type="text" class="form-control" id="search" name="search" 
                           placeholder="Nama, email, nomor HP, atau ID member..." value="">
                </div>
                <div class="col-md-2">
                    <label for="member_type" class="form-label">Tipe Member</label>
                    <select class="form-select" id="member_type" name="member_type">
                        <option value="">Semua Member</option>
                        <option value="reguler">Reguler</option>
                        <option value="silver">Silver</option>
                        <option value="gold">Gold</option>
                        <option value="platinum">Platinum</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="">Semua Status</option>
                        <option value="active">Aktif</option>
                        <option value="inactive">Tidak Aktif</option>
                        <option value="new">Pembeli Baru</option>
                        <option value="vip">VIP Customer</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="cabang" class="form-label">Lokasi Favorit</label>
                    <select class="form-select" id="cabang" name="cabang">
                        <option value="">Semua Cabang</option>
                        <option value="yogyakarta_pusat">Yogyakarta Pusat</option>
                        <option value="yogyakarta_utara">Yogyakarta Utara</option>
                        <option value="solo">Solo</option>
                        <option value="semarang">Semarang</option>
                        <option value="magelang">Magelang</option>
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
                        Data Pembeli Terdaftar
                    </div>
                </div>
                <div class="new-card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Data Pembeli</th>
                                    <th>Tipe Member</th>
                                    <th>Cabang Favorit</th>
                                    <th>Status</th>
                                    <th>Last Shopping</th>
                                    <th>Member Sejak</th>
                                    <th style="text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div style="width: 35px; height: 35px; background: linear-gradient(135deg, #f26b37 0%, #e55827 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; margin-right: 10px;">AD</div>
                                            <div>
                                                <strong>Ahmad Dani</strong>
                                                <br><small>ahmad.dani@gmail.com</small>
                                                <br><small>HP: 081234567890</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #fef3c7; color: #d97706; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">Gold</span>
                                    </td>
                                    <td>
                                        <strong>Yogyakarta Pusat</strong>
                                        <br><small>Pusat</small>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #dcfce7; color: #15803d; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">Aktif</span>
                                    </td>
                                    <td>
                                        <strong>Kemarin</strong>
                                        <br><small>19:30 WIB</small>
                                    </td>
                                    <td>
                                        <strong>8 bulan lalu</strong>
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
                                                <br><small>sari.wulandari@yogya.com</small>
                                                <br><small>ID: USR002</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #dbeafe; color: #1d4ed8; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">Manager</span>
                                    </td>
                                    <td>
                                        <strong>Solo</strong>
                                        <br><small>Cabang</small>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #dcfce7; color: #15803d; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">Aktif</span>
                                    </td>
                                    <td>
                                        <strong>Kemarin</strong>
                                        <br><small>17:45 WIB</small>
                                    </td>
                                    <td>
                                        <strong>6 bulan lalu</strong>
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
                                            <div style="width: 35px; height: 35px; background: linear-gradient(135deg, #f26b37 0%, #e55827 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; margin-right: 10px;">RP</div>
                                            <div>
                                                <strong>Rian Pratama</strong>
                                                <br><small>rian.pratama@yogya.com</small>
                                                <br><small>ID: USR003</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #fee2e2; color: #dc2626; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">Nonaktif</span>
                                    </td>
                                    <td>
                                        <strong>Semarang</strong>
                                        <br><small>Cabang</small>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #fee2e2; color: #dc2626; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">Nonaktif</span>
                                    </td>
                                    <td>
                                        <strong>1 minggu lalu</strong>
                                        <br><small>14:20 WIB</small>
                                    </td>
                                    <td>
                                        <strong>1 bulan lalu</strong>
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
                                            <div style="width: 35px; height: 35px; background: linear-gradient(135deg, #f26b37 0%, #e55827 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; margin-right: 10px;">MF</div>
                                            <div>
                                                <strong>Maya Fitri</strong>
                                                <br><small>maya.fitri@customer.com</small>
                                                <br><small>ID: CUS001</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #dcfce7; color: #15803d; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">Aktif</span>
                                    </td>
                                    <td>
                                        <strong>Yogyakarta</strong>
                                        <br><small>Online</small>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #dcfce7; color: #15803d; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">Aktif</span>
                                    </td>
                                    <td>
                                        <strong>2 hari lalu</strong>
                                        <br><small>19:15 WIB</small>
                                    </td>
                                    <td>
                                        <strong>Baru</strong>
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
                                            <div style="width: 35px; height: 35px; background: linear-gradient(135deg, #f26b37 0%, #e55827 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; margin-right: 10px;">BH</div>
                                            <div>
                                                <strong>Budi Hartanto</strong>
                                                <br><small>budi.hartanto@yogya.com</small>
                                                <br><small>ID: USR004</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #fef3c7; color: #d97706; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">Pending</span>
                                    </td>
                                    <td>
                                        <strong>Magelang</strong>
                                        <br><small>Cabang</small>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #fef3c7; color: #d97706; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">Pending</span>
                                    </td>
                                    <td>
                                        <strong>Belum pernah</strong>
                                        <br><small>-</small>
                                    </td>
                                    <td>
                                        <strong>Hari ini</strong>
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

                    <!-- Pagination -->
                    <div class="pagination-container">
                        <div class="pagination-info">
                            Menampilkan 5 dari 248 pembeli
                        </div>
                        <div class="pagination-wrapper">
                            <nav>
                                <ul class="pagination">
                                    <li class="page-item disabled">
                                        <span class="page-link">Previous</span>
                                    </li>
                                    <li class="page-item active">
                                        <span class="page-link">1</span>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">2</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">3</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">4</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">5</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Tables Row -->
    <div class="row g-4 mt-4">
        <!-- Top Member By Points -->
        <div class="col-lg-6">
            <div class="new-card">
                <div class="new-card-header">
                    <div class="new-card-title">
                        <i class="fas fa-trophy"></i>
                        Top Member By Points
                    </div>
                </div>
                <div class="new-card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Member</th>
                                    <th>Tipe</th>
                                    <th>Points</th>
                                    <th>Total Belanja</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <span class="badge" style="background: #fef3c7; color: #d97706; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">#1</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #f26b37 0%, #e55827 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; margin-right: 8px; font-size: 0.7rem;">AD</div>
                                            <div>
                                                <strong>Ahmad Dani</strong>
                                                <br><small>ID: MBR001</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #fef3c7; color: #d97706; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">Gold</span>
                                    </td>
                                    <td>
                                        <strong style="color: #15803d;">25,420</strong>
                                    </td>
                                    <td>
                                        <strong>Rp 15.2M</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="badge" style="background: #e0e7ff; color: #3730a3; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">#2</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #f26b37 0%, #e55827 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; margin-right: 8px; font-size: 0.7rem;">SW</div>
                                            <div>
                                                <strong>Sari Wulandari</strong>
                                                <br><small>ID: MBR002</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #dbeafe; color: #1d4ed8; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">Silver</span>
                                    </td>
                                    <td>
                                        <strong style="color: #15803d;">18,750</strong>
                                    </td>
                                    <td>
                                        <strong>Rp 12.8M</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="badge" style="background: #fecaca; color: #b91c1c; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">#3</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #f26b37 0%, #e55827 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; margin-right: 8px; font-size: 0.7rem;">MF</div>
                                            <div>
                                                <strong>Maya Fitri</strong>
                                                <br><small>ID: MBR008</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #dcfce7; color: #15803d; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">Regular</span>
                                    </td>
                                    <td>
                                        <strong style="color: #15803d;">14,320</strong>
                                    </td>
                                    <td>
                                        <strong>Rp 9.5M</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Member Activities -->
        <div class="col-lg-6">
            <div class="new-card">
                <div class="new-card-header">
                    <div class="new-card-title">
                        <i class="fas fa-clock"></i>
                        Recent Member Activities
                    </div>
                </div>
                <div class="new-card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Member</th>
                                    <th>Activity</th>
                                    <th>Amount</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #f26b37 0%, #e55827 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; margin-right: 8px; font-size: 0.7rem;">BH</div>
                                            <div>
                                                <strong>Budi Hartanto</strong>
                                                <br><small>Gold Member</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <strong>Purchase</strong>
                                        <br><small>Groceries</small>
                                    </td>
                                    <td>
                                        <strong>Rp 485K</strong>
                                    </td>
                                    <td>
                                        <strong>2 min ago</strong>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #dcfce7; color: #15803d; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">Success</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #f26b37 0%, #e55827 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; margin-right: 8px; font-size: 0.7rem;">RP</div>
                                            <div>
                                                <strong>Rian Pratama</strong>
                                                <br><small>Silver Member</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <strong>Redeem Points</strong>
                                        <br><small>Voucher 50K</small>
                                    </td>
                                    <td>
                                        <strong>2,500 pts</strong>
                                    </td>
                                    <td>
                                        <strong>5 min ago</strong>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #dcfce7; color: #15803d; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">Success</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #f26b37 0%, #e55827 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; margin-right: 8px; font-size: 0.7rem;">MF</div>
                                            <div>
                                                <strong>Maya Fitri</strong>
                                                <br><small>Regular Member</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <strong>Registration</strong>
                                        <br><small>New Member</small>
                                    </td>
                                    <td>
                                        <strong>+1000 pts</strong>
                                    </td>
                                    <td>
                                        <strong>15 min ago</strong>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #fef3c7; color: #d97706; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">Pending</span>
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
            second: '2-digit'
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
            day: 'numeric' 
        };
        const dateString = now.toLocaleDateString('id-ID', options);
        dateElement.textContent = dateString;
    }
}

function resetForm() {
    const searchField = document.querySelector('input[placeholder*="member"]');
    const roleSelect = document.querySelector('select option[selected]').parentElement;
    const statusSelect = roleSelect.nextElementSibling.nextElementSibling;
    const locationSelect = statusSelect.nextElementSibling;
    
    if (searchField) searchField.value = '';
    if (roleSelect) roleSelect.selectedIndex = 0;
    if (statusSelect) statusSelect.selectedIndex = 0;
    if (locationSelect) locationSelect.selectedIndex = 0;
    document.getElementById('cabang').selectedIndex = 0;
}

// Update time and date immediately and then every second
updateDateTime();
setInterval(updateDateTime, 1000);
</script>
@endsection
