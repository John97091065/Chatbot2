<?php

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