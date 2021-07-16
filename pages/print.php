<?php
session_start();
include "../koneksi.php";
// =================RESTRIKSI==================================
if (!isset($_SESSION["logged"])) {
    $_SESSION["error"] = "Login terlebih dahulu";
    header("Location: ./auth/login.php");
}

// =================RESTRIKSI==================================

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $result = mysqli_query($conn, "select t.*, n.nama as nama_nasabah from transaksi as t inner join nasabah as n on t.nasabah_id=n.id where t.id ='$id'");
    $transaksi = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) == 0) {
        $_SESSION["error"] = "ID Tidak ditemukan";
        if (isset($_SESSION["user"])) {
            header("Location: ./user/transaksihome.php");
        } else if (isset($_SESSION["admin"])) {
            header("Location: ./admin/transaksihome.php");
        } else {
            header("Location: ./manager/transaksihome.php");
        }
    }

?>

    <html>

    <head>
        <title>BMT Ash Shiddiq | Print Transaksi</title>
        <style>
            body {
                height: 842px;
                width: 595px;
                /* to centre page on screen*/
                margin-left: auto;
                margin-right: auto;
            }

            table {
                border-collapse: collapse;
                width: 100%;
            }

            td {
                border: 1px solid black;
            }

            th,
            td {
                padding: 10px;
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
        <h3 style="margin-bottom: 1rem;">Slip Transaksi TR-<?php echo $transaksi['id'] ?></h3>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ID Transaksi</td>
                    <td>TR-<?php echo $transaksi["id"] ?></td>
                </tr>
                <tr>
                    <td>ID Pembiayaan</td>
                    <td>PMB-<?php echo $transaksi["pembiayaan_id"] ?></td>
                </tr>
                <tr>
                    <td>Nama Nasabah</td>
                    <td><?php echo $transaksi["nama_nasabah"] ?></td>
                </tr>
                <tr>
                    <td>Tanggal Transaksi</td>
                    <td><?php echo $transaksi["tanggal_transaksi"] ?></td>
                </tr>
                <tr>
                    <td>Debit</td>
                    <td>Rp <?php echo number_format($transaksi["debit"], 0, ',', '.') ?? '00' ?>,00</td>
                </tr>
                <tr>
                    <td>Kredit</td>
                    <td>Rp <?php echo number_format($transaksi["kredit"], 0, ',', '.') ?? '00' ?>,00</td>
                </tr>
                <tr>
                    <td>Keterangan</td>
                    <td><?php echo $transaksi["keterangan"] ?></td>
                </tr>
            </tbody>
        </table>

        <script>
            window.print();
        </script>

    </body>

    </html>
<?php } else {
    $_SESSION["error"] = "ID tidak ditemukan";
    if (isset($_SESSION["user"])) {
        header("Location: ./user/transaksihome.php");
    } else if (isset($_SESSION["admin"])) {
        header("Location: ./admin/transaksihome.php");
    } else {
        header("Location: ./manager/transaksihome.php");
    }
} ?>