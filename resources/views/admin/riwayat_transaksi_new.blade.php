@extends('layouts.app_admin')

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

    .stats-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: var(--shadow);
        border: none;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .stats-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
        margin-bottom: 15px;
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

    .filter-card {
        background: var(--light-bg);
        border-radius: 12px;
        padding: 25px;
        border: 1px solid var(--border-color);
        margin-bottom: 25px;
    }

    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid var(--border-color);
        padding: 12px 15px;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
    }

    .badge {
        border-radius: 6px;
        padding: 8px 12px;
        font-weight: 500;
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

    <!-- Filter Section -->
    <div class="filter-card">
        <div class="row g-3 align-items-end">
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
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label fw-bold">Cari Pelanggan:</label>
                <input type="text" id="customerSearch" name="customer" class="form-control" placeholder="Nama pelanggan...">
            </div>
        </div>
    </div>

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
                <tbody id="transactionTableBody">
                    <tr>
                        <td colspan="7" class="text-center">Loading...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    loadData();
    loadCabangOptions();

    // Event listener untuk perubahan input filter
    $('#startDate, #endDate, #minAmount, #maxAmount, #cabangFilter, #customerSearch').on('change keyup', function() {
        if (this.type === 'text' && this.value.length > 0 && this.value.length < 3) {
            return; // Tunggu minimal 3 karakter untuk pencarian customer
        }
        loadData();
    });

    function loadCabangOptions() {
        $.ajax({
            url: '{{ route("admin.keuangan.getCabang") }}',
            method: 'GET',
            success: function(response) {
                var options = '<option value="">Semua Cabang</option>';
                response.forEach(function(cabang) {
                    options += '<option value="' + cabang.id + '">' + cabang.nama_cabang + '</option>';
                });
                $('#cabangFilter').html(options);
            },
            error: function() {
                console.log('Error loading cabang options');
            }
        });
    }

    function loadData() {
        var formData = {
            start_date: $('#startDate').val(),
            end_date: $('#endDate').val(),
            min_amount: $('#minAmount').val(),
            max_amount: $('#maxAmount').val(),
            cabang: $('#cabangFilter').val(),
            customer: $('#customerSearch').val(),
            _token: '{{ csrf_token() }}'
        };

        $.ajax({
            url: '{{ route("admin.keuangan.filterRiwayatTransaksi") }}',
            method: 'POST',
            data: formData,
            beforeSend: function() {
                $('#transactionTableBody').html('<tr><td colspan="7" class="text-center">Loading...</td></tr>');
            },
            success: function(response) {
                updateTable(response.transaksi);
            },
            error: function(xhr, status, error) {
                console.log('Error:', xhr.responseText);
                $('#transactionTableBody').html('<tr><td colspan="7" class="text-center text-danger">Error loading data: ' + error + '</td></tr>');
            }
        });
    }

    function updateTable(transaksi) {
        var html = '';
        if (transaksi.length > 0) {
            transaksi.forEach(function(item, index) {
                html += '<tr>';
                html += '<td>' + item.id + '</td>';
                html += '<td>' + formatDate(item.tanggal_transaksi) + '</td>';
                html += '<td>' + (item.pelanggan ? item.pelanggan.nama : 'Guest') + '</td>';
                html += '<td>Rp ' + formatCurrency(item.total_belanja) + '</td>';
                html += '<td>' + (item.cabang ? item.cabang.nama_cabang : 'Unknown') + '</td>';
                html += '<td>' + (item.poin_didapat || 0) + '</td>';
                html += '<td>';
                html += '<button class="btn btn-info btn-sm me-1" onclick="viewDetail(' + item.id + ')">';
                html += '<i class="fas fa-eye"></i> Detail';
                html += '</button>';
                html += '</td>';
                html += '</tr>';
            });
        } else {
            html = '<tr><td colspan="7" class="text-center">Tidak ada data transaksi</td></tr>';
        }
        $('#transactionTableBody').html(html);
    }

    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID');
    }

    function formatCurrency(number) {
        return new Intl.NumberFormat('id-ID').format(number);
    }
});

function viewDetail(id) {
    // Implement detail view functionality
    alert('View detail for transaction ID: ' + id);
}
</script>
@endsection
