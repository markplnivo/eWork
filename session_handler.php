<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

function loginUser($username, $position, $user_id) {
    $_SESSION['username'] = $username;
    $_SESSION['position'] = $position;
    $_SESSION['user_id'] = $user_id;
}

function logoutUser() {
    session_unset();
    session_destroy();
}

function isLoggedIn() {
    return isset($_SESSION['username']);
}

?>
