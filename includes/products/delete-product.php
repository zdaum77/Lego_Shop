<?php

require "parts/header.php";
$database = connectToDB();

if (!isset($_SESSION['user'])) {
    echo "You must be logged in to delete a product.";
    exit;
}

$user_id = $_SESSION['user']['id'];
$product_id = $_GET['id'] ?? null;

if (!$product_id) {
    echo "Product ID is missing.";
    exit;
}

// Check product owner
$query = $database->prepare("SELECT user_id FROM products WHERE product_id = :product_id");
$query->execute(['product_id' => $product_id]);
$product = $query->fetch();

if (!$product) {
    echo "Product not found.";
    exit;
}

$currentUser = $_SESSION['user'];
$role = $currentUser['role'];

if ($product['user_id'] != $currentUser['id'] && $role !== 'admin') {
    echo "You are not allowed to delete this product.";
    exit;
}

// Delete from cart_items first
$query = $database->prepare("DELETE FROM cart_items WHERE product_id = :product_id");
$query->execute(['product_id' => $product_id]);

// Delete product
$delete = $database->prepare("DELETE FROM products WHERE product_id = :product_id");
if ($delete->execute(['product_id' => $product_id])) {
    header("Location: /shop");
    exit;
} else {
    echo "Failed to delete product.";
    exit;
}
?>
