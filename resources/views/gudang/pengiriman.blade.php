@extends('layouts.appGudanng')

@section('title', 'Pengiriman - MyYOGYA Dashboard')

@section('content')
<style>
/* Modern MyYOGYA Theme */
.page-wrapper {
    background: #f8fafc;
    min-height: 100vh;
    padding: 20px;
}

body.dark-mode .page-wrapper {
    background: #1a1d29;
}

.content-container {
    max-width: 1400px;
    margin: 0 auto;
}

.page-header {
    background: white;
    border-radius: 16px;
    padding: 25px 30px;
    margin-bottom: 25px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.1);
    border: 1px solid rgba(255,255,255,0.2);
}

body.dark-mode .page-header {
    background: #252837;
    border-color: #3a3d4a;
    color: #e2e8f0;
}

.page-title {
    font-size: 2rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0;
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

body.dark-mode .page-title {
    color: #e2e8f0;
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.page-subtitle {
    color: #64748b;
    margin: 5px 0 0 0;
    font-size: 0.95rem;
}

body.dark-mode .page-subtitle {
    color: #94a3b8;
}

/* Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: white;
    border-radius: 16px;
    padding: 25px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.1);
    border: 1px solid rgba(255,255,255,0.2);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 40px rgba(0,0,0,0.15);
}

body.dark-mode .stat-card {
    background: #252837;
    border-color: #3a3d4a;
}

body.dark-mode .stat-card:hover {
    box-shadow: 0 12px 40px rgba(0,0,0,0.3);
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
}

.stat-number {
    font-size: 2.2rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0;
}

body.dark-mode .stat-number {
    color: #e2e8f0;
}

.stat-label {
    color: #64748b;
    font-size: 0.9rem;
    margin: 5px 0 0 0;
    font-weight: 500;
}

body.dark-mode .stat-label {
    color: #94a3b8;
}

.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    margin-bottom: 15px;
}

.stat-icon.pending { background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); }
.stat-icon.shipping { background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 100%); }
.stat-icon.delivered { background: linear-gradient(135deg, #34d399 0%, #10b981 100%); }
.stat-icon.returned { background: linear-gradient(135deg, #f87171 0%, #ef4444 100%); }

/* Filter Section */
.filter-section {
    background: white;
    border-radius: 16px;
    padding: 25px 30px;
    margin-bottom: 25px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.1);
    border: 1px solid rgba(255,255,255,0.2);
}

body.dark-mode .filter-section {
    background: #252837;
    border-color: #3a3d4a;
}

.filter-grid {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr auto;
    gap: 20px;
    align-items: end;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #374151;
    font-size: 0.9rem;
}

body.dark-mode .form-group label {
    color: #e2e8f0;
}

.form-control {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #d1d5db;
    border-radius: 12px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    background: #ffffff;
    color: #1f2937;
    font-weight: 500;
}

.form-control:focus {
    outline: none;
    border-color: #f26b37;
    box-shadow: 0 0 0 3px rgba(242, 107, 55, 0.15);
    background: #ffffff;
}

.form-control::placeholder {
    color: #6b7280;
    font-weight: 400;
}

body.dark-mode .form-control {
    background: #2a2d47 !important;
    border-color: #4b5563 !important;
    color: #ffffff !important;
    font-weight: 500 !important;
}

body.dark-mode .form-control:focus {
    border-color: #f26b37 !important;
    box-shadow: 0 0 0 3px rgba(242, 107, 55, 0.25) !important;
    background: #2a2d47 !important;
}

body.dark-mode .form-control::placeholder {
    color: #9ca3af !important;
    font-weight: 400 !important;
}

/* Select dropdown styling */
.form-control select {
    cursor: pointer;
}

.form-control option {
    background: #ffffff;
    color: #1f2937;
    padding: 10px;
}

body.dark-mode .form-control option {
    background: #2a2d47 !important;
    color: #ffffff !important;
}

/* Textarea specific styling */
textarea.form-control {
    resize: vertical;
    min-height: 100px;
    font-family: inherit;
    line-height: 1.5;
}

body.dark-mode textarea.form-control {
    background: #2a2d47 !important;
    border-color: #4b5563 !important;
    color: #ffffff !important;
}

body.dark-mode textarea.form-control:focus {
    background: #2a2d47 !important;
    border-color: #f26b37 !important;
    box-shadow: 0 0 0 3px rgba(242, 107, 55, 0.25) !important;
}

/* Enhanced button styling */
.btn {
    padding: 12px 24px;
    border-radius: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
    border: 2px solid transparent;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-primary {
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
    color: white;
    border: 2px solid #f26b37;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(242, 107, 55, 0.3);
    border-color: #e55827;
}

.btn-secondary {
    background: #f8fafc;
    color: #4b5563;
    border: 2px solid #e5e7eb;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-secondary:hover {
    background: #f1f5f9;
    color: #374151;
    border-color: #d1d5db;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

body.dark-mode .btn-secondary {
    background: #374151;
    color: #e5e7eb;
    border-color: #4b5563;
}

body.dark-mode .btn-secondary:hover {
    background: #4b5563;
    color: #f9fafb;
    border-color: #6b7280;
}

/* Table Section */
.table-section {
    background: white;
    border-radius: 16px;
    padding: 30px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.1);
    border: 1px solid rgba(255,255,255,0.2);
}

body.dark-mode .table-section {
    background: #252837;
    border-color: #3a3d4a;
}

.table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    padding-bottom: 20px;
    border-bottom: 2px solid #f1f5f9;
}

body.dark-mode .table-header {
    border-bottom-color: #3a3d4a;
}

.table-title {
    font-size: 1.4rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0;
}

body.dark-mode .table-title {
    color: #e2e8f0;
}

.table-responsive {
    border-radius: 12px;
    overflow: hidden;
}

.modern-table {
    width: 100%;
    border-collapse: collapse;
    background: white;
}

body.dark-mode .modern-table {
    background: #1e2139;
}

.modern-table thead th {
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
    color: white;
    padding: 18px 16px;
    font-weight: 600;
    text-align: left;
    font-size: 0.9rem;
    letter-spacing: 0.5px;
}

.modern-table tbody td {
    padding: 16px;
    border-bottom: 1px solid #f1f5f9;
    color: #374151;
    font-size: 0.9rem;
}

body.dark-mode .modern-table tbody td {
    border-bottom-color: #3a3d4a;
    color: #ffffff !important;
    background-color: #1e2139;
}

body.dark-mode .modern-table tbody td .fw-semibold {
    color: #ffffff !important;
}

body.dark-mode .modern-table tbody td .fw-bold {
    color: #ffffff !important;
}

body.dark-mode .modern-table tbody td .text-muted {
    color: #d1d5db !important;
}

.modern-table tbody tr:hover {
    background-color: #f8fafc;
}

body.dark-mode .modern-table tbody tr:hover {
    background: #2a2d47 !important;
}

/* Status Badges */
.status-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-align: center;
    min-width: 80px;
    display: inline-block;
}

.status-pending { 
    background: #fef3c7; 
    color: #92400e; 
    border: 1px solid #fcd34d; 
}

.status-shipping { 
    background: #dbeafe; 
    color: #1e40af; 
    border: 1px solid #93c5fd; 
}

.status-delivered { 
    background: #d1fae5; 
    color: #065f46; 
    border: 1px solid #6ee7b7; 
}

.status-returned { 
    background: #fee2e2; 
    color: #991b1b; 
    border: 1px solid #fca5a5; 
}

body.dark-mode .status-pending { 
    background: #fbbf24; 
    color: #1f2937; 
}

body.dark-mode .status-shipping { 
    background: #60a5fa; 
    color: #1f2937; 
}

body.dark-mode .status-delivered { 
    background: #34d399; 
    color: #1f2937; 
}

body.dark-mode .status-returned { 
    background: #f87171; 
    color: #1f2937; 
}

/* Action Dropdown */
.action-dropdown {
    position: relative;
    display: inline-block;
}

.action-btn {
    background: #f8fafc;
    border: 2px solid #e5e7eb;
    color: #374151;
    padding: 6px 10px;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 35px;
    height: 35px;
}

.action-btn:hover {
    background: #f26b37;
    color: white;
    border-color: #f26b37;
}

body.dark-mode .action-btn {
    background: #252837;
    border-color: #3a3d4a;
    color: #e2e8f0;
}

body.dark-mode .action-btn:hover {
    background: #f26b37;
    color: white;
    border-color: #f26b37;
}

.action-dropdown-menu {
    position: absolute;
    top: 100%;
    right: 0;
    background: white;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    min-width: 180px;
    z-index: 9999 !important;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
    margin-top: 5px;
}

body.dark-mode .action-dropdown-menu {
    background: #2a2d3f;
    border-color: #3a3d4a;
}

.action-dropdown-menu.show {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.action-dropdown-item {
    display: block;
    padding: 12px 16px;
    color: #374151;
    text-decoration: none;
    transition: all 0.2s ease;
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
    color: #e2e8f0;
    border-bottom-color: #3a3d4a;
}

body.dark-mode .action-dropdown-item:hover {
    background: #3a3d4a;
    color: #f26b37;
}

.action-dropdown-item i {
    margin-right: 8px;
    width: 16px;
    text-align: center;
}

/* Modal Styling */
.modal-content {
    border-radius: 16px;
    border: none;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
}

body.dark-mode .modal-content {
    background: #252837;
    border: 1px solid #3a3d4a;
}

body.dark-mode .modal-body {
    background: #252837;
    color: #e2e8f0;
}

body.dark-mode .modal-footer {
    background: #252837;
    border-color: #3a3d4a;
}

body.dark-mode .modal-body label {
    color: #e2e8f0 !important;
    font-weight: 600;
}

body.dark-mode .modal-body .form-control {
    background: #2a2d47 !important;
    border-color: #4b5563 !important;
    color: #ffffff !important;
}

body.dark-mode .modal-body .form-control:focus {
    background: #2a2d47 !important;
    border-color: #f26b37 !important;
}

/* Responsive Design */
@media (max-width: 768px) {
    .page-wrapper {
        padding: 15px;
    }
    
    .stats-grid {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
    }
    
    .filter-grid {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .table-section {
        padding: 20px 15px;
    }
    
    .table-responsive {
        overflow-x: auto;
    }
    
    .modern-table {
        min-width: 800px;
    }
    
    .table-header {
        flex-direction: column;
        gap: 15px;
        align-items: stretch;
    }
}
</style>

<div class="page-wrapper">
    <div class="content-container">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-shipping-fast"></i>
                Manajemen Pengiriman
            </h1>
            <p class="page-subtitle">Kelola pengiriman barang dan status pengiriman</p>
        </div>

        <!-- Stats Section -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon pending">
                    <i class="fas fa-clock"></i>
                </div>
                <h3 class="stat-number">24</h3>
                <p class="stat-label">Menunggu Pengiriman</p>
            </div>
            <div class="stat-card">
                <div class="stat-icon shipping">
                    <i class="fas fa-truck"></i>
                </div>
                <h3 class="stat-number">18</h3>
                <p class="stat-label">Dalam Pengiriman</p>
            </div>
            <div class="stat-card">
                <div class="stat-icon delivered">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h3 class="stat-number">156</h3>
                <p class="stat-label">Terkirim</p>
            </div>
            <div class="stat-card">
                <div class="stat-icon returned">
                    <i class="fas fa-undo"></i>
                </div>
                <h3 class="stat-number">3</h3>
                <p class="stat-label">Dikembalikan</p>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <div class="filter-grid">
                <div class="form-group">
                    <label for="status">Status Pengiriman</label>
                    <select class="form-control" id="status">
                        <option value="">Semua Status</option>
                        <option value="pending">Menunggu Pengiriman</option>
                        <option value="shipping">Dalam Pengiriman</option>
                        <option value="delivered">Terkirim</option>
                        <option value="returned">Dikembalikan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="ekspedisi">Ekspedisi</label>
                    <select class="form-control" id="ekspedisi">
                        <option value="">Semua Ekspedisi</option>
                        <option value="jne">JNE</option>
                        <option value="pos">POS Indonesia</option>
                        <option value="tiki">TIKI</option>
                        <option value="jnt">J&T Express</option>
                        <option value="sicepat">SiCepat</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tanggal_dari">Tanggal Dari</label>
                    <input type="date" class="form-control" id="tanggal_dari">
                </div>
                <div class="form-group">
                    <label for="tanggal_sampai">Tanggal Sampai</label>
                    <input type="date" class="form-control" id="tanggal_sampai">
                </div>
                <div class="form-group">
                    <label>&nbsp;</label>
                    <div style="display: flex; gap: 10px; flex-wrap: nowrap; min-width: 200px;">
                        <button type="button" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                            Filter
                        </button>
                        <button type="button" class="btn btn-secondary">
                            <i class="fas fa-refresh"></i>
                            Reset
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="table-section">
            <div class="table-header">
                <h2 class="table-title">Daftar Pengiriman</h2>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPengirimanModal">
                    <i class="fas fa-plus"></i>
                    Tambah Pengiriman
                </button>
            </div>
            
            <div class="table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>No. Resi</th>
                            <th>Tujuan</th>
                            <th>Ekspedisi</th>
                            <th>Tanggal Kirim</th>
                            <th>Status</th>
                            <th>Total Biaya</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <span class="fw-semibold">RSI001234567</span><br>
                                <small class="text-muted">Order #ORD-2024-001</small>
                            </td>
                            <td>
                                <span class="fw-semibold">Jakarta Selatan</span><br>
                                <small class="text-muted">Jl. Sudirman No. 123</small>
                            </td>
                            <td>
                                <span class="fw-bold">JNE</span><br>
                                <small class="text-muted">REG - Regular</small>
                            </td>
                            <td>
                                <span class="fw-semibold">25 Agt 2024</span><br>
                                <small class="text-muted">14:30 WIB</small>
                            </td>
                            <td>
                                <span class="status-badge status-shipping">Dalam Pengiriman</span>
                            </td>
                            <td>
                                <span class="fw-bold">Rp 35.000</span><br>
                                <small class="text-muted">+ Asuransi Rp 5.000</small>
                            </td>
                            <td>
                                <div class="action-dropdown">
                                    <button class="action-btn" onclick="toggleActionDropdown(this)">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="action-dropdown-menu">
                                        <a href="#" class="action-dropdown-item" data-bs-toggle="modal" data-bs-target="#detailModal1">
                                            <i class="fas fa-eye"></i>
                                            Lihat Detail
                                        </a>
                                        <a href="#" class="action-dropdown-item">
                                            <i class="fas fa-route"></i>
                                            Lacak Pengiriman
                                        </a>
                                        <a href="#" class="action-dropdown-item">
                                            <i class="fas fa-edit"></i>
                                            Update Status
                                        </a>
                                        <a href="#" class="action-dropdown-item">
                                            <i class="fas fa-print"></i>
                                            Cetak Label
                                        </a>
                                        <a href="#" class="action-dropdown-item text-danger">
                                            <i class="fas fa-times"></i>
                                            Batalkan
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fw-semibold">RSI001234568</span><br>
                                <small class="text-muted">Order #ORD-2024-002</small>
                            </td>
                            <td>
                                <span class="fw-semibold">Bandung</span><br>
                                <small class="text-muted">Jl. Asia Afrika No. 45</small>
                            </td>
                            <td>
                                <span class="fw-bold">POS Indonesia</span><br>
                                <small class="text-muted">Express - Kilat</small>
                            </td>
                            <td>
                                <span class="fw-semibold">24 Agt 2024</span><br>
                                <small class="text-muted">10:15 WIB</small>
                            </td>
                            <td>
                                <span class="status-badge status-delivered">Terkirim</span>
                            </td>
                            <td>
                                <span class="fw-bold">Rp 28.000</span><br>
                                <small class="text-muted">Gratis Asuransi</small>
                            </td>
                            <td>
                                <div class="action-dropdown">
                                    <button class="action-btn" onclick="toggleActionDropdown(this)">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="action-dropdown-menu">
                                        <a href="#" class="action-dropdown-item" data-bs-toggle="modal" data-bs-target="#detailModal2">
                                            <i class="fas fa-eye"></i>
                                            Lihat Detail
                                        </a>
                                        <a href="#" class="action-dropdown-item">
                                            <i class="fas fa-route"></i>
                                            Riwayat Pengiriman
                                        </a>
                                        <a href="#" class="action-dropdown-item">
                                            <i class="fas fa-star"></i>
                                            Beri Rating
                                        </a>
                                        <a href="#" class="action-dropdown-item">
                                            <i class="fas fa-print"></i>
                                            Cetak Bukti
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fw-semibold">RSI001234569</span><br>
                                <small class="text-muted">Order #ORD-2024-003</small>
                            </td>
                            <td>
                                <span class="fw-semibold">Surabaya</span><br>
                                <small class="text-muted">Jl. Pemuda No. 78</small>
                            </td>
                            <td>
                                <span class="fw-bold">J&T Express</span><br>
                                <small class="text-muted">REG - Regular</small>
                            </td>
                            <td>
                                <span class="fw-semibold">23 Agt 2024</span><br>
                                <small class="text-muted">16:45 WIB</small>
                            </td>
                            <td>
                                <span class="status-badge status-pending">Menunggu Pengiriman</span>
                            </td>
                            <td>
                                <span class="fw-bold">Rp 42.000</span><br>
                                <small class="text-muted">+ Asuransi Rp 8.000</small>
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
                                            <i class="fas fa-paper-plane"></i>
                                            Proses Pengiriman
                                        </a>
                                        <a href="#" class="action-dropdown-item">
                                            <i class="fas fa-edit"></i>
                                            Edit Data
                                        </a>
                                        <a href="#" class="action-dropdown-item">
                                            <i class="fas fa-print"></i>
                                            Cetak Label
                                        </a>
                                        <a href="#" class="action-dropdown-item text-danger">
                                            <i class="fas fa-trash"></i>
                                            Hapus
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
</div>

<!-- Modal Tambah Pengiriman -->
<div class="modal fade" id="tambahPengirimanModal" tabindex="-1" aria-labelledby="tambahPengirimanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, #f26b37 0%, #e55827 100%); color: white;">
                <h5 class="modal-title" id="tambahPengirimanModalLabel">
                    <i class="fas fa-plus-circle"></i>
                    Tambah Pengiriman Baru
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="order_id">Order ID</label>
                                <select class="form-control" id="order_id" required>
                                    <option value="">Pilih Order</option>
                                    <option value="ORD-2024-004">ORD-2024-004 - Jakarta</option>
                                    <option value="ORD-2024-005">ORD-2024-005 - Medan</option>
                                    <option value="ORD-2024-006">ORD-2024-006 - Denpasar</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="ekspedisi_baru">Ekspedisi</label>
                                <select class="form-control" id="ekspedisi_baru" required>
                                    <option value="">Pilih Ekspedisi</option>
                                    <option value="jne">JNE</option>
                                    <option value="pos">POS Indonesia</option>
                                    <option value="tiki">TIKI</option>
                                    <option value="jnt">J&T Express</option>
                                    <option value="sicepat">SiCepat</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="layanan">Layanan</label>
                                <select class="form-control" id="layanan" required>
                                    <option value="">Pilih Layanan</option>
                                    <option value="reg">Regular</option>
                                    <option value="express">Express</option>
                                    <option value="priority">Priority</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="estimasi">Estimasi Pengiriman</label>
                                <input type="text" class="form-control" id="estimasi" placeholder="contoh: 2-3 hari" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="biaya_kirim">Biaya Pengiriman</label>
                                <input type="number" class="form-control" id="biaya_kirim" placeholder="0" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="asuransi">Biaya Asuransi</label>
                                <input type="number" class="form-control" id="asuransi" placeholder="0">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="catatan">Catatan Pengiriman</label>
                        <textarea class="form-control" id="catatan" rows="3" placeholder="Catatan khusus untuk pengiriman..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                    Batal
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Simpan Pengiriman
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Pengiriman -->
<div class="modal fade" id="detailModal1" tabindex="-1" aria-labelledby="detailModal1Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, #f26b37 0%, #e55827 100%); color: white;">
                <h5 class="modal-title" id="detailModal1Label">
                    <i class="fas fa-info-circle"></i>
                    Detail Pengiriman - RSI001234567
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="fw-bold text-primary">Informasi Pengiriman</h6>
                        <table class="table table-sm">
                            <tr>
                                <td class="fw-semibold">No. Resi:</td>
                                <td>RSI001234567</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Order ID:</td>
                                <td>ORD-2024-001</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Ekspedisi:</td>
                                <td>JNE - Regular</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Status:</td>
                                <td><span class="status-badge status-shipping">Dalam Pengiriman</span></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold text-primary">Alamat Tujuan</h6>
                        <p class="mb-1"><strong>Andi Pratama</strong></p>
                        <p class="mb-1">Jl. Sudirman No. 123</p>
                        <p class="mb-1">Jakarta Selatan, DKI Jakarta</p>
                        <p class="mb-1">12190</p>
                        <p class="mb-3"><strong>HP:</strong> 0812-3456-7890</p>
                        
                        <h6 class="fw-bold text-primary">Biaya</h6>
                        <p class="mb-1">Ongkir: <strong>Rp 30.000</strong></p>
                        <p class="mb-1">Asuransi: <strong>Rp 5.000</strong></p>
                        <p class="mb-0">Total: <strong>Rp 35.000</strong></p>
                    </div>
                </div>
                
                <hr>
                
                <h6 class="fw-bold text-primary">Tracking Pengiriman</h6>
                <div class="timeline">
                    <div class="timeline-item">
                        <span class="timeline-date">25 Agt 2024 - 16:30</span>
                        <span class="timeline-desc">Paket dalam perjalanan menuju Jakarta Selatan</span>
                    </div>
                    <div class="timeline-item">
                        <span class="timeline-date">25 Agt 2024 - 14:30</span>
                        <span class="timeline-desc">Paket telah dikirim dari Yogyakarta</span>
                    </div>
                    <div class="timeline-item">
                        <span class="timeline-date">25 Agt 2024 - 10:00</span>
                        <span class="timeline-desc">Paket telah di-pickup oleh kurir JNE</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                    Tutup
                </button>
                <button type="button" class="btn btn-primary">
                    <i class="fas fa-print"></i>
                    Cetak Detail
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Action Dropdown Toggle Function
function toggleActionDropdown(button) {
    // Close all other dropdowns first
    document.querySelectorAll('.action-dropdown-menu').forEach(menu => {
        if (menu !== button.nextElementSibling) {
            menu.classList.remove('show');
        }
    });
    
    // Toggle current dropdown
    const menu = button.nextElementSibling;
    menu.classList.toggle('show');
}

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    if (!event.target.closest('.action-dropdown')) {
        document.querySelectorAll('.action-dropdown-menu').forEach(menu => {
            menu.classList.remove('show');
        });
    }
});

// Close dropdown when clicking on menu item
document.querySelectorAll('.action-dropdown-item').forEach(item => {
    item.addEventListener('click', function() {
        document.querySelectorAll('.action-dropdown-menu').forEach(menu => {
            menu.classList.remove('show');
        });
    });
});

// Filter functionality
document.querySelector('.btn-primary').addEventListener('click', function() {
    // Implement filter logic here
    console.log('Filter applied');
});

document.querySelector('.btn-secondary').addEventListener('click', function() {
    // Reset all form fields
    document.getElementById('status').value = '';
    document.getElementById('ekspedisi').value = '';
    document.getElementById('tanggal_dari').value = '';
    document.getElementById('tanggal_sampai').value = '';
    console.log('Filter reset');
});
</script>

      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah Pengiriman -->
<div class="modal fade" id="modalPengiriman" tabindex="-1" aria-labelledby="modalPengirimanLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="modalPengirimanLabel">Tambah Pengiriman Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Tanggal Pengiriman</label>
          <input type="date" class="form-control">
        </div>
        <div class="mb-3">
          <label class="form-label">Cabang Tujuan</label>
          <input type="text" class="form-control" placeholder="Masukkan nama cabang">
        </div>
        <div class="mb-3">
          <label class="form-label">Kode Pengiriman</label>
          <input type="text" class="form-control" placeholder="Masukkan kode pengiriman">
        </div>
        <div class="mb-3">
          <label class="form-label">Jumlah Barang</label>
          <input type="number" class="form-control" placeholder="Masukkan jumlah barang">
        </div>
        <div class="mb-3">
          <label class="form-label">Supir</label>
          <input type="text" class="form-control" placeholder="Masukkan nama supir">
        </div>
        <div class="mb-3">
          <label class="form-label">Status</label>
          <select class="form-select">
            <option value="Terkirim">Terkirim</option>
            <option value="Proses">Proses</option>
            <option value="Dibatalkan">Dibatalkan</option>
          </select>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary">Simpan</button>
      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection