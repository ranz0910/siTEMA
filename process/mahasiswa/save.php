<?php
session_start();
include '../../init.php';
include '../../service/auth.php';
require_once '../../repository/Mahasiswa.php';
require_once '../../repository/Prodi.php';

// ================= PROTEKSI METHOD =================
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . BASE_URL . 'layout/read/data_mahasiswa.php');
    exit;
}

// ================= CEK LOGIN =================
if (!isset($_SESSION['user_id'])) {
    header("Location: " . BASE_URL . "index.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// ================= AMBIL ID JURUSAN DARI USER =================
$q = mysqli_query($koneksi, "SELECT id FROM jurusan WHERE id_user = '$user_id'");
$dataJurusan = mysqli_fetch_assoc($q);

if (!$dataJurusan) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: 'Jurusan tidak ditemukan untuk user ini.'
        }).then(() => window.location.href='" . BASE_URL . "layout/read/data_mahasiswa.php');
    </script>";
    exit;
}

$idJurusan = $dataJurusan['id'];

// ================= SWEETALERT =================
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
<body style='font-family:sans-serif;'>";

// ================= CEK MODE =================
$isUpdate = isset($_POST['id_mahasiswa']) && !empty($_POST['id_mahasiswa']);

$data = [
    'username'       => $_POST['username'],
    'password'       => $_POST['password'] ?? '',
    'email'          => $_POST['email'],
    'nim'            => $_POST['nim'],
    'nama_mahasiswa' => $_POST['nama_mahasiswa'],
    'jenis_kelamin'  => $_POST['jenis_kelamin'],
    'alamat'         => $_POST['alamat'],
    'angkatan'       => $_POST['angkatan'],
    'no_hp'          => $_POST['no_hp'],
    'id_prodi'       => $_POST['id_prodi'],
];

if ($isUpdate) {
    $data['id_mahasiswa'] = $_POST['id_mahasiswa'];
    $data['id_user']      = $_POST['id_user'];
}

// Pastikan prodi milik jurusan login
$prodi = Prodi::getById($data['id_prodi']);
if (!$prodi || $prodi['id_jurusan'] != $idJurusan) {
    echo "<script>
        Swal.fire('Gagal!', 'Prodi tidak valid untuk jurusan Anda.', 'error')
        .then(() => window.history.back());
    </script>";
    exit;
}

// ================= SIMPAN / UPDATE =================
if ($isUpdate) {
    $result = Mahasiswa::update($data);
    if ($result['status']) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data mahasiswa berhasil diperbarui.',
                showConfirmButton: true
            }).then(() => window.location.href='" . BASE_URL . "layout/read/data_mahasiswa.php');
        </script>";
    } else {
        echo "<script>
            Swal.fire('Gagal!', '{$result['msg']}', 'error')
            .then(() => window.history.back());
        </script>";
    }
} else {
    $result = Mahasiswa::create($data);
    if ($result['status']) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Mahasiswa berhasil ditambahkan.',
                showConfirmButton: true
            }).then(() => window.location.href='" . BASE_URL . "layout/read/data_mahasiswa.php');
        </script>";
    } else {
        echo "<script>
            Swal.fire('Peringatan!', '{$result['msg']}', 'warning')
            .then(() => window.history.back());
        </script>";
    }
}

echo "</body>";
