@extends('layouts.navbar_admin')

@section('title', 'Hasil Pencarian - MyYOGYA Admin')

@section('page-title', 'Hasil Pencarian')
@section('page-subtitle', 'Menampilkan hasil pencarian untuk "{{ $query }}"')

@section('content')
<style>
    .search-results-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .search-header {
        background: white;
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        border-left: 4px solid var(--yogya-orange);
    }

    .search-header h4 {
        color: #2c3e50;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .search-query {
        color: var(--yogya-orange);
        font-weight: 700;
        background: rgba(242, 107, 55, 0.1);
        padding: 2px 8px;
        border-radius: 4px;
    }

    .results-section {
        margin-bottom: 40px;
    }

    .section-header {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #e9ecef;
    }

    .section-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        color: white;
        font-size: 16px;
    }

    .section-title {
        flex: 1;
        margin: 0;
        font-weight: 600;
        color: #2c3e50;
    }

    .result-count {
        background: #f8f9fa;
        color: #6c757d;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }

    .results-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }

    .result-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .result-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        border-color: var(--yogya-orange);
    }

    .result-card-header {
        display: flex;
        align-items: center;
        margin-bottom: 12px;
    }

    .result-icon {
        width: 35px;
        height: 35px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        color: white;
        font-size: 14px;
    }

    .result-title {
        font-weight: 600;
        color: #2c3e50;
        font-size: 14px;
        margin: 0;
        line-height: 1.3;
    }

    .result-details {
        color: #6c757d;
        font-size: 12px;
        line-height: 1.4;
        margin-bottom: 8px;
    }

    .result-meta {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .meta-badge {
        background: #f8f9fa;
        color: #495057;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 10px;
        font-weight: 500;
    }

    .meta-badge.price {
        background: #d4edda;
        color: #155724;
    }

    .meta-badge.stock {
        background: #cce5ff;
        color: #004085;
    }

    .meta-badge.date {
        background: #fff3cd;
        color: #856404;
    }

    .no-results {
        text-align: center;
        padding: 40px 20px;
        color: #6c757d;
    }

    .no-results i {
        font-size: 48px;
        margin-bottom: 15px;
        opacity: 0.5;
    }

    .pagination-wrapper {
        margin-top: 30px;
        display: flex;
        justify-content: center;
    }

    .back-to-search {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--yogya-orange);
        text-decoration: none;
        font-weight: 500;
        padding: 8px 16px;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .back-to-search:hover {
        background: rgba(242, 107, 55, 0.1);
        color: var(--yogya-orange);
        text-decoration: none;
    }

    @media (max-width: 768px) {
        .results-grid {
            grid-template-columns: 1fr;
        }
        
        .search-results-container {
            padding: 15px;
        }
    }
</style>

<div class="search-results-container">
    <!-- Search Header -->
    <div class="search-header">
        <div class="d-flex justify-content-between align-items-start">
            <div>
                <h4>Hasil Pencarian</h4>
                <p class="mb-0">Menampilkan hasil untuk: <span class="search-query">"{{ $query }}"</span></p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="back-to-search">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Dashboard
            </a>
        </div>
    </div>

    <!-- Produk Results -->
    @if($results['produk']->count() > 0)
    <div class="results-section">
        <div class="section-header">
            <div class="section-icon" style="background: #28a745;">
                <i class="fas fa-box"></i>
            </div>
            <h5 class="section-title">Produk</h5>
            <span class="result-count">{{ $results['produk']->total() }} hasil</span>
        </div>
        <div class="results-grid">
            @foreach($results['produk'] as $produk)
            <div class="result-card" onclick="window.location.href='{{ route('admin.analisis.barang') }}'">
                <div class="result-card-header">
                    <div class="result-icon" style="background: #28a745;">
                        <i class="fas fa-box"></i>
                    </div>
                    <h6 class="result-title">{{ $produk->nama_barang }}</h6>
                </div>
                <div class="result-details">
                    Kategori: {{ $produk->nama_kategori }}
                </div>
                <div class="result-meta">
                    <span class="meta-badge price">Rp {{ number_format($produk->harga_jual) }}</span>
                    <span class="meta-badge stock">Stok: {{ $produk->stok }}</span>
                </div>
            </div>
            @endforeach
        </div>
        <div class="pagination-wrapper">
            {{ $results['produk']->appends(['q' => $query])->links() }}
        </div>
    </div>
    @endif

    <!-- Pelanggan Results -->
    @if($results['pelanggan']->count() > 0)
    <div class="results-section">
        <div class="section-header">
            <div class="section-icon" style="background: #007bff;">
                <i class="fas fa-user"></i>
            </div>
            <h5 class="section-title">Pelanggan</h5>
            <span class="result-count">{{ $results['pelanggan']->total() }} hasil</span>
        </div>
        <div class="results-grid">
            @foreach($results['pelanggan'] as $pelanggan)
            <div class="result-card" onclick="window.location.href='{{ route('admin.analisis.pelanggan') }}'">
                <div class="result-card-header">
                    <div class="result-icon" style="background: #007bff;">
                        <i class="fas fa-user"></i>
                    </div>
                    <h6 class="result-title">{{ $pelanggan->nama_pelanggan }}</h6>
                </div>
                <div class="result-details">
                    Email: {{ $pelanggan->email }}<br>
                    Telepon: {{ $pelanggan->nomer_telepon }}
                </div>
                <div class="result-meta">
                    <span class="meta-badge">{{ $pelanggan->level_membership }}</span>
                    <span class="meta-badge date">{{ \Carbon\Carbon::parse($pelanggan->created_at)->format('d M Y') }}</span>
                </div>
            </div>
            @endforeach
        </div>
        <div class="pagination-wrapper">
            {{ $results['pelanggan']->appends(['q' => $query])->links() }}
        </div>
    </div>
    @endif

    <!-- Transaksi Results -->
    @if($results['transaksi']->count() > 0)
    <div class="results-section">
        <div class="section-header">
            <div class="section-icon" style="background: #ffc107;">
                <i class="fas fa-receipt"></i>
            </div>
            <h5 class="section-title">Transaksi</h5>
            <span class="result-count">{{ $results['transaksi']->total() }} hasil</span>
        </div>
        <div class="results-grid">
            @foreach($results['transaksi'] as $transaksi)
            <div class="result-card" onclick="window.location.href='{{ route('admin.analisis.penjualan') }}'">
                <div class="result-card-header">
                    <div class="result-icon" style="background: #ffc107;">
                        <i class="fas fa-receipt"></i>
                    </div>
                    <h6 class="result-title">Transaksi #{{ $transaksi->id_transaksi }}</h6>
                </div>
                <div class="result-details">
                    Pelanggan: {{ $transaksi->nama_pelanggan }}<br>
                    Tanggal: {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d M Y H:i') }}
                </div>
                <div class="result-meta">
                    <span class="meta-badge price">Rp {{ number_format($transaksi->total_belanja) }}</span>
                </div>
            </div>
            @endforeach
        </div>
        <div class="pagination-wrapper">
            {{ $results['transaksi']->appends(['q' => $query])->links() }}
        </div>
    </div>
    @endif

    <!-- Kategori Results -->
    @if($results['kategori']->count() > 0)
    <div class="results-section">
        <div class="section-header">
            <div class="section-icon" style="background: #6f42c1;">
                <i class="fas fa-tags"></i>
            </div>
            <h5 class="section-title">Kategori</h5>
            <span class="result-count">{{ $results['kategori']->total() }} hasil</span>
        </div>
        <div class="results-grid">
            @foreach($results['kategori'] as $kategori)
            <div class="result-card" onclick="window.location.href='{{ route('admin.analisis.barang') }}'">
                <div class="result-card-header">
                    <div class="result-icon" style="background: #6f42c1;">
                        <i class="fas fa-tags"></i>
                    </div>
                    <h6 class="result-title">{{ $kategori->nama_kategori }}</h6>
                </div>
                <div class="result-details">
                    Kategori produk
                </div>
            </div>
            @endforeach
        </div>
        <div class="pagination-wrapper">
            {{ $results['kategori']->appends(['q' => $query])->links() }}
        </div>
    </div>
    @endif

    <!-- No Results -->
    @if($results['produk']->count() == 0 && $results['pelanggan']->count() == 0 && $results['transaksi']->count() == 0 && $results['kategori']->count() == 0)
    <div class="no-results">
        <i class="fas fa-search"></i>
        <h5>Tidak ada hasil ditemukan</h5>
        <p>Coba gunakan kata kunci yang berbeda atau lebih spesifik.</p>
        <a href="{{ route('admin.dashboard') }}" class="back-to-search mt-3">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Dashboard
        </a>
    </div>
    @endif
</div>
@endsection
