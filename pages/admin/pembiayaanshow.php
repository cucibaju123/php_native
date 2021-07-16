<?php
include "../../koneksi.php";
session_start();
// =================RESTRIKSI==================================
if (!isset($_SESSION["logged"]) && !isset($_SESSION["admin"])) {
    $_SESSION["error"] = "Login terlebih dahulu";
    header("Location: ../auth/login.php");
}
if (isset($_SESSION["logged"]) && !isset($_SESSION["admin"])) {
    $_SESSION["error"] = "Anda bukan admin";
    header("Location: ../dashboard.php");
}
// =================RESTRIKSI==================================

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    // Mengecek ID ada atau tidak sebelum melakukan join query
    $result = mysqli_query($conn, "select * from pembiayaan where id = '$id'");
    $pembiayaan = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) !== 0) {
        $result_nasabah = mysqli_query($conn, "select p.*, n.nama as nama_nasabah from pembiayaan as p inner join nasabah as n on p.nasabah_id=n.id where p.id ='$id'") or die(mysqli_error($conn));
        $pembiayaan_nasabah = mysqli_fetch_assoc($result_nasabah);

        $result_admin = mysqli_query($conn, "select p.*, a.nama as nama_admin from pembiayaan as p left join admin as a on p.admin_id=a.id where p.id ='$id'") or die(mysqli_error($conn));
        $pembiayaan_admin = mysqli_fetch_assoc($result_admin);

        $result_manager = mysqli_query($conn, "select p.*, m.nama as nama_manager from pembiayaan as p left join manager as m on p.admin_id=m.id where p.id ='$id'") or die(mysqli_error($conn));
        $pembiayaan_manager = mysqli_fetch_assoc($result_manager);
    } else {
        $_SESSION["error"] = "ID Tidak ditemukan";
        header("Location: ./pembiayaanhome.php");
    }
} else {
    $_SESSION["error"] = "ID Tidak ditemukan";
    header("Location: ./pembiayaanhome.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>BMT Ash Shaddiq | Data Pembiayaan</title>
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
                        <a class="nav-link" href="./adminhome.php">
                            <i class="menu-icon typcn typcn-shopping-bag"></i>
                            <span class="menu-title">Admin</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./nasabahhome.php">
                            <i class="menu-icon typcn typcn-shopping-bag"></i>
                            <span class="menu-title">Nasabah</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./rekeninghome.php">
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
                                    <a class="nav-link" href="./pengajuanhome.php">Pengajuan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="./pembiayaanhome.php">Pembiayaan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="./transaksihome.php">Transaksi</a>
                                </li>
                            </ul>
                        </div>
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
                                <h3 class="page-title">Data Pembiayaan</h3>
                            </div>
                        </div>
                    </div>
                    <!-- Page Title Header Ends-->
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4>Pembiayaan PMB-<?php echo $pembiayaan["id"] ?? '' ?></h4>
                                    <table class="table table-striped table-responsive-sm mt-3">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>ID</td>
                                                <td>PMB-<?php echo $pembiayaan["id"] ?></td>
                                            </tr>
                                            <tr>
                                                <td>No. Rekening</td>
                                                <td><?php echo $pembiayaan["rekening_id"] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Nasabah</td>
                                                <td><?php echo $pembiayaan_nasabah["nama_nasabah"] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Admin</td>
                                                <td><?php echo $pembiayaan_admin["nama_admin"] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Manager</td>
                                                <td><?php echo $pembiayaan_manager["nama_manager"] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Jenis Akad</td>
                                                <td><?php echo $pembiayaan["jenis_akad"] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Kegunaan</td>
                                                <td><?php echo $pembiayaan["kegunaan"] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Jaminan</td>
                                                <td><?php echo $pembiayaan["jaminan"] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Total Pinjaman</td>
                                                <td>Rp <?php echo number_format($pembiayaan["total_pinjaman"], 0, ',', '.') ?? '00' ?>,00</td>
                                            </tr>
                                            <tr>
                                                <td>Nisbah BMT</td>
                                                <td><?php echo $pembiayaan["nisbah_bmt"] ?? '0' ?> %</td>
                                            </tr>
                                            <tr>
                                                <td>Nisbah Nasabah</td>
                                                <td><?php echo $pembiayaan["nisbah_nasabah"] ?? '0' ?> %</td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Pengajuan</td>
                                                <td><?php echo $pembiayaan["tanggal_pengajuan"] ?? '' ?></td>
                                            </tr>
                                            <tr>
                                                <td>Angsuran per bulan</td>
                                                <td>Rp <?php echo number_format($pembiayaan["angsuran_per_bulan"], 0, ',', '.') ?? '00' ?>,00 /bulan</td>
                                            </tr>
                                            <tr>
                                                <td>Total Angsuran</td>
                                                <td>Rp <?php echo number_format($pembiayaan["total_angsuran"], 0, ',', '.') ?? '00' ?>,00</td>
                                            </tr>
                                            <tr>
                                                <td>Jangka Waktu</td>
                                                <td><?php echo $pembiayaan["jangka_waktu"] ?> bulan</td>
                                            </tr>
                                            <tr>
                                                <td>Pendapatan BMT</td>
                                                <td>Rp <?php echo number_format($pembiayaan["pendapatan_bmt"], 0, ',', '.') ?? '00' ?>,00</td>
                                            </tr>
                                            <tr>
                                                <td>Pendapatan Nasabah</td>
                                                <td>Rp <?php echo number_format($pembiayaan["pendapatan_nasabah"], 0, ',', '.') ?? '00' ?>,00</td>
                                            </tr>
                                            <tr>
                                                <td>Disetujui Manager</td>
                                                <?php if ($pembiayaan["manager_approved"] == 1) { ?>
                                                    <td><i class="mdi mdi-check mdi-36px text-success"></i></td>
                                                <?php } else { ?>
                                                    <td><i class="mdi mdi-close mdi-36px text-danger"></i></td>
                                                <?php } ?>
                                            </tr>
                                            <tr>
                                                <td>Disetujui Admin</td>
                                                <?php if ($pembiayaan["admin_approved"] == 1) { ?>
                                                    <td><i class="mdi mdi-check mdi-36px text-success"></i></td>
                                                <?php } else { ?>
                                                    <td><i class="mdi mdi-close mdi-36px text-danger"></i></td>
                                                <?php } ?>
                                            </tr>

                                        </tbody>
                                    </table>
                                    <a href="./pembiayaanhome.php"><button type="button" class="btn btn-light mt-3">Kembali</button></a>

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