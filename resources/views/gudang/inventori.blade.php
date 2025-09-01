@extends('layouts.appInventori')

@section('content')
<style>
.inventori-menu {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%)
    min-height: 100vh;
    padding: 2rem;
}

.menu-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
}

.menu-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.4s ease;
    cursor: pointer;
    text-decoration: none;
    color: inherit;
}

.menu-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
    text-decoration: none;
    color: inherit;
}

.menu-icon {
    width: 80px;
    height: 80px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    color: white;
    margin-bottom: 1.5rem;
}

.menu-icon.primary {
    background: linear-gradient(135deg, #667eea, #764ba2);
}

.menu-icon.success {
    background: linear-gradient(135deg, #4ade80, #22c55e);
}

.menu-icon.warning {
    background: linear-gradient(135deg, #fbbf24, #f59e0b);
}

.menu-icon.info {
    background: linear-gradient(135deg, #06b6d4, #0891b2);
}

.menu-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 1rem;
}

.menu-desc {
    color: #6b7280;
    line-height: 1.6;
}

.page-header {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 20px;
    padding: 2rem;
    color: white;
    text-align: center;
}
</style>

<div class="inventori-menu">
    <div class="page-header">
        <h1 class="text-4xl font-bold mb-4">
            <i class="fas fa-warehouse mr-3"></i>Sistem Inventori
        </h1>
        <p class="text-xl opacity-90">Pilih menu untuk memulai pengelolaan inventori</p>
    </div>

    <div class="menu-grid">
        <a href="{{ route('gudang.inventori.dashboard') }}" class="menu-card">
            <div class="menu-icon primary">
                <i class="fas fa-chart-line"></i>
            </div>
            <h3 class="menu-title">Dashboard Inventori</h3>
            <p class="menu-desc">Lihat statistik, grafik, dan overview sistem inventori secara real-time dengan tampilan yang modern dan interaktif.</p>
        </a>

        <a href="{{ route('gudang.inventory.index') }}" class="menu-card">
            <div class="menu-icon success">
                <i class="fas fa-boxes"></i>
            </div>
            <h3 class="menu-title">Kelola Produk</h3>
            <p class="menu-desc">Tambah, edit, hapus, dan kelola semua produk dalam inventori dengan interface yang user-friendly.</p>
        </a>

        <a href="#" class="menu-card">
            <div class="menu-icon warning">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h3 class="menu-title">Stok Rendah</h3>
            <p class="menu-desc">Monitor dan kelola produk dengan stok rendah, dapatkan notifikasi otomatis untuk restock.</p>
        </a>

        <a href="#" class="menu-card">
            <div class="menu-icon info">
                <i class="fas fa-file-export"></i>
            </div>
            <h3 class="menu-title">Laporan</h3>
            <p class="menu-desc">Generate dan download berbagai jenis laporan inventori dalam format Excel, PDF, atau CSV.</p>
        </a>
    </div>
</div>
@endsection
