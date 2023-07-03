<?php

session_start();
if (!isset($_SESSION['email'])) {
    header("location: auth/login.php");
}

require_once 'config.php';

$title = "Order";
require_once 'template/header.php';
require_once 'template/navbar.php';

$idUser = $_SESSION['id'];

?>

<div class="container mt-5">
    <h2>Ordered Product</h2>
    <table class="table table-striped table-hover mt-5">
        <thead>
            <tr>
                <th><center>No</center></th>
                <th><center>Gambar</center></th>
                <th><center>Kode_Pemesanan</center></th>
                <th><center>Nama Barang</center></th>
                <th><center>Qty</center></th>
                <th><center>Total Harga</center></th>
                <th><center>Status</center></th>
                <th><center>Cetak Invoice</center></th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            $dataPesan = mysqli_query($con, "SELECT tb_stock.Foto, tb_pemesanan.kd_pemesanan, tb_stock.Nama_Barang, tb_pemesanan.qty, tb_pemesanan.total, tb_pemesanan.status FROM tb_pemesanan, tb_stock WHERE id_user = $idUser and tb_pemesanan.Kd_Barang = tb_stock.Kd_Barang");
            while($data = mysqli_fetch_array($dataPesan)){
                if(mysqli_num_rows($dataPesan) > 0){ 
            ?>
                <tr>
                    <td><center><?= $no; ?></center></td>
                    <td><center><img src="admin/assets/images/stock/<?= $data['Foto']; ?>" alt="" width="100px"></center></td>
                    <td><center><?= $data['kd_pemesanan']; ?></center></td>
                    <td><center><?= $data['Nama_Barang']; ?></center></td>
                    <td><center><?= $data['qty']; ?></center></td>
                    <td><center>Rp <?= number_format($data['total'], 0, ',', '.') ?></center></td>
                    <?php 
                        if($data['status'] === 'Belum Bayar'){
                            $badge = 'bg-warning';
                        } elseif($data['status'] === 'Dibayar'){
                            $badge = 'bg-primary';
                        } else {
                            $badge = 'bg-success';
                        }
                    ?>
                    <td><center><span class="badge <?= $badge; ?>"><?= $data['status']; ?></span></center></td>
                    <td><center><a href="invoice/invoice.php?kode=<?= $data['kd_pemesanan']; ?>" class="btn btn-success <?= $data['status'] === 'Belum Bayar' ? 'disabled' : '' ?>"><i class="fa-solid fa-print fs-5"></i></a></center></td>
                </tr>
            <?php 
                } else {
            ?> 
                <tr>
                    <td><center>Anda belum memesan produk</center></td>
                </tr>
            <?php 
                }
            $no++;
            }
            ?>
        </tbody>
    </table>
</div>

<?php
require_once 'template/footer.php';
?>