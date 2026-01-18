<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 1. Panggil koneksi secara absolut (Gunakan variabel $connect sesuai image_21a105)
include $_SERVER['DOCUMENT_ROOT'] . '/siTEMA/service/connection.php';

// Cek ID dari URL (untuk Admin) atau dari Session (untuk User Jurusan yang login)
$id_jurusan = isset($_GET['id']) ? mysqli_real_escape_string($connect, $_GET['id']) : '';

// Jika diakses melalui menu profil sendiri, ambil id_user dari session
if (empty($id_jurusan)) {
    $id_user_login = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : '';
    
    if (!empty($id_user_login)) {
        // Cari ID jurusan berdasarkan id_user yang sedang login
        $query_find = "SELECT id FROM jurusan WHERE id_user = '$id_user_login'";
        $res_find = mysqli_query($connect, $query_find);
        $data_find = mysqli_fetch_assoc($res_find);
        $id_jurusan = $data_find['id'] ?? '';
    }
}

if (empty($id_jurusan)) {
    echo "<div class='alert alert-danger m-3'>Error: ID Jurusan tidak ditemukan dalam URL atau Sesi.</div>";
    return;
}

// 2. Query mengambil detail data dari tabel 'jurusan'
$query = "SELECT * FROM jurusan WHERE id = '$id_jurusan'";
$result = mysqli_query($connect, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "<div class='alert alert-warning m-3'>Data profil jurusan tidak tersedia.</div>";
    return;
}
?>

<div class="container-fluid">
    <div class="card bg-light-info shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Profil Jurusan</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">Lihat Profil</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center bg-light-primary rounded-circle mx-auto mb-3" style="width: 120px; height: 120px;">
                        <i class="ti ti-school fs-10 text-primary"></i>
                    </div>
                    
                    <h4 class="fw-semibold"><?= htmlspecialchars($data['nama_jurusan']) ?></h4>
                    <p class="text-muted mb-0">ID Jurusan: <?= htmlspecialchars($data['id']) ?></p>
                    <span class="badge bg-light-success text-success mt-2 border border-success">Status: Aktif</span>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-transparent border-bottom">
                    <h5 class="card-title fw-semibold mb-0 py-2">Detail Informasi Jurusan</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Nama Resmi Jurusan</div>
                        <div class="col-sm-8 fw-bold text-uppercase"><?= htmlspecialchars($data['nama_jurusan']) ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">ID Pengelola (User)</div>
                        <div class="col-sm-8 fw-bold text-primary">USR-0<?= htmlspecialchars($data['id_user']) ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Kode Jurusan</div>
                        <div class="col-sm-8 fw-bold">JRS-<?= htmlspecialchars($data['id']) ?></div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-sm-4 text-muted">Keterangan</div>
                        <div class="col-sm-8 fw-bold">Merupakan entitas jurusan induk di dalam sistem informasi magang.</div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top text-end">
                    <a href="index.php?page=dashboard" class="btn btn-outline-dark me-2">
                        <i class="ti ti-arrow-left me-1"></i> Kembali
                    </a>
                    <a href="index.php?page=edit_profile_jurusan&id=<?= $data['id'] ?>" class="btn btn-primary px-4">
                        <i class="ti ti-edit me-1"></i> Edit Profil
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>