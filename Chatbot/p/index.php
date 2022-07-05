<?php

require_once "../assets/classes/users.php";

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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/general.css">
    <link rel="stylesheet" href="../assets/style/register.css">
    <title>sign-up</title>
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <div class="container">
        <?php if (isset($_GET["action"]) == "register") { ?>
        <form method="post">
            <header class="row">
                <div class="row">
                    <a href="login.php">Back</a> 
                </div>
                <h1>Register</h1>
            </header>
            <div class="row">
                <input type="text" class="small" name="firstName" autocomplete="given-name" placeholder="first name*">
                <input type="text" class="small" name="lastName" autocomplete="family-name" placeholder="last name*">
            </div>
            <input type="text" name="username" autocomplete="nickname" placeholder="username">
            <div class="row">
                <input type="password" class="small" name="password" autocomplete="new-password" placeholder="password*">
                <input type="password" class="small" name="Cpassword" autocomplete="new-password" placeholder="confirm password*">
            </div>
            <input type="email" name="email" autocomplete="email" placeholder="email">
            <input type="number" name="number" placeholder="student number">
            <input type="submit" value="Sign Up" name="register">
        </form>
        <?php } else { ?>
        <form method="post">
            <header><h1>Login</h1></header>
            <input type="text" name="username" autocomplete="nickname" placeholder="Username">
            <input type="password" name="password" autocomplete="current-password" placeholder="Password">
            <input type="submit" value="Login" name="login">
            <div class="row spaceB"><a href="../">Back</a><a href="./?action=register">Sign Up</a></div>
        </form>
        <?php } ?>
    </div>
</body>
</html>