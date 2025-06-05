<?php

//connect to DB
$database = connectToDB ();
//get the data from the form
$password = $_POST ["password"];
$confirm_password = $_POST["password"];
$id = $_POST ["id"];
//check for error
if ( empty($password) || empty($confirm_password) ) {
    $_SESSION["error"] = "please fill up all the fields";
    header("Location: /manage-users-changepwd?id=" . $id);
    exit;
} else if ($password !== $confirm_password) {
    $_SESSION["error"] = "The password is not matching";
    header("Location: /manage-users-changepwd?id=" . $id);
    exit;
}
//update password for the user
$sql = "UPDATE users set password = :password WHERE id =:id";
$query = $database->prepare($sql);
$query->execute([
    "password" => password_hash ($password, PASSWORD_DEFAULT),
    "id" => $id
]);
//redirect
$_SESSION["success"] = "User's password have successfully been changed";
header("Location: /manage-users");
exit;