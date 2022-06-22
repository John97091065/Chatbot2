<?php

$server = "localhost";
$username = "root";
$password = "";
$dbname = "digidave_hkau48w1";

$conn = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);

$cconn = $conn;