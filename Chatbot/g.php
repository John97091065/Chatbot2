<?php
require_once "assets/database/sql/db.php";
require_once "assets/classes/classes.php";

$grouplist = new groups();
$grouplist = $grouplist->getGroupList();

$group = $grouplist[$_GET["g"]];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style/group.css">
    <link rel="stylesheet" href="assets/style/general.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="assets/js/groups.js"></script>
    <title><?= strval($group->groupName) ?></title>
</head>
<body>
    <div class="container">
        <div class="persons">
            <header>
                <p class="fa-solid fa-gear"></p>
                <p>personen</p>
                <p>X</p>
            </header>
            <div class="wrapper">
                <div class="pHeader">
                    <h4>Name</h4>
                    <h4>role</h4>
                    <h4>...</h4>
                </div>
                <?php for ($i = 0; count($group->persons) > $i; $i++) { ?>
                <div class="person">
                    <p class="userName"><?= $group->persons[$i]->Uname ?></p>
                    <p class="role"><?= $group->persons[$i]->role ?></p>
                    <p class="Psettings">...</p>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="chat">

        </div>
    </div>
</body>
</html>