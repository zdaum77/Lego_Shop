<?php

$database = connectToDB();



//lets get the user infow from POST in carrt
$user_id = $_SESSION['user']['id'];
$product_id = $_POST['product_id'] ?? null;
$quantity = max(1, (int)($_POST['quantity'] ?? 1));


//if no product id just go back
if (!$product_id) {
    header("Location: /shop");
    exit;
}

//create a cart for a new user
$query = $database->prepare("SELECT cart_id FROM carts WHERE user_id = :user_id");
$query->execute(['user_id' => $user_id]);
$cart = $query->fetch();


//check is user has a cart if no cart then just make a new one, if have then use old one
if (!$cart) {
    $insert = $database->prepare("INSERT INTO carts (user_id) VALUES (:user_id)");
    $insert->execute(['user_id' => $user_id]);
    $cart_id = $database->lastInsertId();
} else {
    $cart_id = $cart['cart_id'];
}


//use dis to check if product alr in cart
$query = $database->prepare("SELECT quantity FROM cart_items WHERE cart_id = :cart_id AND product_id = :product_id");
$query->execute(['cart_id' => $cart_id, 'product_id' => $product_id]);
$item = $query->fetch();



//for if the product is already in the cart so we update it
if ($item) {
    $newQuantity = $item['quantity'] + $quantity;
    $update = $database->prepare
    ("  UPDATE cart_items 
        SET quantity = :quantity 
        WHERE cart_id = :cart_id 
        AND product_id = :product_id
    ");
    $update->execute([
        'quantity' => $newQuantity,
        'cart_id' => $cart_id,
        'product_id' => $product_id
    ]);



} else {
    //dis for inserting in the tableh as a new row
    $insert = $database->prepare
    ("  INSERT INTO cart_items (cart_id, product_id, quantity) 
        VALUES (:cart_id, :product_id, :quantity)
    ");
    $insert->execute([
        'cart_id' => $cart_id,
        'product_id' => $product_id,
        'quantity' => $quantity
    ]);
}

header("Location: /cart");
exit;
