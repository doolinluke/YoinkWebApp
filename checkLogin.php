<?php

require_once 'User.php';
require_once 'Connection.php';
require_once 'UserTableGateway.php';
require_once 'BusinessTableGateway.php';
require_once 'DealTableGateway.php';

$connection = Connection::getInstance();

if (isset($_GET) && isset($_GET['sortOrder'])) {
    $sortOrder = $_GET['sortOrder'];
    $columnNames = array("businessID", "business_name", "business_address", "business_lat", "business_long", "business_type");
    if (!in_array($sortOrder, $columnNames)) {
        $sortOrder = 'businessID';
    }
}
else {
    $sortOrder = 'businessID';
}

$gateway = new UserTableGateway($connection);
$businessGateway = new BusinessTableGateway($connection);
$dealGateway = new DealTableGateway($connection);

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
/*Username not registered if getUserByUserName does not return a rowCount of 1*/
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
else {
    require 'login.php';
}

/*User sent to home page if rowCount shows that they have created at least 1 business*/
/*If user has not created their first business they are sent to welcome page*/
if (empty($errorMessage)) {$business = $businessGateway->getBusinessByUserId($row['id']);}
if (empty($errorMessage) && $business->rowCount() > 0) {
    $_SESSION['username'] = $username;
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['numBus'] = $business->rowCount();
    
    header("Location: home.php");
}
else if (empty($errorMessage) && $business->rowCount() < 1) {       
    $_SESSION['username'] = $username;
    $_SESSION['user_id'] = $row['id'];
    header("Location: welcome.php");
}
else {
    require 'login.php';
}






