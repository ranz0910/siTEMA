<?php
include $_SERVER['DOCUMENT_ROOT'] . '/siTEMA/service/connection.php';

if (session_status() === PHP_SESSION_NONE) { 
    session_start(); 
}

if (isset($_POST['submit_pengajuan'])) {
    $id_user = $_SESSION['id_user'];
    
    // Ambil ID Mahasiswa berdasarkan user yang login
    $query_mhs = mysqli_query($connect, "SELECT id FROM mahasiswa WHERE id_user = '$id_user'");
    $row_mhs = mysqli_fetch_assoc($query_mhs);

    if (!$row_mhs) {
        die("Error: Data profil mahasiswa tidak ditemukan. Silahkan lengkapi profil terlebih dahulu.");
    }

    $id_mahasiswa = $row_mhs['id'];

    // SESUAIKAN: Pastikan nama di $_POST['...'] sama dengan atribut 'name' di form HTML
    $nik            = mysqli_real_escape_string($connect, $_POST['nik']);
    $tempat_lahir   = mysqli_real_escape_string($connect, $_POST['tempat_lahir']);
    $tanggal_lahir  = mysqli_real_escape_string($connect, $_POST['tanggal_lahir']);
    $jenis_kelamin  = mysqli_real_escape_string($connect, $_POST['jenis_kelamin']); 
    $agama          = mysqli_real_escape_string($connect, $_POST['agama']);
    $alamat         = mysqli_real_escape_string($connect, $_POST['alamat']);
    $id_perusahaan  = mysqli_real_escape_string($connect, $_POST['id_perusahaan']);
    $keterangan     = mysqli_real_escape_string($connect, $_POST['keterangan']);
    $status         = "Pending";

    // Query INSERT (Pastikan kolom id_mahasiswa sudah Anda buat di database)
    $query = "INSERT INTO pengajuan_magang (id_mahasiswa, nik, tempat_lahir, tanggal_lahir, jenis_kelamin, agama, alamat, id_perusahaan, keterangan, status) 
              VALUES ('$id_user', '$nik', '$tempat_lahir', '$tanggal_lahir', '$jenis_kelamin', '$agama', '$alamat', '$id_perusahaan', '$keterangan', '$status')";

    if (mysqli_query($connect, $query)) {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <body style='font-family: sans-serif;'>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Pengajuan magang Anda telah terkirim.',
                    showConfirmButton: false,
                    timer: 2000
                }).then(function() {
                    window.location.href = '/siTEMA/index.php?page=riwayat_magang';
                });
            </script>
        </body>";
    } else {
        die("Error database: " . mysqli_error($connect));
    }
}
?>