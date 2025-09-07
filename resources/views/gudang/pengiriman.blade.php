@extends('layouts.appGudang')

@section('title', 'Pengiriman - MyYOGYA')

@section('content')
<!-- Ensure Bootstrap CSS is loaded -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Add CSRF token for AJAX requests -->
<meta name="csrf-token" content="{{ csrf_token() }}"
<style>
/* Modern Pengiriman Styles - Same as Permintaan */
.pengiriman-header {
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
    color: white;
    padding: 25px 30px;
    border-radius: 12px;
    margin-bottom: 25px;
    box-shadow: 0 4px 15px rgba(242, 107, 55, 0.3);
}

.pengiriman-header h2 {
    font-size: 1.8rem;
    font-weight: 700;
    margin: 0;
}

.pengiriman-header p {
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
}

.stat-card:hover {
    transform: translateY(-2px);
}

.stat-number {
    font-size: 2rem;
    font-weight: bold;
    color: #f26b37;
    margin-bottom: 5px;
}

.stat-label {
    color: #64748b;
    font-size: 0.9rem;
    font-weight: 500;
}

body.dark-mode .stat-label {
    color: #94a3b8;
}

.modern-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    border: 1px solid #f1f5f9;
    margin-bottom: 25px;
}

body.dark-mode .modern-card {
    background: #2a2d3f;
    border-color: #3a3d4a;
}

.card-header-modern {
    padding: 20px 25px;
    border-bottom: 1px solid #f1f5f9;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

body.dark-mode .card-header-modern {
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

/* Status Badge Styles */
.status-badge {
    padding: 5px 12px;
    border-radius: 20px;
    font-weight: 500;
    font-size: 0.8rem;
    text-transform: uppercase;
}

.status-badge.status-menunggu {
    background: linear-gradient(135deg, #fbbf24, #f59e0b);
    color: white;
}

.status-badge.status-dikirim {
    background: linear-gradient(135deg, #60a5fa, #3b82f6);
    color: white;
}

.status-badge.status-selesai {
    background: linear-gradient(135deg, #34d399, #10b981);
    color: white;
}

.status-badge.status-dibatalkan {
    background: linear-gradient(135deg, #f87171, #ef4444);
    color: white;
}

/* Status Badge Dark Mode Improvements */
body.dark-mode .status-badge.status-menunggu {
    background: linear-gradient(135deg, #f59e0b, #d97706) !important;
    color: #ffffff !important;
}

body.dark-mode .status-badge.status-dikirim {
    background: linear-gradient(135deg, #3b82f6, #2563eb) !important;
    color: #ffffff !important;
}

body.dark-mode .status-badge.status-selesai {
    background: linear-gradient(135deg, #059669, #047857) !important;
    color: #ffffff !important;
}

body.dark-mode .status-badge.status-dibatalkan {
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

.filter-section {
    background: white;
    border-radius: 12px;
    padding: 20px 25px;
    margin-bottom: 25px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    border: 1px solid #f1f5f9;
}

body.dark-mode .filter-section {
    background: #2a2d3f;
    border-color: #3a3d4a;
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
    gap: 4px;
}

.action-btn:hover {
    border-color: #f26b37;
    color: #f26b37;
}

body.dark-mode .action-btn {
    background: #252837;
    border-color: #3a3d4a;
    color: #e2e8f0;
}

body.dark-mode .action-btn:hover {
    border-color: #f26b37;
    color: #f26b37;
}

.action-dropdown-menu {
    position: absolute;
    top: 100%;
    right: 0;
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    min-width: 150px;
    z-index: 1000;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
}

body.dark-mode .action-dropdown-menu {
    background: #2a2d3f;
    border-color: #3a3d4a;
}

.action-dropdown.active .action-dropdown-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
    display: block;
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

<div class="pengiriman-container">
    <!-- Header Section -->
    <div class="pengiriman-header">
        <h2>Manajemen Pengiriman</h2>
        <p>Kelola dan pantau status pengiriman barang ke seluruh cabang</p>
    </div>

    <!-- Stats Section -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number">{{ isset($pengiriman) ? collect($pengiriman)->where('status', 'Menunggu')->count() : 24 }}</div>
            <div class="stat-label">Menunggu Pengiriman</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ isset($pengiriman) ? collect($pengiriman)->where('status', 'Dikirim')->count() : 18 }}</div>
            <div class="stat-label">Dalam Pengiriman</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ isset($pengiriman) ? collect($pengiriman)->where('status', 'Selesai')->count() : 156 }}</div>
            <div class="stat-label">Terkirim</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ isset($pengiriman) ? collect($pengiriman)->where('status', 'Dibatalkan')->count() : 3 }}</div>
            <div class="stat-label">Dikembalikan</div>
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
                    <option>Dikirim</option>
                    <option>Selesai</option>
                    <option>Dibatalkan</option>
                </select>
            </div>
            <div>
                <label class="form-label-modern">Ekspedisi</label>
                <select class="form-control form-control-modern">
                    <option>Semua Ekspedisi</option>
                    <option>JNE</option>
                    <option>J&T</option>
                    <option>SiCepat</option>
                    <option>Pos Indonesia</option>
                </select>
            </div>
            <div>
                <label class="form-label-modern">Cabang Tujuan</label>
                <select class="form-control form-control-modern">
                    <option>Semua Cabang</option>
                    <option>Cabang Bandung</option>
                    <option>Cabang Jakarta</option>
                    <option>Cabang Surabaya</option>
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
                <i class="fas fa-shipping-fast" style="color: #f26b37; margin-right: 10px;"></i>
                Daftar Pengiriman
            </h5>
            <div class="d-flex gap-2">
                <button class="btn btn-modern">
                    <i class="fas fa-plus"></i>
                    Buat Pengiriman
                </button>
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
                        <th>No. Resi</th>
                        <th>Tanggal</th>
                        <th>Cabang Tujuan</th>
                        <th>Jumlah Item</th>
                        <th>Ekspedisi</th>
                        <th>Status</th>
                        <th>Estimasi</th>
                        <th>Aksi</th>
                    </tr>
                    @if(isset($pengiriman) && count($pengiriman) > 0)
                        @foreach($pengiriman as $index => $item)
                        <tr>
                            <td>
                                <div class="fw-semibold">#{{ $item['no_resi'] ?? 'PGR'.str_pad($index+1, 3, '0', STR_PAD_LEFT) }}</div>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $item['tanggal'] ?? date('d/m/Y') }}</div>
                                <small class="text-muted">{{ $item['waktu'] ?? date('H:i') }}</small>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $item['cabang'] ?? 'Cabang Jakarta' }}</div>
                                <small class="text-muted">{{ $item['alamat'] ?? 'Jl. Sudirman No. 123' }}</small>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $item['jumlah_item'] ?? rand(5, 50) }} item</div>
                                <small class="text-muted">{{ $item['berat'] ?? rand(1, 10) }} kg</small>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $item['ekspedisi'] ?? 'JNE' }}</div>
                                <small class="text-muted">{{ $item['layanan'] ?? 'REG' }}</small>
                            </td>
                            <td>
                                @php
                                    $status = $item['status'] ?? 'Menunggu';
                                    $statusClass = '';
                                    switch(strtolower($status)) {
                                        case 'menunggu': $statusClass = 'status-menunggu'; break;
                                        case 'dikirim': $statusClass = 'status-dikirim'; break;
                                        case 'selesai': $statusClass = 'status-selesai'; break;
                                        case 'dibatalkan': $statusClass = 'status-dibatalkan'; break;
                                        default: $statusClass = 'status-menunggu';
                                    }
                                @endphp
                                <span class="status-badge {{ $statusClass }}">{{ $status }}</span>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $item['estimasi'] ?? '2-3 hari' }}</div>
                                <small class="text-muted">{{ $item['estimasi_tanggal'] ?? date('d/m/Y', strtotime('+3 days')) }}</small>
                            </td>
                            <td>
                                <div class="action-dropdown">
                                    <button class="action-btn" onclick="toggleDropdown(this)">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="action-dropdown-menu">
                                        <a href="#" class="action-dropdown-item">
                                            <i class="fas fa-eye"></i>
                                            Detail
                                        </a>
                                        <a href="#" class="action-dropdown-item">
                                            <i class="fas fa-edit"></i>
                                            Edit
                                        </a>
                                        <a href="#" class="action-dropdown-item">
                                            <i class="fas fa-print"></i>
                                            Cetak Label
                                        </a>
                                        <a href="#" class="action-dropdown-item">
                                            <i class="fas fa-truck"></i>
                                            Lacak
                                        </a>
                                        <a href="#" class="action-dropdown-item text-danger">
                                            <i class="fas fa-times"></i>
                                            Batalkan
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <!-- Sample Data Rows -->
                        <tr>
                            <td>
                                <div class="fw-semibold">#PGR001</div>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ date('d/m/Y') }}</div>
                                <small class="text-muted">{{ date('H:i') }}</small>
                            </td>
                            <td>
                                <div class="fw-semibold">Cabang Jakarta</div>
                                <small class="text-muted">Jl. Sudirman No. 123</small>
                            </td>
                            <td>
                                <div class="fw-semibold">25 item</div>
                                <small class="text-muted">5.2 kg</small>
                            </td>
                            <td>
                                <div class="fw-semibold">JNE</div>
                                <small class="text-muted">REG</small>
                            </td>
                            <td>
                                <span class="status-badge status-dikirim">Dikirim</span>
                            </td>
                            <td>
                                <div class="fw-semibold">2-3 hari</div>
                                <small class="text-muted">{{ date('d/m/Y', strtotime('+3 days')) }}</small>
                            </td>
                            <td>
                                <div class="action-dropdown">
                                    <button class="action-btn" onclick="toggleDropdown(this)">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="action-dropdown-menu">
                                        <a href="#" class="action-dropdown-item">
                                            <i class="fas fa-eye"></i>
                                            Detail
                                        </a>
                                        <a href="#" class="action-dropdown-item">
                                            <i class="fas fa-edit"></i>
                                            Edit
                                        </a>
                                        <a href="#" class="action-dropdown-item">
                                            <i class="fas fa-print"></i>
                                            Cetak Label
                                        </a>
                                        <a href="#" class="action-dropdown-item">
                                            <i class="fas fa-truck"></i>
                                            Lacak
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
                                <div class="fw-semibold">#PGR002</div>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ date('d/m/Y', strtotime('-1 day')) }}</div>
                                <small class="text-muted">14:30</small>
                            </td>
                            <td>
                                <div class="fw-semibold">Cabang Bandung</div>
                                <small class="text-muted">Jl. Asia Afrika No. 45</small>
                            </td>
                            <td>
                                <div class="fw-semibold">12 item</div>
                                <small class="text-muted">2.8 kg</small>
                            </td>
                            <td>
                                <div class="fw-semibold">J&T</div>
                                <small class="text-muted">EXPRESS</small>
                            </td>
                            <td>
                                <span class="status-badge status-selesai">Selesai</span>
                            </td>
                            <td>
                                <div class="fw-semibold">1-2 hari</div>
                                <small class="text-muted">{{ date('d/m/Y', strtotime('+1 day')) }}</small>
                            </td>
                            <td>
                                <div class="action-dropdown">
                                    <button class="action-btn" onclick="toggleDropdown(this)">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="action-dropdown-menu">
                                        <a href="#" class="action-dropdown-item">
                                            <i class="fas fa-eye"></i>
                                            Detail
                                        </a>
                                        <a href="#" class="action-dropdown-item">
                                            <i class="fas fa-print"></i>
                                            Cetak Label
                                        </a>
                                        <a href="#" class="action-dropdown-item">
                                            <i class="fas fa-truck"></i>
                                            Lacak
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="fw-semibold">#PGR003</div>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ date('d/m/Y') }}</div>
                                <small class="text-muted">09:15</small>
                            </td>
                            <td>
                                <div class="fw-semibold">Cabang Surabaya</div>
                                <small class="text-muted">Jl. Pemuda No. 88</small>
                            </td>
                            <td>
                                <div class="fw-semibold">8 item</div>
                                <small class="text-muted">1.5 kg</small>
                            </td>
                            <td>
                                <div class="fw-semibold">SiCepat</div>
                                <small class="text-muted">REGULAR</small>
                            </td>
                            <td>
                                <span class="status-badge status-menunggu">Menunggu</span>
                            </td>
                            <td>
                                <div class="fw-semibold">3-4 hari</div>
                                <small class="text-muted">{{ date('d/m/Y', strtotime('+4 days')) }}</small>
                            </td>
                            <td>
                                <div class="action-dropdown">
                                    <button class="action-btn" onclick="toggleDropdown(this)">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="action-dropdown-menu">
                                        <a href="#" class="action-dropdown-item">
                                            <i class="fas fa-eye"></i>
                                            Detail
                                        </a>
                                        <a href="#" class="action-dropdown-item">
                                            <i class="fas fa-edit"></i>
                                            Edit
                                        </a>
                                        <a href="#" class="action-dropdown-item">
                                            <i class="fas fa-shipping-fast"></i>
                                            Proses
                                        </a>
                                        <a href="#" class="action-dropdown-item text-danger">
                                            <i class="fas fa-times"></i>
                                            Batalkan
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
// Toggle dropdown function
function toggleDropdown(button) {
    const dropdown = button.closest('.action-dropdown');
    const isActive = dropdown.classList.contains('active');
    
    // Close all other dropdowns
    document.querySelectorAll('.action-dropdown').forEach(d => d.classList.remove('active'));
    
    // Toggle current dropdown
    if (!isActive) {
        dropdown.classList.add('active');
    }
}

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    if (!event.target.closest('.action-dropdown')) {
        document.querySelectorAll('.action-dropdown').forEach(d => d.classList.remove('active'));
    }
});

// Close dropdown when pressing escape
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        document.querySelectorAll('.action-dropdown').forEach(d => d.classList.remove('active'));
    }
});
</script>
@endsection
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
            <p class="page-subtitle">Kelola dan pantau status pengiriman barang ke seluruh cabang</p>
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
                            <th>No. Permintaan</th>
                            <th>Produk</th>
                            <th>Tujuan</th>
                            <th>Tanggal Kirim</th>
                            <th>Status</th>
                            <th>Total Item</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data dari session permintaan yang dikirim -->
                        @if(isset($sessionPengiriman) && count($sessionPengiriman) > 0)
                            @foreach($sessionPengiriman as $index => $pengiriman)
                            <tr>
                                <td>
                                    <span class="fw-semibold">{{ $pengiriman['no_permintaan'] }}</span><br>
                                    <small class="text-muted">ID: {{ $pengiriman['id_pengiriman'] }}</small>
                                </td>
                                <td>
                                    <div class="fw-semibold">{{ Str::limit($pengiriman['produk'], 50) }}</div>
                                    <small class="text-muted">{{ $pengiriman['total_items'] }} item total</small>
                                </td>
                                <td>
                                    <span class="fw-semibold">{{ $pengiriman['tujuan'] }}</span><br>
                                    <small class="text-muted">{{ $pengiriman['penanggung_jawab'] }}</small>
                                </td>
                                <td>
                                    <div>{{ date('d M Y', strtotime($pengiriman['tanggal_kirim'])) }}</div>
                                    <small class="text-muted">{{ date('H:i', strtotime($pengiriman['tanggal_kirim'])) }} WIB</small>
                                </td>
                                <td>
                                    @php
                                        $statusClass = match($pengiriman['status']) {
                                            'Siap Kirim' => 'bg-warning',
                                            'Dalam Perjalanan' => 'bg-info',
                                            'Selesai' => 'bg-success',
                                            default => 'bg-secondary'
                                        };
                                    @endphp
                                    <span class="badge {{ $statusClass }}">{{ $pengiriman['status'] }}</span>
                                </td>
                                <td>
                                    <span class="fw-semibold">{{ $pengiriman['total_items'] }}</span><br>
                                    <small class="text-muted">{{ $pengiriman['prioritas'] }}</small>
                                </td>
                                <td>
                                    <div class="action-dropdown">
                                        <button class="action-btn">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="action-dropdown-menu">
                                            <a href="#" class="action-dropdown-item" 
                                               onclick="lihatDetailPengiriman('{{ $pengiriman['id_pengiriman'] }}', {{ $index }})">
                                                <i class="fas fa-eye"></i>
                                                Lihat Detail
                                            </a>
                                            @if($pengiriman['status'] === 'Menunggu')
                                                <a href="#" class="action-dropdown-item text-success"
                                                   onclick="terimaPengiriman('{{ $pengiriman['id_pengiriman'] }}', {{ $index }})">
                                                    <i class="fas fa-check"></i>
                                                    Terima
                                                </a>
                                                <a href="#" class="action-dropdown-item text-danger"
                                                   onclick="tolakPengiriman('{{ $pengiriman['id_pengiriman'] }}', {{ $index }})">
                                                    <i class="fas fa-times"></i>
                                                    Tolak
                                                </a>
                                            @elseif($pengiriman['status'] === 'Siap Kirim')
                                                <a href="#" class="action-dropdown-item text-success"
                                                   onclick="mulaiPengiriman('{{ $pengiriman['id_pengiriman'] }}', {{ $index }})">
                                                    <i class="fas fa-truck"></i>
                                                    Siap Kirim
                                                </a>
                                                <a href="#" class="action-dropdown-item text-primary"
                                                   onclick="selesaiPengiriman('{{ $pengiriman['id_pengiriman'] }}', {{ $index }})">
                                                    <i class="fas fa-check-circle"></i>
                                                    Selesai Pengiriman
                                                </a>
                                            @elseif($pengiriman['status'] === 'Dalam Perjalanan')
                                                <a href="#" class="action-dropdown-item text-primary"
                                                   onclick="selesaiPengiriman('{{ $pengiriman['id_pengiriman'] }}', {{ $index }})">
                                                    <i class="fas fa-check-circle"></i>
                                                    Selesai Pengiriman
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                        
                        <!-- Data dari database pengiriman lainnya -->
                        @if(isset($pengiriman) && $pengiriman->count() > 0)
                            @foreach($pengiriman as $item)
                            <tr>
                                <td>
                                    <span class="fw-semibold">{{ $item->id ?? 'PGR-' . str_pad($item->id ?? 1, 6, '0', STR_PAD_LEFT) }}</span><br>
                                    <small class="text-muted">{{ $item->kode_pengiriman ?? 'N/A' }}</small>
                                </td>
                                <td>
                                    <div class="fw-semibold">{{ $item->nama_produk ?? $item->produk ?? 'Produk tidak tersedia' }}</div>
                                    <small class="text-muted">{{ $item->jumlah ?? 0 }} item</small>
                                </td>
                                <td>
                                    <span class="fw-semibold">{{ $item->tujuan ?? 'Tujuan tidak tersedia' }}</span><br>
                                    <small class="text-muted">{{ $item->alamat ?? 'Alamat tidak tersedia' }}</small>
                                </td>
                                <td>
                                    <div>{{ date('d M Y', strtotime($item->tanggal_kirim ?? $item->created_at)) }}</div>
                                    <small class="text-muted">{{ date('H:i', strtotime($item->tanggal_kirim ?? $item->created_at)) }} WIB</small>
                                </td>
                                <td>
                                    @php
                                        $dbStatus = $item->status ?? 'pending';
                                        $statusClass = match(strtolower($dbStatus)) {
                                            'pending' => 'bg-warning',
                                            'dikirim', 'siap_kirim' => 'bg-info',
                                            'dalam_perjalanan' => 'bg-primary',
                                            'selesai' => 'bg-success',
                                            'ditolak' => 'bg-danger',
                                            default => 'bg-secondary'
                                        };
                                        
                                        // Map status display names
                                        $statusDisplay = match(strtolower($dbStatus)) {
                                            'pending' => 'Menunggu',
                                            'dikirim' => 'Diterima',
                                            'siap_kirim' => 'Siap Kirim',
                                            'dalam_perjalanan' => 'Dalam Perjalanan',
                                            'selesai' => 'Selesai',
                                            'ditolak' => 'Ditolak',
                                            default => ucfirst($dbStatus)
                                        };
                                    @endphp
                                    <span class="badge {{ $statusClass }}">{{ $statusDisplay }}</span>
                                    @if(strtolower($dbStatus) === 'ditolak' && !empty($item->keterangan))
                                        <br><small class="text-muted mt-1 d-block">{{ $item->keterangan }}</small>
                                    @endif
                                </td>
                                <td>
                                    <span class="fw-semibold">{{ $item->jumlah ?? 0 }}</span><br>
                                    <small class="text-muted">{{ $item->prioritas ?? 'Normal' }}</small>
                                </td>
                                <td>
                                    <div class="action-dropdown">
                                        <button class="action-btn">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="action-dropdown-menu">
                                            <a href="{{ route('gudang.pengiriman.show', $item->id) }}" class="action-dropdown-item">
                                                <i class="fas fa-eye"></i>
                                                Lihat Detail
                                            </a>
                                            @if(strtolower($item->status ?? 'pending') === 'pending')
                                                <a href="#" class="action-dropdown-item text-success"
                                                   onclick="terimaPengirimanDB({{ $item->id }}, 'dikirim')">
                                                    <i class="fas fa-check"></i>
                                                    Terima
                                                </a>
                                                <a href="#" class="action-dropdown-item text-danger"
                                                   onclick="tolakPengirimanDB({{ $item->id }}, 'ditolak')">
                                                    <i class="fas fa-times"></i>
                                                    Tolak
                                                </a>
                                                <a href="{{ route('gudang.pengiriman.edit', $item->id) }}" class="action-dropdown-item">
                                                    <i class="fas fa-edit"></i>
                                                    Edit Pengiriman
                                                </a>
                                            @elseif(in_array(strtolower($item->status ?? 'pending'), ['dikirim', 'siap_kirim']))
                                                <a href="#" class="action-dropdown-item text-success"
                                                   onclick="mulaiPengirimanDB({{ $item->id }}, 'dalam_perjalanan')">
                                                    <i class="fas fa-truck"></i>
                                                    Siap Kirim
                                                </a>
                                                <a href="#" class="action-dropdown-item text-primary"
                                                   onclick="selesaiPengirimanDB({{ $item->id }}, 'selesai')">
                                                    <i class="fas fa-check-circle"></i>
                                                    Selesai Pengiriman
                                                </a>
                                            @elseif(strtolower($item->status ?? 'pending') === 'dalam_perjalanan')
                                                <a href="#" class="action-dropdown-item text-primary"
                                                   onclick="selesaiPengirimanDB({{ $item->id }}, 'selesai')">
                                                    <i class="fas fa-check-circle"></i>
                                                    Selesai Pengiriman
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                        
                        <!-- Jika tidak ada data -->
                        @if((!isset($sessionPengiriman) || count($sessionPengiriman) === 0) && (!isset($pengiriman) || $pengiriman->count() === 0))
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-inbox fa-3x mb-3 opacity-50"></i>
                                    <p class="mb-0">Belum ada data pengiriman</p>
                                    <small>Permintaan yang sudah diterima dan dikirim akan muncul di sini</small>
                                </div>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Alert Container untuk Notifikasi -->
<div id="alertContainer" style="position: fixed; top: 20px; right: 20px; z-index: 9999;"></div>

<!-- Display success/error messages -->
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
    <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

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
                <form id="tambahPengirimanForm" method="POST" action="{{ route('gudang.pengiriman.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="id_produk">Produk *</label>
                                <select class="form-control" id="id_produk" name="id_produk" required>
                                    <option value="">Pilih Produk</option>
                                    @if(isset($produkList))
                                        @foreach($produkList as $produk)
                                            <option value="{{ $produk->id_produk }}" data-stok="{{ $produk->jumlah }}">
                                                {{ $produk->nama_produk }} (Stok: {{ $produk->jumlah }})
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="tujuan">Tujuan *</label>
                                <input type="text" class="form-control" id="tujuan" name="tujuan" placeholder="Alamat tujuan" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="jumlah">Jumlah *</label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" placeholder="Jumlah produk" required>
                                <small class="form-text text-muted">Stok tersedia: <span id="stok-tersedia">0</span></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="tanggal_kirim">Tanggal Kirim *</label>
                                <input type="date" class="form-control" id="tanggal_kirim" name="tanggal_kirim" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="status">Status *</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="pending">Pending</option>
                                    <option value="dikirim">Dikirim</option>
                                    <option value="selesai">Selesai</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan tambahan">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                    Batal
                </button>
                <button type="button" class="btn btn-primary" onclick="submitPengiriman(event)">
                    <i class="fas fa-save"></i>
                    Simpan Pengiriman
                </button>
                <button type="submit" class="btn btn-warning" style="display: none;" id="fallbackSubmit">
                    <i class="fas fa-save"></i>
                    Submit (Fallback)
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
            </div>
        </div>
    </div>
</div>

<!-- Modal Tolak Pengiriman -->
<div class="modal fade" id="tolakPengirimanModal" tabindex="-1" aria-labelledby="tolakPengirimanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); color: white;">
                <h5 class="modal-title" id="tolakPengirimanModalLabel">
                    <i class="fas fa-times-circle"></i>
                    Tolak Pengiriman
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="tolakPengirimanForm">
                    <div class="form-group mb-3">
                        <label for="alasan_tolak">Alasan Penolakan *</label>
                        <textarea class="form-control" id="alasan_tolak" name="alasan_tolak" rows="4" 
                                  placeholder="Masukkan alasan penolakan pengiriman..." required></textarea>
                        <div class="form-text">Berikan alasan yang jelas mengapa pengiriman ini ditolak.</div>
                    </div>
                    <input type="hidden" id="pengiriman_id_tolak" name="pengiriman_id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                    Batal
                </button>
                <button type="button" class="btn btn-danger" onclick="confirmTolakPengiriman()">
                    <i class="fas fa-times-circle"></i>
                    Tolak Pengiriman
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Load Bootstrap JS first -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Ensure CSRF token is available for all AJAX requests
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

// Function to show dynamic alerts
function showAlert(message, type = 'success') {
    const alertContainer = document.getElementById('alertContainer');
    const alertId = 'alert-' + Date.now();
    
    const alertHtml = `
        <div id="${alertId}" class="alert alert-${type} alert-dismissible fade show" role="alert">
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-triangle'}"></i> ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    
    alertContainer.insertAdjacentHTML('beforeend', alertHtml);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        const alert = document.getElementById(alertId);
        if (alert) {
            alert.remove();
        }
    }, 5000);
}

// Initialize tooltips and modals
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Initialize modals
    var modalElements = document.querySelectorAll('.modal');
    modalElements.forEach(function(modalElement) {
        var modal = new bootstrap.Modal(modalElement);
    });
    
    // Initialize dropdown functionality
    initializeDropdowns();
    
    // Set default date to today
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('tanggal_kirim').value = today;
    
    // Handle product selection change
    document.getElementById('id_produk').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const stok = selectedOption.getAttribute('data-stok') || 0;
        document.getElementById('stok-tersedia').textContent = stok;
        
        // Reset and set max value for quantity input
        const jumlahInput = document.getElementById('jumlah');
        jumlahInput.value = '';
        jumlahInput.max = stok;
    });
});

// Function to initialize dropdown functionality
function initializeDropdowns() {
    console.log('Initializing dropdowns...');
    
    // Toggle dropdown when clicking action button
    document.addEventListener('click', function(event) {
        if (event.target.closest('.action-btn')) {
            event.preventDefault();
            event.stopPropagation();
            
            console.log('Dropdown button clicked');
            
            const btn = event.target.closest('.action-btn');
            const dropdown = btn.nextElementSibling;
            const allDropdowns = document.querySelectorAll('.action-dropdown-menu');
            
            console.log('Dropdown element found:', dropdown);
            
            // Close all other dropdowns
            allDropdowns.forEach(menu => {
                if (menu !== dropdown) {
                    menu.classList.remove('show');
                }
            });
            
            // Toggle current dropdown
            dropdown.classList.toggle('show');
            
            console.log('Dropdown show class toggled. Has show class:', dropdown.classList.contains('show'));
        }
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (!event.target.closest('.action-dropdown')) {
            document.querySelectorAll('.action-dropdown-menu').forEach(menu => {
                menu.classList.remove('show');
            });
        }
    });
    
    // Close dropdown when clicking on menu item
    document.addEventListener('click', function(event) {
        if (event.target.closest('.action-dropdown-item')) {
            document.querySelectorAll('.action-dropdown-menu').forEach(menu => {
                menu.classList.remove('show');
            });
        }
    });
}
});

// Function to submit pengiriman form with proper validation
function submitPengiriman(event) {
    event.preventDefault();
    console.log('submitPengiriman function called');
    
    const form = document.getElementById('tambahPengirimanForm');
    const formData = new FormData(form);
    
    console.log('Form data prepared');
    console.log('Form action:', form.action);
    
    // Debug form data
    for (let [key, value] of formData.entries()) {
        console.log(key, value);
    }
    
    // Validate stock availability
    const selectedProduct = document.getElementById('id_produk');
    const selectedOption = selectedProduct.options[selectedProduct.selectedIndex];
    const availableStock = parseInt(selectedOption.getAttribute('data-stok') || 0);
    const requestedQty = parseInt(formData.get('jumlah'));
    
    console.log('Stock validation:', {
        available: availableStock,
        requested: requestedQty
    });
    
    if (requestedQty > availableStock) {
        console.log('Stock validation failed');
        showAlert(`Jumlah yang diminta (${requestedQty}) melebihi stok yang tersedia (${availableStock})`, 'danger');
        return false;
    }
    
    // Show loading state
    const submitBtn = event.target;
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
    submitBtn.disabled = true;
    
    console.log('Starting AJAX request to:', form.action);
    
    // Submit via AJAX for better error handling
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        }
    })
    .then(response => {
        console.log('Response received:', response.status, response.statusText);
        if (!response.ok) {
            return response.json().then(err => {
                console.log('Error response:', err);
                return Promise.reject(err);
            });
        }
        return response.json();
    })
    .then(data => {
        console.log('Success response:', data);
        if (data.success || data.redirect) {
            showAlert('Data pengiriman berhasil disimpan!', 'success');
            setTimeout(() => {
                window.location.reload();
            }, 1500);
        } else {
            throw new Error(data.message || 'Terjadi kesalahan');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        let errorMessage = 'Terjadi kesalahan saat menyimpan data';
        
        if (error.errors) {
            // Laravel validation errors
            const errorList = Object.values(error.errors).flat();
            errorMessage = errorList.join('\n');
        } else if (error.message) {
            errorMessage = error.message;
        }
        
        console.log('Showing fallback submit button');
        document.getElementById('fallbackSubmit').style.display = 'inline-block';
        showAlert(errorMessage + '\n\nCoba gunakan tombol Submit (Fallback) jika AJAX gagal.', 'danger');
    })
    .finally(() => {
        // Reset button state
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    });
}

// Action Dropdown Toggle Function with better event handling
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

// Functions for Terima/Tolak Pengiriman (Session Data)
function terimaPengiriman(idPengiriman, index) {
    if (confirm('Apakah Anda yakin ingin menerima pengiriman ini?')) {
        updatePengirimanStatus(idPengiriman, index, 'Siap Kirim');
    }
}

function tolakPengiriman(idPengiriman, index) {
    document.getElementById('pengiriman_id_tolak').value = idPengiriman;
    document.getElementById('alasan_tolak').value = '';
    
    // Store index for later use
    window.currentPengirimanIndex = index;
    
    const modal = new bootstrap.Modal(document.getElementById('tolakPengirimanModal'));
    modal.show();
}

// Functions for Terima/Tolak Pengiriman (Database Data)
function terimaPengirimanDB(id, newStatus) {
    if (confirm('Apakah Anda yakin ingin menerima pengiriman ini?')) {
        updatePengirimanDBStatus(id, newStatus);
    }
}

function tolakPengirimanDB(id, newStatus) {
    document.getElementById('pengiriman_id_tolak').value = id;
    document.getElementById('alasan_tolak').value = '';
    
    // Store new status for later use
    window.currentNewStatus = newStatus;
    window.currentPengirimanType = 'database';
    
    const modal = new bootstrap.Modal(document.getElementById('tolakPengirimanModal'));
    modal.show();
}

function mulaiPengirimanDB(id, newStatus) {
    if (confirm('Mulai pengiriman untuk item ini?')) {
        updatePengirimanDBStatus(id, newStatus);
    }
}

function selesaiPengirimanDB(id, newStatus) {
    if (confirm('Apakah Anda yakin pengiriman ini sudah selesai?')) {
        updatePengirimanDBStatus(id, newStatus);
    }
}

// Function untuk confirm tolak pengiriman
function confirmTolakPengiriman() {
    const id = document.getElementById('pengiriman_id_tolak').value;
    const alasan = document.getElementById('alasan_tolak').value.trim();
    
    if (!alasan) {
        showAlert('Harap masukkan alasan penolakan!', 'warning');
        return;
    }
    
    // Close modal first
    const modal = bootstrap.Modal.getInstance(document.getElementById('tolakPengirimanModal'));
    modal.hide();
    
    // Check if this is for session data or database data
    if (window.currentPengirimanType === 'database') {
        updatePengirimanDBStatusWithReason(id, window.currentNewStatus || 'ditolak', alasan);
    } else {
        updatePengirimanStatusWithReason(id, window.currentPengirimanIndex, 'Ditolak', alasan);
    }
    
    // Clean up global variables
    delete window.currentPengirimanIndex;
    delete window.currentNewStatus;
    delete window.currentPengirimanType;
}

// Function to update session status with reason
function updatePengirimanStatusWithReason(idPengiriman, index, newStatus, reason) {
    const loadingAlert = document.createElement('div');
    loadingAlert.className = 'alert alert-info';
    loadingAlert.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memperbarui status...';
    document.body.appendChild(loadingAlert);
    
    fetch(`/gudang/pengiriman/update-session-status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            id_pengiriman: idPengiriman,
            status: newStatus,
            index: index,
            reason: reason
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        document.body.removeChild(loadingAlert);
        
        if (data.success) {
            showAlert(`Status berhasil diperbarui menjadi: ${newStatus}`, 'success');
            setTimeout(() => {
                location.reload();
            }, 1500);
        } else {
            showAlert('Error: ' + (data.message || 'Gagal memperbarui status'), 'danger');
        }
    })
    .catch(error => {
        document.body.removeChild(loadingAlert);
        console.error('Error:', error);
        showAlert('Terjadi kesalahan saat memperbarui status. Silakan coba lagi.', 'danger');
    });
}

// Function to update database status
function updatePengirimanDBStatus(id, newStatus) {
    const loadingAlert = document.createElement('div');
    loadingAlert.className = 'alert alert-info';
    loadingAlert.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memperbarui status...';
    document.body.appendChild(loadingAlert);
    
    fetch(`/gudang/pengiriman/${id}/update-status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            status: newStatus
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        document.body.removeChild(loadingAlert);
        
        if (data.success) {
            showAlert(`Status berhasil diperbarui menjadi: ${newStatus}`, 'success');
            setTimeout(() => {
                location.reload();
            }, 1500);
        } else {
            showAlert('Error: ' + (data.message || 'Gagal memperbarui status'), 'danger');
        }
    })
    .catch(error => {
        document.body.removeChild(loadingAlert);
        console.error('Error:', error);
        showAlert('Terjadi kesalahan saat memperbarui status. Silakan coba lagi.', 'danger');
    });
}

// Function to update database status with reason
function updatePengirimanDBStatusWithReason(id, newStatus, reason) {
    const loadingAlert = document.createElement('div');
    loadingAlert.className = 'alert alert-info';
    loadingAlert.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memperbarui status...';
    document.body.appendChild(loadingAlert);
    
    fetch(`/gudang/pengiriman/${id}/update-status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            status: newStatus,
            reason: reason
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        document.body.removeChild(loadingAlert);
        
        if (data.success) {
            showAlert(`Status berhasil diperbarui menjadi: ${newStatus}${reason ? ' dengan alasan: ' + reason : ''}`, 'success');
            setTimeout(() => {
                location.reload();
            }, 1500);
        } else {
            showAlert('Error: ' + (data.message || 'Gagal memperbarui status'), 'danger');
        }
    })
    .catch(error => {
        document.body.removeChild(loadingAlert);
        console.error('Error:', error);
        showAlert('Terjadi kesalahan saat memperbarui status. Silakan coba lagi.', 'danger');
    });
}

// Filter functionality with proper form handling
document.querySelector('.btn-primary').addEventListener('click', function() {
    const status = document.getElementById('status').value;
    const ekspedisi = document.getElementById('ekspedisi').value;
    const tanggalDari = document.getElementById('tanggal_dari').value;
    const tanggalSampai = document.getElementById('tanggal_sampai').value;
    
    // Build query string
    const params = new URLSearchParams();
    if (status) params.append('status', status);
    if (ekspedisi) params.append('ekspedisi', ekspedisi);
    if (tanggalDari) params.append('tanggal_dari', tanggalDari);
    if (tanggalSampai) params.append('tanggal_sampai', tanggalSampai);
    
    // Redirect with filter parameters
    window.location.href = window.location.pathname + '?' + params.toString();
});

// Action functions for pengiriman with improved error handling
function lihatDetailPengiriman(idPengiriman, index) {
    console.log('Detail pengiriman:', idPengiriman, 'Index:', index);
    
    // Create dynamic modal for detail view
    showPengirimanDetail(idPengiriman, index);
}

function mulaiPengiriman(idPengiriman, index) {
    if (confirm('Mulai pengiriman untuk ID: ' + idPengiriman + '?')) {
        updatePengirimanStatus(idPengiriman, index, 'Dalam Perjalanan');
    }
}

function selesaiPengiriman(idPengiriman, index) {
    if (confirm('Selesaikan pengiriman untuk ID: ' + idPengiriman + '?')) {
        updatePengirimanStatus(idPengiriman, index, 'Selesai');
    }
}

function updatePengirimanStatus(idPengiriman, index, newStatus) {
    // Show loading
    const loadingAlert = document.createElement('div');
    loadingAlert.className = 'alert alert-info';
    loadingAlert.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memperbarui status...';
    document.body.appendChild(loadingAlert);
    
    // Make AJAX request to update status
    fetch(`/gudang/pengiriman/update-session-status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            id_pengiriman: idPengiriman,
            status: newStatus,
            index: index
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        document.body.removeChild(loadingAlert);
        
        if (data.success) {
            showAlert('Status berhasil diperbarui!', 'success');
            setTimeout(() => {
                location.reload();
            }, 1500);
        } else {
            showAlert('Error: ' + (data.message || 'Gagal memperbarui status'), 'danger');
        }
    })
    .catch(error => {
        document.body.removeChild(loadingAlert);
        console.error('Error:', error);
        showAlert('Terjadi kesalahan saat memperbarui status. Silakan coba lagi.', 'danger');
    });
}

function showPengirimanDetail(idPengiriman, index) {
    // Get pengiriman data from session
    const sessionPengiriman = @json($sessionPengiriman ?? []);
    
    if (sessionPengiriman[index]) {
        const data = sessionPengiriman[index];
        
        // Create modal content
        const modalContent = `
            <div class="modal fade" id="detailModalDynamic" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header" style="background: linear-gradient(135deg, #f26b37 0%, #e55827 100%); color: white;">
                            <h5 class="modal-title">
                                <i class="fas fa-info-circle"></i>
                                Detail Pengiriman - ${data.id_pengiriman}
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="fw-bold text-primary">Informasi Pengiriman</h6>
                                    <table class="table table-sm">
                                        <tr><td class="fw-semibold">No. Permintaan:</td><td>${data.no_permintaan}</td></tr>
                                        <tr><td class="fw-semibold">ID Pengiriman:</td><td>${data.id_pengiriman}</td></tr>
                                        <tr><td class="fw-semibold">Produk:</td><td>${data.produk}</td></tr>
                                        <tr><td class="fw-semibold">Status:</td><td><span class="badge bg-info">${data.status}</span></td></tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="fw-bold text-primary">Detail Pengiriman</h6>
                                    <table class="table table-sm">
                                        <tr><td class="fw-semibold">Tujuan:</td><td>${data.tujuan}</td></tr>
                                        <tr><td class="fw-semibold">Penanggung Jawab:</td><td>${data.penanggung_jawab}</td></tr>
                                        <tr><td class="fw-semibold">Total Items:</td><td>${data.total_items}</td></tr>
                                        <tr><td class="fw-semibold">Prioritas:</td><td>${data.prioritas}</td></tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        // Remove existing dynamic modal if any
        const existingModal = document.getElementById('detailModalDynamic');
        if (existingModal) {
            existingModal.remove();
        }
        
        // Add modal to body
        document.body.insertAdjacentHTML('beforeend', modalContent);
        
        // Show modal
        const modal = new bootstrap.Modal(document.getElementById('detailModalDynamic'));
        modal.show();
        
        // Remove modal from DOM when hidden
        document.getElementById('detailModalDynamic').addEventListener('hidden.bs.modal', function() {
            this.remove();
        });
    } else {
        alert('Data pengiriman tidak ditemukan');
    }
}

// Reset filter functionality
document.querySelector('.btn-secondary').addEventListener('click', function() {
    // Reset all form fields
    document.getElementById('status').value = '';
    document.getElementById('ekspedisi').value = '';
    document.getElementById('tanggal_dari').value = '';
    document.getElementById('tanggal_sampai').value = '';
    
    // Redirect to clear filters
    window.location.href = window.location.pathname;
});

// Handle form validation
document.getElementById('jumlah').addEventListener('input', function() {
    const max = parseInt(this.max);
    const value = parseInt(this.value);
    
    if (value > max) {
        this.setCustomValidity(`Jumlah tidak boleh melebihi stok yang tersedia (${max})`);
    } else {
        this.setCustomValidity('');
    }
});

// Add simple form submission handler as backup
document.getElementById('tambahPengirimanForm').addEventListener('submit', function(e) {
    e.preventDefault();
    console.log('Form submitted via event listener');
    
    // Show simple confirmation
    if (confirm('Apakah Anda yakin ingin menyimpan data pengiriman ini?')) {
        console.log('User confirmed, proceeding with form submission');
        
        // Remove event listener to prevent infinite loop and submit normally
        this.removeEventListener('submit', arguments.callee);
        this.submit();
    }
});
</script>

@endsection