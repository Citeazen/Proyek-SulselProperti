<footer class="footer">
  <div class="acc">
    <?php if (!is_login()) : ?>
      <a href="login.php">Login</a>
      <a href="register.php">Register</a>
    <?php else : ?>
      <a href="logout.php">Logout</a>
    <?php endif; ?>
  </div>
  <div class="nav-footer">
    <a href="index.php#home">Beranda</a>
    <a href="index.php#about">Tentang</a>
    <a href="product.php">Laman Produk</a>
    <a href="index.php#contact">Kontak Kami</a>
  </div>
  <div class="copyright">
    <p>Copyright by <a href="#">Sulsel Properti</a> | &copy; 2023.</p>
  </div>
</footer>
<script src="assets/fontawesome/js/all.min.js"></script>
</body>

</html>