<?php
session_start();

// Get email and password from POST
$email = $_POST["email"];
$password = $_POST["password"];

// Check if fields are empty
if (empty($email) || empty($password)) {
    $_SESSION["error"] = "All fields are required";
    header("Location: /login");
    exit;
}

// Get user by email
$user = getUserByEmail($email);

if ($user) {
    // Verify password
    if (password_verify($password, $user["password"])) {
        // Set session only if password is valid
        $_SESSION["user"] = [
            'id' => $user["id"], // adjust to match your DB column
            'name' => $user["name"],
            'role' => $user["role"]
        ];

        $_SESSION["success"] = "Welcome back, " . $user["name"] . "!";
        header("Location: /dashboard");
        exit;
    } else {
        $_SESSION["error"] = "The password provided is incorrect";
        header("Location: /login");
        exit;
    }
} else {
    $_SESSION["error"] = "The email provided does not exist";
    header("Location: /login");
    exit;
}
?>
