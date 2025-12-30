<!-- Sidebar Start -->
<aside class="left-sidebar">
  <!-- Sidebar scroll-->
  <div>
    <div class="brand-logo d-flex align-items-center justify-content-between">
      <a href="<?php echo BASE_URL; ?>index.php" class="text-nowrap logo-img">
        <img src="<?php echo BASE_URL; ?>src/images/logos/dark-logo.svg" width="180" alt="" />
      </a>
      <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
        <i class="ti ti-x fs-8"></i>
      </div>
    </div>
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
      <ul id="sidebarnav">
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Home</span>
        </li>

        <li class="sidebar-item <?php echo (!isset($_GET['page']) || $_GET['page'] == 'dashboard') ? 'nav-active' : ''; ?>">
            <a class="sidebar-link" href="<?php echo BASE_URL; ?>index.php" aria-expanded="false">
                <span><i class="ti ti-layout-dashboard"></i></span>
                <span class="hide-menu">Dashboard</span>
            </a>
        </li>

        <?php 
        $role = isset($_SESSION['role']) ? $_SESSION['role'] : ''; 
        if ($role == 'unit_kerjasama' || $role == 'jurusan' || $role == 'mahasiswa'): ?>
        <li class="sidebar-item">
            <a class="sidebar-link" href="index.php?page=pengajuan_magang" aria-expanded="false">
                <span><i class="ti ti-file-description"></i></span>
                <span class="hide-menu">Pengajuan Magang</span>
            </a>
        </li>
        <?php endif; ?>

        <?php if ($role == 'perusahaan'): ?>
        <li class="sidebar-item">
            <a class="sidebar-link" href="index.php?page=lowongan_magang" aria-expanded="false">
                <span><i class="ti ti-briefcase"></i></span>
                <span class="hide-menu">Lowongan Magang</span>
            </a>
        </li>
        <?php endif; ?>


        <?php if ($role == 'unit_kerjasama' || $role == 'jurusan'): ?>
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Account Data</span>
        </li>

        <li class="sidebar-item">
            <a class="sidebar-link" href="index.php?page=table_perusahaan" aria-expanded="false">
                <span><i class="ti ti-building-community"></i></span>
                <span class="hide-menu">Perusahaan</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a class="sidebar-link" href="index.php?page=table_jurusan" aria-expanded="false">
                <span><i class="ti ti-building-skyscraper"></i></span>
                <span class="hide-menu">Jurusan</span>
            </a>
        </li>
        
        <?php if ($role == 'jurusan'): ?>
        <li class="sidebar-item">
            <a class="sidebar-link" href="index.php?page=table_mahasiswa" aria-expanded="false">
                <span><i class="ti ti-school"></i></span>
                <span class="hide-menu">Mahasiswa</span>
            </a>
        </li>
        <?php endif; ?>

        <?php endif; ?>
      </ul>

      
      
    </nav>
    <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->

