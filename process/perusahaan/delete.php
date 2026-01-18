<?php
include '../../init.php';
include '../../service/auth.php';
require_once '../../repository/Perusahaan.php';

$id = $_GET['id'] ?? '';

try {
    if (empty($id)) {
        throw new Exception("ID tidak ditemukan.");
    }

    // Eksekusi hapus di repository
    $result = Perusahaan::delete($id);

    if (!$result['status']) {
        throw new Exception($result['msg']);
    }

    // Notifikasi berhasil muncul SETELAH data terhapus
    echo "
    <html>
    <head><script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script></head>
    <body style='font-family: sans-serif;'>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Terhapus!',
                text: 'Data perusahaan telah berhasil dihapus.',
                confirmButtonColor: '#5D87FF'
            }).then(() => {
                window.location.href = '" . BASE_URL . "/layout/read/data_perusahaan.php';
            });
        </script>
    </body>
    </html>";

} catch (Exception $e) {
    // Notifikasi jika gagal
    echo "
    <html>
    <head><script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script></head>
    <body>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '" . addslashes($e->getMessage()) . "'
            }).then(() => {
                window.history.back();
            });
        </script>
    </body>
    </html>";
}