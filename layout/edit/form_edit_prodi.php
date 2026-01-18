<?php
include '../../init.php';
include '../../service/auth.php';
require_once '../../repository/Prodi.php'; // Asumsi kamu punya file ini

// Ambil ID dari URL
$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: ' . BASE_URL . 'layout/read/data_prodi.php');
    exit;
}

// Ambil data prodi berdasarkan ID menggunakan Repository atau Query Connect
$id_prodi = mysqli_real_escape_string($connect, $id);
$query = mysqli_query($connect, "SELECT * FROM prodi WHERE id = '$id_prodi'");
$data = mysqli_fetch_assoc($query);

// Jika data tidak ditemukan
if (!$data) {
    echo "<script>alert('Data tidak ditemukan!'); window.location.href='" . BASE_URL . "layout/read/data_prodi.php';</script>";
    exit;
}

include '../../partials/header.php'; 
?>

<div class="container-fluid">
    <h3 class="fw-semibold">Form Edit Program Studi</h3>
    <br>

    <form action="<?= BASE_URL ?>process/prodi/update.php" method="POST">
        <input type="hidden" name="id_prodi" value="<?= $data['id'] ?>">

        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4 text-primary">Prodi Detail</h5>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="kodeProdi" class="form-label fw-bold">Kode Prodi</label>
                        <input type="text" class="form-control bg-light" id="kodeProdi" 
                               value="<?= htmlspecialchars($data['kode_prodi'] ?? 'PRODI-'.$data['id']) ?>" readonly>
                        <small class="text-muted">Kode prodi bersifat tetap (Read-only).</small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="namaProdi" class="form-label fw-bold">Nama Program Studi</label>
                        <input type="text" name="nama_prodi" class="form-control" id="namaProdi" 
                               value="<?= htmlspecialchars($data['nama_prodi']) ?>" 
                               placeholder="Masukkan nama program studi" required>
                    </div>
                </div>

                <div class="mb-4 mt-2 form-check">
                    <input type="checkbox" class="form-check-input" id="confirmCheck" required>
                    <label class="form-check-label" for="confirmCheck">Saya yakin ingin mengubah data ini</label>
                </div>

                <div class="text-end border-top pt-3">
                    <a href="<?= BASE_URL ?>layout/read/data_prodi.php" class="btn btn-outline-danger me-2">Batal</a>
                    <button type="submit" name="submit_prodi" class="btn btn-primary px-4 shadow-sm">
                        Perbarui Data
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<?php include '../../partials/footer.php'; ?>