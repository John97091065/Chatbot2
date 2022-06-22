<?php

session_start();
require('db.php');

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/style/login.css?v=1"/>
</head>
<body>

        <div class="background">
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
    
        

        <form>
            <h3>Login</h3>
            <input type="text" name="username" placeholder="username/email">
            <br /><br />
            <input type="password" name="password" placeholder="Password">
            <br> <br>
            <input type="submit">
        </form>

        
</body>
<html>    