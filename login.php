<?php
require_once 'config.php';
if (isset($_SESSION['login'])) :
  header('Location: index.php');
  exit();
endif;

// kalo ada submit / kalo tombol submit ditekan / kalo ada kiriman POST dengan key submit yang nilainya true
if (isset($_POST['submit'])) :
  if (!login()) :
    // kalo loginnya salah
    echo "<script>alert('login gagal! periksa username dan password!')</script>";
  else :
    // kalo login berhasil
    echo "<script>alert('login berhasil.'); location.href = 'product.php';</script>";
  endif;
endif;

include_once 'templates/header.php';
?>

<title>Login</title>

<body>
  <div class="login-page">

    <!-- content -->
          <div class="card-body">
            <h1 class="log-in">Login</h1>
            <form action="" method="POST">
              <div class="mb-3">
                <label for="username">Username</label>
                <input type="text" placeholder="Isi username anda" name="username" id="username" class="form-control" required>
              </div>
              <div class="mb-3">
                <label for="password">Password</label>
                <input type="password" placeholder="Isi password anda" name="password" id="password" class="form-control" required>
              </div>
              <div class="mb-3">
                <button type="submit" name="submit" class="btnSubmit">Login</button>
              </div>

            </form>
          </div>

  </div>
  <!-- end content -->



  <?php include_once 'templates/footer.php'; ?>