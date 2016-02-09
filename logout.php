<?php

$id = session_id();
if ($id == "") {
    session_start();
}

$_SESSION['username'] = NULL;
$_SESSION['user_id'] = NULL;
unset($_SESSION['username']);
unset($_SESSION['user_id']);

header("Location: index.php");
