<?php
include '../../init.php';
include '../../service/auth.php';
include '../../partials/header.php';
require_once '../../repository/Mahasiswa.php';

// Ambil data mahasiswa (misal untuk jurusan login)
$user_id = $_SESSION['user_id'] ?? null;

// Ambil ID jurusan dari user login
$q = mysqli_query($koneksi, "SELECT id FROM jurusan WHERE id_user = '$user_id' LIMIT 1");
$dataJurusan = mysqli_fetch_assoc($q);
$id_jurusan = $dataJurusan['id'] ?? null;

// Ambil semua mahasiswa milik jurusan
$result = Mahasiswa::getAllByJurusan($id_jurusan);
?>

<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <!-- ================= HEADER ================= -->
            <div class="d-flex mb-4 justify-content-between align-items-center">
                <div>
                    <h3 class="fw-bolder mb-1 text-dark">Data Mahasiswa</h3>
                    <p class="text-muted mb-0 small">
                        Kelola dan lihat informasi mahasiswa
                    </p>
                </div>

                <a href="<?= BASE_URL ?>layout/create/form_tambah_mahasiswa.php"
                    class="btn btn-primary px-4 shadow-sm fw-bold">
                    <i class="ti ti-plus me-2"></i> Tambah Mahasiswa
                </a>
            </div>

            <!-- ================= TABLE ================= -->
            <div class="table-responsive rounded-2">
                <table class="table table-hover align-middle border">
                    <thead class="text-white" style="background-color:#5585ff;">
                        <tr>
                            <th class="py-3 text-center" width="5%">No</th>
                            <th class="py-3" width="10%">NIM</th>
                            <th class="py-3" width="15%">Username</th>
                            <th class="py-3" width="20%">Nama Mahasiswa</th>
                            <th class="py-3" width="10%">Jenis Kelamin</th>
                            <th class="py-3" width="15%">Prodi</th>
                            <th class="py-3" width="10%">Angkatan</th>
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
                                    <td class="text-center text-muted fw-bold"><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($row['nim']); ?></td>
                                    <td><?= htmlspecialchars($row['username']); ?></td>
                                    <td><?= htmlspecialchars($row['nama_mahasiswa']); ?></td>
                                    <td><?= htmlspecialchars($row['jenis_kelamin']); ?></td>
                                    <td><?= htmlspecialchars($row['nama_prodi']); ?></td>
                                    <td><?= htmlspecialchars($row['angkatan']); ?></td>
                                    <td class="text-center">
                                        <div class="btn-group gap-1">
                                            <button type="button" class="btn btn-info btn-sm btn-detail-mahasiswa"
                                                data-bs-toggle="modal" data-bs-target="#modalDetailMahasiswa"
                                                data-username="<?= $row['username']; ?>"
                                                data-nim="<?= $row['nim']; ?>"
                                                data-nama="<?= $row['nama_mahasiswa']; ?>"
                                                data-jk="<?= $row['jenis_kelamin']; ?>"
                                                data-prodi="<?= $row['nama_prodi']; ?>"
                                                data-angkatan="<?= $row['angkatan']; ?>"
                                                data-email="<?= $row['email']; ?>"
                                                data-no_hp="<?= $row['no_hp']; ?>"
                                                data-alamat="<?= $row['alamat']; ?>">
                                                <i class="ti ti-eye"></i>
                                            </button>

                                            <a href="<?= BASE_URL ?>layout/edit/form_edit_mahasiswa.php?id=<?= $row['id']; ?>"
                                                class="btn btn-warning btn-sm" title="Edit">
                                                <i class="ti ti-edit"></i>
                                            </a>

                                            <a href="<?= BASE_URL ?>process/mahasiswa/delete.php?id=<?= $row['id']; ?>"
                                                class="btn btn-danger btn-sm"
                                                title="Hapus"
                                                onclick="return confirm('Yakin ingin menghapus mahasiswa ini?')">
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
                                <td colspan="8" class="text-center py-5 text-muted">
                                    Data mahasiswa tidak ditemukan.
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

<?php include '../../modals/modal_detail_mahasiswa.php'; ?>

<?php include '../../partials/footer.php'; ?>

<!-- script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('modalDetailMahasiswa');
        modal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;

            modal.querySelector('#m_username').textContent = button.dataset.username;
            modal.querySelector('#m_nim').textContent = button.dataset.nim;
            modal.querySelector('#m_nama').textContent = button.dataset.nama;
            modal.querySelector('#m_jk').textContent = button.dataset.jk;
            modal.querySelector('#m_prodi').textContent = button.dataset.prodi;
            modal.querySelector('#m_angkatan').textContent = button.dataset.angkatan;
            modal.querySelector('#m_email').textContent = button.dataset.email;
            modal.querySelector('#m_no_hp').textContent = button.dataset.no_hp;
            modal.querySelector('#m_alamat').textContent = button.dataset.alamat;
        });
    });
</script>