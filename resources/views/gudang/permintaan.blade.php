@extends('layouts.appGudang')

@section('title', 'Permintaan Cabang - MyYOGYA')

@section('content')
<style>
/* Modern Permintaan Styles */
.permintaan-header {
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
    color: white;
    padding: 25px 30px;
    border-radius: 12px;
    margin-bottom: 25px;
    box-shadow: 0 4px 15px rgba(242, 107, 55, 0.3);
}

.permintaan-header h2 {
    font-size: 1.8rem;
    font-weight: 700;
    margin: 0;
}

.permintaan-header p {
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
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    border-left: 4px solid #f26b37;
    transition: transform 0.3s ease;
}

body.dark-mode .stat-card {
    background: #2a2d3f;
    border-left-color: #f26b37;
    color: #e2e8f0;
}

.stat-card:hover {
    transform: translateY(-2px);
}

.stat-number {
    font-size: 1.8rem;
    font-weight: 700;
    color: #f26b37;
    margin-bottom: 5px;
}

.stat-label {
    font-size: 0.9rem;
    color: #64748b;
    font-weight: 500;
}

body.dark-mode .stat-label {
    color: #94a3b8;
}

.modern-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    border: 1px solid #e2e8f0;
    overflow: hidden;
}

body.dark-mode .modern-card {
    background: #2a2d3f;
    border-color: #3a3d4a;
}

.card-header-modern {
    background: #f8fafc;
    padding: 20px 25px;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

body.dark-mode .card-header-modern {
    background: #252837;
    border-bottom-color: #3a3d4a;
}

.card-title-modern {
    font-size: 1.1rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0;
}

body.dark-mode .card-title-modern {
    color: #e2e8f0;
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
body.dark-mode .badge.bg-danger {
    background-color: #dc2626 !important;
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

body.dark-mode .badge.bg-info {
    background-color: #2563eb !important;
    color: #ffffff !important;
}

.modern-table tbody tr:hover {
    background: #f8fafc;
}

body.dark-mode .modern-table tbody tr:hover {
    background: #2a2d47 !important;
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
    border: none;
    padding: 8px 16px;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.btn-modern:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(242, 107, 55, 0.4);
    color: white;
}

.btn-outline-modern {
    background: transparent;
    color: #f26b37;
    border: 2px solid #f26b37;
    padding: 8px 16px;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-outline-modern:hover {
    background: #f26b37;
    color: white;
}

.priority-badge {
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

.priority-tinggi {
    background: #fee2e2;
    color: #dc2626;
}

.priority-sedang {
    background: #fef3c7;
    color: #d97706;
}

.priority-rendah {
    background: #dcfce7;
    color: #16a34a;
}

body.dark-mode .priority-tinggi {
    background: #7f1d1d;
    color: #fca5a5;
}

body.dark-mode .priority-sedang {
    background: #78350f;
    color: #fbbf24;
}

body.dark-mode .priority-rendah {
    background: #14532d;
    color: #86efac;
}

.filter-section {
    background: white;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

body.dark-mode .filter-section {
    background: #2a2d3f;
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
}

.form-control-modern:focus {
    border-color: #f26b37;
    box-shadow: 0 0 0 3px rgba(242, 107, 55, 0.1);
}

body.dark-mode .form-control-modern {
    background: #252837;
    border-color: #3a3d4a;
    color: #e2e8f0;
}

/* Action Dropdown Styles */
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
    color: #e2e8f0;
    border-bottom-color: #3a3d4a;
}

body.dark-mode .action-dropdown-item:hover {
    background: #252837;
    color: #f26b37;
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

<div class="permintaan-container">
    <!-- Header Section -->
    <div class="permintaan-header">
        <h2>Permintaan dari Cabang</h2>
        <p>Kelola permintaan stok dari seluruh cabang MyYOGYA</p>
    </div>

    <!-- Stats Section -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number">24</div>
            <div class="stat-label">Total Permintaan</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">8</div>
            <div class="stat-label">Menunggu Approval</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">12</div>
            <div class="stat-label">Diproses</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">4</div>
            <div class="stat-label">Selesai Hari Ini</div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <div class="filter-grid">
            <div>
                <label class="form-label-modern">Status</label>
                <select class="form-control form-control-modern">
                    <option>Semua Status</option>
                    <option>Menunggu</option>
                    <option>Diproses</option>
                    <option>Selesai</option>
                </select>
            </div>
            <div>
                <label class="form-label-modern">Cabang</label>
                <select class="form-control form-control-modern">
                    <option>Semua Cabang</option>
                    <option>Cabang Bandung</option>
                    <option>Cabang Jakarta</option>
                    <option>Cabang Surabaya</option>
                </select>
            </div>
            <div>
                <label class="form-label-modern">Prioritas</label>
                <select class="form-control form-control-modern">
                    <option>Semua Prioritas</option>
                    <option>Tinggi</option>
                    <option>Sedang</option>
                    <option>Rendah</option>
                </select>
            </div>
            <div>
                <label class="form-label-modern">&nbsp;</label>
                <button class="btn btn-modern w-100 form-control-modern" style="height: 48px;">
                    <i class="fas fa-search"></i>
                    Filter
                </button>
            </div>
        </div>
    </div>

    <!-- Main Table -->
    <div class="modern-card">
        <div class="card-header-modern">
            <h5 class="card-title-modern">
                <i class="fas fa-list-alt" style="color: #f26b37; margin-right: 10px;"></i>
                Daftar Permintaan Masuk
            </h5>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-modern">
                    <i class="fas fa-download"></i>
                    Export
                </button>
                <button class="btn btn-modern">
                    <i class="fas fa-sync-alt"></i>
                    Refresh
                </button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table modern-table">
                <thead>
                    <tr>
                        <th>ID Permintaan</th>
                        <th>Cabang</th>
                        <th>Tanggal</th>
                        <th>Total Item</th>
                        <th>Prioritas</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="fw-semibold">#REQ001</div>
                            <small class="text-muted">CB001</small>
                        </td>
                        <td>
                            <div class="fw-semibold">Cabang Bandung</div>
                            <small class="text-muted">Jl. Soekarno Hatta No.123</small>
                        </td>
                        <td>
                            <div>07 Agustus 2025</div>
                            <small class="text-muted">08:30 WIB</small>
                        </td>
                        <td>
                            <span class="fw-semibold">15 Item</span>
                        </td>
                        <td>
                            <span class="priority-badge priority-tinggi">Tinggi</span>
                        </td>
                        <td>
                            <span class="badge bg-warning">Menunggu</span>
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
                                        <i class="fas fa-edit"></i>
                                        Edit Permintaan
                                    </a>
                                    <a href="#" class="action-dropdown-item">
                                        <i class="fas fa-check"></i>
                                        Setujui
                                    </a>
                                    <a href="#" class="action-dropdown-item">
                                        <i class="fas fa-times"></i>
                                        Tolak
                                    </a>
                                    <a href="#" class="action-dropdown-item">
                                        <i class="fas fa-print"></i>
                                        Cetak
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="fw-semibold">#REQ002</div>
                            <small class="text-muted">CB002</small>
                        </td>
                        <td>
                            <div class="fw-semibold">Cabang Jakarta</div>
                            <small class="text-muted">Jl. Sudirman No.45</small>
                        </td>
                        <td>
                            <div>07 Agustus 2025</div>
                            <small class="text-muted">10:15 WIB</small>
                        </td>
                        <td>
                            <span class="fw-semibold">8 Item</span>
                        </td>
                        <td>
                            <span class="priority-badge priority-sedang">Sedang</span>
                        </td>
                        <td>
                            <span class="badge bg-info">Diproses</span>
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
                                        <i class="fas fa-edit"></i>
                                        Edit Permintaan
                                    </a>
                                    <a href="#" class="action-dropdown-item">
                                        <i class="fas fa-shipping-fast"></i>
                                        Proses Kirim
                                    </a>
                                    <a href="#" class="action-dropdown-item">
                                        <i class="fas fa-print"></i>
                                        Cetak
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="fw-semibold">#REQ003</div>
                            <small class="text-muted">CB003</small>
                        </td>
                        <td>
                            <div class="fw-semibold">Cabang Surabaya</div>
                            <small class="text-muted">Jl. Pemuda No.88</small>
                        </td>
                        <td>
                            <div>06 Agustus 2025</div>
                            <small class="text-muted">14:20 WIB</small>
                        </td>
                        <td>
                            <span class="fw-semibold">22 Item</span>
                        </td>
                        <td>
                            <span class="priority-badge priority-rendah">Rendah</span>
                        </td>
                        <td>
                            <span class="badge bg-success">Selesai</span>
                        </td>
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
                                        <i class="fas fa-download"></i>
                                        Download Laporan
                                    </a>
                                    <a href="#" class="action-dropdown-item">
                                        <i class="fas fa-copy"></i>
                                        Duplikasi
                                    </a>
                                    <a href="#" class="action-dropdown-item">
                                        <i class="fas fa-print"></i>
                                        Cetak
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

<!-- Modern Modal Detail -->
<div class="modal fade" id="detailModal1" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
            <div class="modal-header" style="background: linear-gradient(135deg, #f26b37, #e55827); color: white; border-radius: 12px 12px 0 0; border: none;">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-clipboard-list me-2"></i>
                    Detail Permintaan #REQ001
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="padding: 25px;">
                <!-- Info Section -->
                <div class="row mb-4">
                    <div class="col-lg-6">
                        <div class="modern-card">
                            <div class="card-header-modern">
                                <h6 class="card-title-modern">
                                    <i class="fas fa-info-circle" style="color: #f26b37;"></i>
                                    Informasi Permintaan
                                </h6>
                            </div>
                            <div class="p-3">
                                <div class="row g-2">
                                    <div class="col-sm-6">
                                        <small class="text-muted">ID Permintaan</small>
                                        <div class="fw-semibold">#REQ001</div>
                                    </div>
                                    <div class="col-sm-6">
                                        <small class="text-muted">Status</small>
                                        <div><span class="badge bg-warning">Menunggu</span></div>
                                    </div>
                                    <div class="col-sm-6">
                                        <small class="text-muted">Tanggal</small>
                                        <div class="fw-semibold">07 Agustus 2025</div>
                                    </div>
                                    <div class="col-sm-6">
                                        <small class="text-muted">Waktu</small>
                                        <div class="fw-semibold">08:30 WIB</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="modern-card">
                            <div class="card-header-modern">
                                <h6 class="card-title-modern">
                                    <i class="fas fa-store" style="color: #f26b37;"></i>
                                    Informasi Cabang
                                </h6>
                            </div>
                            <div class="p-3">
                                <div class="row g-2">
                                    <div class="col-sm-6">
                                        <small class="text-muted">ID Cabang</small>
                                        <div class="fw-semibold">CB001</div>
                                    </div>
                                    <div class="col-sm-6">
                                        <small class="text-muted">Prioritas</small>
                                        <div><span class="priority-badge priority-tinggi">Tinggi</span></div>
                                    </div>
                                    <div class="col-12">
                                        <small class="text-muted">Nama Cabang</small>
                                        <div class="fw-semibold">Cabang Bandung</div>
                                    </div>
                                    <div class="col-12">
                                        <small class="text-muted">Alamat</small>
                                        <div>Jl. Soekarno Hatta No.123, Bandung</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Products Table -->
                <div class="modern-card">
                    <div class="card-header-modern">
                        <h6 class="card-title-modern">
                            <i class="fas fa-boxes" style="color: #f26b37;"></i>
                            Daftar Produk yang Diminta (2 Items)
                        </h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table modern-table mb-0">
                            <thead>
                                <tr>
                                    <th>Kode Produk</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Jumlah</th>
                                    <th>Satuan</th>
                                    <th>Stok Tersedia</th>
                                    <th>Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="fw-semibold">PRD001</div>
                                    </td>
                                    <td>
                                        <div class="fw-semibold">Minyak Goreng Tropical</div>
                                        <small class="text-muted">Kemasan 1L</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">Sembako</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold text-primary">100</span>
                                    </td>
                                    <td>Liter</td>
                                    <td>
                                        <span class="fw-semibold text-success">250 Liter</span>
                                        <div><small class="text-muted">Stok Aman</small></div>
                                    </td>
                                    <td>
                                        <small>Permintaan mendesak karena stok cabang menipis</small>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="fw-semibold">PRD002</div>
                                    </td>
                                    <td>
                                        <div class="fw-semibold">Beras Premium Grade A</div>
                                        <small class="text-muted">Kemasan 5Kg</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">Sembako</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold text-primary">50</span>
                                    </td>
                                    <td>Kg</td>
                                    <td>
                                        <span class="fw-semibold text-warning">75 Kg</span>
                                        <div><small class="text-muted">Stok Terbatas</small></div>
                                    </td>
                                    <td>
                                        <small>Untuk persiapan stok minggu depan</small>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="border: none; padding: 20px 25px;">
                <div class="d-flex gap-2 w-100">
                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Tutup
                    </button>
                    <button class="btn btn-modern">
                        <i class="fas fa-print me-1"></i> Cetak
                    </button>
                    <button class="btn btn-success">
                        <i class="fas fa-check me-1"></i> Setujui Permintaan
                    </button>
                    <button class="btn btn-danger">
                        <i class="fas fa-times me-1"></i> Tolak Permintaan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
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
</script>
@endsection
