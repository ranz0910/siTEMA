<?php
include '../../init.php';
include '../../service/auth.php';

global $koneksi;

// Cek Role (Admin atau Jurusan)
$role_id = $_SESSION['id_roles'] ?? null;
if ($role_id != 1 && $role_id != 2) {
    exit("Akses Ditolak");
}

// Header agar browser mendownload file Excel
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Rekap_Per_Prodi_dan_Perusahaan.xls");

/**
 * QUERY REKAP (AGGREGATION):
 * 1. Kita mengelompokkan data berdasarkan Nama Prodi dan Nama Perusahaan.
 * 2. COUNT(p.id) digunakan untuk menghitung jumlah mahasiswa dalam kelompok tersebut.
 */
$query = "SELECT 
            pr.nama_prodi,
            COALESCE(p.nama_perusahaan, pt.nama_perusahaan) AS perusahaan_final,
            COUNT(p.id) AS jumlah_mahasiswa
          FROM pengajuan_magang p
          JOIN mahasiswa m ON p.id_mahasiswa = m.id
          JOIN prodi pr ON m.id_prodi = pr.id
          LEFT JOIN lowongan_magang l ON p.id_lowongan_magang = l.id
          LEFT JOIN perusahaan pt ON l.id_perusahaan = pt.id
          GROUP BY pr.nama_prodi, perusahaan_final
          ORDER BY pr.nama_prodi ASC, jumlah_mahasiswa DESC";

$sql = mysqli_query($koneksi, $query);

if (!$sql) {
    die("Kesalahan Query: " . mysqli_error($koneksi));
}
?>

<table border="1">
    <thead>
        <tr>
            <th colspan="4" style="background-color: #4CAF50; color: white; height: 35px; font-size: 14pt;">
                REKAPITULASI PENEMPATAN MAGANG MAHASISWA
            </th>
        </tr>
        <tr style="background-color: #f2f2f2; font-weight: bold;">
            <th width="50">No</th>
            <th width="250">Program Studi</th>
            <th width="300">Nama Perusahaan / Instansi</th>
            <th width="150">Jumlah Mahasiswa</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $no = 1;
        $total_semua = 0;
        while($row = mysqli_fetch_array($sql)): 
            $total_semua += $row['jumlah_mahasiswa'];
        ?>
        <tr>
            <td align="center"><?= $no++; ?></td>
            <td><?= htmlspecialchars($row['nama_prodi']); ?></td>
            <td><?= htmlspecialchars($row['perusahaan_final']); ?></td>
            <td align="center"><?= $row['jumlah_mahasiswa']; ?> Orang</td>
        </tr>
        <?php endwhile; ?>
    </tbody>
    <tfoot>
        <tr style="background-color: #f2f2f2; font-weight: bold;">
            <td colspan="3" align="right">TOTAL KESELURUHAN MAHASISWA : </td>
            <td align="center"><?= $total_semua; ?> Orang</td>
        </tr>
    </tfoot>
</table>