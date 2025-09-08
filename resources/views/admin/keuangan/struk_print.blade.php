<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi #{{ $transaksi->id_transaksi }}</title>
    <style>
        body {
            font-family: 'Courier New', monospace;
            margin: 20px;
            line-height: 1.4;
        }
        .struk-container {
            max-width: 350px;
            margin: 0 auto;
            border: 1px solid #000;
            padding: 15px;
        }
        .header {
            text-align: center;
            border-bottom: 1px dashed #000;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
        .header h2 {
            margin: 0;
            font-size: 18px;
        }
        .header p {
            margin: 5px 0;
            font-size: 12px;
        }
        .info-section {
            margin-bottom: 10px;
            font-size: 12px;
        }
        .info-section p {
            margin: 3px 0;
        }
        .items-section {
            border-top: 1px dashed #000;
            border-bottom: 1px dashed #000;
            padding: 10px 0;
            margin: 10px 0;
        }
        .items-table {
            width: 100%;
            font-size: 11px;
        }
        .items-table td {
            padding: 2px 0;
        }
        .total-section {
            text-align: right;
            margin: 10px 0;
            font-size: 12px;
        }
        .total-section p {
            margin: 3px 0;
        }
        .footer {
            text-align: center;
            margin-top: 15px;
            font-size: 10px;
        }
        .footer p {
            margin: 3px 0;
        }
    </style>
</head>
<body onload="window.print(); window.close();">
    <div class="struk-container">
        <div class="header">
            <h2>YOGYA TOSERBA</h2>
            <p>{{ $transaksi->nama_cabang }}</p>
            <p>Jl. Contoh No. 123, Bandung</p>
            <p>Telp: (022) 123-4567</p>
        </div>
        
        <div class="info-section">
            <p><strong>No. Transaksi:</strong> #{{ $transaksi->id_transaksi }}</p>
            <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d/m/Y H:i') }}</p>
            <p><strong>Pelanggan:</strong> {{ $transaksi->nama_pelanggan }}</p>
            <p><strong>Kasir:</strong> Admin</p>
        </div>
        
        <div class="items-section">
            @if($detailTransaksi && count($detailTransaksi) > 0)
                <table class="items-table">
                    @foreach($detailTransaksi as $item)
                    <tr>
                        <td>{{ $item->nama_barang }}</td>
                        <td style="text-align: right;">{{ $item->jumlah_barang }}x{{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                        <td style="text-align: right;">{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </table>
            @else
                <p style="text-align: center; font-style: italic;">Detail produk tidak tersedia</p>
            @endif
        </div>
        
        <div class="total-section">
            @php
                $total = $transaksi->total_belanja;
                $bayar = $total + (rand(10000, 50000)); // Simulate payment amount
                $kembali = $bayar - $total;
            @endphp
            <p><strong>Total: Rp {{ number_format($total, 0, ',', '.') }}</strong></p>
            <p>Tunai: Rp {{ number_format($bayar, 0, ',', '.') }}</p>
            <p>Kembali: Rp {{ number_format($kembali, 0, ',', '.') }}</p>
        </div>
        
        <div class="footer">
            <p>Terima kasih atas kunjungan Anda!</p>
            <p>Barang yang sudah dibeli tidak dapat dikembalikan</p>
            <p>Simpan struk ini sebagai bukti pembelian</p>
            <p>{{ now()->format('d/m/Y H:i:s') }}</p>
        </div>
    </div>
</body>
</html>
