<?php

session_start();
if (!isset($_SESSION['email'])) {
    header("location: auth/login.php");
}

require_once 'config.php';

$title = "Pembayaran";
require_once 'template/header.php';
require_once 'template/navbar.php';

?>

<div class="container mt-5">
    <h2>Pembayaran</h2>
    <div class="card mt-4">
        <div class="card-header text-center">
            Pilih Pembayaran
        </div>
        <div class="card-body d-flex justify-content-center">
            <div class="row">
                <div class="col px-5">
                    <img src="assets/image/bri.png" alt="" width="100px">
                    <p class="mt-2 fs-5">7632-01-007520-53-0</p>
                </div>
                <div class="col px-5">
                    <img src="assets/image/dana.png" alt="" width="200px">
                    <p class="mt-2 fs-5">085648597435</p>
                </div>
                <div class="col px-5">
                    <img src="assets/image/ovo.png" alt="" width="70px">
                    <p class="mt-2 fs-5">085648597435</p>
                </div>
                <div class="col px-5">
                    <img src="assets/image/link-aja.png" alt="" width="100px">
                    <p class="mt-2 fs-5">085648597435</p>
                </div>
            </div>
        </div>
        <div class="card-footer fs-6">
            Cara Pembayaran :
            <div>
                <ol type="1">
                    <li>Siapkan uang pembayaran</li>
                    <li>Kirim ke salah satu e-wallet di atas</li>
                    <li>Kirim bukti pembayar ke no. WA <span class="fw-bold"><a href="https://wa.me/6285648597435
" target="_blank"><i class="fa-brands fa-whatsapp"></i> 085648597435</a></span></li>
                    <li>Tunggu pembayar Anda untuk dikonfirmasi</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'template/footer.php';
?>