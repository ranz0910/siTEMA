<?php
include $_SERVER['DOCUMENT_ROOT'] . '/siTEMA/service/connection.php';

// 1. Ambil ID dari URL
if (isset($_GET['id'])) {
    $id_prodi = mysqli_real_escape_string($connect, $_GET['id']);
    
    // 2. Query ambil data prodi berdasarkan ID
    $query = mysqli_query($connect, "SELECT * FROM prodi WHERE id = '$id_prodi'");
    $data = mysqli_fetch_assoc($query);

    // Jika data tidak ditemukan, kembalikan ke halaman data prodi
    if (!$data) {
        echo "<script>alert('Data tidak ditemukan!'); window.location='index.php?page=data_prodi';</script>";
        exit;
    }
} else {
    header("Location: index.php?page=data_prodi");
    exit;
}
?>

<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4 text-primary">Form Edit Data Program Studi</h5>
            
            <form action="process/prodi/edit_prodi.php" method="POST">
                <input type="hidden" name="id_prodi" value="<?= $data['id'] ?>">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="kodeProdi" class="form-label fw-bold">Kode Prodi</label>
                        <input type="text" class="form-control bg-light" id="kodeProdi" 
                               value="PRODI-<?= $data['id'] ?>" readonly>
                        <small class="text-muted">Kode prodi digenerate otomatis berdasarkan ID.</small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="namaProdi" class="form-label fw-bold">Nama Program Studi</label>
                        <input type="text" name="nama_prodi" class="form-control" id="namaProdi" 
                               value="<?= htmlspecialchars($data['nama_prodi']) ?>" 
                               placeholder="Masukkan nama program studi" required>
                    </div>
                </div>

                <div class="mb-4 form-check">
                    <input type="checkbox" class="form-check-input" id="confirmCheck" required>
                    <label class="form-check-label" for="confirmCheck">Saya yakin ingin mengubah data ini</label>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" name="submit_prodi" class="btn btn-primary px-4"> Perbarui Data
                    </button>
                    <a href="index.php?page=data_prodi" class="btn btn-light px-4 border">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>