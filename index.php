<?php
  include 'init.php';
  include 'service/auth.php';
?>

<?php
  include 'partials/header.php';
?>

<script src="src/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <script>
      function changeTheme(theme) {
        document.documentElement.setAttribute('data-bs-theme', theme);
        localStorage.setItem('theme', theme);
      }

      function loadTheme() {
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-bs-theme', savedTheme);
      }

      loadTheme();
    </script>

<div class="container-fluid">
     <?php 
        $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
    
        switch ($page) {
          // Perusahaan
          case 'data_perusahaan':
            include 'layout/read/data_perusahaan.php';
            break;
          case 'form_tambah_perusahaan':
            include 'layout/create/form_tambah_perusahaan.php'; 
            break;
          case 'form_edit_perusahaan':
              include 'layout/edit/form_edit_perusahaan.php';
              break;

          // Jurusan
          case 'data_jurusan':
              include 'layout/read/data_jurusan.php';
              break;
          case 'form_edit_jurusan':
              include 'layout/edit/form_edit_jurusan.php';
              break;
          case 'form_tambah_jurusan':
            include 'layout/create/form_tambah_jurusan.php'; 
            break;                    
          case 'profile_jurusan':
              include 'layout/profile/profile_jurusan.php';
              break;
          case 'edit_profile_jurusan':
              include 'layout/profile/edit_profile_jurusan.php';
              break;

          // Prodi
          case 'data_prodi':
              include 'layout/read/data_prodi.php';
              break;
          case 'form_tambah_prodi':
            include 'layout/create/form_tambah_prodi.php';
            break;
          case 'form_edit_prodi':
              include 'layout/edit/form_edit_prodi.php';  
              break;

          // Mahasiswa
          case 'data_mahasiswa':
            include 'layout/read/data_mahasiswa.php';
            break;
          case 'form_tambah_mahasiswa':
            include 'layout/create/form_tambah_mahasiswa.php'; 
            break;
          case 'form_edit_mahasiswa':
              include 'layout/edit/form_edit_mahasiswa.php';
              break;
          case 'profile_mahasiswa':
              include 'layout/profile/profile_mahasiswa.php';
              break;
          case 'edit_profile_mahasiswa':
              include 'layout/profile/edit_profile_mahasiswa.php';
              break;

          // Magang
          case 'pengajuan_magang':
              include 'layout/create/pengajuan_magang.php';
              break;
          case 'lowongan_magang': 
            include 'layout/tampilan/lowongan_magang.php';
            break;   
            
          // Lainnya
          case 'pengaturan':
              include 'layout/profile/pengaturan.php';
              break;
          case 'dashboard':
            default:
            include 'layout/tampilan/dashboard.php';
            break;
        }
    ?>
</div>

<?php 
  include 'partials/footer.php';
?>