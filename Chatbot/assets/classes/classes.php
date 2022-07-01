<?php

use LDAP\Result;

class groups {
    function getGroupList() {
        $json = json_decode(file_get_contents("../assets/uploads/groups.json"));
        return $json;
    }

    function getGroupByGid(int $GID) {
        $g = new group;
        $list = $g->getGroupList();
        return $list[$GID];
    }

    function getGroupsByName(string $name) {

    }

    function importGroup($json) {

    }
}

class group extends groups {

    function addPersonToGroup($person, $group, $author) {

    }

    function createGroup(string $file, string $groupName, int $maxMembers, int $author, array $persons = [], array $settings = ["theme_color"=>"grey", "display_names_allowed"=>true, "access_without_email"=>true, "student_only"=>false, "is_public"=>true]) {
        $personsArr = array();
        $p = new persons;
        $temp = $p->getPersonById($author);

        if ($temp == null) return false;

        unset($temp["Fname"]);
        unset($temp["Lname"]);
        unset($temp["password"]);
        unset($temp["email"]);
        unset($temp["Snumber"]);
        unset($temp["groups"]);
        unset($temp["created_at"]);

        $temp["role"] = "admin";
        array_push($personsArr, $temp);

        $p = new person;
        $GID = $p->generatePersonId("groups");

        foreach ($persons as $Pdata) {
            $p = new persons;
            if (is_string($Pdata)) {
                $temp = $p->getPersonByUsername($Pdata);
            }
            else if (is_int($Pdata)) {
                $temp = $p->getPersonById($Pdata);
            }

            if ($temp != null) {
                unset($temp["Fname"]);
                unset($temp["Lname"]);
                unset($temp["password"]);
                unset($temp["email"]);
                unset($temp["Snumber"]);
                unset($temp["groups"]);
                unset($temp["created_at"]);

                $temp["role"] = "participant";
                array_push($personsArr, $temp);
            }
        } 

        $GID = rand(100000, 999999);

        $jsonArr = ["GID"=>$GID, "groupName"=>$groupName, "maxAmount"=>$maxMembers, "persons"=>$personsArr, "settings"=>$settings];

        $inp = file_get_contents($file);
        $tempArray = json_decode($inp, true);
        
        if (isset($tempArray)) {
            array_push($tempArray, $jsonArr);    
        }
        else {
            $tempArray = [];
            array_push($tempArray, $jsonArr);    
        }

        $jsonData = json_encode($tempArray, JSON_PRETTY_PRINT);
        file_put_contents($file, $jsonData);

        $db = new dataBase;
        $stmt = $db->insert("groups", "GID, groupName", "$GID, $groupName");
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
        $id = $p->generatePersonId("users");

        $db = new dataBase();
        $con = $db->getDDB();
        $sql = "INSERT INTO `users`(`id`, `Fname`, `Lname`, `Uname`, `password`, `email`, `Snumber`, `groups`) VALUES ('$id','$Fname','$Lname','$Uname','$pass','$email','$Snumber', '[]')";
        $stmt = $con->prepare($sql);
        $stmt->execute();
    }

    function generatePersonId($table) {
        $id = date('y').rand(1000,9999);
    
        $db = new dataBase();
        $result = $db->select("*", $table, "id", $id, true);
        if ($result) {
            $p = new person;
            $r = $p->generatePersonId($table);
            return $r;
        }

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

        if ($result) {
            if ($getBool) {
                return true;
            }
        }
        else {
            if ($getBool) {
                return false;
            }
            return null;
        }

        return $result[0];
    }

    function insert($table, $cols, $values) {
        $db = new dataBase();
        $con = $db->getDDB();
        $sql = "INSERT INTO $table ($cols) VALUES $values";
    }
}