<?php
require_once 'config.php';

if (!isset($_SESSION['login'])) :
  header('Location: login.php');
  exit();
endif;

$id = isset($_GET['id']) ? $_GET['id'] : null;
if ($id == null) :
  header('HTTP/1.1 403 Forbidden');
  die();
endif;

if (checkProduct($id) > 1 or checkProduct($id) < 1) :
  header('HTTP/1.1 403 Forbidden');
  die();
endif;

if (deleteDesc($id) && (deleteProduct($id))) :
  echo "<script>alert('Data produk berhasil dihapus.'); location.href = 'product.php';</script>";
else :
  echo "<script>alert('Data produk gagal dihapus.'); location.href = 'product.php';</script>";
endif;
