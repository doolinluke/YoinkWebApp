<?php

require_once 'Business.php';
require_once 'Connection.php';
require_once 'BusinessTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';

$connection = Connection::getInstance();
$gateway = new BusinessTableGateway($connection);

//Validates form data, removes harmful input
$businessId = filter_input(INPUT_POST, 'businessId', FILTER_SANITIZE_NUMBER_INT);
$business_name = filter_input(INPUT_POST, 'business_name', FILTER_SANITIZE_STRING);
$business_address = filter_input(INPUT_POST, 'business_address', FILTER_SANITIZE_STRING);
$business_lat = filter_input(INPUT_POST, 'business_lat',  FILTER_SANITIZE_NUMBER_FLOAT);
$business_long = filter_input(INPUT_POST, 'business_long',  FILTER_SANITIZE_NUMBER_FLOAT);
$business_type = filter_input(INPUT_POST, 'business_type', FILTER_SANITIZE_STRING);
/*if ($dealId == -1) {
    $dealId = NULL;
}*/

//if statements to validate form, works with createEvent.php
$errorMessage = array();
if ($business_name === FALSE || $business_name === '') {
    $errorMessage['business_name'] = 'Business Name must not be blank<br/>';
}

if ($business_address === FALSE || $business_address === '') {
    $errorMessage['business_address'] = 'First Name must not be blank<br/>';
}

if ($business_lat === FALSE || $business_lat === '') {
    $errorMessage['business_lat'] = 'Second Name must not be blank<br/>';
}

if ($business_long === FALSE || $business_long === '') {
    $errorMessage['business_long'] = 'Address must not be blank<br/>';
}

if ($business_type === FALSE || $business_type === '') {
    $errorMessage['business_type'] = 'Phone Number must not be blank<br/>';
}

//uses gateway to call insertBusiness method and passes in variables
$businessId = $gateway->insertBusiness($business_name, $business_address, $business_lat, $business_long, $business_type);
$message = "New Business Created";
header("Location: home.php");






