@extends('layouts.navbar_admin')

@section('title', 'Laporan Keuangan - MyYOGYA')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h3 mb-1">Laporan Keuangan</h2>
            <p class="text-muted mb-0">Generate dan analisis laporan keuangan perusahaan</p>
        </div>
        <div>
            <div class="btn-group">
                <!--<button onclick="exportPDF()" class="btn btn-primary">
                    <i class="fas fa-file-pdf me-2"></i>Export PDF
                </button>
                <button class="btn btn-outline-success" disabled>
                    <i class="fas fa-file-excel me-2"></i>Export Excel
                </button>-->
            </div>
        </div>
    </div>

<div class="card-custom">
    <div class="card-header">
        <h5 class="card-title mb-0"><i class="fas fa-file-alt me-2"></i>Generator Laporan Keuangan</h5>
    </div>
    <div class="card-body">
        <!-- Info Panel -->
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="alert alert-info border-0" style="background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%);">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle me-2 text-primary"></i>
                                <div>
                                    <strong>Filter Aktif:</strong>
                                    <span id="currentFilter" class="ms-2 badge bg-primary">
                                        {{ $kategori ? 'Kategori: ' . $kategori : 'Semua Kategori' }} | 
                                        {{ ucfirst(str_replace('_', ' ', $periode)) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-end">
                            <small class="text-muted">
                                <i class="fas fa-clock me-1"></i>
                                <span id="lastUpdate">{{ date('H:i:s') }}</span>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Laporan -->
        <form method="GET" action="{{ route('admin.laporan') }}" id="filterForm">
            <div class="row mb-4" style="background: var(--light-bg); padding: 25px; border-radius: 12px; border: 1px solid var(--border-color);">
                <div class="col-md-3">
                    <label class="form-label fw-bold">Jenis Laporan:</label>
                    <select name="kategori" id="kategoriSelect" class="form-select" onchange="filterLaporan()" style="border: 2px solid #e9ecef; border-radius: 8px; padding: 12px 15px; font-weight: 500;">
                        <option value="">Laporan Keseluruhan</option>
                        @foreach($kategoriList as $kat)
                            <option value="{{ $kat }}" {{ $kategori == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Periode:</label>
                    <select name="periode" id="periodeSelect" class="form-select" onchange="filterLaporan()" style="border: 2px solid #e9ecef; border-radius: 8px; padding: 12px 15px; font-weight: 500;">
                        <option value="semua" {{ $periode == 'semua' ? 'selected' : '' }}>Semua Periode</option>
                        <option value="hari_ini" {{ $periode == 'hari_ini' ? 'selected' : '' }}>Hari Ini</option>
                        <option value="minggu_ini" {{ $periode == 'minggu_ini' ? 'selected' : '' }}>Minggu Ini</option>
                        <option value="bulan_ini" {{ $periode == 'bulan_ini' ? 'selected' : '' }}>Bulan Ini</option>
                        <option value="tahun_ini" {{ $periode == 'tahun_ini' ? 'selected' : '' }}>Tahun Ini</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="button" onclick="refreshData()" class="btn btn-primary w-100">
                        <i class="fas fa-sync-alt me-2"></i>Refresh Data
                    </button>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="button" onclick="exportPDF()" class="btn btn-success w-100">
                        <i class="fas fa-file-pdf me-2"></i>Export PDF
                    </button>
                </div>
            </div>
        </form>

        <!-- Tabel Laporan -->
        <div class="table-responsive">
            <!-- Loading Indicator -->
            <div id="loadingIndicator" class="text-center py-4" style="display: none;">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2 text-muted">Memuat data laporan...</p>
            </div>

            <table class="table table-striped table-bordered align-middle" id="laporanTable">
                <thead class="table-dark">
                    <tr>
                        <th>Keterangan</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                        <th>Saldo</th>
                    </tr>
                </thead>
                <tbody id="laporanTableBody">
                    @if($laporan && count($laporan) > 0)
                        @foreach($laporan as $row)
                            <tr>
                                <td>{{ $row->nama_kategori }}</td>
                                <td>Rp{{ number_format($row->total_pendapatan, 0, ',', '.') }}</td>
                                <td>-</td>
                                <td>Rp{{ number_format($row->total_pendapatan, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center text-muted">Tidak ada data untuk periode yang dipilih</td>
                        </tr>
                    @endif
                </tbody>
                <tfoot class="table-secondary" id="laporanTableFooter">
                    @if($laporan && count($laporan) > 0)
                    <tr>
                        <th>Total</th>
                        <th id="totalDebit">Rp{{ number_format($laporan->sum('total_pendapatan'), 0, ',', '.') }}</th>
                        <th id="totalKredit">Rp0</th>
                        <th id="totalSaldo">Rp{{ number_format($laporan->sum('total_pendapatan'), 0, ',', '.') }}</th>
                    </tr>
                    @endif
                </tfoot>
            </table>
        </div>
    </div>
</div>

<script>
// Function untuk export PDF
function exportPDF() {
    const form = document.getElementById('filterForm');
    const formData = new FormData(form);
    const params = new URLSearchParams(formData);
    const exportUrl = "{{ url('/admin/keuangan/export-pdf') }}?" + params.toString();
    window.open(exportUrl, '_blank');
}

// Function untuk filter laporan real-time
function filterLaporan() {
    const kategori = document.getElementById('kategoriSelect').value;
    const periode = document.getElementById('periodeSelect').value;
    
    // Update filter indicator
    updateFilterIndicator(kategori, periode);
    
    // Show loading indicator
    document.getElementById('loadingIndicator').style.display = 'block';
    document.getElementById('laporanTable').style.opacity = '0.5';
    
    // Make AJAX request
    fetch("{{ route('admin.keuangan.laporan') }}?" + new URLSearchParams({
        kategori: kategori,
        periode: periode,
        ajax: '1'
    }), {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        updateTable(data);
        
        // Hide loading indicator
        document.getElementById('loadingIndicator').style.display = 'none';
        document.getElementById('laporanTable').style.opacity = '1';
        
        // Update last update time
        document.getElementById('lastUpdate').textContent = new Date().toLocaleTimeString('id-ID');
        
        // Update URL without reloading page
        const newUrl = new URL(window.location);
        newUrl.searchParams.set('kategori', kategori);
        newUrl.searchParams.set('periode', periode);
        window.history.pushState({}, '', newUrl);
        
        // Show success animation
        showSuccessAnimation();
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('loadingIndicator').style.display = 'none';
        document.getElementById('laporanTable').style.opacity = '1';
        
        // Show error message
        document.getElementById('laporanTableBody').innerHTML = 
            '<tr><td colspan="4" class="text-center text-danger"><i class="fas fa-exclamation-triangle me-2"></i>Terjadi kesalahan saat memuat data</td></tr>';
    });
}

// Function untuk refresh data
function refreshData() {
    filterLaporan();
}

// Function untuk update table content
function updateTable(data) {
    const tbody = document.getElementById('laporanTableBody');
    const tfoot = document.getElementById('laporanTableFooter');
    
    if (data.laporan && data.laporan.length > 0) {
        // Update table body
        let tableHTML = '';
        let totalPendapatan = 0;
        
        data.laporan.forEach(row => {
            totalPendapatan += parseInt(row.total_pendapatan);
            tableHTML += `
                <tr>
                    <td>${row.nama_kategori}</td>
                    <td>Rp${formatNumber(row.total_pendapatan)}</td>
                    <td>-</td>
                    <td>Rp${formatNumber(row.total_pendapatan)}</td>
                </tr>
            `;
        });
        
        tbody.innerHTML = tableHTML;
        
        // Update footer
        tfoot.innerHTML = `
            <tr>
                <th>Total</th>
                <th>Rp${formatNumber(totalPendapatan)}</th>
                <th>Rp0</th>
                <th>Rp${formatNumber(totalPendapatan)}</th>
            </tr>
        `;
    } else {
        tbody.innerHTML = '<tr><td colspan="4" class="text-center text-muted">Tidak ada data untuk periode yang dipilih</td></tr>';
        tfoot.innerHTML = '';
    }
    
    // Add animation effect
    tbody.style.animation = 'fadeIn 0.5s ease-in';
}

// Function untuk format number
function formatNumber(num) {
    return parseInt(num).toLocaleString('id-ID');
}

// Function untuk update filter indicator
function updateFilterIndicator(kategori, periode) {
    const filterText = (kategori ? 'Kategori: ' + kategori : 'Semua Kategori') + ' | ' + 
                      periode.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase());
    document.getElementById('currentFilter').innerHTML = filterText;
}

// Function untuk show success animation
function showSuccessAnimation() {
    const table = document.getElementById('laporanTable');
    table.style.transform = 'scale(0.98)';
    setTimeout(() => {
        table.style.transform = 'scale(1)';
    }, 150);
}

// Add CSS animation
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .table-responsive {
        transition: opacity 0.3s ease;
    }
    
    #laporanTable {
        transition: transform 0.15s ease;
    }
    
    #loadingIndicator {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 10;
    }
    
    .alert {
        transition: all 0.3s ease;
    }
    
    .badge {
        transition: all 0.3s ease;
    }
`;
document.head.appendChild(style);
</script>
@endsection
