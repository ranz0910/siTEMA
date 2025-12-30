<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">Form Pengajuan Magang</h5>
      
      <form action="process/simpan_pengajuan.php" method="POST">
        <div class="mb-3">
          <label for="nama_mahasiswa" class="form-label">Nama Mahasiswa</label>
          <input type="text" class="form-control" id="nama_mahasiswa" name="nama" value="<?php echo $_SESSION['identity']; ?>" readonly>
        </div>
        
        <div class="mb-3">
          <label for="perusahaan" class="form-label">Pilih Perusahaan</label>
          <select class="form-select" name="id_perusahaan">
            <option selected>-- Pilih Perusahaan Tujuan --</option>
            </select>
        </div>

        <div class="mb-3">
          <label for="keterangan" class="form-label">Alasan Pengajuan</label>
          <textarea class="form-control" name="keterangan" rows="3" placeholder="Tuliskan alasan singkat..."></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Kirim Pengajuan</button>
      </form>
    </div>
  </div>
</div>