@extends('layouts.navbar_admin')

@section('title', 'Data Karyawan - MyYOGYA Admin')

@php
    use Illuminate\Support\Facades\Storage;
@endphp

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
        }

        #realTimeClock:hover {
            background: rgba(255, 255, 255, 0.3) !important;
            transform: scale(1.05) !important;
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
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
            border: 1px solid #e2e8f0 !important;
            overflow: hidden !important;
            transition: all 0.3s ease !important;
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

        /* Table Styling */
        .table-responsive {
            border-radius: 8px !important;
            background: white !important;
            overflow-x: hidden !important;
            overflow-y: visible !important;
            max-width: 100% !important;
            width: 100% !important;
        }

        /* CRITICAL: Prevent pagination scrolling */
        .table-responsive .pagination-container {
            overflow-x: visible !important;
            overflow-y: visible !important;
        }

        .table-responsive .pagination-wrapper {
            overflow: visible !important;
        }

        /* Ensure table fits in container */
        .table-responsive .table {
            table-layout: fixed !important;
            width: 100% !important;
            margin-bottom: 0 !important;
        }

        .table-responsive .table-fixed {
            table-layout: fixed !important;
            width: 100% !important;
        }

        .table-responsive .table td,
        .table-responsive .table th {
            word-wrap: break-word !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            padding: 8px 6px !important;
            vertical-align: middle !important;
        }

        /* Better table borders */
        .table-responsive .table tbody tr {
            border-bottom: 1px solid #f1f5f9 !important;
        }

        .table-responsive .table tbody tr:hover {
            background-color: #f8fafc !important;
        }

        /* Column specific styling */
        .table-responsive .table td:first-child,
        .table-responsive .table th:first-child {
            text-align: center !important;
            padding-left: 8px !important;
        }

        .table-responsive .table td:last-child,
        .table-responsive .table th:last-child {
            text-align: center !important;
            padding-right: 8px !important;
        }

        /* Responsive table behavior */
        @media (max-width: 992px) {

            .table-responsive .table th,
            .table-responsive .table td {
                font-size: 0.75rem !important;
                padding: 6px 4px !important;
            }

            .table-responsive .table img {
                width: 30px !important;
                height: 30px !important;
            }

            .badge-department,
            .badge-active,
            .badge-inactive {
                font-size: 0.65rem !important;
                padding: 2px 6px !important;
            }
        }

        @media (max-width: 768px) {

            .table-responsive .table th:nth-child(4),
            .table-responsive .table td:nth-child(4) {
                display: none !important;
            }
        }

        /* CRITICAL: Force dropdown to show */
        .table-responsive .action-dropdown {
            position: relative !important;
            z-index: 9999 !important;
        }

        .table-responsive .action-dropdown-menu {
            z-index: 10000 !important;
            position: absolute !important;
            display: block !important;
        }

        /* Table Borders */
        .table td {
            border-bottom: 1px solid #e2e8f0 !important;
            vertical-align: middle !important;
        }

        .table th {
            border-bottom: 2px solid #e2e8f0 !important;
            font-weight: 600 !important;
        }

        .table tr:last-child td {
            border-bottom: none !important;
        }

        .table tbody tr:hover {
            background-color: #f8fafc !important;
            transition: background-color 0.2s ease !important;
        }

        body.dark-mode .table-responsive {
            background: #2a2d3f !important;
        }

        body.dark-mode .table td {
            border-bottom: 1px solid #374151 !important;
        }

        body.dark-mode .table th {
            border-bottom: 2px solid #374151 !important;
        }

        body.dark-mode .table tbody tr:hover {
            background-color: #374151 !important;
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
            border-radius: 10px !important;
            transition: all 0.3s ease !important;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #e55827, #d44a1a) !important;
            transform: translateY(-1px) !important;
        }

        .btn-outline-primary {
            border: 1px solid #f26b37 !important;
            color: #f26b37 !important;
            background: transparent !important;
            font-weight: 500 !important;
            padding: 8px 14px !important;
            border-radius: 10px !important;
            transition: all 0.3s ease !important;
        }

        .btn-outline-primary:hover {
            background: #f26b37 !important;
            color: white !important;
            transform: translateY(-1px) !important;
        }

        .btn-outline-secondary {
            border: 1px solid #6c757d !important;
            color: #6c757d !important;
            background: transparent !important;
            font-weight: 500 !important;
            padding: 8px 14px !important;
            border-radius: 10px !important;
            transition: all 0.3s ease !important;
        }

        .btn-outline-secondary:hover {
            background: #6c757d !important;
            color: white !important;
            transform: translateY(-1px) !important;
            border-color: #6c757d !important;
        }

        body.dark-mode .btn-outline-secondary {
            border-color: #9ca3af !important;
            color: #9ca3af !important;
        }

        body.dark-mode .btn-outline-secondary:hover {
            background: #9ca3af !important;
            color: #1a1d29 !important;
            border-color: #9ca3af !important;
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
            padding: 4px 8px !important;
            border-radius: 12px !important;
            font-size: 0.7rem !important;
            display: inline-block !important;
            white-space: nowrap !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            max-width: 100% !important;
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

        .form-control:hover {
            border-color: #cbd5e1 !important;
            transform: none !important;
        }

        .form-control:focus {
            border-color: #f26b37 !important;
            box-shadow: 0 0 0 3px rgba(242, 107, 55, 0.1) !important;
            background: white !important;
            transform: none !important;
        }

        body.dark-mode .form-control {
            background: #374151 !important;
            border-color: #4b5563 !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode .form-control:hover {
            border-color: #6b7280 !important;
            background: #374151 !important;
        }

        body.dark-mode .form-control:focus {
            background: #374151 !important;
            border-color: #f26b37 !important;
            color: #e2e8f0 !important;
            box-shadow: 0 0 0 3px rgba(242, 107, 55, 0.2) !important;
        }

        body.dark-mode .form-control::placeholder {
            color: #9ca3af !important;
        }

        .form-select {
            border: 1px solid #e2e8f0 !important;
            border-radius: 10px !important;
            padding: 8px 12px !important;
            background: white !important;
            color: #1e293b !important;
            font-size: 0.9rem !important;
            transition: all 0.3s ease !important;
        }

        .form-select:focus {
            border-color: #f26b37 !important;
            box-shadow: 0 0 0 3px rgba(242, 107, 55, 0.1) !important;
            background: white !important;
        }

        body.dark-mode .form-select {
            background: #374151 !important;
            border-color: #4b5563 !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode .form-select:focus {
            background: #374151 !important;
            border-color: #f26b37 !important;
            color: #e2e8f0 !important;
            box-shadow: 0 0 0 3px rgba(242, 107, 55, 0.2) !important;
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

        /* Dropdown Action Button - Specific for table */
        .table-responsive .action-dropdown {
            position: relative;
            display: inline-block;
            z-index: 100 !important;
        }

        .table-responsive .action-dropdown-btn {
            background: transparent !important;
            border: none !important;
            border-radius: 50% !important;
            padding: 8px !important;
            color: #64748b !important;
            font-size: 16px !important;
            cursor: pointer !important;
            transition: all 0.3s ease !important;
            position: relative !important;
            z-index: 101 !important;
            width: 32px !important;
            height: 32px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            pointer-events: auto !important;
        }

        .table-responsive .action-dropdown-btn:hover {
            background: rgba(99, 102, 241, 0.1) !important;
            color: #6366f1 !important;
            transform: scale(1.1) !important;
        }

        .table-responsive .action-dropdown-btn:focus {
            outline: none !important;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2) !important;
        }

        body.dark-mode .table-responsive .action-dropdown-btn {
            color: #9ca3af !important;
        }

        body.dark-mode .table-responsive .action-dropdown-btn:hover {
            background: rgba(99, 102, 241, 0.2) !important;
            color: #a5b4fc !important;
        }

        .table-responsive .action-dropdown-menu {
            position: absolute !important;
            top: 100% !important;
            right: 0 !important;
            background: white !important;
            border: none !important;
            border-radius: 12px !important;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04) !important;
            min-width: 160px !important;
            z-index: 9999 !important;
            opacity: 0 !important;
            visibility: hidden !important;
            transform: translateY(-10px) scale(0.95) !important;
            transition: all 0.2s ease-out !important;
            padding: 8px 0 !important;
            margin-top: 4px !important;
            pointer-events: none !important;
        }

        .table-responsive .action-dropdown.show .action-dropdown-menu {
            opacity: 1 !important;
            visibility: visible !important;
            transform: translateY(0) scale(1) !important;
            pointer-events: auto !important;
        }

        body.dark-mode .table-responsive .action-dropdown-menu {
            background: #1f2937 !important;
            border: 1px solid #374151 !important;
        }

        .action-dropdown-item {
            display: flex !important;
            align-items: center !important;
            padding: 12px 16px !important;
            color: #374151 !important;
            text-decoration: none !important;
            font-size: 0.875rem !important;
            font-weight: 500 !important;
            transition: all 0.2s ease !important;
            border: none !important;
            background: none !important;
            width: 100% !important;
            text-align: left !important;
            cursor: pointer !important;
            border-radius: 8px !important;
            margin: 0 4px !important;
            width: calc(100% - 8px) !important;
        }

        .action-dropdown-item i {
            width: 16px !important;
            margin-right: 12px !important;
            font-size: 14px !important;
        }

        .action-dropdown-item:hover {
            background: #f8fafc !important;
            color: #1e293b !important;
            transform: translateX(2px) !important;
        }

        body.dark-mode .action-dropdown-item {
            color: #d1d5db !important;
        }

        body.dark-mode .action-dropdown-item:hover {
            background: #374151 !important;
            color: #f9fafb !important;
        }

        .action-dropdown-item.edit-item:hover {
            background: #dbeafe !important;
            color: #1d4ed8 !important;
        }

        .action-dropdown-item.delete-item:hover {
            background: #fee2e2 !important;
            color: #dc2626 !important;
        }

        .action-dropdown-item.view-item:hover {
            background: #dcfce7 !important;
            color: #16a34a !important;
        }

        .action-dropdown-item.warning-item:hover {
            background: #fef3c7 !important;
            color: #d97706 !important;
        }

        /* Pagination Styles */
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

        /* Limit pagination width */
        .pagination-wrapper {
            max-width: 100%;
            overflow: hidden;
        }

        .pagination-wrapper .pagination {
            max-width: 100%;
            justify-content: center;
        }

        /* Pagination wrapper */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
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

        /* Hide excessive pagination items on smaller screens */
        @media (max-width: 768px) {
            .pagination .page-item:nth-child(n+6):nth-last-child(n+6) {
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

        /* Ensure pagination doesn't scroll horizontally */
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            padding: 15px 0;
            flex-wrap: nowrap;
            gap: 10px;
            overflow: hidden;
            max-width: 100% !important;
        }

        /* CRITICAL: Force pagination to not scroll */
        .new-card-body {
            overflow: visible !important;
        }

        .table-responsive {
            overflow-x: auto;
            overflow-y: visible !important;
        }

        .table-responsive .pagination-container,
        .table-responsive .pagination-wrapper,
        .table-responsive .pagination {
            overflow: visible !important;
            max-width: none !important;
        }

        /* Loading Spinner */
        .spinner-border {
            display: inline-block;
            width: 1rem;
            height: 1rem;
            vertical-align: text-bottom;
            border: 0.125em solid currentColor;
            border-right-color: transparent;
            border-radius: 50%;
            animation: spinner-border 0.75s linear infinite;
        }

        .spinner-border-sm {
            width: 0.875rem;
            height: 0.875rem;
            border-width: 0.125em;
        }

        @keyframes spinner-border {
            to {
                transform: rotate(360deg);
            }
        }

        .text-primary {
            color: #f26b37 !important;
        }

        .visually-hidden {
            position: absolute !important;
            width: 1px !important;
            height: 1px !important;
            padding: 0 !important;
            margin: -1px !important;
            overflow: hidden !important;
            clip: rect(0, 0, 0, 0) !important;
            white-space: nowrap !important;
            border: 0 !important;
        }

        /* Search Input Enhancement */
        .search-input-enhanced {
            position: relative;
        }

        .search-input-enhanced::after {
            content: '';
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            width: 12px;
            height: 12px;
            border: 2px solid #f26b37;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spinner-border 0.75s linear infinite;
            display: none;
        }

        .search-input-enhanced.loading::after {
            display: block;
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
            display: flex;
            flex-direction: column;
        }

        /* Ensure pagination stays at bottom */
        .equal-height-cards .table-responsive .pagination-container {
            margin-top: auto;
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

        /* Modal Dark Mode Styling */
        body.dark-mode .modal-content {
            background: #2a2d3f !important;
            border: 1px solid #3a3d4a !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode .modal-header {
            border-bottom-color: #3a3d4a !important;
        }

        body.dark-mode .modal-footer {
            border-top-color: #3a3d4a !important;
        }

        body.dark-mode .modal-title {
            color: white !important;
        }

        /* Form Dark Mode Styling */
        body.dark-mode .form-label {
            color: #e2e8f0 !important;
            font-weight: 500 !important;
        }

        body.dark-mode .form-label i {
            color: #f26b37 !important;
        }

        body.dark-mode .text-danger {
            color: #ef4444 !important;
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
            box-shadow: 0 0 0 0.2rem rgba(242, 107, 55, 0.25) !important;
        }

        body.dark-mode .form-control::placeholder {
            color: #9ca3af !important;
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

        body.dark-mode .invalid-feedback {
            color: #ef4444 !important;
        }

        body.dark-mode .form-control.is-invalid {
            border-color: #ef4444 !important;
            box-shadow: 0 0 0 0.2rem rgba(239, 68, 68, 0.25) !important;
        }

        /* Preview Section Dark Mode */
        body.dark-mode .preview-section {
            background: #374151 !important;
            border-color: #4b5563 !important;
        }

        body.dark-mode .preview-section h6 {
            color: #f26b37 !important;
        }

        body.dark-mode .preview-item {
            border-bottom-color: #4b5563 !important;
        }

        body.dark-mode .preview-label {
            color: #9ca3af !important;
        }

        body.dark-mode .preview-value {
            color: #e2e8f0 !important;
        }

        /* Tab styling for dark mode */
        body.dark-mode .nav-tabs {
            border-bottom: 2px solid #3a3d4a !important;
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%) !important;
        }

        body.dark-mode .nav-tabs .nav-link {
            color: #9ca3af !important;
            background: transparent !important;
        }

        body.dark-mode .nav-tabs .nav-link:hover {
            background: rgba(242, 107, 55, 0.2) !important;
            color: #f26b37 !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3) !important;
        }

        body.dark-mode .nav-tabs .nav-link.active {
            background: #2a2d3f !important;
            color: #f26b37 !important;
            box-shadow: 0 -1px 4px rgba(0, 0, 0, 0.3) !important;
        }

        body.dark-mode .nav-tabs .nav-link.active::after {
            background: #f26b37 !important;
        }

        body.dark-mode .tab-content {
            border: 2px solid #3a3d4a !important;
            border-top: none !important;
            background: #2a2d3f !important;
        }

        /* Alert dark mode */
        body.dark-mode .alert-info {
            background: #1e293b !important;
            border-color: #334155 !important;
            color: #cbd5e1 !important;
        }

        body.dark-mode .alert-warning {
            background: #451a03 !important;
            border-color: #92400e !important;
            color: #fbbf24 !important;
        }

        /* Ensure tabs work properly */
        .tab-content {
            border: 2px solid #e2e8f0;
            border-top: none;
            background: white;
            height: 450px;
            border-radius: 0 0 8px 8px;
            overflow: hidden;
            display: flex;
            align-items: center;
        }

        .tab-pane {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
        }

        .tab-pane.active {
            display: flex !important;
        }

        .form-container,
        .preview-container {
            width: 100%;
            max-width: 100%;
            height: 100%;
            overflow-y: auto;
            padding-right: 10px;
        }

        .form-container::-webkit-scrollbar,
        .preview-container::-webkit-scrollbar {
            width: 6px;
        }

        .form-container::-webkit-scrollbar-track,
        .preview-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .form-container::-webkit-scrollbar-thumb,
        .preview-container::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }

        .form-container::-webkit-scrollbar-thumb:hover,
        .preview-container::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        /* Dark mode scrollbar */
        body.dark-mode .form-container::-webkit-scrollbar-track,
        body.dark-mode .preview-container::-webkit-scrollbar-track {
            background: #374151;
        }

        body.dark-mode .form-container::-webkit-scrollbar-thumb,
        body.dark-mode .preview-container::-webkit-scrollbar-thumb {
            background: #6b7280;
        }

        body.dark-mode .form-container::-webkit-scrollbar-thumb:hover,
        body.dark-mode .preview-container::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }

        /* Modal content styling */
        .modal-content {
            border-radius: 12px;
            overflow: hidden;
        }

        /* Form label styling */
        .form-label {
            color: #374151 !important;
            font-weight: 500 !important;
            font-size: 0.85rem !important;
            margin-bottom: 5px !important;
        }

        .compact-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 4px;
            font-size: 0.8rem;
        }

        .compact-input {
            padding: 6px 10px !important;
            font-size: 0.85rem !important;
            height: 35px !important;
        }

        textarea.compact-input {
            height: auto !important;
            min-height: 60px !important;
            resize: vertical;
        }

        .compact-alert {
            padding: 8px 12px !important;
            margin-bottom: 0 !important;
            font-size: 0.8rem !important;
        }

        body.dark-mode .form-label {
            color: #e2e8f0 !important;
        }

        body.dark-mode .compact-label {
            color: #e2e8f0 !important;
        }

        /* Alert styling */
        .alert-info {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            border: 2px solid #93c5fd;
            color: #1e40af;
            border-radius: 8px;
        }

        body.dark-mode .alert-info {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%) !important;
            border: 2px solid #3b82f6 !important;
            color: #dbeafe !important;
        }

        .nav-tabs {
            border-bottom: 2px solid #e2e8f0;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            margin: 0;
            padding: 0 25px;
            position: relative;
        }

        .nav-tabs .nav-link {
            border: none !important;
            border-radius: 8px 8px 0 0 !important;
            color: #6c757d;
            padding: 15px 25px;
            font-weight: 600;
            font-size: 0.95rem;
            margin-right: 5px;
            transition: all 0.3s ease;
            background: transparent;
            position: relative;
            z-index: 2;
        }

        .nav-tabs .nav-link:hover {
            border: none !important;
            background: rgba(242, 107, 55, 0.1) !important;
            color: #f26b37 !important;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .nav-tabs .nav-link.active {
            color: #f26b37 !important;
            background: white !important;
            border: none !important;
            font-weight: 700;
            box-shadow: 0 -1px 4px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 3;
        }

        .nav-tabs .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 2px;
            background: #f26b37;
            z-index: 4;
        }

        /* Preview section styling */
        .preview-section {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 20px;
        }

        .preview-item {
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .preview-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .preview-label {
            font-size: 0.875rem;
            color: #6c757d;
            margin-bottom: 2px;
            font-weight: 500;
        }

        .preview-value {
            font-weight: 600;
            color: #2c3e50;
            word-wrap: break-word;
        }

        /* Dark mode preview styling */
        body.dark-mode .preview-section {
            background: #374151 !important;
            border: 1px solid #4b5563 !important;
        }

        body.dark-mode .preview-item {
            border-bottom: 1px solid #4b5563 !important;
        }

        body.dark-mode .preview-label {
            color: #9ca3af !important;
        }

        body.dark-mode .preview-value {
            color: #e2e8f0 !important;
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
                    <div id="realTimeClock" style="font-weight: 600; color: white; font-size: 1rem; margin-bottom: 5px;">
                    </div>
                    <small id="currentDate" style="opacity: 0.8;"></small>
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
                    <div class="new-stat-number">{{ $totalKaryawan ?? 0 }}</div>
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
                    <div class="new-stat-number">{{ $karyawanAktif ?? 0 }}</div>
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
                    <div class="new-stat-number">{{ $totalDepartemen ?? 0 }}</div>
                    <div class="new-stat-label">Departemen</div>
                    <div class="new-stat-change change-neutral">
                        <i class="fas fa-layer-group"></i> Unit
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="new-stat-card">
                    <div class="new-stat-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="new-stat-number">{{ $hadirHariIni ?? 0 }}</div>
                    <div class="new-stat-label">Total Jabatan</div>
                    <div class="new-stat-change change-positive">
                        <i class="fas fa-briefcase"></i> jabatan
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter Bar -->
        <div class="search-filter-bar">
            <div class="row g-3 align-items-center">
                <div class="col-md-4">
                    <label class="form-label">Cari Karyawan</label>
                    <input type="text" class="form-control" placeholder="Masukkan nama karyawan..." id="searchKaryawan">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Departemen</label>
                    <select class="form-control" id="filterDepartment">
                        <option value="">Semua Departemen</option>
                        @foreach ($divisiList ?? [] as $divisi)
                            <option value="{{ $divisi }}">{{ $divisi }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Status</label>
                    <select class="form-control" id="filterStatus">
                        <option value="">Semua Status</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Non-Aktif">Non-Aktif</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">&nbsp;</label>
                    <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#tambahKaryawanModal"
                        style="background: linear-gradient(135deg, #f26b37 0%, #e55827 100%); border: none; padding: 8px;">
                        <i class="fas fa-plus me-2"></i>Tambah
                    </button>
                </div>
                <div class="col-md-1">
                    <label class="form-label">&nbsp;</label>
                    <button class="btn btn-outline-secondary w-100" id="resetFilters" title="Reset Filter">
                        <i class="fas fa-undo"></i>
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
                    </div>
                    <div class="new-card-body">
                        <div class="table-responsive" id="karyawan-table-container">
                            <table class="table table-sm table-fixed">
                                <thead style="background: white;">
                                    <tr>
                                        <th
                                            style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none; width: 5%;">
                                            #</th>
                                        <th
                                            style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none; width: 8%;">
                                            Foto</th>
                                        <th
                                            style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none; width: 25%;">
                                            Nama Karyawan</th>
                                        <th
                                            style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none; width: 15%;">
                                            Jabatan</th>
                                        <th
                                            style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none; width: 15%;">
                                            Departemen</th>
                                        <th
                                            style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none; width: 12%;">
                                            Status</th>
                                        <th
                                            style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none; width: 12%;">
                                            Bergabung</th>
                                        <th
                                            style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none; text-align: center; width: 8%;">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="karyawan-table-body">
                                    @forelse($karyawan ?? [] as $index => $emp)
                                        <tr>
                                            <td style="font-size: 0.85rem; padding: 12px 8px; width: 5%;">
                                                {{ $loop->iteration }}</td>
                                            <td style="font-size: 0.85rem; padding: 12px 8px; width: 8%;">
                                                @if ($emp->foto && Storage::disk('public')->exists($emp->foto))
                                                    <img src="{{ Storage::url($emp->foto) }}"
                                                        alt="Foto {{ $emp->nama }}"
                                                        style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover;">
                                                @else
                                                    <div
                                                        style="width: 35px; height: 35px; border-radius: 50%; background: linear-gradient(135deg, #f26b37 0%, #e55827 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 12px;">
                                                        {{ strtoupper(substr($emp->nama, 0, 2)) }}
                                                    </div>
                                                @endif
                                            </td>
                                            <td style="font-size: 0.85rem; padding: 12px 8px; width: 25%;">
                                                <div style="max-width: 200px;">
                                                    <strong
                                                        style="color: #1e293b; display: block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $emp->nama }}</strong>
                                                    <small
                                                        style="color: #64748b; display: block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $emp->email }}</small>
                                                </div>
                                            </td>
                                            <td style="font-size: 0.85rem; padding: 12px 8px; width: 15%;">
                                                <strong
                                                    style="color: #1e293b; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: block;">{{ $emp->divisi }}</strong>
                                            </td>
                                            <td style="font-size: 0.85rem; padding: 12px 8px; width: 15%;">
                                                <span class="badge-department"
                                                    style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: inline-block; max-width: 100%;">{{ $emp->divisi }}</span>
                                            </td>
                                            <td style="font-size: 0.85rem; padding: 12px 8px; width: 12%;">
                                                @if ($emp->status === 'Aktif')
                                                    <span class="badge-active">{{ $emp->status }}</span>
                                                @else
                                                    <span class="badge-inactive">{{ $emp->status }}</span>
                                                @endif
                                            </td>
                                            <td style="font-size: 0.85rem; padding: 12px 8px; width: 12%;">
                                                <small
                                                    style="color: #64748b; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: block;">{{ $emp->created_at ? $emp->created_at->format('d M Y') : '-' }}</small>
                                            </td>
                                            <td
                                                style="font-size: 0.85rem; padding: 12px 8px; text-align: center; position: relative; width: 8%;">
                                                <div class="action-dropdown">
                                                    <button class="action-dropdown-btn"
                                                        data-employee-id="{{ $emp->id_karyawan }}" type="button"
                                                        onclick="toggleTableDropdown(this, event)">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="action-dropdown-menu">
                                                        <button class="action-dropdown-item view-item"
                                                            onclick="viewEmployee({{ $emp->id_karyawan }})">
                                                            <i class="fas fa-eye"></i>Detail
                                                        </button>
                                                        <button class="action-dropdown-item edit-item"
                                                            onclick="editEmployee({{ $emp->id_karyawan }})">
                                                            <i class="fas fa-edit"></i>Edit
                                                        </button>
                                                        @if ($emp->status === 'Aktif')
                                                            <button class="action-dropdown-item warning-item"
                                                                onclick="toggleStatus({{ $emp->id_karyawan }}, 'Non-Aktif')">
                                                                <i class="fas fa-user-slash"></i>Non-Aktifkan
                                                            </button>
                                                        @else
                                                            <button class="action-dropdown-item view-item"
                                                                onclick="toggleStatus({{ $emp->id_karyawan }}, 'Aktif')">
                                                                <i class="fas fa-user-check"></i>Aktifkan
                                                            </button>
                                                        @endif
                                                        <button class="action-dropdown-item delete-item"
                                                            onclick="deleteEmployee({{ $emp->id_karyawan }})">
                                                            <i class="fas fa-trash"></i>Hapus
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" style="text-align: center; padding: 40px; color: #64748b;">
                                                <i class="fas fa-users fa-2x mb-3" style="opacity: 0.3;"></i>
                                                <br>
                                                Tidak ada data karyawan
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            @if (isset($karyawan) && $karyawan->hasPages())
                                <div class="pagination-container" id="pagination-container">
                                    <div class="pagination-info" id="pagination-info">
                                        Menampilkan
                                        {{ $karyawan->firstItem() ?? 1 }}-{{ $karyawan->lastItem() ?? $karyawan->count() }}
                                        dari {{ $karyawan->total() ?? $karyawan->count() }} karyawan
                                    </div>
                                    <div class="pagination-wrapper" id="pagination-wrapper">
                                        {{ $karyawan->links('pagination::bootstrap-4') }}
                                    </div>
                                </div>
                            @endif
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
                                        <th style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none;">
                                            Departemen</th>
                                        <th
                                            style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none; text-align: right;">
                                            Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($distribusiDepartemen ?? [] as $dept)
                                        <tr>
                                            <td style="font-size: 0.85rem; border: none; padding: 8px 0;">
                                                <span class="badge-department">{{ $dept->divisi }}</span>
                                            </td>
                                            <td
                                                style="font-size: 0.85rem; border: none; padding: 8px 0; text-align: right;">
                                                <strong style="color: #1e293b;">{{ $dept->jumlah }} orang</strong>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" style="text-align: center; padding: 20px; color: #64748b;">
                                                Tidak ada data departemen
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <!-- Pagination for Distribusi Departemen -->
                            @if (isset($distribusiDepartemen) &&
                                    is_object($distribusiDepartemen) &&
                                    method_exists($distribusiDepartemen, 'hasPages') &&
                                    $distribusiDepartemen->hasPages())
                                <div class="pagination-container">
                                    <div class="pagination-info">
                                        Menampilkan
                                        {{ $distribusiDepartemen->firstItem() ?? 1 }}-{{ $distribusiDepartemen->lastItem() ?? $distribusiDepartemen->count() }}
                                        dari {{ $distribusiDepartemen->total() ?? $distribusiDepartemen->count() }}
                                        departemen
                                    </div>
                                    <div class="pagination-wrapper">
                                        {{ $distribusiDepartemen->links('pagination::bootstrap-4') }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="new-card">
                    <div class="new-card-header">
                        <div class="new-card-title">
                            <i class="fas fa-user-plus"></i>
                            Karyawan Terbaru
                        </div>
                    </div>
                    <div class="new-card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead style="background: white;">
                                    <tr>
                                        <th style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none;">Nama
                                        </th>
                                        <th style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none;">
                                            Departemen</th>
                                        <th
                                            style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none; text-align: center;">
                                            Bergabung</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="font-size: 0.85rem; border: none; padding: 8px 0;">
                                            <strong style="color: #1e293b;">Agus Dewi</strong>
                                        </td>
                                        <td style="font-size: 0.85rem; border: none; padding: 8px 0;">
                                            <span class="badge-department">Security</span>
                                        </td>
                                        <td style="font-size: 0.85rem; border: none; padding: 8px 0; text-align: center;">
                                            <small style="color: #64748b;">31 Agu 2025</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 0.85rem; border: none; padding: 8px 0;">
                                            <strong style="color: #1e293b;">Agus Kusumawati</strong>
                                        </td>
                                        <td style="font-size: 0.85rem; border: none; padding: 8px 0;">
                                            <span class="badge-department">Maintenance</span>
                                        </td>
                                        <td style="font-size: 0.85rem; border: none; padding: 8px 0; text-align: center;">
                                            <small style="color: #64748b;">31 Agu 2025</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 0.85rem; border: none; padding: 8px 0;">
                                            <strong style="color: #1e293b;">Sari Wulandari</strong>
                                        </td>
                                        <td style="font-size: 0.85rem; border: none; padding: 8px 0;">
                                            <span class="badge-department">Admin</span>
                                        </td>
                                        <td style="font-size: 0.85rem; border: none; padding: 8px 0; text-align: center;">
                                            <small style="color: #64748b;">30 Agu 2025</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 0.85rem; border: none; padding: 8px 0;">
                                            <strong style="color: #1e293b;">Budi Santoso</strong>
                                        </td>
                                        <td style="font-size: 0.85rem; border: none; padding: 8px 0;">
                                            <span class="badge-department">Marketing</span>
                                        </td>
                                        <td style="font-size: 0.85rem; border: none; padding: 8px 0; text-align: center;">
                                            <small style="color: #64748b;">29 Agu 2025</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 0.85rem; border: none; padding: 8px 0;">
                                            <strong style="color: #1e293b;">Ahmad Rifki</strong>
                                        </td>
                                        <td style="font-size: 0.85rem; border: none; padding: 8px 0;">
                                            <span class="badge-department">IT Support</span>
                                        </td>
                                        <td style="font-size: 0.85rem; border: none; padding: 8px 0; text-align: center;">
                                            <small style="color: #64748b;">28 Agu 2025</small>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- Pagination for Karyawan Terbaru -->
                            <div class="pagination-container">
                                <div class="pagination-info">
                                    Menampilkan 5 karyawan terbaru dari 725 total
                                </div>
                                <div class="pagination-wrapper">
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
                                                <a class="page-link" href="#">72</a>
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
    </div>

    <!-- Modal Tambah Karyawan -->
    <div class="modal fade" id="tambahKaryawanModal" tabindex="-1" aria-labelledby="tambahKaryawanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header"
                    style="background: linear-gradient(135deg, #f26b37 0%, #e55827 100%); color: white;">
                    <h5 class="modal-title" id="tambahKaryawanModalLabel">
                        <i class="fas fa-user-plus me-2"></i>Tambah Karyawan Baru
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 0;">
                    <!-- Tab Navigation -->
                    <ul class="nav nav-tabs" id="karyawanTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="form-tab" data-bs-toggle="tab"
                                data-bs-target="#form-panel" type="button" role="tab" aria-controls="form-panel"
                                aria-selected="true">
                                <i class="fas fa-edit me-2"></i>Form Input
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="preview-tab" data-bs-toggle="tab"
                                data-bs-target="#preview-panel" type="button" role="tab"
                                aria-controls="preview-panel" aria-selected="false">
                                <i class="fas fa-eye me-2"></i>Preview Data
                            </button>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="karyawanTabContent">
                        <!-- Form Panel -->
                        <div class="tab-pane fade show active" id="form-panel" role="tabpanel"
                            aria-labelledby="form-tab">
                            <div class="form-container">
                                <form id="tambahKaryawanForm">
                                    <div class="row g-2">
                                        <div class="col-md-4">
                                            <label for="nama" class="form-label compact-label">
                                                <i class="fas fa-user me-1"></i>Nama Lengkap <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control compact-input" id="nama"
                                                name="nama" required>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="email" class="form-label compact-label">
                                                <i class="fas fa-envelope me-1"></i>Email <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input type="email" class="form-control compact-input" id="email"
                                                name="email" required>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="tanggal_lahir" class="form-label compact-label">
                                                <i class="fas fa-calendar me-1"></i>Tanggal Lahir <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input type="date" class="form-control compact-input" id="tanggal_lahir"
                                                name="tanggal_lahir" required>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="divisi" class="form-label compact-label">
                                                <i class="fas fa-building me-1"></i>Divisi <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <select class="form-control compact-input" id="divisi" name="divisi"
                                                required>
                                                <option value="">Pilih Divisi</option>

                                                <!-- Management -->
                                                <optgroup label="🏢 Management">
                                                    <option value="General Manager">General Manager</option>
                                                    <option value="Assistant Manager">Assistant Manager</option>
                                                    <option value="Store Manager">Store Manager</option>
                                                    <option value="Supervisor">Supervisor</option>
                                                    <option value="Team Leader">Team Leader</option>
                                                </optgroup>

                                                <!-- Sales & Kasir -->
                                                <optgroup label="💰 Sales & Kasir">
                                                    <option value="Kasir">Kasir</option>
                                                    <option value="Senior Kasir">Senior Kasir</option>
                                                    <option value="Sales Associate">Sales Associate</option>
                                                    <option value="Sales Coordinator">Sales Coordinator</option>
                                                    <option value="Pramuniaga">Pramuniaga</option>
                                                </optgroup>

                                                <!-- Customer Service -->
                                                <optgroup label="🎧 Customer Service">
                                                    <option value="Customer Service">Customer Service</option>
                                                    <option value="Customer Care">Customer Care</option>
                                                    <option value="Information Desk">Information Desk</option>
                                                    <option value="Complaint Handler">Complaint Handler</option>
                                                </optgroup>

                                                <!-- Warehouse & Logistics -->
                                                <optgroup label="📦 Warehouse & Logistics">
                                                    <option value="Warehouse Staff">Warehouse Staff</option>
                                                    <option value="Inventory Control">Inventory Control</option>
                                                    <option value="Stock Keeper">Stock Keeper</option>
                                                    <option value="Receiving Staff">Receiving Staff</option>
                                                    <option value="Delivery Staff">Delivery Staff</option>
                                                    <option value="Logistics Coordinator">Logistics Coordinator</option>
                                                </optgroup>

                                                <!-- Security -->
                                                <optgroup label="🛡️ Security">
                                                    <option value="Security">Security</option>
                                                    <option value="Security Supervisor">Security Supervisor</option>
                                                    <option value="CCTV Operator">CCTV Operator</option>
                                                    <option value="Loss Prevention">Loss Prevention</option>
                                                </optgroup>

                                                <!-- Administration -->
                                                <optgroup label="📋 Administration">
                                                    <option value="HRD">HRD</option>
                                                    <option value="Finance">Finance</option>
                                                    <option value="Accounting">Accounting</option>
                                                    <option value="Admin">Admin</option>
                                                    <option value="Payroll Staff">Payroll Staff</option>
                                                    <option value="Data Entry">Data Entry</option>
                                                </optgroup>

                                                <!-- IT & Technology -->
                                                <optgroup label="💻 IT & Technology">
                                                    <option value="IT Support">IT Support</option>
                                                    <option value="IT Manager">IT Manager</option>
                                                    <option value="System Administrator">System Administrator</option>
                                                    <option value="Network Administrator">Network Administrator</option>
                                                    <option value="Web Developer">Web Developer</option>
                                                </optgroup>

                                                <!-- Maintenance -->
                                                <optgroup label="🔧 Maintenance">
                                                    <option value="Maintenance">Maintenance</option>
                                                    <option value="Cleaning Service">Cleaning Service</option>
                                                    <option value="Janitor">Janitor</option>
                                                    <option value="Gardener">Gardener</option>
                                                    <option value="Electrician">Electrician</option>
                                                    <option value="Plumber">Plumber</option>
                                                </optgroup>

                                                <!-- Marketing -->
                                                <optgroup label="📢 Marketing">
                                                    <option value="Marketing">Marketing</option>
                                                    <option value="Promotor">Promotor</option>
                                                    <option value="Event Coordinator">Event Coordinator</option>
                                                    <option value="Social Media Specialist">Social Media Specialist
                                                    </option>
                                                </optgroup>

                                                <!-- Others -->
                                                <optgroup label="🔄 Others">
                                                    <option value="Intern">Intern</option>
                                                    <option value="Part Time">Part Time</option>
                                                    <option value="Freelancer">Freelancer</option>
                                                    <option value="Consultant">Consultant</option>
                                                </optgroup>

                                                <option value="other">Divisi Lainnya</option>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="nomer_telepon" class="form-label compact-label">
                                                <i class="fas fa-phone me-1"></i>Nomor Telepon <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input type="tel" class="form-control compact-input" id="nomer_telepon"
                                                name="nomer_telepon" placeholder="08xxxxxxxxxx" required>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="id_shift" class="form-label compact-label">
                                                <i class="fas fa-clock me-1"></i>Shift <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-control compact-input" id="id_shift" name="id_shift"
                                                required>
                                                <option value="">Pilih Shift</option>
                                                @foreach ($shiftList ?? [] as $shift)
                                                    <option value="{{ $shift->id_shift }}">
                                                        {{ $shift->nama_shift }}
                                                        ({{ date('H:i', strtotime($shift->jam_mulai)) }}-{{ date('H:i', strtotime($shift->jam_selesai)) }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="status" class="form-label compact-label">
                                                <i class="fas fa-toggle-on me-1"></i>Status <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <select class="form-control compact-input" id="status" name="status"
                                                required>
                                                <option value="Aktif">Aktif</option>
                                                <option value="Non-Aktif">Non-Aktif</option>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-6" id="divisiLainnyaGroup" style="display: none;">
                                            <label for="divisi_lainnya" class="form-label compact-label">
                                                <i class="fas fa-plus me-1"></i>Nama Divisi Baru
                                            </label>
                                            <input type="text" class="form-control compact-input" id="divisi_lainnya"
                                                name="divisi_lainnya">
                                        </div>
                                        <div class="col-12">
                                            <label for="alamat" class="form-label compact-label">
                                                <i class="fas fa-map-marker-alt me-1"></i>Alamat <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <textarea class="form-control compact-input" id="alamat" name="alamat" rows="2" required></textarea>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-12">
                                            <label for="foto_modal" class="form-label compact-label">
                                                <i class="fas fa-image me-1"></i>Foto Karyawan <span
                                                    class="text-muted">(Opsional)</span>
                                            </label>
                                            <input type="file" class="form-control compact-input" id="foto_modal"
                                                name="foto" accept="image/*" onchange="previewImageModal(this)">
                                            <div class="form-text">Format: JPG, JPEG, PNG, GIF. Maksimal: 2MB</div>
                                            <div class="invalid-feedback"></div>

                                            <!-- Preview Image -->
                                            <div class="mt-2">
                                                <img id="imagePreviewModal" src="#" alt="Preview Foto"
                                                    class="img-thumbnail"
                                                    style="width: 100px; height: 100px; object-fit: cover; display: none;">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12">
                                            <div class="alert alert-info compact-alert">
                                                <i class="fas fa-info-circle me-2"></i>
                                                <small><strong>Petunjuk:</strong> Klik tab "Preview Data" untuk melihat
                                                    ringkasan sebelum menyimpan.</small>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Preview Panel -->
                        <div class="tab-pane fade" id="preview-panel" role="tabpanel" aria-labelledby="preview-tab">
                            <div class="preview-container">
                                <div class="preview-section"
                                    style="background: #f8f9fa; border: 1px solid #dee2e6; border-radius: 8px; padding: 20px;">
                                    <h6 style="color: #f26b37; margin-bottom: 20px;">
                                        <i class="fas fa-eye me-2"></i>Preview Data Karyawan
                                    </h6>

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="preview-item"
                                                style="border-bottom: 1px solid #dee2e6; padding-bottom: 10px; margin-bottom: 15px;">
                                                <div class="preview-label"
                                                    style="font-size: 0.875rem; color: #6c757d; margin-bottom: 2px;">Nama
                                                    Lengkap</div>
                                                <div class="preview-value" id="preview-nama"
                                                    style="font-weight: 600; color: #2c3e50;">-</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="preview-item"
                                                style="border-bottom: 1px solid #dee2e6; padding-bottom: 10px; margin-bottom: 15px;">
                                                <div class="preview-label"
                                                    style="font-size: 0.875rem; color: #6c757d; margin-bottom: 2px;">Email
                                                </div>
                                                <div class="preview-value" id="preview-email"
                                                    style="font-weight: 600; color: #2c3e50;">-</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="preview-item"
                                                style="border-bottom: 1px solid #dee2e6; padding-bottom: 10px; margin-bottom: 15px;">
                                                <div class="preview-label"
                                                    style="font-size: 0.875rem; color: #6c757d; margin-bottom: 2px;">Divisi
                                                </div>
                                                <div class="preview-value" id="preview-divisi"
                                                    style="font-weight: 600; color: #2c3e50;">-</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="preview-item"
                                                style="border-bottom: 1px solid #dee2e6; padding-bottom: 10px; margin-bottom: 15px;">
                                                <div class="preview-label"
                                                    style="font-size: 0.875rem; color: #6c757d; margin-bottom: 2px;">
                                                    Tanggal Lahir</div>
                                                <div class="preview-value" id="preview-tanggal-lahir"
                                                    style="font-weight: 600; color: #2c3e50;">-</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="preview-item"
                                                style="border-bottom: 1px solid #dee2e6; padding-bottom: 10px; margin-bottom: 15px;">
                                                <div class="preview-label"
                                                    style="font-size: 0.875rem; color: #6c757d; margin-bottom: 2px;">Nomor
                                                    Telepon</div>
                                                <div class="preview-value" id="preview-telepon"
                                                    style="font-weight: 600; color: #2c3e50;">-</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="preview-item"
                                                style="border-bottom: 1px solid #dee2e6; padding-bottom: 10px; margin-bottom: 15px;">
                                                <div class="preview-label"
                                                    style="font-size: 0.875rem; color: #6c757d; margin-bottom: 2px;">Shift
                                                </div>
                                                <div class="preview-value" id="preview-shift"
                                                    style="font-weight: 600; color: #2c3e50;">-</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="preview-item"
                                                style="border-bottom: 1px solid #dee2e6; padding-bottom: 10px; margin-bottom: 15px;">
                                                <div class="preview-label"
                                                    style="font-size: 0.875rem; color: #6c757d; margin-bottom: 2px;">Status
                                                </div>
                                                <div class="preview-value" id="preview-status"
                                                    style="font-weight: 600; color: #2c3e50;">-</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="preview-item"
                                                style="border-bottom: 1px solid #dee2e6; padding-bottom: 10px; margin-bottom: 15px;">
                                                <div class="preview-label"
                                                    style="font-size: 0.875rem; color: #6c757d; margin-bottom: 2px;">Usia
                                                </div>
                                                <div class="preview-value" id="preview-usia"
                                                    style="font-weight: 600; color: #2c3e50;">-</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="preview-item">
                                                <div class="preview-label"
                                                    style="font-size: 0.875rem; color: #6c757d; margin-bottom: 2px;">Alamat
                                                </div>
                                                <div class="preview-value" id="preview-alamat"
                                                    style="font-weight: 600; color: #2c3e50;">-</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="alert alert-warning mt-3">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        <small><strong>Perhatian:</strong> Pastikan semua data sudah benar sebelum
                                            menyimpan.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
        <div class="modal-footer d-flex justify-content-center">
            <button type="button" class="btn btn-outline-secondary me-3" data-bs-dismiss="modal">
                <i class="fas fa-times me-1"></i>Batal
            </button>
            <button type="button" class="btn btn-primary" id="submitKaryawan">
                <i class="fas fa-save me-1"></i>Simpan Karyawan
            </button>
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

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            // Update clock immediately and then every second
            updateRealTimeClock();
            setInterval(updateRealTimeClock, 1000);
        });

        // Search functionality with AJAX
        let searchTimeout;
        document.getElementById('searchKaryawan').addEventListener('input', function(e) {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                performSearch();
            }, 300); // Debounce untuk menghindari terlalu banyak request
        });

        function performSearch() {
            const searchTerm = document.getElementById('searchKaryawan').value.toLowerCase().trim();
            const departmentFilter = document.getElementById('filterDepartment').value;
            const statusFilter = document.getElementById('filterStatus').value;

            // Jika tidak ada filter, gunakan client-side filtering saja
            if (!searchTerm && !departmentFilter && !statusFilter) {
                applyClientSideFilters();
                return;
            }

            // Show loading indicator
            showLoadingState();

            // Prepare search parameters
            const params = new URLSearchParams();
            if (searchTerm) params.append('search', searchTerm);
            if (departmentFilter) params.append('department', departmentFilter);
            if (statusFilter) params.append('status', statusFilter);

            // Perform AJAX search
            fetch(`${window.location.pathname}?${params.toString()}`, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    updateTableContent(data);
                    hideLoadingState();
                })
                .catch(error => {
                    console.error('Search error:', error);
                    // Fallback to client-side filtering
                    applyClientSideFilters();
                    hideLoadingState();
                });
        }

        function applyClientSideFilters() {
            const searchTerm = document.getElementById('searchKaryawan').value.toLowerCase().trim();
            const departmentFilter = document.getElementById('filterDepartment').value.toLowerCase();
            const statusFilter = document.getElementById('filterStatus').value.toLowerCase();

            const tableBody = document.querySelector('.table tbody');
            const tableRows = tableBody.querySelectorAll('tr');

            let visibleCount = 0;

            tableRows.forEach(row => {
                // Skip empty state row
                if (row.cells.length === 1 && row.cells[0].colSpan > 1) {
                    return;
                }

                // Get data from cells
                const nama = row.cells[2] ? row.cells[2].textContent.toLowerCase() : '';
                const jabatan = row.cells[3] ? row.cells[3].textContent.toLowerCase() : '';
                const departemen = row.cells[4] ? row.cells[4].textContent.toLowerCase() : '';
                const status = row.cells[5] ? row.cells[5].textContent.toLowerCase() : '';
                const email = row.cells[2] ? row.cells[2].querySelector('small') ? row.cells[2].querySelector(
                    'small').textContent.toLowerCase() : '' : '';

                // Combine searchable fields
                const searchableText = `${nama} ${jabatan} ${departemen} ${email}`;

                // Apply filters
                let shouldShow = true;

                // Search filter
                if (searchTerm !== '' && !searchableText.includes(searchTerm)) {
                    shouldShow = false;
                }

                // Department filter
                if (departmentFilter !== '' && !departemen.includes(departmentFilter)) {
                    shouldShow = false;
                }

                // Status filter
                if (statusFilter !== '' && !status.includes(statusFilter)) {
                    shouldShow = false;
                }

                if (shouldShow) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            // Update pagination info
            updateFilterInfo(visibleCount, searchTerm, departmentFilter, statusFilter);
        }

        function updateFilterInfo(visibleCount, searchTerm, departmentFilter, statusFilter) {
            const paginationInfo = document.querySelector('.pagination-info');
            if (!paginationInfo) return;

            let infoText = '';
            const filters = [];

            if (searchTerm) filters.push(`pencarian "${searchTerm}"`);
            if (departmentFilter) filters.push(`departemen "${departmentFilter}"`);
            if (statusFilter) filters.push(`status "${statusFilter}"`);

            if (filters.length > 0) {
                infoText = `Menampilkan ${visibleCount} hasil dengan filter: ${filters.join(', ')}`;
            } else {
                // Reset to original if no filters
                const totalRows = document.querySelectorAll('.table tbody tr').length - 1; // -1 for empty state row
                infoText = `Menampilkan 1-${Math.min(10, totalRows)} dari ${totalRows} karyawan`;
            }

            paginationInfo.textContent = infoText;
        }

        function showLoadingState() {
            const tableBody = document.querySelector('.table tbody');
            const searchInput = document.getElementById('searchKaryawan');

            // Add loading class to search input
            searchInput.parentElement.classList.add('search-input-enhanced', 'loading');

            const loadingRow = document.createElement('tr');
            loadingRow.id = 'loading-row';
            loadingRow.innerHTML = `
        <td colspan="8" style="text-align: center; padding: 40px; color: #64748b;">
            <div class="spinner-border spinner-border-sm text-primary me-2" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            Mencari data...
        </td>
    `;

            // Hide existing rows temporarily
            const existingRows = tableBody.querySelectorAll('tr:not(#loading-row)');
            existingRows.forEach(row => row.style.display = 'none');

            // Add loading row if not exists
            if (!document.getElementById('loading-row')) {
                tableBody.appendChild(loadingRow);
            }
        }

        function hideLoadingState() {
            const searchInput = document.getElementById('searchKaryawan');
            const loadingRow = document.getElementById('loading-row');

            // Remove loading class from search input
            searchInput.parentElement.classList.remove('loading');

            if (loadingRow) {
                loadingRow.remove();
            }
        }

        function updateTableContent(data) {
            const tableBody = document.querySelector('.table tbody');
            const paginationContainer = document.querySelector('.pagination-container');

            // Clear existing content
            tableBody.innerHTML = '';

            if (data.karyawan && data.karyawan.length > 0) {
                // Add employee rows
                data.karyawan.forEach((emp, index) => {
                    const row = createEmployeeRow(emp, index + 1);
                    tableBody.appendChild(row);
                });

                // Update pagination info
                updateSearchPaginationInfo(data);
            } else {
                // Show no results message
                const searchTerm = document.getElementById('searchKaryawan').value;
                const departmentFilter = document.getElementById('filterDepartment').value;
                const statusFilter = document.getElementById('filterStatus').value;

                let message = 'Tidak ada hasil yang ditemukan';
                let subMessage = 'Coba gunakan kata kunci yang berbeda';

                if (searchTerm || departmentFilter || statusFilter) {
                    const filters = [];
                    if (searchTerm) filters.push(`"${searchTerm}"`);
                    if (departmentFilter) filters.push(`departemen "${departmentFilter}"`);
                    if (statusFilter) filters.push(`status "${statusFilter}"`);

                    subMessage = `untuk filter: ${filters.join(', ')}`;
                }

                const noResultRow = document.createElement('tr');
                noResultRow.innerHTML = `
            <td colspan="8" style="text-align: center; padding: 40px; color: #64748b;">
                <i class="fas fa-search fa-2x mb-3" style="opacity: 0.3;"></i>
                <br>
                ${message}
                <br>
                <small>${subMessage}</small>
                <br><br>
                <button class="btn btn-outline-primary btn-sm" onclick="document.getElementById('resetFilters').click()">
                    <i class="fas fa-undo me-1"></i>Reset Filter
                </button>
            </td>
        `;
                tableBody.appendChild(noResultRow);

                // Hide pagination
                if (paginationContainer) {
                    paginationContainer.style.display = 'none';
                }
            }

            // Reinitialize dropdown events
            initializeDropdowns();
        }

        function createEmployeeRow(emp, index) {
            const searchTerm = document.getElementById('searchKaryawan').value.toLowerCase();

            // Function to highlight search terms
            function highlightText(text, searchTerm) {
                if (!searchTerm || !text) return text;
                const regex = new RegExp(`(${searchTerm})`, 'gi');
                return text.replace(regex,
                    '<mark style="background: #fff3cd; padding: 2px 4px; border-radius: 3px;">$1</mark>');
            }

            const row = document.createElement('tr');
            row.innerHTML = `
        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">${index}</td>
        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
            <img src="/image/default-avatar.png" alt="Foto" style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover;">
        </td>
        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
            <div>
                <strong style="color: #1e293b;">${highlightText(emp.nama, searchTerm)}</strong>
                <br>
                <small style="color: #64748b;">${highlightText(emp.email || '-', searchTerm)}</small>
            </div>
        </td>
        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
            <strong style="color: #1e293b;">${highlightText(emp.divisi, searchTerm)}</strong>
        </td>
        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
            <span class="badge-department">${highlightText(emp.divisi, searchTerm)}</span>
        </td>
        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
            ${emp.status === 'Aktif' ? 
                `<span class="badge-active">${emp.status}</span>` : 
                `<span class="badge-inactive">${emp.status}</span>`
            }
        </td>
        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
            <small style="color: #64748b;">${emp.created_at ? new Date(emp.created_at).toLocaleDateString('id-ID', {day: '2-digit', month: 'short', year: 'numeric'}) : '-'}</small>
        </td>
        <td style="font-size: 0.85rem; border: none; padding: 12px 0; text-align: center;">
            <div class="action-dropdown">
                <button class="action-dropdown-btn" data-employee-id="${emp.id_karyawan}">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <div class="action-dropdown-menu">
                    <button class="action-dropdown-item view-item" onclick="viewEmployee(${emp.id_karyawan})">
                        <i class="fas fa-eye me-2"></i>Detail
                    </button>
                    <button class="action-dropdown-item edit-item" onclick="editEmployee(${emp.id_karyawan})">
                        <i class="fas fa-edit me-2"></i>Edit
                    </button>
                    ${emp.status === 'Aktif' ? 
                        `<button class="action-dropdown-item" style="color: #f59e0b;" onclick="toggleStatus(${emp.id_karyawan}, 'Non-Aktif')">
                                    <i class="fas fa-user-slash me-2"></i>Non-Aktifkan
                                </button>` :
                        `<button class="action-dropdown-item" style="color: #10b981;" onclick="toggleStatus(${emp.id_karyawan}, 'Aktif')">
                                    <i class="fas fa-user-check me-2"></i>Aktifkan
                                </button>`
                    }
                    <button class="action-dropdown-item delete-item" onclick="deleteEmployee(${emp.id_karyawan})">
                        <i class="fas fa-trash me-2"></i>Hapus
                    </button>
                </div>
            </div>
        </td>
    `;
            return row;
        }

        function updateSearchPaginationInfo(data) {
            const paginationInfo = document.querySelector('.pagination-info');
            const paginationContainer = document.querySelector('.pagination-container');

            if (paginationInfo) {
                const searchTerm = document.getElementById('searchKaryawan').value;
                const departmentFilter = document.getElementById('filterDepartment').value;
                const statusFilter = document.getElementById('filterStatus').value;

                const filters = [];
                if (searchTerm) filters.push(`"${searchTerm}"`);
                if (departmentFilter) filters.push(`departemen "${departmentFilter}"`);
                if (statusFilter) filters.push(`status "${statusFilter}"`);

                if (filters.length > 0) {
                    paginationInfo.textContent = `Menampilkan ${data.karyawan.length} hasil untuk: ${filters.join(', ')}`;
                } else {
                    paginationInfo.textContent = `Menampilkan ${data.karyawan.length} karyawan`;
                }
            }

            // Show pagination container
            if (paginationContainer) {
                paginationContainer.style.display = 'flex';
            }
        }

        // Specific function for table dropdown to avoid conflict with sidebar
        function toggleTableDropdown(button, event) {
            // Prevent event bubbling to avoid triggering other dropdowns
            if (event) {
                event.preventDefault();
                event.stopPropagation();
                event.stopImmediatePropagation();
            }

            console.log('toggleTableDropdown called', button);

            const dropdown = button.closest('.action-dropdown');
            const allTableDropdowns = document.querySelectorAll('.table-responsive .action-dropdown');

            // Close all other table dropdowns only (not sidebar dropdowns)
            allTableDropdowns.forEach(d => {
                if (d !== dropdown) {
                    d.classList.remove('show');
                }
            });

            // Toggle current dropdown
            dropdown.classList.toggle('show');

            console.log('Table dropdown show state:', dropdown.classList.contains('show'));

            return false; // Prevent any further event propagation
        }

        // Simple dropdown toggle function
        function toggleDropdown(button) {
            console.log('toggleDropdown called', button);

            const dropdown = button.closest('.action-dropdown');
            const allDropdowns = document.querySelectorAll('.action-dropdown');

            // Close all other dropdowns
            allDropdowns.forEach(d => {
                if (d !== dropdown) {
                    d.classList.remove('show');
                }
            });

            // Toggle current dropdown
            dropdown.classList.toggle('show');

            console.log('Dropdown show state:', dropdown.classList.contains('show'));
        }

        function initializeDropdowns() {
            console.log('Initializing dropdowns...');

            // Remove all existing event listeners first
            document.removeEventListener('click', handleOutsideClick);

            // Add event listeners to all dropdown buttons
            document.querySelectorAll('.action-dropdown-btn').forEach(button => {
                // Remove existing listeners
                button.removeEventListener('click', handleButtonClick);
                // Add new listener
                button.addEventListener('click', handleButtonClick);
            });

            // Add global click listener to close dropdowns
            document.addEventListener('click', handleOutsideClick);

            console.log('Found buttons:', document.querySelectorAll('.action-dropdown-btn').length);
        }

        function handleButtonClick(e) {
            e.preventDefault();
            e.stopPropagation();

            console.log('Button clicked!', e.target);

            const button = e.currentTarget;
            const dropdown = button.closest('.action-dropdown');
            const menu = dropdown.querySelector('.action-dropdown-menu');

            // Close all other dropdowns
            document.querySelectorAll('.action-dropdown').forEach(d => {
                if (d !== dropdown) {
                    d.classList.remove('show');
                }
            });

            // Toggle current dropdown
            dropdown.classList.toggle('show');

            console.log('Dropdown toggled, show class:', dropdown.classList.contains('show'));
            console.log('Menu element:', menu);
        }

        function handleOutsideClick(e) {
            // Only close table dropdowns when clicking outside, not sidebar dropdowns
            if (!e.target.closest('.table-responsive .action-dropdown') && !e.target.closest('.sidebar')) {
                document.querySelectorAll('.table-responsive .action-dropdown').forEach(dropdown => {
                    dropdown.classList.remove('show');
                });
            }
        }

        // Add keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl + F to focus search
            if (e.ctrlKey && e.key === 'f') {
                e.preventDefault();
                document.getElementById('searchKaryawan').focus();
                document.getElementById('searchKaryawan').select();
            }

            // Escape to clear search and filters
            if (e.key === 'Escape') {
                document.getElementById('resetFilters').click();
            }
        });

        // Real-time clock update (consolidate with date update)
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

            // Update date as well
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

            // Update current day element if exists
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

        // Update real-time clock
        updateRealTimeClock();
        setInterval(updateRealTimeClock, 1000);

        // Filter functionality
        document.getElementById('filterDepartment').addEventListener('change', performSearch);
        document.getElementById('filterStatus').addEventListener('change', performSearch);

        // Reset filters functionality
        document.getElementById('resetFilters').addEventListener('click', function() {
            // Clear all filter inputs
            document.getElementById('searchKaryawan').value = '';
            document.getElementById('filterDepartment').value = '';
            document.getElementById('filterStatus').value = '';

            // Reload page to show all data
            window.location.href = window.location.pathname;
        });

        // Dropdown functionality with proper event handling
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize dropdowns
            initializeDropdowns();

            // Initialize form handlers
            initializeFormHandlers();
        });

        // Initialize form handlers
        function initializeFormHandlers() {
            // Handle divisi selection
            const divisiSelect = document.getElementById('divisi');
            const divisiLainnyaGroup = document.getElementById('divisiLainnyaGroup');

            if (divisiSelect && divisiLainnyaGroup) {
                divisiSelect.addEventListener('change', function() {
                    if (this.value === 'other') {
                        divisiLainnyaGroup.style.display = 'block';
                        document.getElementById('divisi_lainnya').required = true;
                    } else {
                        divisiLainnyaGroup.style.display = 'none';
                        document.getElementById('divisi_lainnya').required = false;
                        document.getElementById('divisi_lainnya').value = '';
                    }
                });
            }

            // Handle form submission
            const submitButton = document.getElementById('submitKaryawan');
            if (submitButton) {
                submitButton.addEventListener('click', handleSubmitKaryawan);
            }

            // Handle phone number formatting
            const phoneInput = document.getElementById('nomer_telepon');
            if (phoneInput) {
                phoneInput.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\D/g, ''); // Remove non-digits

                    // Ensure it starts with 08
                    if (value.length > 0 && !value.startsWith('08')) {
                        if (value.startsWith('8')) {
                            value = '0' + value;
                        } else if (value.startsWith('62')) {
                            value = '0' + value.substring(2);
                        } else {
                            value = '08' + value;
                        }
                    }

                    // Limit length
                    if (value.length > 13) {
                        value = value.substring(0, 13);
                    }

                    e.target.value = value;
                });
            }
        }

        // Handle form submission
        function handleSubmitKaryawan() {
            const form = document.getElementById('tambahKaryawanForm');
            const submitButton = document.getElementById('submitKaryawan');
            const formData = new FormData(form);

            // Clear previous validation errors
            clearValidationErrors();

            // Get form data
            const formDataObj = new FormData(form);

            // Handle divisi lainnya
            if (formDataObj.get('divisi') === 'other') {
                formDataObj.set('divisi', formDataObj.get('divisi_lainnya'));
                formDataObj.delete('divisi_lainnya');
            }

            // Client-side validation
            const data = {
                nama: formDataObj.get('nama'),
                email: formDataObj.get('email'),
                divisi: formDataObj.get('divisi'),
                tanggal_lahir: formDataObj.get('tanggal_lahir'),
                nomer_telepon: formDataObj.get('nomer_telepon'),
                alamat: formDataObj.get('alamat'),
                id_shift: formDataObj.get('id_shift'),
                status: formDataObj.get('status')
            };

            if (!validateForm(data)) {
                return;
            }

            // Show loading state
            submitButton.disabled = true;
            submitButton.innerHTML = '<div class="spinner-border spinner-border-sm me-2" role="status"></div>Menyimpan...';

            // Submit to server
            fetch('/admin/data-karyawan', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
                            '',
                        'Accept': 'application/json'
                    },
                    body: formDataObj
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        // Show success message
                        showNotification('Karyawan berhasil ditambahkan!', 'success');

                        // Close modal
                        const modal = bootstrap.Modal.getInstance(document.getElementById('tambahKaryawanModal'));
                        modal.hide();

                        // Reset form
                        form.reset();
                        document.getElementById('divisiLainnyaGroup').style.display = 'none';

                        // Clear image preview
                        const imagePreview = document.getElementById('imagePreviewModal');
                        if (imagePreview) {
                            imagePreview.style.display = 'none';
                            imagePreview.src = '#';
                        }

                        // Refresh table data
                        setTimeout(() => {
                            performSearch();
                        }, 500);

                    } else {
                        // Show validation errors
                        if (result.errors) {
                            showValidationErrors(result.errors);
                        } else {
                            showNotification(result.message || 'Terjadi kesalahan saat menyimpan data', 'error');
                        }
                    }
                })
                .catch(error => {
                    console.error('Submit error:', error);
                    showNotification('Terjadi kesalahan saat menyimpan data', 'error');
                })
                .finally(() => {
                    // Reset button state
                    submitButton.disabled = false;
                    submitButton.innerHTML = '<i class="fas fa-save me-1"></i>Simpan Karyawan';
                });
        }

        // Validate form data
        function validateForm(data) {
            let isValid = true;

            // Required field validation
            const requiredFields = {
                nama: 'Nama lengkap',
                email: 'Email',
                divisi: 'Divisi',
                tanggal_lahir: 'Tanggal lahir',
                nomer_telepon: 'Nomor telepon',
                alamat: 'Alamat',
                id_shift: 'Shift',
                status: 'Status'
            };

            for (const [field, label] of Object.entries(requiredFields)) {
                if (!data[field] || data[field].trim() === '') {
                    showFieldError(field, `${label} harus diisi`);
                    isValid = false;
                }
            }

            // Email validation
            if (data.email && !isValidEmail(data.email)) {
                showFieldError('email', 'Format email tidak valid');
                isValid = false;
            }

            // Phone validation
            if (data.nomer_telepon && !isValidPhone(data.nomer_telepon)) {
                showFieldError('nomer_telepon', 'Nomor telepon harus dimulai dengan 08 dan terdiri dari 10-13 digit');
                isValid = false;
            }

            // Age validation (minimum 17 years old)
            if (data.tanggal_lahir && !isValidAge(data.tanggal_lahir)) {
                showFieldError('tanggal_lahir', 'Karyawan harus berusia minimal 17 tahun');
                isValid = false;
            }

            return isValid;
        }

        // Helper validation functions
        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function isValidPhone(phone) {
            const phoneRegex = /^08\d{8,11}$/;
            return phoneRegex.test(phone);
        }

        function isValidAge(birthDate) {
            const today = new Date();
            const birth = new Date(birthDate);
            const age = today.getFullYear() - birth.getFullYear();
            const monthDiff = today.getMonth() - birth.getMonth();

            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birth.getDate())) {
                return (age - 1) >= 17;
            }
            return age >= 17;
        }

        // Show field error
        function showFieldError(fieldName, message) {
            const field = document.getElementById(fieldName);
            if (field) {
                field.classList.add('is-invalid');
                const feedback = field.parentNode.querySelector('.invalid-feedback');
                if (feedback) {
                    feedback.textContent = message;
                }
            }
        }

        // Show validation errors from server
        function showValidationErrors(errors) {
            for (const [field, messages] of Object.entries(errors)) {
                if (Array.isArray(messages) && messages.length > 0) {
                    showFieldError(field, messages[0]);
                }
            }
        }

        // Clear validation errors
        function clearValidationErrors() {
            const invalidFields = document.querySelectorAll('.is-invalid');
            invalidFields.forEach(field => {
                field.classList.remove('is-invalid');
            });

            const feedbacks = document.querySelectorAll('.invalid-feedback');
            feedbacks.forEach(feedback => {
                feedback.textContent = '';
            });
        }

        // Remove the old function
        function toggleDropdown(button) {
            // This function is no longer used
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.action-dropdown')) {
                document.querySelectorAll('.action-dropdown').forEach(dropdown => {
                    dropdown.classList.remove('show');
                });
            }
        });

        // Employee action functions
        function viewEmployee(id) {
            alert('View employee with ID: ' + id);
            // Close dropdown
            document.querySelectorAll('.action-dropdown').forEach(dropdown => {
                dropdown.classList.remove('show');
            });
        }

        function editEmployee(id) {
            alert('Edit employee with ID: ' + id);
            // Close dropdown
            document.querySelectorAll('.action-dropdown').forEach(dropdown => {
                dropdown.classList.remove('show');
            });
        }

        function toggleStatus(id, newStatus) {
            const actionText = newStatus === 'Aktif' ? 'mengaktifkan' : 'menonaktifkan';

            if (confirm(`Apakah Anda yakin ingin ${actionText} karyawan ini?`)) {
                // Show loading state
                showLoadingState();

                fetch(`/admin/karyawan/${id}/toggle-status`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute(
                                'content') || '',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            status: newStatus
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        hideLoadingState();
                        if (data.success) {
                            // Refresh current page data
                            performSearch();

                            // Show success message
                            showNotification(
                                `Karyawan berhasil ${newStatus === 'Aktif' ? 'diaktifkan' : 'dinonaktifkan'}`,
                                'success');
                        } else {
                            showNotification(data.message || 'Terjadi kesalahan', 'error');
                        }
                    })
                    .catch(error => {
                        hideLoadingState();
                        console.error('Toggle status error:', error);
                        showNotification('Terjadi kesalahan saat mengubah status', 'error');
                    });
            }

            // Close dropdown
            document.querySelectorAll('.action-dropdown').forEach(dropdown => {
                dropdown.classList.remove('show');
            });
        }

        function deleteEmployee(id) {
            if (confirm('Apakah Anda yakin ingin menghapus karyawan ini?')) {
                alert('Delete employee with ID: ' + id);
            }
            // Close dropdown
            document.querySelectorAll('.action-dropdown').forEach(dropdown => {
                dropdown.classList.remove('show');
            });
        }

        // Helper function to show notifications
        function showNotification(message, type = 'info') {
            // Create notification element
            const notification = document.createElement('div');
            notification.className =
                `alert alert-${type === 'success' ? 'success' : type === 'error' ? 'danger' : 'info'} alert-dismissible fade show`;
            notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 10000;
        min-width: 300px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    `;
            notification.innerHTML = `
        <strong>${type === 'success' ? 'Berhasil!' : type === 'error' ? 'Error!' : 'Info'}</strong> ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;

            // Add to body
            document.body.appendChild(notification);

            // Auto remove after 3 seconds
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, 3000);
        }

        // CRITICAL: Add the toggleTableDropdown function
        function toggleTableDropdown(button, event) {
            console.log('toggleTableDropdown called!');

            if (event) {
                event.preventDefault();
                event.stopPropagation();
                event.stopImmediatePropagation();
            }

            const dropdown = button.closest('.action-dropdown');
            const allTableDropdowns = document.querySelectorAll('.table-responsive .action-dropdown');

            // Close all other table dropdowns
            allTableDropdowns.forEach(d => {
                if (d !== dropdown) {
                    d.classList.remove('show');
                }
            });

            // Toggle current dropdown
            dropdown.classList.toggle('show');
            console.log('Dropdown toggled, show class:', dropdown.classList.contains('show'));

            return false;
        }

        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM Content Loaded - initializing dropdowns and smooth pagination');

            // Initialize dropdown functionality
            initializeDropdowns();

            // Add smooth pagination (scroll to table when page changes)
            document.addEventListener('click', function(e) {
                if (e.target.closest('.pagination a')) {
                    // Add a small delay to let the page load, then scroll to table
                    setTimeout(() => {
                        const tableContainer = document.getElementById('karyawan-table-container');
                        if (tableContainer) {
                            tableContainer.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start',
                                inline: 'nearest'
                            });
                        }
                    }, 100);
                }
            });
        });

        // Initialize dropdown functionality
        function initializeDropdowns() {
            // Handle dropdown buttons with event delegation
            document.addEventListener('click', function(e) {
                if (e.target.closest('.table-responsive .action-dropdown-btn')) {
                    e.preventDefault();
                    e.stopPropagation();
                    console.log('Dropdown button clicked');

                    const button = e.target.closest('.action-dropdown-btn');
                    const dropdown = button.closest('.action-dropdown');
                    const isCurrentlyShown = dropdown.classList.contains('show');

                    // Close all table dropdowns first
                    document.querySelectorAll('.table-responsive .action-dropdown').forEach(d => {
                        d.classList.remove('show');
                    });

                    // Toggle current dropdown if it wasn't shown
                    if (!isCurrentlyShown) {
                        dropdown.classList.add('show');
                        console.log('Dropdown shown');
                    }
                }
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.table-responsive .action-dropdown')) {
                    document.querySelectorAll('.table-responsive .action-dropdown').forEach(dropdown => {
                        dropdown.classList.remove('show');
                    });
                }
            });
        }

        // Specific function for table dropdown to avoid conflict with sidebar
        function toggleTableDropdown(button, event) {
            // Prevent event bubbling to avoid triggering other dropdowns
            if (event) {
                event.preventDefault();
                event.stopPropagation();
                event.stopImmediatePropagation();
            }

            console.log('toggleTableDropdown called', button);

            const dropdown = button.closest('.action-dropdown');
            const allTableDropdowns = document.querySelectorAll('.table-responsive .action-dropdown');

            // Close all other table dropdowns only (not sidebar dropdowns)
            allTableDropdowns.forEach(d => {
                if (d !== dropdown) {
                    d.classList.remove('show');
                }
            });

            // Toggle current dropdown
            dropdown.classList.toggle('show');

            console.log('Table dropdown show state:', dropdown.classList.contains('show'));

            return false; // Prevent any further event propagation
        }

        // Also initialize after AJAX calls
        window.initializeAfterAjax = function() {
            console.log('Reinitializing dropdowns after AJAX');
            setTimeout(() => {
                // Re-attach event listeners to new elements
                document.querySelectorAll('.table-responsive .action-dropdown-btn').forEach(button => {
                    if (!button.hasAttribute('data-initialized')) {
                        button.setAttribute('data-initialized', 'true');
                        button.addEventListener('click', function(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            console.log('Dropdown button clicked (AJAX)');

                            const dropdown = this.closest('.action-dropdown');
                            const isCurrentlyShown = dropdown.classList.contains('show');

                            // Close all table dropdowns first
                            document.querySelectorAll('.table-responsive .action-dropdown')
                                .forEach(d => {
                                    d.classList.remove('show');
                                });

                            // Toggle current dropdown if it wasn't shown
                            if (!isCurrentlyShown) {
                                dropdown.classList.add('show');
                                console.log('Dropdown shown (AJAX)');
                            }
                        });
                    }
                });
            }, 100);
        };

        // Preview image function for modal
        function previewImageModal(input) {
            const preview = document.getElementById('imagePreviewModal');
            const file = input.files[0];

            if (file) {
                // Validate file size (max 2MB)
                const maxSize = 2 * 1024 * 1024; // 2MB in bytes
                if (file.size > maxSize) {
                    alert('Ukuran file terlalu besar. Maksimal 2MB.');
                    input.value = '';
                    preview.style.display = 'none';
                    return;
                }

                // Validate file type
                const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                if (!allowedTypes.includes(file.type)) {
                    alert('Format file tidak didukung. Gunakan JPG, JPEG, PNG, atau GIF.');
                    input.value = '';
                    preview.style.display = 'none';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        }
    </script>
@endsection
