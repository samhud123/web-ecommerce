<?php

session_start();
if (!isset($_SESSION['login'])) {
    header("location: auth/login.php");
    exit();
}

require_once 'function/function.php';

$title = 'Laporan';
require_once 'template/header.php';
require_once 'template/sidebar.php';

$dataPemesanan = mysqli_query($con, "SELECT tb_pemesanan.*, tb_stock.Nama_Barang FROM tb_pemesanan, tb_stock WHERE tb_pemesanan.Kd_Barang = tb_stock.Kd_Barang AND status = 'Selesai'");

if(isset($_POST['filter'])){
    $dataPemesanan = cariTanggal($_POST);
}

if(isset($_POST['cetak'])){
    $dari = $_POST['dari'];
    $ke = $_POST['ke'];

    if($dari == null && $ke == null){
        echo "
            <script>
                alert('Silahkan isi periode waktu terlebih dahulu!');
                window.location.href = 'laporan.php';
            </script>
        ";
    } else {
        header("location: ../invoice/cetakLaporan.php?dari=" . $dari . '&ke=' . $ke);
    }
}

?>

<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last mb-4">
                    <h3>Laporan</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Laporan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card text-center">
                        <div class="card-header bg-primary py-2">
                            <h6 class="text-white mt-1">Laporan Keuangan</h6>
                        </div>
                        <div class="card-body pt-3 rounded-bottom" style="background-color: #468bfa;">
                            <h6 class="mb-3 text-white">Januari - Desember</h6>
                            <div class="col-md-4" style="margin: 0px auto;">
                                <div class="stats-icon green" style="width: 80px; height: 80px;">
                                    <img src="assets/images/logo/uang.png" alt="" width="60px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card text-center">
                        <div class="card-header bg-primary py-2">
                            <h6 class="text-white mt-1">Laporan Data Stock</h5>
                        </div>
                        <div class="card-body pt-3 rounded-bottom" style="background-color: #468bfa;">
                            <h6 class="mb-3 text-white">Januari - Desember</h6>
                            <div class="col-md-4" style="margin: 0px auto;">
                                <div class="stats-icon green" style="width: 80px; height: 80px;">
                                    <img src="assets/images/logo/toko.png" alt="" width="60px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card text-center">
                        <div class="card-header bg-primary py-2">
                            <h6 class="text-white mt-1">Laporan Penjualan</h6>
                        </div>
                        <div class="card-body pt-3 rounded-bottom" style="background-color: #468bfa;">
                            <h6 class="mb-3 text-white">Januari - Desember</h6>
                            <div class="col-md-4" style="margin: 0px auto;">
                                <div class="stats-icon green" style="width: 80px; height: 80px;">
                                    <img src="assets/images/logo/chart.png" alt="" width="60px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" id="table-striped">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-3">Laporan Penjualan</h4>
                            <form action="" method="post">
                                <div class="row g-3 align-items-center">
                                    <div class="col-auto">
                                        <label class="col-form-label">Periode</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="date" class="form-control" name="dari" >
                                    </div>
                                    <div class="col-auto">
                                        -
                                    </div>
                                    <div class="col-auto">
                                        <input type="date" class="form-control" name="ke" >
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn btn-primary" name="filter" type="submit"><i class="fa-solid fa-magnifying-glass"></i> Cari</button>
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn btn-success" name="cetak" type="submit"><i class="fa-solid fa-print"></i> Cetak</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-content">
                            <!-- table striped -->
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
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
                                        <?php foreach($dataPemesanan as $data) : ?>
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
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php
    require_once 'template/footer.php';
    ?>