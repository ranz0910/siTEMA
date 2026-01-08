<?php
require '../../../service/connection.php';



if (isset($_POST['submit_jurusan'])) {
    
    // Ambil data 
    $username     = $_POST['username'];
    $password     = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email        = $_POST['email_jurusan']; 
    $nama_jurusan = $_POST['nama_jurusan'];
    $ketua_jurusan = $_POST['ketua_jurusan'];
    $id_roles     = 2; 

    
    $cek_duplikat = "SELECT id FROM users WHERE username = '$username' OR email = '$email'";
    $hasil_cek = $connect->query($cek_duplikat);

    if ($hasil_cek->num_rows > 0) {
        echo "<script>
                alert('Username atau Email sudah terdaftar.');
                window.history.back(); 
              </script>";
        exit;
    }

    // Simpan ke Tabel Users
    $sqlUser = "INSERT INTO users (id_roles, username, password, email) 
                VALUES ('$id_roles', '$username', '$password', '$email')";
    
    $queryUser = $connect->query($sqlUser);

    if ($queryUser) {
        $id_user_baru = $connect->insert_id;

        // Simpan ke Tabel Jurusan
        $sqlJurusan = "INSERT INTO jurusan (id_user, ketua_jurusan, nama_jurusan) 
                       VALUES ('$id_user_baru', '$ketua_jurusan', '$nama_jurusan')";

        
        $queryJurusan = $connect->query($sqlJurusan);

        if ($queryJurusan) {
            echo "<script>
                    alert('Berhasil menyimpan data jurusan.');
                    // PERBAIKAN DI SINI: Tambahkan ../../../ agar kembali ke folder utama
                    window.location.href = '../../../index.php?page=table_jurusan';
                  </script>";
        } else {
            echo "Gagal menyimpan ke tabel jurusan: " . $connect->error;
        }
    } else {
        echo "Gagal menyimpan ke tabel users: " . $connect->error;
    }
}
?>