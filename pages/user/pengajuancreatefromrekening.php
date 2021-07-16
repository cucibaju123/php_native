<?php
session_start();
require_once "../../koneksi.php";

if (isset($_POST["tambah_pengajuan"])) {
    $rekening_id = $_POST["rekening_id"];
    $nasabah_id = $_POST["nasabah_id"];
    $tanggal_pengajuan = date('Y-m-d');
    $jangka_waktu = $_POST['jangka_waktu'];

    $result = mysqli_query($conn, "insert into pembiayaan (rekening_id, nasabah_id, tanggal_pengajuan, jangka_waktu) values('$rekening_id', '$nasabah_id', '$tanggal_pengajuan', '$jangka_waktu')") or die(mysqli_error($conn));

    if ($result) {
        $_SESSION["success"] = "Data berhasil ditambahkan";
        header("Location: ./rekeninghome.php");
    } else {
        $_SESSION["error"] = "Data gagal ditambahkan";
        header("Location: ./rekeninghome.php");
    }
} else {
    $_SESSION["error"] = "Isi form terlebih dahulu";
    header("Location: ./rekeninghome.php");
}
