<?php
function setActiveNavbarMenu($requestUrl)
{
  if ($requestUrl == explode('?', $_SERVER["REQUEST_URI"])[0]):
    echo ' nav-active';
  endif;
}
?>

<!-- navbar -->

<body>
  <nav>
    <button class="openbtn"><i class="fa fa-bars"></i></button>
    <div class="logo"><a href="index.php">Sulsel Properti</a></div>
    <ul class="navigation" id="navigation">
      <li><a class="<?php setActiveNavbarMenu('/index.php'); ?>" href="index.php">Beranda</a></li>
      <li><a class="<?php setActiveNavbarMenu('/index.php#about'); ?>" href="index.php#about">Tentang</a></li>
      <li><a class="<?php setActiveNavbarMenu('product.php'); ?>" href="product.php">Produk</a></li>
      <li><a class="<?php setActiveNavbarMenu('/index.php#contact'); ?>" href="index.php#contact">Kontak</a></li>
      <?php if (!is_login()): ?>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
      <?php else: ?>
        <li><a href="logout.php">Logout</a></li>
      <?php endif; ?>
    </ul>

  </nav>
  <script src="script.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", toggleNavbar);
  </script>
  <!-- end navbar -->