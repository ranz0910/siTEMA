<?php
include $_SERVER['DOCUMENT_ROOT'] . '/siTEMA/service/connection.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($connect, $_GET['id']);

    // Cari id_user dulu sebelum dihapus
    $res = mysqli_query($connect, "SELECT id_user FROM mahasiswa WHERE id = '$id'");
    $data = mysqli_fetch_assoc($res);
    $id_user = $data['id_user'];

    mysqli_begin_transaction($connect);
    try {
        mysqli_query($connect, "DELETE FROM mahasiswa WHERE id = '$id'");
        mysqli_query($connect, "DELETE FROM users WHERE id = '$id_user'");
        mysqli_commit($connect);
        
        header("Location: ../../index.php?page=data_mahasiswa");
    } catch (Exception $e) {
        mysqli_rollback($connect);
        echo "Gagal menghapus: " . mysqli_error($connect);
    }
}
?>