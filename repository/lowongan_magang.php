<?php
class Lowongan
{
  // ================= GET ALL LOWONGAN MILIK USER =================
  public static function getAllByUser($user_id)
  {
    global $koneksi;
    $user_id = (int)$user_id;

    $sql = "
        SELECT l.*, j.nama_jurusan
        FROM lowongan_magang l
        LEFT JOIN jurusan j ON l.id_jurusan = j.id
        WHERE l.id_perusahaan = '$user_id'
        ORDER BY l.judul_lowongan ASC
    ";

    return mysqli_query($koneksi, $sql);
  }


  // ================= GET LOWONGAN BY ID =================
  public static function getById($id, $user_id)
  {
    global $koneksi;
    $id = (int)$id;
    $user_id = (int)$user_id;

    $sql = "SELECT * FROM lowongan_magang 
                WHERE id = '$id' AND id_perusahaan = '$user_id'";
    $result = mysqli_query($koneksi, $sql);
    return mysqli_fetch_assoc($result);
  }


  // ================= CREATE LOWONGAN =================
  public static function create($data, $user_id)
  {
    global $koneksi;

    $id_jurusan = (int)$data['id_jurusan'];
    $judul      = mysqli_real_escape_string($koneksi, $data['judul_lowongan']);
    $deskripsi  = mysqli_real_escape_string($koneksi, $data['deskripsi']);
    $kuota      = (int)$data['kuota'];
    $user_id    = (int)$user_id;

    $sql = "INSERT INTO lowongan_magang (id_perusahaan, id_jurusan, judul_lowongan, deskripsi, kuota)
                VALUES ('$user_id', '$id_jurusan', '$judul', '$deskripsi', '$kuota')";

    if (mysqli_query($koneksi, $sql)) {
      return ['status' => true];
    } else {
      return ['status' => false, 'msg' => 'Gagal menambahkan lowongan'];
    }
  }

  // ================= UPDATE LOWONGAN =================
  public static function update($data, $user_id)
  {
    global $koneksi;

    $id         = (int)$data['id'];
    $id_jurusan = (int)$data['id_jurusan'];
    $judul      = mysqli_real_escape_string($koneksi, $data['judul_lowongan']);
    $deskripsi  = mysqli_real_escape_string($koneksi, $data['deskripsi']);
    $kuota      = (int)$data['kuota'];
    $user_id    = (int)$user_id;

    $sql = "UPDATE lowongan_magang SET 
                    id_jurusan = '$id_jurusan',
                    judul_lowongan = '$judul',
                    deskripsi = '$deskripsi',
                    kuota = '$kuota'
                WHERE id = '$id' AND id_perusahaan = '$user_id'";

    if (mysqli_query($koneksi, $sql)) {
      return ['status' => true];
    } else {
      return ['status' => false, 'msg' => 'Gagal mengupdate lowongan'];
    }
  }

  // ================= DELETE LOWONGAN =================
  public static function delete($id, $user_id)
  {
    global $koneksi;

    $id = (int)$id;
    $user_id = (int)$user_id;

    $sql = "DELETE FROM lowongan_magang 
                WHERE id = '$id' AND id_perusahaan = '$user_id'";

    if (mysqli_query($koneksi, $sql)) {
      return ['status' => true];
    } else {
      return ['status' => false, 'msg' => 'Gagal menghapus lowongan'];
    }
  }
}
