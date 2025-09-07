<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip Gaji - {{ $gaji->karyawan->nama }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            font-size: 12px;
            line-height: 1.4;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }

        .company-name {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .slip-title {
            font-size: 16px;
            font-weight: bold;
            margin-top: 10px;
        }

        .periode {
            font-size: 14px;
            color: #666;
        }

        .detail-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .detail-table th,
        .detail-table td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .detail-table th {
            background-color: #f5f5f5;
            font-weight: bold;
        }

        .text-right {
            text-align: right;
        }

        .total-row {
            background-color: #e9ecef;
            font-weight: bold;
        }

        .gaji-bersih {
            background-color: #d4edda;
            font-weight: bold;
            font-size: 14px;
        }

        .info-section {
            margin-bottom: 15px;
        }

        .info-title {
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
            border-bottom: 1px solid #ddd;
            padding-bottom: 3px;
        }

        .print-info {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #ddd;
            font-size: 10px;
            color: #666;
            text-align: center;
        }

        @media print {
            body {
                margin: 0;
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="company-name">MyYOGYA</div>
        <div class="slip-title">SLIP GAJI KARYAWAN</div>
        <div class="periode">Periode: {{ \Carbon\Carbon::parse($gaji->periode_gaji . '-01')->translatedFormat('F Y') }}
        </div>
    </div>

    <!-- Informasi Karyawan -->
    <div class="info-section">
        <div class="info-title">INFORMASI KARYAWAN</div>
        <table class="detail-table">
            <tr>
                <td width="30%"><strong>Nama Karyawan</strong></td>
                <td>: {{ $gaji->karyawan->nama }}</td>
            </tr>
            <tr>
                <td><strong>ID Karyawan</strong></td>
                <td>: {{ $gaji->id_karyawan }}</td>
            </tr>
            <tr>
                <td><strong>Jabatan</strong></td>
                <td>: {{ $gaji->karyawan->jabatan->nama_jabatan ?? 'Tidak Ada' }}</td>
            </tr>
            <tr>
                <td><strong>Email</strong></td>
                <td>: {{ $gaji->karyawan->email ?? '-' }}</td>
            </tr>
        </table>
    </div>

    <!-- Detail Gaji -->
    <div class="info-section">
        <div class="info-title">DETAIL GAJI</div>
        <table class="detail-table">
            <tr>
                <td width="30%"><strong>Gaji Pokok</strong></td>
                <td class="text-right">Rp {{ number_format($gaji->gaji_pokok ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Uang Makan</strong></td>
                <td class="text-right">Rp {{ number_format($gaji->uang_makan ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Uang Transport</strong></td>
                <td class="text-right">Rp {{ number_format($gaji->uang_transport ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Uang Lembur</strong></td>
                <td class="text-right">Rp {{ number_format($gaji->uang_lembur ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr class="total-row">
                <td><strong>Total Gaji</strong></td>
                <td class="text-right">
                    <strong>Rp
                        {{ number_format(($gaji->gaji_pokok ?? 0) + ($gaji->uang_makan ?? 0) + ($gaji->uang_transport ?? 0) + ($gaji->uang_lembur ?? 0), 0, ',', '.') }}</strong>
                </td>
            </tr>
        </table>
    </div>

    <!-- Potongan -->
    <div class="info-section">
        <div class="info-title">POTONGAN</div>
        <table class="detail-table">
            <tr>
                <td width="30%"><strong>Potongan BPJS</strong></td>
                <td class="text-right">Rp {{ number_format($gaji->potongan_bpjs ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Potongan Pajak</strong></td>
                <td class="text-right">Rp {{ number_format($gaji->potongan_pajak ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr class="total-row">
                <td><strong>Total Potongan</strong></td>
                <td class="text-right">
                    <strong>Rp
                        {{ number_format(($gaji->potongan_bpjs ?? 0) + ($gaji->potongan_pajak ?? 0), 0, ',', '.') }}</strong>
                </td>
            </tr>
        </table>
    </div>

    <!-- Gaji Bersih -->
    <div class="info-section">
        <table class="detail-table">
            <tr class="gaji-bersih">
                <td width="30%"><strong>GAJI BERSIH</strong></td>
                <td class="text-right">
                    <strong>Rp {{ number_format($gaji->jumlah_gaji ?? 0, 0, ',', '.') }}</strong>
                </td>
            </tr>
        </table>
    </div>

    <!-- Status Pembayaran -->
    <div class="info-section">
        <div class="info-title">STATUS PEMBAYARAN</div>
        <table class="detail-table">
            <tr>
                <td width="30%"><strong>Status</strong></td>
                <td>
                    @if ($gaji->status_pembayaran == 'paid' || $gaji->status_pembayaran == 'sudah_dibayar')
                        : SUDAH DIBAYAR
                    @elseif($gaji->status_pembayaran == 'pending')
                        : PENDING
                    @else
                        : BELUM DIBAYAR
                    @endif
                </td>
            </tr>
            @if ($gaji->tanggal_bayar)
                <tr>
                    <td><strong>Tanggal Bayar</strong></td>
                    <td>: {{ \Carbon\Carbon::parse($gaji->tanggal_bayar)->translatedFormat('d F Y') }}</td>
                </tr>
            @endif
        </table>
    </div>

    <div class="print-info">
        Slip gaji ini digenerate secara otomatis pada {{ now()->translatedFormat('d F Y H:i:s') }}
    </div>

    <div class="no-print" style="text-align: center; margin-top: 20px;">
        <button onclick="window.print()"
            style="padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">
            Cetak Slip Gaji
        </button>
        <button onclick="window.close()"
            style="padding: 10px 20px; background: #6c757d; color: white; border: none; border-radius: 4px; cursor: pointer; margin-left: 10px;">
            Tutup
        </button>
    </div>
</body>

</html>
