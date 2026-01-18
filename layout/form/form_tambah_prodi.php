<?php
// Cek apakah ada parameter ID untuk mode EDIT
$is_edit = isset($_GET['id']);
$id_prodi = "";
$kode_prodi = ""; // Tambahkan variabel untuk kode prodi
$nama_prodi = "";

if ($is_edit) {
    $id_prodi = mysqli_real_escape_string($connect, $_GET['id']);
    
    // PERBAIKAN: Ambil data dari tabel PRODI, bukan JURUSAN
    $query = mysqli_query($connect, "SELECT * FROM prodi WHERE id = '$id_prodi'");
    $data = mysqli_fetch_assoc($query);
    
    if ($data) {
        $kode_prodi = $data['kode_prodi']; // Ambil kode asli dari DB
        $nama_prodi = $data['nama_prodi'];
    }
}
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4"><?= $is_edit ? 'Form Edit Data Prodi' : 'Form Input Data Prodi' ?></h5>
            <div class="card">
                <div class="card-body">
                    <form action="<?= $is_edit ? 'process/prodi/edit_prodi.php' : 'process/prodi/TambahProdi.php' ?>" method="POST">
                        
                        <?php if ($is_edit): ?>
                            <input type="hidden" name="id_prodi" value="<?= $id_prodi ?>">
                        <?php endif; ?>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="kodeProdi" class="form-label">Kode Prodi</label>
                                <input type="text" name="kode_prodi" class="form-control" id="kodeProdi" 
                                       placeholder="ex: PRODI-001" 
                                       value="<?= $kode_prodi ?>" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="namaProdi" class="form-label">Nama Program Studi</label>
                                <input type="text" name="nama_prodi" class="form-control" id="namaProdi" 
                                       placeholder="Masukkan nama program studi" 
                                       value="<?= $nama_prodi ?>" required>
                            </div>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="confirmCheck" required>
                            <label class="form-check-label" for="confirmCheck">Data yang saya masukkan sudah benar</label>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" name="submit_prodi" class="btn btn-primary">
                                <?= $is_edit ? 'Perbarui Data Prodi' : 'Simpan Data Prodi' ?>
                            </button>
                            <a href="index.php?page=data_program" class="btn btn-outline-danger ms-2">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>