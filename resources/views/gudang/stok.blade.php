@extends('layouts.appGudanng')

@section('title', 'Stok Gudang - {{ $gudang->nama_gudang }}')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-semibold">Manajemen Stok Gudang</h2>
            <p class="text-muted mb-0">{{ $gudang->nama_gudang }} - {{ $gudang->lokasi }}</p>
        </div>
        <a href="{{ route('gudang.stok.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Produk
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Filter and Search -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" 
                           placeholder="Cari nama produk..." 
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="stock_filter" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="low" {{ request('stock_filter') == 'low' ? 'selected' : '' }}>Stok Rendah</option>
                        <option value="empty" {{ request('stock_filter') == 'empty' ? 'selected' : '' }}>Stok Habis</option>
                        <option value="expiring" {{ request('stock_filter') == 'expiring' ? 'selected' : '' }}>Akan Expired</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="fas fa-search"></i> Filter
                    </button>
                </div>
                <div class="col-md-3 text-end">
                    <a href="{{ route('gudang.stok.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-refresh"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Stock Table -->
    <div class="card">
        <div class="card-body">
            @if($stoks->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Foto</th>
                                <th>Nama Produk</th>
                                <th>Satuan</th>
                                <th>Jumlah</th>
                                <th>Status Stok</th>
                                <th>Expired</th>
                                <th>Status Expired</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stoks as $stok)
                            <tr>
                                <td>{{ $stok->id_produk }}</td>
                                <td>
                                    @if($stok->foto)
                                        <img src="{{ asset('storage/' . $stok->foto) }}" 
                                             alt="{{ $stok->nama_produk }}" 
                                             class="rounded" 
                                             style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                             style="width: 50px; height: 50px;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $stok->nama_produk }}</td>
                                <td>{{ $stok->satuan }}</td>
                                <td>
                                    <span class="fw-bold">{{ number_format($stok->jumlah) }}</span>
                                </td>
                                <td>
                                    @if($stok->jumlah <= 0)
                                        <span class="badge bg-danger">Habis</span>
                                    @elseif($stok->jumlah <= 10)
                                        <span class="badge bg-warning">Stok Rendah</span>
                                    @elseif($stok->jumlah <= 50)
                                        <span class="badge bg-info">Stok Sedang</span>
                                    @else
                                        <span class="badge bg-success">Stok Tinggi</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $stok->expired ? $stok->expired->format('d/m/Y') : '-' }}
                                </td>
                                <td>
                                    @if($stok->expired)
                                        @php
                                            $daysUntilExpiry = now()->diffInDays($stok->expired, false);
                                        @endphp
                                        @if($daysUntilExpiry < 0)
                                            <span class="badge bg-danger">Expired</span>
                                        @elseif($daysUntilExpiry <= 7)
                                            <span class="badge bg-warning">Akan Expired</span>
                                        @elseif($daysUntilExpiry <= 30)
                                            <span class="badge bg-info">Perlu Perhatian</span>
                                        @else
                                            <span class="badge bg-success">Aman</span>
                                        @endif
                                    @else
                                        <span class="badge bg-secondary">-</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('gudang.stok.show', $stok) }}" 
                                           class="btn btn-sm btn-outline-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('gudang.stok.edit', $stok) }}" 
                                           class="btn btn-sm btn-outline-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-danger"
                                                onclick="deleteStock({{ $stok->id_produk }})">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $stoks->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                    <h5>Belum ada data stok</h5>
                    <p class="text-muted">Mulai tambahkan produk ke stok gudang Anda.</p>
                    <a href="{{ route('gudang.stok.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Produk Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus produk ini dari stok gudang?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function deleteStock(id) {
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = `/gudang/stok/${id}`;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }
</script>
@endpush