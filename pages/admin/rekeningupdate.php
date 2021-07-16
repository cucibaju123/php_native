<?php
session_start();
require_once "../../koneksi.php";

if (isset($_POST["update_nasabah"]) && isset($_GET["id"])) {
    $id_old = $_GET["id"];
    $id = $_POST['id'];
    $nasabah_id = $_POST['nasabah_id'];
    $admin_id = $_SESSION['id'];
    $jenis_product = $_POST['jenis_product'];
    $setoran_awal = $_POST['setoran_awal'];
    $tanggal_buka = $_POST['tanggal_buka'];

    $find_result = mysqli_query($conn, "select * from rekening where id = '$id_old'") or die(mysqli_error($conn));

    if (mysqli_num_rows($find_result) !== 0) {
        $result = mysqli_query($conn, "UPDATE rekening SET id='$id', nasabah_id='$nasabah_id', admin_id= '$admin_id', jenis_product= '$jenis_product', setoran_awal= '$setoran_awal', tanggal_buka= '$tanggal_buka' WHERE id='$id_old'") or die(mysqli_error($conn));
        if (mysqli_num_rows($result) !== 0) {
            $_SESSION["success"] = "Data berhasil diupdate";
            header("Location: ./rekeninghome.php");
        } else {
            $_SESSION["error"] = "Data gagal diupdate";
            header("Location: ./rekeninghome.php");
        }
    } else {
        $_SESSION["error"] = "ID tidak ditemukan";
    }
} else {
    $_SESSION["error"] = "Isi form terlebih dahulu";
    header("Location: ./rekeningedit.php");
}
