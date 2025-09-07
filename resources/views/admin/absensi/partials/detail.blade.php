<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-user me-2"></i>
                    Data Karyawan
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="fw-bold">Nama Karyawan:</label>
                    <div>{{ $absensi->karyawan->nama ?? 'N/A' }}</div>
                </div>
                <div class="mb-3">
                    <label class="fw-bold">ID Karyawan:</label>
                    <div>{{ $absensi->karyawan->id_karyawan ?? 'N/A' }}</div>
                </div>
                <div class="mb-3">
                    <label class="fw-bold">Jabatan:</label>
                    <div>{{ $absensi->karyawan->jabatan->nama_jabatan ?? 'N/A' }}</div>
                </div>
                <div class="mb-3">
                    <label class="fw-bold">Email:</label>
                    <div>{{ $absensi->karyawan->email ?? 'N/A' }}</div>
                </div>
                <div class="mb-3">
                    <label class="fw-bold">No. Telepon:</label>
                    <div>{{ $absensi->karyawan->no_telepon ?? 'N/A' }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-clock me-2"></i>
                    Data Absensi
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="fw-bold">Tanggal:</label>
                    <div>{{ \Carbon\Carbon::parse($absensi->tanggal)->format('d F Y') }}</div>
                </div>
                <div class="mb-3">
                    <label class="fw-bold">Jam Masuk:</label>
                    <div>
                        @if ($absensi->jam_masuk)
                            <span class="badge bg-success">{{ $absensi->jam_masuk }}</span>
                        @else
                            <span class="badge bg-secondary">Belum masuk</span>
                        @endif
                    </div>
                </div>
                <div class="mb-3">
                    <label class="fw-bold">Jam Keluar:</label>
                    <div>
                        @if ($absensi->jam_keluar)
                            <span class="badge bg-info">{{ $absensi->jam_keluar }}</span>
                        @else
                            <span class="badge bg-secondary">Belum keluar</span>
                        @endif
                    </div>
                </div>
                <div class="mb-3">
                    <label class="fw-bold">Status:</label>
                    <div>
                        @switch($absensi->status)
                            @case('hadir')
                                <span class="badge bg-success">Hadir</span>
                            @break

                            @case('terlambat')
                                <span class="badge bg-warning">Terlambat</span>
                            @break

                            @case('alpha')
                                <span class="badge bg-danger">Alpha</span>
                            @break

                            @case('izin')
                                <span class="badge bg-info">Izin</span>
                            @break

                            @case('sakit')
                                <span class="badge bg-secondary">Sakit</span>
                            @break

                            @default
                                <span class="badge bg-dark">{{ ucfirst($absensi->status) }}</span>
                        @endswitch
                    </div>
                </div>
                @if ($absensi->keterangan)
                    <div class="mb-3">
                        <label class="fw-bold">Keterangan:</label>
                        <div class="bg-light p-2 rounded">{{ $absensi->keterangan }}</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@if ($absensi->jadwalKerja && $absensi->jadwalKerja->shift)
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-calendar-alt me-2"></i>
                        Informasi Jadwal & Shift
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="fw-bold">Nama Shift:</label>
                            <div>{{ $absensi->jadwalKerja->shift->nama_shift }}</div>
                        </div>
                        <div class="col-md-4">
                            <label class="fw-bold">Jam Mulai Shift:</label>
                            <div>{{ $absensi->jadwalKerja->shift->jam_mulai }}</div>
                        </div>
                        <div class="col-md-4">
                            <label class="fw-bold">Jam Selesai Shift:</label>
                            <div>{{ $absensi->jadwalKerja->shift->jam_selesai }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-info-circle me-2"></i>
                    Riwayat Perubahan
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <label class="fw-bold">Dibuat pada:</label>
                        <div>{{ \Carbon\Carbon::parse($absensi->created_at)->format('d F Y H:i:s') }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Terakhir diupdate:</label>
                        <div>{{ \Carbon\Carbon::parse($absensi->updated_at)->format('d F Y H:i:s') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
