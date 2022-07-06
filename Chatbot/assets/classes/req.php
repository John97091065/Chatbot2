<?php

function load($path) {
    include_once (string)$path . "assets/classes/users.php";
    include_once (string)$path . "assets/classes/groups.php";
    include_once (string)$path . "assets/classes/database.php"; 
}
