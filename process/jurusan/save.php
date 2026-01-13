<?php
include '../../init.php';
require_once '../../repository/jurusan.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: ' . BASE_URL);
  exit;
}

// ========================
// MODE: CREATE / UPDATE
// ========================
$isUpdate = isset($_POST['id_jurusan']) && !empty($_POST['id_jurusan']);

if ($isUpdate) {

  // ========================
  // UPDATE
  // ========================
  $result = Jurusan::update([
    'id_jurusan'   => $_POST['id_jurusan'],
    'id_user'      => $_POST['id_user'],
    'username'     => $_POST['username'],
    'email'        => $_POST['email'],
    'nama_jurusan' => $_POST['nama_jurusan'],
    'kode_jurusan' => $_POST['kode_jurusan'],
  ]);

  if ($result) {
    header("Location: " . BASE_URL . "layout/read/data_jurusan.php");
    exit;
  } else {
    echo "<script>
      alert('Gagal mengupdate data jurusan');
      window.history.back();
    </script>";
  }

} else {

  // ========================
  // CREATE
  // ========================
  $result = Jurusan::create($_POST);

  if ($result['status']) {
    header("Location: " . BASE_URL . "layout/read/data_jurusan.php");
    exit;
  } else {
    echo "<script>
      alert('{$result['msg']}');
      window.history.back();
    </script>";
  }
}
