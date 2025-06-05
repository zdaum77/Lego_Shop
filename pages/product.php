<?php

require "parts/header.php";
$database = connectToDB();

if (!isset($_SESSION['user'])) {
    echo "<p>You must be logged in to view the product or buy it</p>";
    exit;
}

$user_id = $_SESSION['user']['id'];
$user_name = $_SESSION['user']['name'];

// product info
$product_id = $_GET['id'] ?? 0;
$query = $database->prepare("SELECT * FROM products WHERE product_id = :product_id");
$query->execute(['product_id' => $product_id]);
$product = $query->fetch();

if (!$product) {
    echo "<p>Product not found.</p>";
    exit;
}

// handle review
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $review = $_POST['review'];
    if ($review) {
        $insert = $database->prepare("INSERT INTO reviews (product_id, user_id, name, review) VALUES (:product_id, :user_id, :name, :review)");
        $insert->execute([
            'product_id' => $product_id,
            'user_id' => $user_id,
            'name' => $user_name,
            'review' => $review
        ]);
        $mode = $_GET['mode'] ?? 'buy';
        header("Location: /product?id=" . $product_id . "&mode=" . urlencode($mode));
        exit;
    }
}

// get reviews
$reviews = $database->prepare("SELECT * FROM reviews WHERE product_id = :product_id ORDER BY created_at DESC");
$reviews->execute(['product_id' => $product_id]);
$allReviews = $reviews->fetchAll();

$mode = $_GET['mode'] ?? 'buy';

?>

<div style="background-color:white;">
    <div class="container my-5 mt-0 justify-content-center align-items-center">
        <div class="card p-4">
            <h2><?= $product['name'] ?></h2>
            <img src="<?= $product['image'] ?>" style="max-width:300px;" />
            <p><b>Price:</b> RM <?= $product['price'] ?></p>
            <p><?= nl2br($product['description']) ?></p>

            <?php if ($mode === 'buy'): ?>
                <form action="/add-cart" method="POST">
                    <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                    <input type="number" name="quantity" value="1" min="1" required>
                    <button type="submit">Add to Cart</button>
                </form>
            <?php endif; ?>
        </div>

        <div class="mt-4 rounded-5" style="background-color:rgb(255, 225, 91); padding:50px; padding-top: 70px; padding-bottom: 70px;">
            <h3>Leave a Review</h3>
            <p>Reviewing as <b><?= $user_name ?></b></p>
            <form method="POST">
                <textarea name="review" placeholder="Write your review here..." rows="4" required></textarea><br><br>
                <button type="submit" class="boton2" style="border-radius:5px;">Submit Review</button>
            </form>
        </div>
    </div>
</div>

<div class="m-5">
    <h3>Reviews</h3>
    <?php if (count($allReviews) > 0): ?>
        <?php foreach ($allReviews as $r): ?>
            <div class="border p-3 mb-2 border-black rounded-2" style="background-color:rgb(255, 225, 91);">
                <u><b><h4><?= $r['name'] ?></h4></b></u>
                <p><?= nl2br($r['review']) ?></p>
                <small><i><?= $r['created_at'] ?></i></small>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No reviews yet.</p>
    <?php endif; ?>
</div>

<div class="d-flex justify-content-center align-items-center mt-5 mb-3">
    <a href="/shop" class="text-decoration-none text-dark">
        <button class="boton p-3 border-0 rounded-3">Go back to the Shop</button>
    </a>
</div>
