<?php

require_once 'Deal.php';
require_once 'Connection.php';
require_once 'DealTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';

$connection = Connection::getInstance();
$gateway = new DealTableGateway($connection);

//Validates form data, removes harmful input
$dealId = filter_input(INPUT_POST, 'dealId', FILTER_SANITIZE_NUMBER_INT);
$deal_description = filter_input(INPUT_POST, 'deal_description', FILTER_SANITIZE_STRING);
$deal_category = filter_input(INPUT_POST, 'deal_category', FILTER_SANITIZE_STRING);
$businessId = filter_input(INPUT_POST, 'businessId', FILTER_SANITIZE_STRING);
$business_name = filter_input(INPUT_POST, 'business_name', FILTER_SANITIZE_STRING);

if ($dealId == -1) {
    $dealId = NULL;
}

//if statements to validate form, works with createDeal.php
$errorMessage = array();
if ($deal_description === FALSE || $deal_description === '') {
    $errorMessage['dealNameError'] = 'Deal Name must not be blank<br/>';
}

if ($deal_category === FALSE || $deal_category === '') {
    $errorMessage['dealNameError'] = 'Deal Name must not be blank<br/>';
}

if ($business_name === FALSE || $business_name === '') {
    $errorMessage['dealNameError'] = 'Deal Name must not be blank<br/>';
}

//uses gateway to call insertDeal method and passes in variables
$dealId = $gateway->insertDeal($deal_description, $deal_category, $businessId, $business_name);
$message = "New Deal Created";
header("Location: viewDeals.php");






