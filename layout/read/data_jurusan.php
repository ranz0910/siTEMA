<?php
include '../../init.php';
include '../../service/auth.php';
require_once '../../repository/jurusan.php';

$dataJurusan = Jurusan::getAll();
?>

<?php
include '../../partials/dashboard/header.php';
?>

<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <div class="d-flex mb-4 justify-content-between align-items-center">
        <h5 class="card-title fw-semibold mb-0">Data Jurusan</h5>
        <a href="<?php echo BASE_URL; ?>layout/create/form_tambah_jurusan.php" class="btn btn-primary">Tambah Data Jurusan</a>
      </div>
      <div class="card w-100">
        <div class="card-body p-4">
          <div class="table-responsive">
            <table class="table text-nowrap mb-0 align-middle">

              <thead class="text-dark fs-4">
                <tr>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">No</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Username</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Kode Jurusan</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Nama Jurusan</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Email</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Aksi</h6>
                  </th>
                </tr>
              </thead>

              <tbody>
                <?php if ($dataJurusan->num_rows > 0): ?>
                  <?php $no = 1; ?>
                  <?php while ($row = $dataJurusan->fetch_assoc()): ?>
                    <tr>
                      <!-- No -->
                      <td class="border-bottom-0">
                        <h6 class="fw-semibold mb-0"><?= $no++; ?></h6>
                      </td>

                      <!-- Username -->
                      <td class="border-bottom-0">
                        <p class="mb-0 fw-normal">
                          <?= htmlspecialchars($row['username']); ?>
                        </p>
                      </td>

                      <!-- Kode Jurusan -->
                      <td class="border-bottom-0">
                        <p class="mb-0 fw-normal">
                          <?= htmlspecialchars($row['kode_jurusan']); ?>
                        </p>
                      </td>

                      <!-- Nama Jurusan -->
                      <td class="border-bottom-0">
                        <p class="mb-0 fw-normal">
                          <?= htmlspecialchars($row['nama_jurusan']); ?>
                        </p>
                      </td>

                      <!-- Email -->
                      <td class="border-bottom-0">
                        <p class="mb-0 fw-normal">
                          <?= htmlspecialchars($row['email']); ?>
                        </p>
                      </td>

                      <td class="border-bottom-0">
                        <div class="d-flex gap-2">
                          <!-- Edit -->
                          <a href="<?= BASE_URL; ?>layout/edit/form_edit_jurusan.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning" title="Edit">
                            <i class="ti ti-edit"></i>
                          </a>

                          <!-- Delete -->
                          <a href="<?= BASE_URL; ?>process/jurusan/delete.php?id=<?= $row['id']; ?>"
                            class="btn btn-sm btn-danger" title="Hapus"
                            onclick="return confirm('Yakin ingin menghapus data jurusan ini?')">
                            <i class="ti ti-trash"></i>
                          </a>
                        </div>
                      </td>
                    </tr>
                  <?php endwhile; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="5" class="text-center">
                      Data jurusan belum tersedia
                    </td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include '../../partials/dashboard/footer.php';
?>