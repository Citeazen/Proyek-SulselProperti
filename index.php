<?php
require_once 'config.php';
$products = getAllProducts();
$categories = getAllCategories();

include_once 'templates/header.php';
?>

<title>Sulsel Properti</title>
</head>

<body>
    <nav>
        <button class="openbtn"><i class="fa fa-bars"></i></button>
        <div class="logo"><a href="index.php">Sulsel Properti</a></div>
        <ul class="navigation">
            <li><a class="#" href="#home">Beranda</a></li>
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
    <section id="home" class="section home odd">
        <div class="hero">
            <div class="hero-text">
                <h1>Selamat datang di Sulsel Properti</h1>
                <h3>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatum, facilis.</h3>
                <a href="product.php">Produk Kami</a>
            </div>
        </div>
    </section>
    <section id="about" class="about even">
        <h2>Tentang Kami</h2>
        <div class="about-content">
            <div class="about-text">
                <h3>Cerita Kami</h3>
                <h4>
                    Properti Sulsel merupakan penyedia layanan penjualan rumah komersil dan premium dengan kualitas
                    rumah yang dipasarkan Terbaik dikelasnya.
                    Membantu Customer mendapatkan rumah impain sampai Terima kunci dan tentunya segala hal terkait
                    pembelian rumah tinggal, ruko, apartment, kavling dan lain-lain.
                </h4>
            </div>
            <div class="about-image">
                <img class="menuimg" src="assets/thumbnail/4.jpg" alt="About Us" />
            </div>
        </div>
    </section>
    <section id="product" class="product odd">
        <div class="product-main">
            <div class="product-text">
                <h2>Produk Kami</h2>
                <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto neque debitis nostrum laborum
                    nihil
                    iure?</h3>
                <a class="btn-add" href="product.php">Lihat selengkapnya</a>
            </div>
            <div class="product-grid-main">
                <ul class="product-grid">
                    <?php foreach (array_slice($products, 0, 4) as $product): ?>
                            <li class="product-item">
                                <a href="detail.php?id=<?= $product['id'] ?>">
                                    <img class="menuimg" src="<?= $product['thumbnail'] ?>" alt="<?= $product['title'] ?>">
                                </a>
                                <h4 class="product-name"><a href="detail.php?id=<?= $product['id'] ?>"><?= $product['title'] ?></a>
                                </h4>
                                <p class="product-price">
                                    <?= $product['prices'] ?>
                                </p>
                            </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </section>
    <section id="contact" class="contact even">
        <h2>Social Link</h2>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consequatur iste, quae eos incidunt ratione
            dignissimos soluta itaque aliquam impedit cum!</p>
        <ul class="social-icons">
            <li><a href=""><i class="fa-brands fa-facebook"></i><span>Facebook</span></a></li>
            <li><a href=""><i class="fa-brands fa-instagram"></i><span>Instagram</span></a></li>
            <li><a href=""><i class="fa-brands fa-whatsapp"></i><span>Whatsapp</span></a></li>
            <li><a href=""><i class="fa-solid fa-phone"></i><span>Telp</span></a></li>
        </ul>
    </section>
    <script src="script.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", toggleNavbar);
        blockImages("menuimg");
    </script>

    <?php include_once 'templates/footer.php'; ?>