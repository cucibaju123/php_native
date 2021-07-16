<?php
session_start();
require_once '../../koneksi.php';

if (isset($_POST['username-manager']) && isset($_POST['password-manager'])) {
    // real_escape_string untuk menghindari serangan SQL INJECTION
    if ($conn) {
        $username = $conn->real_escape_string($_POST["username-manager"]);
        $password = $conn->real_escape_string($_POST["password-manager"]);
    }

    $result = mysqli_query($conn, "select * from manager where username = '$username' and password = '$password'");
    $data = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) !== 0) {
        $_SESSION["id"] = $data["id"];
        $_SESSION["username"] = $username;
        $_SESSION["nama"] = $data["nama"];
        $_SESSION["logged"] = true;
        $_SESSION["role"] = "manager";
        $_SESSION["manager"] = "manager";
        header("Location: ../dashboard.php");
    } else {
        $_SESSION["error"] = "Username & password tidak cocok";
        header("Location: ./loginmanager.php");
    }
} else {
    $_SESSION["error"] = "Isi username dan password terlebih dahulu";
    header("Location: ./loginmanager.php");
}
