<?php
require_once __DIR__ . '/../service/connection.php';

class Mahasiswa {
    public static function getAll()
    {
        global $connect;

        $sql = "
            SELECT
                m.id AS id_mahasiswa,
                m.nim,
                m.nama_mahasiswa,
                m.alamat,
                m.no_hp,
                m.angkatan,
                u.username,
                u.email,
                j.nama_jurusan,    -- Pastikan kolom ini ada di tabel jurusan
                p.nama_prodi AS prodi -- Kita beri alias 'prodi' agar sesuai layout
            FROM mahasiswa m
            JOIN users u ON m.id_user = u.id
            LEFT JOIN prodi p ON m.id_prodi = p.id
            LEFT JOIN jurusan j ON p.id_jurusan = j.id
            ORDER BY m.nama_mahasiswa ASC
        ";

        return mysqli_query($connect, $sql);
    }

    /* =======================
        GET BY ID
    ======================= */
    public static function getById($id)
    {
        global $connect;
        $id = mysqli_real_escape_string($connect, $id);
        $sql = "SELECT m.*, m.id as id_mahasiswa, u.username, u.email 
                FROM mahasiswa m 
                JOIN users u ON m.id_user = u.id 
                WHERE m.id = '$id'";
        $result = mysqli_query($connect, $sql);
        return mysqli_fetch_assoc($result);
    }

    /* =======================
        DELETE (Mahasiswa + User)
    ======================= */
    public static function delete($id)
    {
        global $connect;
        $id = mysqli_real_escape_string($connect, $id);
        
        // Ambil id_user dulu sebelum data mahasiswa dihapus
        $data = self::getById($id);
        $id_user = $data['id_user'];

        mysqli_begin_transaction($connect);
        try {
            // Hapus Mahasiswa
            mysqli_query($connect, "DELETE FROM mahasiswa WHERE id = '$id'");
            // Hapus User Login
            mysqli_query($connect, "DELETE FROM users WHERE id = '$id_user'");

            mysqli_commit($connect);
            return ['status' => true];
        } catch (Exception $e) {
            mysqli_rollback($connect);
            return ['status' => false, 'msg' => $e->getMessage()];
        }
    }

    public static function create($data) {
        global $connect;
        $username = mysqli_real_escape_string($connect, $data['username']);
        
        // Cek apakah username sudah ada
        $check = mysqli_query($connect, "SELECT id FROM users WHERE username = '$username'");
        if (mysqli_num_rows($check) > 0) {
            return ['status' => false, 'msg' => 'Username sudah digunakan, cari yang lain!'];
        }
        $username = mysqli_real_escape_string($connect, $data['username']);
        $email    = mysqli_real_escape_string($connect, $data['email']);
        $password = md5($data['password']);
        $id_roles = 4;

        mysqli_begin_transaction($connect);
        try {
            // PERBAIKAN: Sertakan email agar tidak terjadi duplicate string kosong
            mysqli_query($connect, "INSERT INTO users (username, email, password, id_roles) 
                                    VALUES ('$username', '$email', '$password', '$id_roles')");
            
            $id_user = mysqli_insert_id($connect);
            $id_prodi = mysqli_real_escape_string($connect, $data['id_prodi']);
            $nim = mysqli_real_escape_string($connect, $data['nim']);
            $nama = mysqli_real_escape_string($connect, $data['nama_mahasiswa']);
            $jk = mysqli_real_escape_string($connect, $data['jenis_kelamin']);
            $alamat = mysqli_real_escape_string($connect, $data['alamat']);
            $no_hp = mysqli_real_escape_string($connect, $data['no_hp']);
            $angkatan = mysqli_real_escape_string($connect, $data['angkatan']);

            mysqli_query($connect, "INSERT INTO mahasiswa (id_user, id_prodi, nim, nama_mahasiswa, jenis_kelamin, alamat, no_hp, angkatan)
                                    VALUES ('$id_user', '$id_prodi', '$nim', '$nama', '$jk', '$alamat', '$no_hp', '$angkatan')");

            mysqli_commit($connect);
            return ['status' => true];
        } catch (Exception $e) {
            mysqli_rollback($connect);
            return ['status' => false, 'msg' => $e->getMessage()];
        }
    }

    public static function update($data)
    {
        global $connect;

        // Gunakan null coalescing (??) untuk mencegah "Undefined array key"
        $id_mhs   = mysqli_real_escape_string($connect, $data['id_mahasiswa']);
        $id_user  = mysqli_real_escape_string($connect, $data['id_user']);
        $username = mysqli_real_escape_string($connect, $data['username']);
        $email    = mysqli_real_escape_string($connect, $data['email']);
        $nim      = mysqli_real_escape_string($connect, $data['nim']);
        $nama     = mysqli_real_escape_string($connect, $data['nama_mahasiswa']);
        $jk       = mysqli_real_escape_string($connect, $data['jenis_kelamin']);
        $alamat   = mysqli_real_escape_string($connect, $data['alamat']);
        $no_hp    = mysqli_real_escape_string($connect, $data['no_hp']);
        $id_prodi = mysqli_real_escape_string($connect, $data['id_prodi']);// Default ke 0 jika kosong
        $angkatan = mysqli_real_escape_string($connect, $data['angkatan']);

        mysqli_begin_transaction($connect);

        try {
            // Update Tabel Users
            $sqlUser = "UPDATE users SET username = '$username', email = '$email' WHERE id = '$id_user'";
            if (!mysqli_query($connect, $sqlUser)) {
                throw new Exception("Gagal update user: " . mysqli_error($connect));
            }

            // Update Password jika diisi
            if (!empty($data['password'])) {
                $pass = md5($data['password']);
                mysqli_query($connect, "UPDATE users SET password = '$pass' WHERE id = '$id_user'");
            }

            // Update Tabel Mahasiswa (Pastikan WHERE id sesuai nama kolom di DB)
            // Jika nama kolom primernya 'id', maka WHERE id = '$id_mhs'
            $sqlMhs = "UPDATE mahasiswa SET 
                        nim = '$nim', 
                        nama_mahasiswa = '$nama', 
                        jenis_kelamin = '$jk', 
                        alamat = '$alamat', 
                        no_hp = '$no_hp', 
                        id_prodi = '$id_prodi',
                        angkatan = '$angkatan' 
                    WHERE id = '$id_mhs'";
            
            if (!mysqli_query($connect, $sqlMhs)) {
                throw new Exception("Gagal update mahasiswa: " . mysqli_error($connect));
            }

            mysqli_commit($connect);
            return ['status' => true];

        } catch (Exception $e) {
            mysqli_rollback($connect);
            return ['status' => false, 'msg' => $e->getMessage()];
        }
    }
}