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
    /* CSS Kustom untuk Memastikan Mode Gelap Terlihat Sempurna */
    html, body { transition: background-color 0.2s ease, color 0.2s ease; }
    [data-bs-theme="dark"] { background-color: #121212 !important; color: #e9ecef !important; }
    [data-bs-theme="dark"] .card { background-color: #1e1e1e !important; border-color: #333333 !important; color: #ffffff !important; }
    [data-bs-theme="dark"] .card-title, [data-bs-theme="dark"] h1, [data-bs-theme="dark"] h2, 
    [data-bs-theme="dark"] h3, [data-bs-theme="dark"] h4, [data-bs-theme="dark"] h5, [data-bs-theme="dark"] h6 
    { color: #ffffff !important; }
    [data-bs-theme="dark"] .form-control, [data-bs-theme="dark"] .form-select { background-color: #2b2b2b !important; border-color: #444444 !important; color: #ffffff !important; }
    [data-bs-theme="dark"] .table { color: #e9ecef !important; }
    [data-bs-theme="dark"] .left-sidebar, [data-bs-theme="dark"] .app-header { background-color: #1c1c1c !important; border-color: #333 !important; }
  </style>
</head>

<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    
    <?php include 'sidebar.php'; ?>

    <div class="body-wrapper">
      
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
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item dropdown">
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
                    // 1. Ambil data mentah dari session
                    $role_id = isset($_SESSION['id_roles']) ? $_SESSION['id_roles'] : ''; 
                    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

                    // 2. Jika role adalah Jurusan (ID 2), cari ID jurusan asli dari database
                    $id_profil_jurusan = "";
                    if ($role_id == 2) {
                        $query_j = mysqli_query($connect, "SELECT id FROM jurusan WHERE id_user = '$user_id'");
                        $data_j = mysqli_fetch_assoc($query_j);
                        $id_profil_jurusan = $data_j ? $data_j['id'] : "";
                    }
                    ?>

                    <a href="<?php echo BASE_URL; ?>process/login/ProsesLogout.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>