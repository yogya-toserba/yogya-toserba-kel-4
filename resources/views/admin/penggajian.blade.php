@extends('layouts.navbar_admin')

@section('title', 'Manajemen Penggajian - MyYOGYA')

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

/* Dark Mode Support */
body.dark-mode .main-content {
    background: #1a1d29 !important;
}

/* FORCE NEW DASHBOARD STYLES */
.new-dashboard {
    background: #f8fafc !important;
    min-height: 100vh !important;
    padding: 0 !important;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
    overflow-x: hidden !important;
    width: 100% !important;
}

body.dark-mode .new-dashboard {
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

.new-stats {
    margin-bottom: 30px !important;
}

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

body.dark-mode .new-stat-card {
    background: #2a2d3f !important;
    border-color: #3a3d4a !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3) !important;
}

.new-stat-card:hover {
    transform: translateY(-5px) !important;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

body.dark-mode .new-stat-card:hover {
    box-shadow: 0 8px 25px rgba(0,0,0,0.4) !important;
}

.new-stat-number {
    font-size: 2.2rem !important;
    font-weight: bold !important;
    color: #f26b37 !important;
    margin-bottom: 8px !important;
    line-height: 1 !important;
    text-align: center !important;
}

body.dark-mode .new-stat-number {
    color: #ff7849 !important;
}

.new-stat-label {
    font-size: 0.95rem !important;
    color: #64748b !important;
    font-weight: 500 !important;
    text-align: center !important;
    margin-bottom: 12px !important;
}

body.dark-mode .new-stat-label {
    color: #94a3b8 !important;
}

.new-stat-icon {
    width: 45px !important;
    height: 45px !important;
    background: linear-gradient(135deg, #f26b37, #e55827) !important;
    border-radius: 10px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    color: white !important;
    font-size: 1.1rem !important;
    margin: 0 auto 15px auto !important;
}

.new-stat-card small {
    display: block !important;
    margin-top: 12px !important;
    font-weight: 500 !important;
    text-align: center !important;
    line-height: 1.2 !important;
}

.new-stat-card small i {
    margin-right: 4px !important;
}

.new-card {
    background: white !important;
    border-radius: 15px !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
    border: 1px solid #e2e8f0 !important;
    overflow: hidden !important;
    margin-bottom: 25px !important;
}

body.dark-mode .new-card {
    background: #2a2d3f !important;
    border-color: #3a3d4a !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3) !important;
}

.new-card-header {
    padding: 20px 25px !important;
    background: #f8fafc !important;
    border-bottom: 1px solid #e2e8f0 !important;
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
}

body.dark-mode .new-card-header {
    background: #1f2937 !important;
    border-bottom-color: #374151 !important;
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
    color: #f1f5f9 !important;
}

.new-card-body {
    padding: 25px !important;
}

/* Table Card Specific Styling */
.table-card {
    height: 520px;
    display: flex;
    flex-direction: column;
}

.table-card .new-card-body {
    padding: 20px !important;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.table-content {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.table-card .table-responsive {
    flex-grow: 1;
    overflow: hidden;
    min-height: 300px;
    margin-bottom: 15px;
}

.table-card .table {
    margin-bottom: 0;
}

.table-card tbody tr {
    height: 60px;
}

.table-card .table th,
.table-card .table td {
    padding: 8px 12px;
    vertical-align: middle;
    border-color: #374151;
}

.table-card .table-header-cell {
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.table-card .table-data-cell {
    font-size: 0.8rem;
}

.summary-section {
    margin-top: auto;
    padding-top: 15px;
    flex-shrink: 0;
}

/* Action buttons styling */
.action-buttons {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 20px;
}

.action-buttons .btn {
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
    border: none;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.action-buttons .btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
}

.quick-stats {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    margin-top: 20px;
}

.quick-stats-item {
    background: #f8fafc;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 6px;
}

.quick-stats-item:last-child {
    margin-bottom: 0;
}

.quick-stats-item.green {
    border-left: 4px solid #10b981;
}

.quick-stats-item.orange {
    border-left: 4px solid #f26b37;
}

.quick-stats-label {
    font-size: 0.7rem;
    color: #64748b;
    margin-bottom: 2px;
}

.quick-stats-value {
    font-size: 0.9rem;
    font-weight: 700;
}

.quick-stats-value.green {
    color: #10b981;
}

.quick-stats-value.orange {
    color: #f26b37;
}

.stats-summary {
    background: #f8fafc;
    padding: 12px;
    border-radius: 8px;
    border-left: 4px solid #f26b37;
    text-align: center;
}

.stats-row {
    display: flex;
    justify-content: space-between;
}

.stats-item {
    flex: 1;
}

.stats-label {
    font-size: 0.7rem;
    color: #64748b;
    margin-bottom: 4px;
}

.stats-value {
    font-size: 1rem;
    font-weight: 700;
    color: #1f2937;
}

.stats-value.success {
    color: #10b981;
}

/* Dark Mode for Table Cards */
body.dark-mode .quick-stats-item {
    background: #111827 !important;
}

body.dark-mode .stats-summary {
    background: #111827 !important;
}

body.dark-mode .quick-stats-label,
body.dark-mode .stats-label {
    color: #9ca3af !important;
}

body.dark-mode .stats-value {
    color: #f9fafb !important;
}

body.dark-mode .stats-value.success {
    color: #10b981 !important;
}

body.dark-mode .quick-stats-value.green {
    color: #10b981 !important;
}

body.dark-mode .quick-stats-value.orange {
    color: #f26b37 !important;
}

/* Search and Filter */
.search-filter-bar {
    background: white !important;
    padding: 15px 25px !important;
    border-radius: 15px !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
    border: 1px solid #e2e8f0 !important;
    margin-bottom: 25px !important;
}

body.dark-mode .search-filter-bar {
    background: #2a2d3f !important;
    border-color: #3a3d4a !important;
}

/* Row spacing fix */
.search-filter-bar .row {
    margin: 0 !important;
}

.search-filter-bar .col-md-3 {
    padding: 0 10px !important;
    margin-bottom: 0 !important;
}

.search-filter-bar .col-lg-3 {
    padding: 0 10px !important;
    margin-bottom: 0 !important;
}

.search-filter-bar .col-lg-2 {
    padding: 0 10px !important;
    margin-bottom: 0 !important;
}

.search-filter-bar .col-md-6 {
    padding: 0 10px !important;
    margin-bottom: 15px !important;
}

/* Label styling */
.search-filter-bar .form-label {
    margin-bottom: 3px !important;
    font-size: 0.85rem !important;
    font-weight: 600 !important;
    color: #64748b !important;
    display: block !important;
}

body.dark-mode .search-filter-bar .form-label {
    color: #e2e8f0 !important;
}

/* Input Group Styling */
.input-group-text {
    background: #f8fafc !important;
    border: 2px solid #e2e8f0 !important;
    border-right: none !important;
    color: #64748b !important;
    font-size: 0.85rem !important;
    padding: 10px 12px !important;
    border-radius: 8px 0 0 8px !important;
}

body.dark-mode .input-group-text {
    background: #374151 !important;
    border-color: #4b5563 !important;
    color: #9ca3af !important;
}

/* Form Controls */
.form-control {
    border: 2px solid #e2e8f0 !important;
    border-left: none !important;
    border-radius: 0 8px 8px 0 !important;
    padding: 10px 12px !important;
    font-size: 0.85rem !important;
    height: 42px !important;
    transition: all 0.2s ease !important;
    color: #1f2937 !important;
}

.form-control:hover {
    border-color: #cbd5e1 !important;
}

.form-control:focus {
    border-color: #f26b37 !important;
    box-shadow: 0 0 0 0.2rem rgba(242, 107, 55, 0.25) !important;
    outline: none !important;
}

body.dark-mode .form-control {
    background: #374151 !important;
    border-color: #4b5563 !important;
    color: #e2e8f0 !important;
}

body.dark-mode .form-control:hover {
    border-color: #6b7280 !important;
}

body.dark-mode .form-control:focus {
    border-color: #f26b37 !important;
}

/* Special styling for search input */
.search-filter-bar input[type="text"].form-control {
    font-style: italic !important;
}

.search-filter-bar input[type="text"].form-control:focus {
    font-style: normal !important;
}

.search-filter-bar input[type="text"].form-control::placeholder {
    color: #9ca3af !important;
    font-style: italic !important;
}

body.dark-mode .search-filter-bar input[type="text"].form-control::placeholder {
    color: #6b7280 !important;
}

/* Button Modern - Smaller Size */
.btn-modern {
    background: #f26b37 !important;
    color: white !important;
    border: none !important;
    padding: 10px 16px !important;
    border-radius: 8px !important;
    font-weight: 600 !important;
    font-size: 0.85rem !important;
    height: 42px !important;
    transition: all 0.3s ease !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 6px !important;
    box-shadow: 0 2px 8px rgba(242, 107, 55, 0.3) !important;
}

.btn-modern:hover {
    transform: none !important;
    box-shadow: 0 4px 12px rgba(242, 107, 55, 0.4) !important;
    color: white !important;
    background: #e55827 !important;
}

/* Table checkbox styling */
.table-checkbox {
    width: 18px !important;
    height: 18px !important;
    border: 2px solid #cbd5e1 !important;
    border-radius: 4px !important;
    cursor: pointer !important;
    transition: all 0.2s ease !important;
    margin: 0 auto !important;
    display: block !important;
}

.table-checkbox:checked {
    background-color: #f26b37 !important;
    border-color: #f26b37 !important;
}

.table-checkbox:focus {
    box-shadow: 0 0 0 2px rgba(242, 107, 55, 0.2) !important;
    border-color: #f26b37 !important;
}

body.dark-mode .table-checkbox {
    border-color: #4b5563 !important;
    background-color: #374151 !important;
}

body.dark-mode .table-checkbox:checked {
    background-color: #f26b37 !important;
    border-color: #f26b37 !important;
}

/* Checkbox column alignment */
.table-header-cell:first-child,
.table-data-cell:first-child {
    text-align: center !important;
    padding: 12px 8px !important;
}

/* Header Button Styling - Match Filter Button Size */
.btn-header {
    padding: 10px 16px !important;
    border-radius: 8px !important;
    font-weight: 600 !important;
    font-size: 0.85rem !important;
    height: 42px !important;
    transition: all 0.3s ease !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 6px !important;
}

.btn-modern.btn-header {
    background: #f26b37 !important;
    color: white !important;
    border: none !important;
    box-shadow: 0 2px 8px rgba(242, 107, 55, 0.3) !important;
}

.btn-modern.btn-header:hover {
    transform: none !important;
    box-shadow: 0 4px 12px rgba(242, 107, 55, 0.4) !important;
    color: white !important;
    background: #e55827 !important;
}

.btn-outline-modern.btn-header {
    background: transparent !important;
    color: #f26b37 !important;
    border: 2px solid #f26b37 !important;
    box-shadow: 0 2px 8px rgba(242, 107, 55, 0.2) !important;
}

.btn-outline-modern.btn-header:hover {
    background: #f26b37 !important;
    color: white !important;
    transform: none !important;
    box-shadow: 0 4px 12px rgba(242, 107, 55, 0.4) !important;
}

/* Reset Button Styling */
.btn-outline-secondary {
    border: 2px solid #e2e8f0 !important;
    color: #64748b !important;
    background: transparent !important;
    border-radius: 8px !important;
    padding: 8px 12px !important;
    height: 42px !important;
    width: 42px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    transition: all 0.2s ease !important;
}

.btn-outline-secondary:hover {
    background: #f8fafc !important;
    border-color: #cbd5e1 !important;
    color: #475569 !important;
    transform: none !important;
}

body.dark-mode .btn-outline-secondary {
    border-color: #4b5563 !important;
    color: #9ca3af !important;
}

body.dark-mode .btn-outline-secondary:hover {
    background: #374151 !important;
    border-color: #6b7280 !important;
    color: #d1d5db !important;
}

/* Transparent label for button alignment */
.text-transparent {
    opacity: 0 !important;
    visibility: hidden !important;
}

/* Additional spacing fixes */
.search-filter-bar .input-group {
    width: 100% !important;
}

.search-filter-bar .btn {
    white-space: nowrap !important;
}

.btn-outline-modern {
    background: transparent !important;
    color: #f26b37 !important;
    border: 2px solid #f26b37 !important;
    padding: 10px 18px !important;
    border-radius: 8px !important;
    font-weight: 600 !important;
    transition: all 0.3s ease !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 8px !important;
}

.btn-outline-modern:hover {
    background: #f26b37 !important;
    color: white !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 4px 12px rgba(242, 107, 55, 0.3) !important;
}

.modern-table {
    width: 100% !important;
    border-collapse: collapse !important;
}

.modern-table th {
    background: #f8fafc !important;
    padding: 15px !important;
    text-align: left !important;
    font-weight: 600 !important;
    color: #374151 !important;
    border: none !important;
    border-bottom: 2px solid #e5e7eb !important;
    font-size: 0.9rem !important;
}

body.dark-mode .modern-table th {
    background: #1f2937 !important;
    color: #d1d5db !important;
    border-bottom-color: #374151 !important;
}

.modern-table td {
    padding: 15px !important;
    border: none !important;
    border-bottom: 1px solid #f1f5f9 !important;
    color: #374151 !important;
    font-size: 0.9rem !important;
}

body.dark-mode .modern-table td {
    color: #d1d5db !important;
    border-bottom-color: #374151 !important;
}

.modern-table tbody tr:hover {
    background: #f8fafc !important;
}

body.dark-mode .modern-table tbody tr:hover {
    background: #1f2937 !important;
}

.status-badge {
    padding: 6px 14px !important;
    border-radius: 20px !important;
    font-size: 0.75rem !important;
    font-weight: 600 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
}

.status-paid {
    background: linear-gradient(135deg, #d1fae5, #a7f3d0) !important;
    color: #065f46 !important;
    border: 1px solid #a7f3d0 !important;
}

.status-pending {
    background: linear-gradient(135deg, #fef3c7, #fde68a) !important;
    color: #92400e !important;
    border: 1px solid #fde68a !important;
}

.status-processing {
    background: linear-gradient(135deg, #dbeafe, #bfdbfe) !important;
    color: #1e40af !important;
    border: 1px solid #bfdbfe !important;
}

.salary-amount {
    font-size: 1.05rem !important;
    font-weight: 700 !important;
    color: #059669 !important;
}

body.dark-mode .salary-amount {
    color: #10b981 !important;
}

.profile-avatar {
    width: 40px !important;
    height: 40px !important;
    border-radius: 50% !important;
    background: linear-gradient(135deg, #f26b37, #e55827) !important;
    color: white !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-weight: bold !important;
    margin-right: 12px !important;
    font-size: 0.9rem !important;
}

.overtime-badge {
    background: #fef3c7 !important;
    color: #92400e !important;
    padding: 2px 8px !important;
    border-radius: 10px !important;
    font-size: 0.7rem !important;
    font-weight: 500 !important;
}

/* Responsive adjustments to match dashboard */
@media (max-width: 1200px) {
    .main-content {
        margin-left: 0 !important;
        width: 100% !important;
        padding: 20px !important;
    }
}

/* Action Dropdown Styling */
.action-dropdown {
    position: relative !important;
    display: inline-block !important;
}

.action-dropdown-btn {
    background: transparent !important;
    border: none !important;
    padding: 8px 12px !important;
    color: #6b7280 !important;
    border-radius: 6px !important;
    cursor: pointer !important;
    transition: all 0.2s ease !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    width: 36px !important;
    height: 36px !important;
}

.action-dropdown-btn:hover {
    background: #f3f4f6 !important;
    color: #374151 !important;
}

body.dark-mode .action-dropdown-btn {
    color: #9ca3af !important;
}

body.dark-mode .action-dropdown-btn:hover {
    background: #374151 !important;
    color: #d1d5db !important;
}

.action-dropdown-menu {
    position: absolute !important;
    top: 100% !important;
    right: 0 !important;
    background: white !important;
    border: 1px solid #e5e7eb !important;
    border-radius: 8px !important;
    padding: 8px 0 !important;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06) !important;
    z-index: 50 !important;
    min-width: 150px !important;
    display: none !important;
}

body.dark-mode .action-dropdown-menu {
    background: #374151 !important;
    border-color: #4b5563 !important;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3), 0 2px 4px -1px rgba(0, 0, 0, 0.2) !important;
}

.action-dropdown:hover .action-dropdown-menu {
    display: block !important;
}

.action-dropdown-item {
    display: flex !important;
    align-items: center !important;
    padding: 8px 16px !important;
    color: #374151 !important;
    text-decoration: none !important;
    font-size: 0.875rem !important;
    border: none !important;
    background: transparent !important;
    width: 100% !important;
    text-align: left !important;
    cursor: pointer !important;
    transition: all 0.2s ease !important;
}

.action-dropdown-item:hover {
    background: #f3f4f6 !important;
    color: #1f2937 !important;
}

body.dark-mode .action-dropdown-item {
    color: #d1d5db !important;
}

body.dark-mode .action-dropdown-item:hover {
    background: #4b5563 !important;
    color: #f9fafb !important;
}

/* Dark Mode Table Fixes - More Specific */
body.dark-mode .table {
    color: #e5e7eb !important;
}

body.dark-mode .table thead th {
    background: #1f2937 !important;
    color: #9ca3af !important;
    border-bottom: 1px solid #374151 !important;
}

body.dark-mode .table tbody tr {
    border-bottom: 1px solid #374151 !important;
}

body.dark-mode .table tbody td {
    color: #e5e7eb !important;
    border: none !important;
}

body.dark-mode .table tbody tr:hover {
    background: #1f2937 !important;
}

/* Dark mode for inline styled elements */
body.dark-mode td div[style*="color: #1f2937"] {
    color: #f1f5f9 !important;
}

body.dark-mode td div[style*="color: #374151"] {
    color: #d1d5db !important;
}

body.dark-mode td small[style*="color: #6b7280"] {
    color: #9ca3af !important;
}

body.dark-mode th[style*="color: #64748b"] {
    color: #9ca3af !important;
    background: #1f2937 !important;
}

body.dark-mode .profile-avatar {
    background: linear-gradient(135deg, #ff7849, #f26b37) !important;
}

/* Badge colors for dark mode */
body.dark-mode .badge {
    border: none !important;
}

/* Status badge styling - ensure text is visible */
.badge {
    padding: 4px 12px !important;
    border-radius: 16px !important;
    font-size: 0.75rem !important;
    font-weight: 600 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.3px !important;
    display: inline-block !important;
    min-width: 70px !important;
    text-align: center !important;
    line-height: 1.2 !important;
}

/* Override Bootstrap badge defaults */
.badge[style*="background:"], .badge[style*="color:"] {
    opacity: 1 !important;
    visibility: visible !important;
}

body.dark-mode .badge[style*="background:"], body.dark-mode .badge[style*="color:"] {
    opacity: 1 !important;
    visibility: visible !important;
}

/* Ensure badge text is always visible */
.table-data-cell .badge {
    background-color: inherit !important;
    color: inherit !important;
    text-shadow: none !important;
    position: relative !important;
    z-index: 1 !important;
}

body.dark-mode .table-data-cell .badge {
    background-color: inherit !important;
    color: inherit !important;
    text-shadow: none !important;
}

/* Pagination Styles */
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

/* Status Badge Styles - Match Data Karyawan */
.badge-paid {
    background: #dcfce7 !important;
    color: #15803d !important;
    font-weight: 500 !important;
    padding: 6px 12px !important;
    border-radius: 20px !important;
    font-size: 0.75rem !important;
    text-transform: uppercase !important;
    letter-spacing: 0.3px !important;
}

.badge-pending {
    background: #fef3c7 !important;
    color: #f59e0b !important;
    font-weight: 500 !important;
    padding: 6px 12px !important;
    border-radius: 20px !important;
    font-size: 0.75rem !important;
    text-transform: uppercase !important;
    letter-spacing: 0.3px !important;
}

.badge-process {
    background: #dbeafe !important;
    color: #2563eb !important;
    font-weight: 500 !important;
    padding: 6px 12px !important;
    border-radius: 20px !important;
    font-size: 0.75rem !important;
    text-transform: uppercase !important;
    letter-spacing: 0.3px !important;
}

/* Dark mode status badges */
body.dark-mode .badge-paid {
    background: #065f46 !important;
    color: #dcfce7 !important;
}

body.dark-mode .badge-pending {
    background: #92400e !important;
    color: #fef3c7 !important;
}

body.dark-mode .badge-process {
    background: #1e40af !important;
    color: #dbeafe !important;
}

/* Summary tables dark mode */
body.dark-mode .table-responsive {
    background: transparent !important;
}

body.dark-mode .new-card {
    background: #374151 !important;
    border-color: #4b5563 !important;
}

body.dark-mode .new-card-header {
    background: #4b5563 !important;
    border-bottom-color: #6b7280 !important;
}

body.dark-mode .new-card-title {
    color: #f3f4f6 !important;
}

/* Override inline styles in dark mode */
body.dark-mode td[style*="border: none"] {
    border-bottom: 1px solid #374151 !important;
}

body.dark-mode tr[style*="border-bottom: 1px solid #e2e8f0"] {
    border-bottom: 1px solid #374151 !important;
}

/* Table Header Cell Styling */
.table-header-cell {
    font-size: 0.8rem !important;
    font-weight: 600 !important;
    color: #64748b !important;
    border: none !important;
    background: white !important;
    padding: 12px 0 !important;
}

body.dark-mode .table-header-cell {
    color: #9ca3af !important;
    background: #1f2937 !important;
}

/* Table Data Cell Styling */
.table-data-cell {
    font-size: 0.85rem !important;
    border: none !important;
    padding: 12px 0 !important;
}

body.dark-mode .table-data-cell {
    color: #e5e7eb !important;
}

/* Text color overrides for dark mode */
body.dark-mode .employee-name {
    color: #f1f5f9 !important;
}

body.dark-mode .employee-details {
    color: #9ca3af !important;
}

body.dark-mode .branch-name {
    color: #d1d5db !important;
}

/* Table Row Styling */
.table-row {
    border-bottom: 1px solid #e2e8f0 !important;
    transition: background-color 0.2s ease !important;
}

body.dark-mode .table-row {
    border-bottom: 1px solid #374151 !important;
}

.table-row:hover {
    background-color: #f8fafc !important;
}

body.dark-mode .table-row:hover {
    background-color: #1f2937 !important;
}

/* Force dark mode styling for table elements */
body.dark-mode .new-card {
    background: #2a2d3f !important;
    border-color: #3a3d4a !important;
    color: #e2e8f0 !important;
}

body.dark-mode .new-card-header {
    background: #1f2937 !important;
    border-bottom-color: #374151 !important;
    color: #e2e8f0 !important;
}

body.dark-mode .new-card-title {
    color: #f1f5f9 !important;
}

body.dark-mode .search-filter-bar {
    background: #2a2d3f !important;
    border-color: #3a3d4a !important;
    color: #e2e8f0 !important;
}

body.dark-mode .table,
body.dark-mode .table-sm {
    background: #2a2d3f !important;
    color: #e5e7eb !important;
}

/* Override Bootstrap table styling specifically */
body.dark-mode .table > :not(caption) > * > * {
    background-color: #2a2d3f !important;
    border-bottom-color: #374151 !important;
    color: #e5e7eb !important;
}

body.dark-mode thead th {
    color: #9ca3af !important;
    background: #1f2937 !important;
    border-bottom: 1px solid #374151 !important;
}

body.dark-mode tbody tr {
    border-bottom: 1px solid #374151 !important;
}

body.dark-mode tbody td {
    color: #e5e7eb !important;
    border: none !important;
}

body.dark-mode .profile-avatar {
    background: linear-gradient(135deg, #ff7849, #f26b37) !important;
}

/* Badge colors for dark mode */
body.dark-mode .badge {
    border: none !important;
}

/* Text colors in dark mode */
body.dark-mode td strong,
body.dark-mode td span {
    color: inherit !important;
}

body.dark-mode td small {
    color: #9ca3af !important;
}
    }
}

@media (max-width: 768px) {
    .filter-grid {
        grid-template-columns: 1fr !important;
    }
    
    .new-card-header {
        padding: 15px 20px !important;
        flex-direction: column !important;
        gap: 10px !important;
    }
    
    .new-header {
        padding: 25px 20px !important;
    }
    
    .new-header h1 {
        font-size: 2rem !important;
    }
    
    .search-filter-bar .row {
        flex-direction: column !important;
    }
    
    .search-filter-bar .col-md-3,
    .search-filter-bar .col-lg-3,
    .search-filter-bar .col-lg-2,
    .search-filter-bar .col-md-6 {
        width: 100% !important;
        margin-bottom: 15px !important;
        padding: 0 12px !important;
    }
}
</style>

<div class="new-dashboard">
    <!-- Header Section -->
    <div class="new-header">
        <h1><i class="fas fa-money-check-alt me-3"></i>Manajemen Penggajian Karyawan</h1>
        <p>Kelola dan proses gaji karyawan MyYOGYA dengan sistem terintegrasi</p>
    </div>

    <!-- Stats Section -->
    <div class="row g-4 mb-5">
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="new-stat-label">Total Gaji Bulan Ini</div>
                <div class="new-stat-number">Rp 485.2M</div>
                <small style="color: #10b981; font-size: 0.7rem;">
                    <i class="fas fa-calendar-month"></i> Agustus 2025
                </small>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="new-stat-label">Sudah Dibayar</div>
                <div class="new-stat-number">189</div>
                <small style="color: #3b82f6; font-size: 0.7rem;">
                    <i class="fas fa-user-check"></i> Karyawan
                </small>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="new-stat-label">Pending Approval</div>
                <div class="new-stat-number">23</div>
                <small style="color: #f59e0b; font-size: 0.7rem;">
                    <i class="fas fa-hourglass-half"></i> Menunggu
                </small>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="new-stat-card">
                <div class="new-stat-icon">
                    <i class="fas fa-star"></i>
                </div>
                <div class="new-stat-label">Bonus & Lembur</div>
                <div class="new-stat-number">Rp 23.5M</div>
                <small style="color: #8b5cf6; font-size: 0.7rem;">
                    <i class="fas fa-plus-circle"></i> Tambahan
                </small>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="search-filter-bar">
        <div class="row g-2">
            <!-- Pencarian Nama -->
            <div class="col-lg-3 col-md-6">
                <label for="filter-nama" class="form-label">
                    <i class="fas fa-search me-1"></i>Cari Nama Karyawan
                </label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-user"></i>
                    </span>
                    <input type="text" id="filter-nama" class="form-control" placeholder="Masukkan nama karyawan...">
                </div>
            </div>
            
            <!-- Periode -->
            <div class="col-lg-2 col-md-6">
                <label for="filter-bulan" class="form-label">
                    <i class="fas fa-calendar me-1"></i>Periode
                </label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-calendar"></i>
                    </span>
                    <select id="filter-bulan" class="form-control">
                        <option>Agustus 2025</option>
                        <option>Juli 2025</option>
                        <option>Juni 2025</option>
                        <option>Mei 2025</option>
                    </select>
                </div>
            </div>
            
            <!-- Cabang -->
            <div class="col-lg-2 col-md-6">
                <label for="filter-cabang" class="form-label">
                    <i class="fas fa-building me-1"></i>Cabang
                </label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-building"></i>
                    </span>
                    <select id="filter-cabang" class="form-control">
                        <option>Semua Cabang</option>
                        <option>Yogyakarta Pusat</option>
                        <option>Solo</option>
                        <option>Semarang</option>
                        <option>Magelang</option>
                    </select>
                </div>
            </div>
            
            <!-- Status -->
            <div class="col-lg-2 col-md-6">
                <label for="filter-status" class="form-label">
                    <i class="fas fa-check-circle me-1"></i>Status
                </label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-check-circle"></i>
                    </span>
                    <select id="filter-status" class="form-control">
                        <option>Semua Status</option>
                        <option>Sudah Dibayar</option>
                        <option>Pending</option>
                        <option>Diproses</option>
                    </select>
                </div>
            </div>
            
            <!-- Filter Button -->
            <div class="col-lg-3 col-md-12">
                <label class="form-label" style="opacity: 0; height: 1.25rem;">Filter</label>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-modern flex-grow-1">
                        <i class="fas fa-search me-1"></i>Filter
                    </button>
                    <button type="button" class="btn btn-outline-secondary" title="Reset Filter">
                        <i class="fas fa-refresh"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Penggajian Table -->
    <div class="new-card">
        <div class="new-card-header">
            <h5 class="new-card-title">
                <i class="fas fa-calculator"></i>
                Daftar Penggajian Karyawan - Agustus 2025
            </h5>
            <div class="d-flex gap-2">
                <button class="btn btn-modern btn-header">
                    <i class="fas fa-credit-card me-1"></i>
                    Proses Pembayaran
                </button>
                <button class="btn btn-outline-modern btn-header">
                    <i class="fas fa-download me-1"></i>
                    Export Slip Gaji
                </button>
            </div>
        </div>
        <div class="new-card-body">
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th class="table-header-cell" style="width: 60px;">
                                <input type="checkbox" class="form-check-input table-checkbox">
                            </th>
                            <th class="table-header-cell">Karyawan</th>
                            <th class="table-header-cell">Cabang</th>
                            <th class="table-header-cell">Gaji Pokok</th>
                            <th class="table-header-cell">Kehadiran</th>
                            <th class="table-header-cell">Potongan</th>
                            <th class="table-header-cell">Total Gaji</th>
                            <th class="table-header-cell" style="text-align: center;">Status</th>
                            <th class="table-header-cell" style="text-align: center; width: 60px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table-row">
                            <td class="table-data-cell" style="width: 60px;">
                                <input type="checkbox" class="form-check-input table-checkbox">
                            </td>
                            <td class="table-data-cell">
                                <div class="d-flex align-items-center">
                                    <div class="profile-avatar me-3">AS</div>
                                    <div>
                                        <div class="employee-name" style="font-weight: 600;">Andi Setiawan</div>
                                        <small class="employee-details">ID: EMP001 • Manager</small>
                                    </div>
                                </div>
                            </td>
                            <td class="table-data-cell">
                                <div class="branch-name" style="font-weight: 600;">Yogyakarta</div>
                                <small class="employee-details">Pusat</small>
                            </td>
                            <td class="table-data-cell">
                                <div style="color: #10b981; font-weight: 700; font-size: 1rem;">Rp 8,500,000</div>
                            </td>
                            <td class="table-data-cell">
                                <div style="color: #f59e0b; font-weight: 700;">22/22</div>
                                <small class="employee-details">15.5 jam • +Rp 387,500</small>
                            </td>
                            <td class="table-data-cell">
                                <div style="color: #dc2626; font-weight: 700;">-Rp 425,000</div>
                            </td>
                            <td class="table-data-cell">
                                <div style="color: #10b981; font-weight: 700; font-size: 1rem;">Rp 8,462,500</div>
                            </td>
                            <td class="table-data-cell" style="text-align: center;">
                                <span class="badge-paid">SELESAI</span>
                            </td>
                            <td class="table-data-cell" style="text-align: center; width: 60px;">
                                <div class="action-dropdown">
                                    <button class="action-dropdown-btn">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="action-dropdown-menu">
                                        <button class="action-dropdown-item">
                                            <i class="fas fa-eye me-2"></i>Lihat Detail
                                        </button>
                                        <button class="action-dropdown-item">
                                            <i class="fas fa-download me-2"></i>Download Slip
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        
                        <tr class="table-row">
                            <td class="table-data-cell" style="width: 60px;">
                                <input type="checkbox" class="form-check-input table-checkbox">
                            </td>
                            <td class="table-data-cell">
                                <div class="d-flex align-items-center">
                                    <div class="profile-avatar me-3">SP</div>
                                    <div>
                                        <div class="employee-name" style="font-weight: 600;">Sari Pertiwi</div>
                                        <small class="employee-details">ID: EMP002 • Admin</small>
                                    </div>
                                </div>
                            </td>
                            <td class="table-data-cell">
                                <div class="branch-name" style="font-weight: 600;">Solo</div>
                                <small class="employee-details">Cabang</small>
                            </td>
                            <td class="table-data-cell">
                                <div style="color: #10b981; font-weight: 700; font-size: 1rem;">Rp 4,500,000</div>
                            </td>
                            <td class="table-data-cell">
                                <div style="color: #f59e0b; font-weight: 700;">20/22</div>
                                <small class="employee-details">8.0 jam • +Rp 163,636</small>
                            </td>
                            <td class="table-data-cell">
                                <div style="color: #dc2626; font-weight: 700;">-Rp 225,000</div>
                            </td>
                            <td class="table-data-cell">
                                <div style="color: #10b981; font-weight: 700; font-size: 1rem;">Rp 4,438,636</div>
                            </td>
                            <td class="table-data-cell" style="text-align: center;">
                                <span class="badge-pending">MENUNGGU</span>
                            </td>
                            <td class="table-data-cell" style="text-align: center; width: 60px;">
                                <div class="action-dropdown">
                                    <button class="action-dropdown-btn">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="action-dropdown-menu">
                                        <button class="action-dropdown-item">
                                            <i class="fas fa-eye me-2"></i>Lihat Detail
                                        </button>
                                        <button class="action-dropdown-item">
                                            <i class="fas fa-check me-2"></i>Proses
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="table-row">
                            <td class="table-data-cell" style="width: 60px;">
                                <input type="checkbox" class="form-check-input table-checkbox">
                            </td>
                            <td class="table-data-cell">
                                <div class="d-flex align-items-center">
                                    <div class="profile-avatar me-3">BW</div>
                                    <div>
                                        <div class="employee-name" style="font-weight: 600;">Budi Wijaya</div>
                                        <small class="employee-details">ID: EMP003 • Security</small>
                                    </div>
                                </div>
                            </td>
                            <td class="table-data-cell">
                                <div class="branch-name" style="font-weight: 600;">Semarang</div>
                                <small class="employee-details">Cabang</small>
                            </td>
                            <td class="table-data-cell">
                                <div style="color: #10b981; font-weight: 700; font-size: 1rem;">Rp 3,800,000</div>
                            </td>
                            <td class="table-data-cell">
                                <div style="color: #10b981; font-weight: 700;">22/22</div>
                                <small class="employee-details">12.0 jam • +Rp 207,273</small>
                            </td>
                            <td class="table-data-cell">
                                <div style="color: #dc2626; font-weight: 700;">-Rp 190,000</div>
                            </td>
                            <td class="table-data-cell">
                                <div style="color: #10b981; font-weight: 700; font-size: 1rem;">Rp 3,817,273</div>
                            </td>
                            <td class="table-data-cell" style="text-align: center;">
                                <span class="badge-process">DIPROSES</span>
                            </td>
                            <td class="table-data-cell" style="text-align: center; width: 60px;">
                                <div class="action-dropdown">
                                    <button class="action-dropdown-btn">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="action-dropdown-menu">
                                        <button class="action-dropdown-item">
                                            <i class="fas fa-eye me-2"></i>Lihat Detail
                                        </button>
                                        <button class="action-dropdown-item">
                                            <i class="fas fa-cog me-2"></i>Proses
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="table-row">
                            <td class="table-data-cell" style="width: 60px;">
                                <input type="checkbox" class="form-check-input table-checkbox">
                            </td>
                            <td class="table-data-cell">
                                <div class="d-flex align-items-center">
                                    <div class="profile-avatar me-3">LM</div>
                                    <div>
                                        <div class="employee-name" style="font-weight: 600;">Linda Maharani</div>
                                        <small class="employee-details">ID: EMP004 • Kasir</small>
                                    </div>
                                </div>
                            </td>
                            <td class="table-data-cell">
                                <div class="branch-name" style="font-weight: 600;">Magelang</div>
                                <small class="employee-details">Cabang</small>
                            </td>
                            <td class="table-data-cell">
                                <div style="color: #10b981; font-weight: 700; font-size: 1rem;">Rp 3,200,000</div>
                            </td>
                            <td class="table-data-cell">
                                <div style="color: #dc2626; font-weight: 700;">18/22</div>
                                <small class="employee-details">5.0 jam • +Rp 72,727</small>
                            </td>
                            <td class="table-data-cell">
                                <div style="color: #dc2626; font-weight: 700;">-Rp 160,000</div>
                            </td>
                            <td class="table-data-cell">
                                <div style="color: #10b981; font-weight: 700; font-size: 1rem;">Rp 3,112,727</div>
                            </td>
                            <td class="table-data-cell" style="text-align: center;">
                                <span class="badge-paid">SELESAI</span>
                            </td>
                            <td class="table-data-cell" style="text-align: center; width: 60px;">
                                <div class="action-dropdown">
                                    <button class="action-dropdown-btn">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="action-dropdown-menu">
                                        <button class="action-dropdown-item">
                                            <i class="fas fa-eye me-2"></i>Lihat Detail
                                        </button>
                                        <button class="action-dropdown-item">
                                            <i class="fas fa-download me-2"></i>Download
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="table-row">
                            <td class="table-data-cell" style="width: 60px;">
                                <input type="checkbox" class="form-check-input table-checkbox">
                            </td>
                            <td class="table-data-cell">
                                <div class="d-flex align-items-center">
                                    <div class="profile-avatar me-3">RH</div>
                                    <div>
                                        <div class="employee-name" style="font-weight: 600;">Rudi Hermawan</div>
                                        <small class="employee-details">ID: EMP005 • Supervisor</small>
                                    </div>
                                </div>
                            </td>
                            <td class="table-data-cell">
                                <div class="branch-name" style="font-weight: 600;">Yogyakarta</div>
                                <small class="employee-details">Pusat</small>
                            </td>
                            <td class="table-data-cell">
                                <div style="color: #10b981; font-weight: 700; font-size: 1rem;">Rp 6,500,000</div>
                            </td>
                            <td class="table-data-cell">
                                <div style="color: #10b981; font-weight: 700;">22/22</div>
                                <small class="employee-details">20.0 jam • +Rp 590,909</small>
                            </td>
                            <td class="table-data-cell">
                                <div style="color: #dc2626; font-weight: 700;">-Rp 325,000</div>
                            </td>
                            <td class="table-data-cell">
                                <div style="color: #10b981; font-weight: 700; font-size: 1rem;">Rp 6,765,909</div>
                            </td>
                            <td class="table-data-cell" style="text-align: center;">
                                <span class="badge-pending">MENUNGGU</span>
                            </td>
                            <td class="table-data-cell" style="text-align: center; width: 60px;">
                                <div class="action-dropdown">
                                    <button class="action-dropdown-btn">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="action-dropdown-menu">
                                        <button class="action-dropdown-item">
                                            <i class="fas fa-eye me-2"></i>Lihat Detail
                                        </button>
                                        <button class="action-dropdown-item">
                                            <i class="fas fa-check me-2"></i>Proses
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                </tbody>
            </table>
            </div>

            <!-- Pagination -->
            <div class="pagination-container">
                <div class="pagination-info">
                    Menampilkan 1-5 dari 212 karyawan
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
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Tables -->
    <div class="row mt-4">
        <!-- Bulk Actions -->
        <div class="col-md-4">
            <div class="new-card table-card">
                <div class="new-card-header">
                    <h6 class="new-card-title">
                        <i class="fas fa-tools me-2"></i>
                        Panel Kontrol
                    </h6>
                </div>
                <div class="new-card-body">
                    <div class="action-buttons">
                        <button class="btn btn-success btn-header" style="font-size: 0.8rem; padding: 10px 16px;">
                            <i class="fas fa-check-double me-2"></i>
                            Approve Semua
                        </button>
                        <button class="btn btn-primary btn-header" style="font-size: 0.8rem; padding: 10px 16px;">
                            <i class="fas fa-credit-card me-2"></i>
                            Proses Pembayaran
                        </button>
                        <button class="btn btn-outline-modern btn-header" style="font-size: 0.8rem; padding: 10px 16px;">
                            <i class="fas fa-file-export me-2"></i>
                            Export Data
                        </button>
                    </div>
                    
                    <div class="quick-stats">
                        <h6 style="font-size: 0.8rem; color: #64748b; margin-bottom: 12px;">Quick Stats</h6>
                        <div class="quick-stats-item green">
                            <div class="quick-stats-label">Total Dipilih</div>
                            <div class="quick-stats-value green">0 karyawan</div>
                        </div>
                        <div class="quick-stats-item orange">
                            <div class="quick-stats-label">Estimasi Pembayaran</div>
                            <div class="quick-stats-value orange">Rp 0</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Financial Summary Table -->
        <div class="col-md-4">
            <div class="new-card table-card">
                <div class="new-card-header">
                    <h6 class="new-card-title">
                        <i class="fas fa-chart-bar me-2"></i>
                        Ringkasan Per Cabang
                    </h6>
                </div>
                <div class="new-card-body">
                    <div class="table-content">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th class="table-header-cell" style="font-size: 0.75rem;">Cabang</th>
                                        <th class="table-header-cell" style="font-size: 0.75rem; text-align: center;">Karyawan</th>
                                        <th class="table-header-cell" style="font-size: 0.75rem; text-align: center;">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="table-row">
                                        <td class="table-data-cell">
                                            <div style="font-weight: 600; color: #1f2937; font-size: 0.8rem;">Yogyakarta</div>
                                            <small style="color: #64748b; font-size: 0.7rem;">Pusat</small>
                                        </td>
                                        <td class="table-data-cell" style="text-align: center;">
                                            <div style="font-weight: 600; color: #1f2937; font-size: 0.8rem;">127</div>
                                        </td>
                                        <td class="table-data-cell" style="text-align: center;">
                                            <span class="badge-paid" style="font-size: 0.65rem; padding: 4px 10px;">SELESAI</span>
                                        </td>
                                    </tr>
                                    <tr class="table-row">
                                        <td class="table-data-cell">
                                            <div style="font-weight: 600; color: #1f2937; font-size: 0.8rem;">Solo</div>
                                            <small style="color: #64748b; font-size: 0.7rem;">Cabang</small>
                                        </td>
                                        <td class="table-data-cell" style="text-align: center;">
                                            <div style="font-weight: 600; color: #1f2937; font-size: 0.8rem;">89</div>
                                        </td>
                                        <td class="table-data-cell" style="text-align: center;">
                                            <span class="badge-pending" style="font-size: 0.65rem; padding: 4px 10px;">MENUNGGU</span>
                                        </td>
                                    </tr>
                                    <tr class="table-row">
                                        <td class="table-data-cell">
                                            <div style="font-weight: 600; color: #1f2937; font-size: 0.8rem;">Semarang</div>
                                            <small style="color: #64748b; font-size: 0.7rem;">Cabang</small>
                                        </td>
                                        <td class="table-data-cell" style="text-align: center;">
                                            <div style="font-weight: 600; color: #1f2937; font-size: 0.8rem;">73</div>
                                        </td>
                                        <td class="table-data-cell" style="text-align: center;">
                                            <span class="badge-process" style="font-size: 0.65rem; padding: 4px 10px;">DIPROSES</span>
                                        </td>
                                    </tr>
                                    <tr class="table-row">
                                        <td class="table-data-cell">
                                            <div style="font-weight: 600; color: #1f2937; font-size: 0.8rem;">Magelang</div>
                                            <small style="color: #64748b; font-size: 0.7rem;">Cabang</small>
                                        </td>
                                        <td class="table-data-cell" style="text-align: center;">
                                            <div style="font-weight: 600; color: #1f2937; font-size: 0.8rem;">56</div>
                                        </td>
                                        <td class="table-data-cell" style="text-align: center;">
                                            <span class="badge-paid" style="font-size: 0.65rem; padding: 4px 10px;">SELESAI</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="summary-section">
                            <div class="stats-summary">
                                <div class="stats-row">
                                    <div class="stats-item">
                                        <div class="stats-label">Total Karyawan</div>
                                        <div class="stats-value">345</div>
                                    </div>
                                    <div class="stats-item">
                                        <div class="stats-label">Total Gaji</div>
                                        <div class="stats-value success">2.09B</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment History Table -->
        <div class="col-md-4">
            <div class="new-card table-card">
                <div class="new-card-header">
                    <h6 class="new-card-title">
                        <i class="fas fa-history me-2"></i>
                        Riwayat Terbaru
                    </h6>
                </div>
                <div class="new-card-body">
                    <div class="table-content">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th class="table-header-cell" style="font-size: 0.75rem;">Tanggal</th>
                                        <th class="table-header-cell" style="font-size: 0.75rem; text-align: center;">Batch</th>
                                        <th class="table-header-cell" style="font-size: 0.75rem; text-align: center;">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="table-row">
                                        <td class="table-data-cell">
                                            <div style="font-weight: 600; color: #1f2937; font-size: 0.8rem;">31 Ags</div>
                                            <small style="color: #64748b; font-size: 0.7rem;">09:15</small>
                                        </td>
                                        <td class="table-data-cell" style="text-align: center;">
                                            <div style="font-weight: 600; color: #1f2937; font-size: 0.8rem;">#AGS001</div>
                                            <small style="color: #64748b; font-size: 0.7rem;">127 org</small>
                                        </td>
                                        <td class="table-data-cell" style="text-align: center;">
                                            <span class="badge-paid" style="font-size: 0.65rem; padding: 4px 10px;">BERHASIL</span>
                                        </td>
                                    </tr>
                                    <tr class="table-row">
                                        <td class="table-data-cell">
                                            <div style="font-weight: 600; color: #1f2937; font-size: 0.8rem;">30 Ags</div>
                                            <small style="color: #64748b; font-size: 0.7rem;">14:30</small>
                                        </td>
                                        <td class="table-data-cell" style="text-align: center;">
                                            <div style="font-weight: 600; color: #1f2937; font-size: 0.8rem;">#AGS002</div>
                                            <small style="color: #64748b; font-size: 0.7rem;">56 org</small>
                                        </td>
                                        <td class="table-data-cell" style="text-align: center;">
                                            <span class="badge-paid" style="font-size: 0.65rem; padding: 4px 10px;">BERHASIL</span>
                                        </td>
                                    </tr>
                                    <tr class="table-row">
                                        <td class="table-data-cell">
                                            <div style="font-weight: 600; color: #1f2937; font-size: 0.8rem;">29 Ags</div>
                                            <small style="color: #64748b; font-size: 0.7rem;">16:45</small>
                                        </td>
                                        <td class="table-data-cell" style="text-align: center;">
                                            <div style="font-weight: 600; color: #1f2937; font-size: 0.8rem;">#AGS003</div>
                                            <small style="color: #64748b; font-size: 0.7rem;">89 org</small>
                                        </td>
                                        <td class="table-data-cell" style="text-align: center;">
                                            <span class="badge-pending" style="font-size: 0.65rem; padding: 4px 10px;">MENUNGGU</span>
                                        </td>
                                    </tr>
                                    <tr class="table-row">
                                        <td class="table-data-cell">
                                            <div style="font-weight: 600; color: #1f2937; font-size: 0.8rem;">28 Ags</div>
                                            <small style="color: #64748b; font-size: 0.7rem;">11:20</small>
                                        </td>
                                        <td class="table-data-cell" style="text-align: center;">
                                            <div style="font-weight: 600; color: #1f2937; font-size: 0.8rem;">#AGS004</div>
                                            <small style="color: #64748b; font-size: 0.7rem;">73 org</small>
                                        </td>
                                        <td class="table-data-cell" style="text-align: center;">
                                            <span class="badge-process" style="font-size: 0.65rem; padding: 4px 10px;">DIPROSES</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="summary-section">
                            <button class="btn btn-modern btn-header w-100" style="font-size: 0.8rem; padding: 8px 12px;">
                                <i class="fas fa-eye me-2"></i>
                                Lihat Semua Riwayat
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of new-dashboard -->

<script>
// Select all functionality
document.addEventListener('DOMContentLoaded', function() {
    const selectAllCheckbox = document.querySelector('thead input[type="checkbox"]');
    const rowCheckboxes = document.querySelectorAll('tbody input[type="checkbox"]');
    
    selectAllCheckbox.addEventListener('change', function() {
        rowCheckboxes.forEach(checkbox => {
            checkbox.checked = selectAllCheckbox.checked;
        });
        updateBulkActionsVisibility();
    });
    
    rowCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateBulkActionsVisibility);
    });
    
    function updateBulkActionsVisibility() {
        const checkedBoxes = document.querySelectorAll('tbody input[type="checkbox"]:checked');
        const bulkActions = document.querySelector('.new-card .new-card-body');
        
        if (checkedBoxes.length > 0) {
            bulkActions.style.opacity = '1';
        } else {
            bulkActions.style.opacity = '0.7';
        }
    }
});

// Filter functionality
document.querySelector('.btn-modern').addEventListener('click', function() {
    console.log('Filtering salary data...');
    filterSalaryData();
});

// Search by name functionality
document.getElementById('filter-nama').addEventListener('keyup', function() {
    const searchTerm = this.value.toLowerCase();
    filterTableByName(searchTerm);
});

// Function to filter table by name
function filterTableByName(searchTerm) {
    const tableRows = document.querySelectorAll('.table tbody tr');
    
    tableRows.forEach(row => {
        const employeeName = row.querySelector('.employee-name');
        if (employeeName) {
            const name = employeeName.textContent.toLowerCase();
            if (name.includes(searchTerm) || searchTerm === '') {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    });
    
    // Update results count
    updateResultsCount();
}

// Function to filter all salary data
function filterSalaryData() {
    const periode = document.getElementById('filter-bulan').value;
    const cabang = document.getElementById('filter-cabang').value;
    const status = document.getElementById('filter-status').value;
    const nama = document.getElementById('filter-nama').value;
    
    console.log('Filtering with:', { periode, cabang, status, nama });
    
    // Apply all filters
    filterTableByName(nama.toLowerCase());
    // Add additional filtering logic here for other filters
    
    // Show notification
    showFilterNotification();
}

// Function to show filter notification
function showFilterNotification() {
    // Create temporary notification
    const notification = document.createElement('div');
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: #10b981;
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 9999;
        font-size: 0.9rem;
        font-weight: 500;
    `;
    notification.innerHTML = '<i class="fas fa-check me-2"></i>Filter berhasil diterapkan!';
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// Function to update results count
function updateResultsCount() {
    const visibleRows = document.querySelectorAll('.table tbody tr[style=""], .table tbody tr:not([style])');
    const totalRows = document.querySelectorAll('.table tbody tr').length;
    
    console.log(`Showing ${visibleRows.length} of ${totalRows} employees`);
}

// Reset filter functionality
document.querySelector('.btn-outline-secondary[title="Reset Filter"]').addEventListener('click', function() {
    // Reset all form fields
    document.getElementById('filter-nama').value = '';
    document.getElementById('filter-bulan').selectedIndex = 0;
    document.getElementById('filter-cabang').selectedIndex = 0;
    document.getElementById('filter-status').selectedIndex = 0;
    
    // Show all rows
    const tableRows = document.querySelectorAll('.table tbody tr');
    tableRows.forEach(row => {
        row.style.display = '';
    });
    
    // Show reset notification
    const notification = document.createElement('div');
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: #6b7280;
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 9999;
        font-size: 0.9rem;
        font-weight: 500;
    `;
    notification.innerHTML = '<i class="fas fa-refresh me-2"></i>Filter telah direset!';
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 2000);
});

// Action dropdown functionality
document.addEventListener('click', function(event) {
    const dropdowns = document.querySelectorAll('.action-dropdown-menu');
    
    // Hide all dropdowns when clicking outside
    if (!event.target.closest('.action-dropdown')) {
        dropdowns.forEach(dropdown => {
            dropdown.style.display = 'none';
        });
    }
});

// Toggle dropdown when button is clicked
document.querySelectorAll('.action-dropdown-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        const menu = this.nextElementSibling;
        const allMenus = document.querySelectorAll('.action-dropdown-menu');
        
        // Hide all other menus
        allMenus.forEach(m => {
            if (m !== menu) {
                m.style.display = 'none';
            }
        });
        
        // Toggle current menu
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    });
});

// Handle dropdown item clicks
document.querySelectorAll('.action-dropdown-item').forEach(item => {
    item.addEventListener('click', function() {
        const action = this.textContent.trim();
        console.log('Action clicked:', action);
        
        // Hide dropdown after click
        this.closest('.action-dropdown-menu').style.display = 'none';
    });
});
</script>
@endsection