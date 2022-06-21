<?php

class groups {
    function getGroupList() {
        $json = json_decode(file_get_contents("assets/uploads/groups.json"));
        return $json;
    }
}