@extends('layouts.admin')

@section('title', 'Detail Gaji Otomatis')
@section('page-title', 'Detail Perhitungan Gaji')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4>Detail Gaji - {{ $gaji->karyawan->nama ?? 'Unknown' }}</h4>
                    <a href="{{ route('admin.gaji-otomatis.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Informasi Karyawan -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Informasi Karyawan</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td width="40%"><strong>Nama</strong></td>
                                <td>: {{ $gaji->karyawan->nama ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jabatan</strong></td>
                                <td>: {{ $gaji->karyawan->jabatan->nama_jabatan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Cabang</strong></td>
                                <td>: {{ $gaji->karyawan->cabang->nama ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Periode Gaji</strong></td>
                                <td>: {{ \Carbon\Carbon::createFromFormat('Y-m', $gaji->periode_gaji)->format('F Y') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status</strong></td>
                                <td>:
                                    <span class="badge {{ $gaji->status == 'paid' ? 'bg-success' : 'bg-warning' }}">
                                        {{ ucfirst($gaji->status) }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Rincian Gaji -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Rincian Gaji</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td width="40%"><strong>Gaji Pokok</strong></td>
                                <td>: Rp {{ number_format($gaji->gaji_pokok ?? 0, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tunjangan</strong></td>
                                <td>: Rp {{ number_format($gaji->tunjangan ?? 0, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Bonus</strong></td>
                                <td>: Rp {{ number_format($gaji->bonus ?? 0, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Total Potongan</strong></td>
                                <td>: Rp {{ number_format($gaji->total_potongan ?? 0, 0, ',', '.') }}</td>
                            </tr>
                            <tr class="border-top">
                                <td><strong>Total Gaji</strong></td>
                                <td>: <strong>Rp {{ number_format($gaji->jumlah_gaji ?? 0, 0, ',', '.') }}</strong></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Data Kehadiran -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Data Kehadiran</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <div class="text-center">
                                    <h4 class="text-success">{{ $gaji->total_hari_hadir ?? 0 }}</h4>
                                    <small class="text-muted">Hari Hadir</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <h4 class="text-info">{{ $gaji->total_hari_kerja ?? 0 }}</h4>
                                    <small class="text-muted">Hari Kerja</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <h4 class="text-warning">{{ $gaji->lembur_jam ?? 0 }}</h4>
                                    <small class="text-muted">Jam Lembur</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <h4 class="text-danger">
                                        {{ ($gaji->total_hari_kerja ?? 0) - ($gaji->total_hari_hadir ?? 0) }}</h4>
                                    <small class="text-muted">Hari Absen</small>
                                </div>
                            </div>
                        </div>

                        @if (isset($absensiData) && count($absensiData) > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Shift</th>
                                            <th>Jam Masuk</th>
                                            <th>Jam Keluar</th>
                                            <th>Status</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($absensiData as $absensi)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($absensi->tanggal)->format('d/m/Y') }}</td>
                                                <td>{{ $absensi->shift->nama ?? '-' }}</td>
                                                <td>{{ $absensi->absensi->jam_masuk ?? '-' }}</td>
                                                <td>{{ $absensi->absensi->jam_keluar ?? '-' }}</td>
                                                <td>
                                                    @if ($absensi->absensi)
                                                        <span class="badge bg-success">Hadir</span>
                                                    @else
                                                        <span class="badge bg-danger">Tidak Hadir</span>
                                                    @endif
                                                </td>
                                                <td>{{ $absensi->absensi->keterangan ?? 'Tidak ada absensi' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center text-muted py-4">
                                <i class="fas fa-calendar-times fa-3x mb-3"></i>
                                <p>Tidak ada data absensi untuk periode ini</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @if ($gaji->keterangan)
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Keterangan</h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-0">{{ $gaji->keterangan }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
