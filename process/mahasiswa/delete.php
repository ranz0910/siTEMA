<?php
session_start();
include '../../init.php';
include '../../service/auth.php';
require_once '../../repository/Mahasiswa.php';

// ================= VALIDASI ROLE/LOGIN =================
if (!isset($_SESSION['user_id'])) {
    header("Location: " . BASE_URL . "index.php");
    exit;
}

// ================= AMBIL ID MAHASISWA =================
$id_mahasiswa = $_GET['id'] ?? null;
if (!$id_mahasiswa) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'ID Tidak Valid!',
            text: 'Tidak ada data yang dipilih.'
        }).then(() => window.location.href='" . BASE_URL . "layout/read/data_mahasiswa.php');
    </script>";
    exit;
}

// ================= SWEETALERT =================
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
<body style='font-family:sans-serif;'>";

// ================= DELETE MAHASISWA =================
$result = Mahasiswa::delete($id_mahasiswa);

if ($result['status']) {
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Data mahasiswa berhasil dihapus.',
            showConfirmButton: true
        }).then(() => window.location.href='" . BASE_URL . "layout/read/data_mahasiswa.php');
    </script>";
} else {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{$result['msg']}'
        }).then(() => window.history.back());
    </script>";
}

echo "</body>";
