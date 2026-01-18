<?php
include '../../init.php';
include '../../service/auth.php';
require_once '../../repository/Perusahaan.php';

// 1. Ambil ID dari URL
if (!isset($_GET['id'])) {
    header("Location: " . BASE_URL . "layout/read/data_perusahaan.php");
    exit;
}

$id = $_GET['id'];

// 2. Panggil fungsi delete di Repository
// Pastikan di dalam Perusahaan::delete($id) juga menghapus id_user terkait jika perlu
$result = Perusahaan::delete($id);

// 3. Redirect kembali ke halaman data dengan parameter status
if ($result['status']) {
    // Berhasil hapus
    header("Location: " . BASE_URL . "layout/read/data_perusahaan.php?success=delete");
} else {
    // Gagal hapus
    header("Location: " . BASE_URL . "layout/read/data_perusahaan.php?error=" . urlencode($result['msg']));
}
exit;