<?php
require_once 'config.php';
$product = getDetailProduct();

include_once 'templates/header.php';
?>

<title>
  <?= $product->title ?>
</title>
</head>
<?php include_once 'templates/navbar.php'; ?>
<div class="detail">
  <div class="atas">
    <div class="data">
      <h1>
        <?= $product->title ?>
      </h1>
      <h1>Lokasi: <span>
          <?= $product->addresses ?>
        </span>
      </h1>
      <h1>Rp.<span>
          <?= $product->prices ?>
        </span>
      </h1>
    </div>
    <div class="image-carousel">
      <div class="owl-carousel owl-theme">
        <img class="product-imgs" src="<?= $product->thumbnail ?>" alt="<?= $product->title ?>">
        <?php
        $product_id = $_GET['id'];
        // query data dari tabel products
        $query = "SELECT opt_imgs FROM products WHERE id = $product_id";
        $result = mysqli_query($koneksi, $query);

        // loop setiap row hasil query
        while ($row = mysqli_fetch_assoc($result)) {
          $content = $row['opt_imgs'];
          echo display_img_src($content);
        }
        // tutup koneksi database
        mysqli_close($koneksi);
        ?>
      </div>
    </div>
  </div>
  <div class="edit">
    <?php if (is_login() && is_admin()): ?>
      <a class="btn-change" href="ubah-produk.php?id=<?= $product->id ?>"><i class="fa-solid fa-pen"></i>Ubah Data</a>
      <a class="btn-delete" onclick="return confirm('Apakah anda yakin??')"
        href="hapus-produk.php?id=<?= $product->id ?> "><i class="fa-solid fa-trash"></i>Hapus</a>
    <?php endif; ?>
  </div>
  <div class="deskripsi">
    <h1>Deskripsi</h1>
    <?= $product->descriptions ?>
  </div>
</div>
<script src="script.js"></script>
<script src="assets/vendors/jquery.min.js"></script>
<script src="assets/owlcarousel/owl.carousel.js"></script>
<script>
  $(document).ready(function () {
    $('.owl-carousel').owlCarousel({
      items: 1,
      margin: 1000,
      loop: true,
      nav: true,
      autoWidth: true,
      center: true,
      mouseDrag: false
    })
  });
  addImageModal("product-imgs");
</script>


<?php include_once 'templates/footer.php'; ?>