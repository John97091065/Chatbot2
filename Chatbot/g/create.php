<?php
require_once "../assets/database/sql/db.php";
require_once "../assets/classes/groups.php";


if ($_POST) {
    $g = new group;
    $g->createGroup(
        "../assets/uploads/groups.json",
        $_POST["groupName"], 
        $_POST["maxAmount"], 
        6235793, 
        [$_POST["users"]], 
        [
            "theme_color"=>$_POST["theme_color"], 
            "display_names_allowed"=>isset($_POST["display_names_allowed"]), 
            "acces_without_email"=>isset($_POST["acces_without_email"]), 
            "student_only"=>isset($_POST["student_only"]), 
            "is_public"=>isset($_POST["is_public"])
        ]);
        header("location: ../");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Group</title>
</head>
<body>
    <div class="container">
        <form method="post">
            <input type="text" name="groupName" placeholder="group name">
            <input type="number" name="maxAmount" min="5" max="30" placeholder="max">
            <br>
            <h2>Users</h2>
            <p>Seperate with a comma (,)</p>
            <input type="text" name="users" placeholder="username, username">
            <br>
            <h2>Settings</h2>
            <label for="theme_color">theme color: </label>
            <input type="color" name="theme_color">
            <br>
            <label for="display_names_allowed">Display usernames: </label>
            <input type="checkbox" name="display_names_allowed" checked>
            <br>
            <label for="acces_wihout_email">Allow acces without email: </label>
            <input type="checkbox" name="acces_without_email" checked>
            <br>
            <label for="student_only">Only allow students: </label>
            <input type="checkbox" name="student_only">
            <br>
            <label for="is_public">Invite only: </label>
            <input type="checkbox" name="is_public" checked>
            <input type="submit" value="create">
        </form>
    </div>
</body>
</html>