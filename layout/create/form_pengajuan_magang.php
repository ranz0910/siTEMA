<?php
include '../../init.php';
include '../../service/auth.php';
include '../../partials/header.php';

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
  die('<div class="alert alert-danger">User belum login</div>');
}

global $koneksi;

/* ================= AMBIL DATA MAHASISWA + EMAIL USER ================= */
$sql = "
  SELECT 
    m.id AS id_mahasiswa,
    m.nim,
    m.nama_mahasiswa,
    m.jenis_kelamin,
    m.alamat,
    m.no_hp,
    p.nama_prodi,
    p.jenjang,
    u.email
  FROM mahasiswa m
  JOIN prodi p ON m.id_prodi = p.id
  JOIN users u ON m.id_user = u.id
  WHERE m.id_user = ?
  LIMIT 1
";

$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data) {
  die('<div class="alert alert-danger">Data mahasiswa tidak ditemukan</div>');
}
?>

<div class="container-fluid">
  <div class="card shadow-sm border-0">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">Form Pengajuan Magang</h5>

      <form action="<?= BASE_URL ?>process/pengajuan_magang/save.php" method="POST">

        <!-- ================= CARD 1 : DATA MAHASISWA ================= -->
        <div class="card shadow-none border mb-4">
          <div class="card-header bg-light fw-bold">
            <i class="ti ti-user me-2"></i> Data Mahasiswa
          </div>

          <div class="card-body">
            <div class="row">

              <!-- Baris 1 -->
              <div class="col-md-4 mb-3">
                <label class="form-label">NIM</label>
                <input type="text" class="form-control"
                  value="<?= htmlspecialchars($data['nim']); ?>" readonly>
              </div>

              <div class="col-md-4 mb-3">
                <label class="form-label">Nama Mahasiswa</label>
                <input type="text" class="form-control"
                  value="<?= htmlspecialchars($data['nama_mahasiswa']); ?>" readonly>
              </div>

              <div class="col-md-4 mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <input type="text" class="form-control"
                  value="<?= htmlspecialchars($data['jenis_kelamin']); ?>" readonly>
              </div>

              <!-- Baris 2 (PRODI + JENJANG + NO HP) -->
              <div class="col-md-4 mb-3">
                <label class="form-label">Program Studi</label>
                <input type="text" class="form-control"
                  value="<?= htmlspecialchars($data['nama_prodi']); ?>" readonly>
              </div>

              <div class="col-md-4 mb-3">
                <label class="form-label">Jenjang</label>
                <input type="text" class="form-control"
                  value="<?= htmlspecialchars($data['jenjang']); ?>" readonly>
              </div>

              <div class="col-md-4 mb-3">
                <label class="form-label">No HP</label>
                <input type="text" class="form-control"
                  value="<?= htmlspecialchars($data['no_hp']); ?>" readonly>
              </div>

              <!-- Baris 3 (EMAIL) -->
              <div class="col-md-12 mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control"
                  value="<?= htmlspecialchars($data['email']); ?>" readonly>
              </div>

              <!-- Baris 4 -->
              <div class="col-md-12 mb-3">
                <label class="form-label">Alamat</label>
                <textarea class="form-control" rows="2" readonly><?= htmlspecialchars($data['alamat']); ?></textarea>
              </div>

            </div>
          </div>
        </div>

        <!-- ================= CARD 2 : DATA MAGANG ================= -->
        <div class="card shadow-none border">
          <div class="card-header bg-light fw-bold">
            <i class="ti ti-briefcase me-2"></i> Data Magang
          </div>

          <div class="card-body">
            <div class="row">

              <div class="col-md-6 mb-3">
                <label class="form-label">Nama Perusahaan</label>
                <input type="text" name="nama_perusahaan"
                  class="form-control"
                  placeholder="PT Contoh Sejahtera" required>
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label">Judul Lowongan Magang</label>
                <input type="text" name="judul_lowongan"
                  class="form-control"
                  placeholder="Magang Web Developer" required>
              </div>

            </div>
          </div>
        </div>

        <!-- ================= ACTION ================= -->
        <div class="mt-4 d-flex justify-content-end">
          <a href="<?= BASE_URL ?>layout/read/pengajuan_magang.php"
            class="btn btn-outline-danger">
            Batal
          </a>

          <button type="submit" name="submit_pengajuan"
            class="btn btn-primary ms-2">
            Ajukan Magang
          </button>
        </div>

      </form>
    </div>
  </div>
</div>

<?php include '../../partials/footer.php'; ?>