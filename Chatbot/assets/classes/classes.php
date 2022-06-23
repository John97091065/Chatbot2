<?php

use LDAP\Result;

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
    function createGroup(string $groupName, int $maxMembers, array $persons, array $settings = ["theme_color"=>"grey", "display_names_allowed"=>true, "access_without_email"=>true, "student_only"=>false, "is_public"=>true]) {
        $personArr = "";
        $settingsArr = "";
        $jsonArr = ["groupName"=>$groupName, "maxAmount"=>$maxMembers, "persons"=>$personArr, "settings"=>$settingsArr];
    }
}

class persons {
    function getPersonList() {
        $db = new dataBase();
        $result = $db->select("*", "users");

        return $result;
    }

    function getPersonById($id) {
        $db = new dataBase;
        $result = $db->select("*", "users", "id", $id);
        return $result;
    }

    function getPersonByUsername($name) {
        $db = new dataBase;
        $result = $db->select("*", "users", "Uname", $name);

        return $result;
    }

    function getPersonByEmail($email) {
        $db = new dataBase;
        $result = $db->select("*", "users", "email", $email);

        return $result;
    }
}

class person extends persons {
    function createPerson(string $Fname, string $Lname, string $Uname = null, string $password, string $email = null, int $Snumber = null) {
        
        $pass = password_hash($password, PASSWORD_DEFAULT);

        $p = new person;
        $id = $p->generateId();

        $db = new dataBase();
        $con = $db->getDDB();
        $sql = "INSERT INTO `users`(`id`, `Fname`, `Lname`, `Uname`, `password`, `email`, `Snumber`, `groups`) VALUES ('$id','$Fname','$Lname','$Uname','$pass','$email','$Snumber', '[]')";
        $stmt = $con->prepare($sql);
        $stmt->execute();
    }

    function generateId() {
        $id = date('md').rand(1000,9999);
    
        $db = new dataBase();
        $result = $db->select("*", "users", "id", $id, true);

        return $id;
    }
}

class dataBase {
    
    function getDDB() {
        $server = "localhost";
        $username = "root";
        $password = "";
        $dbname = "digidave_hkau48w1";

        $con = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);
        return $con;
    }

    function select($select = "*", $table, $where = null, $value = null, $getBool = false) {
        $db = new dataBase();
        $con = $db->getDDB();
        $sql = "SELECT $select FROM `$table`";

        if (isset($where) && isset($value)) {
        $sql .= " WHERE `$where` = '$value'";
        }

        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($getBool) {
            if ($result) {
                return true;
            }
            else {
                return false;
            }
        }

        return $result[0];
    }
}