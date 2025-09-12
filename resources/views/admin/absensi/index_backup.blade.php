@extends('layouts.navbar_admin')

@section('title', 'Kelola Absensi Karyawan')

@push('styles')
    <style>
        /* CSS VARIABLES FOR ORANGE THEME */
        :root {
            --table-bg: #ffffff;
            --table-text: #1e293b;
            --table-header-bg: #fff3e0;
            --table-border: #ffb74d;
            --primary-color: #ff6b35;
            --secondary-color: #f7931e;
            --card-bg: #ffffff;
            --card-text: #1e293b;
            --card-border: #ffb74d;
        }

        body.dark-mode {
            --table-bg: #2a1810 !important;
            --table-text: #ffeaa7 !important;
            --table-header-bg: #3a2419 !important;
            --table-border: #5a3625 !important;
            --primary-color: #ff6b35 !important;
            --secondary-color: #f7931e !important;
            --card-bg: #2a1810 !important;
            --card-text: #ffeaa7 !important;
            --card-border: #5a3625 !important;
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

        .new-card {
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--card-border);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .new-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .stats-card {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 24px;
            text-align: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--card-border);
            position: relative;
            overflow: hidden;
            height: 140px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .stats-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
        }

        .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
            color: white;
            font-size: 24px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 4px;
            color: var(--card-text);
            line-height: 1;
        }

        .stats-label {
            font-size: 0.9rem;
            color: #64748b;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stats-label {
            font-size: 1rem;
            font-weight: 500;
            color: #718096;
            margin-bottom: 8px;
        }

        .stats-status {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .stats-status.active {
            color: #10b981;
        }

        .stats-status.warning {
            color: #f59e0b;
        }

        .stats-status.info {
            color: #3b82f6;
        }

        .stats-status.secondary {
            color: #6b7280;
        }

        /* Icon colors - Orange Theme */
        .icon-users {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
        }

        .icon-user-x {
            background: linear-gradient(135deg, #ff8f00 0%, #ff6f00 100%);
        }

        .icon-calendar {
            background: linear-gradient(135deg, #ffb74d 0%, #ffa726 100%);
        }

        .icon-heart {
            background: linear-gradient(135deg, #ff5722 0%, #d84315 100%);
        }

        /* TABLE STYLING */
        .table {
            background: var(--table-bg);
            color: var(--table-text);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .table th {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            font-weight: 600;
            border: none;
            padding: 16px 12px;
            text-align: center;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table td {
            padding: 16px 12px;
            vertical-align: middle;
            border-color: var(--table-border);
            color: var(--table-text);
            background: var(--table-bg);
        }

        .table tbody tr {
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background-color: rgba(255, 107, 53, 0.05) !important;
            transform: scale(1.01);
        }

        /* SEARCH AND FILTER STYLING */
        .search-box {
            border-radius: 12px;
            border: 2px solid var(--card-border);
            padding: 12px 16px;
            background: var(--card-bg);
            color: var(--card-text);
            transition: all 0.3s ease;
        }

        .search-box:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        /* BUTTON STYLING */
        .btn-modern {
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        /* RESPONSIVE DESIGN */
        @media (max-width: 768px) {
            .stats-card {
                height: 120px;
                padding: 16px;
            }

            .stats-icon {
                width: 50px;
                height: 50px;
                font-size: 20px;
            }

            .stats-number {
                font-size: 2rem;
            }

            .stats-label {
                font-size: 0.8rem;
            }
        }

        /* DARK MODE OVERRIDES */
        body.dark-mode .new-card,
        body.dark-mode .new-card *:not(.badge):not(.btn) {
            background: var(--card-bg) !important;
            color: var(--card-text) !important;
            border-color: var(--card-border) !important;
        }

        body.dark-mode .table,
        body.dark-mode .table *,
        body.dark-mode .table-responsive {
            background: var(--table-bg) !important;
            color: var(--table-text) !important;
            border-color: var(--table-border) !important;
        }

        .table tbody tr:hover {
            background-color: #f8f9fc;
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-hadir {
            background-color: #d4edda;
            color: #155724;
        }

        .status-alfa {
            background-color: #f8d7da;
            color: #721c24;
        }

        .status-izin {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        .status-sakit {
            background-color: #e2e3e5;
            color: #383d41;
        }

        .filter-section {
            background-color: #fff3e0;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        /* Pagination Styling */
        .pagination-container {
            background-color: #fff3e0;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
        }

        .pagination-info {
            color: #6c757d;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .pagination .page-link {
            color: #ff6b35;
            border: 1px solid #ffb74d;
            padding: 8px 12px;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 6px;
            margin: 0 2px;
        }

        .pagination .page-link:hover {
            color: #f7931e;
            background-color: #fff3e0;
            border-color: #ff6b35;
        }

        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
            border-color: #ff6b35;
            color: white;
            font-weight: 600;
        }

        .pagination .page-item.disabled .page-link {
            color: #adb5bd;
            background-color: #f8f9fa;
            border-color: #e3e6f0;
        }

        /* Per page selector */
        .per-page-selector {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .per-page-selector select {
            width: auto;
            min-width: 80px;
        }

        /* Modern Data Table Styling - Orange Theme */
        .data-table-card {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(255, 107, 53, 0.15);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .table-header {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .table-header h5 {
            margin: 0;
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .table-body {
            background: white;
            padding: 0;
        }

        .modern-table {
            margin: 0;
            border: none;
            background: transparent;
        }

        .table-header-dark {
            background: linear-gradient(135deg, #d84315 0%, #bf360c 100%);
        }

        .table-header-dark th {
            background: transparent !important;
            color: white !important;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 1rem 0.75rem;
            border: none;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
        }

        .table-row-hover {
            transition: all 0.3s ease;
            border: none !important;
        }

        .table-row-hover:hover {
            background: linear-gradient(135deg, #fff3e0 0%, #ffe0b2 100%) !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(255, 107, 53, 0.1);
        }

        .table-row-hover td {
            border: none;
            border-bottom: 1px solid #f1f3f4;
            padding: 1rem 0.75rem;
            vertical-align: middle;
        }

        /* Action Buttons Styling */
        .action-buttons {
            display: flex;
            gap: 6px;
            justify-content: center;
            align-items: center;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .view-btn {
            background: linear-gradient(135deg, #ffb74d 0%, #ffa726 100%);
            color: white;
        }

        .view-btn:hover {
            background: linear-gradient(135deg, #ffa726 0%, #ff9800 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 183, 77, 0.4);
        }

        .edit-btn {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
            color: white;
        }

        .edit-btn:hover {
            background: linear-gradient(135deg, #f7931e 0%, #f57c00 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 107, 53, 0.4);
        }

        /* Empty State Styling */
        .empty-state {
            padding: 3rem 1rem !important;
            text-align: center;
            background: linear-gradient(135deg, #fff3e0 0%, #ffe0b2 100%);
            border: none !important;
        }

        .empty-content {
            max-width: 300px;
            margin: 0 auto;
        }

        .empty-icon {
            font-size: 3rem;
            color: #cbd5e0;
            margin-bottom: 1rem;
        }

        .empty-title {
            color: #4a5568;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .empty-subtitle {
            color: #718096;
            font-size: 0.9rem;
            margin: 0;
        }

        /* MATCHING PENGGAJIAN STYLES */
        .new-penggajian-dashboard {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 50%, #4facfe 100%) !important;
            min-height: 100vh !important;
            padding: 0 !important;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
            overflow-x: hidden !important;
            width: 100% !important;
            margin: 0 !important;
        }

        body.dark-mode .new-penggajian-dashboard {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 50%, #ffb74d 100%) !important;
        }

        .new-header {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%) !important;
            color: white !important;
            padding: 35px 40px !important;
            border-radius: 15px !important;
            margin-bottom: 35px !important;
            box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3) !important;
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
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.15) !important;
        }

        .new-stat-icon {
            background: linear-gradient(135deg, #ff6b35, #f7931e) !important;
            color: white !important;
            border-radius: 15px !important;
            width: 55px !important;
            height: 55px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            font-size: 20px !important;
            margin-bottom: 15px !important;
            box-shadow: 0 4px 12px rgba(255, 107, 53, 0.3) !important;
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

        /* Cards - Orange Colorful Style */
        .new-card {
            background: rgba(255, 255, 255, 0.95) !important;
            border-radius: 15px !important;
            box-shadow: 0 8px 32px rgba(255, 107, 53, 0.15) !important;
            border: 1px solid rgba(255, 107, 53, 0.2) !important;
            overflow: hidden !important;
            transition: all 0.3s ease !important;
            backdrop-filter: blur(10px) !important;
        }

        .new-card:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 12px 40px rgba(255, 107, 53, 0.25) !important;
        }

        body.dark-mode .new-card {
            background: rgba(42, 24, 16, 0.9) !important;
            border-color: rgba(255, 107, 53, 0.3) !important;
            backdrop-filter: blur(15px) !important;
        }

        .new-card-header {
            background: linear-gradient(135deg, rgba(255, 107, 53, 0.1) 0%, rgba(247, 147, 30, 0.1) 100%) !important;
            padding: 20px 25px !important;
            border-bottom: 1px solid rgba(255, 107, 53, 0.2) !important;
            backdrop-filter: blur(5px) !important;
        }

        body.dark-mode .new-card-header {
            background: linear-gradient(135deg, rgba(255, 107, 53, 0.2) 0%, rgba(247, 147, 30, 0.2) 100%) !important;
            border-color: rgba(255, 107, 53, 0.3) !important;
        }

        .new-card-title {
            font-size: 1.1rem !important;
            font-weight: 600 !important;
            color: #1e293b !important;
            margin: 0 !important;
            display: flex !important;
            align-items: center !important;
            gap: 8px !important;
        }

        body.dark-mode .new-card-title {
            color: #e2e8f0 !important;
        }

        .new-card-body {
            padding: 25px !important;
        }

        /* Table Styling - Orange Colorful Style */
        .table thead {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%) !important;
        }

        .table thead th {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%) !important;
            color: white !important;
            font-weight: 600;
            border: none;
            padding: 16px 12px;
            text-align: center;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 4px rgba(255, 107, 53, 0.2);
        }

        .table tbody {
            background: rgba(255, 255, 255, 0.95) !important;
        }

        .table tbody tr {
            background: rgba(255, 255, 255, 0.95) !important;
            color: #2d3748 !important;
            border: none;
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%) !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.1);
        }

        .table tbody td {
            background: transparent !important;
            color: #2d3748 !important;
            border-color: rgba(255, 107, 53, 0.1) !important;
            padding: 16px 12px;
            vertical-align: middle;
        }

        /* Gear Dropdown Styling - Orange Colorful */
        .gear-dropdown {
            border: 2px solid rgba(255, 107, 53, 0.3) !important;
            background: linear-gradient(135deg, rgba(255, 107, 53, 0.1) 0%, rgba(247, 147, 30, 0.1) 100%) !important;
            color: #ff6b35 !important;
            border-radius: 12px !important;
            padding: 8px 12px !important;
            transition: all 0.3s ease !important;
            position: relative !important;
            min-width: 40px !important;
            height: 36px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            backdrop-filter: blur(5px) !important;
        }

        .gear-dropdown:hover {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%) !important;
            border-color: #ff6b35 !important;
            color: white !important;
            transform: translateY(-2px) rotate(90deg) !important;
            box-shadow: 0 8px 20px rgba(255, 107, 53, 0.3) !important;
        }

        body.dark-mode .gear-dropdown {
            background: linear-gradient(135deg, rgba(255, 107, 53, 0.2) 0%, rgba(247, 147, 30, 0.2) 100%) !important;
            border-color: rgba(255, 107, 53, 0.4) !important;
            color: #ffb74d !important;
        }

        body.dark-mode .gear-dropdown:hover {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%) !important;
            border-color: #ffb74d !important;
            color: white !important;
        }

        /* Pagination */
        .pagination-container {
            background: #f8fafc !important;
            border-radius: 8px !important;
            padding: 15px !important;
            margin-top: 20px !important;
        }

        body.dark-mode .pagination-container {
            background: #374151 !important;
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

        /* NUCLEAR OPTION - FORCE COLORFUL TABLE STYLE */
        #absensi-table-wrapper,
        #absensi-table,
        #absensi-table thead,
        #absensi-table tbody,
        #absensi-table tr,
        #absensi-table td,
        #absensi-table th {
            border-radius: 12px !important;
        }

        #absensi-table thead th {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%) !important;
            color: white !important;
            box-shadow: 0 2px 4px rgba(255, 107, 53, 0.2) !important;
        }

        #absensi-table tbody {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px) !important;
        }

        #absensi-table tbody tr {
            background: rgba(255, 255, 255, 0.95) !important;
            color: #2d3748 !important;
        }

        #absensi-table tbody tr:hover {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%) !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.1) !important;
        }

        /* Force all text elements inside table cells to be dark colored for readability */
        #absensi-table td small,
        #absensi-table td div,
        #absensi-table td strong,
        #absensi-table td span:not(.badge) {
            color: #2d3748 !important;
        }

        /* Ensure muted text is properly colored */
        #absensi-table .text-muted {
            color: #64748b !important;
        }

        /* Dark mode overrides */
        body.dark-mode #absensi-table tbody {
            background: rgba(42, 45, 63, 0.9) !important;
        }

        body.dark-mode #absensi-table tbody tr {
            background: rgba(42, 45, 63, 0.9) !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode #absensi-table td small,
        body.dark-mode #absensi-table td div,
        body.dark-mode #absensi-table td strong,
        body.dark-mode #absensi-table td span:not(.badge) {
            color: #e2e8f0 !important;
        }

        body.dark-mode #absensi-table .text-muted {
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

        /* RESET ALL CONFLICTS - COLORFUL DASHBOARD */
        .main-content {
            margin-left: 250px !important;
            padding: 25px 35px !important;
            background: transparent !important;
            min-height: 100vh !important;
            width: calc(100% - 250px) !important;
            box-sizing: border-box !important;
            position: relative !important;
            overflow-x: hidden !important;
        }

        /* DARK MODE OVERRIDE FOR MAIN CONTENT */
        body.dark-mode .main-content {
            background: transparent !important;
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
    </style>

    <div class="new-penggajian-dashboard">
        <!-- Header Section -->
        <div class="new-header">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h1><i class="fas fa-clock me-3"></i>Absen Karyawan</h1>
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
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal"
                                        value="{{ request('tanggal') }}">
                                </div>
                                <div class="col-md-2 mb-3">
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
                                <div class="col-md-2 mb-3">
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
                                <div class="col-md-3 mb-3">
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
                                <div class="col-md-2 mb-3">
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
                            <table class="table table-bordered" id="absensi-table" width="100%" cellspacing="0">
                                <thead style="background: #3a3d4a !important;">
                                    <tr>
                                        <th
                                            style="width: 5%; background: #3a3d4a !important; color: #94a3b8 !important; text-align: center;">
                                            #</th>
                                        <th style="width: 15%; background: #3a3d4a !important; color: #94a3b8 !important;">
                                            Nama Karyawan</th>
                                        <th
                                            style="width: 10%; background: #3a3d4a !important; color: #94a3b8 !important; text-align: center;">
                                            Tanggal</th>
                                        <th
                                            style="width: 8%; background: #3a3d4a !important; color: #94a3b8 !important; text-align: center;">
                                            Masuk</th>
                                        <th
                                            style="width: 8%; background: #3a3d4a !important; color: #94a3b8 !important; text-align: center;">
                                            Keluar</th>
                                        <th
                                            style="width: 10%; background: #3a3d4a !important; color: #94a3b8 !important; text-align: center;">
                                            Status</th>
                                        <th
                                            style="width: 10%; background: #3a3d4a !important; color: #94a3b8 !important; text-align: center;">
                                            Shift</th>
                                        <th style="width: 20%; background: #3a3d4a !important; color: #94a3b8 !important;">
                                            Keterangan</th>
                                        <th
                                            style="width: 14%; background: #3a3d4a !important; color: #94a3b8 !important; text-align: center;">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody style="background: #2a2d3f !important;">
                                    @forelse($absensi as $index => $item)
                                        <tr style="background: #2a2d3f !important; color: #e2e8f0 !important;">
                                            <td
                                                style="background: transparent !important; color: #e2e8f0 !important; text-align: center;">
                                                {{ $absensi->firstItem() + $index }}</td>
                                            <td style="background: transparent !important; color: #e2e8f0 !important;">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-initial rounded-circle bg-primary text-white me-2"
                                                        style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; font-size: 12px;">
                                                        {{ strtoupper(substr($item->karyawan->nama ?? 'N/A', 0, 2)) }}
                                                    </div>
                                                    <div>
                                                        <div class="fw-bold" style="color: #e2e8f0 !important;">
                                                            {{ $item->karyawan->nama ?? 'N/A' }}</div>
                                                        <small
                                                            style="color: #94a3b8 !important;">{{ $item->karyawan->jabatan->nama_jabatan ?? 'N/A' }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td
                                                style="background: transparent !important; color: #e2e8f0 !important; text-align: center;">
                                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}
                                            </td>
                                            <td
                                                style="background: transparent !important; color: #e2e8f0 !important; text-align: center;">
                                                @if ($item->jam_masuk)
                                                    <span
                                                        class="badge bg-success">{{ \Carbon\Carbon::parse($item->jam_masuk)->format('H:i') }}</span>
                                                @else
                                                    <span style="color: #94a3b8 !important;">-</span>
                                                @endif
                                            </td>
                                            <td
                                                style="background: transparent !important; color: #e2e8f0 !important; text-align: center;">
                                                @if ($item->jam_keluar)
                                                    <span
                                                        class="badge bg-info">{{ \Carbon\Carbon::parse($item->jam_keluar)->format('H:i') }}</span>
                                                @else
                                                    <span style="color: #94a3b8 !important;">-</span>
                                                @endif
                                            </td>
                                            <td
                                                style="background: transparent !important; color: #e2e8f0 !important; text-align: center;">
                                                @php
                                                    $statusClass = 'status-hadir';
                                                    switch (strtolower($item->status)) {
                                                        case 'alfa':
                                                        case 'alpa':
                                                            $statusClass = 'status-alfa';
                                                            break;
                                                        case 'izin':
                                                            $statusClass = 'status-izin';
                                                            break;
                                                        case 'sakit':
                                                            $statusClass = 'status-sakit';
                                                            break;
                                                    }
                                                @endphp
                                                <span class="status-badge {{ $statusClass }}">{{ $item->status }}</span>
                                            </td>
                                            <td
                                                style="background: transparent !important; color: #e2e8f0 !important; text-align: center;">
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
                                                        <i class="fas fa-cog"></i>
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

                // Force colorful table styling
                function forceColorfulTable() {
                    console.log('Applying colorful table styling...');

                    const table = document.querySelector('#absensi-table');
                    const wrapper = document.querySelector('#absensi-table-wrapper');

                    if (table && wrapper) {
                        // Force header gradient - Orange Theme
                        table.querySelectorAll('thead th').forEach(th => {
                            th.style.background = 'linear-gradient(135deg, #ff6b35 0%, #f7931e 100%)';
                            th.style.color = 'white';
                            th.style.boxShadow = '0 2px 4px rgba(255, 107, 53, 0.2)';
                        });

                        // Force body styling
                        const tbody = table.querySelector('tbody');
                        if (tbody) {
                            if (document.body.classList.contains('dark-mode')) {
                                tbody.style.background = 'rgba(42, 24, 16, 0.9)';
                                tbody.style.backdropFilter = 'blur(10px)';
                            } else {
                                tbody.style.background = 'rgba(255, 255, 255, 0.95)';
                                tbody.style.backdropFilter = 'blur(10px)';
                            }
                        }

                        // Force row styling
                        table.querySelectorAll('tbody tr').forEach(tr => {
                            if (document.body.classList.contains('dark-mode')) {
                                tr.style.background = 'rgba(42, 24, 16, 0.9)';
                                tr.style.color = '#ffeaa7';
                            } else {
                                tr.style.background = 'rgba(255, 255, 255, 0.95)';
                                tr.style.color = '#2d3748';
                            }
                        });

                        // Force text elements inside cells
                        table.querySelectorAll('td small, td div, td strong, td span:not(.badge)').forEach(el => {
                            if (document.body.classList.contains('dark-mode')) {
                                el.style.color = '#e2e8f0';
                            } else {
                                el.style.color = '#2d3748';
                            }
                        });

                        // Force muted text
                        table.querySelectorAll('.text-muted').forEach(el => {
                            if (document.body.classList.contains('dark-mode')) {
                                el.style.color = '#94a3b8';
                            } else {
                                el.style.color = '#64748b';
                            }
                        });

                        console.log('Colorful table styling applied');
                    }
                }

                // Run immediately
                forceColorfulTable();

                // Run every 500ms to catch dynamic changes
                const tableInterval = setInterval(forceColorfulTable, 500);

                // Stop after 10 seconds to prevent infinite loop
                setTimeout(() => clearInterval(tableInterval), 10000);

                // Listen for dark mode toggle
                const observer = new MutationObserver(function(mutations) {
                    mutations.forEach(function(mutation) {
                        if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                            console.log('Body class changed, applying colorful styling...');
                            setTimeout(forceColorfulTable, 50);
                        }
                    });
                });

                observer.observe(document.body, {
                    attributes: true,
                    attributeFilter: ['class']
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

            function changePerPage(value) {
                // Get current URL parameters
                const urlParams = new URLSearchParams(window.location.search);

                // Update per_page parameter
                urlParams.set('per_page', value);

                // Remove page parameter to go back to first page
                urlParams.delete('page');

                // Redirect to new URL
                window.location.href = window.location.pathname + '?' + urlParams.toString();
            }

            // Make functions globally available
            window.viewDetail = viewDetail;
            window.editAbsensi = editAbsensi;
            window.changePerPage = changePerPage;
        </script>
    @endpush
