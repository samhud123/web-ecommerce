<?php

session_start();

require_once 'config.php';
$title = 'BO Printing';
require_once 'template/header.php';
require_once 'template/navbar.php';

?>

<!-- header -->
<div class="card bg-dark" style="height: 85vh; margin-top: -10px;">
  <img src="assets/image/banner.jpg" class="card-img" height="100%" style="opacity: 0.2;">
  <div class="card-img-overlay d-flex align-items-center text-white justify-content-center">
    <div class="d-block text-center w-75">
        <h1 class="card-title" style="font-size: 70px;">BO Printing</h1>
        <p class="card-text fs-4">Percetakan Berkualitas, Hasil Memukau! Transformasikan Impianmu, Cetak Realitimu! Anda berhak mendapatkan kualitas terbaik</p>
        <a href="#catalog" class="btn btn-primary">Lihat Catalog <i class="fa-solid fa-eye"></i></a>
    </div>
  </div>
</div>

<!-- Alasan memilih kami -->
<div class="container mt-5">
    <h2 class="text-center mb-4">Kenapa Memilih Kami?</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col text-center text-white">
            <div class="card-body bg-primary rounded-4 p-4">
                <i class="fa-solid fa-truck-fast fs-1 mb-3"></i>
                <h5 class="card-title">Pengiriman Cepat</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
        </div>
        <div class="col text-center text-white">
            <div class="card-body bg-primary rounded-4 p-4">
                <i class="fa-solid fa-medal fs-1 mb-3"></i>
                <h5 class="card-title">Kualitas Terbaik</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
        </div>
        <div class="col text-center text-white">
            <div class="card-body bg-primary rounded-4 p-4">
                <i class="fa-solid fa-money-bill-1-wave fs-1 mb-3"></i>
                <h5 class="card-title">Harga Terjangkau</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
        </div>
    </div>
</div>

<!-- Catalog -->
<div class="container mt-5" id="catalog">
    <h2 class="text-center mb-4">Catalog</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
        $queryStockData = mysqli_query($con, "SELECT * FROM tb_stock WHERE Stock != 0 LIMIT 6");
        while ($stockData = mysqli_fetch_array($queryStockData)) {
        ?>
            <div class="col text-center">
                <div class="card h-100">
                    <img src="admin/assets/images/stock/<?= $stockData['Foto']; ?>" class="card-img-top" alt="..." height="280px">
                    <div class="card-body">
                        <h5 class="card-title"><?= $stockData['Nama_Barang']; ?></h5>
                        <p class="fs-5 fw-bold">Rp <?= number_format($stockData['Harga'], 0, ',', '.') ?></p>
                        <p class="card-text">Stock Tersedia : <b><?= $stockData['Stock']; ?></b></p>
                        <p class="card-text"><?= $stockData['Deskripsi']; ?></p>
                        <a href="checkout.php?c=<?= $stockData['Kd_Barang']; ?>" class="btn btn-primary"><i class="fa-solid fa-cart-shopping"></i> Order Sekarang</a>
                    </div>
                </div>
            </div>
        <?php
        }

        $allData = mysqli_query($con, "SELECT * FROM tb_stock");
        if(mysqli_num_rows($allData) > 6){
        
        ?>
            <div class="text-center w-100 mt-5">
                <a href="catalog.php" class="text-decoration-none fs-5">Lihat Semua <i class="fa-solid fa-circle-arrow-right"></i></a>
            </div>
        <?php 
        }
        ?>
    </div>
</div>
<?php
require_once 'template/footer.php';
?>