<?php
session_start();
include '../../init.php'; 
include '../../service/auth.php';
require_once '../../repository/Mahasiswa.php';

// Ambil ID dari URL dan proteksi session
$user_id_login = $_SESSION['user_id'] ?? null; 
$id_mhs_target = isset($_GET['id']) ? mysqli_real_escape_string($connect, $_GET['id']) : null;

echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
      <body style='font-family: sans-serif;'>";

// 1. Validasi awal jika ID tidak ada
if (!$id_mhs_target) {
    echo "<script>window.location.href = '" . BASE_URL . "layout/read/data_mahasiswa.php';</script>";
    exit;
}

// 2. Logika Pengecekan Otoritas (Mirip dengan Program Prodi)
$boleh_hapus = true;

if ($_SESSION['id_roles'] == 1 && $_SESSION['id_roles'] == 2) { 
    // Super Admin: Selalu boleh hapus
    $boleh_hapus = true;
} else {
    // Admin Jurusan: Cek apakah mahasiswa yang dihapus berasal dari jurusannya
    $query_jurusan = mysqli_query($connect, "SELECT id FROM jurusan WHERE id_user = '$user_id_login'");
    $data_jurusan = mysqli_fetch_assoc($query_jurusan);
    
    if ($data_jurusan) {
        $id_jurusan_admin = $data_jurusan['id'];
        
        // Cek apakah mahasiswa target berada di bawah prodi yang dimiliki jurusan admin tersebut
        $check_mhs = mysqli_query($connect, "
            SELECT m.id FROM mahasiswa m
            JOIN prodi p ON m.id_prodi = p.id
            WHERE m.id = '$id_mhs_target' AND p.id_jurusan = '$id_jurusan_admin'
        ");
        
        if (mysqli_num_rows($check_mhs) > 0) {
            $boleh_hapus = true;
        }
    }
}

// 3. Eksekusi Penghapusan
if ($boleh_hapus) {
    // Menggunakan fungsi delete dari Repository Mahasiswa yang sudah menangani transaksi (Mahasiswa + User)
    $result = Mahasiswa::delete($id_mhs_target);

    if ($result['status']) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data Mahasiswa dan Akun User telah dihapus.',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href = '" . BASE_URL . "layout/read/data_mahasiswa.php';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Error: " . $result['msg'] . "',
            }).then(function() { window.history.back(); });
        </script>";
    }
} else {
    // Jika tidak memiliki akses
    echo "<script>
        Swal.fire({
            icon: 'warning',
            title: 'Akses Ditolak!',
            text: 'Anda tidak memiliki otoritas untuk menghapus data mahasiswa ini.',
        }).then(function() { 
            window.location.href = '" . BASE_URL . "layout/read/data_mahasiswa.php'; 
        });
    </script>";
}

echo "</body>";
?>