<?php

require "parts/header.php";
$database = connectToDB();
$sql = "SELECT * FROM products";
$query = $database->prepare($sql);
$query->execute();
$products = $query->fetchAll();

?>

<div class="d-flex justify-content-center align-items-center m-5" style="background-color:rgb(255, 225, 91);">
  <a href="/add" class="text-decoration-none text-dark">
    <button class="boton p-3 border-0 rounded-3">Add Your Own Product<br>(Click Here)</button>
  </a>
</div>

<div class="justify-content-center align-items-center m-5">
  <div class="row justify-content-center align-items-center">

    <?php foreach ($products as $p): ?>
      <div class="card col-lg-3 col-md-4 col-6">

        <img src="<?= $p['image'] ?>" class="imglego" />

        <div class="intro">
          <h1 id="h1"><?= $p['name'] ?></h1>
          <p id="p">
            RM <?= $p['price'] ?><br/>
            <?= nl2br(strlen($p['description']) > 100 ? substr($p['description'], 0, 100) . '...' : $p['description']) ?>
            <br/><hr>

       <?php if (isset($_SESSION['user'])): ?>
  <?php
    $currentUser = $_SESSION['user'];
    $isOwner = $currentUser['id'] == $p['user_id'];
    $isEditor = $currentUser['role'] === 'editor';
    $isAdmin = $currentUser['role'] === 'admin';
  ?>

  <?php if ($isOwner || $isEditor || $isAdmin): ?>
    <a href="/edit?id=<?= $p['product_id'] ?>" class="text-decoration-none text-dark">
      <button class="boton2 p-2 border-0 rounded-3">Edit</button>
    </a>
    <a href="/product?id=<?= $p['product_id'] ?>&mode=view" class="text-decoration-none text-dark">
      <button class="boton2 p-2 border-0 rounded-3">View</button>
    </a>
    <?php if ($isOwner || $isAdmin): ?>
      <a href="/products/delete?id=<?= $p['product_id'] ?>" onclick="return confirm('Are you sure you want to delete this product?');" class="text-decoration-none text-dark">
        <button class="btn btn-danger p-2 rounded-3">Delete</button>
      </a>
    <?php endif; ?>
  <?php else: ?>
    <a href="/product?id=<?= $p['product_id'] ?>" class="text-decoration-none text-dark">
      <button class="boton2 p-2 border-0 rounded-3">BUY</button>
    </a>
  <?php endif; ?>
<?php else: ?>
  <a href="/product?id=<?= $p['product_id'] ?>" class="text-decoration-none text-dark">
    <button class="boton2 p-2 border-0 rounded-3">BUY</button>
  </a>
<?php endif; ?>


          </p>
        </div>

      </div>
    <?php endforeach; ?>

  </div>
</div>
