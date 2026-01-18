<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$path_koneksi = $_SERVER['DOCUMENT_ROOT'] . '/siTEMA/service/connection.php';
if (file_exists($path_koneksi)) {
    include($path_koneksi);
} else {
    die("Error: File koneksi tidak ditemukan.");
}

$id_login = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '');

$data = null; 
if (!empty($id_login)) {
    $query = "SELECT * FROM mahasiswa WHERE id_user = '$id_login'";
    $result = mysqli_query($connect, $query);
    if ($result) {
        $data = mysqli_fetch_assoc($result);
    }
}

if (!$data) {
    echo "<div class='alert alert-warning'>Profil tidak ditemukan. Silakan lengkapi data profil terlebih dahulu.</div>";
    return;
}
?>

<div class="container-fluid mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary py-3">
            <h5 class="mb-0 text-white fw-bold">Edit Profil Mahasiswa</h5>
        </div>
        <div class="card-body p-4">
            <form action="process/mahasiswa/update_profile.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_user" value="<?= $data['id_user'] ?>">
                
                <div class="row">
                    <div class="col-lg-4 text-center mb-4 border-end">
                        <?php 
                        $foto = !empty($data['foto']) ? 'src/images/profile/'.$data['foto'] : 'src/images/profile/user-1.jpg';
                        ?>
                        <img src="<?= $foto ?>" id="preview" class="rounded-circle shadow-sm mb-3" 
                             style="width: 160px; height: 160px; object-fit: cover; border: 4px solid #f8f9fa;">
                        
                        <div class="px-3">
                            <label class="form-label d-block fw-bold">Ubah Foto Profil</label>
                            <input type="file" name="foto" class="form-control" id="fotoInput" accept="image/*" onchange="previewImage()">
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nama Lengkap</label>
                                <input type="text" name="nama_mahasiswa" class="form-control" value="<?= htmlspecialchars($data['nama_mahasiswa']) ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">NIM</label>
                                <input type="text" name="nim" class="form-control" value="<?= htmlspecialchars($data['nim']) ?>" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Email</label>
                                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($data['email']) ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Kontak (HP)</label>
                                <input type="text" name="kontak" class="form-control" value="<?= htmlspecialchars($data['kontak']) ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Program Studi</label>
                            <input type="text" name="prodi" class="form-control" value="<?= htmlspecialchars($data['prodi']) ?>" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Alamat Lengkap</label>
                            <textarea name="alamat" class="form-control" rows="3" required><?= htmlspecialchars($data['alamat']) ?></textarea>
                        </div>

                        <div class="d-flex gap-2 justify-content-end border-top pt-3">                            
                            <button type="submit" name="simpan_profil" class="btn btn-primary px-4">Simpan Perubahan</button>
                            <a href="index.php?page=profile_mahasiswa" class="btn btn-light px-4 border">Batal</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewImage() {
    const input = document.getElementById('fotoInput');
    const preview = document.getElementById('preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) { preview.src = e.target.result; }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>