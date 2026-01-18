<?php
include '../../init.php';
include '../../service/auth.php';
require_once '../../repository/Perusahaan.php';
?>

<?php include '../../partials/header.php'; ?>

<div class="container-fluid">
    <h3 class="fw-semibold">Form Tambah Perusahaan</h3>
    <br>

    <form action="<?= BASE_URL ?>/process/perusahaan/save.php" method="POST">
        
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4">Account Form</h5>
                
                <div class="row">
                    <div class="col-md-6 mb-0">
                        <label for="username" class="form-label fw-bold">Username</label>
                        <input type="text" name="username" class="form-control" id="username" 
                               placeholder="Masukkan username" required>
                    </div>
                    <div class="col-md-6 mb-0">
                        <label for="password" class="form-label fw-bold">Password</label>
                        <input type="password" name="password" class="form-control" id="password" 
                               placeholder="********" required>
                        <small class="text-muted">*Password ini akan digunakan untuk login mitra</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4">Company Detail</h5>
                
                <div class="row">
                    <div class="col-md-6 mb-0">
                        <label for="nama_perusahaan" class="form-label fw-bold">Nama Perusahaan</label>
                        <input type="text" name="nama_perusahaan" class="form-control" id="nama_perusahaan" 
                               placeholder="Masukkan nama perusahaan" required>
                    </div>
                    <div class="col-md-6 mb-0">
                        <label for="email_perusahaan" class="form-label fw-bold">Email Resmi</label>
                        <input type="email" name="email_perusahaan" class="form-control" id="email_perusahaan" 
                               placeholder="email@perusahaan.com" required>
                    </div>
                    <div class="col-md-6 mb-0">
                        <label for="telp_perusahaan" class="form-label fw-bold">Kontak/Telepon</label>
                        <input type="text" name="telp_perusahaan" class="form-control" id="telp_perusahaan" 
                               placeholder="Nomor telepon/kontak resmi" required>
                    </div>
                    <div class="col-md-6 mb-0">
                        <label for="alamat_perusahaan" class="form-label fw-bold">Alamat Perusahaan</label>
                        <textarea name="alamat_perusahaan" class="form-control" id="alamat_perusahaan" 
                                  rows="1" placeholder="Alamat lengkap perusahaan" required></textarea>
                    </div>
                </div>

                <div class="text mt-3 border-top pt-3">
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="confirmCheck" required>
                        <label class="form-check-label" for="confirmCheck">Data yang saya masukkan sudah benar</label>
                    </div>

                    <button type="submit" name="submit_perusahaan" class="btn btn-primary px-4 shadow-sm">
                        Simpan Data & Akun
                    </button>
                    <a href="<?= BASE_URL ?>/layout/read/data_perusahaan.php" class="btn btn-outline-danger ms-2">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

<?php include '../../partials/footer.php'; ?>