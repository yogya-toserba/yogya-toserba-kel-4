@extends('layouts.navbar_admin')

@section('title', 'Log Aktivitas - MyYOGYA')

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

/* TABLE STYLING - EXACT MATCH ABSENSI WITH SYMMETRICAL COLUMNS */
.table {
    border-collapse: separate !important;
    border-spacing: 0 !important;
    background: white !important;
    color: #1e293b !important;
    margin: 0 !important;
    table-layout: fixed !important;
    width: 100% !important;
}

/* Main table column widths for better symmetry */
.table thead th:nth-child(1) { width: 22% !important; } /* User/Activity */
.table thead th:nth-child(2) { width: 18% !important; } /* Action Type */
.table thead th:nth-child(3) { width: 15% !important; } /* Module */
.table thead th:nth-child(4) { width: 20% !important; } /* Details */
.table thead th:nth-child(5) { width: 12% !important; } /* IP Address */
.table thead th:nth-child(6) { width: 8% !important; }  /* Time */
.table thead th:nth-child(7) { width: 5% !important; }  /* Aksi */

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
    word-wrap: break-word !important;
    overflow-wrap: break-word !important;
    vertical-align: top !important;
}

/* Ensure text doesn't overflow in fixed columns */
.table td, .table th {
    overflow: hidden !important;
    text-overflow: ellipsis !important;
    white-space: nowrap !important;
}

/* Allow wrapping for longer content in specific columns */
.table td:nth-child(4), /* Details column */
.table td:nth-child(1) { /* User/Activity column */
    white-space: normal !important;
}

/* Supporting tables specific styling */
.row.mt-4 .table td,
.row.mt-4 .table th {
    white-space: normal !important;
}

/* Vertical alignment and height consistency for tables */
.table thead th {
    border: none !important;
    padding: 15px 12px !important;
    font-size: 0.8rem !important;
    font-weight: 600 !important;
    color: #64748b !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    background: #f8fafc !important;
    vertical-align: middle !important;
    height: 60px !important; /* Fixed header height */
}

.table tbody td {
    border: none !important;
    padding: 20px 12px !important; /* Increased padding for better alignment */
    font-size: 0.85rem !important;
    color: #1e293b !important;
    border-bottom: 1px solid #f1f5f9 !important;
    background: inherit !important;
    word-wrap: break-word !important;
    overflow-wrap: break-word !important;
    vertical-align: middle !important; /* Center align content vertically */
    min-height: 80px !important; /* Consistent row height */
}

/* Ensure all table rows have consistent height */
.table tbody tr {
    border: none !important;
    transition: all 0.2s ease !important;
    background: white !important;
    min-height: 80px !important;
}

/* Avatar and content alignment */
.table .d-flex.align-items-center {
    align-items: center !important;
    min-height: 50px !important;
}

.table .d-flex.align-items-center > div:last-child {
    display: flex !important;
    flex-direction: column !important;
    justify-content: center !important;
}

/* Badge vertical centering */
.table .badge {
    font-size: 0.7rem !important;
    padding: 6px 10px !important; /* Slightly larger padding */
    border-radius: 12px !important;
    font-weight: 500 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
}

/* Text content vertical alignment */
.table td strong,
.table td small {
    line-height: 1.4 !important;
    display: block !important;
}

.table td strong {
    margin-bottom: 4px !important;
}

.table td small {
    margin-top: 2px !important;
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

/* Dot Menu Button Styling - EXACT MATCH ABSENSI */
.btn-menu {
    background: none !important;
    border: none !important;
    color: #64748b !important;
    padding: 4px 6px !important;
    font-size: 14px !important;
    cursor: pointer !important;
    border-radius: 4px !important;
    transition: all 0.2s ease !important;
}

.btn-menu:hover {
    background: rgba(100, 116, 139, 0.1) !important;
    color: #374151 !important;
}

body.dark-mode .btn-menu {
    color: #9ca3af !important;
}

body.dark-mode .btn-menu:hover {
    background: rgba(156, 163, 175, 0.1) !important;
    color: #d1d5db !important;
}

/* Badge Styling - EXACT MATCH ABSENSI */
.table .badge {
    font-size: 0.7rem !important;
    padding: 4px 8px !important;
    border-radius: 12px !important;
    font-weight: 500 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
}

/* Avatar Circle - EXACT MATCH ABSENSI */
.avatar-circle {
    width: 35px !important;
    height: 35px !important;
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%) !important;
    border-radius: 50% !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    color: white !important;
    font-weight: bold !important;
    margin-right: 10px !important;
    font-size: 0.8rem !important;
}

/* PAGINATION STYLING - EXACT MATCH ABSENSI */
.pagination-container {
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    margin-top: 30px !important;
    padding: 0 5px !important;
}

.pagination-info {
    color: #64748b !important;
    font-size: 0.9rem !important;
    font-weight: 500 !important;
}

body.dark-mode .pagination-info {
    color: #9ca3af !important;
}

.pagination {
    margin: 0 !important;
    gap: 4px !important;
}

.pagination .page-item {
    margin: 0 !important;
}

.pagination .page-link {
    border: 1px solid #e5e7eb !important;
    color: #6b7280 !important;
    padding: 8px 12px !important;
    margin: 0 2px !important;
    border-radius: 8px !important;
    background: white !important;
    font-size: 0.9rem !important;
    font-weight: 500 !important;
    transition: all 0.2s ease !important;
    min-width: 40px !important;
    text-align: center !important;
    text-decoration: none !important;
}

.pagination .page-link:hover {
    background: #f9fafb !important;
    border-color: #d1d5db !important;
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

/* Vertical spacing between tables */
.row.mt-4 {
    margin-top: 2rem !important;
}

.row.mt-4 + .row.mt-4 {
    margin-top: 1.5rem !important;
}

/* Full width tables styling */
.row .col-12 .new-card {
    margin-bottom: 0 !important;
}

.row.mt-4:last-child .new-card {
    margin-bottom: 30px !important;
}

/* Table container improvements */
.table-responsive {
    border-radius: 12px !important;
    overflow-x: auto !important;
}

.table-responsive::-webkit-scrollbar {
    height: 8px !important;
}

.table-responsive::-webkit-scrollbar-track {
    background: #f1f5f9 !important;
    border-radius: 4px !important;
}

.table-responsive::-webkit-scrollbar-thumb {
    background: #d1d5db !important;
    border-radius: 4px !important;
}

.table-responsive::-webkit-scrollbar-thumb:hover {
    background: #9ca3af !important;
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
    
    /* Adjust table columns for tablet */
    .table thead th:nth-child(1) { width: 25% !important; }
    .table thead th:nth-child(2) { width: 20% !important; }
    .table thead th:nth-child(3) { width: 15% !important; }
    .table thead th:nth-child(4) { width: 25% !important; }
    .table thead th:nth-child(5) { width: 10% !important; }
    .table thead th:nth-child(6) { width: 5% !important; }
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
    
    /* Mobile table adjustments */
    .table {
        table-layout: auto !important;
    }
    
    .table thead th,
    .table tbody td {
        padding: 10px 8px !important;
        font-size: 0.8rem !important;
    }
    
    .table td, .table th {
        white-space: normal !important;
    }
}
</style>

<div class="new-pengguna">
    <!-- Header Section -->
    <div class="new-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h1><i class="fas fa-chart-line me-3"></i>Log Aktivitas</h1>
                <p>Monitoring dan Tracking Aktivitas User MyYOGYA</p>
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
                    <i class="fas fa-eye"></i>
                </div>
                <div class="new-stat-number">1,248</div>
                <div class="new-stat-label">Total Views</div>
                <div class="new-stat-change change-positive">
                    <i class="fas fa-arrow-up"></i> +15% Today
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-mouse-pointer"></i>
                </div>
                <div class="new-stat-number">387</div>
                <div class="new-stat-label">User Actions</div>
                <div class="new-stat-change change-positive">
                    <i class="fas fa-check-circle"></i> Active
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="new-stat-number">23</div>
                <div class="new-stat-label">Error Events</div>
                <div class="new-stat-change change-warning">
                    <i class="fas fa-exclamation"></i> Needs Check
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <div class="new-stat-number">156</div>
                <div class="new-stat-label">Security Events</div>
                <div class="new-stat-change change-neutral">
                    <i class="fas fa-lock"></i> Secure
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="search-filter-bar">
        <form method="GET" action="">
            <div class="row g-2 align-items-end">
                <div class="col-md-4">
                    <label for="search" class="form-label">Cari Aktivitas</label>
                    <input type="text" class="form-control" id="search" name="search" 
                           placeholder="User, action, IP, atau detail aktivitas..." value="">
                </div>
                <div class="col-md-2">
                    <label for="action_type" class="form-label">Tipe Aksi</label>
                    <select class="form-select" id="action_type" name="action_type">
                        <option value="">Semua Aksi</option>
                        <option value="login">Login</option>
                        <option value="logout">Logout</option>
                        <option value="create">Create</option>
                        <option value="update">Update</option>
                        <option value="delete">Delete</option>
                        <option value="view">View</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="module" class="form-label">Module</label>
                    <select class="form-select" id="module" name="module">
                        <option value="">Semua Module</option>
                        <option value="user">User Management</option>
                        <option value="product">Product</option>
                        <option value="transaction">Transaction</option>
                        <option value="membership">Membership</option>
                        <option value="report">Report</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="date_range" class="form-label">Periode</label>
                    <select class="form-select" id="date_range" name="date_range">
                        <option value="">Semua Waktu</option>
                        <option value="today">Hari Ini</option>
                        <option value="yesterday">Kemarin</option>
                        <option value="week">Minggu Ini</option>
                        <option value="month">Bulan Ini</option>
                        <option value="custom">Custom Range</option>
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
                        Recent Activity Logs
                    </div>
                </div>
                <div class="new-card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>User/Activity</th>
                                    <th>Action Type</th>
                                    <th>Module</th>
                                    <th>Details</th>
                                    <th>IP Address</th>
                                    <th>Time</th>
                                    <th style="text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle">AD</div>
                                            <div>
                                                <strong>Ahmad Dani</strong>
                                                <br><small>admin@yogya.com</small>
                                                <br><small>ID: USR001</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #dcfce7; color: #15803d;">Login</span>
                                    </td>
                                    <td>
                                        <strong>Authentication</strong>
                                        <br><small>User Session</small>
                                    </td>
                                    <td>
                                        <strong>Successful login attempt</strong>
                                        <br><small>Browser: Chrome 118.0</small>
                                    </td>
                                    <td>
                                        <strong>192.168.1.100</strong>
                                    </td>
                                    <td>
                                        <strong>2 min ago</strong>
                                        <br><small>17:45 WIB</small>
                                    </td>
                                    <td style="text-align: center;">
                                        <button class="btn btn-sm btn-menu">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle">SW</div>
                                            <div>
                                                <strong>Sari Wulandari</strong>
                                                <br><small>sari@yogya.com</small>
                                                <br><small>ID: USR002</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #dbeafe; color: #1d4ed8;">Update</span>
                                    </td>
                                    <td>
                                        <strong>Product</strong>
                                        <br><small>Inventory Mgmt</small>
                                    </td>
                                    <td>
                                        <strong>Updated product price</strong>
                                        <br><small>Product ID: PRD001 - Beras Premium</small>
                                    </td>
                                    <td>
                                        <strong>192.168.1.105</strong>
                                    </td>
                                    <td>
                                        <strong>5 min ago</strong>
                                        <br><small>17:42 WIB</small>
                                    </td>
                                    <td style="text-align: center;">
                                        <button class="btn btn-sm btn-menu">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle">RP</div>
                                            <div>
                                                <strong>Rian Pratama</strong>
                                                <br><small>rian@customer.com</small>
                                                <br><small>Customer</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #fef3c7; color: #d97706;">Create</span>
                                    </td>
                                    <td>
                                        <strong>Transaction</strong>
                                        <br><small>Purchase</small>
                                    </td>
                                    <td>
                                        <strong>New purchase transaction</strong>
                                        <br><small>Total: Rp 485,000 - 5 items</small>
                                    </td>
                                    <td>
                                        <strong>203.194.112.45</strong>
                                    </td>
                                    <td>
                                        <strong>8 min ago</strong>
                                        <br><small>17:39 WIB</small>
                                    </td>
                                    <td style="text-align: center;">
                                        <button class="btn btn-sm btn-menu">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle">MF</div>
                                            <div>
                                                <strong>Maya Fitri</strong>
                                                <br><small>maya@customer.com</small>
                                                <br><small>Gold Member</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #e0f2fe; color: #0277bd;">View</span>
                                    </td>
                                    <td>
                                        <strong>Membership</strong>
                                        <br><small>Benefits</small>
                                    </td>
                                    <td>
                                        <strong>Viewed membership benefits</strong>
                                        <br><small>Accessed discount vouchers page</small>
                                    </td>
                                    <td>
                                        <strong>114.125.214.78</strong>
                                    </td>
                                    <td>
                                        <strong>12 min ago</strong>
                                        <br><small>17:35 WIB</small>
                                    </td>
                                    <td style="text-align: center;">
                                        <button class="btn btn-sm btn-menu">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle">BH</div>
                                            <div>
                                                <strong>Budi Hartanto</strong>
                                                <br><small>budi@yogya.com</small>
                                                <br><small>Manager</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #fee2e2; color: #dc2626;">Delete</span>
                                    </td>
                                    <td>
                                        <strong>User</strong>
                                        <br><small>Staff Management</small>
                                    </td>
                                    <td>
                                        <strong>Deleted inactive user</strong>
                                        <br><small>User: test_user_old - Reason: Inactive 6 months</small>
                                    </td>
                                    <td>
                                        <strong>192.168.1.102</strong>
                                    </td>
                                    <td>
                                        <strong>15 min ago</strong>
                                        <br><small>17:32 WIB</small>
                                    </td>
                                    <td style="text-align: center;">
                                        <button class="btn btn-sm btn-menu">
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
                            Menampilkan 5 dari 1,248 log aktivitas
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

    <!-- Activity Statistics -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="new-card">
                <div class="new-card-header">
                    <div class="new-card-title">
                        <i class="fas fa-chart-bar"></i>
                        Activity Statistics by Module
                    </div>
                </div>
                <div class="new-card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" style="min-height: 400px;">
                            <thead>
                                <tr>
                                    <th>Module</th>
                                    <th>Total Actions</th>
                                    <th>Most Active Users</th>
                                    <th>Peak Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #f26b37 0%, #e55827 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; margin-right: 8px; font-size: 0.7rem;"><i class="fas fa-users" style="font-size: 10px;"></i></div>
                                            <div>
                                                <strong>User Management</strong>
                                                <br><small>Login, register, profile updates</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong style="color: #15803d;">456 actions</strong>
                                            <small>Today</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>Ahmad Dani</strong>
                                            <small>89 actions</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>09:00-12:00</strong>
                                            <small>Morning peak</small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #dcfce7; color: #15803d;">Normal</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #f26b37 0%, #e55827 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; margin-right: 8px; font-size: 0.7rem;"><i class="fas fa-shopping-cart" style="font-size: 10px;"></i></div>
                                            <div>
                                                <strong>Transaction</strong>
                                                <br><small>Purchase, payment, refund</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong style="color: #15803d;">234 actions</strong>
                                            <small>Today</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>Maya Fitri</strong>
                                            <small>45 transactions</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>14:00-17:00</strong>
                                            <small>Afternoon peak</small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #dcfce7; color: #15803d;">Active</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #f26b37 0%, #e55827 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; margin-right: 8px; font-size: 0.7rem;"><i class="fas fa-box" style="font-size: 10px;"></i></div>
                                            <div>
                                                <strong>Product Management</strong>
                                                <br><small>Create, update, delete products</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong style="color: #15803d;">178 actions</strong>
                                            <small>Today</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>Sari Wulandari</strong>
                                            <small>67 updates</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>08:00-10:00</strong>
                                            <small>Early morning</small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #fef3c7; color: #d97706;">Busy</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Security Events -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="new-card">
                <div class="new-card-header">
                    <div class="new-card-title">
                        <i class="fas fa-shield-alt"></i>
                        Recent Security Events
                    </div>
                </div>
                <div class="new-card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" style="min-height: 400px;">
                            <thead>
                                <tr>
                                    <th>Event Type</th>
                                    <th>User/Source</th>
                                    <th>IP Address</th>
                                    <th>Severity</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #f26b37 0%, #e55827 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; margin-right: 8px; font-size: 0.7rem;"><i class="fas fa-user-lock" style="font-size: 10px;"></i></div>
                                            <div>
                                                <strong>Failed Login Attempt</strong>
                                                <br><small>Multiple failed attempts</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>Unknown User</strong>
                                            <small>Email: fake@test.com</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>45.76.183.234</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #fef3c7; color: #d97706;">Medium</span>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>1 hour ago</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #dcfce7; color: #15803d;">Blocked</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #f26b37 0%, #e55827 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; margin-right: 8px; font-size: 0.7rem;"><i class="fas fa-ban" style="font-size: 10px;"></i></div>
                                            <div>
                                                <strong>IP Blacklist</strong>
                                                <br><small>Suspicious activity detected</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>Automated Bot</strong>
                                            <small>User-Agent: Bot/Scanner</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>185.220.101.42</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #fee2e2; color: #dc2626;">High</span>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>2 hours ago</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #fee2e2; color: #dc2626;">Blocked</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #f26b37 0%, #e55827 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; margin-right: 8px; font-size: 0.7rem;"><i class="fas fa-key" style="font-size: 10px;"></i></div>
                                            <div>
                                                <strong>Admin Access</strong>
                                                <br><small>Elevated privileges used</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>Ahmad Dani</strong>
                                            <small>Super Admin</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>192.168.1.100</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #dbeafe; color: #1d4ed8;">Info</span>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <strong>30 min ago</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #dcfce7; color: #15803d;">Allowed</span>
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

function resetForm() {
    const searchField = document.getElementById('search');
    const actionSelect = document.getElementById('action_type');
    const moduleSelect = document.getElementById('module');
    const dateSelect = document.getElementById('date_range');
    
    if (searchField) searchField.value = '';
    if (actionSelect) actionSelect.selectedIndex = 0;
    if (moduleSelect) moduleSelect.selectedIndex = 0;
    if (dateSelect) dateSelect.selectedIndex = 0;
}

// Update time and date immediately and then every second
updateDateTime();
setInterval(updateDateTime, 1000);
</script>
@endsection
