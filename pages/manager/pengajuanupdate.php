<?php
include "../../koneksi.php";
session_start();

if ($_GET["id"] && isset($_POST["manager_approved"])) {
    $id = $_GET["id"];
    $manager_approved = $_POST["manager_approved"];
    $manager_id = $_SESSION["id"];

    $find_result = mysqli_query($conn, "select * from pembiayaan where id = '$id'") or die(mysqli_error($conn));
    $pembiayaan = mysqli_fetch_assoc($find_result);
    if (mysqli_num_rows($find_result) !== 0) {
        $result = mysqli_query($conn, "UPDATE pembiayaan SET manager_id= '$manager_id', manager_approved= '$manager_approved' WHERE id='$id'") or die(mysqli_error($conn));
        if (mysqli_num_rows($result) !== 0) {
            $_SESSION["success"] = "Data berhasil diupdate";
            header("Location: ./pengajuanhome.php");
        } else {
            $_SESSION["error"] = "Data gagal diupdate";
            header("Location: ./pengajuanhome.php");
        }
    } else {
        $_SESSION["error"] = "Data tidak ditemukan";
        header("Location: ./pengajuanhome.php");
    }
}
