<?php

session_start();
if (!isset($_SESSION['login'])) {
    header("location: auth/login.php");
    exit();
}

require_once 'function/function.php';

// cek apakah tombol simpan di tekan
if (isset($_POST['simpan'])) {
    // cek apakah data berhasil disimpan atau tidak
    if (tambahStock($_POST) > 0) {
        echo "
            <script>
                alert('data berhasil ditambahkan');
                document.location.href = 'stock.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal ditambahkan');
                document.location.href = 'stock.php';
            </script>
        ";
    }
}

$title = 'Stock';
require_once 'template/header.php';
require_once 'template/sidebar.php';


// Menghitung total Barang
$tbStock = mysqli_query($con, "SELECT * FROM tb_stock");
$totalBarang = mysqli_num_rows($tbStock);

// Barang tersedia
$queryBarangTersedia = mysqli_query($con, "SELECT * FROM tb_stock WHERE Stock != 0");
$barangTersedia = mysqli_num_rows($queryBarangTersedia);

// Barang habis
$queryBarangHabis = mysqli_query($con, "SELECT * FROM tb_stock WHERE Stock = 0");
$barangHabis = mysqli_num_rows($queryBarangHabis);

// jumlah user admin
$queryAdmin = mysqli_query($con, "SELECT * FROM tb_admin");
$totalAdmin = mysqli_num_rows($queryAdmin);

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
                    <h3>Kelola Data Stock</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Stock</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-8">
                                <h4 class="font-extrabold mb-0"><?= $totalBarang; ?></h4>
                                <h6 class="text-muted font-semibold">Total Barang</h6>
                            </div>
                            <div class="col-md-4">
                                <div class="stats-icon purple">
                                    <i class="fa-solid fa-folder-open text-white fs-5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-8">
                                <h4 class="font-extrabold mb-0"><?= $barangTersedia; ?></h4>
                                <h6 class="text-muted font-semibold">Barang Tersedia</h6>
                            </div>
                            <div class="col-md-4">
                                <div class="stats-icon blue">
                                    <i class="fa-solid fa-right-from-bracket text-white fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-8">
                                <h4 class="font-extrabold mb-0"><?= $barangHabis; ?></h4>
                                <h6 class="text-muted font-semibold">Barang Habis</h6>
                            </div>
                            <div class="col-md-4">
                                <div class="stats-icon green">
                                    <i class="fa-solid fa-right-from-bracket fa-rotate-180 text-white fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-8">
                                <h4 class="font-extrabold mb-0"><?= $totalAdmin; ?></h4>
                                <h6 class="text-muted font-semibold">User Admin</h6>
                            </div>
                            <div class="col-md-4">
                                <div class="stats-icon red">
                                    <i class="fa-solid fa-users text-white fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <i class="bi bi-plus-circle"></i> Tambah Barang
            </button>

        </div>

        <div class="row" id="table-striped">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Stock Barang</h4>
                    </div>
                    <div class="card-content">
                        <!-- table striped -->
                        <div class="table-responsive">
                            <table class="table table-striped mb-0"  id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Jenis Barang</th>
                                        <th>Stock</th>
                                        <th>Satuan</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $queryStock = mysqli_query($con, "SELECT * FROM tb_stock");
                                    while ($data = mysqli_fetch_array($queryStock)) {
                                    ?>
                                        <tr>
                                            <td class="text-bold-500"><?= $no; ?></td>
                                            <td><?= $data['Nama_Barang']; ?></td>
                                            <td><?= $data['Jenis_Barang']; ?></td>
                                            <td><?= $data['Stock']; ?></td>
                                            <td><?= $data['Satuan']; ?></td>
                                            <td>
                                                <a href="stock-detail.php?p=<?= $data['Kd_Barang']; ?>" title="Detail Stock" class="btn btn-sm btn-primary"><i class="bi bi-eye-fill fs-6"></i></a>
                                                <a href="delete.php?p=<?= $data['Kd_Barang']; ?>&foto=<?= $data['Foto']; ?>" title="Hapus Stock" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');"><i class="bi bi-trash-fill fs-6"></i></a>
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
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Stock Barang</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="Nama_Barang" class="form-label">Nama_Barang</label>
                                <input type="text" class="form-control" name="Nama_Barang" id="Nama_Barang" required>
                            </div>
                            <div class="mb-3">
                                <label for="Jenis_Barang" class="form-label">Jenis_Barang</label>
                                <input type="text" class="form-control" name="Jenis_Barang" id="Jenis_Barang" required>
                            </div>
                            <div class="mb-3">
                                <label for="Stock" class="form-label">Stock</label>
                                <input type="number" class="form-control" name="stock" id="Stock" required>
                            </div>
                            <div class="mb-3">
                                <label for="Satuan" class="form-label">Satuan</label>
                                <select name="satuan" id="satuan" class="form-select" required>
                                    <option value="" selected>-- Pilih Satuan --</option>
                                    <option value="Meter">Meter</option>
                                    <option value="Lembar">Lembar</option>
                                    <option value="Pcs">Pcs</option>
                                    <option value="Pack">Pack</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="Harga" class="form-label">Harga</label>
                                <input type="number" class="form-control" name="Harga" id="Harga" required>
                            </div>
                            <div class="mb-3">
                                <label for="Foto" class="form-label">Foto</label>
                                <input type="file" class="form-control" name="gambar" id="gambar" required>
                            </div>
                            <div class="mb-3">
                                <label for="Deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="Deskripsi" name="Deskripsi" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php
        require_once 'template/footer.php';
        ?>