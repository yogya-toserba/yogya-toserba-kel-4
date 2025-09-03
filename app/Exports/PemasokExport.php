<?php

namespace App\Exports;

use App\Models\Pemasok;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class PemasokExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    private $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = Pemasok::query();
        
        // Apply filters
        if (isset($this->filters['search']) && !empty($this->filters['search'])) {
            $query->search($this->filters['search']);
        }
        
        if (isset($this->filters['status']) && !empty($this->filters['status'])) {
            if ($this->filters['status'] === 'aktif') {
                $query->aktif();
            } elseif ($this->filters['status'] === 'non-aktif') {
                $query->nonAktif();
            }
        }
        
        if (isset($this->filters['kategori']) && !empty($this->filters['kategori'])) {
            $query->kategori($this->filters['kategori']);
        }
        
        if (isset($this->filters['kota']) && !empty($this->filters['kota'])) {
            $query->where('kota', 'like', '%' . $this->filters['kota'] . '%');
        }
        
        return $query->orderBy('nama_perusahaan', 'asc')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
            'Nama Perusahaan',
            'Kontak Person',
            'Telepon',
            'Email',
            'Alamat',
            'Kota',
            'Kategori Produk',
            'Tanggal Kerjasama',
            'Status',
            'Rating',
            'Catatan'
        ];
    }

    /**
     * @var Pemasok $pemasok
     */
    public function map($pemasok): array
    {
        static $no = 0;
        $no++;
        
        return [
            $no,
            $pemasok->nama_perusahaan,
            $pemasok->kontak_person,
            $pemasok->telepon,
            $pemasok->email,
            $pemasok->alamat,
            $pemasok->kota,
            $pemasok->kategori_produk,
            $pemasok->tanggal_kerjasama ? $pemasok->tanggal_kerjasama->format('d/m/Y') : '',
            ucfirst($pemasok->status),
            $pemasok->rating ? number_format($pemasok->rating, 1) : '',
            $pemasok->catatan
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style for header row
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4472C4'],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                ],
            ],
            // Style for all cells
            'A:L' => [
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_TOP,
                    'wrapText' => true,
                ],
            ],
        ];
    }
}
