<?php
require '../../service/connection.php';

if (isset($_POST['submit_perusahaan'])) {

    // Ambil data dari form
    $nama_perusahaan   = $_POST['nama_perusahaan'];
    $email_perusahaan  = $_POST['email_perusahaan'];
    $alamat_perusahaan = $_POST['alamat_perusahaan'];
    $kontak_perusahaan = $_POST['kontak_perusahaan'];

    
    $username = $nama_perusahaan;
    $password = password_hash('perusahaan123', PASSWORD_DEFAULT);
    $id_roles = 3;

    $cek_duplikat = "
        SELECT id FROM users
        WHERE username = '$username' OR email = '$email_perusahaan'
    ";

    $hasil_cek = $connect->query($cek_duplikat);

    if ($hasil_cek->num_rows > 0) {
        echo "<script>
                alert('Nama perusahaan atau Email sudah terdaftar.');
                window.history.back();
              </script>";
        exit;
    }

    // Insert ke USERS
    $sqlUser = "
        INSERT INTO users (id_roles, username, password, email)
        VALUES ('$id_roles', '$username', '$password', '$email_perusahaan')
    ";

    $queryUser = $connect->query($sqlUser);

    if ($queryUser) {

        $id_user_baru = $connect->insert_id;

        // Insert ke PERUSAHAAN
        $sqlPerusahaan = "
            INSERT INTO perusahaan (id_user, nama_perusahaan, alamat, email, kontak)
            VALUES ('$id_user_baru', '$nama_perusahaan', '$alamat_perusahaan', '$email_perusahaan', '$kontak_perusahaan')
        ";

        $queryPerusahaan = $connect->query($sqlPerusahaan);

        if ($queryPerusahaan) {
            echo "<script>
                    alert('Berhasil menyimpan data perusahaan.');
                    window.location.href='../../index.php?page=table_perusahaan';
                  </script>";
        } else {
            echo 'Gagal menyimpan ke tabel perusahaan: ' . $connect->error;
        }

    } else {
        echo 'Gagal menyimpan ke tabel users: ' . $connect->error;
    }
}
?>
