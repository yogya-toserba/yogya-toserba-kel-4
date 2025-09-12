@extends('layouts.navbar_admin')

@section('title', 'Sistem Penggajian Otomatis')

@push('styles')
    <style>
        /* CSS VARIABLES FOR DARK THEME TABLE */
        :root {
            --table-bg: #2c3e50;
            --table-text: #ecf0f1;
            --table-header-bg: #34495e;
            --table-border: #3a4750;
        }

        body.dark-mode {
            --table-bg: #2c3e50 !important;
            --table-text: #ecf0f1 !important;
            --table-header-bg: #34495e !important;
            --table-border: #3a4750 !important;
        }

        /* ULTIMATE DARK THEME TABLE - OVERRIDE ALL */
        body.dark-mode * {
            border-color: #3a4750 !important;
        }

        body.dark-mode .new-penggajian-dashboard {
            background: #1a1d29 !important;
        }

        body.dark-mode .new-card,
        body.dark-mode .new-card *:not(.badge):not(.btn) {
            background: var(--table-bg) !important;
            color: var(--table-text) !important;
            border-color: var(--table-border) !important;
        }

        body.dark-mode .table,
        body.dark-mode .table *,
        body.dark-mode .table-responsive {
            background: var(--table-bg) !important;
            color: var(--table-text) !important;
            border-color: var(--table-border) !important;
        }

        body.dark-mode .table thead th {
            background: var(--table-header-bg) !important;
            color: #bdc3c7 !important;
            font-weight: 600;
        }

        body.dark-mode .table tbody tr:hover {
            background: #34495e !important;
        }

        /* DARK THEME TABLE - OVERRIDE ALL WHITE SETTINGS */
        .table,
        .table *,
        .table-responsive,
        .table thead,
        .table tbody,
        .table tr,
        .table th,
        .table td {
            background: #2c3e50 !important;
            background-color: #2c3e50 !important;
            color: #ecf0f1 !important;
            border-color: #3a4750 !important;
        }

        .table thead th {
            background: #34495e !important;
            background-color: #34495e !important;
            color: #bdc3c7 !important;
            font-weight: 600;
            border-bottom: 2px solid #3a4750 !important;
        }

        .table tbody tr:hover {
            background: #34495e !important;
            background-color: #34495e !important;
        }

        /* BADGE STYLES FOR DARK THEME */
        .badge {
            background: #27ae60 !important;
            color: #ffffff !important;
            border: 1px solid #2ecc71 !important;
            padding: 0.375rem 0.75rem;
            border-radius: 0.375rem;
            font-weight: 500;
        }

        .badge.bg-success {
            background: #27ae60 !important;
            border-color: #2ecc71 !important;
        }

        .badge.bg-warning {
            background: #f39c12 !important;
            color: #ffffff !important;
            border-color: #e67e22 !important;
        }

        .badge.bg-danger {
            background: #e74c3c !important;
            border-color: #c0392b !important;
        }

        /* BUTTON STYLES FOR DARK THEME */
        .btn {
            background: #34495e !important;
            color: #ecf0f1 !important;
            border: 1px solid #3a4750 !important;
            border-radius: 0.375rem;
        }

        .btn:hover {
            background: #3a4750 !important;
            color: #ffffff !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-outline-secondary {
            background: transparent !important;
            color: #bdc3c7 !important;
            border: 1px solid #3a4750 !important;
        }

        .btn-outline-secondary:hover {
            background: #34495e !important;
            color: #ffffff !important;
        }

        /* CARD AND CONTAINER DARK THEME */
        .new-card {
            background: #2c3e50 !important;
            color: #ecf0f1 !important;
            border: 1px solid #3a4750 !important;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }

        .new-card-header {
            background: #34495e !important;
            color: #bdc3c7 !important;
            border-bottom: 1px solid #3a4750 !important;
        }

        .new-card-body {
            background: #2c3e50 !important;
            color: #ecf0f1 !important;
        }

        /* PAGE BACKGROUND */
        .new-penggajian-dashboard {
            background: #1a252f !important;
            min-height: 100vh;
        }

        /* FORM ELEMENTS DARK THEME */
        .form-control,
        .form-select {
            background: #34495e !important;
            color: #ecf0f1 !important;
            border: 1px solid #3a4750 !important;
        }

        .form-control:focus,
        .form-select:focus {
            background: #34495e !important;
            color: #ecf0f1 !important;
            border-color: #3498db !important;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

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
            transform: scale(1.02);
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
            overflow-x: auto !important;
            overflow-y: visible !important;
            position: relative !important;
        }

        .table-responsive .dropdown-menu {
            position: absolute !important;
            z-index: 1060 !important;
            max-height: 200px !important;
            overflow-y: auto !important;
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
            transform: scale(1.02);
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

        /* DARK MODE STYLING FOR TABLES - MATCHING DATA KARYAWAN */
        body.dark-mode .table-responsive {
            background: #2a2d3f !important;
        }

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

        /* Detail table dark mode */
        body.dark-mode .detail-table {
            background: #2a2d3f !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode .detail-table td {
            color: #e2e8f0 !important;
            border-color: #3a3d4a !important;
        }

        body.dark-mode .detail-table tr:nth-child(even) {
            background-color: #3a3d4a !important;
        }

        /* Badge styles dark mode */
        body.dark-mode .badge-success {
            background: #065f46 !important;
            color: #a7f3d0 !important;
        }

        body.dark-mode .badge-warning {
            background: #92400e !important;
            color: #fde68a !important;
        }

        body.dark-mode .badge-danger {
            background: #991b1b !important;
            color: #fecaca !important;
        }

        /* Dropdown menu dark mode */
        body.dark-mode .dropdown-menu {
            background: #2a2d3f !important;
            border-color: #3a3d4a !important;
        }

        body.dark-mode .dropdown-item {
            color: #e2e8f0 !important;
        }

        body.dark-mode .dropdown-item:hover {
            background: #3a3d4a !important;
            color: #e2e8f0 !important;
        }

        /* Modal dark mode */
        body.dark-mode .modal-content {
            background: #2a2d3f !important;
            border-color: #3a3d4a !important;
        }

        body.dark-mode .modal-header {
            border-color: #3a3d4a !important;
        }

        body.dark-mode .modal-body {
            color: #e2e8f0 !important;
        }

        body.dark-mode .modal-title {
            color: #e2e8f0 !important;
        }

        body.dark-mode .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }

        /* TABLE STYLING - MATCHING DATA KARYAWAN EXACTLY */
        .new-card {
            background: white !important;
            border-radius: 15px !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
            border: 1px solid #e2e8f0 !important;
            margin-bottom: 25px !important;
            transition: all 0.3s ease !important;
        }

        body.dark-mode .new-card {
            background: #2a2d3f !important;
            border-color: #3a3d4a !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3) !important;
        }

        .new-card-header {
            background: #f8fafc !important;
            border-bottom: 1px solid #e2e8f0 !important;
            padding: 20px 25px !important;
            border-radius: 15px 15px 0 0 !important;
        }

        body.dark-mode .new-card-header {
            background: #2a2d3f !important;
            border-color: #3a3d4a !important;
        }

        .new-card-title {
            font-size: 1.25rem !important;
            font-weight: 600 !important;
            color: #1e293b !important;
            margin: 0 !important;
            display: flex !important;
            align-items: center !important;
        }

        body.dark-mode .new-card-title {
            color: #e2e8f0 !important;
        }

        .new-card-body {
            padding: 25px !important;
            position: relative !important;
            overflow: visible !important;
        }

        .new-card-footer {
            background: #f8fafc !important;
            border-top: 1px solid #e2e8f0 !important;
            padding: 20px 25px !important;
            border-radius: 0 0 15px 15px !important;
        }

        body.dark-mode .new-card-footer {
            background: #2a2d3f !important;
            border-color: #3a3d4a !important;
        }

        /* Table Styling */
        .table-responsive {
            border-radius: 10px !important;
            overflow: hidden !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05) !important;
        }

        .table {
            margin-bottom: 0 !important;
            background: white !important;
            border-collapse: separate !important;
            border-spacing: 0 !important;
        }

        /* OVERRIDE TABLE BACKGROUND FOR DARK MODE */
        body.dark-mode .table {
            background: #2a2d3f !important;
        }

        .table thead th {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%) !important;
            color: #475569 !important;
            font-weight: 600 !important;
            font-size: 0.875rem !important;
            text-transform: uppercase !important;
            letter-spacing: 0.025em !important;
            padding: 16px 12px !important;
            border: none !important;
            border-bottom: 2px solid #e2e8f0 !important;
            white-space: nowrap !important;
        }

        .table tbody td {
            padding: 16px 12px !important;
            border: none !important;
            border-bottom: 1px solid #f1f5f9 !important;
            vertical-align: middle !important;
            font-size: 0.875rem !important;
            color: #334155 !important;
        }

        .table tbody tr {
            transition: all 0.2s ease !important;
        }

        .table tbody tr:hover {
            background: #f8fafc !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05) !important;
        }

        .table tbody tr:last-child td {
            border-bottom: none !important;
        }

        /* Dark mode table styling */
        body.dark-mode .table {
            background: #2a2d3f !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode .table thead th {
            background: linear-gradient(135deg, #2a2d3f 0%, #3a3d4a 100%) !important;
            color: #94a3b8 !important;
            border-color: #3a3d4a !important;
        }

        body.dark-mode .table tbody td {
            color: #e2e8f0 !important;
            border-color: #3a3d4a !important;
        }

        body.dark-mode .table tbody tr:hover {
            background: #3a3d4a !important;
        }

        /* Ensure table responsive wrapper is also dark */
        body.dark-mode .table-responsive {
            background: #2a2d3f !important;
        }

        /* Badge styling matching data karyawan */
        .badge {
            font-size: 0.75rem !important;
            font-weight: 600 !important;
            padding: 6px 12px !important;
            border-radius: 20px !important;
            text-transform: uppercase !important;
            letter-spacing: 0.025em !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 4px !important;
        }

        .badge.bg-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
            color: white !important;
        }

        .badge.bg-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
            color: white !important;
        }

        .badge.bg-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
            color: white !important;
        }

        .badge.bg-info {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%) !important;
            color: white !important;
        }

        .badge.bg-secondary {
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%) !important;
            color: white !important;
        }

        /* Dropdown gear button styling */
        .gear-dropdown {
            background: white !important;
            border: 1px solid #e2e8f0 !important;
            color: #64748b !important;
            border-radius: 8px !important;
            padding: 8px !important;
            transition: all 0.2s ease !important;
            width: 36px !important;
            height: 36px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        .gear-dropdown:hover {
            background: #f8fafc !important;
            border-color: #cbd5e1 !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1) !important;
        }

        body.dark-mode .gear-dropdown {
            background: #3a3d4a !important;
            border-color: #4a4d5a !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode .gear-dropdown:hover {
            background: #4a4d5a !important;
            border-color: #5a5d6a !important;
        }

        /* Table container overflow control */
        .table-responsive {
            overflow-x: auto !important;
            overflow-y: hidden !important;
            position: relative !important;
            contain: layout style !important;
        }

        .table td,
        .table th {
            overflow: hidden !important;
            position: relative !important;
        }

        .dropdown {
            position: relative !important;
            contain: layout !important;
        }

        /* Specific positioning for action column dropdown */
        .table td:last-child .dropdown {
            position: static !important;
        }

        .table td:last-child .dropdown-menu {
            position: absolute !important;
            right: 0 !important;
            left: auto !important;
            transform: none !important;
            margin-top: 5px !important;
        }

        /* Prevent dropdown from extending beyond viewport */
        .dropdown-menu {
            max-width: 180px !important;
            white-space: nowrap !important;
        }

        /* Force dropdown to stay within table bounds */
        .table-responsive .dropdown {
            position: static !important;
        }

        .table-responsive .dropdown-menu {
            position: absolute !important;
            right: 5px !important;
            top: 100% !important;
            left: auto !important;
            transform: translateX(0) !important;
            margin-top: 2px !important;
            max-width: 160px !important;
            width: 160px !important;
            max-height: 200px !important;
            overflow-y: auto !important;
            z-index: 1050 !important;
        }

        /* Aggressive containment for action column */
        .table td:last-child {
            position: relative !important;
            overflow: hidden !important;
            contain: layout style !important;
        }

        .table td:last-child .dropdown {
            position: relative !important;
            contain: layout !important;
        }

        .table td:last-child .dropdown-menu {
            position: absolute !important;
            right: 5px !important;
            top: calc(100% + 2px) !important;
            left: auto !important;
            max-width: 150px !important;
            width: 150px !important;
            margin: 0 !important;
            transform: none !important;
            clip-path: inset(0 0 0 0) !important;
        }

        /* Ensure new-card has proper containing */
        .new-card {
            position: relative !important;
            overflow: hidden !important;
            contain: layout style !important;
        }

        /* Table wrapper absolute containment */
        .table-responsive {
            position: relative !important;
            overflow-x: auto !important;
            overflow-y: hidden !important;
            contain: layout style !important;
        }

        #penggajian-table-wrapper {
            position: relative !important;
            overflow: hidden !important;
            contain: layout style !important;
            border-radius: 10px !important;
        }

        /* Ensure row containers don't clip hover effects */
        .row.g-4 {
            overflow: visible !important;
        }

        .col-lg-3,
        .col-md-6,
        .col-md-3,
        .col-md-2,
        .col-12 {
            overflow: visible !important;
        }

        /* PAGINATION STYLING TO MATCH DATA KARYAWAN */
        .pagination {
            margin: 0 !important;
        }

        .pagination .page-link {
            color: #64748b !important;
            background: white !important;
            border: 1px solid #e2e8f0 !important;
            padding: 8px 12px !important;
            margin: 0 2px !important;
            border-radius: 6px !important;
            font-size: 0.875rem !important;
            font-weight: 500 !important;
            transition: all 0.2s ease !important;
        }

        .pagination .page-link:hover {
            color: #f26b37 !important;
            background: #fef2e7 !important;
            border-color: #f26b37 !important;
            transform: translateY(-1px) !important;
        }

        .pagination .page-item.active .page-link {
            color: white !important;
            background: linear-gradient(135deg, #f26b37 0%, #e55827 100%) !important;
            border-color: #f26b37 !important;
            box-shadow: 0 2px 8px rgba(242, 107, 55, 0.3) !important;
        }

        .pagination .page-item.disabled .page-link {
            color: #94a3b8 !important;
            background: #f1f5f9 !important;
            border-color: #e2e8f0 !important;
        }

        /* Dark mode pagination */
        body.dark-mode .pagination .page-link {
            color: #e2e8f0 !important;
            background: #3a3d4a !important;
            border-color: #4a4d5a !important;
        }

        body.dark-mode .pagination .page-link:hover {
            background: #4a4d5a !important;
            border-color: #f26b37 !important;
        }

        body.dark-mode .pagination .page-item.disabled .page-link {
            color: #64748b !important;
            background: #2a2d3f !important;
            border-color: #3a3d4a !important;
        }

        /* DataTables info styling */
        .dataTables_info {
            color: #64748b !important;
            font-size: 0.875rem !important;
            font-weight: 500 !important;
        }

        body.dark-mode .dataTables_info {
            color: #94a3b8 !important;
        }

        /* Empty state styling */
        .text-center.py-4 {
            padding: 4rem 2rem !important;
        }

        .text-center.py-4 .fa-inbox {
            color: #cbd5e1 !important;
            margin-bottom: 1rem !important;
        }

        body.dark-mode .text-center.py-4 .fa-inbox {
            color: #64748b !important;
        }

        /* ADDITIONAL AGGRESSIVE DARK MODE OVERRIDES */
        body.dark-mode .new-penggajian-dashboard,
        body.dark-mode .new-penggajian-dashboard .new-card,
        body.dark-mode .new-penggajian-dashboard .new-card-body,
        body.dark-mode .new-penggajian-dashboard .new-card-header,
        body.dark-mode .new-penggajian-dashboard .new-card-footer,
        body.dark-mode .new-penggajian-dashboard .table-responsive,
        body.dark-mode .new-penggajian-dashboard .table {
            background: #2a2d3f !important;
            color: #e2e8f0 !important;
        }

        /* Force all text elements in dark mode */
        body.dark-mode .new-penggajian-dashboard td,
        body.dark-mode .new-penggajian-dashboard th,
        body.dark-mode .new-penggajian-dashboard span,
        body.dark-mode .new-penggajian-dashboard div:not(.badge),
        body.dark-mode .new-penggajian-dashboard small {
            color: #e2e8f0 !important;
        }

        /* Force table cells background */
        body.dark-mode .table tbody tr {
            background: #2a2d3f !important;
        }

        body.dark-mode .table tbody tr:hover {
            background: #3a3d4a !important;
        }

        /* Force badge text to stay white */
        body.dark-mode .badge {
            color: white !important;
        }

        /* Force card headers in dark mode */
        body.dark-mode .new-card-header {
            background: #2a2d3f !important;
            border-color: #3a3d4a !important;
            color: #e2e8f0 !important;
        }

        /* Force card footers in dark mode */
        body.dark-mode .new-card-footer {
            background: #2a2d3f !important;
            border-color: #3a3d4a !important;
        }

        /* FINAL OVERRIDE - HIGHEST SPECIFICITY FOR DARK MODE */
        body.dark-mode .new-penggajian-dashboard .new-card .table {
            background: #2a2d3f !important;
        }

        body.dark-mode .new-penggajian-dashboard .new-card .table-responsive {
            background: #2a2d3f !important;
        }

        body.dark-mode .new-penggajian-dashboard .table tbody tr {
            background: #2a2d3f !important;
        }

        body.dark-mode .new-penggajian-dashboard .table tbody tr:hover {
            background: #3a3d4a !important;
        }

        /* Override transparent backgrounds */
        body.dark-mode .table {
            background: #2a2d3f !important;
        }

        body.dark-mode .table th {
            background: #3a3d4a !important;
        }

        body.dark-mode .table td {
            background: transparent !important;
        }

        /* ULTIMATE DARK MODE OVERRIDE - NUCLEAR OPTION */
        body.dark-mode .new-penggajian-dashboard .new-card .new-card-body .table-responsive .table,
        body.dark-mode .new-penggajian-dashboard .new-card .new-card-body .table-responsive,
        body.dark-mode .new-penggajian-dashboard .new-card .new-card-body {
            background: #2a2d3f !important;
        }

        body.dark-mode .new-penggajian-dashboard .new-card .new-card-body .table-responsive .table thead th {
            background: #3a3d4a !important;
        }

        body.dark-mode .new-penggajian-dashboard .new-card .new-card-body .table-responsive .table tbody tr {
            background: #2a2d3f !important;
        }

        body.dark-mode .new-penggajian-dashboard .new-card .new-card-body .table-responsive .table tbody tr:hover {
            background: #3a3d4a !important;
        }

        /* ULTIMATE FORCE - OVERRIDE ALL BOOTSTRAP TABLE CLASSES */
        body.dark-mode .table,
        body.dark-mode .table-striped>tbody>tr:nth-of-type(odd)>td,
        body.dark-mode .table-striped>tbody>tr:nth-of-type(odd)>th,
        body.dark-mode .table-hover>tbody>tr:hover>td,
        body.dark-mode .table-hover>tbody>tr:hover>th {
            background: #2a2d3f !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode .table-responsive {
            background: #2a2d3f !important;
        }

        /* Force override any remaining white backgrounds */
        body.dark-mode * {
            border-color: #3a3d4a !important;
        }

        body.dark-mode .table tbody tr:hover {
            background-color: #3a3d4a !important;
        }

        /* MAXIMUM SPECIFICITY DARK MODE OVERRIDE */
        html body.dark-mode .new-penggajian-dashboard .new-card .new-card-body .table-responsive {
            background-color: #2a2d3f !important;
        }

        html body.dark-mode .new-penggajian-dashboard .new-card .new-card-body .table-responsive .table {
            background-color: #2a2d3f !important;
        }

        html body.dark-mode .new-penggajian-dashboard .new-card .new-card-body .table-responsive .table tbody tr {
            background-color: #2a2d3f !important;
        }

        html body.dark-mode .new-penggajian-dashboard .new-card .new-card-body .table-responsive .table tbody tr td {
            background-color: transparent !important;
        }

        html body.dark-mode .new-penggajian-dashboard .new-card .new-card-body .table-responsive .table thead tr th {
            background-color: #3a3d4a !important;
        }

        /* ANTI-BOOTSTRAP OVERRIDE */
        body.dark-mode .table:not(.table-dark) {
            background-color: #2a2d3f !important;
        }

        body.dark-mode .table:not(.table-dark)>tbody>tr>td {
            background-color: transparent !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode .table:not(.table-dark)>thead>tr>th {
            background-color: #3a3d4a !important;
            color: #94a3b8 !important;
        }

        /* FINAL ULTIMATE OVERRIDE - NUCLEAR OPTION */
        body.dark-mode .table,
        body.dark-mode .table.table-striped,
        body.dark-mode .table.table-hover,
        body.dark-mode .table.table-bordered {
            background-color: #2a2d3f !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode .table-responsive {
            background-color: #2a2d3f !important;
        }

        body.dark-mode .new-card .table {
            background-color: #2a2d3f !important;
        }

        body.dark-mode .new-card .table-responsive {
            background-color: #2a2d3f !important;
        }

        /* ULTRA HIGH SPECIFICITY CSS - NUCLEAR OPTION */
        html body.dark-mode .new-penggajian-dashboard .new-card .new-card-body .table-responsive,
        html body.dark-mode .new-penggajian-dashboard .new-card .new-card-body .table-responsive .table,
        html body.dark-mode .new-penggajian-dashboard .new-card .new-card-body .table,
        html body.dark-mode .table,
        html body.dark-mode table {
            background-color: #2a2d3f !important;
            background-image: none !important;
            background: #2a2d3f !important;
        }

        /* Use CSS selector with maximum specificity */
        html body.dark-mode div.new-penggajian-dashboard div.new-card div.new-card-body div.table-responsive table.table {
            background-color: #2a2d3f !important;
        }

        html body.dark-mode div.new-penggajian-dashboard div.new-card div.new-card-body div.table-responsive {
            background-color: #2a2d3f !important;
        }

        /* TARGET SPECIFIC TABLE IDS */
        body.dark-mode #penggajian-table-wrapper,
        body.dark-mode #penggajian-table {
            background-color: #2a2d3f !important;
            background: #2a2d3f !important;
        }

        /* ATTRIBUTE SELECTOR OVERRIDE */
        body.dark-mode [data-dark-mode="true"] {
            background-color: #2a2d3f !important;
            background: #2a2d3f !important;
        }

        /* LAST RESORT - OVERRIDE BOOTSTRAP DIRECTLY */
        body.dark-mode .table:not(.table-dark) {
            --bs-table-bg: #2a2d3f !important;
            --bs-table-color: #e2e8f0 !important;
            background-color: #2a2d3f !important;
        }

        /* Force ALL possible table selectors */
        body.dark-mode table,
        body.dark-mode table.table,
        body.dark-mode .table {
            background: #2a2d3f !important;
        }
    </style>

    <!-- JAVASCRIPT FORCE DARK MODE -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function forceDarkModeTable() {
                if (document.body.classList.contains('dark-mode')) {
                    console.log('Applying dark mode to tables...');

                    // Remove all conflicting styles first
                    const style = document.createElement('style');
                    style.innerHTML = `
                        body.dark-mode .table,
                        body.dark-mode .table-responsive,
                        body.dark-mode #penggajian-table,
                        body.dark-mode #penggajian-table-wrapper {
                            background: #2a2d3f !important;
                            color: #e2e8f0 !important;
                        }
                        body.dark-mode .table thead th {
                            background: #3a3d4a !important;
                            color: #94a3b8 !important;
                        }
                        body.dark-mode .table tbody tr:hover {
                            background: #3a3d4a !important;
                        }
                        body.dark-mode .new-card,
                        body.dark-mode .new-card-body {
                            background: #2a2d3f !important;
                        }
                    `;
                    document.head.appendChild(style);

                    // Override ALL white backgrounds by force
                    const allElements = document.querySelectorAll('*');
                    allElements.forEach(el => {
                        const computedStyle = window.getComputedStyle(el);
                        if (computedStyle.backgroundColor === 'rgb(255, 255, 255)' ||
                            computedStyle.backgroundColor === 'white' ||
                            el.style.backgroundColor === 'white' ||
                            el.style.backgroundColor === '#ffffff' ||
                            el.style.backgroundColor === '#fff') {
                            if (el.closest('.table, .table-responsive, .new-card')) {
                                el.style.setProperty('background-color', '#2a2d3f', 'important');
                                el.style.setProperty('background', '#2a2d3f', 'important');
                            }
                        }
                    });

                    // Force direct styling as backup
                    const tables = document.querySelectorAll(
                        '.table, .table-responsive, #penggajian-table, #penggajian-table-wrapper');
                    tables.forEach(table => {
                        table.style.setProperty('background-color', '#2a2d3f', 'important');
                        table.style.setProperty('background', '#2a2d3f', 'important');
                        table.style.setProperty('color', '#e2e8f0', 'important');
                        table.setAttribute('data-dark-mode', 'true');
                    });

                    // Force table rows
                    const rows = document.querySelectorAll('.table tbody tr');
                    rows.forEach(row => {
                        row.style.setProperty('background-color', '#2a2d3f', 'important');
                        row.style.setProperty('background', '#2a2d3f', 'important');
                    });

                    // Force table headers
                    const headers = document.querySelectorAll('.table thead th');
                    headers.forEach(header => {
                        header.style.setProperty('background-color', '#3a3d4a', 'important');
                        header.style.setProperty('background', '#3a3d4a', 'important');
                        header.style.setProperty('color', '#94a3b8', 'important');
                    });

                    // Force table cells
                    const cells = document.querySelectorAll('.table td');
                    cells.forEach(cell => {
                        cell.style.setProperty('background-color', 'transparent', 'important');
                        cell.style.setProperty('color', '#e2e8f0', 'important');
                    });

                    // Force cards
                    const cards = document.querySelectorAll('.new-card, .new-card-body');
                    cards.forEach(card => {
                        card.style.setProperty('background-color', '#2a2d3f', 'important');
                        card.style.setProperty('background', '#2a2d3f', 'important');
                    });

                    console.log('Dark mode applied to', tables.length, 'tables');

                    // BRUTAL FORCE - Remove all style attributes and reapply
                    setTimeout(() => {
                        const table = document.querySelector('#penggajian-table');
                        const wrapper = document.querySelector('#penggajian-table-wrapper');

                        if (table && wrapper) {
                            // Force wrapper
                            wrapper.style.backgroundColor = '#2a2d3f';
                            wrapper.style.color = '#e2e8f0';

                            // Force table
                            table.style.backgroundColor = '#2a2d3f';
                            table.style.color = '#e2e8f0';

                            // Force all table elements
                            table.querySelectorAll('*').forEach(el => {
                                if (el.tagName === 'THEAD' || el.tagName === 'TH') {
                                    el.style.backgroundColor = '#3a3d4a';
                                    el.style.color = '#94a3b8';
                                } else if (el.tagName === 'TBODY' || el.tagName === 'TR' || el
                                    .tagName === 'TD') {
                                    if (el.tagName === 'TD') {
                                        el.style.backgroundColor = 'transparent';
                                        el.style.color = '#e2e8f0';
                                    } else {
                                        el.style.backgroundColor = '#2a2d3f';
                                        el.style.color = '#e2e8f0';
                                    }
                                }
                            });

                            // Force text elements inside cells
                            table.querySelectorAll('td small, td div, td strong, td span').forEach(el => {
                                if (!el.classList.contains('badge')) {
                                    el.style.color = '#e2e8f0';
                                }
                            });

                            console.log('Brutal force styling applied');
                        }
                    }, 100);

                } else {
                    console.log('Not in dark mode, skipping table styling');
                }
            }

            // Run immediately
            forceDarkModeTable();

            // Run every 500ms to catch dynamic changes
            const interval = setInterval(forceDarkModeTable, 500);

            // Stop after 10 seconds to prevent infinite loop
            setTimeout(() => clearInterval(interval), 10000);

            // Listen for dark mode toggle
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                        console.log('Body class changed, applying dark mode...');
                        setTimeout(forceDarkModeTable, 50);
                    }
                });
            });

            observer.observe(document.body, {
                attributes: true,
                attributeFilter: ['class']
            });

            // Force on window load
            window.addEventListener('load', function() {
                console.log('Window loaded, applying dark mode...');
                forceDarkModeTable();
            });
        });
    </script>

    <!-- FINAL NUCLEAR CSS OVERRIDE -->
    <style id="dark-mode-nuclear-override">
        /* NUCLEAR OPTION - FORCE DARK MODE WITH MAXIMUM SPECIFICITY */
        body.dark-mode #penggajian-table-wrapper,
        body.dark-mode #penggajian-table,
        body.dark-mode #penggajian-table thead,
        body.dark-mode #penggajian-table tbody,
        body.dark-mode #penggajian-table tr,
        body.dark-mode #penggajian-table td,
        body.dark-mode #penggajian-table th {
            background: #2a2d3f !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode #penggajian-table thead th {
            background: #3a3d4a !important;
            color: #94a3b8 !important;
        }

        body.dark-mode #penggajian-table tbody tr:hover {
            background: #3a3d4a !important;
        }

        body.dark-mode #penggajian-table tbody tr:hover td {
            background: transparent !important;
        }

        /* Override any Bootstrap classes */
        body.dark-mode .table-responsive.table-responsive,
        body.dark-mode .table.table {
            background-color: #2a2d3f !important;
        }

        /* Force all text elements in table */
        body.dark-mode #penggajian-table td *:not(.badge),
        body.dark-mode #penggajian-table td small,
        body.dark-mode #penggajian-table td div,
        body.dark-mode #penggajian-table td strong,
        body.dark-mode #penggajian-table td span {
            color: #e2e8f0 !important;
        }

        body.dark-mode #penggajian-table .text-muted {
            color: #94a3b8 !important;
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

        /* DARK MODE OVERRIDE FOR MAIN CONTENT */
        body.dark-mode .main-content {
            background: #1a1d29 !important;
        }

        /* Ensure no parent container interferes */
        @media (min-width: 769px) {
            .main-content {
                margin-left: 250px !important;
                width: calc(100% - 250px) !important;
            }
        }

        /* Remove any extra padding or margin that might conflict */
        .main-content>* {
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

        .row>* {
            padding-left: 12px !important;
            padding-right: 12px !important;
        }

        /* Dark Mode Support */
        body.dark-mode .main-content {
            background: #1a1d29 !important;
        }

        /* CRITICAL DARK MODE TABLE OVERRIDE - PLACED HERE FOR HIGHER PRIORITY */
        body.dark-mode .table,
        body.dark-mode .table-responsive,
        body.dark-mode #penggajian-table,
        body.dark-mode #penggajian-table-wrapper {
            background: #2a2d3f !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode .table thead th {
            background: #3a3d4a !important;
            color: #94a3b8 !important;
        }

        body.dark-mode .new-card,
        body.dark-mode .new-card-body,
        body.dark-mode .new-card-header,
        body.dark-mode .new-card-footer {
            background: #2a2d3f !important;
            color: #e2e8f0 !important;
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
            transform: translateY(-1px) !important;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2) !important;
            color: white !important;
        }

        /* Stats Cards */
        .new-stat-card {
            background: white !important;
            padding: 25px 20px !important;
            border-radius: 15px !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
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
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3) !important;
        }

        .new-stat-card:hover {
            transform: translateY(-1px) !important;
            box-shadow: 0 6px 20px rgba(242, 107, 55, 0.15) !important;
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
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
            border: 1px solid #e2e8f0 !important;
            overflow: hidden !important;
            transition: all 0.3s ease !important;
        }

        /* FORCE DARK MODE CARDS - HIGHER SPECIFICITY */
        body.dark-mode .new-card {
            background: #2a2d3f !important;
            border-color: #3a3d4a !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3) !important;
        }

        body.dark-mode .new-card {
            background: #2a2d3f !important;
            border-color: #3a3d4a !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3) !important;
        }

        .new-card:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
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
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
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

        /* REMOVED DUPLICATE TABLE STYLING - USING THE FIRST ONE WITH PROPER DARK MODE OVERRIDE */

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

        /* Dark mode form controls */
        body.dark-mode .form-select,
        body.dark-mode .form-control {
            background-color: #2a2d3f !important;
            border-color: #3a3d4a !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode .form-select:focus,
        body.dark-mode .form-control:focus {
            background-color: #2a2d3f !important;
            border-color: #f26b37 !important;
            color: #e2e8f0 !important;
        }

        /* Dark mode card styling */
        body.dark-mode .new-card {
            background: #2a2d3f !important;
            border-color: #3a3d4a !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode .new-card-header {
            background: #2a2d3f !important;
            border-color: #3a3d4a !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode .new-card-body {
            background: #2a2d3f !important;
            color: #e2e8f0 !important;
        }

        /* Dark mode labels */
        body.dark-mode .form-label {
            color: #e2e8f0 !important;
        }

        body.dark-mode .text-muted {
            color: #9ca3af !important;
        }

        /* Dark mode pagination */
        body.dark-mode .pagination .page-link {
            background: #2a2d3f !important;
            border-color: #3a3d4a !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode .pagination .page-link:hover {
            background: #3a3d4a !important;
            border-color: #4a4d5a !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode .pagination .page-item.active .page-link {
            background: #f26b37 !important;
            border-color: #f26b37 !important;
            color: white !important;
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
            max-width: 180px !important;
            animation: dropdownSlideIn 0.2s ease-out !important;
            position: absolute !important;
            right: 0 !important;
            left: auto !important;
            transform: none !important;
            margin-top: 0.125rem !important;
            z-index: 1060 !important;
            contain: layout !important;
            overflow: hidden !important;
        }

        @keyframes dropdownSlideIn {
            0% {
                opacity: 0;
                transform: translateY(-5px) scale(0.98);
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

        /* MODAL FORM FIX - Remove all visual artifacts */
        .modal .form-select,
        .modal select,
        .modal-body .form-select,
        .modal-body select {
            background: #ffffff !important;
            border: 1px solid #d1d3e2 !important;
            border-radius: 8px !important;
            color: #374151 !important;
            padding: 8px 12px !important;
            font-size: 14px !important;
            line-height: 1.5 !important;
            appearance: none !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            background-image: none !important;
            background-repeat: no-repeat !important;
            background-position: right 12px center !important;
            background-size: 12px !important;
            outline: none !important;
            box-shadow: none !important;
            text-decoration: none !important;
            border-image: none !important;
            background-attachment: scroll !important;
            background-origin: padding-box !important;
            background-clip: border-box !important;
        }

        /* Add simple CSS arrow */
        .modal .form-select::after,
        .modal select::after,
        .modal-body .form-select::after,
        .modal-body select::after {
            content: '▼' !important;
            position: absolute !important;
            right: 12px !important;
            top: 50% !important;
            transform: translateY(-50%) !important;
            font-size: 10px !important;
            color: #6b7280 !important;
            pointer-events: none !important;
        }

        .modal .form-select:focus,
        .modal select:focus,
        .modal-body .form-select:focus,
        .modal-body select:focus {
            border-color: #f26b37 !important;
            box-shadow: 0 0 0 0.2rem rgba(242, 107, 55, 0.25) !important;
            outline: none !important;
        }

        /* Remove all webkit/moz artifacts for modal forms */
        .modal select::-webkit-inner-spin-button,
        .modal select::-webkit-outer-spin-button,
        .modal select::-webkit-search-decoration,
        .modal select::-webkit-search-cancel-button,
        .modal select::-webkit-search-results-button,
        .modal select::-webkit-search-results-decoration,
        .modal select::-webkit-calendar-picker-indicator,
        .modal .form-select::-webkit-inner-spin-button,
        .modal .form-select::-webkit-outer-spin-button,
        .modal .form-select::-webkit-search-decoration,
        .modal .form-select::-webkit-search-cancel-button,
        .modal .form-select::-webkit-search-results-button,
        .modal .form-select::-webkit-search-results-decoration,
        .modal .form-select::-webkit-calendar-picker-indicator {
            -webkit-appearance: none !important;
            display: none !important;
            opacity: 0 !important;
            visibility: hidden !important;
        }

        .modal select::-moz-focus-inner,
        .modal .form-select::-moz-focus-inner {
            border: 0 !important;
            padding: 0 !important;
        }

        /* Force clean modal form styling */
        .modal-body .row,
        .modal-body .col-md-6,
        .modal-body .col-md-4 {
            border: none !important;
            outline: none !important;
            background: transparent !important;
            box-shadow: none !important;
        }

        /* Modal form label styling */
        .modal .form-label,
        .modal-body .form-label {
            color: #374151 !important;
            font-weight: 600 !important;
            margin-bottom: 8px !important;
            font-size: 14px !important;
        }

        /* Modal button styling */
        .modal .btn,
        .modal-body .btn {
            border-radius: 8px !important;
            padding: 8px 16px !important;
            font-size: 14px !important;
            font-weight: 600 !important;
            border: none !important;
            outline: none !important;
            transition: all 0.3s ease !important;
        }

        .modal .btn-primary,
        .modal-body .btn-primary {
            background: linear-gradient(135deg, #f26b37, #e55827) !important;
            color: white !important;
        }

        .modal .btn-primary:hover,
        .modal-body .btn-primary:hover {
            background: linear-gradient(135deg, #e55827, #d94515) !important;
            transform: translateY(-1px) !important;
        }

        /* Remove any remaining artifacts */
        .modal *,
        .modal *::before,
        .modal *::after {
            border-image: none !important;
            border-image-source: none !important;
            border-image-slice: initial !important;
            border-image-width: initial !important;
            border-image-outset: initial !important;
            border-image-repeat: initial !important;
            text-decoration: none !important;
        }

        /* ULTIMATE FORM CLEANUP - Nuclear option for form artifacts */
        .modal select,
        .modal .form-select,
        .modal input,
        .modal textarea {
            all: unset !important;
            display: block !important;
            width: 100% !important;
            box-sizing: border-box !important;
            background: #ffffff !important;
            border: 1px solid #d1d3e2 !important;
            border-radius: 8px !important;
            padding: 8px 12px !important;
            font-size: 14px !important;
            color: #374151 !important;
            font-family: inherit !important;
            line-height: 1.5 !important;
            cursor: pointer !important;
        }

        .modal select:focus,
        .modal .form-select:focus {
            border-color: #f26b37 !important;
            box-shadow: 0 0 0 0.2rem rgba(242, 107, 55, 0.25) !important;
            outline: none !important;
        }

        /* Force override any browser default styling */
        .modal select option {
            background: #ffffff !important;
            color: #374151 !important;
            padding: 4px 8px !important;
        }

        /* Additional cleanup for container elements */
        .modal .form-group,
        .modal .mb-3,
        .modal .row,
        .modal .col-md-6,
        .modal .col-md-4 {
            border: none !important;
            outline: none !important;
            background: transparent !important;
            box-shadow: none !important;
            border-image: none !important;
            text-decoration: none !important;
        }

        /* Override any bootstrap interference */
        .modal .form-control,
        .modal .form-select {
            border: 1px solid #d1d3e2 !important;
            background-color: #ffffff !important;
            background-image: none !important;
            background-clip: padding-box !important;
            appearance: none !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
        }

        /* SPECIFIC FIX FOR PROSES MODAL */
        #prosesModal select,
        #prosesModal .form-select,
        #previewModal select,
        #previewModal .form-select {
            background: #ffffff !important;
            border: 1px solid #d1d3e2 !important;
            border-radius: 8px !important;
            color: #374151 !important;
            padding: 8px 12px !important;
            font-size: 14px !important;
            line-height: 1.5 !important;
            outline: none !important;
            box-shadow: none !important;
            appearance: none !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            background-image: none !important;
            background-repeat: no-repeat !important;
            background-position: right 12px center !important;
            background-size: 12px !important;
            border-image: none !important;
            text-decoration: none !important;
            background-attachment: scroll !important;
            background-origin: padding-box !important;
            background-clip: border-box !important;
            width: 100% !important;
            font-family: inherit !important;
            cursor: pointer !important;
        }

        #prosesModal select:focus,
        #prosesModal .form-select:focus,
        #previewModal select:focus,
        #previewModal .form-select:focus {
            border-color: #f26b37 !important;
            box-shadow: 0 0 0 0.2rem rgba(242, 107, 55, 0.25) !important;
            outline: none !important;
            background-color: #ffffff !important;
        }

        /* Remove all webkit artifacts for these specific modals */
        #prosesModal select::-webkit-inner-spin-button,
        #prosesModal select::-webkit-outer-spin-button,
        #prosesModal select::-webkit-search-decoration,
        #prosesModal select::-webkit-search-cancel-button,
        #prosesModal select::-webkit-search-results-button,
        #prosesModal select::-webkit-search-results-decoration,
        #prosesModal select::-webkit-calendar-picker-indicator,
        #prosesModal .form-select::-webkit-inner-spin-button,
        #prosesModal .form-select::-webkit-outer-spin-button,
        #prosesModal .form-select::-webkit-search-decoration,
        #prosesModal .form-select::-webkit-search-cancel-button,
        #prosesModal .form-select::-webkit-search-results-button,
        #prosesModal .form-select::-webkit-search-results-decoration,
        #prosesModal .form-select::-webkit-calendar-picker-indicator,
        #previewModal select::-webkit-inner-spin-button,
        #previewModal select::-webkit-outer-spin-button,
        #previewModal select::-webkit-search-decoration,
        #previewModal select::-webkit-search-cancel-button,
        #previewModal select::-webkit-search-results-button,
        #previewModal select::-webkit-search-results-decoration,
        #previewModal select::-webkit-calendar-picker-indicator,
        #previewModal .form-select::-webkit-inner-spin-button,
        #previewModal .form-select::-webkit-outer-spin-button,
        #previewModal .form-select::-webkit-search-decoration,
        #previewModal .form-select::-webkit-search-cancel-button,
        #previewModal .form-select::-webkit-search-results-button,
        #previewModal .form-select::-webkit-search-results-decoration,
        #previewModal .form-select::-webkit-calendar-picker-indicator {
            -webkit-appearance: none !important;
            display: none !important;
            opacity: 0 !important;
            visibility: hidden !important;
        }

        #prosesModal select::-moz-focus-inner,
        #prosesModal .form-select::-moz-focus-inner,
        #previewModal select::-moz-focus-inner,
        #previewModal .form-select::-moz-focus-inner {
            border: 0 !important;
            padding: 0 !important;
        }

        /* Force clean containers for proses modal */
        #prosesModal .modal-body .row,
        #prosesModal .modal-body .col-md-6,
        #previewModal .modal-body .row,
        #previewModal .modal-body .col-md-4 {
            border: none !important;
            outline: none !important;
            background: transparent !important;
            box-shadow: none !important;
            border-image: none !important;
            text-decoration: none !important;
        }

        /* Form labels in proses modal */
        #prosesModal .form-label,
        #previewModal .form-label {
            color: #374151 !important;
            font-weight: 600 !important;
            margin-bottom: 8px !important;
            font-size: 14px !important;
            border: none !important;
            background: transparent !important;
        }

        /* Button styling in proses modal */
        #prosesModal .btn,
        #previewModal .btn {
            border-radius: 8px !important;
            padding: 8px 16px !important;
            font-size: 14px !important;
            font-weight: 600 !important;
            border: none !important;
            outline: none !important;
            transition: all 0.3s ease !important;
        }

        #prosesModal .btn-success {
            background: linear-gradient(135deg, #10b981, #059669) !important;
            color: white !important;
        }

        #prosesModal .btn-success:hover {
            background: linear-gradient(135deg, #059669, #047857) !important;
            transform: translateY(-1px) !important;
        }

        #prosesModal .btn-secondary {
            background: #6c757d !important;
            color: white !important;
        }

        #prosesModal .btn-secondary:hover {
            background: #5a6268 !important;
        }

        /* Nuclear option for prosesModal forms */
        #prosesModal *,
        #prosesModal *::before,
        #prosesModal *::after,
        #previewModal *,
        #previewModal *::before,
        #previewModal *::after {
            border-image: none !important;
            border-image-source: none !important;
            border-image-slice: initial !important;
            border-image-width: initial !important;
            border-image-outset: initial !important;
            border-image-repeat: initial !important;
            text-decoration: none !important;
        }

        /* DARK MODE FOR MODALS */
        body.dark-mode .modal-content {
            background: #2a2d3f !important;
            border-color: #3a3d4a !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode .modal-header {
            background: #2a2d3f !important;
            border-color: #3a3d4a !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode .modal-body {
            background: #2a2d3f !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode .modal-footer {
            background: #2a2d3f !important;
            border-color: #3a3d4a !important;
        }

        body.dark-mode .modal-title {
            color: #e2e8f0 !important;
        }

        /* DARK MODE FOR MODAL FORMS */
        body.dark-mode #prosesModal select,
        body.dark-mode #prosesModal .form-select,
        body.dark-mode #previewModal select,
        body.dark-mode #previewModal .form-select,
        body.dark-mode .modal select,
        body.dark-mode .modal .form-select {
            background: #374151 !important;
            border: 1px solid #4a5568 !important;
            border-radius: 8px !important;
            color: #e2e8f0 !important;
            padding: 8px 12px !important;
            font-size: 14px !important;
            line-height: 1.5 !important;
            outline: none !important;
            box-shadow: none !important;
            appearance: none !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            background-image: none !important;
            border-image: none !important;
            text-decoration: none !important;
            width: 100% !important;
            font-family: inherit !important;
            cursor: pointer !important;
        }

        body.dark-mode #prosesModal select:focus,
        body.dark-mode #prosesModal .form-select:focus,
        body.dark-mode #previewModal select:focus,
        body.dark-mode #previewModal .form-select:focus,
        body.dark-mode .modal select:focus,
        body.dark-mode .modal .form-select:focus {
            border-color: #f26b37 !important;
            box-shadow: 0 0 0 0.2rem rgba(242, 107, 55, 0.25) !important;
            outline: none !important;
            background-color: #374151 !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode #prosesModal select option,
        body.dark-mode #previewModal select option,
        body.dark-mode .modal select option {
            background: #374151 !important;
            color: #e2e8f0 !important;
            padding: 4px 8px !important;
        }

        /* DARK MODE FOR MODAL LABELS */
        body.dark-mode #prosesModal .form-label,
        body.dark-mode #previewModal .form-label,
        body.dark-mode .modal .form-label {
            color: #e2e8f0 !important;
            font-weight: 600 !important;
            margin-bottom: 8px !important;
            font-size: 14px !important;
        }

        /* DARK MODE FOR MODAL BUTTONS */
        body.dark-mode #prosesModal .btn-secondary,
        body.dark-mode .modal .btn-secondary {
            background: #4a5568 !important;
            border-color: #4a5568 !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode #prosesModal .btn-secondary:hover,
        body.dark-mode .modal .btn-secondary:hover {
            background: #2d3748 !important;
            border-color: #2d3748 !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode #prosesModal .btn-success {
            background: linear-gradient(135deg, #10b981, #059669) !important;
            border: none !important;
            color: white !important;
        }

        body.dark-mode #prosesModal .btn-success:hover {
            background: linear-gradient(135deg, #059669, #047857) !important;
            transform: translateY(-1px) !important;
        }

        /* DARK MODE FOR ALERT IN MODAL */
        body.dark-mode #prosesModal .alert-success {
            background: linear-gradient(135deg, #10b981, #059669) !important;
            border: none !important;
            color: white !important;
        }

        body.dark-mode #prosesModal .text-muted {
            color: #9ca3af !important;
        }

        /* DARK MODE FOR MODAL CONTAINERS */
        body.dark-mode #prosesModal .modal-body .row,
        body.dark-mode #prosesModal .modal-body .col-md-6,
        body.dark-mode #previewModal .modal-body .row,
        body.dark-mode #previewModal .modal-body .col-md-4,
        body.dark-mode .modal .row,
        body.dark-mode .modal .col-md-6,
        body.dark-mode .modal .col-md-4 {
            border: none !important;
            outline: none !important;
            background: transparent !important;
            box-shadow: none !important;
            border-image: none !important;
            text-decoration: none !important;
        }

        /* DARK MODE FOR CLOSE BUTTON */
        body.dark-mode .modal .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%) !important;
        }

        /* DARK MODE FOR PREVIEW BUTTON */
        body.dark-mode #previewModal .btn-primary {
            background: linear-gradient(135deg, #f26b37, #e55827) !important;
            border: none !important;
            color: white !important;
        }

        body.dark-mode #previewModal .btn-primary:hover {
            background: linear-gradient(135deg, #e55827, #d94515) !important;
            transform: translateY(-1px) !important;
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
                    <div id="realTimeClock" style="font-weight: 600; color: white; font-size: 1rem; margin-top: 10px;">
                    </div>
                    <div><small id="currentDate" style="opacity: 0.8;"></small></div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert"
                style="border-radius: 10px; border: none; background: linear-gradient(135deg, #10b981, #059669); color: white;">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert"
                style="border-radius: 10px; border: none; background: linear-gradient(135deg, #ef4444, #dc2626); color: white;">
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
                    <div class="new-stat-icon">
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
                    <div class="new-stat-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="new-stat-number" style="font-size: 1.8rem;">
                        {{ number_format($stats['rata_rata_gaji'] ?? 0, 0, ',', '.') }}</div>
                    <div class="new-stat-label">Rata-rata Gaji (Rp)</div>
                    <div class="new-stat-change change-neutral">
                        <i class="fas fa-equals"></i> Normal
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="new-stat-card">
                    <div class="new-stat-icon">
                        <i class="fas fa-crown"></i>
                    </div>
                    <div class="new-stat-number" style="font-size: 1.8rem;">
                        {{ number_format($stats['gaji_tertinggi'] ?? 0, 0, ',', '.') }}</div>
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
                    <i class="fas fa-table me-2"></i>
                    Data Gaji - {{ Carbon\Carbon::create(null, $bulan, 1)->format('F') }} {{ $tahun }}
                </div>
            </div>
            <div class="new-card-body">
                @if ($gajiList->count() > 0)
                    <div class="table-responsive" id="penggajian-table-wrapper"
                        style="background: #2a2d3f !important; color: #e2e8f0 !important;">
                        <table class="table" id="penggajian-table"
                            style="background: #2a2d3f !important; color: #e2e8f0 !important;">
                            <thead style="background: #3a3d4a !important;">
                                <tr>
                                    <th style="width: 5%; background: #3a3d4a !important; color: #94a3b8 !important;">#
                                    </th>
                                    <th style="width: 20%; background: #3a3d4a !important; color: #94a3b8 !important;">Nama
                                        Karyawan</th>
                                    <th style="width: 12%; background: #3a3d4a !important; color: #94a3b8 !important;">
                                        Jabatan</th>
                                    <th style="width: 12%; background: #3a3d4a !important; color: #94a3b8 !important;">
                                        Absensi</th>
                                    <th style="width: 12%; background: #3a3d4a !important; color: #94a3b8 !important;">Gaji
                                        Pokok</th>
                                    <th style="width: 12%; background: #3a3d4a !important; color: #94a3b8 !important;">
                                        Tunjangan</th>
                                    <th style="width: 12%; background: #3a3d4a !important; color: #94a3b8 !important;">
                                        Potongan</th>
                                    <th style="width: 12%; background: #3a3d4a !important; color: #94a3b8 !important;">
                                        Total Gaji</th>
                                    <th style="width: 10%; background: #3a3d4a !important; color: #94a3b8 !important;">
                                        Status</th>
                                    <th style="width: 8%; background: #3a3d4a !important; color: #94a3b8 !important;">Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody style="background: #2a2d3f !important;">
                                @foreach ($gajiList as $index => $gaji)
                                    @php
                                        $statsAbsensi = $gaji->karyawan->getStatistikAbsensiBulan($tahun, $bulan);
                                    @endphp
                                    <tr style="background: #2a2d3f !important; color: #e2e8f0 !important;">
                                        <td style="background: transparent !important; color: #e2e8f0 !important;">
                                            {{ $gajiList->firstItem() + $index }}</td>
                                        <td style="background: transparent !important; color: #e2e8f0 !important;">
                                            {{ $gaji->karyawan->nama ?? 'N/A' }}</td>
                                        <td style="background: transparent !important; color: #e2e8f0 !important;">
                                            {{ $gaji->karyawan->jabatan->nama_jabatan ?? 'N/A' }}</td>
                                        <td style="background: transparent !important; color: #e2e8f0 !important;">
                                            <small class="text-muted" style="color: #94a3b8 !important;">
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
                                        <td style="background: transparent !important; color: #e2e8f0 !important;">Rp
                                            {{ number_format($gaji->gaji_pokok ?? 0, 0, ',', '.') }}</td>
                                        <td style="background: transparent !important; color: #e2e8f0 !important;">Rp
                                            {{ number_format(($gaji->tunjangan_jabatan ?? 0) + ($gaji->tunjangan_kehadiran ?? 0) + ($gaji->tunjangan_lainnya ?? 0), 0, ',', '.') }}
                                        </td>
                                        <td style="background: transparent !important; color: #e2e8f0 !important;">Rp
                                            {{ number_format(($gaji->potongan_absensi ?? 0) + ($gaji->potongan_lainnya ?? 0), 0, ',', '.') }}
                                        </td>
                                        <td style="background: transparent !important; color: #e2e8f0 !important;">
                                            <strong>Rp {{ number_format($gaji->jumlah_gaji ?? 0, 0, ',', '.') }}</strong>
                                        </td>
                                        <td style="background: transparent !important; color: #e2e8f0 !important;">
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
                                        <td class="text-center"
                                            style="background: transparent !important; color: #e2e8f0 !important;">
                                            <div class="dropdown">
                                                <button class="gear-dropdown" type="button"
                                                    id="dropdownMenuButton{{ $gaji->id_gaji ?? 0 }}"
                                                    data-bs-toggle="dropdown" aria-expanded="false" title="Aksi">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end"
                                                    aria-labelledby="dropdownMenuButton{{ $gaji->id_gaji ?? 0 }}">
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
                                                                <i class="fas fa-check text-success me-2"></i>Tandai
                                                                Dibayar
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

                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
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
                    <div class="new-card-footer">
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

            // Clean modal forms immediately
            cleanModalForms();

            // Additional immediate cleanup for specific modals
            setTimeout(() => {
                const prosesSelects = document.querySelectorAll(
                    '#prosesModal select, #prosesModal .form-select');
                const previewSelects = document.querySelectorAll(
                    '#previewModal select, #previewModal .form-select');

                [...prosesSelects, ...previewSelects].forEach(select => {
                    select.style.cssText = `
                        background: #ffffff !important;
                        border: 1px solid #d1d3e2 !important;
                        border-radius: 8px !important;
                        color: #374151 !important;
                        padding: 8px 12px !important;
                        font-size: 14px !important;
                        outline: none !important;
                        box-shadow: none !important;
                        appearance: none !important;
                        -webkit-appearance: none !important;
                        -moz-appearance: none !important;
                        background-image: none !important;
                        border-image: none !important;
                        text-decoration: none !important;
                        width: 100% !important;
                    `;
                });
            }, 500);

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

        // Function to clean modal forms from visual artifacts
        function cleanModalForms() {
            console.log('Cleaning modal forms...');

            // Apply immediate fix to all selects in modals
            const modalSelects = document.querySelectorAll('.modal select, .modal .form-select');
            modalSelects.forEach(select => {
                // Remove all visual artifacts
                select.style.cssText = `
                    background: #ffffff !important;
                    border: 1px solid #d1d3e2 !important;
                    border-radius: 8px !important;
                    color: #374151 !important;
                    padding: 8px 12px !important;
                    font-size: 14px !important;
                    line-height: 1.5 !important;
                    appearance: none !important;
                    -webkit-appearance: none !important;
                    -moz-appearance: none !important;
                    background-image: none !important;
                    background-repeat: no-repeat !important;
                    background-position: right 12px center !important;
                    background-size: 12px !important;
                    outline: none !important;
                    box-shadow: none !important;
                    text-decoration: none !important;
                    border-image: none !important;
                    background-attachment: scroll !important;
                    background-origin: padding-box !important;
                    background-clip: border-box !important;
                `;
            });

            // Clean modal containers
            const modalContainers = document.querySelectorAll(
                '.modal-body .row, .modal-body .col-md-6, .modal-body .col-md-4');
            modalContainers.forEach(container => {
                container.style.cssText = `
                    border: none !important;
                    outline: none !important;
                    background: transparent !important;
                    box-shadow: none !important;
                    border-image: none !important;
                    text-decoration: none !important;
                `;
            });

            // Observer to clean new modal elements
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.type === 'childList') {
                        mutation.addedNodes.forEach(function(node) {
                            if (node.nodeType === 1 && (node.classList?.contains('modal') || node
                                    .querySelector?.('.modal'))) {
                                setTimeout(() => cleanModalForms(), 100);
                            }
                        });
                    }
                });
            });

            observer.observe(document.body, {
                childList: true,
                subtree: true
            });

            console.log('Modal forms cleaned');
        }

        // Add modal event listeners to clean forms when modals open
        document.addEventListener('DOMContentLoaded', function() {
            // Listen for modal show events
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                modal.addEventListener('shown.bs.modal', function() {
                    console.log('Modal opened, cleaning forms...');
                    setTimeout(() => {
                        cleanModalForms();

                        // Additional cleanup for this specific modal
                        const modalSelects = this.querySelectorAll('select, .form-select');
                        modalSelects.forEach(select => {
                            // Force clean styling
                            select.style.setProperty('background', '#ffffff',
                                'important');
                            select.style.setProperty('border', '1px solid #d1d3e2',
                                'important');
                            select.style.setProperty('border-radius', '8px',
                                'important');
                            select.style.setProperty('outline', 'none',
                                'important');
                            select.style.setProperty('box-shadow', 'none',
                                'important');
                            select.style.setProperty('appearance', 'none',
                                'important');
                            select.style.setProperty('-webkit-appearance', 'none',
                                'important');
                            select.style.setProperty('-moz-appearance', 'none',
                                'important');
                            select.style.setProperty('background-image', 'none',
                                'important');
                            select.style.setProperty('border-image', 'none',
                                'important');
                            select.style.setProperty('text-decoration', 'none',
                                'important');
                        });
                    }, 100);
                });
            });

            // Special handling for prosesModal
            const prosesModal = document.getElementById('prosesModal');
            const previewModal = document.getElementById('previewModal');

            if (prosesModal) {
                prosesModal.addEventListener('shown.bs.modal', function() {
                    console.log('Proses modal opened, applying special cleanup...');
                    setTimeout(() => {
                        // Force clean all form elements in proses modal
                        const prosesSelects = prosesModal.querySelectorAll('select, .form-select');
                        prosesSelects.forEach(select => {
                            // Check if dark mode is active
                            if (document.body.classList.contains('dark-mode')) {
                                select.style.cssText = `
                                    background: #374151 !important;
                                    border: 1px solid #4a5568 !important;
                                    border-radius: 8px !important;
                                    color: #e2e8f0 !important;
                                    padding: 8px 12px !important;
                                    font-size: 14px !important;
                                    line-height: 1.5 !important;
                                    outline: none !important;
                                    box-shadow: none !important;
                                    appearance: none !important;
                                    -webkit-appearance: none !important;
                                    -moz-appearance: none !important;
                                    background-image: none !important;
                                    border-image: none !important;
                                    text-decoration: none !important;
                                    width: 100% !important;
                                    font-family: inherit !important;
                                    cursor: pointer !important;
                                `;
                            } else {
                                select.style.cssText = `
                                    background: #ffffff !important;
                                    border: 1px solid #d1d3e2 !important;
                                    border-radius: 8px !important;
                                    color: #374151 !important;
                                    padding: 8px 12px !important;
                                    font-size: 14px !important;
                                    line-height: 1.5 !important;
                                    outline: none !important;
                                    box-shadow: none !important;
                                    appearance: none !important;
                                    -webkit-appearance: none !important;
                                    -moz-appearance: none !important;
                                    background-image: none !important;
                                    border-image: none !important;
                                    text-decoration: none !important;
                                    width: 100% !important;
                                    font-family: inherit !important;
                                    cursor: pointer !important;
                                `;
                            }
                        });

                        // Clean containers
                        const containers = prosesModal.querySelectorAll(
                            '.row, .col-md-6, .modal-body');
                        containers.forEach(container => {
                            container.style.setProperty('border', 'none', 'important');
                            container.style.setProperty('outline', 'none', 'important');
                            container.style.setProperty('background', 'transparent',
                                'important');
                            container.style.setProperty('box-shadow', 'none', 'important');
                            container.style.setProperty('border-image', 'none',
                                'important');
                            container.style.setProperty('text-decoration', 'none',
                                'important');
                        });

                        // Apply dark mode to modal content if dark mode is active
                        if (document.body.classList.contains('dark-mode')) {
                            const modalContent = prosesModal.querySelector('.modal-content');
                            const modalHeader = prosesModal.querySelector('.modal-header');
                            const modalBody = prosesModal.querySelector('.modal-body');
                            const modalFooter = prosesModal.querySelector('.modal-footer');

                            if (modalContent) {
                                modalContent.style.setProperty('background', '#2a2d3f',
                                    'important');
                                modalContent.style.setProperty('color', '#e2e8f0', 'important');
                                modalContent.style.setProperty('border-color', '#3a3d4a',
                                    'important');
                            }

                            if (modalHeader) {
                                modalHeader.style.setProperty('background', '#2a2d3f', 'important');
                                modalHeader.style.setProperty('border-color', '#3a3d4a',
                                    'important');
                            }

                            if (modalBody) {
                                modalBody.style.setProperty('background', '#2a2d3f', 'important');
                                modalBody.style.setProperty('color', '#e2e8f0', 'important');
                            }

                            if (modalFooter) {
                                modalFooter.style.setProperty('background', '#2a2d3f', 'important');
                                modalFooter.style.setProperty('border-color', '#3a3d4a',
                                    'important');
                            }
                        }
                    }, 200);
                });
            }

            if (previewModal) {
                previewModal.addEventListener('shown.bs.modal', function() {
                    console.log('Preview modal opened, applying special cleanup...');
                    setTimeout(() => {
                        // Force clean all form elements in preview modal
                        const previewSelects = previewModal.querySelectorAll(
                            'select, .form-select');
                        previewSelects.forEach(select => {
                            // Check if dark mode is active
                            if (document.body.classList.contains('dark-mode')) {
                                select.style.cssText = `
                                    background: #374151 !important;
                                    border: 1px solid #4a5568 !important;
                                    border-radius: 8px !important;
                                    color: #e2e8f0 !important;
                                    padding: 8px 12px !important;
                                    font-size: 14px !important;
                                    line-height: 1.5 !important;
                                    outline: none !important;
                                    box-shadow: none !important;
                                    appearance: none !important;
                                    -webkit-appearance: none !important;
                                    -moz-appearance: none !important;
                                    background-image: none !important;
                                    border-image: none !important;
                                    text-decoration: none !important;
                                    width: 100% !important;
                                    font-family: inherit !important;
                                    cursor: pointer !important;
                                `;
                            } else {
                                select.style.cssText = `
                                    background: #ffffff !important;
                                    border: 1px solid #d1d3e2 !important;
                                    border-radius: 8px !important;
                                    color: #374151 !important;
                                    padding: 8px 12px !important;
                                    font-size: 14px !important;
                                    line-height: 1.5 !important;
                                    outline: none !important;
                                    box-shadow: none !important;
                                    appearance: none !important;
                                    -webkit-appearance: none !important;
                                    -moz-appearance: none !important;
                                    background-image: none !important;
                                    border-image: none !important;
                                    text-decoration: none !important;
                                    width: 100% !important;
                                    font-family: inherit !important;
                                    cursor: pointer !important;
                                `;
                            }
                        });

                        // Apply dark mode to modal content if dark mode is active
                        if (document.body.classList.contains('dark-mode')) {
                            const modalContent = previewModal.querySelector('.modal-content');
                            const modalHeader = previewModal.querySelector('.modal-header');
                            const modalBody = previewModal.querySelector('.modal-body');

                            if (modalContent) {
                                modalContent.style.setProperty('background', '#2a2d3f',
                                    'important');
                                modalContent.style.setProperty('color', '#e2e8f0', 'important');
                                modalContent.style.setProperty('border-color', '#3a3d4a',
                                    'important');
                            }

                            if (modalHeader) {
                                modalHeader.style.setProperty('background', '#2a2d3f', 'important');
                                modalHeader.style.setProperty('border-color', '#3a3d4a',
                                    'important');
                            }

                            if (modalBody) {
                                modalBody.style.setProperty('background', '#2a2d3f', 'important');
                                modalBody.style.setProperty('color', '#e2e8f0', 'important');
                            }
                        }
                    }, 200);
                });
            }
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

                // Prevent dropdown overflow - force position within bounds
                document.addEventListener('shown.bs.dropdown', function(e) {
                    const dropdown = e.target.querySelector('.dropdown-menu');
                    if (dropdown) {
                        const rect = dropdown.getBoundingClientRect();
                        const tableRect = document.querySelector('#penggajian-table-wrapper')
                            .getBoundingClientRect();

                        // Force dropdown to stay within table bounds
                        if (rect.right > tableRect.right) {
                            dropdown.style.right = '5px';
                            dropdown.style.left = 'auto';
                            dropdown.style.transform = 'none';
                        }

                        // Ensure it doesn't go below table
                        if (rect.bottom > tableRect.bottom) {
                            dropdown.style.top = 'auto';
                            dropdown.style.bottom = '100%';
                        }

                        // Force maximum width
                        dropdown.style.maxWidth = '150px';
                        dropdown.style.width = '150px';
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
