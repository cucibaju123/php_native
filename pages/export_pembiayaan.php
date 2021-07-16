<?php
session_start();
include "../koneksi.php";
// =================RESTRIKSI==================================
if (!isset($_SESSION["logged"]) && !isset($_SESSION["manager"])) {
    $_SESSION["error"] = "Login terlebih dahulu";
    header("Location: ./auth/login.php");
}
if (isset($_SESSION["logged"]) && !isset($_SESSION["manager"])) {
    $_SESSION["error"] = "Anda bukan manager";
    header("Location: ./dashboard.php");
}
// =================RESTRIKSI==================================

$result = mysqli_query($conn, "select p.*, n.nama as nama_nasabah, t.tanggal_transaksi from pembiayaan as p inner join nasabah as n on p.nasabah_id=n.id inner join transaksi as t on p.id=t.pembiayaan_id where t.keterangan='Pembiayaan Mudharabah'");
$data_pembiayaan = mysqli_fetch_all($result, MYSQLI_ASSOC);
// $result_transaksi = mysqli_query($conn, "select t.tanggal_transaksi, p.id as pembiayaan_id from transaksi as t inner join pembiayaan as p on t.pembiayaan_id=p.id where t.keterangan='Pembiayaan Mudharabah' and p.id='$id'");
// $transaksi = mysqli_fetch_assoc($result_transaksi);
if (mysqli_num_rows($result) == 0) {
    $_SESSION["error"] = "Data Tidak ditemukan";
    header("Location: ./manager/pembiayaanhome.php");
}

?>

<html>

<head>
    <title>BMT Ash Shiddiq | Export Pembiayaan</title>
    <style>
        /* body {
            height: 842px;
            width: 725px;
            margin-left: auto;
            margin-right: auto;
        } */

        table {
            border-collapse: collapse;
            width: 100%;
        }

        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 5px;
        }
    </style>
</head>

<body style="padding: 40px 130px;">
    <center style="border-bottom: 5px solid #000;">
        <h2>BMT ASH-SHIDDIQ</h2>
        <p>Kalibata City Square Qioz SSG0507, Jl. Kalibata Raya 01 - Jakarta Selatan</p>
    </center>

    <hr>

    <br>
    <h3 style="margin-bottom: 1rem;">Laporan Pembiayaan BMT Ash-Shiddiq</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nasabah</th>
                <th>Kegunaan</th>
                <th>Jaminan</th>
                <th>Tanggal Disetujui</th>
                <th>Jangka Waktu</th>
                <th>Total Pinjaman</th>
                <th>Angsuran/bln</th>
                <th>Pendapatan BMT</th>
                <th>Pendapatan Nasabah</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data_pembiayaan as $pembiayaan) { ?>
                <tr>
                    <td>PMB-<?php echo $pembiayaan["id"] ?></td>
                    <td><?php echo $pembiayaan["nama_nasabah"] ?></td>
                    <td><?php echo $pembiayaan["kegunaan"] ?></td>
                    <td><?php echo $pembiayaan["jaminan"] ?></td>
                    <td><?php echo $pembiayaan["tanggal_transaksi"] ?></td>
                    <td><?php echo $pembiayaan["jangka_waktu"] ?> bln</td>
                    <td>Rp <?php echo number_format($pembiayaan["total_pinjaman"], 0, ',', '.') ?? '00' ?>,00</td>
                    <td>Rp <?php echo number_format($pembiayaan["angsuran_per_bulan"], 0, ',', '.') ?? '00' ?>,00</td>
                    <td>Rp <?php echo number_format($pembiayaan["pendapatan_bmt"], 0, ',', '.') ?? '00' ?>,00</td>
                    <td>Rp <?php echo number_format($pembiayaan["pendapatan_nasabah"], 0, ',', '.') ?? '00' ?>,00</td>
                    <?php if ($pembiayaan["total_angsuran"] >= $pembiayaan["total_pinjaman"]) { ?>
                        <td>Lunas</td>
                    <?php } else { ?>
                        <td>Belum Lunas</td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <script>
        window.print();
    </script>
</body>


</html>