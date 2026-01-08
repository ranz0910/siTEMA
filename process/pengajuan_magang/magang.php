<?php
require '../../service/connection.php';

if (isset($_POST['submit_pengajuan'])) {

    // Karena tidak login, id_user = 0
    $id_user = 0;

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

    // Cek duplikat berdasarkan NIK + perusahaan
    $cek_duplikat = $connect->prepare("
        SELECT id FROM pengajuan_magang
        WHERE nik = ? AND id_perusahaan = ? AND status = 'Pending'
    ");
    $cek_duplikat->bind_param("si", $nik, $id_perusahaan);
    $cek_duplikat->execute();
    $hasil_cek = $cek_duplikat->get_result();

    if ($hasil_cek->num_rows > 0) {
        echo "<script>
                alert('Anda sudah memiliki pengajuan Pending untuk perusahaan ini.');
                window.history.back();
              </script>";
        exit;
    }

    // Insert data
    $stmt = $connect->prepare("
        INSERT INTO pengajuan_magang
        (id_user, nik, nama_mahasiswa, tempat_lahir, tanggal_lahir,
         jekel, agama, alamat, id_perusahaan, keterangan, status)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("isssssssiss",
        $id_user, $nik, $nama_mahasiswa, $tempat_lahir, $tanggal_lahir,
        $jekel, $agama, $alamat, $id_perusahaan, $keterangan, $status
    );

    if ($stmt->execute()) {
        echo "<script>
                alert('Pengajuan magang berhasil dikirim.');
                window.location.href='../../index.php?page=pengajuan_saya';
              </script>";
    } else {
        echo "Gagal menyimpan pengajuan: " . $stmt->error;
    }

    $stmt->close();
    $cek_duplikat->close();
    $connect->close();
}
?>
