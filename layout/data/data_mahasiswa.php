<?php
include $_SERVER['DOCUMENT_ROOT'] . '/siTEMA/service/connection.php';

// Ambil data dari tabel mahasiswa
// Pastikan variabel koneksi menggunakan $connect sesuai standar Anda
$sql = "SELECT * FROM mahasiswa ORDER BY id DESC";
$query = mysqli_query($connect, $sql);
?>

<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex mb-4 justify-content-between align-items-center">
                <h5 class="card-title fw-semibold mb-0 text-primary">Data Mahasiswa</h5>
                <a href="index.php?page=form_tambah_mahasiswa" class="btn btn-primary">
                    <i class="ti ti-plus me-1"></i> Tambah Data Mahasiswa
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light text-dark">
                        <tr>
                            <th class="border-bottom-0 text-center" width="5%">No</th>
                            <th class="border-bottom-0">Nama Mahasiswa</th>
                            <th class="border-bottom-0">NIM</th>
                            <th class="border-bottom-0">Program Studi</th>
                            <th class="border-bottom-0">Email</th>
                            <th class="border-bottom-0">Alamat</th>
                            <th class="border-bottom-0">Kontak</th>
                            <th class="border-bottom-0 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        if (mysqli_num_rows($query) > 0) :
                            while ($row = mysqli_fetch_assoc($query)) : 
                        ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td class="fw-semibold"><?= htmlspecialchars($row['nama_mahasiswa']); ?></td>
                                <td><?= htmlspecialchars($row['nim']); ?></td>
                                <td><?= htmlspecialchars($row['prodi']); ?></td>
                                <td><?= htmlspecialchars($row['email']); ?></td>
                                <td><?= htmlspecialchars($row['alamat']); ?></td>
                                <td><?= htmlspecialchars($row['kontak']); ?></td>
                                <td class="text-center">
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="index.php?page=form_edit_mahasiswa&id=<?= $row['id']; ?>" class="btn btn-warning btn-sm shadow-sm" title="Edit">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                        <a href="process/mahasiswa/HapusMahasiswa.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm shadow-sm" onclick="return confirm('Hapus data mahasiswa ini?')" title="Hapus">
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
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <p class="mb-0">Belum ada data mahasiswa yang terdaftar.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>