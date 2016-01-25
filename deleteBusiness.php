<?php

require_once 'Business.php';
require_once 'Connection.php';
require_once 'BusinessTableGateway.php';

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
$gateway = new BusinessTableGateway($connection);

//gateway calls deleteBusiness method from BusinessTableGateway
$gateway->deleteBusiness($id);

header("Location: home.php");
?>
