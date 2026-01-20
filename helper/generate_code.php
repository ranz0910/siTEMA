<?php

function generateLowonganManualCode($judul, $perusahaan)
{
    // Normalisasi
    $judul = strtolower(trim($judul));
    $perusahaan = strtolower(trim($perusahaan));

    // Gabung string
    $raw = $judul . '|' . $perusahaan;

    // Hash pendek
    $hash = strtoupper(substr(sha1($raw), 0, 4));

    // Tahun & bulan
    $ym = date('Ym');

    return "LM-$ym-$hash";
}
