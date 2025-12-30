<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">Form Input Data Mahasiswa</h5>
      <div class="card">
        <div class="card-body">
           <form action="process/mahasiswa/TambahMahasiswa.php" method="POST">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="namaMhs" class="form-label">Nama Mahasiswa</label>
                <input type="text" name="nama_mahasiswa" class="form-control" id="namaMhs" placeholder="Masukkan nama" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="nimMhs" class="form-label">NIM Mahasiswa</label>
                <input type="text" name="nim_mahasiswa" class="form-control" id="nimMhs" placeholder="Masukkan NIM" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="jurusan" class="form-label">Jurusan</label>
                <input type="text" name="jurusan_mahasiswa" class="form-control" id="jurusan" placeholder="Masukkan jurusan" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Email Mahasiswa</label>
                <input type="email" name="email_mahasiswa" class="form-control" id="email" placeholder="ex: example@gmail.com" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="alamatMhs" class="form-label">Alamat Mahasiswa</label>
                <input type="text" name="alamat_mahasiswa" class="form-control" id="alamatMhs" placeholder="Masukkan alamat" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="kontakMhs" class="form-label">Kontak Mahasiswa</label>
                <input type="text" name="kontak_mahasiswa" class="form-control" id="kontakMhs" placeholder="Masukkan kontak" required>
              </div>
            </div>

            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="confirmCheck" required>
              <label class="form-check-label" for="confirmCheck">Data yang saya masukkan sudah benar</label>
            </div>
            <button type="submit" name="submit_mahasiswa" class="btn btn-primary">Simpan Data Mahasiswa</button>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>