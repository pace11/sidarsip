<?php 
  if (isset($_COOKIE['user_sidarsip'])) {
    date_default_timezone_set('Asia/Jakarta');
    include "config/connection.php";
    include "config/global_vars.php";

    if (isset($_GET['page']) && $_GET['page'] === 'logout') {
      setcookie('user_sidarsip', '', time()-(86400 * 30), "/");
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
  <title>Dashboard - SIDARSIP</title>
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
  <meta name="msapplication-TileImage" content="./dist/assets/favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <!-- Main styles for this application-->
  <link href="./dist/css/style.css" rel="stylesheet">
  <link href="./coreui/chartjs/dist/css/coreui-chartjs.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <style>
    .field-icon {
      float: right;
      margin-right: 8px;
      margin-top: -25px;
      position: relative;
      z-index: 2;
      cursor:pointer;
    }
    .action-box {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      gap: 6px;
    }

    /* Buat sidebar menjadi layout kolom fleksibel */
    .c-sidebar {
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      height: 100vh;
      overflow: hidden;
    }

    /* Buat konten utama sidebar (list menu) bisa scroll */
    .c-sidebar-nav {
      flex: 1;
      overflow-y: auto;
      overflow-x: hidden;
    }

    /* Buat bagian bawah tetap fixed di bawah, tapi width-nya sesuai sidebar */
    .c-sidebar-bottom {
      width: 100%;
      padding: 0.75rem 1rem;
      border-top: 1px solid rgba(255,255,255,0.1);
      background-color: rgba(0,0,0,0.25);
      box-sizing: border-box;
    }

    .c-sidebar-bottom a {
      color: #fff;
      display: flex;
      align-items: center;
      text-decoration: none;
    }

    .c-sidebar-bottom a:hover {
      background-color: rgba(255,255,255,0.1);
      border-radius: 0.25rem;
    }
  </style>
</head>

<body class="c-app">
  <?php 

    if (get_user_login('type') == 'superadmin' || get_user_login('type') == 'admin') {
      include "sidebar.php";
    }
    
    include "script.php";
  ?>
  <div class="c-wrapper c-fixed-components">
    <?php 
      include "header.php";
    ?>
    <div class="c-body">
      <?php 
        include "routing.php";
      ?>
      <div class="toast-container position-fixed p-3" style="right: 1rem; top: 1rem; z-index: 9999;">
        <div id="mainToast" class="toast" data-delay="3000">
          <div class="toast-header">
            <strong class="mr-auto" id="toastTitle">Notifikasi</strong>
            <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast">&times;</button>
          </div>
          <div class="toast-body" id="toastBody">Pesan akan muncul di sini.</div>
        </div>
      </div>
      <footer class="c-footer">
        <div><a href="https://coreui.io">CoreUI</a> &copy; <?= date('Y') ?> creativeLabs.</div>
        <div class="ml-auto">Powered by&nbsp;<a href="https://coreui.io/">CoreUI</a></div>
      </footer>
    </div>
  </div>
</body>

</html>
<?php 
  }
  else { ?>
    <div class="col-md-12" align="center">
      <button type="button" name="button" class="btn btn-primary">Login Terlebih dahulu</button>
    </div>

<?php echo"<meta http-equiv='refresh' content='1;url=login.php'>"; } ?>