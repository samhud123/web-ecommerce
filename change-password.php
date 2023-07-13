<?php

session_start();

if (!isset($_SESSION['email'])) {
  header("location: auth/login.php");
}

require_once 'config.php';
$title = 'Ubah Password';
require_once 'template/header.php';
require_once 'template/navbar.php';

$id = $_SESSION['id_user'];

$getDataUser = mysqli_query($con, "SELECT * FROM tb_user WHERE id_user = $id");
$DataUser = mysqli_fetch_array($getDataUser);

if(isset($_POST['changePassword'])){
    $passLama = $_POST['passwordLama'];
    $passBaru = mysqli_real_escape_string($con, $_POST['passwordBaru']);
    $konfPass = mysqli_real_escape_string($con, $_POST['konfirmasiPassword']);

    // validasi password lama
    if( password_verify($passLama, $DataUser['password']) ){
        // validasi password baru dengan konfirmasi password
        if( $passBaru == $konfPass ){
            // enkripsi password
            $passBaru = password_hash($passBaru, PASSWORD_DEFAULT);

            // ubah password ke database
            $change = mysqli_query($con, "UPDATE tb_user SET password = '$passBaru' WHERE id_user = $id");

            if($change){
                echo "
                    <script>
                        alert('Berhasil Ubah Password! Silahkan login Kembali!');
                        document.location.href = 'auth/logout.php';
                    </script>
                ";
                die();
            }
        } else {
            echo "
                <script>
                    alert('Konfirmasi password tidak sesuai!');
                    document.location.href = 'change-password.php';
                </script>
            ";
            die();
        }
    } else {
        echo "
            <script>
                alert('Password lama tidak sesuai!');
                document.location.href = 'change-password.php';
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
            <li class="breadcrumb-item active" aria-current="page">Ganti Password</li>
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
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <form action="" method="post">
                <div class="row">
                  <div class="col-sm-4">
                    <p class="mb-0"><i class="fa-solid fa-key"></i> Password Lama</p>
                  </div>
                  <div class="col-sm-8">
                    <input type="password" name="passwordLama" class="form-control" required>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-4">
                    <p class="mb-0"><i class="fa-solid fa-lock"></i> Password Baru</p>
                  </div>
                  <div class="col-sm-8">
                    <input type="password" name="passwordBaru" class="form-control" required>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-4">
                    <p class="mb-0"><i class="fa-solid fa-lock"></i> Konfirmasi Password</p>
                  </div>
                  <div class="col-sm-8">
                    <input type="password" name="konfirmasiPassword" class="form-control" required>
                  </div>
                </div>
                <hr>
                <div class="row mt-4">
                  <button type="submit" class="btn btn-primary" name="changePassword">Ganti Password</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
require_once 'template/footer.php';
?>