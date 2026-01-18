<?php
// Gunakan path yang tepat menuju root
include '../../init.php'; 
include '../../service/auth.php';
require_once '../../repository/mahasiswa.php';

if (!isset($_GET['id'])) {
    header("Location: " . BASE_URL . "index.php?page=data_mahasiswa");
    exit;
}

$id = $_GET['id'];
$result = Mahasiswa::delete($id);

// REDIRECT HARUS KE index.php agar sidebar/header tetap muncul
if ($result['status']) {
    header("Location: " . BASE_URL . "index.php?page=data_mahasiswa&success=delete");
} else {
    header("Location: " . BASE_URL . "index.php?page=data_mahasiswa&error=" . urlencode($result['msg']));
}
exit;