<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">Form Input Data Jurusan</h5>
      <div class="card">
        <div class="card-body">
            <form action="process/login/jurusan/TambahJurusan.php" method="POST">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="namaJurusan" class="form-label">Nama Jurusan</label>
                <input type="text" name="nama_jurusan" class="form-control" id="namaJurusan" placeholder="Masukkan nama jurusan" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="emailJurusan" class="form-label">Email Jurusan</label>
                <input type="email" name="email_jurusan" class="form-control" id="emailJurusan" placeholder="email@jurusan.ac.id" required>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="usernameJurusan" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="usernameJurusan" placeholder="Username login" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="passJurusan" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="passJurusan" placeholder="******" required>
              </div>
            </div>

            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="confirmCheck" required>
              <label class="form-check-label" for="confirmCheck">Data yang saya masukkan sudah benar</label>
            </div>
            <button type="submit" name="submit_jurusan" class="btn btn-primary">Simpan Data Jurusan</button>
          </form>
        </div>
      </div>

      <h5 class="card-title fw-semibold mb-4">Disabled forms</h5>
      <div class="card mb-0">
        <div class="card-body">
          <form>
            <fieldset disabled>
              <legend>Disabled fieldset example</legend>
              <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Disabled input</label>
                <input type="text" id="disabledTextInput" class="form-control" placeholder="Disabled input">
              </div>
              <div class="mb-3">
                <label for="disabledSelect" class="form-label">Disabled select menu</label>
                <select id="disabledSelect" class="form-select">
                  <option>Disabled select</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </fieldset>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>