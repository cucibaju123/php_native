<?php
session_start();
require_once '../../koneksi.php';
// =================RESTRIKSI==================================
if (!isset($_SESSION["logged"]) && !isset($_SESSION["manager"])) {
    $_SESSION["error"] = "Login terlebih dahulu";
    header("Location: ../auth/login.php");
}
if (isset($_SESSION["logged"]) && !isset($_SESSION["manager"])) {
    $_SESSION["error"] = "Anda bukan manager";
    header("Location: ../dashboard.php");
}
// =================RESTRIKSI==================================


if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}

if (isset($_GET['cari'])) {
    $cari = $_GET['cari'];
} else if (isset($_GET["cari"]) && $_GET["cari"] == '') {
    $cari = null;
} else {
    $cari = null;
}

$no_of_records_per_page = 15;
$offset = ($pageno - 1) * $no_of_records_per_page;

$result_count = mysqli_query($conn, "select count(*) from transaksi");
$total_rows = mysqli_fetch_array($result_count)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);
if ($cari == null) {
    $result = mysqli_query($conn, "select t.*, n.nama from transaksi as t inner join nasabah as n on t.nasabah_id=n.id order by t.id desc limit $offset, $no_of_records_per_page") or die(mysqli_error($conn));
} else {
    $result = mysqli_query($conn, "select t.*, n.nama from transaksi as t inner join nasabah as n on t.nasabah_id=n.id where nama like '%$cari%' order by t.id desc limit $offset, $no_of_records_per_page") or die(mysqli_error($conn));
}
$data_transaksi = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>BMT Ash Shaddiq | Data Transaksi</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets/vendors/iconfonts/ionicons/dist/css/ionicons.css">
    <link rel="stylesheet" href="../../assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.addons.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../../assets/css/shared/style.css">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../../assets/css/demo_1/style.css">
    <!-- End Layout styles -->
    <link rel="shortcut icon" href="../../assets/images/favicon.ico" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
                <a class="navbar-brand brand-logo" href="../dashboard.php">
                    <img style="height: 37px !important; width: auto;" src="../../assets/images/auth/LOGO BMT MINI.png" alt="logo" />
                </a>
                <a class="navbar-brand brand-logo-mini" href="../dashboard.php>
                    <img style=" height: 37px !important; width: auto;" src="../../assets/images/auth/LOGO BMT MINI.png" alt="logo" />
                </a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
                        <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                            <img class="img-xs rounded-circle" src="../../assets/images/faces/face8.jpg" alt="Profile image"> </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle" src="../../assets/images/faces/face8.jpg" alt="Profile image">
                                <p class="mb-1 mt-3 font-weight-semibold"><?php echo $_SESSION["nama"]; ?></p>
                                <p class="font-weight-light text-muted mb-0"><?php echo $_SESSION["username"]; ?></p>
                            </div>
                            <a href="../auth/logout.php" class="dropdown-item text-danger">Sign Out</a>
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
                        <a class="nav-link" href="../dashboard.php">
                            <i class="menu-icon typcn typcn-document-text"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./pengajuanhome.php">
                            <i class="menu-icon typcn typcn-user-outline"></i>
                            <span class="menu-title">Pengajuan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./pembiayaanhome.php">
                            <i class="menu-icon typcn typcn-th-large-outline"></i>
                            <span class="menu-title">Pembiayaan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./transaksihome.php">
                            <i class="menu-icon typcn typcn-th-large-outline"></i>
                            <span class="menu-title">Transaksi</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <!-- Page Title Header Starts-->
                    <div class="row page-title-header">
                        <div class="col-12">
                            <?php include "../inc/messageslogged.php" ?>
                            <div class="page-header">
                                <h3 class="page-title">Data Transaksi</h3>
                            </div>
                        </div>
                    </div>
                    <!-- Page Title Header Ends-->
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <?php if (count($data_transaksi) < 1) { ?>
                                        <div class="p-3">
                                            <p class="text-center">Tidak Ada Data</p>
                                        </div>
                                    <?php } else { ?>
                                        <div class="row align-items-center">
                                            <div class="col-md-6 mt-1">
                                                <form class="d-flex" action=<?php echo "./transaksihome.php?pageno=" . $pageno . "&" ?> method="get">
                                                    <input class="form-control mr-2" type="search" name="cari" placeholder="Cari Nama Nasabah" value="<?php echo $cari ?>" aria-label="Search">
                                                    <button class="btn btn-primary" type="submit">Cari</button>
                                                </form>
                                            </div>
                                            <div class="col-md-6 mt-1 text-right">
                                                <a href=<?php echo "../export_transaksi.php" ?>><button class="btn btn-primary py-2">Print Semua</button></a>
                                            </div>
                                        </div>
                                        <table class="table table-striped table-responsive mt-4">
                                            <thead>
                                                <tr>
                                                    <th>No Transaksi</th>
                                                    <th>No Pembiayaan</th>
                                                    <th>Nasabah</th>
                                                    <th>Tanggal Transaksi</th>
                                                    <th>Debit</th>
                                                    <th>Kredit</th>
                                                    <th>Keterangan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($data_transaksi as $transaksi) { ?>
                                                    <tr>
                                                        <td>TR-<?php echo $transaksi["id"] ?> </td>
                                                        <td>PMB-<?php echo $transaksi["pembiayaan_id"] ?></td>
                                                        <td> <?php echo $transaksi["nama"] ?></td>
                                                        <td> <?php echo $transaksi["tanggal_transaksi"] ?></td>
                                                        <td>Rp <?php echo number_format($transaksi["debit"], 0, ',', '.') ?? '00' ?>,00</td>
                                                        <td>Rp <?php echo number_format($transaksi["kredit"], 0, ',', '.') ?? '00' ?>,00</td>
                                                        <td> <?php echo $transaksi["keterangan"] ?></td>
                                                        <td>
                                                            <a href=<?php echo "../print.php?id={$transaksi['id']}" ?>><button class="btn btn-danger">Print</button></a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    <?php } ?>
                                    <nav class="mt-3 row justify-content-center">
                                        <ul class="pagination">
                                            <li class="page-item <?php if ($pageno <= 1) {
                                                                        echo 'disabled';
                                                                    } ?>">
                                                <a class="page-link" href="<?php if ($pageno <= 1 && $cari == null) {
                                                                                echo '#';
                                                                            } else if ($pageno <= 1 && $cari != null) {
                                                                                echo '?cari=' . $cari . "&#";
                                                                            } else if ($pageno > 1 && $cari != null) {
                                                                                echo '?cari=' . $cari . "&pageno=" . ($pageno - 1);
                                                                            } else {
                                                                                echo "?pageno=" . ($pageno - 1);
                                                                            } ?>" tabindex="-1" aria-disabled="true">Previous</a>
                                            </li>
                                            <li class="page-item <?php if ($pageno >= $total_pages) {
                                                                        echo 'disabled';
                                                                    } ?>">
                                                <a class="page-link" href="<?php if ($pageno >= $total_pages && $cari == null) {
                                                                                echo '#';
                                                                            } else if ($pageno >= $total_pages && $cari != null) {
                                                                                echo '?cari=' . $cari . '&#';
                                                                            } else if ($pageno < $total_pages && $cari != null) {
                                                                                echo "?cari=" . $cari . "&pageno=" . ($pageno + 1);
                                                                            } else {
                                                                                echo "?pageno=" . ($pageno + 1);
                                                                            } ?>">Next</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
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
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="../../assets/vendors/js/vendor.bundle.addons.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="../../assets/js/shared/off-canvas.js"></script>
    <script src="../../assets/js/shared/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="../../assets/js/demo_1/dashboard.js"></script>
    <!-- End custom js for this page-->
    <script src="../../assets/js/shared/jquery.cookie.js" type="text/javascript"></script>
</body>

</html>