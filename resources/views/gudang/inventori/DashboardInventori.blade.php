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
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 20px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
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
            <div class="action-card" onclick="location.href='{{ route('gudang.inventory.index') }}'">
                <div class="action-icon primary">
                    <i class="fas fa-plus"></i>
                </div>
                <div class="action-title">Tambah Produk</div>
                <div class="action-desc">Tambahkan produk baru ke inventori</div>
            </div>

            <div class="action-card" onclick="location.href='#'">
                <div class="action-icon success">
                    <i class="fas fa-search"></i>
                </div>
                <div class="action-title">Cari Produk</div>
                <div class="action-desc">Pencarian dan filter produk</div>
            </div>

            <div class="action-card" onclick="location.href='#'">
                <div class="action-icon warning">
                    <i class="fas fa-download"></i>
                </div>
                <div class="action-title">Export Data</div>
                <div class="action-desc">Download laporan inventori</div>
            </div>

            <div class="action-card" onclick="location.href='#'">
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

<!-- Floating Action Button -->
<div class="fixed bottom-6 right-6 z-50">
    <div class="relative group">
        <button class="bg-gradient-to-r from-purple-500 to-indigo-600 text-white p-4 rounded-full shadow-2xl hover:shadow-3xl transition-all duration-300 hover:scale-110 group-hover:rotate-45">
            <i class="fas fa-plus text-xl"></i>
        </button>
        
        <!-- Mini FAB Menu -->
        <div class="absolute bottom-16 right-0 space-y-3 transform scale-0 group-hover:scale-100 transition-transform duration-300 origin-bottom">
            <button class="bg-blue-500 text-white p-3 rounded-full shadow-lg hover:bg-blue-600 transition-colors" title="Tambah Produk">
                <i class="fas fa-box"></i>
            </button>
            <button class="bg-green-500 text-white p-3 rounded-full shadow-lg hover:bg-green-600 transition-colors" title="Scan Barcode">
                <i class="fas fa-qrcode"></i>
            </button>
            <button class="bg-yellow-500 text-white p-3 rounded-full shadow-lg hover:bg-yellow-600 transition-colors" title="Import Data">
                <i class="fas fa-upload"></i>
            </button>
        </div>
    </div>
</div>
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
</script>
@endpush
