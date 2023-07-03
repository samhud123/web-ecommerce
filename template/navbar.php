<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary" style="z-index: 1;">
    <div class="container">
        <a class="navbar-brand fs-3 fw-bold" href="index.php">BO Digital</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-4 mb-2 mb-lg-0">
                <li class="nav-item me-3">
                    <a class="nav-link <?php if($title === 'BO Printing') echo 'active'; ?>" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link" href="#">About Us</a>
                </li>
                <li class="nav-item me-3 <?= $title === 'Order' ? 'active' : '' ?>">
                    <a class="nav-link" href="order.php">Order Product</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link" href="#">News Article</a>
                </li>
            </ul>
            <form class="d-flex ms-auto" role="search">
                <input class="form-control" type="search" id="search" placeholder="Search" aria-label="Search">
            </form>
            <div class="ms-4 icon-search">
                <i class="fa-solid fa-magnifying-glass text-white fs-4" id="icon-search"></i>
            </div>
            <?php
            if (isset($_SESSION['email'])) {
            ?>
                <div class="ms-4">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle bg-transparent border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-regular fa-user text-white fs-4"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Lihat Profile</a></li>
                            <li><a class="dropdown-item" href="auth/logout.php">Logout</a></li>
                        </ul>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class="ms-4">
                    <a href="auth/login.php" class="btn btn-outline-light">Login</a>
                </div>
            <?php 
            }
            ?>
        </div>
    </div>
</nav>