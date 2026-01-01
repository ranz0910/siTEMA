<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">Form Pengajuan Magang</h5>
      
      <form action="process/simpan_pengajuan.php" method="POST">
        
        <div class="row mb-3">
          <div class="col-md-6">
            <label for="nama_mahasiswa" class="form-label">Nama Mahasiswa</label>
            <input type="text" class="form-control" id="nama_mahasiswa" name="nama" value="<?php echo $_SESSION['identity']; ?>" readonly>
          </div>
          <div class="col-md-6">
            <label for="nik" class="form-label">NIK</label>
            <input type="number" class="form-control" name="nik" placeholder="Masukkan 16 digit NIK" required>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
            <input type="text" class="form-control" name="tempat_lahir" placeholder="Contoh: Jakarta" required>
          </div>
          <div class="col-md-6">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" name="tanggal_lahir" required>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label">Jenis Kelamin</label>
            <select class="form-select" name="jenis_kelamin" required>
              <option value="" selected disabled>-- Pilih Jenis Kelamin --</option>
              <option value="Laki-laki">Laki-laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label">Agama</label>
            <select class="form-select" name="agama" required>
              <option value="" selected disabled>-- Pilih Agama --</option>
              <option value="Islam">Islam</option>
              <option value="Kristen">Kristen</option>
              <option value="Katolik">Katolik</option>
              <option value="Hindu">Hindu</option>
              <option value="Buddha">Buddha</option>
              <option value="Khonghucu">Khonghucu</option>
            </select>
          </div>
        </div>

        <div class="mb-3">
          <label for="alamat" class="form-label">Alamat Lengkap</label>
          <textarea class="form-control" name="alamat" rows="2" placeholder="Tulis alamat domisili saat ini..." required></textarea>
        </div>

        <div class="mb-3">
          <label for="perusahaan" class="form-label">Pilih Perusahaan Tujuan</label>
          <select class="form-select" name="id_perusahaan" required>
            <option value="" selected disabled>-- Pilih Perusahaan Tujuan --</option>
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