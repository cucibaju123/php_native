<?php
session_start();
require_once "../../koneksi.php";

if (isset($_POST["update_nasabah"]) && isset($_GET["id"])) {
    $id_old = $_GET["id"];
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $agama = $_POST['agama'];
    $pendidikan = $_POST['pendidikan'];
    $status = $_POST['status'];
    $pekerjaan = $_POST["pekerjaan"];
    $no_hp = $_POST["no_hp"];
    $ahli_waris = $_POST["ahli_waris"];
    $alamat_ahli_waris = $_POST["alamat_ahli_waris"];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $find_result = mysqli_query($conn, "select * from nasabah where id = '$id_old'") or die(mysqli_error($conn));

    if (mysqli_num_rows($find_result) !== 0) {
        if ($password !== '') {
            $result = mysqli_query($conn, "UPDATE nasabah SET id='$id', nama='$nama', jenis_kelamin= '$jenis_kelamin',tempat_lahir= '$tempat_lahir', tanggal_lahir= '$tanggal_lahir', alamat= '$alamat', agama= '$agama', pendidikan= '$pendidikan', status= '$status', pekerjaan= '$pekerjaan', no_hp= '$no_hp', ahli_waris= '$ahli_waris', alamat_ahli_waris= '$alamat_ahli_waris', username= '$username', password= '$password' WHERE id='$id_old'") or die(mysqli_error($conn));
            if (mysqli_num_rows($result) !== 0) {
                $_SESSION["success"] = "Data berhasil diupdate";
                header("Location: ./nasabahhome.php");
            } else {
                $_SESSION["error"] = "Data gagal diupdate";
                header("Location: ./nasabahhome.php");
            }
        } else {
            $result = mysqli_query($conn, "UPDATE nasabah SET id='$id', nama='$nama', jenis_kelamin= '$jenis_kelamin',tempat_lahir= '$tempat_lahir', tanggal_lahir= '$tanggal_lahir', alamat= '$alamat', agama= '$agama', pendidikan= '$pendidikan', status= '$status', pekerjaan= '$pekerjaan', no_hp= '$no_hp',  username= '$username' WHERE id='$id_old'") or die(mysqli_error($conn));
            if (mysqli_num_rows($result) !== 0) {
                $_SESSION["success"] = "Data berhasil diupdate";
                header("Location: ./nasabahhome.php");
            } else {
                $_SESSION["error"] = "Data gagal diupdate";
                header("Location: ./nasabahhome.php");
            }
        }
    } else {
        $_SESSION["error"] = "ID tidak ditemukan";
    }
} else {
    $_SESSION["error"] = "Isi form terlebih dahulu";
    header("Location: ./nasabahedit.php");
}
