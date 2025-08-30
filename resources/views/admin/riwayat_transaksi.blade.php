@extends('layouts.navbar_admin')

@section('title', 'Riwayat Transaksi')

@section('content')
<style>
    :root {
        --primary-color: #3498db;
        --secondary-color: #2c3e50;
        --accent-color: #e74c3c;
        --success-color: #27ae60;
        --warning-color: #f39c12;
        --info-color: #17a2b8;
        --light-bg: #f8f9fa;
        --border-color: #dee2e6;
        --text-dark: #2c3e50;
        --shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .content-header {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 30px 0;
        margin: -30px -30px 30px -30px;
        border-radius: 0 0 25px 25px;
    }

    .table-container {
        background: white;
        border-radius: 15px;
        box-shadow: var(--shadow);
        overflow: hidden;
    }

    .table {
        margin-bottom: 0;
    }

    .table thead th {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border: none;
        font-weight: 600;
        padding: 20px 15px;
        font-size: 14px;
    }

    .table tbody td {
        padding: 15px;
        vertical-align: middle;
        border-top: 1px solid var(--border-color);
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .btn-custom {
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
    }

    .btn-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
</style>

<div class="container-fluid">
    <!-- Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="m-0 fw-bold">
                        <i class="fas fa-history me-3"></i>Riwayat Transaksi
                    </h1>
                    <p class="mb-0 opacity-75">Kelola dan pantau seluruh riwayat transaksi</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <div class="d-flex justify-content-md-end gap-2">
                        <button class="btn btn-light btn-custom">
                            <i class="fas fa-download me-2"></i>Export Data
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Statistics -->
    @if(isset($totalTransaksi))
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Total Transaksi</h5>
                    <h3>{{ number_format($totalTransaksi) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Total Pendapatan</h5>
                    <h3>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5>Rata-rata per Transaksi</h5>
                    <h3>Rp {{ number_format($rataRataTransaksi, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5>Transaksi Hari Ini</h5>
                    <h3>{{ $transaksi->where('tanggal_transaksi', '>=', now()->format('Y-m-d'))->count() }}</h3>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Tabel Transaksi -->
    <div class="table-container">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Tanggal</th>
                        <th>Nama Pelanggan</th>
                        <th>Total Belanja</th>
                        <th>Cabang</th>
                        <th>Poin Didapat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($transaksi) && count($transaksi) > 0)
                        @foreach($transaksi as $trx)
                            <tr>
                                <td>{{ $trx->id_transaksi }}</td>
                                <td>{{ date('d/m/Y', strtotime($trx->tanggal_transaksi)) }}</td>
                                <td>{{ $trx->pelanggan_nama ?? 'Guest' }}</td>
                                <td>Rp{{ number_format($trx->total_belanja, 0, ',', '.') }}</td>
                                <td>{{ $trx->nama_cabang ?? 'N/A' }}</td>
                                <td>{{ $trx->poin_yang_didapatkan ?? 0 }} poin</td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="showTransactionDetail('{{ $trx->id_transaksi }}')">
                                        <i class="fas fa-eye"></i> Detail
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="text-center text-muted">Tidak ada data transaksi</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h3 mb-1">Riwayat Transaksi</h2>
            <p class="text-muted mb-0">Lacak dan kelola semua transaksi yang telah terjadi</p>
        </div>
        <div>
            <button class="btn btn-primary">
                <i class="fas fa-download me-2"></i>Export Data
            </button>
        </div>
    </div>

<div class="card-custom">
    <div class="card-header">
        <h5 class="card-title mb-0"><i class="fas fa-search me-2"></i>Filter & Pencarian Transaksi</h5>
    </div>
    <div class="card-body">

        <!-- Filter Pencarian -->
                <form id="filterForm" class="mb-4">
            <div class="row g-3 align-items-end" style="background: var(--light-bg); padding: 25px; border-radius: 12px; border: 1px solid var(--border-color);">
                <div class="col-md-2">
                    <label class="form-label fw-bold">Tanggal Mulai:</label>
                    <input type="date" id="startDate" name="start_date" class="form-control">
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-bold">Tanggal Akhir:</label>
                    <input type="date" id="endDate" name="end_date" class="form-control">
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-bold">Minimal Total:</label>
                    <input type="number" id="minAmount" name="min_amount" class="form-control" placeholder="0">
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-bold">Maksimal Total:</label>
                    <input type="number" id="maxAmount" name="max_amount" class="form-control" placeholder="999999999">
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-bold">Cabang:</label>
                    <select id="cabangFilter" name="cabang" class="form-select">
                        <option value="">Semua Cabang</option>
                        <!-- Options akan diisi via JavaScript atau dari controller -->
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-bold">Cari Pelanggan:</label>
                    <input type="text" id="customerSearch" name="customer" class="form-control" placeholder="Nama pelanggan...">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" id="filterBtn" class="btn w-100" style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); color: white; font-weight: 600;">
                        <i class="fas fa-filter me-2"></i>Filter Data
                    </button>
                </div>
            </div>
        </form>

        <!-- Loading indicator -->
        <div id="loadingIndicator" class="text-center py-3" style="display: none;">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2 text-muted">Memuat data transaksi...</p>
        </div>

        <!-- Filter status indicator -->
        <div id="filterStatus" class="mb-3" style="display: none;">
            <div class="alert alert-info d-flex align-items-center">
                <i class="fas fa-info-circle me-2"></i>
                <span id="filterInfo"></span>
                <button type="button" class="btn-close ms-auto" onclick="clearAllFilters()"></button>
            </div>
        </div>

        <!-- Tabel Riwayat Transaksi -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Tanggal</th>
                        <th>Nama Pelanggan</th>
                        <th>Total Belanja</th>
                        <th>Cabang</th>
                        <th>Poin Didapat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="transactionTableBody">
                    @if(isset($transaksi) && count($transaksi) > 0)
                        @foreach($transaksi as $trx)
                            <tr>
                                <td>{{ $trx->id_transaksi }}</td>
                                <td>{{ date('d/m/Y', strtotime($trx->tanggal_transaksi)) }}</td>
                                <td>{{ $trx->pelanggan_nama ?? 'Guest' }}</td>
                                <td>Rp{{ number_format($trx->total_belanja, 0, ',', '.') }}</td>
                                <td>{{ $trx->nama_cabang ?? 'N/A' }}</td>
                                <td>{{ $trx->poin_yang_didapatkan ?? 0 }} poin</td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="showTransactionDetail('{{ $trx->id_transaksi }}')">
                                        <i class="fas fa-eye"></i> Detail
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="text-center text-muted">Tidak ada data transaksi</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- No results message -->
        <div id="noResults" class="text-center py-5" style="display: none;">
            <i class="fas fa-search fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">Tidak ada data transaksi yang sesuai dengan filter</h5>
            <p class="text-muted">Coba ubah kriteria pencarian atau hapus beberapa filter</p>
            <button class="btn btn-outline-primary" onclick="clearAllFilters()">Reset Filter</button>
        </div>

        <!-- Pagination -->
        <nav class="mt-3">
            <ul class="pagination justify-content-end">
                <li class="page-item disabled">
                    <a class="page-link">Sebelumnya</a>
                </li>
                <li class="page-item active">
                    <a class="page-link">1</a>
                </li>
                <li class="page-item">
                    <a class="page-link">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link">Berikutnya</a>
                </li>
            </ul>
        </nav>

    </div>
</div>

<!-- Transaction Detail Modal -->
<div class="modal fade" id="transactionDetailModal" tabindex="-1" aria-labelledby="transactionDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="transactionDetailModalLabel">Detail Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="transactionDetailContent">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Real-time filtering functionality
    const filterForm = document.getElementById('filterForm');
    const startDateInput = document.getElementById('startDate');
    const endDateInput = document.getElementById('endDate');
    const statusFilter = document.getElementById('statusFilter');
    const paymentFilter = document.getElementById('paymentFilter');
    const customerSearch = document.getElementById('customerSearch');
    const filterBtn = document.getElementById('filterBtn');
    const tableBody = document.getElementById('transactionTableBody');
    const loadingIndicator = document.getElementById('loadingIndicator');
    const filterStatus = document.getElementById('filterStatus');
    const filterInfo = document.getElementById('filterInfo');
    const noResults = document.getElementById('noResults');

    // Store original table data
    const originalRows = Array.from(tableBody.querySelectorAll('tr'));

    // Add event listeners for real-time filtering
    statusFilter.addEventListener('change', applyFilters);
    paymentFilter.addEventListener('change', applyFilters);
    customerSearch.addEventListener('input', debounce(applyFilters, 300));
    startDateInput.addEventListener('change', applyFilters);
    endDateInput.addEventListener('change', applyFilters);
    filterBtn.addEventListener('click', applyFilters);

    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    function applyFilters() {
        showLoading(true);
        
        setTimeout(() => {
            const startDate = startDateInput.value;
            const endDate = endDateInput.value;
            const statusValue = statusFilter.value.toLowerCase();
            const paymentValue = paymentFilter.value.toLowerCase();
            const customerValue = customerSearch.value.toLowerCase();

            let visibleCount = 0;
            let activeFilters = [];

            originalRows.forEach(row => {
                const rowDate = row.dataset.date;
                const rowStatus = row.dataset.status.toLowerCase();
                const rowPayment = row.dataset.payment.toLowerCase();
                const rowCustomer = row.dataset.customer.toLowerCase();

                let showRow = true;

                // Date filter
                if (startDate && rowDate < startDate) showRow = false;
                if (endDate && rowDate > endDate) showRow = false;

                // Status filter
                if (statusValue && !rowStatus.includes(statusValue)) showRow = false;

                // Payment method filter
                if (paymentValue && !rowPayment.includes(paymentValue)) showRow = false;

                // Customer search
                if (customerValue && !rowCustomer.includes(customerValue)) showRow = false;

                if (showRow) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            // Build active filters info
            if (startDate) activeFilters.push(`Dari: ${formatDate(startDate)}`);
            if (endDate) activeFilters.push(`Sampai: ${formatDate(endDate)}`);
            if (statusValue) activeFilters.push(`Status: ${statusFilter.options[statusFilter.selectedIndex].text}`);
            if (paymentValue) activeFilters.push(`Pembayaran: ${paymentFilter.options[paymentFilter.selectedIndex].text}`);
            if (customerValue) activeFilters.push(`Pelanggan: "${customerValue}"`);

            updateFilterStatus(activeFilters, visibleCount);
            showLoading(false);

            // Show/hide no results message
            if (visibleCount === 0 && activeFilters.length > 0) {
                noResults.style.display = 'block';
                document.querySelector('.table-responsive').style.display = 'none';
            } else {
                noResults.style.display = 'none';
                document.querySelector('.table-responsive').style.display = 'block';
            }
        }, 300); // Simulate API delay
    }

    function showLoading(show) {
        loadingIndicator.style.display = show ? 'block' : 'none';
    }

    function updateFilterStatus(activeFilters, visibleCount) {
        if (activeFilters.length > 0) {
            filterInfo.innerHTML = `
                <strong>Filter aktif:</strong> ${activeFilters.join(', ')} 
                <br><small class="text-muted">Menampilkan ${visibleCount} dari ${originalRows.length} transaksi</small>
            `;
            filterStatus.style.display = 'block';
        } else {
            filterStatus.style.display = 'none';
        }
    }

    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID');
    }

    // Global function for clearing filters
    window.clearAllFilters = function() {
        startDateInput.value = '{{ date("Y-m-01") }}';
        endDateInput.value = '{{ date("Y-m-d") }}';
        statusFilter.value = '';
        paymentFilter.value = '';
        customerSearch.value = '';
        applyFilters();
    };

    // Transaction detail function
    window.showTransactionDetail = function(transactionId) {
        const modal = new bootstrap.Modal(document.getElementById('transactionDetailModal'));
        const content = document.getElementById('transactionDetailContent');
        
        content.innerHTML = `
            <div class="text-center py-4">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2">Memuat detail transaksi...</p>
            </div>
        `;
        
        modal.show();
        
        // Simulate API call
        setTimeout(() => {
            content.innerHTML = `
                <div class="row">
                    <div class="col-md-6">
                        <h6>Informasi Transaksi</h6>
                        <table class="table table-borderless table-sm">
                            <tr><td>No. Transaksi:</td><td><strong>${transactionId}</strong></td></tr>
                            <tr><td>Tanggal:</td><td>14 Agustus 2025</td></tr>
                            <tr><td>Status:</td><td><span class="badge bg-success">Berhasil</span></td></tr>
                            <tr><td>Metode Pembayaran:</td><td>QRIS</td></tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6>Informasi Pelanggan</h6>
                        <table class="table table-borderless table-sm">
                            <tr><td>Nama:</td><td>Pelanggan 1</td></tr>
                            <tr><td>Email:</td><td>pelanggan1@email.com</td></tr>
                            <tr><td>Telepon:</td><td>08123456789</td></tr>
                        </table>
                    </div>
                </div>
                <hr>
                <h6>Detail Pembelian</h6>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Produk A</td>
                                <td>2</td>
                                <td>Rp50.000</td>
                                <td>Rp100.000</td>
                            </tr>
                            <tr>
                                <td>Produk B</td>
                                <td>1</td>
                                <td>Rp60.000</td>
                                <td>Rp60.000</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr class="fw-bold">
                                <td colspan="3">Total</td>
                                <td>Rp160.000</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            `;
        }, 1000);
    };

    // Initialize filters on page load
    applyFilters();
});
</script>
@endsection
