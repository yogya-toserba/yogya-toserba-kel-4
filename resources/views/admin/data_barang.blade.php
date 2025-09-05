@extends('layouts.navbar_admin')

@section('title', 'Data Barang')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Data Barang</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Data Barang & Inventori</h4>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Produk</span>
                                <h4 class="mb-3">
                                    <span class="counter-value" data-target="{{ $stats['total_produk'] }}">0</span>
                                </h4>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-primary">
                                    <span class="avatar-title bg-primary rounded-circle">
                                        <i class="fas fa-box text-white font-size-16"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Stok Habis</span>
                                <h4 class="mb-3">
                                    <span class="counter-value text-danger"
                                        data-target="{{ $stats['produk_stok_habis'] }}">0</span>
                                </h4>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-danger">
                                    <span class="avatar-title bg-danger rounded-circle">
                                        <i class="fas fa-exclamation-triangle text-white font-size-16"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Stok Minimum</span>
                                <h4 class="mb-3">
                                    <span class="counter-value text-warning"
                                        data-target="{{ $stats['produk_stok_minimum'] }}">0</span>
                                </h4>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-warning">
                                    <span class="avatar-title bg-warning rounded-circle">
                                        <i class="fas fa-exclamation text-white font-size-16"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Nilai Stok</span>
                                <h4 class="mb-3">
                                    <span class="counter-value" data-target="{{ $stats['total_nilai_stok'] }}">0</span>
                                </h4>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-success">
                                    <span class="avatar-title bg-success rounded-circle">
                                        <i class="fas fa-money-bill text-white font-size-16"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products by Category -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Produk per Kategori</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-nowrap table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Kategori</th>
                                        <th>Jumlah Produk</th>
                                        <th>Total Stok</th>
                                        <th>Nilai Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($produkByKategori as $kategori)
                                        <tr>
                                            <td>{{ $kategori['kategori'] }}</td>
                                            <td>
                                                <span class="badge bg-primary rounded-pill">{{ $kategori['jumlah'] }}</span>
                                            </td>
                                            <td>{{ number_format($kategori['total_stok']) }}</td>
                                            <td>Rp {{ number_format($kategori['nilai_stok'], 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title mb-0">Daftar Produk</h4>
                            </div>
                            <div class="col-auto">
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-outline-success btn-sm">
                                        <i class="fas fa-download"></i> Export Excel
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm">
                                        <i class="fas fa-plus"></i> Tambah Produk
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Filter -->
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <select class="form-select" id="kategoriFilter">
                                    <option value="">Semua Kategori</option>
                                    @foreach ($produkByKategori as $kategori)
                                        <option value="{{ $kategori['kategori'] }}">{{ $kategori['kategori'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-select" id="stokFilter">
                                    <option value="">Semua Stok</option>
                                    <option value="habis">Stok Habis</option>
                                    <option value="minimum">Stok Minimum</option>
                                    <option value="normal">Stok Normal</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="search-box">
                                    <input type="text" class="form-control" id="searchBox"
                                        placeholder="Cari produk...">
                                    <i class="bx bx-search-alt search-icon"></i>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-nowrap table-hover mb-0" id="produkTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Kategori</th>
                                        <th>Harga Jual</th>
                                        <th>Stok</th>
                                        <th>Stok Minimum</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($produkList as $produk)
                                        <tr>
                                            <td><code>{{ $produk->id_produk }}</code></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar-xs">
                                                            <div
                                                                class="avatar-title bg-soft-primary text-primary rounded-circle font-size-16">
                                                                <i class="fas fa-box"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-0 font-size-14">{{ $produk->nama_produk }}</h6>
                                                        <p class="text-muted mb-0 font-size-12">
                                                            {{ $produk->deskripsi ?? '-' }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge bg-soft-info text-info">{{ $produk->nama_kategori ?? 'Tidak Terkategori' }}</span>
                                            </td>
                                            <td>Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</td>
                                            <td>
                                                <span class="fw-semibold">{{ number_format($produk->stok ?? 0) }}</span>
                                            </td>
                                            <td>{{ number_format($produk->stok_minimum ?? 0) }}</td>
                                            <td>
                                                @php
                                                    $stok = $produk->stok ?? 0;
                                                    $stokMin = $produk->stok_minimum ?? 0;
                                                @endphp
                                                @if ($stok <= 0)
                                                    <span class="badge bg-danger">Habis</span>
                                                @elseif($stok <= $stokMin)
                                                    <span class="badge bg-warning">Minimum</span>
                                                @else
                                                    <span class="badge bg-success">Normal</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-soft-secondary btn-sm dropdown-toggle"
                                                        type="button" data-bs-toggle="dropdown">
                                                        <i class="fas fa-ellipsis-h"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#"><i
                                                                    class="fas fa-eye"></i> Detail</a></li>
                                                        <li><a class="dropdown-item" href="#"><i
                                                                    class="fas fa-edit"></i> Edit</a></li>
                                                        <li><a class="dropdown-item" href="#"><i
                                                                    class="fas fa-plus-circle"></i> Tambah Stok</a></li>
                                                        <li>
                                                            <hr class="dropdown-divider">
                                                        </li>
                                                        <li><a class="dropdown-item text-danger" href="#"><i
                                                                    class="fas fa-trash"></i> Hapus</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border-radius: 0.375rem;
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            padding: 1rem 1.25rem;
        }

        .counter-value {
            font-weight: 600;
        }

        .search-box {
            position: relative;
        }

        .search-box .search-icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
        }

        .table th {
            font-weight: 600;
            color: #495057;
            background-color: #f8f9fa;
            border: none;
        }

        .table td {
            vertical-align: middle;
            border-color: #f1f1f1;
        }

        .badge {
            font-size: 0.75rem;
            font-weight: 500;
        }

        .avatar-xs {
            height: 2rem;
            width: 2rem;
        }

        .avatar-sm {
            height: 2.5rem;
            width: 2.5rem;
        }

        .avatar-title {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            width: 100%;
        }

        .bg-soft-primary {
            background-color: rgba(13, 110, 253, 0.1);
        }

        .bg-soft-info {
            background-color: rgba(13, 202, 240, 0.1);
        }

        .bg-soft-secondary {
            background-color: rgba(108, 117, 125, 0.1);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Search functionality
            const searchBox = document.getElementById('searchBox');
            const table = document.getElementById('produkTable');
            const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

            searchBox.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase();

                for (let i = 0; i < rows.length; i++) {
                    const row = rows[i];
                    const cells = row.getElementsByTagName('td');
                    let found = false;

                    for (let j = 0; j < cells.length; j++) {
                        if (cells[j].textContent.toLowerCase().includes(searchTerm)) {
                            found = true;
                            break;
                        }
                    }

                    row.style.display = found ? '' : 'none';
                }
            });

            // Filter functionality
            const kategoriFilter = document.getElementById('kategoriFilter');
            const stokFilter = document.getElementById('stokFilter');

            function applyFilters() {
                const kategoriValue = kategoriFilter.value;
                const stokValue = stokFilter.value;

                for (let i = 0; i < rows.length; i++) {
                    const row = rows[i];
                    const kategoriCell = row.cells[2].textContent;
                    const statusCell = row.cells[6].textContent;

                    let showRow = true;

                    // Filter by kategori
                    if (kategoriValue && !kategoriCell.includes(kategoriValue)) {
                        showRow = false;
                    }

                    // Filter by stok status
                    if (stokValue) {
                        if (stokValue === 'habis' && !statusCell.includes('Habis')) {
                            showRow = false;
                        } else if (stokValue === 'minimum' && !statusCell.includes('Minimum')) {
                            showRow = false;
                        } else if (stokValue === 'normal' && !statusCell.includes('Normal')) {
                            showRow = false;
                        }
                    }

                    row.style.display = showRow ? '' : 'none';
                }
            }

            kategoriFilter.addEventListener('change', applyFilters);
            stokFilter.addEventListener('change', applyFilters);

            // Counter animation
            const counters = document.querySelectorAll('.counter-value');
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                const duration = 1000;
                const increment = target / (duration / 16);
                let current = 0;

                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    counter.textContent = Math.floor(current).toLocaleString();
                }, 16);
            });
        });
    </script>
@endsection
