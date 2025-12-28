<?php

require 'service/connection.php';

// Ambil data jurusan + user terkait
$sql = "
  SELECT 
    j.id,
    j.nama_jurusan,
    u.email,
    u.username
  FROM jurusan j
  JOIN users u 
      ON j.id_user = u.id
  ORDER BY j.id DESC
";
$result = $connect->query($sql);
?>

<div class="col-lg-12 mt-4">
  <div class="card mb-3">
    <div class="card-body p-4 d-flex justify-content-between align-items-center">
      <h5 class="card-title fw-semibold mb-0">Data Jurusan</h5>
      <a href="index.php?page=form_tambah_jurusan" class="btn btn-primary">
        Tambah Data Jurusan
      </a>
    </div>
  </div>
</div>

<div class="card w-100">
  <div class="card-body p-4">
    <div class="table-responsive">
      <table class="table text-nowrap mb-0 align-middle">
        <thead class="text-dark fs-4">
          <tr>
            <th>Nama Jurusan</th>
            <th>Email Jurusan</th>
            <th>Username</th>
            <th>Password</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
              <tr>
                <td><?= htmlspecialchars($row['nama_jurusan']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['username']) ?></td>
                <td>********</td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr>
              <td colspan="4" class="text-center text-muted">
                Belum ada data jurusan              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>