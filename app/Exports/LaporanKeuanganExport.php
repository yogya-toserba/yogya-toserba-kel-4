<?php

namespace App\Exports;

class LaporanKeuanganExport
{
    protected $data;
    protected $jenisLaporan;
    protected $periode;

    public function __construct($data, $jenisLaporan, $periode)
    {
        $this->data = $data;
        $this->jenisLaporan = $jenisLaporan;
        $this->periode = $periode;
    }

    public function generateExcel()
    {
        // Create HTML table for better Excel formatting
        $html = '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; font-weight: bold; font-size: 16px; margin-bottom: 20px; }
        .info { margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background-color: #d7263d; color: white; padding: 10px; text-align: center; border: 1px solid #000; font-weight: bold; }
        td { padding: 8px; border: 1px solid #000; text-align: left; }
        .number { text-align: right; }
        .total-row { background-color: #fff3cd; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">LAPORAN KEUANGAN - YOGYA TOSERBA</div>
    <div class="info">Jenis Laporan: ' . htmlspecialchars($this->jenisLaporan) . '</div>
    <div class="info">Periode: ' . htmlspecialchars($this->periode) . '</div>
    <div class="info">Tanggal Export: ' . date('d/m/Y H:i:s') . '</div>
    
    <table>
        <thead>
            <tr>
                <th width="40%">KETERANGAN</th>
                <th width="20%">DEBIT</th>
                <th width="20%">KREDIT</th>
                <th width="20%">SALDO</th>
            </tr>
        </thead>
        <tbody>';

        // Add data rows
        foreach ($this->data as $row) {
            $html .= '<tr>
                <td>' . htmlspecialchars($row['keterangan']) . '</td>
                <td class="number">' . ($row['debit'] ? 'Rp ' . number_format($row['debit'], 0, ',', '.') : '-') . '</td>
                <td class="number">' . ($row['kredit'] ? 'Rp ' . number_format($row['kredit'], 0, ',', '.') : '-') . '</td>
                <td class="number">Rp ' . number_format($row['saldo'], 0, ',', '.') . '</td>
            </tr>';
        }

        // Add total row
        $totalDebit = array_sum(array_column($this->data, 'debit'));
        $totalKredit = array_sum(array_column($this->data, 'kredit'));
        $totalSaldo = array_sum(array_column($this->data, 'saldo'));

        $html .= '<tr class="total-row">
                <td><strong>TOTAL</strong></td>
                <td class="number"><strong>Rp ' . number_format($totalDebit, 0, ',', '.') . '</strong></td>
                <td class="number"><strong>Rp ' . number_format($totalKredit, 0, ',', '.') . '</strong></td>
                <td class="number"><strong>Rp ' . number_format($totalSaldo, 0, ',', '.') . '</strong></td>
            </tr>';

        $html .= '</tbody>
    </table>
</body>
</html>';

        return $html;
    }

    public function generateCSV()
    {
        $output = fopen('php://temp', 'w');
        
        // Add BOM for UTF-8 Excel compatibility
        fputs($output, "\xEF\xBB\xBF");
        
        // Header CSV
        fputcsv($output, ['LAPORAN KEUANGAN - YOGYA TOSERBA'], ';');
        fputcsv($output, ['Jenis Laporan: ' . $this->jenisLaporan], ';');
        fputcsv($output, ['Periode: ' . $this->periode], ';');
        fputcsv($output, ['Tanggal Export: ' . date('d/m/Y H:i:s')], ';');
        fputcsv($output, [], ';');
        
        // Column headers
        fputcsv($output, ['KETERANGAN', 'DEBIT', 'KREDIT', 'SALDO'], ';');
        
        // Data rows
        foreach ($this->data as $row) {
            fputcsv($output, [
                $row['keterangan'],
                $row['debit'] ? number_format($row['debit'], 0, ',', '.') : '0',
                $row['kredit'] ? number_format($row['kredit'], 0, ',', '.') : '0',
                number_format($row['saldo'], 0, ',', '.')
            ], ';');
        }
        
        // Total row
        $totalDebit = array_sum(array_column($this->data, 'debit'));
        $totalKredit = array_sum(array_column($this->data, 'kredit'));
        $totalSaldo = array_sum(array_column($this->data, 'saldo'));
        
        fputcsv($output, [], ';');
        fputcsv($output, [
            'TOTAL',
            number_format($totalDebit, 0, ',', '.'),
            number_format($totalKredit, 0, ',', '.'),
            number_format($totalSaldo, 0, ',', '.')
        ], ';');
        
        rewind($output);
        $csv = stream_get_contents($output);
        fclose($output);
        
        return $csv;
    }
}
