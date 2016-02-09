<?php

require_once 'User.php';
require_once 'Connection.php';
require_once 'UserTableGateway.php';

$connection = Connection::getInstance();

$gateway = new UserTableGateway($connection);


/* Starts new session if session doesn't already exist */
$id = session_id();
if ($id == "") {
    session_start();
}

/* Validates data entered and filters it to be applicable to the field */
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);


/* Error message array for data entered */
/* If data is blank error message is shown */
$errorMessage = array();
if ($username === FALSE || $username === '') {
    $errorMessage['username'] = 'Username must not be blank<br/>';
}

if ($password === FALSE || $password === '') {
    $errorMessage['password'] = 'Password must not be blank<br/>';
}

if (empty($errorMessage)) {
    $statement = $gateway->getUserByUserName($username);
    if ($statement->rowCount() != 1) {
        $errorMessage['username'] = 'Username not registered<br/>';
    } else if ($statement->rowCount() == 1) {
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if ($password !== $row['password']) {
            $errorMessage['password'] = 'Invalid password<br/>';
        }
    }
}

if (empty($errorMessage)) {
    $_SESSION['username'] = $username;
    $_SESSION['user_id'] = $row['id'];
    header("Location: home.php");
} else {
    require 'index.php';
}










