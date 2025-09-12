<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip Gaji - {{ $gaji->karyawan->nama }} - {{ date('F Y', strtotime($gaji->periode_gaji)) }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background-color: white !important;
            }

            .slip-container {
                box-shadow: none !important;
                border: 1px solid #000 !important;
            }
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .slip-container {
            background-color: white;
            max-width: 800px;
            margin: 2rem auto;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .slip-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .company-logo {
            width: 80px;
            height: 80px;
            background-color: white;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .slip-body {
            padding: 2rem;
        }

        .info-section {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            border-bottom: 1px dotted #dee2e6;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 600;
            color: #6c757d;
            flex: 1;
        }

        .info-value {
            font-weight: 500;
            color: #212529;
            text-align: right;
            flex: 1;
        }

        .calculation-table {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            overflow: hidden;
        }

        .calculation-table th {
            background-color: #f8f9fa;
            font-weight: 600;
            border-bottom: 2px solid #e9ecef;
        }

        .calculation-table td {
            border-bottom: 1px solid #e9ecef;
        }

        .total-row {
            background-color: #f8f9fa;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .total-amount {
            font-size: 1.5rem;
            font-weight: bold;
            color: #28a745;
        }

        .slip-footer {
            background-color: #f8f9fa;
            padding: 1.5rem 2rem;
            border-top: 2px solid #e9ecef;
        }

        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 3rem;
        }

        .signature-box {
            text-align: center;
            min-width: 200px;
        }

        .signature-line {
            border-top: 1px solid #000;
            margin-top: 3rem;
            padding-top: 0.5rem;
        }
    </style>
</head>

<body>
    <div class="no-print text-center mb-3">
        <button onclick="window.print()" class="btn btn-primary btn-lg me-2">
            <i class="fas fa-print me-1"></i>Cetak Slip
        </button>
        <button onclick="window.close()" class="btn btn-secondary btn-lg">
            <i class="fas fa-times me-1"></i>Tutup
        </button>
    </div>

    <div class="slip-container">
        <!-- Header -->
        <div class="slip-header">
            <div class="company-logo">
                <i class="fas fa-store fa-2x text-primary"></i>
            </div>
            <h2 class="mb-2">YOGYA GROUP TOSERBA</h2>
            <p class="mb-0">Slip Gaji Karyawan</p>
            <h4 class="mt-2">{{ date('F Y', strtotime($gaji->periode_gaji)) }}</h4>
        </div>

        <div class="slip-body">
            <!-- Informasi Karyawan -->
            <div class="info-section">
                <h5 class="text-primary mb-3">
                    <i class="fas fa-user me-2"></i>
                    Informasi Karyawan
                </h5>
                <div class="info-row">
                    <span class="info-label">Nama Karyawan</span>
                    <span class="info-value">{{ $gaji->karyawan->nama }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">ID Karyawan</span>
                    <span class="info-value">{{ $gaji->karyawan->id_karyawan }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Jabatan</span>
                    <span class="info-value">{{ $gaji->karyawan->jabatan->nama_jabatan ?? 'Tidak ada jabatan' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Cabang</span>
                    <span class="info-value">{{ $gaji->karyawan->cabang->nama_cabang ?? 'Tidak ada cabang' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Email</span>
                    <span class="info-value">{{ $gaji->karyawan->email }}</span>
                </div>
            </div>

            <!-- Informasi Gaji -->
            <div class="info-section">
                <h5 class="text-primary mb-3">
                    <i class="fas fa-calendar me-2"></i>
                    Informasi Periode
                </h5>
                <div class="info-row">
                    <span class="info-label">Periode Gaji</span>
                    <span class="info-value">{{ date('F Y', strtotime($gaji->periode_gaji)) }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Tanggal Dibuat</span>
                    <span class="info-value">{{ date('d F Y', strtotime($gaji->created_at)) }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Status Pembayaran</span>
                    <span class="info-value">
                        @if ($gaji->status_pembayaran == 'paid')
                            <span class="text-success fw-bold">TERBAYAR</span>
                        @elseif($gaji->status_pembayaran == 'pending')
                            <span class="text-warning fw-bold">PENDING</span>
                        @else
                            <span class="text-secondary fw-bold">{{ strtoupper($gaji->status_pembayaran) }}</span>
                        @endif
                    </span>
                </div>
                @if ($gaji->keterangan)
                    <div class="info-row">
                        <span class="info-label">Keterangan</span>
                        <span class="info-value">{{ $gaji->keterangan }}</span>
                    </div>
                @endif
            </div>

            <!-- Rincian Gaji -->
            <div class="calculation-table">
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th colspan="2" class="text-center">
                                <i class="fas fa-calculator me-2"></i>
                                RINCIAN PERHITUNGAN GAJI
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="info-label">Gaji Pokok</td>
                            <td class="info-value">Rp {{ number_format($gaji->gaji_pokok, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="info-label">Tunjangan</td>
                            <td class="info-value">Rp {{ number_format($gaji->tunjangan, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="info-label">Bonus</td>
                            <td class="info-value">Rp {{ number_format($gaji->bonus, 0, ',', '.') }}</td>
                        </tr>
                        <tr class="table-light">
                            <td class="info-label fw-bold">Subtotal Pendapatan</td>
                            <td class="info-value fw-bold">Rp
                                {{ number_format($gaji->gaji_pokok + $gaji->tunjangan + $gaji->bonus, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr class="table-warning">
                            <td class="info-label">Potongan</td>
                            <td class="info-value text-danger">- Rp {{ number_format($gaji->potongan, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr class="total-row table-success">
                            <td class="info-label">
                                <strong>TOTAL GAJI BERSIH</strong>
                            </td>
                            <td class="info-value">
                                <span class="total-amount">Rp
                                    {{ number_format($gaji->jumlah_gaji, 0, ',', '.') }}</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Terbilang -->
            <div class="mt-3 p-3 bg-light border rounded">
                <strong>Terbilang:</strong>
                <em>{{ ucwords(\App\Helpers\NumberHelper::terbilang($gaji->jumlah_gaji) ?? 'Tidak dapat menghitung terbilang') }}
                    Rupiah</em>
            </div>
        </div>

        <!-- Footer -->
        <div class="slip-footer">
            <div class="row">
                <div class="col-6">
                    <p class="mb-1"><strong>Keterangan:</strong></p>
                    <ul class="list-unstyled small text-muted">
                        <li>• Slip gaji ini sah tanpa tanda tangan</li>
                        <li>• Mohon disimpan sebagai bukti pembayaran</li>
                        <li>• Untuk pertanyaan hubungi HRD</li>
                    </ul>
                </div>
                <div class="col-6 text-end">
                    <p class="mb-1"><strong>Dicetak pada:</strong></p>
                    <p class="small text-muted">{{ date('d F Y H:i:s') }}</p>

                    @if ($gaji->is_auto_generated)
                        <p class="small text-info mt-2">
                            <i class="fas fa-robot me-1"></i>
                            Slip ini dibuat secara otomatis oleh sistem
                        </p>
                    @endif
                </div>
            </div>

            <div class="signature-section no-print">
                <div class="signature-box">
                    <div class="signature-line">
                        <strong>HRD</strong><br>
                        <small class="text-muted">Yogya Group Toserba</small>
                    </div>
                </div>
                <div class="signature-box">
                    <div class="signature-line">
                        <strong>{{ $gaji->karyawan->nama }}</strong><br>
                        <small class="text-muted">Karyawan</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="no-print text-center mt-3 mb-4">
        <p class="text-muted">
            <i class="fas fa-info-circle me-1"></i>
            Untuk mencetak, gunakan tombol "Cetak Slip" di atas atau Ctrl+P
        </p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto focus on print button when page loads
        window.addEventListener('load', function() {
            document.querySelector('.btn-primary').focus();
        });
    </script>
</body>

</html>
