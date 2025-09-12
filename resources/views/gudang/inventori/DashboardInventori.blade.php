@extends('layouts.appInventori')

@section('content')
<style>
/* Modern Dashboard Styling */
.dashboard-modern {
    min-height: 100vh;
    padding: 2rem;
    position: relative;
    overflow-x: hidden;
}

.dashboard-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmZmZmYiIGZpbGwtb3BhY2l0eT0iMC4xIj48cGF0aCBkPSJtMzYgMzRjMC0yLjIwOS0xLjc5MS00LTQtNHMtNCAxLjc5MS00IDQgMS43OTEgNCA0IDQgNC0xLjc5MSA0LTR6bTAtMTBjMC0yLjIwOS0xLjc5MS00LTQtNHMtNCAxLjc5MS00IDQgMS43OTEgNCA0IDQgNC0xLjc5MSA0LTR6bTAtMTBjMC0yLjIwOS0xLjc5MS00LTQtNHMtNCAxLjc5MS00IDQgMS43OTEgNCA0IDQgNC0xLjc5MSA0LTR6bTEwIDEwYzAtMi4yMDktMS43OTEtNC00LTRzLTQgMS43OTEtNCA0IDEuNzkxIDQgNCA0IDQtMS43OTEgNC00em0wIDEwYzAtMi4yMDktMS43OTEtNC00LTRzLTQgMS43OTEtNCA0IDEuNzkxIDQgNCA0IDQtMS43OTEgNC00em0wIDEwYzAtMi4yMDktMS43OTEtNC00LTRzLTQgMS43OTEtNCA0IDEuNzkxIDQgNCA0IDQtMS43OTEgNC00em0xMC0yMGMwLTIuMjA5LTEuNzkxLTQtNC00cy00IDEuNzkxLTQgNDFi</svg>') repeat;
    opacity: 0.05;
    z-index: 0;
}

.dashboard-content {
    position: relative;
    z-index: 1;
}

.dashboard-header {
    background: linear-gradient(135deg, #f26b37, #e55827);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 20px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 8px 32px rgba(242, 107, 55, 0.3);
    color: white;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.dashboard-header::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.1) 50%, transparent 70%);
    animation: shimmer 3s infinite;
}

@keyframes shimmer {
    0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
    100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
}

.dashboard-header h1 {
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 1rem;
    background: linear-gradient(45deg, #fff, #e2e8f0);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    position: relative;
    z-index: 2;
}

.dashboard-header p {
    font-size: 1.2rem;
    opacity: 0.9;
    position: relative;
    z-index: 2;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.stat-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    position: relative;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #667eea, #764ba2);
}

.stat-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
}

.stat-icon {
    width: 70px;
    height: 70px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
    margin-bottom: 1.5rem;
    position: relative;
    overflow: hidden;
}

.stat-icon::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: inherit;
    filter: blur(20px);
    opacity: 0.3;
    z-index: -1;
}

.stat-icon.primary {
    background: linear-gradient(135deg, #667eea, #764ba2);
}

.stat-icon.success {
    background: linear-gradient(135deg, #4ade80, #22c55e);
}

.stat-icon.warning {
    background: linear-gradient(135deg, #fbbf24, #f59e0b);
}

.stat-icon.danger {
    background: linear-gradient(135deg, #ef4444, #dc2626);
}

.stat-icon.info {
    background: linear-gradient(135deg, #06b6d4, #0891b2);
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 800;
    color: #1f2937;
    margin-bottom: 0.5rem;
    line-height: 1;
}

.stat-label {
    font-size: 1.1rem;
    color: #6b7280;
    font-weight: 600;
    margin-bottom: 1rem;
}

.stat-change {
    display: flex;
    align-items: center;
    font-size: 0.9rem;
    font-weight: 600;
}

.stat-change.positive {
    color: #22c55e;
}

.stat-change.negative {
    color: #ef4444;
}

.charts-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 2rem;
    margin-bottom: 2rem;
}

.chart-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.chart-header {
    margin-bottom: 2rem;
    border-bottom: 2px solid #f1f5f9;
    padding-bottom: 1rem;
}

.chart-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 0.5rem;
}

.chart-subtitle {
    color: #6b7280;
    font-size: 0.9rem;
}

.recent-activities {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.activity-item {
    display: flex;
    align-items: center;
    padding: 1rem 0;
    border-bottom: 1px solid #f1f5f9;
    transition: all 0.3s ease;
}

.activity-item:hover {
    background: rgba(102, 126, 234, 0.05);
    border-radius: 10px;
    margin: 0 -1rem;
    padding: 1rem;
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    font-size: 1rem;
    color: white;
}

.activity-content {
    flex: 1;
}

.activity-title {
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 0.25rem;
}

.activity-time {
    font-size: 0.8rem;
    color: #6b7280;
}

.quick-actions {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.action-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: 15px;
    padding: 1.5rem;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
    cursor: pointer;
    text-align: center;
}

.action-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}

.action-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    font-size: 1.5rem;
    color: white;
}

.action-title {
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 0.5rem;
}

.action-desc {
    font-size: 0.8rem;
    color: #6b7280;
}

.progress-ring {
    width: 120px;
    height: 120px;
    margin: 0 auto;
}

.progress-ring-circle {
    fill: none;
    stroke: #e5e7eb;
    stroke-width: 8;
}

.progress-ring-progress {
    fill: none;
    stroke: #667eea;
    stroke-width: 8;
    stroke-linecap: round;
    transform: rotate(-90deg);
    transform-origin: 50% 50%;
    transition: stroke-dasharray 0.5s ease;
}

@media (max-width: 768px) {
    .dashboard-modern {
        padding: 1rem;
    }
    
    .charts-grid {
        grid-template-columns: 1fr;
    }
    
    .dashboard-header h1 {
        font-size: 2rem;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
}

/* Additional animations */
@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.5;
    }
}

.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

/* Enhanced card hover effects */
.chart-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
}

/* Gradient borders for top products */
.gradient-border {
    position: relative;
    background: white;
    border-radius: 8px;
}

.gradient-border::before {
    content: '';
    position: absolute;
    inset: 0;
    padding: 2px;
    background: linear-gradient(45deg, #667eea, #764ba2);
    border-radius: inherit;
    mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
    mask-composite: exclude;
}
</style>

<div class="dashboard-modern">
    <div class="dashboard-content">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <h1><i class="fas fa-tachometer-alt mr-3"></i>Dashboard Inventori</h1>
            <p>Selamat datang di sistem manajemen inventori modern • {{ date('d F Y') }}</p>
        </div>

        <!-- Statistics Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon primary">
                    <i class="fas fa-boxes"></i>
                </div>
                <div class="stat-number">{{ number_format($totalProduk) }}</div>
                <div class="stat-label">Total Produk</div>
                <div class="stat-change {{ $growthMetrics['produk']['trend'] === 'up' ? 'positive' : 'negative' }}">
                    <i class="fas fa-arrow-{{ $growthMetrics['produk']['trend'] }} mr-1"></i>
                    {{ $growthMetrics['produk']['trend'] === 'up' ? '+' : '' }}{{ $growthMetrics['produk']['value'] }}% dari bulan lalu
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon success">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-number">{{ number_format($produkAktif) }}</div>
                <div class="stat-label">Produk Aktif</div>
                <div class="stat-change {{ $growthMetrics['aktif']['trend'] === 'up' ? 'positive' : 'negative' }}">
                    <i class="fas fa-arrow-{{ $growthMetrics['aktif']['trend'] }} mr-1"></i>
                    {{ $growthMetrics['aktif']['trend'] === 'up' ? '+' : '' }}{{ $growthMetrics['aktif']['value'] }}% dari bulan lalu
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon warning">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stat-number">{{ number_format($stokRendah) }}</div>
                <div class="stat-label">Stok Rendah</div>
                <div class="stat-change negative">
                    <i class="fas fa-exclamation-circle mr-1"></i>
                    Perlu perhatian segera
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon info">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="stat-number">Rp {{ number_format($totalNilai, 0, ',', '.') }}</div>
                <div class="stat-label">Total Nilai Inventori</div>
                <div class="stat-change {{ $growthMetrics['nilai']['trend'] === 'up' ? 'positive' : 'negative' }}">
                    <i class="fas fa-arrow-{{ $growthMetrics['nilai']['trend'] }} mr-1"></i>
                    {{ $growthMetrics['nilai']['trend'] === 'up' ? '+' : '' }}{{ $growthMetrics['nilai']['value'] }}% dari bulan lalu
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="charts-grid">
            <div class="chart-card">
                <div class="chart-header">
                    <h3 class="chart-title">Trend Stok Bulanan</h3>
                    <p class="chart-subtitle">Pergerakan stok dalam 6 bulan terakhir</p>
                </div>
                <div class="chart-container" style="height: 300px;">
                    <canvas id="trendChart"></canvas>
                </div>
            </div>

            <div class="chart-card">
                <div class="chart-header">
                    <h3 class="chart-title">Status Produk</h3>
                    <p class="chart-subtitle">Distribusi status produk berdasarkan stok</p>
                </div>
                <div class="text-center" style="padding: 2rem 0;">
                    <div class="progress-container" style="position: relative; display: inline-block;">
                        <svg class="progress-ring" width="120" height="120">
                            <circle class="progress-ring-circle" cx="60" cy="60" r="52"></circle>
                            <circle class="progress-ring-progress" cx="60" cy="60" r="52" 
                                    stroke-dasharray="327" stroke-dashoffset="{{ 327 - (327 * $persentaseProdukAktif / 100) }}"></circle>
                        </svg>
                        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
                            <div style="font-size: 1.8rem; font-weight: bold; color: #1f2937;">{{ $persentaseProdukAktif }}%</div>
                            <div style="font-size: 0.8rem; color: #6b7280;">Aktif</div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="grid grid-cols-2 gap-2 text-xs">
                            <div class="text-center p-2 bg-green-50 rounded">
                                <div class="font-bold text-green-600">{{ number_format($kategoriStok['stok_tinggi']) }}</div>
                                <div class="text-green-500">Stok Tinggi</div>
                            </div>
                            <div class="text-center p-2 bg-yellow-50 rounded">
                                <div class="font-bold text-yellow-600">{{ number_format($kategoriStok['stok_sedang']) }}</div>
                                <div class="text-yellow-500">Stok Sedang</div>
                            </div>
                            <div class="text-center p-2 bg-orange-50 rounded">
                                <div class="font-bold text-orange-600">{{ number_format($kategoriStok['stok_rendah']) }}</div>
                                <div class="text-orange-500">Stok Rendah</div>
                            </div>
                            <div class="text-center p-2 bg-red-50 rounded">
                                <div class="font-bold text-red-600">{{ number_format($kategoriStok['stok_habis']) }}</div>
                                <div class="text-red-500">Stok Habis</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions">
            <div class="action-card" onclick="openTambahProdukModal()">
                <div class="action-icon primary">
                    <i class="fas fa-plus"></i>
                </div>
                <div class="action-title">Tambah Produk</div>
                <div class="action-desc">Tambahkan produk baru ke inventori</div>
            </div>

            <div class="action-card" onclick="location.href='{{ route('gudang.inventori.index') }}'">
                <div class="action-icon success">
                    <i class="fas fa-search"></i>
                </div>
                <div class="action-title">Cari Produk</div>
                <div class="action-desc">Pencarian dan filter produk</div>
            </div>

            <div class="action-card" onclick="location.href='{{ route('gudang.inventori.index') }}'">
                <div class="action-icon warning">
                    <i class="fas fa-download"></i>
                </div>
                <div class="action-title">Export Data</div>
                <div class="action-desc">Download laporan inventori</div>
            </div>

            <div class="action-card" onclick="location.href='{{ route('gudang.inventori.index') }}'">
                <div class="action-icon danger">
                    <i class="fas fa-cog"></i>
                </div>
                <div class="action-title">Pengaturan</div>
                <div class="action-desc">Konfigurasi sistem inventori</div>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="recent-activities">
            <div class="chart-header">
                <h3 class="chart-title">Aktivitas Terkini</h3>
                <p class="chart-subtitle">Log aktivitas sistem dalam 24 jam terakhir</p>
            </div>

            @foreach($recentActivities as $activity)
            <div class="activity-item">
                <div class="activity-icon {{ $activity['color'] }}">
                    <i class="{{ $activity['icon'] }}"></i>
                </div>
                <div class="activity-content">
                    <div class="activity-title">{{ $activity['title'] }}</div>
                    <div class="font-medium text-gray-700 mb-1">{{ $activity['description'] }}</div>
                    <div class="text-sm text-gray-500 mb-2">{{ $activity['details'] }}</div>
                    <div class="activity-time">{{ $activity['time'] }}</div>
                </div>
            </div>
            @endforeach

            @if(count($recentActivities) == 0)
            <div class="text-center py-8 text-gray-500">
                <i class="fas fa-inbox text-4xl mb-3 opacity-50"></i>
                <p>Belum ada aktivitas terbaru</p>
                <small>Aktivitas akan muncul setelah ada perubahan data</small>
            </div>
            @endif
        </div>

        <!-- Spacer untuk memberikan jarak -->
        <div class="mb-8"></div>

        <!-- Top Products Section -->
        <div class="charts-grid">
            <div class="chart-card">
                <div class="chart-header">
                    <h3 class="chart-title">
                        <i class="fas fa-trophy text-yellow-500 mr-2"></i>
                        Top 5 Produk - Stok Tertinggi
                    </h3>
                    <p class="chart-subtitle">Produk dengan stok paling banyak</p>
                </div>
                <div class="space-y-3">
                    @foreach($topStokTinggi as $index => $produk)
                    <div class="flex items-center justify-between p-3 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg hover:from-blue-100 hover:to-indigo-100 transition-all duration-300 border border-blue-100">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-full flex items-center justify-center text-sm font-bold mr-3 shadow-lg">
                                {{ $index + 1 }}
                            </div>
                            <div>
                                <div class="font-semibold text-gray-800">{{ Str::limit($produk->nama_barang, 25) }}</div>
                                <div class="text-sm text-blue-600">Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="font-bold text-green-600 text-lg">{{ number_format($produk->stok) }}</div>
                            <div class="text-xs text-gray-500 bg-green-100 px-2 py-1 rounded-full">unit</div>
                        </div>
                    </div>
                    @endforeach

                    @if($topStokTinggi->count() == 0)
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-box text-3xl mb-3 opacity-50"></i>
                        <p class="font-medium">Tidak ada data produk</p>
                        <small>Data akan muncul setelah produk ditambahkan</small>
                    </div>
                    @endif
                </div>
            </div> 
            <div class="chart-card">
                <div class="chart-header">
                    <h3 class="chart-title">
                        <i class="fas fa-exclamation-triangle text-orange-500 mr-2"></i>
                        Peringatan Stok Rendah
                    </h3>
                    <p class="chart-subtitle">Produk yang perlu segera direstok</p>
                </div>
                <div class="space-y-3">
                    @foreach($topStokRendah as $index => $produk)
                    <div class="flex items-center justify-between p-3 bg-gradient-to-r from-red-50 to-pink-50 rounded-lg hover:from-red-100 hover:to-pink-100 transition-all duration-300 border border-red-100 relative">
                        <!-- Pulse animation untuk urgent items -->
                        @if($produk->stok <= 5)
                        <div class="absolute top-0 right-0 w-3 h-3 bg-red-500 rounded-full animate-pulse"></div>
                        @endif
                        
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-r from-red-500 to-pink-600 text-white rounded-full flex items-center justify-center text-sm font-bold mr-3 shadow-lg">
                                <i class="fas fa-exclamation text-xs"></i>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-800">{{ Str::limit($produk->nama_barang, 25) }}</div>
                                <div class="text-sm text-red-600 font-medium">
                                    @if($produk->stok <= 5)
                                        <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs">URGENT!</span>
                                    @else
                                        Perlu restok segera
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="font-bold text-red-600 text-lg">{{ number_format($produk->stok) }}</div>
                            <div class="text-xs text-gray-500 bg-red-100 px-2 py-1 rounded-full">tersisa</div>
                        </div>
                    </div>
                    @endforeach

                    @if($topStokRendah->count() == 0)
                    <div class="text-center py-8 text-green-500">
                        <i class="fas fa-check-circle text-3xl mb-3"></i>
                        <p class="font-medium">Semua produk stoknya aman!</p>
                        <small class="text-green-400">Tidak ada produk dengan stok rendah</small>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Produk -->
<dialog id="modalTambahProduk" class="modal modal-middle">
  <div class="modal-box max-w-4xl">
    <form method="POST" action="{{ route('gudang.inventori.store') }}" enctype="multipart/form-data" id="tambahProdukFormDashboard">
      @csrf
      <h3 class="font-bold text-lg mb-4 text-orange-600">
        <i class="fas fa-plus-circle mr-2"></i>Tambah Produk Baru
      </h3>
      
      <!-- Grid Layout untuk Form -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Kolom Kiri -->
        <div class="space-y-4">
          <!-- Nama Barang -->
          <div>
            <label class="label">
              <span class="label-text font-semibold">Nama Barang *</span>
            </label>
            <input type="text" name="nama_barang" placeholder="Masukkan nama barang" 
                   class="input input-bordered w-full border-orange-200 focus:border-orange-500 focus:ring-orange-500" required>
          </div>

          <!-- SKU -->
          <div>
            <label class="label">
              <span class="label-text font-semibold">SKU *</span>
              <span class="label-text-alt text-orange-500">Auto-generate berdasarkan kategori</span>
            </label>
            <input type="text" name="sku" id="skuInput" placeholder="Pilih kategori untuk auto-generate SKU" 
                   class="input input-bordered w-full border-orange-200 focus:border-orange-500 focus:ring-orange-500 bg-gray-50" 
                   readonly required>
          </div>

          <!-- Kategori -->
          <div>
            <label class="label">
              <span class="label-text font-semibold">Kategori *</span>
            </label>
            <select name="kategori" id="kategoriSelect" class="select select-bordered w-full border-orange-200 focus:border-orange-500 focus:ring-orange-500" required>
              <option disabled selected>Pilih kategori</option>
              <option value="makanan">Makanan</option>
              <option value="minuman">Minuman</option>
              <option value="elektronik">Elektronik</option>
              <option value="fashion">Fashion</option>
              <option value="kesehatan">Kesehatan</option>
              <option value="rumah_tangga">Rumah Tangga</option>
              <option value="olahraga">Olahraga</option>
              <option value="lainnya">Lainnya</option>
            </select>
          </div>

          <!-- Jumlah Barang -->
          <div>
            <label class="label">
              <span class="label-text font-semibold">Jumlah Barang *</span>
            </label>
            <input type="number" name="jumlah_barang" placeholder="0" min="1" 
                   class="input input-bordered w-full border-orange-200 focus:border-orange-500 focus:ring-orange-500" required>
          </div>

          <!-- Stok -->
          <div>
            <label class="label">
              <span class="label-text font-semibold">Stok *</span>
            </label>
            <input type="number" name="stok" placeholder="0" min="0" 
                   class="input input-bordered w-full border-orange-200 focus:border-orange-500 focus:ring-orange-500" required>
          </div>
        </div>

        <!-- Kolom Kanan -->
        <div class="space-y-4">
          <!-- Harga Beli -->
          <div>
            <label class="label">
              <span class="label-text font-semibold">Harga Beli (Rp) *</span>
            </label>
            <input type="number" name="harga_beli" placeholder="0" min="0" step="0.01" 
                   class="input input-bordered w-full border-orange-200 focus:border-orange-500 focus:ring-orange-500" required>
          </div>

          <!-- Harga Jual -->
          <div>
            <label class="label">
              <span class="label-text font-semibold">Harga Jual (Rp) *</span>
            </label>
            <input type="number" name="harga_jual" placeholder="0" min="0" step="0.01" 
                   class="input input-bordered w-full border-orange-200 focus:border-orange-500 focus:ring-orange-500" required>
          </div>

          <!-- Foto Produk -->
          <div>
            <label class="label">
              <span class="label-text font-semibold">Foto Produk</span>
            </label>
            <input type="file" name="foto" accept="image/*" 
                   class="file-input file-input-bordered w-full border-orange-200">
            <div class="label">
              <span class="label-text-alt text-gray-500">Format: JPG, PNG, maksimal 2MB</span>
            </div>
          </div>

          <!-- Deskripsi -->
          <div>
            <label class="label">
              <span class="label-text font-semibold">Deskripsi</span>
            </label>
            <textarea name="deskripsi" placeholder="Deskripsi produk (opsional)" 
                      class="textarea textarea-bordered w-full h-20 border-orange-200 focus:border-orange-500 focus:ring-orange-500"></textarea>
          </div>

          <!-- Status -->
          <div>
            <label class="label">
              <span class="label-text font-semibold">Status *</span>
            </label>
            <select name="status" class="select select-bordered w-full border-orange-200 focus:border-orange-500 focus:ring-orange-500" required>
              <option value="aktif" selected>Aktif</option>
              <option value="nonaktif">Nonaktif</option>
            </select>
          </div>
        </div>
      </div>

      <div class="modal-action">
        <button type="button" class="btn btn-ghost" onclick="modalTambahProduk.close()">
          <i class="fas fa-times mr-2"></i>Batal
        </button>
        <button type="submit" class="btn bg-orange-500 hover:bg-orange-600 text-white">
          <i class="fas fa-save mr-2"></i>Simpan Produk
        </button>
      </div>
    </form>
  </div>
</dialog>

<!-- Panduan Fitur Inventori -->
<div class="chart-card">
    <div class="chart-header">
        <h3 class="chart-title">
            <i class="fas fa-graduation-cap text-orange-500 mr-2"></i>Panduan Penggunaan Sistem Inventori
        </h3>
        <p class="chart-subtitle">Pelajari cara menggunakan fitur-fitur inventori dengan mudah</p>
    </div>

    <ul class="timeline timeline-snap-icon max-md:timeline-compact timeline-vertical">
        <!-- Tambah Produk -->
        <li>
            <div class="timeline-middle">
                <div class="w-8 h-8 bg-orange-400 rounded-full flex items-center justify-center shadow-sm">
                    <i class="fas fa-plus text-white text-sm"></i>
                </div>
            </div>
            <div class="timeline-start mb-10 md:text-end">
                <time class="font-medium text-orange-500 text-sm">Tambah Produk</time>
                <div class="text-lg font-semibold text-gray-800 mb-2">Menambah Produk Baru</div>
                <div class="text-gray-600 text-sm leading-relaxed">
                    Klik tombol "Tambah Produk" untuk menambahkan produk baru ke inventori. 
                    Isi informasi seperti nama produk, kategori, jumlah stok, harga beli, dan harga jual. 
                    Pastikan data yang dimasukkan akurat untuk menjaga kualitas data inventori.
                </div>
            </div>
            <hr class="border-orange-100" />
        </li>

        <!-- Kelola Stok -->
        <li>
            <hr class="border-orange-100" />
            <div class="timeline-middle">
                <div class="w-8 h-8 bg-blue-400 rounded-full flex items-center justify-center shadow-sm">
                    <i class="fas fa-boxes text-white text-sm"></i>
                </div>
            </div>
            <div class="timeline-end md:mb-10">
                <time class="font-medium text-blue-500 text-sm">Kelola Stok</time>
                <div class="text-lg font-semibold text-gray-800 mb-2">Mengelola Stok Produk</div>
                <div class="text-gray-600 text-sm leading-relaxed">
                    Pantau dan kelola stok produk dengan mudah. Gunakan fitur "Edit" 
                    untuk mengubah informasi produk atau update jumlah stok. Sistem akan otomatis 
                    menandai produk dengan stok rendah untuk membantu restock tepat waktu.
                </div>
            </div>
            <hr class="border-orange-100" />
        </li>

        <!-- Monitoring Dashboard -->
        <li>
            <hr class="border-orange-100" />
            <div class="timeline-middle">
                <div class="w-8 h-8 bg-green-400 rounded-full flex items-center justify-center shadow-sm">
                    <i class="fas fa-chart-line text-white text-sm"></i>
                </div>
            </div>
            <div class="timeline-start mb-10 md:text-end">
                <time class="font-medium text-green-500 text-sm">Dashboard</time>
                <div class="text-lg font-semibold text-gray-800 mb-2">Monitoring Dashboard</div>
                <div class="text-gray-600 text-sm leading-relaxed">
                    Gunakan dashboard untuk memantau statistik inventori. Lihat total produk, 
                    total stok, dan total nilai inventori. Dashboard memberikan gambaran 
                    menyeluruh tentang kondisi inventori secara real-time.
                </div>
            </div>
            <hr class="border-orange-100" />
        </li>

        <!-- Filter dan Pencarian -->
        <li>
            <hr class="border-orange-100" />
            <div class="timeline-middle">
                <div class="w-8 h-8 bg-purple-400 rounded-full flex items-center justify-center shadow-sm">
                    <i class="fas fa-search text-white text-sm"></i>
                </div>
            </div>
            <div class="timeline-end md:mb-10">
                <time class="font-medium text-purple-500 text-sm">Pencarian</time>
                <div class="text-lg font-semibold text-gray-800 mb-2">Filter dan Pencarian</div>
                <div class="text-gray-600 text-sm leading-relaxed">
                    Temukan produk dengan cepat menggunakan fitur pencarian dan filter. 
                    Anda dapat mencari berdasarkan nama produk, filter berdasarkan kategori, 
                    atau mengurutkan berdasarkan stok, harga, atau tanggal ditambahkan.
                </div>
            </div>
            <hr class="border-orange-100" />
        </li>

        <!-- Peringatan Stok -->
        <li>
            <hr class="border-orange-100" />
            <div class="timeline-middle">
                <div class="w-8 h-8 bg-red-400 rounded-full flex items-center justify-center shadow-sm">
                    <i class="fas fa-exclamation-triangle text-white text-sm"></i>
                </div>
            </div>
            <div class="timeline-start mb-10 md:text-end">
                <time class="font-medium text-red-500 text-sm">Peringatan</time>
                <div class="text-lg font-semibold text-gray-800 mb-2">Peringatan Stok Rendah</div>
                <div class="text-gray-600 text-sm leading-relaxed">
                    Sistem akan otomatis menampilkan peringatan stok rendah 
                    untuk produk yang stoknya kurang dari batas minimum. Gunakan informasi 
                    ini untuk melakukan pemesanan ulang dan menghindari kehabisan stok.
                </div>
            </div>
            <hr class="border-orange-100" />
        </li>

        <!-- Keamanan Data -->
        <li>
            <hr class="border-orange-100" />
            <div class="timeline-middle">
                <div class="w-8 h-8 bg-indigo-400 rounded-full flex items-center justify-center shadow-sm">
                    <i class="fas fa-shield-alt text-white text-sm"></i>
                </div>
            </div>
            <div class="timeline-end md:mb-10">
                <time class="font-medium text-indigo-500 text-sm">Keamanan</time>
                <div class="text-lg font-semibold text-gray-800 mb-2">Keamanan Data</div>
                <div class="text-gray-600 text-sm leading-relaxed">
                    Semua data inventori tersimpan dengan aman dan terbackup otomatis. 
                    Sistem dilengkapi dengan fitur keamanan tingkat tinggi untuk melindungi 
                    data bisnis dari kehilangan atau akses yang tidak sah.
                </div>
            </div>
        </li>
    </ul>

    <!-- Tips Tambahan -->
    <div class="mt-6 p-4 bg-orange-50 rounded-lg border-l-4 border-orange-400">
        <div class="flex items-start">
            <i class="fas fa-lightbulb text-orange-500 text-lg mr-3 mt-1"></i>
            <div>
                <h4 class="font-semibold text-orange-800 mb-2">Tips Penggunaan Optimal:</h4>
                <ul class="text-gray-700 space-y-1 text-sm">
                    <li>• Lakukan update stok secara berkala untuk menjaga akurasi data</li>
                    <li>• Gunakan kategori produk untuk mempermudah pengelompokan dan pencarian</li>
                    <li>• Perhatikan peringatan stok rendah dan lakukan restock sebelum kehabisan</li>
                    <li>• Manfaatkan fitur filter untuk analisis produk berdasarkan kriteria tertentu</li>
                    <li>• Backup data secara rutin untuk menjaga keamanan informasi inventori</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Alert Konfirmasi Universal -->
<div id="confirmAlert" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-mx-4 transform transition-all duration-300 scale-95 opacity-0" id="confirmModal">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center mr-3">
                    <i id="confirmIcon" class="fas fa-question-circle text-orange-500 text-lg"></i>
                </div>
                <h3 id="confirmTitle" class="text-lg font-semibold text-gray-800">Konfirmasi Aksi</h3>
            </div>
        </div>
        
        <!-- Body -->
        <div class="px-6 py-4">
            <p id="confirmMessage" class="text-gray-600 mb-4">Apakah Anda yakin ingin melanjutkan aksi ini?</p>
            <div class="bg-orange-50 border-l-4 border-orange-400 p-3 rounded">
                <div class="flex">
                    <i class="fas fa-info-circle text-orange-500 mr-2 mt-0.5"></i>
                    <p class="text-sm text-orange-700" id="confirmDetails">Pastikan data yang Anda masukkan sudah benar sebelum melanjutkan.</p>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="px-6 py-4 bg-gray-50 rounded-b-xl flex justify-end space-x-3">
            <button type="button" 
                    class="px-4 py-2 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200" 
                    onclick="hideConfirmAlert()">
                <i class="fas fa-times mr-1"></i>
                <span id="cancelText">Batalkan</span>
            </button>
            <button type="button" 
                    class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors duration-200" 
                    id="confirmButton">
                <i id="confirmButtonIcon" class="fas fa-check mr-1"></i>
                <span id="confirmButtonText">Lanjutkan</span>
            </button>
        </div>
    </div>
</div>

<!-- Alert konfirmasi khusus dengan DaisyUI style -->
<div id="daisyConfirmAlert" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div role="alert" class="alert alert-warning max-w-md transform transition-all duration-300 scale-95 opacity-0" id="daisyModal">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current h-6 w-6 shrink-0">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"></path>
        </svg>
        <div>
            <h3 class="font-bold" id="daisyTitle">Konfirmasi Aksi</h3>
            <div class="text-xs" id="daisyMessage">Apakah Anda yakin ingin melanjutkan?</div>
        </div>
        <div class="flex space-x-2">
            <button class="btn btn-sm btn-ghost" onclick="hideDaisyConfirmAlert()">
                <span id="daisyCancelText">Batalkan</span>
            </button>
            <button class="btn btn-sm btn-primary" id="daisyConfirmButton">
                <span id="daisyConfirmText">Ya, Lanjutkan</span>
            </button>
        </div>
    </div>
</div>

<!-- Floating Action Button -->

@endsection

@push('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Data dari controller
const trendData = @json($trendStokBulanan);

// Animated numbers
document.addEventListener('DOMContentLoaded', function() {
    // Animate stat numbers
    const statNumbers = document.querySelectorAll('.stat-number');
    
    statNumbers.forEach(number => {
        const originalText = number.textContent;
        const finalValue = originalText.replace(/[^\d]/g, '');
        if (finalValue && !originalText.includes('Rp')) {
            animateNumber(number, 0, parseInt(finalValue), 2000);
        }
    });
    
    // Initialize trend chart
    initTrendChart();
    
    // Auto refresh data every 30 seconds
    setInterval(refreshDashboard, 30000);
});

function animateNumber(element, start, end, duration) {
    const startTime = performance.now();
    const originalText = element.textContent;
    
    function updateNumber(currentTime) {
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1);
        
        const current = Math.floor(start + (end - start) * easeOutCubic(progress));
        
        if (originalText.includes('Rp')) {
            element.textContent = 'Rp ' + current.toLocaleString('id-ID');
        } else if (originalText.includes('%')) {
            element.textContent = current + '%';
        } else {
            element.textContent = current.toLocaleString('id-ID');
        }
        
        if (progress < 1) {
            requestAnimationFrame(updateNumber);
        }
    }
    
    requestAnimationFrame(updateNumber);
}

function easeOutCubic(t) {
    return 1 - Math.pow(1 - t, 3);
}

function initTrendChart() {
    const ctx = document.getElementById('trendChart');
    if (!ctx) return;
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: trendData.labels,
            datasets: [
                {
                    label: 'Total Stok',
                    data: trendData.stok,
                    borderColor: 'rgb(102, 126, 234)',
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: 'rgb(102, 126, 234)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 3,
                    pointRadius: 6,
                    pointHoverRadius: 8
                },
                {
                    label: 'Nilai Inventori (Rp)',
                    data: trendData.nilai,
                    borderColor: 'rgb(34, 197, 94)',
                    backgroundColor: 'rgba(34, 197, 94, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: 'rgb(34, 197, 94)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 3,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    yAxisID: 'y1'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        padding: 20,
                        font: {
                            size: 12,
                            weight: '600'
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    borderColor: 'rgba(255, 255, 255, 0.2)',
                    borderWidth: 1,
                    cornerRadius: 8,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            if (context.datasetIndex === 0) {
                                return 'Stok: ' + context.parsed.y.toLocaleString('id-ID') + ' unit';
                            } else {
                                return 'Nilai: Rp ' + context.parsed.y.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            },
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString('id-ID') + ' unit';
                        },
                        color: '#6b7280',
                        font: {
                            size: 11
                        }
                    }
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    beginAtZero: true,
                    grid: {
                        drawOnChartArea: false,
                    },
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + (value / 1000000).toFixed(1) + 'M';
                        },
                        color: '#6b7280',
                        font: {
                            size: 11
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#6b7280',
                        font: {
                            size: 11,
                            weight: '600'
                        }
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index'
            },
            elements: {
                point: {
                    hoverBackgroundColor: '#fff'
                }
            }
        }
    });
}

// Real-time data refresh
function refreshDashboard() {
    fetch('{{ route("gudang.inventori.statistics") }}')
        .then(response => response.json())
        .then(data => {
            // Update stat numbers without animation
            updateStatValue('.stat-card:nth-child(1) .stat-number', data.total_produk);
            updateStatValue('.stat-card:nth-child(2) .stat-number', data.produk_aktif);
            updateStatValue('.stat-card:nth-child(3) .stat-number', data.stok_rendah);
            updateStatValue('.stat-card:nth-child(4) .stat-number', 'Rp ' + data.total_nilai.toLocaleString('id-ID'));
            
            console.log('Dashboard data refreshed');
        })
        .catch(error => {
            console.error('Error refreshing dashboard:', error);
        });
}

function updateStatValue(selector, value) {
    const element = document.querySelector(selector);
    if (element) {
        element.textContent = typeof value === 'string' ? value : value.toLocaleString('id-ID');
    }
}

// Real-time clock
function updateTime() {
    const now = new Date();
    const options = {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    };
    const timeString = now.toLocaleDateString('id-ID', options);
    
    const elements = document.querySelectorAll('.real-time');
    elements.forEach(el => el.textContent = timeString);
}

setInterval(updateTime, 1000);
updateTime();

// Progress ring animation
document.addEventListener('DOMContentLoaded', function() {
    const progressRing = document.querySelector('.progress-ring-progress');
    if (progressRing) {
        const radius = 52;
        const circumference = 2 * Math.PI * radius;
        const percentage = {{ $persentaseProdukAktif }};
        
        progressRing.style.strokeDasharray = circumference;
        progressRing.style.strokeDashoffset = circumference;
        
        setTimeout(() => {
            const offset = circumference - (percentage / 100) * circumference;
            progressRing.style.strokeDashoffset = offset;
            progressRing.style.transition = 'stroke-dashoffset 1.5s ease-in-out';
        }, 500);
    }
});

// Tooltip initialization
document.querySelectorAll('[title]').forEach(element => {
    element.addEventListener('mouseenter', function() {
        // Simple tooltip implementation
        const tooltip = document.createElement('div');
        tooltip.textContent = this.getAttribute('title');
        tooltip.style.cssText = `
            position: absolute;
            background: rgba(0,0,0,0.8);
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            pointer-events: none;
            z-index: 1000;
            white-space: nowrap;
        `;
        document.body.appendChild(tooltip);
        
        this.addEventListener('mousemove', function(e) {
            tooltip.style.left = e.clientX + 10 + 'px';
            tooltip.style.top = e.clientY - 30 + 'px';
        });
        
        this.addEventListener('mouseleave', function() {
            document.body.removeChild(tooltip);
        });
    });
});

// ============= ALERT KONFIRMASI UNIVERSAL =============
let confirmCallback = null;

function showConfirmAlert(options = {}) {
    const {
        title = 'Konfirmasi Aksi',
        message = 'Apakah Anda yakin ingin melanjutkan aksi ini?',
        details = 'Pastikan data yang Anda masukkan sudah benar sebelum melanjutkan.',
        confirmText = 'Lanjutkan',
        cancelText = 'Batalkan',
        icon = 'fas fa-question-circle',
        iconColor = 'text-orange-500',
        confirmColor = 'bg-orange-500 hover:bg-orange-600',
        onConfirm = null
    } = options;

    // Set content
    document.getElementById('confirmTitle').textContent = title;
    document.getElementById('confirmMessage').textContent = message;
    document.getElementById('confirmDetails').textContent = details;
    document.getElementById('confirmButtonText').textContent = confirmText;
    document.getElementById('cancelText').textContent = cancelText;
    
    // Set icon
    const iconElement = document.getElementById('confirmIcon');
    iconElement.className = `${icon} ${iconColor} text-lg`;
    
    // Set button colors
    const confirmButton = document.getElementById('confirmButton');
    confirmButton.className = `px-4 py-2 ${confirmColor} text-white rounded-lg transition-colors duration-200`;
    
    // Store callback
    confirmCallback = onConfirm;
    
    // Show modal
    const alertElement = document.getElementById('confirmAlert');
    const modalElement = document.getElementById('confirmModal');
    
    alertElement.classList.remove('hidden');
    
    // Animate in
    setTimeout(() => {
        modalElement.classList.remove('scale-95', 'opacity-0');
        modalElement.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function hideConfirmAlert() {
    const alertElement = document.getElementById('confirmAlert');
    const modalElement = document.getElementById('confirmModal');
    
    // Animate out
    modalElement.classList.remove('scale-100', 'opacity-100');
    modalElement.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        alertElement.classList.add('hidden');
        confirmCallback = null;
    }, 300);
}

function showDaisyConfirmAlert(options = {}) {
    const {
        title = 'Konfirmasi Aksi',
        message = 'Apakah Anda yakin ingin melanjutkan?',
        confirmText = 'Ya, Lanjutkan',
        cancelText = 'Batalkan',
        onConfirm = null
    } = options;

    // Set content
    document.getElementById('daisyTitle').textContent = title;
    document.getElementById('daisyMessage').textContent = message;
    document.getElementById('daisyConfirmText').textContent = confirmText;
    document.getElementById('daisyCancelText').textContent = cancelText;
    
    // Store callback
    confirmCallback = onConfirm;
    
    // Show modal
    const alertElement = document.getElementById('daisyConfirmAlert');
    const modalElement = document.getElementById('daisyModal');
    
    alertElement.classList.remove('hidden');
    
    // Animate in
    setTimeout(() => {
        modalElement.classList.remove('scale-95', 'opacity-0');
        modalElement.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function hideDaisyConfirmAlert() {
    const alertElement = document.getElementById('daisyConfirmAlert');
    const modalElement = document.getElementById('daisyModal');
    
    // Animate out
    modalElement.classList.remove('scale-100', 'opacity-100');
    modalElement.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        alertElement.classList.add('hidden');
        confirmCallback = null;
    }, 300);
}

// Event listeners untuk tombol konfirmasi
document.getElementById('confirmButton').addEventListener('click', function() {
    if (confirmCallback) {
        confirmCallback();
    }
    hideConfirmAlert();
});

document.getElementById('daisyConfirmButton').addEventListener('click', function() {
    if (confirmCallback) {
        confirmCallback();
    }
    hideDaisyConfirmAlert();
});

// Close modal when clicking backdrop
document.getElementById('confirmAlert').addEventListener('click', function(e) {
    if (e.target === this) {
        hideConfirmAlert();
    }
});

document.getElementById('daisyConfirmAlert').addEventListener('click', function(e) {
    if (e.target === this) {
        hideDaisyConfirmAlert();
    }
});

// ESC key to close modal
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        hideConfirmAlert();
        hideDaisyConfirmAlert();
    }
});

// ============= MODAL TAMBAH PRODUK =============
function openTambahProdukModal() {
    modalTambahProduk.showModal();
}

// ============= AUTO-GENERATE SKU =============
const kategoriToSKU = {
    'makanan': 'MKN',
    'minuman': 'MNM',
    'elektronik': 'ELK',
    'fashion': 'FSH',
    'kesehatan': 'KSH',
    'rumah_tangga': 'RMH',
    'olahraga': 'OLH',
    'lainnya': 'LNY'
};

// Simpan counter SKU untuk setiap kategori di localStorage
function getNextSKUNumber(kategori) {
    const storageKey = `sku_counter_${kategori}`;
    let counter = localStorage.getItem(storageKey);
    
    if (!counter) {
        counter = 1;
    } else {
        counter = parseInt(counter) + 1;
    }
    
    localStorage.setItem(storageKey, counter);
    return counter.toString().padStart(4, '0');
}

// Generate SKU berdasarkan kategori
function generateSKU(kategori) {
    if (!kategori || !kategoriToSKU[kategori]) {
        return '';
    }
    
    const prefix = kategoriToSKU[kategori];
    const number = getNextSKUNumber(kategori);
    return `${prefix}-${number}`;
}

// Event listener untuk perubahan kategori
document.addEventListener('DOMContentLoaded', function() {
    const kategoriSelect = document.getElementById('kategoriSelect');
    const skuInput = document.getElementById('skuInput');
    
    if (kategoriSelect && skuInput) {
        kategoriSelect.addEventListener('change', function() {
            const selectedKategori = this.value;
            
            if (selectedKategori && selectedKategori !== '') {
                const newSKU = generateSKU(selectedKategori);
                skuInput.value = newSKU;
                skuInput.style.backgroundColor = '#f0f9ff'; // Light blue background
                skuInput.style.color = '#1e40af'; // Blue text
                
                // Tambahkan efek animasi
                skuInput.classList.add('animate-pulse');
                setTimeout(() => {
                    skuInput.classList.remove('animate-pulse');
                }, 1000);
            } else {
                skuInput.value = '';
                skuInput.style.backgroundColor = '#f9fafb'; // Default gray
                skuInput.style.color = '#6b7280'; // Default gray text
            }
        });
    }
});

// Reset modal ketika ditutup
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('modalTambahProduk');
    if (modal) {
        modal.addEventListener('close', function() {
            // Reset form
            const form = document.getElementById('tambahProdukFormDashboard');
            if (form) {
                form.reset();
                
                // Reset SKU field
                const skuInput = document.getElementById('skuInput');
                if (skuInput) {
                    skuInput.value = '';
                    skuInput.style.backgroundColor = '#f9fafb';
                    skuInput.style.color = '#6b7280';
                }
            }
        });
    }
});

// Form submission dengan konfirmasi
document.getElementById('tambahProdukFormDashboard').addEventListener('submit', function(e) {
    e.preventDefault();
    const form = this;
    
    // Ambil data form untuk preview
    const formData = new FormData(form);
    const namaBarang = formData.get('nama_barang');
    const kategori = formData.get('kategori');
    const stok = formData.get('stok');
    const hargaJual = formData.get('harga_jual');
    
    showConfirmAlert({
        title: 'Tambah Produk Baru',
        message: `Apakah Anda yakin ingin menambahkan produk "${namaBarang}" ke inventori?`,
        details: `Kategori: ${kategori} • Stok: ${stok} unit • Harga: Rp ${parseInt(hargaJual).toLocaleString('id-ID')}`,
        confirmText: 'Tambah Produk',
        cancelText: 'Batalkan',
        icon: 'fas fa-plus-circle',
        iconColor: 'text-green-500',
        confirmColor: 'bg-green-500 hover:bg-green-600',
        onConfirm: function() {
            // Tutup modal produk dulu
            modalTambahProduk.close();
            // Submit form
            form.submit();
        }
    });
});
</script>
@endpush
