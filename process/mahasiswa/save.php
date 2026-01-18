<?php
include '../../init.php';
include '../../service/auth.php';

// Pastikan request datang dari POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . BASE_URL . 'layout/read/data_mahasiswa.php');
    exit;
}

// Cek apakah ini mode Update (ada id_mhs) atau mode Create
$isUpdate = isset($_POST['id_mhs']) && !empty($_POST['id_mhs']);

// Ambil Data Umum dari Form
$nama     = mysqli_real_escape_string($connect, $_POST['nama_mahasiswa']);
$nim      = mysqli_real_escape_string($connect, $_POST['nim_mahasiswa']);
$prodi    = mysqli_real_escape_string($connect, $_POST['prodi_mahasiswa']);
$email    = mysqli_real_escape_string($connect, $_POST['email_mahasiswa']);
$alamat   = mysqli_real_escape_string($connect, $_POST['alamat_mahasiswa']);
$kontak   = mysqli_real_escape_string($connect, $_POST['kontak_mahasiswa']);
$username = mysqli_real_escape_string($connect, $_POST['username']);

// Mulai Transaksi
mysqli_begin_transaction($connect);

try {
    if ($isUpdate) {
        // ==========================================
        // LOGIKA UPDATE
        // ==========================================
        $id_mhs  = $_POST['id_mhs'];
        $id_user = $_POST['id_user'];
        $id_roles = 4; // ID Role Mahasiswa

        // Update Tabel Users (Username & Role)
        $queryUser = "UPDATE users SET username = '$username', id_roles = '$id_roles' WHERE id = '$id_user'";
        
        // Jika password diisi, maka update password juga
        if (!empty($_POST['password'])) {
            $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $queryUser = "UPDATE users SET username = '$username', password = '$pass', id_roles = '$id_roles' WHERE id = '$id_user'";
        }
        mysqli_query($connect, $queryUser);

        // Update Tabel Mahasiswa
        $queryMhs = "UPDATE mahasiswa SET 
                        nama_mahasiswa = '$nama', 
                        nim = '$nim', 
                        prodi = '$prodi', 
                        email = '$email', 
                        alamat = '$alamat', 
                        kontak = '$kontak' 
                     WHERE id = '$id_mhs'";
        mysqli_query($connect, $queryMhs);

        $msg = "Data Mahasiswa & Akun Berhasil Diperbarui";

    } else {
        // ==========================================
        // LOGIKA CREATE
        // ==========================================
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $id_roles = 4; // Role Mahasiswa

        // Simpan ke Tabel Users
        $queryUser = "INSERT INTO users (username, password, id_roles) VALUES ('$username', '$password', '$id_roles')";
        mysqli_query($connect, $queryUser);

        $id_user_baru = mysqli_insert_id($connect);

        // Simpan ke Tabel Mahasiswa
        $queryMhs = "INSERT INTO mahasiswa (id_user, nama_mahasiswa, nim, email, kontak, prodi, alamat) 
                     VALUES ('$id_user_baru', '$nama', '$nim', '$email', '$kontak', '$prodi', '$alamat')";
        mysqli_query($connect, $queryMhs);

        $msg = "Mahasiswa Berhasil Didaftarkan";
    }

    // Jika sampai sini tidak ada error, simpan permanen
    mysqli_commit($connect);

    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          <body style='font-family:sans-serif;'>
            <script>
                Swal.fire({icon:'success', title:'Berhasil!', text:'$msg'})
                .then(() => { window.location.href='" . BASE_URL . "layout/read/data_mahasiswa.php'; });
            </script>
          </body>";

} catch (Exception $e) {
    // Batalkan semua perubahan jika ada satu saja yang gagal
    mysqli_rollback($connect);
    die("Gagal memproses data. Error: " . $e->getMessage());
}