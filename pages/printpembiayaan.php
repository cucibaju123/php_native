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

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $result = mysqli_query($conn, "select p.*, n.nama as nama_nasabah from pembiayaan as p inner join nasabah as n on p.nasabah_id=n.id where p.id ='$id'");
    $pembiayaan = mysqli_fetch_assoc($result);
    $result_transaksi = mysqli_query($conn, "select t.tanggal_transaksi, p.id as pembiayaan_id from transaksi as t inner join pembiayaan as p on t.pembiayaan_id=p.id where t.keterangan='Pembiayaan Mudharabah' and p.id='$id'");
    $transaksi = mysqli_fetch_assoc($result_transaksi);
    if (mysqli_num_rows($result) == 0) {
        $_SESSION["error"] = "ID Tidak ditemukan";
        header("Location: ./manager/pembiayaanhome.php");
    }

?>

    <html>

    <head>
        <title>BMT Ash Shiddiq | Print Pembiayaan</title>
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
        <h3 style="margin-bottom: 1rem;">Laporan Pembiayaan PMB-<?php echo $pembiayaan['id'] ?></h3>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ID Pembiayaan</td>
                    <td>PMB-<?php echo $pembiayaan["id"] ?></td>
                </tr>
                <tr>
                    <td>No Rekening</td>
                    <td><?php echo $pembiayaan["rekening_id"] ?></td>
                </tr>
                <tr>
                    <td>Atas Nama</td>
                    <td><?php echo $pembiayaan["nama_nasabah"] ?></td>
                </tr>
                <tr>
                    <td>Jenis Akad</td>
                    <td><?php echo $pembiayaan["jenis_akad"] ?></td>
                </tr>
                <tr>
                    <td>Kegunaan</td>
                    <td><?php echo $pembiayaan["kegunaan"] ?></td>
                </tr>
                <tr>
                    <td>Jaminan</td>
                    <td><?php echo $pembiayaan["jaminan"] ?></td>
                </tr>
                <tr>
                    <td>Nisbah BMT</td>
                    <td><?php echo $pembiayaan["nisbah_bmt"] ?>%</td>
                </tr>
                <tr>
                    <td>Nisbah Nasabah</td>
                    <td><?php echo $pembiayaan["nisbah_nasabah"] ?>%</td>
                </tr>
                <tr>
                    <td>Tanggal Pengajuan</td>
                    <td><?php echo $pembiayaan["tanggal_pengajuan"] ?></td>
                </tr>
                <tr>
                    <td>Tanggal Disetujui</td>
                    <td><?php echo $transaksi["tanggal_transaksi"] ?></td>
                </tr>
                <tr>
                    <td>Jangka Waktu</td>
                    <td><?php echo $pembiayaan["jangka_waktu"] ?> bulan</td>
                </tr>
                <tr>
                    <td>Total Pinjaman</td>
                    <td>Rp <?php echo number_format($pembiayaan["total_pinjaman"], 0, ',', '.') ?? '00' ?>,00</td>
                </tr>
                <tr>
                    <td>Angsuran Per Bulan</td>
                    <td>Rp <?php echo number_format($pembiayaan["angsuran_per_bulan"], 0, ',', '.') ?? '00' ?>,00</td>
                </tr>
                <tr>
                    <td>Total Angsuran</td>
                    <td>Rp <?php echo number_format($pembiayaan["total_angsuran"], 0, ',', '.') ?? '00' ?>,00</td>
                </tr>
                <tr>
                    <td>Pendapatan BMT</td>
                    <td>Rp <?php echo number_format($pembiayaan["pendapatan_bmt"], 0, ',', '.') ?? '00' ?>,00</td>
                </tr>
                <tr>
                    <td>Pendapatan Nasabah</td>
                    <td>Rp <?php echo number_format($pembiayaan["pendapatan_nasabah"], 0, ',', '.') ?? '00' ?>,00</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <?php if ($pembiayaan["total_angsuran"] >= $pembiayaan["total_pinjaman"]) { ?>
                        <td>Lunas</td>
                    <?php } else { ?>
                        <td>Belum Lunas</td>
                    <?php } ?>
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
    header("Location: ./manager/pembiayaanhome.php");
} ?>