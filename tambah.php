<?php
require_once 'config.php';

if (!isset($_SESSION['login'])):
  header('Location: login.php');
  exit();
endif;

if (isset($_POST['submit'])):
  if (addProduct($_POST)):
    // berhasil
    echo "<script>
            alert('Laman properti berhasil dibuat');
            location.href = 'product.php';
          </script>";
  else:
    // gagal
  endif;
endif;

$categories = getAllCategories();
include_once 'templates/navbar.php';
include_once 'templates/header.php';
?>

<script src="ckeditor/ckeditor.js"></script>

<title>Tambah Produk</title>

<body>

  <div class="detail">

    <!-- content -->
    <h1>Buat Properti</h1>
    <div class="data-edit-menu">

      <form action="" method="POST" enctype="multipart/form-data">
        <div class="items-data">
          <div class="item">
            <label for="title">Title</label>
            <input type="text" id="title" placeholder="Isi Title" name="title">
          </div>
          <div class="item">
            <label for="title">Alamat</label>
            <input type="text" id="title" placeholder="Isi lokasi" name="addresses">
          </div>
          <div class="item">
            <label for="category_id">Pilih Kategori</label>
            <select class="form-select" name="category_id" id="category_id">
              <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="item">
            <label for="prices">Harga</label>
            <input type="text" id="prices" name="prices"></input>
          </div>
          <div class="item">
            <label for="descriptions">Deskripsi</label>
            <textarea id="summernote" name="descriptions"></textarea>
          </div>
          <div class="item">
            <label for="thumbnail">Foto Thumbnail</label>
            <input type="file" name="thumbnail" id="thumbnail" required>
          </div>
          <div class="button">
            <a class="btn-grey" onclick="history.back()">Kembali</a>
            <button type="submit" class="btn-add" name="submit">Tambah Produk</button>
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
<!-- // </script> -->

<?php include_once 'templates/footer.php'; ?>