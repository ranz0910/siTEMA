<?php
// Hubungkan ke database
$path_koneksi = $_SERVER['DOCUMENT_ROOT'] . '/siTEMA/service/connection.php';
include $path_koneksi;

// Ambil ID dari URL
$id = $_GET['id'];
$query = mysqli_query($connect, "SELECT * FROM jurusan WHERE id = '$id'");
$data = mysqli_fetch_array($query);

// Cek jika data tidak ditemukan
if (!$data) {
    echo "<script>alert('Data jurusan tidak ditemukan!'); window.location.href='index.php?page=data_jurusan';</script>";
    exit();
}
?>

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white pt-3">
            <h3 class="card-title">Edit Data Jurusan</h3>
        </div>
        <div class="card-body p-4">
            <form action="process/jurusan/edit_jurusan.php" method="POST">
                
                <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

                <div class="form-group mb-4">
                    <label class="form-label fw-bold">Nama Jurusan</label>
                    <input type="text" name="nama_jurusan" class="form-control" value="<?php echo $data['nama_jurusan']; ?>" required>
                </div>

                <div class="form-group mb-4">
                    <label class="form-label fw-bold">Ketua Jurusan</label>
                    <input type="text" name="ketua_jurusan" class="form-control" value="<?php echo $data['kajur']; ?>" required>
                </div>

                <div class="form-group mb-5">
                    <label class="form-label fw-bold">Email Jurusan</label>
                    <input type="email" name="email_jurusan" class="form-control" value="<?php echo $data['email_jurusan']; ?>" required>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" name="update_jurusan" class="btn btn-primary px-4">Simpan Perubahan</button>
                    <a href="index.php?page=data_jurusan" class="btn btn-secondary px-4">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>