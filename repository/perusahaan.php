<?php
class Perusahaan
{
  /* ================= GET ALL ================= */
  public static function getAll()
  {
    global $koneksi;

    $sql = "
            SELECT 
                p.*,
                u.username,
                u.email
            FROM perusahaan p
            JOIN users u ON p.id_user = u.id
            ORDER BY p.nama_perusahaan ASC
        ";

    return mysqli_query($koneksi, $sql);
  }

  /* ================= GET BY ID ================= */
  public static function getById($id)
  {
    global $koneksi;
    $id = mysqli_real_escape_string($koneksi, $id);

    $sql = "
            SELECT 
                p.*,
                u.username,
                u.email,
                u.id AS id_user
            FROM perusahaan p
            JOIN users u ON p.id_user = u.id
            WHERE p.id = '$id'
        ";

    $result = mysqli_query($koneksi, $sql);
    return mysqli_fetch_assoc($result);
  }

  /* ================= CREATE ================= */
  public static function create($data)
  {
    global $koneksi;

    $username          = $data['username'];
    $password          = md5($data['password']);
    $email             = $data['email'];
    $npwp              = $data['npwp'];
    $nama_perusahaan   = $data['nama_perusahaan'];
    $alamat_perusahaan = $data['alamat_perusahaan'];
    $telp_perusahaan   = $data['telp_perusahaan'];
    $id_roles          = 3; // role perusahaan

    // ===== CEK DUPLIKAT USER =====
    $cekUser = $koneksi->query("
        SELECT id FROM users 
        WHERE username='$username' OR email='$email'
    ");

    if ($cekUser->num_rows > 0) {
      return ['status' => false, 'msg' => 'Username atau Email sudah terdaftar'];
    }

    // ===== CEK DUPLIKAT NPWP =====
    $cekNpwp = $koneksi->query("
        SELECT id FROM perusahaan WHERE npwp='$npwp'
    ");

    if ($cekNpwp->num_rows > 0) {
      return ['status' => false, 'msg' => 'NPWP sudah terdaftar'];
    }

    // ===== INSERT USERS =====
    $koneksi->query("
        INSERT INTO users (id_roles, username, password, email)
        VALUES ('$id_roles', '$username', '$password', '$email')
    ");

    $id_user = $koneksi->insert_id;

    // ===== INSERT PERUSAHAAN =====
    $koneksi->query("
        INSERT INTO perusahaan 
        (id_user, npwp, nama_perusahaan, alamat_perusahaan, telp_perusahaan)
        VALUES 
        ('$id_user', '$npwp', '$nama_perusahaan', '$alamat_perusahaan', '$telp_perusahaan')
    ");

    return ['status' => true];
  }


  /* ================= UPDATE ================= */
  public static function update($data)
  {
    global $koneksi;

    $id_perusahaan = mysqli_real_escape_string($koneksi, $data['id_perusahaan']);
    $id_user       = mysqli_real_escape_string($koneksi, $data['id_user']);

    $username = mysqli_real_escape_string($koneksi, $data['username']);
    $email    = mysqli_real_escape_string($koneksi, $data['email']);

    $npwp   = mysqli_real_escape_string($koneksi, $data['npwp']);
    $nama   = mysqli_real_escape_string($koneksi, $data['nama_perusahaan']);
    $alamat = mysqli_real_escape_string($koneksi, $data['alamat_perusahaan']);
    $telp   = mysqli_real_escape_string($koneksi, $data['telp_perusahaan']);

    mysqli_begin_transaction($koneksi);

    try {
      // Update users
      $koneksi->query("
                UPDATE users 
                SET username = '$username', email = '$email'
                WHERE id = '$id_user'
            ");

      // Update perusahaan
      $koneksi->query("
                UPDATE perusahaan 
                SET 
                    npwp = '$npwp',
                    nama_perusahaan = '$nama',
                    alamat_perusahaan = '$alamat',
                    telp_perusahaan = '$telp'
                WHERE id = '$id_perusahaan'
            ");

      mysqli_commit($koneksi);
      return true;
    } catch (Exception $e) {
      mysqli_rollback($koneksi);
      return false;
    }
  }

  /* ================= DELETE ================= */
  public static function delete($id_perusahaan)
  {
    global $koneksi;
    $id_perusahaan = mysqli_real_escape_string($koneksi, $id_perusahaan);

    // Ambil id_user
    $get = $koneksi->query("
            SELECT id_user FROM perusahaan WHERE id = '$id_perusahaan'
        ");

    if ($get->num_rows == 0) {
      return [
        'status' => false,
        'msg' => 'Data perusahaan tidak ditemukan'
      ];
    }

    $row = $get->fetch_assoc();
    $id_user = $row['id_user'];

    mysqli_begin_transaction($koneksi);

    try {
      // Hapus perusahaan
      $koneksi->query("
                DELETE FROM perusahaan WHERE id = '$id_perusahaan'
            ");

      // Hapus user
      $koneksi->query("
                DELETE FROM users WHERE id = '$id_user'
            ");

      mysqli_commit($koneksi);
      return ['status' => true];
    } catch (Exception $e) {
      mysqli_rollback($koneksi);
      return [
        'status' => false,
        'msg' => 'Gagal menghapus data perusahaan'
      ];
    }
  }
}
