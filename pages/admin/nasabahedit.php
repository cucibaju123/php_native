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
    $result = mysqli_query($conn, "select * from nasabah where id ='$id'");
    $nasabah = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) == 0) {
        $_SESSION["error"] = "ID Tidak ditemukan";
        header("Location: ./nasabahhome.php");
    }
} else {
    $_SESSION["error"] = "ID Tidak ditemukan";
    header("Location: ./nasabahhome.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>BMT Ash Shaddiq | Data Nasabah</title>
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
                        <a class="nav-link" href="./nasabahhome.php">
                            <i class="menu-icon typcn typcn-shopping-bag"></i>
                            <span class="menu-title">Nasabah</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./rekeninghome.php">
                            <i class="menu-icon typcn typcn-shopping-bag"></i>
                            <span class="menu-title">Rekening</span>
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
                                <h3 class="page-title">Data Nasabah</h3>
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
                                            <h4 class="mb-5"><strong>Edit Nasabah</strong></h4>
                                            <form class="forms-sample" action="./nasabahupdate.php?id=<?php echo $nasabah['id'] ?>" method="POST">
                                                <div class="form-group">
                                                    <label>NIK</label>
                                                    <input id="idnasabah" name="id" type="text" class="form-control" placeholder="Masukkan NIK" value=<?php echo $nasabah['id'] ?> required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama</label>
                                                    <input id="namanasabah" name="nama" type="text" class="form-control" placeholder="Masukkan nama nasabah" value="<?php echo $nasabah['nama'] ?>" required>
                                                </div>
                                                <div class=" form-group">
                                                    <label>Jenis Kelamin</label>
                                                    <select id="jenis_kelaminnasabah" name="jenis_kelamin" class="form-control">
                                                        <option value="Laki-laki" <?php if ($nasabah['jenis_kelamin'] == 'Laki-laki') echo 'selected'  ?>>Laki-laki</option>
                                                        <option value="Perempuan" <?php if ($nasabah['jenis_kelamin'] == 'Perempuan') echo 'selected'  ?>>Perempuan</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tempat Lahir</label>
                                                    <input id="tempat_lahirnasabah" name="tempat_lahir" type="text" class="form-control" placeholder="Masukkan tempat lahir" value="<?php echo $nasabah['tempat_lahir'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tanggal Lahir</label>
                                                    <input id="tanggal_lahirnasabah" name="tanggal_lahir" type="date" class="form-control" value=<?php echo $nasabah['tanggal_lahir'] ?> required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Alamat</label>
                                                    <textarea id="alamatnasabah" name="alamat" class="form-control" placeholder="Masukkan alamat" required><?php echo $nasabah['alamat'] ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Agama</label>
                                                    <select id="agamanasabah" name="agama" class="form-control">
                                                        <option value="Islam" <?php if ($nasabah['agama'] == 'Islam') echo 'selected'  ?>>Islam</option>
                                                        <option value="Katholik" <?php if ($nasabah['agama'] == 'Katholik') echo 'selected'  ?>>Katholik</option>
                                                        <option value="Protestan" <?php if ($nasabah['agama'] == 'Protestan') echo 'selected'  ?>>Protestan</option>
                                                        <option value="Hindu" <?php if ($nasabah['agama'] == 'Hindu') echo 'selected'  ?>>Hindu</option>
                                                        <option value="Buddha" <?php if ($nasabah['agama'] == 'Buddha') echo 'selected'  ?>>Buddha</option>
                                                        <option value="Konghucu" <?php if ($nasabah['agama'] == 'Konghucu') echo 'selected'  ?>>Konghucu</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Pendidikan</label>
                                                    <select id="statusnasabah" name="pendidikan" class="form-control" required>
                                                        <option value="SD" <?php if ($nasabah['pendidikan'] == 'SD') echo 'selected'  ?>>SD</option>
                                                        <option value="SMP" <?php if ($nasabah['pendidikan'] == 'SMP') echo 'selected'  ?>>SMP</option>
                                                        <option value="SMA/SMK" <?php if ($nasabah['pendidikan'] == 'SMA/SMK') echo 'selected'  ?>>SMA/SMK</option>
                                                        <option value="D1" <?php if ($nasabah['pendidikan'] == 'D1') echo 'selected'  ?>>D1</option>
                                                        <option value="D2" <?php if ($nasabah['pendidikan'] == 'D2') echo 'selected'  ?>>D2</option>
                                                        <option value="D3" <?php if ($nasabah['pendidikan'] == 'D3') echo 'selected'  ?>>D3</option>
                                                        <option value="S1" <?php if ($nasabah['pendidikan'] == 'S1') echo 'selected'  ?>>S1</option>
                                                        <option value="S2" <?php if ($nasabah['pendidikan'] == 'S2') echo 'selected'  ?>>S2</option>
                                                        <option value="S3" <?php if ($nasabah['pendidikan'] == 'S3') echo 'selected'  ?>>S3</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select id="statusnasabah" name="status" class="form-control">
                                                        <option value="Belum Menikah" <?php if ($nasabah['status'] == 'Belum Menikah') echo 'selected'  ?>>Belum Menikah</option>
                                                        <option value="Sudah Menikah" <?php if ($nasabah['status'] == 'Sudah Menikah') echo 'selected'  ?>>Sudah Menikah</option>
                                                        <option value="Pernah Menikah" <?php if ($nasabah['status'] == 'Pernah Menikah') echo 'selected'  ?>>Pernah Menikah</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Pekerjaan</label>
                                                    <input id="pekerjaannasabah" name="pekerjaan" type="text" class="form-control" placeholder="Masukkan pekerjaan" value="<?php echo $nasabah['pekerjaan'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>No.HP</label>
                                                    <input id="no_hpnasabah" name="no_hp" type="number" min=0 class="form-control" placeholder="Cth: 08786076xxxx" value="<?php echo $nasabah['no_hp'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Ahli Waris</label>
                                                    <input name="ahli_waris" type="text" class="form-control" placeholder="Masukkan nama ahli waris" value="<?php echo $nasabah['ahli_waris'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Alamat Ahli Waris</label>
                                                    <textarea name="alamat_ahli_waris" class="form-control" placeholder="Masukkan alamat ahli waris" required><?php echo $nasabah['alamat_ahli_waris'] ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input id="usernamenasabah" name="username" type="text" class="form-control" placeholder="Masukkan username" value="<?php echo $nasabah['username'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Ubah Password</label>
                                                    <input id="passwordnasabah" name="password" type="password" class="form-control" placeholder="Masukkan Password Baru">
                                                </div>
                                                <button type="submit" class="btn btn-success mr-2" name="update_nasabah">Update</button>
                                                <a href="./nasabahhome.php"><button type="button" class="btn btn-light mr-2">Cancel</button></a>
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