<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">Form Input Data Perusahaan</h5>
      <div class="card">
        <div class="card-body">
           <form action="process/perusahaan/TambahPerusahaan.php" method="POST">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="namaPerusahaan" class="form-label">Nama Perusahaan</label>
                <input type="text" name="nama_perusahaan" class="form-control" id="namaPerusahaan" placeholder="Masukkan nama perusahaan" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="emailPerusahaan" class="form-label">Email Perusahaan</label>
                <input type="email" name="email_perusahaan" class="form-control" id="emailPerusahaan" placeholder="email@perusahaan.ac.id" required>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="alamatPerusahaan" class="form-label">Alamat</label>
                <input type="text" name="alamat_perusahaan" class="form-control" id="alamatPerusahaan" placeholder="Alamat perusahaan" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="kotakPerusahaan" class="form-label">Kontak Perusahaan</label>
                <input type="text" name="kontak_perusahaan" class="form-control" id="kotakPerusahaan" placeholder="Kontak perusahaan" required>
              </div>
            </div>

            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="confirmCheck" required>
              <label class="form-check-label" for="confirmCheck">Data yang saya masukkan sudah benar</label>
            </div>
            <button type="submit" name="submit_perusahaan" class="btn btn-primary">Simpan Data Perusahaan</button>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>