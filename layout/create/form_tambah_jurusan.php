<?php
include '../../init.php';
include '../../service/auth.php';

include '../../partials/header.php';
?>

<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">Form Tambah Jurusan</h5>

      <form action="<?= BASE_URL ?>process/jurusan/save.php" method="POST">

        <!-- ================= CARD 1 : DATA AKUN ================= -->
        <div class="card shadow-none border mb-4">
          <div class="card-header bg-light fw-bold">
            <i class="ti ti-user me-2"></i> Data Akun
          </div>
          <div class="card-body">
            <div class="row">

              <div class="col-md-6 mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
              </div>

              <div class="col-md-6 mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="********" required>
              </div>

            </div>
          </div>
        </div>

        <!-- ================= CARD 2 : DATA JURUSAN ================= -->
        <div class="card shadow-none border">
          <div class="card-header bg-light fw-bold">
            <i class="ti ti-building-skyscraper me-2"></i> Data Jurusan
          </div>
          <div class="card-body">
            <div class="row">

              <div class="col-md-4 mb-3">
                <label for="namaJurusan" class="form-label">Nama Jurusan</label>
                <input type="text" name="nama_jurusan" class="form-control" id="namaJurusan" placeholder="Contoh: Teknik Informatika" required>
              </div>

              <div class="col-md-4 mb-3">
                <label for="kodeJurusan" class="form-label">Kode Jurusan</label>
                <input type="text" name="kode_jurusan" class="form-control" id="kodeJurusan" placeholder="JRS-XXX" required>
              </div>

              <div class="col-md-4 mb-3">
                <label for="emailJurusan" class="form-label">Email Jurusan</label>
                <input type="email" name="email_jurusan" class="form-control" id="emailJurusan" placeholder="it@kampus.id" required>
              </div>

            </div>
          </div>
        </div>

        <div class="mt-4 d-flex justify-content-end">
          <a href="<?= BASE_URL ?>layout/read/data_jurusan.php" class="btn btn-outline-danger">
            Batal
          </a>
          <button type="submit" name="submit_jurusan" class="btn btn-primary ms-2">
            Simpan Data Jurusan
          </button>
        </div>

      </form>

    </div>
  </div>
</div>

<?php
include '../../partials/footer.php';
?>