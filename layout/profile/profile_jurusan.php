<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Menggunakan path absolut untuk keamanan koneksi sesuai struktur siTEMA
include $_SERVER['DOCUMENT_ROOT'] . '/siTEMA/init.php'; 

// 1. Ambil ID dari URL (biasanya digunakan oleh Admin saat melihat profil jurusan lain)
$id_jurusan = isset($_GET['id']) ? mysqli_real_escape_string($connect, $_GET['id']) : '';

// 2. Jika ID di URL kosong, ambil ID berdasarkan User yang sedang login (Session)
if (empty($id_jurusan)) {
    // Sesuai perbaikan login sebelumnya, kita gunakan 'user_id'
    $id_user_login = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
    
    if (!empty($id_user_login)) {
        // Mencari relasi di tabel jurusan berdasarkan siapa yang login
        $query_find = "SELECT id FROM jurusan WHERE id_user = '$id_user_login'";
        $res_find = mysqli_query($connect, $query_find);
        $data_find = mysqli_fetch_assoc($res_find);
        $id_jurusan = $data_find['id'] ?? '';
    }
}

// 3. Validasi Akhir jika data tidak ditemukan
if (empty($id_jurusan)) {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Akses Ditolak',
            text: 'Data profil jurusan tidak ditemukan atau akun belum terhubung.',
            confirmButtonText: 'Kembali'
        }).then(() => { window.location.href = 'index.php'; });
    </script>";
    return;
}

// 4. Query utama mengambil detail data jurusan
$query = "SELECT * FROM jurusan WHERE id = '$id_jurusan'";
$result = mysqli_query($connect, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "<div class='alert alert-warning m-3'>Profil tidak tersedia di database.</div>";
    return;
}
?>

<div class="container-fluid">
    <div class="card bg-light-info shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Informasi Lembaga</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="index.php">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Profil Jurusan</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-3 text-center mb-n5">
                    <img src="<?= BASE_URL; ?>src/images/breadcrumb/ChatBc.png" alt="" class="img-fluid mb-n4">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center bg-light-primary rounded-circle mx-auto mb-3" style="width: 110px; height: 110px;">
                        <i class="ti ti-school fs-10 text-primary"></i>
                    </div>
                    
                    <h4 class="fw-bold mb-1"><?= htmlspecialchars($data['nama_jurusan']) ?></h4>
                    <p class="text-muted small">Kode Institusi: JRS-0<?= htmlspecialchars($data['id']) ?></p>
                    <div class="d-flex justify-content-center gap-2 mt-3">
                        <span class="badge bg-primary rounded-3 fw-semibold">Internal</span>
                        <span class="badge bg-light-success text-success rounded-3 fw-semibold">Verified</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="card-title fw-semibold mb-0">Detail Profil</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-sm-4">
                            <p class="mb-0 text-muted">Nama Jurusan</p>
                        </div>
                        <div class="col-sm-8">
                            <h6 class="fw-semibold mb-0"><?= htmlspecialchars($data['nama_jurusan']) ?></h6>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-4">
                            <p class="mb-0 text-muted">ID Pengelola (Auth)</p>
                        </div>
                        <div class="col-sm-8">
                            <h6 class="fw-semibold mb-0 text-primary">UID-<?= htmlspecialchars($data['id_user']) ?></h6>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-4">
                            <p class="mb-0 text-muted">Status Sistem</p>
                        </div>
                        <div class="col-sm-8">
                            <h6 class="fw-semibold mb-0 text-success">Aktif (Sistem Informasi Magang)</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <p class="mb-0 text-muted">Deskripsi</p>
                        </div>
                        <div class="col-sm-8">
                            <p class="mb-0">Entitas pengelola data magang mahasiswa pada tingkat Jurusan di lingkungan Politeknik/Universitas.</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white border-top py-3 text-end">
                    <a href="index.php" class="btn btn-light-secondary font-medium text-secondary px-4 me-2">
                        <i class="ti ti-arrow-left fs-4 me-1"></i> Dashboard
                    </a>
                    <a href="index.php?page=edit_profile_jurusan&id=<?= $data['id'] ?>" class="btn btn-primary px-4">
                        <i class="ti ti-edit fs-4 me-1"></i> Perbarui Data
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>