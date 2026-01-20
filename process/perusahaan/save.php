<?php
include '../../init.php';
include '../../service/auth.php';
require_once '../../repository/Perusahaan.php';

// Proteksi method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: ' . BASE_URL . 'layout/read/data_perusahaan.php');
  exit;
}

// SweetAlert
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
<body style='font-family:sans-serif;'>";

// ================= CEK MODE =================
$isUpdate = isset($_POST['id_perusahaan']) && !empty($_POST['id_perusahaan']);

if ($isUpdate) {

  /* ================= UPDATE ================= */
  $data = [
    'id_perusahaan'     => $_POST['id_perusahaan'],
    'id_user'           => $_POST['id_user'],
    'username'          => $_POST['username'],
    'email'             => $_POST['email_perusahaan'],
    'npwp'              => $_POST['npwp'],
    'nama_perusahaan'   => $_POST['nama_perusahaan'],
    'alamat_perusahaan' => $_POST['alamat_perusahaan'],
    'telp_perusahaan'   => $_POST['telp_perusahaan'],
  ];

  $update = Perusahaan::update($data);

  if ($update) {
    echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data perusahaan berhasil diperbarui.',
                showConfirmButton: true
            }).then(() => {
                window.location.href = '" . BASE_URL . "layout/read/data_perusahaan.php';
            });
        </script>";
  } else {
    echo "<script>
            Swal.fire('Gagal!', 'Gagal memperbarui data perusahaan.', 'error')
            .then(() => window.history.back());
        </script>";
  }
} else {

  /* ================= CREATE ================= */
  $data = [
    'username'          => $_POST['username'],
    'password'          => $_POST['password'],
    'email'             => $_POST['email_perusahaan'],
    'npwp'              => $_POST['npwp'],
    'nama_perusahaan'   => $_POST['nama_perusahaan'],
    'alamat_perusahaan' => $_POST['alamat_perusahaan'],
    'telp_perusahaan'   => $_POST['telp_perusahaan'],
  ];

  $create = Perusahaan::create($data);

  if ($create['status']) {
    echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Perusahaan baru berhasil ditambahkan.',
                timer: 2000,
                showConfirmButton: true
            }).then(() => {
                window.location.href = '" . BASE_URL . "layout/read/data_perusahaan.php';
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
