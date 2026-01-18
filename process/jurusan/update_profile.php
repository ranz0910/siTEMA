<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/siTEMA/service/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Amankan input data
    $id = mysqli_real_escape_string($connect, $_POST['id']);
    $nama_jurusan = mysqli_real_escape_string($connect, $_POST['nama_jurusan']);

    // Query Update
    $query_update = "UPDATE jurusan SET 
                     nama_jurusan = '$nama_jurusan' 
                     WHERE id = '$id'";

    if (mysqli_query($connect, $query_update)) {
        // Jika berhasil, arahkan kembali ke profil dengan pesan sukses
        header("Location: ../../index.php?page=profile_jurusan&id=$id&status=success");
    } else {
        // Jika gagal
        header("Location: ../../index.php?page=profile_jurusan&id=$id&status=error");
    }
} else {
    die("Akses ditolak.");
}
?>