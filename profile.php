<?php

session_start();

if (!isset($_SESSION['email'])) {
  header("location: auth/login.php");
}

require_once 'config.php';
$title = 'Catalog';
require_once 'template/header.php';
require_once 'template/navbar.php';

$id = $_SESSION['id_user'];

$getDataUser = mysqli_query($con, "SELECT * FROM tb_user WHERE id_user = $id");
$DataUser = mysqli_fetch_array($getDataUser);

if(isset($_POST['simpan'])){
  $namaLengkap = htmlspecialchars($_POST['nama']);
  $username = htmlspecialchars($_POST['username']);
  $email = $_POST['email'];
  $nohp = $_POST['nohp'];
  $alamat = htmlspecialchars($_POST['alamat']);

  $query = mysqli_query($con, "UPDATE tb_user SET 
                            nama_lengkap = '$namaLengkap',
                            username = '$username',
                            email = '$email',
                            noHP = $nohp,
                            alamat = '$alamat'
                            WHERE id_user = $id
                        ");
  
  if($query){
    echo "
      <script>
        alert('Berhasil Update Profile!');
        document.location.href = 'profile.php';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('Gagal Update Profile!');
        document.location.href = 'profile.php';
      </script>
    ";
  }
}

if(isset($_POST['upload'])){
  $namaFile = $_FILES['gambar']['name'];
  $ukuranFile = $_FILES['gambar']['size'];
  $error = $_FILES['gambar']['error'];
  $tmpName = $_FILES['gambar']['tmp_name'];

  // cek apakah yang diupload adalah gambar 
  $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
  $ekstensiGambar = explode('.', $namaFile);
  $ekstensiGambar = strtolower(end($ekstensiGambar));

  if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
      echo "
          <script>
              alert('Yang anda upload bukan gambar');
              document.location.href = 'profile.php';
          </script>
      ";
      die();
  }

  // cek jika ukurannya terlalu besar
  if ($ukuranFile > 1000000) {
    echo "
        <script>
            alert('ukuran gambar terlalu besar');
            document.location.href = 'profile.php';
        </script>
    ";
    die();
  }

  // lolos pengecekan gambar siap di upload
    // Generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'assets/image/' . $namaFileBaru);

    // query update foto
    $query = mysqli_query($con, "UPDATE tb_user SET foto = '$namaFileBaru' WHERE id_user = $id");

    if($query){
      echo "
        <script>
          alert('Berhasil Update Foto!');
          document.location.href = 'profile.php';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Gagal Update Foto!');
          document.location.href = 'profile.php';
        </script>
      ";
    }
}


?>

<section style="background-color: #eee;">
  <div class="container py-5">
    <div class="row">
      <div class="col">
        <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">User Profile</li>
          </ol>
        </nav>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="assets/image/<?= $DataUser['foto']; ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="my-3"><?= $DataUser['nama_lengkap']; ?></h5>
            <p class="text-muted mb-4">@<?= $DataUser['username']; ?></p>
            <div class="d-flex justify-content-center mb-2">
              <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="gambar" id="gambar" class="form-control form-control-sm mb-3" required>
                <button type="submit" name="upload" class="btn btn-sm btn-primary w-100">Ganti Foto</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Nama Lengkap</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?= $DataUser['nama_lengkap']; ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Username</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">@<?= $DataUser['username']; ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?= $DataUser['email']; ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">No HP</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?= $DataUser['noHP']; ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Alamat</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?= $DataUser['alamat']; ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Update Profile
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post">
        <div class="modal-body">
          <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" name="nama" required value="<?= $DataUser['nama_lengkap']; ?>">
          </div>
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required value="<?= $DataUser['username']; ?>">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required value="<?= $DataUser['email']; ?>">
          </div>
          <div class="mb-3">
            <label for="nohp" class="form-label">No HP</label>
            <input type="tel" class="form-control" id="nohp" name="nohp" required value="<?= $DataUser['noHP']; ?>">
          </div>
          <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?= $DataUser['alamat']; ?></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
require_once 'template/footer.php';
?>