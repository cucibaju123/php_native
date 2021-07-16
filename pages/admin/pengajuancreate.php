<?php
session_start();
require_once "../../koneksi.php";

if (isset($_POST["tambah_pengajuan"])) {
    $rekening_id = explode('-', $_POST["rekening_id"])[0];
    $nasabah_id = explode('-', $_POST["rekening_id"])[1];
    $jenis_akad = $_POST['jenis_akad'];
    $kegunaan = $_POST['kegunaan'];
    $jaminan = $_POST['jaminan'];
    $total_pinjaman = $_POST['total_pinjaman'];
    $nisbah_bmt = $_POST['nisbah_bmt'];
    $nisbah_nasabah = $_POST['nisbah_nasabah'];
    $tanggal_pengajuan = $_POST['tanggal_pengajuan'];
    $angsuran_per_bulan = $_POST["angsuran_per_bulan"];
    $total_angsuran = $_POST['total_angsuran'];
    $jangka_waktu = $_POST['jangka_waktu'];

    $result = mysqli_query($conn, "insert into pembiayaan (rekening_id, nasabah_id, jenis_akad, kegunaan, jaminan, total_pinjaman, nisbah_bmt, nisbah_nasabah, tanggal_pengajuan, angsuran_per_bulan, total_angsuran, jangka_waktu) values('$rekening_id', '$nasabah_id', '$jenis_akad', '$kegunaan', '$jaminan', '$total_pinjaman', '$nisbah_bmt', '$nisbah_nasabah', '$tanggal_pengajuan', '$angsuran_per_bulan', 0, '$jangka_waktu')") or die(mysqli_error($conn));

    if ($result) {
        $_SESSION["success"] = "Data berhasil ditambahkan";
        header("Location: ./pengajuanhome.php");
    } else {
        $_SESSION["error"] = "Data gagal ditambahkan";
        header("Location: ./pengajuanhome.php");
    }
} else {
    $_SESSION["error"] = "Isi form terlebih dahulu";
    header("Location: ./pengajuanhome.php");
}
