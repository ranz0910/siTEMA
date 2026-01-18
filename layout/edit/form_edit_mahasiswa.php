<?php
include '../../init.php';
include '../../service/auth.php';
require_once '../../repository/Mahasiswa.php'; // Asumsi kamu punya file ini

// Ambil ID dari URL
$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: ' . BASE_URL . 'layout/read/data_mahasiswa.php');
    exit;
}

// Ambil data lengkap mahasiswa (termasuk username dari tabel users)
// Disarankan menggunakan fungsi di Repository agar lebih bersih
$data = Mahasiswa::getById($id);

if (!$data) {
    echo "<script>alert('Data tidak ditemukan!'); window.location.href='" . BASE_URL . "layout/read/data_mahasiswa.php';</script>";
    exit;
}
?>

<?php include '../../partials/header.php'; ?>

<div class="container-fluid">
    <h3 class="fw-semibold">Form Edit Mahasiswa</h3>
    <br>

    <form action="<?= BASE_URL ?>process/mahasiswa/update.php" method="POST">
        
        <input type="hidden" name="id_mhs" value="<?= $data['id'] ?>">
        <input type="hidden" name="id_user" value="<?= $data['id_user'] ?>">

        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4">Account Form</h5>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Username</label>
                        <input type="text" name="username" class="form-control" 
                               value="<?= htmlspecialchars($data['username']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Password Baru</label>
                        <input type="password" name="password" class="form-control" 
                               placeholder="******">
                        <small class="text-muted">*Kosongkan jika tidak ingin mengganti password</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4">Personal Detail</h5>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nama Lengkap</label>
                        <input type="text" name="nama_mahasiswa" class="form-control" 
                               value="<?= htmlspecialchars($data['nama_mahasiswa']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">NIM</label>
                        <input type="text" name="nim_mahasiswa" class="form-control" 
                               value="<?= htmlspecialchars($data['nim']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Program Studi</label>
                        <input type="text" name="prodi_mahasiswa" class="form-control" 
                               value="<?= htmlspecialchars($data['prodi']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" name="email_mahasiswa" class="form-control" 
                               value="<?= htmlspecialchars($data['email']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Kontak/WhatsApp</label>
                        <input type="text" name="kontak_mahasiswa" class="form-control" 
                               value="<?= htmlspecialchars($data['kontak']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Alamat</label>
                        <input type="text" name="alamat_mahasiswa" class="form-control" 
                               value="<?= htmlspecialchars($data['alamat']) ?>" required>
                    </div>
                </div>

                <div class="text-end mt-3 border-top pt-3">
                    <a href="<?= BASE_URL ?>layout/read/data_mahasiswa.php" class="btn btn-outline-danger me-2">Batal</a>
                    <button type="submit" name="update_mahasiswa" class="btn btn-primary px-4 shadow-sm">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<?php include '../../partials/footer.php'; ?>