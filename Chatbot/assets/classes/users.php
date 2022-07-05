<?php

    include "database.php";

    class users {
        function getUsers() {
            $db = new dataBase;
            $result = $db->select("*", "users");

            return $result;
        }

        function getUserById($id) {
            $db = new dataBase;
            $result = $db->select("*", "users", "id", $id);
            return $result;
        }

        function getUserByUsername($name) {
            $db = new dataBase;
            $result = $db->select("*", "users", "Uname", $name);

            return $result;
        }

        function getUserByEmail($email) {
            $db = new dataBase;
            $result = $db->select("*", "users", "email", $email);

            return $result;
        }
    }

    class user extends users {

        function generateRandomId($table) {

            $id = date('y').rand(10000,99999);

            $db = new dataBase;
            $result = $db->select("*", $table, "id", $id, true);
            if ($result) {
                $user = new user;
                $newResult = $user->generateRandomId($table);
                return $newResult;
            }

            return $id;

        }

        function createUser(string $firstName, string $lastName, string $username = null, string $password, string $email = null, int $number = null) {

            $password = password_hash($password, PASSWORD_BCRYPT);
            $user = new user;
            $id = $user->generateRandomId("users");

            $db = new dataBase;
            $connection = $db->getDDB();
            $stmt = $connection->prepare("INSERT INTO `users`(`id`, `Fname`, `Lname`, `Uname`, `password`, `email`, `Snumber`, `groups`) VALUES ('$id','$firstName','$lastName','$username','$password','$email','$number', '[]')");
            $stmt->execute();

        }

        function checkUser(string $username, string $password) {

            session_start();

            $db = new dataBase;
            $result = $db->select("*", "users", "Uname", $username);

            if ($result) {
                if (password_verify($password, $result["password"])) {
                    header("location: ../");
                    $_SESSION["username"] = $username;
                } else {
                    echo "Wrong user credentials.";
                }
            } else {
                echo "User was not found.";
            };

        }
    }