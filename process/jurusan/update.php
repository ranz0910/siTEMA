<?php
include '../../service/connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_jurusan    = mysqli_real_escape_string($connect, $_POST['id_jurusan']);
    $id_user       = mysqli_real_escape_string($connect, $_POST['id_user']);
    $nama_jurusan  = mysqli_real_escape_string($connect, $_POST['nama_jurusan']);
    $kode_jurusan  = mysqli_real_escape_string($connect, $_POST['kode_jurusan']);
    $ketua_jurusan = mysqli_real_escape_string($connect, $_POST['ketua_jurusan']);
    $username      = mysqli_real_escape_string($connect, $_POST['username']);
    $email         = mysqli_real_escape_string($connect, $_POST['email_jurusan']);
    
    // Logika Password MD5 opsional
    $pw_query = "";
    if (!empty($_POST['password'])) {
        $hash = md5($_POST['password']);
        $pw_query = ", password = '$hash'";
    }

    mysqli_begin_transaction($connect);
    try {
        // 1. Update Kredensial User
        mysqli_query($connect, "UPDATE users SET username = '$username', email = '$email' $pw_query WHERE id = '$id_user'");

        // 2. Update Informasi Jurusan Lengkap
        mysqli_query($connect, "UPDATE jurusan SET 
                    nama_jurusan = '$nama_jurusan', 
                    kode_jurusan = '$kode_jurusan', 
                    kajur = '$ketua_jurusan' 
                    WHERE id = '$id_jurusan'");

        mysqli_commit($connect);

        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              <body style='font-family:sans-serif'>
              <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data jurusan telah diperbarui oleh Admin.',
                    timer: 2000, showConfirmButton: false
                }).then(() => {
                    window.location.href = '../../index.php?page=data_jurusan';
                });
              </script></body>";
    } catch (Exception $e) {
        mysqli_rollback($connect);
        die("Error: " . $e->getMessage());
    }
}