<?php
include '../../init.php';
include '../../service/auth.php';
include '../../partials/header.php';
require_once '../../repository/prodi.php';

// Ambil user_id dari session
$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    die('<div class="alert alert-danger">User tidak ditemukan. Silakan login ulang.</div>');
}

// Ambil id_jurusan milik user
$sql_jurusan = "SELECT id FROM jurusan WHERE id_user = $user_id";
$res_jurusan = mysqli_query($koneksi, $sql_jurusan);

if (!$res_jurusan || mysqli_num_rows($res_jurusan) == 0) {
    die('<div class="alert alert-danger">Jurusan milik user tidak ditemukan.</div>');
}

$row_jurusan = mysqli_fetch_assoc($res_jurusan);
$id_jurusan = (int)$row_jurusan['id'];

// Ambil prodi berdasarkan id_jurusan milik user
$result = Prodi::getAllByJurusan($id_jurusan);
?>

<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <!-- ================= HEADER ================= -->
            <div class="d-flex mb-4 justify-content-between align-items-center">
                <div>
                    <h3 class="fw-bolder mb-1 text-dark">Data Program Studi</h3>
                    <p class="text-muted mb-0 small">
                        Kelola dan lihat informasi program studi
                    </p>
                </div>

                <button type="button"
                    class="btn btn-primary px-4 shadow-sm fw-bold"
                    data-bs-toggle="modal"
                    data-bs-target="#modalTambahProdi">
                    <i class="ti ti-plus me-2"></i> Tambah Prodi
                </button>
            </div>

            <!-- ================= TABLE ================= -->
            <div class="table-responsive rounded-2">
                <table class="table table-hover align-middle border">
                    <thead class="text-white" style="background-color:#5585ff;">
                        <tr>
                            <th class="py-3 text-center" width="5%">No</th>
                            <th class="py-3" width="35%">Nama Prodi</th>
                            <th class="py-3 text-center" width="15%">Kode Prodi</th>
                            <th class="py-3 text-center" width="15%">Jenjang</th>
                            <th class="py-3 text-center" width="15%">Tanggal</th>
                            <th class="py-3 text-center" width="15%">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white">
                        <?php
                        $no = 1;
                        if ($result && $result->num_rows > 0):
                            while ($row = $result->fetch_assoc()):
                        ?>
                                <tr>
                                    <td class="text-center text-muted fw-bold">
                                        <?= $no++; ?>
                                    </td>

                                    <td class="fw-semibold text-dark">
                                        <?= htmlspecialchars($row['nama_prodi']); ?>
                                    </td>

                                    <td class="text-center">
                                        <span class="badge bg-light text-dark border">
                                            <?= htmlspecialchars($row['kode_prodi'] ?? '-'); ?>
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        <span class="badge bg-light text-dark border">
                                            <?= htmlspecialchars($row['jenjang'] ?? '-'); ?>
                                        </span>
                                    </td>

                                    <td class="text-center text-muted small">
                                        <?= date('d M Y', strtotime($row['created_at'])); ?>
                                    </td>

                                    <td class="text-center">
                                        <div class="btn-group gap-1">
                                            <button type="button"
                                                class="btn btn-warning btn-sm px-3 btn-edit-prodi"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalEditProdi"
                                                data-id="<?= $row['id']; ?>"
                                                data-kode="<?= htmlspecialchars($row['kode_prodi']); ?>"
                                                data-nama="<?= htmlspecialchars($row['nama_prodi']); ?>"
                                                data-jenjang="<?= htmlspecialchars($row['jenjang']); ?>">
                                                <i class="ti ti-edit"></i>
                                            </button>


                                            <a href="<?= BASE_URL ?>process/prodi/delete.php?id=<?= $row['id']; ?>"
                                                class="btn btn-danger btn-sm px-3"
                                                title="Hapus"
                                                onclick="return confirm('Yakin ingin menghapus prodi ini?')">
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
                                    Data program studi tidak ditemukan.
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

<?php include '../../modals/modal_tambah_prodi.php'; ?>

<?php include '../../modals/modal_edit_prodi.php'; ?>

<?php include '../../partials/footer.php'; ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const modalEdit = document.getElementById('modalEditProdi');

        modalEdit.addEventListener('show.bs.modal', function(event) {

            const button = event.relatedTarget;

            document.getElementById('edit_id_prodi').value = button.dataset.id;
            document.getElementById('edit_kode_prodi').value = button.dataset.kode;
            document.getElementById('edit_nama_prodi').value = button.dataset.nama;

            const jenjang = button.dataset.jenjang;
            document.getElementById('edit_jenjang_d3').checked = jenjang === 'D3';
            document.getElementById('edit_jenjang_d4').checked = jenjang === 'D4';

        });

    });
</script>

<!-- script -->