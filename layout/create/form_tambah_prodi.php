<?php
include '../../init.php';
include '../../service/auth.php';

// Inisialisasi variabel
$is_edit = isset($_GET['id']);
$id_prodi = "";
$kode_prodi = ""; 
$nama_prodi = "";

if ($is_edit) {
    // Menggunakan koneksi dari init.php
    $id_prodi = mysqli_real_escape_string($connect, $_GET['id']);
    
    // Ambil data dari tabel prodi
    $query = mysqli_query($connect, "SELECT * FROM prodi WHERE id = '$id_prodi'");
    $data = mysqli_fetch_assoc($query);
    
    if ($data) {
        $kode_prodi = $data['kode_prodi'];
        $nama_prodi = $data['nama_prodi'];
    }
}

include '../../partials/header.php'; 
?>

<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4 text-primary">
                <?= $is_edit ? 'Form Edit Data Program Studi' : 'Form Input Data Program Studi' ?>
            </h5>
            
            <div class="card shadow-none border">
                <div class="card-body">
                    <form action="<?= $is_edit ? BASE_URL . 'process/prodi/edit.php' : BASE_URL . 'process/prodi/save.php' ?>" method="POST">
                        
                        <?php if ($is_edit): ?>
                            <input type="hidden" name="id_prodi" value="<?= $id_prodi ?>">
                        <?php endif; ?>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="kodeProdi" class="form-label fw-bold">Kode Prodi</label>
                                <input type="text" name="kode_prodi" class="form-control" id="kodeProdi" 
                                       placeholder="ex: PRODI-001" 
                                       value="<?= htmlspecialchars($kode_prodi) ?>" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="namaProdi" class="form-label fw-bold">Nama Program Studi</label>
                                <input type="text" name="nama_prodi" class="form-control" id="namaProdi" 
                                       placeholder="Masukkan nama program studi" 
                                       value="<?= htmlspecialchars($nama_prodi) ?>" required>
                            </div>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="confirmCheck" required>
                            <label class="form-check-label" for="confirmCheck">Data yang saya masukkan sudah benar</label>
                        </div>

                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" name="submit_prodi" class="btn btn-primary px-4">
                                <i class="ti ti-device-floppy me-1"></i>
                                <?= $is_edit ? 'Perbarui Data Prodi' : 'Simpan Data Prodi' ?>
                            </button>
                            <a href="<?= BASE_URL ?>layout/data/data_prodi.php" class="btn btn-outline-danger">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../../partials/footer.php'; ?>