@extends('layouts.appGudang')

@section('title', 'Manajemen Pemasok - MyYOGYA')

@section('content')
<div class="content">
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
    <style>
    .page-header {
        background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
        color: #fff;
        padding: 22px;
        border-radius: 12px;
        margin-bottom: 20px;
        box-shadow: 0 8px 28px rgba(0,0,0,0.08);
    }
    .page-header h1 { margin: 0; font-size: 1.5rem; font-weight: 700; }
    .page-header p { margin: 0; opacity: 0.95; }
    .page-header .actions .btn { min-width: 140px; }

    .btn-orange {
        background: linear-gradient(135deg,#f26b37 0%,#e55827 100%) !important;
        color: #fff !important;
        border: none !important;
        box-shadow: 0 8px 20px rgba(226,88,39,0.25);
    }
    .btn-orange:hover {
        filter: brightness(0.95);
        color: #fff !important;
    }
    </style>

    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="fas fa-industry me-2"></i>Manajemen Pemasok</h1>
            <p class="mb-0">Kelola data pemasok dan supplier Anda</p>
        </div>
        <div class="actions">
            <button class="btn btn-orange" data-bs-toggle="modal" data-bs-target="#tambahPemasokModal">
                <i class="fas fa-plus me-2"></i>Tambah Pemasok
            </button>
        </div>
    </div>

    <!-- Filter & Search Section -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('pemasok.index') }}" class="row g-3">
                <div class="col-md-3">
                    <input type="text" class="form-control" name="search" placeholder="Cari pemasok..." 
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <select class="form-select" name="status">
                        <option value="">Semua Status</option>
                        <option value="aktif" {{ request('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="non-aktif" {{ request('status') === 'non-aktif' ? 'selected' : '' }}>Non-Aktif</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-select" name="kategori">
                        <option value="">Semua Kategori</option>
                        <option value="makanan" {{ request('kategori') === 'makanan' ? 'selected' : '' }}>Makanan</option>
                        <option value="minuman" {{ request('kategori') === 'minuman' ? 'selected' : '' }}>Minuman</option>
                        <option value="elektronik" {{ request('kategori') === 'elektronik' ? 'selected' : '' }}>Elektronik</option>
                        <option value="fashion" {{ request('kategori') === 'fashion' ? 'selected' : '' }}>Fashion</option>
                        <option value="kesehatan" {{ request('kategori') === 'kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                        <option value="rumah-tangga" {{ request('kategori') === 'rumah-tangga' ? 'selected' : '' }}>Rumah Tangga</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" name="kota" placeholder="Kota" 
                           value="{{ request('kota') }}">
                </div>
                <div class="col-md-3">
                    <div class="btn-group w-100">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search me-1"></i>Cari
                        </button>
                        <a href="{{ route('pemasok.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>Reset
                        </a>
                        <div class="btn-group">
                            <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="fas fa-download me-1"></i>Export
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" onclick="exportPemasok('csv')">
                                    <i class="fas fa-file-csv me-2"></i>Export CSV
                                </a></li>
                                <li><a class="dropdown-item" href="#" onclick="exportPemasok('excel')">
                                    <i class="fas fa-file-excel me-2"></i>Export Excel
                                </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Pemasok Table -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="fas fa-list me-2"></i>Daftar Pemasok
                <span class="badge bg-primary ms-2">{{ $pemasoks->total() }}</span>
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Perusahaan</th>
                            <th>Kontak Person</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Kota</th>
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
                                <div class="fw-bold">{{ $pemasok->nama_perusahaan }}</div>
                                <small class="text-muted">ID: {{ $pemasok->id_pemasok }}</small>
                            </td>
                            <td>{{ $pemasok->kontak_person ?? '-' }}</td>
                            <td>{{ $pemasok->email ?? '-' }}</td>
                            <td>{{ $pemasok->telepon ?? '-' }}</td>
                            <td>{{ $pemasok->kota ?? '-' }}</td>
                            <td>
                                @if($pemasok->kategori_produk)
                                    <span class="badge bg-info">{{ $pemasok->kategori_produk }}</span>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $pemasok->status === 'aktif' ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($pemasok->status) }}
                                </span>
                            </td>
                            <td>
                                @if($pemasok->rating)
                                    <div class="d-flex align-items-center">
                                        <span class="me-1">{{ $pemasok->rating }}</span>
                                        <div class="text-warning">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star{{ $i <= $pemasok->rating ? '' : ' text-muted' }}"></i>
                                            @endfor
                                        </div>
                                    </div>
                                @else
                                    <span class="text-muted">Belum dinilai</span>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" 
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-cogs"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="#" onclick="viewPemasokDetail({{ $pemasok->id_pemasok }})">
                                                <i class="fas fa-eye me-2"></i>Lihat Detail
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#" onclick="editPemasok({{ $pemasok->id_pemasok }})">
                                                <i class="fas fa-edit me-2"></i>Edit Data
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('pemasok.chat', $pemasok->id_pemasok) }}">
                                                <i class="fas fa-comments me-2"></i>Chat
                                            </a>
                                        </li>
                                        <li>
                                            <form action="{{ route('pemasok.reset-password', $pemasok->id_pemasok) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="dropdown-item" 
                                                        onclick="return confirm('Reset password untuk {{ $pemasok->nama_perusahaan }}?')">
                                                    <i class="fas fa-key me-2"></i>Reset Password
                                                </button>
                                            </form>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form action="{{ route('pemasok.destroy', $pemasok->id_pemasok) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger" 
                                                        onclick="return confirm('Hapus pemasok {{ $pemasok->nama_perusahaan }}?')">
                                                    <i class="fas fa-trash me-2"></i>Hapus
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                    <h5>Tidak ada data pemasok</h5>
                                    <p>Belum ada pemasok yang terdaftar atau tidak sesuai dengan filter yang dipilih.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($pemasoks->hasPages())
        <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted">
                    Menampilkan {{ $pemasoks->firstItem() }} - {{ $pemasoks->lastItem() }} 
                    dari {{ $pemasoks->total() }} data
                </div>
                {{ $pemasoks->withQueryString()->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Modal Tambah Pemasok -->
<div class="modal fade" id="tambahPemasokModal" tabindex="-1" aria-labelledby="tambahPemasokModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPemasokModalLabel">Tambah Pemasok Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('pemasok.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nama_perusahaan" class="form-label">Nama Perusahaan *</label>
                            <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="kontak_person" class="form-label">Kontak Person</label>
                            <input type="text" class="form-control" id="kontak_person" name="kontak_person">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="telepon" class="form-label">Telepon</label>
                            <input type="text" class="form-control" id="telepon" name="telepon">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="2"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="kota" class="form-label">Kota</label>
                            <input type="text" class="form-control" id="kota" name="kota">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="kode_pos" class="form-label">Kode Pos</label>
                            <input type="text" class="form-control" id="kode_pos" name="kode_pos">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="kategori_produk" class="form-label">Kategori Produk</label>
                            <select class="form-select" id="kategori_produk" name="kategori_produk">
                                <option value="">Pilih Kategori</option>
                                <option value="makanan">Makanan</option>
                                <option value="minuman">Minuman</option>
                                <option value="elektronik">Elektronik</option>
                                <option value="fashion">Fashion</option>
                                <option value="kesehatan">Kesehatan & Kecantikan</option>
                                <option value="rumah-tangga">Rumah Tangga</option>
                                <option value="olahraga">Olahraga & Outdoor</option>
                                <option value="otomotif">Otomotif</option>
                                <option value="buku">Buku & Alat Tulis</option>
                                <option value="mainan">Mainan & Hobi</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_kerjasama" class="form-label">Tanggal Kerjasama</label>
                            <input type="date" class="form-control" id="tanggal_kerjasama" name="tanggal_kerjasama">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="aktif">Aktif</option>
                                <option value="non-aktif">Non-Aktif</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <select class="form-select" id="rating" name="rating">
                                <option value="">Pilih Rating</option>
                                <option value="1">1 - Kurang Baik</option>
                                <option value="2">2 - Cukup</option>
                                <option value="3">3 - Baik</option>
                                <option value="4">4 - Sangat Baik</option>
                                <option value="5">5 - Excellent</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="catatan" class="form-label">Catatan</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Pemasok</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Detail Pemasok -->
<div class="modal fade" id="detailPemasokModal" tabindex="-1" aria-labelledby="detailPemasokModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailPemasokModalLabel">Detail Pemasok</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Content will be loaded via JavaScript -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Pemasok -->
<div class="modal fade" id="editPemasokModal" tabindex="-1" aria-labelledby="editPemasokModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPemasokModalLabel">Edit Pemasok</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editPemasokForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_nama_perusahaan" class="form-label">Nama Perusahaan *</label>
                            <input type="text" class="form-control" id="edit_nama_perusahaan" name="nama_perusahaan" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_kontak_person" class="form-label">Kontak Person</label>
                            <input type="text" class="form-control" id="edit_kontak_person" name="kontak_person">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_email" class="form-label">Email *</label>
                            <input type="email" class="form-control" id="edit_email" name="email" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_telepon" class="form-label">Telepon</label>
                            <input type="text" class="form-control" id="edit_telepon" name="telepon">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="edit_alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="edit_alamat" name="alamat" rows="2"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_kota" class="form-label">Kota</label>
                            <input type="text" class="form-control" id="edit_kota" name="kota">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_kode_pos" class="form-label">Kode Pos</label>
                            <input type="text" class="form-control" id="edit_kode_pos" name="kode_pos">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_kategori_produk" class="form-label">Kategori Produk</label>
                            <select class="form-select" id="edit_kategori_produk" name="kategori_produk">
                                <option value="">Pilih Kategori</option>
                                <option value="makanan">Makanan</option>
                                <option value="minuman">Minuman</option>
                                <option value="elektronik">Elektronik</option>
                                <option value="fashion">Fashion</option>
                                <option value="kesehatan">Kesehatan & Kecantikan</option>
                                <option value="rumah-tangga">Rumah Tangga</option>
                                <option value="olahraga">Olahraga & Outdoor</option>
                                <option value="otomotif">Otomotif</option>
                                <option value="buku">Buku & Alat Tulis</option>
                                <option value="mainan">Mainan & Hobi</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_tanggal_kerjasama" class="form-label">Tanggal Kerjasama</label>
                            <input type="date" class="form-control" id="edit_tanggal_kerjasama" name="tanggal_kerjasama">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_status" class="form-label">Status</label>
                            <select class="form-select" id="edit_status" name="status">
                                <option value="aktif">Aktif</option>
                                <option value="non-aktif">Non-Aktif</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_rating" class="form-label">Rating</label>
                            <select class="form-select" id="edit_rating" name="rating">
                                <option value="">Pilih Rating</option>
                                <option value="1">1 - Kurang Baik</option>
                                <option value="2">2 - Cukup</option>
                                <option value="3">3 - Baik</option>
                                <option value="4">4 - Sangat Baik</option>
                                <option value="5">5 - Excellent</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_catatan" class="form-label">Catatan</label>
                            <textarea class="form-control" id="edit_catatan" name="catatan" rows="3"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="updatePemasokBtn">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
console.log('=== PEMASOK SCRIPT LOADED ===');

// Test immediate availability
console.log('Bootstrap available:', typeof bootstrap !== 'undefined');
console.log('jQuery available:', typeof $ !== 'undefined');

// CSRF Token untuk AJAX
const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

// ===== GLOBAL FUNCTIONS =====

// Global function untuk view detail pemasok
function viewPemasokDetail(id) {
    console.log('=== viewPemasokDetail called ===', id);
    
    if (!id) {
        alert('ID tidak valid');
        return;
    }
    
    const modalElement = document.getElementById('detailPemasokModal');
    if (!modalElement) {
        alert('Modal detail tidak ditemukan!');
        return;
    }
    
    try {
        const modal = new bootstrap.Modal(modalElement);
        modal.show();
        
        // Set loading content
        document.querySelector('#detailPemasokModal .modal-title').innerHTML = 'Memuat Data...';
        document.querySelector('#detailPemasokModal .modal-body').innerHTML = '<div class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>';
        
        // Fetch data from controller
        const url = `/gudang/pemasok/${id}`;
        console.log('Fetching from:', url);
        
        fetch(url, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            console.log('Response status:', response.status);
            if (!response.ok) {
                throw new Error(`HTTP ${response.status}: ${response.statusText}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('Data received:', data);
            
            if (data.success && data.data) {
                const pemasok = data.data;
                
                document.querySelector('#detailPemasokModal .modal-title').innerHTML = 'Detail Pemasok';
                document.querySelector('#detailPemasokModal .modal-body').innerHTML = `
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr><th>Nama Perusahaan:</th><td>${pemasok.nama_perusahaan || '-'}</td></tr>
                                <tr><th>Kontak Person:</th><td>${pemasok.kontak_person || '-'}</td></tr>
                                <tr><th>Email:</th><td>${pemasok.email || '-'}</td></tr>
                                <tr><th>Telepon:</th><td>${pemasok.telepon || '-'}</td></tr>
                                <tr><th>Alamat:</th><td>${pemasok.alamat || '-'}</td></tr>
                                <tr><th>Kota:</th><td>${pemasok.kota || '-'}</td></tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr><th>Kode Pos:</th><td>${pemasok.kode_pos || '-'}</td></tr>
                                <tr><th>Kategori Produk:</th><td>${pemasok.kategori_produk || '-'}</td></tr>
                                <tr><th>Tanggal Kerjasama:</th><td>${pemasok.tanggal_kerjasama || '-'}</td></tr>
                                <tr><th>Status:</th><td><span class="badge ${pemasok.status === 'aktif' ? 'bg-success' : 'bg-danger'}">${pemasok.status || 'Tidak diketahui'}</span></td></tr>
                                <tr><th>Rating:</th><td>${pemasok.rating ? pemasok.rating + '/5' : '-'}</td></tr>
                                <tr><th>Catatan:</th><td>${pemasok.catatan || '-'}</td></tr>
                            </table>
                        </div>
                    </div>
                `;
            } else {
                throw new Error(data.message || 'Data tidak ditemukan');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.querySelector('#detailPemasokModal .modal-title').innerHTML = 'Error';
            document.querySelector('#detailPemasokModal .modal-body').innerHTML = `
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle"></i> 
                    Gagal memuat data: ${error.message}
                </div>
            `;
        });
        
    } catch (error) {
        console.error('Modal error:', error);
        alert('Error membuka modal: ' + error.message);
    }
}

// Global function untuk edit pemasok
function editPemasok(id) {
    console.log('=== editPemasok called ===', id);
    
    if (!id) {
        alert('ID tidak valid');
        return;
    }
    
    const modalElement = document.getElementById('editPemasokModal');
    if (!modalElement) {
        alert('Modal edit tidak ditemukan!');
        return;
    }
    
    try {
        const modal = new bootstrap.Modal(modalElement);
        modal.show();
        
        // Set loading content
        document.querySelector('#editPemasokModal .modal-title').innerHTML = 'Memuat Data...';
        document.querySelector('#editPemasokModal .modal-body').innerHTML = '<div class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>';
        
        // Fetch data for editing
        const url = `/gudang/pemasok/${id}`;
        console.log('Fetching for edit:', url);
        
        fetch(url, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP ${response.status}: ${response.statusText}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('Edit data received:', data);
            
            if (data.success && data.data) {
                const pemasok = data.data;
                
                // Restore modal title
                document.querySelector('#editPemasokModal .modal-title').innerHTML = 'Edit Pemasok';
                
                // Restore modal body content with form (get from template above)
                const originalFormHTML = `
                    <form id="editPemasokForm" method="POST">
                        <input type="hidden" name="_token" value="${csrfToken}">
                        <input type="hidden" name="_method" value="PUT">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="edit_nama_perusahaan" class="form-label">Nama Perusahaan *</label>
                                <input type="text" class="form-control" id="edit_nama_perusahaan" name="nama_perusahaan" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit_kontak_person" class="form-label">Kontak Person</label>
                                <input type="text" class="form-control" id="edit_kontak_person" name="kontak_person">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit_email" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="edit_email" name="email" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit_telepon" class="form-label">Telepon</label>
                                <input type="text" class="form-control" id="edit_telepon" name="telepon">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="edit_alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="edit_alamat" name="alamat" rows="2"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit_kota" class="form-label">Kota</label>
                                <input type="text" class="form-control" id="edit_kota" name="kota">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit_kode_pos" class="form-label">Kode Pos</label>
                                <input type="text" class="form-control" id="edit_kode_pos" name="kode_pos">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit_kategori_produk" class="form-label">Kategori Produk</label>
                                <select class="form-select" id="edit_kategori_produk" name="kategori_produk">
                                    <option value="">Pilih Kategori</option>
                                    <option value="makanan">Makanan</option>
                                    <option value="minuman">Minuman</option>
                                    <option value="elektronik">Elektronik</option>
                                    <option value="fashion">Fashion</option>
                                    <option value="kesehatan">Kesehatan & Kecantikan</option>
                                    <option value="rumah-tangga">Rumah Tangga</option>
                                    <option value="olahraga">Olahraga & Outdoor</option>
                                    <option value="otomotif">Otomotif</option>
                                    <option value="buku">Buku & Alat Tulis</option>
                                    <option value="mainan">Mainan & Hobi</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit_tanggal_kerjasama" class="form-label">Tanggal Kerjasama</label>
                                <input type="date" class="form-control" id="edit_tanggal_kerjasama" name="tanggal_kerjasama">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit_status" class="form-label">Status</label>
                                <select class="form-select" id="edit_status" name="status">
                                    <option value="aktif">Aktif</option>
                                    <option value="non-aktif">Non-Aktif</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit_rating" class="form-label">Rating</label>
                                <select class="form-select" id="edit_rating" name="rating">
                                    <option value="">Pilih Rating</option>
                                    <option value="1">1 - Kurang Baik</option>
                                    <option value="2">2 - Cukup</option>
                                    <option value="3">3 - Baik</option>
                                    <option value="4">4 - Sangat Baik</option>
                                    <option value="5">5 - Excellent</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit_catatan" class="form-label">Catatan</label>
                                <textarea class="form-control" id="edit_catatan" name="catatan" rows="3"></textarea>
                            </div>
                        </div>
                    </form>
                `;
                
                document.querySelector('#editPemasokModal .modal-body').innerHTML = originalFormHTML;
                
                // Populate form fields
                const fieldMappings = {
                    'edit_nama_perusahaan': 'nama_perusahaan',
                    'edit_kontak_person': 'kontak_person', 
                    'edit_email': 'email',
                    'edit_telepon': 'telepon',
                    'edit_alamat': 'alamat',
                    'edit_kota': 'kota',
                    'edit_kode_pos': 'kode_pos',
                    'edit_kategori_produk': 'kategori_produk',
                    'edit_tanggal_kerjasama': 'tanggal_kerjasama',
                    'edit_status': 'status',
                    'edit_rating': 'rating',
                    'edit_catatan': 'catatan'
                };
                
                Object.keys(fieldMappings).forEach(fieldId => {
                    const element = document.getElementById(fieldId);
                    const dataKey = fieldMappings[fieldId];
                    if (element && pemasok[dataKey] !== undefined) {
                        element.value = pemasok[dataKey] || '';
                    }
                });
                
                // Store ID for form submission
                const form = document.getElementById('editPemasokForm');
                if (form) {
                    form.setAttribute('data-id', id);
                    form.action = `/gudang/pemasok/${id}`;
                }
                
            } else {
                throw new Error(data.message || 'Gagal memuat data untuk edit');
            }
        })
        .catch(error => {
            console.error('Edit error:', error);
            document.querySelector('#editPemasokModal .modal-title').innerHTML = 'Error';
            document.querySelector('#editPemasokModal .modal-body').innerHTML = `
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle"></i> 
                    Gagal memuat data untuk edit: ${error.message}
                </div>
            `;
        });
        
    } catch (error) {
        console.error('Edit modal error:', error);
        alert('Error membuka modal edit: ' + error.message);
    }
}

// Export function
function exportPemasok(format = 'csv') {
    console.log('Export function called with format:', format);
    
    const searchParams = new URLSearchParams();
    searchParams.append('format', format);
    
    // Get filter values
    const searchInput = document.querySelector('input[name="search"]');
    if (searchInput?.value) searchParams.append('search', searchInput.value);
    
    const statusSelect = document.querySelector('select[name="status"]');
    if (statusSelect?.value) searchParams.append('status', statusSelect.value);
    
    const kategoriSelect = document.querySelector('select[name="kategori"]');
    if (kategoriSelect?.value) searchParams.append('kategori', kategoriSelect.value);
    
    const kotaSelect = document.querySelector('select[name="kota"]');
    if (kotaSelect?.value) searchParams.append('kota', kotaSelect.value);
    
    const exportUrl = `${window.location.origin}/gudang/export-pemasok?${searchParams.toString()}`;
    
    // Show loading notification
    const formatText = format === 'excel' ? 'Excel' : 'CSV';
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            icon: 'info',
            title: `Mempersiapkan file ${formatText}...`,
            timer: 2000,
            showConfirmButton: false
        });
    }
    
    // Download file
    const link = document.createElement('a');
    link.href = exportUrl;
    link.style.display = 'none';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

// DOM ready functions
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM ready!');
    
    // Initialize Bootstrap dropdowns
    const dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
    dropdownElementList.map(function (dropdownToggleEl) {
        return new bootstrap.Dropdown(dropdownToggleEl);
    });
    
    // Auto-format phone number
    const phoneInput = document.querySelector('input[name="telepon"]');
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 0 && value.startsWith('8')) {
                value = '0' + value;
            }
            e.target.value = value;
        });
    }
    
    // Update button handler
    const updateBtn = document.getElementById('updatePemasokBtn');
    if (updateBtn) {
        updateBtn.addEventListener('click', function() {
            updatePemasok();
        });
    }
});

// Update function
function updatePemasok() {
    const form = document.getElementById('editPemasokForm');
    const id = form?.getAttribute('data-id');
    
    if (!id) {
        alert('ID pemasok tidak ditemukan');
        return;
    }
    
    const formData = new FormData(form);
    formData.append('_method', 'PUT');
    
    fetch(`/gudang/pemasok/${id}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            if (typeof Swal !== 'undefined') {
                Swal.fire('Berhasil!', 'Data pemasok berhasil diperbarui', 'success')
                .then(() => location.reload());
            } else {
                alert('Data berhasil diperbarui');
                location.reload();
            }
        } else {
            throw new Error(data.message || 'Gagal memperbarui data');
        }
    })
    .catch(error => {
        console.error('Update error:', error);
        if (typeof Swal !== 'undefined') {
            Swal.fire('Error!', error.message, 'error');
        } else {
            alert('Error: ' + error.message);
        }
    });
}

console.log('=== SCRIPT FULLY LOADED ===');
</script>
@endpush
