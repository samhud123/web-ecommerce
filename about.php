<?php

require_once 'config.php';
$title = 'About';
require_once 'template/header.php';
require_once 'template/navbar.php';

?>

<!-- header -->
<div class="card bg-dark" style="height: 85vh; margin-top: -10px;">
  <img src="assets/image/banner.jpg" class="card-img" height="100%" style="opacity: 0.2;">
  <div class="card-img-overlay d-flex align-items-center text-white justify-content-center">
    <div class="d-block text-center w-75">
        <h1 class="card-title" style="font-size: 70px;">Tentang Kami</h1>
        <p class="card-text fs-4">Percetakan Berkualitas, Hasil Memukau! Transformasikan Impianmu, Cetak Realitimu! Anda berhak mendapatkan kualitas terbaik</p>
    </div>
  </div>
</div>

<div class="container my-5">
  <div class="row">
    <div class="col-md-8">
      <label class="fs-5 fw-bold">Toko Percetakan</label>
      <h1 class="fs-1 fw-bold text-primary mb-3">BO Printing</h1>
      <p>Toko Percetakan BO Printing adalah sebuah usaha bersama yang dijalankan oleh beberapa orang di bawah naungan dari LPK Inasaba. Toko ini bergerak di bidang penjualan dan jasa percetakan seperti sablon, mmt, stiker, gantungan kunci, papper bag, undangan, dan lain sebagainya.</p>
      <a href="catalog.php" class="btn btn-primary text-decoration-none">Order Sekarang <i class="fa-solid fa-circle-arrow-right"></i></a>
    </div>
    <div class="col-md-4 d-flex justify-content-center">
      <img src="assets/image/brand.jpeg" alt="brand" width="300px">
    </div>
  </div>
</div>

<?php
require_once 'template/footer.php';
?>