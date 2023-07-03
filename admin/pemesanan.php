<?php

session_start();
if (!isset($_SESSION['login'])) {
    header("location: auth/login.php");
    exit();
}

require_once 'function/function.php';

$title = 'Pemesanan';
require_once 'template/header.php';
require_once 'template/sidebar.php';

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
                    <h3>Kelola Data Pemesanan</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Pemesanan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Pemesanan Masuk</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama</th>
                                <th>Pesanan</th>
                                <th>Total Bayar</th>
                                <th>Status</th>
                                <th>Detail</th>
                                <th>Invoice</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            $dataPemesanan = mysqli_query($con, "SELECT tb_pemesanan.*, tb_stock.Nama_Barang from tb_pemesanan, tb_stock WHERE tb_pemesanan.Kd_Barang = tb_stock.Kd_Barang ORDER BY tanggal DESC");
                            while($data = mysqli_fetch_array($dataPemesanan)){
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $data['tanggal']; ?></td>
                                    <td><?= $data['nama']; ?></td>
                                    <td><?= $data['Nama_Barang']; ?></td>
                                    <td>Rp <?= number_format($data['total'], 0, ',', '.') ?></td>
                                    <?php 
                                    if($data['status'] === 'Belum Bayar'){
                                        $badge = 'bg-warning';
                                    } elseif($data['status'] === 'Dibayar'){
                                        $badge = 'bg-primary';
                                    } else {
                                        $badge = 'bg-success';
                                    }
                                    ?>
                                    <td>
                                        <span class="badge <?= $badge; ?>"><?= $data['status']; ?></span>
                                    </td>
                                    <td>
                                        <a href="detail-pemesanan.php?kode=<?= $data['kd_pemesanan'] ?>" title="Detail Pemesanan" class="btn btn-sm btn-primary"><i class="bi bi-eye-fill fs-6"></i></a>
                                    </td>
                                    <td>
                                        <a href="../invoice/invoice.php?kode=<?= $data['kd_pemesanan']; ?>" class="btn btn-info border-0  <?php if($data['status'] == 'Belum Bayar') echo 'disabled'; ?>"><i class="fa-solid fa-file-invoice"></i></a>
                                    </td>
                                </tr>
                            <?php 
                            $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>

    <?php
    require_once 'template/footer.php';
    ?>