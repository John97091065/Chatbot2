<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create group</title>
</head>
<body>
    <div class="container">
        <form method="post">
            <input type="text" name="groupName">
            <input type="number" name="maxAmount" min="5" max="30">
            <br>
            <h2>settings</h2>
            <label for="theme_color">theme color: </label>
            <input type="color" name="theme_color">
            <br>
            <label for="display_names_allowed">display usernames: </label>
            <input type="checkbox" name="display_names_allowed" checked>
            <br>
            <label for="acces_wihout_email">allow acces without email: </label>
            <input type="checkbox" name="acces_without_email" checked>
            <br>
            <label for="student_only">only allow students: </label>
            <input type="checkbox" name="student_only">
            <br>
            <label for="is_public">invite only: </label>
            <input type="checkbox" name="is_public" checked>
        </form>
    </div>
</body>
</html>