@extends('layouts.navbar_admin')

@section('title', 'Laporan Keuangan - MyYOGYA')

@push('styles')
<style>
/* Table Styling - Mirror Data Karyawan Style */
.table-responsive {
    border-radius: 8px !important;
    background: white !important;
    box-shadow: 0 2px 4px rgba(0,0,0,0.02);
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

body.dark-mode .table tfoot tr {
    background: #2a2d3f !important;
}

body.dark-mode .table tfoot th {
    background: #2a2d3f !important;
    color: #94a3b8 !important;
    border-color: #3a3d4a !important;
}

/* TABLE TEXT COLORS DARK MODE */
body.dark-mode .table strong {
    color: #e2e8f0 !important;
}

body.dark-mode .table small {
    color: #94a3b8 !important;
}

/* Badge Styles - Same as Data Karyawan */
.badge-aktif {
    background: #dcfce7 !important;
    color: #15803d !important;
    font-weight: 500 !important;
    padding: 6px 12px !important;
    border-radius: 20px !important;
    font-size: 0.75rem !important;
}

.badge-security {
    background: #dbeafe !important;
    color: #1d4ed8 !important;
    font-weight: 500 !important;
    padding: 4px 10px !important;
    border-radius: 15px !important;
    font-size: 0.7rem !important;
}

.badge-customer-service {
    background: #f3e8ff !important;
    color: #7c3aed !important;
    font-weight: 500 !important;
    padding: 4px 10px !important;
    border-radius: 15px !important;
    font-size: 0.7rem !important;
}

.badge-penjualan {
    background: #fef3c7 !important;
    color: #92400e !important;
    font-weight: 500 !important;
    padding: 4px 10px !important;
    border-radius: 15px !important;
    font-size: 0.7rem !important;
}

.badge-it {
    background: #ddd6fe !important;
    color: #5b21b6 !important;
    font-weight: 500 !important;
    padding: 4px 10px !important;
    border-radius: 15px !important;
    font-size: 0.7rem !important;
}

.badge-gudang {
    background: #fed7d7 !important;
    color: #c53030 !important;
    font-weight: 500 !important;
    padding: 4px 10px !important;
    border-radius: 15px !important;
    font-size: 0.7rem !important;
}

.badge-keuangan {
    background: #d1fae5 !important;
    color: #047857 !important;
    font-weight: 500 !important;
    padding: 4px 10px !important;
    border-radius: 15px !important;
    font-size: 0.7rem !important;
}

.badge-hrd {
    background: #fce7f3 !important;
    color: #be185d !important;
    font-weight: 500 !important;
    padding: 4px 10px !important;
    border-radius: 15px !important;
    font-size: 0.7rem !important;
}

/* Action Buttons - Enhanced Modern Style */
.action-dropdown {
    position: relative;
    display: inline-block;
}

.action-dropdown-btn {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border: 1px solid #dee2e6;
    font-size: 1rem;
    color: #495057;
    cursor: pointer;
    padding: 8px 12px;
    border-radius: 8px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 4px rgba(0,0,0,0.08);
    position: relative;
    overflow: hidden;
}

.action-dropdown-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
    transition: left 0.5s;
}

.action-dropdown-btn:hover::before {
    left: 100%;
}

.action-dropdown-btn:hover {
    background: linear-gradient(135deg, #e9ecef, #dee2e6);
    color: #212529;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    border-color: #adb5bd;
}

.action-dropdown-btn:active {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

.action-dropdown-menu {
    display: none;
    position: absolute;
    right: 0;
    top: calc(100% + 8px);
    background: white;
    border-radius: 12px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.12), 0 8px 25px rgba(0,0,0,0.08);
    z-index: 1000;
    min-width: 180px;
    padding: 8px 0;
    border: 1px solid rgba(0,0,0,0.08);
    opacity: 0;
    transform: translateY(-10px) scale(0.95);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    backdrop-filter: blur(20px);
    background: rgba(255,255,255,0.95);
}

.action-dropdown-menu::before {
    content: '';
    position: absolute;
    top: -6px;
    right: 20px;
    width: 12px;
    height: 12px;
    background: white;
    border-left: 1px solid rgba(0,0,0,0.08);
    border-top: 1px solid rgba(0,0,0,0.08);
    transform: rotate(45deg);
}

.action-dropdown.show .action-dropdown-menu {
    display: block;
    opacity: 1;
    transform: translateY(0) scale(1);
}

.action-dropdown-item {
    display: flex;
    align-items: center;
    width: 100%;
    padding: 12px 20px;
    border: none;
    background: none;
    text-align: left;
    font-size: 0.875rem;
    color: #374151;
    cursor: pointer;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    font-weight: 500;
    position: relative;
    overflow: hidden;
}

.action-dropdown-item::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 0;
    height: 100%;
    background: linear-gradient(90deg, rgba(99, 102, 241, 0.1), rgba(99, 102, 241, 0.05));
    transition: width 0.3s ease;
}

.action-dropdown-item:hover::before {
    width: 100%;
}

.action-dropdown-item:hover {
    background: rgba(249, 250, 251, 0.8);
    transform: translateX(4px);
    padding-left: 24px;
}

.action-dropdown-item i {
    width: 16px;
    margin-right: 12px;
    font-size: 0.875rem;
    transition: transform 0.2s ease;
}

.action-dropdown-item:hover i {
    transform: scale(1.1);
}

/* Specific styling for different action types */
.action-dropdown-item.view-item {
    color: #059669;
}

.action-dropdown-item.view-item:hover {
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(5, 150, 105, 0.05));
    color: #047857;
}

.action-dropdown-item.edit-item {
    color: #3B82F6;
}

.action-dropdown-item.edit-item:hover {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(37, 99, 235, 0.05));
    color: #1D4ED8;
}

.action-dropdown-item.warning-item {
    color: #F59E0B;
}

.action-dropdown-item.warning-item:hover {
    background: linear-gradient(135deg, rgba(245, 158, 11, 0.1), rgba(217, 119, 6, 0.05));
    color: #D97706;
}

.action-dropdown-item.delete-item {
    color: #EF4444;
}

.action-dropdown-item.delete-item:hover {
    background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(220, 38, 38, 0.05));
    color: #DC2626;
}

/* Dark mode support for dropdown */
body.dark-mode .action-dropdown-btn {
    background: linear-gradient(135deg, #374151, #4B5563);
    border-color: #6B7280;
    color: #F9FAFB;
}

body.dark-mode .action-dropdown-btn:hover {
    background: linear-gradient(135deg, #4B5563, #6B7280);
    color: #FFFFFF;
}

body.dark-mode .action-dropdown-menu {
    background: rgba(31, 41, 55, 0.95);
    border-color: rgba(75, 85, 99, 0.3);
}

body.dark-mode .action-dropdown-menu::before {
    background: #1F2937;
    border-color: rgba(75, 85, 99, 0.3);
}

body.dark-mode .action-dropdown-item {
    color: #E5E7EB;
}

body.dark-mode .action-dropdown-item:hover {
    background: rgba(55, 65, 81, 0.6);
}

/* Header Buttons - Same as Data Karyawan */
.btn-orange {
    background: linear-gradient(135deg, #f26b37, #e55827) !important;
    border: none !important;
    color: white !important;
    font-weight: 500 !important;
    padding: 8px 16px !important;
    border-radius: 8px !important;
    transition: all 0.3s ease !important;
}

.btn-orange:hover {
    background: linear-gradient(135deg, #e55827, #d44a1a) !important;
    color: white !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 4px 12px rgba(242, 107, 55, 0.3) !important;
}

.btn-outline-orange {
    border: 2px solid #f26b37 !important;
    color: #f26b37 !important;
    background: transparent !important;
    font-weight: 500 !important;
    padding: 6px 14px !important;
    border-radius: 8px !important;
    transition: all 0.3s ease !important;
}

.btn-outline-orange:hover {
    background: #f26b37 !important;
    color: white !important;
    transform: translateY(-1px) !important;
}
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h3 mb-1" style="color: white; font-weight: 600;">
                <i class="fas fa-chart-line me-2"></i>Laporan Keuangan
            </h2>
            <p class="text-muted mb-0" style="color: rgba(255,255,255,0.7) !important;">Generate dan analisis laporan keuangan perusahaan</p>
        </div>
        <div class="btn-group">
            <button class="btn btn-orange" id="exportPdfBtn" onclick="exportToPDF()">
                <i class="fas fa-download me-2"></i>Export
            </button>
            <button class="btn btn-outline-orange" id="filterBtn">
                <i class="fas fa-filter me-2"></i>Filter
            </button>
        </div>
    </div>

<div class="card-custom">
    <div class="card-header">
        <h5 class="card-title mb-0"><i class="fas fa-file-alt me-2"></i>Generator Laporan Keuangan</h5>
    </div>
    <div class="card-body">

        <!-- Filter Laporan -->
        <form id="laporanForm" method="GET" action="{{ route('admin.laporan') }}" style="display: none;">
        <div class="row mb-4" style="background: rgba(255,255,255,0.1); padding: 25px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.2); backdrop-filter: blur(10px);">
            <div class="col-md-3">
                <label class="form-label fw-bold" style="color: white;">Jenis Laporan:</label>
                <select class="form-select" id="jenisLaporan" name="jenis_laporan" style="border: 2px solid rgba(255,255,255,0.2); border-radius: 8px; padding: 12px 15px; font-weight: 500; background: rgba(255,255,255,0.1); color: white; backdrop-filter: blur(5px);">
                    <option value="" style="background: #2a2d3f; color: white;">Pilih Laporan</option>
                    <option value="neraca" {{ request('jenis_laporan') == 'neraca' ? 'selected' : '' }} style="background: #2a2d3f; color: white;">Neraca</option>
                    <option value="laba_rugi" {{ request('jenis_laporan') == 'laba_rugi' ? 'selected' : '' }} style="background: #2a2d3f; color: white;">Laporan Laba Rugi</option>
                    <option value="arus_kas" {{ request('jenis_laporan') == 'arus_kas' ? 'selected' : '' }} style="background: #2a2d3f; color: white;">Laporan Arus Kas</option>
                    <option value="ekuitas" {{ request('jenis_laporan') == 'ekuitas' ? 'selected' : '' }} style="background: #2a2d3f; color: white;">Perubahan Ekuitas</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label" style="color: white;">Periode:</label>
                <input type="month" class="form-control" id="periode" name="periode" value="{{ request('periode', date('Y-m')) }}" style="border: 2px solid rgba(255,255,255,0.2); border-radius: 8px; padding: 12px 15px; background: rgba(255,255,255,0.1); color: white; backdrop-filter: blur(5px);">
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-orange w-100">Tampilkan</button>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="button" class="btn btn-outline-orange w-100" onclick="exportToPDF()">Export PDF</button>
            </div>
        </div>
        </form>

        <!-- Tabel Laporan -->
        <div class="table-responsive">
            <table class="table table-sm">
                <thead style="background: white;">
                    <tr>
                        <th style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none;">#</th>
                        <th style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none;">Nama Karyawan</th>
                        <th style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none;">Jabatan</th>
                        <th style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none;">Departemen</th>
                        <th style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none;">Status</th>
                        <th style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none;">Bergabung</th>
                        <th style="font-size: 0.8rem; font-weight: 600; color: #64748b; border: none; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">1</td>
                        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                            <div style="display: flex; align-items: center;">
                                <img src="/image/default-avatar.png" alt="Foto" style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover; margin-right: 12px;">
                                <div>
                                    <strong style="color: #1e293b;">Abyasa Jagaraga Haryanto S.T.</strong>
                                    <br>
                                    <small style="color: #64748b;">wahyuni.amalia@example.net</small>
                                </div>
                            </div>
                        </td>
                        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                            <strong style="color: #1e293b;">Security</strong>
                        </td>
                        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                            <span class="badge-security">Security</span>
                        </td>
                        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                            <span class="badge-aktif">Aktif</span>
                        </td>
                        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                            <small style="color: #64748b;">01 Sep 2025</small>
                        </td>
                        <td style="font-size: 0.85rem; border: none; padding: 12px 0; text-align: center;">
                            <div class="action-dropdown">
                                <button class="action-dropdown-btn" onclick="toggleDropdown(this)">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="action-dropdown-menu">
                                    <button class="action-dropdown-item view-item" onclick="viewEmployee(1)">
                                        <i class="fas fa-eye"></i>Detail
                                    </button>
                                    <button class="action-dropdown-item edit-item" onclick="editEmployee(1)">
                                        <i class="fas fa-edit"></i>Edit
                                    </button>
                                    <button class="action-dropdown-item warning-item" onclick="toggleStatus(1, 'Non-Aktif')">
                                        <i class="fas fa-user-slash"></i>Non-Aktifkan
                                    </button>
                                    <button class="action-dropdown-item delete-item" onclick="deleteEmployee(1)">
                                        <i class="fas fa-trash"></i>Hapus
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">2</td>
                        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                            <div style="display: flex; align-items: center;">
                                <img src="/image/default-avatar.png" alt="Foto" style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover; margin-right: 12px;">
                                <div>
                                    <strong style="color: #1e293b;">Ade Citra Mandasari</strong>
                                    <br>
                                    <small style="color: #64748b;">fatimah.kuswoyo@example.com</small>
                                </div>
                            </div>
                        </td>
                        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                            <strong style="color: #1e293b;">Customer Service</strong>
                        </td>
                        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                            <span class="badge-customer-service">Customer Service</span>
                        </td>
                        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                            <span class="badge-aktif">Aktif</span>
                        </td>
                        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                            <small style="color: #64748b;">01 Sep 2025</small>
                        </td>
                        <td style="font-size: 0.85rem; border: none; padding: 12px 0; text-align: center;">
                            <div class="action-dropdown">
                                <button class="action-dropdown-btn" onclick="toggleDropdown(this)">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="action-dropdown-menu">
                                    <button class="action-dropdown-item view-item">
                                        <i class="fas fa-eye me-2"></i>Detail
                                    </button>
                                    <button class="action-dropdown-item edit-item">
                                        <i class="fas fa-edit me-2"></i>Edit
                                    </button>
                                    <button class="action-dropdown-item delete-item">
                                        <i class="fas fa-trash me-2"></i>Hapus
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">3</td>
                        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                            <div style="display: flex; align-items: center;">
                                <img src="/image/default-avatar.png" alt="Foto" style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover; margin-right: 12px;">
                                <div>
                                    <strong style="color: #1e293b;">Ade Salahudin</strong>
                                    <br>
                                    <small style="color: #64748b;">wahyu34@example.net</small>
                                </div>
                            </div>
                        </td>
                        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                            <strong style="color: #1e293b;">Penjualan</strong>
                        </td>
                        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                            <span class="badge-penjualan">Penjualan</span>
                        </td>
                        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                            <span class="badge-aktif">Aktif</span>
                        </td>
                        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                            <small style="color: #64748b;">01 Sep 2025</small>
                        </td>
                        <td style="font-size: 0.85rem; border: none; padding: 12px 0; text-align: center;">
                            <div class="action-dropdown">
                                <button class="action-dropdown-btn" onclick="toggleDropdown(this)">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="action-dropdown-menu">
                                    <button class="action-dropdown-item view-item">
                                        <i class="fas fa-eye me-2"></i>Detail
                                    </button>
                                    <button class="action-dropdown-item edit-item">
                                        <i class="fas fa-edit me-2"></i>Edit
                                    </button>
                                    <button class="action-dropdown-item delete-item">
                                        <i class="fas fa-trash me-2"></i>Hapus
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">4</td>
                        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                            <div style="display: flex; align-items: center;">
                                <img src="/image/default-avatar.png" alt="Foto" style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover; margin-right: 12px;">
                                <div>
                                    <strong style="color: #1e293b;">Adiarja Firgantoro M.Ak</strong>
                                    <br>
                                    <small style="color: #64748b;">aisyah18@example.com</small>
                                </div>
                            </div>
                        </td>
                        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                            <strong style="color: #1e293b;">IT</strong>
                        </td>
                        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                            <span class="badge-it">IT</span>
                        </td>
                        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                            <span class="badge-aktif">Aktif</span>
                        </td>
                        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                            <small style="color: #64748b;">01 Sep 2025</small>
                        </td>
                        <td style="font-size: 0.85rem; border: none; padding: 12px 0; text-align: center;">
                            <div class="action-dropdown">
                                <button class="action-dropdown-btn" onclick="toggleDropdown(this)">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="action-dropdown-menu">
                                    <button class="action-dropdown-item view-item">
                                        <i class="fas fa-eye me-2"></i>Detail
                                    </button>
                                    <button class="action-dropdown-item edit-item">
                                        <i class="fas fa-edit me-2"></i>Edit
                                    </button>
                                    <button class="action-dropdown-item delete-item">
                                        <i class="fas fa-trash me-2"></i>Hapus
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">5</td>
                        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                            <div style="display: flex; align-items: center;">
                                <img src="/image/default-avatar.png" alt="Foto" style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover; margin-right: 12px;">
                                <div>
                                    <strong style="color: #1e293b;">Adinata Darsirah Jailani</strong>
                                    <br>
                                    <small style="color: #64748b;">asmanto40@example.com</small>
                                </div>
                            </div>
                        </td>
                        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                            <strong style="color: #1e293b;">Gudang</strong>
                        </td>
                        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                            <span class="badge-gudang">Gudang</span>
                        </td>
                        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                            <span class="badge-aktif">Aktif</span>
                        </td>
                        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
                            <small style="color: #64748b;">01 Sep 2025</small>
                        </td>
                        <td style="font-size: 0.85rem; border: none; padding: 12px 0; text-align: center;">
                            <div class="action-dropdown">
                                <button class="action-dropdown-btn" onclick="toggleDropdown(this)">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="action-dropdown-menu">
                                    <button class="action-dropdown-item view-item">
                                        <i class="fas fa-eye me-2"></i>Detail
                                    </button>
                                    <button class="action-dropdown-item edit-item">
                                        <i class="fas fa-edit me-2"></i>Edit
                                    </button>
                                    <button class="action-dropdown-item delete-item">
                                        <i class="fas fa-trash me-2"></i>Hapus
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Fungsi Export PDF
function exportToPDF() {
    const jenisLaporan = document.getElementById('jenisLaporan').value;
    const periode = document.getElementById('periode').value;
    
    if (!jenisLaporan) {
        alert('Silakan pilih jenis laporan terlebih dahulu!');
        return;
    }
    
    // Show loading state
    const btnPDF = document.getElementById('exportPdfBtn');
    const originalText = btnPDF.innerHTML;
    btnPDF.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Generating PDF...';
    btnPDF.disabled = true;
    
    // Build URL with parameters
    let url = '{{ route("admin.keuangan.export.pdf") }}';
    const params = new URLSearchParams();
    
    if (jenisLaporan) params.append('jenis_laporan', jenisLaporan);
    if (periode) params.append('periode', periode);
    
    if (params.toString()) {
        url += '?' + params.toString();
    }
    
    // Open PDF in new tab
    window.open(url, '_blank');
    
    // Reset button after 2 seconds
    setTimeout(() => {
        btnPDF.innerHTML = originalText;
        btnPDF.disabled = false;
    }, 2000);
}

// Fungsi Export Excel
function exportToExcel() {
    const jenisLaporan = document.getElementById('jenisLaporan').value;
    const periode = document.getElementById('periode').value;
    
    if (!jenisLaporan) {
        alert('Silakan pilih jenis laporan terlebih dahulu!');
        return;
    }
    
    // Show loading state
    const btnExcel = document.getElementById('exportExcelBtn');
    const originalText = btnExcel.innerHTML;
    btnExcel.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Generating Excel...';
    btnExcel.disabled = true;
    
    // Build URL with parameters (untuk future implementation)
    let url = '{{ route("admin.keuangan.export.pdf") }}';
    const params = new URLSearchParams();
    
    if (jenisLaporan) params.append('jenis_laporan', jenisLaporan);
    if (periode) params.append('periode', periode);
    params.append('format', 'excel'); // Add format parameter
    
    if (params.toString()) {
        url += '?' + params.toString();
    }
    
    // For now, show alert (until Excel export is implemented)
    alert('Fitur Export Excel sedang dalam pengembangan. Silakan gunakan Export PDF terlebih dahulu.');
    
    // Reset button
    setTimeout(() => {
        btnExcel.innerHTML = originalText;
        btnExcel.disabled = false;
    }, 1000);
}

// Auto-submit form when filters change (optional)
document.getElementById('jenisLaporan').addEventListener('change', function() {
    if (this.value) {
        // Optional: auto-submit form when jenis laporan changes
        // document.getElementById('laporanForm').submit();
    }
});

document.getElementById('periode').addEventListener('change', function() {
    if (this.value && document.getElementById('jenisLaporan').value) {
        // Optional: auto-submit form when periode changes
        // document.getElementById('laporanForm').submit();
    }
});

// Dropdown functionality
function toggleDropdown(button) {
    // Close all other dropdowns
    document.querySelectorAll('.action-dropdown').forEach(dropdown => {
        if (dropdown !== button.parentElement) {
            dropdown.classList.remove('show');
        }
    });
    
    // Toggle current dropdown
    button.parentElement.classList.toggle('show');
}

// Close dropdowns when clicking outside
document.addEventListener('click', function(event) {
    if (!event.target.closest('.action-dropdown')) {
        document.querySelectorAll('.action-dropdown').forEach(dropdown => {
            dropdown.classList.remove('show');
        });
    }
});

// Filter button functionality
document.getElementById('filterBtn').addEventListener('click', function() {
    const filterForm = document.getElementById('laporanForm');
    if (filterForm.style.display === 'none' || !filterForm.style.display) {
        filterForm.style.display = 'block';
        this.classList.add('active');
    } else {
        filterForm.style.display = 'none';
        this.classList.remove('active');
    }
});
</script>
@endpush
