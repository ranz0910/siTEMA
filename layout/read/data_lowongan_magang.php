<?php
include '../../init.php';
include '../../service/auth.php';
include '../../partials/header.php';
require_once '../../repository/lowongan_magang.php';

$user_id = $_SESSION['user_id']; // User perusahaan login
$result = Lowongan::getAllByUser($user_id);
?>

<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="d-flex mb-4 justify-content-between align-items-center">
                <div>
                    <h3 class="fw-bolder mb-1 text-dark">Data Lowongan Magang</h3>
                    <p class="text-muted mb-0 small">
                        Kelola dan lihat informasi lowongan magang
                    </p>
                </div>

                <a href="<?= BASE_URL ?>layout/create/form_tambah_lowongan_magang.php"
                   class="btn btn-primary px-4 shadow-sm fw-bold">
                   <i class="ti ti-plus me-2"></i> Tambah Lowongan
                </a>
            </div>

            <div class="table-responsive rounded-2">
                <table class="table table-hover align-middle border">
                    <thead class="text-white" style="background-color:#5585ff;">
                        <tr>
                            <th class="py-3 text-center" width="5%">No</th>
                            <th class="py-3" width="25%">Judul Lowongan</th>
                            <th class="py-3" width="35%">Deskripsi</th>
                            <th class="py-3" width="20%">Jurusan Dibutuhkan</th>
                            <th class="py-3 text-center" width="10%">Kuota</th>
                            <th class="py-3 text-center" width="15%">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white">
                        <?php
                        $no = 1;
                        if ($result && mysqli_num_rows($result) > 0):
                            while ($row = mysqli_fetch_assoc($result)):
                        ?>
                            <tr>
                                <td class="text-center text-muted fw-bold"><?= $no++; ?></td>
                                <td><?= htmlspecialchars($row['judul_lowongan']); ?></td>
                                <td><?= htmlspecialchars($row['deskripsi']); ?></td>
                                <td><?= htmlspecialchars($row['nama_jurusan']); ?></td>
                                <td class="text-center"><?= htmlspecialchars($row['kuota']); ?></td>
                                <td class="text-center">
                                    <div class="btn-group gap-1">
                                        <a href="<?= BASE_URL ?>layout/edit/form_edit_lowongan_magang.php?id=<?= $row['id']; ?>"
                                           class="btn btn-warning btn-sm px-3" title="Edit">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                        <a href="<?= BASE_URL ?>process/lowongan_magang/delete.php?id=<?= $row['id']; ?>"
                                           class="btn btn-danger btn-sm px-3"
                                           title="Hapus"
                                           onclick="return confirm('Yakin ingin menghapus lowongan ini?')">
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
                                <td colspan="6" class="text-center py-5 text-muted">
                                    Data lowongan magang tidak ditemukan.
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
