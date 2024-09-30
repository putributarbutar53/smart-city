<?php

if (!function_exists('convertNumberToRoman')) {
    function convertNumberToRoman($number)
    {
        $map = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            // Tambahkan lebih banyak jika diperlukan
        ];

        return $map[$number] ?? $number; // Jika angka lebih dari 10, kembalikan angka aslinya
    }
}
