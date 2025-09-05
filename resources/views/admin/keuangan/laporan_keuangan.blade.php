@extends('layouts.navbar_admin')

@section('title', 'Laporan Keuangan')
@section('page-title', 'Laporan Keuangan')

@section('content')
<!-- Filter Section -->
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="fas fa-filter me-2"></i>Filter Laporan
        </h5>
    </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.laporan.keuangan') }}" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Bulan</label>
                    <select name="bulan" class="form-select">
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tahun</label>
                    <select name="tahun" class="form-select">
                        @for ($i = date('Y') - 2; $i <= date('Y') + 1; $i++)
                            <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-search me-1"></i>Filter
                    </button>
                    <a href="{{ route('admin.laporan.export', ['type' => 'keuangan', 'bulan' => $bulan, 'tahun' => $tahun]) }}"
                        class="btn btn-success">
                        <i class="fas fa-download me-1"></i>Export
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-header">
                    <i class="fas fa-arrow-up me-2"></i>Total Pendapatan
                </div>
                <div class="card-body">
                    <h4 class="card-title">Rp {{ number_format($pendapatan, 0, ',', '.') }}</h4>
                    <small>Periode: {{ DateTime::createFromFormat('!m', $bulan)->format('F') }} {{ $tahun }}</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger">
                <div class="card-header">
                    <i class="fas fa-arrow-down me-2"></i>Total Pengeluaran
                </div>
                <div class="card-body">
                    <h4 class="card-title">Rp {{ number_format($total_pengeluaran, 0, ',', '.') }}</h4>
                    <small>Gaji: Rp {{ number_format($pengeluaran_gaji, 0, ',', '.') }}</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white {{ $laba_rugi >= 0 ? 'bg-info' : 'bg-warning' }}">
                <div class="card-header">
                    <i class="fas fa-chart-line me-2"></i>Laba/Rugi
                </div>
                <div class="card-body">
                    <h4 class="card-title">Rp {{ number_format($laba_rugi, 0, ',', '.') }}</h4>
                    <small>{{ $laba_rugi >= 0 ? 'Laba' : 'Rugi' }}</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-secondary">
                <div class="card-header">
                    <i class="fas fa-percentage me-2"></i>Margin
                </div>
                <div class="card-body">
                    <h4 class="card-title">{{ $pendapatan > 0 ? number_format(($laba_rugi/$pendapatan)*100, 1) : 0 }}%</h4>
                    <small>Margin Laba</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-line me-2"></i>Trend Penjualan Harian
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="salesChart" height="100"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-pie me-2"></i>Komposisi Keuangan
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="pieChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Produk Terlaris -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-trophy me-2"></i>Produk Terlaris
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Produk</th>
                                    <th>Terjual</th>
                                    <th>Pendapatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($produkTerlaris as $produk)
                                    <tr>
                                        <td>{{ $produk->nama_barang }}</td>
                                        <td>{{ number_format($produk->total_terjual) }}</td>
                                        <td>Rp {{ number_format($produk->total_pendapatan, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-money-bill-wave me-2"></i>Detail Pengeluaran Gaji
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Karyawan</th>
                                    <th>Jabatan</th>
                                    <th>Gaji</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($gaji as $g)
                                    <tr>
                                        <td>{{ $g->karyawan->nama ?? 'Unknown' }}</td>
                                        <td>{{ $g->karyawan->jabatan->nama_jabatan ?? 'Unknown' }}</td>
                                        <td>Rp {{ number_format($g->total_gaji, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">Tidak ada data gaji</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Transaksi Detail -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="fas fa-receipt me-2"></i>Detail Transaksi
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Tanggal</th>
                            <th>ID Transaksi</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksi->take(20) as $t)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($t->tanggal_transaksi)->format('d/m/Y H:i') }}</td>
                                <td>#{{ $t->id_transaksi }}</td>
                                <td>{{ $t->nama_barang ?? 'Multiple Items' }}</td>
                                <td>{{ $t->jumlah_barang ?? '-' }}</td>
                                <td>Rp {{ number_format($t->total_belanja, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Tidak ada data transaksi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($transaksi->count() > 20)
                <div class="text-center mt-3">
                    <small class="text-muted">Menampilkan 20 transaksi teratas dari {{ $transaksi->count() }} total transaksi</small>
                </div>
            @endif
        </div>
    </div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sales Chart
    const salesCtx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(salesCtx, {
        type: 'line',
        data: {
            labels: @json($dataHarian->pluck('hari')->map(function($hari) { return 'Hari ' . $hari; })),
            datasets: [{
                label: 'Penjualan Harian',
                data: @json($dataHarian->pluck('total')),
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Trend Penjualan Harian'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value, index, values) {
                            return 'Rp ' + value.toLocaleString();
                        }
                    }
                }
            }
        }
    });

    // Pie Chart
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    const pieChart = new Chart(pieCtx, {
        type: 'doughnut',
        data: {
            labels: ['Pendapatan', 'Pengeluaran Gaji', 'Pengeluaran Lain'],
            datasets: [{
                data: [{{ $pendapatan }}, {{ $pengeluaran_gaji }}, {{ $pengeluaran_lain }}],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(255, 206, 86, 0.8)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'Komposisi Keuangan'
                }
            }
        }
    });
});
</script>
@endpush
@endsection
