<?php

$user_id = $_SESSION['user']['id'];
$database = connectToDB();


$query = $database->prepare("SELECT cart_id FROM carts WHERE user_id = :user_id");
$query->execute(['user_id' => $user_id]);
$cart = $query->fetch();

if (!$cart) {
    header("Location: /cart");
    exit;
}

$cart_id = $cart['cart_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quantities'])) {
    foreach ($_POST['quantities'] as $product_id => $quantity) {
        $quantity = max(1, (int)$quantity);

        $updateStmt = $database->prepare
        ("  UPDATE cart_items 
            SET quantity = :quantity 
            WHERE cart_id = :cart_id AND product_id = :product_id
        ");
        $updateStmt->execute([
            'quantity' => $quantity,
            'cart_id' => $cart_id,
            'product_id' => $product_id
        ]);
    }
}

header("Location: /cart");
exit;
