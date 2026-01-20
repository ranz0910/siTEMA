<?php
class Mahasiswa
{
    // ================= GET ALL MAHASISWA SESUAI JURUSAN =================
    public static function getAllByJurusan($id_jurusan)
    {
        global $koneksi;
        $id_jurusan = (int)$id_jurusan;

        $sql = "
        SELECT m.*, u.username, u.email, p.nama_prodi
        FROM mahasiswa m
        JOIN users u ON m.id_user = u.id
        JOIN prodi p ON m.id_prodi = p.id
        WHERE p.id_jurusan = '$id_jurusan'
        ORDER BY m.nama_mahasiswa ASC
        ";

        return mysqli_query($koneksi, $sql);
    }

    // ================= CREATE MAHASISWA =================
    public static function create($data)
    {
        global $koneksi;

        $username       = mysqli_real_escape_string($koneksi, $data['username']);
        $password       = md5($data['password']);
        $email          = mysqli_real_escape_string($koneksi, $data['email']);
        $nim            = mysqli_real_escape_string($koneksi, $data['nim']);
        $nama_mahasiswa = mysqli_real_escape_string($koneksi, $data['nama_mahasiswa']);
        $jenis_kelamin  = mysqli_real_escape_string($koneksi, $data['jenis_kelamin']);
        $alamat         = mysqli_real_escape_string($koneksi, $data['alamat']);
        $angkatan       = mysqli_real_escape_string($koneksi, $data['angkatan']);
        $no_hp          = mysqli_real_escape_string($koneksi, $data['no_hp']);
        $id_prodi       = (int)$data['id_prodi'];
        $id_roles       = 4; // Role Mahasiswa

        // Cek duplikat username/email
        $cek = $koneksi->query("SELECT id FROM users WHERE username='$username' OR email='$email'");
        if ($cek->num_rows > 0) {
            return ['status' => false, 'msg' => 'Username atau Email sudah terdaftar'];
        }

        // Mulai transaksi
        mysqli_begin_transaction($koneksi);
        try {
            // 1. Insert ke tabel users
            $koneksi->query("
                INSERT INTO users (id_roles, username, password, email)
                VALUES ('$id_roles', '$username', '$password', '$email')
            ");
            $id_user = $koneksi->insert_id;

            // 2. Insert ke tabel mahasiswa
            $koneksi->query("
                INSERT INTO mahasiswa (id_user, id_prodi, nim, nama_mahasiswa, jenis_kelamin, alamat, angkatan, no_hp)
                VALUES ('$id_user', '$id_prodi', '$nim', '$nama_mahasiswa', '$jenis_kelamin', '$alamat', '$angkatan', '$no_hp')
            ");

            mysqli_commit($koneksi);
            return ['status' => true];
        } catch (Exception $e) {
            mysqli_rollback($koneksi);
            return ['status' => false, 'msg' => 'Gagal menyimpan data mahasiswa'];
        }
    }

    // ================= UPDATE MAHASISWA =================
    public static function update($data)
    {
        global $koneksi;

        $id_mahasiswa   = (int)$data['id_mahasiswa'];
        $id_user        = (int)$data['id_user'];
        $username       = mysqli_real_escape_string($koneksi, $data['username']);
        $email          = mysqli_real_escape_string($koneksi, $data['email']);
        $nim            = mysqli_real_escape_string($koneksi, $data['nim']);
        $nama_mahasiswa = mysqli_real_escape_string($koneksi, $data['nama_mahasiswa']);
        $jenis_kelamin  = mysqli_real_escape_string($koneksi, $data['jenis_kelamin']);
        $alamat         = mysqli_real_escape_string($koneksi, $data['alamat']);
        $angkatan       = mysqli_real_escape_string($koneksi, $data['angkatan']);
        $no_hp          = mysqli_real_escape_string($koneksi, $data['no_hp']);
        $id_prodi       = (int)$data['id_prodi'];
        $password       = trim($data['password'] ?? ''); // opsional

        mysqli_begin_transaction($koneksi);
        try {
            // Update user
            if (!empty($password)) {
                $password_hashed = md5($password);
                $koneksi->query("
                    UPDATE users SET username='$username', email='$email', password='$password_hashed' WHERE id='$id_user'
                ");
            } else {
                $koneksi->query("
                    UPDATE users SET username='$username', email='$email' WHERE id='$id_user'
                ");
            }

            // Update mahasiswa
            $koneksi->query("
                UPDATE mahasiswa
                SET id_prodi='$id_prodi', nim='$nim', nama_mahasiswa='$nama_mahasiswa', jenis_kelamin='$jenis_kelamin',
                    alamat='$alamat', angkatan='$angkatan', no_hp='$no_hp'
                WHERE id='$id_mahasiswa'
            ");

            mysqli_commit($koneksi);
            return ['status' => true];
        } catch (Exception $e) {
            mysqli_rollback($koneksi);
            return ['status' => false, 'msg' => 'Gagal mengupdate data mahasiswa'];
        }
    }

    // ================= DELETE MAHASISWA =================
    public static function delete($id_mahasiswa)
    {
        global $koneksi;

        // Ambil id_user dulu
        $get = $koneksi->query("SELECT id_user FROM mahasiswa WHERE id='$id_mahasiswa'");
        if ($get->num_rows == 0) {
            return ['status' => false, 'msg' => 'Data mahasiswa tidak ditemukan'];
        }

        $row = $get->fetch_assoc();
        $id_user = $row['id_user'];

        // Hapus mahasiswa
        $koneksi->query("DELETE FROM mahasiswa WHERE id='$id_mahasiswa'");
        // Hapus user
        $koneksi->query("DELETE FROM users WHERE id='$id_user'");

        return ['status' => true];
    }
}
