<?php
require_once 'config.php';

if (!isset($_SESSION['login'])):
  header('Location: login.php');
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
    echo "<script>
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
<script src="ckeditor/ckeditor.js"></script>
<title>Ubah Produk</title>

<body>
  <div class="detail">
    <!-- content -->
    <h1>Ubah Data Produk</h1>
    <div class="data-edit-menu">
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="items-data">
          <input type="hidden" name="id" value="<?= $product->id ?>">
          <div class="item">
            <label for="title">Judul Produk</label>
            <input type="text" id="title" placeholder="Isi judul Produk" name="title" value="<?= $product->title ?>">
          </div>
          <div class="item">
            <label for="addresses">Alamat</label>
            <input type="text" id="addresses" placeholder="Isi Alamat" name="addresses"
              value="<?= $product->addresses ?>">
          </div>
          <div class="item">
            <label for="category_id">Pilih Kategori :</label>
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
          </div>
          <div class="button">
            <a class="btn-grey" onclick="history.back()">Kembali</a>
            <button type="submit" class="btn-change" name="submit">Ubah Produk</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>
<!-- end content -->
<script>
  CKEDITOR.replace('descriptions', {
    filebrowserUploadUrl: "uploadimg.php",
    filebrowserUploadMethod: "form"
  });
</script>
<!-- <script src="https://cdn.ckeditor.com/ckeditor5/36.0.0/classic/ckeditor.js"></script>
  <script>
    function createCKEditor(element) {
      ClassicEditor
        .create(element)
        .catch(error => {
          console.error(error);
        });
    } -->
<!-- // createCKEditor(document.querySelector('#prices'));
  // createCKEditor(document.querySelector('#descriptions')); -->
<!-- // </script> -->

<?php include_once 'templates/footer.php'; ?>