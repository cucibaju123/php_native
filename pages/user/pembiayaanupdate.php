<?php
include "../../koneksi.php";
session_start();

if (isset($_GET["id"]) && isset($_POST["bayar_angsuran"])) {
    $id = $_GET['id'];

    $find_result = mysqli_query($conn, "select * from pembiayaan where id = '$id'") or die(mysqli_error($conn));
    $pembiayaan = mysqli_fetch_assoc($find_result);
    if (mysqli_num_rows($find_result) !== 0) {
        $bayar_angsuran = $pembiayaan["total_angsuran"] + $_POST['bayar_angsuran_input'];
        $keuntungan_per_bulan = $_POST["keuntungan_per_bulan"];
        $pendapatan_bmt = $pembiayaan["pendapatan_bmt"] + ($keuntungan_per_bulan * 0.6);
        $pendapatan_nasabah = $pembiayaan["pendapatan_nasabah"] + ($keuntungan_per_bulan * 0.4);
        $result = mysqli_query($conn, "UPDATE pembiayaan SET total_angsuran='$bayar_angsuran', pendapatan_bmt='$pendapatan_bmt', pendapatan_nasabah='$pendapatan_nasabah' WHERE id='$id'") or die(mysqli_error($conn));
        if (mysqli_num_rows($result) !== 0) {
            $pembiayaan_id = $pembiayaan["id"];
            $nasabah_id = $pembiayaan["nasabah_id"];
            $tanggal_transaksi = date('Y-m-d');
            $transaksi_pendapatan_bmt = $keuntungan_per_bulan * 0.6;
            $transaksi_pendapatan_nasabah = $keuntungan_per_bulan * 0.4;
            mysqli_query($conn, "insert into transaksi (pembiayaan_id, nasabah_id, tanggal_transaksi, debit, kredit, keterangan) values('$pembiayaan_id', '$nasabah_id', '$tanggal_transaksi', {$_POST['bayar_angsuran_input']}, 0, 'Angsuran Mudharabah')") or die(mysqli_error($conn));
            mysqli_query($conn, "insert into transaksi (pembiayaan_id, nasabah_id, tanggal_transaksi, debit, kredit, keterangan) values('$pembiayaan_id', '$nasabah_id', '$tanggal_transaksi', {$transaksi_pendapatan_bmt}, 0, 'Pendapatan BMT')") or die(mysqli_error($conn));
            mysqli_query($conn, "insert into transaksi (pembiayaan_id, nasabah_id, tanggal_transaksi, debit, kredit, keterangan) values('$pembiayaan_id', '$nasabah_id', '$tanggal_transaksi', 0, {$transaksi_pendapatan_nasabah}, 'Pendapatan Nasabah')") or die(mysqli_error($conn));
            $_SESSION["success"] = "Pembayaran Berhasil";
            header("Location: ./pembiayaanhome.php");
        } else {
            $_SESSION["error"] = "Pembayaran Gagal";
            header("Location: ./pembiayaanhome.php");
        }
    } else {
        $_SESSION["error"] = "ID Tidak ditemukan";
        header("Location: ./pembiayaanhome.php");
    }
} else {
    $_SESSION["error"] = "Isi Form terlebih dahulu";
    header("Location: ./pembiayaanhome.php");
}
