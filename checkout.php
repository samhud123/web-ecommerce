<?php

session_start();
if (!isset($_SESSION['email'])) {
    header("location: auth/login.php");
}

require_once 'config.php';
$title = "Checkout";
require_once 'template/header.php';
require_once 'template/navbar.php';

$kdBarang = $_GET['c'];
$getData = mysqli_query($con, "SELECT * FROM tb_stock WHERE Kd_Barang = $kdBarang");
$data = mysqli_fetch_array($getData);

$id = $_SESSION['id_user'];
$getDataUser = mysqli_query($con, "SELECT * FROM tb_user WHERE id_user = $id");
$dataUser = mysqli_fetch_array($getDataUser);

if(isset($_POST['simpan'])){
    $idUser = $_SESSION['id'];
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $nohp = $_POST['nohp'];
    $qty = $_POST['jmlBarang'];
    $alamat = htmlspecialchars($_POST['alamat']);

    $permitted_chars = '0123456789';
    $kdPemesanan = substr(str_shuffle($permitted_chars), 0, 5);
    $kode = 'BO-' . $kdPemesanan;

    $total = $qty * $data['Harga'];
    
    // query input pemesanan
    $insertPemesanan = mysqli_query($con, "INSERT INTO tb_pemesanan 
                                            (kd_pemesanan, id_user, kd_barang, nama, email, nohp, qty, alamat, total ) 
                                                VALUES 
                                            ( '$kode', $idUser, $kdBarang, '$nama', '$email', $nohp, $qty, '$alamat', $total)
                                        ");

    if($insertPemesanan){
        $stockAkhir = $data['Stock'] - $qty;
        mysqli_query($con, "UPDATE tb_stock SET Stock = $stockAkhir WHERE Kd_Barang = $kdBarang");
        header('location: pembayaran.php');
    } else {
        echo '
            <script>
                alert("Gagal memesan produk!");
            </script>
        ';
    }
}

?>

<div class="container mt-5">
    <h2 class="mb-4">Checkout</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Data Pemesanan</h5>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama anda" required value="<?= $dataUser['nama_lengkap']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email anda" required value="<?= $dataUser['email']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="nohp" class="form-label">No. HP / WA</label>
                            <input type="number" class="form-control" id="nohp" name="nohp" placeholder="Masukkan nohp anda" required value="<?= $dataUser['noHP']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="jmlBarang" class="form-label">Jumlah Barang</label>
                            <input type="number" class="form-control" id="jmlBarang" name="jmlBarang" placeholder="Masukkan jumlah barang" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?= $dataUser['alamat']; ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" name="simpan">Bayar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Data Barang</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>foto</th>
                                <th>Nama</th>
                                <th style="width: 15%;"><center>Qty</center></th>
                                <th style="width: 30%;"><center>Total</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <input type="hidden" name="harga" id="harga" value="<?= $data['Harga']; ?>">
                                <td>1</td>
                                <td><img src="<?= $mainUrlAdmin; ?>admin/assets/images/stock/<?= $data['Foto']; ?>" alt="" width="70px"></td>
                                <td><?= $data['Nama_Barang']; ?></td>
                                <td>
                                    <center id="qty"></center>
                                </td>
                                <td>
                                    <center id="total"></center>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const jmlBarang = document.getElementById('jmlBarang');
    const total = document.getElementById('total');
    const harga = document.getElementById('harga');
    const qty = document.getElementById('qty');

    jmlBarang.addEventListener('keyup', function(){
        qty.innerHTML = jmlBarang.value;

        let totalHarga = parseInt(jmlBarang.value) * parseInt(harga.value);

        let rupiahFormat = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
        }).format(totalHarga);
        total.innerHTML = rupiahFormat;
    })
</script>

<?php
require_once 'template/footer.php';
?>