<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 1. Perbaikan: Panggil koneksi secara absolut
include $_SERVER['DOCUMENT_ROOT'] . '/siTEMA/service/connection.php';

$id_login = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '');

if (empty($id_login)) {
    echo "<div class='alert alert-danger m-3'>Sesi tidak ditemukan. Silakan login kembali.</div>";
    return;
}

$query = "SELECT * FROM mahasiswa WHERE id_user = '$id_login'";
$result = mysqli_query($connect, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "<div class='alert alert-warning m-3'>Data profil belum diisi.</div>";
    return;
}
?>

<div class="container-fluid">
    <div class="card bg-light-info shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Profil Mahasiswa</h4>
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
            <div class="card">
                <div class="card-body text-center">
                    <?php 
                        $foto_path = !empty($data['foto']) ? 'src/images/profile/' . $data['foto'] : 'src/images/profile/user-1.jpg';
                    ?>
                    <img src="<?= $foto_path ?>" alt="user" class="img-fluid rounded-circle mb-3 shadow-sm" style="width: 120px; height: 120px; object-fit: cover;">
                    
                    <h4 class="fw-semibold"><?= htmlspecialchars($data['nama_mahasiswa']) ?></h4>
                    <p class="text-muted mb-0"><?= htmlspecialchars($data['nim']) ?></p>
                    <span class="badge bg-light-primary text-primary mt-2">Mahasiswa Aktif</span>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-transparent border-bottom">
                    <h5 class="card-title fw-semibold mb-0 py-2">Detail Informasi Pribadi</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Nama Lengkap</div>
                        <div class="col-sm-8 fw-bold"><?= htmlspecialchars($data['nama_mahasiswa']) ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">NIM</div>
                        <div class="col-sm-8 fw-bold"><?= htmlspecialchars($data['nim']) ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Email Address</div>
                        <div class="col-sm-8 fw-bold"><?= htmlspecialchars($data['email']) ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Kontak (HP)</div>
                        <div class="col-sm-8 fw-bold"><?= htmlspecialchars($data['kontak']) ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Program Studi</div>
                        <div class="col-sm-8 fw-bold"><?= htmlspecialchars($data['prodi']) ?></div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-sm-4 text-muted">Alamat Lengkap</div>
                        <div class="col-sm-8 fw-bold"><?= nl2br(htmlspecialchars($data['alamat'])) ?></div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top text-end">
                    <a href="index.php?page=dashboard" class="btn btn-outline-dark me-2">
                        <i class="ti ti-arrow-left me-1"></i> Kembali
                    </a>
                    <a href="index.php?page=edit_profile_mahasiswa" class="btn btn-primary px-4">
                        <i class="ti ti-edit me-1"></i> Edit Profil
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>