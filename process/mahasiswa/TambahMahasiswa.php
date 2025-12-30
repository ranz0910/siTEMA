<?php
require '../../service/connection.php';

if (isset($_POST['submit_mahasiswa'])) {

    // Ambil data dari form
    $nama_mahasiswa   = $_POST['nama_mahasiswa'];
    $nim_mahasiswa    = $_POST['nim_mahasiswa'];
    $jurusan_mahasiswa = $_POST['jurusan_mahasiswa'];
    $email_mahasiswa  = $_POST['email_mahasiswa'];
    $alamat_mahasiswa = $_POST['alamat_mahasiswa'];
    $kontak_mahasiswa = $_POST['kontak_mahasiswa'];

    
    $username = $nim_mahasiswa;
    $password = password_hash('mahasiswa123', PASSWORD_DEFAULT);
    $id_roles = 4;

    // Cek duplikat username / email / NIM
    $cek_duplikat = "
        SELECT u.id 
        FROM users u
        LEFT JOIN mahasiswa m ON m.id_user = u.id
        WHERE u.username = '$username'
           OR u.email = '$email_mahasiswa'
           OR m.nim = '$nim_mahasiswa'
    ";

    $hasil_cek = $connect->query($cek_duplikat);

    if ($hasil_cek->num_rows > 0) {
        echo "<script>
                alert('NIM atau Email sudah terdaftar.');
                window.history.back();
              </script>";
        exit;
    }

    // user
    $sqlUser = "
        INSERT INTO users (id_roles, username, password, email)
        VALUES ('$id_roles', '$username', '$password', '$email_mahasiswa')
    ";

    $queryUser = $connect->query($sqlUser);

    if ($queryUser) {

        $id_user_baru = $connect->insert_id;

       //mahasiswa 
       
        $sqlMahasiswa = "
            INSERT INTO mahasiswa 
            (id_user, nama_mahasiswa, nim, email, kontak, jurusan, alamat)
            VALUES
            ('$id_user_baru', '$nama_mahasiswa', '$nim_mahasiswa', 
             '$email_mahasiswa', '$kontak_mahasiswa', 
             '$jurusan_mahasiswa', '$alamat_mahasiswa')
        ";

        $queryMahasiswa = $connect->query($sqlMahasiswa);

        if ($queryMahasiswa) {
            echo "<script>
                    alert('Berhasil menyimpan data mahasiswa.');
                    window.location.href='../../index.php?page=table_mahasiswa';
                  </script>";
        } else {
            echo 'Gagal menyimpan ke tabel mahasiswa: ' . $connect->error;
        }

    } else {
        echo 'Gagal menyimpan ke tabel users: ' . $connect->error;
    }
}
?>
