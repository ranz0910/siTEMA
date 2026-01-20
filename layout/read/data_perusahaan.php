<?php
include '../../init.php';
include '../../service/auth.php';
include '../../partials/header.php';

// Ambil data perusahaan
$result = Perusahaan::getAll();
?>

<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <!-- Header -->
            <div class="d-flex mb-4 justify-content-between align-items-center">
                <div>
                    <h3 class="fw-bolder mb-1 text-dark">Data Perusahaan</h3>
                    <p class="text-muted mb-0 small">Kelola dan lihat informasi perusahaan</p>
                </div>
                <a href="<?= BASE_URL; ?>layout/create/form_tambah_perusahaan.php"
                    class="btn btn-primary px-4 shadow-sm fw-bold">
                    <i class="ti ti-plus me-2"></i> Tambah Perusahaan
                </a>
            </div>

            <!-- Table -->
            <div class="table-responsive rounded-2">
                <table class="table table-hover align-middle border">
                    <thead style="background-color:#5585ff;">
                        <tr>
                            <th class="py-3 px-3 text-white text-center" width="5%">No</th>
                            <th class="py-3 text-white" width="15%">NPWP</th>
                            <th class="py-3 text-white" width="15%">Username</th>
                            <th class="py-3 text-white" width="20%">Nama Perusahaan</th>
                            <th class="py-3 text-white" width="20%">Alamat</th>
                            <th class="py-3 text-white text-center" width="15%">Tanggal Daftar</th>
                            <th class="py-3 text-white text-center" width="10%">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white">
                        <?php
                        $no = 1;
                        if ($result && mysqli_num_rows($result) > 0):
                            while ($row = mysqli_fetch_assoc($result)):
                        ?>
                                <tr>
                                    <td class="text-center fw-bold text-muted"><?= $no++; ?></td>

                                    <td><?= htmlspecialchars($row['npwp']); ?></td>

                                    <td><?= htmlspecialchars($row['username']); ?></td>

                                    <td class="fw-semibold"><?= htmlspecialchars($row['nama_perusahaan']); ?></td>

                                    <td><?= htmlspecialchars($row['alamat_perusahaan']); ?></td>

                                    <td class="text-center text-muted">
                                        <?= date('d M Y', strtotime($row['created_at'])); ?>
                                    </td>

                                    <td class="text-center">
                                        <div class="btn-group gap-1">

                                            <!-- DETAIL -->
                                            <button
                                                class="btn btn-info btn-sm btn-detail"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalDetailPerusahaan"

                                                data-npwp="<?= $row['npwp']; ?>"
                                                data-username="<?= $row['username']; ?>"
                                                data-nama="<?= $row['nama_perusahaan']; ?>"
                                                data-email="<?= $row['email']; ?>"
                                                data-telp="<?= $row['telp_perusahaan']; ?>"
                                                data-alamat="<?= $row['alamat_perusahaan']; ?>"
                                                data-tanggal="<?= date('d M Y', strtotime($row['created_at'])); ?>">
                                                <i class="ti ti-eye"></i>
                                            </button>

                                            <!-- EDIT -->
                                            <a href="<?= BASE_URL ?>layout/edit/form_edit_perusahaan.php?id=<?= $row['id']; ?>"
                                                class="btn btn-warning btn-sm">
                                                <i class="ti ti-edit"></i>
                                            </a>

                                            <!-- DELETE (ADMIN UTAMA) -->
                                            <?php if ($_SESSION['id_roles'] == 1): ?>
                                                <a href="<?= BASE_URL ?>process/perusahaan/delete.php?id=<?= $row['id']; ?>"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin hapus perusahaan ini?')">
                                                    <i class="ti ti-trash"></i>
                                                </a>
                                            <?php endif; ?>

                                        </div>
                                    </td>
                                </tr>


                            <?php endwhile;
                        else: ?>
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    Data perusahaan tidak ditemukan.
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

<?php include '../../modals/modal_detail_perusahaan.php'; ?>

<!-- script -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.btn-detail').forEach(btn => {
            btn.addEventListener('click', function() {

                document.getElementById('m_npwp').textContent = this.dataset.npwp;
                document.getElementById('m_nama').textContent = this.dataset.nama;
                document.getElementById('m_username').textContent = this.dataset.username;
                document.getElementById('m_email').textContent = this.dataset.email;
                document.getElementById('m_telp').textContent = this.dataset.telp;
                document.getElementById('m_alamat').textContent = this.dataset.alamat;
                document.getElementById('m_tanggal').textContent = this.dataset.tanggal;

            });
        });
    });
</script>

<?php include '../../partials/footer.php'; ?>