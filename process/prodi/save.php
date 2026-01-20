<?php
include '../../init.php';
include '../../service/auth.php';
require_once '../../repository/Prodi.php';

// ================= PROTEKSI METHOD =================
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . BASE_URL . 'layout/read/data_prodi.php');
    exit;
}

// ================= CEK LOGIN =================
if (!isset($_SESSION['user_id'])) {
    header("Location: " . BASE_URL . "index.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// ================= AMBIL ID JURUSAN DARI USER =================
$q = mysqli_query(
    $koneksi,
    "SELECT id FROM jurusan WHERE id_user = '$user_id'"
);

$dataJurusan = mysqli_fetch_assoc($q);

if (!$dataJurusan) {
    echo "Jurusan tidak ditemukan untuk user ini.";
    exit;
}

$idJurusan = $dataJurusan['id'];

// ================= SWEETALERT =================
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
<body style='font-family:sans-serif;'>";

// ================= CEK MODE =================
$isUpdate = isset($_POST['id_prodi']) && !empty($_POST['id_prodi']);

if ($isUpdate) {

    /* ================= UPDATE ================= */
    $data = [
        'id_prodi'   => $_POST['id_prodi'],
        'id_jurusan' => $idJurusan, // 🔐 hasil query, bukan session
        'kode_prodi' => $_POST['kode_prodi'],
        'nama_prodi' => $_POST['nama_prodi'],
        'jenjang'    => $_POST['jenjang'],
    ];

    $update = Prodi::update($data);

    if ($update) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data program studi berhasil diperbarui.',
                showConfirmButton: true
            }).then(() => {
                window.location.href = '" . BASE_URL . "layout/read/data_prodi.php';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire('Gagal!', 'Gagal memperbarui data prodi.', 'error')
            .then(() => window.history.back());
        </script>";
    }
} else {

    /* ================= CREATE ================= */
    $data = [
        'id_jurusan' => $idJurusan, // 🔥 otomatis dari user login
        'kode_prodi' => $_POST['kode_prodi'],
        'nama_prodi' => $_POST['nama_prodi'],
        'jenjang'    => $_POST['jenjang'],
    ];

    $create = Prodi::create($data);

    if ($create['status']) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Program studi berhasil ditambahkan.',
                showConfirmButton: true
            }).then(() => {
                window.location.href = '" . BASE_URL . "layout/read/data_prodi.php';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire('Peringatan!', '{$create['msg']}', 'warning')
            .then(() => window.history.back());
        </script>";
    }
}

echo "</body>";
