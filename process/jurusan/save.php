<?php
include '../../init.php';
include '../../service/auth.php';

// Proteksi method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . BASE_URL . 'index.php?page=data_jurusan');
    exit;
}

// SweetAlert
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
<body style='font-family:sans-serif;'>";

// ================= CEK MODE =================
$isUpdate = isset($_POST['id_jurusan']) && !empty($_POST['id_jurusan']);

if ($isUpdate) {
    // ================= UPDATE =================
    $data = [
        'id_jurusan'   => $_POST['id_jurusan'],
        'id_user'      => $_POST['id_user'],
        'username'     => $_POST['username'],
        'email'        => $_POST['email_jurusan'],
        'nama_jurusan' => $_POST['nama_jurusan'],
        'kode_jurusan' => $_POST['kode_jurusan'],
    ];

    $update = Jurusan::update($data);

    if ($update) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data jurusan berhasil diperbarui.',
                showConfirmButton: true
            }).then(() => {
                window.location.href = '" . BASE_URL . "layout/read/data_jurusan.php';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire('Gagal!', 'Gagal memperbarui data.', 'error')
            .then(() => window.history.back());
        </script>";
    }
} else {
    // ================= CREATE =================
    $data = [
        'username'     => $_POST['username'],
        'password'     => $_POST['password'],
        'email'        => $_POST['email_jurusan'],
        'nama_jurusan' => $_POST['nama_jurusan'],
        'kode_jurusan' => $_POST['kode_jurusan'],
    ];

    $create = Jurusan::create($data);

    if ($create['status']) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Jurusan baru berhasil ditambahkan.',
                timer: 2000,
                showConfirmButton: true
            }).then(() => {
                window.location.href = '" . BASE_URL . "layout/read/data_jurusan.php';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire('Peringatan!', '{$create['msg']}', 'warning')
            .then(() => window.history.back());
        </script>";
    }
}

echo "</body>";
