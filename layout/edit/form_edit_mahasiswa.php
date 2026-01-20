<?php
include '../../init.php';
include '../../service/auth.php';
require_once '../../repository/Prodi.php';

// ================= CEK LOGIN =================
$user_id = $_SESSION['user_id'] ?? null;

// Ambil ID jurusan dari user login
$q = mysqli_query($koneksi, "SELECT id FROM jurusan WHERE id_user = '$user_id' LIMIT 1");
$dataJurusan = mysqli_fetch_assoc($q);
$id_jurusan = $dataJurusan['id'] ?? null;

// Ambil daftar prodi untuk jurusan ini
$prodiList = Prodi::getAllByJurusan($id_jurusan);

// Ambil data mahasiswa jika ada ID dikirim
$id_mahasiswa = $_GET['id'] ?? null;
$mahasiswa = null;

if ($id_mahasiswa) {
    $id_mahasiswa = (int)$id_mahasiswa;
    $result = mysqli_query($koneksi, "
        SELECT m.*, u.username, u.email, p.id as id_prodi, p.nama_prodi
        FROM mahasiswa m
        JOIN users u ON m.id_user = u.id
        JOIN prodi p ON m.id_prodi = p.id
        WHERE m.id = '$id_mahasiswa'
    ");
    $mahasiswa = mysqli_fetch_assoc($result);
    if (!$mahasiswa) {
        echo "<script>alert('Data mahasiswa tidak ditemukan'); window.location.href='" . BASE_URL . "layout/read/data_mahasiswa.php';</script>";
        exit;
    }
}

include '../../partials/header.php';
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Form Edit Mahasiswa</h5>

            <form action="<?= BASE_URL ?>process/mahasiswa/save.php" method="POST">

                <!-- ================= HIDDEN ================= -->
                <input type="hidden" name="id_mahasiswa" value="<?= $mahasiswa['id'] ?? '' ?>">
                <input type="hidden" name="id_user" value="<?= $mahasiswa['id_user'] ?? '' ?>">

                <!-- ================= CARD 1 : DATA AKUN ================= -->
                <div class="card shadow-none border mb-4">
                    <div class="card-header bg-light fw-bold">
                        <i class="ti ti-user me-2"></i> Data Akun
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" id="username"
                                    value="<?= htmlspecialchars($mahasiswa['username'] ?? '') ?>" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password"
                                    placeholder="********">
                                <small class="text-muted">
                                    * Biarkan kosong jika tidak ingin mengganti password
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ================= CARD 2 : DATA MAHASISWA ================= -->
                <div class="card shadow-none border">
                    <div class="card-header bg-light fw-bold">
                        <i class="ti ti-graduation-cap me-2"></i> Data Mahasiswa
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <label for="nim" class="form-label">NIM</label>
                                <input type="text" name="nim" class="form-control" id="nim"
                                    value="<?= htmlspecialchars($mahasiswa['nim'] ?? '') ?>" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="nama" class="form-label">Nama Mahasiswa</label>
                                <input type="text" name="nama_mahasiswa" class="form-control" id="nama"
                                    value="<?= htmlspecialchars($mahasiswa['nama_mahasiswa'] ?? '') ?>" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="Laki-laki" <?= trim($mahasiswa['jenis_kelamin'] ?? '') == 'Laki-Laki' ? 'selected' : '' ?>>Laki-Laki</option>
                                    <option value="Perempuan" <?= trim($mahasiswa['jenis_kelamin'] ?? '') == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                                </select>
                            </div>

                            <!-- Baris Prodi dan Angkatan -->
                            <div class="col-md-6 mb-3">
                                <label for="prodi" class="form-label">Prodi</label>
                                <select name="id_prodi" id="prodi" class="form-select" required>
                                    <option value="">-- Pilih Prodi --</option>
                                    <?php while ($prodi = $prodiList->fetch_assoc()): ?>
                                        <option value="<?= $prodi['id']; ?>" <?= ($mahasiswa['id_prodi'] ?? '') == $prodi['id'] ? 'selected' : '' ?>>
                                            <?= $prodi['nama_prodi']; ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="angkatan" class="form-label">Angkatan</label>
                                <input type="number" name="angkatan" class="form-control" id="angkatan"
                                    value="<?= htmlspecialchars($mahasiswa['angkatan'] ?? '') ?>" required>
                            </div>

                            <!-- Baris Email dan No HP -->
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    value="<?= htmlspecialchars($mahasiswa['email'] ?? '') ?>" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="no_hp" class="form-label">No HP</label>
                                <input type="text" name="no_hp" class="form-control" id="no_hp"
                                    value="<?= htmlspecialchars($mahasiswa['no_hp'] ?? '') ?>" required>
                            </div>

                            <!-- Alamat -->
                            <div class="col-md-12 mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control" rows="3" required><?= htmlspecialchars($mahasiswa['alamat'] ?? '') ?></textarea>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-end">
                    <a href="<?= BASE_URL ?>layout/read/data_mahasiswa.php" class="btn btn-outline-danger">Batal</a>
                    <button type="submit" name="submit_mahasiswa" class="btn btn-primary ms-2">Update Mahasiswa</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php include '../../partials/footer.php'; ?>