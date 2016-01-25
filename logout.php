<?php

$id = session_id();
if ($id == "") {
    session_start();
}

$_SESSION['username'] = NULL;
unset($_SESSION['USERNAME']);

header("Location: index.php");
