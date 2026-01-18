<?php
include '../../init.php';
include '../../service/auth.php';
require_once '../../repository/Mahasiswa.php';

// 1. Ambil ID dari URL
$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: ' . BASE_URL . 'layout/read/data_mahasiswa.php');
    exit;
}

// 2. Ambil data lengkap mahasiswa dari Repository
$data = Mahasiswa::getById($id);

if (!$data) {
    echo "<script>alert('Data tidak ditemukan!'); window.location.href='" . BASE_URL . "layout/read/data_mahasiswa.php';</script>";
    exit;
}
?>

<?php include '../../partials/header.php'; ?>

<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="d-flex align-items-center mb-4">
                <h5 class="card-title fw-semibold mb-0 text-primary">Edit Data Mahasiswa</h5>
            </div>

            <form action="<?= BASE_URL ?>process/mahasiswa/save.php" method="POST">
                
                <input type="hidden" name="id_mahasiswa" value="<?= $data['id_mahasiswa'] ?>">
                <input type="hidden" name="id_user" value="<?= $data['id_user'] ?>">

                <div class="card shadow-none border mb-4">
                    <div class="card-header bg-light py-3">
                        <h6 class="mb-0 fw-bold text-dark"><i class="ti ti-lock me-2"></i>Account Form</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-0">
                                <label class="form-label fw-bold">Username</label>
                                <input type="text" name="username" class="form-control" 
                                       value="<?= htmlspecialchars($data['username']) ?>" required>
                            </div>
                            <div class="col-md-6 mb-0">
                                <label class="form-label fw-bold">Password Baru</label>
                                <input type="password" name="password" class="form-control" placeholder="******">
                                <div class="form-text text-danger">*Kosongkan jika tidak ingin mengganti password.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-none border mb-4">
                    <div class="card-header bg-light py-3">
                        <h6 class="mb-0 fw-bold text-dark"><i class="ti ti-id me-2"></i>Personal Detail</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Nama Lengkap</label>
                                <input type="text" name="nama_mahasiswa" class="form-control" 
                                       value="<?= htmlspecialchars($data['nama_mahasiswa']) ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">NIM</label>
                                <input type="text" name="nim" class="form-control" 
                                       value="<?= htmlspecialchars($data['nim']) ?>" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select" required>
                                    <option value="Laki-laki" <?= $data['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                                    <option value="Perempuan" <?= $data['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                                </select>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Email</label>
                                <input type="email" name="email" class="form-control" 
                                       value="<?= htmlspecialchars($data['email']) ?>" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Kontak/WhatsApp</label>
                                <input type="text" name="no_hp" class="form-control" 
                                       value="<?= htmlspecialchars($data['no_hp']) ?>" required>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-bold">Angkatan</label>
                                <input type="number" name="angkatan" class="form-control" 
                                       value="<?= htmlspecialchars($data['angkatan']) ?>" required>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-bold">ID Prodi</label>
                                <input type="number" name="id_prodi" class="form-control" 
                                    value="<?= htmlspecialchars($data['id_prodi']) ?>" required>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Alamat Lengkap</label>
                                <textarea name="alamat" class="form-control" rows="3" required><?= htmlspecialchars($data['alamat']) ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content gap-2 border-top pt-4">
                    <a href="<?= BASE_URL ?>layout/read/data_mahasiswa.php" class="btn btn-outline-danger px-4">Batal</a>
                    <button type="submit" name="submit_edit" class="btn btn-primary px-4 shadow-sm">
                        <i class="ti ti-device-floppy me-1"></i> Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php include '../../partials/footer.php'; ?>