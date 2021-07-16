<?php
session_start();
require_once "../../koneksi.php";

if (isset($_POST["edit_admin"]) && isset($_GET["id"])) {
    $id = $_GET['id'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $agama = $_POST['agama'];
    $status = $_POST['status'];
    $jabatan = $_POST['jabatan'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $find_result = mysqli_query($conn, "select * from admin where id = '$id'") or die(mysqli_error($conn));

    if (mysqli_num_rows($find_result) !== 0) {
        if ($password !== '') {
            $result = mysqli_query($conn, "UPDATE admin SET nama='$nama', jenis_kelamin= '$jenis_kelamin',tanggal_lahir= '$tanggal_lahir',agama= '$agama', status= '$status', jabatan= '$jabatan', username= '$username', password= '$password' WHERE id='$id'") or die(mysqli_error($conn));
            if (mysqli_num_rows($result) !== 0) {
                $_SESSION["success"] = "Data berhasil diupdate";
                header("Location: ./adminhome.php");
            } else {
                $_SESSION["error"] = "Data gagal diupdate";
                header("Location: ./adminhome.php");
            }
        } else {
            $result = mysqli_query($conn, "UPDATE admin SET nama='$nama', jenis_kelamin= '$jenis_kelamin',tanggal_lahir= '$tanggal_lahir',agama= '$agama', status= '$status', jabatan= '$jabatan', username= '$username' WHERE id='$id'") or die(mysqli_error($conn));
            if (mysqli_num_rows($result) !== 0) {
                $_SESSION["success"] = "Data berhasil diupdate";
                header("Location: ./adminhome.php");
            } else {
                $_SESSION["error"] = "Data gagal diupdate";
                header("Location: ./adminhome.php");
            }
        }
    } else {
        $_SESSION["error"] = "ID tidak ditemukan";
    }
} else {
    $_SESSION["error"] = "Isi form terlebih dahulu";
    header("Location: ./adminedit.php");
}
