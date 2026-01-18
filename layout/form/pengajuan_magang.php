<?php
include $_SERVER['DOCUMENT_ROOT'] . '/siTEMA/service/connection.php';

if (session_status() === PHP_SESSION_NONE) { 
    session_start(); 
}

// PROTEKSI: Jika tidak ada session id_user, tendang ke halaman login
if (!isset($_SESSION['id_user'])) {
    echo "<script>alert('Silahkan login terlebih dahulu!'); window.location='/siTEMA/login.php';</script>";
    exit;
}

$id_user = $_SESSION['id_user'];
$query_mhs = mysqli_query($connect, "SELECT nama_mahasiswa FROM mahasiswa WHERE id_user = '$id_user'");
$data_mhs = mysqli_fetch_assoc($query_mhs);
?>

<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4 text-primary">Form Pengajuan Magang</h5>
            
            <form action="process/pengajuan_magang/magang.php" method="POST">
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nama_mahasiswa" class="form-label fw-bold">Nama Mahasiswa</label>
                        <input type="text" class="form-control" id="nama_mahasiswa" name="nama" 
                            placeholder="Masukkan nama lengkap Anda" required>
                    </div>

                    <div class="col-md-6">
                        <label for="nik" class="form-label fw-bold">NIK (No. Induk Kependudukan)</label>
                        <input type="number" class="form-control" name="nik" 
                            placeholder="Masukkan 16 digit NIK" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="tempat_lahir" class="form-label fw-bold">Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempat_lahir" placeholder="Contoh: Jakarta" required>
                    </div>

                    <div class="col-md-6">
                        <label for="tanggal_lahir" class="form-label fw-bold">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggal_lahir" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Jenis Kelamin</label>
                        <select class="form-select" name="jenis_kelamin" required>
                            <option value="" selected disabled>-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Agama</label>
                        <select class="form-select" name="agama" required>
                            <option value="" selected disabled>-- Pilih Agama --</option>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Khonghucu">Khonghucu</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label fw-bold">Alamat Lengkap (Domisili)</label>
                    <textarea class="form-control" name="alamat" rows="2" placeholder="Tulis alamat domisili saat ini..." required></textarea>
                </div>

                <div class="mb-3">
                    <label for="perusahaan" class="form-label fw-bold">Pilih Perusahaan Tujuan</label>
                    <select class="form-select" name="id_perusahaan" required>
                        <option value="" selected disabled>-- Pilih Perusahaan yang Tersedia --</option>
                        <?php
                        // Ambil data perusahaan secara dinamis dari database
                        $sql_perusahaan = mysqli_query($connect, "SELECT id, nama_perusahaan FROM perusahaan ORDER BY nama_perusahaan ASC");
                        while($row = mysqli_fetch_assoc($sql_perusahaan)) {
                            echo "<option value='".$row['id']."'>".$row['nama_perusahaan']."</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="keterangan" class="form-label fw-bold">Alasan Pengajuan / Skill yang dimiliki</label>
                    <textarea class="form-control" name="keterangan" rows="3" placeholder="Tuliskan alasan singkat mengapa Anda ingin magang di perusahaan tersebut..."></textarea>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" name="submit_pengajuan" class="btn btn-primary px-4">Kirim Pengajuan</button>
                    <button type="reset" class="btn btn-light px-4 border">Reset</button>
                </div>

            </form>
        </div>
    </div>
</div>