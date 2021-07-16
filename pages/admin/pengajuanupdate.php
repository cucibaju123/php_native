<?php
include "../../koneksi.php";
session_start();

if (isset($_GET["id"]) && isset($_POST["update_pengajuan"])) {
    $id = $_GET['id'];
    $jenis_akad = $_POST['jenis_akad'];
    $kegunaan = $_POST['kegunaan'];
    $jaminan = $_POST['jaminan'];
    $total_pinjaman = $_POST['total_pinjaman'];
    $nisbah_bmt = $_POST['nisbah_bmt'];
    $nisbah_nasabah = $_POST['nisbah_nasabah'];
    $tanggal_pengajuan = $_POST['tanggal_pengajuan'];
    $angsuran_per_bulan = $_POST["angsuran_per_bulan"];
    $jangka_waktu = $_POST['jangka_waktu'];

    $find_result = mysqli_query($conn, "select * from pembiayaan where id = '$id'") or die(mysqli_error($conn));
    if (mysqli_num_rows($find_result) !== 0) {
        $result = mysqli_query($conn, "UPDATE pembiayaan SET jenis_akad= '$jenis_akad', kegunaan= '$kegunaan', jaminan= '$jaminan', total_pinjaman= '$total_pinjaman', nisbah_bmt= '$nisbah_bmt', nisbah_nasabah= '$nisbah_nasabah', tanggal_pengajuan= '$tanggal_pengajuan', angsuran_per_bulan= '$angsuran_per_bulan', total_angsuran= 0, jangka_waktu = '$jangka_waktu' WHERE id='$id'") or die(mysqli_error($conn));
        if (mysqli_num_rows($result) !== 0) {
            $_SESSION["success"] = "Data berhasil diupdate";
            header("Location: ./pengajuanhome.php");
        } else {
            $_SESSION["error"] = "Data gagal diupdate";
            header("Location: ./pengajuanhome.php");
        }
    } else {
        $_SESSION["error"] = "Isi Form terlebih dahulu";
        header("Location: ./pengajuanhome.php");
    }
} else if ($_GET["id"] && isset($_POST["admin_approved"])) {
    $id = $_GET["id"];
    $admin_approved = $_POST["admin_approved"];
    $admin_id = $_SESSION["id"];

    $find_result = mysqli_query($conn, "select * from pembiayaan where id = '$id'") or die(mysqli_error($conn));
    $pembiayaan = mysqli_fetch_assoc($find_result);
    if (mysqli_num_rows($find_result) !== 0) {
        $result = mysqli_query($conn, "update pembiayaan set admin_id= '$admin_id', admin_approved= '$admin_approved' WHERE id='$id'") or die(mysqli_error($conn));
        if (mysqli_num_rows($result) !== 0) {
            if ($admin_approved == 1) {
                $pembiayaan_id = $pembiayaan["id"];
                $nasabah_id = $pembiayaan["nasabah_id"];
                $tanggal_transaksi = date('Y-m-d');
                $total_pinjaman = $pembiayaan["total_pinjaman"];
                $create_transaksi = mysqli_query($conn, "insert into transaksi (pembiayaan_id, nasabah_id, tanggal_transaksi, debit, kredit, keterangan) values('$pembiayaan_id', '$nasabah_id', '$tanggal_transaksi', 0, '$total_pinjaman', 'Pembiayaan Mudharabah')") or die(mysqli_error($conn));
                $_SESSION["success"] = "Data berhasil diupdate";
                header("Location: ./pengajuanhome.php");
            } else {
                $_SESSION["success"] = "Data berhasil diupdate";
                header("Location: ./pengajuanhome.php");
            }
        } else {
            $_SESSION["error"] = "Data gagal diupdate";
            header("Location: ./pengajuanhome.php");
        }
    } else {
        $_SESSION["error"] = "Data tidak ditemukan";
        header("Location: ./pengajuanhome.php");
    }
} else {
    $_SESSION["error"] = "ID tidak ditemukan";
    header("Location: ./pengajuanhome.php");
}
