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

$businessID = filter_input(INPUT_POST, 'businessID', FILTER_SANITIZE_STRING);
$business_name = filter_input(INPUT_POST, 'business_name', FILTER_SANITIZE_STRING);
$business_address = filter_input(INPUT_POST, 'business_address', FILTER_SANITIZE_STRING);
$business_lat = filter_input(INPUT_POST, 'business_lat', FILTER_SANITIZE_STRING);
$business_long = filter_input(INPUT_POST, 'business_long', FILTER_SANITIZE_STRING);
$business_type = filter_input(INPUT_POST, 'business_type', FILTER_SANITIZE_STRING);

if(empty($errorMessage)){
    $gateway->updateBusiness($businessID, $business_name, $business_address, $business_lat, $business_long, $business_type);

    header('Location: home.php');
}
else{
    require 'editBusinessForm.php';    
}
