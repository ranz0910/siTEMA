<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$path_koneksi = $_SERVER['DOCUMENT_ROOT'] . '/siTEMA/service/connection.php';
include($path_koneksi);

if (isset($_POST['submit_prodi'])) {
    
    // Pastikan menggunakan variabel koneksi $connect sesuai connection.php Anda
    if (!isset($connect)) {
        die("Error: Variabel \$connect tidak ditemukan.");
    }

    // Ambil data dari POST sesuai dengan name yang ada di form_edit_prodi
    $id_prodi   = mysqli_real_escape_string($connect, $_POST['id_prodi']); 
    $nama_prodi = mysqli_real_escape_string($connect, $_POST['nama_prodi']);

    // Query Update - Hanya ke tabel prodi
    $query = "UPDATE prodi SET 
                nama_prodi = '$nama_prodi' 
              WHERE id = '$id_prodi'";

    if (mysqli_query($connect, $query)) {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <body style='font-family: sans-serif;'>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data program studi telah diperbarui.',
                    showConfirmButton: false,
                    timer: 2000
                }).then(function() {
                    window.location.href = '/siTEMA/index.php?page=data_prodi';
                });
            </script>
        </body>";
        exit();
    } else {
        die("Error database: " . mysqli_error($connect));
    }
} else {
    echo "<script>window.location.href = '/siTEMA/index.php?page=data_prodi';</script>";
    exit();
}
?>