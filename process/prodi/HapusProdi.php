<?php
include $_SERVER['DOCUMENT_ROOT'] . '/siTEMA/service/connection.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($connect, $_GET['id']);

    // Query Hapus
    $query = "DELETE FROM prodi WHERE id = '$id'";

    if (mysqli_query($connect, $query)) {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <body style='font-family: sans-serif;'>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Dihapus!',
                    text: 'Data Program Studi telah berhasil dihapus.',
                    showConfirmButton: false,
                    timer: 2000
                }).then(function() {
                    window.location.href = '../../index.php?page=data_prodi';
                });
            </script>
        </body>";
    } else {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Data tidak bisa dihapus karena terkait dengan data lain.',
            }).then(function() {
                window.location.href = '../../index.php?page=data_prodi';
            });
        </script>";
    }
} else {
    header("Location: ../../index.php?page=data_prodi");
}
?>