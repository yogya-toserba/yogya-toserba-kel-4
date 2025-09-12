@extends('layouts.navbar_admin')

@section('title', 'Kelola Absensi Karyawan')

@push('styles')
    <style>
        /* CSS VARIABLES FOR DYNAMIC THEMING */
        :root {
            --table-bg: #ffffff;
            --table-text: #1e293b;
            --table-header-bg: #f8fafc;
            --table-border: #e2e8f0;
        }

        body.dark-mode {
            --table-bg: #ffffff !important;
            --table-text: #1e293b !important;
            --table-header-bg: #f8fafc !important;
            --table-border: #e2e8f0 !important;
        }

        /* ULTIMATE DARK MODE OVERRIDE - HIGHEST PRIORITY */
        body.dark-mode * {
            border-color: #3a3d4a !important;
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
            color: #94a3b8 !important;
        }

        body.dark-mode .table tbody tr:hover {
            background: var(--table-header-bg) !important;
        }

        /* FORCE WHITE TABLE - OVERRIDE ALL DARK MODE */
        .table,
        .table *,
        .table-responsive,
        .table thead,
        .table tbody,
        .table tr,
        .table th,
        .table td {
            background: #ffffff !important;
            background-color: #ffffff !important;
            color: #1e293b !important;
            border-color: #e2e8f0 !important;
            border: none !important;
            border-top: none !important;
            border-bottom: none !important;
            border-left: none !important;
            border-right: none !important;
            outline: none !important;
            box-shadow: none !important;
        }

        .table thead th {
            background: #f8fafc !important;
            background-color: #f8fafc !important;
        }

        .table tbody tr:hover {
            background: #f1f5f9 !important;
            background-color: #f1f5f9 !important;
        }

        /* MODERN TABLE STYLING - ENHANCED DESIGN */
        .table {
            border-collapse: separate !important;
            border-spacing: 0 12px !important;
            background: transparent !important;
            margin-bottom: 0 !important;
        }

        .table thead th {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%) !important;
            color: #ffffff !important;
            border: none !important;
            padding: 18px 20px !important;
            font-weight: 600 !important;
            font-size: 0.875rem !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
            text-align: center !important;
            position: relative !important;
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.2) !important;
        }

        .table thead th:first-child {
            border-radius: 12px 0 0 12px !important;
        }

        .table thead th:last-child {
            border-radius: 0 12px 12px 0 !important;
        }

        .table tbody tr {
            background: #ffffff !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08) !important;
            border-radius: 12px !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            margin-bottom: 8px !important;
        }

        .table tbody tr:hover {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%) !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12) !important;
        }

        .table tbody td {
            background: transparent !important;
            border: none !important;
            padding: 18px 20px !important;
            color: #374151 !important;
            font-weight: 500 !important;
            text-align: center !important;
            vertical-align: middle !important;
            position: relative !important;
        }

        .table tbody td:first-child {
            border-radius: 12px 0 0 12px !important;
        }

        .table tbody td:last-child {
            border-radius: 0 12px 12px 0 !important;
        }

        /* MODERN BADGES */
        .badge {
            padding: 8px 16px !important;
            border-radius: 20px !important;
            font-weight: 600 !important;
            font-size: 0.75rem !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
            border: 2px solid transparent !important;
            transition: all 0.3s ease !important;
        }

        .badge-success {
            background: linear-gradient(135deg, #10b981, #059669) !important;
            color: #ffffff !important;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3) !important;
        }

        .badge-warning {
            background: linear-gradient(135deg, #f59e0b, #d97706) !important;
            color: #ffffff !important;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3) !important;
        }

        .badge-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626) !important;
            color: #ffffff !important;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3) !important;
        }

        .badge-info {
            background: linear-gradient(135deg, #3b82f6, #2563eb) !important;
            color: #ffffff !important;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3) !important;
        }

        /* TABLE CONTAINER */
        .table-responsive {
            background: transparent !important;
            border-radius: 15px !important;
            padding: 15px !important;
            overflow: visible !important;
        }

        /* PROFILE AVATAR MODERN */
        .avatar-modern {
            width: 45px !important;
            height: 45px !important;
            border-radius: 12px !important;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            color: #ffffff !important;
            font-weight: 700 !important;
            font-size: 0.9rem !important;
            margin: 0 auto !important;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3) !important;
        }

        /* OVERRIDE BOOTSTRAP TABLE BORDERS */
        .table-bordered,
        .table-bordered th,
        .table-bordered td {
            border: none !important;
        }

        /* ACTION BUTTONS MODERN */
        .btn-sm {
            padding: 8px 15px !important;
            border-radius: 8px !important;
            font-weight: 600 !important;
            font-size: 0.75rem !important;
            transition: all 0.3s ease !important;
            border: none !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6, #2563eb) !important;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3) !important;
        }

        .btn-primary:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4) !important;
        }

        .btn-warning {
            background: linear-gradient(135deg, #f59e0b, #d97706) !important;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3) !important;
        }

        .btn-warning:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4) !important;
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626) !important;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3) !important;
        }

        .btn-danger:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4) !important;
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

        /* NUCLEAR OPTION - FORCE DARK MODE WITH MAXIMUM SPECIFICITY */
        body.dark-mode #absensi-table-wrapper,
        body.dark-mode #absensi-table,
        body.dark-mode #absensi-table thead,
        body.dark-mode #absensi-table tbody,
        body.dark-mode #absensi-table tr,
        body.dark-mode #absensi-table td,
        body.dark-mode #absensi-table th {
            background: #2a2d3f !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode #absensi-table thead th {
            background: #3a3d4a !important;
            color: #94a3b8 !important;
        }

        body.dark-mode #absensi-table tbody tr:hover {
            background: #3a3d4a !important;
        }

        /* Force all text elements inside table cells to be light colored in dark mode */
        body.dark-mode #absensi-table td small,
        body.dark-mode #absensi-table td div,
        body.dark-mode #absensi-table td strong,
        body.dark-mode #absensi-table td span:not(.badge) {
            color: #e2e8f0 !important;
        }

        /* Ensure muted text is properly colored */
        body.dark-mode #absensi-table .text-muted {
            color: #94a3b8 !important;
        }

        /* PAGINATION STYLING - CONSISTENT WITH PENGGAJIAN */
        .pagination-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            backdrop-filter: blur(10px);
        }

        body.dark-mode .pagination-container {
            background: rgba(42, 45, 63, 0.95);
            border-color: #3a3d4a;
            color: #e2e8f0;
        }

        .dataTables_info {
            color: #64748b;
            font-size: 0.875rem;
            font-weight: 500;
            margin: 0;
        }

        body.dark-mode .dataTables_info {
            color: #94a3b8;
        }

        /* Laravel Pagination Styles */
        .pagination {
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 4px;
        }

        .pagination .page-item {
            margin: 0;
        }

        .pagination .page-link {
            background: white;
            border: 1px solid #e2e8f0;
            color: #64748b;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
        }

        .pagination .page-link:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            color: #475569;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            border-color: #4f46e5;
            color: white;
            font-weight: 600;
        }

        .pagination .page-item.disabled .page-link {
            background: #f8fafc;
            border-color: #e2e8f0;
            color: #cbd5e1;
            cursor: not-allowed;
        }

        .pagination .page-item.disabled .page-link:hover {
            background: #f8fafc;
            border-color: #e2e8f0;
            color: #cbd5e1;
            transform: none;
            box-shadow: none;
        }

        /* Dark mode pagination */
        body.dark-mode .pagination .page-link {
            background: #3a3d4a;
            border-color: #4a4d5a;
            color: #e2e8f0;
        }

        body.dark-mode .pagination .page-link:hover {
            background: #4a4d5a;
            border-color: #5a5d6a;
            color: #f1f5f9;
        }

        body.dark-mode .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            border-color: #4f46e5;
            color: white;
        }

        body.dark-mode .pagination .page-item.disabled .page-link {
            background: #2a2d3f;
            border-color: #3a3d4a;
            color: #64748b;
        }

        /* Responsive pagination */
        @media (max-width: 768px) {
            .pagination-container {
                flex-direction: column;
                gap: 12px;
                text-align: center;
            }

            .pagination .page-link {
                padding: 6px 10px;
                font-size: 0.8rem;
                min-width: 32px;
                height: 32px;
            }
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
        body.dark-mode #absensi-table,
        body.dark-mode #absensi-table-wrapper {
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
            color: rgba(255, 255, 255, 0.9) !important;
            margin: 8px 0 0 0 !important;
            font-size: 1.1rem !important;
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
    </style>

    <div class="new-penggajian-dashboard">
        <!-- Header Section -->
        <div class="new-header">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h1><i class="fas fa-clock me-3"></i>Kelola Absensi Karyawan</h1>
                    <p>Pantau dan kelola data absensi karyawan MyYOGYA secara real-time</p>
                </div>
                <div style="text-align: right;">
                    <div id="realTimeClock" style="font-weight: 600; color: white; font-size: 1rem; margin-top: 10px;"></div>
                    <div><small id="currentDate" style="opacity: 0.8;"></small></div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards Row -->
        <div class="row g-4 mb-5">
            <div class="col-lg-3 col-md-6">
                <div class="new-stat-card">
                    <div class="new-stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="new-stat-number">{{ $stats['total_hadir'] ?? 0 }}</div>
                    <div class="new-stat-label">Total Hadir</div>
                    <div class="new-stat-change change-positive">
                        <i class="fas fa-arrow-up"></i> Aktif
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="new-stat-card">
                    <div class="new-stat-icon">
                        <i class="fas fa-user-times"></i>
                    </div>
                    <div class="new-stat-number">{{ $stats['total_alfa'] ?? 0 }}</div>
                    <div class="new-stat-label">Total Alfa</div>
                    <div class="new-stat-change change-warning">
                        <i class="fas fa-exclamation-triangle"></i> Warning
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="new-stat-card">
                    <div class="new-stat-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="new-stat-number">{{ $stats['total_izin'] ?? 0 }}</div>
                    <div class="new-stat-label">Total Izin</div>
                    <div class="new-stat-change change-neutral">
                        <i class="fas fa-info-circle"></i> Approved
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="new-stat-card">
                    <div class="new-stat-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="new-stat-number">{{ $stats['total_sakit'] ?? 0 }}</div>
                    <div class="new-stat-label">Total Sakit</div>
                    <div class="new-stat-change change-neutral">
                        <i class="fas fa-clock"></i> Care
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
                            Filter Data Absensi
                        </div>
                    </div>
                    <div class="new-card-body">
                        <form method="GET" action="{{ route('admin.absensi.index') }}" class="row g-3">
                            <div class="col-md-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal"
                                    value="{{ request('tanggal') }}">
                            </div>
                            <div class="col-md-2">
                                <label for="bulan" class="form-label">Bulan</label>
                                <select class="form-control" id="bulan" name="bulan">
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}"
                                            {{ request('bulan', now()->month) == $i ? 'selected' : '' }}>
                                            {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="tahun" class="form-label">Tahun</label>
                                <select class="form-control" id="tahun" name="tahun">
                                    @for ($year = 2020; $year <= now()->year + 1; $year++)
                                        <option value="{{ $year }}"
                                            {{ request('tahun', now()->year) == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="karyawan_id" class="form-label">Karyawan</label>
                                <select class="form-control" id="karyawan_id" name="karyawan_id">
                                    <option value="">Semua Karyawan</option>
                                    @foreach ($karyawanList as $karyawan)
                                        <option value="{{ $karyawan->id_karyawan }}"
                                            {{ request('karyawan_id') == $karyawan->id_karyawan ? 'selected' : '' }}>
                                            {{ $karyawan->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">&nbsp;</label>
                                <div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search"></i> Filter
                                    </button>
                                    <a href="{{ route('admin.absensi.index') }}" class="btn btn-secondary ms-2">
                                        <i class="fas fa-refresh"></i> Reset
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="row g-4 mb-5">
            <div class="col-12">
                <div class="new-card">
                    <div class="new-card-header">
                        <div class="new-card-title">
                            <i class="fas fa-table"></i>
                            Data Absensi Karyawan
                        </div>
                    </div>
                    <div class="new-card-body">
                        <div class="table-responsive" id="absensi-table-wrapper">
                            <table class="table table-modern" id="absensi-table" width="100%" cellspacing="0">
                                <thead style="background: #3a3d4a !important;">
                                    <tr>
                                        <th style="width: 5%; background: #3a3d4a !important; color: #94a3b8 !important;">#
                                        </th>
                                        <th style="width: 20%; background: #3a3d4a !important; color: #94a3b8 !important;">
                                            Nama Karyawan</th>
                                        <th style="width: 12%; background: #3a3d4a !important; color: #94a3b8 !important;">
                                            Tanggal</th>
                                        <th style="width: 12%; background: #3a3d4a !important; color: #94a3b8 !important;">
                                            Masuk</th>
                                        <th style="width: 12%; background: #3a3d4a !important; color: #94a3b8 !important;">
                                            Keluar</th>
                                        <th style="width: 12%; background: #3a3d4a !important; color: #94a3b8 !important;">
                                            Status</th>
                                        <th style="width: 12%; background: #3a3d4a !important; color: #94a3b8 !important;">
                                            Shift</th>
                                        <th style="width: 15%; background: #3a3d4a !important; color: #94a3b8 !important;">
                                            Keterangan</th>
                                        <th style="width: 10%; background: #3a3d4a !important; color: #94a3b8 !important;">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody style="background: #2a2d3f !important;">
                                    @forelse($absensi as $index => $item)
                                        <tr style="background: #2a2d3f !important; color: #e2e8f0 !important;">
                                            <td style="background: transparent !important; color: #e2e8f0 !important;">
                                                {{ $absensi->firstItem() + $index }}</td>
                                            <td style="background: transparent !important; color: #e2e8f0 !important;">
                                                {{ $item->karyawan->nama ?? 'N/A' }}</td>
                                            <td style="background: transparent !important; color: #e2e8f0 !important;">
                                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                                            <td style="background: transparent !important; color: #e2e8f0 !important;">
                                                @if ($item->jam_masuk)
                                                    <span
                                                        class="badge bg-success">{{ \Carbon\Carbon::parse($item->jam_masuk)->format('H:i') }}</span>
                                                @else
                                                    <span style="color: #94a3b8 !important;">-</span>
                                                @endif
                                            </td>
                                            <td style="background: transparent !important; color: #e2e8f0 !important;">
                                                @if ($item->jam_keluar)
                                                    <span
                                                        class="badge bg-info">{{ \Carbon\Carbon::parse($item->jam_keluar)->format('H:i') }}</span>
                                                @else
                                                    <span style="color: #94a3b8 !important;">-</span>
                                                @endif
                                            </td>
                                            <td style="background: transparent !important; color: #e2e8f0 !important;">
                                                @php
                                                    $status = strtolower($item->status);
                                                @endphp

                                                @if (in_array($status, ['hadir', 'present']))
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check-circle me-1"></i>Hadir
                                                    </span>
                                                @elseif (in_array($status, ['alfa', 'alpa', 'absent']))
                                                    <span class="badge bg-danger">
                                                        <i class="fas fa-times-circle me-1"></i>Alfa
                                                    </span>
                                                @elseif (in_array($status, ['izin', 'permission']))
                                                    <span class="badge bg-warning text-dark">
                                                        <i class="fas fa-clock me-1"></i>Izin
                                                    </span>
                                                @elseif (in_array($status, ['sakit', 'sick']))
                                                    <span class="badge bg-info">
                                                        <i class="fas fa-heart me-1"></i>Sakit
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary">
                                                        <i class="fas fa-question-circle me-1"></i>{{ $item->status }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td style="background: transparent !important; color: #e2e8f0 !important;">
                                                @if ($item->jadwalKerja && $item->jadwalKerja->shift)
                                                    <span
                                                        class="badge bg-info">{{ $item->jadwalKerja->shift->nama_shift }}</span>
                                                @else
                                                    <span class="badge bg-secondary">N/A</span>
                                                @endif
                                            </td>
                                            <td style="background: transparent !important; color: #e2e8f0 !important;">
                                                <small
                                                    style="color: #94a3b8 !important;">{{ $item->keterangan ?? '-' }}</small>
                                            </td>
                                            <td class="text-center"
                                                style="background: transparent !important; color: #e2e8f0 !important;">
                                                <div class="dropdown">
                                                    <button class="gear-dropdown" type="button"
                                                        id="dropdownMenuButton{{ $item->id_absensi ?? 0 }}"
                                                        data-bs-toggle="dropdown" aria-expanded="false" title="Aksi">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end"
                                                        aria-labelledby="dropdownMenuButton{{ $item->id_absensi ?? 0 }}">
                                                        <li>
                                                            <a class="dropdown-item" href="#"
                                                                onclick="console.log('Dropdown click - view detail', {{ $item->id_absensi ?? 0 }}); viewDetail({{ $item->id_absensi ?? 0 }}); return false;">
                                                                <i class="fas fa-eye text-info me-2"></i>Lihat Detail
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="#"
                                                                onclick="console.log('Dropdown click - edit absensi', {{ $item->id_absensi ?? 0 }}); editAbsensi({{ $item->id_absensi ?? 0 }}); return false;">
                                                                <i class="fas fa-edit text-success me-2"></i>Edit Absensi
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr style="background: #2a2d3f !important; color: #e2e8f0 !important;">
                                            <td colspan="9" class="text-center py-4"
                                                style="background: transparent !important; color: #e2e8f0 !important;">
                                                <i class="fas fa-calendar-times fa-2x text-muted mb-3"
                                                    style="color: #94a3b8 !important;"></i>
                                                <h6 style="color: #e2e8f0 !important;">Tidak ada data absensi</h6>
                                                <p class="mb-0" style="color: #94a3b8 !important;">Belum ada data
                                                    absensi yang tersedia untuk periode yang dipilih</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination Section -->
                        <div class="pagination-container d-flex justify-content-between align-items-center mt-4">
                            <div class="dataTables_info">
                                Menampilkan {{ $absensi->firstItem() ?? 0 }} sampai {{ $absensi->lastItem() ?? 0 }} dari
                                {{ $absensi->total() }} data
                            </div>
                            <div class="d-flex align-items-center">
                                {{ $absensi->appends(request()->query())->links('pagination.custom') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- View Detail Modal -->
    <div class="modal fade" id="viewDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Absensi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="modalDetailContent">
                    <!-- Content will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Absensi Modal -->
    <div class="modal fade" id="editAbsensiModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Absensi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="modalEditContent">
                    <!-- Content will be loaded here -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Setup event delegation for absensi actions
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Absensi page loaded, setting up event handlers...');

            // Real-time clock functionality to match penggajian page
            function updateClock() {
                const now = new Date();
                const timeString = now.toLocaleTimeString('id-ID', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });
                const dateString = now.toLocaleDateString('id-ID', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });

                const clockElement = document.getElementById('realTimeClock');
                const dateElement = document.getElementById('currentDate');

                if (clockElement) clockElement.textContent = timeString;
                if (dateElement) dateElement.textContent = dateString;
            }

            // Update clock immediately and then every second
            updateClock();
            setInterval(updateClock, 1000);

            // Force dark mode table styling like penggajian
            function forceDarkModeTable() {
                if (document.body.classList.contains('dark-mode')) {
                    console.log('Applying dark mode table styling...');

                    const table = document.querySelector('#absensi-table');
                    const wrapper = document.querySelector('#absensi-table-wrapper');

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
                            } else if (el.tagName === 'TBODY' || el.tagName === 'TR' || el.tagName ===
                                'TD') {
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
                        table.querySelectorAll('td small, td div, td strong, td span:not(.badge)').forEach(el => {
                            el.style.color = '#e2e8f0';
                        });

                        // Force muted text
                        table.querySelectorAll('.text-muted').forEach(el => {
                            el.style.color = '#94a3b8';
                        });

                        console.log('Dark mode table styling applied');
                    }
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

            // Event delegation for action buttons
            document.addEventListener('click', function(e) {
                const target = e.target.closest('[data-action]');
                if (!target) return;

                e.preventDefault();
                e.stopPropagation();

                const action = target.getAttribute('data-action');
                const id = target.getAttribute('data-id');

                console.log(`Absensi action clicked: ${action}, ID: ${id}`);

                switch (action) {
                    case 'view-detail':
                        viewDetail(id);
                        break;
                    case 'edit-absensi':
                        editAbsensi(id);
                        break;
                    default:
                        console.warn('Unknown action:', action);
                }
            });
        });

        function viewDetail(id) {
            console.log('viewDetail function called with ID:', id);

            if (!id) {
                alert('ID absensi tidak valid');
                return;
            }

            const modalElement = document.getElementById('viewDetailModal');
            if (!modalElement) {
                alert('Modal detail tidak ditemukan');
                return;
            }

            try {
                const modal = new bootstrap.Modal(modalElement);
                const content = document.getElementById('modalDetailContent');

                // Show loading
                content.innerHTML = `
                    <div class="text-center py-4">
                        <i class="fas fa-spinner fa-spin fa-2x text-primary mb-3"></i>
                        <h5 class="text-muted">Memuat detail absensi...</h5>
                    </div>
                `;

                modal.show();

                // Fetch detail data via API
                fetch(`/admin/absensi/api/${id}/detail`, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => {
                        console.log('Detail API response status:', response.status);
                        if (!response.ok) {
                            throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Detail API response:', data);
                        if (data.success) {
                            content.innerHTML = data.html;
                        } else {
                            content.innerHTML = '<div class="alert alert-danger">Gagal memuat detail: ' + (data
                                .message || 'Unknown error') + '</div>';
                        }
                    })
                    .catch(error => {
                        console.error('Detail fetch error:', error);
                        content.innerHTML = '<div class="alert alert-danger">Terjadi kesalahan: ' + error.message +
                            '</div>';
                    });

            } catch (error) {
                console.error('Modal error:', error);
                alert('Gagal membuka modal: ' + error.message);
            }
        }

        function editAbsensi(id) {
            console.log('editAbsensi function called with ID:', id);

            if (!id) {
                alert('ID absensi tidak valid');
                return;
            }

            const modalElement = document.getElementById('editAbsensiModal');
            if (!modalElement) {
                alert('Modal edit tidak ditemukan');
                return;
            }

            try {
                const modal = new bootstrap.Modal(modalElement);
                const content = document.getElementById('modalEditContent');

                // Show loading
                content.innerHTML = `
                    <div class="text-center py-4">
                        <i class="fas fa-spinner fa-spin fa-2x text-primary mb-3"></i>
                        <h5 class="text-muted">Memuat form edit...</h5>
                    </div>
                `;

                modal.show();

                // Fetch edit form via API
                fetch(`/admin/absensi/api/${id}/edit`, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => {
                        console.log('Edit API response status:', response.status);
                        if (!response.ok) {
                            throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Edit API response:', data);
                        if (data.success) {
                            content.innerHTML = data.html;

                            // Setup form submission
                            const form = content.querySelector('#editAbsensiForm');
                            if (form) {
                                form.addEventListener('submit', function(e) {
                                    e.preventDefault();
                                    submitEditForm(id, new FormData(form));
                                });
                            }
                        } else {
                            content.innerHTML = '<div class="alert alert-danger">Gagal memuat form: ' + (data.message ||
                                'Unknown error') + '</div>';
                        }
                    })
                    .catch(error => {
                        console.error('Edit fetch error:', error);
                        content.innerHTML = '<div class="alert alert-danger">Terjadi kesalahan: ' + error.message +
                            '</div>';
                    });

            } catch (error) {
                console.error('Modal error:', error);
                alert('Gagal membuka modal: ' + error.message);
            }
        }

        function submitEditForm(id, formData) {
            console.log('Submitting edit form for ID:', id);

            fetch(`/admin/absensi/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(response => {
                    console.log('Update response status:', response.status);
                    return response.json();
                })
                .then(data => {
                    console.log('Update response:', data);
                    if (data.success) {
                        alert('Data absensi berhasil diperbarui');
                        bootstrap.Modal.getInstance(document.getElementById('editAbsensiModal')).hide();
                        location.reload();
                    } else {
                        alert('Gagal memperbarui data: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Update error:', error);
                    alert('Terjadi kesalahan: ' + error.message);
                });
        }

        // Make functions globally available
        window.viewDetail = viewDetail;
        window.editAbsensi = editAbsensi;
    </script>
@endpush
