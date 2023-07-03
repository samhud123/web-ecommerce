<?php

session_start();
if (!isset($_SESSION['login'])) {
    header("location: auth/login.php");
    exit();
}

require_once 'function/function.php';

$title = 'Change-Password';
require_once 'template/header.php';
require_once 'template/sidebar.php';

$id = $_SESSION['id'];

if(isset($_POST['change'])){
    $passwordLama = $_POST['password-lama'];
    $passwordBaru = mysqli_real_escape_string($con, $_POST['password-baru']);
    $konfirmPassword = mysqli_real_escape_string($con, $_POST['konfirmasi-password']);

    $getData = mysqli_query($con, "SELECT * FROM tb_admin WHERE id = $id");
    $data = mysqli_fetch_array($getData);

    if($passwordLama === $data['password']){
        if($passwordBaru === $konfirmPassword){
            mysqli_query($con, "UPDATE tb_admin SET password = '$passwordBaru'");
            echo "
                <script>
                    alert('Berhasil ubah password, silahkan login kembali');
                    document.location.href = 'auth/logout.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Gagal, Konfirmasi Password tidak sesuai!');
                </script>
            ";
        }
    } else {
        echo "
            <script>
                alert('Gagal, Password lama tidak sesuai!');
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
                <div class="col-12 col-md-6 order-md-1 order-last mb-4">
                    <h3>Ubah Password</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Ubah Password</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Form Ubah Password</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal" action="" method="post">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Password Lama</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="password" name="password-lama" class="form-control" id="first-name-icon">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-key-fill"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Password Baru</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="password" name="password-baru" class="form-control" id="first-name-icon">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-lock"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Konfirmasi Password Baru</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="password" name="konfirmasi-password" class="form-control">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-lock"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" name="change" class="btn btn-primary me-1 mb-1">Ubah</button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    require_once 'template/footer.php';
    ?>