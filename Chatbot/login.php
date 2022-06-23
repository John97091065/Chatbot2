<?php

session_start();
require_once 'assets/database/sql/db.php';
require_once 'assets/classes/classes.php';

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
    <link rel="stylesheet" href="assets/style/login.css?v=1"/>
</head>
<body>

        <div class="background">
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
    
        

        <form method="POST">
            <h3>Login</h3>
            <input type="text" name="userDetails" placeholder="username/email/studentNumber">
            <br /><br />
            <input type="password" name="password" placeholder="Password">
            <br> <br>
            <input type="submit">
            <a href="./">terugkeren</a>
        </form>

        
</body>
<html>    