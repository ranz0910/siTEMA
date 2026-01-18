<?php
include '../../init.php';
include '../../service/auth.php';
require_once '../../repository/Prodi.php';

// 1. Ambil ID dari URL
if (!isset($_GET['id'])) {
    header("Location: " . BASE_URL . "layout/read/data_prodi.php");
    exit;
}

$id = $_GET['id'];

// 2. Jalankan fungsi delete di Repository Prodi
$result = Prodi::delete($id);

// 3. Redirect kembali ke halaman data prodi dengan membawa status
if ($result['status']) {
    // Berhasil hapus
    header("Location: " . BASE_URL . "layout/read/data_prodi.php?success=delete");
} else {
    // Gagal hapus (biasanya karena relasi database/foreign key constraint)
    header("Location: " . BASE_URL . "layout/read/data_prodi.php?error=related");
}
exit;