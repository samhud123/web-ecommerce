<?php 

session_start();

require_once '../config.php';

if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query($con, "SELECT * FROM tb_user WHERE email = '$email'");

    // cek email
    if( mysqli_num_rows($result) === 1 ){
        // cek password
        $row = mysqli_fetch_assoc($result);
        if( password_verify($password, $row['password']) ){
            // set session
            $_SESSION['email'] = $row['email'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['id_user'] = $row['id_user'];
            
            header("location: ../index.php");
        } else {
            echo "
                <script>
                    alert('Password Salah!');
                    window.location.href = 'login.php';
                </script>
            ";
        die();
        }
    } else {
        echo "
            <script>
                alert('Email tidak terdaftar!');
                window.location.href = 'login.php';
            </script>
        ";
        die();
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
                        <h2 class="card-title text-center mb-5 fw-Bold fs-3">Login</h2>
                        <form action="" method="post">
                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Email address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword">Password</label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="" id="rememberPasswordCheck">
                                <label class="form-check-label" for="rememberPasswordCheck">
                                    Remember password
                                </label>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit" name="login">Login</button>
                            </div>
                            <hr class="my-4">
                            <div class="row">
                                <div class="col">
                                    <p><a href="register.php" class="text-decoration-none">Daftar?</a></p>
                                </div>
                                <div class="col">
                                    <p><a href="#" class="text-decoration-none">Foget Password?</a></p>
                                </div>
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