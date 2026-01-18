<?php
include '../../init.php';
include '../../service/auth.php';

// Pastikan request datang dari POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . BASE_URL . 'index.php?page=data_jurusan');
    exit;
}

// Persiapan Header SweetAlert2
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
      <body style='font-family: sans-serif;'>";

// Cek apakah ini mode Update (berdasarkan name="id_jurusan" dari form edit yang kita buat sebelumnya)
$isUpdate = isset($_POST['id_jurusan']) && !empty($_POST['id_jurusan']);

if ($isUpdate) {
    // ==========================================
    // LOGIKA UPDATE (Data sudah ada)
    // ==========================================
    $id_jurusan   = mysqli_real_escape_string($connect, $_POST['id_jurusan']); 
    $id_user      = mysqli_real_escape_string($connect, $_POST['id_user']); 
    $nama_jurusan = mysqli_real_escape_string($connect, $_POST['nama_jurusan']);
    $ketua_jurusan= mysqli_real_escape_string($connect, $_POST['ketua_jurusan']);
    $email_jurusan= mysqli_real_escape_string($connect, $_POST['email_jurusan']);
    $kode_jurusan = mysqli_real_escape_string($connect, $_POST['kode_jurusan']);
    $username     = mysqli_real_escape_string($connect, $_POST['username']);

    // Update dua tabel sekaligus (Users dan Jurusan)
    $queryUser = "UPDATE users SET username = '$username', email = '$email_jurusan' WHERE id = '$id_user'";
    $queryJrs  = "UPDATE jurusan SET nama_jurusan = '$nama_jurusan', kajur = '$ketua_jurusan', kode_jurusan = '$kode_jurusan' WHERE id = '$id_jurusan'";

    if (mysqli_query($connect, $queryUser) && mysqli_query($connect, $queryJrs)) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil Diperbarui!',
                text: 'Data jurusan telah berhasil diubah.',
                showConfirmButton: false,
                timer: 2000
            }).then(function() {
                window.location.href = '" . BASE_URL . "index.php?page=data_jurusan';
            });
        </script>";
    } else {
        echo "<script>Swal.fire('Gagal!', 'Terjadi kesalahan saat update database.', 'error').then(function(){ window.history.back(); });</script>";
    }

} else {
    // ==========================================
    // LOGIKA CREATE (Data baru)
    // ==========================================
    $username     = mysqli_real_escape_string($connect, $_POST['username']);
    $password     = md5($_POST['password']);
    $email        = mysqli_real_escape_string($connect, $_POST['email_jurusan']); 
    $nama_jurusan = mysqli_real_escape_string($connect, $_POST['nama_jurusan']);
    $kode_jurusan = mysqli_real_escape_string($connect, $_POST['kode_jurusan']);
    $ketua_jurusan= mysqli_real_escape_string($connect, $_POST['ketua_jurusan']);
    $id_roles     = 2; 

    // Cek duplikat
    $cek_duplikat = "SELECT id FROM users WHERE username = '$username' OR email = '$email'";
    $hasil_cek = $connect->query($cek_duplikat);

    if ($hasil_cek->num_rows > 0) {
        echo "<script>
            Swal.fire('Terdaftar!', 'Username atau Email sudah digunakan.', 'warning').then(function(){ window.history.back(); });
        </script>";
        exit;
    }

    // Simpan ke Tabel Users
    $sqlUser = "INSERT INTO users (id_roles, username, password, email) VALUES ('$id_roles', '$username', '$password', '$email')";
    
    if ($connect->query($sqlUser)) {
        $id_user_baru = $connect->insert_id;
        // Simpan ke Tabel Jurusan
        $sqlJurusan = "INSERT INTO jurusan (id_user, nama_jurusan, kode_jurusan, kajur) VALUES ('$id_user_baru', '$nama_jurusan', '$kode_jurusan', '$ketua_jurusan')";
        
        if ($connect->query($sqlJurusan)) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil Disimpan!',
                    text: 'Jurusan baru telah berhasil ditambahkan.',
                    showConfirmButton: false,
                    timer: 2000
                }).then(function() {
                    window.location.href = '" . BASE_URL . "index.php?page=data_jurusan';
                });
            </script>";
        }
    }
}
echo "</body>";