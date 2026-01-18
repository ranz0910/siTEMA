<?php
include 'service/connection.php';

$conn = $connect;
$totalMhs     = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM mahasiswa"))['total'];
$totalMitra   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM perusahaan"))['total'];
$totalPending = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM pengajuan_magang WHERE status='Pending'"))['total'];
$totalSuccess = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM pengajuan_magang WHERE status='Diterima'"))['total'];

$queryTabel = mysqli_query($conn, "SELECT pengajuan_magang.*, mahasiswa.nama_mahasiswa, mahasiswa.prodi 
                                   FROM pengajuan_magang 
                                   JOIN mahasiswa ON pengajuan_magang.id = mahasiswa.id 
                                   ORDER BY pengajuan_magang.created_at DESC LIMIT 5");

$dataChart = [];
for ($i = 1; $i <= 12; $i++) {
    $sql = "SELECT COUNT(*) as total FROM pengajuan_magang WHERE MONTH(created_at) = '$i' AND YEAR(created_at) = YEAR(CURDATE())";
    $res = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    $dataChart[] = (int)$res['total'];
}

$queryTabel = mysqli_query($conn, "SELECT 
    p.nama_mahasiswa, 
    p.status, 
    p.created_at, 
    m.prodi, 
    pr.nama_perusahaan
    FROM pengajuan_magang p
    LEFT JOIN mahasiswa m ON p.id_user = m.id_user 
    LEFT JOIN perusahaan pr ON p.id_perusahaan = pr.id 
    ORDER BY p.created_at DESC LIMIT 5");
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6 col-xl-3">
            <div class="card bg-light-primary shadow-none">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="round rounded bg-primary d-flex align-items-center justify-content-center">
                            <i class="ti ti-users text-white fs-7"></i>
                        </div>
                        <div class="ms-3">
                            <h4 class="mb-0 fw-semibold"><?= number_format($totalMhs) ?></h4>
                            <p class="mb-0">Total Mahasiswa</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card bg-light-warning shadow-none">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="round rounded bg-warning d-flex align-items-center justify-content-center">
                            <i class="ti ti-building text-white fs-7"></i>
                        </div>
                        <div class="ms-3">
                            <h4 class="mb-0 fw-semibold"><?= number_format($totalMitra) ?></h4>
                            <p class="mb-0">Mitra Perusahaan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card bg-light-info shadow-none">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="round rounded bg-info d-flex align-items-center justify-content-center">
                            <i class="ti ti-file-text text-white fs-7"></i>
                        </div>
                        <div class="ms-3">
                            <h4 class="mb-0 fw-semibold"><?= number_format($totalPending) ?></h4>
                            <p class="mb-0">Pengajuan Pending</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card bg-light-success shadow-none">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="round rounded bg-success d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle-check text-white fs-7"></i>
                        </div>
                        <div class="ms-3">
                            <h4 class="mb-0 fw-semibold"><?= number_format($totalSuccess) ?></h4>
                            <p class="mb-0">Diterima Magang</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <h5 class="card-title fw-semibold">Statistik Penempatan Magang <?= date('Y') ?></h5>
                    <div id="chart-penempatan"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Alur Pengajuan</h5>
                    <div class="position-relative">
                        <div class="d-flex align-items-center mb-4">
                            <span class="btn btn-sm btn-light-primary round-20 me-3">1</span>
                            <p class="mb-0 fs-3">Lengkapi Profile Mahasiswa</p>
                        </div>
                        <div class="d-flex align-items-center mb-4">
                            <span class="btn btn-sm btn-light-primary round-20 me-3">2</span>
                            <p class="mb-0 fs-3">Pilih Lowongan Perusahaan</p>
                        </div>
                        <div class="d-flex align-items-center mb-4">
                            <span class="btn btn-sm btn-light-primary round-20 me-3">3</span>
                            <p class="mb-0 fs-3">Kirim Form Pengajuan Magang</p>
                        </div>
                        <div class="d-flex align-items-center mb-4">
                            <span class="btn btn-sm btn-light-warning round-20 me-3">4</span>
                            <p class="mb-0 fs-3">Verifikasi oleh Jurusan</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="btn btn-sm btn-light-success round-20 me-3">5</span>
                            <p class="mb-0 fs-3 fw-bold text-success">Cetak Surat Tugas</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Daftar Pengajuan Terbaru</h5>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">No</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Nama Mahasiswa</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Perusahaan Tujuan</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Status</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Tanggal</h6></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                if (mysqli_num_rows($queryTabel) > 0) {
                                    while($row = mysqli_fetch_assoc($queryTabel)): 
                                        // Tentukan warna badge berdasarkan status di database
                                        $badge = "bg-warning"; // Default Pending
                                        if($row['status'] == 'Diterima') $badge = "bg-success";
                                        if($row['status'] == 'Ditolak') $badge = "bg-danger";
                                ?>
                                    <tr>
                                        <td class="border-bottom-0"><?= $no++ ?></td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1"><?= $row['nama_mahasiswa'] ?></h6>
                                        </td>
                                        <td class="border-bottom-0"><?= $row['nama_perusahaan'] ?? 'Perusahaan Tidak Ditemukan' ?></td>
                                        <td class="border-bottom-0">
                                            <span class="badge <?= $badge ?> rounded-3 fw-semibold"><?= $row['status'] ?></span>
                                        </td>
                                        <td class="border-bottom-0"><?= date('d M Y', strtotime($row['created_at'])) ?></td>
                                    </tr>
                                <?php 
                                    endwhile; 
                                } else {
                                    echo "<tr><td colspan='5' class='text-center'>Tidak ada data pengajuan terbaru.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    var options = {
        series: [{
            name: 'Jumlah Pengajuan',
            data: <?= json_encode($dataChart) ?>
        }],
        chart: {
            type: 'bar',
            height: 350,
            toolbar: { show: false }
        },
        colors: ['#5D87FF'],
        plotOptions: {
            bar: { borderRadius: 4, columnWidth: '45%', distributed: false }
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart-penempatan"), options);
    chart.render();
</script>