<?php
if (isset($_COOKIE['user_id'])) {
    setcookie('user_id', '', time() - 3600, '/');
}

if (isset($_COOKIE['user_role'])) {
    setcookie('user_role', '', time() - 3600, '/');
}

$_SESSION = array();
session_destroy();
header("Location: login.php");
exit();
?>