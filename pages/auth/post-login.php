<?php
session_start();

require_once '../../koneksi.php';
if (isset($_POST['username']) && isset($_POST['password'])) {
    // real_escape_string untuk menghindari serangan SQL INJECTION
    $username = $conn->real_escape_string($_POST["username"]);
    $password = $conn->real_escape_string($_POST["password"]);

    $result = mysqli_query($conn, "select * from nasabah where username = '$username' and password = '$password'");
    $data = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) !== 0) {
        $_SESSION["id"] = $data["id"];
        $_SESSION["username"] = $username;
        $_SESSION["nama"] = $data["nama"];
        $_SESSION["logged"] = true;
        $_SESSION["role"] = "user";
        $_SESSION["user"] = "user";
        header("Location: ../dashboard.php");
    } else {
        $_SESSION["error"] = "Username & password tidak cocok";
        header("Location: ./login.php");
    }
} else {
    $_SESSION["error"] = "Isi username dan password terlebih dahulu";
    header("Location: ./login.php");
}
