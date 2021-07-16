<?php
include "../../koneksi.php";
session_start();

if ($_GET["id"] && isset($_POST["input_pendapatan"])) {
    $id = $_GET["id"];
    $pendapatan_bmt = $_POST["pendapatan_bmt"];
    $pendapatan_nasabah = $_POST["pendapatan_nasabah"];

    $find_result = mysqli_query($conn, "select * from pembiayaan where id = '$id'") or die(mysqli_error($conn));
    $pembiayaan = mysqli_fetch_assoc($find_result);
    if (mysqli_num_rows($find_result) !== 0) {
        $result = mysqli_query($conn, "update pembiayaan set pendapatan_bmt= '$pendapatan_bmt', pendapatan_nasabah= '$pendapatan_nasabah' WHERE id='$id'") or die(mysqli_error($conn));
        if (mysqli_num_rows($result) !== 0) {
            $pembiayaan_id = $pembiayaan["id"];
            $nasabah_id = $pembiayaan["nasabah_id"];
            $tanggal_transaksi = date('Y-m-d');
            mysqli_query($conn, "insert into transaksi (pembiayaan_id, nasabah_id, tanggal_transaksi, debit, kredit, keterangan) values('$pembiayaan_id', '$nasabah_id', '$tanggal_transaksi', '$pendapatan_bmt', 0, 'Pendapatan BMT')") or die(mysqli_error($conn));
            mysqli_query($conn, "insert into transaksi (pembiayaan_id, nasabah_id, tanggal_transaksi, debit, kredit, keterangan) values('$pembiayaan_id', '$nasabah_id', '$tanggal_transaksi', 0, '$pendapatan_nasabah', 'Pendapatan Nasabah')") or die(mysqli_error($conn));
            $_SESSION["success"] = "Data berhasil diupdate";
            header("Location: ./pembiayaanhome.php");
        } else {
            $_SESSION["error"] = "Data gagal diupdate";
            header("Location: ./pembiayaanhome.php");
        }
    } else {
        $_SESSION["error"] = "Data tidak ditemukan";
        header("Location: ./pembiayaanhome.php");
    }
} else {
    $_SESSION["error"] = "ID tidak ditemukan";
    header("Location: ./pembiayaanhome.php");
}
