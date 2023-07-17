<?php

session_start();

require_once 'config.php';
$title = 'Catalog';
require_once 'template/header.php';
require_once 'template/navbar.php';

?>

<!-- Catalog -->
<div class="container mt-5" id="catalog">
    <h2 class="text-center mb-4"><?= isset($_GET['search']) == true ? 'Hasil Pencarian ' : 'All Catalog' ?></h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
        if(isset($_GET['search'])){
            $cari = $_GET['search'];
            $getData = mysqli_query($con, "SELECT * FROM tb_stock WHERE Nama_Barang LIKE '%$cari%' OR Jenis_Barang LIKE '%$cari%'");
            if(mysqli_num_rows($getData) > 0) {
                while ($data = mysqli_fetch_array($getData)) {
        
        ?>
                <div class="col text-center">
                    <div class="card h-100">
                        <img src="admin/assets/images/stock/<?= $data['Foto']; ?>" class="card-img-top" alt="..." height="280px">
                        <div class="card-body">
                            <h5 class="card-title"><?= $data['Nama_Barang']; ?></h5>
                            <p class="fs-5 fw-bold">Rp <?= number_format($data['Harga'], 0, ',', '.') ?></p>
                            <p class="card-text">Stock Tersedia : <b><?= $data['Stock']; ?></b></p>
                            <p class="card-text"><?= $data['Deskripsi']; ?></p>
                            <a href="checkout.php?c=<?= $data['Kd_Barang']; ?>" class="btn btn-primary"><i class="fa-solid fa-cart-shopping"></i> Order Sekarang</a>
                        </div>
                    </div>
                </div>
        <?php    
                }
            } else {
        ?>
            <div class="text-center w-100">Data Tidak Ada</div>
        <?php 
            }
        } else {
            $allData = mysqli_query($con, "SELECT * FROM tb_stock");
            foreach($allData as $data){
        ?>
                <div class="col text-center">
                    <div class="card h-100">
                        <img src="admin/assets/images/stock/<?= $data['Foto']; ?>" class="card-img-top" alt="..." height="280px">
                        <div class="card-body">
                            <h5 class="card-title"><?= $data['Nama_Barang']; ?></h5>
                            <p class="fs-5 fw-bold">Rp <?= number_format($data['Harga'], 0, ',', '.') ?></p>
                            <p class="card-text">Stock Tersedia : <b><?= $data['Stock']; ?></b></p>
                            <p class="card-text"><?= $data['Deskripsi']; ?></p>
                            <a href="checkout.php?c=<?= $data['Kd_Barang']; ?>" class="btn btn-primary"><i class="fa-solid fa-cart-shopping"></i> Order Sekarang</a>
                        </div>
                    </div>
                </div>
        <?php 
            }
        }
        ?>
    </div>
</div>

<?php
require_once 'template/footer.php';
?>