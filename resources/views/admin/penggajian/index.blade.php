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
                                    <th>Aksi</th>
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
                                        <td>
                                            <button class="btn btn-sm btn-info"
                                                onclick="viewDetail({{ $gaji->id_gaji ?? 0 }})">
                                                <i class="fas fa-eye"></i>
                                            </button>
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
            // Implement detail view functionality
            window.location.href = `{{ route('admin.penggajian') }}/${id}`;
        }
    </script>
@endsection
