<?php

require_once 'Deal.php';
require_once 'Connection.php';
require_once 'DealTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';

if (!isset($_GET) || !isset($_GET['id'])) {
    die('Invalid request');
}
$id = $_GET['id'];

$connection = Connection::getInstance();
//gateway calls deleteDeal method from DealTableGateway
$gateway = new DealTableGateway($connection);

$gateway->deleteDeal($id);

header("Location: viewDeals.php");
?>
