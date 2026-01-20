<?php
// 1. Samakan nama variabel session dengan yang ada di ProsesLogin.php
// Kita gunakan id_roles sesuai standar yang kita buat sebelumnya
$role_id = isset($_SESSION['id_roles']) ? $_SESSION['id_roles'] : 0;
?>

<aside class="left-sidebar">
  <div>
    <div class="brand-logo d-flex align-items-center justify-content-between">
      <a href="<?php echo BASE_URL; ?>index.php" class="text-nowrap logo-img">
        <img src="<?php echo BASE_URL; ?>src/images/logos/sitema.png" width="135" alt="Logo" />
      </a>
      <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
        <i class="ti ti-x fs-8"></i>
      </div>
    </div>

    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
      <ul id="sidebarnav">

        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Home</span>
        </li>

        <li class="sidebar-item">
          <a class="sidebar-link" href="<?php echo BASE_URL; ?>index.php">
            <span><i class="ti ti-layout-dashboard"></i></span>
            <span class="hide-menu">Dashboard</span>
          </a>
        </li>

        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Main Menu</span>
        </li>

        <?php if ($role_id == 1) : ?>  
          <li class="sidebar-item">
            <a class="sidebar-link" href="<?php echo BASE_URL; ?>layout/read/data_jurusan.php">
              <span><i class="ti ti-building-skyscraper"></i></span><span class="hide-menu">Jurusan</span>
            </a>
          </li>       
          <li class="sidebar-item">
            <a class="sidebar-link" href="<?php echo BASE_URL; ?>layout/read/data_perusahaan.php">
              <span><i class="ti ti-building"></i></span><span class="hide-menu">Perusahaan</span>
            </a>
          </li>
           <li class="sidebar-item">
            <a class="sidebar-link" href="<?php echo BASE_URL; ?>layout/tampilan/pengajuan_magang.php">
              <span><i class="ti ti-file-description"></i></span><span class="hide-menu">Pengajuan Magang</span>
            </a>
          </li>         
        <?php endif; ?>

        <?php if ($role_id == 2) : ?>
          <li class="sidebar-item">
            <a class="sidebar-link" href="<?php echo BASE_URL; ?>/layout/read/data_prodi.php">
              <span><i class="ti ti-book"></i></span><span class="hide-menu">Data Prodi</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="<?php echo BASE_URL; ?>/layout/read/data_mahasiswa.php">
              <span><i class="ti ti-school"></i></span><span class="hide-menu">Data Mahasiswa</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="<?php echo BASE_URL; ?>layout/tampilan/pengajuan_magang.php">
              <span><i class="ti ti-file-description"></i></span><span class="hide-menu">Pengajuan Magang</span>
            </a>
          </li>
        <?php endif; ?>

        <?php if ($role_id == 3) : ?>
          <li class="sidebar-item">
            <a class="sidebar-link" href="<?php echo BASE_URL; ?>layout/read/data_lowongan_magang.php">
              <span><i class="ti ti-briefcase"></i></span><span class="hide-menu">Data Lowongan Magang</span>
            </a>
          </li>
        <?php endif; ?>

        <?php if ($role_id == 4) : ?>
          <li class="sidebar-item">
            <a class="sidebar-link" href="<?php echo BASE_URL; ?>layout/tampilan/lowongan_magang.php">
              <span><i class="ti ti-briefcase"></i></span><span class="hide-menu">Lowongan Magang</span>
            </a>
          </li>

          <li class="sidebar-item">
            <a class="sidebar-link" href="<?php echo BASE_URL; ?>layout/tampilan/pengajuan_magang.php">
              <span><i class="ti ti-file-description"></i></span><span class="hide-menu">Pengajuan Magang</span>
            </a>
          </li>   
        <?php endif; ?>

      </ul>
    </nav>
  </div>
</aside>