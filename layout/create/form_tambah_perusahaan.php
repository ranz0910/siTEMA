<?php
include '../../init.php';
include '../../service/auth.php';
?>

<?php include '../../partials/header.php'; ?>

<div class="container-fluid">
  <div class="card shadow-sm">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4 text-primary">Form Tambah Perusahaan</h5>
      
      <div class="card shadow-none border">
        <div class="card-body">
          <form action="<?= BASE_URL ?>process/perusahaan/save.php" method="POST">

            <div class="row mb-3">
              <div class="col-md-6">
                <label for="username" class="form-label fw-bold">Username</label>
                <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan username" required>
              </div>
              <div class="col-md-6">
                <label for="password" class="form-label fw-bold">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="********" required>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="namaPerusahaan" class="form-label fw-bold">Nama Perusahaan</label>
                <input type="text" name="nama_perusahaan" class="form-control" id="nama_perusahaan" placeholder="Masukkan nama perusahaan" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="emailPerusahaan" class="form-label fw-bold">Email Perusahaan</label>
                <input type="email" name="email_perusahaan" class="form-control" id="email" placeholder="email@perusahaan.com" required>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="alamatPerusahaan" class="form-label fw-bold">Alamat</label>
                <input type="text" name="alamat_perusahaan" class="form-control" id="alamat" placeholder="Alamat lengkap perusahaan" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="kontakPerusahaan" class="form-label fw-bold">Kontak Perusahaan</label>
                <input type="text" name="kontak_perusahaan" class="form-control" id="kontak" placeholder="Nomor telepon/kontak resmi" required>
              </div>
            </div>

            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="confirmCheck" required>
              <label class="form-check-label" for="confirmCheck">Data yang saya masukkan sudah benar</label>
            </div>

            <div class="mt-4">
              <button type="submit" name="submit_perusahaan" class="btn btn-primary px-4">
                Simpan Data & Akun
              </button>
              <a href="<?= BASE_URL ?>layout/data/data_perusahaan.php" class="btn btn-outline-danger ms-2">
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