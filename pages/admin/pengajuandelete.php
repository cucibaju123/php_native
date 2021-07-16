<?php
session_start();
require_once "../../koneksi.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $delete_result = mysqli_query($conn, "delete from pembiayaan where id = '$id'") or die(mysqli_error($conn));
    if ($delete_result) {
        $_SESSION["success"] = "Data berhasil dihapus";
        header("Location: ./pengajuanhome.php");
    }
} else {
    $_SESSION["error"] = "ID tidak ditemukan";
    header("Location: ./pengajuanhome.php");
}
