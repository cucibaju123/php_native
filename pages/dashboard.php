<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION["logged"])) {
    header("Location: ./auth/login.php");
}
$admin_admin_count = mysqli_query($conn, "select count(1) from admin");
$admin_admin_total = mysqli_fetch_array($admin_admin_count)[0];

$admin_nasabah_count = mysqli_query($conn, "select count(1) from nasabah");
$admin_nasabah_total = mysqli_fetch_array($admin_nasabah_count)[0];

$admin_rekening_count = mysqli_query($conn, "select count(1) from rekening");
$admin_rekening_total = mysqli_fetch_array($admin_rekening_count)[0];

$admin_pembiayaan_count = mysqli_query($conn, "select count(1) from pembiayaan");
$admin_pembiayaan_total = mysqli_fetch_array($admin_pembiayaan_count)[0];

$admin_transaksi_count = mysqli_query($conn, "select count(1) from transaksi");
$admin_transaksi_total = mysqli_fetch_array($admin_transaksi_count)[0];

if (isset($_SESSION["user"])) {
    $user_rekening_count = mysqli_query($conn, "select count(1) from rekening where nasabah_id = {$_SESSION['id']}");
    $user_rekening_total = mysqli_fetch_array($user_rekening_count)[0];

    $user_pembiayaan_count = mysqli_query($conn, "select count(1) from pembiayaan where nasabah_id = {$_SESSION['id']}");
    $user_pembiayaan_total = mysqli_fetch_array($user_pembiayaan_count)[0];

    $user_transaksi_count = mysqli_query($conn, "select count(1) from transaksi where nasabah_id = {$_SESSION['id']}");
    $user_transaksi_total = mysqli_fetch_array($user_transaksi_count)[0];
} else {
    $user_rekening_total = 0;

    $user_pembiayaan_total = 0;

    $user_transaksi_total = 0;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>BMT Ash Shaddiq | Dashboard</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/iconfonts/ionicons/dist/css/ionicons.css">
    <link rel="stylesheet" href="../assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.addons.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/shared/style.css">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../assets/css/demo_1/style.css">
    <!-- End Layout styles -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico" />
    <script src="https://kit.fontawesome.com/9f89dbaa52.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
                <a class="navbar-brand brand-logo" href="./dashboard.php">
                    <img style="height: 37px !important; width: auto;" src="../assets/images/auth/LOGO BMT MINI.png" alt="logo" />
                </a>
                <a class="navbar-brand brand-logo-mini" href="./dashboard.php">
                    <img style="height: 37px !important; width: auto;" src="../assets/images/auth/LOGO BMT MINI.png" alt="logo" />
                </a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
                        <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                            <img class="img-xs rounded-circle" src="../assets/images/faces/face8.jpg" alt="Profile image"> </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle" src="../assets/images/faces/face8.jpg" alt="Profile image">
                                <p class="mb-1 mt-3 font-weight-semibold"><?php echo $_SESSION["nama"]; ?></p>
                                <p class="font-weight-light text-muted mb-0"><?php echo $_SESSION["username"]; ?></p>
                            </div>
                            <a href="../pages/auth/logout.php" class="dropdown-item text-danger">Sign Out</a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item nav-category">Main Menu</li>
                    <li class="nav-item">
                        <a class="nav-link" href="./dashboard.php">
                            <i class="menu-icon typcn typcn-document-text"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <?php if ($_SESSION["role"] === "admin") { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="./admin/adminhome.php">
                                <i class="menu-icon typcn typcn-shopping-bag"></i>
                                <span class="menu-title">Admin</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./admin/nasabahhome.php">
                                <i class="menu-icon typcn typcn-shopping-bag"></i>
                                <span class="menu-title">Nasabah</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./admin/rekeninghome.php">
                                <i class="menu-icon typcn typcn-user-outline"></i>
                                <span class="menu-title">Rekening</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                                <i class="menu-icon typcn typcn-coffee"></i>
                                <span class="menu-title">Mudharabah</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="ui-basic">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link" href="./admin/pengajuanhome.php">Pengajuan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="./admin/pembiayaanhome.php">Pembiayaan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="./admin/transaksihome.php">Transaksi</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    <?php } elseif ($_SESSION["role"] === "user") { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="./user/rekeninghome.php">
                                <i class="menu-icon typcn typcn-th-large-outline"></i>
                                <span class="menu-title">Rekening</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                                <i class="menu-icon typcn typcn-coffee"></i>
                                <span class="menu-title">Mudharabah</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="ui-basic">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link" href="./user/pengajuanhome.php">Pengajuan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="./user/pembiayaanhome.php">Pembiayaan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="./user/transaksihome.php">Transaksi</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="./manager/pengajuanhome.php">
                                <i class="menu-icon typcn typcn-user-outline"></i>
                                <span class="menu-title">Pengajuan</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./manager/pembiayaanhome.php">
                                <i class="menu-icon typcn typcn-user-outline"></i>
                                <span class="menu-title">Pembiayaan</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./manager/transaksihome.php">
                                <i class="menu-icon typcn typcn-user-outline"></i>
                                <span class="menu-title">Transaksi</span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <!-- Page Title Header Starts-->
                    <div class="row page-title-header">
                        <div class="col-12">
                            <div class="page-header">
                                <?php include "./inc/messageslogged.php" ?>
                                <h3 class="page-title">Welcome, <?php echo $_SESSION['nama']; ?></h3>
                            </div>
                        </div>
                    </div>
                    <!-- Page Title Header Ends-->
                    <?php if (isset($_SESSION["admin"])) { ?>
                        <div class="row">
                            <div class="col-md-4 grid-margin">
                                <a class="card-link" href="./admin/adminhome.php">
                                    <div class="card dashboard">
                                        <div class="card-body row align-items-center">
                                            <div class="col-4 pr-4 text-right"><i class="fas fa-user-cog fa-3x"></i></div>
                                            <div class="col-8">
                                                <h2 class="display-3"><?php echo $admin_admin_total ?></h2>
                                                <h6 class="display-5 font-weight-semibold">Admin</h6>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4 grid-margin">
                                <a class="card-link" href="./admin/nasabahhome.php">
                                    <div class="card dashboard">
                                        <div class="card-body row align-items-center">
                                            <div class="col-4 pr-4 text-right"><i class="fas fa-user fa-3x"></i></div>
                                            <div class="col-8">
                                                <h2 class="display-3"><?php echo $admin_nasabah_total ?></h2>
                                                <h6 class="display-5 font-weight-semibold">Nasabah</h6>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4 grid-margin">
                                <a class="card-link" href="./admin/rekeninghome.php">
                                    <div class="card dashboard">
                                        <div class="card-body row align-items-center">
                                            <div class="col-4 pr-4 text-right"><i class="fas fa-file-invoice fa-3x"></i></div>
                                            <div class="col-8">
                                                <h2 class="display-3"><?php echo $admin_rekening_total ?></h2>
                                                <h6 class="display-5 font-weight-semibold">Rekening</h6>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 grid-margin">
                                <a class="card-link" href="./admin/pembiayaanhome.php">
                                    <div class="card dashboard">
                                        <div class="card-body row align-items-center">
                                            <div class="col-4 pr-4 text-right"><i class="fas fa-money-check fa-3x"></i></div>
                                            <div class="col-8">
                                                <h2 class="display-3"><?php echo $admin_pembiayaan_total ?></h2>
                                                <h6 class="display-5 font-weight-semibold">Pembiayaan</h6>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4 grid-margin">
                                <a class="card-link" href="./admin/transaksihome.php">
                                    <div class="card dashboard">
                                        <div class="card-body row align-items-center">
                                            <div class="col-4 pr-4 text-right"><i class="fas fa-receipt fa-3x"></i></div>
                                            <div class="col-8">
                                                <h2 class="display-3"><?php echo $admin_transaksi_total ?></h2>
                                                <h6 class="display-5 font-weight-semibold">Transaksi</h6>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php } else if (isset($_SESSION["user"])) { ?>
                        <div class="row">
                            <div class="col-md-4 grid-margin">
                                <a class="card-link" href="./user/rekeninghome.php">
                                    <div class="card dashboard">
                                        <div class="card-body row align-items-center">
                                            <div class="col-4 pr-4 text-right"><i class="fas fa-wallet fa-3x"></i></div>
                                            <div class="col-8">
                                                <h2 class="display-3"><?php echo $user_rekening_total ?></h2>
                                                <h6 class="display-5 font-weight-semibold">Rekening</h6>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4 grid-margin">
                                <a class="card-link" href="./user/pengajuanhome.php">
                                    <div class="card dashboard">
                                        <div class="card-body row align-items-center">
                                            <div class="col-4 pr-4 text-right"><i class="fas fa-file-contract fa-3x"></i></div>
                                            <div class="col-8">
                                                <h2 class="display-3"><?php echo $user_pembiayaan_total ?></h2>
                                                <h6 class="display-5 font-weight-semibold">Pengajuan</h6>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4 grid-margin">
                                <a class="card-link" href="./user/pembiayaanhome.php">
                                    <div class="card dashboard">
                                        <div class="card-body row align-items-center">
                                            <div class="col-4 pr-4 text-right"><i class="fas fa-money-check fa-3x"></i></div>
                                            <div class="col-8">
                                                <h2 class="display-3"><?php echo $user_pembiayaan_total ?></h2>
                                                <h6 class="display-5 font-weight-semibold">Pembiayaan</h6>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4 grid-margin">
                                <a class="card-link" href="./user/transaksihome.php">
                                    <div class="card dashboard">
                                        <div class="card-body row align-items-center">
                                            <div class="col-4 pr-4 text-right"><i class="fas fa-receipt fa-3x"></i></div>
                                            <div class="col-8">
                                                <h2 class="display-3"><?php echo $user_transaksi_total ?></h2>
                                                <h6 class="display-5 font-weight-semibold">Transaksi</h6>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="row">
                            <div class="col-md-4 grid-margin">
                                <a class="card-link" href="./manager/pengajuanhome.php">
                                    <div class="card dashboard">
                                        <div class="card-body row align-items-center">
                                            <div class="col-4 pr-4 text-right"><i class="fas fa-file-contract fa-3x"></i></div>
                                            <div class="col-8">
                                                <h2 class="display-3"><?php echo $admin_pembiayaan_total ?></h2>
                                                <h6 class="display-5 font-weight-semibold">Pengajuan</h6>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4 grid-margin">
                                <a class="card-link" href="./manager/pembiayaanhome.php">
                                    <div class="card dashboard">
                                        <div class="card-body row align-items-center">
                                            <div class="col-4 pr-4 text-right"><i class="fas fa-money-check fa-3x"></i></div>
                                            <div class="col-8">
                                                <h2 class="display-3"><?php echo $admin_pembiayaan_total ?></h2>
                                                <h6 class="display-5 font-weight-semibold">Pembiayaan</h6>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4 grid-margin">
                                <a class="card-link" href="./manager/transaksihome.php">
                                    <div class="card dashboard">
                                        <div class="card-body row align-items-center">
                                            <div class="col-4 pr-4 text-right"><i class="fas fa-receipt fa-3x"></i></div>
                                            <div class="col-8">
                                                <h2 class="display-3"><?php echo $admin_transaksi_total ?></h2>
                                                <h6 class="display-5 font-weight-semibold">Transaksi</h6>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="container-fluid clearfix">
                        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2021</span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="../assets/vendors/js/vendor.bundle.addons.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="../assets/js/shared/off-canvas.js"></script>
    <script src="../assets/js/shared/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="../assets/js/demo_1/dashboard.js"></script>
    <!-- End custom js for this page-->
    <script src="../assets/js/shared/jquery.cookie.js" type="text/javascript"></script>
</body>

</html>