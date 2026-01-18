<?php
class Jurusan {
    public static function getAll() {
        global $koneksi;
        $sql = "SELECT j.*, u.username, u.email FROM jurusan j 
                JOIN users u ON j.id_user = u.id ORDER BY j.nama_jurusan ASC";
        return mysqli_query($koneksi, $sql);
    }

    public static function getById($id) {
        global $koneksi;
        $id = mysqli_real_escape_string($koneksi, $id);
        $sql = "SELECT j.*, u.username, u.email FROM jurusan j 
                JOIN users u ON j.id_user = u.id WHERE j.id = '$id'";
        $result = mysqli_query($koneksi, $sql);
        return mysqli_fetch_assoc($result);
    }

    public static function create($data)
    {
        global $koneksi;
        $username      = $data['username'];
        $password      = md5($data['password']);
        $email         = $data['email'];
        $nama_jurusan  = $data['nama_jurusan'];
        $kode_jurusan  = $data['kode_jurusan'];
        $id_roles      = 2;

        // cek duplikat
        $cek = $koneksi->query("
        SELECT id FROM users 
        WHERE username='$username' OR email='$email'");

        if ($cek->num_rows > 0) {
            return ['status' => false, 'msg' => 'Username atau Email sudah terdaftar'];
        }

        // insert users
        $koneksi->query("
        INSERT INTO users (id_roles, username, password, email)
        VALUES ('$id_roles', '$username', '$password', '$email')");

        $id_user = $koneksi->insert_id;

        // insert jurusan
        $koneksi->query("
        INSERT INTO jurusan (id_user, nama_jurusan, kode_jurusan)
        VALUES ('$id_user', '$nama_jurusan', '$kode_jurusan')");

        return ['status' => true];
    }

    public static function update($data) {
        global $koneksi; // Pastikan ini sesuai dengan nama di DatabaseConfig.php

        $id_jurusan   = mysqli_real_escape_string($koneksi, $data['id_jurusan']);
        $id_user      = mysqli_real_escape_string($koneksi, $data['id_user']);
        $username     = mysqli_real_escape_string($koneksi, $data['username']);
        $email        = mysqli_real_escape_string($koneksi, $data['email']);
        $nama_jurusan = mysqli_real_escape_string($koneksi, $data['nama_jurusan']);
        $kode_jurusan = mysqli_real_escape_string($koneksi, $data['kode_jurusan']);

        mysqli_begin_transaction($koneksi);
        try {
            // 1. Update Tabel Users (Gunakan id_user)
            $queryUser = "UPDATE users SET username = '$username', email = '$email' WHERE id = '$id_user'";
            mysqli_query($koneksi, $queryUser);
            // 2. Update Tabel Jurusan (Gunakan id_jurusan)
            $queryJurusan = "UPDATE jurusan SET nama_jurusan = '$nama_jurusan', kode_jurusan = '$kode_jurusan' WHERE id = '$id_jurusan'";
            mysqli_query($koneksi, $queryJurusan);

            mysqli_commit($koneksi);
            return true;
        } catch (Exception $e) {
            mysqli_rollback($koneksi);
            return false;
        }
    }

    public static function delete($id_jurusan)
    {
        global $koneksi;

        // Ambil id_user dulu (biar user ikut kehapus)
        $get = $koneksi->query("
        SELECT id_user FROM jurusan WHERE id = '$id_jurusan'");

        if ($get->num_rows == 0) {
            return ['status' => false, 'msg' => 'Data jurusan tidak ditemukan'];
        }

        $row = $get->fetch_assoc();
        $id_user = $row['id_user'];

        // Hapus jurusan
        $koneksi->query("
        DELETE FROM jurusan WHERE id = '$id_jurusan'");

        // Hapus user
        $koneksi->query("
        DELETE FROM users WHERE id = '$id_user'");

        return ['status' => true];
    }
}
