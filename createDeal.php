<?php

require_once 'Deal.php';
require_once 'Connection.php';
require_once 'DealTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

$userId = $_SESSION['user_id'];

require 'ensureUserLoggedIn.php';

$connection = Connection::getInstance();
$gateway = new DealTableGateway($connection);

//Validates form data, removes harmful input
$dealId = filter_input(INPUT_POST, 'dealId', FILTER_SANITIZE_NUMBER_INT);
$deal_description = filter_input(INPUT_POST, 'deal_description', FILTER_SANITIZE_STRING);
$deal_category = filter_input(INPUT_POST, 'deal_category', FILTER_SANITIZE_STRING);
$businessId = filter_input(INPUT_POST, 'businessId', FILTER_SANITIZE_STRING);

if ($dealId == -1) {
    $dealId = NULL;
}

if ($userId == -1) {
    $userId = null;
}
//if statements to validate form, works with createDeal.php
$errorMessage = array();
if ($deal_description === FALSE || $deal_description === '') {
    $errorMessage['dealNameError'] = 'Deal Description must not be blank<br/>';
}

if ($deal_category === FALSE || $deal_category === '') {
    $errorMessage['dealCategoryError'] = 'Deal Category must not be blank<br/>';
}

if ($businessId === FALSE || $businessId === '') {
    $errorMessage['businessNameError'] = 'Business Name must not be blank<br/>';
}

//uses gateway to call insertDeal method and passes in variables


if (empty($errorMessage)) {
    $dealId = $gateway->insertDeal($deal_description, $deal_category, $businessId, $userId);
    $message = "New Deal Created";
    header("Location: viewDeals.php");
}
else {
    require 'createDealForm.php';
}




