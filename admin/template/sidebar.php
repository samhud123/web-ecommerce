
<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <!-- <a href="index.php"><img src="assets/images/logo/logo.png" alt="Logo" srcset=""></a> -->
                    <h3 style="text-transform: uppercase;"><?= $_SESSION['user']; ?></h3>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item <?php if($title == "Dashboard") echo 'active'; ?>">
                    <a href="index.php" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item <?php if($title == "Stock") echo 'active'; ?>">
                    <a href="stock.php" class='sidebar-link'>
                        <i class="bi bi-box-fill"></i>
                        <span>Kelola Data Stock</span>
                    </a>
                </li>

                <li class="sidebar-item <?php if($title == "Pemesanan") echo 'active'; ?> ">
                    <a href="pemesanan.php" class='sidebar-link'>
                        <i class="bi bi-cart-check-fill"></i>
                        <span>Data Pemesanan</span>
                    </a>
                </li>

                <li class="sidebar-item <?php if($title == "Laporan") echo 'active'; ?> ">
                    <a href="laporan.php" class='sidebar-link'>
                        <i class="bi bi-bar-chart-line-fill"></i>
                        <span>Laporan Bulanan</span>
                    </a>
                </li>

                <li class="sidebar-title">User</li>

                <li class="sidebar-item has-sub <?php if($title == "Change-Password") echo 'active'; ?> ">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-person-badge-fill"></i>
                        <span>Admin</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="auth/logout.php">Logout</a>
                        </li>
                        <li class="submenu-item <?php if($title == "Change-Password") echo 'active'; ?>">
                            <a href="change-password.php">Change Password</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>