<?php

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