<?php
require "parts/header.php";

//redirect if u not logged in
if (!isset($_SESSION['user'])) {
    echo "<p>Please <a href='/login'>log in</a> to view your cart.</p>";
    exit;
}

$database = connectToDB();
$user_id = $_SESSION['user']['id'];

//get da cart id
$query = $database->prepare("SELECT cart_id FROM carts WHERE user_id = :user_id");
$query->execute(['user_id' => $user_id]);
$cart = $query->fetch();

if (!$cart) {
    echo "<p>Your cart is empty.</p>";
    exit;
}

$cart_id = $cart['cart_id'];

//get da cart item with the info
$sql = "SELECT ci.quantity, p.* FROM cart_items ci 
        JOIN products p ON ci.product_id = p.product_id
        WHERE ci.cart_id = :cart_id";
$query = $database->prepare($sql);
$query->execute(['cart_id' => $cart_id]);
$items = $query->fetchAll();

if (!$items) {
    echo "<p>Your cart is empty.</p>";
    exit;
}
?>

<h1 class="container my-5 d-flex justify-content-center align-items-center">Your Cart</h1>

<div class="container my-5 d-flex justify-content-center align-items-center">
    <form action="/cart/update" method="post">
        <table class="table">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price (Each)</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            <?php $grandTotal = 0; ?>
            <?php foreach ($items as $item): ?>
                <?php 
                    $total = $item['price'] * $item['quantity'];
                    $grandTotal += $total;
                ?>
                <tr>
                    <td><?=($item['name']) ?></td>
                    <td>
                        <input type="number" name="quantities[<?= $item['product_id'] ?>]" value="<?= $item['quantity'] ?>" min="1" class="form-control" style="width: 80px;">
                    </td>
                    <td>RM <?= number_format($item['price'], 2) ?></td>
                    <td>RM <?= number_format($total, 2) ?></td>
                    <td>
                        <a href="/cart/delete?product_id=<?= $item['product_id'] ?>" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3"><b>Grand Total</b></td>
                <td><b>RM <?= number_format($grandTotal, 2) ?></b></td>
                <td></td>
            </tr>
        </table>
        <div>
            <button type="submit" class="btn btn-primary">Update Cart</button>
            <a href="/home" class="btn btn-success">Checkout</a>
        </div>
    </form>
</div>
