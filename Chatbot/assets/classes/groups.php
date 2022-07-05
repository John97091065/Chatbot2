<?php

include "users.php";
include "database.php";

class groups {
    function getGroupList($file) {
        $json = json_decode(file_get_contents($file));
        return $json;
    }

    function getGroupByIndex(int $index, $file) {
        $g = new groups;
        $list = $g->getGroupList($file);
        return $list[$index];
    }

    function getGroupByGid($GID, $file) {
        $g = new groups;
        $list = $g->getGroupList($file);
        for ($i = 0; $i < count($list); $i++) {
            if ($list[$i]->GID == $GID) {
                return $list[$i];
            }
        }
    }

    function getGroupsByName(string $name) {

    }
}

class group extends groups {

    function getAccesibleGroups(array $user) {
        $u = new users;
        $user = $u->getUserById($user["id"]);

        $user["groups"];
    }

    function addPersonToGroup($user, $group, $author) {

    }

    function createGroup(string $file, string $groupName, int $maxMembers, int $author, array $users = [], array $settings = ["theme_color"=>"grey", "display_names_allowed"=>true, "access_without_email"=>true, "student_only"=>false, "is_public"=>true]) {
        $usersArr = array();
        $u = new persons;
        $temp = $u->getPersonById($author);

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

        $u = new person;
        $GID = $u->generatePersonId("groups");

        foreach ($users as $Pdata) {
            $u = new persons;
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