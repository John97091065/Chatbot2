<?php

require_once "../assets/classes/login.php";

if (isset($_POST["login"])) {

    $user = new user;
    $user->checkUser($_POST["username"], $_POST["password"]);
   
}

if (isset($_POST["register"])) {

    $user = new user;
    $user->createUser($_POST["firstName"], $_POST["lastName"], $_POST["username"], $_POST["password"], $_POST["email"], $_POST["number"]);
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Systeem</title>
    <link rel="stylesheet" href="style.css" type="text/css">
    <script src=""></script>
</head>
<body>
    <a href="../">Back</a>
    <div class="container">
        <?php if (isset($_GET["action"]) == "register") { ?>
        <form method="post">
            <span class="title">Register</span>
            <input type="text" name="firstName" placeholder="First Name">
            <input type="text" name="lastName" placeholder="Last Name">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="password" placeholder="Password">
            <input type="password" name="passwordConfirm" placeholder="Confirm Password">
            <input type="email" name="email" placeholder="name@example.com">
            <input type="number" name="number" placeholder="12345678">
            <input type="submit" name="register" value="Register">
            <a href="./">Login</a>
        </form>
        <?php } else { ?>
        <form method="post">
            <span class="title">Login</span>
            <span class="status"></span>
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="password" placeholder="Password">
            <input type="submit" name="login" value="Login">
            <a href="./?action=register">Register</a>
        </form>
        <?php } ?>
    </div>
</body>
</html>