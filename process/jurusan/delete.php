<?php
session_start();
include '../../init.php';
include '../../service/auth.php';

echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
<body style='font-family:sans-serif;'>";

// ================= VALIDASI ID =================
$id_jurusan = $_GET['id'] ?? null;

if (!$id_jurusan) {
    echo "<script>
        window.location.href = '../../index.php?page=data_jurusan';
    </script>";
    exit;
}

// ================= ROLE CHECK =================
// Role:
// 1 = Super Admin
// 2 = Admin Jurusan

if ($_SESSION['id_roles'] == 1) {
    // ================= SUPER ADMIN =================
    $result = Jurusan::delete($id_jurusan);
} else {
    // ================= ADMIN JURUSAN =================
    $user_id = $_SESSION['user_id'] ?? null;

    if (!$user_id) {
        aksesDitolak();
        exit;
    }

    // Ambil jurusan milik admin
    $jurusan = mysqli_query(
        $koneksi,
        "SELECT id FROM jurusan WHERE id_user = '$user_id'"
    );
    $data = mysqli_fetch_assoc($jurusan);

    if (!$data || $data['id'] != $id_jurusan) {
        aksesDitolak();
        exit;
    }

    $result = Jurusan::delete($id_jurusan);
}

// ================= RESPONSE =================
if ($result['status']) {
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Data jurusan berhasil dihapus.',
            showConfirmButton: true
        }).then(() => {
            window.location.href = '" . BASE_URL . "layout/read/data_jurusan.php';
        });
    </script>";
} else {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{$result['msg']}'
        }).then(() => window.history.back());
    </script>";
}

echo "</body>";

// ================= HELPER =================
function aksesDitolak()
{
    echo "<script>
        Swal.fire({
            icon: 'warning',
            title: 'Akses Ditolak!',
            text: 'Anda tidak memiliki otoritas untuk menghapus data ini.'
        }).then(() => {
            window.location.href = '" . BASE_URL . "layout/read/data_jurusan.php';
        });
    </script>";
}
