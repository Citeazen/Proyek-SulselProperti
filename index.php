<?php
require_once 'config.php';
$products = getAllProducts();
$categories = getAllCategories();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sulsel Properti</title>
    <link rel="stylesheet" href="style.css" />
    <link href="assets/fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="assets/fontawesome/css/brands.css" rel="stylesheet">
    <link href="assets/fontawesome/css/solid.css" rel="stylesheet">
</head>

<body>
    <button class="openbtn" onclick="mobel()"><i class="fa fa-bars"></i></button>
    <nav>
        <div class="logo"><a href="index.php">Sulsel Properti</a></div>
        <ul class="navigation">
            <li><a href="#home">Beranda</a></li>
            <li><a href="#about">Tentang</a></li>
            <li><a href="#product">Produk</a></li>
            <li><a href="#contact">Kontak</a></li>
            <?php if (!is_login()): ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            <?php else: ?>
                <li><a href="logout.php">Logout</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <!-- tes -->
    <section id="home" class="section home odd">
        <div class="hero">
            <div class="hero-text">
                <h1>Selamat datang di Sulsel Properti</h1>
                <h2>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatum, facilis.</h2>
                <a href="product.php">Produk Kami</a>
            </div>
        </div>
    </section>
    <section id="about" class="about even">
        <h2>Tentang Kami</h2>
        <div class="about-content">
            <div class="about-text">
                <h3>Cerita Kami</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed auctor, magna at blandit viverra, ipsum
                    magna molestie erat, euismod suscipit libero risus a enim. Sed id elit non
                    nibh malesuada aliquet. Sedeget ipsum vel nibh commodo pellentesque vel vel nisi.
                </p>
            </div>
            <div class="about-image">
                <img src="assets/thumbnail/4.jpg" alt="About Us" />
            </div>
        </div>
    </section>
    <section id="product" class="product odd">
        <h2>Produk Kami</h2>
        <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto neque debitis nostrum laborum nihil
            iure?</h3>
        <ul class="product-grid">
            <?php foreach (array_slice($products, 0, 4) as $product): ?>
                <li class="product-item">
                    <img src="<?= $product['thumbnail'] ?>" alt="<?= $product['title'] ?>">
                    <h4 class="product-name"><a href="detail.php?id=<?= $product['id'] ?>"><?= $product['title'] ?></a></h4>
                    <p class="product-price">
                        <?= $product['prices'] ?>
                    </p>
                </li>
            <?php endforeach; ?>
        </ul>
        <br>
        <a href="product.php">Lihat selengkapnya</a>
    </section>
    <section id="contact" class="contact even">
        <h2>Hubungi Kami</h2>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consequatur iste, quae eos incidunt ratione
            dignissimos soluta itaque aliquam impedit cum!</p>
        <label for="Nama"></label>
        <input type="text" />
    </section>
    <footer>
        <div class="socials"></div>
        <div class="nav-footer">
            <a href="#home">Beranda</a>
            <a href="#about">Tentang</a>
            <a href="#product">Produk</a>
            <a href="#contact">Kontak Kami</a>
        </div>
        <div class="copyright">
            <p>Copyright by <a href="#">Rumah Website</a> | &copy; 2023.</p>
        </div>
    </footer>
    <script src="assets/fontawesome/js/all.min.js"></script>
</body>

</html>