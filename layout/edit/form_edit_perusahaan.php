<?php
// Hubungkan ke database
$path_koneksi = $_SERVER['DOCUMENT_ROOT'] . '/siTEMA/service/connection.php';
include $path_koneksi;

// Ambil ID dari URL
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM perusahaan WHERE id = '$id'");
$data = mysqli_fetch_array($query);
?>

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white pt-3">
            <h3 class="card-title">Edit Data Perusahaan</h3>
        </div>
        <div class="card-body p-4">
            <form action="process/perusahaan/edit_perusahaan.php" method="POST">
                
                <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

                <div class="form-group mb-4">
                    <label class="form-label fw-bold">Nama Perusahaan</label>
                    <input type="text" name="nama_perusahaan" class="form-control" value="<?php echo $data['nama_perusahaan']; ?>" required>
                </div>

                <div class="form-group mb-4">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $data['email']; ?>" required>
                </div>

                <div class="form-group mb-4">
                    <label class="form-label fw-bold">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3" required><?php echo $data['alamat']; ?></textarea>
                </div>

                <div class="form-group mb-5">
                    <label class="form-label fw-bold">Kontak</label>
                    <input type="text" name="kontak" class="form-control" value="<?php echo $data['kontak']; ?>" required>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" name="update_perusahaan" class="btn btn-primary px-4">Simpan Perubahan</button>
                    <a href="index.php?page=data_perusahaan" class="btn btn-secondary px-4">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>