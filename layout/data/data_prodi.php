<?php
include $_SERVER['DOCUMENT_ROOT'] . '/siTEMA/service/connection.php';

// Ambil data prodi dari database
$sql   = "SELECT * FROM prodi ORDER BY id DESC";
$query = mysqli_query($connect, $sql);

// Cek apakah ada data
$jumlah_data = mysqli_num_rows($query);
?>

<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title fw-semibold text-primary mb-0">Data Program Studi</h5>
                <a href="index.php?page=form_tambah_prodi" class="btn btn-primary">
                    <i class="ti ti-plus me-1"></i> Tambah Data Prodi
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="5%" class="text-center">No</th>
                            <th width="20%">Kode Prodi</th>
                            <th>Nama Program Studi</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        if ($jumlah_data > 0) :
                            while ($row = mysqli_fetch_assoc($query)) : 
                        ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td>
                                    <span class="badge bg-light-primary text-primary fw-bold">
                                        PRODI-<?= $row['id']; ?>
                                    </span>
                                </td>
                                <td class="fw-bold"><?= htmlspecialchars($row['nama_prodi']); ?></td>
                                <td class="text-center">
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="index.php?page=form_edit_prodi&id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">
                                          <i class="ti ti-edit"></i>
                                        </a>
                                        
                                        <a href="process/prodi/HapusProdi.php?id=<?= $row['id']; ?>" 
                                           class="btn btn-danger btn-sm" 
                                           onclick="return confirm('Apakah Anda yakin ingin menghapus prodi ini?')" 
                                           title="Hapus">
                                            <i class="ti ti-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php 
                            endwhile; 
                        else : 
                        ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    <i class="ti ti-info-circle fs-5 d-block mb-2"></i>
                                    Belum ada data program studi yang terdaftar.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>