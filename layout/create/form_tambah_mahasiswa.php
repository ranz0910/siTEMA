<?php
include '../../init.php';
include '../../service/auth.php';
?>

<?php include '../../partials/header.php'; ?>

<div class="container-fluid">
  <div class="card shadow-sm">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4 text-primary">Form Tambah Mahasiswa</h5>
      
      <div class="card shadow-none border">
        <div class="card-body">
          <form action="<?= BASE_URL ?>process/mahasiswa/save.php" method="POST">
            
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Username untuk login" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password untuk login" required>
              </div>

              <div class="col-md-6 mb-3">
                <label for="namaMhs" class="form-label fw-bold">Nama Mahasiswa</label>
                <input type="text" name="nama_mahasiswa" class="form-control" id="namaMhs" placeholder="Masukkan nama" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="nimMhs" class="form-label fw-bold">NIM Mahasiswa</label>
                <input type="text" name="nim_mahasiswa" class="form-control" id="nimMhs" placeholder="Masukkan NIM" required>
              </div>
              
              <div class="col-md-6 mb-3">
                <label for="prodi" class="form-label fw-bold">Program Studi</label>
                <input type="text" name="prodi_mahasiswa" class="form-control" id="prodi" placeholder="Masukkan program studi" required>
              </div>
              
              <div class="col-md-6 mb-3">
                <label for="email" class="form-label fw-bold">Email Mahasiswa</label>
                <input type="email" name="email_mahasiswa" class="form-control" id="email" placeholder="ex: example@gmail.com" required>
              </div>
              
              <div class="col-md-6 mb-3">
                <label for="alamatMhs" class="form-label fw-bold">Alamat Mahasiswa</label>
                <input type="text" name="alamat_mahasiswa" class="form-control" id="alamatMhs" placeholder="Masukkan alamat" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="kontakMhs" class="form-label fw-bold">Kontak Mahasiswa</label>
                <input type="text" name="kontak_mahasiswa" class="form-control" id="kontakMhs" placeholder="Masukkan kontak" required>
              </div>
            </div>

            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="confirmCheck" required>
              <label class="form-check-label" for="confirmCheck">Data yang saya masukkan sudah benar</label>
            </div>
            
            <div class="mt-4">
              <button type="submit" name="submit_mahasiswa" class="btn btn-primary px-4">
                Simpan Data & Akun
              </button>
              <a href="<?= BASE_URL ?>layout/data/data_mahasiswa.php" class="btn btn-outline-danger ms-2">
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