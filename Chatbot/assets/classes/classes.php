<?php

class groups {
    function getGroupList() {
        $json = json_decode(file_get_contents("assets/uploads/groups.json"));
        return $json;
    }

    function getGroupByGid(int $GID) {

    }

    function getGroupsByName(string $name) {

    }

    function importGroup($json) {

    }
}

class group extends groups {

    function __construct(string $groupName, int $maxMembers, array $persons, array $settings = ["theme_color"=>"grey", "display_names_allowed"=>true, "access_without_email"=>true, "student_only"=>false, "is_public"=>false]) {
        $personArr = "";
        $settingsArr = "";
        $jsonArr = ["groupName"=>$groupName, "maxAmount"=>$maxMembers, "persons"=>$personArr, "settings"=>$settingsArr];
    }
}

class persons {
    function getPersonList() {

    }

    function getPersonById($id) {
        $con = new database();
        $conn = $con->getCon();
        $sql = "SELECT * from `users` WHERE `id` = $id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getPersonByUsername() {

    }
}

class person extends persons {
    
}

class dataBase {
    
    function getCon() {
        $server = "localhost";
        $username = "root";
        $password = "";
        $dbname = "digidave_hkau48w1";

        $con = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);
        return $con;
    }
}