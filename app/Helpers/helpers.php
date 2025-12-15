<?php

if (!function_exists('rupiah')) {
    function rupiah($angka)
    {
        return 'Rp ' . number_format($angka, 0, ',', '.');
    }
}

if (!function_exists('to_koma')) {
    function to_koma($angka)
    {
        // pastikan angka berbentuk float
        $angka = floatval($angka);

        // ubah angka menjadi format koma 1-2 desimal dulu
        $formatted = rtrim(rtrim(number_format($angka, 2, ',', ''), '0'), ',');

        return $formatted;
    }
}

if (!function_exists('ribuan')) {
    function ribuan($angka)
    {
        return number_format($angka, 0, ',', '.');
    }
}

if (!function_exists('safe_divide')) {
    function safe_divide($numerator, $denominator, $default = 0)
    {
        return $denominator != 0 ? $numerator / $denominator : $default;
    }
}
