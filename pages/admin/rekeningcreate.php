<?php
session_start();
require_once "../../koneksi.php";

if (isset($_POST["tambah_rekening"])) {
    $id = $_POST['id'];
    $nasabah_id = $_POST['nasabah_id'];
    $admin_id = $_SESSION['id'];
    $jenis_product = $_POST['jenis_product'];
    $setoran_awal = $_POST['setoran_awal'];
    $tanggal_buka = $_POST['tanggal_buka'];

    $result = mysqli_query($conn, "insert into rekening (id, nasabah_id, admin_id, jenis_product, setoran_awal, tanggal_buka) values('$id', '$nasabah_id', '$admin_id', '$jenis_product', '$setoran_awal', '$tanggal_buka')") or die(mysqli_error($conn));

    if ($result) {
        $_SESSION["success"] = "Data berhasil ditambahkan";
        header("Location: ./rekeninghome.php");
    } else {
        $_SESSION["error"] = "Data gagal ditambahkan";
        header("Location: ./rekeningadd.php");
    }
} else {
    $_SESSION["error"] = "Isi form terlebih dahulu";
    header("Location: ./rekeningadd.php");
}
