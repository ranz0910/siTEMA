<?php
include '../../init.php';
include '../../service/auth.php';
require_once '../../repository/lowongan_magang.php';

// Proteksi method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: ' . BASE_URL . 'layout/read/data_lowongan_magang.php');
  exit;
}

// SweetAlert
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
<body style='font-family:sans-serif;'>";

// Ambil user_id dari session
$user_id = $_SESSION['user_id'];

// ================= CEK MODE =================
$isUpdate = isset($_POST['id']) && !empty($_POST['id']);

$data = [
  'id_jurusan'    => $_POST['id_jurusan'],
  'judul_lowongan' => $_POST['judul_lowongan'],
  'deskripsi'     => $_POST['deskripsi'],
  'kuota'         => $_POST['kuota'],
];

if ($isUpdate) {
  // ================= UPDATE =================
  $data['id'] = $_POST['id'];
  $update = Lowongan::update($data, $user_id);

  if ($update['status']) {
    echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Lowongan berhasil diperbarui.',
                showConfirmButton: true
            }).then(() => {
                window.location.href = '" . BASE_URL . "layout/read/data_lowongan_magang.php';
            });
        </script>";
  } else {
    echo "<script>
            Swal.fire('Gagal!', '{$update['msg']}', 'error')
            .then(() => window.history.back());
        </script>";
  }
} else {
  // ================= CREATE =================
  $create = Lowongan::create($data, $user_id);

  if ($create['status']) {
    echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Lowongan baru berhasil ditambahkan.',
                showConfirmButton: true
            }).then(() => {
                window.location.href = '" . BASE_URL . "layout/read/data_lowongan_magang.php';
            });
        </script>";
  } else {
    echo "<script>
            Swal.fire('Gagal!', '{$create['msg']}', 'error')
            .then(() => window.history.back());
        </script>";
  }
}

echo "</body>";
