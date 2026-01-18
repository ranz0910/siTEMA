<?php
include '../../init.php';
include '../../service/auth.php';
require_once '../../repository/mahasiswa.php';

// Mengambil data menggunakan Repository
// Diasumsikan Anda memiliki class Mahasiswa dengan method getAll()
$dataMahasiswa = Mahasiswa::getAll();

include '../../partials/header.php';
?>

<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex mb-4 justify-content-between align-items-center">
                <div>
                    <h5 class="card-title fw-bold mb-1 text-primary">Data Mahasiswa</h5>
                    <p class="text-muted mb-0 small">Daftar mahasiswa yang terdaftar dalam sistem magang.</p>
                </div>
                <a href="<?php echo BASE_URL; ?>layout/create/form_tambah_mahasiswa.php" class="btn btn-primary d-flex align-items-center">
                    <i class="ti ti-plus me-2 fs-4"></i> Tambah Data Mahasiswa
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle border">
                    <thead class="table-light">
                        <tr class="text-dark">
                            <th class="py-3 px-4 text-center" width="5%">No</th>
                            <th class="py-3">Nama Mahasiswa</th>
                            <th class="py-3">NIM</th>
                            <th class="py-3">Program Studi</th>
                            <th class="py-3">Kontak & Email</th>
                            <th class="py-3">Alamat</th>
                            <th class="py-3 text-center" width="12%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($dataMahasiswa->num_rows > 0): ?>
                            <?php 
                            $no = 1; 
                            while ($row = $dataMahasiswa->fetch_assoc()): 
                            ?>
                            <tr>
                                <td class="px-4 text-center text-muted"><?= $no++; ?></td>
                                
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light-info text-info rounded-circle p-2 me-3">
                                            <i class="ti ti-user fs-5"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0"><?= htmlspecialchars($row['nama_mahasiswa']); ?></h6>
                                            <small class="text-muted">User ID: #<?= $row['id_user']; ?></small>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <span class="badge bg-light-primary text-primary fw-semibold">
                                        <?= htmlspecialchars($row['nim']); ?>
                                    </span>
                                </td>

                                <td>
                                    <p class="mb-0 fw-normal"><?= htmlspecialchars($row['prodi'] ?? $row['jurusan']); ?></p>
                                </td>

                                <td>
                                    <div class="d-flex flex-column">
                                        <small class="text-dark"><i class="ti ti-mail me-1"></i> <?= htmlspecialchars($row['email']); ?></small>
                                        <small class="text-muted"><i class="ti ti-phone me-1"></i> <?= htmlspecialchars($row['kontak']); ?></small>
                                    </div>
                                </td>

                                <td>
                                    <p class="mb-0 small text-wrap" style="max-width: 150px;">
                                        <?= htmlspecialchars($row['alamat']); ?>
                                    </p>
                                </td>

                                <td class="text-center">
                                    <div class="btn-group shadow-sm" role="group">
                                        <a href="<?= BASE_URL; ?>layout/edit/form_edit_mahasiswa.php?id=<?= $row['id']; ?>" 
                                           class="btn btn-outline-warning btn-sm" title="Edit">
                                            <i class="ti ti-edit fs-4"></i>
                                        </a>
                                        <a href="<?= BASE_URL; ?>process/mahasiswa/HapusMahasiswa.php?id=<?= $row['id']; ?>" 
                                           class="btn btn-outline-danger btn-sm" 
                                           onclick="return confirm('Yakin ingin menghapus data mahasiswa ini?')" title="Hapus">
                                            <i class="ti ti-trash fs-4"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="ti ti-users fs-9 opacity-25 d-block mb-2"></i>
                                    <p class="text-muted">Belum ada data mahasiswa yang terdaftar.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
include '../../partials/footer.php';
?>