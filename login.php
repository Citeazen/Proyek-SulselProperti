<?php
require_once 'config.php';
if (isset($_SESSION['login'])):
  header('Location: index.php');
  exit();
endif;

// kalo ada submit / kalo tombol submit ditekan / kalo ada kiriman POST dengan key submit yang nilainya true
if (isset($_POST['submit'])):
  if (!login()):
    // kalo loginnya salah
    echo "<script>alert('login gagal! periksa username dan password!')</script>";
  else:
    // kalo login berhasil
    echo "<script>alert('login berhasil.'); location.href = 'index.php';</script>";
  endif;
endif;

include_once 'templates/header.php';
?>

<title>Login</title>

<body>
  <div class="container">

    <!-- content -->
    <div class="row justify-content-center mt-5">
      <div class="col-md-7">
        <div class="card border-0 shadow bg-light">
          <div class="card-body">
            <h1 class="my-3 text-center">Login</h1>
            <form action="" method="POST">
              <div class="mb-3">
                <label for="username">Username</label>
                <input type="text" placeholder="Isi username anda" name="username" id="username" class="form-control"
                  required>
              </div>
              <div class="mb-3">
                <label for="password">Password</label>
                <input type="password" placeholder="Isi password anda" name="password" id="password"
                  class="form-control" required>
              </div>
              <div class="mb-3">
                <button type="submit" name="submit" class="btn btn-success w-100">Login</button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- end content -->

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
    crossorigin="anonymous"></script>

  <?php include_once 'templates/footer.php'; ?>