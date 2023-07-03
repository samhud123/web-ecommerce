<?php

// Connect Database
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'pemesanan';

$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// function tambah stock barang
function tambahStock($data)
{
    global $con;

    $namaBarang = htmlspecialchars($data['Nama_Barang']);
    $jenisBarang = htmlspecialchars($data['Jenis_Barang']);
    $stock = $data['stock'];
    $harga = htmlspecialchars($data['Harga']);
    $satuan = htmlspecialchars($data['satuan']);
    $deskripsi = htmlspecialchars($data['Deskripsi']);

    // upload foto
    $foto = upload();

    if (!$foto) {
        return false;
    }

    // query insert data
    $query = mysqli_query($con, "INSERT INTO tb_stock VALUES ('', '$namaBarang', '$jenisBarang', '$stock', '$satuan', $harga, '$deskripsi', '$foto')");

    return mysqli_affected_rows($con);
}

// function upload gambar
function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        echo "
            <script>
                alert('Pilih gambar terlebih dahulu');
            </script>
        ";
        return false;
    }

    // cek apakah yang diupload adalah gambar 
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "
            <script>
                alert('Yang anda upload bukan gambar');
            </script>
        ";
        return false;
    }

    // cek jika ukurannya terlalu besar
    if ($ukuranFile > 1000000) {
        echo "
            <script>
                alert('ukuran gambar terlalu besar');
            </script>
        ";
        return false;
    }

    // lolos pengecekan gambar siap di upload
    // Generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'assets/images/stock/' . $namaFileBaru);

    return $namaFileBaru;
}

// function update stock 
function updateStock($data)
{
    global $con;

    $kdBarang = $data['Kd_Barang'];
    $namaBarang = htmlspecialchars($data['Nama_Barang']);
    $jenisBarang = htmlspecialchars($data['Jenis_Barang']);
    $stock = $data['stock'];
    $satuan = htmlspecialchars($data['satuan']);
    $harga = htmlspecialchars($data['Harga']);
    $deskripsi = htmlspecialchars($data['Deskripsi']);
    $gambarLama = htmlspecialchars($data['gambarLama']);

    // cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    // query insert data
    $query = "UPDATE tb_stock SET 
                Nama_Barang = '$namaBarang',
                Jenis_Barang = '$jenisBarang',
                Stock = $stock,
                Satuan = '$satuan',
                Harga = $harga,
                Deskripsi = '$deskripsi',
                Foto = '$gambar'
                WHERE Kd_Barang = $kdBarang
            ";

    mysqli_query($con, $query);

    return mysqli_affected_rows($con);
}

// function hapus data stock
function deleteStock($kdBarang, $foto)
{
    global $con;
    mysqli_query($con, "DELETE FROM tb_stock WHERE Kd_Barang = $kdBarang");

    unlink('assets/images/stock/' . $foto);

    return mysqli_affected_rows($con);
}

// function untuk konfirmasi pesanan
function konfirmasi($data){
    global $con;

    $kodePemesanan = $data['kodePemesanan'];

    // Update status
    $updateStatus = mysqli_query($con, "UPDATE tb_pemesanan SET status='Dibayar' WHERE kd_pemesanan = '$kodePemesanan'");
}

function cariTanggal($data){
    global $con;

    $dari = $data['dari'];
    $ke = $data['ke'];

    if($dari != null && $ke != null){
        $query = mysqli_query($con, "SELECT tb_pemesanan.*, tb_stock.Nama_Barang FROM tb_pemesanan, tb_stock WHERE tanggal BETWEEN '$dari' AND DATE_ADD('$ke', INTERVAL 1 DAY) AND tb_pemesanan.Kd_Barang = tb_stock.Kd_Barang AND status = 'Selesai'");
    } else {
        $query = mysqli_query($con, "SELECT tb_pemesanan.*, tb_stock.Nama_Barang FROM tb_pemesanan, tb_stock WHERE tb_pemesanan.Kd_Barang = tb_stock.Kd_Barang AND status = 'Selesai'");
    }

    return $query;
}

function cetakLaporan($dari, $ke) {
    global $con;

    $query = mysqli_query($con, "SELECT tb_pemesanan.*, tb_stock.Nama_Barang FROM tb_pemesanan, tb_stock WHERE tanggal BETWEEN '$dari' AND DATE_ADD('$ke', INTERVAL 1 DAY) AND tb_pemesanan.Kd_Barang = tb_stock.Kd_Barang AND status = 'Selesai'");

    return $query;
}
