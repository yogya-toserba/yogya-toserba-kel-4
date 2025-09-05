<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Keuangan - Yogya Toserba</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 12px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }
        
        .header h1 {
            color: #d7263d;
            font-size: 24px;
            margin: 0;
            font-weight: bold;
        }
        
        .header h2 {
            color: #666;
            font-size: 16px;
            margin: 5px 0;
        }
        
        .info-section {
            margin-bottom: 20px;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
        }
        
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        
        .info-label {
            font-weight: bold;
            color: #333;
        }
        
        .table-container {
            margin-top: 20px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        th {
            background-color: #d7263d;
            color: white;
            padding: 12px 8px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #ddd;
        }
        
        td {
            padding: 10px 8px;
            border: 1px solid #ddd;
            vertical-align: top;
        }
        
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        .text-right {
            text-align: right;
        }
        
        .text-center {
            text-align: center;
        }
        
        .total-row {
            background-color: #fff3cd !important;
            font-weight: bold;
        }
        
        .total-row td {
            border-top: 2px solid #333;
            padding: 12px 8px;
        }
        
        .amount {
            font-family: 'Courier New', monospace;
            font-weight: bold;
        }
        
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }
        
        .signature-section {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }
        
        .signature-box {
            text-align: center;
            width: 200px;
        }
        
        .signature-line {
            border-bottom: 1px solid #333;
            margin-bottom: 5px;
            height: 60px;
        }
        
        @media print {
            body { 
                margin: 0; 
                -webkit-print-color-adjust: exact; 
                color-adjust: exact; 
            }
            .header h1 { color: #d7263d !important; }
            th { background-color: #d7263d !important; color: white !important; }
            .total-row { background-color: #fff3cd !important; }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>YOGYA TOSERBA</h1>
        <h2>{{ $jenisLaporan }}</h2>
    </div>

    <div class="info-section">
        <div class="info-row">
            <span class="info-label">Jenis Laporan:</span>
            <span>{{ $jenisLaporan }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Periode:</span>
            <span>{{ $periodeText }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Tanggal Dibuat:</span>
            <span>{{ date('d/m/Y H:i:s') }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Dibuat oleh:</span>
            <span>Admin</span>
        </div>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th width="40%">KETERANGAN</th>
                    <th width="20%" class="text-right">DEBIT</th>
                    <th width="20%" class="text-right">KREDIT</th>
                    <th width="20%" class="text-right">SALDO</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $row)
                <tr>
                    <td>{{ $row['keterangan'] }}</td>
                    <td class="text-right amount">
                        @if($row['debit'])
                            Rp{{ number_format($row['debit'], 0, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="text-right amount">
                        @if($row['kredit'])
                            Rp{{ number_format($row['kredit'], 0, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="text-right amount">
                        Rp{{ number_format($row['saldo'], 0, ',', '.') }}
                    </td>
                </tr>
                @endforeach
                
                <tr class="total-row">
                    <td><strong>TOTAL</strong></td>
                    <td class="text-right amount">
                        <strong>Rp{{ number_format(array_sum(array_column($data, 'debit')), 0, ',', '.') }}</strong>
                    </td>
                    <td class="text-right amount">
                        <strong>Rp{{ number_format(array_sum(array_column($data, 'kredit')), 0, ',', '.') }}</strong>
                    </td>
                    <td class="text-right amount">
                        <strong>Rp{{ number_format(array_sum(array_column($data, 'saldo')), 0, ',', '.') }}</strong>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="signature-section">
        <div class="signature-box">
            <div class="signature-line"></div>
            <strong>Manager Keuangan</strong>
        </div>
        <div class="signature-box">
            <div class="signature-line"></div>
            <strong>Direktur</strong>
        </div>
    </div>

    <div class="footer">
        <p>Dokumen ini dibuat secara otomatis oleh sistem Yogya Toserba</p>
        <p>Dicetak pada: {{ date('d/m/Y H:i:s') }}</p>
    </div>
    
    <script>
        // Auto print ketika halaman dimuat
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>