<?php include '../../init.php'; ?>
<?php include '../../service/guest.php'; ?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modernize Free</title>
  <link rel="shortcut icon" type="image/png" href="<?php echo BASE_URL; ?>src/images/logos/favicon.png" />
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>src/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="<?php echo BASE_URL; ?>index.php" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="<?php echo BASE_URL; ?>src/images/logos/dark-logo.svg" width="180" alt="">
                </a>
                <p class="text-center">Your Social Campaigns</p>
                <form action="<?php echo BASE_URL; ?>process/login/ProsesLogin.php" method="POST">
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username/Email</label>
                    <input type="text" class="form-control" name="identity">
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign In</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="<?php echo BASE_URL; ?>src/libs/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo BASE_URL; ?>src/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

  <?php 
  include 'partials/dashboard/footer.php';
  ?>