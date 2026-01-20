<?php
include '../../init.php';
include '../../service/auth.php';
include '../../partials/header.php';

$id = $_GET['id'] ?? null;
$data = Jurusan::getById($id);

if (!$data) {
    echo "<script>alert('Data tidak ditemukan!'); window.location.href='" . BASE_URL . "layout/read/data_jurusan.php';</script>";
    exit;
}
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Form Edit Jurusan</h5>

            <form action="<?= BASE_URL ?>process/jurusan/save.php" method="POST">

                <!-- hidden -->
                <input type="hidden" name="id_jurusan" value="<?= $data['id'] ?>">
                <input type="hidden" name="id_user" value="<?= $data['id_user'] ?>">

                <!-- ================= CARD 1 : DATA AKUN ================= -->
                <div class="card shadow-none border mb-4">
                    <div class="card-header bg-light fw-bold">
                        <i class="ti ti-user me-2"></i> Data Akun
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" class="form-control"
                                    value="<?= htmlspecialchars($data['username']) ?>" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    Password Baru
                                </label>
                                <input type="password" name="password" class="form-control" placeholder="********">
                                <small class="text-muted">
                                    * Biarkan kosong jika tidak ingin mengganti password
                                </small>    
                            </div>

                        </div>
                    </div>
                </div>

                <!-- ================= CARD 2 : DATA JURUSAN ================= -->
                <div class="card shadow-none border">
                    <div class="card-header bg-light fw-bold">
                        <i class="ti ti-building-community me-2"></i> Data Jurusan
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Nama Jurusan</label>
                                <input type="text" name="nama_jurusan" class="form-control"
                                    value="<?= htmlspecialchars($data['nama_jurusan']) ?>" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Kode Jurusan</label>
                                <input type="text" name="kode_jurusan" class="form-control"
                                    value="<?= htmlspecialchars($data['kode_jurusan']) ?>" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Email Jurusan</label>
                                <input type="email" name="email_jurusan" class="form-control"
                                    value="<?= htmlspecialchars($data['email_jurusan'] ?? $data['email']) ?>" required>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- ================= BUTTON ================= -->
                <div class="mt-4 d-flex justify-content-end">
                    <a href="<?= BASE_URL ?>layout/read/data_jurusan.php" class="btn btn-outline-danger">
                        Batal
                    </a>
                    <button type="submit" name="update_jurusan" class="btn btn-primary ms-2">
                        Update Data Jurusan
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<?php include '../../partials/footer.php'; ?>