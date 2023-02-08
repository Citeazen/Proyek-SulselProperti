<?php
require_once 'config.php';
$product = getDetailProduct();

include_once 'templates/navbar.php';
include_once 'templates/header.php';
?>

<title>
  <?= $product->title ?>
</title>

<body>
  <div class="detail">
    <div class="atas">
      <img src="<?= $product->thumbnail ?>" alt="<?= $product->title ?>">
      <!-- <img src="<?= $product->images ?>" alt="<?= $product->title ?>"> -->
      <?php if (is_login()): ?>
        <a class="btn-change" href="ubah-produk.php?id=<?= $product->id ?>">Ubah Data</a>
        <a class="btn-delete" onclick="return confirm('Apakah anda yakin??')"
          href="hapus-produk.php?id=<?= $product->id ?> ">Hapus</a>
      <?php endif; ?>
    </div>
    <h1>
      <?= $product->title ?>
    </h1>
    <h2>Alamat</h2>
    <?= $product->addresses ?>
    <h2>Harga</h2>
    <?= $product->prices ?>
    <h2>Deskripsi</h2>
    <div class="deskripsi">
      <?= $product->descriptions ?>
    </div>
  </div>

  <!-- end content -->

  <?php include_once 'templates/footer.php'; ?>