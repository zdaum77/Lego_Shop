<?php
$database = connectToDB();
$success = false;
$error = '';

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
            $image = $uploadPath;
        } else {
            $error = "Failed to upload image.";
        }
    } else {
        $error = "Image is required.";
    }

    if ($name && isset($image) && $price && $description) {
        if (!isset($_SESSION['user'])) {
            $error = "You must be logged in to add a product.";
        } else {
            $user_id = $_SESSION['user']['id'];
            $sql = "INSERT INTO products (name, image, price, description, user_id) 
                    VALUES (:name, :image, :price, :description, :user_id)";
            $query = $database->prepare($sql);
            $success = $query->execute([
                'name' => $name,
                'image' => $image,
                'price' => $price,
                'description' => $description,
                'user_id' => $user_id
            ]);
        }

        if ($success) {
            header("Location: /shop");
            exit;
        } else {
            $error = "Please login to add your own product.";
        }
    } elseif (!$error) {
        $error = "All fields are required.";
    }
}
?>

<?php require "parts/header.php"; ?>

<div class="d-flex justify-content-center align-items-center mt-3">
    <h2>Add New Product</h2>
</div>

<div class="d-flex justify-content-center align-items-center mt-5 p-5" style="background-color:#fef5df;">
    <form method="post" enctype="multipart/form-data">
        <label>Product Name:<br>
            <input type="text" name="name" class="input">
        </label><br><br>

        <label>Image File:<br>
            <input type="file" name="image" accept="image/*">
        </label><br><br>

        <label>Price:<br>
            <input type="text" name="price" class="input">
        </label><br><br>

        <label>Description:<br>
            <textarea name="description" rows="4" cols="30" class="input"></textarea>
        </label><br><br>

        <button class="botton" type="submit">Add Product</button>
    </form>
</div>

<div class="d-flex justify-content-center align-items-center mt-3">
    <?php if ($error): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>
</div>

<div class="d-flex justify-content-center align-items-center mt-5 mb-3">
    <a href="/shop" class="text-decoration-none text-dark">
        <button class="boton p-3 border-0 rounded-3">Go back to the Shop</button>
    </a>
</div>
