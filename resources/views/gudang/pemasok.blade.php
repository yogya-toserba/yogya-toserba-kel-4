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
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1"><i class="fas fa-industry text-primary"></i> Manajemen Pemasok</h2>
            <p class="text-muted mb-0">Kelola data pemasok dan supplier Anda</p>
        </div>
        <button class="btn btn-primary btn-lg shadow-sm" data-bs-toggle="modal" data-bs-target="#tambahPemasokModal">
            <i class="fas fa-plus me-2"></i>Tambah Pemasok
        </button>
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
                                <div class="btn-group" role="group">
                                    <button class="btn btn-outline-primary btn-sm btn-detail" 
                                            data-id="{{ $pemasok->id_pemasok }}"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#detailPemasokModal"
                                            title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-outline-warning btn-sm btn-edit" 
                                            data-id="{{ $pemasok->id_pemasok }}"
                                            title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-outline-danger btn-sm btn-delete" 
                                            data-id="{{ $pemasok->id_pemasok }}"
                                            data-nama="{{ $pemasok->nama_perusahaan }}"
                                            title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
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
@endsection

@section('scripts')
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

.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1) !important;
}

.btn:hover {
    transform: translateY(-1px);
    transition: all 0.2s ease;
}
</style>

<script>
// JavaScript untuk interaksi
document.addEventListener('DOMContentLoaded', function() {
    // CSRF Token untuk AJAX
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Auto-format nomor telepon
    document.querySelector('input[name="telepon"]').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length > 0) {
            if (value.startsWith('8')) {
                value = '0' + value;
            }
        }
        e.target.value = value;
    });

    // Handle detail pemasok
    document.querySelectorAll('.btn-detail').forEach(button => {
        button.addEventListener('click', function() {
            const pemasokId = this.getAttribute('data-id');
            
            fetch(`{{ url('gudang/pemasok') }}/${pemasokId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const pemasok = data.data;
                        
                        // Update modal content
                        document.querySelector('#detailPemasokModal .modal-body').innerHTML = `
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label text-muted small">NAMA PEMASOK</label>
                                        <div class="fw-medium">${pemasok.nama_perusahaan}</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-muted small">KONTAK PERSON</label>
                                        <div class="fw-medium">${pemasok.kontak_person}</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-muted small">TELEPON</label>
                                        <div class="fw-medium">${pemasok.telepon}</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-muted small">EMAIL</label>
                                        <div class="fw-medium">${pemasok.email}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label text-muted small">KOTA</label>
                                        <div class="fw-medium">${pemasok.kota}</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-muted small">KATEGORI PRODUK</label>
                                        <div class="fw-medium">${pemasok.kategori_produk}</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-muted small">STATUS</label>
                                        <div><span class="badge bg-${pemasok.status == 'aktif' ? 'success' : 'secondary'}">${pemasok.status.charAt(0).toUpperCase() + pemasok.status.slice(1)}</span></div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-muted small">RATING</label>
                                        <div class="fw-medium">${pemasok.rating}/5.0</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label text-muted small">ALAMAT LENGKAP</label>
                                        <div class="fw-medium">${pemasok.alamat}</div>
                                    </div>
                                    ${pemasok.catatan ? `
                                    <div class="mb-3">
                                        <label class="form-label text-muted small">CATATAN</label>
                                        <div class="fw-medium">${pemasok.catatan}</div>
                                    </div>
                                    ` : ''}
                                </div>
                            </div>
                        `;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal memuat detail pemasok');
                });
        });
    });

    // Handle edit pemasok
    document.querySelectorAll('.btn-edit').forEach(button => {
        button.addEventListener('click', function() {
            const pemasokId = this.getAttribute('data-id');
            
            fetch(`{{ url('gudang/pemasok') }}/${pemasokId}/edit`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const pemasok = data.data;
                        const modal = new bootstrap.Modal(document.getElementById('tambahPemasokModal'));
                        
                        // Update form title
                        document.getElementById('tambahPemasokLabel').innerHTML = '<i class="fas fa-edit me-2"></i>Edit Pemasok';
                        
                        // Update form action
                        const form = document.getElementById('formPemasok');
                        form.action = `{{ url('gudang/pemasok') }}/${pemasokId}`;
                        
                        // Add method override for PUT
                        let methodField = form.querySelector('input[name="_method"]');
                        if (!methodField) {
                            methodField = document.createElement('input');
                            methodField.type = 'hidden';
                            methodField.name = '_method';
                            form.appendChild(methodField);
                        }
                        methodField.value = 'PUT';
                        
                        // Fill form with data
                        form.querySelector('input[name="nama_perusahaan"]').value = pemasok.nama_perusahaan;
                        form.querySelector('input[name="kontak_person"]').value = pemasok.kontak_person;
                        form.querySelector('input[name="telepon"]').value = pemasok.telepon;
                        form.querySelector('input[name="email"]').value = pemasok.email;
                        form.querySelector('textarea[name="alamat"]').value = pemasok.alamat;
                        form.querySelector('select[name="kota"]').value = pemasok.kota;
                        form.querySelector('select[name="kategori_produk"]').value = pemasok.kategori_produk;
                        if (pemasok.tanggal_kerjasama) {
                            form.querySelector('input[name="tanggal_kerjasama"]').value = pemasok.tanggal_kerjasama;
                        }
                        form.querySelector('select[name="status"]').value = pemasok.status;
                        form.querySelector('select[name="rating"]').value = pemasok.rating;
                        if (pemasok.catatan) {
                            form.querySelector('textarea[name="catatan"]').value = pemasok.catatan;
                        }
                        
                        modal.show();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal memuat data pemasok');
                });
        });
    });

    // Handle delete pemasok
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function() {
            const pemasokId = this.getAttribute('data-id');
            const namaPemasok = this.getAttribute('data-nama');
            
            if (confirm(`Apakah Anda yakin ingin menghapus pemasok "${namaPemasok}"?`)) {
                fetch(`{{ url('gudang/pemasok') }}/${pemasokId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Refresh halaman
                        location.reload();
                    } else {
                        alert(data.message || 'Gagal menghapus pemasok');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus pemasok');
                });
            }
        });
    });

    // Reset form when modal is hidden
    document.getElementById('tambahPemasokModal').addEventListener('hidden.bs.modal', function() {
        const form = document.getElementById('formPemasok');
        form.reset();
        form.action = '{{ route('gudang.pemasok.store') }}';
        
        // Remove method override
        const methodField = form.querySelector('input[name="_method"]');
        if (methodField) {
            methodField.remove();
        }
        
        // Reset title
        document.getElementById('tambahPemasokLabel').innerHTML = '<i class="fas fa-plus-circle me-2"></i>Tambah Pemasok Baru';
    });

    // Auto submit filter form when select changes
    document.querySelectorAll('#filterForm select').forEach(element => {
        element.addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });
    });

    // Validasi form
    document.getElementById('formPemasok').addEventListener('submit', function(e) {
        // Form akan submit secara normal, tidak dicegah lagi
        
        // Simulasi loading
        const submitBtn = e.target.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Menyimpan...';
        submitBtn.disabled = true;
    });
});
</script>
@endsection
