{{-- Card Produk Terlaris Component --}}
<div class="card border-0 shadow-sm h-100">
    <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="fas fa-fire text-danger me-2"></i>
            {{ $title ?? 'Produk Terlaris' }}
        </h5>
        @if(isset($showPeriod) && $showPeriod)
            <small class="text-muted">{{ $periode ?? '30 hari terakhir' }}</small>
        @endif
    </div>
    <div class="card-body">
        @if(isset($produkTerlaris) && $produkTerlaris->count() > 0)
            <div class="list-group list-group-flush">
                @foreach($produkTerlaris->take($limit ?? 5) as $index => $produk)
                    <div class="list-group-item px-0 border-0">
                        <div class="d-flex align-items-center">
                            {{-- Ranking Badge --}}
                            <div class="avatar-sm me-3">
                                <div class="bg-{{ $index == 0 ? 'warning' : ($index == 1 ? 'info' : ($index == 2 ? 'success' : 'secondary')) }} bg-opacity-10 text-{{ $index == 0 ? 'warning' : ($index == 1 ? 'info' : ($index == 2 ? 'success' : 'secondary')) }} rounded-circle p-2 d-flex align-items-center justify-content-center">
                                    @if($index < 3)
                                        <i class="fas fa-{{ $index == 0 ? 'crown' : ($index == 1 ? 'medal' : 'award') }}"></i>
                                    @else
                                        <span class="fw-bold">{{ $index + 1 }}</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Product Info --}}
                            <div class="flex-grow-1">
                                <div class="fw-semibold text-truncate" style="max-width: {{ $maxWidth ?? '200px' }};" title="{{ $produk->nama_barang }}">
                                    {{ $produk->nama_barang }}
                                </div>
                                <div class="d-flex flex-wrap gap-1 mt-1">
                                    <small class="badge bg-light text-dark">{{ $produk->nama_kategori }}</small>
                                    @if(isset($showPrice) && $showPrice)
                                        <small class="text-success fw-semibold">Rp {{ number_format($produk->harga_jual ?? 0, 0, ',', '.') }}</small>
                                    @endif
                                </div>
                            </div>

                            {{-- Sales Stats --}}
                            <div class="text-end">
                                <div class="fw-bold text-{{ $index < 3 ? 'success' : 'primary' }}">
                                    {{ number_format($produk->total_terjual ?? $produk->sold ?? 0) }}
                                </div>
                                <small class="text-muted">terjual</small>
                                @if(isset($showRevenue) && $showRevenue && isset($produk->total_pendapatan))
                                    <div class="text-muted small mt-1">
                                        Rp {{ number_format($produk->total_pendapatan, 0, ',', '.') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        {{-- Progress Bar (Optional) --}}
                        @if(isset($showProgress) && $showProgress)
                            <div class="mt-2">
                                @php
                                    $maxSold = $produkTerlaris->max('total_terjual') ?? $produkTerlaris->max('sold') ?? 1;
                                    $currentSold = $produk->total_terjual ?? $produk->sold ?? 0;
                                    $percentage = $maxSold > 0 ? ($currentSold / $maxSold) * 100 : 0;
                                @endphp
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-{{ $index == 0 ? 'warning' : ($index == 1 ? 'info' : ($index == 2 ? 'success' : 'secondary')) }}" 
                                         role="progressbar" 
                                         style="width: {{ $percentage }}%"
                                         aria-valuenow="{{ $percentage }}" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            {{-- Action Buttons --}}
            @if(isset($showActions) && $showActions)
                <div class="mt-3 d-flex gap-2 justify-content-center">
                    @if(isset($showDetailButton) && $showDetailButton)
                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="loadDetailProdukTerlaris()">
                            <i class="fas fa-chart-bar me-1"></i>
                            Lihat Detail
                        </button>
                    @endif
                    
                    @if(isset($showRefreshButton) && $showRefreshButton)
                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="refreshProdukTerlaris()">
                            <i class="fas fa-sync-alt me-1"></i>
                            Refresh
                        </button>
                    @endif
                </div>
            @endif

        @else
            {{-- Empty State --}}
            <div class="text-center py-4">
                <i class="fas fa-chart-bar fa-2x text-muted mb-2"></i>
                <p class="text-muted mb-0">{{ $emptyMessage ?? 'Belum ada data transaksi' }}</p>
                @if(isset($showSeedButton) && $showSeedButton)
                    <button type="button" class="btn btn-outline-primary btn-sm mt-2" onclick="generateSampleData()">
                        <i class="fas fa-database me-1"></i>
                        Generate Sample Data
                    </button>
                @endif
            </div>
        @endif
    </div>

    {{-- Loading State --}}
    @if(isset($showLoading) && $showLoading)
        <div id="produkTerlarisLoading" class="card-img-overlay d-none bg-white bg-opacity-75 d-flex align-items-center justify-content-center">
            <div class="text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="mt-2 text-muted">Memuat data...</div>
            </div>
        </div>
    @endif
</div>

{{-- JavaScript Functions (Optional) --}}
@if(isset($includeScript) && $includeScript)
<script>
function loadDetailProdukTerlaris() {
    // Show loading
    document.getElementById('produkTerlarisLoading')?.classList.remove('d-none');
    
    fetch('{{ route('api.produk.terlaris') }}?limit=20&periode={{ $periode ?? 30 }}')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showProdukTerlarisModal(data.data);
            }
        })
        .catch(error => {
            console.error('Error loading produk terlaris:', error);
            alert('Gagal memuat data produk terlaris');
        })
        .finally(() => {
            document.getElementById('produkTerlarisLoading')?.classList.add('d-none');
        });
}

function refreshProdukTerlaris() {
    location.reload();
}

function generateSampleData() {
    if (confirm('Generate sample transaction data? This will create test transactions.')) {
        fetch('/api/generate-sample-transactions', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Sample data generated successfully!');
                location.reload();
            } else {
                alert('Failed to generate sample data: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error generating sample data:', error);
            alert('Error generating sample data');
        });
    }
}

function showProdukTerlarisModal(products) {
    let modalContent = `
        <div class="modal fade" id="produkTerlarisModal" tabindex="-1">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fas fa-fire text-danger me-2"></i>
                            Detail Produk Terlaris
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Rank</th>
                                        <th>Produk</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th>Terjual</th>
                                        <th>Transaksi</th>
                                        <th>Pendapatan</th>
                                        <th>Rata-rata</th>
                                    </tr>
                                </thead>
                                <tbody>`;
    
    products.forEach((product, index) => {
        const rankBadge = index < 3 ? 
            `<span class="badge bg-${index === 0 ? 'warning' : index === 1 ? 'info' : 'success'}">
                <i class="fas fa-${index === 0 ? 'crown' : index === 1 ? 'medal' : 'award'}"></i> ${index + 1}
            </span>` :
            `<span class="badge bg-secondary">${index + 1}</span>`;

        modalContent += `
            <tr>
                <td>${rankBadge}</td>
                <td>
                    <div class="fw-semibold">${product.nama_barang}</div>
                </td>
                <td>
                    <span class="badge bg-light text-dark">${product.nama_kategori}</span>
                </td>
                <td>Rp ${parseInt(product.harga_jual || 0).toLocaleString('id-ID')}</td>
                <td>
                    <span class="badge bg-success">${product.total_terjual || product.sold || 0}</span>
                </td>
                <td>${product.jumlah_transaksi || 0}</td>
                <td>
                    <span class="text-success fw-semibold">
                        Rp ${parseInt(product.total_pendapatan || 0).toLocaleString('id-ID')}
                    </span>
                </td>
                <td>Rp ${parseInt(product.harga_rata_rata || product.harga_jual || 0).toLocaleString('id-ID')}</td>
            </tr>`;
    });
    
    modalContent += `
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary" onclick="exportProdukTerlaris()">
                            <i class="fas fa-download me-1"></i>Export Data
                        </button>
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

function exportProdukTerlaris() {
    window.open('{{ route('api.produk.terlaris') }}?format=csv&limit=100', '_blank');
}
</script>
@endif
