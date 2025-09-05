@extends('layouts.navbar_admin')

@section('title', 'Data Barang - MyYOGYA')

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

/* FORCE NEW DASHBOARD STYLES - EXACT MATCH WITH DAFTAR PENGGUNA */
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
    margin-bottom: 30px !important;
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

/* ROW AND COLUMN LAYOUT - EXACT MATCH WITH DAFTAR PENGGUNA */
.row.g-4 {
    margin: 0 -15px !important;
    margin-bottom: 10px !important;
}

.row.g-4 > .col-lg-3 {
    padding: 0 15px !important;
    margin-bottom: 0px !important;
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

.change-danger {
    background: #fecaca !important;
    color: #dc2626 !important;
}

/* SEARCH FILTER BAR - EXACT MATCH WITH DAFTAR PENGGUNA */
.search-filter-bar {
    background: white !important;
    padding: 25px 30px !important;
    border-radius: 15px !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
    border: 1px solid #e2e8f0 !important;
    margin-bottom: 30px !important;
}

body.dark-mode .search-filter-bar {
    background: #2a2d3f !important;
    border-color: #374151 !important;
    color: #e2e8f0 !important;
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
    color: #d1d5db !important;
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
    text-decoration: none !important;
    min-width: 80px !important;
    justify-content: center !important;
}

.btn-outline-secondary:hover {
    background: #6c757d !important;
    color: white !important;
    transform: translateY(-1px) !important;
}

body.dark-mode .btn-outline-secondary {
    background: #374151 !important;
    border-color: #4b5563 !important;
    color: #9ca3af !important;
}

body.dark-mode .btn-outline-secondary:hover {
    background: #4b5563 !important;
    border-color: #6b7280 !important;
    color: #d1d5db !important;
}

/* Responsive adjustments for search bar */
@media (max-width: 768px) {
    .search-filter-bar {
        padding: 20px !important;
    }
    
    .search-filter-bar .form-control,
    .search-filter-bar .form-select {
        font-size: 0.8rem !important;
        padding: 10px 12px !important;
    }
    
    .search-filter-bar .col-md-4,
    .search-filter-bar .col-md-2 {
        width: 100% !important;
        margin-bottom: 15px !important;
    }
}

/* MAIN CARD STYLING - EXACT MATCH WITH DAFTAR PENGGUNA */
.new-card {
    background: white !important;
    border-radius: 15px !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
    border: 1px solid #e2e8f0 !important;
    overflow: hidden !important;
    position: relative !important;
}

body.dark-mode .new-card {
    background: #2a2d3f !important;
    border-color: #374151 !important;
    color: #e2e8f0 !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3) !important;
}

.new-card-header {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%) !important;
    padding: 20px 25px !important;
    border-bottom: 2px solid #e2e8f0 !important;
    font-weight: bold !important;
    color: #1e293b !important;
    font-size: 1.1rem !important;
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
}

body.dark-mode .new-card-header {
    background: linear-gradient(135deg, #374151 0%, #4b5563 100%) !important;
    border-color: #4b5563 !important;
    color: #f9fafb !important;
}

.new-card-header i {
    color: #f26b37 !important;
    font-size: 1.2rem !important;
}

.new-card-title i {
    color: #f26b37 !important;
    font-size: 1.1rem !important;
}

.new-card-body {
    padding: 0 !important;
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
    border-bottom-color: #374151 !important;
    color: #e2e8f0 !important;
}
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
    color: #9ca3af !important;
}

/* Avatar styling in table */
.table .avatar {
    width: 40px !important;
    height: 40px !important;
    border-radius: 50% !important;
    object-fit: cover !important;
    border: 2px solid #e2e8f0 !important;
}

.table .avatar-fallback {
    width: 40px !important;
    height: 40px !important;
    border-radius: 50% !important;
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%) !important;
    color: white !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-weight: bold !important;
    font-size: 1rem !important;
}

/* Badge styling in table */
.table .badge {
    font-size: 0.7rem !important;
    padding: 6px 10px !important;
    border-radius: 12px !important;
    font-weight: 500 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
}

/* Status badges */
.badge.bg-success {
    background: #dcfce7 !important;
    color: #15803d !important;
    border: 1px solid #bbf7d0 !important;
}

.badge.bg-danger {
    background: #fee2e2 !important;
    color: #dc2626 !important;
    border: 1px solid #fecaca !important;
}

.badge.bg-warning {
    background: #fef3c7 !important;
    color: #d97706 !important;
    border: 1px solid #fde68a !important;
}

.badge.bg-info {
    background: #dbeafe !important;
    color: #1d4ed8 !important;
    border: 1px solid #93c5fd !important;
}

.badge.bg-secondary {
    background: #f1f5f9 !important;
    color: #64748b !important;
    border: 1px solid #e2e8f0 !important;
}

body.dark-mode .badge.bg-success {
    background: rgba(34, 197, 94, 0.1) !important;
    color: #4ade80 !important;
    border-color: rgba(34, 197, 94, 0.2) !important;
}

body.dark-mode .badge.bg-danger {
    background: rgba(239, 68, 68, 0.1) !important;
    color: #f87171 !important;
    border-color: rgba(239, 68, 68, 0.2) !important;
}

body.dark-mode .badge.bg-warning {
    background: rgba(217, 119, 6, 0.1) !important;
    color: #fbbf24 !important;
    border-color: rgba(217, 119, 6, 0.2) !important;
}

body.dark-mode .badge.bg-info {
    background: rgba(29, 78, 216, 0.1) !important;
    color: #60a5fa !important;
    border-color: rgba(29, 78, 216, 0.2) !important;
}

body.dark-mode .badge.bg-secondary {
    background: rgba(148, 163, 184, 0.1) !important;
    color: #94a3b8 !important;
    border-color: rgba(148, 163, 184, 0.2) !important;
}

/* PAGINATION STYLING - EXACT MATCH WITH DAFTAR PENGGUNA */
.pagination-container {
    padding: 20px 25px !important;
    background: #f8fafc !important;
    border-top: 1px solid #e2e8f0 !important;
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    flex-wrap: wrap !important;
    gap: 15px !important;
}

body.dark-mode .pagination-container {
    background: #374151 !important;
    border-color: #4b5563 !important;
}

.pagination-info {
    color: #64748b !important;
    font-size: 0.9rem !important;
    font-weight: 500 !important;
}

body.dark-mode .pagination-info {
    color: #9ca3af !important;
}

.pagination-wrapper .pagination {
    margin: 0 !important;
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
@media (max-width: 768px) {
    .pagination-container {
        flex-direction: column !important;
        text-align: center !important;
        gap: 10px !important;
    }
    
    .pagination .page-item .page-link {
        padding: 6px 10px !important;
        font-size: 0.8rem !important;
    }
}

/* Fix any overflow or spacing issues */
.table-responsive {
    border-radius: 0 !important;
    border: none !important;
    box-shadow: none !important;
}

/* Ensure consistent row heights and alignment */
.table tbody td {
    vertical-align: middle !important;
}

/* NEW CARD STYLING - EXACT MATCH WITH DAFTAR PENGGUNA */
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
</style>

<div class="new-pengguna">
    <!-- Header dengan Real Time Clock -->
    <div class="new-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h1>
                    <i class="fas fa-boxes me-3"></i>
                    Data Barang
                </h1>
                <p>Kelola inventaris dan stok barang di toko dengan mudah dan efisien.</p>
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
                    <i class="fas fa-boxes"></i>
                </div>
                <div class="new-stat-number">1,847</div>
                <div class="new-stat-label">Total Barang</div>
                <div class="new-stat-change change-positive">
                    <i class="fas fa-box-open"></i> Aktif
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="new-stat-number">1,634</div>
                <div class="new-stat-label">Stok Tersedia</div>
                <div class="new-stat-change change-positive">
                    <i class="fas fa-warehouse"></i> In Stock
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="new-stat-number">89</div>
                <div class="new-stat-label">Stok Menipis</div>
                <div class="new-stat-change change-warning">
                    <i class="fas fa-low-vision"></i> Low Stock
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div class="new-stat-number">124</div>
                <div class="new-stat-label">Stok Habis</div>
                <div class="new-stat-change change-negative">
                    <i class="fas fa-ban"></i> Out of Stock
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="search-filter-bar">
        <form method="GET" action="">
            <div class="row g-2 align-items-end">
                <div class="col-md-4">
                    <label for="search" class="form-label">Cari Barang</label>
                    <input type="text" class="form-control" id="search" name="search" 
                           placeholder="Nama barang, kode SKU, kategori, atau merk..." value="">
                </div>
                <div class="col-md-2">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select class="form-select" id="kategori" name="kategori">
                        <option value="">Semua Kategori</option>
                        <option value="elektronik">Elektronik</option>
                        <option value="fashion">Fashion</option>
                        <option value="makanan">Makanan & Minuman</option>
                        <option value="rumah-tangga">Rumah Tangga</option>
                        <option value="olahraga">Olahraga</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="status" class="form-label">Status Stok</label>
                    <select class="form-select" id="status" name="status">
                        <option value="">Semua Status</option>
                        <option value="tersedia">Tersedia</option>
                        <option value="stok-rendah">Stok Rendah</option>
                        <option value="habis">Habis</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="merk" class="form-label">Merk</label>
                    <select class="form-select" id="merk" name="merk">
                        <option value="">Semua Merk</option>
                        <option value="samsung">Samsung</option>
                        <option value="lg">LG</option>
                        <option value="sony">Sony</option>
                        <option value="nike">Nike</option>
                        <option value="adidas">Adidas</option>
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
                        Daftar Data Barang
                    </div>
                </div>
                <div class="new-card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Barang</th>
                                    <th>Kode SKU</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Status</th>
                                    <th style="text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-fallback me-3">S55</div>
                                    <div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>Samsung Galaxy A55 5G</strong>
                                            <small class="text-muted">samsung-galaxy-a55-5g-128gb</small>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <strong>SAMS-A55-128</strong>
                                    <small class="text-muted">8801643670958</small>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <strong>Elektronik</strong>
                                    <small class="text-muted">Smartphone</small>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <strong>Rp 4.299.000</strong>
                                    <small class="text-muted">Margin: 15%</small>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <strong>47 unit</strong>
                                    <small class="text-success">Cukup tersedia</small>
                                </div>
                            </td>
                            <td>
                                <span class="badge" style="background: #dcfce7; color: #15803d; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">Aktif</span>
                            </td>
                            <td style="text-align: center;">
                                <button class="btn btn-sm" style="background: none; border: none; color: #64748b; padding: 4px;">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-fallback me-3">RT</div>
                                    <div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>Rinso Total Clean 800g</strong>
                                            <small class="text-muted">rinso-total-clean-detergen-800g</small>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <strong>RINSO-TC-800</strong>
                                    <small class="text-muted">8999999015435</small>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <strong>Rumah Tangga</strong>
                                    <small class="text-muted">Detergent</small>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <strong>Rp 18.500</strong>
                                    <small class="text-muted">Margin: 12%</small>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <strong>234 unit</strong>
                                    <small class="text-success">Stok aman</small>
                                </div>
                            </td>
                            <td>
                                <span class="badge" style="background: #dcfce7; color: #15803d; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">Aktif</span>
                            </td>
                            <td style="text-align: center;">
                                <button class="btn btn-sm" style="background: none; border: none; color: #64748b; padding: 4px;">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-fallback me-3">LP</div>
                                    <div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>L'Oreal Paris Rouge</strong>
                                            <small class="text-muted">loreal-rouge-lipstick-matte-red</small>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <strong>LOR-LIP-RED01</strong>
                                    <small class="text-muted">3600523351394</small>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <strong>Kosmetik</strong>
                                    <small class="text-muted">Lipstick</small>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <strong>Rp 89.000</strong>
                                    <small class="text-muted">Margin: 25%</small>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <strong>8 unit</strong>
                                    <small class="text-warning">Stok menipis</small>
                                </div>
                            </td>
                            <td>
                                <span class="badge" style="background: #fef3c7; color: #d97706; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">Menipis</span>
                            </td>
                            <td style="text-align: center;">
                                <button class="btn btn-sm" style="background: none; border: none; color: #64748b; padding: 4px;">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-fallback me-3">NK</div>
                                    <div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>Nike Air Max 270</strong>
                                            <small class="text-muted">nike-air-max-270-black-white-43</small>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <strong>NIKE-AM270-43</strong>
                                    <small class="text-muted">192499806829</small>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <strong>Fashion</strong>
                                    <small class="text-muted">Sepatu Olahraga</small>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <strong>Rp 1.999.000</strong>
                                    <small class="text-muted">Margin: 20%</small>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <strong>0 unit</strong>
                                    <small class="text-danger">Stok habis</small>
                                </div>
                            </td>
                            <td>
                                <span class="badge" style="background: #fee2e2; color: #dc2626; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">Habis</span>
                            </td>
                            <td style="text-align: center;">
                                <button class="btn btn-sm" style="background: none; border: none; color: #64748b; padding: 4px;">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-fallback me-3">IC</div>
                                    <div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>Indomie Goreng Original</strong>
                                            <small class="text-muted">indomie-mie-instan-goreng-85g</small>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <strong>INDO-GRNL-85G</strong>
                                    <small class="text-muted">8993175125437</small>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <strong>Makanan</strong>
                                    <small class="text-muted">Mie Instan</small>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <strong>Rp 3.500</strong>
                                    <small class="text-muted">Margin: 8%</small>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <strong>486 unit</strong>
                                    <small class="text-success">Stok melimpah</small>
                                </div>
                            </td>
                            <td>
                                <span class="badge" style="background: #dcfce7; color: #15803d; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">Aktif</span>
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
                    Menampilkan 5 dari 1,847 data barang
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

            <!-- Tabel Kedua: Daftar Supplier & Pembelian -->
            <div class="new-card mt-4">
                <div class="new-card-header">
                    <div class="new-card-title">
                        <i class="fas fa-building"></i>
                        Daftar Supplier & Pembelian Terbaru
                    </div>
                </div>
                <div class="new-card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Supplier</th>
                                    <th>Produk</th>
                                    <th>Tanggal Pembelian</th>
                                    <th>Jumlah</th>
                                    <th>Harga Satuan</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <strong>PT. Samsung Indonesia</strong>
                                            <small class="text-muted">Supplier Elektronik</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('images/samsung-a54.jpg') }}" alt="Product" class="rounded me-3" style="width: 40px; height: 40px; object-fit: cover;">
                                            <div>
                                                <strong>Smartphone Samsung A54</strong>
                                                <br><small class="text-muted">SKU: ELK-001</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>25 Agustus 2025</td>
                                    <td>100 unit</td>
                                    <td>Rp 3.750.000</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <strong>Rp 375.000.000</strong>
                                            <small class="text-success">Lunas</small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #dcfce7; color: #15803d; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">Diterima</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <strong>PT. LG Electronics</strong>
                                            <small class="text-muted">Supplier Elektronik</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('images/lg-tv.jpg') }}" alt="Product" class="rounded me-3" style="width: 40px; height: 40px; object-fit: cover;">
                                            <div>
                                                <strong>Televisi LG 43 inch</strong>
                                                <br><small class="text-muted">SKU: ELK-002</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>28 Agustus 2025</td>
                                    <td>50 unit</td>
                                    <td>Rp 6.200.000</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <strong>Rp 310.000.000</strong>
                                            <small class="text-warning">Cicilan</small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #fef3c7; color: #d97706; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">Dalam Perjalanan</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <strong>PT. ASUS Indonesia</strong>
                                            <small class="text-muted">Supplier Komputer</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('images/asus-laptop.jpg') }}" alt="Product" class="rounded me-3" style="width: 40px; height: 40px; object-fit: cover;">
                                            <div>
                                                <strong>Laptop ASUS VivoBook</strong>
                                                <br><small class="text-muted">SKU: ELK-003</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>30 Agustus 2025</td>
                                    <td>25 unit</td>
                                    <td>Rp 8.500.000</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <strong>Rp 212.500.000</strong>
                                            <small class="text-danger">Belum bayar</small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #fee2e2; color: #dc2626; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">Tertunda</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tabel Ketiga: Analisis Penjualan Produk -->
            <div class="new-card mt-4">
                <div class="new-card-header">
                    <div class="new-card-title">
                        <i class="fas fa-chart-line"></i>
                        Analisis Penjualan Produk (30 Hari Terakhir)
                    </div>
                </div>
                <div class="new-card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Produk</th>
                                    <th>Terjual</th>
                                    <th>Revenue</th>
                                    <th>Profit</th>
                                    <th>Growth</th>
                                    <th>Rating</th>
                                    <th>Trend</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('images/samsung-a54.jpg') }}" alt="Product" class="rounded me-3" style="width: 40px; height: 40px; object-fit: cover;">
                                            <div>
                                                <strong>Smartphone Samsung A54</strong>
                                                <br><small class="text-muted">Kategori: Elektronik</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <strong>47 unit</strong>
                                            <small class="text-success">Target tercapai</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <strong>Rp 202.053.000</strong>
                                            <small class="text-muted">Avg: Rp 4.299.000</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <strong class="text-success">Rp 30.308.000</strong>
                                            <small class="text-muted">Margin: 15%</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-arrow-up text-success me-1"></i>
                                            <strong class="text-success">+23%</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="me-2">⭐⭐⭐⭐⭐</span>
                                            <small>4.8/5</small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #dcfce7; color: #15803d; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">🔥 Hot</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('images/lg-tv.jpg') }}" alt="Product" class="rounded me-3" style="width: 40px; height: 40px; object-fit: cover;">
                                            <div>
                                                <strong>Televisi LG 43 inch</strong>
                                                <br><small class="text-muted">Kategori: Elektronik</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <strong>234 unit</strong>
                                            <small class="text-success">Best seller</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <strong>Rp 1.521.600.000</strong>
                                            <small class="text-muted">Avg: Rp 6.500.000</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <strong class="text-success">Rp 136.944.000</strong>
                                            <small class="text-muted">Margin: 9%</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-arrow-up text-success me-1"></i>
                                            <strong class="text-success">+45%</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="me-2">⭐⭐⭐⭐</span>
                                            <small>4.3/5</small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #dcfce7; color: #15803d; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">📈 Rising</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('images/asus-laptop.jpg') }}" alt="Product" class="rounded me-3" style="width: 40px; height: 40px; object-fit: cover;">
                                            <div>
                                                <strong>Laptop ASUS VivoBook</strong>
                                                <br><small class="text-muted">Kategori: Komputer</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <strong>8 unit</strong>
                                            <small class="text-warning">Kurang diminati</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <strong>Rp 76.800.000</strong>
                                            <small class="text-muted">Avg: Rp 9.600.000</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <strong class="text-warning">Rp 6.144.000</strong>
                                            <small class="text-muted">Margin: 8%</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-arrow-down text-danger me-1"></i>
                                            <strong class="text-danger">-12%</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="me-2">⭐⭐⭐</span>
                                            <small>3.9/5</small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #fef3c7; color: #d97706; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">📉 Declining</span>
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
    document.getElementById('kategori').value = '';
    document.getElementById('status').value = '';
    document.getElementById('brand').value = '';
}
</script>
@endsection
