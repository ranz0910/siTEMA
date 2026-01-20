<?php
session_start();
include '../../init.php';
include '../../service/auth.php';
require_once '../../repository/lowongan_magang.php';

echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
<body style='font-family:sans-serif;'>";

// ================= VALIDASI ID =================
$id_lowongan = $_GET['id'] ?? null;

if (!$id_lowongan) {
  echo "<script>
        window.location.href = '" . BASE_URL . "layout/read/data_lowongan_magang.php';
    </script>";
  exit;
}

// Ambil user_id dan role
$user_id = $_SESSION['user_id'] ?? null;
$role_id = $_SESSION['id_roles'] ?? null;

// ================= ROLE CHECK =================
// Misal: role 1 = Super Admin, role 2 = Perusahaan/HR
if (!$user_id) {
  aksesDitolak();
  exit;
}

// ================= HAPUS LOWONGAN =================
$result = Lowongan::delete($id_lowongan, $user_id);

// ================= RESPONSE =================
if ($result['status']) {
  echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Lowongan berhasil dihapus.',
            showConfirmButton: true
        }).then(() => {
            window.location.href = '" . BASE_URL . "layout/read/data_lowongan_magang.php';
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
            text: 'Anda tidak memiliki otoritas untuk menghapus lowongan ini.'
        }).then(() => {
            window.location.href = '" . BASE_URL . "layout/read/data_lowongan_magang.php';
        });
    </script>";
}
