<?php

require_once("users.php");

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

    function addUserToGroup($user, $group, $author) {

    }

    function createGroup(string $file, string $groupName, int $maxMembers, int $author, array $users = [], array $settings = ["theme_color"=>"grey", "display_names_allowed"=>true, "access_without_email"=>true, "student_only"=>false, "is_public"=>true]) {
        $usersArr = array();
        $u = new users;
        $temp = $u->getUserById($author);

        if ($temp == null) return false;

        unset($temp["Fname"]);
        unset($temp["Lname"]);
        unset($temp["password"]);
        unset($temp["email"]);
        unset($temp["Snumber"]);
        unset($temp["groups"]);
        unset($temp["created_at"]);

        $temp["role"] = "admin";
        array_push($usersArr, $temp);

        $u = new user;
        $GID = $u->generateRandomId("groups");

        foreach ($users as $Udata) {
            $u = new users;
            if (is_string($Udata)) {
                $temp = $u->getUserByUsername($Udata);
            }
            else if (is_int($Udata)) {
                $temp = $u->getUserById($Udata);
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
                array_push($usersArr, $temp);
            }
        } 

        $GID = rand(100000, 999999);

        $jsonArr = ["GID"=>$GID, "groupName"=>$groupName, "maxAmount"=>$maxMembers, "persons"=>$usersArr, "settings"=>$settings];

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