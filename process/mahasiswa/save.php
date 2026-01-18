<?php
include '../../init.php';
include '../../service/auth.php';
require_once '../../repository/Mahasiswa.php';

// Pastikan request POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . BASE_URL . 'layout/read/data_mahasiswa.php');
    exit;
}

// Mode UPDATE jika ada id_mahasiswa
$isUpdate = isset($_POST['id_mahasiswa']) && !empty($_POST['id_mahasiswa']);

try {

    if ($isUpdate) {
        /* =======================
            UPDATE
        ======================= */
        $data = [
            'id_mahasiswa'   => $_POST['id_mahasiswa'],
            'id_user'        => $_POST['id_user'],
            'id_prodi'       => $_POST['id_prodi'],
            'username'       => $_POST['username'],
            'email'          => $_POST['email'],
            'nim'            => $_POST['nim'],
            'nama_mahasiswa' => $_POST['nama_mahasiswa'],
            'jenis_kelamin'  => $_POST['jenis_kelamin'],
            'alamat'         => $_POST['alamat'],
            'angkatan'       => $_POST['angkatan'],
            'no_hp'          => $_POST['no_hp'],
        ];

        $result = Mahasiswa::update($data);
        $msg = 'Data Mahasiswa berhasil diperbarui';

    } else {
        /* =======================
            CREATE
        ======================= */
        $data = [
            'username'       => $_POST['username'],
            'password'       => $_POST['password'],
            'email'          => $_POST['email'],
            'id_prodi'       => $_POST['id_prodi'],
            'nim'            => $_POST['nim'],
            'nama_mahasiswa' => $_POST['nama_mahasiswa'],
            'jenis_kelamin'  => $_POST['jenis_kelamin'],
            'alamat'         => $_POST['alamat'],
            'angkatan'       => $_POST['angkatan'],
            'no_hp'          => $_POST['no_hp'],
        ];

        $result = Mahasiswa::create($data);
        $msg = 'Mahasiswa berhasil ditambahkan';
    }

    if (!$result['status']) {
        throw new Exception($result['msg'] ?? 'Gagal menyimpan data');
    }

    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <body>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '$msg'
            }).then(() => {
                window.location.href = '" . BASE_URL . "layout/read/data_mahasiswa.php';
            });
        </script>
    </body>
    ";

} catch (Exception $e) {
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
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
    ";
}