<?php
include '../../init.php';
include '../../service/auth.php';
require_once '../../repository/Perusahaan.php';
include '../../partials/header.php';

// ================= VALIDASI ID =================
$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: ' . BASE_URL . 'layout/read/data_perusahaan.php');
    exit;
}

// ================= AMBIL DATA =================
$data = Perusahaan::getById($id);

if (!$data) {
    echo "<script>
        alert('Data perusahaan tidak ditemukan!');
        window.location.href = '" . BASE_URL . "layout/read/data_perusahaan.php';
    </script>";
    exit;
}
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Form Edit Perusahaan</h5>

            <form action="<?= BASE_URL ?>process/perusahaan/save.php" method="POST">

                <!-- ================= HIDDEN ================= -->
                <input type="hidden" name="id_perusahaan" value="<?= $data['id']; ?>">
                <input type="hidden" name="id_user" value="<?= $data['id_user']; ?>">

                <!-- ================= CARD 1 : DATA AKUN ================= -->
                <div class="card shadow-none border mb-4">
                    <div class="card-header bg-light fw-bold">
                        <i class="ti ti-user me-2"></i> Data Akun
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Username</label>
                                <input type="text"
                                    name="username"
                                    class="form-control"
                                    value="<?= htmlspecialchars($data['username']); ?>"
                                    required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Password</label>
                                <input type="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="********">
                                <small class="text-muted">
                                    * Biarkan kosong jika tidak ingin mengganti password
                                </small>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- ================= CARD 2 : DATA PERUSAHAAN ================= -->
                <div class="card shadow-none border mb-4">
                    <div class="card-header bg-light fw-bold">
                        <i class="ti ti-building me-2"></i> Data Perusahaan
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label">NPWP</label>
                                <input type="text"
                                    name="npwp"
                                    class="form-control"
                                    value="<?= htmlspecialchars($data['npwp']); ?>"
                                    required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Perusahaan</label>
                                <input type="text"
                                    name="nama_perusahaan"
                                    class="form-control"
                                    value="<?= htmlspecialchars($data['nama_perusahaan']); ?>"
                                    required>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Alamat Perusahaan</label>
                                <textarea name="alamat_perusahaan"
                                    class="form-control"
                                    rows="3"
                                    required><?= htmlspecialchars($data['alamat_perusahaan']); ?></textarea>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- ================= CARD 3 : KONTAK PERUSAHAAN ================= -->
                <div class="card shadow-none border">
                    <div class="card-header bg-light fw-bold">
                        <i class="ti ti-phone me-2"></i> Kontak Perusahaan
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email Perusahaan</label>
                                <input type="email"
                                    name="email_perusahaan"
                                    class="form-control"
                                    value="<?= htmlspecialchars($data['email']); ?>"
                                    required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">No. Telepon</label>
                                <input type="text"
                                    name="telp_perusahaan"
                                    class="form-control"
                                    value="<?= htmlspecialchars($data['telp_perusahaan']); ?>"
                                    required>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- ================= BUTTON ================= -->
                <div class="mt-4 d-flex justify-content-end">
                    <a href="<?= BASE_URL ?>layout/read/data_perusahaan.php"
                        class="btn btn-outline-danger">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary ms-2">
                        Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php include '../../partials/footer.php'; ?>