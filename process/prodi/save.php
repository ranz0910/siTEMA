<?php
include '../../init.php';
include '../../service/auth.php';

// Pastikan request datang dari POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . BASE_URL . 'layout/read/data_prodi.php');
    exit;
}

// Cek apakah ini mode Update (ada id_prodi) atau mode Create
// Kita gunakan id_prodi sebagai penanda karena di form edit Anda menggunakan name="id_prodi"
$isUpdate = isset($_POST['id_prodi']) && !empty($_POST['id_prodi']);

// Ambil data nama_prodi (digunakan baik di Create maupun Update)
$nama_prodi = mysqli_real_escape_string($connect, $_POST['nama_prodi']);

if ($isUpdate) {
    // ==========================================
    // LOGIKA UPDATE (Data sudah ada)
    // ==========================================
    $id_prodi = mysqli_real_escape_string($connect, $_POST['id_prodi']); 

    $query = "UPDATE prodi SET 
                nama_prodi = '$nama_prodi' 
              WHERE id = '$id_prodi'";

    if (mysqli_query($connect, $query)) {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <body style='font-family: sans-serif;'>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data program studi telah diperbarui.',
                    showConfirmButton: false,
                    timer: 2000
                }).then(function() {
                    window.location.href = '" . BASE_URL . "layout/read/data_prodi.php';
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
    
    // Query INSERT ke tabel prodi
    $query = "INSERT INTO prodi (nama_prodi) VALUES ('$nama_prodi')";

    if (mysqli_query($connect, $query)) {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <body style='font-family: sans-serif;'>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data Program Studi berhasil ditambahkan.',
                    showConfirmButton: false,
                    timer: 2000
                }).then(function() {
                    window.location.href = '" . BASE_URL . "layout/read/data_prodi.php';
                });
            </script>
        </body>";
    } else {
        die("Error database: " . mysqli_error($connect));
    }
}
?>