<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$path_koneksi = $_SERVER['DOCUMENT_ROOT'] . '/siTEMA/service/connection.php';
include($path_koneksi);

if (isset($_POST['update_jurusan'])) {
    
    // Pastikan menggunakan variabel koneksi $connect sesuai connection.php Anda
    if (!isset($connect)) {
        die("Error: Variabel \$connect tidak ditemukan.");
    }

    // Ambil data dari POST (Username dihapus dari sini agar tidak error)
    $id             = mysqli_real_escape_string($connect, $_POST['id']); 
    $nama_jurusan   = mysqli_real_escape_string($connect, $_POST['nama_jurusan']);
    $ketua_jurusan  = mysqli_real_escape_string($connect, $_POST['ketua_jurusan']);
    $email_jurusan  = mysqli_real_escape_string($connect, $_POST['email_jurusan']);

    // Query Update - Hanya ke tabel jurusan
    $query = "UPDATE jurusan SET 
                nama_jurusan = '$nama_jurusan', 
                kajur = '$ketua_jurusan', 
                email_jurusan = '$email_jurusan' 
              WHERE id = '$id'";

    if (mysqli_query($connect, $query)) {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <body style='font-family: sans-serif;'>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data jurusan telah diperbarui.',
                    showConfirmButton: false,
                    timer: 2000
                }).then(function() {
                    window.location.href = '/siTEMA/index.php?page=data_jurusan';
                });
            </script>
        </body>";
        exit();
    } else {
        die("Error database: " . mysqli_error($connect));
    }
} else {
    echo "<script>window.location.href = '/siTEMA/index.php?page=data_jurusan';</script>";
    exit();
}
?>