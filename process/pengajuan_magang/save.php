<?php
include '../../init.php';
include '../../service/auth.php';
include '../../helper/generate_code.php';

if (!isset($_POST['submit_pengajuan'])) {
  header("Location: ../../layout/read/pengajuan_magang.php");
  exit;
}

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
  die('User belum login');
}

$judul_lowongan  = trim($_POST['judul_lowongan']);
$nama_perusahaan = trim($_POST['nama_perusahaan']);

if (!$judul_lowongan || !$nama_perusahaan) {
  die('Data tidak lengkap');
}

global $koneksi;

/* ================= AMBIL ID MAHASISWA ================= */
$sql_mhs = "
    SELECT id 
    FROM mahasiswa 
    WHERE id_user = ?
    LIMIT 1
";

$stmt = mysqli_prepare($koneksi, $sql_mhs);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$mhs = mysqli_fetch_assoc($res);

if (!$mhs) {
  die('Mahasiswa tidak ditemukan');
}

$id_mahasiswa = (int)$mhs['id'];

/* ================= GENERATE KODE LOWONGAN MANUAL ================= */
$id_lowongan_manual = generateLowonganManualCode(
  $judul_lowongan,
  $nama_perusahaan
);

/* ================= INSERT PENGAJUAN ================= */
$sql_insert = "
    INSERT INTO pengajuan_magang
        (id_mahasiswa, id_lowongan_manual, judul_lowongan, nama_perusahaan, status, created_at)
    VALUES
        (?, ?, ?, ?, 1, NOW())
";

$stmt = mysqli_prepare($koneksi, $sql_insert);
mysqli_stmt_bind_param(
  $stmt,
  "isss",
  $id_mahasiswa,
  $id_lowongan_manual,
  $judul_lowongan,
  $nama_perusahaan
);

if (mysqli_stmt_execute($stmt)) {
  header("Location: ../../layout/tampilan/pengajuan_magang.php?success=1");
  exit;
} else {
  die("Gagal menyimpan pengajuan");
}
