<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex mb-4 justify-content-between align-items-center">
                <div>
                    <h5 class="card-title fw-bold mb-1">Daftar Master Jurusan</h5>
                    <p class="text-muted mb-0 small">Kelola data program studi, pimpinan jurusan, dan kontak resmi.</p>
                </div>
                <a href="index.php?page=form_tambah_jurusan" class="btn btn-primary d-flex align-items-center">
                    <i class="ti ti-plus me-2 fs-4"></i> Tambah Jurusan
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle border">
                    <thead class="table-light">
                        <tr>
                            <th class="py-3 px-4" width="5%">No</th>
                            <th class="py-3" width="35%">Nama Jurusan</th>
                            <th class="py-3" width="25%">Ketua Jurusan</th>
                            <th class="py-3 text-center" width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        // Query JOIN: Mengambil data dari tabel jurusan dan email dari tabel terkait
                        // Diasumsikan kolom di tabel jurusan adalah: nama_jurusan, ketua_jurusan, email_jurusan
                        $query = "SELECT * FROM jurusan ORDER BY nama_jurusan ASC";
                        $result = mysqli_query($koneksi, $query);

                        if (mysqli_num_rows($result) > 0):
                            while($row = mysqli_fetch_assoc($result)): 
                        ?>
                        <tr>
                            <td class="px-4 text-muted"><?= $no++; ?></td>
                            
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-light-primary text-primary rounded-2 p-2 me-3">
                                        <i class="ti ti-building-community fs-6"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-0"><?= htmlspecialchars($row['nama_jurusan']); ?></h6>
                                        <small class="text-muted">Kode: <span class="badge bg-light-secondary text-dark fw-normal">JRS-<?= $row['id']; ?></span></small>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-light-info text-info rounded-circle p-1 me-2">
                                        <i class="ti ti-user-check fs-4"></i>
                                    </div>
                                    <span class="fw-semibold text-dark"><?= htmlspecialchars($row['kajur']); ?></span>
                                </div>
                            </td>

                            <td class="text-center">
                                <div class="btn-group shadow-sm" role="group">
                                    <a href="index.php?page=form_edit_jurusan&id=<?= $row['id']; ?>" 
                                       class="btn btn-outline-warning btn-sm" title="Edit">
                                        <i class="ti ti-edit fs-4"></i>
                                    </a>
                                    <a href="service/hapus_jurusan.php?id=<?= $row['id']; ?>" 
                                       class="btn btn-outline-danger btn-sm" 
                                       onclick="return confirm('Hapus data jurusan ini?')" title="Hapus">
                                        <i class="ti ti-trash fs-4"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php 
                            endwhile; 
                        else: 
                        ?>
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <i class="ti ti-database-off fs-9 opacity-25 d-block mb-2"></i>
                                <p class="text-muted">Data jurusan tidak ditemukan di database.</p>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>