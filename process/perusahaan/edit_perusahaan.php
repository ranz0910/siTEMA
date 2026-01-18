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


if (isset($_POST['update_perusahaan'])) {
    
    if (!isset($connect)) {
        die("Error: Variabel \$connect tidak ditemukan. Periksa file connection.php Anda.");
    }

    // Ambil data dan amankan dari SQL Injection
    $id     = mysqli_real_escape_string($connect, $_POST['id']); 
    $nama   = mysqli_real_escape_string($connect, $_POST['nama_perusahaan']);
    $email  = mysqli_real_escape_string($connect, $_POST['email']);
    $alamat = mysqli_real_escape_string($connect, $_POST['alamat']);
    $kontak = mysqli_real_escape_string($connect, $_POST['kontak']);

    // Query Update
    $query = "UPDATE perusahaan SET 
                nama_perusahaan = '$nama', 
                email = '$email', 
                alamat = '$alamat', 
                kontak = '$kontak' 
              WHERE id = '$id'";

    if (mysqli_query($connect, $query)) {
        // Menggunakan JavaScript untuk redirect agar terhindar dari error 'Headers already sent'
        // Dan menggunakan path lengkap /siTEMA/ agar tidak 404
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <body style='font-family: sans-serif;'>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Informasi perusahaan telah diperbarui.',
                    showConfirmButton: false,
                    timer: 2000
                }).then(function() {
                    window.location.href = '/siTEMA/index.php?page=data_perusahaan';
                });
            </script>
        </body>";
        exit();
    } else {
        die("Error database: " . mysqli_error($connect));
    }
} else {
    // Redirect jika file diakses langsung tanpa form
    echo "<script>window.location.href = '/siTEMA/index.php?page=data_perusahaan';</script>";
    exit();
}
?>