<?php
include '../../init.php';
include '../../service/auth.php';
require_once '../../repository/Perusahaan.php';

// Pastikan request POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . BASE_URL . '/layout/read/data_perusahaan.php');
    exit;
}

// Mode UPDATE jika ada id_perusahaan
$isUpdate = isset($_POST['id_perusahaan']) && !empty($_POST['id_perusahaan']);

try {
    // Gunakan operator ?? '' untuk mencegah Warning Undefined Index
    if ($isUpdate) {
        /* =======================
            PROSES UPDATE
        ======================= */
        $data = [
            'id_perusahaan'     => $_POST['id_perusahaan'],
            'id_user'           => $_POST['id_user'],
            'username'          => $_POST['username'] ?? '',
            'email_perusahaan'  => $_POST['email_perusahaan'] ?? '',
            'nama_perusahaan'   => $_POST['nama_perusahaan'] ?? '',
            'alamat_perusahaan' => $_POST['alamat_perusahaan'] ?? '',
            'telp_perusahaan'   => $_POST['telp_perusahaan'] ?? '',
        ];

        $result = Perusahaan::update($data);
        $msg = 'Data Perusahaan berhasil diperbarui';

    } else {
        /* =======================
            PROSES CREATE
        ======================= */
        $data = [
            'username'          => $_POST['username'] ?? '',
            'password'          => $_POST['password'] ?? '',
            'email_perusahaan'  => $_POST['email_perusahaan'] ?? '',
            'nama_perusahaan'   => $_POST['nama_perusahaan'] ?? '',
            'alamat_perusahaan' => $_POST['alamat_perusahaan'] ?? '',
            'telp_perusahaan'   => $_POST['telp_perusahaan'] ?? '',
        ];

        $result = Perusahaan::create($data);
        $msg = 'Perusahaan baru berhasil ditambahkan';
    }

    // Cek status keberhasilan dari Repository
    if (!$result['status']) {
        throw new Exception($result['msg'] ?? 'Gagal menyimpan data');
    }

    // Feedback Sukses dengan SweetAlert2
    echo "
    <html>
    <head>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body style='font-family: sans-serif;'>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '$msg',
                confirmButtonColor: '#5D87FF'
            }).then(() => {
                window.location.href = '" . BASE_URL . "/layout/read/data_perusahaan.php';
            });
        </script>
    </body>
    </html>";

} catch (Exception $e) {
    // Feedback Gagal dengan SweetAlert2
    echo "
    <html>
    <head>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body style='font-family: sans-serif;'>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: '" . addslashes($e->getMessage()) . "',
                confirmButtonColor: '#d33'
            }).then(() => {
                window.history.back();
            });
        </script>
    </body>
    </html>";
}