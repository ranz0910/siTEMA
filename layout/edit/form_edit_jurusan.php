<?php
// layout/edit/form_edit_jurusan.php
$id = $_GET['id'] ?? null;
$data = Jurusan::getById($id);

if (!$data) {
    echo "<script>alert('Data tidak ditemukan!'); window.location.href='index.php?page=data_jurusan';</script>";
    exit;
}
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Form Edit Jurusan</h5>
            
            <div class="card shadow-none border">
                <div class="card-body">
                    <form action="<?= BASE_URL ?>process/jurusan/update.php" method="POST">
                        
                        <input type="hidden" name="id_jurusan" value="<?= $data['id'] ?>">
                        <input type="hidden" name="id_user" value="<?= $data['id_user'] ?>">
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="username" class="form-label text-dark fw-bold">Username</label>
                                <input type="text" name="username" class="form-control" id="username" 
                                       value="<?= htmlspecialchars($data['username']) ?>" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label text-dark fw-bold">Password Baru (Kosongkan jika tidak diubah)</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="********">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="namaJurusan" class="form-label text-dark fw-bold">Nama Jurusan</label>
                                <input type="text" name="nama_jurusan" class="form-control" id="namaJurusan" 
                                       value="<?= htmlspecialchars($data['nama_jurusan']) ?>" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="kodeJurusan" class="form-label text-dark fw-bold">Kode Jurusan</label>
                                <input type="text" name="kode_jurusan" class="form-control" id="kodeJurusan" 
                                       value="<?= htmlspecialchars($data['kode_jurusan'] ?? '') ?>" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="ketuaJurusan" class="form-label text-dark fw-bold">Ketua Jurusan</label>
                                <input type="text" name="ketua_jurusan" class="form-control" id="ketuaJurusan" 
                                       value="<?= htmlspecialchars($data['kajur'] ?? '') ?>" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="emailJurusan" class="form-label text-dark fw-bold">Email Jurusan</label>
                                <input type="email" name="email_jurusan" class="form-control" id="emailJurusan" 
                                       value="<?= htmlspecialchars($data['email'] ?? $data['email_jurusan']) ?>" required>
                            </div>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="confirmCheck" required>
                            <label class="form-check-label" for="confirmCheck">Saya yakin ingin mengubah data ini</label>
                        </div>

                        <div class="mt-4">
                            <button type="submit" name="update_jurusan" class="btn btn-primary px-4 fw-bold">
                                <i class="ti ti-device-floppy me-1"></i> Update Data
                            </button>
                            <a href="index.php?page=data_jurusan" class="btn btn-outline-danger ms-2">
                                Batal
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>