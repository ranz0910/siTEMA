<?php
include '../../init.php';
include '../../service/auth.php';
include '../../partials/header.php';

global $koneksi;

// Proteksi Role
$role_id = $_SESSION['id_roles'] ?? null;
if ($role_id != 2 && $role_id != 1) {
    echo "<script>window.location.href='../dashboard.php';</script>";
    exit;
}

// QUERY DATA
$query = "SELECT 
            p.id, p.status, m.nama_mahasiswa as nama_mhs, m.nim, pr.nama_prodi, 
            COALESCE(p.judul_lowongan, l.judul_lowongan) AS judul_final,
            COALESCE(p.nama_perusahaan, pt.nama_perusahaan) AS perusahaan_final
          FROM pengajuan_magang p
          JOIN mahasiswa m ON p.id_mahasiswa = m.id
          JOIN prodi pr ON m.id_prodi = pr.id
          LEFT JOIN lowongan_magang l ON p.id_lowongan_magang = l.id
          LEFT JOIN perusahaan pt ON l.id_perusahaan = pt.id
          ORDER BY p.id DESC";

$sql = mysqli_query($koneksi, $query);
?>

<style>
    /* 1. Mendorong konten utama ke bawah header */
    .content-body {
        padding-top: 85px; /* Sesuaikan dengan tinggi header siTEMA Anda */
        min-height: calc(100vh - 60px); /* Memastikan footer tetap di bawah */
    }

    /* 2. Menghilangkan margin atas pada card agar menempel sempurna */
    .custom-card {
        margin-top: 0 !important;
        border-radius: 8px;
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    /* 3. Penyesuaian header tabel agar lebih bersih */
    .table thead th {
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
        color: #334155;
        font-weight: 600;
        padding: 15px;
    }
</style>

<main class="content-body">
    <div class="container-fluid px-4">
        <div class="card custom-card">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                <h5 class="fw-bold text-dark mb-0">Daftar Review Pengajuan Magang</h5>
                <a href="export_rekap.php" class="btn btn-success btn-sm fw-bold">
                    <i class="ti ti-file-spreadsheet me-1"></i> Export Rekap Excel
                </a>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th>Perusahaan</th>
                                <th>Judul Lowongan</th>
                                <th>Status</th>
                                <th class="text-center pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($sql) > 0): ?>
                                <?php while($data = mysqli_fetch_array($sql)): ?>
                                <tr>
                                    <td class="ps-4">
                                        <span class="text-muted small fw-bold"><?= htmlspecialchars($data['nim']); ?></span>
                                    </td>
                                    <td class="fw-bold text-primary"><?= htmlspecialchars($data['nama_mhs']); ?></td>
                                    <td><?= htmlspecialchars($data['perusahaan_final']); ?></td>
                                    <td><?= htmlspecialchars($data['judul_final']); ?></td>
                                    <td>
                                        <?php 
                                        if($data['status'] == 1) echo '<span class="badge bg-warning text-dark">Menunggu</span>';
                                        elseif($data['status'] == 2) echo '<span class="badge bg-success">Disetujui</span>';
                                        else echo '<span class="badge bg-danger">Ditolak</span>';
                                        ?>
                                    </td>
                                    <td class="text-center pe-4">
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-primary btn-preview" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#modalDetailPengajuan"
                                                data-nim="<?= $data['nim']; ?>"
                                                data-nama="<?= $data['nama_mhs']; ?>"
                                                data-prodi="<?= $data['nama_prodi']; ?>"
                                                data-perusahaan="<?= $data['perusahaan_final']; ?>"
                                                data-judul="<?= $data['judul_final']; ?>"
                                                data-status="<?= ($data['status'] == 1 ? 'Menunggu' : ($data['status'] == 2 ? 'Disetujui' : 'Ditolak')); ?>">
                                            <i class="ti ti-eye"></i> Preview
                                        </button>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr><td colspan="6" class="text-center py-5 text-muted">Belum ada pengajuan magang.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="modalDetailPengajuan" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="ti ti-user me-2"></i> Detail Pengajuan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <table class="table table-borderless mb-0">
                    <tr><th width="40%" class="text-muted fw-normal">NIM</th><td id="m_nim" class="fw-bold"></td></tr>
                    <tr><th class="text-muted fw-normal">Nama Mahasiswa</th><td id="m_nama" class="fw-bold"></td></tr>
                    <tr><th class="text-muted fw-normal">Program Studi</th><td id="m_prodi" class="fw-bold"></td></tr>
                    <tr><td colspan="2"><hr class="my-2"></td></tr>
                    <tr><th class="text-muted fw-normal">Perusahaan</th><td id="m_perusahaan" class="fw-bold text-primary"></td></tr>
                    <tr><th class="text-muted fw-normal">Judul Lowongan</th><td id="m_judul" class="fw-bold text-dark"></td></tr>
                    <tr><th class="text-muted fw-normal">Status</th><td><span id="m_status" class="badge"></span></td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const previewButtons = document.querySelectorAll('.btn-preview');
    previewButtons.forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('m_nim').innerText = this.getAttribute('data-nim');
            document.getElementById('m_nama').innerText = this.getAttribute('data-nama');
            document.getElementById('m_prodi').innerText = this.getAttribute('data-prodi');
            document.getElementById('m_perusahaan').innerText = this.getAttribute('data-perusahaan');
            document.getElementById('m_judul').innerText = this.getAttribute('data-judul');
            
            const status = this.getAttribute('data-status');
            const statusBadge = document.getElementById('m_status');
            statusBadge.innerText = status;
            statusBadge.className = 'badge '; 
            if(status === 'Menunggu') statusBadge.classList.add('bg-warning', 'text-dark');
            else if(status === 'Disetujui') statusBadge.classList.add('bg-success');
            else statusBadge.classList.add('bg-danger');
        });
    });
});
</script>

<?php include '../../partials/footer.php'; ?>