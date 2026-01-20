<?php
include '../../init.php';
include '../../service/auth.php';
include '../../partials/header.php';

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
  die('<div class="alert alert-danger">User tidak ditemukan. Silakan login ulang.</div>');
}

global $koneksi;

/* ================= AMBIL ID MAHASISWA ================= */
$sql_mhs = "SELECT id, id_prodi FROM mahasiswa WHERE id_user = ? LIMIT 1";
$stmt = mysqli_prepare($koneksi, $sql_mhs);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$res_mhs = mysqli_stmt_get_result($stmt);
$mhs = mysqli_fetch_assoc($res_mhs);

if (!$mhs) {
  die('<div class="alert alert-danger">Mahasiswa tidak ditemukan.</div>');
}

$id_mahasiswa = (int)$mhs['id'];
$id_prodi     = (int)$mhs['id_prodi'];

/* ================= AMBIL ID JURUSAN ================= */
$sql_prodi = "SELECT id_jurusan FROM prodi WHERE id = ? LIMIT 1";
$stmt = mysqli_prepare($koneksi, $sql_prodi);
mysqli_stmt_bind_param($stmt, "i", $id_prodi);
mysqli_stmt_execute($stmt);
$res_prodi = mysqli_stmt_get_result($stmt);
$prodi = mysqli_fetch_assoc($res_prodi);

$id_jurusan = (int)$prodi['id_jurusan'];

/* ================= CEK PENGAJUAN AKTIF ================= */
$sql_cek = "
  SELECT id 
  FROM pengajuan_magang
  WHERE id_mahasiswa = ?
    AND status = 1
  LIMIT 1
";
$stmt = mysqli_prepare($koneksi, $sql_cek);
mysqli_stmt_bind_param($stmt, "i", $id_mahasiswa);
mysqli_stmt_execute($stmt);
$res_cek = mysqli_stmt_get_result($stmt);

$sudahAjukan = mysqli_num_rows($res_cek) > 0;

/* ================= AMBIL LOWONGAN ================= */
$sql_lowongan = "
  SELECT l.*, j.nama_jurusan
  FROM lowongan_magang l
  LEFT JOIN jurusan j ON l.id_jurusan = j.id
  WHERE l.id_jurusan = ?
  ORDER BY l.judul_lowongan ASC
";
$stmt = mysqli_prepare($koneksi, $sql_lowongan);
mysqli_stmt_bind_param($stmt, "i", $id_jurusan);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<div class="container-fluid">

  <div class="mb-4">
    <h3 class="fw-bolder text-dark">Lowongan Magang</h3>
    <p class="text-muted mb-0">Lowongan magang sesuai jurusan Anda</p>
  </div>

  <?php if ($sudahAjukan): ?>
    <div class="alert alert-warning">
      <i class="ti ti-alert-circle me-1"></i>
      Anda sudah memiliki <b>pengajuan magang aktif</b>.
      Pengajuan lain akan dibuka setelah status berubah.
    </div>
  <?php endif; ?>

  <div class="row g-3">
    <?php if ($result && mysqli_num_rows($result) > 0): ?>
      <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="col-12">
          <div class="card shadow-sm border border-primary rounded-3 d-flex flex-row align-items-center p-3">

            <!-- INFO LOWONGAN -->
            <div class="flex-grow-1">
              <h5 class="fw-bold mb-2">
                <?= htmlspecialchars($row['judul_lowongan']); ?>
              </h5>

              <p class="text-muted mb-2"
                style="font-size: 0.9rem; max-height: 4.2em; overflow: hidden;">
                <?= htmlspecialchars($row['deskripsi']); ?>
              </p>

              <div class="d-flex gap-2 align-items-center">
                <span class="badge bg-success">Kuota: <?= $row['kuota']; ?></span>
                <span class="text-muted small">
                  <?= date('d M Y', strtotime($row['created_at'])); ?>
                </span>
              </div>
            </div>

            <!-- TOMBOL -->
            <div class="ms-3">
              <?php if ($sudahAjukan): ?>
                <button class="btn btn-secondary fw-bold" disabled>
                  Sudah Mengajukan
                </button>
              <?php else: ?>
                <a href="<?= BASE_URL ?>process/pengajuan_magang/ajukan_lowongan.php?id=<?= $row['id']; ?>"
                  class="btn btn-primary fw-bold"
                  onclick="return confirm('Yakin ingin mengajukan magang ini?')">
                  Ajukan Magang
                </a>
              <?php endif; ?>
            </div>

          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <div class="col-12">
        <div class="alert alert-info text-center">
          Tidak ada lowongan magang untuk jurusan Anda.
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>

<style>
  .card {
    transition: transform 0.2s, box-shadow 0.2s;
  }

  .card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 18px rgba(0, 0, 0, .12);
  }
</style>

<?php if (isset($_GET['success'])): ?>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: 'Pengajuan magang berhasil dikirim.',
        confirmButtonColor: '#3085d6'
      });
    });
  </script>
<?php endif; ?>

<?php if (isset($_GET['blocked'])): ?>
  <script>
    Swal.fire({
      icon: 'warning',
      title: 'Pengajuan Ditolak',
      text: 'Anda sudah memiliki pengajuan magang aktif.',
      confirmButtonColor: '#d33'
    });
  </script>
<?php endif; ?>

<?php include '../../partials/footer.php'; ?>