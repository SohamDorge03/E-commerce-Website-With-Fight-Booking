<?php

include("/wamp64/www/major project/Admin/include/connection.php");
session_start();

$_SESSION = array();

session_destroy();

header("location: login.php");
exit;
?>
