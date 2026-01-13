<?php
include '../../init.php';
include '../../service/auth.php';
require_once '../../repository/Jurusan.php';

$id = $_GET['id'] ?? null;
if (!$id) {
  header('Location: ' . BASE_URL . 'layout/read/data_jurusan.php');
  exit;
}

$data = Jurusan::getById($id);
?>

<?php include '../../partials/dashboard/header.php'; ?>

<div class="container-fluid">

  <h3>Form Edit Jurusan</h3>
  <br>

  <form action="<?= BASE_URL ?>process/jurusan/save.php" method="POST">

    <!-- HIDDEN -->
    <input type="hidden" name="id_jurusan" value="<?= $data['id'] ?>">
    <input type="hidden" name="id_user" value="<?= $data['id_user'] ?>">

    <!-- ACCOUNT FORM -->
    <div class="card mb-3">
      <div class="card-body">
        <h5 class="card-title mb-4">Account Form</h5>

        <div class="mb-3">
          <label class="form-label">Username</label>
          <input type="text" class="form-control" name="username"
            value="<?= htmlspecialchars($data['username']) ?>" >
        </div>

        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" class="form-control" name="password" placeholder="******" >
        </div>

        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" name="email"
            value="<?= htmlspecialchars($data['email']) ?>">
        </div>
      </div>
    </div>

    <!-- DETAIL -->
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-4">Account Detail</h5>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">Nama Jurusan</label>
            <input type="text" class="form-control" name="nama_jurusan"
              value="<?= htmlspecialchars($data['nama_jurusan']) ?>">
          </div>

          <div class="col-md-6 mb-3">
            <label class="form-label">Kode Jurusan</label>
            <input type="text" class="form-control" name="kode_jurusan"
              value="<?= htmlspecialchars($data['kode_jurusan']) ?>">
          </div>
        </div>

        <div class="text-end">
          <button type="submit" class="btn btn-primary">
            Update Data Jurusan
          </button>
        </div>
      </div>
    </div>

  </form>
</div>

<?php include '../../partials/dashboard/footer.php'; ?>