<?php

class UserTableGateway {

    private $connection;

    public function __construct($c) {
        $this->connection = $c;
    }

    public function getUserByUserName($username) {
        // execute a query to see if username is in the database
        $sqlQuery = "SELECT * FROM users WHERE username = :username";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "username" => $username
        );

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not retrieve users");
        }

        return $statement;
    }

    public function insertUser($username, $password) {
        $sqlInsert = "INSERT users(username, password) "
                . "VALUES (:username, :password)";

        $statement = $this->connection->prepare($sqlInsert);

        $params = array(
            "username" => $username,
            "password" => $password
        );

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not insert new user");
        }
    }

}
