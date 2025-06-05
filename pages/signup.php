<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
    />
    <style type="text/css">
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
  background-color: rgb(0, 0, 0);
}

    </style>
  </head>
  <body>
      <div class="headah">
      <nav class="header navbar navbar-expand-lg" style="background-color: rgb(247, 215, 76);">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.html">
            <img
              src="brand-lego.svg"
              alt="LEGO"
              width="30"
              height="30"
              class="mb-1"
            />
          </a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav nav-underline me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="/shop">LEGO MOC SHOP</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/cart">YOUR CART</a>
              </li>
        
              <li class="button nav-item">
                <a class="nav-link text-danger" href="/all-sets">ALL SETS</a>
              </li>

            </ul>
            <ul class="navbar-nav nav-underline ms-auto mb-2 mb-lg-0">
            <?php if ( isUserLoggedIn() ) : ?>
              <li class="nav-item">
                  <a class="nav-link" href="/logout">Logout</a>
              </li>
            <?php else : ?>
              <li class="nav-item">
                  <a class="nav-link" href="/login">Login</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="/signup">Sign Up</a>
              </li>
            <?php endif; ?>
            </ul>
            
          </div>
        </div>
      </nav>
    </div>
    <div class="container my-5 mx-auto" style="max-width: 500px;"> 
        <div class="card rounded shadow-sm mx-auto my-4" style="max-width: 500px;">
            <div class="card-body">
                <h5 class="card-title text-center mb-3 py-3 border-bottom">
                Sign Up a New Account
                </h5>

                <form action="/auth/signup" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" />
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" />
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input
                    type="password"
                    class="form-control"
                    id="password"
                    name="password"
                    />
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label"
                    >Confirm Password</label
                    >
                    <input
                    type="password"
                    class="form-control"
                    id="confirm_password"
                    name="confirm_password"
                    />
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-warning btn-fu">
                    Sign Up
                    </button>
                </div>
                </form>
            </div>
        </div>

        <div
            class="d-flex justify-content-between align-items-center gap-3 mx-auto pt-3"
        >
            <a href="/" class="text-decoration-none small"
            ><i class="bi bi-arrow-left-circle"></i> Go back</a
            >
            <a href="/login" class="text-decoration-none small"
            >Already have an account? Login here
            <i class="bi bi-arrow-right-circle"></i
            ></a>
        </div>
    </div>

 </body>
</html>

