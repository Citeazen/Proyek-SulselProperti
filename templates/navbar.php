<?php
function setActiveNavbarMenu($requestUrl)
{
  if ($requestUrl == explode('?', $_SERVER["REQUEST_URI"])[0]) :
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
      <li><a class="" href="index.php">Beranda</a></li>
      <li><a class="" href="product.php">Laman Produk</a></li>
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
  <script src="script.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      toggleNavbar();
      setActiveNavbarMenu();
    });
  </script>

  <!-- end navbar -->