<?php
include '../../init.php';
include '../../service/auth.php';
include '../../partials/header.php';

require_once '../../repository/Perusahaan.php';
?>

<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">Form Tambah Perusahaan</h5>

      <form action="<?= BASE_URL ?>process/perusahaan/save.php" method="POST">

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
                  placeholder="Username" required>
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control"
                  placeholder="********" required>
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

              <!-- NPWP -->
              <div class="col-md-6 mb-3">
                <label class="form-label">NPWP</label>
                <input type="text" name="npwp" class="form-control"
                  placeholder="00.000.000.0-000.000" required>
              </div>

              <!-- Nama Perusahaan -->
              <div class="col-md-6 mb-3">
                <label class="form-label">Nama Perusahaan</label>
                <input type="text" name="nama_perusahaan" class="form-control"
                  placeholder="PT Contoh Sejahtera" required>
              </div>

              <!-- Alamat -->
              <div class="col-md-12 mb-3">
                <label class="form-label">Alamat Perusahaan</label>
                <textarea name="alamat_perusahaan"
                  class="form-control"
                  rows="3"
                  placeholder="Jl. Sudirman No. 10, Jakarta"
                  required></textarea>
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
                <input type="email" name="email_perusahaan" class="form-control"
                  placeholder="info@perusahaan.co.id" required>
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label">No. Telepon</label>
                <input type="text" name="telp_perusahaan" class="form-control"
                  placeholder="08xxxxxxxxxx" required>
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
          <button type="submit" name="submit_perusahaan"
            class="btn btn-primary ms-2">
            Simpan Data Perusahaan
          </button>
        </div>

      </form>

    </div>
  </div>
</div>

<?php include '../../partials/footer.php'; ?>