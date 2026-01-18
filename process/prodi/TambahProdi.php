<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Menggunakan jalur absolut untuk koneksi agar lebih stabil
$path_koneksi = $_SERVER['DOCUMENT_ROOT'] . '/siTEMA/service/connection.php';
include($path_koneksi);

if (isset($_POST['submit_prodi'])) {
    
    // Pastikan menggunakan variabel koneksi $connect sesuai connection.php Anda
    if (!isset($connect)) {
        die("Error: Variabel \$connect tidak ditemukan.");
    }

    // Mengambil data dari name="nama_prodi" di form dan melindunginya dari SQL Injection
    $nama_prodi = mysqli_real_escape_string($connect, $_POST['nama_prodi']);
    
    // Query INSERT ke tabel prodi
    $query = "INSERT INTO prodi (nama_prodi) VALUES ('$nama_prodi')";

    if (mysqli_query($connect, $query)) {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <body style='font-family: sans-serif;'>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data Program Studi berhasil ditambahkan.',
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
    // Jika diakses langsung tanpa melalui form, arahkan kembali
    echo "<script>window.location.href = '/siTEMA/index.php?page=data_prodi';</script>";
    exit();
}
?>