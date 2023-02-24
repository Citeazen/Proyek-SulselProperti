<?php
require_once 'config.php';
if (isset($_SESSION['login'])) :
  header('Location: index.php');
  exit();
  die();
endif;

// kalo ada submit / kalo tombol submit ditekan / kalo ada kiriman POST dengan key submit yang nilainya true
if (isset($_POST['submit'])) :
  register();
endif;

include_once 'templates/header.php';
?>

<div class="login-page">

  <!-- content -->
  <div class="card-body">
    <h1 class="log-in">Register</h1>
    <form action="" method="POST">
      <div class="mb-3">
        <label for="name">Nama</label>
        <input type="text" placeholder="Isi nama anda" name="name" id="name" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="username">Username</label>
        <input type="text" placeholder="Isi username anda" name="username" id="username" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="password">Password</label>
        <input type="password" placeholder="Isi password anda" name="password" id="password" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="password_confirm">Konfirmasi Password</label>
        <input type="password" placeholder="Isi password_confirm anda" name="password_confirm" id="password_confirm" class="form-control">
      </div>
      <div class="mb-3">
        <button type="submit" name="submit" class="btnSubmit">Register</button>
      </div>
    </form>
  </div>

</div>
<!-- end content -->


<?php include_once 'templates/footer.php'; ?>