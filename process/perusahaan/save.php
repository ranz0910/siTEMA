<?php
include '../../init.php';
include '../../service/auth.php';

// Pastikan request datang dari POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . BASE_URL . 'layout/read/data_perusahaan.php');
    exit;
}

// Cek apakah ini mode Update (ada ID) atau mode Create
$isUpdate = isset($_POST['id']) && !empty($_POST['id']);

if ($isUpdate) {
    // ==========================================
    // LOGIKA UPDATE (Data sudah ada)
    // ==========================================
    $id     = mysqli_real_escape_string($connect, $_POST['id']); 
    $nama   = mysqli_real_escape_string($connect, $_POST['nama_perusahaan']);
    $email  = mysqli_real_escape_string($connect, $_POST['email']);
    $alamat = mysqli_real_escape_string($connect, $_POST['alamat']);
    $kontak = mysqli_real_escape_string($connect, $_POST['kontak']);

    $query = "UPDATE perusahaan SET 
                nama_perusahaan = '$nama', 
                email = '$email', 
                alamat = '$alamat', 
                kontak = '$kontak' 
              WHERE id = '$id'";

    if (mysqli_query($connect, $query)) {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <body style='font-family: sans-serif;'>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Informasi perusahaan telah diperbarui.',
                    showConfirmButton: false,
                    timer: 2000
                }).then(function() {
                    window.location.href = '" . BASE_URL . "layout/read/data_perusahaan.php';
                });
            </script>
        </body>";
    } else {
        die("Error database: " . mysqli_error($connect));
    }

} else {
    // ==========================================
    // LOGIKA CREATE (Data baru)
    // ==========================================
    $username          = mysqli_real_escape_string($connect, $_POST['username']);
    $password          = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $nama_perusahaan   = mysqli_real_escape_string($connect, $_POST['nama_perusahaan']);
    $email_perusahaan  = mysqli_real_escape_string($connect, $_POST['email_perusahaan']);
    $alamat_perusahaan = mysqli_real_escape_string($connect, $_POST['alamat_perusahaan']);
    $kontak_perusahaan = mysqli_real_escape_string($connect, $_POST['telp_perusahaan']);
    $id_roles = 3; // Role Perusahaan

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

    // Mulai proses simpan ke dua tabel
    $sqlUser = "INSERT INTO users (id_roles, username, password, email) 
                VALUES ('$id_roles', '$username', '$password', '$email_perusahaan')";

    if ($connect->query($sqlUser)) {
        $id_user_baru = $connect->insert_id;

        $sqlPerusahaan = "INSERT INTO perusahaan (id_user, nama_perusahaan, alamat_perusahaan, email_perusahaan, telp_perusahaan) 
                          VALUES ('$id_user_baru', '$nama_perusahaan', '$alamat_perusahaan', '$email_perusahaan', '$kontak_perusahaan')";

        if ($connect->query($sqlPerusahaan)) {
            echo "<script>
                    alert('Berhasil menyimpan data perusahaan.');
                    window.location.href='" . BASE_URL . "layout/read/data_perusahaan.php';
                  </script>";
        } else {
            // Rollback manual: hapus user jika profil gagal dibuat
            $connect->query("DELETE FROM users WHERE id = '$id_user_baru'");
            echo 'Gagal menyimpan ke tabel perusahaan: ' . $connect->error;
        }
    } else {
        echo 'Gagal menyimpan ke tabel users: ' . $connect->error;
    }
}