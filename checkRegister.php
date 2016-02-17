<?php

require_once 'User.php';
require_once 'Connection.php';
require_once 'UserTableGateway.php';

$connection = Connection::getInstance();

$gateway = new UserTableGateway($connection);


/* Start new if doesn't already exist */
$id = session_id();
if ($id == "") {
    session_start();
}

/* Filters input to only accept correct characters */
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$password2 = filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_STRING);

/* Error message array runs through all fields to check if they have been left blank */
$errorMessage = array();
if ($username === FALSE || $username === '') {
    $errorMessage['username'] = 'Username must not be blank<br/>';
} else {
    // execute a query to see if username is in the database
    $statement = $gateway->getUserByUsername($username);

    // if the username is in the database then add an error message
    // to the errorMessage array
    if ($statement->rowCount() !== 0) {
        $errorMessage['username'] = 'Username already registered<br/>';
    }
}
if ($password === FALSE || $password === '') {
    $errorMessage['password'] = 'Password must not be blank<br/>';
}

if ($password2 === FALSE || $password2 === '') {
    $errorMessage['password2'] = 'Confirm password must not be blank<br/>';
} else if ($password !== $password2) {
    $errorMessage['password2'] = 'Passwords must match<br/>';
}

/* Inserts user details into database and retreives details back to pass into the session */
/*Sent to welcome page instead of home page*/
if (empty($errorMessage)) {
    $gateway->insertUser($username, $password);
    $statement = $gateway->getUserByUserName($username);
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    $_SESSION['username'] = $username;
    $_SESSION['user_id'] = $row['id'];
    header('Location: welcome.php');
}

/* Sent back to register if the above fails */ else {
    require 'register.php';
}











