<?php 

require_once "./assets/database/sql/db.php";
require_once "./assets/classes/classes.php";

$json = json_decode(file_get_contents("assets/uploads/groups.json"));

if (!isset($json)) {
    $json = array();
}

$groups = "";

for ($i = 0; $i < count($json); $i++) {
    $groups .= "<div class='group' onclick='Gopen( " . $i . ")' style='background: radial-gradient(white 1% ," . $json[$i]->settings->theme_color . ")'>";
    $groups .= "<h2>" . $json[$i]->groupName . "</h2>";
    $groups .= "<div><h4>" . count($json[$i]->persons) . "/" . $json[$i]->maxAmount . "</h4></div>";
    $groups .= "</div>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style/home.css">
    <link rel="stylesheet" href="assets/style/nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/style/general.css">
    <script src="assets/js/groups.js"></script>
    <title>digiDave</title>
</head>
<body>
    <?php include "assets/includes/header.php" ?>
    <div class="container">
        <?= $groups ?>

        <div class="group" onclick="window.location = 'g/create.php'">
        <h1>+</h1>
        </div>
    </div>
    
</body>
</html>