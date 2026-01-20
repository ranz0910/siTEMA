<!-- Modal Tambah Prodi -->
<div class="modal fade" id="modalTambahProdi" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Tambah Program Studi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form action="<?= BASE_URL ?>process/prodi/save.php" method="POST">
        <div class="modal-body">

          <div class="mb-3">
            <label class="form-label">Nama Prodi</label>
            <input type="text" name="nama_prodi" class="form-control" required>
          </div>


          <div class="mb-3">
            <label class="form-label">Kode Prodi</label>
            <input type="text" name="kode_prodi" class="form-control" required>
          </div>
          
          <div class="mb-3">
            <label class="form-label d-block">Jenjang</label>

            <div class="form-check form-check-inline">
              <input class="form-check-input"
                type="radio"
                name="jenjang"
                id="jenjangD3"
                value="D3"
                required>
              <label class="form-check-label" for="jenjangD3">
                D3
              </label>
            </div>

            <div class="form-check form-check-inline">
              <input class="form-check-input"
                type="radio"
                name="jenjang"
                id="jenjangD4"
                value="D4"
                required>
              <label class="form-check-label" for="jenjangD4">
                D4
              </label>
            </div>
          </div>


        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Batal
          </button>
          <button type="submit" name="submit_prodi" class="btn btn-primary">
            Simpan
          </button>
        </div>
      </form>

    </div>
  </div>
</div>