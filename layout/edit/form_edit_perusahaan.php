<?php
include '../../init.php';
include '../../service/auth.php';
require_once '../../repository/Perusahaan.php';

// Ambil ID dari URL
$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: ' . BASE_URL . 'layout/read/data_perusahaan.php');
    exit;
}

// Ambil data lengkap perusahaan melalui Repository
$data = Perusahaan::getById($id);

if (!$data) {
    echo "<script>alert('Data perusahaan tidak ditemukan!'); window.location.href='" . BASE_URL . "layout/read/data_perusahaan.php';</script>";
    exit;
}
?>

<?php include '../../partials/header.php'; ?>

<div class="container-fluid">
    <h3 class="fw-semibold">Form Edit Perusahaan</h3>
    <br>

    <form action="<?= BASE_URL ?>/process/perusahaan/save.php" method="POST">
        
        <input type="hidden" name="id_perusahaan" value="<?= $data['id'] ?>">
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
                        <small class="text-muted">*Kosongkan jika tidak ingin mengganti password akun perusahaan</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4">Company Detail</h5>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nama Perusahaan</label>
                        <input type="text" name="nama_perusahaan" class="form-control" 
                               value="<?= htmlspecialchars($data['nama_perusahaan']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Email Resmi</label>
                        <input type="email" name="email_perusahaan" class="form-control" 
                               value="<?= htmlspecialchars($data['email_perusahaan']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Kontak/Telepon</label>
                        <input type="text" name="telp_perusahaan" class="form-control" 
                               value="<?= htmlspecialchars($data['telp_perusahaan']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Alamat Perusahaan</label>
                        <textarea name="alamat_perusahaan" class="form-control" rows="1" required><?= htmlspecialchars($data['alamat_perusahaan']) ?></textarea>
                    </div>
                </div>

                <div class="text mt-3 border-top pt-3">
                    <button type="submit" name="update_perusahaan" class="btn btn-primary px-4 shadow-sm">
                        Simpan Perubahan
                    </button>
                    <a href="<?= BASE_URL ?>/layout/read/data_perusahaan.php" class="btn btn-outline-danger me-2">Batal</a>                    
                </div>
            </div>
        </div>
    </form>
</div>

<?php include '../../partials/footer.php'; ?>