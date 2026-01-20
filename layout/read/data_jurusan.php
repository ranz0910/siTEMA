<?php
include '../../init.php';
include '../../service/auth.php';
include '../../partials/header.php';

// Ambil data jurusan
$result = Jurusan::getAll();
?>

<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <!-- ================= HEADER ================= -->
            <div class="d-flex mb-4 justify-content-between align-items-center">
                <div>
                    <h3 class="fw-bolder mb-1 text-dark">Data Jurusan</h3>
                    <p class="text-muted mb-0 small">
                        Kelola dan lihat informasi jurusan
                    </p>
                </div>

                <a href="<?= BASE_URL ?>layout/create/form_tambah_jurusan.php"
                    class="btn btn-primary px-4 shadow-sm fw-bold">
                    <i class="ti ti-plus me-2"></i> Tambah Jurusan
                </a>
            </div>

            <!-- ================= TABLE ================= -->
            <div class="table-responsive rounded-2">
                <table class="table table-hover align-middle border">
                    <thead class="text-white" style="background-color:#5585ff;">
                        <tr>
                            <th class="py-3 text-center" width="5%">No</th>
                            <th class="py-3 text-center" width="15%">Username</th>
                            <th class="py-3" width="25%">Nama Jurusan</th>
                            <th class="py-3 text-center" width="15%">Kode</th>
                            <th class="py-3 text-center" width="20%">Email</th>
                            <th class="py-3 text-center" width="10%">Tanggal</th>
                            <th class="py-3 text-center" width="10%">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white">
                        <?php
                        $no = 1;
                        if ($result && mysqli_num_rows($result) > 0):
                            while ($row = mysqli_fetch_assoc($result)):
                        ?>
                                <tr>
                                    <td class="text-center text-muted fw-bold">
                                        <?= $no++; ?>
                                    </td>

                                    <td class="text-center fw-semibold text-dark">
                                        <?= htmlspecialchars($row['username']); ?>
                                    </td>

                                    <td class="fw-semibold text-dark">
                                        <?= htmlspecialchars($row['nama_jurusan']); ?>
                                    </td>

                                    <td class="text-center">
                                        <span class="badge bg-light text-dark border">
                                            <?= htmlspecialchars($row['kode_jurusan'] ?? '-'); ?>
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        <span class="badge bg-light text-dark border">
                                            <?= htmlspecialchars($row['email'] ?? '-'); ?>
                                        </span>
                                    </td>

                                    <td class="text-center text-muted small">
                                        <?= date('d M Y', strtotime($row['created_at'])); ?>
                                    </td>

                                    <td class="text-center">
                                        <div class="btn-group gap-1">
                                            <a href="<?= BASE_URL ?>layout/edit/form_edit_jurusan.php?id=<?= $row['id']; ?>"
                                                class="btn btn-warning btn-sm px-3"
                                                title="Edit">
                                                <i class="ti ti-edit"></i>
                                            </a>

                                            <a href="<?= BASE_URL ?>process/jurusan/delete.php?id=<?= $row['id']; ?>"
                                                class="btn btn-danger btn-sm px-3"
                                                title="Hapus"
                                                onclick="return confirm('Yakin ingin menghapus jurusan ini?')">
                                                <i class="ti ti-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            endwhile;
                        else:
                            ?>
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    Data jurusan tidak ditemukan.
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
    thead th {
        font-weight: 600 !important;
        letter-spacing: 0.5px;
        border: none !important;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }
</style>

<?php include '../../partials/footer.php'; ?>