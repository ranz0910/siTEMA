<?php
session_start();
include '../../init.php';
include '../../service/auth.php';
require_once '../../repository/Prodi.php';

// Load SweetAlert
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
<body style='font-family:sans-serif;'>";

// ================= CEK LOGIN =================
if (!isset($_SESSION['user_id'])) {
    echo "<script>
        Swal.fire({
            icon: 'warning',
            title: 'Login Diperlukan!',
            text: 'Silakan login terlebih dahulu.'
        }).then(() => {
            window.location.href = '" . BASE_URL . "index.php';
        });
    </script>";
    exit;
}

$user_id = $_SESSION['user_id'];

// ================= AMBIL ID JURUSAN DARI USER =================
$q = mysqli_query($koneksi, "SELECT id FROM jurusan WHERE id_user = '$user_id' LIMIT 1");
$dataJurusan = mysqli_fetch_assoc($q);

if (!$dataJurusan) {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: 'Jurusan Anda tidak ditemukan.'
        }).then(() => {
            window.location.href = '" . BASE_URL . "layout/read/data_prodi.php';
        });
    </script>";
    exit;
}

$id_jurusan = $dataJurusan['id'];

// ================= VALIDASI ID PRODI =================
$id_prodi = $_GET['id'] ?? null;
if (!$id_prodi) {
    echo "<script>
        Swal.fire({
            icon: 'warning',
            title: 'ID Prodi Tidak Valid!',
            text: 'Tidak ada data yang dipilih.'
        }).then(() => {
            window.location.href = '" . BASE_URL . "layout/read/data_prodi.php';
        });
    </script>";
    exit;
}

// ================= DELETE =================
$result = Prodi::delete($id_prodi, $id_jurusan);

// ================= RESPONSE =================
if ($result['status']) {
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Program studi berhasil dihapus.',
            showConfirmButton: true
        }).then(() => {
            window.location.href = '" . BASE_URL . "layout/read/data_prodi.php';
        });
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
