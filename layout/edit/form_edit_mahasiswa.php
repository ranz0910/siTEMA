<?php
include $_SERVER['DOCUMENT_ROOT'] . '/siTEMA/service/connection.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($connect, $_GET['id']);
    
    // Mengambil data lengkap mahasiswa beserta username dari tabel users
    $sql = "SELECT m.*, u.username FROM mahasiswa m 
            JOIN users u ON m.id_user = u.id 
            WHERE m.id = '$id'";
    $query = mysqli_query($connect, $sql);
    $data = mysqli_fetch_assoc($query);

    if (!$data) {
        echo "<script>alert('Data tidak ditemukan!'); window.location='index.php?page=data_mahasiswa';</script>";
        exit;
    }
}
?>

<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="mb-4">
                <h5 class="card-title fw-semibold text-primary">Edit Data Mahasiswa & Akun</h5>
            </div>            
            <form action="process/mahasiswa/edit_mahasiswa.php" method="POST">
                <input type="hidden" name="id_mhs" value="<?= $data['id'] ?>">
                <input type="hidden" name="id_user" value="<?= $data['id_user'] ?>">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nama Mahasiswa</label>
                        <input type="text" name="nama_mahasiswa" class="form-control" 
                               value="<?= htmlspecialchars($data['nama_mahasiswa']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">NIM Mahasiswa</label>
                        <input type="text" name="nim_mahasiswa" class="form-control" 
                               value="<?= htmlspecialchars($data['nim']) ?>" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Program Studi</label>
                        <input type="text" name="prodi_mahasiswa" class="form-control" 
                               value="<?= htmlspecialchars($data['prodi']) ?>" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Email Mahasiswa</label>
                        <input type="email" name="email_mahasiswa" class="form-control" 
                               value="<?= htmlspecialchars($data['email']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Kontak Mahasiswa</label>
                        <input type="text" name="kontak_mahasiswa" class="form-control" 
                               value="<?= htmlspecialchars($data['kontak']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Alamat Mahasiswa</label>
                        <input type="text" name="alamat_mahasiswa" class="form-control" 
                               value="<?= htmlspecialchars($data['alamat']) ?>" required>
                    </div>
                </div>

                <div class="mt-4 border-top pt-3">
                    <button type="submit" name="update_mahasiswa" class="btn btn-primary px-4 shadow-sm">Simpan Perubahan
                    </button>
                    <a href="index.php?page=data_mahasiswa" class="btn btn-outline-secondary ms-2">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>