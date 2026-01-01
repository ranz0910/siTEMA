<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <div class="d-flex align-items-center justify-content-between mb-4">
        <h5 class="card-title fw-semibold mb-0">Data Program Studi</h5>
        <a href="index.php?page=form_tambah_prodi" class="btn btn-primary">
          <i class="ti ti-plus me-1"></i> Input Data Prodi
        </a>
      </div>
      
      <p class="mb-0">Berikut adalah daftar program studi yang terdaftar dalam sistem.</p>
      
      <div class="table-responsive mt-4">
        <table class="table table-bordered table-striped">
          <thead class="text-white bg-primary">
            <tr>
              <th>No</th>
              <th>Kode Prodi</th>
              <th>Nama Program Studi</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
              // Ambil data dari tabel prodi/jurusan (sesuaikan nama tabel Anda)
              $no = 1;
              $query = mysqli_query($koneksi, "SELECT * FROM jurusan ORDER BY id DESC");
              while($row = mysqli_fetch_assoc($query)):
            ?>
            <tr>
              <td><?= $no++; ?></td>
              <td>PRODI-<?= $row['id']; ?></td> <td><?= $row['nama_jurusan']; ?></td>
              <td>
                <a href="index.php?page=form_tambah_prodi&id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">
                   <i class="ti ti-edit"></i> Edit
                </a>
                
                <a href="service/hapus_prodi.php?id=<?= $row['id']; ?>" 
                   class="btn btn-sm btn-danger" 
                   onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                   <i class="ti ti-trash"></i> Hapus
                </a>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>