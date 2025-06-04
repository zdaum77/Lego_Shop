<?php 

    // start session
    session_start();

    // require the functions file
    require "includes/functions.php";

    // figure out which path the user is on
    $path = $_SERVER["REQUEST_URI"];
    // remove all the query string from the url
    $path = parse_url( $path, PHP_URL_PATH );

    switch ($path) {
      // pages routes
      case '/login':
        require "pages/login.php";
        break;
      case '/signup':
        require "pages/signup.php";
        break;
      case '/logout':
        require "pages/logout.php";
        break;
      case "/all-sets":
        require "pages/a.php";
        break;
      case "/city":
        require "pages/c.php";
        break;
      case "/creator":
        require "pages/cr.php";
        break;
      case "/ninjago":
        require "pages/n.php";
        break;
      case "/others":
        require "pages/o.php";
        break;
      case "/star-wars":
        require "pages/s.php";
        break;
      case "/shop":
        require "pages/shop.php";
        break;
      case "/cart":
        require "pages/cart.php";
        break;
      case "/add":
        require "pages/add-products.php";
        break;
      case "/edit":
        require "pages/edit-products.php";
        break;
      case "/add-cart":
        require "pages/add-cart.php";
        break;
      case "/product":
        require "pages/product.php";
        break;
      // actions routes
      case '/auth/login':
        require "includes/auth/do-login.php";
        break;
      case '/auth/signup':
        require "includes/auth/do-signup.php";
        break;
      case '/cart/delete':
        require "includes/cart/delete-cart.php";
        break;
      case '/cart/update':
        require "includes/cart/update-cart.php";
        break;
      case '/products/delete':
        require "includes/products/delete-product.php";
        break;
        default:
        require "pages/home.php";
        break;
      }
      // setup the action route for add user
      // case '/user/add':
      //   require "includes/user/add.php";
      //   break;
      // setup the action for delete user
      // case '/user/delete':
      //   require "includes/user/delete.php";
      //   break;
      // case '/user/update':
      //   require "includes/user/update.php";
      //   break;
      // case '/user/changepwd':
      //   require "includes/user/changepwd.php";
      //   break;
      // case '/post/delete':
      //   require "includes/post/delete.php";
      //   break;
      // case '/post/add':
      //   require "includes/post/add.php";
      //   break;
      // case '/post/update':
      //   require "includes/post/update.php";
      //   break;