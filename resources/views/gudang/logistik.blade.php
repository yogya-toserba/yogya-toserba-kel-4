@extends('layouts.appGudanng')

@section('title', 'Manajemen Logistik - MyYOGYA')

@section('content')
<style>
/* Modern Layout */
body {
    background: #ffffff;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
}

/* Page Header */
.page-header {
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
    color: white;
    padding: 30px;
    border-radius: 20px;
    margin-bottom: 30px;
    box-shadow: 0 8px 32px rgba(242, 107, 55, 0.3);
}

.page-header h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 15px;
}

.page-header .subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
    margin-top: 8px;
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
    box-shadow: 0 8px 32px rgba(0,0,0,0.08);
    border: 1px solid rgba(255,255,255,0.2);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
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

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 16px 48px rgba(0,0,0,0.12);
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    color: white;
    margin-bottom: 15px;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1e293b;
    margin: 10px 0 5px 0;
}

.stat-label {
    color: #64748b;
    font-size: 0.95rem;
    font-weight: 500;
}

/* Filter Section */
.filter-section {
    background: white;
    border-radius: 16px;
    padding: 25px;
    margin-bottom: 25px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.08);
    border: 1px solid rgba(255,255,255,0.2);
}

.filter-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    align-items: end;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    font-weight: 600;
    color: #374151;
    margin-bottom: 8px;
    font-size: 0.9rem;
}

.form-control {
    padding: 12px 16px;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    background: #ffffff;
    color: #374151;
}

.form-control:focus {
    outline: none;
    border-color: #f26b37;
    box-shadow: 0 0 0 3px rgba(242, 107, 55, 0.1);
    background: #ffffff;
}

.form-control::placeholder {
    color: #9ca3af;
}

/* Button Styles */
.btn {
    padding: 12px 24px;
    border-radius: 12px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    border: 2px solid transparent;
    cursor: pointer;
    font-size: 0.95rem;
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
    color: white;
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

.button-group {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
    justify-content: flex-start;
    align-items: center;
}

/* Table Section */
.table-section {
    background: white;
    border-radius: 16px;
    padding: 30px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.1);
    border: 1px solid rgba(255,255,255,0.2);
}

.table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    padding-bottom: 20px;
    border-bottom: 2px solid #f1f5f9;
}

.table-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0;
}

/* Modern Table */
.modern-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 16px rgba(0,0,0,0.05);
}

.modern-table thead {
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
}

.modern-table th {
    padding: 18px 20px;
    text-align: left;
    font-weight: 600;
    color: white;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border: none;
}

.modern-table td {
    padding: 16px 20px;
    border-bottom: 1px solid #f1f5f9;
    color: #374151;
    font-size: 0.95rem;
    vertical-align: middle;
}

.modern-table tbody tr {
    transition: all 0.2s ease;
}

.modern-table tbody tr:hover {
    background-color: #f8fafc;
    transform: scale(1.01);
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}

.modern-table tbody tr:last-child td {
    border-bottom: none;
}

/* Status Badges */
.badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.badge.bg-success {
    background: #34d399 !important;
    color: #064e3b !important;
}

.badge.bg-warning {
    background: #fbbf24 !important;
    color: #92400e !important;
}

.badge.bg-danger {
    background: #f87171 !important;
    color: #7f1d1d !important;
}

.badge.bg-info {
    background: #60a5fa !important;
    color: #1e3a8a !important;
}

/* Action Buttons */
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
    font-size: 0.9rem;
    transition: all 0.3s ease;
    border-bottom: 1px solid #f1f5f9;
}

.action-dropdown-item:last-child {
    border-bottom: none;
}

.action-dropdown-item:hover {
    background: #f8fafc;
    color: #f26b37;
}

.action-dropdown-item i {
    margin-right: 8px;
    width: 16px;
}

/* Dark Mode Support */
body.dark-mode {
    background: #0f172a;
    color: #e2e8f0;
}

body.dark-mode .page-header {
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
}

body.dark-mode .stat-card {
    background: #252837;
    border-color: #3a3d4a;
    color: #e2e8f0;
}

body.dark-mode .stat-number {
    color: #ffffff;
}

body.dark-mode .stat-label {
    color: #94a3b8;
}

body.dark-mode .filter-section {
    background: #252837;
    border-color: #3a3d4a;
}

body.dark-mode .form-group label {
    color: #e2e8f0;
}

body.dark-mode .form-control {
    background: #374151;
    border-color: #4b5563;
    color: #e2e8f0;
}

body.dark-mode .form-control:focus {
    border-color: #f26b37;
    background: #374151;
}

body.dark-mode .form-control::placeholder {
    color: #9ca3af;
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

body.dark-mode .table-section {
    background: #252837;
    border-color: #3a3d4a;
}

body.dark-mode .table-title {
    color: #ffffff;
}

body.dark-mode .modern-table {
    background: #252837;
}

body.dark-mode .modern-table td {
    border-color: #3a3d4a;
    color: #ffffff !important;
    background-color: #1e2139;
}

body.dark-mode .modern-table tbody tr:hover {
    background-color: #2a2d47 !important;
}

body.dark-mode .modern-table td .fw-semibold,
body.dark-mode .modern-table td .fw-bold {
    color: #ffffff !important;
}

body.dark-mode .modern-table td .text-muted {
    color: #d1d5db !important;
}

body.dark-mode .badge.bg-success {
    background: #34d399 !important;
    color: #064e3b !important;
}

body.dark-mode .badge.bg-warning {
    background: #fbbf24 !important;
    color: #92400e !important;
}

body.dark-mode .badge.bg-danger {
    background: #f87171 !important;
    color: #7f1d1d !important;
}

body.dark-mode .badge.bg-info {
    background: #60a5fa !important;
    color: #1e3a8a !important;
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

body.dark-mode .action-dropdown-menu {
    background: #2a2d3f;
    border-color: #3a3d4a;
}

body.dark-mode .action-dropdown-item {
    color: #e2e8f0;
    border-color: #3a3d4a;
}

body.dark-mode .action-dropdown-item:hover {
    background: #374151;
    color: #f26b37;
}

/* Form Enhancements for Dark Mode */
body.dark-mode select.form-control {
    background: #374151 !important;
    color: #e2e8f0 !important;
    border-color: #4b5563 !important;
}

body.dark-mode select.form-control option {
    background: #374151 !important;
    color: #e2e8f0 !important;
}

body.dark-mode input[type="date"].form-control {
    background: #374151 !important;
    color: #e2e8f0 !important;
    border-color: #4b5563 !important;
}

body.dark-mode input[type="date"].form-control::-webkit-calendar-picker-indicator {
    filter: invert(1);
}

body.dark-mode textarea.form-control {
    background: #374151 !important;
    color: #e2e8f0 !important;
    border-color: #4b5563 !important;
}

/* Modal Enhancements for Dark Mode */
body.dark-mode .modal-content {
    background: #252837 !important;
    border-color: #3a3d4a !important;
}

body.dark-mode .modal-header {
    border-color: #3a3d4a !important;
}

body.dark-mode .modal-footer {
    border-color: #3a3d4a !important;
}

body.dark-mode .modal-title {
    color: #ffffff !important;
}

body.dark-mode .btn-close {
    filter: invert(1);
}

/* Responsive Design */
@media (max-width: 768px) {
    .filter-grid {
        grid-template-columns: 1fr;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .table-header {
        flex-direction: column;
        gap: 15px;
        align-items: stretch;
    }
    
    .button-group {
        justify-content: center;
    }
    
    .page-header h1 {
        font-size: 2rem;
    }
}
</style>

<div class="content">
    <!-- Page Header -->
    <div class="page-header">
        <h1>
            <i class="fas fa-truck"></i>
            Manajemen Logistik
        </h1>
        <p class="subtitle">Kelola distribusi dan pengiriman barang dengan efisien</p>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);">
                <i class="fas fa-truck-loading"></i>
            </div>
            <div class="stat-number">42</div>
            <div class="stat-label">Dalam Proses</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #10b981 0%, #047857 100%);">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-number">156</div>
            <div class="stat-label">Terkirim</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-number">8</div>
            <div class="stat-label">Tertunda</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="stat-number">2</div>
            <div class="stat-label">Bermasalah</div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <div class="filter-grid">
            <div class="form-group">
                <label for="status">Status Logistik</label>
                <select class="form-control" id="status">
                    <option value="">Semua Status</option>
                    <option value="pending">Dalam Proses</option>
                    <option value="shipped">Terkirim</option>
                    <option value="delayed">Tertunda</option>
                    <option value="problem">Bermasalah</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="tujuan">Tujuan</label>
                <select class="form-control" id="tujuan">
                    <option value="">Semua Tujuan</option>
                    <option value="cabang1">Cabang Malioboro</option>
                    <option value="cabang2">Cabang Sleman</option>
                    <option value="cabang3">Cabang Bantul</option>
                    <option value="gudang">Gudang Pusat</option>
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
            
            <div class="button-group">
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

    <!-- Table Section -->
    <div class="table-section">
        <div class="table-header">
            <h2 class="table-title">Daftar Logistik</h2>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahLogistikModal">
                <i class="fas fa-plus"></i>
                Tambah Logistik
            </button>
        </div>
        
        <div class="table-responsive">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>No. Resi</th>
                        <th>Tanggal</th>
                        <th>Asal</th>
                        <th>Tujuan</th>
                        <th>Jenis Barang</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="fw-semibold">LOG001234567</td>
                        <td>25 Agt 2024</td>
                        <td>Gudang Pusat</td>
                        <td>Cabang Malioboro</td>
                        <td>Elektronik</td>
                        <td><span class="fw-bold">120 Item</span></td>
                        <td><span class="badge bg-success">Terkirim</span></td>
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
                                        Edit Status
                                    </a>
                                    <a href="#" class="action-dropdown-item">
                                        <i class="fas fa-print"></i>
                                        Cetak Label
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="fw-semibold">LOG001234568</td>
                        <td>24 Agt 2024</td>
                        <td>Cabang Sleman</td>
                        <td>Gudang Pusat</td>
                        <td>Fashion</td>
                        <td><span class="fw-bold">85 Item</span></td>
                        <td><span class="badge bg-warning">Dalam Proses</span></td>
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
                                        Lacak Pengiriman
                                    </a>
                                    <a href="#" class="action-dropdown-item">
                                        <i class="fas fa-edit"></i>
                                        Edit Status
                                    </a>
                                    <a href="#" class="action-dropdown-item">
                                        <i class="fas fa-print"></i>
                                        Cetak Label
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="fw-semibold">LOG001234569</td>
                        <td>23 Agt 2024</td>
                        <td>Gudang Pusat</td>
                        <td>Cabang Bantul</td>
                        <td>Makanan & Minuman</td>
                        <td><span class="fw-bold">200 Item</span></td>
                        <td><span class="badge bg-danger">Tertunda</span></td>
                        <td>
                            <div class="action-dropdown">
                                <button class="action-btn" onclick="toggleActionDropdown(this)">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="action-dropdown-menu">
                                    <a href="#" class="action-dropdown-item" data-bs-toggle="modal" data-bs-target="#detailModal3">
                                        <i class="fas fa-eye"></i>
                                        Lihat Detail
                                    </a>
                                    <a href="#" class="action-dropdown-item">
                                        <i class="fas fa-route"></i>
                                        Lacak Pengiriman
                                    </a>
                                    <a href="#" class="action-dropdown-item">
                                        <i class="fas fa-edit"></i>
                                        Edit Status
                                    </a>
                                    <a href="#" class="action-dropdown-item">
                                        <i class="fas fa-print"></i>
                                        Cetak Label
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

<!-- Modal Tambah Logistik -->
<div class="modal fade" id="tambahLogistikModal" tabindex="-1" aria-labelledby="tambahLogistikModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahLogistikModalLabel">Tambah Data Logistik</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="no_resi" class="form-label">No. Resi</label>
                                <input type="text" class="form-control" id="no_resi" placeholder="Masukkan nomor resi">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tanggal_kirim" class="form-label">Tanggal Kirim</label>
                                <input type="date" class="form-control" id="tanggal_kirim">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="asal" class="form-label">Asal</label>
                                <select class="form-control" id="asal">
                                    <option value="">Pilih Asal</option>
                                    <option value="gudang">Gudang Pusat</option>
                                    <option value="cabang1">Cabang Malioboro</option>
                                    <option value="cabang2">Cabang Sleman</option>
                                    <option value="cabang3">Cabang Bantul</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tujuan_kirim" class="form-label">Tujuan</label>
                                <select class="form-control" id="tujuan_kirim">
                                    <option value="">Pilih Tujuan</option>
                                    <option value="gudang">Gudang Pusat</option>
                                    <option value="cabang1">Cabang Malioboro</option>
                                    <option value="cabang2">Cabang Sleman</option>
                                    <option value="cabang3">Cabang Bantul</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="jenis_barang" class="form-label">Jenis Barang</label>
                                <select class="form-control" id="jenis_barang">
                                    <option value="">Pilih Jenis Barang</option>
                                    <option value="elektronik">Elektronik</option>
                                    <option value="fashion">Fashion</option>
                                    <option value="makanan">Makanan & Minuman</option>
                                    <option value="rumah_tangga">Rumah Tangga</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="jumlah_item" class="form-label">Jumlah Item</label>
                                <input type="number" class="form-control" id="jumlah_item" placeholder="0">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="status_logistik" class="form-label">Status</label>
                        <select class="form-control" id="status_logistik">
                            <option value="pending">Dalam Proses</option>
                            <option value="shipped">Terkirim</option>
                            <option value="delayed">Tertunda</option>
                            <option value="problem">Bermasalah</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan" rows="3" placeholder="Masukkan keterangan tambahan"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Detail Modals -->
<div class="modal fade" id="detailModal1" tabindex="-1" aria-labelledby="detailModal1Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModal1Label">Detail Logistik - LOG001234567</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>No. Resi:</strong> LOG001234567</p>
                        <p><strong>Tanggal Kirim:</strong> 25 Agustus 2024</p>
                        <p><strong>Asal:</strong> Gudang Pusat</p>
                        <p><strong>Tujuan:</strong> Cabang Malioboro</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Jenis Barang:</strong> Elektronik</p>
                        <p><strong>Jumlah Item:</strong> 120 Item</p>
                        <p><strong>Status:</strong> <span class="badge bg-success">Terkirim</span></p>
                        <p><strong>Estimasi Tiba:</strong> 26 Agustus 2024</p>
                    </div>
                </div>
                <hr>
                <h6>Timeline Pengiriman:</h6>
                <ul class="list-unstyled">
                    <li class="mb-2">✅ <strong>25 Agt 2024 08:00</strong> - Barang dikirim dari Gudang Pusat</li>
                    <li class="mb-2">✅ <strong>25 Agt 2024 10:30</strong> - Dalam perjalanan ke Cabang Malioboro</li>
                    <li class="mb-2">✅ <strong>25 Agt 2024 14:15</strong> - Barang telah tiba di Cabang Malioboro</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary">Cetak Label</button>
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

// Filter and Reset functionality
document.querySelector('.btn-primary').addEventListener('click', function() {
    // Filter logic here
    console.log('Filter applied');
});

document.querySelector('.btn-secondary').addEventListener('click', function() {
    // Reset all form fields
    document.getElementById('status').value = '';
    document.getElementById('tujuan').value = '';
    document.getElementById('tanggal_dari').value = '';
    document.getElementById('tanggal_sampai').value = '';
    console.log('Filter reset');
});
</script>
@endsection