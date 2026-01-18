<?php
require_once __DIR__ . '/../service/connection.php';

class Perusahaan {
    public static function getAll() {
        global $connect;        
        $sql = "SELECT p.*, p.id AS id_perusahaan, u.username, u.email
                FROM perusahaan p 
                JOIN users u ON p.id_user = u.id
                ORDER BY p.nama_perusahaan ASC";
        return mysqli_query($connect, $sql);
    }

    public static function getById($id) {
        global $connect;
        $id = mysqli_real_escape_string($connect, $id);
        $sql = "SELECT p.*, p.id AS id_perusahaan, u.username, u.email 
                FROM perusahaan p 
                JOIN users u ON p.id_user = u.id 
                WHERE p.id = '$id'";
        $result = mysqli_query($connect, $sql);
        return mysqli_fetch_assoc($result);
    }

    /* ===========================================================
        FUNGSI DELETE (Hapus Perusahaan + User Terkait)
       =========================================================== */
    public static function delete($id) {
        global $connect;
        $id = mysqli_real_escape_string($connect, $id);
        
        // 1. Ambil data perusahaan untuk mendapatkan id_user
        $data = self::getById($id);
        if (!$data) {
            return ['status' => false, 'msg' => 'Data perusahaan tidak ditemukan.'];
        }
        $id_user = $data['id_user'];

        mysqli_begin_transaction($connect);
        try {
            // 2. Hapus data dari tabel perusahaan
            mysqli_query($connect, "DELETE FROM perusahaan WHERE id = '$id'");
            
            // 3. Hapus data dari tabel users
            mysqli_query($connect, "DELETE FROM users WHERE id = '$id_user'");

            mysqli_commit($connect);
            return ['status' => true];
        } catch (Exception $e) {
            mysqli_rollback($connect);
            return ['status' => false, 'msg' => "Gagal menghapus: " . $e->getMessage()];
        }
    }

    /* ===========================================================
        FUNGSI CREATE (Tambah Perusahaan + User Baru)
       =========================================================== */
    public static function create($data) {
        global $connect;
        
        $username = mysqli_real_escape_string($connect, $data['username']);
        $email    = mysqli_real_escape_string($connect, $data['email_perusahaan']);
        $password = md5($data['password']); // Menggunakan md5 sesuai repo Mahasiswa Anda
        $id_roles = 3; 

        // Cek duplikat username
        $check = mysqli_query($connect, "SELECT id FROM users WHERE username = '$username'");
        if (mysqli_num_rows($check) > 0) {
            return ['status' => false, 'msg' => "Username '$username' sudah terdaftar."];
        }

        mysqli_begin_transaction($connect);
        try {
            // Simpan User
            mysqli_query($connect, "INSERT INTO users (username, email, password, id_roles) 
                                    VALUES ('$username', '$email', '$password', '$id_roles')");
            
            $id_user = mysqli_insert_id($connect);

            // Simpan Profil Perusahaan
            $nama   = mysqli_real_escape_string($connect, $data['nama_perusahaan']);
            $alamat = mysqli_real_escape_string($connect, $data['alamat_perusahaan']);
            $telp   = mysqli_real_escape_string($connect, $data['telp_perusahaan']);

            mysqli_query($connect, "INSERT INTO perusahaan (id_user, nama_perusahaan, alamat_perusahaan, email_perusahaan, telp_perusahaan) 
                                    VALUES ('$id_user', '$nama', '$alamat', '$email', '$telp')");

            mysqli_commit($connect);
            return ['status' => true];
        } catch (Exception $e) {
            mysqli_rollback($connect);
            return ['status' => false, 'msg' => $e->getMessage()];
        }
    }

    /* ===========================================================
        FUNGSI UPDATE (Perbarui Perusahaan + User)
       =========================================================== */
    public static function update($data) {
        global $connect;
        
        $id_perusahaan = mysqli_real_escape_string($connect, $data['id_perusahaan']);
        $id_user       = mysqli_real_escape_string($connect, $data['id_user']);
        $username      = mysqli_real_escape_string($connect, $data['username']);
        $email         = mysqli_real_escape_string($connect, $data['email_perusahaan']);
        
        // Pengecekan Username Duplikat (Kecuali milik sendiri)
        $check = mysqli_query($connect, "SELECT id FROM users WHERE username = '$username' AND id != '$id_user'");
        if (mysqli_num_rows($check) > 0) {
            return ['status' => false, 'msg' => "Username '$username' sudah digunakan akun lain."];
        }

        mysqli_begin_transaction($connect);
        try {
            // Update Users
            mysqli_query($connect, "UPDATE users SET username = '$username', email = '$email' WHERE id = '$id_user'");

            // Update Password jika diisi
            if (!empty($data['password'])) {
                $pass = md5($data['password']);
                mysqli_query($connect, "UPDATE users SET password = '$pass' WHERE id = '$id_user'");
            }

            // Update Perusahaan
            $nama   = mysqli_real_escape_string($connect, $data['nama_perusahaan']);
            $alamat = mysqli_real_escape_string($connect, $data['alamat_perusahaan']);
            $telp   = mysqli_real_escape_string($connect, $data['telp_perusahaan']);

            mysqli_query($connect, "UPDATE perusahaan SET 
                                    nama_perusahaan = '$nama', 
                                    alamat_perusahaan = '$alamat', 
                                    email_perusahaan = '$email', 
                                    telp_perusahaan = '$telp' 
                                    WHERE id = '$id_perusahaan'");

            mysqli_commit($connect);
            return ['status' => true];
        } catch (Exception $e) {
            mysqli_rollback($connect);
            return ['status' => false, 'msg' => $e->getMessage()];
        }
    }
}