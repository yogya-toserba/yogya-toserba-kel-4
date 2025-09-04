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

    <!-- Error Alert -->
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
        <button type="button" class="bt    // AJAX request untuk get data
    // Try simple approach with window.location
    const baseUrl = window.location.origin;
    const url = `${baseUrl}/gudang/pemasok-data?id=${id}`;
    console.log('Making AJAX request to:', url);
    
    // Test dengan URL alternatif jika route helper gagal
    const fallbackUrl = `/gudang/pemasok-data?id=${id}`;
    console.log('Fallback URL:', fallbackUrl);
    
    // Check if CSRF token exists
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (!csrfToken) {
        alert('CSRF token not found!');
        return;
    }
    
    // Try main URL first, fallback if needed
    fetch(url, {a-bs-dismiss="alert" aria-label="Close"></button>
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
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-cog"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <button class="dropdown-item btn-detail" 
                                                    data-id="{{ $pemasok->id_pemasok }}"
                                                    onclick="viewPemasokDetail({{ $pemasok->id_pemasok }})"
                                                    type="button">
                                                <i class="fas fa-eye text-info me-2"></i>Lihat Detail
                                            </button>
                                        </li>
                                        <li>
                                            <button class="dropdown-item btn-edit" 
                                                    onclick="editPemasok({{ $pemasok->id_pemasok }})">
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
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

// Global function untuk view detail
function viewPemasokDetail(id) {
    console.log('viewPemasokDetail called with ID:', id);
    
    // Test apakah modal element ada
    const modalElement = document.getElementById('detailPemasokModal');
    if (!modalElement) {
        alert('Modal element not found!');
        return;
    }
    
    // Tampilkan loading modal
    const modalTitle = document.querySelector('#detailPemasokModal .modal-title');
    const modalBody = document.querySelector('#detailPemasokModal .modal-body');
    
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
            <p class="mt-2">Memuat data pemasok...</p>
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
    // Try simple approach with window.location
    const baseUrl = window.location.origin;
    const url = `${baseUrl}/gudang/pemasok-data?id=${id}`;
    console.log('Making AJAX request to:', url);
    
    // Test dengan URL alternatif jika route helper gagal
    const fallbackUrl = `/gudang/pemasok-data?id=${id}`;
    console.log('Fallback URL:', fallbackUrl);
    
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
    
    // Try main URL first, fallback if needed
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
        console.log('Response ok:', response.ok);
        console.log('Response headers:', response.headers);
        
        if (!response.ok) {
            throw new Error(`HTTP ${response.status}: ${response.statusText}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Data received:', data);
        
        // Update modal title
        modalTitle.innerHTML = 'Detail Pemasok';
        
        // Ambil data dari response
        const pemasok = data.data;
        
        // Update modal body dengan data
        modalBody.innerHTML = `
            <div class="row">
                <div class="col-md-6">
                    <h6 class="text-primary mb-3">Informasi Perusahaan</h6>
                    <table class="table table-sm">
                        <tr>
                            <td><strong>Nama Perusahaan:</strong></td>
                            <td>${pemasok.nama_perusahaan || '-'}</td>
                        </tr>
                        <tr>
                            <td><strong>Kontak Person:</strong></td>
                            <td>${pemasok.kontak_person || '-'}</td>
                        </tr>
                        <tr>
                            <td><strong>Email:</strong></td>
                            <td>${pemasok.email || '-'}</td>
                        </tr>
                        <tr>
                            <td><strong>Telepon:</strong></td>
                            <td>${pemasok.telepon || '-'}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h6 class="text-primary mb-3">Informasi Lokasi</h6>
                    <table class="table table-sm">
                        <tr>
                            <td><strong>Alamat:</strong></td>
                            <td>${pemasok.alamat || '-'}</td>
                        </tr>
                        <tr>
                            <td><strong>Kota:</strong></td>
                            <td>${pemasok.kota || '-'}</td>
                        </tr>
                        <tr>
                            <td><strong>Kode Pos:</strong></td>
                            <td>${pemasok.kode_pos || '-'}</td>
                        </tr>
                        <tr>
                            <td><strong>Kategori Produk:</strong></td>
                            <td>${pemasok.kategori_produk || '-'}</td>
                        </tr>
                    </table>
                </div>
            </div>
            ${pemasok.catatan ? `
            <div class="row mt-3">
                <div class="col-12">
                    <h6 class="text-primary mb-2">Catatan</h6>
                    <p class="text-muted">${pemasok.catatan}</p>
                </div>
            </div>
            ` : ''}
        `;
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
                    <p>Tidak dapat memuat data pemasok. Silakan coba lagi.</p>
                    <small>Error: ${error.message}</small>
                    <hr>
                    <small>URL yang diakses: ${url}</small>
                    <br><small>Fallback URL: ${fallbackUrl}</small>
                    <br><small>Coba akses URL ini manual di browser untuk test</small>
                </div>
            `;
        }
    });
}

// Global function untuk edit pemasok
function editPemasok(id) {
    console.log('editPemasok called with ID:', id);
    
    // Test apakah modal element ada
    const modalElement = document.getElementById('editPemasokModal');
    if (!modalElement) {
        alert('Modal edit element not found!');
        return;
    }
    
    // Tampilkan loading di modal
    const modalTitle = document.querySelector('#editPemasokModal .modal-title');
    const modalBody = document.querySelector('#editPemasokModal .modal-body');
    
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
            <p class="mt-2">Memuat data pemasok...</p>
        </div>
    `;
    
    // Tampilkan modal
    try {
        const editModal = new bootstrap.Modal(modalElement);
        editModal.show();
    } catch (error) {
        alert('Error showing modal: ' + error.message);
        return;
    }
    
    // AJAX request untuk get data
    const baseUrl = window.location.origin;
    const url = `${baseUrl}/gudang/pemasok-data?id=${id}`;
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
        modalTitle.innerHTML = 'Edit Pemasok';
        
        // Restore form content
        modalBody.innerHTML = `
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
        `;
        
        // Populate form dengan data
        const pemasok = data.data;
        document.getElementById('edit_id_pemasok').value = pemasok.id_pemasok;
        document.getElementById('edit_nama_perusahaan').value = pemasok.nama_perusahaan || '';
        document.getElementById('edit_kontak_person').value = pemasok.kontak_person || '';
        document.getElementById('edit_telepon').value = pemasok.telepon || '';
        document.getElementById('edit_email').value = pemasok.email || '';
        document.getElementById('edit_alamat').value = pemasok.alamat || '';
        document.getElementById('edit_kota').value = pemasok.kota || '';
        document.getElementById('edit_kategori_produk').value = pemasok.kategori_produk || '';
        document.getElementById('edit_tanggal_kerjasama').value = pemasok.tanggal_kerjasama || '';
        document.getElementById('edit_status').value = pemasok.status || '';
        document.getElementById('edit_rating').value = pemasok.rating || '';
        document.getElementById('edit_catatan').value = pemasok.catatan || '';
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
                    <p>Tidak dapat memuat data pemasok. Silakan coba lagi.</p>
                    <small>Error: ${error.message}</small>
                </div>
            `;
        }
    });
}

// Function untuk update pemasok
function updatePemasok() {
    const form = document.getElementById('editPemasokForm');
    const formData = new FormData(form);
    const id = document.getElementById('edit_id_pemasok').value;
    
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
        text: 'Sedang memperbarui data pemasok',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    
    // Convert FormData to JSON
    const data = {};
    for (let [key, value] of formData.entries()) {
        data[key] = value;
    }
    
    const baseUrl = window.location.origin;
    const url = `${baseUrl}/gudang/pemasok/${id}`;
    
    fetch(url, {
        method: 'PUT',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken.getAttribute('content')
        },
        body: JSON.stringify(data)
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
            text: 'Data pemasok berhasil diperbarui',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            // Tutup modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('editPemasokModal'));
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
</script>
@endpush
