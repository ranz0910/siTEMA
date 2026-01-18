<?php
include '../../init.php';
include '../../service/auth.php';
require_once '../../repository/prodi.php';

// Mengambil data menggunakan Repository sesuai standar baru
$dataProdi = Prodi::getAll();

include '../../partials/header.php';
?>

<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h5 class="card-title fw-bold text-primary mb-1">Data Program Studi</h5>
                    <p class="text-muted mb-0 small">Daftar program studi yang terintegrasi dalam sistem.</p>
                </div>
                <a href="<?php echo BASE_URL; ?>layout/create/form_tambah_prodi.php" class="btn btn-primary d-flex align-items-center">
                    <i class="ti ti-plus me-2 fs-4"></i> Tambah Data Prodi
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle border">
                    <thead class="table-light">
                        <tr class="text-dark">
                            <th width="5%" class="py-3 px-4 text-center">No</th>
                            <th width="25%" class="py-3">Kode Prodi</th>
                            <th class="py-3">Nama Program Studi</th>
                            <th width="15%" class="py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        if ($dataProdi->num_rows > 0) :
                            while ($row = $dataProdi->fetch_assoc()) : 
                        ?>
                            <tr>
                                <td class="px-4 text-center text-muted"><?= $no++; ?></td>
                                <td>
                                    <span class="badge bg-light-primary text-primary fw-bold px-3">
                                        <?= htmlspecialchars($row['kode_prodi'] ?? 'PRODI-' . $row['id']); ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light-secondary text-secondary rounded-2 p-2 me-3">
                                            <i class="ti ti-school fs-6"></i>
                                        </div>
                                        <h6 class="fw-bold mb-0"><?= htmlspecialchars($row['nama_prodi']); ?></h6>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group shadow-sm" role="group">
                                        <a href="<?= BASE_URL; ?>layout/edit/form_edit_prodi.php?id=<?= $row['id']; ?>" 
                                           class="btn btn-outline-warning btn-sm" title="Edit">
                                            <i class="ti ti-edit fs-4"></i>
                                        </a>
                                        
                                        <a href="<?= BASE_URL; ?>process/prodi/HapusProdi.php?id=<?= $row['id']; ?>" 
                                           class="btn btn-outline-danger btn-sm" 
                                           onclick="return confirm('Apakah Anda yakin ingin menghapus prodi ini?')" 
                                           title="Hapus">
                                            <i class="ti ti-trash fs-4"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php 
                            endwhile; 
                        else : 
                        ?>
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <i class="ti ti-info-circle fs-9 opacity-25 d-block mb-2"></i>
                                    <p class="text-muted">Belum ada data program studi yang terdaftar.</p>
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