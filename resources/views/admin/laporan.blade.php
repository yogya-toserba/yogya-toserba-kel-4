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
            <!--<div class="btn-group">
                <button class="btn btn-primary" id="exportPdfBtn" onclick="exportToPDF()">
                    <i class="fas fa-file-pdf me-2"></i>Export PDF
                </button>
                <button class="btn btn-outline-success" id="exportExcelBtn" onclick="exportToExcel()">
                    <i class="fas fa-file-excel me-2"></i>Export Excel
                </button>
            </div>-->
        </div>
    </div>

<div class="card-custom">
    <div class="card-header">
        <h5 class="card-title mb-0"><i class="fas fa-file-alt me-2"></i>Generator Laporan Keuangan</h5>
    </div>
    <div class="card-body">

        <!-- Filter Laporan -->
        <form id="laporanForm" method="GET" action="{{ route('admin.laporan') }}">
        <div class="row mb-4" style="background: var(--light-bg); padding: 25px; border-radius: 12px; border: 1px solid var(--border-color);">
            <div class="col-md-3">
                <label class="form-label fw-bold">Jenis Laporan:</label>
                <select class="form-select" id="jenisLaporan" name="jenis_laporan" style="border: 2px solid #e9ecef; border-radius: 8px; padding: 12px 15px; font-weight: 500;">
                    <option value="">Pilih Laporan</option>
                    <option value="neraca" {{ request('jenis_laporan') == 'neraca' ? 'selected' : '' }}>Neraca</option>
                    <option value="laba_rugi" {{ request('jenis_laporan') == 'laba_rugi' ? 'selected' : '' }}>Laporan Laba Rugi</option>
                    <option value="arus_kas" {{ request('jenis_laporan') == 'arus_kas' ? 'selected' : '' }}>Laporan Arus Kas</option>
                    <option value="ekuitas" {{ request('jenis_laporan') == 'ekuitas' ? 'selected' : '' }}>Perubahan Ekuitas</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Periode:</label>
                <input type="month" class="form-control" id="periode" name="periode" value="{{ request('periode', date('Y-m')) }}">
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Tampilkan</button>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="button" class="btn btn-success w-100" onclick="exportToPDF()">Export PDF</button>
            </div>
        </div>
        </form>

        <!-- Tabel Laporan -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Keterangan</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                        <th>Saldo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Kas</td>
                        <td>Rp50.000.000</td>
                        <td>-</td>
                        <td>Rp50.000.000</td>
                    </tr>
                    <tr>
                        <td>Piutang Usaha</td>
                        <td>Rp20.000.000</td>
                        <td>-</td>
                        <td>Rp70.000.000</td>
                    </tr>
                    <tr>
                        <td>Pendapatan Penjualan</td>
                        <td>-</td>
                        <td>Rp80.000.000</td>
                        <td>-Rp10.000.000</td>
                    </tr>
                    <tr>
                        <td>Beban Operasional</td>
                        <td>Rp5.000.000</td>
                        <td>-</td>
                        <td>-Rp15.000.000</td>
                    </tr>
                </tbody>
                <tfoot class="table-secondary">
                    <tr>
                        <th>Total</th>
                        <th>Rp75.000.000</th>
                        <th>Rp80.000.000</th>
                        <th>Rp5.000.000</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Fungsi Export PDF
function exportToPDF() {
    const jenisLaporan = document.getElementById('jenisLaporan').value;
    const periode = document.getElementById('periode').value;
    
    if (!jenisLaporan) {
        alert('Silakan pilih jenis laporan terlebih dahulu!');
        return;
    }
    
    // Show loading state
    const btnPDF = document.getElementById('exportPdfBtn');
    const originalText = btnPDF.innerHTML;
    btnPDF.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Generating PDF...';
    btnPDF.disabled = true;
    
    // Build URL with parameters
    let url = '{{ route("admin.keuangan.export.pdf") }}';
    const params = new URLSearchParams();
    
    if (jenisLaporan) params.append('jenis_laporan', jenisLaporan);
    if (periode) params.append('periode', periode);
    
    if (params.toString()) {
        url += '?' + params.toString();
    }
    
    // Open PDF in new tab
    window.open(url, '_blank');
    
    // Reset button after 2 seconds
    setTimeout(() => {
        btnPDF.innerHTML = originalText;
        btnPDF.disabled = false;
    }, 2000);
}

// Fungsi Export Excel
function exportToExcel() {
    const jenisLaporan = document.getElementById('jenisLaporan').value;
    const periode = document.getElementById('periode').value;
    
    if (!jenisLaporan) {
        alert('Silakan pilih jenis laporan terlebih dahulu!');
        return;
    }
    
    // Show loading state
    const btnExcel = document.getElementById('exportExcelBtn');
    const originalText = btnExcel.innerHTML;
    btnExcel.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Generating Excel...';
    btnExcel.disabled = true;
    
    // Build URL with parameters (untuk future implementation)
    let url = '{{ route("admin.keuangan.export.pdf") }}';
    const params = new URLSearchParams();
    
    if (jenisLaporan) params.append('jenis_laporan', jenisLaporan);
    if (periode) params.append('periode', periode);
    params.append('format', 'excel'); // Add format parameter
    
    if (params.toString()) {
        url += '?' + params.toString();
    }
    
    // For now, show alert (until Excel export is implemented)
    alert('Fitur Export Excel sedang dalam pengembangan. Silakan gunakan Export PDF terlebih dahulu.');
    
    // Reset button
    setTimeout(() => {
        btnExcel.innerHTML = originalText;
        btnExcel.disabled = false;
    }, 1000);
}

// Auto-submit form when filters change (optional)
document.getElementById('jenisLaporan').addEventListener('change', function() {
    if (this.value) {
        // Optional: auto-submit form when jenis laporan changes
        // document.getElementById('laporanForm').submit();
    }
});

document.getElementById('periode').addEventListener('change', function() {
    if (this.value && document.getElementById('jenisLaporan').value) {
        // Optional: auto-submit form when periode changes
        // document.getElementById('laporanForm').submit();
    }
});
</script>
@endpush
