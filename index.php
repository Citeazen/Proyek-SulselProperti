<?php
require_once 'config.php';
$products = getAllProducts();
$categories = getAllCategories();

include_once 'templates/header.php';
?>


<!-- AOS -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

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
            <span class="login">

                <?php if (!is_login()) : ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                <?php else : ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php endif; ?>
            </span>
        </ul>
    </nav>
    <section id="home" class="section home odd">
        <div class="hero">
            <div class="hero-text">
                <h1>Selamat datang di <span><span></h1>
                <h3>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatum, facilis.</h3>
                <a href="product.php">Produk Kami</a>
            </div>
        </div>
    </section>
    <section id="about" class="about even">
        <h2 data-aos="fade-down">Tentang Kami</h2>
        <div class="about-content" data-aos="fade-in" data-aos-duration="1000">
            <div class="about-text">
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
    <section id="product" class="product product-idx odd">
        <div class="product-main">
            <div class="product-text" data-aos="fade-right" data-aos-easing="ease-in-sine" data-aos-offset="300">
                <h2>Produk</h2>
                <h3>Untuk melihat produk lainnya, silahkan klik tombol dibawah ini</h3>
                <a class="btn-add" href="product.php">Laman Properti</a>
            </div>
            <div class="product-grid-main">
                <ul class="product-grid">
                    <?php foreach (array_slice($products, 0, 4) as $product) : ?>
                        <li class="product-item" data-aos="flip-right" data-aos-offset="300" data-aos-anchor-placement="top-bottom">
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
                <a class="btn-add" href="product.php">Laman Properti</a>
            </div>
        </div>
    </section>
    <section id="contact" class="contact even">
        <div class="socials-link">
            <div class="social-title" data-aos="fade-down" data-aos-offset="300">
                <h2>Sosial Media</h2>
                <h3>Untuk informasi lebih lanjut, anda dapat menghubungi kami melalui sosial media dan Whatsapp kami</h3>
            </div>
            <ul class="social-icons" data-aos="fade-up" data-aos-offset="300">
                <li><a href=""><i class="fa-brands fa-facebook"></i><span>Facebook</span></a></li>
                <li><a href=""><i class="fa-brands fa-instagram"></i><span>Instagram</span></a></li>
                <li><a href=""><i class="fa-brands fa-whatsapp"></i><span>Whatsapp</span></a></li>
                <!-- <li><a href=""><i class="fa-solid fa-phone"></i><span>Telepon</span></a></li> -->
            </ul>
        </div>
    </section>
    <br><br>
    <div class="whatsapp"><button><i class="fa-brands fa-whatsapp"></i></button></div>
    <script src="script.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            onScrollActive();
            toggleNavbar();
            setActiveNavbarMenu();
            blockImages("menuimg");
        });
    </script>

    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/TextPlugin.min.js"></script>
    <script>
        gsap.registerPlugin(TextPlugin);
        gsap.to(".hero-text h1 span", {
            preserveSpaces: true,
            duration: 1.5,
            delay: 2,
            text: "Sulsel Properti",
        });
        gsap.from(".hero-text h1", {
            delay: 0.8,
            opacity: 0,
            x: -100,
            duration: 1,
            ease: 'back',
        });
        gsap.from(".hero-text h3, .hero-text a", {
            delay: 3.5,
            opacity: 0,
            x: -100,
            duration: 1,
            ease: 'back',
        });
    </script>

    <!-- AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            duration: 400,
            offset: 380,
        });
    </script>

    <?php include_once 'templates/footer.php'; ?>