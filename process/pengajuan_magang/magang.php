<?php
require '../../service/connection.php';

if (isset($_POST['submit_pengajuan'])) {

    // Ambil id_user dari session (jika login, default 0)
    $id_user = $_SESSION['id_user'] ?? 0;

    // Ambil data dari form
    $nik             = $_POST['nik'];
    $nama_mahasiswa  = $_POST['nama'];
    $tempat_lahir    = $_POST['tempat_lahir'];
    $tanggal_lahir   = $_POST['tanggal_lahir'];
    $jekel           = $_POST['jenis_kelamin'];
    $agama           = $_POST['agama'];
    $alamat          = $_POST['alamat'];
    $id_perusahaan   = $_POST['id_perusahaan'];
    $keterangan      = $_POST['keterangan'];

    $status = 'Pending';

    // Cek duplikat pengajuan untuk user yang sama dan status Pending
    $cek_duplikat = "
        SELECT id FROM pengajuan_magang
        WHERE id_user = '$id_user'
          AND id_perusahaan = '$id_perusahaan'
          AND status = 'Pending'
    ";
    $hasil_cek = $connect->query($cek_duplikat);

    if ($hasil_cek->num_rows > 0) {
        echo "<script>
                alert('Anda sudah memiliki pengajuan magang yang masih Pending.');
                window.history.back();
              </script>";
        exit;
    }

    // Insert ke tabel pengajuan_magang
    $sqlPengajuan = "
        INSERT INTO pengajuan_magang
        (id_user, nik, nama_mahasiswa, tempat_lahir, tanggal_lahir,
         jekel, agama, alamat, id_perusahaan, keterangan, status)
        VALUES
        ('$id_user', '$nik', '$nama_mahasiswa', '$tempat_lahir', '$tanggal_lahir',
         '$jekel', '$agama', '$alamat', '$id_perusahaan', '$keterangan', '$status')
    ";

    $queryPengajuan = $connect->query($sqlPengajuan);

    if ($queryPengajuan) {
        echo "<script>
                alert('Pengajuan magang berhasil dikirim.');
                window.location.href='../../index.php?page=pengajuan_saya';
              </script>";
    } else {
        echo 'Gagal menyimpan pengajuan: ' . $connect->error;
    }

}
?>
