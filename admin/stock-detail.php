<?php

session_start();
if (!isset($_SESSION['login'])) {
    header("location: auth/login.php");
    exit();
}

require_once 'function/function.php';

$title = 'Stock';
require_once 'template/header.php';
require_once 'template/sidebar.php';

$Kd_Barang = $_GET['p'];

$queryStock = mysqli_query($con, "SELECT * FROM tb_stock WHERE Kd_Barang = $Kd_Barang");
$dataStock = mysqli_fetch_array($queryStock);

// cek apakah tombol update di tekan
if (isset($_POST['update'])) {
    // cek apakah data berhasil disimpan atau tidak
    if (updateStock($_POST) > 0) {
        header("Location: stock-detail.php?p=" . $Kd_Barang);
    } else {
        echo "
            <script>
                alert('data gagal diubah');
                document.location.href = 'stock.php';
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
                    <h3>Detail Data Stock</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="stock.php">Stock</a></li>
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
                <img src="assets/images/stock/<?= $dataStock['Foto']; ?>" alt="Foto Produk" width="300px" class="mb-3">
                <h5 class="card-title"><?= $dataStock['Nama_Barang']; ?></h5>
                <p class="card-text"><?= $dataStock['Deskripsi']; ?></p>
                <div class="col-md-6 col-12" style="margin: 1px auto;">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Nama Barang</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="Nama_Barang" class="form-control" name="Nama_Barang" value="<?= $dataStock['Nama_Barang'] ?>" disabled>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Jenis Barang</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="email" id="Jenis_Barang" class="form-control" name="Jenis_Barang" value="<?= $dataStock['Jenis_Barang'] ?>" disabled>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Stock</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="number" id="Stock" class="form-control" name="Stock" value="<?= $dataStock['Stock'] ?>" disabled>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Satuan</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="Satuan" class="form-control" name="Satuan" value="<?= $dataStock['Satuan'] ?>" disabled>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Harga</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="number" id="Harga" class="form-control" name="Harga" value="<?= $dataStock['Harga'] ?>" disabled>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Deskripsi</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled><?= $dataStock['Deskripsi'] ?></textarea>
                                            </div>
                                            <div class="col-sm-12 d-flex justify-content-center mt-4">
                                                <button type="button" class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                    <i class="bi bi-pencil-square"></i> Update
                                                </button>
                                                <a href="stock.php" class="btn btn-info"><i class="bi bi-arrow-left-circle"></i> Kembali</a>
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
                2 days ago
            </div>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Stock</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" name="Kd_Barang" value="<?= $dataStock['Kd_Barang']; ?>">
                            <input type="hidden" name="gambarLama" value="<?= $dataStock['Foto']; ?>">
                            <div class="mb-3">
                                <label for="Nama_Barang" class="form-label">Nama_Barang</label>
                                <input type="text" class="form-control" name="Nama_Barang" id="Nama_Barang" required value="<?= $dataStock['Nama_Barang']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="Jenis_Barang" class="form-label">Jenis_Barang</label>
                                <input type="text" class="form-control" name="Jenis_Barang" id="Jenis_Barang" required value="<?= $dataStock['Jenis_Barang']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="Stock" class="form-label">Stock</label>
                                <input type="number" class="form-control" name="stock" id="Stock" required value="<?= $dataStock['Stock']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="Satuan" class="form-label">Satuan</label>
                                <select name="satuan" id="satuan" class="form-select" required>
                                    <?php 
                                    $satuan = ['Meter', 'Lembar', 'Pcs', 'Pack'];
                                    foreach($satuan as $row){
                                        if($row == $dataStock['Satuan']){
                                    ?>
                                            <option value="<?= $row ?>"><?= $row; ?></option>
                                    <?php 
                                        } else {
                                    ?>
                                            <option value="<?= $row ?>"><?= $row ?></option>
                                    <?php 
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="Harga" class="form-label">Harga</label>
                                <input type="number" class="form-control" name="Harga" id="Harga" required value="<?= $dataStock['Harga']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="Foto" class="form-label">Foto</label>
                                <input type="file" class="form-control" name="gambar" id="gambar">
                            </div>
                            <div class="mb-3">
                                <label for="Deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="Deskripsi" name="Deskripsi" rows="3"><?= $dataStock['Deskripsi']; ?></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="update" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php
        require_once 'template/footer.php';
        ?>