<?php
session_start();

function is_login()
{
  if (isset($_SESSION['login'])):
    return true;
  else:
    return false;
  endif;
}

$koneksi = mysqli_connect('localhost', 'root', '', 'sulsel_properti');

function getAllProducts()
{
  global $koneksi;
  $query = "SELECT * FROM vw_products WHERE title LIKE'%%'";
  if (isset($_GET['search'])):
    $search = $_GET['search'];
    $query = "SELECT * FROM vw_products WHERE title LIKE '%$search%'";
  endif;
  if (isset($_GET['category'])):
    $category = $_GET['category'];
    if ($category != ""):
      $query .= " AND category_id = '$category'";
    endif;
  endif;
  $result = mysqli_query($koneksi, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function getDetailProduct()
{
  if (isset($_GET['id'])):
    $id = $_GET['id'];
    global $koneksi;
    $query = "SELECT * FROM vw_products WHERE id=$id";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_object($result);
    return $row;
  else:
    return null;
  endif;
}

function getAllCategories()
{
  global $koneksi;
  $query = "SELECT * FROM categories";
  $result = mysqli_query($koneksi, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function upload($image)
{
  $fileName = $image['name'];
  $tmpName = $image['tmp_name'];
  $fileSize = $image['size'];
  $error = $image['error'];

  // cek apakah filenya ada atau tidak
  if ($error == 4):
    echo "<script>
            alert('Gambar harus ada!.');
          </script>";
    return false;
  endif;

  // cek apakah file yg di upload tipe nya gambar atau bukan
  $imageFormatValid = ['jpg', 'jpeg', 'png', 'webp', 'bmp'];
  $imageFormat = explode('.', $fileName);
  $imageFormat = strtolower(end($imageFormat)); // JPEG => jpeg
  if (!in_array($imageFormat, $imageFormatValid)):
    echo "<script>
            alert('File harus gambar!.');
          </script>";
    return false;
  endif;

  // cek file size
  if ($fileSize > 2000000):
    echo "<script>
            alert('Ukuran gambar maksimal 2MB!.');
          </script>";
    return false;
  endif;

  // eksekusi nama file baru
  $newFileName = date('YmdHis') . uniqid() . '.' . $imageFormat;
  move_uploaded_file($tmpName, 'assets/thumbnail/' . $newFileName);

  return 'assets/thumbnail/' . $newFileName;
}


function addProduct($data)
{
  global $koneksi;

  $title = htmlspecialchars($data['title']);
  $category_id = $data['category_id'];
  $addresses = $data['addresses'];
  $prices = $data['prices'];
  $descriptions = $data['descriptions'];
  // $images = $data['images'];
  $user_id = 2;

  // upload image
  $thumbnail = upload($_FILES['thumbnail']);

  // cek apakah validasinya lolos atau tidak
  if (!$thumbnail):
    // validasinya gak lolos
    return false;
  endif;

  // jalankan query
  mysqli_query($koneksi, "INSERT INTO products VALUES (NULL, '$title' ,'$user_id', '$category_id', '$addresses', '$prices', '$descriptions', '$thumbnail', 1)");

  if (mysqli_affected_rows($koneksi) > 0):
    // return true kalo berhasil ditambah
    return true;
  else:
    // return false kalo gagal ditambah
    return false;
  endif;
}

function checkProduct($id)
{
  global $koneksi;
  $query = "SELECT * FROM vw_products WHERE id = $id";
  $result = mysqli_query($koneksi, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return count($rows);
}

function deleteDesc($id)
{
  // Koneksikan ke database
  global $koneksi;

  // Ambil data dari database
  $query = "SELECT * FROM products WHERE id = $id";
  $result = mysqli_query($koneksi, $query);
  $product = mysqli_fetch_assoc($result);

  // Ambil tag img dari teks
  preg_match_all('/<img[^>]+>/i', $product['descriptions'], $images);

  // Hapus file gambar dari direktori
  foreach ($images[0] as $image) {
    preg_match('/src="([^"]+)/i', $image, $src);
    unlink(substr($src[1], 0));
  }

  // Tutup koneksi database
  mysqli_query($koneksi, $query);
  if (mysqli_affected_rows($koneksi) > 0):
    // return true kalo berhasil dihapus
    return true;
  else:
    // return false kalo gagal dihapus
    return false;
  endif;
}

function deleteProduct($id)
{
  global $koneksi;
  $query = "DELETE FROM products";
  $product = getDetailProduct();

  $oldThumbnail = $product->thumbnail;
  // kalo ada foto lama maka hapus
  if (file_exists($oldThumbnail) and $oldThumbnail != 'assets/thumbnail/thumb.jpg'):
    unlink($oldThumbnail);
  endif;

  $query .= " WHERE id = $id";

  /*
  == Hidden
  UPDATE products SET is_active = 0 WHERE id = $id;
  maka gak perlu untuk hapus thumbnailnya
  */

  // jalankan query delete
  mysqli_query($koneksi, $query);
  if (mysqli_affected_rows($koneksi) > 0):
    // return true kalo berhasil dihapus
    return true;
  else:
    // return false kalo gagal dihapus
    return false;
  endif;
}



function changeProduct($data)
{
  global $koneksi;
  $id = $data['id'];
  $title = htmlspecialchars($data['title']);
  $category_id = $data['category_id'];
  $addresses = $data['addresses'];
  $prices = $data['prices'];
  $descriptions = $data['descriptions'];
  // $images = $data['images'];

  // query basic
  $query = "UPDATE products SET title = '$title', category_id = '$category_id', prices = '$prices', addresses = '$addresses', descriptions = '$descriptions'
    ";
  // , images = '$images'

  // cek apakah fotonya diganti atau tidak
  if ($_FILES['thumbnail']['error'] === 0):
    $product = getDetailProduct();
    $oldThumbnail = $product->thumbnail;
    $newThumbnail = upload($_FILES['thumbnail']);
    // kalo ada foto lama maka hapus
    if (file_exists($oldThumbnail) and $oldThumbnail != 'assets/thumbnail/thumb.jpg'):
      unlink($oldThumbnail);
    endif;
    $query .= ", thumbnail = '$newThumbnail'";
  endif;


  $query .= " WHERE id = '$id'";

  // jalankan query
  mysqli_query($koneksi, $query);

  if (mysqli_affected_rows($koneksi) > 0):
    // return true kalo berhasil ditambah
    return true;
  else:
    // return false kalo gagal ditambah
    return false;
  endif;
}


// function login
function login()
{
  global $koneksi;
  $username = $_POST['username'];
  // cek apakah username bener atau enggak
  $result = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
  $row = mysqli_fetch_assoc($result);
  if ($row !== NULL and $row):
    // cek apakah password bener atau enggak
    if (password_verify($_POST['password'], $row['password'])):
      $_SESSION['login'] = true;
      $_SESSION['user_id'] = $row['id'];
      return true;
    else:
      return false;
    endif;
  else:
    return false;
  endif;
}

// function register
function register()
{
  global $koneksi;
  $name = htmlspecialchars($_POST['name']);
  $username = $_POST['username'];
  $password = $_POST['password'];
  $password_confirm = $_POST['password_confirm'];

  if ($password === $password_confirm):
    // kalo konfirmasi password bener
    // apakah username nya sudah terdaftar atau belum
    $result = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
    $row = mysqli_fetch_assoc($result);
    if ($row == NULL):
      // username tersedia / username belum kepake
      $password = password_hash($password, PASSWORD_DEFAULT);
      $query = "INSERT INTO users VALUES (NULL, '$name', '$username', '$password', NULL, 1)";
      mysqli_query($koneksi, $query);
      if (mysqli_affected_rows($koneksi) > 0):
        echo "<script>alert('registrasi berhasil. Silahkan login.'); location.href='login.php'</script>";
      else:
        echo "<script>alert('registrasi gagal!')</script>";
      endif;
    else:
      // username nya tidak tersedia / kepake
      echo "<script>alert('username tidak tersedia!!')</script>";
    endif;
  else:
    // kalo konfirmasi password salah
    echo "<script>alert('konfirmasi password salah!!')</script>";
  endif;

}