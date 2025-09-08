@extends('layouts.navbar_admin')

@section('title', 'Sistem Penggajian Otomatis')

@push('styles')
    <style>
        /* AGGRESSIVE RESET FOR FORM ELEMENTS */
        * {
            box-sizing: border-box !important;
        }

        /* Remove all possible visual artifacts */
        .new-card-body *,
        .new-card-body *::before,
        .new-card-body *::after {
            border-image: none !important;
            border-image-source: none !important;
            border-image-slice: initial !important;
            border-image-width: initial !important;
            border-image-outset: initial !important;
            border-image-repeat: initial !important;
            background-image: none !important;
            box-shadow: none !important;
            outline: none !important;
            text-decoration: none !important;
        }

        /* Additional aggressive reset for form container */
        .new-card-body form,
        .new-card-body .row,
        .new-card-body .col-md-3,
        .new-card-body .col-md-2,
        .new-card-body .d-grid {
            background: transparent !important;
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
            border-image: none !important;
            background-image: none !important;
            text-decoration: none !important;
        }

        /* Force transparent background on all containers */
        .new-card-body .row::before,
        .new-card-body .row::after,
        .new-card-body .col-md-3::before,
        .new-card-body .col-md-3::after,
        .new-card-body .col-md-2::before,
        .new-card-body .col-md-2::after {
            display: none !important;
            content: none !important;
        }

        .dataTables_info {
            color: #6c757d;
            font-size: 0.875rem;
            padding-top: 0.75rem;
        }

        .card-footer {
            border-top: 1px solid #e3e6f0;
            background-color: #f8f9fc !important;
        }

        .pagination-sm .page-link {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }

        .table-responsive {
            border-radius: 0.35rem;
        }

        /* Custom action buttons styling */
        .btn[data-action] {
            cursor: pointer !important;
            pointer-events: auto !important;
            min-width: 32px;
            border-radius: 4px;
        }

        .btn[data-action]:hover {
            transform: scale(1.05);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn[data-action] i {
            pointer-events: none;
            /* Prevent icon from blocking click */
        }

        /* Custom dropdown styling - Bootstrap 5.3.0 compatible */
        .dropdown-toggle::after {
            display: none !important;
        }

        /* Ensure Bootstrap dropdown functionality is not broken */
        .dropdown-toggle[data-bs-toggle="dropdown"] {
            cursor: pointer;
            position: relative;
        }

        .btn.dropdown-toggle {
            cursor: pointer;
            position: relative;
        }

        .btn.dropdown-toggle:hover {
            background-color: #f8f9fc !important;
            border-color: #d1d3e2 !important;
        }

        /* Ensure dropdown menu appears above other elements */
        .dropdown-menu {
            border: 1px solid #e3e6f0 !important;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
            border-radius: 0.35rem !important;
            min-width: 10rem !important;
            z-index: 1055 !important;
            animation: dropdownFadeIn 0.2s ease-in-out;
            position: absolute !important;
        }

        /* Fix for table overflow issues with dropdowns */
        .table-responsive {
            overflow: visible !important;
        }

        .table-responsive .dropdown-menu {
            position: fixed !important;
        }

        @keyframes dropdownFadeIn {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dropdown-item {
            padding: 0.5rem 1rem !important;
            font-size: 0.875rem !important;
            transition: all 0.15s ease-in-out !important;
            cursor: pointer !important;
            display: flex !important;
            align-items: center !important;
        }

        .dropdown-item:hover {
            background-color: #f8f9fc !important;
            color: #3a3b45 !important;
            transform: translateX(3px);
        }

        .dropdown-item i {
            width: 16px !important;
            text-align: center !important;
            margin-right: 0.5rem !important;
        }

        .btn-outline-secondary {
            border-color: #d1d3e2 !important;
            color: #858796 !important;
        }

        .btn-outline-secondary:hover {
            background-color: #5a5c69 !important;
            border-color: #5a5c69 !important;
            color: white !important;
            transform: scale(1.05);
        }

        .dropdown-item.text-danger:hover {
            background-color: #f8d7da !important;
            color: #721c24 !important;
        }

        /* Modal Detail Styling */
        .modal-xl {
            max-width: 90%;
        }

        .detail-card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }

        .detail-card .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 0.5rem 0.5rem 0 0 !important;
            padding: 0.75rem 1rem;
        }

        .detail-table {
            margin-bottom: 0;
        }

        .detail-table td {
            padding: 0.5rem 0.75rem;
            border: none;
            vertical-align: middle;
        }

        .detail-table tr:nth-child(even) {
            background-color: #f8f9fc;
        }

        .highlight-row {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%) !important;
            font-weight: bold;
        }

        .loading-container {
            min-height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
@endpush

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
.new-penggajian-dashboard {
    background: #f8fafc !important;
    min-height: 100vh !important;
    padding: 0 !important;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
    overflow-x: hidden !important;
    width: 100% !important;
    margin: 0 !important;
}

body.dark-mode .new-penggajian-dashboard {
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
    display: inline-block !important;
    cursor: default !important;
}

#realTimeClock:hover {
    background: rgba(255, 255, 255, 0.25) !important;
    transform: translateY(-1px) !important;
}

/* Action buttons in header */
.new-action-buttons {
    display: flex !important;
    gap: 12px !important;
    align-items: center !important;
}

.new-action-btn {
    background: rgba(255, 255, 255, 0.2) !important;
    border: 1px solid rgba(255, 255, 255, 0.3) !important;
    color: white !important;
    padding: 10px 20px !important;
    border-radius: 10px !important;
    font-weight: 500 !important;
    transition: all 0.3s ease !important;
    backdrop-filter: blur(10px) !important;
}

.new-action-btn:hover {
    background: rgba(255, 255, 255, 0.3) !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2) !important;
    color: white !important;
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

/* TABLE STYLING - CONSISTENT WITH DATA KARYAWAN */
.table-responsive {
    border-radius: 8px !important;
    background: white !important;
    overflow-x: auto !important;
    overflow-y: visible !important;
    max-width: 100% !important;
    width: 100% !important;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1) !important;
    border: 1px solid #e2e8f0 !important;
}

body.dark-mode .table-responsive {
    background: #2a2d3f !important;
    border-color: #3a3d4a !important;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3) !important;
}

/* CRITICAL: Prevent pagination scrolling */
.table-responsive .pagination-container {
    overflow-x: visible !important;
    overflow-y: visible !important;
}

.table-responsive .pagination-wrapper {
    overflow: visible !important;
}

/* Table styling */
.table {
    margin-bottom: 0 !important;
    background: transparent !important;
    color: #1e293b !important;
    font-size: 0.875rem !important;
}

body.dark-mode .table {
    color: #e2e8f0 !important;
}

.table th {
    background: #f8fafc !important;
    color: #374151 !important;
    font-weight: 600 !important;
    font-size: 0.8rem !important;
    text-transform: uppercase !important;
    letter-spacing: 0.025em !important;
    padding: 12px 8px !important;
    border-bottom: 2px solid #e2e8f0 !important;
    border-top: none !important;
    border-left: none !important;
    border-right: none !important;
    vertical-align: middle !important;
}

body.dark-mode .table th {
    background: #374151 !important;
    color: #94a3b8 !important;
    border-color: #4b5563 !important;
}

.table td {
    padding: 12px 8px !important;
    border-bottom: 1px solid #f1f5f9 !important;
    border-top: none !important;
    border-left: none !important;
    border-right: none !important;
    vertical-align: middle !important;
    color: #374151 !important;
    font-size: 0.8rem !important;
}

body.dark-mode .table td {
    border-color: #3a3d4a !important;
    color: #e2e8f0 !important;
}

.table tbody tr:hover {
    background-color: #f8fafc !important;
    transition: background-color 0.2s ease !important;
}

body.dark-mode .table tbody tr:hover {
    background-color: #3a3d4a !important;
}

.table tr:last-child td {
    border-bottom: none !important;
}

/* Table column widths for better display */
.table th:first-child,
.table td:first-child {
    width: 50px !important;
    text-align: center !important;
}

.table th:last-child,
.table td:last-child {
    width: 80px !important;
    text-align: center !important;
}

/* Badge styling for status */
.badge {
    font-size: 0.7rem !important;
    padding: 4px 8px !important;
    border-radius: 12px !important;
    font-weight: 500 !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 4px !important;
}

.badge.bg-success {
    background: #dcfce7 !important;
    color: #166534 !important;
    border: 1px solid #bbf7d0 !important;
}

.badge.bg-warning {
    background: #fef3c7 !important;
    color: #d97706 !important;
    border: 1px solid #fde68a !important;
}

.badge.bg-danger {
    background: #fecaca !important;
    color: #dc2626 !important;
    border: 1px solid #fca5a5 !important;
}

.badge.bg-info {
    background: #dbeafe !important;
    color: #1d4ed8 !important;
    border: 1px solid #bfdbfe !important;
}

.badge.bg-secondary {
    background: #f1f5f9 !important;
    color: #64748b !important;
    border: 1px solid #e2e8f0 !important;
}

body.dark-mode .badge.bg-success {
    background: #166534 !important;
    color: #dcfce7 !important;
    border-color: #166534 !important;
}

body.dark-mode .badge.bg-warning {
    background: #d97706 !important;
    color: #fef3c7 !important;
    border-color: #d97706 !important;
}

body.dark-mode .badge.bg-danger {
    background: #dc2626 !important;
    color: #fecaca !important;
    border-color: #dc2626 !important;
}

body.dark-mode .badge.bg-info {
    background: #1d4ed8 !important;
    color: #dbeafe !important;
    border-color: #1d4ed8 !important;
}

body.dark-mode .badge.bg-secondary {
    background: #64748b !important;
    color: #f1f5f9 !important;
    border-color: #64748b !important;
}

/* Responsive table behavior */
@media (max-width: 992px) {
    .table th,
    .table td {
        font-size: 0.75rem !important;
        padding: 8px 6px !important;
    }
    
    .badge {
        font-size: 0.65rem !important;
        padding: 2px 6px !important;
    }
}

@media (max-width: 768px) {
    .table th:nth-child(4),
    .table td:nth-child(4),
    .table th:nth-child(6),
    .table td:nth-child(6),
    .table th:nth-child(7),
    .table td:nth-child(7) {
        display: none !important;
    }
}

/* PAGINATION STYLES - CONSISTENT WITH DATA KARYAWAN */
.pagination-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;
    padding: 15px 0;
    flex-wrap: nowrap;
    gap: 10px;
    overflow: hidden;
    max-width: 100%;
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
    gap: 1px !important;
    align-items: center !important;
    flex-wrap: nowrap !important;
    overflow: hidden !important;
    max-width: 100% !important;
}

.pagination .page-item {
    margin: 0 !important;
    display: inline-block !important;
    flex-shrink: 0 !important;
}

.pagination .page-link {
    display: inline-block !important;
    padding: 6px 8px !important;
    margin: 0 !important;
    border: 1px solid #e2e8f0 !important;
    background: white !important;
    color: #64748b !important;
    text-decoration: none !important;
    border-radius: 4px !important;
    font-size: 0.8rem !important;
    transition: all 0.2s ease !important;
    line-height: 1.2 !important;
    min-width: 28px !important;
    text-align: center !important;
    white-space: nowrap !important;
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

/* Improved card footer styling */
.card-footer {
    background: #f8fafc !important;
    border-top: 1px solid #e2e8f0 !important;
    padding: 15px 20px !important;
    border-radius: 0 0 8px 8px !important;
}

body.dark-mode .card-footer {
    background: #374151 !important;
    border-color: #4b5563 !important;
}

.dataTables_info {
    color: #64748b !important;
    font-size: 0.875rem !important;
    margin: 0 !important;
    line-height: 1.5 !important;
}

body.dark-mode .dataTables_info {
    color: #9ca3af !important;
}

/* Responsive pagination */
@media (max-width: 576px) {
    .pagination-container {
        flex-direction: column;
        text-align: center;
        gap: 15px;
    }
    
    .pagination .page-link {
        padding: 4px 6px !important;
        font-size: 0.75rem !important;
        min-width: 24px !important;
    }
}

/* Hide middle pagination items when there are too many pages */
@media (max-width: 768px) {
    .pagination .page-item:nth-child(n+5):nth-last-child(n+5) {
        display: none !important;
    }
    
    .pagination .page-item:first-child,
    .pagination .page-item:nth-child(2),
    .pagination .page-item.active,
    .pagination .page-item:nth-last-child(2),
    .pagination .page-item:last-child {
        display: inline-block !important;
    }
}

/* Pagination wrapper */
.pagination-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    max-width: 100%;
}

.pagination-wrapper nav {
    margin: 0;
    max-width: 100%;
}

/* Override default Laravel pagination styles */
.pagination-wrapper .pagination {
    margin-bottom: 0 !important;
    flex-wrap: nowrap !important;
    overflow: hidden !important;
    justify-content: center !important;
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

/* Fix form controls styling */
.form-select,
.form-control {
    border: 1px solid #d1d3e2 !important;
    border-radius: 8px !important;
    padding: 0.5rem 0.75rem !important;
    font-size: 0.875rem !important;
    line-height: 1.5 !important;
    background-color: #fff !important;
    background-clip: padding-box !important;
    background-image: none !important;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out !important;
    appearance: none !important;
    -webkit-appearance: none !important;
    -moz-appearance: none !important;
    background-repeat: no-repeat !important;
    background-position: right 0.75rem center !important;
    background-size: 16px 12px !important;
}

/* Custom dropdown arrow for select */
.form-select {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m1 6 6.25 6.25a.75.75 0 0 0 1.06 0L15 6'/%3e%3c/svg%3e") !important;
    padding-right: 2.25rem !important;
}

.form-select:focus,
.form-control:focus {
    border-color: #f26b37 !important;
    outline: 0 !important;
    box-shadow: 0 0 0 0.2rem rgba(242, 107, 55, 0.25) !important;
}

.form-label {
    margin-bottom: 0.5rem !important;
    font-weight: 600 !important;
    color: #374151 !important;
    font-size: 0.875rem !important;
}

/* Remove any unwanted borders and lines */
.new-card-body form {
    border: none !important;
    outline: none !important;
}

.new-card-body .row {
    border: none !important;
    outline: none !important;
    margin: 0 !important;
}

.new-card-body .col-md-3,
.new-card-body .col-md-2 {
    border: none !important;
    outline: none !important;
    padding: 0 0.75rem !important;
}

/* Remove any webkit styling that causes lines */
.form-select::-webkit-scrollbar {
    display: none !important;
}

.form-select::-webkit-search-decoration,
.form-select::-webkit-search-cancel-button,
.form-select::-webkit-search-results-button,
.form-select::-webkit-search-results-decoration {
    display: none !important;
}

/* Ensure no pseudo elements add lines */
.form-select::before,
.form-select::after {
    display: none !important;
    content: none !important;
}

/* Remove any default browser styling */
.form-select option {
    background: white !important;
    color: #374151 !important;
    border: none !important;
}

/* Dark mode form controls */
body.dark-mode .form-select,
body.dark-mode .form-control {
    background-color: #2a2d3f !important;
    border-color: #3a3d4a !important;
    color: #e2e8f0 !important;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23e2e8f0' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m1 6 6.25 6.25a.75.75 0 0 0 1.06 0L15 6'/%3e%3c/svg%3e") !important;
}

body.dark-mode .form-select:focus,
body.dark-mode .form-control:focus {
    border-color: #f26b37 !important;
    box-shadow: 0 0 0 0.2rem rgba(242, 107, 55, 0.25) !important;
}

body.dark-mode .form-label {
    color: #94a3b8 !important;
}

body.dark-mode .form-select option {
    background: #2a2d3f !important;
    color: #e2e8f0 !important;
}

/* Additional cleanup for any remaining visual artifacts */
.new-card-body * {
    box-sizing: border-box !important;
}

/* Force clean appearance on all form elements */
input[type="text"],
input[type="email"],
input[type="password"],
input[type="number"],
select,
textarea {
    -webkit-appearance: none !important;
    -moz-appearance: none !important;
    appearance: none !important;
    background-image: none !important;
    border-image: none !important;
    border-image-source: none !important;
    border-image-slice: 0 !important;
    border-image-width: 0 !important;
    border-image-outset: 0 !important;
    border-image-repeat: stretch !important;
}

/* Clean select styling specifically */
select.form-select {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m1 6 6.25 6.25a.75.75 0 0 0 1.06 0L15 6'/%3e%3c/svg%3e") !important;
    background-repeat: no-repeat !important;
    background-position: right 0.75rem center !important;
    background-size: 16px 12px !important;
    background-color: #fff !important;
    border: 1px solid #d1d3e2 !important;
    border-radius: 8px !important;
    padding: 0.5rem 2.25rem 0.5rem 0.75rem !important;
}

/* ULTIMATE FORM ELEMENT RESET */
.new-card-body select,
.new-card-body input,
.new-card-body button {
    -webkit-appearance: none !important;
    -moz-appearance: none !important;
    appearance: none !important;
    background: none !important;
    border: none !important;
    outline: none !important;
    box-shadow: none !important;
    text-decoration: none !important;
    border-image: none !important;
    background-image: none !important;
    border-radius: 0 !important;
    padding: 0 !important;
    margin: 0 !important;
}

/* Reset all webkit and moz specific styling */
.new-card-body select::-webkit-inner-spin-button,
.new-card-body select::-webkit-outer-spin-button,
.new-card-body select::-webkit-search-decoration,
.new-card-body select::-webkit-search-cancel-button,
.new-card-body select::-webkit-search-results-button,
.new-card-body select::-webkit-search-results-decoration,
.new-card-body select::-webkit-calendar-picker-indicator {
    -webkit-appearance: none !important;
    display: none !important;
}

.new-card-body select::-moz-focus-inner {
    border: 0 !important;
    padding: 0 !important;
}

/* Then apply clean styling */
.new-card-body .form-select {
    background: #fff !important;
    border: 1px solid #d1d3e2 !important;
    border-radius: 8px !important;
    padding: 0.5rem 2.25rem 0.5rem 0.75rem !important;
    font-size: 0.875rem !important;
    color: #374151 !important;
    font-family: inherit !important;
    line-height: 1.5 !important;
    width: 100% !important;
    height: auto !important;
    min-height: 38px !important;
    cursor: pointer !important;
    transition: border-color 0.15s ease-in-out !important;
}

/* Simple arrow without SVG that might cause issues */
.new-card-body .form-select::after {
    content: '▼' !important;
    position: absolute !important;
    right: 12px !important;
    top: 50% !important;
    transform: translateY(-50%) !important;
    font-size: 12px !important;
    color: #6b7280 !important;
    pointer-events: none !important;
}

.new-card-body .form-select:focus {
    border-color: #f26b37 !important;
    outline: 0 !important;
    box-shadow: 0 0 0 0.2rem rgba(242, 107, 55, 0.25) !important;
}

/* Force clean styling on select wrapper */
.new-card-body .col-md-3,
.new-card-body .col-md-2 {
    position: relative !important;
}

.new-card-body .col-md-3 select,
.new-card-body .col-md-2 select {
    width: 100% !important;
    position: relative !important;
    z-index: 1 !important;
}

/* NUCLEAR OPTION - Complete reset of any browser default styling */
.new-card-body select,
.new-card-body select * {
    all: unset !important;
    display: block !important;
    width: 100% !important;
    box-sizing: border-box !important;
}

/* Rebuild select from scratch */
.new-card-body .form-select {
    display: block !important;
    width: 100% !important;
    padding: 0.5rem 0.75rem !important;
    font-size: 0.875rem !important;
    font-weight: 400 !important;
    line-height: 1.5 !important;
    color: #374151 !important;
    background-color: #fff !important;
    background-clip: padding-box !important;
    border: 1px solid #d1d3e2 !important;
    border-radius: 8px !important;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out !important;
    cursor: pointer !important;
    font-family: inherit !important;
}

.new-card-body .form-select:focus {
    color: #374151 !important;
    background-color: #fff !important;
    border-color: #f26b37 !important;
    outline: 0 !important;
    box-shadow: 0 0 0 0.2rem rgba(242, 107, 55, 0.25) !important;
}

.new-card-body .form-select option {
    color: #374151 !important;
    background-color: #fff !important;
}

/* AGGRESSIVE FIX FOR DROPDOWN LINES - OVERRIDE EVERYTHING */
.new-card-body select {
    background-image: none !important;
    background-repeat: no-repeat !important;
    background-position: right !important;
    background-size: auto !important;
    background-attachment: scroll !important;
    background-origin: padding-box !important;
    background-clip: border-box !important;
    -webkit-print-color-adjust: exact !important;
    color-adjust: exact !important;
}

/* Force override any bootstrap/framework interference */
.new-card-body .form-select,
.new-card-body select.form-select,
select.form-select.new-card-body,
.row .form-select,
.col-md-3 .form-select,
.col-md-2 .form-select {
    background: #ffffff !important;
    border: 1px solid #d1d3e2 !important;
    border-radius: 8px !important;
    outline: none !important;
    box-shadow: none !important;
    appearance: none !important;
    -webkit-appearance: none !important;
    -moz-appearance: none !important;
    background-image: none !important;
    background-repeat: no-repeat !important;
    background-position: center right 12px !important;
    background-size: 12px !important;
    padding: 8px 35px 8px 12px !important;
    font-size: 14px !important;
    line-height: 1.5 !important;
    color: #374151 !important;
    cursor: pointer !important;
    transition: border-color 0.15s ease-in-out !important;
}

/* Add custom arrow using CSS only */
.new-card-body .form-select {
    background-image: linear-gradient(45deg, transparent 50%, #6b7280 50%), linear-gradient(135deg, #6b7280 50%, transparent 50%) !important;
    background-position: calc(100% - 20px) calc(1em + 2px), calc(100% - 15px) calc(1em + 2px) !important;
    background-size: 5px 5px, 5px 5px !important;
    background-repeat: no-repeat !important;
}

.new-card-body .form-select:focus {
    border-color: #f26b37 !important;
    box-shadow: 0 0 0 0.2rem rgba(242, 107, 55, 0.25) !important;
}

.new-card-body .btn {
    background: linear-gradient(135deg, #f26b37, #e55827) !important;
    border: none !important;
    border-radius: 8px !important;
    color: white !important;
    padding: 0.5rem 1rem !important;
    font-size: 0.875rem !important;
    font-weight: 600 !important;
    transition: all 0.3s ease !important;
}

.new-card-body .btn.btn-success {
    background: linear-gradient(135deg, #10b981, #059669) !important;
}

.new-card-body .btn:hover {
    transform: translateY(-1px) !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
}

/* Gear Dropdown Styling */
.gear-dropdown {
    border: 1px solid #d1d3e2 !important;
    background: #fff !important;
    color: #5a5c69 !important;
    border-radius: 8px !important;
    padding: 6px 12px !important;
    transition: all 0.3s ease !important;
    position: relative !important;
    min-width: 40px !important;
    height: 32px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
}

.gear-dropdown:hover {
    background: #f8f9fc !important;
    border-color: #5a5c69 !important;
    color: #5a5c69 !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1) !important;
}

.gear-dropdown:focus {
    box-shadow: 0 0 0 0.2rem rgba(90, 92, 105, 0.25) !important;
    border-color: #5a5c69 !important;
}

.gear-dropdown::after {
    display: none !important;
}

/* Gear Icon Animation */
.gear-icon {
    transition: transform 0.3s ease !important;
    font-size: 14px !important;
}

.gear-dropdown:hover .gear-icon {
    transform: rotate(90deg) !important;
}

.gear-dropdown[aria-expanded="true"] .gear-icon {
    transform: rotate(180deg) !important;
}

/* Dropdown Menu Styling */
.dropdown-menu {
    border: 1px solid #e3e6f0 !important;
    border-radius: 10px !important;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    padding: 0.5rem 0 !important;
    min-width: 180px !important;
    animation: dropdownSlideIn 0.2s ease-out !important;
}

@keyframes dropdownSlideIn {
    0% {
        opacity: 0;
        transform: translateY(-10px) scale(0.95);
    }
    100% {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.dropdown-item {
    padding: 0.75rem 1rem !important;
    font-size: 0.875rem !important;
    color: #5a5c69 !important;
    transition: all 0.15s ease !important;
    border: none !important;
    background: none !important;
    text-decoration: none !important;
    display: flex !important;
    align-items: center !important;
}

.dropdown-item:hover {
    background: #f8f9fc !important;
    color: #5a5c69 !important;
    transform: translateX(5px) !important;
}

.dropdown-item i {
    width: 16px !important;
    text-align: center !important;
    margin-right: 0.5rem !important;
}

.dropdown-divider {
    margin: 0.25rem 0 !important;
    border-color: #e3e6f0 !important;
}

/* Dark mode support for dropdown */
body.dark-mode .gear-dropdown {
    background: #2a2d3f !important;
    border-color: #3a3d4a !important;
    color: #e2e8f0 !important;
}

body.dark-mode .gear-dropdown:hover {
    background: #3a3d4a !important;
    border-color: #4a4d5a !important;
}

body.dark-mode .dropdown-menu {
    background: #2a2d3f !important;
    border-color: #3a3d4a !important;
}

body.dark-mode .dropdown-item {
    color: #e2e8f0 !important;
}

body.dark-mode .dropdown-item:hover {
    background: #3a3d4a !important;
    color: #f1f5f9 !important;
}

body.dark-mode .dropdown-divider {
    border-color: #3a3d4a !important;
}
</style>

<div class="new-penggajian-dashboard">
    <!-- Header Section -->
    <div class="new-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h1><i class="fas fa-calculator me-3"></i>Sistem Penggajian Otomatis</h1>
                <p>Kelola dan proses penggajian karyawan MyYOGYA secara otomatis</p>
            </div>
            <div style="text-align: right;">
                <div class="new-action-buttons">
                    <button type="button" class="new-action-btn" data-bs-toggle="modal" data-bs-target="#previewModal">
                        <i class="fas fa-eye me-2"></i>Preview Gaji
                    </button>
                    <button type="button" class="new-action-btn" data-bs-toggle="modal" data-bs-target="#prosesModal">
                        <i class="fas fa-calculator me-2"></i>Proses Gaji Otomatis
                    </button>
                </div>
                <div id="realTimeClock" style="font-weight: 600; color: white; font-size: 1rem; margin-top: 10px;"></div>
                <small id="currentDate" style="opacity: 0.8;"></small>
            </div>
        </div>
    </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 10px; border: none; background: linear-gradient(135deg, #10b981, #059669); color: white;">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 10px; border: none; background: linear-gradient(135deg, #ef4444, #dc2626); color: white;">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Statistics Cards Row (moved above filter) -->
        <div class="row g-4 mb-5">
            <div class="col-lg-3 col-md-6">
                <div class="new-stat-card">
                    <div class="new-stat-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="new-stat-number">{{ number_format($stats['total_gaji'] ?? 0, 0, ',', '.') }}</div>
                    <div class="new-stat-label">Total Gaji (Rp)</div>
                    <div class="new-stat-change change-positive">
                        <i class="fas fa-arrow-up"></i> Periode Ini
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="new-stat-card">
                    <div class="new-stat-icon" style="background: linear-gradient(135deg, #10b981, #059669) !important;">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="new-stat-number">{{ $stats['total_karyawan'] ?? 0 }}</div>
                    <div class="new-stat-label">Total Karyawan</div>
                    <div class="new-stat-change change-positive">
                        <i class="fas fa-user-check"></i> Aktif
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="new-stat-card">
                    <div class="new-stat-icon" style="background: linear-gradient(135deg, #f59e0b, #d97706) !important;">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="new-stat-number" style="font-size: 1.8rem;">{{ number_format($stats['rata_rata_gaji'] ?? 0, 0, ',', '.') }}</div>
                    <div class="new-stat-label">Rata-rata Gaji (Rp)</div>
                    <div class="new-stat-change change-neutral">
                        <i class="fas fa-equals"></i> Normal
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="new-stat-card">
                    <div class="new-stat-icon" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed) !important;">
                        <i class="fas fa-crown"></i>
                    </div>
                    <div class="new-stat-number" style="font-size: 1.8rem;">{{ number_format($stats['gaji_tertinggi'] ?? 0, 0, ',', '.') }}</div>
                    <div class="new-stat-label">Gaji Tertinggi (Rp)</div>
                    <div class="new-stat-change change-positive">
                        <i class="fas fa-trophy"></i> Maksimal
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="row g-4 mb-5">
            <div class="col-12">
                <div class="new-card">
                    <div class="new-card-header">
                        <div class="new-card-title">
                            <i class="fas fa-filter"></i>
                            Filter Periode
                        </div>
                    </div>
                    <div class="new-card-body">
                        <form method="GET" action="{{ route('admin.penggajian') }}" class="row g-3">
                            <div class="col-md-3">
                                <label for="bulan" class="form-label">Bulan</label>
                                <select name="bulan" id="bulan" class="form-select">
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ $i == $bulan ? 'selected' : '' }}>
                                            {{ Carbon\Carbon::create(null, $i, 1)->format('F') }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="tahun" class="form-label">Tahun</label>
                                <select name="tahun" id="tahun" class="form-select">
                                    @for ($year = date('Y') - 2; $year <= date('Y') + 1; $year++)
                                        <option value="{{ $year }}" {{ $year == $tahun ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="per_page" class="form-label">Per Halaman</label>
                                <select name="per_page" id="per_page" class="form-select">
                                    @foreach ([10, 25, 50, 100] as $perPageOption)
                                        <option value="{{ $perPageOption }}"
                                            {{ request('per_page', 10) == $perPageOption ? 'selected' : '' }}>
                                            {{ $perPageOption }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">&nbsp;</label>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-filter me-2"></i>Filter
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">&nbsp;</label>
                                <div class="d-grid">
                                    <a href="{{ route('admin.penggajian') }}" class="btn btn-success">
                                        <i class="fas fa-refresh me-2"></i>Reset
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Gaji -->
        <div class="new-card">
            <div class="new-card-header">
                <div class="new-card-title">
                    <i class="fas fa-table"></i>
                    Data Gaji - {{ Carbon\Carbon::create(null, $bulan, 1)->format('F') }} {{ $tahun }}
                </div>
            </div>
            <div class="new-card-body">
                @if ($gajiList->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Karyawan</th>
                                    <th>Jabatan</th>
                                    <th>Absensi</th>
                                    <th>Gaji Pokok</th>
                                    <th>Tunjangan</th>
                                    <th>Potongan</th>
                                    <th>Total Gaji</th>
                                    <th>Status</th>
                                    <th width="80" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gajiList as $index => $gaji)
                                    @php
                                        $statsAbsensi = $gaji->karyawan->getStatistikAbsensiBulan($tahun, $bulan);
                                    @endphp
                                    <tr>
                                        <td>{{ $gajiList->firstItem() + $index }}</td>
                                        <td>{{ $gaji->karyawan->nama ?? 'N/A' }}</td>
                                        <td>{{ $gaji->karyawan->jabatan->nama_jabatan ?? 'N/A' }}</td>
                                        <td>
                                            <small class="text-muted">
                                                <div><strong>Hadir:</strong> {{ $statsAbsensi['total_hadir'] }} hari</div>
                                                <div><strong>Absen:</strong> {{ $statsAbsensi['total_absen'] }} hari</div>
                                                <div><strong>Kehadiran:</strong>
                                                    {{ $statsAbsensi['persentase_kehadiran'] }}%</div>
                                                @if ($statsAbsensi['total_terlambat_menit'] > 0)
                                                    <div class="text-warning"><strong>Terlambat:</strong>
                                                        {{ $statsAbsensi['total_terlambat_menit'] }} menit</div>
                                                @endif
                                            </small>
                                        </td>
                                        <td>Rp {{ number_format($gaji->gaji_pokok ?? 0, 0, ',', '.') }}</td>
                                        <td>Rp
                                            {{ number_format(($gaji->tunjangan_jabatan ?? 0) + ($gaji->tunjangan_kehadiran ?? 0) + ($gaji->tunjangan_lainnya ?? 0), 0, ',', '.') }}
                                        </td>
                                        <td>Rp
                                            {{ number_format(($gaji->potongan_absensi ?? 0) + ($gaji->potongan_lainnya ?? 0), 0, ',', '.') }}
                                        </td>
                                        <td><strong>Rp {{ number_format($gaji->jumlah_gaji ?? 0, 0, ',', '.') }}</strong>
                                        </td>
                                        <td>
                                            @php
                                                $status = strtolower($gaji->status_pembayaran ?? 'pending');
                                            @endphp

                                            @if (in_array($status, ['paid', 'sudah_dibayar', 'dibayar']))
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check-circle me-1"></i>Sudah Dibayar
                                                </span>
                                            @elseif (in_array($status, ['pending', 'belum_dibayar', 'menunggu']))
                                                <span class="badge bg-warning text-dark">
                                                    <i class="fas fa-clock me-1"></i>Pending
                                                </span>
                                            @elseif (in_array($status, ['cancelled', 'dibatalkan', 'batal']))
                                                <span class="badge bg-danger">
                                                    <i class="fas fa-times-circle me-1"></i>Dibatalkan
                                                </span>
                                            @elseif (in_array($status, ['processing', 'diproses']))
                                                <span class="badge bg-info">
                                                    <i class="fas fa-sync-alt me-1"></i>Diproses
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">
                                                    <i
                                                        class="fas fa-question-circle me-1"></i>{{ $status ?: 'Tidak Diketahui' }}
                                                </span>
                                            @endif

                                            @if ($gaji->tanggal_bayar)
                                                <small class="d-block text-muted mt-1">
                                                    {{ \Carbon\Carbon::parse($gaji->tanggal_bayar)->format('d/m/Y') }}
                                                </small>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle gear-dropdown" 
                                                        type="button" 
                                                        id="dropdownMenuButton{{ $gaji->id_gaji ?? 0 }}" 
                                                        data-bs-toggle="dropdown" 
                                                        aria-expanded="false"
                                                        title="Aksi">
                                                    <i class="fas fa-cog gear-icon"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton{{ $gaji->id_gaji ?? 0 }}">
                                                    <li>
                                                        <a class="dropdown-item" href="#" 
                                                           onclick="console.log('Dropdown click - view detail', {{ $gaji->id_gaji ?? 0 }}); viewDetail({{ $gaji->id_gaji ?? 0 }}); return false;">
                                                            <i class="fas fa-eye text-info me-2"></i>Lihat Detail
                                                        </a>
                                                    </li>
                                                    
                                                    @php
                                                        $status = strtolower($gaji->status_pembayaran ?? 'pending');
                                                    @endphp

                                                    @if (in_array($status, ['pending', 'belum_dibayar', 'menunggu']))
                                                        <li>
                                                            <a class="dropdown-item" href="#" 
                                                               onclick="console.log('Dropdown click - mark paid', {{ $gaji->id_gaji ?? 0 }}); markAsPaid({{ $gaji->id_gaji ?? 0 }}); return false;">
                                                                <i class="fas fa-check text-success me-2"></i>Tandai Dibayar
                                                            </a>
                                                        </li>
                                                    @endif

                                                    @if (in_array($status, ['paid', 'sudah_dibayar', 'dibayar']))
                                                        <li>
                                                            <a class="dropdown-item" href="#" 
                                                               onclick="console.log('Dropdown click - generate slip', {{ $gaji->id_gaji ?? 0 }}); generateSlip({{ $gaji->id_gaji ?? 0 }}); return false;">
                                                                <i class="fas fa-file-pdf text-primary me-2"></i>Cetak Slip
                                                            </a>
                                                        </li>
                                                    @endif
                                                    
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item text-muted" href="#" 
                                                           onclick="console.log('Edit gaji', {{ $gaji->id_gaji ?? 0 }}); return false;">
                                                            <i class="fas fa-edit me-2"></i>Edit Gaji
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Info dan Controls -->
                    <div class="card-footer bg-light">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="dataTables_info">
                                    Menampilkan {{ $gajiList->firstItem() }} sampai {{ $gajiList->lastItem() }}
                                    dari {{ $gajiList->total() }} data gaji
                                    (Periode: {{ Carbon\Carbon::create(null, $bulan, 1)->format('F') }}
                                    {{ $tahun }})
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-end">
                                    {{ $gajiList->appends(request()->query())->links('pagination.custom') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-4">
                        <div class="mb-3">
                            <i class="fas fa-inbox fa-3x text-muted"></i>
                        </div>
                        <h5 class="text-muted">Belum ada data gaji untuk periode ini</h5>
                        <p class="text-muted">Silakan proses gaji otomatis untuk periode
                            {{ Carbon\Carbon::create(null, $bulan, 1)->format('F') }} {{ $tahun }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Preview Gaji -->
    <div class="modal fade" id="previewModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Preview Perhitungan Gaji</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="previewForm">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="preview_bulan" class="form-label">Bulan</label>
                                <select name="bulan" id="preview_bulan" class="form-select">
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ $i == $bulan ? 'selected' : '' }}>
                                            {{ Carbon\Carbon::create(null, $i, 1)->format('F') }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="preview_tahun" class="form-label">Tahun</label>
                                <select name="tahun" id="preview_tahun" class="form-select">
                                    @for ($year = date('Y') - 2; $year <= date('Y') + 1; $year++)
                                        <option value="{{ $year }}" {{ $year == $tahun ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">&nbsp;</label>
                                <button type="button" onclick="loadPreview()" class="btn btn-primary d-block">
                                    <i class="fas fa-search"></i> Preview
                                </button>
                            </div>
                        </div>
                    </form>

                    <div id="previewContent">
                        <div class="text-center">
                            <p class="text-muted">Pilih periode dan klik Preview untuk melihat perhitungan gaji</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Proses Gaji -->
    <div class="modal fade" id="prosesModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Proses Gaji Otomatis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.penggajian.proses-otomatis') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i>
                            <strong>Proses Gaji Otomatis</strong><br>
                            Sistem akan menghitung gaji berdasarkan shift, absensi, dan jabatan karyawan.<br>
                            <small class="text-muted">✅ Gaji akan langsung ditandai sebagai <strong>"SUDAH
                                    DIBAYAR"</strong> setelah proses selesai.</small>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="proses_bulan" class="form-label">Bulan</label>
                                <select name="bulan" id="proses_bulan" class="form-select" required>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ $i == $bulan ? 'selected' : '' }}>
                                            {{ Carbon\Carbon::create(null, $i, 1)->format('F') }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="proses_tahun" class="form-label">Tahun</label>
                                <select name="tahun" id="proses_tahun" class="form-select" required>
                                    @for ($year = date('Y') - 2; $year <= date('Y') + 1; $year++)
                                        <option value="{{ $year }}" {{ $year == $tahun ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-calculator"></i> Proses Gaji
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Detail Gaji -->
    <div class="modal fade" id="detailModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-money-bill-wave me-2"></i>Detail Gaji Karyawan
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div id="detailContent">
                        <div class="loading-container">
                            <div class="text-center">
                                <i class="fas fa-spinner fa-spin fa-3x text-primary mb-3"></i>
                                <h5 class="text-muted">Memuat detail gaji...</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Tutup
                    </button>
                    <button type="button" class="btn btn-warning" id="editFromModal">
                        <i class="fas fa-edit me-2"></i>Edit Gaji
                    </button>
                    <button type="button" class="btn btn-info" id="printFromModal">
                        <i class="fas fa-print me-2"></i>Cetak Detail
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>

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
});
</script>

@endsection

@section('scripts')
    <script>
        function loadPreview() {
            const bulan = document.getElementById('preview_bulan').value;
            const tahun = document.getElementById('preview_tahun').value;
            const content = document.getElementById('previewContent');

            content.innerHTML =
                '<div class="text-center"><i class="fas fa-spinner fa-spin fa-2x"></i><p>Memuat preview...</p></div>';

            fetch(`{{ route('admin.penggajian.preview') }}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        bulan: parseInt(bulan),
                        tahun: parseInt(tahun)
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.length === 0) {
                        content.innerHTML = '<div class="alert alert-warning">Tidak ada data karyawan aktif.</div>';
                        return;
                    }

                    let html = '<div class="table-responsive"><table class="table table-sm table-bordered">';
                    html +=
                        '<thead><tr><th>Nama</th><th>Jabatan</th><th>Gaji Pokok</th><th>Tunjangan</th><th>Bonus</th><th>Potongan</th><th>Total</th><th>Keterangan</th></tr></thead><tbody>';

                    data.forEach(item => {
                        if (item.error) {
                            html +=
                                `<tr class="table-danger"><td>${item.nama}</td><td>${item.jabatan}</td><td colspan="6">Error: ${item.error}</td></tr>`;
                        } else {
                            html += `<tr>
                    <td>${item.nama}</td>
                    <td>${item.jabatan}</td>
                    <td>Rp ${item.gaji_pokok ? item.gaji_pokok.toLocaleString('id-ID') : '0'}</td>
                    <td>Rp ${item.tunjangan ? item.tunjangan.toLocaleString('id-ID') : '0'}</td>
                    <td>Rp ${item.bonus ? item.bonus.toLocaleString('id-ID') : '0'}</td>
                    <td>Rp ${item.potongan ? item.potongan.toLocaleString('id-ID') : '0'}</td>
                    <td><strong>Rp ${item.jumlah_gaji ? item.jumlah_gaji.toLocaleString('id-ID') : '0'}</strong></td>
                    <td><small>${item.keterangan || ''}</small></td>
                </tr>`;
                        }
                    });

                    html += '</tbody></table></div>';
                    content.innerHTML = html;
                })
                .catch(error => {
                    content.innerHTML = '<div class="alert alert-danger">Gagal memuat preview: ' + error.message +
                        '</div>';
                });
        }

        function viewDetail(id) {
            console.log('viewDetail function called with ID:', id);

            if (!id) {
                alert('ID gaji tidak valid');
                return;
            }

            // Buka modal dan load data detail
            const modalElement = document.getElementById('detailModal');
            if (!modalElement) {
                alert('Modal tidak ditemukan. Pastikan modal detail ada di halaman.');
                console.error('detailModal element not found');
                return;
            }

            console.log('Modal element found, initializing...');

            try {
                const modal = new bootstrap.Modal(modalElement);
                const content = document.getElementById('detailContent');

                if (!content) {
                    alert('Konten modal tidak ditemukan');
                    return;
                }

                // Reset content dan tampilkan loading
                content.innerHTML = `
                    <div class="loading-container">
                        <div class="text-center">
                            <i class="fas fa-spinner fa-spin fa-3x text-primary mb-3"></i>
                            <h5 class="text-muted">Memuat detail gaji...</h5>
                        </div>
                    </div>
                `;

                // Set edit button action
                const editBtn = document.getElementById('editFromModal');
                if (editBtn) {
                    editBtn.onclick = function() {
                        window.location.href = `{{ route('admin.penggajian') }}/${id}/edit`;
                    };
                }

                // Set print button action
                const printBtn = document.getElementById('printFromModal');
                if (printBtn) {
                    printBtn.onclick = function() {
                        printGajiDetail();
                    };
                }

                // Show modal
                console.log('Showing modal...');
                modal.show();

                // Fetch detail data
                console.log('Fetching data from API...');
                const apiUrl = `{{ route('admin.penggajian') }}/${id}/api`;
                console.log('API URL:', apiUrl);

                fetch(apiUrl, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => {
                        console.log('API Response status:', response.status);
                        if (!response.ok) {
                            throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('API Response data:', data);
                        if (data.success) {
                            content.innerHTML = data.html;
                            // Store data for printing
                            window.currentGajiData = data.data;
                            console.log('Detail loaded successfully');
                        } else {
                            content.innerHTML = '<div class="alert alert-danger">Gagal memuat detail: ' + (data
                                .message || 'Unknown error') + '</div>';
                        }
                    })
                    .catch(error => {
                        console.error('Fetch Error:', error);
                        content.innerHTML = '<div class="alert alert-danger">Terjadi kesalahan: ' + error.message +
                            '</div>';
                    });

            } catch (error) {
                console.error('Modal initialization error:', error);
                alert('Gagal membuka modal: ' + error.message);
            }
        }

        function printGajiDetail() {
            if (!window.currentGajiData) {
                alert('Data tidak tersedia untuk dicetak');
                return;
            }

            const data = window.currentGajiData;
            const printWindow = window.open('', '_blank');

            // Calculate totals
            const totalGaji = (data.gaji_pokok || 0) + (data.uang_makan || 0) + (data.uang_transport || 0) + (data
                .uang_lembur || 0);
            const totalPotongan = (data.potongan_bpjs || 0) + (data.potongan_pajak || 0);
            const gajiBersih = totalGaji - totalPotongan;

            printWindow.document.write(`
                <html>
                    <head>
                        <title>Detail Gaji - ${data.karyawan.nama}</title>
                        <style>
                            body { 
                                font-family: Arial, sans-serif; 
                                margin: 20px; 
                                font-size: 12px;
                            }
                            .header { 
                                text-align: center; 
                                margin-bottom: 30px; 
                                border-bottom: 2px solid #333;
                                padding-bottom: 15px;
                            }
                            .detail-table { 
                                width: 100%; 
                                border-collapse: collapse; 
                                margin-bottom: 20px; 
                            }
                            .detail-table th, .detail-table td { 
                                padding: 8px; 
                                border: 1px solid #ddd; 
                                text-align: left; 
                            }
                            .detail-table th { 
                                background-color: #f5f5f5; 
                                font-weight: bold;
                            }
                            .text-right { text-align: right; }
                            .total-row { 
                                background-color: #e9ecef; 
                                font-weight: bold; 
                            }
                            .gaji-bersih { 
                                background-color: #d4edda; 
                                font-weight: bold; 
                                font-size: 14px; 
                            }
                            .company-name {
                                font-size: 18px;
                                font-weight: bold;
                                color: #333;
                            }
                            .slip-title {
                                font-size: 16px;
                                margin: 10px 0;
                            }
                        </style>
                    </head>
                    <body>
                        <div class="header">
                            <div class="company-name">YOGYA TOSERBA</div>
                            <div class="slip-title">SLIP GAJI KARYAWAN</div>
                            <p>Periode: ${new Date(data.tanggal_gaji).toLocaleDateString('id-ID', {month: 'long', year: 'numeric'})}</p>
                        </div>
                        
                        <table class="detail-table">
                            <tr><th colspan="2">INFORMASI KARYAWAN</th></tr>
                            <tr><td width="30%"><strong>Nama Karyawan</strong></td><td>${data.karyawan.nama}</td></tr>
                            <tr><td><strong>ID Karyawan</strong></td><td>${data.id_karyawan}</td></tr>
                            <tr><td><strong>Jabatan</strong></td><td>${data.karyawan.jabatan ? data.karyawan.jabatan.nama_jabatan : 'Tidak ada'}</td></tr>
                            <tr><td><strong>Email</strong></td><td>${data.karyawan.email}</td></tr>
                            <tr><td><strong>Tanggal Gaji</strong></td><td>${new Date(data.tanggal_gaji).toLocaleDateString('id-ID')}</td></tr>
                        </table>
                        
                        <table class="detail-table">
                            <tr class="total-row"><th colspan="2">RINCIAN GAJI</th></tr>
                            <tr><td width="50%">Gaji Pokok</td><td class="text-right">Rp ${Number(data.gaji_pokok || 0).toLocaleString('id-ID')}</td></tr>
                            <tr><td>Uang Makan</td><td class="text-right">Rp ${Number(data.uang_makan || 0).toLocaleString('id-ID')}</td></tr>
                            <tr><td>Uang Transport</td><td class="text-right">Rp ${Number(data.uang_transport || 0).toLocaleString('id-ID')}</td></tr>
                            <tr><td>Uang Lembur</td><td class="text-right">Rp ${Number(data.uang_lembur || 0).toLocaleString('id-ID')}</td></tr>
                            <tr class="total-row"><td><strong>Sub Total</strong></td><td class="text-right"><strong>Rp ${totalGaji.toLocaleString('id-ID')}</strong></td></tr>
                        </table>
                        
                        <table class="detail-table">
                            <tr class="total-row"><th colspan="2">POTONGAN</th></tr>
                            <tr><td width="50%">Potongan BPJS</td><td class="text-right">Rp ${Number(data.potongan_bpjs || 0).toLocaleString('id-ID')}</td></tr>
                            <tr><td>Potongan Pajak</td><td class="text-right">Rp ${Number(data.potongan_pajak || 0).toLocaleString('id-ID')}</td></tr>
                            <tr class="total-row"><td><strong>Total Potongan</strong></td><td class="text-right"><strong>Rp ${totalPotongan.toLocaleString('id-ID')}</strong></td></tr>
                        </table>
                        
                        <table class="detail-table">
                            <tr class="gaji-bersih"><td width="50%"><strong>GAJI BERSIH</strong></td><td class="text-right"><strong>Rp ${gajiBersih.toLocaleString('id-ID')}</strong></td></tr>
                        </table>
                        
                        <div style="margin-top: 50px; font-size: 10px;">
                            <p>Dicetak pada: ${new Date().toLocaleDateString('id-ID')} ${new Date().toLocaleTimeString('id-ID')}</p>
                            <p><em>Slip gaji ini dicetak otomatis oleh sistem</em></p>
                        </div>
                    </body>
                </html>
            `);
            printWindow.document.close();
            printWindow.print();
        }

        function markAsPaid(id) {
            console.log('markAsPaid function called with ID:', id);

            if (!id) {
                alert('ID gaji tidak valid');
                return;
            }

            if (confirm('Tandai gaji ini sebagai sudah dibayar?')) {
                console.log('Sending mark as paid request...');

                fetch(`{{ route('admin.penggajian') }}/${id}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({
                            status_pembayaran: 'paid'
                        })
                    })
                    .then(response => {
                        console.log('Mark as paid response status:', response.status);
                        if (!response.ok) {
                            throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Mark as paid response:', data);
                        if (data.success) {
                            alert('Status pembayaran berhasil diperbarui');
                            location.reload();
                        } else {
                            alert('Gagal mengupdate status: ' + (data.message || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Mark as paid error:', error);
                        alert('Terjadi kesalahan: ' + error.message);
                    });
            }
        }

        function generateSlip(id) {
            console.log('generateSlip function called with ID:', id);

            if (!id) {
                alert('ID gaji tidak valid');
                return;
            }

            // Generate dan download slip gaji
            if (confirm('Generate slip gaji untuk karyawan ini?')) {
                try {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `{{ route('admin.penggajian.generate') }}`;
                    form.target = '_blank';
                    form.style.display = 'none';

                    // CSRF token
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = '{{ csrf_token() }}';
                    form.appendChild(csrfInput);

                    // ID Gaji
                    const idInput = document.createElement('input');
                    idInput.type = 'hidden';
                    idInput.name = 'gaji_id';
                    idInput.value = id;
                    form.appendChild(idInput);

                    document.body.appendChild(form);
                    console.log('Submitting slip generation form...');
                    form.submit();

                    // Clean up
                    setTimeout(() => {
                        document.body.removeChild(form);
                    }, 1000);
                } catch (error) {
                    console.error('Generate slip error:', error);
                    alert('Terjadi kesalahan saat generate slip: ' + error.message);
                }
            }
        }

        // Initialize Bootstrap dropdowns when page loads
        document.addEventListener('DOMContentLoaded', function() {
            console.log('🚀 DOM loaded, initializing penggajian actions...');
            console.log('Action buttons found:', document.querySelectorAll('[data-action]').length);
            console.log('Bootstrap available:', typeof bootstrap !== 'undefined');

            // Wait for Bootstrap to be fully loaded
            if (typeof bootstrap === 'undefined') {
                console.error('Bootstrap is not loaded');
                setTimeout(() => {
                    if (typeof bootstrap === 'undefined') {
                        alert('Bootstrap tidak dapat dimuat. Refresh halaman dan coba lagi.');
                    } else {
                        initializeDropdowns();
                    }
                }, 2000);
                return;
            }

            initializeDropdowns();
            setupEventDelegation();

            console.log('✅ All penggajian actions initialized');
        });

        function setupEventDelegation() {
            console.log('Setting up event delegation for penggajian actions...');

            // Use event delegation for dropdown actions
            document.addEventListener('click', function(e) {
                console.log('Click detected on:', e.target);

                const target = e.target.closest('[data-action]');
                console.log('Target with data-action:', target);

                if (!target) return;

                e.preventDefault();
                e.stopPropagation();

                const action = target.getAttribute('data-action');
                const id = target.getAttribute('data-id');
                const name = target.getAttribute('data-name');

                console.log(`Action clicked: ${action}, ID: ${id}, Name: ${name}`);

                switch (action) {
                    case 'view-detail':
                        console.log('Calling viewDetail with ID:', id);
                        viewDetail(id);
                        break;
                    case 'edit-gaji':
                        console.log('Calling editGaji with ID:', id);
                        editGaji(id);
                        break;
                    case 'mark-paid':
                        console.log('Calling markAsPaid with ID:', id);
                        markAsPaid(id);
                        break;
                    case 'generate-slip':
                        console.log('Calling generateSlip with ID:', id);
                        generateSlip(id);
                        break;
                    case 'delete-gaji':
                        console.log('Calling deleteGaji with ID:', id, 'Name:', name);
                        deleteGaji(id, name);
                        break;
                    default:
                        console.warn('Unknown action:', action);
                }
            });

            console.log('✅ Event delegation setup complete');
        }

        function initializeDropdowns() {
            console.log('Initializing Bootstrap dropdowns...');

            // Clear any existing dropdown instances first
            document.querySelectorAll('.dropdown-toggle').forEach(function(element) {
                const existingInstance = bootstrap.Dropdown.getInstance(element);
                if (existingInstance) {
                    existingInstance.dispose();
                }
            });

            try {
                // Initialize all dropdown buttons with proper error handling
                const dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
                console.log('Found dropdown elements:', dropdownElementList.length);

                const dropdownList = dropdownElementList.map(function(dropdownToggleEl, index) {
                    try {
                        const dropdown = new bootstrap.Dropdown(dropdownToggleEl, {
                            boundary: 'viewport',
                            display: 'dynamic',
                            autoClose: true
                        });

                        console.log(`Dropdown ${index + 1} (${dropdownToggleEl.id}) initialized successfully`);
                        return dropdown;
                    } catch (e) {
                        console.error('Failed to initialize dropdown:', dropdownToggleEl.id, e);
                        return null;
                    }
                }).filter(dropdown => dropdown !== null);

                console.log('Bootstrap dropdowns initialized successfully:', dropdownList.length);

                // Add global event listeners for debugging and functionality
                document.addEventListener('show.bs.dropdown', function(event) {
                    console.log('Dropdown showing:', event.target.id);
                    // Ensure other dropdowns close
                    document.querySelectorAll('.dropdown-menu.show').forEach(function(menu) {
                        if (menu !== event.target.nextElementSibling) {
                            const toggle = menu.previousElementSibling;
                            if (toggle && toggle.classList.contains('dropdown-toggle')) {
                                const instance = bootstrap.Dropdown.getInstance(toggle);
                                if (instance) {
                                    instance.hide();
                                }
                            }
                        }
                    });
                });

                document.addEventListener('shown.bs.dropdown', function(event) {
                    console.log('Dropdown shown:', event.target.id);
                });

                document.addEventListener('hide.bs.dropdown', function(event) {
                    console.log('Dropdown hiding:', event.target.id);
                });

                document.addEventListener('hidden.bs.dropdown', function(event) {
                    console.log('Dropdown hidden:', event.target.id);
                });

                dropdownElementList.forEach(function(toggle, index) {
                    toggle.addEventListener('click', function(e) {
                        console.log(`Dropdown ${index + 1} clicked:`, this.id);
                    });
                });

            } catch (error) {
                console.error('Error initializing dropdowns:', error);

                // Fallback: try manual event handling
                console.log('Attempting fallback dropdown handling...');
                document.querySelectorAll('.dropdown-toggle').forEach(function(toggle) {
                    toggle.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        console.log('Fallback: Manual dropdown toggle clicked');

                        const menu = this.nextElementSibling;
                        if (menu && menu.classList.contains('dropdown-menu')) {
                            // Close all other dropdowns
                            document.querySelectorAll('.dropdown-menu.show').forEach(function(otherMenu) {
                                if (otherMenu !== menu) {
                                    otherMenu.classList.remove('show');
                                }
                            });

                            // Toggle current dropdown
                            menu.classList.toggle('show');
                        }
                    });
                });

                // Close dropdowns when clicking outside
                document.addEventListener('click', function(e) {
                    if (!e.target.closest('.dropdown')) {
                        document.querySelectorAll('.dropdown-menu.show').forEach(function(menu) {
                            menu.classList.remove('show');
                        });
                    }
                });
            }
        }

        // Make functions globally available
        window.viewDetail = viewDetail;
        window.markAsPaid = markAsPaid;
        window.generateSlip = generateSlip;
    </script>
@endsection
