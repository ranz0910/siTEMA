<?php
// 1. Ambil ID Jurusan dari URL
$id_jurusan = isset($_GET['id']) ? $_GET['id'] : '';

if (empty($id_jurusan)) {
    echo "<div class='alert alert-danger'>ID Jurusan tidak ditemukan.</div>";
    return;
}

// 2. Query untuk mengambil detail data jurusan
$query = "SELECT * FROM jurusan WHERE id = '$id_jurusan'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

// Jika data tidak ada di database
if (!$data) {
    echo "<div class='alert alert-warning'>Data jurusan tidak ditemukan di database.</div>";
    return;
}
?>

<div class="container-fluid">
    <div class="card bg-light-success shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Detail Program Studi</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="index.php?page=data_prodi">Data Prodi</a></li>
                            <li class="breadcrumb-item" aria-current="page">Profil Jurusan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center bg-light-primary rounded-circle mx-auto mb-3" style="width: 100px; height: 100px;">
                        <i class="ti ti-school fs-10 text-primary"></i>
                    </div>
                    <h4 class="fw-semibold"><?= htmlspecialchars($data['nama_jurusan']) ?></h4>
                    <p class="text-muted">ID Prodi: <?= htmlspecialchars($data['id']) ?></p>
                    <span class="badge bg-success">Status: Aktif</span>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-white border-bottom">
                    <h5 class="card-title fw-semibold mb-0">Informasi Jurusan</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless align-middle">
                        <tbody>
                            <tr>
                                <td width="30%" class="text-muted">Nama Program Studi</td>
                                <td width="5%">:</td>
                                <td class="fw-bold"><?= htmlspecialchars($data['nama_jurusan']) ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Kode Internal</td>
                                <td class="">:</td>
                                <td class="fw-bold text-uppercase">PRD-0<?= htmlspecialchars($data['id']) ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Keterangan</td>
                                <td class="">:</td>
                                <td>Program studi ini berfokus pada pengembangan kompetensi mahasiswa di bidang <?= htmlspecialchars($data['nama_jurusan']) ?>.</td>
                            </tr>
                        </tbody>
                    </table>

                    <hr>
                    
                    <div class="d-flex justify-content-between mt-4">
                        <a href="index.php?page=data_prodi" class="btn btn-outline-secondary">
                            <i class="ti ti-arrow-left me-1"></i> Kembali
                        </a>
                        <a href="index.php?page=form_tambah_prodi&id=<?= $data['id'] ?>" class="btn btn-warning text-white">
                            <i class="ti ti-edit me-1"></i> Edit Jurusan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>