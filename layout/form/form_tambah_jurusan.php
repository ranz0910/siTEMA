
<div class="container-fluid">
  <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-4">Form Input Data Jurusan</h5>
            <form action="process/login/jurusan/TambahJurusan.php" method="POST">
                <div class="mb-3">
                    <label for="nama_jurusan" class="form-label">Nama Jurusan</label>
                    <input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan" placeholder="Masukkan nama jurusan" required>
                </div>

                <div class="mb-3">
                    <label for="ketua_jurusan" class="form-label">Nama Ketua Jurusan</label>
                    <input type="text" class="form-control" id="ketua_jurusan" name="ketua_jurusan" placeholder="Masukkan nama ketua jurusan" required>
                </div>

                <div class="mb-3">
                    <label for="email_jurusan" class="form-label">Email Jurusan</label>
                    <input type="email" class="form-control" id="email_jurusan" name="email_jurusan" placeholder="email@jurusan.ac.id" required>
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Username Login</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username login" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="******" required>
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="confirm" required>
                    <label class="form-check-label" for="confirm">Data yang saya masukkan sudah benar</label>
                </div>

                <button type="submit" name="submit_jurusan" class="btn btn-primary">Simpan Data Jurusan</button>
            </form>
        </div>
    </div>
</div>
