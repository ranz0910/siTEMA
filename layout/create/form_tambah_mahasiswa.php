<?php
include '../../init.php';
include '../../service/auth.php';
include '../../partials/header.php';
require_once '../../repository/Prodi.php';

// Ambil prodi sesuai jurusan user login
$user_id = $_SESSION['user_id'] ?? null;
$q = mysqli_query($koneksi, "SELECT id FROM jurusan WHERE id_user = '$user_id' LIMIT 1");
$dataJurusan = mysqli_fetch_assoc($q);
$id_jurusan = $dataJurusan['id'] ?? null;

$prodiList = Prodi::getAllByJurusan($id_jurusan);
?>

<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">Form Tambah Mahasiswa</h5>

      <form action="<?= BASE_URL ?>process/mahasiswa/save.php" method="POST">

        <!-- ================= CARD 1 : DATA AKUN ================= -->
        <div class="card shadow-none border mb-4">
          <div class="card-header bg-light fw-bold">
            <i class="ti ti-user me-2"></i> Data Akun
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
              </div>

              <div class="col-md-6 mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="********" required>
              </div>
            </div>
          </div>
        </div>

        <!-- ================= CARD 2 : DATA MAHASISWA ================= -->
        <div class="card shadow-none border">
          <div class="card-header bg-light fw-bold">
            <i class="ti ti-school me-2"></i> Data Mahasiswa
          </div>
          <div class="card-body">

            <!-- Baris 1: NIM | Nama | Jenis Kelamin -->
            <div class="row mb-3">
              <div class="col-md-4">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" name="nim" class="form-control" id="nim" placeholder="Nomor Induk Mahasiswa" required>
              </div>

              <div class="col-md-4">
                <label for="nama" class="form-label">Nama Mahasiswa</label>
                <input type="text" name="nama_mahasiswa" class="form-control" id="nama" placeholder="Nama Lengkap" required>
              </div>

              <div class="col-md-4">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                  <option value="">-- Pilih Jenis Kelamin --</option>
                  <option value="Laki-Laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
              </div>
            </div>

            <!-- Baris 2: Prodi | Angkatan -->
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="prodi" class="form-label">Prodi</label>
                <select name="id_prodi" id="prodi" class="form-select" required>
                  <option value="">-- Pilih Prodi --</option>
                  <?php while ($prodi = $prodiList->fetch_assoc()): ?>
                    <option value="<?= $prodi['id']; ?>"><?= $prodi['nama_prodi']; ?></option>
                  <?php endwhile; ?>
                </select>
              </div>

              <div class="col-md-6">
                <label for="angkatan" class="form-label">Angkatan</label>
                <input type="number" name="angkatan" class="form-control" id="angkatan" placeholder="Tahun Angkatan" required>
              </div>
            </div>

            <!-- Baris 3: Email | No HP -->
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="email@domain.com" required>
              </div>

              <div class="col-md-6">
                <label for="no_hp" class="form-label">No HP</label>
                <input type="text" name="no_hp" class="form-control" id="no_hp" placeholder="08xxxxxxxxxx" required>
              </div>
            </div>

            <!-- Baris 4: Alamat -->
            <div class="row">
              <div class="col-md-12">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control" rows="3" placeholder="Alamat lengkap" required></textarea>
              </div>
            </div>

          </div>
        </div>

        <div class="mt-4 d-flex justify-content-end">
          <a href="<?= BASE_URL ?>layout/read/data_mahasiswa.php" class="btn btn-outline-danger">Batal</a>
          <button type="submit" name="submit_mahasiswa" class="btn btn-primary ms-2">Simpan Data Mahasiswa</button>
        </div>

      </form>
    </div>
  </div>
</div>

<?php include '../../partials/footer.php'; ?>
