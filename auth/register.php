<?php 

require_once '../config.php';

if(isset($_POST['daftar'])){
    $username = strtolower(stripslashes($_POST["username"]));
    $email = htmlspecialchars($_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST["password"]);
    $password2 = mysqli_real_escape_string($con, $_POST["password2"]);

    // cek ketersediaan username 
    $result = mysqli_query($con, "SELECT username from tb_user WHERE username = '$username'");

    if ( mysqli_fetch_assoc($result) ) {
        echo "
            <script>
                alert('username sudah terdaftar!');
                window.location.href = 'register.php';
            </script>
        ";
        die();
    }

    // cek ketersediaan email
    $cekEmail = mysqli_query($con, "SELECT email from tb_user WHERE email = '$email'");

    if ( mysqli_fetch_assoc($cekEmail) ) {
        echo "
            <script>
                alert('Email sudah terdaftar!');
                window.location.href = 'register.php';
            </script>
        ";
        die();
    }

    // cek konfirmasi password
    if ( $password !== $password2 ) {
        echo "
            <script>
                alert('Konfirmasi password tidak sesuai!');
                window.location.href = 'register.php';
            </script>
        ";
        die();
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambhakn user baru ke database
    $queryReg = mysqli_query($con, "INSERT INTO tb_user (username, password, email) VALUES ('$username', '$password', '$email')");

    if($queryReg){
        echo "
            <script>
                alert('Berhasil! Silahkan Login kembali');
                window.location.href = 'login.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Gagal Daftar! Coba Lagi');
            </script>
        ";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Fontawesome -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../assets/vendors/sweetalert2/sweetalert2.min.css">
</head>

<style>
    body {
        background: #007bff;
        background: linear-gradient(to right, #0062E6, #33AEFF);
    }

    .btn-login {
        font-size: 0.9rem;
        letter-spacing: 0.05rem;
        padding: 0.75rem 1rem;
    }

    .btn-google {
        color: white !important;
        background-color: #ea4335;
    }

    .btn-facebook {
        color: white !important;
        background-color: #3b5998;
    }
</style>

<body>

    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card border-0 shadow rounded-3 my-5">
                    <div class="card-body p-4 p-sm-5">
                        <h2 class="card-title text-center mb-5 fw-Bold fs-3">Sign Up</h2>
                        <form action="" method="post">
                            <div class="form-floating mb-3">
                                <input type="username" name="username" class="form-control" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Username</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control" id="floatingemail" placeholder="email">
                                <label for="floatingemail">Email</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword">Password</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="password2" class="form-control" id="floatingPassword2" placeholder="Password2">
                                <label for="floatingPassword2">Konfirmasi Password</label>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit" name="daftar">Daftar</button>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <p><a href="login.php" class="text-decoration-none">Login?</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <script src="../assets/vendors/sweetalert2/sweetalert2.min.js"></script>
</body>

</html>