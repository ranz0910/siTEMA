<?php
require_once __DIR__ . '/../service/connection.php';

class Mahasiswa {
    public static function getAll() {
        global $connect;
        $sql = "SELECT m.*, u.username, u.email 
                FROM mahasiswa m 
                JOIN users u ON m.id_user = u.id 
                ORDER BY m.nama_mahasiswa ASC";
        return $connect->query($sql);
    }

    public static function getById($id) {
        global $connect;
        $sql = "SELECT m.*, u.username, u.email 
                FROM mahasiswa m 
                JOIN users u ON m.id_user = u.id 
                WHERE m.id = '$id' LIMIT 1";
        return $connect->query($sql)->fetch_assoc();
    }

    public static function create($data) {
        global $connect;
        $username = $data['username'];
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $id_roles = 4; // Role Mahasiswa

        mysqli_begin_transaction($connect);
        try {
            $connect->query("INSERT INTO users (username, password, id_roles) VALUES ('$username', '$password', '$id_roles')");
            $id_user = $connect->insert_id;

            $connect->query("INSERT INTO mahasiswa (id_user, nama_mahasiswa, nim, email, kontak, prodi, alamat) 
                            VALUES ('$id_user', '{$data['nama_mahasiswa']}', '{$data['nim_mahasiswa']}', '{$data['email_mahasiswa']}', '{$data['kontak_mahasiswa']}', '{$data['prodi_mahasiswa']}', '{$data['alamat_mahasiswa']}')");
            
            mysqli_commit($connect);
            return ['status' => true];
        } catch (Exception $e) {
            mysqli_rollback($connect);
            return ['status' => false, 'msg' => $e->getMessage()];
        }
    }

    public static function delete($id) {
        global $connect;
        $res = $connect->query("SELECT id_user FROM mahasiswa WHERE id = '$id'");
        $data = $res->fetch_assoc();
        $id_user = $data['id_user'];

        mysqli_begin_transaction($connect);
        try {
            $connect->query("DELETE FROM mahasiswa WHERE id = '$id'");
            $connect->query("DELETE FROM users WHERE id = '$id_user'");
            mysqli_commit($connect);
            return ['status' => true];
        } catch (Exception $e) {
            mysqli_rollback($connect);
            return ['status' => false, 'msg' => $e->getMessage()];
        }
    }
}