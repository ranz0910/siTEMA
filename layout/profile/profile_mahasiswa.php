<?php
// 1. Pastikan session dimulai untuk mengambil ID user yang login
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 2. Mengambil ID User dari session. 
// Karena di database Anda kolomnya adalah 'id_user', pastikan saat login Anda menyimpan session dengan nama 'id_user'
$id_login = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '');

if (empty($id_login)) {
    echo "<div class='alert alert-danger'>Sesi tidak ditemukan. Silakan login kembali untuk melihat profil.</div>";
    return;
}

// 3. Query disesuaikan dengan struktur tabel di gambar (kolom: nama_mahasiswa, nim, email, kontak, jurusan, alamat)
$query = "SELECT * FROM mahasiswa WHERE id_user = '$id_login'";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    echo "<div class='alert alert-danger'>Error Database: " . mysqli_error($koneksi) . "</div>";
    return;
}

$data = mysqli_fetch_assoc($result);

// Jika data mahasiswa tidak ditemukan di database
if (!$data) {
    echo "<div class='alert alert-warning'>Data profil mahasiswa untuk ID User ini belum diisi di database.</div>";
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
                    <img src="src/images/profile/user-1.jpg" alt="user" class="img-fluid rounded-circle mb-3" width="120">
                    <h4 class="fw-semibold"><?= htmlspecialchars($data['nama_mahasiswa']) ?></h4>
                    <p class="text-muted mb-0"><?= htmlspecialchars($data['nim']) ?></p>
                    <span class="badge bg-light-primary text-primary mt-2">Status: Mahasiswa</span>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-transparent border-bottom">
                    <h5 class="card-title fw-semibold mb-0 py-2">Detail Informasi Pribadi</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <h6 class="mb-0 text-muted">Nama Lengkap</h6>
                        </div>
                        <div class="col-sm-8">
                            <p class="mb-0 fw-bold"><?= htmlspecialchars($data['nama_mahasiswa']) ?></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <h6 class="mb-0 text-muted">NIM</h6>
                        </div>
                        <div class="col-sm-8">
                            <p class="mb-0 fw-bold"><?= htmlspecialchars($data['nim']) ?></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <h6 class="mb-0 text-muted">Email Address</h6>
                        </div>
                        <div class="col-sm-8">
                            <p class="mb-0 fw-bold"><?= htmlspecialchars($data['email']) ?></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <h6 class="mb-0 text-muted">Nomor Kontak (HP)</h6>
                        </div>
                        <div class="col-sm-8">
                            <p class="mb-0 fw-bold"><?= htmlspecialchars($data['kontak']) ?></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <h6 class="mb-0 text-muted">Jurusan</h6>
                        </div>
                        <div class="col-sm-8">
                            <p class="mb-0 fw-bold"><?= htmlspecialchars($data['jurusan']) ?></p>
                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-sm-4">
                            <h6 class="mb-0 text-muted">Alamat Lengkap</h6>
                        </div>
                        <div class="col-sm-8">
                            <p class="mb-0 fw-bold"><?= nl2br(htmlspecialchars($data['alamat'])) ?></p>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top text-end">
                    <button class="btn btn-primary px-4">Edit Profil</button>
                </div>
            </div>
        </div>
    </div>
</div>