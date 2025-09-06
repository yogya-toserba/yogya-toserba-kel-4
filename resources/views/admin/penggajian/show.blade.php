@extends('layouts.navbar_admin')

@section('title', 'Detail Gaji Karyawan')

@section('content')
    <div class="container-fluid">
        <!-- Header -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detail Gaji Karyawan</h1>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.penggajian.edit', $gaji->id_gaji) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit Gaji
                </a>
                <a href="{{ route('admin.penggajian') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Info Karyawan -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Informasi Karyawan</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Nama:</strong></td>
                                <td>{{ $gaji->karyawan->nama ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>ID Karyawan:</strong></td>
                                <td>{{ $gaji->id_karyawan }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jabatan:</strong></td>
                                <td>{{ $gaji->karyawan->jabatan->nama_jabatan ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Divisi:</strong></td>
                                <td>{{ $gaji->karyawan->divisi ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Periode Gaji:</strong></td>
                                <td>{{ Carbon\Carbon::createFromFormat('Y-m', $gaji->periode_gaji)->format('F Y') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Info Gaji -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Rincian Gaji</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Gaji Pokok:</strong></td>
                                <td>Rp {{ number_format($gaji->gaji_pokok, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tunjangan:</strong></td>
                                <td>Rp {{ number_format($gaji->tunjangan, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Bonus:</strong></td>
                                <td>Rp {{ number_format($gaji->bonus, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Potongan:</strong></td>
                                <td>Rp {{ number_format($gaji->potongan, 0, ',', '.') }}</td>
                            </tr>
                            <tr class="table-success">
                                <td><strong>Total Gaji:</strong></td>
                                <td><strong>Rp {{ number_format($gaji->jumlah_gaji, 0, ',', '.') }}</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td>
                                    @if ($gaji->status_pembayaran == 'paid')
                                        <span class="badge bg-success">Dibayar</span>
                                    @elseif($gaji->status_pembayaran == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @else
                                        <span class="badge bg-danger">Dibatalkan</span>
                                    @endif
                                </td>
                            </tr>
                            @if ($gaji->keterangan)
                                <tr>
                                    <td><strong>Keterangan:</strong></td>
                                    <td>{{ $gaji->keterangan }}</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @if (isset($absensiData) && $absensiData->count() > 0)
            <!-- Data Absensi -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Data Absensi Periode
                                {{ Carbon\Carbon::createFromFormat('Y-m', $gaji->periode_gaji)->format('F Y') }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Jam Masuk</th>
                                            <th>Jam Keluar</th>
                                            <th>Terlambat</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($absensiData as $absensi)
                                            <tr>
                                                <td>{{ $absensi->tanggal->format('d/m/Y') }}</td>
                                                <td>
                                                    @if ($absensi->status == 'Hadir')
                                                        <span class="badge bg-success">{{ $absensi->status }}</span>
                                                    @elseif($absensi->status == 'Izin')
                                                        <span class="badge bg-warning">{{ $absensi->status }}</span>
                                                    @elseif($absensi->status == 'Sakit')
                                                        <span class="badge bg-info">{{ $absensi->status }}</span>
                                                    @else
                                                        <span class="badge bg-danger">{{ $absensi->status }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $absensi->jam_masuk ? Carbon\Carbon::parse($absensi->jam_masuk)->format('H:i') : '-' }}
                                                </td>
                                                <td>{{ $absensi->jam_keluar ? Carbon\Carbon::parse($absensi->jam_keluar)->format('H:i') : '-' }}
                                                </td>
                                                <td>{{ $absensi->terlambat_menit > 0 ? $absensi->terlambat_menit . ' menit' : '-' }}
                                                </td>
                                                <td>{{ $absensi->keterangan ?: '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
