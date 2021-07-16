<?php  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>BMT Ash Shiddiq | Login</title>
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
    <link rel="stylesheet" href="../../assets/css/auth_style.css">
    <link rel="stylesheet" href="../../assets/css/shared/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../../assets/images/favicon.ico" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
                <div class="row w-100">
                    <div class="col-lg-4 mx-auto">
                        <div class="text-center">
                            <img style="width: 300px;" class="mb-3 mx-auto" src="../../assets/images/auth/LOGO BMT.png" alt="logo">
                        </div>
                        <div class="auto-form-wrapper">
                            <?php include "../inc/messages.php" ?>
                            <div class="row justify-content-center">
                                <div class="col text-center">
                                    <p style="font-size: 13px !important;" class="text-custom-secondary mb-2">Login Sebagai:</p>
                                    <div class="btn-group mb-5" role="group" aria-label="Basic outlined example">
                                        <button type="button" class="btn btn-lg btn-custom"><a href="./login.php">Nasabah</a></button>
                                        <button type="button" class="btn btn-lg btn-custom"><a href="./loginadmin.php">Admin</a></button>
                                        <button type="button" class="btn btn-lg btn-custom active"><a href="./loginmanager.php">Manager</a></button>
                                    </div>
                                </div>
                            </div>
                            <form action="post-login-manager.php" method="post">
                                <div class="form-group">
                                    <label class="label">Username</label>
                                    <div class="input-group">
                                        <input name="username-manager" type="text" class="form-control" placeholder="Masukkan username" required="required">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-check-circle-outline"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="label">Password</label>
                                    <div class="input-group">
                                        <input name="password-manager" type="password" class="form-control" placeholder="Masukkan password" required="required">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-check-circle-outline"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-custom-login submit-btn btn-block">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="../../assets/vendors/js/vendor.bundle.addons.js"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="../../assets/js/shared/off-canvas.js"></script>
    <script src="../../assets/js/shared/misc.js"></script>
    <!-- endinject -->
    <script src="../../assets/js/shared/jquery.cookie.js" type="text/javascript"></script>
</body>

</html>