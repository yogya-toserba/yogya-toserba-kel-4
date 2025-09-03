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
    z-index: 1050;
    overflow: visible;
    transform: translateY(2px);
}

/* Adjust position for right edge tables */
.modern-table td:last-child .action-dropdown-menu {
    right: 0;
    left: auto;
}

@media (max-width: 768px) {
    .action-dropdown-menu {
        left: auto;
        right: 0;
        min-width: 160px;
    }
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
    border: none;
    background: none;
    width: 100%;
    text-align: left;
    font-size: 14px;
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

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Stats Section -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number">{{ number_format($stats['total_produk'] ?? 0) }}</div>
            <div class="stat-label">Total Item</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ number_format($stats['stok_menipis'] ?? 0) }}</div>
            <div class="stat-label">Stok Menipis</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ number_format($stats['stok_habis'] ?? 0) }}</div>
            <div class="stat-label">Stok Habis</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ number_format($stats['total_nilai'] ?? 0, 0, ',', '.') }}</div>
            <div class="stat-label">Total Nilai (Rp)</div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <form method="GET" action="{{ route('gudang.stok.index') }}">
            <div class="filter-grid">
                <div>
                    <label class="form-label-modern">Kategori</label>
                    <select name="kategori" class="form-control form-control-modern">
                        <option value="">Semua Kategori</option>
                        <option value="Sembako" {{ request('kategori') == 'Sembako' ? 'selected' : '' }}>Sembako</option>
                        <option value="Makanan" {{ request('kategori') == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                        <option value="Minuman" {{ request('kategori') == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                        <option value="Perawatan" {{ request('kategori') == 'Perawatan' ? 'selected' : '' }}>Perawatan</option>
                        <option value="Rumah Tangga" {{ request('kategori') == 'Rumah Tangga' ? 'selected' : '' }}>Rumah Tangga</option>
                    </select>
                </div>
                <div>
                    <label class="form-label-modern">Status Stok</label>
                    <select name="stock_filter" class="form-control form-control-modern">
                        <option value="">Semua Status</option>
                        <option value="normal" {{ request('stock_filter') == 'normal' ? 'selected' : '' }}>Stok Aman</option>
                        <option value="low" {{ request('stock_filter') == 'low' ? 'selected' : '' }}>Stok Menipis</option>
                        <option value="empty" {{ request('stock_filter') == 'empty' ? 'selected' : '' }}>Stok Habis</option>
                        <option value="expiring" {{ request('stock_filter') == 'expiring' ? 'selected' : '' }}>Akan Expired</option>
                    </select>
                </div>
                <div>
                    <label class="form-label-modern">Pencarian</label>
                    <input type="text" name="search" class="form-control form-control-modern" 
                           placeholder="Nama barang..." value="{{ request('search') }}">
                </div>
                <div>
                    <label class="form-label-modern">&nbsp;</label>
                    <button type="submit" class="btn btn-modern w-100 form-control-modern" style="height: 48px;">
                        <i class="fas fa-search"></i>
                        Cari
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Main Table -->
    <div class="modern-card">
        <div class="card-header-modern">
            <h5 class="card-title-modern">
                <i class="fas fa-boxes" style="color: #f26b37; margin-right: 10px;"></i>
                Daftar Stok Barang
            </h5>
            <div class="d-flex gap-2">
                <a href="{{ route('gudang.stok.create') }}" class="btn btn-modern">
                    <i class="fas fa-plus"></i>
                    Tambah Stok
                </a>
                <div class="dropdown">
                    <button class="btn btn-outline-modern dropdown-toggle" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-download"></i>
                        Export
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                        <li><a class="dropdown-item" href="#" onclick="exportStok('csv')">
                            <i class="fas fa-file-csv text-success me-2"></i>Export CSV
                        </a></li>
                        <li><a class="dropdown-item" href="#" onclick="exportStok('excel')">
                            <i class="fas fa-file-excel text-primary me-2"></i>Export Excel
                        </a></li>
                    </ul>
                </div>
                <button class="btn btn-outline-modern" onclick="location.reload()">
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
                        <th>Foto</th>
                        <th>Kode/Nama Produk</th>
                        <th>Kategori</th>
                        <th>Stok Tersedia</th>
                        <th>Harga</th>
                        <th>Status Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stoks as $stok)
                    <tr>
                        <td>
                            <div>{{ $stok->created_at->format('d M Y') }}</div>
                            <small class="text-muted">{{ $stok->created_at->format('H:i') }} WIB</small>
                        </td>
                        <td>
                            <div class="product-image">
                                <img src="{{ asset($stok->foto) }}" 
                                     alt="{{ $stok->nama_produk }}" 
                                     class="img-thumbnail"
                                     style="width: 50px; height: 50px; object-fit: cover;"
                                     onerror="this.src='{{ asset('images/produk/default-product.svg') }}'">
                            </div>
                        </td>
                        <td>
                            <div class="fw-semibold">#{{ str_pad($stok->id_produk, 3, '0', STR_PAD_LEFT) }}</div>
                            <div>{{ $stok->nama_produk }}</div>
                            <small class="text-muted">Per {{ $stok->satuan }}</small>
                        </td>
                        <td>
                            <span class="badge bg-info">{{ $stok->kategori ?? 'Umum' }}</span>
                        </td>
                        <td>
                            <div class="fw-bold @if($stok->jumlah <= 10) text-danger @elseif($stok->jumlah <= 30) text-warning @else text-success @endif">
                                {{ $stok->jumlah }} {{ $stok->satuan }}
                            </div>
                            @if($stok->expired)
                                <small class="text-muted">Expired: {{ $stok->expired->format('d/m/Y') }}</small>
                            @endif
                        </td>
                        <td>
                            @if($stok->harga_beli && $stok->harga_jual)
                                <div class="fw-semibold">Beli: Rp {{ number_format($stok->harga_beli, 0, ',', '.') }}</div>
                                <div class="text-success">Jual: Rp {{ number_format($stok->harga_jual, 0, ',', '.') }}</div>
                            @else
                                <div class="text-muted">-</div>
                            @endif
                        </td>
                        <td>
                            @if($stok->jumlah <= 0)
                                <span class="status-badge status-rendah">Stok Habis</span>
                            @elseif($stok->jumlah <= 10)
                                <span class="status-badge status-rendah">Stok Kritis</span>
                            @elseif($stok->jumlah <= 30)
                                <span class="status-badge status-sedang">Stok Menipis</span>
                            @else
                                <span class="status-badge status-tinggi">Stok Aman</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-dropdown">
                                <button class="action-btn" onclick="toggleActionDropdown(this)">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="action-dropdown-menu">
                                    <button onclick="event.stopPropagation(); viewStokDetail({{ $stok->id_produk }}); return false;" class="action-dropdown-item">
                                        <i class="fas fa-eye"></i>
                                        Lihat Detail
                                    </button>
                                    <button onclick="event.stopPropagation(); editStok({{ $stok->id_produk }}); return false;" class="action-dropdown-item">
                                        <i class="fas fa-edit"></i>
                                        Edit Stok
                                    </button>
                                    <a href="{{ route('gudang.stok.add-stock', $stok) }}" class="action-dropdown-item">
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
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <div class="text-muted">
                                <i class="fas fa-box-open fa-2x mb-2"></i>
                                <p>Belum ada data stok</p>
                                <a href="{{ route('gudang.stok.create') }}" class="btn btn-modern">
                                    <i class="fas fa-plus"></i>
                                    Tambah Stok Pertama
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Pagination -->
<div class="row mt-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div class="text-muted">
                Menampilkan {{ $stoks->firstItem() ?? 0 }} - {{ $stoks->lastItem() ?? 0 }} dari {{ $stoks->total() }} data
            </div>
            <div>
                {{ $stoks->links() }}
            </div>
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

// Export function
function exportStok(format = 'csv') {
    console.log('Exporting stok data in format:', format);
    
    // Get current filter values
    const searchValue = document.querySelector('input[name="search"]')?.value || '';
    const kategoriValue = document.querySelector('select[name="kategori"]')?.value || '';
    const stockFilterValue = document.querySelector('select[name="stock_filter"]')?.value || '';
    
    // Build export URL with current filters
    const baseUrl = window.location.origin;
    const exportUrl = new URL(`${baseUrl}/gudang/stok-export`);
    
    // Add parameters
    exportUrl.searchParams.append('format', format);
    if (searchValue) exportUrl.searchParams.append('search', searchValue);
    if (kategoriValue) exportUrl.searchParams.append('kategori', kategoriValue);
    if (stockFilterValue) exportUrl.searchParams.append('stock_filter', stockFilterValue);
    
    console.log('Export URL:', exportUrl.toString());
    
    // Show loading notification
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            title: 'Memproses Export...',
            text: `Sedang menyiapkan file ${format.toUpperCase()}`,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        
        // Auto close after 2 seconds
        setTimeout(() => {
            Swal.close();
        }, 2000);
    }
    
    // Create temporary link and trigger download
    const link = document.createElement('a');
    link.href = exportUrl.toString();
    link.download = '';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

// Legacy function for backward compatibility
function exportData() {
    exportStok('csv');
}

// Auto refresh alerts after 5 seconds
setTimeout(function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        if (alert.classList.contains('show')) {
            alert.classList.remove('show');
            setTimeout(() => alert.remove(), 150);
        }
    });
}, 5000);

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

// Global function untuk view detail stok
function viewStokDetail(id) {
    console.log('viewStokDetail called with ID:', id);
    
    // Close any existing dropdown
    document.querySelectorAll('.action-dropdown-menu').forEach(menu => {
        menu.style.display = 'none';
    });
    
    // Test apakah modal element ada
    const modalElement = document.getElementById('detailStokModal');
    if (!modalElement) {
        alert('Modal element not found!');
        return;
    }
    
    // Tampilkan loading modal
    const modalTitle = document.querySelector('#detailStokModal .modal-title');
    const modalBody = document.querySelector('#detailStokModal .modal-body');
    
    if (!modalTitle || !modalBody) {
        alert('Modal title or body not found!');
        return;
    }
    
    modalTitle.innerHTML = 'Loading...';
    modalBody.innerHTML = `
        <div class="text-center">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <p class="mt-2">Memuat data stok...</p>
        </div>
    `;
    
    // Tampilkan modal
    try {
        const detailModal = new bootstrap.Modal(modalElement);
        detailModal.show();
    } catch (error) {
        alert('Error showing modal: ' + error.message);
        return;
    }
    
    // AJAX request untuk get data
    const baseUrl = window.location.origin;
    const url = `${baseUrl}/gudang/stok-data?id=${id}`;
    console.log('Making AJAX request to:', url);
    
    // Check if CSRF token exists
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (!csrfToken) {
        alert('CSRF token not found!');
        return;
    }
    
    // Add timeout untuk prevent infinite loading
    const controller = new AbortController();
    const timeoutId = setTimeout(() => {
        controller.abort();
        modalTitle.innerHTML = 'Timeout';
        modalBody.innerHTML = `
            <div class="alert alert-warning">
                <h6>Request Timeout!</h6>
                <p>Permintaan memakan waktu terlalu lama.</p>
                <small>Coba lagi atau periksa koneksi.</small>
            </div>
        `;
    }, 8000); // 8 second timeout
    
    // Fetch data
    fetch(url, {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken.getAttribute('content')
        },
        signal: controller.signal
    })
    .then(response => {
        clearTimeout(timeoutId);
        console.log('Response status:', response.status);
        
        if (!response.ok) {
            throw new Error(`HTTP ${response.status}: ${response.statusText}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Data received:', data);
        
        // Update modal title
        modalTitle.innerHTML = 'Detail Stok';
        
        // Ambil data dari response
        const stok = data.data;
        
        // Update modal body dengan data
        modalBody.innerHTML = `
            <div class="row">
                <div class="col-md-6">
                    <h6 class="text-primary mb-3">Informasi Produk</h6>
                    <table class="table table-sm">
                        <tr>
                            <td><strong>ID Produk:</strong></td>
                            <td>#${String(stok.id_produk).padStart(3, '0')}</td>
                        </tr>
                        <tr>
                            <td><strong>Nama Produk:</strong></td>
                            <td>${stok.nama_produk || '-'}</td>
                        </tr>
                        <tr>
                            <td><strong>Kategori:</strong></td>
                            <td>${stok.kategori || '-'}</td>
                        </tr>
                        <tr>
                            <td><strong>Satuan:</strong></td>
                            <td>${stok.satuan || '-'}</td>
                        </tr>
                        <tr>
                            <td><strong>Status:</strong></td>
                            <td>
                                ${stok.status === 'aktif' ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-danger">Non-Aktif</span>'}
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h6 class="text-primary mb-3">Informasi Stok & Harga</h6>
                    <table class="table table-sm">
                        <tr>
                            <td><strong>Jumlah Stok:</strong></td>
                            <td><span class="badge ${stok.jumlah > 0 ? (stok.jumlah <= 10 ? 'bg-warning' : 'bg-success') : 'bg-danger'}">${stok.jumlah || 0}</span></td>
                        </tr>
                        <tr>
                            <td><strong>Harga Beli:</strong></td>
                            <td>Rp ${stok.harga_beli ? Number(stok.harga_beli).toLocaleString('id-ID') : '0'}</td>
                        </tr>
                        <tr>
                            <td><strong>Harga Jual:</strong></td>
                            <td>Rp ${stok.harga_jual ? Number(stok.harga_jual).toLocaleString('id-ID') : '0'}</td>
                        </tr>
                        <tr>
                            <td><strong>Margin:</strong></td>
                            <td>${stok.harga_beli && stok.harga_jual ? Math.round(((stok.harga_jual - stok.harga_beli) / stok.harga_beli) * 100) + '%' : '0%'}</td>
                        </tr>
                        <tr>
                            <td><strong>Tanggal Input:</strong></td>
                            <td>${stok.tanggal ? new Date(stok.tanggal).toLocaleDateString('id-ID') : '-'}</td>
                        </tr>
                    </table>
                </div>
            </div>
            ${stok.deskripsi ? `
            <div class="row mt-3">
                <div class="col-12">
                    <h6 class="text-primary mb-2">Deskripsi</h6>
                    <p class="text-muted">${stok.deskripsi}</p>
                </div>
            </div>
            ` : ''}
            ${stok.expired ? `
            <div class="row mt-3">
                <div class="col-12">
                    <h6 class="text-primary mb-2">Informasi Kedaluwarsa</h6>
                    <p class="text-muted">
                        <i class="fas fa-calendar-alt me-2"></i>
                        Tanggal Kedaluwarsa: ${new Date(stok.expired).toLocaleDateString('id-ID')}
                        ${new Date(stok.expired) <= new Date() ? '<span class="badge bg-danger ms-2">KEDALUWARSA</span>' : 
                          new Date(stok.expired) <= new Date(Date.now() + 30*24*60*60*1000) ? '<span class="badge bg-warning ms-2">AKAN KEDALUWARSA</span>' : 
                          '<span class="badge bg-success ms-2">MASIH SEGAR</span>'}
                    </p>
                </div>
            </div>
            ` : ''}
        `;
    })
    .catch(error => {
        clearTimeout(timeoutId);
        console.error('Error:', error);
        
        modalTitle.innerHTML = 'Error';
        
        if (error.name === 'AbortError') {
            modalBody.innerHTML = `
                <div class="alert alert-warning">
                    <h6>Request Dibatalkan!</h6>
                    <p>Request timeout atau dibatalkan.</p>
                    <small>Coba lagi atau periksa koneksi internet.</small>
                </div>
            `;
        } else {
            modalBody.innerHTML = `
                <div class="alert alert-danger">
                    <h6>Terjadi Kesalahan!</h6>
                    <p>Tidak dapat memuat data stok. Silakan coba lagi.</p>
                    <small>Error: ${error.message}</small>
                </div>
            `;
        }
    });
}

// Global function untuk edit stok
function editStok(id) {
    console.log('=== EDIT STOK FUNCTION CALLED ===');
    console.log('editStok called with ID:', id);
    console.log('Type of ID:', typeof id);
    
    // Validate ID
    if (!id || id === 'undefined' || id === 'null') {
        console.error('Invalid ID provided:', id);
        alert('ID produk tidak valid: ' + id);
        return;
    }
    
    // Test apakah modal element ada
    const modalElement = document.getElementById('editStokModal');
    console.log('Modal element found:', modalElement ? 'YES' : 'NO');
    if (!modalElement) {
        console.error('Modal element not found!');
        alert('Modal edit element not found!');
        return;
    }
    
    // Close any existing dropdown
    document.querySelectorAll('.action-dropdown-menu').forEach(menu => {
        menu.style.display = 'none';
    });
    
    // Tampilkan loading di modal
    const modalTitle = document.querySelector('#editStokModal .modal-title');
    const modalBody = document.querySelector('#editStokModal .modal-body');
    
    console.log('Modal title found:', modalTitle ? 'YES' : 'NO');
    console.log('Modal body found:', modalBody ? 'YES' : 'NO');
    
    if (!modalTitle || !modalBody) {
        console.error('Modal title or body not found!');
        alert('Modal title or body not found!');
        return;
    }
    
    modalTitle.innerHTML = 'Loading...';
    modalBody.innerHTML = `
        <div class="text-center py-4">
            <div class="spinner-border text-primary mb-3" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="text-muted">Memuat data untuk edit...</p>
        </div>
    `;
    
    // Tampilkan modal
    try {
        console.log('Attempting to show modal...');
        const editModal = new bootstrap.Modal(modalElement);
        editModal.show();
        console.log('Modal shown successfully');
    } catch (error) {
        console.error('Error showing modal:', error);
        alert('Error showing modal: ' + error.message);
        return;
    }
    
    // AJAX request untuk get data
    const baseUrl = window.location.origin;
    const url = `${baseUrl}/gudang/stok-data?id=${id}`;
    console.log('Making AJAX request to:', url);
    
    // Check if CSRF token exists
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (!csrfToken) {
        alert('CSRF token not found!');
        return;
    }
    
    // Add timeout untuk prevent infinite loading
    const controller = new AbortController();
    const timeoutId = setTimeout(() => {
        controller.abort();
        modalTitle.innerHTML = 'Timeout';
        modalBody.innerHTML = `
            <div class="alert alert-warning">
                <h6>Request Timeout!</h6>
                <p>Permintaan memakan waktu terlalu lama.</p>
                <small>Coba lagi atau periksa koneksi.</small>
            </div>
        `;
    }, 8000); // 8 second timeout
    
    // Fetch data untuk edit
    fetch(url, {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken.getAttribute('content')
        },
        signal: controller.signal
    })
    .then(response => {
        clearTimeout(timeoutId); // Clear timeout jika berhasil
        console.log('Response status:', response.status);
        
        if (!response.ok) {
            throw new Error(`HTTP ${response.status}: ${response.statusText}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Data received for edit:', data);
        
        // Reset modal title
        modalTitle.innerHTML = 'Edit Stok';
        
        // Reset modal body with compact form - hanya field yang penting
        modalBody.innerHTML = `
            <form id="editStokForm">
                <input type="hidden" id="edit_id_produk" name="id_produk">
                
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="edit_nama_produk" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_nama_produk" name="nama_produk" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="edit_jumlah" class="form-label">Stok <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="edit_jumlah" name="jumlah" min="0" required>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="edit_harga_beli" class="form-label">Harga Beli <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="edit_harga_beli" name="harga_beli" min="0" step="0.01" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="edit_harga_jual" class="form-label">Harga Jual <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="edit_harga_jual" name="harga_jual" min="0" step="0.01" required>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="edit_status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select" id="edit_status" name="status" required>
                            <option value="">Pilih Status</option>
                            <option value="aktif">Aktif</option>
                            <option value="non-aktif">Non-Aktif</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="edit_expired" class="form-label">Kedaluwarsa</label>
                        <input type="date" class="form-control" id="edit_expired" name="expired">
                        <small class="text-muted">Opsional</small>
                    </div>
                </div>
            </form>
        `;
        
        // Wait for DOM to be ready, then populate form dengan data
        setTimeout(() => {
            try {
                const stok = data.data;
                
                // Set values dengan null checking
                const setFieldValue = (id, value) => {
                    const field = document.getElementById(id);
                    if (field) {
                        field.value = value || '';
                    } else {
                        console.warn(`Field dengan ID ${id} tidak ditemukan`);
                    }
                };
                
                setFieldValue('edit_id_produk', stok.id_produk);
                setFieldValue('edit_nama_produk', stok.nama_produk);
                setFieldValue('edit_jumlah', stok.jumlah);
                setFieldValue('edit_harga_beli', stok.harga_beli);
                setFieldValue('edit_harga_jual', stok.harga_jual);
                setFieldValue('edit_expired', stok.expired);
                setFieldValue('edit_status', stok.status);
                
            } catch (error) {
                console.error('Error saat populate form:', error);
            }
        }, 100); // Wait 100ms for DOM to be ready
    })
    .catch(error => {
        clearTimeout(timeoutId); // Clear timeout jika error
        console.error('Error:', error);
        
        modalTitle.innerHTML = 'Error';
        
        if (error.name === 'AbortError') {
            modalBody.innerHTML = `
                <div class="alert alert-warning">
                    <h6>Request Dibatalkan!</h6>
                    <p>Request timeout atau dibatalkan.</p>
                    <small>Coba lagi atau periksa koneksi internet.</small>
                </div>
            `;
        } else {
            modalBody.innerHTML = `
                <div class="alert alert-danger">
                    <h6>Terjadi Kesalahan!</h6>
                    <p>Tidak dapat memuat data stok. Silakan coba lagi.</p>
                    <small>Error: ${error.message}</small>
                </div>
            `;
        }
    });
}

// Function untuk update stok
function updateStok() {
    const form = document.getElementById('editStokForm');
    const formData = new FormData(form);
    const id = document.getElementById('edit_id_produk').value;
    
    // Check if CSRF token exists
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (!csrfToken) {
        Swal.fire('Error', 'CSRF token not found!', 'error');
        return;
    }
    
    // Validasi form
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }
    
    // Show loading
    Swal.fire({
        title: 'Memproses...',
        text: 'Sedang memperbarui data stok',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    
    const baseUrl = window.location.origin;
    const url = `${baseUrl}/gudang/stok/${id}`;
    
    // Add CSRF token and method override to FormData
    formData.append('_token', csrfToken.getAttribute('content'));
    formData.append('_method', 'PUT');
    
    fetch(url, {
        method: 'POST', // Using POST with method override for file upload
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken.getAttribute('content')
        },
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => Promise.reject(err));
        }
        return response.json();
    })
    .then(data => {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Data stok berhasil diperbarui',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            // Tutup modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('editStokModal'));
            modal.hide();
            
            // Reload halaman untuk refresh data
            window.location.reload();
        });
    })
    .catch(error => {
        console.error('Error:', error);
        
        let errorMessage = 'Terjadi kesalahan saat memperbarui data';
        
        if (error.errors) {
            // Laravel validation errors
            const errors = Object.values(error.errors).flat();
            errorMessage = errors.join('\n');
        } else if (error.message) {
            errorMessage = error.message;
        }
        
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: errorMessage
        });
    });
}

// Event listener untuk DOM ready
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM ready!');
    
    // Event listener untuk update button
    const updateStokBtn = document.getElementById('updateStokBtn');
    if (updateStokBtn) {
        updateStokBtn.addEventListener('click', function() {
            updateStok();
        });
    }
    
    // Close dropdown when any modal opens
    const modals = ['detailStokModal', 'editStokModal'];
    modals.forEach(modalId => {
        const modalElement = document.getElementById(modalId);
        if (modalElement) {
            modalElement.addEventListener('show.bs.modal', function() {
                // Close all dropdowns
                document.querySelectorAll('.action-dropdown-menu').forEach(menu => {
                    menu.style.display = 'none';
                });
                // Remove active state from buttons
                document.querySelectorAll('.action-btn').forEach(btn => {
                    btn.classList.remove('active');
                });
                // Remove dropdown-active class from rows
                document.querySelectorAll('.modern-table tbody tr').forEach(row => {
                    row.classList.remove('dropdown-active');
                });
            });
        }
    });
});
</script>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Detail Stok Modal -->
<div class="modal fade" id="detailStokModal" tabindex="-1" aria-labelledby="detailStokModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailStokModalLabel">Detail Stok</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Content will be loaded dynamically -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Stok Modal -->
<div class="modal fade" id="editStokModal" tabindex="-1" aria-labelledby="editStokModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStokModalLabel">Edit Stok</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editStokForm">
                    <input type="hidden" id="edit_id_produk" name="id_produk">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_nama_produk" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_nama_produk" name="nama_produk" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_kategori" name="kategori" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_satuan" class="form-label">Satuan <span class="text-danger">*</span></label>
                            <select class="form-select" id="edit_satuan" name="satuan" required>
                                <option value="">Pilih Satuan</option>
                                <option value="pcs">Pcs</option>
                                <option value="kg">Kg</option>
                                <option value="gr">Gram</option>
                                <option value="ltr">Liter</option>
                                <option value="ml">Mililiter</option>
                                <option value="box">Box</option>
                                <option value="pack">Pack</option>
                                <option value="botol">Botol</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_jumlah" class="form-label">Jumlah Stok <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="edit_jumlah" name="jumlah" min="0" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_harga_beli" class="form-label">Harga Beli <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="edit_harga_beli" name="harga_beli" min="0" step="0.01" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_harga_jual" class="form-label">Harga Jual <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="edit_harga_jual" name="harga_jual" min="0" step="0.01" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_tanggal" class="form-label">Tanggal Input</label>
                            <input type="date" class="form-control" id="edit_tanggal" name="tanggal">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_expired" class="form-label">Tanggal Kedaluwarsa</label>
                            <input type="date" class="form-control" id="edit_expired" name="expired">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select" id="edit_status" name="status" required>
                                <option value="">Pilih Status</option>
                                <option value="aktif">Aktif</option>
                                <option value="non-aktif">Non-Aktif</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_foto" class="form-label">Foto Produk</label>
                            <input type="file" class="form-control" id="edit_foto" name="foto" accept="image/*">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto</small>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="edit_deskripsi" name="deskripsi" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="updateStokBtn">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>

@endsection