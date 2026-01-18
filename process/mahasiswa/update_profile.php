<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Gunakan path absolut untuk koneksi
include $_SERVER['DOCUMENT_ROOT'] . '/siTEMA/service/connection.php';

if (isset($_POST['simpan_profil'])) {
    $id_user = mysqli_real_escape_string($connect, $_POST['id_user']);
    $nama    = mysqli_real_escape_string($connect, $_POST['nama_mahasiswa']);
    $nim     = mysqli_real_escape_string($connect, $_POST['nim']);
    $email   = mysqli_real_escape_string($connect, $_POST['email']);
    $kontak  = mysqli_real_escape_string($connect, $_POST['kontak']);
    $jurusan = mysqli_real_escape_string($connect, $_POST['jurusan']);
    $alamat  = mysqli_real_escape_string($connect, $_POST['alamat']);

    // Logika Pengunggahan Foto
    $nama_foto = $_FILES['foto']['name'];
    $tmp_foto  = $_FILES['foto']['tmp_name'];

    if (!empty($nama_foto)) {
        // Generate nama unik untuk foto
        $ekstensi = pathinfo($nama_foto, PATHINFO_EXTENSION);
        $foto_baru = "USER_" . $id_user . "_" . time() . "." . $ekstensi;
        $tujuan = $_SERVER['DOCUMENT_ROOT'] . "/siTEMA/src/images/profile/" . $foto_baru;

        if (move_uploaded_file($tmp_foto, $tujuan)) {
            // Update dengan foto baru
            $sql = "UPDATE mahasiswa SET nama_mahasiswa='$nama', nim='$nim', email='$email', 
                    kontak='$kontak', jurusan='$jurusan', alamat='$alamat', foto='$foto_baru' 
                    WHERE id_user='$id_user'";
        }
    } else {
        // Update tanpa mengubah foto lama
        $sql = "UPDATE mahasiswa SET nama_mahasiswa='$nama', nim='$nim', email='$email', 
                kontak='$kontak', jurusan='$jurusan', alamat='$alamat' 
                WHERE id_user='$id_user'";
    }

    if (mysqli_query($connect, $sql)) {
        // PENGALIHAN DAN NOTIFIKASI
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <body style='font-family: sans-serif;'>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Profil Anda telah diperbarui.',
                    showConfirmButton: false,
                    timer: 2000
                }).then(function() {
                    window.location.href = '/siTEMA/index.php?page=profile_mahasiswa';
                });
            </script>
        </body>";
        exit();
    } else {
        die("Error database: " . mysqli_error($connect));
    }
} else {
    // Jika diakses tanpa menekan tombol simpan
    header("Location: /siTEMA/index.php?page=lihat_profil");
    exit();
}