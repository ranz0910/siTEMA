<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SITEMA</title>
  <link rel="shortcut icon" type="image/png" href="<?php echo BASE_URL; ?>src/images/logos/favicon.png" />
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>src/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    
    <?php
    include 'sidebar.php';
    ?>

    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
          </ul>
          
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="<?php echo BASE_URL; ?>src/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </a>

                    <?php 
                    // Ambil role dari session
                    $role = isset($_SESSION['role']) ? $_SESSION['role'] : ''; 

                    // Kondisi jika yang login adalah MAHASISWA
                    if ($role == 'mahasiswa'): ?>
                      <a href="?page=profile_mahasiswa" class="d-flex align-items-center gap-2 dropdown-item">
                        <i class="ti ti-id fs-6"></i>
                        <p class="mb-0 fs-3">Profile Mahasiswa</p>
                      </a>

                    <?php 
                    // Kondisi jika yang login adalah PERUSAHAAN
                    elseif ($role == 'perusahaan'): ?>
                      <a href="?page=profile_perusahaan" class="d-flex align-items-center gap-2 dropdown-item">
                        <i class="ti ti-building fs-6"></i>
                        <p class="mb-0 fs-3">Profile Perusahaan</p>
                      </a>

                    <?php 
                    // Kondisi jika yang login adalah JURUSAN atau UNIT KERJA
                    elseif ($role == 'jurusan' || $role == 'unit_kerjasama'): ?>
                      <a href="?page=profile_admin" class="d-flex align-items-center gap-2 dropdown-item">
                        <i class="ti ti-user-check fs-6"></i>
                        <p class="mb-0 fs-3">Profile Admin</p>
                      </a>
                    <?php endif; ?>

                    <a href="<?php echo BASE_URL; ?>process/login/ProsesLogout.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
          </div>

          
        </nav>
      </header>
      <!--  Header End -->