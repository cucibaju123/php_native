<?php
session_start();
require_once "../../koneksi.php";

if (isset($_POST["tambah_admin"])) {
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $agama = $_POST['agama'];
    $status = $_POST['status'];
    $jabatan = $_POST["jabatan"];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "insert into admin (nama, jenis_kelamin, tanggal_lahir, agama, status, jabatan, username, password) values('$nama', '$jenis_kelamin', '$tanggal_lahir', '$agama', '$status', '$jabatan', '$username', '$password')") or die(mysqli_error($conn));

    if ($result) {
        $_SESSION["success"] = "Data admin berhasil ditambahkan";
        header("Location: ./adminhome.php");
    } else {
        $_SESSION["error"] = "Data gagal ditambahkan";
        header("Location: ./adminadd.php");
    }
} else {
    $_SESSION["error"] = "Isi form terlebih dahulu";
    header("Location: ./adminadd.php");
}
