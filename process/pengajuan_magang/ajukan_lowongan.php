<?php
include '../../init.php';
include '../../service/auth.php';

$user_id     = $_SESSION['user_id'] ?? null;
$id_lowongan = $_GET['id'] ?? null;

if (!$user_id || !$id_lowongan) {
  die('Akses tidak valid');
}

global $koneksi;

/* ================= AMBIL ID MAHASISWA ================= */
$sql_mhs = "SELECT id FROM mahasiswa WHERE id_user = ? LIMIT 1";
$stmt = mysqli_prepare($koneksi, $sql_mhs);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$mhs = mysqli_fetch_assoc($res);

if (!$mhs) {
  die('Mahasiswa tidak ditemukan');
}

$id_mahasiswa = (int)$mhs['id'];

/* ================= CEK DUPLIKAT (STATUS AKTIF) ================= */
$sql_check = "
  SELECT id 
  FROM pengajuan_magang
  WHERE id_mahasiswa = ?
    AND id_lowongan_magang = ?
    AND status = 1
";
$stmt = mysqli_prepare($koneksi, $sql_check);
mysqli_stmt_bind_param($stmt, "ii", $id_mahasiswa, $id_lowongan);
mysqli_stmt_execute($stmt);
$res_check = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($res_check) > 0) {
  header("Location: " . BASE_URL . "layout/tampilan/lowongan_magang.php?duplicate=1");
  exit;
}

/* ================= INSERT PENGAJUAN ================= */
$sql_insert = "
  INSERT INTO pengajuan_magang
    (id_mahasiswa, id_lowongan_magang, status, created_at)
  VALUES
    (?, ?, 1, NOW())
";

$stmt = mysqli_prepare($koneksi, $sql_insert);
mysqli_stmt_bind_param($stmt, "ii", $id_mahasiswa, $id_lowongan);
mysqli_stmt_execute($stmt);

/* ================= REDIRECT ================= */
header("Location: " . BASE_URL . "layout/tampilan/lowongan_magang.php?success=1");
exit;
