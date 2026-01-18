<?php
include '../../init.php';
include '../../service/auth.php';
require_once '../../repository/Mahasiswa.php';

// Ambil data mahasiswa
$dataMahasiswa = Mahasiswa::getAll();

include '../../partials/header.php';
?>

<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-body">

            <div class="d-flex mb-4 justify-content-between align-items-center">
                <div>
                    <h5 class="card-title fw-bold mb-1 text-primary">Data Mahasiswa</h5>
                    <p class="text-muted mb-0 small">
                        Daftar mahasiswa yang terdaftar dalam sistem.
                    </p>
                </div>
                <a href="<?= BASE_URL; ?>layout/create/form_tambah_mahasiswa.php"
                   class="btn btn-primary d-flex align-items-center">
                    <i class="ti ti-plus me-2 fs-4"></i> Tambah Data Mahasiswa
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-sm align-middle border small">
                    <thead class="table-light">
                        <tr style="font-size: 0.85rem;"> <th class="text-center" width="4%">No</th>
                            <th width="10%">NIM</th>
                            <th>Username</th>
                            <th>Nama Mahasiswa</th>
                            <th>Program Studi</th>
                            <th width="15%">Alamat</th>
                            <th>Email</th>
                            <th>No. Telp</th>
                            <th class="text-center" width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($dataMahasiswa && $dataMahasiswa->num_rows > 0): ?>
                            <?php $no = 1; ?>
                            <?php while ($row = $dataMahasiswa->fetch_assoc()): ?>
                                <tr>
                                    <td class="text-center text-muted"><?= $no++; ?></td>
                                    <td>
                                        <span class="badge bg-light-primary text-primary fw-semibold" style="font-size: 0.75rem;">
                                            <?= htmlspecialchars($row['nim']); ?>
                                        </span>
                                    </td>
                                    <td><?= htmlspecialchars($row['username']); ?></td>
                                    <td><?= htmlspecialchars($row['nama_mahasiswa']); ?></td>
                                    <td><?= htmlspecialchars($row['prodi']); ?></td>
                                    <td class="text-truncate" style="max-width: 150px;" title="<?= htmlspecialchars($row['alamat']); ?>">
                                        <?= htmlspecialchars($row['alamat']); ?>
                                    </td>
                                    <td>
                                        <i class="ti ti-mail me-1"></i>
                                        <?= htmlspecialchars($row['email']); ?>

                                    </td>
                                    <td>
                                        <i class="ti ti-phone me-1"></i>
                                        <?= htmlspecialchars($row['no_hp']); ?>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="<?= BASE_URL; ?>layout/edit/form_edit_mahasiswa.php?id=<?= $row['id_mahasiswa']; ?>"
                                            class="btn btn-outline-warning btn-xs px-2 py-1"
                                            title="Edit">
                                                <i class="ti ti-edit fs-3"></i>
                                            </a>
                                            <a href="<?= BASE_URL; ?>process/mahasiswa/delete.php?id=<?= $row['id_mahasiswa']; ?>"
                                            class="btn btn-outline-danger btn-xs px-2 py-1"
                                            onclick="return confirm('Yakin ingin menghapus data mahasiswa ini?')"
                                            title="Hapus">
                                                <i class="ti ti-trash fs-3"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="10" class="text-center py-5 text-muted">
                                Belum ada data mahasiswa.
                            </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<?php include '../../partials/footer.php'; ?>