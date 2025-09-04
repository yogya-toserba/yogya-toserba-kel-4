<?php

namespace App\Services;

class GajiService
{
    /**
     * Struktur gaji berdasarkan divisi/jabatan
     */
    private static $strukturGaji = [
        'HRD' => 8500000,
        'IT' => 8000000,
        'Keuangan' => 7500000,
        'Marketing' => 7000000,
        'Penjualan' => 6500000,
        'Admin' => 5500000,
        'Produksi' => 5000000,
        'Gudang' => 4500000,
        'Customer Service' => 4200000,
        'Security' => 3800000,
    ];

    /**
     * Mendapatkan gaji berdasarkan divisi
     *
     * @param string $divisi
     * @return int
     */
    public static function getGajiByDivisi($divisi)
    {
        return self::$strukturGaji[$divisi] ?? 3500000; // Default gaji minimum
    }

    /**
     * Mendapatkan semua struktur gaji
     *
     * @return array
     */
    public static function getAllStrukturGaji()
    {
        return self::$strukturGaji;
    }

    /**
     * Format currency untuk tampilan
     *
     * @param int $jumlah
     * @return string
     */
    public static function formatCurrency($jumlah)
    {
        return 'Rp ' . number_format($jumlah, 0, ',', '.');
    }
}
