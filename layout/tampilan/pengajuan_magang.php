<?php
include '../../init.php';
include '../../service/auth.php';
include '../../partials/header.php';

$user_id  = $_SESSION['user_id'] ?? null;
$role_id = $_SESSION['id_roles'] ?? null;

if (!$user_id || !$role_id) {
  die('<div class="alert alert-danger">Akses tidak valid.</div>');
}

global $koneksi;
?>

<!-- =====================================================
ROLE 4 — MAHASISWA
===================================================== -->
<?php if ($role_id == 4): ?>

  <?php
  // Ambil id mahasiswa
  $sql_mhs = "SELECT id FROM mahasiswa WHERE id_user = ? LIMIT 1";
  $stmt = mysqli_prepare($koneksi, $sql_mhs);
  mysqli_stmt_bind_param($stmt, "i", $user_id);
  mysqli_stmt_execute($stmt);
  $res_mhs = mysqli_stmt_get_result($stmt);
  $mhs = mysqli_fetch_assoc($res_mhs);

  if (!$mhs) {
    die('<div class="alert alert-danger">Mahasiswa tidak ditemukan.</div>');
  }

  $id_mahasiswa = (int)$mhs['id'];

  // Cek pengajuan aktif
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
  ?>

  <div class="container-fluid">
    <div class="card shadow-sm border-0">
      <div class="card-body">

        <div class="d-flex mb-4 justify-content-between align-items-center">
          <div>
            <h3 class="fw-bolder mb-1 text-dark">Pengajuan Magang</h3>
            <p class="text-muted mb-0 small">
              Ajukan permohonan magang sesuai jurusan dan program studi
            </p>
          </div>

          <?php if ($sudahAjukan): ?>
            <button class="btn btn-secondary fw-bold" disabled>
              <i class="ti ti-lock me-2"></i> Sudah Mengajukan
            </button>
          <?php else: ?>
            <a href="<?= BASE_URL ?>layout/create/form_pengajuan_magang.php"
              class="btn btn-primary fw-bold">
              <i class="ti ti-send me-2"></i> Ajukan Magang
            </a>
          <?php endif; ?>
        </div>

        <?php if ($sudahAjukan): ?>
          <div class="alert alert-warning text-center">
            Anda sudah memiliki <b>pengajuan magang aktif</b>.
          </div>
        <?php else: ?>
          <div class="text-center py-5 text-muted">
            Silakan ajukan magang melalui tombol di atas.
          </div>
        <?php endif; ?>

      </div>
    </div>
  </div>

  <!-- =====================================================
ROLE 1 — ADMIN
===================================================== -->
<?php elseif ($role_id == 1): ?>

  <div class="container-fluid">
    <div class="alert alert-primary">
      <h4 class="fw-bold">Manajemen Pengajuan Magang</h4>
      <p>Kelola seluruh pengajuan magang mahasiswa.</p>
    </div>

    <a href="<?= BASE_URL ?>layout/read/pengajuan_magang.php"
      class="btn btn-primary">
      Lihat Semua Pengajuan
    </a>
  </div>

  <!-- =====================================================
ROLE 2 — JURUSAN
===================================================== -->
<?php elseif ($role_id == 2): ?>

  <div class="container-fluid">
    <div class="alert alert-info">
      <h4 class="fw-bold">Review Pengajuan Mahasiswa</h4>
      <p>Review pengajuan magang mahasiswa bimbingan.</p>
    </div>

    <a href="<?= BASE_URL ?>layout/read/review_pengajuan.php"
      class="btn btn-info">
      Review Pengajuan
    </a>
  </div>

  <!-- =====================================================
ROLE 3 — PERUSAHAAN
===================================================== -->
<?php elseif ($role_id == 3): ?>

  <div class="container-fluid">
    <div class="alert alert-success">
      <h4 class="fw-bold">Monitoring Pengajuan Magang</h4>
      <p>Validasi dan monitoring pengajuan magang.</p>
    </div>

    <a href="<?= BASE_URL ?>layout/read/rekap_pengajuan.php"
      class="btn btn-success">
      Rekap Pengajuan
    </a>
  </div>

  <!-- =====================================================
ROLE TIDAK VALID
===================================================== -->
<?php else: ?>

  <div class="alert alert-danger text-center">
    Role tidak dikenali.
  </div>

<?php endif; ?>

<?php if (isset($_GET['success'])): ?>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: 'Pengajuan magang berhasil dikirim.'
      });
    });
  </script>
<?php endif; ?>

<?php include '../../partials/footer.php'; ?>