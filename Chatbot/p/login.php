<?php

session_start();
require_once '../assets/database/sql/db.php';
require_once '../assets/classes/classes.php';

if ($_POST) {
    $p = new persons;
    if (str_contains($_POST["userDetails"], "@")) {
        $p->getPersonByEmail($_POST["userDetails"]);
        if (password_verify($_POST["password"], $p->password)) {
            echo "yess";
        }
        else {
            echo "wrong password";
        }
    }
    else if (is_numeric($_POST["userDetails"])) {
        
    }
    else {
        $person = $p->getPersonByUsername($_POST["userDetails"]);
        if (password_verify($_POST["password"], $person["password"])) {
            echo "yess u";
        }
        else {
            echo "wrong pass";
        }
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/style/login.css">
    <link rel="stylesheet" href="../assets/style/general.css">
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <div class="container">
        <form method="post">
            <header><h1>Login</h1></header>
            <input type="text" name="userDetails" autocomplete="nickname" placeholder="username/email/student number">
            <input type="password" name="password" autocomplete="current-password" placeholder="password">
            <input type="submit" value="login">
            <div class="row spaceB"><a href="../">back</a><a href="register.php">sign up</a></div>
        </form>
    </div>
</body>
<html>    