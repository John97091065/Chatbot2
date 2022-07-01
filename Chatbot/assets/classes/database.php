<?php

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