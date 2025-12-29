<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">Form Input Data Jurusan</h5>
      <div class="card">
        <div class="card-body">
            <form action="index.php?page=table_jurusan" method="POST">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="namaJurusan" class="form-label">Nama Jurusan</label>
                <input type="text" name="nama_jurusan" class="form-control" id="namaJurusan" placeholder="Masukkan nama jurusan" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="ketuaJurusan" class="form-label">Ketua Jurusan</label>
                <input type="text" name="ketua_jurusan" class="form-control" id="ketuaJurusan" placeholder="Nama Ketua Jurusan" required>
              </div>
            </div>

            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="confirmCheck" required>
              <label class="form-check-label" for="confirmCheck">Data yang saya masukkan sudah benar</label>
            </div>
            <button type="submit" name="submit_jurusan" class="btn btn-primary">Simpan Data Jurusan</button>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>