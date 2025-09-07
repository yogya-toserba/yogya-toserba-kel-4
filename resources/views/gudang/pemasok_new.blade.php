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
                <button class="btn btn-outline-modern" onclick="exportPemasok('excel')">
                    <i class="fas fa-download"></i>
                    Export
                </button>
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
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nama_perusahaan" class="form-label">Nama Perusahaan *</label>
                            <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" required>
                        </div>
                        <div class="col-md-6">
                            <label for="kontak_person" class="form-label">Kontak Person</label>
                            <input type="text" class="form-control" id="kontak_person" name="kontak_person">
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="col-md-6">
                            <label for="telepon" class="form-label">Telepon</label>
                            <input type="text" class="form-control" id="telepon" name="telepon">
                        </div>
                        <div class="col-12">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="kota" class="form-label">Kota</label>
                            <input type="text" class="form-control" id="kota" name="kota">
                        </div>
                        <div class="col-md-6">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-select" id="kategori" name="kategori">
                                <option value="">Pilih Kategori</option>
                                <option value="makanan">Makanan</option>
                                <option value="minuman">Minuman</option>
                                <option value="elektronik">Elektronik</option>
                                <option value="fashion">Fashion</option>
                                <option value="kesehatan">Kesehatan</option>
                                <option value="rumah-tangga">Rumah Tangga</option>
                            </select>
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
    // Add implementation for viewing pemasok details
    console.log('Viewing pemasok:', id);
}

// Edit pemasok function
function editPemasok(id) {
    // Add implementation for editing pemasok
    console.log('Editing pemasok:', id);
}

// Toggle status function
function toggleStatus(id, status) {
    if (confirm(`Apakah Anda yakin ingin ${status === 'aktif' ? 'mengaktifkan' : 'menonaktifkan'} pemasok ini?`)) {
        // Add implementation for toggling status
        console.log('Toggling status for pemasok:', id, 'to:', status);
    }
}

// Delete pemasok function
function hapusPemasok(id) {
    if (confirm('Apakah Anda yakin ingin menghapus pemasok ini? Tindakan ini tidak dapat dibatalkan.')) {
        // Add implementation for deleting pemasok
        console.log('Deleting pemasok:', id);
    }
}

// Export function
function exportPemasok(format) {
    // Add implementation for exporting data
    console.log('Exporting pemasok data in format:', format);
}
</script>

@endsection
