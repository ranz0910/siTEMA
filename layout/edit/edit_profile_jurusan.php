<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include $_SERVER['DOCUMENT_ROOT'] . '/siTEMA/service/connection.php';

// Ambil ID dari URL
$id_jurusan = isset($_GET['id']) ? mysqli_real_escape_string($connect, $_GET['id']) : '';

if (empty($id_jurusan)) {
    echo "<div class='alert alert-danger m-3'>Error: ID tidak valid.</div>";
    return;
}

// Ambil data lama dari database
$query = "SELECT * FROM jurusan WHERE id = '$id_jurusan'";
$result = mysqli_query($connect, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "<div class='alert alert-warning m-3'>Data tidak ditemukan.</div>";
    return;
}
?>

<div class="container-fluid">
    <div class="card bg-light-info shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <h4 class="fw-semibold mb-8">Edit Profil Jurusan</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-muted" href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a class="text-muted" href="index.php?page=profile_jurusan&id=<?= $id_jurusan ?>">Profil</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-transparent border-bottom">
                    <h5 class="card-title fw-semibold mb-0 py-2">Formulir Perubahan Data</h5>
                </div>
                <div class="card-body">
                    <form action="process/jurusan/update_profile.php" method="POST">
                        <input type="hidden" name="id" value="<?= $data['id'] ?>">

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Nama Resmi Jurusan</label>
                            <input type="text" class="form-control" name="nama_jurusan" 
                                   value="<?= htmlspecialchars($data['nama_jurusan']) ?>" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">ID Pengelola (Read Only)</label>
                            <input type="text" class="form-control bg-light" 
                                   value="USR-0<?= htmlspecialchars($data['id_user']) ?>" readonly>
                        </div>

                        <div class="d-flex justify-content-between mt-5">
                            <a href="index.php?page=profile_jurusan&id=<?= $data['id'] ?>" class="btn btn-outline-dark">Batal</a>
                            <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>