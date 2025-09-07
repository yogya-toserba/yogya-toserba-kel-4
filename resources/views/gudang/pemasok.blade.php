@extends('layouts.appGudang')

@section('title', 'Manajemen Pemasok - MyYOGYA')

@push('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
<style>
/* Modern Pemasok Styles - Same as Permintaan */
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

/* Export Dropdown Styles */
.dropdown-menu {
    border: none;
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    border-radius: 8px;
    padding: 8px 0;
    min-width: 200px;
}

.dropdown-item {
    padding: 10px 16px;
    font-size: 0.9rem;
    border-radius: 6px;
    margin: 2px 8px;
    transition: all 0.3s ease;
}

.dropdown-item:hover {
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
    color: white;
    transform: translateX(4px);
}

.dropdown-item:hover i {
    transform: scale(1.1);
}

.dropdown-item i {
    width: 16px;
    transition: all 0.3s ease;
}

.dropdown-divider {
    margin: 8px 0;
    border-color: #e2e8f0;
}

.dropdown-item-text {
    padding: 8px 16px;
    font-style: italic;
}

/* Dark mode dropdown */
body.dark-mode .dropdown-menu {
    background: #2a2d3f;
    border: 1px solid #3a3d4a;
}

body.dark-mode .dropdown-item {
    color: #e2e8f0;
}

body.dark-mode .dropdown-item:hover {
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
    color: white;
}

body.dark-mode .dropdown-divider {
    border-color: #3a3d4a;
}

body.dark-mode .dropdown-item-text {
    color: #94a3b8;
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
    <!-- Success Alert -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- User Credentials Alert -->
    @if(session('user_credentials'))
    <div class="alert alert-info alert-dismissible fade show mb-4" role="alert">
        <div class="d-flex justify-content-between align-items-start">
            <div>
                <h5 class="alert-heading">
                    <i class="fas fa-user-lock me-2"></i>Akun Supplier Berhasil Dibuat!
                </h5>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <strong>Username:</strong><br>
                        <code class="fs-6">{{ session('user_credentials.username') }}</code>
                    </div>
                    <div class="col-md-6">
                        <strong>Password:</strong><br>
                        <code class="fs-6">{{ session('user_credentials.password') }}</code>
                    </div>
                </div>
                <hr>
                <p class="mb-0">
                    <strong>Email:</strong> {{ session('user_credentials.email') }}<br>
                    <strong>URL Login:</strong> <a href="{{ session('user_credentials.login_url') }}" target="_blank">{{ session('user_credentials.login_url') }}</a>
                </p>
                <small class="text-muted">
                    <i class="fas fa-exclamation-triangle"></i> 
                    Simpan kredensial ini dengan aman. Password hanya ditampilkan sekali saja!
                </small>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif

    <!-- Error Alert -->
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Validation Errors -->
    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
        <i class="fas fa-exclamation-triangle me-2"></i>
        <strong>Terdapat kesalahan:</strong>
        <ul class="mb-0 mt-2">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Header Section -->
    <div class="permintaan-header">
        <h2>Manajemen Pemasok</h2>
        <p>Kelola data pemasok dan supplier MyYOGYA</p>
    </div>

    <!-- Stats Section -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number">{{ isset($pemasoks) ? $pemasoks->total() : 0 }}</div>
            <div class="stat-label">Total Pemasok</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ isset($pemasoks) ? $pemasoks->where('status', 'aktif')->count() : 0 }}</div>
            <div class="stat-label">Pemasok Aktif</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ isset($pemasoks) ? $pemasoks->where('status', 'non-aktif')->count() : 0 }}</div>
            <div class="stat-label">Pemasok Non-Aktif</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ isset($pemasoks) ? $pemasoks->where('created_at', '>=', now()->startOfMonth())->count() : 0 }}</div>
            <div class="stat-label">Baru Bulan Ini</div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <form method="GET" action="{{ route('gudang.pemasok.index') }}">
            <div class="filter-grid">
                <div>
                    <label class="form-label-modern">Cari Pemasok</label>
                    <input type="text" class="form-control form-control-modern" name="search" 
                           placeholder="Nama pemasok..." value="{{ request('search') }}">
                </div>
                <div>
                    <label class="form-label-modern">Status</label>
                    <select class="form-control form-control-modern" name="status">
                        <option value="">Semua Status</option>
                        <option value="aktif" {{ request('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="non-aktif" {{ request('status') === 'non-aktif' ? 'selected' : '' }}>Non-Aktif</option>
                    </select>
                </div>
                <div>
                    <label class="form-label-modern">Kategori</label>
                    <select class="form-control form-control-modern" name="kategori">
                        <option value="">Semua Kategori</option>
                        <option value="makanan" {{ request('kategori') === 'makanan' ? 'selected' : '' }}>Makanan</option>
                        <option value="minuman" {{ request('kategori') === 'minuman' ? 'selected' : '' }}>Minuman</option>
                        <option value="elektronik" {{ request('kategori') === 'elektronik' ? 'selected' : '' }}>Elektronik</option>
                        <option value="fashion" {{ request('kategori') === 'fashion' ? 'selected' : '' }}>Fashion</option>
                        <option value="kesehatan" {{ request('kategori') === 'kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                        <option value="rumah-tangga" {{ request('kategori') === 'rumah-tangga' ? 'selected' : '' }}>Rumah Tangga</option>
                    </select>
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
                <i class="fas fa-list-alt" style="color: #f26b37; margin-right: 10px;"></i>
                Daftar Pemasok
            </h5>
            <div class="d-flex gap-2">
                <button class="btn btn-modern" data-bs-toggle="modal" data-bs-target="#tambahPemasokModal">
                    <i class="fas fa-plus"></i>
                    Tambah Pemasok
                </button>
                
                <!-- Export Dropdown -->
                <div class="dropdown">
                    <button class="btn btn-outline-modern dropdown-toggle" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-download"></i>
                        Export Data
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                        <li>
                            <a class="dropdown-item" href="#" onclick="exportPemasok('excel')">
                                <i class="fas fa-file-excel text-success me-2"></i>
                                Export ke Excel (.xls)
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#" onclick="exportPemasok('csv')">
                                <i class="fas fa-file-csv text-info me-2"></i>
                                Export ke CSV (.csv)
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <span class="dropdown-item-text text-muted">
                                <small><i class="fas fa-info-circle me-1"></i>Data akan diexport sesuai filter yang aktif</small>
                            </span>
                        </li>
                    </ul>
                </div>
                
                <button class="btn btn-modern" onclick="location.reload()">
                    <i class="fas fa-sync-alt"></i>
                    Refresh
                </button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table modern-table">
                <thead>
                    <tr>
                        <th>Nama Perusahaan</th>
                        <th>Kontak Person</th>
                        <th>Email & Telepon</th>
                        <th>Lokasi</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Rating</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pemasoks as $pemasok)
                    <tr>
                        <td>
                            <div class="fw-semibold">{{ $pemasok->nama_perusahaan }}</div>
                            <small class="text-muted">ID: {{ $pemasok->id_pemasok }}</small>
                        </td>
                        <td>
                            <div class="fw-semibold">{{ $pemasok->kontak_person ?? '-' }}</div>
                            <small class="text-muted">{{ $pemasok->jabatan ?? 'Staff' }}</small>
                        </td>
                        <td>
                            <div>{{ $pemasok->email ?? '-' }}</div>
                            <small class="text-muted">{{ $pemasok->telepon ?? '-' }}</small>
                        </td>
                        <td>
                            <div class="fw-semibold">{{ $pemasok->kota ?? '-' }}</div>
                            <small class="text-muted">{{ $pemasok->alamat ?? '-' }}</small>
                        </td>
                        <td>
                            <span class="priority-badge priority-sedang">{{ $pemasok->kategori ?? 'Umum' }}</span>
                        </td>
                        <td>
                            @php
                                $status = $pemasok->status ?? 'aktif';
                                $statusClass = $status === 'aktif' ? 'bg-success' : 'bg-danger';
                            @endphp
                            <span class="badge {{ $statusClass }}">{{ ucfirst($status) }}</span>
                        </td>
                        <td>
                            @php
                                $rating = $pemasok->rating ?? 4.0;
                                $fullStars = floor($rating);
                                $halfStar = ($rating - $fullStars) >= 0.5;
                            @endphp
                            <div class="d-flex align-items-center">
                                <div class="me-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $fullStars)
                                            <i class="fas fa-star text-warning"></i>
                                        @elseif($i == $fullStars + 1 && $halfStar)
                                            <i class="fas fa-star-half-alt text-warning"></i>
                                        @else
                                            <i class="far fa-star text-muted"></i>
                                        @endif
                                    @endfor
                                </div>
                                <span class="fw-semibold">{{ number_format($rating, 1) }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="action-dropdown">
                                <button class="action-btn" onclick="toggleActionDropdown(this)">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="action-dropdown-menu">
                                    <a href="#" class="action-dropdown-item" onclick="viewPemasok({{ $pemasok->id_pemasok }})">
                                        <i class="fas fa-eye"></i>
                                        Lihat Detail
                                    </a>
                                    <a href="#" class="action-dropdown-item" onclick="editPemasok({{ $pemasok->id_pemasok }})">
                                        <i class="fas fa-edit"></i>
                                        Edit
                                    </a>
                                    @if($pemasok->status === 'aktif')
                                        <a href="#" class="action-dropdown-item" onclick="toggleStatus({{ $pemasok->id_pemasok }}, 'non-aktif')">
                                            <i class="fas fa-ban"></i>
                                            Nonaktifkan
                                        </a>
                                    @else
                                        <a href="#" class="action-dropdown-item" onclick="toggleStatus({{ $pemasok->id_pemasok }}, 'aktif')">
                                            <i class="fas fa-check"></i>
                                            Aktifkan
                                        </a>
                                    @endif
                                    <a href="#" class="action-dropdown-item text-danger" onclick="hapusPemasok({{ $pemasok->id_pemasok }})">
                                        <i class="fas fa-trash"></i>
                                        Hapus
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <div class="d-flex flex-column align-items-center">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Tidak ada data pemasok</h5>
                                <p class="text-muted">Belum ada pemasok yang terdaftar dalam sistem</p>
                                <button class="btn btn-modern" data-bs-toggle="modal" data-bs-target="#tambahPemasokModal">
                                    <i class="fas fa-plus"></i>
                                    Tambah Pemasok Pertama
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if(isset($pemasoks) && $pemasoks->hasPages())
        <div class="d-flex justify-content-between align-items-center p-3">
            <div class="text-muted">
                Menampilkan {{ $pemasoks->firstItem() ?? 0 }} sampai {{ $pemasoks->lastItem() ?? 0 }} 
                dari {{ $pemasoks->total() ?? 0 }} data
            </div>
            {{ $pemasoks->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Modal Tambah Pemasok -->
<div class="modal fade" id="tambahPemasokModal" tabindex="-1" aria-labelledby="tambahPemasokModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPemasokModalLabel">
                    <i class="fas fa-plus-circle me-2"></i>Tambah Pemasok Baru
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('gudang.pemasok.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Tab Navigation -->
                    <ul class="nav nav-tabs mb-3" id="tambahPemasokTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="perusahaan-tab" data-bs-toggle="tab" data-bs-target="#perusahaan" type="button" role="tab">
                                <i class="fas fa-building me-1"></i>Data Perusahaan
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="akun-tab" data-bs-toggle="tab" data-bs-target="#akun" type="button" role="tab">
                                <i class="fas fa-user me-1"></i>Akun Login
                            </button>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="tambahPemasokTabContent">
                        <!-- Data Perusahaan Tab -->
                        <div class="tab-pane fade show active" id="perusahaan" role="tabpanel">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="nama_perusahaan" class="form-label">Nama Perusahaan *</label>
                                    <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="kontak_person" class="form-label">Kontak Person *</label>
                                    <input type="text" class="form-control" id="kontak_person" name="kontak_person" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email Perusahaan *</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="telepon" class="form-label">Telepon *</label>
                                    <input type="text" class="form-control" id="telepon" name="telepon" required>
                                </div>
                                <div class="col-12">
                                    <label for="alamat" class="form-label">Alamat *</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="kota" class="form-label">Kota *</label>
                                    <input type="text" class="form-control" id="kota" name="kota" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="kategori_produk" class="form-label">Kategori Produk *</label>
                                    <select class="form-select" id="kategori_produk" name="kategori_produk" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="makanan">Makanan</option>
                                        <option value="minuman">Minuman</option>
                                        <option value="elektronik">Elektronik</option>
                                        <option value="fashion">Fashion</option>
                                        <option value="kesehatan">Kesehatan</option>
                                        <option value="rumah-tangga">Rumah Tangga</option>
                                        <option value="olahraga">Olahraga</option>
                                        <option value="mainan">Mainan</option>
                                        <option value="otomotif">Otomotif</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="tanggal_kerjasama" class="form-label">Tanggal Kerjasama</label>
                                    <input type="date" class="form-control" id="tanggal_kerjasama" name="tanggal_kerjasama" value="{{ date('Y-m-d') }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="rating" class="form-label">Rating (1-5)</label>
                                    <select class="form-select" id="rating" name="rating">
                                        <option value="5">⭐⭐⭐⭐⭐ (5)</option>
                                        <option value="4">⭐⭐⭐⭐ (4)</option>
                                        <option value="3">⭐⭐⭐ (3)</option>
                                        <option value="2">⭐⭐ (2)</option>
                                        <option value="1">⭐ (1)</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="catatan" class="form-label">Catatan</label>
                                    <textarea class="form-control" id="catatan" name="catatan" rows="2" placeholder="Catatan tambahan tentang pemasok..."></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Akun Login Tab -->
                        <div class="tab-pane fade" id="akun" role="tabpanel">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Akun Login Pemasok:</strong> Buat username dan password untuk pemasok agar mereka dapat mengakses sistem.
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="username" class="form-label">Username *</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                    <div class="form-text">Username harus unik dan tidak boleh sama dengan yang lain</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="email_login" class="form-label">Email Login *</label>
                                    <input type="email" class="form-control" id="email_login" name="email_login" required>
                                    <div class="form-text">Email untuk login (bisa berbeda dengan email perusahaan)</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="password" class="form-label">Password *</label>
                                    <input type="password" class="form-control" id="password" name="password" required minlength="8">
                                    <div class="form-text">Minimal 8 karakter</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Password *</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required minlength="8">
                                </div>
                                <div class="col-md-6">
                                    <label for="nama_lengkap" class="form-label">Nama Lengkap PIC *</label>
                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                                    <div class="form-text">Person In Charge (PIC) dari pemasok</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="telepon_pic" class="form-label">Telepon PIC</label>
                                    <input type="text" class="form-control" id="telepon_pic" name="telepon_pic">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-modern">
                        <i class="fas fa-save me-1"></i>Simpan Pemasok
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Pemasok -->
<div class="modal fade" id="editPemasokModal" tabindex="-1" aria-labelledby="editPemasokModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPemasokModalLabel">
                    <i class="fas fa-edit me-2"></i>Edit Pemasok
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editPemasokForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <!-- Tab Navigation -->
                    <ul class="nav nav-tabs mb-3" id="editPemasokTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="edit-perusahaan-tab" data-bs-toggle="tab" data-bs-target="#edit-perusahaan" type="button" role="tab">
                                <i class="fas fa-building me-1"></i>Data Perusahaan
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="edit-akun-tab" data-bs-toggle="tab" data-bs-target="#edit-akun" type="button" role="tab">
                                <i class="fas fa-user me-1"></i>Akun Login
                            </button>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="editPemasokTabContent">
                        <!-- Data Perusahaan Tab -->
                        <div class="tab-pane fade show active" id="edit-perusahaan" role="tabpanel">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="edit_nama_perusahaan" class="form-label">Nama Perusahaan *</label>
                                    <input type="text" class="form-control" id="edit_nama_perusahaan" name="nama_perusahaan" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="edit_kontak_person" class="form-label">Kontak Person *</label>
                                    <input type="text" class="form-control" id="edit_kontak_person" name="kontak_person" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="edit_email" class="form-label">Email Perusahaan *</label>
                                    <input type="email" class="form-control" id="edit_email" name="email" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="edit_telepon" class="form-label">Telepon *</label>
                                    <input type="text" class="form-control" id="edit_telepon" name="telepon" required>
                                </div>
                                <div class="col-12">
                                    <label for="edit_alamat" class="form-label">Alamat *</label>
                                    <textarea class="form-control" id="edit_alamat" name="alamat" rows="3" required></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="edit_kota" class="form-label">Kota *</label>
                                    <input type="text" class="form-control" id="edit_kota" name="kota" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="edit_kategori_produk" class="form-label">Kategori Produk *</label>
                                    <select class="form-select" id="edit_kategori_produk" name="kategori_produk" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="makanan">Makanan</option>
                                        <option value="minuman">Minuman</option>
                                        <option value="elektronik">Elektronik</option>
                                        <option value="fashion">Fashion</option>
                                        <option value="kesehatan">Kesehatan</option>
                                        <option value="rumah-tangga">Rumah Tangga</option>
                                        <option value="olahraga">Olahraga</option>
                                        <option value="mainan">Mainan</option>
                                        <option value="otomotif">Otomotif</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="edit_tanggal_kerjasama" class="form-label">Tanggal Kerjasama</label>
                                    <input type="date" class="form-control" id="edit_tanggal_kerjasama" name="tanggal_kerjasama">
                                </div>
                                <div class="col-md-6">
                                    <label for="edit_status" class="form-label">Status</label>
                                    <select class="form-select" id="edit_status" name="status">
                                        <option value="aktif">Aktif</option>
                                        <option value="non-aktif">Non-Aktif</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="edit_rating" class="form-label">Rating (1-5)</label>
                                    <select class="form-select" id="edit_rating" name="rating">
                                        <option value="5">⭐⭐⭐⭐⭐ (5)</option>
                                        <option value="4">⭐⭐⭐⭐ (4)</option>
                                        <option value="3">⭐⭐⭐ (3)</option>
                                        <option value="2">⭐⭐ (2)</option>
                                        <option value="1">⭐ (1)</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <!-- Spacer -->
                                </div>
                                <div class="col-12">
                                    <label for="edit_catatan" class="form-label">Catatan</label>
                                    <textarea class="form-control" id="edit_catatan" name="catatan" rows="2" placeholder="Catatan tambahan tentang pemasok..."></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Akun Login Tab -->
                        <div class="tab-pane fade" id="edit-akun" role="tabpanel">
                            <div id="edit-akun-content">
                                <!-- Content will be loaded by JavaScript -->
                                <div class="text-center">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <p class="mt-2">Memuat informasi akun...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-modern">
                        <i class="fas fa-save me-1"></i>Update Pemasok
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Action dropdown functionality
function toggleActionDropdown(button) {
    // Close all other dropdowns
    document.querySelectorAll('.action-dropdown-menu.show').forEach(menu => {
        menu.classList.remove('show');
    });
    
    // Toggle current dropdown
    const dropdown = button.nextElementSibling;
    dropdown.classList.toggle('show');
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function closeDropdown(e) {
        if (!button.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.remove('show');
            document.removeEventListener('click', closeDropdown);
        }
    });
}

// View pemasok function
function viewPemasok(id) {
    console.log('Viewing pemasok:', id);
    
    // Show loading
    const modal = new bootstrap.Modal(document.getElementById('detailPemasokModal') || createDetailModal());
    modal.show();
    
    // Fetch pemasok details
    fetch(`/gudang/pemasok/${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showPemasokDetail(data.data);
            } else {
                alert('Error: ' + data.message);
                modal.hide();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengambil data pemasok');
            modal.hide();
        });
}

// Edit pemasok function
function editPemasok(id) {
    console.log('Editing pemasok:', id);
    
    // Fetch pemasok data for editing
    fetch(`/gudang/pemasok/${id}/edit`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showEditPemasokModal(data.data);
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengambil data pemasok');
        });
}

// Toggle status function
function toggleStatus(id, status) {
    if (confirm(`Apakah Anda yakin ingin ${status === 'aktif' ? 'mengaktifkan' : 'menonaktifkan'} pemasok ini?`)) {
        // Send request to toggle status
        fetch(`/gudang/pemasok/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-HTTP-Method-Override': 'PUT'
            },
            body: JSON.stringify({
                'status': status
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(`Pemasok berhasil ${status === 'aktif' ? 'diaktifkan' : 'dinonaktifkan'}!`);
                window.location.reload();
            } else {
                alert('Error: ' + (data.message || 'Gagal mengubah status pemasok'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengubah status pemasok');
        });
    }
}

// Delete pemasok function
function hapusPemasok(id) {
    if (confirm('Apakah Anda yakin ingin menghapus pemasok ini? Tindakan ini tidak dapat dibatalkan.')) {
        // Send DELETE request
        fetch(`/gudang/pemasok/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-HTTP-Method-Override': 'DELETE'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Pemasok berhasil dihapus!');
                window.location.reload();
            } else {
                alert('Error: ' + (data.message || 'Gagal menghapus pemasok'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus pemasok');
        });
    }
}

// Export function
function exportPemasok(format = 'excel') {
    try {
        // Prevent default action for links
        if (event) {
            event.preventDefault();
        }

        // Show loading state on the specific button clicked
        const clickedElement = event.target.closest('a') || event.target.closest('button');
        const originalContent = clickedElement.innerHTML;
        clickedElement.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Exporting...';
        
        // Disable dropdown
        const dropdownButton = document.getElementById('exportDropdown');
        if (dropdownButton) {
            dropdownButton.disabled = true;
        }

        // Get current filters from the page
        const urlParams = new URLSearchParams(window.location.search);
        const filters = {
            search: urlParams.get('search') || '',
            status: urlParams.get('status') || '',
            kategori: urlParams.get('kategori') || '',
            kota: urlParams.get('kota') || '',
            format: format
        };

        // Build export URL with filters
        const exportUrl = new URL(`{{ route('gudang.pemasok.export') }}`, window.location.origin);
        Object.keys(filters).forEach(key => {
            if (filters[key]) {
                exportUrl.searchParams.append(key, filters[key]);
            }
        });

        // Determine file extension and format name
        const formatInfo = {
            excel: { ext: 'XLS', name: 'Excel' },
            csv: { ext: 'CSV', name: 'CSV' }
        };
        
        const currentFormat = formatInfo[format] || formatInfo.excel;

        // Show confirmation dialog
        if (confirm(`Apakah Anda yakin ingin mengexport data pemasok ke format ${currentFormat.name} (${currentFormat.ext})?`)) {
            // Create a temporary link to download
            const downloadLink = document.createElement('a');
            downloadLink.href = exportUrl.toString();
            downloadLink.style.display = 'none';
            downloadLink.target = '_blank'; // Open in new tab
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
            
            // Show success message
            showAlert('success', `Data pemasok berhasil diexport ke format ${currentFormat.name}! File akan otomatis diunduh.`);
        }

        // Restore button state
        setTimeout(() => {
            clickedElement.innerHTML = originalContent;
            if (dropdownButton) {
                dropdownButton.disabled = false;
            }
        }, 2000);

    } catch (error) {
        console.error('Export error:', error);
        showAlert('error', 'Terjadi kesalahan saat export data: ' + error.message);
        
        // Restore button state on error
        const clickedElement = event.target.closest('a') || event.target.closest('button');
        const dropdownButton = document.getElementById('exportDropdown');
        
        if (clickedElement) {
            clickedElement.innerHTML = clickedElement.innerHTML.replace('<i class="fas fa-spinner fa-spin"></i> Exporting...', '<i class="fas fa-download"></i> Export');
        }
        if (dropdownButton) {
            dropdownButton.disabled = false;
        }
    }
}

// Helper function to create detail modal
function createDetailModal() {
    const modalHtml = `
        <div class="modal fade" id="detailPemasokModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Pemasok</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" id="detailPemasokContent">
                        <div class="text-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-2">Memuat data pemasok...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    // Append to body if not exists
    if (!document.getElementById('detailPemasokModal')) {
        document.body.insertAdjacentHTML('beforeend', modalHtml);
    }
    
    return document.getElementById('detailPemasokModal');
}

// Helper function to show pemasok detail
function showPemasokDetail(pemasok) {
    const content = document.getElementById('detailPemasokContent');
    
    const detailHtml = `
        <div class="row">
            <div class="col-md-6">
                <h6 class="fw-bold text-primary">Informasi Perusahaan</h6>
                <table class="table table-borderless">
                    <tr><td width="35%"><strong>Nama Perusahaan:</strong></td><td>${pemasok.nama_perusahaan || '-'}</td></tr>
                    <tr><td><strong>ID Pemasok:</strong></td><td>${pemasok.id_pemasok || '-'}</td></tr>
                    <tr><td><strong>Kategori:</strong></td><td>${pemasok.kategori_produk || 'Umum'}</td></tr>
                    <tr><td><strong>Status:</strong></td><td>
                        <span class="badge ${pemasok.status === 'aktif' ? 'bg-success' : 'bg-danger'}">${pemasok.status || 'aktif'}</span>
                    </td></tr>
                </table>
            </div>
            <div class="col-md-6">
                <h6 class="fw-bold text-primary">Kontak & Lokasi</h6>
                <table class="table table-borderless">
                    <tr><td width="35%"><strong>Kontak Person:</strong></td><td>${pemasok.kontak_person || '-'}</td></tr>
                    <tr><td><strong>Jabatan:</strong></td><td>${pemasok.jabatan || '-'}</td></tr>
                    <tr><td><strong>Email:</strong></td><td>${pemasok.email || '-'}</td></tr>
                    <tr><td><strong>Telepon:</strong></td><td>${pemasok.telepon || '-'}</td></tr>
                    <tr><td><strong>Kota:</strong></td><td>${pemasok.kota || '-'}</td></tr>
                </table>
            </div>
        </div>
        
        ${pemasok.alamat ? `
        <div class="row mt-3">
            <div class="col-12">
                <h6 class="fw-bold text-primary">Alamat Lengkap</h6>
                <p class="mb-0">${pemasok.alamat}</p>
            </div>
        </div>
        ` : ''}
        
        ${pemasok.user ? `
        <div class="row mt-3">
            <div class="col-12">
                <h6 class="fw-bold text-primary">
                    <i class="fas fa-user-lock me-2"></i>Informasi Akun Login
                </h6>
                <div class="alert alert-info" style="background: #e3f2fd; border: 1px solid #90caf9;">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-sm table-borderless mb-0">
                                <tr>
                                    <td width="40%" class="fw-semibold"><i class="fas fa-user me-2"></i>Username:</td>
                                    <td>
                                        <span class="badge bg-primary">${pemasok.user.username || '-'}</span>
                                        <button class="btn btn-sm btn-outline-primary ms-2" onclick="copyToClipboard('${pemasok.user.username || ''}', 'Username')">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold"><i class="fas fa-envelope me-2"></i>Email Login:</td>
                                    <td>
                                        <span class="badge bg-info">${pemasok.user.email || '-'}</span>
                                        <button class="btn btn-sm btn-outline-info ms-2" onclick="copyToClipboard('${pemasok.user.email || ''}', 'Email')">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold"><i class="fas fa-key me-2"></i>Password:</td>
                                    <td>
                                        <span class="badge bg-warning text-dark" id="passwordDisplay">${pemasok.user.plain_password ? '••••••••' : 'Tidak tersedia'}</span>
                                        ${pemasok.user.plain_password ? `
                                        <button class="btn btn-sm btn-outline-warning ms-2" onclick="togglePassword('${pemasok.user.plain_password}')">
                                            <i class="fas fa-eye" id="passwordToggleIcon"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning ms-1" onclick="copyToClipboard('${pemasok.user.plain_password}', 'Password')">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                        ` : ''}
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-sm table-borderless mb-0">
                                <tr>
                                    <td width="40%" class="fw-semibold"><i class="fas fa-user-circle me-2"></i>Nama Lengkap:</td>
                                    <td>${pemasok.user.nama_lengkap || '-'}</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold"><i class="fas fa-toggle-on me-2"></i>Status Akun:</td>
                                    <td>
                                        <span class="badge ${pemasok.user.status === 'aktif' ? 'bg-success' : 'bg-danger'}">${pemasok.user.status || 'aktif'}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold"><i class="fas fa-clock me-2"></i>Login Terakhir:</td>
                                    <td>${pemasok.user.last_login || 'Belum pernah login'}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <hr class="my-3">
                    <div class="text-center">
                        <small class="text-muted">
                            <i class="fas fa-link me-1"></i>URL Login: 
                            <a href="#" onclick="copyToClipboard('${window.location.origin}/supplier/login', 'URL Login')" class="text-decoration-none">
                                ${window.location.origin}/supplier/login
                            </a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
        ` : `
        <div class="row mt-3">
            <div class="col-12">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Akun login belum dibuat</strong> untuk pemasok ini.
                </div>
            </div>
        </div>
        `}
    `;
    
    content.innerHTML = detailHtml;
}

// Form validation and auto-fill for tambah pemasok
document.addEventListener('DOMContentLoaded', function() {
    const emailField = document.getElementById('email');
    const emailLoginField = document.getElementById('email_login');
    const usernameField = document.getElementById('username');
    const namaPerusahaanField = document.getElementById('nama_perusahaan');
    const kontakPersonField = document.getElementById('kontak_person');
    const namaLengkapField = document.getElementById('nama_lengkap');
    const passwordField = document.getElementById('password');
    const confirmPasswordField = document.getElementById('password_confirmation');

    // Auto-fill email login when email perusahaan changes
    if (emailField && emailLoginField) {
        emailField.addEventListener('input', function() {
            if (!emailLoginField.value) {
                emailLoginField.value = this.value;
            }
        });
    }

    // Auto-generate username from nama perusahaan
    if (namaPerusahaanField && usernameField) {
        namaPerusahaanField.addEventListener('input', function() {
            if (!usernameField.value) {
                let username = this.value.toLowerCase()
                    .replace(/[^a-z0-9\s]/g, '') // Remove special characters
                    .replace(/\s+/g, '_') // Replace spaces with underscore
                    .substring(0, 15); // Limit to 15 characters
                
                if (username) {
                    usernameField.value = username;
                }
            }
        });
    }

    // Auto-fill nama lengkap from kontak person
    if (kontakPersonField && namaLengkapField) {
        kontakPersonField.addEventListener('input', function() {
            if (!namaLengkapField.value) {
                namaLengkapField.value = this.value;
            }
        });
    }

    // Password confirmation validation
    if (confirmPasswordField) {
        confirmPasswordField.addEventListener('input', function() {
            if (passwordField.value !== this.value) {
                this.setCustomValidity('Password tidak cocok');
                this.classList.add('is-invalid');
            } else {
                this.setCustomValidity('');
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            }
        });

        passwordField.addEventListener('input', function() {
            if (confirmPasswordField.value && confirmPasswordField.value !== this.value) {
                confirmPasswordField.setCustomValidity('Password tidak cocok');
                confirmPasswordField.classList.add('is-invalid');
            } else if (confirmPasswordField.value) {
                confirmPasswordField.setCustomValidity('');
                confirmPasswordField.classList.remove('is-invalid');
                confirmPasswordField.classList.add('is-valid');
            }
        });
    }

    // Form submission validation
    const tambahPemasokForm = document.querySelector('#tambahPemasokModal form');
    if (tambahPemasokForm) {
        tambahPemasokForm.addEventListener('submit', function(e) {
            const password = passwordField.value;
            const confirmPassword = confirmPasswordField.value;
            
            if (password !== confirmPassword) {
                e.preventDefault();
                showAlert('error', 'Password dan konfirmasi password tidak cocok!');
                return false;
            }
            
            if (password.length < 8) {
                e.preventDefault();
                showAlert('error', 'Password minimal 8 karakter!');
                return false;
            }
        });
    }
});

// Helper function to copy text to clipboard
function copyToClipboard(text, label) {
    if (!text) {
        showAlert('error', 'Tidak ada data untuk disalin');
        return;
    }
    
    navigator.clipboard.writeText(text).then(function() {
        showAlert('success', label + ' berhasil disalin ke clipboard');
    }).catch(function(err) {
        // Fallback untuk browser yang tidak mendukung clipboard API
        const textArea = document.createElement('textarea');
        textArea.value = text;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        showAlert('success', label + ' berhasil disalin ke clipboard');
    });
}

// Helper function to toggle password visibility
function togglePassword(password) {
    const passwordDisplay = document.getElementById('passwordDisplay');
    const toggleIcon = document.getElementById('passwordToggleIcon');
    
    if (passwordDisplay.textContent === '••••••••') {
        passwordDisplay.textContent = password;
        passwordDisplay.className = 'badge bg-success';
        toggleIcon.className = 'fas fa-eye-slash';
    } else {
        passwordDisplay.textContent = '••••••••';
        passwordDisplay.className = 'badge bg-warning text-dark';
        toggleIcon.className = 'fas fa-eye';
    }
}

// Helper function to show edit modal
function showEditPemasokModal(pemasok) {
    // Populate edit form with current data - Data Perusahaan
    document.getElementById('edit_nama_perusahaan').value = pemasok.nama_perusahaan || '';
    document.getElementById('edit_kontak_person').value = pemasok.kontak_person || '';
    document.getElementById('edit_email').value = pemasok.email || '';
    document.getElementById('edit_telepon').value = pemasok.telepon || '';
    document.getElementById('edit_alamat').value = pemasok.alamat || '';
    document.getElementById('edit_kota').value = pemasok.kota || '';
    document.getElementById('edit_kategori_produk').value = pemasok.kategori_produk || '';
    document.getElementById('edit_tanggal_kerjasama').value = pemasok.tanggal_kerjasama || '';
    document.getElementById('edit_status').value = pemasok.status || 'aktif';
    document.getElementById('edit_rating').value = pemasok.rating || '5';
    document.getElementById('edit_catatan').value = pemasok.catatan || '';
    
    // Populate akun login tab
    populateEditAkunTab(pemasok);
    
    // Store ID for form submission
    document.getElementById('editPemasokForm').dataset.pemasokId = pemasok.id_pemasok;
    
    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('editPemasokModal'));
    modal.show();
}

// Function to populate akun login tab in edit modal
function populateEditAkunTab(pemasok) {
    const akunContent = document.getElementById('edit-akun-content');
    
    if (pemasok.user) {
        akunContent.innerHTML = `
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                <strong>Informasi Akun Login Pemasok</strong>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="edit_username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="edit_username" name="username" value="${pemasok.user.username}" readonly>
                    <div class="form-text">Username tidak dapat diubah</div>
                </div>
                <div class="col-md-6">
                    <label for="edit_email_login" class="form-label">Email Login</label>
                    <input type="email" class="form-control" id="edit_email_login" name="email_login" value="${pemasok.user.email}">
                </div>
                <div class="col-md-6">
                    <label for="edit_nama_lengkap" class="form-label">Nama Lengkap PIC</label>
                    <input type="text" class="form-control" id="edit_nama_lengkap" name="nama_lengkap" value="${pemasok.user.nama_lengkap}">
                </div>
                <div class="col-md-6">
                    <label for="edit_telepon_pic" class="form-label">Telepon PIC</label>
                    <input type="text" class="form-control" id="edit_telepon_pic" name="telepon_pic" value="${pemasok.user.telepon || ''}">
                </div>
                <div class="col-md-6">
                    <label for="edit_status_akun" class="form-label">Status Akun</label>
                    <select class="form-select" id="edit_status_akun" name="status_akun">
                        <option value="aktif" ${pemasok.user.status === 'aktif' ? 'selected' : ''}>Aktif</option>
                        <option value="non-aktif" ${pemasok.user.status === 'non-aktif' ? 'selected' : ''}>Non-Aktif</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Terakhir Login</label>
                    <input type="text" class="form-control" value="${pemasok.user.last_login ? new Date(pemasok.user.last_login).toLocaleString('id-ID') : 'Belum login'}" readonly>
                </div>
                <div class="col-12">
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Reset Password:</strong> 
                        <button type="button" class="btn btn-sm btn-outline-warning ms-2" onclick="resetPasswordPemasok(${pemasok.id_pemasok})">
                            <i class="fas fa-key me-1"></i>Reset Password
                        </button>
                        <small class="d-block mt-1">Klik tombol ini untuk generate password baru untuk pemasok</small>
                    </div>
                </div>
            </div>
        `;
    } else {
        akunContent.innerHTML = `
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong>Akun login belum dibuat</strong> untuk pemasok ini.
            </div>
            <div class="row g-3">
                <div class="col-12">
                    <button type="button" class="btn btn-primary" onclick="createAkunForPemasok(${pemasok.id_pemasok})">
                        <i class="fas fa-plus me-1"></i>Buat Akun Login
                    </button>
                </div>
            </div>
        `;
    }
}

// Handle edit form submission
document.getElementById('editPemasokForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const form = this;
    const pemasokId = form.dataset.pemasokId;
    const formData = new FormData(form);
    
    // Convert FormData to regular object for JSON
    const data = {};
    formData.forEach((value, key) => {
        data[key] = value;
    });
    
    // Send PUT request
    fetch(`/gudang/pemasok/${pemasokId}`, {
        method: 'POST', // Laravel uses POST with _method=PUT
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-HTTP-Method-Override': 'PUT'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Close modal
            bootstrap.Modal.getInstance(document.getElementById('editPemasokModal')).hide();
            
            // Show success message
            alert('Pemasok berhasil diupdate!');
            
            // Reload page to show updated data
            window.location.reload();
        } else {
            alert('Error: ' + (data.message || 'Gagal mengupdate pemasok'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mengupdate pemasok');
    });
});

// Reset password function
function resetPasswordPemasok(pemasokId) {
    if (confirm('Apakah Anda yakin ingin reset password untuk pemasok ini? Password baru akan di-generate secara otomatis.')) {
        const resetButton = event.target;
        const originalContent = resetButton.innerHTML;
        resetButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
        resetButton.disabled = true;

        fetch(`/gudang/pemasok/${pemasokId}/reset-password`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show new password in modal
                const passwordModal = `
                    <div class="modal fade" id="newPasswordModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-warning text-dark">
                                    <h5 class="modal-title">
                                        <i class="fas fa-key me-2"></i>Password Baru
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Password berhasil direset untuk <strong>${data.username}</strong>
                                    </div>
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <div class="mb-2">
                                                <strong>Username:</strong> 
                                                <span class="text-primary">${data.username}</span>
                                                <button type="button" class="btn btn-sm btn-outline-secondary ms-2" onclick="copyToClipboard('${data.username}', 'Username')">
                                                    <i class="fas fa-copy"></i>
                                                </button>
                                            </div>
                                            <div class="mb-2">
                                                <strong>Password Baru:</strong> 
                                                <span class="text-danger">${data.new_password}</span>
                                                <button type="button" class="btn btn-sm btn-outline-secondary ms-2" onclick="copyToClipboard('${data.new_password}', 'Password')">
                                                    <i class="fas fa-copy"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="alert alert-warning">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        <strong>Penting:</strong> Simpan password ini dan berikan kepada pemasok.
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="button" class="btn btn-primary" onclick="copyToClipboard('Username: ${data.username}\\nPassword: ${data.new_password}', 'Informasi login')">
                                        <i class="fas fa-copy me-1"></i>Salin Semua
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                
                // Add modal to page and show
                document.body.insertAdjacentHTML('beforeend', passwordModal);
                const modal = new bootstrap.Modal(document.getElementById('newPasswordModal'));
                modal.show();
                
                // Remove modal when closed
                document.getElementById('newPasswordModal').addEventListener('hidden.bs.modal', function() {
                    this.remove();
                });
                
                showAlert('success', 'Password berhasil direset!');
            } else {
                showAlert('error', 'Error: ' + (data.message || 'Gagal reset password'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('error', 'Terjadi kesalahan saat reset password');
        })
        .finally(() => {
            resetButton.innerHTML = originalContent;
            resetButton.disabled = false;
        });
    }
}

// Create akun for pemasok function
function createAkunForPemasok(pemasokId) {
    if (confirm('Apakah Anda yakin ingin membuat akun login untuk pemasok ini?')) {
        const createButton = event.target;
        const originalContent = createButton.innerHTML;
        createButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating...';
        createButton.disabled = true;

        fetch(`/gudang/pemasok/${pemasokId}/create-account`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert('success', 'Akun berhasil dibuat! Silakan refresh halaman untuk melihat perubahan.');
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            } else {
                showAlert('error', 'Error: ' + (data.message || 'Gagal membuat akun'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('error', 'Terjadi kesalahan saat membuat akun');
        })
        .finally(() => {
            createButton.innerHTML = originalContent;
            createButton.disabled = false;
        });
    }
}

// Show user credentials modal if new pemasok was created
@if(session('success') && session('user_credentials'))
document.addEventListener('DOMContentLoaded', function() {
    const credentials = @json(session('user_credentials'));
    
    // Create modal for showing credentials
    const credentialsModal = `
        <div class="modal fade" id="credentialsModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">
                            <i class="fas fa-check-circle me-2"></i>Pemasok Berhasil Ditambahkan!
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Akun login telah dibuat untuk pemasok ${credentials.nama_perusahaan}</strong>
                        </div>
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title"><i class="fas fa-user me-2"></i>Informasi Login:</h6>
                                        <div class="mb-2">
                                            <strong>Username:</strong> 
                                            <span class="text-primary">${credentials.username}</span>
                                            <button type="button" class="btn btn-sm btn-outline-secondary ms-2" onclick="copyToClipboard('${credentials.username}', 'Username')">
                                                <i class="fas fa-copy"></i>
                                            </button>
                                        </div>
                                        <div class="mb-2">
                                            <strong>Password:</strong> 
                                            <span class="text-danger">${credentials.password}</span>
                                            <button type="button" class="btn btn-sm btn-outline-secondary ms-2" onclick="copyToClipboard('${credentials.password}', 'Password')">
                                                <i class="fas fa-copy"></i>
                                            </button>
                                        </div>
                                        <div class="mb-2">
                                            <strong>Email:</strong> 
                                            <span class="text-info">${credentials.email}</span>
                                            <button type="button" class="btn btn-sm btn-outline-secondary ms-2" onclick="copyToClipboard('${credentials.email}', 'Email')">
                                                <i class="fas fa-copy"></i>
                                            </button>
                                        </div>
                                        <hr>
                                        <div class="mb-0">
                                            <strong>URL Login:</strong><br>
                                            <a href="${credentials.login_url}" target="_blank" class="text-success">
                                                ${credentials.login_url}
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-secondary ms-2" onclick="copyToClipboard('${credentials.login_url}', 'URL Login')">
                                                <i class="fas fa-copy"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-warning mt-3">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Penting:</strong> Simpan informasi ini dan berikan kepada pemasok untuk mengakses sistem.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary" onclick="copyAllCredentials(credentials)">
                            <i class="fas fa-copy me-1"></i>Salin Semua Info
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    // Add modal to page
    document.body.insertAdjacentHTML('beforeend', credentialsModal);
    
    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('credentialsModal'));
    modal.show();
});

// Function to copy all credentials
function copyAllCredentials(credentials) {
    const allInfo = `Informasi Login Pemasok ${credentials.nama_perusahaan}:
Username: ${credentials.username}
Password: ${credentials.password}
Email: ${credentials.email}
URL Login: ${credentials.login_url}

Silakan gunakan informasi ini untuk mengakses sistem.`;

    copyToClipboard(allInfo, 'Semua informasi login');
}
@endif
</script>

@endsection
