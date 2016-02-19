<?php

require_once 'Deal.php';
require_once 'Connection.php';
require_once 'DealTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

$dealId = $_SESSION['id'];

require 'ensureUserLoggedIn.php';

$connection = Connection::getInstance();
$gateway = new DealTableGateway($connection);

$deal_description = filter_input(INPUT_POST, 'deal_description', FILTER_SANITIZE_STRING);
$deal_category = filter_input(INPUT_POST, 'deal_category', FILTER_SANITIZE_STRING);
$businessId = filter_input(INPUT_POST, 'businessId', FILTER_SANITIZE_STRING);
if($dealId === -1) {
    $dealId = NULL;
}

$errorMessage = array();
if ($deal_description === FALSE || $deal_description === '') {
    $errorMessage['$deal_description'] = 'Deal Description must not be blank<br/>';
}

if ($deal_category === FALSE || $deal_category === '') {
    $errorMessage['$deal_category'] = 'Category must not be blank<br/>';
}

if ($businessId === FALSE || $businessId === '') {
    $errorMessage['$businessId'] = 'Business must not be blank<br/>';
}

$gateway->updateDeal($dealId, $deal_description, $deal_category, $businessId);

header('Location: viewDeals.php');

