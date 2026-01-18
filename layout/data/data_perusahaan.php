<div class="container-fluid">
  <div class="card shadow-sm">
    <div class="card-body">
      <div class="d-flex mb-4 justify-content-between align-items-center">
        <div>
          <h5 class="card-title fw-bold mb-1">Data Mitra Perusahaan</h5>
          <p class="text-muted mb-0 small">Daftar perusahaan mitra yang tersedia untuk program magang.</p>
        </div>
        <a href="index.php?page=form_tambah_perusahaan" class="btn btn-primary d-flex align-items-center">
          <i class="ti ti-plus me-2 fs-4"></i>Tambah Data Perusahaan
        </a>
      </div>

      <div class="table-responsive">
        <table class="table table-hover align-middle border">
          <thead class="table-light">
            <tr>
              <th class="py-3 px-4" width="5%">No</th>
              <th class="py-3">Nama Perusahaan</th>
              <th class="py-3">Alamat</th>
              <th class="py-3">Kontak & Email</th>
              <th class="py-3 text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $no = 1;
              // Mengambil data dari tabel perusahaan
              $query = "SELECT * FROM perusahaan ORDER BY nama_perusahaan ASC";
              $result = mysqli_query($koneksi, $query);

              if (mysqli_num_rows($result) > 0):
                while($row = mysqli_fetch_assoc($result)): 
            ?>
            <tr>
              <td class="px-4 text-muted"><?= $no++; ?></td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="bg-light-info text-info rounded-2 p-2 me-3">
                    <i class="ti ti-briefcase fs-6"></i>
                  </div>
                  <h6 class="fw-bold mb-0"><?= htmlspecialchars($row['nama_perusahaan']); ?></h6>
                </div>
              </td>
              <td>
                <p class="mb-0 small text-wrap" style="max-width: 250px;">
                  <i class="ti ti-map-pin me-1 text-danger"></i><?= htmlspecialchars($row['alamat']); ?>
                </p>
              </td>
              <td>
                <div class="mb-1">
                  <i class="ti ti-phone me-1 text-success"></i><small><?= htmlspecialchars($row['kontak']); ?></small>
                </div>
                <div>
                  <i class="ti ti-mail me-1 text-primary"></i><small><?= htmlspecialchars($row['email']); ?></small>
                </div>
              </td>
              <td class="text-center">
                <div class="btn-group shadow-sm">
                  <a href="index.php?page=form_edit_perusahaan&id=<?= $row['id']; ?>" class="btn btn-outline-warning btn-sm">
                    <i class="ti ti-edit fs-4"></i>
                  </a>
                  <a href="process/perusahaan/hapus_perusahaan.php?id=<?= $row['id']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Hapus data perusahaan ini?')" title="Hapus">
                    <i class="ti ti-trash fs-4"></i>
                  </a>
                </div>
              </td>
            </tr>
            <?php 
                endwhile; 
              else: 
            ?>
            <tr>
              <td colspan="5" class="text-center py-5 text-muted">Belum ada data perusahaan.</td>
            </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>