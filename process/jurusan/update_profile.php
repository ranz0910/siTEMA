<?php
include '../../service/connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_jurusan   = mysqli_real_escape_string($connect, $_POST['id_jurusan']);
    $nama_jurusan = mysqli_real_escape_string($connect, $_POST['nama_jurusan']);
    
    // Ambil id_user dari database berdasarkan id_jurusan untuk update password
    $get_user = mysqli_query($connect, "SELECT id_user FROM jurusan WHERE id = '$id_jurusan'");
    $row_user = mysqli_fetch_assoc($get_user);
    $id_user  = $row_user['id_user'];

    // 1. Logika Password (MD5) - Hanya jika diisi
    $pw_query = "";
    if (!empty($_POST['password'])) {
        $hash = md5($_POST['password']);
        $pw_query = "UPDATE users SET password = '$hash' WHERE id = '$id_user'";
    }

    // 2. Logika Upload Foto
    $foto_query = "";
    if (!empty($_FILES['foto_profil']['name'])) {
        $nama_file = $_FILES['foto_profil']['name'];
        $tmp_file  = $_FILES['foto_profil']['tmp_name'];
        $ekstensi  = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
        $nama_baru = "jurusan_" . time() . "." . $ekstensi;
        $path      = "../../assets/images/profile/" . $nama_baru;

        if (move_uploaded_file($tmp_file, $path)) {
            $foto_query = ", foto = '$nama_baru'";
        }
    }

    mysqli_begin_transaction($connect);
    try {
        // A. Update Password di tabel Users (Jika ada)
        if ($pw_query != "") {
            mysqli_query($connect, $pw_query);
        }

        // B. Update Nama dan Foto di tabel Jurusan
        $sql_jurusan = "UPDATE jurusan SET nama_jurusan = '$nama_jurusan' $foto_query WHERE id = '$id_jurusan'";
        mysqli_query($connect, $sql_jurusan);

        mysqli_commit($connect);

        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              <body style='font-family:sans-serif'>
              <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Profil Diperbarui!',
                    text: 'Data jurusan dan foto berhasil disimpan.',
                    timer: 2000, showConfirmButton: false
                }).then(() => {
                    window.location.href = '../../index.php?page=profile_jurusan&id=$id_jurusan';
                });
              </script></body>";

    } catch (Exception $e) {
        mysqli_rollback($connect);
        die("Gagal update: " . $e->getMessage());
    }
}