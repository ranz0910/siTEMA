<?php
require_once __DIR__ . '/../service/connection.php';

class Perusahaan {
    public static function getAll() {
        global $connect;
        $sql = "SELECT p.*, u.username FROM perusahaan p JOIN users u ON p.id_user = u.id";
        return $connect->query($sql);
    }

    public static function create($data) {
        global $connect;
        $username = $data['username'];
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $id_roles = 3; // Role Perusahaan

        mysqli_begin_transaction($connect);
        try {
            $connect->query("INSERT INTO users (id_roles, username, password, email) VALUES ('$id_roles', '$username', '$password', '{$data['email_perusahaan']}')");
            $id_user = $connect->insert_id;

            $connect->query("INSERT INTO perusahaan (id_user, nama_perusahaan, alamat, email, kontak) 
                            VALUES ('$id_user', '{$data['nama_perusahaan']}', '{$data['alamat_perusahaan']}', '{$data['email_perusahaan']}', '{$data['kontak_perusahaan']}')");
            
            mysqli_commit($connect);
            return ['status' => true];
        } catch (Exception $e) {
            mysqli_rollback($connect);
            return ['status' => false, 'msg' => $e->getMessage()];
        }
    }

    public static function delete($id) {
        global $connect;
        $data = $connect->query("SELECT id_user FROM perusahaan WHERE id = '$id'")->fetch_assoc();
        $id_user = $data['id_user'];

        $connect->query("DELETE FROM perusahaan WHERE id = '$id'");
        return $connect->query("DELETE FROM users WHERE id = '$id_user'");
    }
}