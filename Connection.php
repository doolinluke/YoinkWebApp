<?php

class Connection { //create a class to make the connection

    private static $connection = NULL;

    public static function getInstance() {
        /* Creates new connection if connection doesn't already exist */
        if (Connection::$connection === NULL) {
            $host = 'localhost'; //specify login details to phpmyadmin page
            $database = 'yoink_database';
            $username = 'root';
            $password = '';
            $dsn = 'mysql:dbname=' . $database . ";host=" . $host;

            Connection::$connection = new PDO($dsn, $username, $password);
            if (!Connection::$connection) { //tests the connection
                die("Could not connect to database!");
            }
        }

        return Connection::$connection;
    }

}
