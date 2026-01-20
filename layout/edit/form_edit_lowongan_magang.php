<?php
include '../../init.php';
include '../../service/auth.php';
include '../../partials/header.php';
require_once '../../repository/Jurusan.php';
require_once '../../repository/lowongan_magang.php';

// Ambil semua jurusan untuk dropdown
$resultJurusan = Jurusan::getAll();

// Ambil ID lowongan dari query string
$id_lowongan = $_GET['id'] ?? null;
$user_id = $_SESSION['user_id'];
$lowongan = null;

// Jika ada ID, ambil data lowongan
if ($id_lowongan) {
  $lowongan = Lowongan::getById($id_lowongan, $user_id);
  if (!$lowongan) {
    echo "<script>
                alert('Lowongan tidak ditemukan.');
                window.location.href='" . BASE_URL . "layout/read/data_lowongan_magang.php';
              </script>";
    exit;
  }
}
?>

<div class="container-fluid">
  <div class="card shadow-sm border-0">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4"><?= $lowongan ? 'Edit Lowongan Magang' : 'Tambah Lowongan Magang' ?></h5>

      <form action="<?= BASE_URL ?>process/lowongan_magang/save.php" method="POST">

        <?php if ($lowongan): ?>
          <input type="hidden" name="id" value="<?= $lowongan['id'] ?>">
        <?php endif; ?>

        <!-- Judul Lowongan -->
        <div class="mb-3">
          <label for="judul_lowongan" class="form-label">Judul Lowongan</label>
          <input type="text" name="judul_lowongan" id="judul_lowongan" class="form-control"
            value="<?= htmlspecialchars($lowongan['judul_lowongan'] ?? '') ?>" required>
        </div>

        <!-- Deskripsi -->
        <div class="mb-3">
          <label for="deskripsi" class="form-label">Deskripsi</label>
          <textarea name="deskripsi" id="deskripsi" class="form-control" rows="6" required><?= htmlspecialchars($lowongan['deskripsi'] ?? '') ?></textarea>
        </div>

        <!-- Jurusan -->
        <div class="mb-3">
          <label for="id_jurusan" class="form-label">Jurusan Dibutuhkan</label>
          <select name="id_jurusan" id="id_jurusan" class="form-select" required>
            <option value="">-- Pilih Jurusan --</option>
            <?php while ($jurusan = mysqli_fetch_assoc($resultJurusan)): ?>
              <option value="<?= $jurusan['id'] ?>" <?= (isset($lowongan['id_jurusan']) && $lowongan['id_jurusan'] == $jurusan['id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($jurusan['nama_jurusan']) ?>
              </option>
            <?php endwhile; ?>
          </select>
        </div>

        <!-- Kuota -->
        <div class="mb-3">
          <label for="kuota" class="form-label">Kuota</label>
          <input type="number" name="kuota" id="kuota" class="form-control"
            value="<?= htmlspecialchars($lowongan['kuota'] ?? '') ?>" required min="1">
        </div>

        <!-- Tombol -->
        <div class="mt-4 d-flex justify-content-end">
          <a href="<?= BASE_URL ?>layout/read/data_lowongan_magang.php" class="btn btn-outline-danger me-2">Batal</a>
          <button type="submit" name="submit_lowongan" class="btn btn-primary"><?= $lowongan ? 'Update Lowongan' : 'Tambah Lowongan' ?></button>
        </div>

      </form>
    </div>
  </div>
</div>

<?php include '../../partials/footer.php'; ?>