<?php
require_once __DIR__ . '/../service/connection.php';

class Jurusan
{
    public static function getAll()
    {
        global $connect;

        $sql = "
        SELECT 
            j.id,
            j.nama_jurusan,
            j.kode_jurusan,
            u.username,
            u.email
        FROM jurusan j
        JOIN users u ON j.id_user = u.id
        ORDER BY j.nama_jurusan ASC
    ";

        return $connect->query($sql);
    }

    public static function getById($id_jurusan)
    {
        global $connect;

        $sql = "
        SELECT 
            j.id,
            j.kode_jurusan,
            j.nama_jurusan,
            u.id AS id_user,
            u.username,
            u.email
        FROM jurusan j
        JOIN users u ON j.id_user = u.id
        WHERE j.id = '$id_jurusan'
        LIMIT 1
    ";

        return $connect->query($sql)->fetch_assoc();
    }

    public static function create($data)
    {
        global $connect;

        $username      = $data['username'];
        $password      = md5($data['password']); // sesuai permintaan
        $email         = $data['email'];
        $nama_jurusan  = $data['nama_jurusan'];
        $kode_jurusan  = $data['kode_jurusan'];
        $id_roles      = 2;

        // cek duplikat
        $cek = $connect->query("
        SELECT id FROM users 
        WHERE username='$username' OR email='$email'
    ");

        if ($cek->num_rows > 0) {
            return ['status' => false, 'msg' => 'Username atau Email sudah terdaftar'];
        }

        // insert users
        $connect->query("
        INSERT INTO users (id_roles, username, password, email)
        VALUES ('$id_roles', '$username', '$password', '$email')
    ");

        $id_user = $connect->insert_id;

        // insert jurusan
        $connect->query("
        INSERT INTO jurusan (id_user, nama_jurusan, kode_jurusan)
        VALUES ('$id_user', '$nama_jurusan', '$kode_jurusan')
    ");

        return ['status' => true];
    }

    public static function update($data)
    {
        global $connect;

        $id_jurusan   = $data['id_jurusan'];
        $id_user      = $data['id_user'];
        $username     = $data['username'];
        $email        = $data['email'];
        $nama_jurusan = $data['nama_jurusan'];
        $kode_jurusan = $data['kode_jurusan'];

        // Update USERS
        $sqlUser = "
        UPDATE users SET
            username = '$username',
            email = '$email'
        WHERE id = '$id_user'
    ";

        // Update JURUSAN
        $sqlJurusan = "
        UPDATE jurusan SET
            nama_jurusan = '$nama_jurusan',
            kode_jurusan = '$kode_jurusan'
        WHERE id = '$id_jurusan'
    ";

        $connect->query($sqlUser);
        return $connect->query($sqlJurusan);
    }

    public static function delete($id_jurusan)
    {
        global $connect;

        // Ambil id_user dulu (biar user ikut kehapus)
        $get = $connect->query("
        SELECT id_user FROM jurusan WHERE id = '$id_jurusan'
    ");

        if ($get->num_rows == 0) {
            return ['status' => false, 'msg' => 'Data jurusan tidak ditemukan'];
        }

        $row = $get->fetch_assoc();
        $id_user = $row['id_user'];

        // Hapus jurusan
        $connect->query("
        DELETE FROM jurusan WHERE id = '$id_jurusan'
    ");

        // Hapus user
        $connect->query("
        DELETE FROM users WHERE id = '$id_user'
    ");

        return ['status' => true];
    }
}
