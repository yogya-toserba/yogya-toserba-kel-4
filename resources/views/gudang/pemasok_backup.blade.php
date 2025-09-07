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
            <div class="actions d-flex gap-2">
            <div class="dropdown">
                <button class="btn btn-orange btn-lg shadow-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-file-excel me-2"></i>Export Data
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><button class="dropdown-item" onclick="exportPemasok('csv')">
                        <i class="fas fa-file-csv me-2"></i>Export CSV
                    </button></li>
                    <li><button class="dropdown-item" onclick="exportPemasok('excel')">
                        <i class="fas fa-file-excel me-2"></i>Export Excel
                    </button></li>
                </ul>
            </div>
            <button class="btn btn-orange btn-lg shadow-sm" data-bs-toggle="modal" data-bs-target="#tambahPemasokModal">
                <i class="fas fa-plus me-2"></i>Tambah Pemasok
            </button>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm bg-gradient-primary text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="mb-1 fw-medium opacity-75">Total Pemasok</p>
                            <h3 class="mb-0">{{ $totalPemasok ?? 0 }}</h3>
                        </div>
                        <div class="ms-3">
                            <i class="fas fa-building fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm bg-gradient-success text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="mb-1 fw-medium opacity-75">Aktif</p>
                            <h3 class="mb-0">{{ $pemasokAktif ?? 0 }}</h3>
                        </div>
                        <div class="ms-3">
                            <i class="fas fa-check-circle fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm bg-gradient-warning text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="mb-1 fw-medium opacity-75">Non-Aktif</p>
                            <h3 class="mb-0">{{ $pemasokNonAktif ?? 0 }}</h3>
                        </div>
                        <div class="ms-3">
                            <i class="fas fa-pause-circle fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm bg-gradient-info text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="mb-1 fw-medium opacity-75">Kategori Produk</p>
                            <h3 class="mb-0">{{ $totalKategori ?? 0 }}</h3>
                        </div>
                        <div class="ms-3">
                            <i class="fas fa-tags fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('gudang.pemasok.index') }}" id="filterForm">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-medium">Cari Pemasok</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-start-0" 
                                   placeholder="Nama, alamat, atau produk..." 
                                   value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-medium">Status</label>
                        <select name="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="non-aktif" {{ request('status') == 'non-aktif' ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-medium">Kategori Produk</label>
                        <select name="kategori" class="form-select">
                            <option value="">Semua Kategori</option>
                            @foreach($kategoriProduk as $kategori)
                                <option value="{{ $kategori }}" 
                                        {{ request('kategori') == $kategori ? 'selected' : '' }}>
                                    {{ $kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-medium">Kota</label>
                        <select name="kota" class="form-select">
                            <option value="">Semua Kota</option>
                            @foreach($kotaList as $kota)
                                <option value="{{ $kota }}" 
                                        {{ request('kota') == $kota ? 'selected' : '' }}>
                                    {{ $kota }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1">
                        <label class="form-label fw-medium">&nbsp;</label>
                        <button type="submit" class="btn btn-outline-primary w-100">
                            <i class="fas fa-filter me-1"></i>Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">Daftar Pemasok</h5>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-success btn-sm">
                        <i class="fas fa-download me-1"></i>Export Excel
                    </button>
                    <button class="btn btn-outline-info btn-sm">
                        <i class="fas fa-print me-1"></i>Print
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="border-0 fw-semibold">#</th>
                            <th class="border-0 fw-semibold">Pemasok</th>
                            <th class="border-0 fw-semibold">Kontak & Lokasi</th>
                            <th class="border-0 fw-semibold">Produk Utama</th>
                            <th class="border-0 fw-semibold">Status</th>
                            <th class="border-0 fw-semibold">Rating</th>
                            <th class="border-0 fw-semibold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pemasoks as $index => $pemasok)
                        <tr>
                            <td class="align-middle">{{ $pemasoks->firstItem() + $index }}</td>
                            <td class="align-middle">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-{{ $pemasok->status == 'aktif' ? 'primary' : 'secondary' }} rounded-circle d-flex align-items-center justify-content-center me-3">
                                        <i class="fas fa-building text-white"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $pemasok->nama_perusahaan }}</h6>
                                        <small class="text-muted">{{ $pemasok->kontak_person }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle">
                                <div>
                                    <div class="fw-medium">{{ $pemasok->telepon }}</div>
                                    <small class="text-muted">
                                        <i class="fas fa-envelope me-1"></i>{{ $pemasok->email }}
                                    </small><br>
                                    <small class="text-muted">
                                        <i class="fas fa-map-marker-alt me-1"></i>{{ $pemasok->kota }}
                                    </small>
                                </div>
                            </td>
                            <td class="align-middle">
                                <span class="badge bg-light text-dark border">{{ $pemasok->kategori_produk }}</span>
                            </td>
                            <td class="align-middle">
                                <span class="badge bg-{{ $pemasok->status == 'aktif' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($pemasok->status) }}
                                </span>
                            </td>
                            <td class="align-middle">
                                <div class="d-flex align-items-center">
                                    <span class="text-warning me-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= floor($pemasok->rating))
                                                ★
                                            @elseif($i <= $pemasok->rating)
                                                ☆
                                            @else
                                                ☆
                                            @endif
                                        @endfor
                                    </span>
                                    <small class="text-muted">{{ number_format($pemasok->rating, 1) }}</small>
                                </div>
                            </td>
                            <td class="align-middle text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" 
                                            type="button" 
                                            data-bs-toggle="dropdown" 
                                            aria-expanded="false"
                                            style="pointer-events: auto !important; z-index: 10 !important;">
                                        <i class="fas fa-cog"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <button class="dropdown-item btn-detail" 
                                                    data-id="{{ $pemasok->id_pemasok }}"
                                                    onclick="window.viewPemasokDetail({{ $pemasok->id_pemasok }})"
                                                    type="button">
                                                <i class="fas fa-eye text-info me-2"></i>Lihat Detail
                                            </button>
                                        </li>
                                        <li>
                                            <button class="dropdown-item btn-edit" 
                                                    onclick="window.editPemasok({{ $pemasok->id_pemasok }})">
                                                <i class="fas fa-edit text-warning me-2"></i>Edit Data
                                            </button>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <button class="dropdown-item text-danger btn-delete" 
                                                    data-id="{{ $pemasok->id_pemasok }}"
                                                    data-nama="{{ $pemasok->nama_perusahaan }}">
                                                <i class="fas fa-trash me-2"></i>Hapus Data
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                    <p class="mb-0">Tidak ada data pemasok yang ditemukan</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-top-0">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    Menampilkan {{ $pemasoks->firstItem() ?? 0 }}-{{ $pemasoks->lastItem() ?? 0 }} 
                    dari {{ $pemasoks->total() ?? 0 }} data
                </small>
                <div>
                    {{ $pemasoks->appends(request()->input())->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit Pemasok -->
<div class="modal fade" id="tambahPemasokModal" tabindex="-1" aria-labelledby="tambahPemasokLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <div>
                    <h5 class="modal-title mb-0" id="tambahPemasokLabel">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Pemasok Baru
                    </h5>
                    <small class="opacity-75">Lengkapi informasi pemasok dengan benar</small>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('gudang.pemasok.store') }}" id="formPemasok">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-medium">
                                    <i class="fas fa-building text-primary me-1"></i>Nama Perusahaan
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="nama_perusahaan" class="form-control" placeholder="PT/CV/UD Nama Perusahaan" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-medium">
                                    <i class="fas fa-user text-primary me-1"></i>Nama Kontak Person
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="kontak_person" class="form-control" placeholder="Nama perwakilan perusahaan" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-medium">
                                    <i class="fas fa-phone text-primary me-1"></i>No. Telepon
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="tel" name="telepon" class="form-control" placeholder="08xxxxxxxxxx" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-medium">
                                    <i class="fas fa-envelope text-primary me-1"></i>Email
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="email" name="email" class="form-control" placeholder="email@perusahaan.com" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-medium">
                            <i class="fas fa-map-marker-alt text-primary me-1"></i>Alamat Lengkap
                            <span class="text-danger">*</span>
                        </label>
                        <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat lengkap pemasok" required></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-medium">
                                    <i class="fas fa-city text-primary me-1"></i>Kota/Kabupaten
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="kota" class="form-select" required>
                                    <option value="">Pilih Kota/Kabupaten</option>
                                    <option value="Jakarta">Jakarta</option>
                                    <option value="Bandung">Bandung</option>
                                    <option value="Surabaya">Surabaya</option>
                                    <option value="Medan">Medan</option>
                                    <option value="Semarang">Semarang</option>
                                    <option value="Yogyakarta">Yogyakarta</option>
                                    <option value="Malang">Malang</option>
                                    <option value="Solo">Solo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-medium">
                                    <i class="fas fa-tags text-primary me-1"></i>Kategori Produk
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="kategori_produk" class="form-select" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="Makanan & Minuman">Makanan & Minuman</option>
                                    <option value="Elektronik">Elektronik</option>
                                    <option value="Fashion & Aksesoris">Fashion & Aksesoris</option>
                                    <option value="Kebutuhan Rumah">Kebutuhan Rumah</option>
                                    <option value="Kesehatan & Kecantikan">Kesehatan & Kecantikan</option>
                                    <option value="Olahraga & Hobi">Olahraga & Hobi</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-medium">
                                    <i class="fas fa-calendar text-primary me-1"></i>Tanggal Kerjasama
                                </label>
                                <input type="date" name="tanggal_kerjasama" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-medium">
                                    <i class="fas fa-star text-primary me-1"></i>Rating
                                </label>
                                <select name="rating" class="form-select">
                                    <option value="">Pilih Rating</option>
                                    <option value="5">5 - Sangat Baik</option>
                                    <option value="4">4 - Baik</option>
                                    <option value="3">3 - Cukup</option>
                                    <option value="2">2 - Kurang</option>
                                    <option value="1">1 - Sangat Kurang</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-medium">
                                    <i class="fas fa-toggle-on text-primary me-1"></i>Status
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="status" class="form-select" required>
                                    <option value="">Pilih Status</option>
                                    <option value="aktif" selected>Aktif</option>
                                    <option value="non-aktif">Non-Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-medium">
                            <i class="fas fa-sticky-note text-primary me-1"></i>Catatan
                        </label>
                        <textarea name="catatan" class="form-control" rows="2" placeholder="Catatan tambahan tentang pemasok (opsional)"></textarea>
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2 pt-3">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i>Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Simpan Pemasok
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Pemasok -->
<div class="modal fade" id="detailPemasokModal" tabindex="-1" aria-labelledby="detailPemasokLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-info text-white">
                <div>
                    <h5 class="modal-title mb-0" id="detailPemasokLabel">
                        <i class="fas fa-info-circle me-2"></i>Detail Pemasok
                    </h5>
                    <small class="opacity-75">Informasi lengkap pemasok</small>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted small">NAMA PEMASOK</label>
                            <div class="fw-medium">PT Maju Jaya Sejahtera</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small">KONTAK PERSON</label>
                            <div class="fw-medium">Budi Santoso</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small">TELEPON</label>
                            <div class="fw-medium">0812-3456-7890</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted small">EMAIL</label>
                            <div class="fw-medium">info@majujaya.com</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small">STATUS</label>
                            <div><span class="badge bg-success">Aktif</span></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small">RATING</label>
                            <div class="d-flex align-items-center">
                                <span class="text-warning me-2">★★★★☆</span>
                                <span class="fw-medium">4.2/5</span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label text-muted small">ALAMAT</label>
                            <div class="fw-medium">Jl. Raya Industri No. 123, Bandung, Jawa Barat 40123</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small">PRODUK UTAMA</label>
                            <div>
                                <span class="badge bg-light text-dark border me-1">Beras Premium</span>
                                <span class="badge bg-light text-dark border me-1">Gula Pasir</span>
                                <span class="badge bg-light text-dark border">Minyak Goreng</span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small">TANGGAL KERJASAMA</label>
                            <div class="fw-medium">15 Januari 2024</div>
                        </div>
                        <div class="mb-0">
                            <label class="form-label text-muted small">CATATAN</label>
                            <div class="fw-medium">Supplier terpercaya dengan kualitas produk konsisten dan pengiriman tepat waktu.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Pemasok Modal -->
<div class="modal fade" id="editPemasokModal" tabindex="-1" aria-labelledby="editPemasokModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPemasokModalLabel">Edit Pemasok</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editPemasokForm">
                    <input type="hidden" id="edit_id_pemasok" name="id_pemasok">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_nama_perusahaan" class="form-label">Nama Perusahaan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_nama_perusahaan" name="nama_perusahaan" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_kontak_person" class="form-label">Kontak Person <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_kontak_person" name="kontak_person" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_telepon" class="form-label">Telepon <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_telepon" name="telepon" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="edit_email" name="email" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="edit_alamat" name="alamat" rows="3" required></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_kota" class="form-label">Kota <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_kota" name="kota" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_kategori_produk" class="form-label">Kategori Produk <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_kategori_produk" name="kategori_produk" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_tanggal_kerjasama" class="form-label">Tanggal Kerjasama</label>
                            <input type="date" class="form-control" id="edit_tanggal_kerjasama" name="tanggal_kerjasama">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select" id="edit_status" name="status" required>
                                <option value="">Pilih Status</option>
                                <option value="aktif">Aktif</option>
                                <option value="non-aktif">Non-Aktif</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
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
<!-- jQuery sudah dimuat di layout -->
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
console.log('=== PEMASOK SCRIPT LOADING ===');

// Test immediate availability
console.log('Bootstrap available:', typeof bootstrap !== 'undefined');
console.log('jQuery available:', typeof $ !== 'undefined');

// Simple global functions (no window prefix needed)
function viewPemasokDetail(id) {
    console.log('viewPemasokDetail called with ID:', id);
    alert('View Detail untuk ID: ' + id + ' - Feature under development');
}

function editPemasok(id) {
    console.log('editPemasok called with ID:', id); 
    alert('Edit Pemasok untuk ID: ' + id + ' - Feature under development');
}

// Fix untuk Bootstrap dropdown yang tidak bekerja
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM ready - initializing dropdowns...');
    
    // Force reinitialize semua dropdown
    const dropdownElements = document.querySelectorAll('[data-bs-toggle="dropdown"]');
    console.log('Found dropdown elements:', dropdownElements.length);
    
    dropdownElements.forEach(function(element, index) {
        console.log('Initializing dropdown', index + 1);
        try {
            // Destroy existing dropdown jika ada
            const existingDropdown = bootstrap.Dropdown.getInstance(element);
            if (existingDropdown) {
                existingDropdown.dispose();
            }
            
            // Create new dropdown instance
            const dropdown = new bootstrap.Dropdown(element);
            console.log('Dropdown', index + 1, 'initialized successfully');
            
            // Add event listener untuk debugging
            element.addEventListener('click', function(e) {
                console.log('Dropdown button clicked:', e.target);
                e.stopPropagation();
            });
            
        } catch (error) {
            console.error('Error initializing dropdown', index + 1, ':', error);
        }
    });
    
    // Test klik pada dropdown pertama
    setTimeout(function() {
        const firstDropdown = document.querySelector('[data-bs-toggle="dropdown"]');
        if (firstDropdown) {
            console.log('Testing first dropdown click...');
            firstDropdown.style.backgroundColor = '#e3f2fd'; // Visual indicator
        }
    }, 1000);
    
    // Manual dropdown handler sebagai backup
    document.addEventListener('click', function(e) {
        if (e.target.closest('[data-bs-toggle="dropdown"]')) {
            console.log('Manual dropdown handler triggered');
            const button = e.target.closest('[data-bs-toggle="dropdown"]');
            const dropdown = button.nextElementSibling;
            
            if (dropdown && dropdown.classList.contains('dropdown-menu')) {
                // Toggle dropdown visibility
                if (dropdown.style.display === 'block') {
                    dropdown.style.display = 'none';
                    dropdown.classList.remove('show');
                } else {
                    // Hide all other dropdowns first
                    document.querySelectorAll('.dropdown-menu').forEach(menu => {
                        menu.style.display = 'none';
                        menu.classList.remove('show');
                    });
                    
                    // Show this dropdown
                    dropdown.style.display = 'block';
                    dropdown.classList.add('show');
                }
                e.preventDefault();
                e.stopPropagation();
            }
        } else {
            // Click outside - hide all dropdowns
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.style.display = 'none';
                menu.classList.remove('show');
            });
        }
    });
});

<style>
.avatar-sm {
    width: 40px;
    height: 40px;
    font-size: 14px;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.bg-gradient-success {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

.bg-gradient-warning {
    background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
}

.bg-gradient-info {
    background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
}

.table-hover tbody tr:hover {
    background-color: rgba(0, 123, 255, 0.05);
}

/* Dark mode for table hover */
body.dark-mode .table-hover tbody tr:hover {
    background-color: rgba(242, 107, 55, 0.1) !important;
}

/* Button group styles */
.btn-group .btn {
    margin: 0 2px;
    padding: 4px 8px;
    font-size: 12px;
    border-radius: 4px !important;
}

/* BOOTSTRAP DROPDOWN FIX */
.dropdown-toggle {
    pointer-events: auto !important;
    cursor: pointer !important;
    z-index: 10 !important;
    position: relative !important;
}

.dropdown-menu {
    z-index: 9999 !important;
    position: absolute !important;
    pointer-events: auto !important;
}

.table .dropdown {
    position: relative !important;
}

.table td {
    overflow: visible !important;
    position: relative !important;
}

/* Pastikan dropdown button dapat diklik */
.btn[data-bs-toggle="dropdown"] {
    pointer-events: auto !important;
    background-color: #f8f9fa !important;
    border: 1px solid #dee2e6 !important;
    padding: 0.25rem 0.5rem !important;
    font-size: 0.875rem !important;
    border-radius: 0.375rem !important;
    cursor: pointer !important;
}

.btn[data-bs-toggle="dropdown"]:hover {
    background-color: #e9ecef !important;
    border-color: #adb5bd !important;
}

.btn-group .btn:hover {
    transform: translateY(-1px);
}

.btn-group .btn i {
    font-size: 11px;
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1) !important;
}

/* Dark mode card hover */
body.dark-mode .card:hover {
    box-shadow: 0 4px 8px rgba(242, 107, 55, 0.15) !important;
}

.btn:hover {
    transform: translateY(-1px);
    transition: all 0.2s ease;
}

/* Additional dark mode fixes for pemasok page */
body.dark-mode .modal-content {
    background-color: #2a2d3f !important;
    color: #e2e8f0 !important;
}

body.dark-mode .modal-header {
    background-color: #374151 !important;
    border-color: #3a3d4a !important;
    color: #e2e8f0 !important;
}

body.dark-mode .modal-footer {
    background-color: #2a2d3f !important;
    border-color: #3a3d4a !important;
}

body.dark-mode .close {
    color: #e2e8f0 !important;
}

/* Dark mode for input groups */
body.dark-mode .input-group-text {
    background-color: #374151 !important;
    border-color: #4b5563 !important;
    color: #e2e8f0 !important;
}

/* Dark mode for text muted */
body.dark-mode .text-muted {
    color: #9ca3af !important;
}

/* Dark mode for small text */
body.dark-mode small {
    color: #9ca3af !important;
}

/* Dark mode for strong text */
body.dark-mode strong {
    color: #f3f4f6 !important;
}
</style>

<script>
console.log('JavaScript file loaded!');

// Global function untuk export pemasok
function exportPemasok(format = 'csv') {
    console.log('Export function called with format:', format);
    
    // Get current filter values
    const searchParams = new URLSearchParams();
    
    // Add format parameter
    searchParams.append('format', format);
    
    // Get search value
    const searchInput = document.querySelector('input[name="search"]');
    if (searchInput && searchInput.value) {
        searchParams.append('search', searchInput.value);
    }
    
    // Get status filter
    const statusSelect = document.querySelector('select[name="status"]');
    if (statusSelect && statusSelect.value) {
        searchParams.append('status', statusSelect.value);
    }
    
    // Get kategori filter
    const kategoriSelect = document.querySelector('select[name="kategori"]');
    if (kategoriSelect && kategoriSelect.value) {
        searchParams.append('kategori', kategoriSelect.value);
    }
    
    // Get kota filter
    const kotaSelect = document.querySelector('select[name="kota"]');
    if (kotaSelect && kotaSelect.value) {
        searchParams.append('kota', kotaSelect.value);
    }
    
    // Build export URL with filters
    const baseUrl = window.location.origin;
    const exportUrl = `${baseUrl}/gudang/export-pemasok?${searchParams.toString()}`;
    
    console.log('Export URL:', exportUrl);
    
    // Test URL alternatif juga
    const altUrl = `${baseUrl}/gudang/pemasok/export?${searchParams.toString()}`;
    console.log('Alternative Export URL:', altUrl);
    
    // Show loading notification
    const formatText = format === 'excel' ? 'Excel' : 'CSV';
    if (typeof Swal !== 'undefined') {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true
        });
        
        Toast.fire({
            icon: 'info',
            title: `Mempersiapkan file ${formatText}...`
        });
    } else {
        alert(`Mempersiapkan file ${formatText}...`);
    }
    
    // Create a temporary link and trigger download
    const link = document.createElement('a');
    link.href = exportUrl;
    link.style.display = 'none';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

// Event listener untuk DOM ready
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM ready!');
    
    // CSRF Token untuk AJAX
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Auto-format nomor telepon
    const phoneInput = document.querySelector('input[name="telepon"]');
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 0) {
                if (value.startsWith('8')) {
                    value = '0' + value;
                }
            }
            e.target.value = value;
        });
    }
    
    // Event listener untuk update button
    const updatePemasokBtn = document.getElementById('updatePemasokBtn');
    if (updatePemasokBtn) {
        updatePemasokBtn.addEventListener('click', function() {
            updatePemasok();
        });
    }
});

// ===== GLOBAL FUNCTIONS (Outside DOMContentLoaded) =====

// Make functions available immediately
function viewPemasokDetail(id) {
    if (typeof window.viewPemasokDetail === 'function') {
        return window.viewPemasokDetail(id);
    } else {
        console.error('viewPemasokDetail not ready yet');
        alert('Function not ready, please try again');
    }
}

function editPemasok(id) {
    if (typeof window.editPemasok === 'function') {
        return window.editPemasok(id);
    } else {
        console.error('editPemasok not ready yet');
        alert('Function not ready, please try again');
    }
}

// Global function untuk view detail
window.viewPemasokDetail = function(id) {
    console.log('=== DEBUG: viewPemasokDetail called ===');
    console.log('ID:', id);
    
    try {
        const modalElement = document.getElementById('detailPemasokModal');
        if (!modalElement) {
            alert('Modal element not found!');
            return;
        }
        
        const modal = new bootstrap.Modal(modalElement);
        modal.show();
        
        // Set loading content
        document.querySelector('#detailPemasokModal .modal-title').innerHTML = 'Loading...';
        document.querySelector('#detailPemasokModal .modal-body').innerHTML = 'Memuat data...';
        
        // Simple AJAX request
        const url = `/gudang/pemasok-data?id=${id}`;
        console.log('Fetching:', url);
        
        fetch(url, {
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => {
            console.log('Response status:', response.status);
            return response.json();
        })
        .then(data => {
            console.log('Response data:', data);
            
            if (data.success) {
                const pemasok = data.data;
                document.querySelector('#detailPemasokModal .modal-title').innerHTML = 'Detail Pemasok';
                document.querySelector('#detailPemasokModal .modal-body').innerHTML = `
                    <h5>${pemasok.nama_perusahaan}</h5>
                    <p><strong>Email:</strong> ${pemasok.email || '-'}</p>
                    <p><strong>Telepon:</strong> ${pemasok.telepon || '-'}</p>
                    <p><strong>Alamat:</strong> ${pemasok.alamat || '-'}</p>
                    <p><strong>Status:</strong> <span class="badge ${pemasok.status === 'aktif' ? 'bg-success' : 'bg-danger'}">${pemasok.status}</span></p>
                `;
            } else {
                throw new Error(data.message || 'Failed to load data');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.querySelector('#detailPemasokModal .modal-title').innerHTML = 'Error';
            document.querySelector('#detailPemasokModal .modal-body').innerHTML = `<div class="alert alert-danger">Error: ${error.message}</div>`;
        });
        
    } catch (error) {
        console.error('Modal error:', error);
        alert('Error: ' + error.message);
    }
};

// Global function untuk edit pemasok
window.editPemasok = function(id) {
    console.log('=== DEBUG: editPemasok called ===');
    console.log('ID:', id);
    
    try {
        const modalElement = document.getElementById('editPemasokModal');
        if (!modalElement) {
            alert('Edit modal element not found!');
            return;
        }
        
        const modal = new bootstrap.Modal(modalElement);
        modal.show();
        
        // Set loading content
        document.querySelector('#editPemasokModal .modal-title').innerHTML = 'Loading...';
        document.querySelector('#editPemasokModal .modal-body').innerHTML = 'Memuat data untuk edit...';
        
        // Fetch data for editing
        const url = `/gudang/pemasok-data?id=${id}`;
        console.log('Fetching for edit:', url);
        
        fetch(url, {
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log('Edit data received:', data);
            
            if (data.success) {
                const pemasok = data.data;
                document.querySelector('#editPemasokModal .modal-title').innerHTML = 'Edit Pemasok';
                
                // Populate form fields
                const fields = [
                    'edit_nama_perusahaan', 'edit_kontak_person', 'edit_email', 'edit_telepon',
                    'edit_alamat', 'edit_kota', 'edit_kode_pos', 'edit_kategori_produk',
                    'edit_tanggal_kerjasama', 'edit_status', 'edit_rating', 'edit_catatan'
                ];
                
                fields.forEach(fieldId => {
                    const element = document.getElementById(fieldId);
                    const fieldName = fieldId.replace('edit_', '');
                    if (element) {
                        element.value = pemasok[fieldName] || '';
                    }
                });
                
                // Store ID for form submission
                document.getElementById('editPemasokForm').setAttribute('data-id', id);
                
            } else {
                throw new Error(data.message || 'Failed to load data');
            }
        })
        .catch(error => {
            console.error('Edit error:', error);
            document.querySelector('#editPemasokModal .modal-title').innerHTML = 'Error';
            document.querySelector('#editPemasokModal .modal-body').innerHTML = `<div class="alert alert-danger">Error: ${error.message}</div>`;
        });
        
    } catch (error) {
        console.error('Edit modal error:', error);
        alert('Error: ' + error.message);
    }
};
</script>
@endpush
