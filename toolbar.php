<?php

$session_id = session_id();
if ($session_id == "") {
    session_start();
}
if (isset($_SESSION['username'])) {
    echo '<a href="logout.php" class="btn btn-logout btn-md"><text class="whiteFont">Logout</text></a>';
} else {
    echo '<li><a href="login.php" class="btn btn-signin inline btn-xs"><text class="whiteFont">Sign In</text></a></li>';
    echo '<li><a href="register.php" class="btn btn-register inline btn-xs"><text class="whiteFont">Register</text></a></li>';
}

