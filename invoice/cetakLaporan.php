<?php

//Mengaktifkan output buffering
ob_start();

require_once '../admin/function/function.php';

$dari = $_GET['dari'];
$ke = $_GET['ke'];

$dataLaporan = cetakLaporan($dari, $ke);

// pemasukan
$queryPemasukan = mysqli_query($con, "SELECT SUM(total) as 'JUMLAH' FROM tb_pemesanan WHERE tanggal BETWEEN '$dari' AND DATE_ADD('$ke', INTERVAL 1 DAY) AND status != 'Belum Bayar'");
$pemasukan = mysqli_fetch_array($queryPemasukan);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Cetak Laporan Periode <?= $dari; ?> - <?= $ke; ?></title>
</head>

<style>
    body {
        font-family: sans-serif;
    }
    .judul {
        text-align: center;
    }
    table{
        margin: 10px auto;
        width: 100%;
        border-collapse: collapse;
    }
    table, th, td{
        border: 1px solid #999;
        padding: 8px 20px;
        text-align: center;
    }
</style>

<body>

    <div class="judul">
        <h2>BO Printing</h2>
        <h4>LAPORAN PENJUALAN</h4>
        <h4>PERIODE <?= $dari; ?> - <?= $ke; ?></h4>
    </div>

    <table cellpadding="10">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Produk</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($dataLaporan as $data) : ?>
                <tr>
                    <td><?= $no; ?></td>
                    <td><?= $data['tanggal']; ?></td>
                    <td><?= $data['nama']; ?></td>
                    <td><?= $data['Nama_Barang']; ?></td>
                    <td><?= $data['qty']; ?></td>
                    <td>Rp <?= number_format($data['total'], 0, ',', '.') ?></td>
                </tr>
                <?php $no++; ?>
            <?php endforeach; ?>

            <tr>
                <th colspan="5">Total</th>
                <th>Rp <?=number_format($pemasukan['JUMLAH'], 0, ',', '.')?></th>
            </tr>
        </tbody>
    </table>

</body>

</html>

<?php

//Meload library mPDF
require 'mpdf/vendor/autoload.php';

// //Membuat inisialisasi objek mPDF
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4', 'margin_top' => 25, 'margin_bottom' => 25, 'margin_left' => 15, 'margin_right' => 15]);

// //Memasukkan output yang diambil dari output buffering ke variabel html
$html = ob_get_contents();

// //Menghapus isi output buffering
ob_end_clean();

$mpdf->WriteHTML(utf8_encode($html));

// //Membuat output file
$content = $mpdf->Output("Laporan_" . $dari . "-" . $ke . ".pdf", "D");

?>