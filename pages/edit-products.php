<?php
require "parts/header.php";
$database = connectToDB();


if (!isset($_SESSION['user'])) {
    echo "<p>You must be logged in to edit a product.</p>";
    exit;
}

$user_id = $_SESSION['user']['id'];


$product_id = $_GET['id'] ?? 0;


$role = $_SESSION['user']['role'];

if ($role === 'admin' || $role === 'editor') {
    $query = $database->prepare("SELECT * FROM products WHERE product_id = :product_id");
    $query->execute(['product_id' => $product_id]);
} else {
    $query = $database->prepare("SELECT * FROM products WHERE product_id = :product_id AND user_id = :user_id");
    $query->execute([
        'product_id' => $product_id,
        'user_id' => $user_id
    ]);
}

$product = $query->fetch();

if (!$product) {
    echo "<p>Product not found or you don't have permission to edit it.</p>";
    exit;
}

$error = '';
$success = false;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $imageTmp = $_FILES['image']['tmp_name'];
        $imageName = basename($_FILES['image']['name']);
        $uploadDir = 'uploads/';
        $uploadPath = $uploadDir . $imageName;

        if (move_uploaded_file($imageTmp, $uploadPath)) {
            $product['image'] = $uploadPath;
        } else {
            $error = "Failed to upload image.";
        }
    }



    if (!$error) {
        $query = $database->prepare("UPDATE products SET name = :name, price = :price, description = :description, image = :image WHERE product_id = :product_id");
        $success = $query->execute([
            'name' => $name,
            'price' => $price,
            'description' => $description,
            'image' => $product['image'],
            'product_id' => $product_id,
        ]);
        }    else {
        $query = $database->prepare("UPDATE products SET name = :name, price = :price, description = :description, image = :image WHERE product_id = :product_id AND user_id = :user_id");
        $success = $query->execute([
            'name' => $name,
            'price' => $price,
            'description' => $description,
            'image' => $product['image'],
            'product_id' => $product_id,
            'user_id' => $user_id
        ]);
        
        }
        if ($success) {
            header("Location: /product?id=$product_id");
            exit;
        } else {
            $error = "Failed to update product.";
        }
    }

?>

<div class="containeh my-5">
    <h2>Edit Product</h2>
    <div class="cared p-4 justify-content-center align-items-center d-flex ">
        <form method="POST" enctype="multipart/form-data">
            <label>Product Name:<br>
                <input type="text" name="name" value="<?= ($product['name']) ?>" class="input" required>
            </label><br><br>

            <label>Price:<br>
                <input type="text" name="price" value="<?= $product['price'] ?>" class="input" required>
            </label><br><br>

            <label>Description:<br>
                <textarea name="description" rows="4" cols="30" class="input" required><?= ($product['description']) ?></textarea>
            </label><br><br>

            <label>Current Image:<br>
                <img src="<?= $product['image'] ?>" style="max-width: 200px;" alt="Product Image"><br>
                <small>You can upload a new image below:</small>
            </label><br><br>

            <label>New Image (optional):<br>
                <input type="file" name="image" accept="image/*">
            </label><br><br>

            <button type="submit" class="boton2 p-2 border-0 rounded-3">Update Product</button>
        </form>

        <?php if ($error): ?>
            <p class="text-danger mt-3"><?= $error ?></p>
        <?php endif; ?>
    </div>

    <div class="d-flex justify-content-center align-items-center mt-5 mb-3">
        <a href="/shop" class="text-decoration-none text-dark">
            <button class="boton p-3 border-0 rounded-3">Go back to the Shop</button>
        </a>
    </div>
</div>
