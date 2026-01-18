<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">Form Input Data Jurusan</h5>
      <div class="card">
        <div class="card-body">
          <form action="process/jurusan/TambahJurusan.php" method="POST">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username" required>
              </div>

              <div class="col-md-6 mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="********" required>
              </div>

              <div class="col-md-6 mb-3">
                <label for="namaJurusan" class="form-label">Nama Jurusan</label>
                <input type="text" name="nama_jurusan" class="form-control" id="namaJurusan" placeholder="Contoh: Teknik Informatika" required>
              </div>

              <div class="col-md-6 mb-3">
                <label for="ketuaJurusan" class="form-label">Ketua Jurusan</label>
                <input type="text" name="ketua_jurusan" class="form-control" id="ketuaJurusan" placeholder="Nama Lengkap & Gelar" required>
              </div>
              
              <div class="col-md-6 mb-3">
                <label for="emailJurusan" class="form-label">Email Jurusan</label>
                <input type="email" name="email_jurusan" class="form-control" id="emailJurusan" placeholder="it@kampus.id" required>
              </div>
            </div>

            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="confirmCheck" required>
              <label class="form-check-label" for="confirmCheck">Data yang saya masukkan sudah benar</label>
            </div>
            <div class="mt-3">
              <button type="submit" name="submit_jurusan" class="btn btn-primary">Simpan Data & Akun</button>
              <a href="index.php?page=data_jurusan" class="btn btn-outline-danger ms-2">Batal</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>