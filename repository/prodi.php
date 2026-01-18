<?php
require_once __DIR__ . '/../service/connection.php';

class Prodi {
    public static function getAll() {
        global $connect;
        return $connect->query("SELECT * FROM prodi ORDER BY nama_prodi ASC");
    }

    public static function create($data) {
        global $connect;
        $nama = mysqli_real_escape_string($connect, $data['nama_prodi']);
        return $connect->query("INSERT INTO prodi (nama_prodi) VALUES ('$nama')");
    }

    public static function update($id, $nama) {
        global $connect;
        $nama = mysqli_real_escape_string($connect, $nama);
        return $connect->query("UPDATE prodi SET nama_prodi = '$nama' WHERE id = '$id'");
    }

    public static function delete($id) {
        global $connect;
        // Kita beri status agar di file proses bisa menampilkan pesan error jika gagal (FK constraint)
        try {
            $res = $connect->query("DELETE FROM prodi WHERE id = '$id'");
            return ['status' => $res];
        } catch (Exception $e) {
            return ['status' => false, 'msg' => 'Data terkait dengan tabel lain'];
        }
    }
}