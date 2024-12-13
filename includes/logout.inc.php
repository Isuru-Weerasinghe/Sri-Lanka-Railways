<?php
session_start();

use classes\User;

require_once '../classes/User.php';

if (isset($_COOKIE['remember_me'])) {
    unset($_COOKIE['remember_user']);
    setcookie("remember_me", "", -1, "/");
    $user = new User(null, null);
    $user->setUserId($_SESSION['userId']);
    $user->setToken(null);
    $user->setExpiry(null);
    $user->update();
}

$_SESSION = array();
session_destroy();
header("location: ../index.php");
exit;