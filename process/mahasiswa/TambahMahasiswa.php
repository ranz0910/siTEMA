<?php
include $_SERVER['DOCUMENT_ROOT'] . '/siTEMA/service/connection.php';

// Tambahkan ini untuk melihat pesan error yang sebenarnya
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (isset($_POST['submit_mahasiswa'])) {
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $id_roles = 4;

    $nama    = mysqli_real_escape_string($connect, $_POST['nama_mahasiswa']);
    $nim     = mysqli_real_escape_string($connect, $_POST['nim_mahasiswa']);
    $prodi   = mysqli_real_escape_string($connect, $_POST['prodi_mahasiswa']);
    $email   = mysqli_real_escape_string($connect, $_POST['email_mahasiswa']);
    $alamat  = mysqli_real_escape_string($connect, $_POST['alamat_mahasiswa']);
    $kontak  = mysqli_real_escape_string($connect, $_POST['kontak_mahasiswa']);

    mysqli_begin_transaction($connect);

    try {
        $queryUser = "INSERT INTO users (username, password, id_roles) VALUES ('$username', '$password', '$id_roles')";
        mysqli_query($connect, $queryUser);

        $id_user_baru = mysqli_insert_id($connect);

        // PERHATIKAN: Pastikan kolom 'prodi' di tabel mahasiswa benar-benar ada
        $queryMhs = "INSERT INTO mahasiswa (id_user, nama_mahasiswa, nim, email, kontak, prodi, alamat) 
                     VALUES ('$id_user_baru', '$nama', '$nim', '$email', '$kontak', '$prodi', '$alamat')";
        mysqli_query($connect, $queryMhs);

        mysqli_commit($connect);
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              <body style='font-family:sans-serif;'>
                <script>
                    Swal.fire({icon:'success', title:'Berhasil!', text:'Mahasiswa Berhasil Didaftarkan'})
                    .then(() => { window.location.href='../../index.php?page=data_mahasiswa'; });
                </script>
              </body>";
    } catch (Exception $e) {
        mysqli_rollback($connect);
        // Tampilkan pesan error spesifik dari database
        die("Gagal menyimpan. Error: " . $e->getMessage());
    }
}
?>