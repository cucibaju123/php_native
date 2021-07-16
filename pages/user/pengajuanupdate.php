<?php
include "../../koneksi.php";
session_start();

if (isset($_GET["id"]) && isset($_POST["tambah_pengajuan_ulang"])) {
    $id = $_GET['id'];
    $tanggal_pengajuan = date('Y-m-d');
    $jangka_waktu = $_POST['jangka_waktu'];

    $find_result = mysqli_query($conn, "select * from pembiayaan where id = '$id'") or die(mysqli_error($conn));
    if (mysqli_num_rows($find_result) !== 0) {
        $result = mysqli_query($conn, "UPDATE pembiayaan SET admin_id=null, manager_id=null, jenis_akad=null, kegunaan=null, jaminan=null, total_pinjaman=null , nisbah_bmt=null, nisbah_nasabah=null, tanggal_pengajuan= '$tanggal_pengajuan', angsuran_per_bulan=null,  keuntungan_per_bulan=null, total_angsuran= 0, jangka_waktu = '$jangka_waktu', admin_approved=0, manager_approved=0 WHERE id='$id'") or die(mysqli_error($conn));
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
} else {
    $_SESSION["error"] = "Isi Form terlebih dahulu";
    header("Location: ./pengajuanhome.php");
}
