<?php
require_once 'config.php';
$products = getAllProducts();
$categories = getAllCategories();
$search = isset($_GET['search']) ? $_GET['search'] : null;
$categoryId = isset($_GET['category']) ? $_GET['category'] : null;

include_once 'templates/header.php';
include_once 'templates/navbar.php';
?>
<!-- HEADER -->
<title>Produk Kami</title>
<!-- Penutup HEADER -->

<body>
  <section class="product">
    <h2>Properti Gw</h2>
    <form action="product.php" method="GET">
      <div class="product-properties">
        <div class="option">
          <select name="category">
            <option value="">-- Pilih Kategori --</option>
            <?php foreach ($categories as $category): ?>
              <option value="<?= $category['id'] ?>" <?php if ($category['id'] == $categoryId):
                  echo ' selected';
                endif; ?>>
                <?= $category['name'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="search">
          <input name="search" type="text" placeholder="Telusuri properti" value="<?= $search ?>">
          <button type="submit"><i class="fa fa-search"></i></button>
        </div>
        <?php if (is_login()): ?>
          <a class="btn-add" href="tambah.php">Tambah Data</a>
        <?php endif; ?>
      </div>
    </form>
    <!-- <section class="product"> -->
    <ul class="product-grid">
      <?php foreach ($products as $product): ?>
        <li class="product-item">
          <img src="<?= $product['thumbnail'] ?>" alt="<?= $product['title'] ?>">
          <h3 class="product-name"><a href="detail.php?id=<?= $product['id'] ?>"><?= $product['title'] ?></a></h3>
          <h4>Tipe :
            <?= $product['category_name'] ?>
          </h4>
          <h4>Alamat :
            <?= $product['addresses'] ?>
          </h4>
          <div class="product-options">
            <?php if (is_login()): ?>
              <a class="btn-add" href="ubah-produk.php?id=<?= $product['id'] ?>"><i class="fa-solid fa-pen"></i></a>
              <a class="btn-delete" href="hapus-produk.php?id=<?= $product['id'] ?>"
                onclick="return confirm('Apakah anda yakin??')"><i class="fa-solid fa-trash"></i></a>
            <?php endif; ?>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
    </div>
  </section>
  <?php include_once 'templates/footer.php'; ?>