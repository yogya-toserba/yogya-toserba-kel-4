@extends('layouts.navbar_admin')

@section('title', 'Manage Membership - MyYOGYA')

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

/* Main table column widths for better content display */
.table thead th:nth-child(1) { width: 20% !important; } /* Level Membership */
.table thead th:nth-child(2) { width: 12% !important; } /* Min. Spending */
.table thead th:nth-child(3) { width: 25% !important; } /* Benefits - Made wider for full content */
.table thead th:nth-child(4) { width: 13% !important; } /* Members Count */
.table thead th:nth-child(5) { width: 13% !important; } /* Monthly Revenue */
.table thead th:nth-child(6) { width: 12% !important; } /* Created Date - Made wider */
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
    padding: 15px 15px !important;
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
    padding: 18px 15px !important;
    font-size: 0.85rem !important;
    color: #1e293b !important;
    border-bottom: 1px solid #f1f5f9 !important;
    background: inherit !important;
    word-wrap: break-word !important;
    overflow-wrap: break-word !important;
    vertical-align: top !important;
    min-height: 60px !important;
}

/* Ensure text doesn't overflow in fixed columns */
.table td, .table th {
    overflow: hidden !important;
    text-overflow: ellipsis !important;
    white-space: nowrap !important;
}

/* Allow wrapping for longer content in specific columns that need full display */
.table td:nth-child(3), /* Benefits column - Allow wrapping for full benefits text */
.table td:nth-child(6), /* Created Date column - Allow wrapping for full date */
.table td:nth-child(1) { /* Level Membership column */
    white-space: normal !important;
    word-wrap: break-word !important;
    overflow-wrap: break-word !important;
    line-height: 1.4 !important;
    vertical-align: top !important;
}

/* Specific styling for Benefits column badges and text */
.table td:nth-child(3) .badge {
    display: inline-block !important;
    max-width: 100% !important;
    white-space: normal !important;
    line-height: 1.3 !important;
    padding: 4px 8px !important;
    margin-bottom: 4px !important;
}

/* Ensure Created Date column shows full content */
.table td:nth-child(6) {
    min-width: 120px !important;
}

/* Supporting tables specific styling */
.row.g-4.mt-4 .table td,
.row.g-4.mt-4 .table th {
    white-space: normal !important;
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

/* Responsive table wrapper to prevent horizontal overflow */
.table-responsive {
    overflow-x: auto !important;
    -webkit-overflow-scrolling: touch !important;
}

/* Ensure table content is readable on smaller screens */
@media (max-width: 992px) {
    .table thead th:nth-child(1) { width: 18% !important; }
    .table thead th:nth-child(2) { width: 10% !important; }
    .table thead th:nth-child(3) { width: 30% !important; }
    .table thead th:nth-child(4) { width: 12% !important; }
    .table thead th:nth-child(5) { width: 12% !important; }
    .table thead th:nth-child(6) { width: 13% !important; }
    .table thead th:nth-child(7) { width: 5% !important; }
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
    .table thead th:nth-child(1) { width: 30% !important; }
    .table thead th:nth-child(2) { width: 15% !important; }
    .table thead th:nth-child(3) { width: 25% !important; }
    .table thead th:nth-child(4) { width: 15% !important; }
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
</style>

<div class="new-pengguna">
    <!-- Header Section -->
    <div class="new-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h1><i class="fas fa-id-card me-3"></i>Manage Membership</h1>
                <p>Manajemen Membership Level dan Benefit MyYOGYA</p>
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
                    <i class="fas fa-star"></i>
                </div>
                <div class="new-stat-number">4</div>
                <div class="new-stat-label">Membership Level</div>
                <div class="new-stat-change change-positive">
                    <i class="fas fa-layer-group"></i> Aktif
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-crown"></i>
                </div>
                <div class="new-stat-number">48</div>
                <div class="new-stat-label">Gold Members</div>
                <div class="new-stat-change change-warning">
                    <i class="fas fa-trophy"></i> Premium
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-medal"></i>
                </div>
                <div class="new-stat-number">28</div>
                <div class="new-stat-label">Platinum Members</div>
                <div class="new-stat-change change-positive">
                    <i class="fas fa-gem"></i> VIP
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-gift"></i>
                </div>
                <div class="new-stat-number">156</div>
                <div class="new-stat-label">Total Benefits</div>
                <div class="new-stat-change change-neutral">
                    <i class="fas fa-percent"></i> Rewards
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="search-filter-bar">
        <form method="GET" action="">
            <div class="row g-2 align-items-end">
                <div class="col-md-4">
                    <label for="search" class="form-label">Cari Membership</label>
                    <input type="text" class="form-control" id="search" name="search" 
                           placeholder="Nama level, benefit, atau minimum spending..." value="">
                </div>
                <div class="col-md-2">
                    <label for="level_type" class="form-label">Tipe Level</label>
                    <select class="form-select" id="level_type" name="level_type">
                        <option value="">Semua Level</option>
                        <option value="bronze">Bronze</option>
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
                        <option value="inactive">Nonaktif</option>
                        <option value="new">Level Baru</option>
                        <option value="archived">Diarsipkan</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="benefit_type" class="form-label">Tipe Benefit</label>
                    <select class="form-select" id="benefit_type" name="benefit_type">
                        <option value="">Semua Benefit</option>
                        <option value="discount">Diskon</option>
                        <option value="points">Points</option>
                        <option value="cashback">Cashback</option>
                        <option value="exclusive">Eksklusif</option>
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
                        Membership Levels Management
                    </div>
                </div>
                <div class="new-card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Level Membership</th>
                                    <th>Min. Spending</th>
                                    <th>Benefits</th>
                                    <th>Members Count</th>
                                    <th>Monthly Revenue</th>
                                    <th>Created Date</th>
                                    <th style="text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle" style="background: linear-gradient(135deg, #cd7f32 0%, #b8860b 100%);">BR</div>
                                            <div>
                                                <strong>Bronze Level</strong>
                                                <br><small>Entry level membership</small>
                                                <br><small>Code: BRONZE001</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <strong>Rp 0</strong>
                                        <br><small>No minimum</small>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column align-items-start">
                                            <span class="badge mb-1" style="background: #fef3c7; color: #d97706; padding: 2px 6px; border-radius: 8px; font-size: 0.7rem; font-weight: 500;">5% POINTS</span>
                                            <small class="text-muted" style="font-size: 0.75rem;">Basic rewards</small>
                                        </div>
                                    </td>
                                    <td>
                                        <strong>172 Members</strong>
                                        <br><small>69.4% dari total</small>
                                    </td>
                                    <td>
                                        <strong>Rp 45.2M</strong>
                                        <br><small>Bulan ini</small>
                                    </td>
                                    <td>
                                        <strong>8 bulan lalu</strong>
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
                                            <div class="avatar-circle" style="background: linear-gradient(135deg, #c0c0c0 0%, #a8a8a8 100%);">SL</div>
                                            <div>
                                                <strong>Silver Level</strong>
                                                <br><small>Standard membership</small>
                                                <br><small>Code: SILVER002</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <strong>Rp 2M</strong>
                                        <br><small>Per tahun</small>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column align-items-start">
                                            <span class="badge mb-1" style="background: #dbeafe; color: #1d4ed8; padding: 2px 6px; border-radius: 8px; font-size: 0.7rem; font-weight: 500;">10% POINTS</span>
                                            <span class="badge mb-1" style="background: #dcfce7; color: #15803d; padding: 2px 6px; border-radius: 8px; font-size: 0.7rem; font-weight: 500;">5% DISCOUNT</span>
                                            <small class="text-muted" style="font-size: 0.75rem;">Enhanced rewards</small>
                                        </div>
                                    </td>
                                    <td>
                                        <strong>48 Members</strong>
                                        <br><small>19.4% dari total</small>
                                    </td>
                                    <td>
                                        <strong>Rp 32.8M</strong>
                                        <br><small>Bulan ini</small>
                                    </td>
                                    <td>
                                        <strong>6 bulan lalu</strong>
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
                                            <div class="avatar-circle" style="background: linear-gradient(135deg, #ffd700 0%, #ffcc02 100%);">GL</div>
                                            <div>
                                                <strong>Gold Level</strong>
                                                <br><small>Premium membership</small>
                                                <br><small>Code: GOLD003</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <strong>Rp 5M</strong>
                                        <br><small>Per tahun</small>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column align-items-start">
                                            <span class="badge mb-1" style="background: #fef3c7; color: #d97706; padding: 2px 6px; border-radius: 8px; font-size: 0.7rem; font-weight: 500;">15% POINTS</span>
                                            <span class="badge mb-1" style="background: #dcfce7; color: #15803d; padding: 2px 6px; border-radius: 8px; font-size: 0.7rem; font-weight: 500;">10% DISCOUNT</span>
                                            <small class="text-muted" style="font-size: 0.75rem;">Premium benefits</small>
                                        </div>
                                    </td>
                                    <td>
                                        <strong>21 Members</strong>
                                        <br><small>8.5% dari total</small>
                                    </td>
                                    <td>
                                        <strong>Rp 28.4M</strong>
                                        <br><small>Bulan ini</small>
                                    </td>
                                    <td>
                                        <strong>4 bulan lalu</strong>
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
                                            <div class="avatar-circle" style="background: linear-gradient(135deg, #e5e4e2 0%, #d3d3d3 100%);">PT</div>
                                            <div>
                                                <strong>Platinum Level</strong>
                                                <br><small>VIP membership</small>
                                                <br><small>Code: PLATINUM004</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <strong>Rp 15M</strong>
                                        <br><small>Per tahun</small>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column align-items-start">
                                            <span class="badge mb-1" style="background: #dcfce7; color: #15803d; padding: 2px 6px; border-radius: 8px; font-size: 0.7rem; font-weight: 500;">20% POINTS</span>
                                            <span class="badge mb-1" style="background: #dbeafe; color: #1d4ed8; padding: 2px 6px; border-radius: 8px; font-size: 0.7rem; font-weight: 500;">15% DISCOUNT</span>
                                            <span class="badge mb-1" style="background: #f3e8ff; color: #7c3aed; padding: 2px 6px; border-radius: 8px; font-size: 0.7rem; font-weight: 500;">VIP ACCESS</span>
                                            <small class="text-muted" style="font-size: 0.75rem;">Exclusive benefits</small>
                                        </div>
                                    </td>
                                    <td>
                                        <strong>7 Members</strong>
                                        <br><small>2.8% dari total</small>
                                    </td>
                                    <td>
                                        <strong>Rp 18.7M</strong>
                                        <br><small>Bulan ini</small>
                                    </td>
                                    <td>
                                        <strong>2 bulan lalu</strong>
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
                            Menampilkan 4 dari 4 membership level
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
                                    <li class="page-item disabled">
                                        <span class="page-link">Next</span>
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
    <div class="row mt-4">
        <!-- Benefits Configuration -->
        <div class="col-12">
            <div class="new-card">
                <div class="new-card-header">
                    <div class="new-card-title">
                        <i class="fas fa-gift"></i>
                        Benefits Configuration
                    </div>
                </div>
                <div class="new-card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Benefit Type</th>
                                    <th>Level</th>
                                    <th>Value</th>
                                    <th>Status</th>
                                    <th>Usage</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #f26b37 0%, #e55827 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; margin-right: 8px; font-size: 0.7rem;"><i class="fas fa-percentage" style="font-size: 10px;"></i></div>
                                            <div>
                                                <strong>Points Multiplier</strong>
                                                <br><small>Extra earning points</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #fef3c7; color: #d97706;">Gold</span>
                                    </td>
                                    <td>
                                        <strong style="color: #15803d;">15%</strong>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #dcfce7; color: #15803d;">Aktif</span>
                                    </td>
                                    <td>
                                        <strong>2,150x</strong>
                                        <br><small>This month</small>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #f26b37 0%, #e55827 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; margin-right: 8px; font-size: 0.7rem;"><i class="fas fa-tags" style="font-size: 10px;"></i></div>
                                            <div>
                                                <strong>Shopping Discount</strong>
                                                <br><small>Direct discount</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #dbeafe; color: #1d4ed8;">Silver</span>
                                    </td>
                                    <td>
                                        <strong style="color: #15803d;">5%</strong>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #dcfce7; color: #15803d;">Aktif</span>
                                    </td>
                                    <td>
                                        <strong>1,876x</strong>
                                        <br><small>This month</small>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #f26b37 0%, #e55827 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; margin-right: 8px; font-size: 0.7rem;"><i class="fas fa-crown" style="font-size: 10px;"></i></div>
                                            <div>
                                                <strong>VIP Access</strong>
                                                <br><small>Exclusive services</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #dcfce7; color: #15803d;">Platinum</span>
                                    </td>
                                    <td>
                                        <strong style="color: #15803d;">Unlimited</strong>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #dcfce7; color: #15803d;">Aktif</span>
                                    </td>
                                    <td>
                                        <strong>142x</strong>
                                        <br><small>This month</small>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Membership Activities -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="new-card">
                <div class="new-card-header">
                    <div class="new-card-title">
                        <i class="fas fa-history"></i>
                        Recent Membership Activities
                    </div>
                </div>
                <div class="new-card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Member</th>
                                    <th>Activity</th>
                                    <th>From/To Level</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
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
                                        <strong>Level Upgrade</strong>
                                        <br><small>Automatic promotion</small>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="badge" style="background: #dbeafe; color: #1d4ed8; font-size: 0.65rem;">Silver</span>
                                            →
                                            <span class="badge" style="background: #fef3c7; color: #d97706; font-size: 0.65rem;">Gold</span>
                                        </div>
                                    </td>
                                    <td>
                                        <strong>2 hours ago</strong>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #dcfce7; color: #15803d;">Success</span>
                                    </td>
                                </tr>
                                <tr>
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
                                        <strong>Benefits Redeemed</strong>
                                        <br><small>Used discount coupon</small>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #dbeafe; color: #1d4ed8; font-size: 0.65rem;">5% Discount</span>
                                    </td>
                                    <td>
                                        <strong>5 hours ago</strong>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #dcfce7; color: #15803d;">Success</span>
                                    </td>
                                </tr>
                                <tr>
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
                                        <strong>New Registration</strong>
                                        <br><small>Joined membership</small>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #fef3c7; color: #d97706; font-size: 0.65rem;">Bronze</span>
                                    </td>
                                    <td>
                                        <strong>1 day ago</strong>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #fef3c7; color: #d97706;">Pending</span>
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
    const levelSelect = document.getElementById('level_type');
    const statusSelect = document.getElementById('status');
    const benefitSelect = document.getElementById('benefit_type');
    
    if (searchField) searchField.value = '';
    if (levelSelect) levelSelect.selectedIndex = 0;
    if (statusSelect) statusSelect.selectedIndex = 0;
    if (benefitSelect) benefitSelect.selectedIndex = 0;
}

// Update time and date immediately and then every second
updateDateTime();
setInterval(updateDateTime, 1000);
</script>
@endsection
