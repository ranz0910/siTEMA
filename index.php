<?php
  include 'init.php';
  include 'service/auth.php';
?>

<?php
  include 'partials/dashboard/header.php';
?>

<div class="container-fluid">
     <?php 
        $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
    
        switch ($page) {
          case 'table_perusahaan':
            include 'layout/table/table_perusahaan.php';
            break;
            
          case 'table_jurusan':
            include 'layout/table/table_jurusan.php';
            break;

          case 'table_mahasiswa':
            include 'layout/table/table_mahasiswa.php';
            break;
            
          case 'form_tambah_jurusan':
            include 'layout/form/form_tambah_jurusan.php'; 
            break;

          case 'form_tambah_perusahaan':
            include 'layout/form/form_tambah_perusahaan.php'; 
            break;

          case 'form_tambah_mahasiswa':
            include 'layout/form/form_tambah_mahasiswa.php'; 
            break;

          case 'form_tambah_prodi':
            include 'layout/form/form_tambah_prodi.php';
            break;

          case 'pengajuan_magang':
              include 'layout/form/pengajuan_magang.php';
              break;
          
          case 'profile_mahasiswa':
              include 'layout/profile/profile_mahasiswa.php';
              break;

          case 'profile_jurusan':
              include 'layout/profile/profile_jurusan.php';
              break;
              
          case 'lowongan_magang': 
            include 'layout/lowongan_magang.php';
            break;

          case 'data_prodi':
              include 'layout/tampilan/data_prodi.php';
              break;

          case 'dashboard':
            default:
            include 'layout/tampilan/dashboard.php';
            break;
        }
    ?>
</div>

<?php 
  include 'partials/dashboard/footer.php';
?>