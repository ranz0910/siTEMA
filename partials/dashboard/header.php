<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SITEMA</title>
  <link rel="shortcut icon" type="image/png" href="<?php echo BASE_URL; ?>src/images/logos/favicon.png" />
  <script>
    (function() {
      const savedTheme = localStorage.getItem('theme') || 'light';
      document.documentElement.setAttribute('data-bs-theme', savedTheme);
    })();
  </script>
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>src/css/styles.min.css" />
  <style>
    html, body {
      transition: background-color 0.2s ease, color 0.2s ease;
    }
    
    [data-bs-theme="dark"] {
      background-color: #121212 !important;
    }

    /* Standar warna Mode Gelap */
    [data-bs-theme="dark"] {
      background-color: #121212 !important;
      color: #e9ecef !important; /* Warna teks utama yang lembut di mata */
    }

    /* Memastikan teks pada kartu (card) terbaca jelas */
    [data-bs-theme="dark"] .card {
      background-color: #1e1e1e !important;
      border-color: #333333 !important;
      color: #ffffff !important;
    }

    [data-bs-theme="dark"] .card-title, 
    [data-bs-theme="dark"] .card-heading,
    [data-bs-theme="dark"] h1, 
    [data-bs-theme="dark"] h2, 
    [data-bs-theme="dark"] h3, 
    [data-bs-theme="dark"] h4, 
    [data-bs-theme="dark"] h5, 
    [data-bs-theme="dark"] h6 {
      color: #ffffff !important; /* Judul berwarna putih terang */
    }

    /* Perbaikan teks pada Form Input agar tidak gelap di atas gelap */
    [data-bs-theme="dark"] .form-control, 
    [data-bs-theme="dark"] .form-select {
      background-color: #2b2b2b !important;
      border-color: #444444 !important;
      color: #ffffff !important;
    }

    [data-bs-theme="dark"] .form-label {
      color: #d1d1d1 !important;
    }

    /* Perbaikan pada Tabel */
    [data-bs-theme="dark"] .table {
      color: #e9ecef !important;
    }

    [data-bs-theme="dark"] .table thead th {
      background-color: #252525 !important;
      color: #ffffff !important;
      border-bottom: 2px solid #444;
    }

    /* Perbaikan Sidebar & Header */
    [data-bs-theme="dark"] .left-sidebar,
    [data-bs-theme="dark"] .app-header {
      background-color: #1c1c1c !important;
      border-right: 1px solid #333 !important;
      border-bottom: 1px solid #333 !important;
    }

    [data-bs-theme="dark"] .sidebar-link {
      color: #d1d1d1 !important;
    }

    [data-bs-theme="dark"] .sidebar-link:hover {
      background-color: #252525 !important;
      color: #5d87ff !important; /* Warna aksen biru saat hover */
    }
  </style>
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
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="<?php echo BASE_URL; ?>src/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
              <div class="message-body">
                <a href="?page=pengaturan" class="d-flex align-items-center gap-2 dropdown-item">
                  <i class="ti ti-settings fs-6"></i>
                  <p class="mb-0 fs-3">Pengaturan</p>
                </a>

                <?php 
                $role = isset($_SESSION['role']) ? $_SESSION['role'] : ''; 
                $id_p = isset($_SESSION['id_profil']) ? $_SESSION['id_profil'] : '';

                if ($role == 'mahasiswa'): ?>
                  <a href="?page=profile_mahasiswa&id=<?= $id_p ?>" class="d-flex align-items-center gap-2 dropdown-item">
                    <i class="ti ti-id-badge fs-6"></i>
                    <p class="mb-0 fs-3">Profile Mahasiswa</p>
                  </a>
                <?php elseif ($role == 'perusahaan'): ?>
                  <a href="?page=profile_perusahaan&id=<?= $id_p ?>" class="d-flex align-items-center gap-2 dropdown-item">
                    <i class="ti ti-building fs-6"></i>
                    <p class="mb-0 fs-3">Profile Perusahaan</p>
                  </a>
                <?php elseif ($role == 'jurusan'): ?>
                  <a href="?page=profile_jurusan&id=<?= $id_p ?>" class="d-flex align-items-center gap-2 dropdown-item">
                    <i class="ti ti-school fs-6"></i>
                    <p class="mb-0 fs-3">Profile Jurusan</p>
                  </a>
                <?php endif; ?>

                <a href="<?php echo BASE_URL; ?>process/login/ProsesLogout.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
              </div>
            </div>
          </div>
        </nav>
      </header>
      <!--  Header End -->