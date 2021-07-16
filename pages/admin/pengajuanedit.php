<?php
session_start();
require_once '../../koneksi.php';
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
    $result = mysqli_query($conn, "select * from pembiayaan where id ='$id'");
    $pembiayaan = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) == 0) {
        $_SESSION["error"] = "ID Tidak ditemukan";
        header("Location: ./pengajuanhome.php");
    }
} else {
    $_SESSION["error"] = "ID Tidak ditemukan";
    header("Location: ./pengajuanhome.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>BMT Ash Shaddiq | Data Pengajuan</title>
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
                                <h3 class="page-title">Data Pengajuan</h3>
                            </div>
                        </div>
                    </div>
                    <!-- Page Title Header Ends-->
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        <div class="col-md-7">
                                            <h4 class="mb-5"><strong>Edit Pembiayaan</strong></h4>
                                            <form class="forms-sample" action=<?php echo "./pengajuanupdate.php?id={$pembiayaan['id']}" ?> method="POST">
                                                <div class="form-group">
                                                    <label>Jenis Akad</label>
                                                    <select name="jenis_akad" class="form-control" required>
                                                        <option value="Mudharabah">Mudharabah</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Kegunaan</label>
                                                    <input type="text" name="kegunaan" class="form-control" required value="<?php echo $pembiayaan['kegunaan'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Jaminan</label>
                                                    <input type="text" name="jaminan" class="form-control" required value="<?php echo $pembiayaan['jaminan'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Jangka Waktu</label>
                                                    <div class="input-group">
                                                        <input name="jangka_waktu" type="number" min=1 class="form-control" placeholder="Masukkan Jangka Waktu Pembiayaan" required value="<?php echo $pembiayaan['jangka_waktu'] ?>">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Bulan</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Total Pinjaman</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Rp</span>
                                                        </div>
                                                        <input name="total_pinjaman" type="number" min=1 class="form-control" placeholder="Masukkan Total Pinjaman" required value="<?php echo $pembiayaan['total_pinjaman'] ?>">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Nisbah BMT</label>
                                                            <input name="nisbah_bmt" type="number" min=0 max=100 class="form-control" readonly value=60>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label f>Nisbah Nasabah</label>
                                                            <input name="nisbah_nasabah" type="number" min=0 max=100 class="form-control" readonly value=40>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tanggal Pengajuan</label>
                                                    <input name="tanggal_pengajuan" type="date" class="form-control" placeholder="yyyy/mm/dd" required value="<?php echo $pembiayaan['tanggal_pengajuan'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Angsuran Per Bulan</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Rp</span>
                                                        </div>
                                                        <input name="angsuran_per_bulan" type="number" min=1 class="form-control" placeholder="Masukkan Angsuran Per Bulan" required value="<?php echo $pembiayaan['angsuran_per_bulan'] ?>">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" name="update_pengajuan" class="btn btn-success mr-2">Update</button>
                                                <a href="./pengajuanhome.php"><button type="button" class="btn btn-light">Cancel</button></a>
                                            </form>
                                        </div>
                                    </div>
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