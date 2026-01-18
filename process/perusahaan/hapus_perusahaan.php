<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$path_koneksi = $_SERVER['DOCUMENT_ROOT'] . '/siTEMA/service/connection.php';

if (file_exists($path_koneksi)) {
    include($path_koneksi);
} else {
    die("Error: File koneksi tidak ditemukan di: " . $path_koneksi);
}

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($connect, $_GET['id']);

    // Query untuk menghapus data
    $query = "DELETE FROM perusahaan WHERE id = '$id'";

    if (mysqli_query($connect, $query)) {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <body style='font-family: sans-serif;'>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Terhapus!',
                    text: 'Data perusahaan telah berhasil dihapus.',
                    showConfirmButton: false,
                    timer: 2000
                }).then(function() {
                    window.location.href = '/siTEMA/index.php?page=data_perusahaan';
                });
            </script>
        </body>";
        exit();
    } else {
        die("Gagal menghapus data: " . mysqli_error($connect));
    }
} else {
    echo "<script>window.location.href = '/siTEMA/index.php?page=data_perusahaan';</script>";
    exit();
}
?>