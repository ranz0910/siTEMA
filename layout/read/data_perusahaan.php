<?php

include '../../init.php';
include '../../service/auth.php';
require_once '../../repository/Perusahaan.php';

// Mengambil data menggunakan Repository sesuai gaya bahasa baru
$dataPerusahaan = Perusahaan::getAll();

include '../../partials/header.php';
?>

<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex mb-4 justify-content-between align-items-center">
                <div>
                    <h5 class="card-title fw-bold mb-1">Data Mitra Perusahaan</h5>
                    <p class="text-muted mb-0 small">Daftar perusahaan mitra yang tersedia untuk program magang.</p>
                </div>
                <a href="<?php echo BASE_URL; ?>/layout/create/form_tambah_perusahaan.php" class="btn btn-primary d-flex align-items-center">
                    <i class="ti ti-plus me-2 fs-4"></i> Tambah Data Perusahaan
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle border">
                    <thead class="table-light">
                        <tr class="text-dark">
                            <th class="py-3 px-4" width="5%">No</th>
                            <th class="py-3" width="30%">Nama Perusahaan</th>
                            <th class="py-3" width="25%">Alamat Lokasi</th>
                            <th class="py-3" width="25%">Kontak & Email</th>
                            <th class="py-3 text-center" width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($dataPerusahaan->num_rows > 0): ?>
                            <?php 
                            $no = 1; 
                            while($row = $dataPerusahaan->fetch_assoc()): 
                            ?>
                            <tr>
                                <td class="px-4 text-muted"><?= $no++; ?></td>
                                
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light-info text-info rounded-2 p-2 me-3">
                                            <i class="ti ti-briefcase fs-6"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0"><?= htmlspecialchars($row['nama_perusahaan']); ?></h6>
                                            <small class="text-muted">ID: #<?= $row['id']; ?></small>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <p class="mb-0 small text-wrap" style="max-width: 250px;">
                                        <i class="ti ti-map-pin me-1 text-danger"></i>
                                        <?= htmlspecialchars($row['alamat_perusahaan']); ?> </p>
                                </td>

                                <td>
                                    <div class="d-flex flex-column gap-1">
                                        <div class="d-flex align-items-center">
                                            <i class="ti ti-phone me-2 text-success fs-3"></i>
                                            <small class="text-dark"><?= htmlspecialchars($row['telp_perusahaan']); ?></small> </div>
                                        <div class="d-flex align-items-center">
                                            <i class="ti ti-mail me-2 text-primary fs-3"></i>
                                            <small class="text-muted"><?= htmlspecialchars($row['email_perusahaan']); ?></small> </div>
                                    </div>
                                </td>

                                <td class="text-center">
                                    <div class="btn-group shadow-sm" role="group">
                                        <a href="<?= BASE_URL; ?>/layout/edit/form_edit_perusahaan.php?id=<?= $row['id']; ?>" 
                                           class="btn btn-outline-warning btn-sm" title="Edit">
                                            <i class="ti ti-edit fs-4"></i>
                                        </a>
                                        <a href="<?= BASE_URL; ?>/process/perusahaan/delete.php?id=<?= $row['id']; ?>" 
                                           class="btn btn-outline-danger btn-sm" 
                                           onclick="return confirm('Hapus data perusahaan ini?')" title="Hapus">
                                            <i class="ti ti-trash fs-4"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <i class="ti ti-building-factory-2 fs-9 opacity-25 d-block mb-2"></i>
                                    <p class="text-muted">Belum ada data perusahaan yang tersedia.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include '../../partials/footer.php';  ?>