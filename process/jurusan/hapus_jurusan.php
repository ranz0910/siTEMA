<?php
session_start();
include '../service/connection.php';

$query_jurusan = mysqli_query($koneksi, "SELECT id FROM jurusan WHERE id_user = '$user_id'");
$data_jurusan = mysqli_fetch_assoc($query_jurusan);

if ($data_jurusan) {
    $id_jurusan_admin = $data_jurusan['id'];

    // 3. Hapus dengan syarat: ID prodi cocok DAN milik jurusan si admin tersebut
    $query_hapus = "DELETE FROM prodi WHERE id = '$id_prodi' AND id_jurusan = '$id_jurusan_admin'";
    $eksekusi = mysqli_query($koneksi, $query_hapus);

    if ($eksekusi && mysqli_affected_rows($koneksi) > 0) {
        // Berhasil hapus
        header("Location: ../index.php?page=data_prodi=deleted");
    } else {
        // Gagal (mungkin ID salah atau mencoba hapus milik orang lain)
        header("Location: ../index.php?page=data_prodi=forbidden");
    }
} else {
    // User login tidak terdaftar sebagai pengelola jurusan manapun
    header("Location: ../index.php?page=data_prodi=error_role");
}
?>