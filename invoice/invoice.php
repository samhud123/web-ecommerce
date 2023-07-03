<?php

//Mengaktifkan output buffering
ob_start();

require_once '../config.php';

$kodePemesanan = $_GET['kode'];

$data = mysqli_query($con, "SELECT tb_pemesanan.*, tb_stock.* FROM tb_pemesanan, tb_stock WHERE kd_pemesanan = '$kodePemesanan' AND tb_pemesanan.Kd_Barang = tb_stock.Kd_Barang");
$row = mysqli_fetch_array($data);

?>

<!DOCTYPE html>
<html>

<head>
	<title>Invoice_<?= $row['kd_pemesanan']; ?></title>
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>

<style>
	.invoice-title h2,
	.invoice-title h3 {
		display: inline-block;
	}

	.table>tbody>tr>.no-line {
		border-top: none;
	}

	.table>thead>tr>.no-line {
		border-bottom: none;
	}

	.table>tbody>tr>.thick-line {
		border-top: 2px solid;
	}
</style>

<body>
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="invoice-title">
					<h2>Invoice</h2>
					<h3 class="pull-right">Order # <?= $row['kd_pemesanan']; ?></h3>
				</div>
				<hr>
				<div class="row">
					<div class="col-xs-6">
						<address>
							<strong>Dikirim Dari:</strong><br>
							BO Printing<br>
							<?= $row['alamat']; ?><br>
						</address>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6">
						<address>
							<strong>Kirim Ke:</strong><br>
							<?= $row['nama']; ?><br>
							<?= $row['alamat']; ?><br>
						</address>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6">
						<address>
							<strong>Tanggal Pemesanan:</strong><br>
							<?= $row['tanggal']; ?><br>
						</address>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6">
						<address>
							<strong>Status:</strong><br>
							Dibayar<br>
						</address>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><strong>Rincian Pesanan</strong></h3>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-condensed">
								<thead>
									<tr>
										<td><b>Nama Barang</b></td>
										<td class="text-center"><b>Harga</b></td>
										<td class="text-center"><b>Qty</b></td>
										<td class="text-right"><b>Total</b></td>
									</tr>
								</thead>
								<tbody>
									<!-- foreach ($order->lineItems as $line) or some such thing here -->
									<tr>
										<td><?= $row['Nama_Barang']; ?></td>
										<td class="text-center">Rp <?= number_format($row['Harga'], 0, ',', '.') ?></td>
										<td class="text-center"><?= $row['qty'] ?></td>
										<td class="text-right">Rp <?= number_format($row['total'], 0, ',', '.') ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>

<?php

//Meload library mPDF
require 'mpdf/vendor/autoload.php';

//Membuat inisialisasi objek mPDF
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4','margin_top' => 25, 'margin_bottom' => 25, 'margin_left' => 25, 'margin_right' => 25]);

//Memasukkan output yang diambil dari output buffering ke variabel html
$html = ob_get_contents();
   
//Menghapus isi output buffering
ob_end_clean();

$mpdf->WriteHTML(utf8_encode($html));

//Membuat output file
$content = $mpdf->Output("Invoice_" . $row['kd_pemesanan'] . ".pdf", "D");

?>