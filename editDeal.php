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

$dealID = filter_input(INPUT_POST, 'dealID', FILTER_SANITIZE_NUMBER_INT);
$deal_description = filter_input(INPUT_POST, 'deal_description', FILTER_SANITIZE_STRING);
$deal_category = filter_input(INPUT_POST, 'deal_category', FILTER_SANITIZE_STRING);
$businessId = filter_input(INPUT_POST, 'businessId', FILTER_SANITIZE_STRING);
$business_name = filter_input(INPUT_POST, '$business_name', FILTER_SANITIZE_STRING);
if($dealID === -1) {
    $dealID = NULL;
}

$gateway->updateDeal($dealID, $deal_description, $deal_category, $businessId, $business_name);

header('Location: viewDeals.php');

