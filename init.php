<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Tambahkan ob_start agar tidak error 'headers already sent'
ob_start();

require_once __DIR__ . '/config/BaseUrlConfig.php';
require_once __DIR__ . '/service/connection.php';

// Gunakan __DIR__ untuk keamanan path
require_once __DIR__ . '/repository/jurusan.php';
require_once __DIR__ . '/repository/mahasiswa.php';
require_once __DIR__ . '/repository/perusahaan.php';
require_once __DIR__ . '/repository/prodi.php';

?>