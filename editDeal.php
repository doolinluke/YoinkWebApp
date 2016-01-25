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
$dealName = filter_input(INPUT_POST, 'deal_description', FILTER_SANITIZE_STRING);
if($dealID === -1) {
    $dealID = NULL;
}

$gateway->updateDeal($dealID, $deal_description);

header('Location: viewDeals.php');

