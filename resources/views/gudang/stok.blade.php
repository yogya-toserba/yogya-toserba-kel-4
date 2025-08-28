@extends('layouts.appGudang')

@section('title', 'Manajemen Stok - MyYOGYA')

@section('content')
<style>
/* Modern Stok Styles - Same as Permintaan */
.stok-header {
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
    color: white;
    padding: 25px 30px;
    border-radius: 12px;
    margin-bottom: 25px;
    box-shadow: 0 4px 15px rgba(242, 107, 55, 0.3);
}

.stok-header h2 {
    font-size: 1.8rem;
    font-weight: 700;
    margin: 0;
}

.stok-header p {
    font-size: 1rem;
    opacity: 0.9;
    margin: 8px 0 0 0;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 25px;
}

.stat-card {
    background: #ffffff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    border-left: 4px solid #f26b37;
    transition: all 0.3s ease;
    border: 2px solid #f1f5f9;
}

.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    border-color: #e5e7eb;
}

body.dark-mode .stat-card {
    background: #2a2d3f;
    border-left-color: #f26b37;
    color: #e2e8f0;
    border-color: #3a3d4a;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
}

body.dark-mode .stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.4);
    border-color: #4a5568;
}

.stat-number {
    font-size: 1.8rem;
    font-weight: 700;
    color: #f26b37;
    margin-bottom: 5px;
}

.stat-label {
    font-size: 0.95rem;
    color: #6b7280;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

body.dark-mode .stat-label {
    color: #d1d5db;
}

.modern-card {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    border: 2px solid #e5e7eb;
    overflow: hidden;
    transition: all 0.3s ease;
}

.modern-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

body.dark-mode .modern-card {
    background: #2a2d3f;
    border-color: #3a3d4a;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
}

body.dark-mode .modern-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.4);
}

.card-header-modern {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    padding: 20px 25px;
    border-bottom: 2px solid #e5e7eb;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

body.dark-mode .card-header-modern {
    background: linear-gradient(135deg, #252837 0%, #2a2d47 100%);
    border-bottom-color: #3a3d4a;
}

.card-title-modern {
    font-size: 1.1rem;
    font-weight: 700;
    color: #374151;
    margin: 0;
    display: flex;
    align-items: center;
}

body.dark-mode .card-title-modern {
    color: #ffffff;
}

.modern-table {
    margin: 0;
}

.modern-table th {
    background: #f8fafc;
    border: none;
    padding: 15px;
    font-weight: 600;
    color: #374151;
    font-size: 0.9rem;
}

body.dark-mode .modern-table th {
    background: #252837;
    color: #e2e8f0;
}

.modern-table td {
    padding: 15px;
    border: none;
    border-bottom: 1px solid #f1f5f9;
    color: #374151;
}

body.dark-mode .modern-table td {
    border-bottom-color: #3a3d4a;
    color: #ffffff !important;
    background-color: #1e2139;
}

/* Enhanced Dark Mode Text Visibility */
body.dark-mode .modern-table td .fw-semibold,
body.dark-mode .modern-table td .fw-bold {
    color: #ffffff !important;
}

body.dark-mode .modern-table td small,
body.dark-mode .modern-table td .text-muted {
    color: #d1d5db !important;
}

body.dark-mode .modern-table td .text-success {
    color: #34d399 !important;
}

body.dark-mode .modern-table td .text-warning {
    color: #fbbf24 !important;
}

body.dark-mode .modern-table td .text-danger {
    color: #f87171 !important;
}

body.dark-mode .modern-table td .text-info {
    color: #60a5fa !important;
}

/* Badge colors in dark mode */
body.dark-mode .badge.bg-info {
    background-color: #2563eb !important;
    color: #ffffff !important;
}

body.dark-mode .badge.bg-warning {
    background-color: #d97706 !important;
    color: #ffffff !important;
}

body.dark-mode .badge.bg-success {
    background-color: #059669 !important;
    color: #ffffff !important;
}

.modern-table tbody tr:hover {
    background: #f8fafc;
    position: relative;
    z-index: 1;
}

body.dark-mode .modern-table tbody tr:hover {
    background: #2a2d47 !important;
    position: relative;
    z-index: 1;
}

/* Ensure dropdown stays above other rows */
.modern-table tbody tr {
    position: relative;
    z-index: 1;
}

.modern-table tbody tr:has(.action-dropdown .action-dropdown-menu[style*="block"]) {
    z-index: 9998 !important;
}

/* For browsers without :has() support */
.modern-table tbody tr.dropdown-active {
    z-index: 9998 !important;
}

/* Status Badge Dark Mode Improvements */
body.dark-mode .status-badge.status-tinggi {
    background: linear-gradient(135deg, #059669, #047857) !important;
    color: #ffffff !important;
}

body.dark-mode .status-badge.status-sedang {
    background: linear-gradient(135deg, #d97706, #b45309) !important;
    color: #ffffff !important;
}

body.dark-mode .status-badge.status-rendah {
    background: linear-gradient(135deg, #dc2626, #b91c1c) !important;
    color: #ffffff !important;
}

.btn-modern {
    background: linear-gradient(135deg, #f26b37, #e55827);
    color: white;
    border: 2px solid #f26b37;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 2px 8px rgba(242, 107, 55, 0.3);
}

.btn-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(242, 107, 55, 0.4);
    color: white;
    background: linear-gradient(135deg, #e55827, #d84315);
    border-color: #e55827;
}

.btn-outline-modern {
    background: transparent;
    color: #f26b37;
    border: 2px solid #f26b37;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-outline-modern:hover {
    background: #f26b37;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(242, 107, 55, 0.3);
}

.status-badge {
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border: 2px solid transparent;
    transition: all 0.3s ease;
}

.status-tinggi {
    background: linear-gradient(135deg, #dcfce7, #bbf7d0);
    color: #059669;
    border-color: #a7f3d0;
}

.status-sedang {
    background: linear-gradient(135deg, #fef3c7, #fde68a);
    color: #d97706;
    border-color: #fcd34d;
}

.status-rendah {
    background: linear-gradient(135deg, #fee2e2, #fecaca);
    color: #dc2626;
    border-color: #fca5a5;
}
}

body.dark-mode .status-tinggi {
    background: #14532d;
    color: #86efac;
}

body.dark-mode .status-sedang {
    background: #78350f;
    color: #fbbf24;
}

body.dark-mode .status-rendah {
    background: #7f1d1d;
    color: #fca5a5;
}

.filter-section {
    background: #ffffff;
    padding: 25px;
    border-radius: 12px;
    margin-bottom: 25px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    border: 2px solid #f1f5f9;
    transition: all 0.3s ease;
}

.filter-section:hover {
    box-shadow: 0 6px 20px rgba(0,0,0,0.12);
    border-color: #e5e7eb;
}

body.dark-mode .filter-section {
    background: #2a2d3f;
    border-color: #3a3d4a;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
}

body.dark-mode .filter-section:hover {
    box-shadow: 0 6px 20px rgba(0,0,0,0.4);
    border-color: #4a5568;
}

.filter-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    align-items: end;
}

.form-label-modern {
    font-weight: 600;
    color: #374151;
    margin-bottom: 8px;
}

body.dark-mode .form-label-modern {
    color: #e2e8f0;
}

.form-control-modern {
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    padding: 10px 12px;
    transition: all 0.3s ease;
    height: 48px;
    background: #ffffff;
    color: #374151;
    font-weight: 500;
}

.form-control-modern:focus {
    border-color: #f26b37;
    box-shadow: 0 0 0 3px rgba(242, 107, 55, 0.1);
    outline: none;
    background: #ffffff;
    color: #374151;
}

.form-control-modern::placeholder {
    color: #9ca3af;
    opacity: 0.8;
    font-weight: 400;
}

/* Select Dropdown Specific Styling */
.form-select.form-control-modern {
    background: #ffffff;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23374151' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m1 6 7 7 7-7'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 12px center;
    background-size: 16px 12px;
    padding-right: 40px;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    color: #374151;
    font-weight: 500;
}

.form-select.form-control-modern:focus {
    background: #ffffff;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23f26b37' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m1 6 7 7 7-7'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 12px center;
    background-size: 16px 12px;
    color: #374151;
}

.form-select.form-control-modern option {
    background: #ffffff;
    color: #374151;
    font-weight: 500;
}

/* Textarea Specific Styling */
textarea.form-control-modern {
    background: #ffffff;
    color: #374151;
    font-weight: 500;
    resize: vertical;
    min-height: 80px;
}

textarea.form-control-modern:focus {
    background: #ffffff;
    color: #374151;
}

/* Input Group Light Mode */
.input-group-text {
    background: #f8fafc;
    border: 2px solid #e5e7eb;
    color: #374151;
    font-weight: 600;
}

.input-group .form-control-modern {
    border-left: none;
}

.input-group .form-control-modern:focus {
    border-left: none;
}

/* Form Sections Light Mode */
.form-section {
    background: #f8fafc;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
}

.form-section-title {
    color: #374151;
    background: #ffffff;
    padding: 8px 12px;
    border-radius: 6px;
    margin-bottom: 15px;
    border-left: 4px solid #f26b37;
    font-weight: 600;
    display: flex;
    align-items: center;
}

.form-section-title i {
    margin-right: 8px;
    color: #f26b37;
}

/* Form Groups Light Mode */
.form-group-modern {
    margin-bottom: 20px;
}

.form-label-modern {
    color: #374151;
    font-weight: 600;
    margin-bottom: 8px;
    display: block;
}

/* Modal Light Mode */
.modal-content.modern-modal {
    background: #ffffff;
    border: 2px solid #e5e7eb;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}

.modal-header.modal-header-modern {
    background: linear-gradient(135deg, #f26b37, #e55827);
    border-bottom: 2px solid #e5e7eb;
    color: #ffffff;
}

.modal-body.modal-body-modern {
    background: #ffffff;
    color: #374151;
}

.modal-footer.modal-footer-modern {
    background: #f8fafc;
    border-top: 2px solid #e5e7eb;
}

body.dark-mode .form-control-modern {
    background: #2a2d47 !important;
    border: 2px solid #4a5568 !important;
    color: #ffffff !important;
    font-weight: 500 !important;
}

body.dark-mode .form-control-modern:focus {
    background: #2d3748 !important;
    border-color: #f26b37 !important;
    color: #ffffff !important;
    box-shadow: 0 0 0 0.2rem rgba(242, 107, 55, 0.25) !important;
    outline: none !important;
}

body.dark-mode .form-control-modern::placeholder {
    color: #cbd5e0 !important;
    opacity: 0.8 !important;
    font-weight: 400 !important;
}

body.dark-mode .form-select.form-control-modern {
    background: #2a2d47 !important;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m1 6 7 7 7-7'/%3e%3c/svg%3e") !important;
    background-repeat: no-repeat !important;
    background-position: right 12px center !important;
    background-size: 16px 12px !important;
    border: 2px solid #4a5568 !important;
    color: #ffffff !important;
    font-weight: 500 !important;
    padding-right: 40px !important;
    appearance: none !important;
    -webkit-appearance: none !important;
    -moz-appearance: none !important;
}

body.dark-mode .form-select.form-control-modern:focus {
    background: #2d3748 !important;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23f26b37' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m1 6 7 7 7-7'/%3e%3c/svg%3e") !important;
    background-repeat: no-repeat !important;
    background-position: right 12px center !important;
    background-size: 16px 12px !important;
    border-color: #f26b37 !important;
    color: #ffffff !important;
    box-shadow: 0 0 0 0.2rem rgba(242, 107, 55, 0.25) !important;
    outline: none !important;
}

body.dark-mode .form-select.form-control-modern option {
    background: #2a2d47 !important;
    color: #ffffff !important;
    font-weight: 500 !important;
}

/* Textarea Dark Mode */
body.dark-mode textarea.form-control-modern {
    background: #2a2d47 !important;
    border: 2px solid #4a5568 !important;
    color: #ffffff !important;
    font-weight: 500 !important;
    resize: vertical !important;
}

body.dark-mode textarea.form-control-modern:focus {
    background: #2d3748 !important;
    border-color: #f26b37 !important;
    color: #ffffff !important;
    box-shadow: 0 0 0 0.2rem rgba(242, 107, 55, 0.25) !important;
}

/* Input Group Dark Mode */
body.dark-mode .input-group-text {
    background: #4a5568 !important;
    border: 2px solid #4a5568 !important;
    color: #ffffff !important;
    font-weight: 600 !important;
}

body.dark-mode .input-group .form-control-modern {
    border-left: none !important;
}

body.dark-mode .input-group .form-control-modern:focus {
    border-left: none !important;
}

/* Button Dark Mode in Modal */
body.dark-mode .btn-modern {
    background: linear-gradient(135deg, #f26b37, #e55827) !important;
    border: 2px solid #f26b37 !important;
    color: #ffffff !important;
    font-weight: 600 !important;
}

body.dark-mode .btn-modern:hover {
    background: linear-gradient(135deg, #e55827, #d84315) !important;
    border-color: #e55827 !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 4px 12px rgba(242, 107, 55, 0.4) !important;
}

body.dark-mode .btn-outline-modern {
    background: transparent !important;
    border: 2px solid #4a5568 !important;
    color: #ffffff !important;
    font-weight: 600 !important;
}

body.dark-mode .btn-outline-modern:hover {
    background: #4a5568 !important;
    border-color: #4a5568 !important;
    color: #ffffff !important;
    transform: translateY(-2px) !important;
}

/* Close Button Dark Mode */
body.dark-mode .btn-close {
    filter: invert(1) grayscale(100%) brightness(200%) !important;
}

/* Form Labels Dark Mode */
body.dark-mode .form-label-modern {
    color: #ffffff !important;
}

body.dark-mode .form-section-title {
    color: #ffffff !important;
}

/* Modal Dark Mode Enhancements */
body.dark-mode .modal-backdrop {
    background-color: rgba(0, 0, 0, 0.8) !important;
}

body.dark-mode .modal-content.modern-modal {
    background: #1e2139 !important;
    border: 2px solid #3a3d4a !important;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5) !important;
}

body.dark-mode .modal-header.modal-header-modern {
    background: linear-gradient(135deg, #f26b37, #e55827) !important;
    border-bottom: 2px solid #3a3d4a !important;
    color: #ffffff !important;
}

body.dark-mode .modal-body.modal-body-modern {
    background: #1e2139 !important;
    color: #ffffff !important;
}

body.dark-mode .modal-footer.modal-footer-modern {
    background: #252837 !important;
    border-top: 2px solid #3a3d4a !important;
}

/* Form Section Dark Mode */
body.dark-mode .form-section {
    background: #252837 !important;
    border: 2px solid #3a3d4a !important;
    border-radius: 8px !important;
    padding: 20px !important;
    margin-bottom: 20px !important;
}

body.dark-mode .form-section-title {
    color: #ffffff !important;
    background: #2a2d47 !important;
    padding: 8px 12px !important;
    border-radius: 6px !important;
    margin-bottom: 15px !important;
    border-left: 4px solid #f26b37 !important;
}

/* Enhanced Form Group Styling */
body.dark-mode .form-group-modern {
    margin-bottom: 20px !important;
}

body.dark-mode .form-label-modern {
    color: #ffffff !important;
    font-weight: 600 !important;
    margin-bottom: 8px !important;
    display: block !important;
}

/* Action Dropdown Styles */
.action-dropdown {
    position: relative;
    display: inline-block;
    z-index: 1000 !important;
}

/* Ensure table cells don't interfere with dropdown */
.modern-table td {
    position: relative;
    z-index: 1;
}

.modern-table td:has(.action-dropdown) {
    overflow: visible !important;
    z-index: 1001 !important;
}

/* Alternative for browsers that don't support :has() */
.modern-table td:last-child {
    overflow: visible !important;
    z-index: 1001 !important;
}

/* Ensure table container doesn't clip dropdown */
.table-responsive {
    overflow: visible !important;
}

.modern-card {
    overflow: visible !important;
}

.action-btn {
    background: #f8fafc;
    border: 2px solid #e5e7eb;
    color: #374151;
    padding: 6px 10px;
    border-radius: 6px;
    cursor: pointer !important;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 35px;
    height: 35px;
    z-index: 100 !important;
    position: relative !important;
    pointer-events: auto !important;
    user-select: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    outline: none;
}

.action-btn:focus {
    outline: 2px solid #f26b37;
    outline-offset: 2px;
}

.action-btn:hover {
    background: #f26b37;
    color: white;
    border-color: #f26b37;
    transform: scale(1.05);
}

.action-btn:active {
    transform: scale(0.98);
}

.action-btn.active {
    background: #f26b37 !important;
    color: white !important;
    border-color: #f26b37 !important;
}

body.dark-mode .action-btn.active {
    background: #f26b37 !important;
    color: white !important;
    border-color: #f26b37 !important;
}

body.dark-mode .action-btn {
    background: #252837;
    border-color: #3a3d4a;
    color: #e2e8f0;
    z-index: 100 !important;
    position: relative !important;
    pointer-events: auto !important;
    cursor: pointer !important;
}

body.dark-mode .action-btn:focus {
    outline: 2px solid #f26b37;
    outline-offset: 2px;
}

body.dark-mode .action-btn:hover {
    background: #f26b37;
    color: white;
    border-color: #f26b37;
    transform: scale(1.05);
}

body.dark-mode .action-btn:active {
    transform: scale(0.98);
}

.action-dropdown-menu {
    position: absolute;
    top: 100%;
    right: 0;
    background: white;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.25);
    min-width: 180px;
    display: none;
    z-index: 9999 !important;
    overflow: visible;
    transform: translateY(2px);
}

body.dark-mode .action-dropdown-menu {
    background: #2a2d3f;
    border-color: #3a3d4a;
    box-shadow: 0 8px 25px rgba(0,0,0,0.5);
}

.action-dropdown-menu.show {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.action-dropdown-item {
    padding: 10px 15px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
    color: #374151;
    text-decoration: none;
    border-bottom: 1px solid #f1f5f9;
}

.action-dropdown-item:last-child {
    border-bottom: none;
}

.action-dropdown-item:hover {
    background: #f8fafc;
    color: #f26b37;
}

body.dark-mode .action-dropdown-item {
    color: #ffffff !important;
    border-bottom-color: #3a3d4a;
}

body.dark-mode .action-dropdown-item:hover {
    background: #2a2d47 !important;
    color: #f26b37 !important;
}

.action-dropdown-item i {
    width: 16px;
    text-align: center;
}

@media (max-width: 768px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .filter-grid {
        grid-template-columns: 1fr;
    }
    
    .card-header-modern {
        padding: 15px 20px;
        flex-direction: column;
        gap: 10px;
    }
}
</style>

<div class="stok-container">
    <!-- Header Section -->
    <div class="stok-header">
        <h2>Manajemen Stok Barang</h2>
        <p>Kelola dan pantau stok barang di gudang pusat MyYOGYA</p>
    </div>

    <!-- Stats Section -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number">1,245</div>
            <div class="stat-label">Total Item</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">156</div>
            <div class="stat-label">Stok Menipis</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">89</div>
            <div class="stat-label">Stok Habis</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">1.2M</div>
            <div class="stat-label">Total Nilai (Rp)</div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <div class="filter-grid">
            <div>
                <label class="form-label-modern">Kategori</label>
                <select class="form-control form-control-modern">
                    <option>Semua Kategori</option>
                    <option>Sembako</option>
                    <option>Minuman</option>
                    <option>Snack</option>
                    <option>Perawatan</option>
                </select>
            </div>
            <div>
                <label class="form-label-modern">Status Stok</label>
                <select class="form-control form-control-modern">
                    <option>Semua Status</option>
                    <option>Stok Aman</option>
                    <option>Stok Menipis</option>
                    <option>Stok Habis</option>
                </select>
            </div>
            <div>
                <label class="form-label-modern">Pencarian</label>
                <input type="text" class="form-control form-control-modern" placeholder="Nama barang...">
            </div>
            <div>
                <label class="form-label-modern">&nbsp;</label>
                <button class="btn btn-modern w-100 form-control-modern" style="height: 48px;">
                    <i class="fas fa-search"></i>
                    Cari
                </button>
            </div>
        </div>
    </div>

    <!-- Main Table -->
    <div class="modern-card">
        <div class="card-header-modern">
            <h5 class="card-title-modern">
                <i class="fas fa-boxes" style="color: #f26b37; margin-right: 10px;"></i>
                Daftar Stok Barang
            </h5>
            <div class="d-flex gap-2">
                <button class="btn btn-modern" data-bs-toggle="modal" data-bs-target="#modalTambahStok">
                    <i class="fas fa-plus"></i>
                    Tambah Stok
                </button>
                <button class="btn btn-outline-modern">
                    <i class="fas fa-download"></i>
                    Export
                </button>
                <button class="btn btn-outline-modern">
                    <i class="fas fa-sync-alt"></i>
                    Refresh
                </button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table modern-table">
                <thead>
                    <tr>
                        <th>Tanggal Update</th>
                        <th>Kode/Nama Produk</th>
                        <th>Kategori</th>
                        <th>Stok Tersedia</th>
                        <th>Harga</th>
                        <th>Status Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div>13 Agustus 2025</div>
                            <small class="text-muted">09:30 WIB</small>
                        </td>
                        <td>
                            <div class="fw-semibold">#PRD001</div>
                            <div>Indomie Goreng</div>
                            <small class="text-muted">Kemasan Dus (40 pcs)</small>
                        </td>
                        <td>
                            <span class="badge bg-info">Sembako</span>
                        </td>
                        <td>
                            <div class="fw-bold text-success">100 Dus</div>
                            <small class="text-muted">= 4,000 pcs</small>
                        </td>
                        <td>
                            <div class="fw-semibold">Beli: Rp 85,000</div>
                            <div class="text-success">Jual: Rp 120,000</div>
                        </td>
                        <td>
                            <span class="status-badge status-tinggi">Stok Aman</span>
                        </td>
                        <td>
                            <div class="action-dropdown">
                                <button class="action-btn" onclick="toggleActionDropdown(this)">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="action-dropdown-menu">
                                    <a href="#" class="action-dropdown-item">
                                        <i class="fas fa-eye"></i>
                                        Lihat Detail
                                    </a>
                                    <a href="#" class="action-dropdown-item">
                                        <i class="fas fa-edit"></i>
                                        Edit Stok
                                    </a>
                                    <a href="#" class="action-dropdown-item">
                                        <i class="fas fa-plus"></i>
                                        Tambah Stok
                                    </a>
                                    <a href="#" class="action-dropdown-item">
                                        <i class="fas fa-minus"></i>
                                        Kurangi Stok
                                    </a>
                                    <a href="#" class="action-dropdown-item">
                                        <i class="fas fa-history"></i>
                                        Riwayat
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>13 Agustus 2025</div>
                            <small class="text-muted">08:15 WIB</small>
                        </td>
                        <td>
                            <div class="fw-semibold">#PRD002</div>
                            <div>Sabun Lifebuoy</div>
                            <small class="text-muted">Kemasan Dus (24 pcs)</small>
                        </td>
                        <td>
                            <span class="badge bg-warning">Perawatan</span>
                        </td>
                        <td>
                            <div class="fw-bold text-warning">25 Dus</div>
                            <small class="text-muted">= 600 pcs</small>
                        </td>
                        <td>
                            <div class="fw-semibold">Beli: Rp 45,000</div>
                            <div class="text-success">Jual: Rp 65,000</div>
                        </td>
                        <td>
                            <span class="status-badge status-sedang">Stok Menipis</span>
                        </td>
                        <td>
                            <div class="action-dropdown">
                                <button class="action-btn" onclick="toggleActionDropdown(this)">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="action-dropdown-menu">
                                    <a href="#" class="action-dropdown-item">
                                        <i class="fas fa-eye"></i>
                                        Lihat Detail
                                    </a>
                                    <a href="#" class="action-dropdown-item">
                                        <i class="fas fa-edit"></i>
                                        Edit Stok
                                    </a>
                                    <a href="#" class="action-dropdown-item">
                                        <i class="fas fa-plus"></i>
                                        Tambah Stok
                                    </a>
                                    <a href="#" class="action-dropdown-item">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        Set Alert
                                    </a>
                                    <a href="#" class="action-dropdown-item">
                                        <i class="fas fa-shopping-cart"></i>
                                        Pesan Ulang
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>12 Agustus 2025</div>
                            <small class="text-muted">16:45 WIB</small>
                        </td>
                        <td>
                            <div class="fw-semibold">#PRD003</div>
                            <div>Teh Pucuk Harum</div>
                            <small class="text-muted">Kemasan Dus (24 botol)</small>
                        </td>
                        <td>
                            <span class="badge bg-success">Minuman</span>
                        </td>
                        <td>
                            <div class="fw-bold text-danger">0 Dus</div>
                            <small class="text-muted">Stok Kosong</small>
                        </td>
                        <td>
                            <div class="fw-semibold">Beli: Rp 35,000</div>
                            <div class="text-success">Jual: Rp 48,000</div>
                        </td>
                        <td>
                            <span class="status-badge status-rendah">Stok Habis</span>
                        </td>
                        <td>
                            <div class="action-dropdown">
                                <button class="action-btn" onclick="toggleActionDropdown(this)">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="action-dropdown-menu">
                                    <a href="#" class="action-dropdown-item">
                                        <i class="fas fa-eye"></i>
                                        Lihat Detail
                                    </a>
                                    <a href="#" class="action-dropdown-item">
                                        <i class="fas fa-plus"></i>
                                        Restok Urgent
                                    </a>
                                    <a href="#" class="action-dropdown-item">
                                        <i class="fas fa-shopping-cart"></i>
                                        Pesan Segera
                                    </a>
                                    <a href="#" class="action-dropdown-item">
                                        <i class="fas fa-bell"></i>
                                        Notifikasi Supplier
                                    </a>
                                    <a href="#" class="action-dropdown-item">
                                        <i class="fas fa-history"></i>
                                        Riwayat
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Stok -->
<div class="modal fade" id="modalTambahStok" tabindex="-1" aria-labelledby="modalTambahStokLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modern-modal">
            <div class="modal-header modal-header-modern">
                <h5 class="modal-title" id="modalTambahStokLabel">
                    <i class="fas fa-plus-circle" style="color: #f26b37; margin-right: 10px;"></i>
                    Tambah Stok Barang
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body-modern">
                <form id="formTambahStok">
                    <div class="row">
                        <!-- Informasi Produk -->
                        <div class="col-md-6">
                            <div class="form-section">
                                <h6 class="form-section-title">
                                    <i class="fas fa-box"></i>
                                    Informasi Produk
                                </h6>
                                <div class="form-group-modern">
                                    <label for="kode_produk" class="form-label-modern">Kode Produk</label>
                                    <input type="text" class="form-control form-control-modern" id="kode_produk" placeholder="Masukkan kode produk">
                                </div>
                                <div class="form-group-modern">
                                    <label for="nama_produk" class="form-label-modern">Nama Produk</label>
                                    <input type="text" class="form-control form-control-modern" id="nama_produk" placeholder="Masukkan nama produk">
                                </div>
                                <div class="form-group-modern">
                                    <label for="kategori" class="form-label-modern">Kategori</label>
                                    <select class="form-select form-control-modern" id="kategori">
                                        <option value="">Pilih Kategori</option>
                                        <option value="sembako">Sembako</option>
                                        <option value="minuman">Minuman</option>
                                        <option value="perawatan">Perawatan</option>
                                        <option value="elektronik">Elektronik</option>
                                        <option value="pakaian">Pakaian</option>
                                    </select>
                                </div>
                                <div class="form-group-modern">
                                    <label for="satuan" class="form-label-modern">Satuan</label>
                                    <select class="form-select form-control-modern" id="satuan">
                                        <option value="">Pilih Satuan</option>
                                        <option value="pcs">Pcs</option>
                                        <option value="dus">Dus</option>
                                        <option value="kg">Kg</option>
                                        <option value="liter">Liter</option>
                                        <option value="pack">Pack</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Stok & Harga -->
                        <div class="col-md-6">
                            <div class="form-section">
                                <h6 class="form-section-title">
                                    <i class="fas fa-calculator"></i>
                                    Stok & Harga
                                </h6>
                                <div class="form-group-modern">
                                    <label for="jumlah_stok" class="form-label-modern">Jumlah Stok</label>
                                    <input type="number" class="form-control form-control-modern" id="jumlah_stok" placeholder="0" min="0">
                                </div>
                                <div class="form-group-modern">
                                    <label for="stok_minimum" class="form-label-modern">Stok Minimum</label>
                                    <input type="number" class="form-control form-control-modern" id="stok_minimum" placeholder="0" min="0">
                                </div>
                                <div class="form-group-modern">
                                    <label for="harga_beli" class="form-label-modern">Harga Beli</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control form-control-modern" id="harga_beli" placeholder="0" min="0">
                                    </div>
                                </div>
                                <div class="form-group-modern">
                                    <label for="harga_jual" class="form-label-modern">Harga Jual</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control form-control-modern" id="harga_jual" placeholder="0" min="0">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div class="col-12">
                            <div class="form-section">
                                <h6 class="form-section-title">
                                    <i class="fas fa-info-circle"></i>
                                    Informasi Tambahan
                                </h6>
                                <div class="form-group-modern">
                                    <label for="deskripsi" class="form-label-modern">Deskripsi Produk</label>
                                    <textarea class="form-control form-control-modern" id="deskripsi" rows="3" placeholder="Masukkan deskripsi produk (opsional)"></textarea>
                                </div>
                                <div class="form-group-modern">
                                    <label for="lokasi_rak" class="form-label-modern">Lokasi Rak</label>
                                    <input type="text" class="form-control form-control-modern" id="lokasi_rak" placeholder="Contoh: Rak A-1, Lantai 2">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer modal-footer-modern">
                <button type="button" class="btn btn-outline-modern" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-modern">
                    <i class="fas fa-save"></i>
                    Simpan Stok
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Action dropdown functionality
function toggleActionDropdown(button) {
    console.log('Button clicked:', button); // Debug log
    
    // Ensure button is clickable
    if (!button) {
        console.error('Button is null or undefined');
        return;
    }
    
    // Remove dropdown-active class from all rows
    document.querySelectorAll('.modern-table tbody tr').forEach(row => {
        row.classList.remove('dropdown-active');
    });
    
    // Close all other dropdowns first
    document.querySelectorAll('.action-dropdown-menu').forEach(menu => {
        if (menu !== button.nextElementSibling) {
            menu.style.display = 'none';
        }
    });
    
    // Remove active class from all buttons
    document.querySelectorAll('.action-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    
    // Toggle current dropdown
    const menu = button.nextElementSibling;
    if (menu) {
        const isVisible = menu.style.display === 'block';
        menu.style.display = isVisible ? 'none' : 'block';
        console.log('Menu toggled:', !isVisible); // Debug log
        
        // Add active class to button and row
        if (!isVisible) {
            button.classList.add('active');
            // Find the parent row and add dropdown-active class
            const row = button.closest('tr');
            if (row) {
                row.classList.add('dropdown-active');
            }
        } else {
            button.classList.remove('active');
        }
    } else {
        console.error('Menu element not found'); // Debug log
    }
}

// Close dropdowns when clicking outside
document.addEventListener('click', function(event) {
    if (!event.target.closest('.action-dropdown')) {
        document.querySelectorAll('.action-dropdown-menu').forEach(menu => {
            menu.style.display = 'none';
        });
        // Remove active class from all buttons
        document.querySelectorAll('.action-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        // Remove dropdown-active class from all rows
        document.querySelectorAll('.modern-table tbody tr').forEach(row => {
            row.classList.remove('dropdown-active');
        });
    }
});

// Alternative event listener for buttons (backup method)
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, setting up action buttons'); // Debug log
    
    // Remove any existing onclick handlers and use only event listeners
    document.querySelectorAll('.action-btn').forEach(button => {
        // Remove onclick attribute
        button.removeAttribute('onclick');
        
        // Add multiple event types for better compatibility
        ['click', 'touchstart'].forEach(eventType => {
            button.addEventListener(eventType, function(e) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                console.log(`Action button ${eventType} via event listener`); // Debug log
                toggleActionDropdown(this);
            }, { passive: false });
        });
        
        // Add keyboard support
        button.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                e.stopPropagation();
                toggleActionDropdown(this);
            }
        });
    });
});

// Auto-calculate profit margin
document.getElementById('harga_beli').addEventListener('input', calculateProfit);
document.getElementById('harga_jual').addEventListener('input', calculateProfit);

function calculateProfit() {
    const hargaBeli = parseFloat(document.getElementById('harga_beli').value) || 0;
    const hargaJual = parseFloat(document.getElementById('harga_jual').value) || 0;
    
    if (hargaBeli > 0 && hargaJual > 0) {
        const profit = hargaJual - hargaBeli;
        const margin = ((profit / hargaBeli) * 100).toFixed(2);
        
        // Show profit info (you can add this display element)
        console.log(`Keuntungan: Rp ${profit.toLocaleString('id-ID')} (${margin}%)`);
    }
}

// Format currency inputs
function formatCurrency(input) {
    const value = input.value.replace(/[^\d]/g, '');
    input.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

// Add currency formatting to price inputs
document.getElementById('harga_beli').addEventListener('input', function() {
    formatCurrency(this);
});

document.getElementById('harga_jual').addEventListener('input', function() {
    formatCurrency(this);
});
</script>

@endsection