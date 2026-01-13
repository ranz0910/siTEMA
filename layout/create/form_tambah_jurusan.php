<?php
include '../../init.php';
include '../../service/auth.php';
?>

<?php include '../../partials/dashboard/header.php'; ?>

<div class="container-fluid">

    <h3>Form Tambah Jurusan</h3>
    <br>

    <form action="<?= BASE_URL ?>process/jurusan/save.php" method="POST">

        <!-- ACCOUNT FORM -->
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title mb-4">Account Form</h5>

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="******" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="email@jurusan.ac.id" required>
                </div>
            </div>
        </div>

        <!-- ACCOUNT DETAIL -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Account Detail</h5>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Jurusan</label>
                        <input type="text" class="form-control" name="nama_jurusan" placeholder="Nama Jurusan" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kode Jurusan</label>
                        <input type="text" class="form-control" name="kode_jurusan" placeholder="Kode Jurusan" required>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary mt-2">
                        Simpan Data Jurusan
                    </button>
                </div>
            </div>
        </div>

    </form>
</div>

<?php include '../../partials/dashboard/footer.php'; ?>