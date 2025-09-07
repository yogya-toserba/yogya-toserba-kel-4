<?php

namespace App\Exports;

use App\Models\Pemasok;

/**
 * Export class untuk data Pemasok
 * NOTE: Membutuhkan package maatwebsite/excel untuk berfungsi
 * Install dengan: composer require maatwebsite/excel
 */
class PemasokExport
{
  private $filters;

  public function __construct($filters = [])
  {
    $this->filters = $filters;
  }

  /**
   * Get data collection untuk export
   * @return \Illuminate\Support\Collection
   */
  public function collection()
  {
    $query = Pemasok::with('user');

    // Apply filters
    if (isset($this->filters['search']) && !empty($this->filters['search'])) {
      $search = $this->filters['search'];
      $query->where(function ($q) use ($search) {
        $q->where('nama_perusahaan', 'like', "%{$search}%")
          ->orWhere('kontak_person', 'like', "%{$search}%")
          ->orWhere('alamat', 'like', "%{$search}%")
          ->orWhere('telepon', 'like', "%{$search}%")
          ->orWhere('email', 'like', "%{$search}%");
      });
    }

    if (isset($this->filters['status']) && !empty($this->filters['status'])) {
      $query->where('status', $this->filters['status']);
    }

    if (isset($this->filters['kategori']) && !empty($this->filters['kategori'])) {
      $query->where('kategori_produk', 'like', '%' . $this->filters['kategori'] . '%');
    }

    if (isset($this->filters['kota']) && !empty($this->filters['kota'])) {
      $query->where('kota', 'like', '%' . $this->filters['kota'] . '%');
    }

    return $query->orderBy('nama_perusahaan', 'asc')->get();
  }

  /**
   * Get headings untuk export
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
      'Catatan',
      'Username Login',
      'Email Login',
      'Nama PIC Login',
      'Telepon PIC',
      'Status Akun',
      'Terakhir Login',
      'Dibuat Pada'
    ];
  }

  /**
   * Map data untuk export
   * @param $pemasok
   * @return array
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
      $pemasok->catatan,
      // Data akun login
      $pemasok->user ? $pemasok->user->username : 'Belum dibuat',
      $pemasok->user ? $pemasok->user->email : 'Belum dibuat',
      $pemasok->user ? $pemasok->user->nama_lengkap : 'Belum dibuat',
      $pemasok->user ? $pemasok->user->telepon : 'Belum dibuat',
      $pemasok->user ? ucfirst($pemasok->user->status) : 'Belum dibuat',
      $pemasok->user && $pemasok->user->last_login ? $pemasok->user->last_login->format('d/m/Y H:i') : 'Belum login',
      $pemasok->created_at->format('d/m/Y H:i')
    ];
  }

  /**
   * Get data as array untuk manual export (fallback)
   * @return array
   */
  public function toArray(): array
  {
    $data = [];
    $data[] = $this->headings();

    foreach ($this->collection() as $pemasok) {
      $data[] = $this->map($pemasok);
    }

    return $data;
  }

  /**
   * Generate CSV content
   * @return string
   */
  public function toCsv(): string
  {
    $csv = '';
    $data = $this->toArray();

    foreach ($data as $row) {
      $csv .= '"' . implode('","', $row) . '"' . "\n";
    }

    return $csv;
  }
}
