<?php
session_start();
include '../../init.php'; 
include '../../service/auth.php';

// Proteksi agar tidak muncul warning jika session kosong
$user_id = $_SESSION['user_id'] ?? null; 
$id_prodi = isset($_GET['id']) ? mysqli_real_escape_string($connect, $_GET['id']) : null;

echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
      <body style='font-family: sans-serif;'>";

if (!$id_prodi) {
    echo "<script>window.location.href = '../../index.php?page=data_prodi';</script>";
    exit;
}

// JIKA LOGIN SEBAGAI SUPER ADMIN (Role 1), Langsung Hapus Tanpa Cek Kepemilikan Jurusan
if ($_SESSION['id_roles'] == 1) {
    $query_hapus = "DELETE FROM prodi WHERE id = '$id_prodi'";
} else {
    // JIKA LOGIN SEBAGAI ADMIN JURUSAN, Cek Kepemilikan
    $query_jurusan = mysqli_query($connect, "SELECT id FROM jurusan WHERE id_user = '$user_id'");
    $data_jurusan = mysqli_fetch_assoc($query_jurusan);
    
    if ($data_jurusan) {
        $id_jurusan_admin = $data_jurusan['id'];
        $query_hapus = "DELETE FROM prodi WHERE id = '$id_prodi' AND id_jurusan = '$id_jurusan_admin'";
    } else {
        $query_hapus = null; // Menandakan akses tidak sah
    }
}

if ($query_hapus) {
    $eksekusi = mysqli_query($connect, $query_hapus);
    if ($eksekusi && mysqli_affected_rows($connect) > 0) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data Program Studi telah dihapus.',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href = '../../index.php?page=data_prodi';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Data tidak ditemukan atau masih terikat data lain.',
            }).then(function() { window.history.back(); });
        </script>";
    }
} else {
    echo "<script>
        Swal.fire({
            icon: 'warning',
            title: 'Akses Ditolak!',
            text: 'Anda tidak memiliki otoritas untuk menghapus data ini.',
        }).then(function() { window.location.href = '../../index.php?page=data_prodi'; });
    </script>";
}
echo "</body>";
?>