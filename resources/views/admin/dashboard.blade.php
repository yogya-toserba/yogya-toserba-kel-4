@extends('layouts.navbar_admin')

@section('title', 'Dashboard Admin - MyYOGYA')

@section('content')
<div class="container-fluid">
    <!-- Welcome Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-1">Dashboard Admin</h1>
                    <p class="text-muted mb-0">Selamat datang di panel administrasi MyYOGYA</p>
                </div>
                <div class="text-end">
                    <small class="text-muted">{{ date('l, d F Y') }}</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <!-- Total Produk -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted small mb-1">Total Produk</div>
                            <div class="h4 mb-0 text-dark">{{ number_format($totalProduk) }}</div>
                            <small class="text-success">
                                <i class="fas fa-box-open"></i> {{ number_format($totalStok) }} Total Stok
                            </small>
                        </div>
                        <div class="text-primary opacity-75">
                            <i class="fas fa-box fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Transaksi -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted small mb-1">Transaksi Hari Ini</div>
                            <div class="h4 mb-0 text-dark">{{ number_format($transaksiHariIni) }}</div>
                            <small class="text-info">
                                <i class="fas fa-calendar-day"></i> {{ date('d F Y') }}
                            </small>
                        </div>
                        <div class="text-success opacity-75">
                            <i class="fas fa-shopping-cart fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Pengguna -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted small mb-1">Total Pelanggan</div>
                            <div class="h4 mb-0 text-dark">{{ number_format($totalPengguna) }}</div>
                            <small class="text-warning">
                                <i class="fas fa-users"></i> Registered customers
                            </small>
                        </div>
                        <div class="text-warning opacity-75">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pendapatan -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted small mb-1">Pendapatan Hari Ini</div>
                            <div class="h4 mb-0 text-dark">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</div>
                            <small class="text-success">
                                <i class="fas fa-money-bill-wave"></i> Dari {{ $transaksiHariIni }} transaksi
                            </small>
                        </div>
                        <div class="text-info opacity-75">
                            <i class="fas fa-chart-line fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Analytics Dashboard -->
    <div class="row g-4 mb-4">
        <!-- Sales Chart -->
        <div class="col-xl-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-chart-line text-primary me-2"></i>Grafik Penjualan
                        </h5>
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" id="periodDropdown">
                                <span id="currentPeriod">7 Hari Terakhir</span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item period-filter" href="#" data-days="7">7 Hari</a></li>
                                <li><a class="dropdown-item period-filter" href="#" data-days="30">30 Hari</a></li>
                                <li><a class="dropdown-item period-filter" href="#" data-days="90">90 Hari</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="chartLoading" class="text-center d-none" style="padding: 60px;">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2">Memuat data...</p>
                    </div>
                    <div style="position: relative; height: 300px;">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="col-xl-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0">Pesanan Terbaru</h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item px-0 border-0">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm me-3">
                                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-shopping-bag"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-semibold">Pesanan #12345</div>
                                    <small class="text-muted">Budi Santoso - Rp 125,000</small>
                                </div>
                                <small class="text-muted">2 min</small>
                            </div>
                        </div>
                        <div class="list-group-item px-0 border-0">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm me-3">
                                    <div class="bg-success bg-opacity-10 text-success rounded-circle p-2 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-semibold">Pesanan #12344</div>
                                    <small class="text-muted">Siti Aminah - Rp 87,500</small>
                                </div>
                                <small class="text-muted">5 min</small>
                            </div>
                        </div>
                        <div class="list-group-item px-0 border-0">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm me-3">
                                    <div class="bg-warning bg-opacity-10 text-warning rounded-circle p-2 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-truck"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-semibold">Pesanan #12343</div>
                                    <small class="text-muted">Ahmad Rizki - Rp 156,000</small>
                                </div>
                                <small class="text-muted">8 min</small>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <a href="#" class="btn btn-outline-primary btn-sm">Lihat Semua Pesanan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Tables & Analytics -->
    <div class="row g-4">
        <!-- System Status & Performance -->
        <div class="col-xl-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0">Status Sistem</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <div class="text-success me-2">
                                    <i class="fas fa-circle fa-sm"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold">Server</div>
                                    <small class="text-muted">Online</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <div class="text-success me-2">
                                    <i class="fas fa-circle fa-sm"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold">Database</div>
                                    <small class="text-muted">Connected</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <div class="text-warning me-2">
                                    <i class="fas fa-circle fa-sm"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold">Storage</div>
                                    <small class="text-muted">78% Used</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <div class="text-success me-2">
                                    <i class="fas fa-circle fa-sm"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold">Payment</div>
                                    <small class="text-muted">Active</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row g-3 text-center">
                        <div class="col-4">
                            <div class="fw-semibold text-primary">99.9%</div>
                            <small class="text-muted">Uptime</small>
                        </div>
                        <div class="col-4">
                            <div class="fw-semibold text-success">42ms</div>
                            <small class="text-muted">Response</small>
                        </div>
                        <div class="col-4">
                            <div class="fw-semibold text-info">2.1GB</div>
                            <small class="text-muted">Memory</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Best Selling Products -->
        <div class="col-xl-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Produk Terlaris</h5>
                    <small class="text-muted">30 hari terakhir</small>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Produk</th>
                                    <th class="text-center">Terjual</th>
                                    <th class="text-end">Pendapatan</th>
                                    <th class="text-center">Trend</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 text-primary rounded p-2 me-3">
                                                <i class="fas fa-box-open"></i>
                                            </div>
                                            <div>
                                                <div class="fw-semibold">Indomie Goreng</div>
                                                <small class="text-muted">Makanan Instan</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-success">1,250</span>
                                    </td>
                                    <td class="text-end fw-semibold">Rp 4,062,500</td>
                                    <td class="text-center">
                                        <i class="fas fa-arrow-up text-success"></i>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-success bg-opacity-10 text-success rounded p-2 me-3">
                                                <i class="fas fa-seedling"></i>
                                            </div>
                                            <div>
                                                <div class="fw-semibold">Beras Premium 5kg</div>
                                                <small class="text-muted">Sembako</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-info">892</span>
                                    </td>
                                    <td class="text-end fw-semibold">Rp 66,900,000</td>
                                    <td class="text-center">
                                        <i class="fas fa-arrow-up text-success"></i>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-warning bg-opacity-10 text-warning rounded p-2 me-3">
                                                <i class="fas fa-tint"></i>
                                            </div>
                                            <div>
                                                <div class="fw-semibold">Minyak Goreng 1L</div>
                                                <small class="text-muted">Sembako</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-warning">756</span>
                                    </td>
                                    <td class="text-end fw-semibold">Rp 13,608,000</td>
                                    <td class="text-center">
                                        <i class="fas fa-minus text-muted"></i>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-3">
                        <a href="#" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-chart-bar me-1"></i>Lihat Laporan Lengkap
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let salesChart;
    
    // Initialize chart with default data
    function initChart(labels, data) {
        const ctx = document.getElementById('salesChart').getContext('2d');
        
        if (salesChart) {
            salesChart.destroy();
        }
        
        salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Penjualan',
                    data: data,
                    fill: true,
                    backgroundColor: 'rgba(13, 110, 253, 0.1)',
                    borderColor: '#0d6efd',
                    borderWidth: 2,
                    tension: 0.4,
                    pointBackgroundColor: '#0d6efd',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#6c757d'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0,0,0,0.05)'
                        },
                        ticks: {
                            color: '#6c757d',
                            callback: function(value) {
                                return 'Rp ' + value + 'K';
                            }
                        }
                    }
                },
                interaction: {
                    intersect: false
                },
                animation: {
                    duration: 800,
                    easing: 'easeInOutQuart'
                }
            }
        });
    }
    
    // Initialize with default data (7 days)
    initChart(@json($chartLabels), @json($chartData));
    
    // Function untuk load more produk terlaris
    function loadMoreProdukTerlaris() {
        fetch('{{ route('api.produk.terlaris') }}?limit=20')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show modal with detailed data
                    showProdukTerlarisModal(data.data);
                }
            })
            .catch(error => {
                console.error('Error loading produk terlaris:', error);
                alert('Gagal memuat data produk terlaris');
            });
    }
    
    // Function to show modal with produk terlaris details
    function showProdukTerlarisModal(products) {
        let modalContent = `
            <div class="modal fade" id="produkTerlarisModal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <i class="fas fa-fire text-danger me-2"></i>
                                Produk Terlaris Lengkap
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Rank</th>
                                            <th>Produk</th>
                                            <th>Kategori</th>
                                            <th>Harga</th>
                                            <th>Terjual</th>
                                            <th>Pendapatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>`;
        
        products.forEach((product, index) => {
            modalContent += `
                <tr>
                    <td>
                        <span class="badge bg-${index < 3 ? 'warning' : 'secondary'}">${index + 1}</span>
                    </td>
                    <td>
                        <div class="fw-semibold">${product.nama_barang}</div>
                    </td>
                    <td>${product.nama_kategori}</td>
                    <td>Rp ${parseInt(product.harga_jual).toLocaleString('id-ID')}</td>
                    <td>
                        <span class="badge bg-success">${product.total_terjual}</span>
                    </td>
                    <td>Rp ${parseInt(product.total_pendapatan).toLocaleString('id-ID')}</td>
                </tr>`;
        });
        
        modalContent += `
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;
        
        // Remove existing modal if any
        const existingModal = document.getElementById('produkTerlarisModal');
        if (existingModal) {
            existingModal.remove();
        }
        
        // Add modal to body
        document.body.insertAdjacentHTML('beforeend', modalContent);
        
        // Show modal
        const modal = new bootstrap.Modal(document.getElementById('produkTerlarisModal'));
        modal.show();
    }
    
    // Handle period filter clicks
    document.querySelectorAll('.period-filter').forEach(function(item) {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const days = this.getAttribute('data-days');
            const periodText = this.textContent;
            
            // Show loading
            document.getElementById('chartLoading').classList.remove('d-none');
            document.getElementById('salesChart').style.opacity = '0.3';
            
            // Update dropdown text
            document.getElementById('currentPeriod').textContent = periodText + ' Terakhir';
            
            // Fetch new data via AJAX
            fetch('{{ route("admin.sales.data") }}?days=' + days, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.status);
                }
                return response.json();
            })
            .then(data => {
                console.log('Received data:', data);
                
                // Hide loading
                document.getElementById('chartLoading').classList.add('d-none');
                document.getElementById('salesChart').style.opacity = '1';
                
                if (data.success) {
                    // Update chart with new data
                    initChart(data.labels, data.data);
                } else {
                    console.error('Error fetching chart data:', data.message || 'Unknown error');
                    alert('Gagal memuat data grafik: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('AJAX Error:', error);
                
                // Hide loading
                document.getElementById('chartLoading').classList.add('d-none');
                document.getElementById('salesChart').style.opacity = '1';
                
                alert('Terjadi kesalahan saat memuat data. Silakan periksa console untuk detail.');
            });
        });
    });
});
</script>

@endsection
