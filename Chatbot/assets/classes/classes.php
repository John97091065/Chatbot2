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
}

class group extends groups {

}

class persons {
    function getPersonList() {

    }

    function getPersonById() {

    }

    function getPersonByUsername() {

    }
}

class person extends persons {
    
}