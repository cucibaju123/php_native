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
$result = mysqli_query($conn, "select t.* ,n.nama from transaksi as t inner join nasabah as n on t.nasabah_id=n.id");
$data_transaksi = mysqli_fetch_all($result, MYSQLI_ASSOC);
if (mysqli_num_rows($result) == 0) {
    $_SESSION["error"] = "Data ditemukan";
    header("Location: ./manager/transaksihome.php");
}

?>

<html>

<head>
    <title>BMT Ash Shiddiq | Export Transaksi</title>
    <style>
        body {
            height: 842px;
            width: 725px;
            /* to centre page on screen*/
            margin-left: auto;
            margin-right: auto;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 5px;
        }
    </style>
</head>

<body style="padding: 40px 0px;">
    <center style="border-bottom: 5px solid #000;">
        <h2>BMT ASH-SHIDDIQ</h2>
        <p>Kalibata City Square Qioz SSG0507, Jl. Kalibata Raya 01 - Jakarta Selatan</p>
    </center>

    <hr>

    <br>
    <h3 style="margin-bottom: 1rem;">Laporan Transaksi BMT Ash-Shiddiq</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>No Pembiayaan</th>
                <th>Nasabah</th>
                <th>Tanggal Transaksi</th>
                <th>Debit</th>
                <th>Kredit</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data_transaksi as $transaksi) { ?>
                <tr>
                    <td>TR-<?php echo $transaksi["id"] ?></td>
                    <td>PMB-<?php echo $transaksi["pembiayaan_id"] ?></td>
                    <td><?php echo $transaksi["nama"] ?></td>
                    <td><?php echo $transaksi["tanggal_transaksi"] ?></td>
                    <td>Rp <?php echo number_format($transaksi["debit"], 0, ',', '.') ?? '00' ?>,00</td>
                    <td>Rp <?php echo number_format($transaksi["kredit"], 0, ',', '.') ?? '00' ?>,00</td>
                    <td><?php echo $transaksi["keterangan"] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <script>
        window.print();
    </script>
</body>

</html>