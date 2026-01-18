<?php
// layout/read/data_jurusan.php
$result = Jurusan::getAll(); 
?>

<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="d-flex mb-4 justify-content-between align-items-center">
                <div>
                    <h4 class="fw-bolder mb-1 text-dark">Master Data Jurusan</h4>
                    <p class="text-muted mb-0 small">Kelola informasi program studi dan pimpinan jurusan.</p>
                </div>
                <a href="index.php?page=form_tambah_jurusan" class="btn btn-primary px-4 shadow-sm d-flex align-items-center fw-bold">
                    <i class="ti ti-plus me-2 fs-5"></i> Tambah Jurusan
                </a>
            </div>

            <div class="table-responsive rounded-2">
                <table class="table table-hover align-middle border">
                    <thead style="background-color: #5585ff;"> 
                        <tr>
                            <th class="py-3 px-4 text-white text-center" width="5%">No</th>
                            <th class="py-3 text-white" width="40%">Nama & Kode Jurusan</th>
                            <th class="py-3 text-white" width="30%">Ketua Jurusan (Username)</th>
                            <th class="py-3 text-center text-white" width="25%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <?php 
                        $no = 1;
                        if ($result && mysqli_num_rows($result) > 0):
                            while($row = mysqli_fetch_assoc($result)): 
                        ?>
                        <tr>
                            <td class="px-4 text-center text-muted fw-bold"><?= $no++; ?></td>
                            
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-light-primary text-primary rounded-3 p-3 me-3">
                                        <i class="ti ti-building-community fs-7"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-0 text-dark"><?= htmlspecialchars($row['nama_jurusan']); ?></h6>
                                        <span class="badge bg-light text-dark border mt-1">
                                            ID: <?= $row['id']; ?> | <?= htmlspecialchars($row['kode_jurusan'] ?? 'N/A'); ?>
                                        </span>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-light-info text-info rounded-circle p-2 me-2">
                                        <i class="ti ti-user-check fs-5"></i>
                                    </div>
                                    <span class="fw-semibold text-dark"><?= htmlspecialchars($row['kajur'] ?? 'Belum Ditentukan'); ?></span>
                                </div>
                            </td>

                            <td class="text-center">
                                <div class="btn-group gap-2">
                                    <a href="index.php?page=form_edit_jurusan&id=<?= $row['id']; ?>" 
                                       class="btn btn-warning btn-sm px-3 fw-bold rounded-2">
                                        <i class="ti ti-edit fs-5"></i> Edit
                                    </a>
                                    
                                    <a href="process/jurusan/delete.php?id=<?= $row['id']; ?>" 
                                       class="btn btn-danger btn-sm px-3 fw-bold rounded-2" 
                                       onclick="return confirm('Hapus data jurusan ini?')">
                                        <i class="ti ti-trash fs-5"></i> Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php 
                            endwhile; 
                        else: 
                        ?>
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <p class="text-muted mb-0">Data jurusan tidak ditemukan.</p>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    /* Mengatur kontras teks di header agar sangat tajam */
    thead th {
        font-weight: 600 !important;
        letter-spacing: 0.5px;
        border: none !important;
    }
    .bg-light-primary { background-color: #ECF2FF !important; }
    .bg-light-info { background-color: #E1F5FA !important; }
    .table-hover tbody tr:hover { background-color: #f8f9fa; }
</style>