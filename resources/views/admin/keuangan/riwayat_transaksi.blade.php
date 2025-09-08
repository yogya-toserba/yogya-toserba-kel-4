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
    height: 240px !important;
    display: flex !important;
    flex-direction: column !important;
    justify-content: center !important;
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
    white-space: nowrap !important;
    overflow: hidden !important;
}

/* Responsive font size untuk angka panjang */
.new-stat-number.long-number {
    font-size: 1.6rem !important;
}

.new-stat-number.very-long-number {
    font-size: 1.3rem !important;
}

.new-stat-number.extra-long-number {
    font-size: 1.1rem !important;
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
    padding: 11px 20px !important;
    border-radius: 8px !important;
    font-weight: 600 !important;
    transition: all 0.3s ease !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 8px !important;
    width: 100% !important;
    box-shadow: 0 2px 8px rgba(242, 107, 55, 0.2) !important;
    text-decoration: none !important;
}

.search-btn:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 6px 20px rgba(242, 107, 55, 0.4) !important;
    color: white !important;
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

/* PAGINATION - ENHANCED FOR BETTER FUNCTIONALITY */
.pagination-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 0;
    padding: 20px 25px;
    flex-wrap: wrap;
    background: white !important;
    border-top: 1px solid #e5e7eb;
}

body.dark-mode .pagination-container {
    background: #2a2d3f !important;
    border-top-color: #374151;
}

.pagination-info {
    color: #64748b;
    font-size: 0.9rem;
    font-weight: 500;
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
    display: flex;
    list-style: none;
    padding: 0;
    gap: 4px;
}

.page-item {
    display: inline-block;
}

.page-link {
    color: #374151;
    background: white;
    border: 1px solid #d1d5db;
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.2s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 36px;
    height: 36px;
    position: relative;
    cursor: pointer;
}

.page-link:hover {
    background: #f8fafc;
    border-color: #f26b37;
    color: #f26b37;
    text-decoration: none;
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.page-item.active .page-link {
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
    border-color: #f26b37;
    color: white;
    font-weight: 600;
    box-shadow: 0 2px 8px rgba(242, 107, 55, 0.3);
}

.page-item.active .page-link:hover {
    background: linear-gradient(135deg, #e55827 0%, #d4511e 100%);
    transform: none;
}

.page-item.disabled .page-link {
    color: #9ca3af;
    background: #f9fafb;
    border-color: #e5e7eb;
    cursor: not-allowed;
    opacity: 0.6;
}

.page-item.disabled .page-link:hover {
    color: #9ca3af;
    background: #f9fafb;
    border-color: #e5e7eb;
    transform: none;
    box-shadow: none;
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

body.dark-mode .page-item.active .page-link {
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
    border-color: #f26b37;
    color: white;
}

body.dark-mode .page-item.disabled .page-link {
    color: #6b7280;
    background: #2a2d3f;
    border-color: #374151;
}
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
    padding: 9px 20px !important;
    border-radius: 8px !important;
    font-size: 0.875rem !important;
    font-weight: 600 !important;
    transition: all 0.3s ease !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 8px !important;
    width: 100% !important;
    text-decoration: none !important;
    box-shadow: 0 2px 4px rgba(108, 117, 125, 0.1) !important;
}

.btn-outline-secondary:hover {
    background: #6c757d !important;
    color: white !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 6px 16px rgba(108, 117, 125, 0.3) !important;
    text-decoration: none !important;
}

body.dark-mode .btn-outline-secondary {
    border-color: #9ca3af !important;
    color: #9ca3af !important;
}

body.dark-mode .btn-outline-secondary:hover {
    background: #9ca3af !important;
    color: #1f2937 !important;
}

/* Responsive design */
@media (max-width: 768px) {
    .pagination-container {
        flex-direction: column;
        gap: 15px;
        text-align: center;
        padding: 15px;
    }
    
    .pagination-info {
        font-size: 0.8rem;
        order: 2;
    }
    
    .pagination-wrapper {
        order: 1;
        justify-content: center;
        width: 100%;
    }
    
    .pagination {
        flex-wrap: wrap;
        justify-content: center;
        gap: 2px;
    }
    
    .page-link {
        padding: 6px 10px;
        font-size: 0.8rem;
        min-width: 32px;
        height: 32px;
    }
}

@media (max-width: 480px) {
    .pagination {
        gap: 1px;
    }
    
    .page-link {
        padding: 4px 8px;
        font-size: 0.75rem;
        min-width: 28px;
        height: 28px;
    }
    
    .pagination-info {
        font-size: 0.75rem;
        line-height: 1.4;
    }
    
    /* Hide pagination text on very small screens, show only numbers */
    .pagination-wrapper .text-muted {
        display: none;
    }
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
    
    /* Mobile button styling */
    .search-btn,
    .btn-outline-secondary {
        padding: 12px 16px !important;
        font-size: 0.85rem !important;
        width: 100% !important;
    }
    
    .search-btn span,
    .btn-outline-secondary span {
        display: inline !important;
    }
    
    /* Mobile form spacing */
    .search-filter-bar {
        padding: 20px 15px !important;
    }
    
    .search-filter-bar .col-md-2 {
        margin-bottom: 20px;
    }
    
    .table th,
    .table td {
        padding: 8px 12px !important;
        font-size: 0.75rem !important;
    }
    
    /* Responsive font sizes untuk mobile */
    .new-stat-card {
        height: 180px !important;
        padding: 20px !important;
    }
    
    .new-stat-number {
        font-size: 1.5rem !important;
    }
    
    .new-stat-number.long-number {
        font-size: 1.2rem !important;
    }
    
    .new-stat-number.very-long-number {
        font-size: 1rem !important;
    }
    
    .new-stat-number.extra-long-number {
        font-size: 0.9rem !important;
    }
}

/* Additional responsive breakpoints untuk tablets */
@media (min-width: 577px) and (max-width: 768px) {
    .new-stat-number.long-number {
        font-size: 1.4rem !important;
    }
    
    .new-stat-number.very-long-number {
        font-size: 1.2rem !important;
    }
    
    .new-stat-number.extra-long-number {
        font-size: 1rem !important;
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
        <form method="GET" action="{{ route('admin.keuangan.riwayat') }}" id="filterForm">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="search" class="form-label">
                        <i class="fas fa-search me-1"></i>
                        Cari Transaksi
                    </label>
                    <input type="text" class="form-control" id="search" name="search" 
                           placeholder="ID transaksi, nama pelanggan, atau metode..." 
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <label for="periode" class="form-label">
                        <i class="fas fa-calendar-alt me-1"></i>
                        Periode
                    </label>
                    <select class="form-select" id="periode" name="periode">
                        <option value="">Semua Periode</option>
                        <option value="harian" {{ request('periode') == 'harian' ? 'selected' : '' }}>Harian</option>
                        <option value="mingguan" {{ request('periode') == 'mingguan' ? 'selected' : '' }}>Mingguan</option>
                        <option value="bulanan" {{ request('periode') == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="status" class="form-label">
                        <i class="fas fa-check-circle me-1"></i>
                        Status
                    </label>
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
                        <option value="transfer" {{ request('metode') == 'transfer' ? 'selected' : '' }}>Transfer</option>
                        <option value="kartu" {{ request('metode') == 'kartu' ? 'selected' : '' }}>Kartu</option>
                        <option value="e-wallet" {{ request('metode') == 'e-wallet' ? 'selected' : '' }}>E-Wallet</option>
                        <option value="qris" {{ request('metode') == 'qris' ? 'selected' : '' }}>QRIS</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <div class="d-flex gap-2">
                        <button type="submit" class="search-btn" title="Cari transaksi">
                            <i class="fas fa-search"></i>
                            <span class="d-none d-sm-inline">Cari</span>
                        </button>
                        <a href="{{ route('admin.keuangan.riwayat') }}" class="btn-outline-secondary" title="Reset filter">
                            <i class="fas fa-undo"></i>
                            <span class="d-none d-sm-inline">Reset</span>
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
                                    <th>NAMA PELANGGAN</th>
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
                                @php
                                    // Map transaction data to payment methods
                                    $metode = 'Tunai'; // Default
                                    if (isset($t->keterangan)) {
                                        if (stripos($t->keterangan, 'transfer') !== false) {
                                            $metode = 'Transfer';
                                        } elseif (stripos($t->keterangan, 'kartu') !== false) {
                                            $metode = 'Kartu';
                                        } elseif (stripos($t->keterangan, 'ewallet') !== false || stripos($t->keterangan, 'e-wallet') !== false) {
                                            $metode = 'E-Wallet';
                                        } elseif (stripos($t->keterangan, 'qris') !== false) {
                                            $metode = 'QRIS';
                                        } else {
                                            // For SALDO_AWAL or other types, randomize for demo
                                            $metodePembayaran = ['Tunai', 'Transfer', 'Kartu', 'E-Wallet', 'QRIS'];
                                            $metode = $metodePembayaran[($t->id_transaksi % 5)];
                                        }
                                    }
                                @endphp
                                <div class="d-flex flex-column justify-content-center">
                                    <strong>{{ $metode }}</strong>
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
                                    // Map transaction ID to status for demo purposes
                                    $statusList = ['berhasil', 'pending', 'gagal', 'dibatalkan'];
                                    $status = $statusList[($t->id_transaksi % 4)];
                                    
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
                                        <li><a class="dropdown-item" href="#" onclick="lihatDetail({{ $t->id_transaksi }})"><i class="fas fa-eye me-2"></i>Lihat Detail</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="cetakStruk({{ $t->id_transaksi }})"><i class="fas fa-print me-2"></i>Cetak Struk</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item text-danger" href="#" onclick="hapusTransaksi({{ $t->id_transaksi }})"><i class="fas fa-trash me-2"></i>Hapus</a></li>
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
                        
                    </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-container">
                        <div class="pagination-info">
                            @if(isset($transaksi) && $transaksi->count() > 0)
                                Menampilkan {{ $transaksi->firstItem() }} - {{ $transaksi->lastItem() }} dari {{ number_format($transaksi->total()) }} riwayat transaksi
                                @if(request()->hasAny(['search', 'periode', 'status', 'metode']))
                                    <span class="text-muted"> (hasil pencarian/filter)</span>
                                @endif
                            @elseif(isset($transaksi))
                                Tidak ada riwayat transaksi yang ditemukan
                                @if(request()->hasAny(['search', 'periode', 'status', 'metode']))
                                    <span class="text-muted"> - coba ubah filter pencarian</span>
                                @endif
                            @else
                                <span class="text-danger">Error: Data tidak dapat dimuat</span>
                            @endif
                        </div>
                        @if(isset($transaksi) && $transaksi->hasPages())
                            <div class="pagination-wrapper">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="text-muted me-2" style="font-size: 0.8rem;">Halaman:</span>
                                    {{ $transaksi->appends(request()->query())->onEachSide(2)->links('custom.pagination') }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Transaksi -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="detailModalBody">
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus transaksi ini?</p>
                <p class="text-danger"><small>Tindakan ini tidak dapat dibatalkan.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Hapus</button>
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

// Lihat Detail Transaksi
function lihatDetail(idTransaksi) {
    const modal = new bootstrap.Modal(document.getElementById('detailModal'));
    const modalBody = document.getElementById('detailModalBody');
    
    // Show loading
    modalBody.innerHTML = `
        <div class="text-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Memuat detail transaksi...</p>
        </div>
    `;
    
    modal.show();
    
    // Fetch data from server
    fetch(`/admin/keuangan/detail-transaksi/${idTransaksi}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const transaksi = data.data.transaksi;
                const detail = data.data.detail;
                
                let detailRows = '';
                if (detail && detail.length > 0) {
                    detail.forEach(item => {
                        detailRows += `
                            <tr>
                                <td>${item.nama_barang}</td>
                                <td>${item.jumlah_barang}</td>
                                <td>Rp ${parseInt(item.harga_satuan).toLocaleString('id-ID')}</td>
                                <td>Rp ${parseInt(item.total_harga).toLocaleString('id-ID')}</td>
                            </tr>
                        `;
                    });
                } else {
                    detailRows = '<tr><td colspan="4" class="text-center">Tidak ada detail produk</td></tr>';
                }
                
                modalBody.innerHTML = `
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Informasi Transaksi</h6>
                            <table class="table table-borderless">
                                <tr><td><strong>ID Transaksi:</strong></td><td>#${transaksi.id_transaksi}</td></tr>
                                <tr><td><strong>Tanggal:</strong></td><td>${new Date(transaksi.tanggal_transaksi).toLocaleDateString('id-ID')}</td></tr>
                                <tr><td><strong>Jenis:</strong></td><td>${transaksi.jenis_transaksi || 'PENJUALAN'}</td></tr>
                                <tr><td><strong>Keterangan:</strong></td><td>${transaksi.keterangan || 'Penjualan toko'}</td></tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6>Informasi Pelanggan</h6>
                            <table class="table table-borderless">
                                <tr><td><strong>Nama:</strong></td><td>${transaksi.nama_pelanggan}</td></tr>
                                <tr><td><strong>Cabang:</strong></td><td>${transaksi.nama_cabang}</td></tr>
                                <tr><td><strong>Total:</strong></td><td><strong>Rp ${parseInt(transaksi.total_belanja).toLocaleString('id-ID')}</strong></td></tr>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <h6>Detail Produk</h6>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${detailRows}
                            </tbody>
                        </table>
                    </div>
                `;
            } else {
                modalBody.innerHTML = `
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        ${data.error || 'Gagal memuat detail transaksi'}
                    </div>
                `;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            modalBody.innerHTML = `
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Terjadi kesalahan saat memuat data
                </div>
            `;
        });
}

// Cetak Struk
function cetakStruk(idTransaksi) {
    // Show loading toast
    showToast('Menyiapkan struk untuk dicetak...', 'info');
    
    // Open print window directly from server
    const printUrl = `/admin/keuangan/cetak-struk/${idTransaksi}`;
    const printWindow = window.open(printUrl, '_blank', 'width=800,height=600');
    
    if (printWindow) {
        printWindow.addEventListener('load', function() {
            setTimeout(() => {
                printWindow.print();
                showToast('Struk berhasil dicetak!', 'success');
            }, 1000);
        });
    } else {
        showToast('Popup diblokir. Silakan izinkan popup untuk mencetak struk.', 'error');
    }
}

// Hapus Transaksi
let deleteTransaksiId = null;

function hapusTransaksi(idTransaksi) {
    deleteTransaksiId = idTransaksi;
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

// Toast notification function
function showToast(message, type = 'info') {
    // Create toast container if it doesn't exist
    let toastContainer = document.getElementById('toastContainer');
    if (!toastContainer) {
        toastContainer = document.createElement('div');
        toastContainer.id = 'toastContainer';
        toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
        toastContainer.style.zIndex = '9999';
        document.body.appendChild(toastContainer);
    }
    
    // Create toast
    const toastId = 'toast-' + Date.now();
    const bgClass = type === 'success' ? 'bg-success' : type === 'error' ? 'bg-danger' : 'bg-info';
    
    const toastHtml = `
        <div id="${toastId}" class="toast ${bgClass} text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header ${bgClass} text-white border-0">
                <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-triangle' : 'info-circle'} me-2"></i>
                <strong class="me-auto">Notifikasi</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body">
                ${message}
            </div>
        </div>
    `;
    
    toastContainer.insertAdjacentHTML('beforeend', toastHtml);
    
    // Show toast
    const toastElement = new bootstrap.Toast(document.getElementById(toastId));
    toastElement.show();
    
    // Remove toast element after it's hidden
    document.getElementById(toastId).addEventListener('hidden.bs.toast', function() {
        this.remove();
    });
}

// Enhanced Pagination Functionality
document.addEventListener('DOMContentLoaded', function() {
    // Konfirmasi hapus event listener
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    if (confirmDeleteBtn) {
        confirmDeleteBtn.addEventListener('click', function() {
            if (deleteTransaksiId) {
                // Show loading
                this.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Menghapus...';
                this.disabled = true;
                
                // AJAX call to delete
                fetch(`/admin/keuangan/hapus-transaksi/${deleteTransaksiId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast('Transaksi berhasil dihapus!', 'success');
                        
                        // Close modal
                        bootstrap.Modal.getInstance(document.getElementById('deleteModal')).hide();
                        
                        // Reload page after short delay
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    } else {
                        showToast(data.error || 'Gagal menghapus transaksi', 'error');
                        
                        // Reset button state
                        this.innerHTML = 'Hapus';
                        this.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Terjadi kesalahan saat menghapus transaksi', 'error');
                    
                    // Reset button state
                    this.innerHTML = 'Hapus';
                    this.disabled = false;
                });
            }
        });
    }
    
    // Add loading state for pagination links
    const paginationLinks = document.querySelectorAll('.pagination .page-link');
    
    paginationLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Don't prevent default, but add loading state
            if (!this.closest('.page-item').classList.contains('disabled')) {
                // Add loading indicator
                const originalContent = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                
                // Show loading on the table
                const tableContainer = document.querySelector('.new-table-container');
                if (tableContainer) {
                    tableContainer.style.opacity = '0.6';
                    tableContainer.style.pointerEvents = 'none';
                }
                
                // Reset if page doesn't load (fallback)
                setTimeout(() => {
                    this.innerHTML = originalContent;
                    if (tableContainer) {
                        tableContainer.style.opacity = '1';
                        tableContainer.style.pointerEvents = 'auto';
                    }
                }, 10000); // 10 second timeout
            }
        });
    });
    
    // Add smooth scroll to top when pagination is clicked
    const paginationContainer = document.querySelector('.pagination-container');
    if (paginationContainer) {
        paginationContainer.addEventListener('click', function(e) {
            if (e.target.closest('.page-link') && !e.target.closest('.page-item').classList.contains('disabled')) {
                setTimeout(() => {
                    window.scrollTo({
                        top: document.querySelector('.new-table-container').offsetTop - 100,
                        behavior: 'smooth'
                    });
                }, 100);
            }
        });
    }
    
    // Keyboard navigation for pagination
    document.addEventListener('keydown', function(e) {
        if (e.ctrlKey) {
            const currentPage = document.querySelector('.page-item.active .page-link');
            let targetLink = null;
            
            switch(e.key) {
                case 'ArrowLeft':
                    // Previous page
                    targetLink = document.querySelector('.pagination .page-item:first-child .page-link');
                    break;
                case 'ArrowRight':
                    // Next page
                    targetLink = document.querySelector('.pagination .page-item:last-child .page-link');
                    break;
            }
            
            if (targetLink && !targetLink.closest('.page-item').classList.contains('disabled')) {
                e.preventDefault();
                targetLink.click();
            }
        }
    });
    
    // Add tooltip for pagination info
    const paginationInfo = document.querySelector('.pagination-info');
    if (paginationInfo) {
        paginationInfo.title = 'Informasi halaman saat ini';
    }
    
    // Responsive font sizing untuk angka panjang
    function adjustNumberFontSize() {
        const numberElements = document.querySelectorAll('.new-stat-number');
        
        numberElements.forEach(function(element) {
            const text = element.textContent.trim();
            const length = text.length;
            
            // Reset classes
            element.classList.remove('long-number', 'very-long-number', 'extra-long-number');
            
            // Apply appropriate class based on length
            if (length > 20) {
                element.classList.add('extra-long-number');
            } else if (length > 15) {
                element.classList.add('very-long-number');
            } else if (length > 12) {
                element.classList.add('long-number');
            }
        });
    }
    
    // Run on page load
    adjustNumberFontSize();
    
    // Run again after any dynamic content updates
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'childList') {
                adjustNumberFontSize();
            }
        });
    });
    
    // Start observing
    const statsContainer = document.querySelector('.row.g-4');
    if (statsContainer) {
        observer.observe(statsContainer, {
            childList: true,
            subtree: true
        });
    }
    
    // Enhanced Search and Filter Functionality
    const filterForm = document.getElementById('filterForm');
    const searchInput = document.getElementById('search');
    const periodeSelect = document.getElementById('periode');
    const statusSelect = document.getElementById('status');
    const metodeSelect = document.getElementById('metode');
    
    // Auto-submit form when dropdown changes
    function autoSubmitForm() {
        filterForm.submit();
    }
    
    // Add event listeners for dropdowns
    if (periodeSelect) {
        periodeSelect.addEventListener('change', autoSubmitForm);
    }
    
    if (statusSelect) {
        statusSelect.addEventListener('change', autoSubmitForm);
    }
    
    if (metodeSelect) {
        metodeSelect.addEventListener('change', autoSubmitForm);
    }
    
    // Debounced search for text input
    let searchTimeout;
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(function() {
                filterForm.submit();
            }, 500); // Wait 500ms after user stops typing
        });
        
        // Submit on Enter key
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                clearTimeout(searchTimeout);
                filterForm.submit();
            }
        });
    }
    
    // Show loading indicator during form submission
    if (filterForm) {
        filterForm.addEventListener('submit', function() {
            const submitBtn = filterForm.querySelector('.search-btn');
            if (submitBtn) {
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span class="d-none d-sm-inline">Mencari...</span>';
                submitBtn.disabled = true;
                
                // Re-enable after 3 seconds as fallback
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 3000);
            }
        });
    }
    
    // Highlight active filters
    function highlightActiveFilters() {
        const urlParams = new URLSearchParams(window.location.search);
        
        // Highlight search input if has value
        if (searchInput && urlParams.get('search')) {
            searchInput.style.borderColor = '#f26b37';
            searchInput.style.backgroundColor = '#fef9f7';
        }
        
        // Highlight dropdowns if not default
        [periodeSelect, statusSelect, metodeSelect].forEach(select => {
            if (select && select.value !== '') {
                select.style.borderColor = '#f26b37';
                select.style.backgroundColor = '#fef9f7';
            }
        });
        
        // Show filter count
        const filterCount = [...urlParams.entries()].filter(([key, value]) => 
            value !== '' && ['search', 'periode', 'status', 'metode'].includes(key)
        ).length;
        
        if (filterCount > 0) {
            const filterIndicator = document.createElement('div');
            filterIndicator.className = 'filter-indicator';
            filterIndicator.innerHTML = `<small class="text-primary"><i class="fas fa-filter"></i> ${filterCount} filter aktif</small>`;
            filterIndicator.style.cssText = 'text-align: center; margin-top: 10px; font-weight: 600;';
            
            const searchBar = document.querySelector('.search-filter-bar');
            if (searchBar && !searchBar.querySelector('.filter-indicator')) {
                searchBar.appendChild(filterIndicator);
            }
        }
    }
    
    // Run highlight function
    highlightActiveFilters();
    
    // Preserve scroll position when returning from other pages
    const scrollPosition = sessionStorage.getItem('riwayat_scroll_position');
    if (scrollPosition) {
        window.scrollTo(0, parseInt(scrollPosition));
        sessionStorage.removeItem('riwayat_scroll_position');
    }
    
    // Save scroll position before leaving
    window.addEventListener('beforeunload', function() {
        sessionStorage.setItem('riwayat_scroll_position', window.scrollY);
    });
});
</script>
@endsection
