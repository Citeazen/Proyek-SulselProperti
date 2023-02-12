<?php
require_once 'config.php';

if (!isset($_SESSION['login'])):
  header('Location: login.php');
  exit();
endif;

if (!is_admin()):
  header('Location: product.php');
  exit();
endif;

$id = isset($_GET['id']) ? $_GET['id'] : null;
if ($id == null):
  header('HTTP/1.1 403 Forbidden');
  die();
endif;

if (checkProduct($id) > 1 or checkProduct($id) < 1):
  header('HTTP/1.1 403 Forbidden');
  die();
endif;

if (isset($_POST['submit'])):
  if (changeProduct($_POST)):
    // berhasil
    echo "<script>
      alert('Produk kamu berhasil diubah');
      location.href = 'product.php';
      </script>";
    // gagal
  else:
    "<script>
        alert('Produk kamu gagal diubah');
        location.href = 'product.php';
        </script>";
  endif;
endif;


$categories = getAllCategories();
$product = getDetailProduct();

include_once 'templates/header.php';
include_once 'templates/navbar.php';
?>
<script src="assets/ckeditor/ckeditor.js"></script>
<title>Ubah Data</title>

<body>
  <div class="detail">
    <!-- content -->
    <h1>Ubah Data Properti</h1>
    <div class="data-edit-menu">
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="items-data">
          <input type="hidden" name="id" value="<?= $product->id ?>">
          <div class="item">
            <label for="title">Title</label>
            <input type="text" id="title" placeholder="Isi judul Produk" name="title" value="<?= $product->title ?>">
          </div>
          <div class="item">
            <label for="addresses">Alamat</label>
            <input type="text" id="addresses" placeholder="Isi Alamat" name="addresses"
              value="<?= $product->addresses ?>">
          </div>
          <div class="item">
            <label for="category_id"><strong>Pilih Kategori :</strong></label>
            <select name="category_id" id="category_id">
              <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>" <?php if ($category['id'] == $product->category_id):
                    echo 'selected';
                  else:
                    echo '';
                  endif; ?>><?= $category['name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="item">
            <label for="prices">Harga</label>
            <input type="text" id="prices" name="prices" value="<?= $product->prices ?>">
            </input>
          </div>
          <div class="item">
            <label for="descriptions">Deskripsi</label>
            <textarea id="descriptions" name="descriptions"><?= $product->descriptions ?></textarea>
          </div>
          <div class="item">
            <div class="thumbnail">
              <label for="thumbnail">Foto Thumbnail</label>
              <p><small>Kosongkan jika tidak ingin mengganti thumbnail</small></p>
              <img src="<?= $product->thumbnail ?>" alt="<?= $product->title ?>" style="height: 150px;">
              <input type="file" name="thumbnail" id="thumbnail">
            </div>
            <div class="item">
              <label for="opt_imgs">Gambar Tambahan <strong>(Opsional)</strong></label>
              <textarea id="opt_imgs" name="opt_imgs"><?= $product->opt_imgs ?></textarea>
            </div>
          </div>
          <div class="button">
            <a class="btn-grey" onclick="history.back()"> Kembali</a>
            <button type="submit" class="btn-change" name="submit"> Ubah Data</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>
<!-- end content -->
<?php include_once 'templates/footer.php'; ?>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    ckedit_desc();
    ckedit_imgs();
  });
</script>