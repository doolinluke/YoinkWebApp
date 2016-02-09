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

$dealId = filter_input(INPUT_POST, 'dealId', FILTER_SANITIZE_NUMBER_INT);
$deal_description = filter_input(INPUT_POST, 'deal_description', FILTER_SANITIZE_STRING);
$deal_category = filter_input(INPUT_POST, 'deal_category', FILTER_SANITIZE_STRING);
$businessId = filter_input(INPUT_POST, 'businessId', FILTER_SANITIZE_STRING);
$business_name = filter_input(INPUT_POST, '$business_name', FILTER_SANITIZE_STRING);
if($dealId === -1) {
    $dealId = NULL;
}

$gateway->updateDeal($dealId, $deal_description, $deal_category, $businessId, $business_name);

header('Location: viewDeals.php');

