<?php

session_start();

if (!isset($_GET['product_id'])) {
    header("Location: /cart");
    exit;
}

$user_id = $_SESSION['user']['id'];
$product_id = $_GET['product_id'];

$database = connectToDB();

$query = $database->prepare("SELECT cart_id FROM carts WHERE user_id = :user_id");
$query->execute(['user_id' => $user_id]);
$cart = $query->fetch();

if ($cart) {
    $cart_id = $cart['cart_id'];
    $delete = $database->prepare
    ("  DELETE 
        FROM cart_items 
        WHERE cart_id = :cart_id 
        AND product_id = :product_id
    ");
    $delete->execute([
        'cart_id' => $cart_id,
        'product_id' => $product_id
    ]);
}

header("Location: /cart");
exit;
