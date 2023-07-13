<!-- Footer -->
<footer class="pt-5 text-center text-lg-start bg-light text-muted">
    <!-- Section: Social media -->
    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom bg-primary text-white">
        <!-- Left -->
        <div class="me-5 d-none d-lg-block">
            <span>Ikuti Sosial Media kami untuk mendapatkan hal menarik : </span>
        </div>
        <!-- Left -->

        <!-- Right -->
        <div>
            <a href="#" class="me-4 text-reset">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="me-4 text-reset">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="me-4 text-reset">
                <i class="fab fa-google"></i>
            </a>
            <a href="#" class="me-4 text-reset">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="#" class="me-4 text-reset">
                <i class="fab fa-linkedin"></i>
            </a>
            <a href="#" class="me-4 text-reset">
                <i class="fab fa-github"></i>
            </a>
        </div>
        <!-- Right -->
    </section>
    <!-- Section: Social media -->

    <!-- Section: Links  -->
    <section class="">
        <div class="container text-center text-md-start mt-5">
            <!-- Grid row -->
            <div class="row mt-3">
                <!-- Grid column -->
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <!-- Content -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        <i class="fas fa-gem me-3"></i>BO Printing
                    </h6>
                    <p>
                        Kami adalah sebuah kelompok usaha bersama yang bergerak di bidang usaha layanan percetakan. Kami sangat mengutamakan kualitas demi kepuasan pelanggan.
                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        Kategori
                    </h6>
                    <?php 
                    require_once 'config.php';
                    $jenisBarang = mysqli_query($con, "SELECT Jenis_Barang FROM tb_stock");
                    while($category = mysqli_fetch_array($jenisBarang)){
                    ?>
                        <p>
                            <a href="catalog.php?search=<?= $category['Jenis_Barang']; ?>" class="text-reset"><?= $category['Jenis_Barang']; ?></a>
                        </p>
                    <?php 
                    }
                    ?>  
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">Kontak</h6>
                    <p><i class="fas fa-home me-3"></i> Buaran, Pekalongan</p>
                    <p>
                        <i class="fas fa-envelope me-3"></i>
                        boprinting@gmail.com
                    </p>
                    <p><i class="fas fa-phone me-3"></i> +62 856 4859 7435</p>
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
        </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
        © <?= date('Y'); ?> Copyright: <b>BO Printing</b>
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<!-- CDN JQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<!-- Link Internal JS -->
<script src="assets/script.js"></script>
</body>

</html>