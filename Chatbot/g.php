<?php
require_once "assets/database/sql/db.php";
require_once "assets/classes/classes.php";

$groups = new groups();
$groups = $groups->getGroupList();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= strval($groups[0]->groupName) ?></title>
</head>
<body>

</body>
</html>