<?php 
  include 'config/connection.php';
  include 'config/global_vars.php';
  date_default_timezone_set('Asia/Jakarta');

  if (isset($_POST['submit'])) {
    $e = $_POST['email'];
    $p = encrypt_decrypt('encrypt', $_POST['password']);
    
    $cek_login = mysqli_query($conn, "SELECT * FROM users WHERE BINARY email='$e' AND password='$p'");
    $data = mysqli_fetch_array($cek_login);
    $hitung = mysqli_num_rows($cek_login);

    if ($hitung > 0 && $data) {
      $token_gen = encrypt_decrypt('encrypt', $data['id']);
      setcookie('user_sidarsip', $token_gen, time() + (86400 * 30), "/");
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>Login - SIDARSIP</title>
    <link rel="apple-touch-icon" sizes="57x57" href="./dist/assets/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="./dist/assets/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="./dist/assets/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="./dist/assets/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="./dist/assets/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="./dist/assets/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="./dist/assets/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="./dist/assets/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="./dist/assets/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="./dist/assets/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./dist/assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="./dist/assets/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./dist/assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="./dist/assets/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Main styles for this application-->
    <link href="./dist/css/style.css" rel="stylesheet">
  </head>
  <body class="c-app flex-row align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card-group">
            <div class="card p-4">
              <div class="card-body" style="height: 300px;">
                <h1>Login</h1>
                <form action="login.php" method="post" enctype="multipart/form-data">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend"><span class="input-group-text">
                        <svg class="c-icon">
                          <use xlink:href="./coreui/icons/sprites/free.svg#cil-user"></use>
                        </svg></span></div>
                    <input class="form-control" type="email" placeholder="Email" name="email" required>
                  </div>
                  <div class="input-group mb-4">
                    <div class="input-group-prepend"><span class="input-group-text">
                        <svg class="c-icon">
                          <use xlink:href="./coreui/icons/sprites/free.svg#cil-lock-locked"></use>
                        </svg></span></div>
                    <input class="form-control" type="password" placeholder="Password" name="password" required>
                  </div>
                  <div class="row">
                    <div class="col-md-12 col-xs-12">
                    <input type="submit" name="submit" class="btn btn-primary btn-block" value="Login">
                    </div>
                  </div>
                </form>
                <!-- <?= encrypt_decrypt('decrypt', 'eHRaZDdHV0l0bkFuelZXeXd1T0drUT09') ?> -->
                <!-- <?= encrypt_decrypt('encrypt', '12345') ?> -->
                <div class="row mt-4">
                  <div class="col-md-12">
                    <?php 
                      if (isset($_POST['submit'])) {
                        $e = $_POST['email'];
                        $p = encrypt_decrypt('encrypt', $_POST['password']);

                        $cek_login = mysqli_query($conn, "SELECT * FROM users WHERE BINARY email='$e' AND password='$p'");
                        $data = mysqli_fetch_array($cek_login);
                        $hitung = mysqli_num_rows($cek_login);

                        if ($hitung > 0) {
                          echo  '<div class="alert alert-success alert-dismissible fade show" role="alert">Login Berhasil'.
                                  '<button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.
                                '</div>';
                          echo "<meta http-equiv='refresh' content='1;
                          url=index.php?page=beranda'>";
                        } else {
                          echo  '<div class="alert alert-danger alert-dismissible fade show" role="alert">Login Gagal'.
                                  '<button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.
                                '</div>';
                        }
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="card text-white bg-primary py-5 d-md-down-none">
              <div class="card-body text-center">
                <div>
                  <img src="./dist/assets/img/sidarsip.jpeg" alt="logo-sidarsip" width="300px">
                  <p>Sistem Informasi Dokumen dan Arsip terpadu Kementerian Agama Republik Indonesia</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="./coreui/coreui/dist/js/coreui.bundle.min.js"></script>
    <script src="./coreui/icons/js/svgxuse.min.js"></script>
  </body>
</html>