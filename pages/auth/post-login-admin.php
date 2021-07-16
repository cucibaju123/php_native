<?php
session_start();
require_once '../../koneksi.php';

if (isset($_POST['username-admin']) && isset($_POST['password-admin'])) {
    // real_escape_string untuk menghindari serangan SQL INJECTION
    if ($conn) {
        $username = $conn->real_escape_string($_POST["username-admin"]);
        $password = $conn->real_escape_string($_POST["password-admin"]);
    }

    $result = mysqli_query($conn, "select * from admin where username = '$username' and password = '$password'");
    $data = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) !== 0) {
        $_SESSION["id"] = $data["id"];
        $_SESSION["username"] = $username;
        $_SESSION["nama"] = $data["nama"];
        $_SESSION["logged"] = true;
        $_SESSION["role"] = "admin";
        $_SESSION["admin"] = "admin";
        header("Location: ../dashboard.php");
    } else {
        $_SESSION["error"] = "Username & password tidak cocok";
        header("Location: ./loginadmin.php");
    }
} else {
    $_SESSION["error"] = "Isi username dan password terlebih dahulu";
    header("Location: ./loginadmin.php");
}
