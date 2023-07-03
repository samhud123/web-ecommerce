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

$kodePemesanan = $_GET['kode'];

$detailPemesanan = mysqli_query($con, "SELECT tb_pemesanan.*, tb_stock.* FROM tb_pemesanan, tb_stock WHERE tb_pemesanan.Kd_Barang = tb_stock.Kd_Barang AND kd_pemesanan = '$kodePemesanan'");
$data = mysqli_fetch_array($detailPemesanan);

if(isset($_POST['konfirmasi'])){
    $updateStatus = mysqli_query($con, "UPDATE tb_pemesanan SET status='Dibayar' WHERE kd_pemesanan = '$kodePemesanan'");

    if($updateStatus){
        echo "
            <script>
                alert('Konfirmasi Pesanan Berhasil!');
                window.location.href = 'pemesanan.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Konfirmasi Pesanan Gagal!');
                window.location.href = 'detail-pemesanan.php';
            </script>
        ";
    }
}

if(isset($_POST['selesai'])){
    $updateStatus = mysqli_query($con, "UPDATE tb_pemesanan SET status='Selesai' WHERE kd_pemesanan = '$kodePemesanan'");

    if($updateStatus){
        echo "
            <script>
                alert('Konfirmasi Pesanan Berhasil!');
                window.location.href = 'pemesanan.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Konfirmasi Pesanan Gagal!');
                window.location.href = 'detail-pemesanan.php';
            </script>
        ";
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
                <div class="col-12 col-md-6 order-md-1 order-last mb-3">
                    <h3>Detail Data Pemesanan</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="pemesanan.php">Data Pemesanan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detail</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="card text-center">
            <div class="card-header">
                Detail
            </div>
            <div class="card-body">
                <img src="assets/images/stock/<?= $data['Foto']; ?>" alt="Foto Produk" width="300px" class="mb-3">
                <h5 class="card-title"><?= $data['Nama_Barang']; ?></h5>
                <p class="card-text"><?= $data['Deskripsi']; ?></p>
                <div class="col-md-6 col-12" style="margin: 1px auto;">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal" action="" method="post">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Nama Pemesan</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="nama" class="form-control" name="nama" value="<?= $data['nama'] ?>" disabled>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Kode Pemesanan</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="kodePemesanan" name="kodePemesanan" class="form-control" value="<?= $data['kd_pemesanan'] ?>" disabled>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="email" id="email" class="form-control" name="email" value="<?= $data['email'] ?>" disabled>
                                            </div>
                                            <div class="col-md-4">
                                                <label>No. HP</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="number" id="noHP" class="form-control" name="noHP" value="<?= $data['nohp'] ?>" disabled>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Qty</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="number" id="qty" class="form-control" name="qty" value="<?= $data['qty'] ?>" disabled>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Total</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="total" class="form-control" name="total" value="<?= 'Rp ' . number_format($data['total'], 0, ',', '.') ?>" disabled>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Alamat</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" disabled><?= $data['alamat'] ?></textarea>
                                            </div>
                                            <div class="d-flex justify-content-center mt-4">
                                                <form action="" method="post">
                                                    <button type="submit" class="btn btn-primary" <?php if($data['status'] !== 'Belum Bayar') echo 'disabled'; ?> onclick="return confirm('Apakah Anda yakin konfirmasi pesanan ini?');" name="konfirmasi"><i class="fa-regular fa-circle-check"></i> Konfirmasi Pesanan</button>
                                                </form>
                                            </div>
                                            <div class="d-flex justify-content-center mt-4">
                                                <form action="" method="post">
                                                    <button class="btn btn-success" <?php if($data['status'] !== 'Dibayar') echo 'disabled'; ?> onclick="return confirm('Apakah Anda yakin?');" name="selesai"><i class="fa-regular fa-circle-check"></i> Pesanan Selesai</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                <?= $data['tanggal'] ?>
            </div>
        </div>

<?php 
require_once 'template/footer.php';
?>