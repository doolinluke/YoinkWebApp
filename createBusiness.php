<?php

require_once 'Business.php';
require_once 'Connection.php';
require_once 'BusinessTableGateway.php';
require_once 'DealTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

$userId = $_SESSION['user_id'];

require 'ensureUserLoggedIn.php';

$connection = Connection::getInstance();
$gateway = new BusinessTableGateway($connection);
$dealGateway = new DealTableGateway($connection);

//Validates form data, removes harmful input
$businessId = filter_input(INPUT_POST, 'businessId', FILTER_SANITIZE_NUMBER_INT);
$business_name = filter_input(INPUT_POST, 'business_name', FILTER_SANITIZE_STRING);
$business_address = filter_input(INPUT_POST, 'business_address', FILTER_SANITIZE_STRING);
$business_lat = filter_input(INPUT_POST, 'business_lat',  FILTER_SANITIZE_NUMBER_FLOAT);
$business_long = filter_input(INPUT_POST, 'business_long',  FILTER_SANITIZE_NUMBER_FLOAT);
$business_type = filter_input(INPUT_POST, 'business_type', FILTER_SANITIZE_STRING);
if ($userId == -1) {
    $userId = null;
}

//if statements to validate form
$errorMessage = array();
if ($business_name === FALSE || $business_name === '') {
    $errorMessage['business_name'] = 'Business Name must not be blank<br/>';
}

if ($business_address === FALSE || $business_address === '') {
    $errorMessage['business_address'] = 'Address must not be blank<br/>';
}

if ($business_lat === FALSE || $business_lat === '') {
    $errorMessage['business_lat'] = 'Latitude must not be blank<br/>';
}

if ($business_long === FALSE || $business_long === '') {
    $errorMessage['business_long'] = 'Longitude must not be blank<br/>';
}

if ($business_type === FALSE || $business_type === '') {
    $errorMessage['business_type'] = 'Business type must not be blank<br/>';
}


$deal = $dealGateway->getDealByUserId($uId);
$row = $deal->fetch(PDO::FETCH_ASSOC);
if (empty($errorMessage)) {
    $businessId = $gateway->insertBusiness($business_name, $business_address, $business_lat, $business_long, $business_type, $userId);
    $message = "New Business Created";
    header("Location: dealPrompt.php");
}







