@extends('layouts.navbar_admin')

@section('title', 'Analisis Penjualan - MyYOGYA Admin')

@section('content')
<style>
.penjualan-header {
    background: linear-gradient(135deg, #9333ea 0%, #7c3aed 100%);
    color: white;
    padding: 35px 40px;
    border-radius: 15px;
    margin-bottom: 35px;
    box-shadow: 0 4px 15px rgba(147, 51, 234, 0.3);
}

.penjualan-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 25px;
    margin-bottom: 35px;
}

.penjualan-card {
    background: white;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
}

.penjualan-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.12);
}

.penjualan-icon {
    width: 45px;
    height: 45px;
    background: linear-gradient(135deg, #9333ea, #7c3aed);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.1rem;
    margin-bottom: 15px;
}

.penjualan-number {
    font-size: 1.8rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 5px;
}

.penjualan-label {
    color: #64748b;
    font-size: 0.9rem;
    font-weight: 500;
}

.chart-container {
    background: white;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    margin-bottom: 30px;
}

.chart-wrapper {
    position: relative;
    height: 400px;
    margin-top: 20px;
}

.chart-loading {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: #64748b;
    font-size: 14px;
    display: none;
}

@media (max-width: 768px) {
    .chart-wrapper {
        height: 300px;
    }
    
    .chart-controls {
        flex-wrap: wrap;
        gap: 8px;
    }
    
    .chart-btn {
        padding: 6px 12px;
        font-size: 0.8rem;
    }
}

.chart-controls {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
    align-items: center;
}

.chart-btn {
    padding: 8px 16px;
    border: 1px solid #9333ea;
    background: transparent;
    color: #9333ea;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 0.9rem;
}

.chart-btn.active,
.chart-btn:hover {
    background: #9333ea;
    color: white;
}

@media (max-width: 768px) {
    .main-content {
        margin-left: 0 !important;
        width: 100% !important;
        padding: 20px !important;
    }
}
</style>

<!-- Penjualan Header -->
<div class="penjualan-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="fas fa-chart-line me-3"></i>Analisis Penjualan</h1>
            <p>Monitor kinerja penjualan dan tren bisnis</p>
        </div>
        <div class="text-end">
            <small>{{ date('l, d F Y') }}</small>
        </div>
    </div>
</div>

<!-- Penjualan Statistics -->
<div class="penjualan-stats">
    <div class="penjualan-card">
        <div class="penjualan-icon">
            <i class="fas fa-shopping-cart"></i>
        </div>
        <div class="penjualan-number">{{ number_format($totalTransaksi) }}</div>
        <div class="penjualan-label">Total Transaksi</div>
    </div>

    <div class="penjualan-card">
        <div class="penjualan-icon">
            <i class="fas fa-money-bill-wave"></i>
        </div>
        <div class="penjualan-number">Rp {{ number_format($pendapatan) }}</div>
        <div class="penjualan-label">Pendapatan</div>
    </div>

    <div class="penjualan-card">
        <div class="penjualan-icon">
            <i class="fas fa-calculator"></i>
        </div>
        <div class="penjualan-number">Rp {{ number_format($rataRataTransaksi) }}</div>
        <div class="penjualan-label">Rata-rata Transaksi</div>
    </div>

    <div class="penjualan-card">
        <div class="penjualan-icon">
            <i class="fas fa-star"></i>
        </div>
        <div class="penjualan-number">{{ $barangTerlaris ?? 'N/A' }}</div>
        <div class="penjualan-label">Barang Terlaris</div>
    </div>
</div>

<!-- Penjualan Chart -->
<div class="chart-container">
    <div class="d-flex justify-content-between align-items-center">
        <h5><i class="fas fa-chart-bar me-2"></i>Grafik Penjualan Harian</h5>
        <div class="chart-controls">
            <button class="chart-btn active" onclick="updateChart(7)">7 Hari</button>
            <button class="chart-btn" onclick="updateChart(30)">30 Hari</button>
            <button class="chart-btn" onclick="updateChart(90)">3 Bulan</button>
        </div>
    </div>
    <div class="chart-wrapper">
        <canvas id="penjualanChart"></canvas>
        <div class="chart-loading" id="chartLoading">
            <i class="fas fa-spinner fa-spin me-2"></i>Memuat data...
        </div>
    </div>
</div>

<!-- Barang Terlaris Table -->
<div class="card">
    <div class="card-header">
        <h5><i class="fas fa-trophy me-2"></i>Barang Terlaris</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Ranking</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Total Terjual</th>
                        <th>Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barangTerlarisData as $index => $barang)
                    <tr>
                        <td>
                            @if($index == 0)
                                <i class="fas fa-trophy text-warning"></i> 1
                            @elseif($index == 1)
                                <i class="fas fa-medal text-secondary"></i> 2
                            @elseif($index == 2)
                                <i class="fas fa-award text-warning"></i> 3
                            @else
                                {{ $index + 1 }}
                            @endif
                        </td>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->nama_kategori }}</td>
                        <td>
                            <span class="badge bg-primary">{{ $barang->total_terjual }}</span>
                        </td>
                        <td>Rp {{ number_format($barang->total_pendapatan) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada data penjualan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Chart Penjualan Harian
let penjualanChart;
const ctx = document.getElementById('penjualanChart').getContext('2d');

// Data dari controller
const initialData = @json($penjualanHarian);

function initChart(data) {
    const labels = data.map(item => item.tanggal);
    const values = data.map(item => item.total);
    
    if (penjualanChart) {
        penjualanChart.destroy();
    }
    
    penjualanChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: values,
                borderColor: '#9333ea',
                backgroundColor: 'rgba(147, 51, 234, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#9333ea',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 3,
                pointRadius: 6,
                pointHoverRadius: 8,
                shadowColor: 'rgba(147, 51, 234, 0.3)',
                shadowBlur: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        font: {
                            size: 12,
                            weight: '500'
                        },
                        color: '#64748b'
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(30, 41, 59, 0.9)',
                    titleColor: '#ffffff',
                    bodyColor: '#ffffff',
                    borderColor: '#9333ea',
                    borderWidth: 1,
                    cornerRadius: 8,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return 'Pendapatan: Rp ' + context.parsed.y.toLocaleString('id-ID');
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: true,
                        color: 'rgba(0,0,0,0.05)'
                    },
                    ticks: {
                        font: {
                            size: 11
                        },
                        color: '#64748b'
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        display: true,
                        color: 'rgba(0,0,0,0.05)'
                    },
                    ticks: {
                        font: {
                            size: 11
                        },
                        color: '#64748b',
                        callback: function(value) {
                            if (value >= 1000000) {
                                return 'Rp ' + (value / 1000000).toFixed(1) + 'M';
                            } else if (value >= 1000) {
                                return 'Rp ' + (value / 1000).toFixed(0) + 'K';
                            }
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            },
            elements: {
                point: {
                    hoverRadius: 8
                }
            },
            animation: {
                duration: 1000,
                easing: 'easeInOutQuart'
            }
        }
    });
}

// Initialize chart with initial data
initChart(initialData);

// Update chart function
async function updateChart(days) {
    // Update active button
    document.querySelectorAll('.chart-btn').forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');
    
    // Show loading
    const loadingElement = document.getElementById('chartLoading');
    loadingElement.style.display = 'block';
    
    try {
        // Fetch new data
        const response = await fetch(`/admin/chart-data?period=${days}`);
        const result = await response.json();
        
        if (result.success) {
            // Format data
            const chartData = result.labels.map((label, index) => ({
                tanggal: label,
                total: result.data[index]
            }));
            
            // Hide loading
            loadingElement.style.display = 'none';
            
            initChart(chartData);
        } else {
            loadingElement.style.display = 'none';
            console.error('Failed to fetch chart data:', result.message);
            
            // Show error message
            alert('Gagal memuat data grafik. Silakan coba lagi.');
        }
    } catch (error) {
        loadingElement.style.display = 'none';
        console.error('Error updating chart:', error);
        alert('Terjadi kesalahan saat memuat data. Silakan coba lagi.');
    }
}
</script>
@endsection
