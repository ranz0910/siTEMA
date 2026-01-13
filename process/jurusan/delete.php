<?php
include '../../init.php';
include '../../service/auth.php';
require_once '../../repository/jurusan.php';

if (!isset($_GET['id'])) {
    header("Location: " . BASE_URL . "layout/read/data_jurusan.php");
    exit;
}

$id = $_GET['id'];

$result = Jurusan::delete($id);

if ($result['status']) {
    header("Location: " . BASE_URL . "layout/read/data_jurusan.php?success=delete");
} else {
    header("Location: " . BASE_URL . "layout/read/data_jurusan.php?error=" . urlencode($result['msg']));
}
exit;
