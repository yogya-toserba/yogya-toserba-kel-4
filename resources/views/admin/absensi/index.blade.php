@extends('layouts.navbar_admin')

@section('title', 'Kelola Absensi Karyawan')

@section('content')
    <div class="container-fluid">
        <!-- Header -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Kelola Absensi Karyawan</h1>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.absensi.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Absensi
                </a>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importModal">
                    <i class="fas fa-upload"></i> Import Data
                </button>
                <a href="{{ route('admin.absensi.export') }}?bulan={{ $bulan }}&tahun={{ $tahun }}"
                    class="btn btn-info">
                    <i class="fas fa-download"></i> Export
                </a>
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
                        <h6 class="m-0 font-weight-bold text-primary">Filter Data Absensi</h6>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.absensi') }}" class="row g-3">
                            <div class="col-md-2">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control"
                                    value="{{ $tanggal }}">
                            </div>
                            <div class="col-md-2">
                                <label for="bulan" class="form-label">Bulan</label>
                                <select name="bulan" id="bulan" class="form-select">
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ $i == $bulan ? 'selected' : '' }}>
                                            {{ Carbon\Carbon::create()->month($i)->format('F') }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="tahun" class="form-label">Tahun</label>
                                <select name="tahun" id="tahun" class="form-select">
                                    @for ($year = date('Y') - 2; $year <= date('Y') + 1; $year++)
                                        <option value="{{ $year }}" {{ $year == $tahun ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="karyawan_id" class="form-label">Karyawan</label>
                                <select name="karyawan_id" id="karyawan_id" class="form-select">
                                    <option value="">Semua Karyawan</option>
                                    @foreach ($karyawanList as $karyawan)
                                        <option value="{{ $karyawan->id_karyawan }}"
                                            {{ $karyawan->id_karyawan == $karyawan_id ? 'selected' : '' }}>
                                            {{ $karyawan->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
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
                        <h6 class="m-0 font-weight-bold text-primary">Statistik Absensi</h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-6">
                                <div class="mb-2">
                                    <small class="text-success">Hadir</small>
                                    <h6 class="mb-0 text-success">{{ $stats['total_hadir'] }}</h6>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <small class="text-warning">Terlambat</small>
                                    <h6 class="mb-0 text-warning">{{ $stats['total_terlambat'] }}</h6>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <small class="text-danger">Alpha</small>
                                    <h6 class="mb-0 text-danger">{{ $stats['total_alpha'] }}</h6>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <small class="text-info">Izin</small>
                                    <h6 class="mb-0 text-info">{{ $stats['total_izin'] }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Absensi -->
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Data Absensi</h6>
            </div>
            <div class="card-body">
                @if ($absensiList->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAll"></th>
                                    <th>Tanggal</th>
                                    <th>Nama Karyawan</th>
                                    <th>Jabatan</th>
                                    <th>Shift</th>
                                    <th>Jam Masuk</th>
                                    <th>Jam Keluar</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($absensiList as $absensi)
                                    <tr>
                                        <td><input type="checkbox" name="selected_ids[]"
                                                value="{{ $absensi->id_absensi }}" class="select-item"></td>
                                        <td>{{ Carbon\Carbon::parse($absensi->tanggal)->format('d/m/Y') }}</td>
                                        <td>{{ $absensi->karyawan->nama ?? 'N/A' }}</td>
                                        <td>{{ $absensi->karyawan->jabatan->nama_jabatan ?? 'N/A' }}</td>
                                        <td>{{ $absensi->shift->nama_shift ?? 'N/A' }}</td>
                                        <td>{{ $absensi->jam_masuk ?? '-' }}</td>
                                        <td>{{ $absensi->jam_keluar ?? '-' }}</td>
                                        <td>
                                            @if ($absensi->status == 'hadir')
                                                <span class="badge bg-success">Hadir</span>
                                            @elseif($absensi->status == 'terlambat')
                                                <span class="badge bg-warning">Terlambat</span>
                                            @elseif($absensi->status == 'alpha')
                                                <span class="badge bg-danger">Alpha</span>
                                            @elseif($absensi->status == 'izin')
                                                <span class="badge bg-info">Izin</span>
                                            @else
                                                <span class="badge bg-secondary">{{ ucfirst($absensi->status) }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $absensi->keterangan ?? '-' }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.absensi.show', $absensi->id_absensi) }}"
                                                    class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.absensi.edit', $absensi->id_absensi) }}"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.absensi.destroy', $absensi->id_absensi) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('Yakin hapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Bulk Actions -->
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <form action="{{ route('admin.absensi.bulk-update') }}" method="POST" id="bulkForm">
                                @csrf
                                <div class="d-flex gap-2 align-items-end">
                                    <div>
                                        <label class="form-label">Aksi Massal:</label>
                                        <select name="status" class="form-select" required>
                                            <option value="">Pilih Status</option>
                                            <option value="hadir">Hadir</option>
                                            <option value="terlambat">Terlambat</option>
                                            <option value="alpha">Alpha</option>
                                            <option value="izin">Izin</option>
                                            <option value="sakit">Sakit</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary" onclick="return confirmBulkAction()">
                                        Update Status
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <!-- Pagination -->
                            <div class="d-flex justify-content-end">
                                {{ $absensiList->links() }}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-4">
                        <div class="mb-3">
                            <i class="fas fa-calendar-times fa-3x text-muted"></i>
                        </div>
                        <h5 class="text-muted">Belum ada data absensi</h5>
                        <p class="text-muted">Silakan tambah data absensi karyawan</p>
                        <a href="{{ route('admin.absensi.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tambah Absensi
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Import -->
    <div class="modal fade" id="importModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Data Absensi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.absensi.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="file" class="form-label">File CSV/Excel</label>
                            <input type="file" name="file" id="file" class="form-control"
                                accept=".csv,.xlsx,.xls" required>
                            <div class="form-text">
                                Format file: CSV atau Excel (.xlsx, .xls)
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-upload"></i> Import
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        // Select All functionality
        document.getElementById('selectAll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.select-item');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        // Bulk action confirmation
        function confirmBulkAction() {
            const selectedItems = document.querySelectorAll('.select-item:checked');
            if (selectedItems.length === 0) {
                alert('Pilih minimal satu item untuk diupdate.');
                return false;
            }

            // Add selected IDs to form
            const form = document.getElementById('bulkForm');
            const existingInputs = form.querySelectorAll('input[name="selected_ids[]"]');
            existingInputs.forEach(input => input.remove());

            selectedItems.forEach(item => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'selected_ids[]';
                input.value = item.value;
                form.appendChild(input);
            });

            return confirm(`Yakin ingin mengupdate status ${selectedItems.length} item yang dipilih?`);
        }

        // Auto-clear tanggal filter when bulan/tahun changed
        document.getElementById('bulan').addEventListener('change', function() {
            document.getElementById('tanggal').value = '';
        });

        document.getElementById('tahun').addEventListener('change', function() {
            document.getElementById('tanggal').value = '';
        });
    </script>
@endsection
