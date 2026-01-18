<?php
include '../../init.php';
include '../../service/auth.php'; // Pastikan di dalam file ini ada session_start()

// CEK DISINI: Menggunakan null coalescing (??) agar tidak error jika kosong
$role           = $_SESSION['role'] ?? ''; 
$idProdiSession = $_SESSION['id_prodi'] ?? null;
$namaProdi      = $_SESSION['nama_prodi'] ?? 'Prodi Tidak Terdeteksi';

$isJurusan      = ($role === 'jurusan');
?>

<?php include '../../partials/header.php'; ?>

<div class="container-fluid">
  <div class="card shadow-sm">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4 text-primary">Form Tambah Mahasiswa</h5>

      <form action="<?= BASE_URL ?>process/mahasiswa/save.php" method="POST">

        <div class="card shadow-none border mb-4">
          <div class="card-header bg-light">
            <h6 class="mb-0 fw-bold"><i class="ti ti-user-circle me-2"></i>Akun Login</h6>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Input NIM sebagai username" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Default: 123456" required>
              </div>
            </div>
          </div>
        </div>

        <div class="card shadow-none border mb-4">
          <div class="card-header bg-light">
            <h6 class="mb-0 fw-bold"><i class="ti ti-id me-2"></i>Data Mahasiswa</h6>
          </div>
          <div class="card-body">
            <div class="row">

              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Program Studi</label>
                <?php if ($isJurusan && $idProdiSession) : ?>
                    <input type="hidden" name="id_prodi" value="<?= $idProdiSession; ?>">
                    <input type="text" class="form-control bg-light" value="<?= $_SESSION['nama_prodi'] ?? 'Prodi Anda'; ?>" readonly>
                    <small class="text-primary">*Terkunci otomatis sesuai akun jurusan Anda</small>
                <?php else : ?>
                    <select name="id_prodi" class="form-select" required>
                      <option value="" disabled selected>Pilih Prodi</option>
                      <?php
                      $prodi = mysqli_query($connect, "SELECT id, nama_prodi FROM prodi ORDER BY nama_prodi ASC");
                      while ($p = mysqli_fetch_assoc($prodi)) :
                      ?>
                        <option value="<?= $p['id']; ?>"><?= $p['nama_prodi']; ?></option>
                      <?php endwhile; ?>
                    </select>
                <?php endif; ?>
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">NIM</label>
                <input type="text" name="nim" class="form-control" required>
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Nama Mahasiswa</label>
                <input type="text" name="nama_mahasiswa" class="form-control" required>
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Email</label>
                <input type="email" name="email" class="form-control" required>
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select" required>
                  <option value="" disabled selected>Pilih Jenis Kelamin</option>
                  <option value="Laki-laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">No. HP</label>
                <input type="text" name="no_hp" class="form-control" required>
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Angkatan</label>
                <input type="number" name="angkatan" class="form-control" value="<?= date('Y') ?>" required>
              </div>

              <div class="col-md-12 mb-3">
                <label class="form-label fw-bold">Alamat</label>
                <textarea name="alamat" class="form-control" rows="2" required></textarea>
              </div>
            </div>
          </div>
        </div>

        <div class="mb-4 mt-2 form-check">
          <input type="checkbox" class="form-check-input" id="confirmCheck" required>
          <label class="form-check-label" for="confirmCheck">Data yang saya masukkan sudah benar</label>
        </div>

        <div class="px-3">
          <div class="mt-4">
            <button type="submit" class="btn btn-primary px-4 shadow-sm">
              <i class="ti ti-device-floppy me-1"></i> Simpan Mahasiswa
            </button>
            <a href="<?= BASE_URL ?>index.php?page=data_mahasiswa" class="btn btn-outline-danger px-4">Batal</a>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>

<?php include '../../partials/footer.php'; ?>