<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LEGO (W.O.I)</title>
    <link href="parts/stylesheet.css" rel="stylesheet" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
       <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
    />
    <link rel="icon" class="icon" href="brand-lego.svg" type="image/x-icon" />
    <style>
      body{
        background-color:rgb(254, 242, 207);
      } 
    </style>
  </head>
  <body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <div class="headah">
      <nav class="header navbar navbar-expand-lg">
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
          <?php if ( isAdmin() ) : ?>
              <li class="nav-item">
                <a class="nav-link" href="/manage-users">MANAGE USERS</a>
              </li>
          <?php endif; ?>
        
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