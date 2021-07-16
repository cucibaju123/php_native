<?php
session_start();
require_once "../../koneksi.php";

if (isset($_POST["tambah_nasabah"])) {
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

    $result = mysqli_query($conn, "insert into nasabah (id, nama, jenis_kelamin, tempat_lahir, tanggal_lahir, alamat, agama, pendidikan, status, pekerjaan, no_hp, ahli_waris, alamat_ahli_waris, username, password) values('$id', '$nama', '$jenis_kelamin', '$tempat_lahir', '$tanggal_lahir', '$alamat', '$agama', '$pendidikan', '$status', '$pekerjaan', '$no_hp', '$ahli_waris', '$alamat_ahli_waris', '$username', '$password')") or die(mysqli_error($conn));

    if ($result) {
        $_SESSION["success"] = "Data nasabah berhasil ditambahkan";
        header("Location: ./nasabahhome.php");
    } else {
        $_SESSION["error"] = "Data gagal ditambahkan";
        header("Location: ./nasabahadd.php");
    }
} else {
    $_SESSION["error"] = "Isi form terlebih dahulu";
    header("Location: ./nasabahadd.php");
}
