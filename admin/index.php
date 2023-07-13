<?php

session_start();
if (!isset($_SESSION['login'])) {
    header("location: auth/login.php");
    exit();
}

require_once 'function/function.php';

$title = 'Dashboard';
require_once 'template/header.php';
require_once 'template/sidebar.php';

// Pesanan Masuk
$queryPesananMasuk = mysqli_query($con, "SELECT * FROM tb_pemesanan");
$pesananMasuk = mysqli_num_rows($queryPesananMasuk);

// Pesanan Selesai 
$querPesananSelesai = mysqli_query($con, "SELECT * FROM tb_pemesanan WHERE status='Selesai'");
$pesananSelesai = mysqli_num_rows($querPesananSelesai);

// pemasukan
$queryPemasukan = mysqli_query($con, "SELECT SUM(total) as 'JUMLAH' FROM tb_pemesanan WHERE status != 'Belum Bayar'");
$pemasukan = mysqli_fetch_array($queryPemasukan);

?>

<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3>Statistik Toko</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-9">
                <div class="row">
                    <div class="col-6 col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon purple">
                                            <i class="fa-solid fa-right-to-bracket text-white fs-3"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Pesanan Masuk</h6>
                                        <h6 class="font-extrabold mb-0"><?= $pesananMasuk; ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="fa-solid fa-circle-check text-white fs-3"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Pesanan Selesai</h6>
                                        <h6 class="font-extrabold mb-0"><?= $pesananSelesai; ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon green">
                                            <i class="fa-solid fa-hand-holding-dollar text-white fs-3"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Pemasukan</h6>
                                        <h6 class="font-extrabold mb-0">Rp <?= number_format($pemasukan['JUMLAH'], 0, ',', '.') ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Pesanan Terbaru</h4>
                            </div>
                            <div class="card-content pb-4">
                                <?php
                                $pesananTerbaru = mysqli_query($con, "SELECT tb_pemesanan.nama, tb_pemesanan.kd_pemesanan, tb_user.username FROM tb_pemesanan, tb_user WHERE tb_pemesanan.id_user = tb_user.id_user AND tb_pemesanan.status != 'Selesai' ORDER BY tb_pemesanan.tanggal DESC LIMIT 5");
                                while ($terbaru = mysqli_fetch_array($pesananTerbaru)) {
                                ?>
                                    <div class="recent-message d-flex px-4 py-3">
                                        <div class="avatar avatar-lg">
                                            <img src="assets/images/faces/user.png">
                                        </div>
                                        <div class="name ms-4">
                                            <h5 class="mb-1"><?= $terbaru['nama']; ?></h5>
                                            <h6 class="text-muted mb-0">@<?= $terbaru['username']; ?></h6>
                                        </div>
                                        <div class="ms-auto">
                                            <label for="">Lihat Detail <i class="fa-solid fa-arrow-right"></i> </label>
                                            <a href="detail-pemesanan.php?kode=<?= $terbaru['kd_pemesanan']; ?>" class="btn btn-sm btn-primary"><i class="fa-solid fa-eye"></i></a>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="card-body py-4 px-5">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-xl">
                                <img src="assets/images/faces/face.png" alt="Face 1">
                            </div>
                            <div class="ms-3 name">
                                <h5 class="font-bold"><?= $_SESSION['login']; ?></h5>
                                <h6 class="text-muted mb-0">@<?= $_SESSION['user']; ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Produk Terlaris</h4>
                    </div>
                    <div class="card-content pb-4">
                        <?php
                        $produkTerlaris = mysqli_query($con, "SELECT DISTINCT(tb_pemesanan.Kd_Barang) AS kode, COUNT(tb_pemesanan.Kd_Barang) AS kodeBarang, tb_stock.Nama_Barang, tb_stock.foto FROM tb_pemesanan, tb_stock WHERE tb_pemesanan.Kd_Barang = tb_stock.Kd_Barang GROUP BY kode LIMIT 3");
                        while ($terlaris = mysqli_fetch_array($produkTerlaris)) {
                        ?>
                            <div class="recent-message d-flex px-4 py-3">
                                <div class="avatar avatar-lg">
                                    <img src="assets/images/stock/<?= $terlaris['foto']; ?>">
                                </div>
                                <div class="name ms-4">
                                    <h5 class="mb-1"><?= $terlaris['Nama_Barang']; ?></h5>
                                    <h6 class="text-muted mb-0">Total : <?= $terlaris['kodeBarang']; ?></h6>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <?php
    require_once 'template/footer.php';
    ?>