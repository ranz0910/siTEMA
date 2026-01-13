<?php

// Role id dari session, diambil dari id_user
$role_id = $_SESSION['role_id'] ?? 0;
?>

<aside class="left-sidebar">
  <div>

    <!-- LOGO -->
    <div class="brand-logo d-flex align-items-center justify-content-between">
      <a href="<?php echo BASE_URL; ?>index.php" class="text-nowrap logo-img">
        <img src="<?php echo BASE_URL; ?>src/images/logos/dark-logo.svg" width="180" alt="Logo" />
      </a>
      <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
        <i class="ti ti-x fs-8"></i>
      </div>
    </div>

    <!-- SIDEBAR -->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
      <ul id="sidebarnav">

        <!-- ================= HOME ================= -->
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Home</span>
        </li>

        <li class="sidebar-item <?php echo (!isset($_GET['page']) || $_GET['page'] == 'dashboard') ? 'nav-active' : ''; ?>">
          <a class="sidebar-link" href="<?php echo BASE_URL; ?>index.php">
            <span><i class="ti ti-layout-dashboard"></i></span>
            <span class="hide-menu">Dashboard</span>
          </a>  
        </li>

        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Data</span>
        </li>
        <!-- ================= PERUSAHAAN (3) ================= -->
        <?php if ($role_id == 3): ?>
          <li class="sidebar-item">
            <a class="sidebar-link" href="index.php?page=lowongan_magang">
              <span><i class="ti ti-briefcase"></i></span>
              <span class="hide-menu">Lowongan Magang</span>
            </a>
          </li>
        <?php endif; ?>

        <!-- ================= ACCOUNT DATA ================= -->


        <!-- UNIT KERJASAMA (1) -->
        <?php if ($role_id == 1): ?>
          <li class="sidebar-item">
            <a class="sidebar-link" href="<?php echo BASE_URL; ?>layout/read/data_jurusan.php">
              <span><i class="ti ti-building-skyscraper"></i></span>
              <span class="hide-menu">Jurusan</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="index.php?page=table_jurusan">
              <span><i class="ti ti-building-community"></i></span>
              <span class="hide-menu">Perusahaan</span>
            </a>
          </li>
        <?php endif; ?>

        <!-- JURUSAN (2) -->
        <?php if ($role_id == 2): ?>         
          <li class="sidebar-item">
            <a class="sidebar-link" href="index.php?page=data_prodi">
              <span><i class="ti ti-building-skyscraper"></i></span>
              <span class="hide-menu">Data Prodi</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="index.php?page=table_mahasiswa">
              <span><i class="ti ti-school"></i></span>
              <span class="hide-menu">Mahasiswa</span>
            </a>
          </li>
        <?php endif; ?>



      </ul>
    </nav>
  </div>
</aside>