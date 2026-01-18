<?php
require '../../service/connection.php';
$koneksi = $connect; 

if (isset($_POST['submit_perusahaan'])) {

    $username          = $_POST['username'];
    $password          = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $nama_perusahaan   = $_POST['nama_perusahaan'];
    $email_perusahaan  = $_POST['email_perusahaan'];
    $alamat_perusahaan = $_POST['alamat_perusahaan'];
    $kontak_perusahaan = $_POST['kontak_perusahaan'];
    $id_roles = 3;

    // Cek duplikat di tabel users
    $cek_duplikat = "SELECT id FROM users WHERE username = '$username' OR email = '$email_perusahaan'";
    $hasil_cek = $connect->query($cek_duplikat);

    if ($hasil_cek->num_rows > 0) {
        echo "<script>
                alert('Username atau Email sudah terdaftar.');
                window.history.back();
              </script>";
        exit;
    }

    // 1. Insert ke tabel USERS
    $sqlUser = "INSERT INTO users (id_roles, username, password, email) 
                VALUES ('$id_roles', '$username', '$password', '$email_perusahaan')";

    if ($connect->query($sqlUser)) {
        $id_user_baru = $connect->insert_id;

        // 2. Insert ke tabel PERUSAHAAN (Hapus kolom username & password di sini)
        $sqlPerusahaan = "INSERT INTO perusahaan (id_user, nama_perusahaan, alamat, email, kontak) 
                          VALUES ('$id_user_baru', '$nama_perusahaan', '$alamat_perusahaan', '$email_perusahaan', '$kontak_perusahaan')";

        if ($connect->query($sqlPerusahaan)) {
            echo "<script>
                    alert('Berhasil menyimpan data perusahaan.');
                    window.location.href='../../index.php?page=data_perusahaan';
                  </script>";
        } else {
            // Jika gagal di tabel perusahaan, hapus user yang baru dibuat agar tidak gantung (rollback manual)
            $connect->query("DELETE FROM users WHERE id = '$id_user_baru'");
            echo 'Gagal menyimpan ke tabel perusahaan: ' . $connect->error;
        }

    } else {
        echo 'Gagal menyimpan ke tabel users: ' . $connect->error;
    }
}
?>