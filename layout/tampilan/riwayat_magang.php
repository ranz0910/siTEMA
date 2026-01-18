<?php
include $_SERVER['DOCUMENT_ROOT'] . '/siTEMA/service/connection.php';

if (session_status() === PHP_SESSION_NONE) { 
    session_start(); 
}

// Proteksi: Hanya mahasiswa yang sudah login yang bisa melihat
if (!isset($_SESSION['id_user'])) {
    echo "<script>window.location='/siTEMA/process/login/ProsesLogin.php';</script>";
    exit;
}

$id_user = $_SESSION['id_user'];

// Query JOIN untuk mengambil data pengajuan dan nama perusahaan
$sql = "SELECT pm.*, p.nama_perusahaan 
        FROM pengajuan_magang pm
        JOIN perusahaan p ON pm.id_perusahaan = p.id
        JOIN mahasiswa m ON pm.id_mahasiswa = m.id
        WHERE m.id_user = '$id_user'
        ORDER BY pm.id DESC";

$query = mysqli_query($connect, $sql);
?>

<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title fw-semibold text-primary">Riwayat Pengajuan Magang</h5>
                <a href="index.php?page=form_magang" class="btn btn-primary btn-sm">
                    <i class="ti ti-plus"></i> Ajukan Baru
                </a>
            </div>
            <hr>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Perusahaan Tujuan</th>
                            <th>NIK</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        if (mysqli_num_rows($query) > 0) {
                            while ($row = mysqli_fetch_assoc($query)) { 
                                // Logika Warna Badge Status
                                $status_class = 'bg-warning'; // Pending
                                if ($row['status'] == 'Diterima') $status_class = 'bg-success';
                                if ($row['status'] == 'Ditolak') $status_class = 'bg-danger';
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= date('d M Y', strtotime($row['tanggal_lahir'])); // Asumsi tgl pengajuan atau gunakan kolom created_at ?></td>
                                <td><strong><?= htmlspecialchars($row['nama_perusahaan']); ?></strong></td>
                                <td><?= htmlspecialchars($row['nik']); ?></td>
                                <td>
                                    <span class="badge <?= $status_class; ?> rounded-3 fw-semibold">
                                        <?= $row['status']; ?>
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-info btn-sm text-white" data-bs-toggle="modal" data-bs-target="#detailModal<?= $row['id']; ?>">
                                        <i class="ti ti-eye"></i> Detail
                                    </button>
                                </td>
                            </tr>

                            <div class="modal fade" id="detailModal<?= $row['id']; ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Detail Pengajuan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Tempat, Tgl Lahir:</strong> <?= $row['tempat_lahir']; ?>, <?= $row['tanggal_lahir']; ?></p>
                                            <p><strong>Alamat:</strong> <?= $row['alamat']; ?></p>
                                            <p><strong>Keterangan/Skill:</strong><br><?= nl2br(htmlspecialchars($row['keterangan'])); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php 
                            } 
                        } else {
                            echo "<tr><td colspan='6' class='text-center text-muted'>Belum ada riwayat pengajuan.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>