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
    $result = mysqli_query($conn, "select * from admin where id ='$id'");
    $admin = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) == 0) {
        $_SESSION["error"] = "ID Tidak ditemukan";
        header("Location: ./adminhome.php");
    }
} else {
    $_SESSION["error"] = "ID Tidak ditemukan";
    header("Location: ./adminhome.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>BMT Ash Shaddiq | Data Admin</title>
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
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <!-- Page Title Header Starts-->
                    <div class="row page-title-header">
                        <div class="col-12">
                            <?php include "../inc/messageslogged.php" ?>
                            <div class="page-header">
                                <h3 class="page-title">Data Admin</h3>
                            </div>
                        </div>
                    </div>
                    <!-- Page Title Header Ends-->
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        <?php include "../inc/messageslogged.php" ?>
                                        <div class="col-md-7">
                                            <h4 class="mb-5"><strong>Edit Admin</strong></h4>
                                            <form class="forms-sample" action="<?php echo "./adminupdate.php?id=" . $admin['id'] ?>" method="POST">
                                                <div class="form-group">
                                                    <label>Nama</label>
                                                    <input name="nama" type="text" class="form-control" placeholder="Masukkan nama admin" value="<?php echo $admin['nama'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Jenis Kelamin</label>
                                                    <select name="jenis_kelamin" class="form-control">
                                                        <option value="Laki-laki" <?php if ($admin["jenis_kelamin"] == "Laki-laki") echo 'selected'  ?>>Laki-laki</option>
                                                        <option value="Perempuan" <?php if ($admin["jenis_kelamin"] == "Perempuan") echo 'selected'  ?>>Perempuan</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Agama</label>
                                                    <select id="agamanasabah" name="agama" class="form-control">
                                                        <option value="Islam" <?php if ($admin["agama"] == "Islam") echo 'selected'  ?>>Islam</option>
                                                        <option value="Katholik" <?php if ($admin["agama"] == "Katholik") echo 'selected'  ?>>Katholik</option>
                                                        <option value="Protestan" <?php if ($admin["agama"] == "Protestan") echo 'selected'  ?>>Protestan</option>
                                                        <option value="Hindu" <?php if ($admin["agama"] == "Hindu") echo 'selected'  ?>>Hindu</option>
                                                        <option value="Buddha" <?php if ($admin["agama"] == "Buddha") echo 'selected'  ?>>Buddha</option>
                                                        <option value="Konghucu" <?php if ($admin["agama"] == "Konghucu") echo 'selected'  ?>>Konghucu</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select name="status" class="form-control">
                                                        <option value="Belum Menikah" <?php if ($admin["status"] == "Belum Menikah") echo 'selected'  ?>>Belum Menikah</option>
                                                        <option value="Sudah Menikah" <?php if ($admin["status"] == "Sudah Menikah") echo 'selected'  ?>>Sudah Menikah</option>
                                                        <option value="Pernah Menikah" <?php if ($admin["status"] == "Pernah Menikah") echo 'selected'  ?>>Pernah Menikah</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Jabatan</label>
                                                    <input name="jabatan" type="text" class="form-control" placeholder="Masukkan jabatan" value="<?php echo $admin['jabatan'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tanggal Lahir</label>
                                                    <input name="tanggal_lahir" type="date" class="form-control" placeholder="yyyy/mm/dd" value="<?php echo $admin['tanggal_lahir'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input name="username" type="text" class="form-control" placeholder="Masukkan username" value="<?php echo $admin['username'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Ubah Password</label>
                                                    <input name="password" type="password" class="form-control" placeholder="Ubah password">
                                                </div>
                                                <button type="submit" class="btn btn-success mr-2" name="edit_admin">Save</button>
                                                <a href="./adminhome.php"><button type="button" class="btn btn-light mr-2">Cancel</button></a>
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