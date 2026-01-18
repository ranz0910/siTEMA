<?php
include $_SERVER['DOCUMENT_ROOT'] . '/siTEMA/service/connection.php';

if (isset($_POST['update_mahasiswa'])) {
    // 1. Ambil ID identitas
    $id_mhs  = $_POST['id_mhs'];
    $id_user = $_POST['id_user'];
    
    // 2. Ambil Data dari Form
    $nama     = mysqli_real_escape_string($connect, $_POST['nama_mahasiswa']);
    $nim      = mysqli_real_escape_string($connect, $_POST['nim_mahasiswa']);
    $prodi    = mysqli_real_escape_string($connect, $_POST['prodi_mahasiswa']);
    $email    = mysqli_real_escape_string($connect, $_POST['email_mahasiswa']);
    $alamat   = mysqli_real_escape_string($connect, $_POST['alamat_mahasiswa']);
    $kontak   = mysqli_real_escape_string($connect, $_POST['kontak_mahasiswa']);

    // Mulai Transaksi agar kedua tabel terupdate bersamaan
    mysqli_begin_transaction($connect);

    try {
        // --- TEMPAT MENAMBAHKAN KODE UPDATE USER ---
        $id_roles = 2; // ID untuk Mahasiswa
        $queryUser = "UPDATE users SET username = '$username', id_roles = '$id_roles' WHERE id = '$id_user'";

        // Jika user mengisi kolom password di form, maka password ikut diupdate
        if (!empty($_POST['password'])) {
            $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $queryUser = "UPDATE users SET username = '$username', password = '$pass', id_roles = '$id_roles' WHERE id = '$id_user'";
        }
        mysqli_query($connect, $queryUser);
        // --- AKHIR KODE UPDATE USER ---

        // 3. Update Tabel Mahasiswa
        $queryMhs = "UPDATE mahasiswa SET 
                     nama_mahasiswa = '$nama', 
                     nim = '$nim', 
                     prodi = '$prodi', 
                     email = '$email', 
                     alamat = '$alamat', 
                     kontak = '$kontak' 
                     WHERE id = '$id_mhs'";
        
        mysqli_query($connect, $queryMhs);

        // Commit perubahan
        mysqli_commit($connect);

        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              <body style='font-family:sans-serif;'>
                <script>
                    Swal.fire({icon:'success', title:'Berhasil!', text:'Data Mahasiswa & Akun Berhasil Diperbarui'})
                    .then(() => { window.location.href='../../index.php?page=data_mahasiswa'; });
                </script>
              </body>";

    } catch (Exception $e) {
        // Batalkan jika ada salah satu yang gagal
        mysqli_rollback($connect);
        echo "Gagal memperbarui: " . mysqli_error($connect);
    }
}
?>