<?php
/* require_once "../assets/classes/classes.php"; */
require_once "../assets/database/sql/db.php";

$error = "";
if ($_POST) {
    $p = new persons;
    if ($p->getPersonByUsername($_POST["Uname"])) {
        $error = "username already exists";
    }
    else if ($_POST["password"] != $_POST["Cpassword"]) {
        $error = "passwords do not match";
    }
    else if ($p->getPersonByEmail($_POST["email"] && isset($_POST["email"]))) {
        $error = "email already exists";
    }
    else if (false) {
        return;
    }
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
        <form method="post">
            <header class="row">
                <div class="row">
                    <a href="login.php">Back</a> 
                </div>  

                <h1>Register</h1>
            </header>

            <div class="row">
                <input type="text" class="small" name="Fname" autocomplete="given-name" placeholder="first name*">
                <input type="text" class="small" name="Lname" autocomplete="family-name" placeholder="last name*">
            </div>
            
            <input type="text" name="Uname" autocomplete="nickname" placeholder="username">
            <div class="row">
                <input type="password" class="small" name="password" autocomplete="new-password" placeholder="password*">
                <input type="password" class="small" name="Cpassword" autocomplete="new-password" placeholder="confirm password*">
            </div>
            <input type="email" name="email" autocomplete="email" placeholder="email">
            <input type="number" name="Snumber" placeholder="student number">
            <input type="submit" value="sign up">
            <div class="error"><?= $error ?></div>
        </form>
        
    </div>
</body>
</html>