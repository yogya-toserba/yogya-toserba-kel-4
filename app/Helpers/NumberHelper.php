<?php

namespace App\Helpers;

class NumberHelper
{
    public static function terbilang($angka)
    {
        $angka = abs($angka);
        $baca = array(
            "",
            "satu",
            "dua",
            "tiga",
            "empat",
            "lima",
            "enam",
            "tujuh",
            "delapan",
            "sembilan",
            "sepuluh",
            "sebelas",
            "dua belas",
            "tiga belas",
            "empat belas",
            "lima belas",
            "enam belas",
            "tujuh belas",
            "delapan belas",
            "sembilan belas"
        );

        $terbilang = "";

        if ($angka < 20) {
            $terbilang = $baca[$angka];
        } elseif ($angka < 100) {
            $terbilang = $baca[floor($angka / 10)] . " puluh " . $baca[$angka % 10];
        } elseif ($angka < 200) {
            $terbilang = "seratus " . self::terbilang($angka - 100);
        } elseif ($angka < 1000) {
            $terbilang = $baca[floor($angka / 100)] . " ratus " . self::terbilang($angka % 100);
        } elseif ($angka < 2000) {
            $terbilang = "seribu " . self::terbilang($angka - 1000);
        } elseif ($angka < 1000000) {
            $terbilang = self::terbilang(floor($angka / 1000)) . " ribu " . self::terbilang($angka % 1000);
        } elseif ($angka < 1000000000) {
            $terbilang = self::terbilang(floor($angka / 1000000)) . " juta " . self::terbilang($angka % 1000000);
        } elseif ($angka < 1000000000000) {
            $terbilang = self::terbilang(floor($angka / 1000000000)) . " milyar " . self::terbilang($angka % 1000000000);
        } elseif ($angka < 1000000000000000) {
            $terbilang = self::terbilang(floor($angka / 1000000000000)) . " trilyun " . self::terbilang($angka % 1000000000000);
        }

        return trim($terbilang);
    }
}
