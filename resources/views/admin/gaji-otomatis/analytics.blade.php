@extends('layouts.admin')

@section('title', 'Analytics Gaji Otomatis')
@section('page-title', 'Analytics & Statistik Penggajian')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Filter Tahun</h5>
                    </div>
                    <div class="card-body">
                        <form method="GET" class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Tahun</label>
                                <select name="tahun" class="form-select">
                                    @for ($i = 2020; $i <= 2030; $i++)
                                        <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>
                                            {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">&nbsp;</label>
                                <button type="submit" class="btn btn-primary d-block">Filter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart Gaji Per Bulan -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Grafik Gaji Per Bulan - {{ $tahun }}</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="gajiPerBulanChart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik Per Jabatan -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Statistik Per Jabatan</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Jabatan</th>
                                        <th>Jumlah Periode</th>
                                        <th>Rata-rata Gaji</th>
                                        <th>Total Gaji</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($gajiPerJabatan ?? [] as $jabatan)
                                        <tr>
                                            <td>{{ $jabatan->nama_jabatan }}</td>
                                            <td>{{ $jabatan->jumlah_periode }}</td>
                                            <td>Rp {{ number_format($jabatan->rata_rata ?? 0, 0, ',', '.') }}</td>
                                            <td>Rp {{ number_format($jabatan->total_gaji ?? 0, 0, ',', '.') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Trend Kehadiran -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Trend Kehadiran</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Periode</th>
                                        <th>Rata-rata Hari Hadir</th>
                                        <th>Rata-rata Hari Kerja</th>
                                        <th>Persentase Kehadiran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($trendKehadiran ?? [] as $trend)
                                        @php
                                            $persentase =
                                                $trend->rata_rata_kerja > 0
                                                    ? ($trend->rata_rata_hadir / $trend->rata_rata_kerja) * 100
                                                    : 0;
                                        @endphp
                                        <tr>
                                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m', $trend->periode_gaji)->format('F Y') }}
                                            </td>
                                            <td>{{ number_format($trend->rata_rata_hadir ?? 0, 1) }} hari</td>
                                            <td>{{ number_format($trend->rata_rata_kerja ?? 0, 1) }} hari</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="progress flex-grow-1 me-2" style="height: 20px;">
                                                        <div class="progress-bar {{ $persentase >= 90 ? 'bg-success' : ($persentase >= 80 ? 'bg-warning' : 'bg-danger') }}"
                                                            style="width: {{ $persentase }}%">
                                                        </div>
                                                    </div>
                                                    <span class="fw-bold">{{ number_format($persentase, 1) }}%</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Chart Gaji Per Bulan
        const gajiPerBulanData = @json($gajiPerBulan ?? []);
        const ctx = document.getElementById('gajiPerBulanChart').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: gajiPerBulanData.map(item => item.bulan),
                datasets: [{
                    label: 'Total Gaji (Rp)',
                    data: gajiPerBulanData.map(item => item.total),
                    borderColor: '#f26b37',
                    backgroundColor: 'rgba(242, 107, 55, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                            }
                        }
                    }
                },
                elements: {
                    point: {
                        radius: 6,
                        hoverRadius: 8
                    }
                }
            }
        });
    </script>
@endpush
