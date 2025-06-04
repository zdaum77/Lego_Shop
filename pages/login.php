<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" />
    <style>
      body {
        background: #f1f1f1;
      }
      .button {
        background-color: white;
        border-radius: 3px;
        padding-left: 15px;
        padding-right: 15px;
      }
      .button:hover {
        background-color: black;
      }
    </style>
  </head>
  <body>
    <nav class="header navbar navbar-expand-lg" style="background-color: rgb(247, 215, 76);">
      <div class="container-fluid">
        <a class="navbar-brand" href="/">
          <img src="brand-lego.svg" alt="LEGO" width="30" height="30" />
        </a>
        <div class="collapse navbar-collapse">
          <ul class="navbar-nav nav-underline me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link" href="/shop">SHOP</a></li>
            <li class="nav-item"><a class="nav-link" href="/cart">YOUR CART</a></li>
            <li class="button nav-item"><a class="nav-link text-danger" href="/all-sets">ALL SETS</a></li>
          </ul>
          <ul class="navbar-nav nav-underline ms-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
            <li class="nav-item"><a class="nav-link" href="/signup">Sign Up</a></li>
            <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container my-5 mx-auto" style="max-width: 500px;">
      <div class="card rounded shadow-sm mx-auto my-4" style="max-width: 500px;">
        <div class="card-body">
          <h5 class="card-title text-center mb-3 py-3 border-bottom">Login To Your Account</h5>

          <!-- Show error or success messages -->

          <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
          <?php endif; ?>
          <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
          <?php endif; ?>

          <!-- Login form -->
          <form action="/auth/login" method="POST">
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="email" name="email" />
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" />
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-warning btn-fu">Login</button>
            </div>
          </form>
        </div>
      </div>

      <div class="d-flex justify-content-between align-items-center gap-3 mx-auto pt-3">
        <a href="/" class="text-decoration-none small"><i class="bi bi-arrow-left-circle"></i> Go back</a>
        <a href="/signup" class="text-decoration-none small">Don't have an account? Sign up here
          <i class="bi bi-arrow-right-circle"></i></a>
      </div>
    </div>
  </body>
</html>
