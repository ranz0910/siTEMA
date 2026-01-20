<?php
class Prodi
{
    /* ================= GET ALL ================= */
    public static function getAll()
    {
        global $koneksi;

        $sql = "
            SELECT 
                p.*,
                j.nama_jurusan
            FROM prodi p
            JOIN jurusan j ON p.id_jurusan = j.id
            ORDER BY p.nama_prodi ASC
        ";

        return mysqli_query($koneksi, $sql);
    }

    /* ================= GET ALL BY JURUSAN ================= */
    public static function getAllByJurusan($id_jurusan)
    {
        global $koneksi;

        $id_jurusan = mysqli_real_escape_string($koneksi, $id_jurusan);

        $sql = "
            SELECT 
                p.*,
                j.nama_jurusan
            FROM prodi p
            JOIN jurusan j ON p.id_jurusan = j.id
            WHERE p.id_jurusan = '$id_jurusan'
            ORDER BY p.nama_prodi ASC
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
                j.nama_jurusan
            FROM prodi p
            JOIN jurusan j ON p.id_jurusan = j.id
            WHERE p.id = '$id'
        ";

        $result = mysqli_query($koneksi, $sql);
        return mysqli_fetch_assoc($result);
    }

    /* ================= CREATE ================= */
    public static function create($data)
    {
        global $koneksi;

        $id_jurusan = mysqli_real_escape_string($koneksi, $data['id_jurusan']);
        $kode_prodi = mysqli_real_escape_string($koneksi, $data['kode_prodi']);
        $nama_prodi = mysqli_real_escape_string($koneksi, $data['nama_prodi']);
        $jenjang    = mysqli_real_escape_string($koneksi, $data['jenjang']);

        // Cek duplikat prodi dalam jurusan
        $cek = $koneksi->query("
            SELECT id FROM prodi 
            WHERE id_jurusan = '$id_jurusan' 
            AND (kode_prodi = '$kode_prodi' OR nama_prodi = '$nama_prodi')
        ");

        if ($cek->num_rows > 0) {
            return ['status' => false, 'msg' => 'Kode atau nama prodi sudah terdaftar di jurusan ini'];
        }

        $query = "
            INSERT INTO prodi (id_jurusan, kode_prodi, nama_prodi, jenjang)
            VALUES ('$id_jurusan', '$kode_prodi', '$nama_prodi', '$jenjang')
        ";

        if (mysqli_query($koneksi, $query)) {
            return ['status' => true, 'msg' => 'Prodi berhasil ditambahkan'];
        } else {
            return ['status' => false, 'msg' => 'Gagal menambahkan prodi: ' . mysqli_error($koneksi)];
        }
    }

    /* ================= UPDATE ================= */
    public static function update($data)
    {
        global $koneksi;

        $id_prodi   = mysqli_real_escape_string($koneksi, $data['id_prodi']);
        $id_jurusan = mysqli_real_escape_string($koneksi, $data['id_jurusan']);
        $kode_prodi = mysqli_real_escape_string($koneksi, $data['kode_prodi']);
        $nama_prodi = mysqli_real_escape_string($koneksi, $data['nama_prodi']);
        $jenjang    = mysqli_real_escape_string($koneksi, $data['jenjang']);

        // Pastikan prodi milik jurusan
        $cek = $koneksi->query("
            SELECT id FROM prodi 
            WHERE id = '$id_prodi' AND id_jurusan = '$id_jurusan'
        ");

        if ($cek->num_rows == 0) {
            return ['status' => false, 'msg' => 'Data prodi tidak ditemukan atau bukan milik jurusan Anda'];
        }

        $query = "
            UPDATE prodi SET
                kode_prodi = '$kode_prodi',
                nama_prodi = '$nama_prodi',
                jenjang    = '$jenjang'
            WHERE id = '$id_prodi'
        ";

        if (mysqli_query($koneksi, $query)) {
            return ['status' => true, 'msg' => 'Prodi berhasil diperbarui'];
        } else {
            return ['status' => false, 'msg' => 'Gagal memperbarui prodi: ' . mysqli_error($koneksi)];
        }
    }

    /* ================= DELETE ================= */
    public static function delete($id_prodi, $id_jurusan)
    {
        global $koneksi;

        $id_prodi   = mysqli_real_escape_string($koneksi, $id_prodi);
        $id_jurusan = mysqli_real_escape_string($koneksi, $id_jurusan);

        // Pastikan prodi milik jurusan
        $cek = $koneksi->query("
            SELECT id FROM prodi 
            WHERE id = '$id_prodi' AND id_jurusan = '$id_jurusan'
        ");

        if ($cek->num_rows == 0) {
            return ['status' => false, 'msg' => 'Data prodi tidak ditemukan atau bukan milik jurusan Anda'];
        }

        if (mysqli_query($koneksi, "DELETE FROM prodi WHERE id = '$id_prodi'")) {
            return ['status' => true, 'msg' => 'Prodi berhasil dihapus'];
        } else {
            return ['status' => false, 'msg' => 'Gagal menghapus prodi: ' . mysqli_error($koneksi)];
        }
    }
}
