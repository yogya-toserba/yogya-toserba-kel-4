@extends('layouts.admin')

@section('title', 'Sistem Penggajian Otomatis')

@section('content')
    <div class="container-fluid">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-md-8">
                <h1 class="h3 mb-0 text-gray-800">
                    <i class="fas fa-calculator"></i> Sistem Penggajian Otomatis
                </h1>
                <p class="text-muted">Kelola gaji karyawan berdasarkan shift, absensi, dan jabatan</p>
            </div>
            <div class="col-md-4 text-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#generateModal">
                    <i class="fas fa-magic"></i> Generate Gaji Otomatis
                </button>
            </div>
        </div>

        <!-- Alert Messages -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
        @endif

        <!-- Filter Form -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Filter Periode</h6>
            </div>
            <div class="card-body">
                <form method="GET" class="row">
                    <div class="col-md-3">
                        <label for="bulan">Bulan</label>
                        <select name="bulan" id="bulan" class="form-control">
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                                    {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="tahun">Tahun</label>
                        <select name="tahun" id="tahun" class="form-control">
                            @for ($y = date('Y'); $y >= 2020; $y--)
                                <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-primary form-control">
                            <i class="fas fa-search"></i> Filter
                        </button>
                    </div>
                    <div class="col-md-3">
                        <label>&nbsp;</label>
                        <button type="button" class="btn btn-info form-control" onclick="previewGaji()">
                            <i class="fas fa-eye"></i> Preview
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Karyawan
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalKaryawan }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Sudah Digaji
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $karyawanSudahDigaji }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Total Gaji Dibayar
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    Rp {{ number_format($totalGajiDibayar, 0, ',', '.') }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Rata-rata Gaji
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    Rp
                                    {{ $karyawanSudahDigaji > 0 ? number_format($totalGajiDibayar / $karyawanSudahDigaji, 0, ',', '.') : '0' }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gaji List -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    Data Gaji Periode {{ DateTime::createFromFormat('!m', $bulan)->format('F') }} {{ $tahun }}
                </h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow">
                        <a class="dropdown-item" href="{{ route('admin.gaji-otomatis.analytics') }}">
                            <i class="fas fa-chart-area fa-sm fa-fw mr-2 text-gray-400"></i>
                            Analytics
                        </a>
                        <a class="dropdown-item" href="#" onclick="exportData()">
                            <i class="fas fa-download fa-sm fa-fw mr-2 text-gray-400"></i>
                            Export Data
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if ($gajiList->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Karyawan</th>
                                    <th>Jabatan</th>
                                    <th>Cabang</th>
                                    <th>Hari Hadir</th>
                                    <th>Gaji Pokok</th>
                                    <th>Tunjangan</th>
                                    <th>Bonus</th>
                                    <th>Potongan</th>
                                    <th>Total Gaji</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gajiList as $gaji)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="mr-3">
                                                    <div class="icon-circle bg-primary">
                                                        <i class="fas fa-user text-white"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="font-weight-bold">{{ $gaji->karyawan->nama }}</div>
                                                    <div class="text-muted small">ID: {{ $gaji->id_karyawan }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge badge-info">
                                                {{ $gaji->karyawan->jabatan->nama_jabatan ?? 'Tidak ada' }}
                                            </span>
                                        </td>
                                        <td>{{ $gaji->karyawan->cabang->nama_cabang ?? '-' }}</td>
                                        <td>
                                            <div class="text-center">
                                                <div class="font-weight-bold">{{ $gaji->total_hari_hadir }}</div>
                                                <div class="text-muted small">/ {{ $gaji->total_hari_kerja }} hari</div>
                                            </div>
                                        </td>
                                        <td>Rp {{ number_format($gaji->gaji_pokok, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($gaji->tunjangan, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($gaji->bonus, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($gaji->total_potongan, 0, ',', '.') }}</td>
                                        <td class="font-weight-bold">Rp
                                            {{ number_format($gaji->jumlah_gaji, 0, ',', '.') }}</td>
                                        <td>
                                            @if ($gaji->status == 'pending')
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif($gaji->status == 'approved')
                                                <span class="badge badge-success">Approved</span>
                                            @elseif($gaji->status == 'paid')
                                                <span class="badge badge-primary">Paid</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-sm btn-info"
                                                    onclick="viewDetail({{ $gaji->id_gaji }})">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-success"
                                                    onclick="printSlip({{ $gaji->id_gaji }})">
                                                    <i class="fas fa-print"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center">
                        {{ $gajiList->appends(request()->query())->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-inbox fa-3x text-gray-300 mb-3"></i>
                        <h5 class="text-muted">Belum ada data gaji untuk periode ini</h5>
                        <p class="text-muted">Klik "Generate Gaji Otomatis" untuk membuat data gaji</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Laporan Per Jabatan -->
        @if ($laporanJabatan->count() > 0)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Laporan Per Jabatan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Jabatan</th>
                                    <th>Jumlah Karyawan</th>
                                    <th>Rata-rata Gaji</th>
                                    <th>Total Gaji</th>
                                    <th>Rata-rata Kehadiran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laporanJabatan as $laporan)
                                    <tr>
                                        <td>{{ $laporan->nama_jabatan }}</td>
                                        <td>{{ $laporan->jumlah_karyawan }} orang</td>
                                        <td>Rp {{ number_format($laporan->rata_rata_gaji, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($laporan->total_gaji_jabatan, 0, ',', '.') }}</td>
                                        <td>{{ number_format($laporan->rata_rata_kehadiran, 1) }} hari</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Generate Modal -->
    <div class="modal fade" id="generateModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Generate Gaji Otomatis</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('admin.gaji-otomatis.generate') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="gen_bulan">Bulan</label>
                            <select name="bulan" id="gen_bulan" class="form-control" required>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                                        {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="gen_tahun">Tahun</label>
                            <select name="tahun" id="gen_tahun" class="form-control" required>
                                @for ($y = date('Y'); $y >= 2020; $y--)
                                    <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>
                                        {{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            <strong>Informasi:</strong> Sistem akan menghitung gaji berdasarkan:
                            <ul class="mb-0 mt-2">
                                <li>Data absensi dan shift karyawan</li>
                                <li>Konfigurasi gaji per jabatan</li>
                                <li>Bonus shift malam dan lembur</li>
                                <li>Potongan keterlambatan dan absen</li>
                            </ul>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-magic"></i> Generate Gaji
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Preview Modal -->
    <div class="modal fade" id="previewModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Preview Perhitungan Gaji</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="previewContent">
                        <div class="text-center">
                            <i class="fas fa-spinner fa-spin fa-2x text-primary"></i>
                            <p class="mt-2">Memuat preview...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        function previewGaji() {
            const bulan = document.getElementById('bulan').value;
            const tahun = document.getElementById('tahun').value;

            $('#previewModal').modal('show');

            fetch(`{{ route('admin.gaji-otomatis.preview') }}?bulan=${bulan}&tahun=${tahun}`)
                .then(response => response.json())
                .then(data => {
                    let html =
                        '<div class="table-responsive"><table class="table table-bordered"><thead><tr><th>Nama</th><th>Jabatan</th><th>Gaji Pokok</th><th>Total Gaji</th><th>Kehadiran</th></tr></thead><tbody>';

                    data.forEach(item => {
                        if (item.error) {
                            html +=
                                `<tr><td>${item.nama}</td><td>${item.jabatan}</td><td colspan="3" class="text-danger">${item.error}</td></tr>`;
                        } else {
                            html +=
                                `<tr><td>${item.nama}</td><td>${item.jabatan}</td><td>Rp ${item.gaji_pokok}</td><td>Rp ${item.jumlah_gaji}</td><td>${item.hari_hadir}/${item.hari_kerja} hari</td></tr>`;
                        }
                    });

                    html += '</tbody></table></div>';
                    document.getElementById('previewContent').innerHTML = html;
                })
                .catch(error => {
                    document.getElementById('previewContent').innerHTML = '<div class="alert alert-danger">Error: ' +
                        error.message + '</div>';
                });
        }

        function viewDetail(id) {
            window.open(`{{ route('admin.gaji-otomatis.detail', '') }}/${id}`, '_blank');
        }

        function printSlip(id) {
            window.open(`{{ route('admin.gaji-otomatis.slip', '') }}/${id}`, '_blank');
        }

        function exportData() {
            const bulan = document.getElementById('bulan').value;
            const tahun = document.getElementById('tahun').value;
            window.location.href = `{{ route('admin.gaji-otomatis.export') }}?bulan=${bulan}&tahun=${tahun}`;
        }
    </script>
@endsection
