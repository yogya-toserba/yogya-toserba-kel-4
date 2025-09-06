@extends('layouts.navbar_admin')

@section('title', 'Sistem Penggajian Otomatis')

@push('styles')
    <style>
        .dataTables_info {
            color: #6c757d;
            font-size: 0.875rem;
            padding-top: 0.75rem;
        }

        .card-footer {
            border-top: 1px solid #e3e6f0;
            background-color: #f8f9fc !important;
        }

        .pagination-sm .page-link {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }

        .table-responsive {
            border-radius: 0.35rem;
        }

        /* Custom dropdown styling - Bootstrap 5.3.0 compatible */
        .dropdown-toggle::after {
            display: none !important;
        }

        /* Ensure Bootstrap dropdown functionality is not broken */
        .dropdown-toggle[data-bs-toggle="dropdown"] {
            cursor: pointer;
            position: relative;
        }

        .btn.dropdown-toggle {
            cursor: pointer;
            position: relative;
        }

        .btn.dropdown-toggle:hover {
            background-color: #f8f9fc !important;
            border-color: #d1d3e2 !important;
        }

        /* Ensure dropdown menu appears above other elements */
        .dropdown-menu {
            border: 1px solid #e3e6f0 !important;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
            border-radius: 0.35rem !important;
            min-width: 10rem !important;
            z-index: 1055 !important;
            animation: dropdownFadeIn 0.2s ease-in-out;
            position: absolute !important;
        }

        /* Fix for table overflow issues with dropdowns */
        .table-responsive {
            overflow: visible !important;
        }
        
        .table-responsive .dropdown-menu {
            position: fixed !important;
        }

        @keyframes dropdownFadeIn {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dropdown-item {
            padding: 0.5rem 1rem !important;
            font-size: 0.875rem !important;
            transition: all 0.15s ease-in-out !important;
            cursor: pointer !important;
            display: flex !important;
            align-items: center !important;
        }

        .dropdown-item:hover {
            background-color: #f8f9fc !important;
            color: #3a3b45 !important;
            transform: translateX(3px);
        }

        .dropdown-item i {
            width: 16px !important;
            text-align: center !important;
            margin-right: 0.5rem !important;
        }

        .btn-outline-secondary {
            border-color: #d1d3e2 !important;
            color: #858796 !important;
        }

        .btn-outline-secondary:hover {
            background-color: #5a5c69 !important;
            border-color: #5a5c69 !important;
            color: white !important;
            transform: scale(1.05);
        }

        .dropdown-item.text-danger:hover {
            background-color: #f8d7da !important;
            color: #721c24 !important;
        }

        /* Modal Detail Styling */
        .modal-xl {
            max-width: 90%;
        }

        .detail-card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }

        .detail-card .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 0.5rem 0.5rem 0 0 !important;
            padding: 0.75rem 1rem;
        }

        .detail-table {
            margin-bottom: 0;
        }

        .detail-table td {
            padding: 0.5rem 0.75rem;
            border: none;
            vertical-align: middle;
        }

        .detail-table tr:nth-child(even) {
            background-color: #f8f9fc;
        }

        .highlight-row {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%) !important;
            font-weight: bold;
        }

        .loading-container {
            min-height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <!-- Header -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Sistem Penggajian Otomatis</h1>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#previewModal">
                    <i class="fas fa-eye"></i> Preview Gaji
                </button>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#prosesModal">
                    <i class="fas fa-calculator"></i> Proses Gaji Otomatis
                </button>
                <button onclick="testDropdowns()" class="btn btn-info ms-2" title="Test dropdown functionality">
                    <i class="fas fa-bug me-2"></i>Test Dropdowns
                </button>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Filter dan Statistik -->
        <div class="row mb-4">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Filter Periode</h6>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.penggajian') }}" class="row g-3">
                            <div class="col-md-3">
                                <label for="bulan" class="form-label">Bulan</label>
                                <select name="bulan" id="bulan" class="form-select">
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ $i == $bulan ? 'selected' : '' }}>
                                            {{ Carbon\Carbon::create(null, $i, 1)->format('F') }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="tahun" class="form-label">Tahun</label>
                                <select name="tahun" id="tahun" class="form-select">
                                    @for ($year = date('Y') - 2; $year <= date('Y') + 1; $year++)
                                        <option value="{{ $year }}" {{ $year == $tahun ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="per_page" class="form-label">Per Halaman</label>
                                <select name="per_page" id="per_page" class="form-select">
                                    @foreach ([10, 25, 50, 100] as $perPageOption)
                                        <option value="{{ $perPageOption }}"
                                            {{ request('per_page', 10) == $perPageOption ? 'selected' : '' }}>
                                            {{ $perPageOption }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">&nbsp;</label>
                                <button type="submit" class="btn btn-primary d-block">
                                    <i class="fas fa-filter"></i> Filter
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Statistik
                            {{ Carbon\Carbon::create(null, $bulan, 1)->format('F') }} {{ $tahun }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-6">
                                <div class="mb-2">
                                    <small class="text-muted">Total Gaji</small>
                                    <h6 class="mb-0">Rp {{ number_format($stats['total_gaji'] ?? 0, 0, ',', '.') }}</h6>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <small class="text-muted">Karyawan</small>
                                    <h6 class="mb-0">{{ $stats['total_karyawan'] ?? 0 }} orang</h6>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <small class="text-muted">Rata-rata</small>
                                    <h6 class="mb-0">Rp {{ number_format($stats['rata_rata_gaji'] ?? 0, 0, ',', '.') }}
                                    </h6>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <small class="text-muted">Tertinggi</small>
                                    <h6 class="mb-0">Rp {{ number_format($stats['gaji_tertinggi'] ?? 0, 0, ',', '.') }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Gaji -->
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Data Gaji -
                    {{ Carbon\Carbon::create(null, $bulan, 1)->format('F') }} {{ $tahun }}</h6>
            </div>
            <div class="card-body">
                @if ($gajiList->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Karyawan</th>
                                    <th>Jabatan</th>
                                    <th>Absensi</th>
                                    <th>Gaji Pokok</th>
                                    <th>Tunjangan</th>
                                    <th>Potongan</th>
                                    <th>Total Gaji</th>
                                    <th>Status</th>
                                    <th width="80" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gajiList as $index => $gaji)
                                    @php
                                        $statsAbsensi = $gaji->karyawan->getStatistikAbsensiBulan($tahun, $bulan);
                                    @endphp
                                    <tr>
                                        <td>{{ $gajiList->firstItem() + $index }}</td>
                                        <td>{{ $gaji->karyawan->nama ?? 'N/A' }}</td>
                                        <td>{{ $gaji->karyawan->jabatan->nama_jabatan ?? 'N/A' }}</td>
                                        <td>
                                            <small class="text-muted">
                                                <div><strong>Hadir:</strong> {{ $statsAbsensi['total_hadir'] }} hari</div>
                                                <div><strong>Absen:</strong> {{ $statsAbsensi['total_absen'] }} hari</div>
                                                <div><strong>Kehadiran:</strong>
                                                    {{ $statsAbsensi['persentase_kehadiran'] }}%</div>
                                                @if ($statsAbsensi['total_terlambat_menit'] > 0)
                                                    <div class="text-warning"><strong>Terlambat:</strong>
                                                        {{ $statsAbsensi['total_terlambat_menit'] }} menit</div>
                                                @endif
                                            </small>
                                        </td>
                                        <td>Rp {{ number_format($gaji->gaji_pokok ?? 0, 0, ',', '.') }}</td>
                                        <td>Rp
                                            {{ number_format(($gaji->tunjangan_jabatan ?? 0) + ($gaji->tunjangan_kehadiran ?? 0) + ($gaji->tunjangan_lainnya ?? 0), 0, ',', '.') }}
                                        </td>
                                        <td>Rp
                                            {{ number_format(($gaji->potongan_absensi ?? 0) + ($gaji->potongan_lainnya ?? 0), 0, ',', '.') }}
                                        </td>
                                        <td><strong>Rp {{ number_format($gaji->jumlah_gaji ?? 0, 0, ',', '.') }}</strong>
                                        </td>
                                        <td>
                                            @if (isset($gaji->status_pembayaran))
                                                @if ($gaji->status_pembayaran == 'paid')
                                                    <span class="badge bg-success">Dibayar</span>
                                                @elseif($gaji->status_pembayaran == 'pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                @else
                                                    <span class="badge bg-danger">Dibatalkan</span>
                                                @endif
                                            @else
                                                <span class="badge bg-secondary">N/A</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" 
                                                    type="button" 
                                                    id="dropdownMenuButton{{ $gaji->id_gaji ?? 0 }}"
                                                    data-bs-toggle="dropdown" 
                                                    aria-expanded="false"
                                                    title="Menu Aksi">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end shadow-sm" 
                                                    aria-labelledby="dropdownMenuButton{{ $gaji->id_gaji ?? 0 }}">
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)" 
                                                           data-action="view-detail" 
                                                           data-id="{{ $gaji->id_gaji ?? 0 }}">
                                                            <i class="fas fa-eye text-info me-2"></i>Lihat Detail
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)" 
                                                           data-action="edit-gaji" 
                                                           data-id="{{ $gaji->id_gaji ?? 0 }}">
                                                            <i class="fas fa-edit text-warning me-2"></i>Edit Gaji
                                                        </a>
                                                    </li>
                                                    @if($gaji->status_pembayaran == 'pending' || $gaji->status_pembayaran == 'belum_dibayar')
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)" 
                                                           data-action="mark-paid" 
                                                           data-id="{{ $gaji->id_gaji ?? 0 }}">
                                                            <i class="fas fa-check text-success me-2"></i>Tandai Dibayar
                                                        </a>
                                                    </li>
                                                    @endif
                                                    @if($gaji->status_pembayaran == 'paid' || $gaji->status_pembayaran == 'sudah_dibayar')
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)" 
                                                           data-action="generate-slip" 
                                                           data-id="{{ $gaji->id_gaji ?? 0 }}">
                                                            <i class="fas fa-file-pdf text-primary me-2"></i>Cetak Slip
                                                        </a>
                                                    </li>
                                                    @endif
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item text-danger" href="javascript:void(0)" 
                                                           data-action="delete-gaji" 
                                                           data-id="{{ $gaji->id_gaji ?? 0 }}" 
                                                           data-name="{{ $gaji->karyawan->nama ?? 'N/A' }}">
                                                            <i class="fas fa-trash me-2"></i>Hapus
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Info dan Controls -->
                    <div class="card-footer bg-light">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="dataTables_info">
                                    Menampilkan {{ $gajiList->firstItem() }} sampai {{ $gajiList->lastItem() }}
                                    dari {{ $gajiList->total() }} data gaji
                                    (Periode: {{ Carbon\Carbon::create(null, $bulan, 1)->format('F') }}
                                    {{ $tahun }})
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-end">
                                    {{ $gajiList->appends(request()->query())->links('pagination.custom') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-4">
                        <div class="mb-3">
                            <i class="fas fa-inbox fa-3x text-muted"></i>
                        </div>
                        <h5 class="text-muted">Belum ada data gaji untuk periode ini</h5>
                        <p class="text-muted">Silakan proses gaji otomatis untuk periode
                            {{ Carbon\Carbon::create(null, $bulan, 1)->format('F') }} {{ $tahun }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Preview Gaji -->
    <div class="modal fade" id="previewModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Preview Perhitungan Gaji</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="previewForm">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="preview_bulan" class="form-label">Bulan</label>
                                <select name="bulan" id="preview_bulan" class="form-select">
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ $i == $bulan ? 'selected' : '' }}>
                                            {{ Carbon\Carbon::create(null, $i, 1)->format('F') }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="preview_tahun" class="form-label">Tahun</label>
                                <select name="tahun" id="preview_tahun" class="form-select">
                                    @for ($year = date('Y') - 2; $year <= date('Y') + 1; $year++)
                                        <option value="{{ $year }}" {{ $year == $tahun ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">&nbsp;</label>
                                <button type="button" onclick="loadPreview()" class="btn btn-primary d-block">
                                    <i class="fas fa-search"></i> Preview
                                </button>
                            </div>
                        </div>
                    </form>

                    <div id="previewContent">
                        <div class="text-center">
                            <p class="text-muted">Pilih periode dan klik Preview untuk melihat perhitungan gaji</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Proses Gaji -->
    <div class="modal fade" id="prosesModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Proses Gaji Otomatis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.penggajian.proses-otomatis') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            Proses ini akan menghitung gaji berdasarkan shift, absensi, dan jabatan karyawan.
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="proses_bulan" class="form-label">Bulan</label>
                                <select name="bulan" id="proses_bulan" class="form-select" required>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ $i == $bulan ? 'selected' : '' }}>
                                            {{ Carbon\Carbon::create(null, $i, 1)->format('F') }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="proses_tahun" class="form-label">Tahun</label>
                                <select name="tahun" id="proses_tahun" class="form-select" required>
                                    @for ($year = date('Y') - 2; $year <= date('Y') + 1; $year++)
                                        <option value="{{ $year }}" {{ $year == $tahun ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-calculator"></i> Proses Gaji
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Detail Gaji -->
    <div class="modal fade" id="detailModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-money-bill-wave me-2"></i>Detail Gaji Karyawan
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div id="detailContent">
                        <div class="loading-container">
                            <div class="text-center">
                                <i class="fas fa-spinner fa-spin fa-3x text-primary mb-3"></i>
                                <h5 class="text-muted">Memuat detail gaji...</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Tutup
                    </button>
                    <button type="button" class="btn btn-warning" id="editFromModal">
                        <i class="fas fa-edit me-2"></i>Edit Gaji
                    </button>
                    <button type="button" class="btn btn-info" id="printFromModal">
                        <i class="fas fa-print me-2"></i>Cetak Detail
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        function loadPreview() {
            const bulan = document.getElementById('preview_bulan').value;
            const tahun = document.getElementById('preview_tahun').value;
            const content = document.getElementById('previewContent');

            content.innerHTML =
                '<div class="text-center"><i class="fas fa-spinner fa-spin fa-2x"></i><p>Memuat preview...</p></div>';

            fetch(`{{ route('admin.penggajian.preview') }}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        bulan: parseInt(bulan),
                        tahun: parseInt(tahun)
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.length === 0) {
                        content.innerHTML = '<div class="alert alert-warning">Tidak ada data karyawan aktif.</div>';
                        return;
                    }

                    let html = '<div class="table-responsive"><table class="table table-sm table-bordered">';
                    html +=
                        '<thead><tr><th>Nama</th><th>Jabatan</th><th>Gaji Pokok</th><th>Tunjangan</th><th>Bonus</th><th>Potongan</th><th>Total</th><th>Keterangan</th></tr></thead><tbody>';

                    data.forEach(item => {
                        if (item.error) {
                            html +=
                                `<tr class="table-danger"><td>${item.nama}</td><td>${item.jabatan}</td><td colspan="6">Error: ${item.error}</td></tr>`;
                        } else {
                            html += `<tr>
                    <td>${item.nama}</td>
                    <td>${item.jabatan}</td>
                    <td>Rp ${item.gaji_pokok ? item.gaji_pokok.toLocaleString('id-ID') : '0'}</td>
                    <td>Rp ${item.tunjangan ? item.tunjangan.toLocaleString('id-ID') : '0'}</td>
                    <td>Rp ${item.bonus ? item.bonus.toLocaleString('id-ID') : '0'}</td>
                    <td>Rp ${item.potongan ? item.potongan.toLocaleString('id-ID') : '0'}</td>
                    <td><strong>Rp ${item.jumlah_gaji ? item.jumlah_gaji.toLocaleString('id-ID') : '0'}</strong></td>
                    <td><small>${item.keterangan || ''}</small></td>
                </tr>`;
                        }
                    });

                    html += '</tbody></table></div>';
                    content.innerHTML = html;
                })
                .catch(error => {
                    content.innerHTML = '<div class="alert alert-danger">Gagal memuat preview: ' + error.message +
                        '</div>';
                });
        }

        function viewDetail(id) {
            console.log('viewDetail function called with ID:', id);
            
            if (!id) {
                alert('ID gaji tidak valid');
                return;
            }
            
            // Buka modal dan load data detail
            const modalElement = document.getElementById('detailModal');
            if (!modalElement) {
                alert('Modal tidak ditemukan. Pastikan modal detail ada di halaman.');
                console.error('detailModal element not found');
                return;
            }
            
            console.log('Modal element found, initializing...');
            
            try {
                const modal = new bootstrap.Modal(modalElement);
                const content = document.getElementById('detailContent');
                
                if (!content) {
                    alert('Konten modal tidak ditemukan');
                    return;
                }
                
                // Reset content dan tampilkan loading
                content.innerHTML = `
                    <div class="loading-container">
                        <div class="text-center">
                            <i class="fas fa-spinner fa-spin fa-3x text-primary mb-3"></i>
                            <h5 class="text-muted">Memuat detail gaji...</h5>
                        </div>
                    </div>
                `;
                
                // Set edit button action
                const editBtn = document.getElementById('editFromModal');
                if (editBtn) {
                    editBtn.onclick = function() {
                        window.location.href = `{{ route('admin.penggajian') }}/${id}/edit`;
                    };
                }
                
                // Set print button action
                const printBtn = document.getElementById('printFromModal');
                if (printBtn) {
                    printBtn.onclick = function() {
                        printGajiDetail();
                    };
                }
                
                // Show modal
                console.log('Showing modal...');
                modal.show();
                
                // Fetch detail data
                console.log('Fetching data from API...');
                const apiUrl = `{{ route('admin.penggajian') }}/${id}/api`;
                console.log('API URL:', apiUrl);
                
                fetch(apiUrl, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    console.log('API Response status:', response.status);
                    if (!response.ok) {
                        throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('API Response data:', data);
                    if (data.success) {
                        content.innerHTML = data.html;
                        // Store data for printing
                        window.currentGajiData = data.data;
                        console.log('Detail loaded successfully');
                    } else {
                        content.innerHTML = '<div class="alert alert-danger">Gagal memuat detail: ' + (data.message || 'Unknown error') + '</div>';
                    }
                })
                .catch(error => {
                    console.error('Fetch Error:', error);
                    content.innerHTML = '<div class="alert alert-danger">Terjadi kesalahan: ' + error.message + '</div>';
                });
                
            } catch (error) {
                console.error('Modal initialization error:', error);
                alert('Gagal membuka modal: ' + error.message);
            }
        }

        function printGajiDetail() {
            if (!window.currentGajiData) {
                alert('Data tidak tersedia untuk dicetak');
                return;
            }
            
            const data = window.currentGajiData;
            const printWindow = window.open('', '_blank');
            
            // Calculate totals
            const totalGaji = (data.gaji_pokok || 0) + (data.uang_makan || 0) + (data.uang_transport || 0) + (data.uang_lembur || 0);
            const totalPotongan = (data.potongan_bpjs || 0) + (data.potongan_pajak || 0);
            const gajiBersih = totalGaji - totalPotongan;
            
            printWindow.document.write(`
                <html>
                    <head>
                        <title>Detail Gaji - ${data.karyawan.nama}</title>
                        <style>
                            body { 
                                font-family: Arial, sans-serif; 
                                margin: 20px; 
                                font-size: 12px;
                            }
                            .header { 
                                text-align: center; 
                                margin-bottom: 30px; 
                                border-bottom: 2px solid #333;
                                padding-bottom: 15px;
                            }
                            .detail-table { 
                                width: 100%; 
                                border-collapse: collapse; 
                                margin-bottom: 20px; 
                            }
                            .detail-table th, .detail-table td { 
                                padding: 8px; 
                                border: 1px solid #ddd; 
                                text-align: left; 
                            }
                            .detail-table th { 
                                background-color: #f5f5f5; 
                                font-weight: bold;
                            }
                            .text-right { text-align: right; }
                            .total-row { 
                                background-color: #e9ecef; 
                                font-weight: bold; 
                            }
                            .gaji-bersih { 
                                background-color: #d4edda; 
                                font-weight: bold; 
                                font-size: 14px; 
                            }
                            .company-name {
                                font-size: 18px;
                                font-weight: bold;
                                color: #333;
                            }
                            .slip-title {
                                font-size: 16px;
                                margin: 10px 0;
                            }
                        </style>
                    </head>
                    <body>
                        <div class="header">
                            <div class="company-name">YOGYA TOSERBA</div>
                            <div class="slip-title">SLIP GAJI KARYAWAN</div>
                            <p>Periode: ${new Date(data.tanggal_gaji).toLocaleDateString('id-ID', {month: 'long', year: 'numeric'})}</p>
                        </div>
                        
                        <table class="detail-table">
                            <tr><th colspan="2">INFORMASI KARYAWAN</th></tr>
                            <tr><td width="30%"><strong>Nama Karyawan</strong></td><td>${data.karyawan.nama}</td></tr>
                            <tr><td><strong>ID Karyawan</strong></td><td>${data.id_karyawan}</td></tr>
                            <tr><td><strong>Jabatan</strong></td><td>${data.karyawan.jabatan ? data.karyawan.jabatan.nama_jabatan : 'Tidak ada'}</td></tr>
                            <tr><td><strong>Email</strong></td><td>${data.karyawan.email}</td></tr>
                            <tr><td><strong>Tanggal Gaji</strong></td><td>${new Date(data.tanggal_gaji).toLocaleDateString('id-ID')}</td></tr>
                        </table>
                        
                        <table class="detail-table">
                            <tr class="total-row"><th colspan="2">RINCIAN GAJI</th></tr>
                            <tr><td width="50%">Gaji Pokok</td><td class="text-right">Rp ${Number(data.gaji_pokok || 0).toLocaleString('id-ID')}</td></tr>
                            <tr><td>Uang Makan</td><td class="text-right">Rp ${Number(data.uang_makan || 0).toLocaleString('id-ID')}</td></tr>
                            <tr><td>Uang Transport</td><td class="text-right">Rp ${Number(data.uang_transport || 0).toLocaleString('id-ID')}</td></tr>
                            <tr><td>Uang Lembur</td><td class="text-right">Rp ${Number(data.uang_lembur || 0).toLocaleString('id-ID')}</td></tr>
                            <tr class="total-row"><td><strong>Sub Total</strong></td><td class="text-right"><strong>Rp ${totalGaji.toLocaleString('id-ID')}</strong></td></tr>
                        </table>
                        
                        <table class="detail-table">
                            <tr class="total-row"><th colspan="2">POTONGAN</th></tr>
                            <tr><td width="50%">Potongan BPJS</td><td class="text-right">Rp ${Number(data.potongan_bpjs || 0).toLocaleString('id-ID')}</td></tr>
                            <tr><td>Potongan Pajak</td><td class="text-right">Rp ${Number(data.potongan_pajak || 0).toLocaleString('id-ID')}</td></tr>
                            <tr class="total-row"><td><strong>Total Potongan</strong></td><td class="text-right"><strong>Rp ${totalPotongan.toLocaleString('id-ID')}</strong></td></tr>
                        </table>
                        
                        <table class="detail-table">
                            <tr class="gaji-bersih"><td width="50%"><strong>GAJI BERSIH</strong></td><td class="text-right"><strong>Rp ${gajiBersih.toLocaleString('id-ID')}</strong></td></tr>
                        </table>
                        
                        <div style="margin-top: 50px; font-size: 10px;">
                            <p>Dicetak pada: ${new Date().toLocaleDateString('id-ID')} ${new Date().toLocaleTimeString('id-ID')}</p>
                            <p><em>Slip gaji ini dicetak otomatis oleh sistem</em></p>
                        </div>
                    </body>
                </html>
            `);
            printWindow.document.close();
            printWindow.print();
        }

        function editGaji(id) {
            console.log('editGaji function called with ID:', id);
            
            if (!id) {
                alert('ID gaji tidak valid');
                return;
            }
            
            // Redirect ke halaman edit
            const editUrl = `{{ route('admin.penggajian') }}/${id}/edit`;
            console.log('Redirecting to:', editUrl);
            window.location.href = editUrl;
        }

        function deleteGaji(id, namaKaryawan) {
            console.log('deleteGaji function called with ID:', id, 'Name:', namaKaryawan);
            
            if (!id) {
                alert('ID gaji tidak valid');
                return;
            }
            
            const confirmMessage = `Apakah Anda yakin ingin menghapus data gaji untuk ${namaKaryawan || 'karyawan ini'}?`;
            
            if (confirm(confirmMessage)) {
                try {
                    // Create form untuk delete
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `{{ route('admin.penggajian') }}/${id}`;
                    form.style.display = 'none';

                    // CSRF token
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = '{{ csrf_token() }}';
                    form.appendChild(csrfInput);

                    // Method spoofing untuk DELETE
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';
                    form.appendChild(methodInput);

                    document.body.appendChild(form);
                    console.log('Submitting delete form...');
                    form.submit();
                } catch (error) {
                    console.error('Delete error:', error);
                    alert('Terjadi kesalahan saat menghapus data: ' + error.message);
                }
            }
        }

        function markAsPaid(id) {
            console.log('markAsPaid function called with ID:', id);
            
            if (!id) {
                alert('ID gaji tidak valid');
                return;
            }
            
            if (confirm('Tandai gaji ini sebagai sudah dibayar?')) {
                console.log('Sending mark as paid request...');
                
                fetch(`{{ route('admin.penggajian') }}/${id}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({
                            status_pembayaran: 'sudah_dibayar'
                        })
                    })
                    .then(response => {
                        console.log('Mark as paid response status:', response.status);
                        if (!response.ok) {
                            throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Mark as paid response:', data);
                        if (data.success) {
                            alert('Status pembayaran berhasil diperbarui');
                            location.reload();
                        } else {
                            alert('Gagal mengupdate status: ' + (data.message || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Mark as paid error:', error);
                        alert('Terjadi kesalahan: ' + error.message);
                    });
            }
        }

        function generateSlip(id) {
            console.log('generateSlip function called with ID:', id);
            
            if (!id) {
                alert('ID gaji tidak valid');
                return;
            }
            
            // Generate dan download slip gaji
            if (confirm('Generate slip gaji untuk karyawan ini?')) {
                try {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `{{ route('admin.penggajian') }}/generate`;
                    form.target = '_blank';
                    form.style.display = 'none';
                    
                    // CSRF token
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = '{{ csrf_token() }}';
                    form.appendChild(csrfInput);
                    
                    // ID Gaji
                    const idInput = document.createElement('input');
                    idInput.type = 'hidden';
                    idInput.name = 'gaji_id';
                    idInput.value = id;
                    form.appendChild(idInput);
                    
                    document.body.appendChild(form);
                    console.log('Submitting slip generation form...');
                    form.submit();
                    
                    // Clean up
                    setTimeout(() => {
                        document.body.removeChild(form);
                    }, 1000);
                } catch (error) {
                    console.error('Generate slip error:', error);
                    alert('Terjadi kesalahan saat generate slip: ' + error.message);
                }
            }
        }

        // Initialize Bootstrap dropdowns when page loads
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, initializing dropdowns...');
            
            // Wait for Bootstrap to be fully loaded
            if (typeof bootstrap === 'undefined') {
                console.error('Bootstrap is not loaded');
                setTimeout(() => {
                    if (typeof bootstrap === 'undefined') {
                        alert('Bootstrap tidak dapat dimuat. Refresh halaman dan coba lagi.');
                    } else {
                        initializeDropdowns();
                    }
                }, 2000);
                return;
            }
            
            initializeDropdowns();
            setupEventDelegation();
        });
        
        function setupEventDelegation() {
            console.log('Setting up event delegation for dropdown actions...');
            
            // Use event delegation for dropdown actions
            document.addEventListener('click', function(e) {
                const target = e.target.closest('[data-action]');
                if (!target) return;
                
                e.preventDefault();
                e.stopPropagation();
                
                const action = target.getAttribute('data-action');
                const id = target.getAttribute('data-id');
                const name = target.getAttribute('data-name');
                
                console.log(`Action clicked: ${action}, ID: ${id}`);
                
                switch(action) {
                    case 'view-detail':
                        viewDetail(id);
                        break;
                    case 'edit-gaji':
                        editGaji(id);
                        break;
                    case 'mark-paid':
                        markAsPaid(id);
                        break;
                    case 'generate-slip':
                        generateSlip(id);
                        break;
                    case 'delete-gaji':
                        deleteGaji(id, name);
                        break;
                    default:
                        console.warn('Unknown action:', action);
                }
            });
            
            console.log('✅ Event delegation setup complete');
        }
        
        function initializeDropdowns() {
            console.log('Initializing Bootstrap dropdowns...');
            
            // Clear any existing dropdown instances first
            document.querySelectorAll('.dropdown-toggle').forEach(function(element) {
                const existingInstance = bootstrap.Dropdown.getInstance(element);
                if (existingInstance) {
                    existingInstance.dispose();
                }
            });
            
            try {
                // Initialize all dropdown buttons with proper error handling
                const dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
                console.log('Found dropdown elements:', dropdownElementList.length);
                
                const dropdownList = dropdownElementList.map(function (dropdownToggleEl, index) {
                    try {
                        const dropdown = new bootstrap.Dropdown(dropdownToggleEl, {
                            boundary: 'viewport',
                            display: 'dynamic',
                            autoClose: true
                        });
                        
                        console.log(`Dropdown ${index + 1} (${dropdownToggleEl.id}) initialized successfully`);
                        return dropdown;
                    } catch (e) {
                        console.error('Failed to initialize dropdown:', dropdownToggleEl.id, e);
                        return null;
                    }
                }).filter(dropdown => dropdown !== null);
                
                console.log('Bootstrap dropdowns initialized successfully:', dropdownList.length);
                
                // Add global event listeners for debugging and functionality
                document.addEventListener('show.bs.dropdown', function(event) {
                    console.log('Dropdown showing:', event.target.id);
                    // Ensure other dropdowns close
                    document.querySelectorAll('.dropdown-menu.show').forEach(function(menu) {
                        if (menu !== event.target.nextElementSibling) {
                            const toggle = menu.previousElementSibling;
                            if (toggle && toggle.classList.contains('dropdown-toggle')) {
                                const instance = bootstrap.Dropdown.getInstance(toggle);
                                if (instance) {
                                    instance.hide();
                                }
                            }
                        }
                    });
                });
                
                document.addEventListener('shown.bs.dropdown', function(event) {
                    console.log('Dropdown shown:', event.target.id);
                });
                
                document.addEventListener('hide.bs.dropdown', function(event) {
                    console.log('Dropdown hiding:', event.target.id);
                });
                
                document.addEventListener('hidden.bs.dropdown', function(event) {
                    console.log('Dropdown hidden:', event.target.id);
                });
                
                // Test dropdown functionality
                console.log('Testing dropdown click handlers...');
                dropdownElementList.forEach(function(toggle, index) {
                    toggle.addEventListener('click', function(e) {
                        console.log(`Dropdown ${index + 1} clicked:`, this.id);
                    });
                });
                
            } catch (error) {
                console.error('Error initializing dropdowns:', error);
                
                // Fallback: try manual event handling
                console.log('Attempting fallback dropdown handling...');
                document.querySelectorAll('.dropdown-toggle').forEach(function(toggle) {
                    toggle.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        
                        console.log('Fallback: Manual dropdown toggle clicked');
                        
                        const menu = this.nextElementSibling;
                        if (menu && menu.classList.contains('dropdown-menu')) {
                            // Close all other dropdowns
                            document.querySelectorAll('.dropdown-menu.show').forEach(function(otherMenu) {
                                if (otherMenu !== menu) {
                                    otherMenu.classList.remove('show');
                                }
                            });
                            
                            // Toggle current dropdown
                            menu.classList.toggle('show');
                        }
                    });
                });
                
                // Close dropdowns when clicking outside
                document.addEventListener('click', function(e) {
                    if (!e.target.closest('.dropdown')) {
                        document.querySelectorAll('.dropdown-menu.show').forEach(function(menu) {
                            menu.classList.remove('show');
                        });
                    }
                });
            }
        }
        
        // Test function to verify dropdown functionality
        function testDropdowns() {
            console.log('=== DROPDOWN TEST ===');
            const dropdowns = document.querySelectorAll('.dropdown-toggle');
            console.log('Total dropdowns found:', dropdowns.length);
            
            dropdowns.forEach(function(dropdown, index) {
                console.log(`Dropdown ${index + 1}:`, {
                    id: dropdown.id,
                    hasBootstrapInstance: !!bootstrap.Dropdown.getInstance(dropdown),
                    nextSibling: dropdown.nextElementSibling?.className
                });
            });
            
            console.log('Bootstrap version:', bootstrap?.Tooltip?.VERSION || 'Unknown');
            console.log('===================');
        }
        
        // Make functions globally available
        window.viewDetail = viewDetail;
        window.editGaji = editGaji;
        window.markAsPaid = markAsPaid;
        window.generateSlip = generateSlip;
        window.deleteGaji = deleteGaji;
        window.testDropdowns = testDropdowns;
    </script>
@endsection
