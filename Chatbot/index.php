<?php 

include_once "assets/database/sql/db.php";
$json = json_decode(file_get_contents("assets/uploads/groups.json"));

$groups = "";

for ($i = 0; $i < count($json); $i++) {
    $groups .= "<div class='group' onclick='Gopen( " . $json[$i]->GID . ")'>";
    $groups .= "<header>" . $json[$i]->name . "</header>";
    $groups .= "<div>" . count($json[$i]->persons) . "/" . $json[$i]->maxAmount . "</div>";
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
    <link rel="stylesheet" href="assets/style/general.css">
    <title>digiDave</title>
</head>
<body>
    <div class="topnav">
  <a class="active" href="#home"><h3>(digidave)</h3></a>
  <a href="#">login</a>
  <a href="#">Contact</a>
  <a href="#">About</a>
  <a href="#">News</a>
</div>
    <div class="container">
        <?= $groups ?>
    </div>
</body>
</html>